@extends('shop::layouts.master')
@section('content-wrapper')
    <div class="container my-5 order_invoice_view">
        <div class="invoice_view_header d-flex justify-content-between">
            <h2>Custom Order Payment</h2>
        
            <p class="text-secondary">Order Status: <span
                    class="text-uppercase {{ $order->status }}">{{ $order->status }}</span></p>
        </div>

        <section class="customer_detail">
            <h5 class="bg-dark p-2 text-light">Customer</h5>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-5 fbo__detail">
                    {{-- <h4 class="">Fbo Detail</h4> --}}

                    <h4>{{__('shop::app.fbo-detail.client-info')}}</h4>
                    <p class="m-0">{{ $order->fbo_full_name }}</p>
                    <p class="m-0">{{ $order->fbo_email_address }}</p>
                    <p class="mb-3">{{ $order->fbo_phone_number }}</p>
                    <h4>{{__('shop::app.fbo-detail.aircraft-info')}}</h4>
                    <p class="m-0">{{ $order->fbo_tail_number }}</p>
                    <p class="m-0">Packaging: {{ $order->fbo_packaging }}</p>
                    <p>Service Packaging: {{ $order->fbo_service_packaging }}</p>
                    @if (isset($order->delivery_date) && $order->delivery_date != '')
                        @php
                            $date = $order->delivery_date;

                            // Create a DateTime object from the date string
                            $dateObj = new DateTime($date);

                            // Get today's date
                            $today = new DateTime('today');

                            // Get tomorrow's date
                            $tomorrow = new DateTime('tomorrow');

                            // Compare the delivery date with today's date and tomorrow's date
                            if ($dateObj->format('Y-m-d') == $today->format('Y-m-d')) {
                                // If delivery date is today, show today's date in the desired format
    $formattedDate = 'Today'; // Example format: "Thursday 3/26"
} elseif ($dateObj->format('Y-m-d') == $tomorrow->format('Y-m-d')) {
    // If delivery date is tomorrow, show tomorrow's date in the desired format
                                $formattedDate = 'Tomorrow'; // Example format: "Friday 3/27"
                            } else {
                                // If not today or tomorrow, show the delivery date in the original format
                                // Get the day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
                                $dayOfWeek = $dateObj->format('w');

                                // Array of days of the week
                                $daysOfWeek = [
                                    'Sunday',
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday',
                                    'Saturday',
                                ];

                                // Get the day of the week name
                                $dayName = $daysOfWeek[$dayOfWeek];

                                // Get the month
                                $month = $dateObj->format('n');

                                // Get the day of the month
                                $dayOfMonth = $dateObj->format('j');

                                // Format the date string
                                $formattedDate = $dayName . ' ' . $month . '/' . $dayOfMonth;
                            }
                        @endphp
                        <p>Delivery Date: {{ $formattedDate }}</p>
                    @endif
                    @if (isset($order->delivery_time) && $order->delivery_time != '')
                        <p class="mb-3">Delivery Time: {{ $order->delivery_time }}</p>
                    @endif
                </div>

                <div class="col-sm-12 col-md-8 col-lg-5 airport_address">
                    <h4 class="">Address</h4>

                    <strong>{{ $order->shipping_address->airport_name }}</strong>
                    <p> {{ $order->shipping_address->address1 }} </p>
                </div>
            </div>
        </section>

        <section class="shopping_cart my-3">
            <h5 class="bg-dark p-2 text-light">Shopping Cart</h5>
            <div class="row my-3">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="table">
                        <div class="table-responsive">
                            {{-- sandeep add css --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="order_view_table_head">
                                        <th>Item</th>
                                        <th>Product</th>
                                        {{-- @if (isset($specialInstruction)) --}}
                                        {{-- <th>Special instructions</th> --}}
                                        {{-- @endif --}}
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>

                                <tbody class="table__body">
                                    @php
                                        $orders = DB::table('order_items')
                                            ->where('order_id', $order->id)
                                            ->where('parent_id', null)
                                            ->get();
                                        // dd($orders)
                                    @endphp
                                    {{-- @dd($order->item) --}}
                                    @foreach ($order->items as $item)
                                        @php
                                            $optionLabel = null;
                                            $specialInstruction = null;
                                            $notes = null;
                                            if (isset($item->additional['attributes'])) {
                                                $attributes = $item->additional['attributes'];

                                                foreach ($attributes as $attribute) {
                                                    if (
                                                        isset($attribute['option_label']) &&
                                                        $attribute['option_label'] != ''
                                                    ) {
                                                        $optionLabel = $attribute['option_label'];
                                                    }
                                                }
                                            }

                                            if (isset($item->additional['special_instruction'])) {
                                                $specialInstruction = $item->additional['special_instruction'];
                                            }
                                            // dd($notes);
                                            $notes = DB::table('order_items')
                                                ->where('id', $item->id)
                                                ->where('order_id', $order->increment_id)
                                                ->value('additional_notes');

                                            // $truncatedNotes = Str::limit($notes, $limit = 9, $end = '...');

                                        @endphp

                                        <tr class="order_view_table_body">
                                            <td style="
                                        max-width: 130px;">
                                                {{-- <div>
                                                    <img class="product__img"
                                                        src="/cache/medium/product/278/s09QJX1kqQwX8zLXByqS8gU836SU5oPgp47G7ov3.png"
                                                        alt="Product" style="height: 70px;width: 80px;" />
                                                </div> --}}

                                                @if (isset($notes))
                                                    <p class="m-0 display__notes">{{ $notes }}</p>
                                                @endif
                                            </td>
                                            {{-- @dd($item) --}}
                                            <td>
                                                {{ $item->name }}
                                                @if ($optionLabel)
                                                    ({{ $optionLabel }})
                                                @endif
                                            </td>

                                            {{-- @if (isset($specialInstruction))
                                                <td class="special-intruction">{{ $specialInstruction }}</td>
                                            @else
                                                <td class="special-intruction text-center"></td>
                                            @endif --}}

                                            <td>{{ core()->formatBasePrice($item->base_price) }}</td>

                                            <td>
                                                <span class="qty-row">
                                                    {{ $item->qty_ordered }}
                                                </span>

                                            </td>

                                            <td>{{ core()->formatBasePrice($item->base_total - $item->base_discount_amount) }}
                                            </td>
                                    @endforeach
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="order__view__payment">
                        <h5>Order summary</h5>
                        {{-- @dd($agent->Handling_charges); --}}
                        <div class="card order__view__payment">
                            <div class="row p-2 order__view__total">
                                <p class="col-7 cart_text">Cart Total</p>
                                <p class="col-5 total">{{ core()->formatBasePrice($order->sub_total) }}</p>
                                {{-- @dd(core()->formatBasePrice(isset($item->base_tax_amount))) --}}
                                {{-- <p class="col-7 text">Discount</p>
                                <p class="col-5 price">20%</p> --}}
                                {{-- <p class="col-7 tax_text">Tax</p>
                                @if (isset($item->base_tax_amount))
                                    <p class="col-5 tax">{{ core()->formatBasePrice($item->base_tax_amount) }}</p>
                                @else
                                    <p class="col-5 total">{{ core()->formatBasePrice(0.0) }} </p>
                                @endif --}}

                                {{-- sandeep add code  --}}
                                <p class="col-7 cart_text m-0">
                                    Tax
                                </p>

                                @if (isset($order->tax_amount))
                                    <p class="col-5 tax m-0">{{ core()->formatBasePrice($order->tax_amount) }}</p>
                                @else
                                    <p class="col-5 total m-0">{{ core()->formatBasePrice(0.0) }} </p>
                                @endif
                                <p class="col-7 cart_text">
                                    Handler Charges
                                </p>
                                @if (isset($agent) && isset($agent->Handling_charges) && $agent->Handling_charges != '')
                                    <p class="col-5 tax">{{ core()->formatBasePrice($agent->Handling_charges) }}</p>
                                @else
                                    <p class="col-5 total">{{ core()->formatBasePrice(0.0) }} </p>
                                @endif
                                <p class="col-7 cart_text">
                                    @if ($order->status === 'paid')
                                        Paid amount
                                    @else
                                        Order Total
                                    @endif
                                </p>

                                <p class="col-5 total">
                                    @if (isset($agent->Handling_charges))
                                        {{ core()->formatBasePrice($order->grand_total + $agent->Handling_charges) }}
                                    @else
                                        {{ core()->formatBasePrice($order->grand_total) }}
                                    @endif
                                </p>









                            </div>
                        </div>
                        {{-- <button class="order_view_send_button mt-3">Send Updates</button> --}}
                    </div>
                </div>
            </div>
        </section>

        @php
        $order_status = DB::table('order_status_log')
        ->join('order_status', 'order_status_log.status_id', '=', 'order_status.id')
        ->where('order_status_log.order_id', $order->id)
        ->select('order_status.status') 
        ->pluck('order_status.status');
    
        $paymentButtonVisible = !$order_status->contains('paid');

            // $cards = collect();
            $cards = app('Webkul\MpAuthorizeNet\Repositories\MpAuthorizeNetRepository')->findWhere([
                'customers_id' => $order->customer_id,
            ]);
        @endphp

        <div class="paymen__section">

            @if ($order->status === 'paid' && !session('payment_success_' . $order->id))
                @php
                    session()->flash('success', 'Payment paid successfully');
                    session(['payment_success_' . $order->id => true]);
                    
                @endphp
            @endif

            <!-- sandeep delete deliverd and shipped -->
            @if (!in_array($order->status, ['pending', 'canceled', 'rejected', 'paid']) && $paymentButtonVisible)
                <button type="button" class="collect_payment_modal_button" data-toggle="modal"
                    data-target="#collectPaymentModal">
                    Make Payment
                </button>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="collectPaymentModal" tabindex="-1" role="dialog"
                aria-labelledby="collectPaymentTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="collectPaymentTitle">Collect Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-dark">
                            <div class="add_new_card">
                                <button type="button" id="open-mpauthorizenet-modal"
                                    class="order_view_add_card_button mr-2">Add card</button>
                                <input type="hidden" id="order_order_id" value="{{ $order->increment_id }}">
                                <input type="hidden" id="order_customer_id" value="{{ $order->customer_id }}">
                                {{-- mpauthorizenet --}}
                            </div>

                     {{-- sandeep add card error message --}}
                        <div class="card_erorr_message p-2 d-none" style="color:red;">
                          <span class="payment_error_message"></span>
                        </div>

                            @if (isset($cards) && count($cards) > 0)
                                <div class="strike-through text-center my-2">
                                    <span>or use existing card</span>
                                </div>

                                <div class="existing_card">
                                    @include(
                                        'mpauthorizenet::shop.volantijetcatering.components.saved-cards',
                                        [
                                            'customerId' => $order->customer_id,
                                        ]
                                    )
                                    {{-- delete payment modal --}}
                                    {{-- <button class="payment-delete-model-btn d-none" data-toggle="modal"
                                        data-target="#payment_delete_model">delete
                                        model</button>
                                    <div class="modal fade p-0 " id="payment_delete_model"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header fbo-header">
                                                    <h1 class="fs24 fw6 mt-1">
                                                        Delete Card
                                                    </h1>
                                                    <button type="button" class="close save-payment-close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body popup-content">
                                                    <div class="body col-12 border-0 p-0">
                                                        <form action="" method="POST" @submit.prevent="onSubmit">
                                                            {{ csrf_field() }}
                                                            <div class="row mb-3">
                                                                <p class="px-3">Are you sure you want
                                                                    to delete this card?
                                                                    Confirming will permanently remove
                                                                    the card from your account.
                                                                </p>
                                                                <div class="row w-100 mt-4">
                                                                    <div class="col"><button type="button"
                                                                            class="btn btn-primary accept">Ok</button>
                                                                    </div>
                                                                    <div class="col"><button type="button"
                                                                            class="btn btn-primary cancel">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- end delete payment modal --}}

                                </div>
                            @endif
                        </div>

                        <div class="modal-footer p-2">
                            <button type="button" class="collect_payment_close_button" data-dismiss="modal">Close</button>
                            <button type="button" class="invoice_view_pay_button pay_disable" id="collect_payment"
                                disabled>Charge 
                            
                                @if (isset($agent->Handling_charges))
                                {{ core()->formatBasePrice($order->grand_total + $agent->Handling_charges) }}
                            @else
                                {{ core()->formatBasePrice($order->grand_total) }}
                            @endif
                            
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    @include('mpauthorizenet::shop.volantijetcatering.checkout.card-script', [
        'orderId' => $order->id,
        'customerId' => $order->customer_id,
    ])
@endpush
