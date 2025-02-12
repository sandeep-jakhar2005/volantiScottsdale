<?php

namespace ACME\paymentProfile\Http\Controllers\Admin;

// use ACME\paymentProfile\Mail\OrderInvoice;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;
use ACME\paymentProfile\Models\invoiceImage;
use ACME\paymentProfile\Models\agentHandler;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Facades\Invoice;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Http;
use Webkul\Sales\Models\OrderItem;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use ACME\paymentProfile\Jobs\ProcessQuickBooksInvoice;
use ACME\paymentProfile\Jobs\OrderInvoiceJob;


class InvoicesController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\InvoiceRepository  $invoiceRepository
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected InvoiceRepository $invoiceRepository
    ) {
        $this->middleware('admin');

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($orderId)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        try {
            $invoice_images = invoiceImage::all();
            $invoice_images = $invoice_images->toArray();
            $agent = agentHandler::where('order_id', $orderId)->first();

            $nameArray = array_column($invoice_images, 'name');
            $imageEncodeArray = array_column($invoice_images, 'image_encode');

            // Sort the arrays based on the 'name' field
            array_multisort($nameArray, $imageEncodeArray);

            // Combine the sorted arrays into a new array
            $sort_invoice_image = array_combine($nameArray, $imageEncodeArray);
            $order = Order::where('id', $orderId)->first();
            // dd($order);
            $categories = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->join('category_translations', 'product_categories.category_id', '=', 'category_translations.category_id')
                ->where('order_items.order_id', $order->id)
                ->where('category_translations.locale', 'en')
                ->select('category_translations.name as category_name', 'order_items.*')
                ->get();

            // Grouping items by category and ensuring each product appears only once
            $groupedItems = [];
            $addedProducts = [];
            foreach ($categories as $item) {
                $categoryName = $item->category_name;
                $productId = $item->product_id;
                unset($item->category_name); // Remove category name from item

                // Check if the product has already been added to a category
                if (!in_array($productId, $addedProducts)) {
                    if (!isset($groupedItems[$categoryName])) {
                        $groupedItems[$categoryName] = [];
                    }
                    
                    $groupedItems[$categoryName][] = $item;
                    $addedProducts[] = $productId; // Mark product as added to a category
                }
            }
            // Extract category names from the result
            $categoryNames = $categories->pluck('name')->toArray();

            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => true,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true, // Typo corrected
                ],
            ]);

            $options = new Options();
            $options->set('isHtml5ParserEnabled', FALSE);
            //  $options->set('isRemoteEnabled', false);
            $dompdf = new Dompdf();
            $dompdf->setOptions($options);
            $dompdf->setHttpContext($context);
            $html = view('shop::pdf.header');

            $html = view('shop::pdf.invoices', compact('order', 'groupedItems', 'sort_invoice_image', 'agent'));
            //  $dompdf->loadHtml(ob_get_clean());
            $dompdf->loadHtml($html);

            // Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render PDF
            $dompdf->render();

            $pdfFileName = 'invoice_' . uniqid() . '.pdf';

            $pdfPath = storage_path('app/public/invoice/' . $pdfFileName);
            file_put_contents($pdfPath, $dompdf->output());
            $order = $this->orderRepository->findOrFail($orderId);

            $order->update(['status' => 'invoice sent', 'status_id' => 3]);
            DB::table('order_status_log')
                ->insert([
                    'order_id' => $order->id,
                    'user_id' => $admin_id,
                    'is_admin' => 1,
                    'status_id' => 3,
                    'email' => $order->customer_email === null ? $order->fbo_email_address : $order->customer_email,
                ]);
            // dd($order);


            // sandeep add code for invoice send using queue
            try{
                OrderInvoiceJob::dispatch($order, $agent, $pdfPath);
            }catch (QueryException $e){
                
            }
            
            session()->flash('success', 'Invoiced sent Successfully!');
            // sandeep send quickbook invoice using queue
            ProcessQuickBooksInvoice::dispatch($orderId);
        
            // $this->createInvoice($orderId);
            // return redirect()->route('quickbooks.invoice.create',['orderId'=>$orderId]);

            return redirect()->back();
        } catch (QueryException $e) {
            session()->flash('error', 'Error generating the order. Please try again.');
            return redirect()->back();

        } catch (\Exception $e) {
            // dd($e);
            session()->flash('error', 'An error occurred. Please try again.');
            return redirect()->back();
        }

    }


    // function to get all quickbooks account  details
    public function getQuickBooksConfig()
    {
        return [
            'client_id' => config('app.client_id'),
            'client_secret' => config('app.client_secret'),
            'redirect_uri' => config('app.redirect_uri'),
            'baseUrl' => config('app.baseUrl'),
            'company_id' => config('app.company_id'),
            'scope' => config('app.scope'),
        ];
    }


