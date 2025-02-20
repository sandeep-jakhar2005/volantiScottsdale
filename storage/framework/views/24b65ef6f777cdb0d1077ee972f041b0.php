<?php echo $__env->make('paymentprofile::admin.links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    use Carbon\Carbon;
?>
<?php $__env->startPush('css'); ?>
    <style>
        /* Reset some default styles to ensure consistency */
        body,
        table,
        td,
        p {
            margin: 0;
            padding: 0;
            font-family: arial;
            color: #444444;
        }

        /* Set the background color for the entire email */
        body {
            background-color: #fff;
        }

        /* Add some spacing around the content */
        table.wrapper {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            padding: 0;
            background-color: #ffffff;
        }

        /* Style the header section */
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        /* Style the receipt details section */
        .receipt-details {
            padding: 20px;
        }

        /* Style the table */
        table.receipt-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style the table headers */
        table.receipt-table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }

        /* Style the table rows */
        table.receipt-table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        /* Style the total amount */
        .total-amount {
            text-align: right;
            font-weight: bold;
        }

        /* Add some spacing for better readability */
        p {
            margin-bottom: 10px;
        }

        .table-width {
            max-width: 690px;
            margin: auto;
            display: flex;
        }

        /* @media only screen and (max-width: 520px) {
                                                    table tr {
                                                        display: flex !important;
                                                        flex-wrap: wrap;
                                                        gap: 10px;
                                                    }
                                                } */

        @media only screen and (max-width: 768px) {
            table.wrapper {
                max-width: 100% !important;
            }

            table.receipt-table th,
            table.receipt-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            table.wrapper img {
                width: 100%;
                max-width: 100%;
                height: auto;
            }
        }
    </style>
<?php $__env->stopPush(); ?>


