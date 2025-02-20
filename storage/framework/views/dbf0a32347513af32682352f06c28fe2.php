<?php
use Carbon\Carbon;
?>

<html>

<head>
    <style>
        /** Define the margins of your page **/
        /** Define the margins of your page **/
        @page {
            margin: 220px 40px;
        }

        header {
            position: fixed;
            top: -220px;
            left: 0px;
            right: 0px;
            /** Extra personal styles **/

            color: black;
            text-align: center;
            line-height: 35px;
        }

        .w-100 {
            width: 100%;
        }

        main {
            margin-top: 0;
        }

        header p {
            margin: 0;
            font-size: 13px;
            line-height: 18px;
            font-family: sans-serif;
            text-align: right;
        }

        header h2,
        header h1 {
            font-family: sans-serif;
            text-align: right;
            font-weight: 400;
            margin: 10px 0;
        }

        /* Added CSS for the table layout */
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        header h2 {
            color: #aa1d25;
        }

        .header-table td {
            border: 1px solid white;
            padding: 5px;


        }
  

        header img {
            max-width: 100px;
        }

        header hr {
            border: 1px solid #aa1d25;
            width: 60%;
            margin-right: 0;
        }

        footer {
            position: fixed;
            bottom: -200px;
            left: 0px;
            right: 0px;
            margin: 0;
            /** Extra personal styles **/

            color: black;
            text-align: center;
            line-height: 35px;
            border-top: 2px solid #a7a7a7;
            padding-top: 20px;
        }

        footer p {
            text-align: center;
            margin: 0;
            font-size: 13px;
            line-height: 18px;
            font-family: sans-serif;
        }

        .left p,
        .left {
            text-align: left !important;
        }

        p,
        td,
        h1,
        h2,
        h3,
        th {
            font-family: sans-serif;
        }

        main p {
            font-family: sans-serif;
        }

        .left div {
            margin-top: 10px;
        }

        .center p {
            text-align: center;
        }

        .red-heading {
            color: #aa1d25;
            font-weight: 700;

        }

        .intro {
            margin: auto;
        }

        .intro td {
            width: 25%;
            max-width: 400px;
            padding: 0 10px;
            vertical-align: top;
        }

        .intro p {
            font-size: 17px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .red-heading {
            font-size: 15px !important;
            /* font-weight: 600 !important; */
            /* font-family: sans-serif; */
        }

        main img {
            max-width: 100px;
    max-height: 50px;
    margin: auto;
    display: flex;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
        }

        .notes {
            background-color: #e6e6e7;
            padding: 10px;
            border-left: 7px solid #c80f2e;
            margin-top: 20px;
        }

        .color-heading {
            padding: 10px;
            background-color: #fbe6e9;
            border-bottom: 2px solid #c80f2e;
            margin-top: 20px;
        }

        .red-para {
            color: #c80f2e;
            font-weight: 400;
        }

        .info-2 {
            background-color: #f6f6f7;
        }

        .info-2 td {
            border: none;
            padding: 10px;
        }

        .info-2 p {
            text-align: center;
        }

        .item {
            width: 100%;
        }

        .item td {
            text-align: center;
        }

        .item th {
            padding: 10px 10px;
        }

        .item td {
            padding: 5px;
        }

        .item-category {
            background-color: #f0f0f0;
            width: 100%;
        }

        .item-category td {
            text-align: left;
        }

        .item-name {
            font-weight: 700;
            text-align: left;
        }

        .item-desc {
            text-align: left;
        }

        .color-heading-light {
            background-color: #f0f0f0;
            padding: 10px;
            margin-top: 10px;
        }

        .cost {
            width: 100%;
            margin-top: 15px;
        }

        .cost td {
            padding: 5px;
        }

        .cost td {
            font-weight: 700;
        }

        .agent {
            width: 100%;
            margin-top: 10px;
        }

        .agent th,
        .agent td {
            text-align: left;
            padding: 5px;
        }

        mt-3 {
            margin-top: 30px;
        }

        .p-2 {
            padding: 10px;
        }

        .list li {
            padding: 5px 0;
            line-height: 23px;
            font-family: sans-serif;
        }

        .list {
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .pagenum:before {
            content: counter(page);
            text-align: right
        }

        .pagenum {
            text-align: right;
        }

        .button-pay {
            width: auto;
            padding: 9px 10px;
            background-color: #f84661 ;
            color: #fff;
            text-decoration: unset;
            text-transform: capitalize;
        }

        .notes-table {
            padding: 20px !important;
        }

        .notes-table td,
        .notes-table th {
            padding: 0;
        }
        .packaging-section p{
            margin: 0;
    padding: 10px;
    margin-bottom: 30px;
    text-align: left !important;
        }
        .intro td,.intro td p,.word-wrap td ,.word-wrap td p{
           word-wrap: break-word;
           overflow-wrap: anywhere;
        }
        .image-center td img{
           
            justify-content: center;
            margin: auto;
        }
        .intro td{
            max-width: 100%;
        }
        .intro td{
            text-align: center;
        }
        .intro td img{
            display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
        }
        .center-table td{
            min-width:150px !important;
        }
        .mt-5{
            margin: 20px 0;
        }
        .text-center{
            text-align: center
        }
        .right{
            text-align: right;
        }
    </style>
</head>

<body>
    <?php 
    $carbonDate = Carbon::parse($order->created_at );
    $delivery_dates = Carbon::parse($order->delivery_date );


// Separate date and time
$Order_date = $carbonDate->isoFormat('DD MMMM YYYY'); // "2024-03-15"
$delivery_dates_format=$delivery_dates->isoFormat('DD MMMM YYYY');
$delivery_date=$delivery_dates->toDateString();
$delivery_time=$delivery_dates->format('H:i');



?>

    <!-- Define header and footer blocks before your content -->
    <header>
        <div class="pagenum"></div>

        <table class="header-table">
            <tr>
                <td class="left">


                    <img src="<?php echo e($sort_invoice_image['logo']); ?>"
                        alt="">
                    <div>
                        <p><?php echo e($Order_date); ?></p>
                        <p>Volanti Inflight Catering</p>
                    </div>
                </td>
                <td colspan="2">
                    <?php if(isset($order->purchase_order_no) && $order->purchase_order_no!=''): ?>
                    <h1>Purchase Order No.</h1>
                    <h1><?php echo e($order->purchase_order_no); ?></h1>
                    <?php else: ?>
                    <h1>Invoice No.</h1>
                    <h1><?php echo e($order->id); ?></h1>
                    <?php endif; ?>
                   <P>15000 N. Airport Dr. Scottsdale, Arizona 85260, United States</P>
                  
                    <hr>
                </td>
            </tr>

        </table>
    </header>

    <footer>
        <p>Volanti Jet Catering, 15000 N. Airport Dr. Scottsdale, Arizona 85260, United States</p>
        <p>Company Registration Number: <?php echo e(config('app.company_reference_no')); ?> | VAT number: <?php echo e(config('app.company_vat_no')); ?> | +480.657.2426 |  jetcatering@volantiscottsdale.com
        </p>
       
       
    </footer>
    <!-- Wrap the content of your PDF inside a main tag -->
    <main>

        <div class="color-heading">
            <p class="red-heading">Invoice Details</p>

        </div>

        <table class="info-2 mt-3 w-100 notes-table">
            <tr>

                <th class="left">Id</th>
                <th class="text-center">Purchase Date</th>
                <th class="right">Action</th>

            </tr>
            <tr>
                <td>
                    <p class="left"><?php echo e($order->id); ?></p>

                </td>
                <td>
                    <p class="text-center"><?php echo e($Order_date); ?></p>
                </td>
                <td class="right">
                    <a href="<?php echo e(route('order-invoice-view', ['orderid' => $order->id, 'customerid' => $order->customer_id])); ?>"
                        class="button-pay">pay Now</a>

                </td>
            </tr>
        </table>

        <table class="center intro image-center mt-5">
            <tr>
                <td>
                    <p class="red-heading">DELIVERY DATE</p>
                    <p><?php echo e($delivery_dates_format); ?></p>
                </td>
                <td>
                    <p class="red-heading">DELIVERY TIME</p>
                    <p><?php echo e($order->delivery_time); ?></p>
                </td>
               
                <td>
                    <p class="red-heading">LOCATION</p>
                    <p><?php echo e(isset($order->shipping_address->airport_name) ? $order->shipping_address->airport_name : ''); ?></p>

                </td>
                <td>
                    <p class="red-heading">AIRCRAFT</p>
                    <p><?php echo e($order->fbo_tail_number); ?></p>
                </td>
            </tr>
            <tr class="center-table">
               
                <td>
                    <p class="red-heading">READY TO SERVE</p>
                    <img src="<?php echo e($sort_invoice_image['serve']); ?>"
                        alt="">
                </td>
                <td>
                    <p class="red-heading">CABIN HOST</p>
                    <img src="<?php echo e($sort_invoice_image['cabin']); ?>" alt="">
                </td>
                <td>
                    <p class="red-heading">MICROWAVE/OVEN</p>
                    <img src="<?php echo e($sort_invoice_image['microwave']); ?>"
                        alt="">
                </td>
            </tr>
        </table>

        


        <div class="color-heading">
            <p class="red-heading">Packaging</p>
        </div>
        <div class="info-2 packaging-section">
        <p ><?php echo e($order->fbo_packaging); ?></p>
    </div>



    <div class="page-break"></div>





    
      
        <?php
        use ACME\paymentProfile\Models\OrderNotes;

        $commentsCount = OrderNotes::where('order_id', $order->id)->count();

    ?>

<?php if($commentsCount > 0): ?>

<div class="color-heading">
    <p class="red-heading">Notes</p>
</div>
   <table class="w-100" style="table-layout: fixed;"> 
     
        <?php $__currentLoopData = OrderNotes::orderBy('id', 'desc')->where('order_id', $order->id)->limit(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr style="">
                <?php if($comment->is_admin === 1): ?>
                <td class="p-2">Support</td>
                <td class="p-2" style="word-break: break-word; overflow-wrap: break-word;"><?php echo e($comment->notes); ?></td>
                <td class="p-2"><?php echo e(date('m-d-Y h:i:s A', strtotime($comment->created_at))); ?></td>
                <?php else: ?>
                <td>Customer</td>
                <td><?php echo e($comment->notes); ?></td>
                <td><?php echo e(date('m-d-Y h:i:s A', strtotime($comment->created_at))); ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php endif; ?>


       
        <div class="color-heading">
            <p class="red-heading">ORDER REQUEST</p>
        </div>
        <table class="item">
            <tr>
                <th class="left">ITEM</th>
                <th>NOTES</th>
                <th>QTY</th>
                <th>UNIT</th>
                <th>UNIT COST</th>
                <th>TOTAL COST</th>
                <th>CURRENCY</th>
            </tr>

            
            
                
                


                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $optionLabel = null;
                        $specialInstruction = null;
                        $notes = null;


                        // sandeep add new code 
                        if (isset($item->additional)) {
                        // $additional = json_decode($item->additional, true);
                      
                        if (isset($item->additional['attributes'])) {
                            $attributes = $item->additional['attributes'];

                            foreach ($attributes as $attribute) {
                                if (isset($attribute['option_label']) && $attribute['option_label'] != '') {
                                    $optionLabel = $attribute['option_label'];
                                }
                            }
                        }
                    }

            //             if (isset($item->additional['attributes'])) {
            //                 $attributes = $item->additional['attributes'];
            //   dd($attributes);
            //                 foreach ($attributes as $attribute) {
            //                     if (isset($attribute['option_label']) && $attribute['option_label'] != '') {
            //                         $optionLabel = $attribute['option_label'];
            //                     }
            //                 }
            //             }

                        if (isset($item->additional['special_instruction'])) {
                            $specialInstruction = $item->additional['special_instruction'];
                        }

                        $notes = DB::table('order_items')
                            ->where('id', $item->id)
                            ->where('order_id', $order->increment_id)
                            ->value('additional_notes');

                        $product_details = DB::table('product_flat')
                            ->select('description')
                            ->where('id', $item->product_id)
                            ->first();
                        //    dd($notes)

                        // sandeep add code
                        $itemName = $item->name;
                            if ($optionLabel) {
                            $itemName = $itemName . ' (' . $optionLabel . ')';
                            }
                    ?>
                    <tr> 
                        <td>
                            <p class="item-name"><?php echo e($itemName); ?></p>
                            <p class="item-desc"><?php echo e($product_details->description); ?></p>
                        </td>
                        <td><?php echo e($specialInstruction); ?></td>
                        <td><?php echo e($item->qty_ordered); ?></td>
                        <td>Piece</td>
                        <td><?php echo e(core()->formatBasePrice($item->price)); ?></td>
                        <td><?php echo e(core()->formatBasePrice($item->base_total - $item->base_discount_amount)); ?>

                        </td>
                        <td><?php echo e($order->order_currency_code); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </table>
        <div class="color-heading-light">
            <p class="">TOTAL COST</p>
        </div>
        <table class="cost">
            <tr>
                <td colspan="3">Catering Charge</td>
                <td><?php echo e(core()->formatBasePrice($order->sub_total)); ?></td>
                <td><?php echo e($order->order_currency_code); ?></td>
            </tr>

            
            <tr>
                <?php if(isset($order->tax_amount)): ?>
                <td colspan="3">Tax</td>
                <td><?php echo e(core()->formatBasePrice($order->tax_amount)); ?></td>
                <td><?php echo e($order->order_currency_code); ?></td>
                <?php endif; ?>
            </tr>
            
            <tr>
                <td colspan="3">Additional Handling Charge</td>
                <td>
                <?php if(isset($agent->Handling_charges) && $agent->Handling_charges!=null): ?>
            
                    <?php echo e(core()->formatBasePrice($agent->Handling_charges)); ?>

                    <?php else: ?>
                    <?php echo e(core()->formatBasePrice(0)); ?>

                <?php endif; ?>    
                
                </td>
                <td><?php echo e($order->order_currency_code); ?></td>
            </tr>
            <tr>
                <td colspan="3">Order Total</td>
                <td><?php echo e(core()->formatBasePrice($order->grand_total + (isset($agent->Handling_charges) ? $agent->Handling_charges : 0))); ?></td>
                <td><?php echo e($order->order_currency_code); ?></td>
            </tr>

        </table>
        <div class="color-heading mt-3">
            <p class="red-heading">HANDLING AGENT AND PERMISSION</p>
        </div>

        <table class="agent">
            <tr>
                <th>AIRPORT</th>
                <th>HANDLING AGENT</th>
                <th>TELEPHONE</th>
                <th>PPR - PERMIT</th>
            </tr>
            <tr>
                <td> <?php echo e($order->shipping_address->airport_name); ?></td>
                <td><?php echo e(isset($agent->Name) ? $agent->Name : ''); ?></td>
                <td><?php echo e(isset($agent->Mobile) ? $agent->Mobile : ''); ?></td>
                <td><?php echo e(isset($agent->PPR_Permit) ? $agent->PPR_Permit : ''); ?></td>
            </tr>

        </table>

        <?php if(isset($order->billing_address->address1)): ?>
        <div class="color-heading mt-3">
            <p class="red-heading">Billing Address</p>
        </div>

        <table class="agent word-wrap">
            <tr>
            
              
                <th>ADDRESS</th>              
                <th>EMAIL</th>
                <th>MOBILE</th>
            </tr>
            <tr>
               
              
                <td>
                    <?php if(isset($order->billing_address) && $order->billing_address->address1 != null): ?>
                        <?php echo e(isset($order->billing_address->address1) ? $order->billing_address->address1 . ',' : ''); ?>

                        <?php echo e(isset($order->billing_address->city) ? $order->billing_address->city . ',' : ''); ?>

                        <?php echo e(isset($order->billing_address->postcode) ? $order->billing_address->postcode . ',' : ''); ?>

                        <?php echo e(isset($order->billing_address->state) ? $order->billing_address->state : ''); ?>

                <?php endif; ?>
                </td>
                <td><?php echo e(isset($order->fbo_email_address) ? $order->fbo_email_address : ''); ?></td>
                <td><?php echo e(isset($order->fbo_phone_number) ? $order->fbo_phone_number : ''); ?></td>
                
            </tr>
            

        </table>
        <?php endif; ?>
    
    </main>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/pdf/invoices.blade.php ENDPATH**/ ?>