// sandeep || function to create invoice in quickbook 
    public function createInvoice($orderId)
    {
        try {
            log::info('creaet quickbook invoice2332');
            $configData = $this->getQuickBooksConfig();
            $order = Order::where('id', $orderId)->first();
                
                $tokenData = DB::table('quickbook_tokens')->where('client_id', $configData['client_id'])->first();
                if (!$tokenData) {
                    log::info('sandeep connect funtion');
                    return  $this->connect();
                    // return response()->json(['error' => 'No tokens found. Please connect again.'], 401);
                }
            
                log::info('creaet invoice');
                $accessToken = $tokenData->access_token;
                $expiresAt = strtotime($tokenData->access_token_expires_at);
                $refreshToken = $tokenData->refresh_token;
                $refreshTokenExpiresAt = strtotime($tokenData->refresh_token_expires_at);
    
                // Check if refresh token is expired
                if (empty($refreshToken) || (time() >= $refreshTokenExpiresAt)) {
                    log::info('connnect funtion');
                    return  $this->connect();
                }

                // Check if access token is empty or expired
                if (empty($accessToken) || (time() >= $expiresAt)) {
                    $tokens = $this->refreshAccessToken($configData['client_id'], $configData['client_secret'], $refreshToken,$configData['company_id']);
                    if ($tokens) {
                        $accessToken = $tokens['access_token'];
                        log::info('accessToken');
                    } else {
                        return response()->json(['error' => 'Failed to refresh access token'], 401);
                    }
                }
                

                 $customerDetail = DB::table('customers')->find($order->customer_id);
                 $agent = agentHandler::where('order_id', $orderId)->first();

                 log::info('customer_id',['customer_id'=>$customerDetail]);
                 if (isset($agent->Handling_charges) && is_numeric($agent->Handling_charges)) {
                     $Handling_charges = $agent->Handling_charges;
                 }

                $quickbookCustomerId = null;
                if (!$customerDetail->quickbook_customer_id) {
                    $customerResponse = $this->createCustomer($customerDetail, $configData['company_id'], $accessToken,$orderId);
                    $quickbookCustomerId = $customerResponse['customerId'];
                }else {
                    $quickbookCustomerId = $customerDetail->quickbook_customer_id;
                }

                // log::info('creaet customer');
                //   $customerResponse = $this->createCustomer($customerDetail, $configData['company_id'], $accessToken,$orderId);
                //     $quickbookCustomerId = $customerResponse['customerId'];
                // log::info('create customer2');

                $lines = [];
                $itemsData = $order->items;

                // Check if the agent has handling charges
                if (isset($agent->Handling_charges)) {
                    $agent->name = "Handling Charge";
                    $itemsData->push($agent);
                }

                foreach ($itemsData as $item) {
                    $optionLabel = null;
                    if (isset($item->additional['attributes'])) {
                        $attributes = $item->additional['attributes'];
                
                        foreach ($attributes as $attribute) {
                            if (isset($attribute['option_label']) && $attribute['option_label'] != '') {
                                $optionLabel = $attribute['option_label'];
                            }
                        }
                    }

                 $itemName = $item->name;
   
                if ($optionLabel) {
                  $itemName = $itemName . ' (' . $optionLabel . ')';
                }
                $query = "SELECT * FROM Item WHERE Name = '{$itemName}'";
                $existingItemResponse = Http::withToken($accessToken)
                    ->withHeaders(['Content-Type' => 'text/plain'])
                    ->get("https://sandbox-quickbooks.api.intuit.com/v3/company/{$configData['company_id']}/query?query=" . urlencode($query) . "&minorversion=73");
            
                if (!$existingItemResponse->successful()) {
                    $responseBody = $existingItemResponse->body();
                }
    
                $responseData  = json_decode(json_encode(simplexml_load_string($existingItemResponse->body())), true);
                $existingItems = $responseData['QueryResponse']['Item'] ?? [];
                if (count($existingItems) > 0) {
                    $lines[] = [
                        "DetailType" => "SalesItemLineDetail",
                        "Amount" => $item->total ?? $Handling_charges ?? "0", 
                        "SalesItemLineDetail" => [
                            "ItemRef" => [
                                "name" => $existingItems['Name'], 
                                "value" => $existingItems['Id'],
                            ],
                            "Qty" => $item->qty_ordered ?? null, 
                            "UnitPrice" => $item->price ?? null,
                            "TaxCodeRef" => [
                            "value" => "TAX" 
                            ],
                        ]
                    ];
                

                    } else {
                        $newItemData = [
                            "Name" => $itemName,
                            "Type" => "Service",
                            "IncomeAccountRef" => [
                                "value" => "79",
                            ]
                        ];
                        $createItemResponse = Http::withToken($accessToken)
                            ->withHeaders(['Content-Type' => 'application/json'])
                            ->post("https://sandbox-quickbooks.api.intuit.com/v3/company/{$configData['company_id']}/item", $newItemData);
        
                            $responseData = json_decode(json_encode(simplexml_load_string($createItemResponse->body())), true);
                            log::info($responseData);
                            $existingItems = $responseData['Item'] ?? [];
                        if ($createItemResponse->successful()) {
                            $lines[] = [
                                "DetailType" => "SalesItemLineDetail",
                                "Amount" => $item->total ?? $Handling_charges ?? "0", 
                                "SalesItemLineDetail" => [
                                    "ItemRef" => [
                                        "name" => $existingItems['Name'], 
                                        "value" => $existingItems['Id'],
                                    ],
                                    "Qty" => $item->qty_ordered ?? null, 
                                    "UnitPrice" => $item->price ?? null,
                                    "TaxCodeRef" => [
                                        "value" => "TAX"
                                ],
                                ]
                            ];
                        } else {
                            return response()->json([
                                'error' => 'Failed to create item in QuickBooks',
                                'details' => $createItemResponse->json()
                            ], 400);
                        }
                }
            }


            log::info('creaet invoice1');

            $invoiceData = [
                "Line" => $lines, 
                "TxnTaxDetail"=> [
                    "TxnTaxCodeRef"=> [
                      "value"=> "2"
                    ],
                    "TotalTax"=> $order->tax_amount
                ],
                "CustomerRef" => [
                    "value" => $quickbookCustomerId
                ],
                "TxnDate" => date('Y-m-d'),
                // "DueDate" => date('Y-m-d', strtotime('+30 days')),
                "BillEmail" => [
                    "Address" => $order->fbo_email_address ?? $order->customer_email
                ],
                "BillAddr" => [
                    "Line1" => $order->billing_address->airport_name, 
                    "Line2" => $order->billing_address->address1,  
                    "City" => $order->billing_address->state,            
                    "Country" => $order->billing_address->country,      
                    "PostalCode" => $order->billing_address->postcode   
                ],
                "ShipAddr" => [
                    "Line1" => $order->shipping_address->airport_name,  
                    "Line2" => $order->shipping_address->address1,
                    "City" => $order->shipping_address->state,           
                    "Country" => $order->shipping_address->country,      
                    "PostalCode" => $order->shipping_address->postcode    
                ],
                "CustomField" => [
                    [
                        "DefinitionId" => "1",
                        "Type" => "StringType",
                        "StringValue" => $order->delivery_time
                    ],
                    [
                        "DefinitionId" => "2",
                        "Type" => "StringType",
                        "StringValue" => $order->fbo_tail_number 
                    ]
                ],
                "AllowOnlinePayment" => true,

        ];

        log::info('creaet invoice2');

             // Make the invoice creation request with the access token
             $result = $this->createInvoiceRequest($configData['company_id'], $accessToken, $invoiceData,$orderId);
           
             log::info('result',['result'=>$result]);
            log::info('creaet invoice3');

             //  store inquiery id to orders table
            if ($result) {
                $data = json_decode($result->getContent(), true);
                log::info($data);
                $id = $data['invoice']['Id'];
                $invoiceLink = $data['invoice']['InvoiceLink'];
            
                DB::table('orders')
                    ->where('id', $orderId)
                    ->update([
                        'quickbook_invoice_id' => $id,
                        'quickbook_invoice_link' => $invoiceLink
                    ]);
            }
    
             $statusCode = $result->getStatusCode();
             $resultContent = $result->getData(true);
            if ($statusCode == 201) {
                log::info('invoice create');
                // return redirect()->back();
                 return [
                'status' => 'success',
                'message' => 'invoice created in QuickBooks successfully.'
            ];
            } else {
                return response()->json(['error' => 'Failed to create invoice', 'status_code' => $statusCode, 'response' => $resultContent], $statusCode);
            }
        
        } catch (\Exception $e) {
            file_put_contents('debug.log', 'Error creating QuickBooks invoice: ' . $e->getMessage() . "\n");
            return null;
        }
    }
    
    // sandeep || function to create invoice request
            private function createInvoiceRequest($companyId, $accessToken, $invoiceData,$orderId)
            {
                log::info('creaet invoice435435');
            try{

                $orders = DB::table('orders')->where('id',$orderId)->first();
                $invoiceId = $orders->quickbook_invoice_id;
                if (!empty($invoiceId)) {
                    $existingInvoiceResponse = Http::withToken($accessToken)
                        ->withHeaders(['Content-Type' => 'application/json'])
                        ->get("https://sandbox-quickbooks.api.intuit.com/v3/company/{$companyId}/invoice/{$invoiceId}?minorversion=73");
    
                $existingInvoice = json_decode(json_encode(simplexml_load_string($existingInvoiceResponse->body())), true);

                if (isset($existingInvoice['Invoice'])) {

                $syncToken = $existingInvoice['Invoice']['SyncToken'];
                $invoiceData['SyncToken'] = $syncToken;
                $invoiceData['Id'] = $invoiceId;
                
                $updateResponse = Http::withToken($accessToken)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post("https://sandbox-quickbooks.api.intuit.com/v3/company/{$companyId}/invoice?minorversion=73", $invoiceData);
    
                    $updatedInvoice = json_decode(json_encode(simplexml_load_string($updateResponse->body())), true);

                    if ($updateResponse->successful()) {
                         $updatedInvoice = json_decode(json_encode(simplexml_load_string($updateResponse->body())), true);
                         return response()->json([
                            'message' => 'Invoice updated successfully',
                            'invoice' => $updatedInvoice['Invoice'],
                          ], 201);
                    }
                }else{
                    // not found invoice in quickbooks then create new
                        $response = Http::withToken($accessToken)
                        ->post("https://sandbox-quickbooks.api.intuit.com/v3/company/$companyId/invoice?minorversion=73", $invoiceData);

                        if ($response->successful()) {

                            $decodedResponse = json_decode(json_encode(simplexml_load_string($response->body())), true);
                            
                            return response()->json([
                                'message' => 'Invoice created successfully',
                                'invoice' => $decodedResponse['Invoice'],
                            ], 201);
                        }
                }

                  }else{
                        //    not found in database table then create new
                            $response = Http::withToken($accessToken)
                                           ->post("https://sandbox-quickbooks.api.intuit.com/v3/company/$companyId/invoice?minorversion=73", $invoiceData);
    
                            if ($response->successful()) {
                                $decodedResponse = json_decode(json_encode(simplexml_load_string($response->body())), true);
                                
                                return response()->json([
                                    'message' => 'Invoice created successfully',
                                    'invoice' => $decodedResponse['Invoice'],
                                ], 201);
                            }
                        }

                    }catch (\Exception $e) {
                            file_put_contents('debug.log', 'Error creating QuickBooks invoice: ' . $e->getMessage() . "\n");
                            return null;
                        }

                    }


                    
            //sandeep ||  Function to refresh the access token
            public function refreshAccessToken($client_id, $client_secret, $refreshToken,$companyId)
            {
                $tokenUrl = "https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer";
                
                try {
                    $client = new Client();
                    $response = $client->post($tokenUrl, [
                        'headers' => [
                            'Authorization' => 'Basic ' . base64_encode($client_id . ':' . $client_secret),
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                        'form_params' => [
                            'grant_type' => 'refresh_token',
                            'refresh_token' => $refreshToken,
                        ],
                    ]);
    
                    $data = json_decode($response->getBody(), true);
                    log::info('data',['data'=>$data]);

                    DB::table('quickbook_tokens')->updateOrInsert(
                        ['client_id' => $client_id],
                        [ 
                            'access_token' => $data['access_token'],
                            'refresh_token' => $data['refresh_token'],
                            'company_id'   =>   $companyId,
                            'access_token_expires_at' => date('Y-m-d H:i:s', time() + $data['expires_in']),
                            'refresh_token_expires_at' => date('Y-m-d H:i:s', time() + $data['x_refresh_token_expires_in']),
                        ]
                    );
                    return [
                        'access_token' => $data['access_token'],
                        'expires_in' => $data['expires_in'],
                    ];
    
                } catch (\Exception $e) {
                    file_put_contents('debug.log', 'Error refreshing access token: ' . $e->getMessage() . "\n");
                    return null;
                }
            }
    
       // sandeep || function to create customer in quickbook 
        private function createCustomer($customerDetail,$companyId,$accessToken,$orderId){
            log::info('update customer');
            // check if customer detail is empty
            if (empty($customerDetail->first_name) || empty($customerDetail->last_name) || empty($customerDetail->email)) {
               $customerOrderDetails = DB::table('orders')->where('id',$orderId)->first();
                    $customerData = [
                        "FullyQualifiedName" => $customerOrderDetails->fbo_email_address,
                        "PrimaryEmailAddr" => [
                            "Address" => $customerOrderDetails->fbo_email_address
                        ],
                        "DisplayName" => $customerOrderDetails->fbo_email_address,
                        "MiddleName" => $customerOrderDetails->fbo_email_address,
                        "PrimaryPhone" => [
                            "FreeFormNumber" => $customerOrderDetails->fbo_phone_number
                        ]
                    ];
                    $query = "SELECT * FROM Customer WHERE FullyQualifiedName = '{$customerOrderDetails->fbo_email_address}'";
            }else{
                    $customerData = [
                        "FullyQualifiedName" => $customerDetail->email,
                        "PrimaryEmailAddr" => [
                            "Address" => $customerDetail->email
                        ],
                        "DisplayName" => $customerDetail->email,
                        "MiddleName" => $customerDetail->email,
                        "PrimaryPhone" => [
                            "FreeFormNumber" => $customerDetail->phone
                        ]
                    ];
                    $query = "SELECT * FROM Customer WHERE FullyQualifiedName = '{$customerDetail->email}'";
            }
            
            try {
                // Query to check if the customer already exists by email
                    $response = Http::withToken($accessToken)
                        ->withHeaders(['Content-Type' => 'text/plain'])
                        ->get("https://sandbox-quickbooks.api.intuit.com/v3/company/{$companyId}/query", [
                            'query' => $query,
                        ]);

                    if ($response->successful()) {
                        $customers = json_decode(json_encode(simplexml_load_string($response->body())), true);
                        $existingCustomerData = $customers['QueryResponse']['Customer'] ?? null;
    
                        if (!empty($existingCustomerData)) {
                            // Customer exists, so we update their details  
                            $existingCustomerId = $existingCustomerData['Id'];
                            if ($existingCustomerId) {
                                DB::table('customers')
                                    ->where('id', $customerDetail->id)
                                    ->update(['quickbook_customer_id' => $existingCustomerId]);
                            }
                            
                            return [
                                'success' => true,
                                'customerId' => $existingCustomerId,
                            ];
                    } else {
                        // Customer does not exist, so we create a new one
                        $createResponse = Http::withToken($accessToken)
                            ->withHeaders(['Content-Type' => 'application/json'])
                            ->post("https://sandbox-quickbooks.api.intuit.com/v3/company/{$companyId}/customer", $customerData);
                        
                        if ($createResponse->successful()) {
                            $createResponseData = json_decode(json_encode(simplexml_load_string($createResponse->body())), true);
                            $customerId = $createResponseData['Customer']['Id'] ?? null;
        
                            if ($customerId) {
                                // Update the local database
                                DB::table('customers')
                                    ->where('id', $customerDetail->id)
                                    ->update(['quickbook_customer_id' => $customerId]);
        
                                return [
                                    'success' => true,
                                    'customerId' => $customerId,
                                    'message' => 'Customer created successfully.'
                                ];
                            }
                        }
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Error retrieving customers',
                        'response' => $response->body()
                    ];
                }
            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Exception occurred: ' . $e->getMessage()
                ];
            }
        }

         //    function to connect quickbook site
        public function connect()
        {
            log::info('connnect');

            $configData = $this->getQuickBooksConfig();
            
            $dataService = DataService::Configure([
                'auth_mode'     => 'oauth2',
                'ClientID'      => $configData['client_id'],
                'ClientSecret'  => $configData['client_secret'],
                'RedirectURI'   => $configData['redirect_uri'],
                'scope'         => $configData['scope'],
                'baseUrl'       => $configData['baseUrl'],
            ]);

            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

            return redirect($authUrl);
        }

           //    function to create refresh and access token
            public function callback(Request $request)
            {
                log::info('callback funtion');
                $configData = $this->getQuickBooksConfig();
                $dataService = DataService::Configure([
                    'auth_mode'     => 'oauth2',
                    'ClientID'      => $configData['client_id'],
                    'ClientSecret'  => $configData['client_secret'],
                    'RedirectURI'   => $configData['redirect_uri'],
                    'scope'         => $configData['scope'],
                    'baseUrl'       => $configData['baseUrl'],
                ]);
                
                $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
                $accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($request->code, $request->realmId);
     
                log::info('access_token',['accessToken'=>$accessToken]);

                // Store the tokens in the database
                DB::table('quickbook_tokens')->updateOrInsert(
                    ['client_id' => $configData['client_id']],
                    [ 
                        'access_token' => $accessToken->getAccessToken(),
                        'refresh_token' => $accessToken->getRefreshToken(), 
                        'company_id'   => $request->realmId,
                        'access_token_expires_at' => $accessToken->getAccessTokenExpiresAt(),
                        'refresh_token_expires_at' => $accessToken->getRefreshTokenExpiresAt(),
                    ]
                );
                
                // return redirect()->route('quickbooks.invoice.create');
                
            }




    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view($this->_config['view']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $orderId
     * @return \Illuminate\View\View
     */

    public function view(Request $request)
    {
        $data = $request->all();
        $order_detail = json_decode(json_encode($data));
        // dd($order_detail);
        return view($this->_config['view'], compact('order_detail'));
    }

    public function invoice_detail(Request $request)
    {
        $detail = $request->all();
        $order = Order::where('id', $detail['orderid'])->first();

        if (
            ($order->customer_email !== null && $detail['email'] === $order->customer_email && $detail['tail_number'] === $order->fbo_tail_number) ||
            ($order->customer_email === null && $detail['email'] === $order->fbo_email_address && $detail['tail_number'] === $order->fbo_tail_number)
        ) {
            return view($this->_config['view'], compact('order'));
        }

        session()->flash('error', 'Wrong email or tail number');
        return redirect()->back();
    }

}