<table class="wrapper">
    <tr
        style="
          text-align: center;
          padding: 30px 0 0 0;
          display: block;
          width: 90%;
        ">
        <td colspan="2" style="text-align: center !important; width: 100%; display: block">
            <div style="max-width: 400px; margin: 0 auto">
                <img src="https://images.squarespace-cdn.com/content/v1/6171dbc44e102724f1ce58cf/eda39336-24c7-499b-9336-c9cee87db776/VolantiStickers-11.jpg?format=1500w"
                    style="width: 70%" />
            </div>
        </td>
    </tr>
    <tr
        style="
          background: #f6f6f6;
          margin-top: 20px;
          border-top: 1px dashed black;
          padding: 20px;
          display: flex;
          justify-content: space-between;
        ">
        <td style="width: 50%; text-align: left">
            <h1
                style="
              padding-bottom: 15px;
              color: #000000;
              font-size: 24px;
              font-weight: bold;
              margin-top: 0;
            ">
                Thank you for your order!
            </h1>
            <p style="padding-bottom: 0px">
                Order No: <strong><?php echo e($order->increment_id); ?></strong>
            </p>
            <a href="<?php echo e(route('order-invoice-view', ['orderid' => $order->id, 'customerid' => $order->customer_id])); ?>"
                style="
              background: #444444;
              text-decoration: none;
              border-radius: 5px;
              float: left;
              border: none;
              color: #fff;
              font-weight: 600;
              padding: 9px 15px;
            ">Place
                order</a>
        </td>
        <td style="width: 50%; text-align: right">
            <p>
                Need Help? <br />
                Call us <a href="tel:1-866-864-8488">(480.657.2426)</a> or
                <a href="mailto:jetcatering@volantiscottsdale.com" style="color: #007bff; font-weight: 600">Email us
                </a>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="width: 100%">
            <div
                style="
              border-top: 1px dotted black;
              border-bottom: 1px dotted black;
              padding: 0;
              text-align: center;
            ">
                <h3 style="padding: 15px 0px;font-weight: bold;margin: 0px;font-size: 20px;">
                    Order Details
                </h3>
            </div>
        </td>
    </tr>
    <tr
        style="
          background: #f6f6f6;
          padding: 20px;
          display: block;
          vertical-align: text-top;
        ">
        <td>
            <table>
                <tr>
                    <td style="font-weight: 600;" colspan="3">Order No: <?php echo e($order->increment_id); ?></td>
                </tr>
                <tr>
                    
                    <td colspan="3">Order Date & Time : <?php echo e(date('m-d-Y h:i:s A', strtotime($order->created_at))); ?></td>
                </tr>
                <tr style="padding-top: 30px; display: flex; gap: 20px">
                    <td>
                        <div class="order-details">
                            
                            
                            <div class="mb-0"
                                style="
                            overflow: auto;
                        ">
                                <h6 class="" style="font-size:13px; margin-top:15px"><b><?php echo e(__('shop::app.fbo-detail.client-info')); ?></b></h6>
                                <p class="">
                                    <?php echo e($order->fbo_full_name); ?>

                                    <span style="float: left; width: 100%">
                                        <?php echo e($order->fbo_email_address); ?>

                                    </span>
                                    <span style="float: left; width: 100%">
                                        <?php echo e($order->fbo_phone_number); ?>

                                    </span>
                                </p>
                            </div>
                            <div class="mt-3">
                                <h6 class="" style="font-size:13px"><b><?php echo e(__('shop::app.fbo-detail.aircraft-info')); ?></b></h6>
                                <p>
                                    <?php echo e($order->fbo_tail_number); ?>

                                    <span style="float: left; width: 100%">
                                        <?php echo e($order->fbo_packaging); ?>

                                    </span>
                                    <span style="float: left; width: 100%">
                                        <?php echo e($order->fbo_service_packaging); ?>

                                    </span>
                                </p>
                            </div>

                        </div>
                    </td>
                    <td style="padding-left: 20px">
                        <div class="order-details"
                            style="
                        overflow: auto;
                    ">
                            <p class="mb-2">
                                <b>Address</b>
                            </p>
                            
                            <p style="margin-bottom: 0px">
                                <span style="float: left; width: 100%">
                                    <?php echo e($order->shipping_address->airport_name); ?>

                                </span>
                                <span style="float: left; width: 100%">
                                    <?php echo e($order->shipping_address->address1); ?>

                                </span>
                            </p>
                        </div>
                        <?php if(isset($airport_fbo)): ?>
                            <div class="mt-3" style="line-break: anywhere">
                                <p class="mb-2 text-dark"><b>Airport FBO</b></p>
                                <input type="hidden" id="airport_fbo_airport_id"
                                    value="<?php echo e($airport_fbo->airport_id); ?>" attr="<?php echo e($airport_fbo->customer_id); ?>">
                                <p class="m-0"><?php echo e($airport_fbo->name); ?></p>
                                <p class="m-0"><?php echo e($airport_fbo->address); ?></p>
                            </div>
                        <?php endif; ?>
                    </td>
                    <?php if($order->status === 'paid'): ?>
                        <td style="padding-left: 20px">
                            <div class="order-details">
                                <p><b>Payment : AuthorizeNet</b></p>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table style="width: 100%">
                <tr>
                    <td>
                        <div
                            style="
                    background: #f6f6f6;
                    width: 100%;
                    float: left;
                    padding: 20px 0 20px 0;
                    display: block;
                    vertical-align: text-top;
                    border-top: 1px dotted black;
                    border-bottom: 1px dotted black;
                    margin-top: 20px;">
                            <div class="table-responsive" style="max-height: 500px;overflow-x: auto;">
                                <table style="width: -webkit-fill-available;">
                                    <tbody>
                                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
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

                                                $notes = DB::table('order_items')
                                                    ->where('id', $item->id)
                                                    ->where('order_id', $order->increment_id)
                                                    ->value('additional_notes');
                                            ?>
                                            <tr class="order_view_table_body" style="height: 110px;">
                                                <td
                                                    style="
                                                max-width: 130px;">
                                                    
                                                    <?php if(isset($notes)): ?>
                                                        <p class="m-0"
                                                            style="max-height: 100px;overflow-y: auto;font-size: 11px;">
                                                            <?php echo e($notes); ?></p>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo e($item->name); ?>

                                                    <?php if($optionLabel): ?>
                                                        (<?php echo e($optionLabel); ?>)
                                                    <?php endif; ?>
                                                </td>

                                                <?php if($order->status === 'pending'): ?>
                                                    <td>NA</td>
                                                <?php else: ?>
                                                    <td><?php echo e(core()->formatBasePrice($item->price)); ?>

                                                        <p style="margin: 0;" class="qty-row">
                                                            Qty:
                                                            <?php echo e($item->qty_ordered); ?>

                                                        </p>
                                                    </td>
                                                <?php endif; ?>

                                                
                                                <?php if($order->status === 'pending'): ?>
                                                    <td>NA</td>
                                                <?php else: ?>
                                                
                                                    <td><?php echo e(core()->formatBasePrice($item->base_total - $item->base_discount_amount)); ?>

                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <table style="margin-top: 15px;margin-bottom: 15px;width:100%;" class="table-width">
        <tbody class="w-100">
            <tr style="vertical-align:text-top;display:flex;vertical-align:text-top;justify-content: space-around; line-break:anywhere">
                <td style="width: 44%;">
                    <div>
                        <?php
                            use ACME\paymentProfile\Models\OrderNotes;

                            $commentsCount = OrderNotes::where('order_id', $order->id)->count();

                        ?>
                        <div class="<?php if($commentsCount > 0): ?> d-block <?php else: ?> d-none <?php endif; ?>">
                            <b class="text-break">ORDER NOTES: </b>
                            <ul class="comment_list m-0"
                                style="height:100px;overflow:auto;padding: 0;list-style: none;margin: 0;">
                                <?php $__currentLoopData = OrderNotes::orderBy('id', 'desc')->where('order_id', $order->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="d-flex"
                                        style="
                                    margin: 0;
                                ">
                                        <?php if($comment->is_admin === 1): ?>
                                            <p class="w-100"
                                                style="color: rgb(157, 157, 157);font-size: 13px;margin:0;">Support:
                                                <span><?php echo e($comment->notes); ?></span>
                                                
                                                 <span
                                                    class="float-right">(<?php echo e(date('m-d-Y h:i:s A', strtotime($comment->created_at))); ?>)</span>
                                            </p>
                                        <?php else: ?>
                                            <p class="w-100" style="color: rgb(157, 157, 157);font-size: 13px;">
                                                Customer:
                                                <span><?php echo e($comment->notes); ?></span>
                                                <span class="float-right"><?php echo e(date('m-d-Y h:i:s A', strtotime($comment->created_at))); ?></span>
                                            </p>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </td>
                <td style="width: 56%;">
                    <p style="margin-bottom: 10px; text-align: right">
                        SubTotal :
                        
                            
                        <strong><?php echo e(core()->formatBasePrice($order->sub_total)); ?></strong>
                        
                    </p>
                    

                    <p style="margin-bottom: 10px; text-align: right">
                        Tax :
                        
                        <?php if(isset($order->tax_amount)): ?>
                            <strong><?php echo e(core()->formatBasePrice($order->tax_amount)); ?></strong>
                        <?php endif; ?>

                        
                    </p>
                    <p style="margin-bottom: 10px; text-align: right">
                        Agent Handler :

                        <?php if(isset($agent)): ?>
                            <strong><?php echo e(core()->formatBasePrice($agent->Handling_charges)); ?></strong>
                        <?php else: ?>
                            <strong><?php echo e(core()->formatBasePrice(0)); ?></strong>
                        <?php endif; ?>

                        
                    </p>

                    <p style="margin-bottom: 10px; text-align: right">
                        Order Total :
                        
                        <strong>

                            <?php if(isset($agent)): ?>
                                <?php echo e(core()->formatBasePrice($order->grand_total + $agent->Handling_charges)); ?>

                            <?php else: ?>
                                <?php echo e(core()->formatBasePrice($order->grand_total)); ?>

                            <?php endif; ?>


                        </strong>
                        
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</table>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\paymentProfile\src\Providers/../Resources/views/shop/volantijetcatering/invoices/mail/create.blade.php ENDPATH**/ ?>