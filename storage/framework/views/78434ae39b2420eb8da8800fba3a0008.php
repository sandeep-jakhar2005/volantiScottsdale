<?php $__env->startSection('page_title'); ?>
    
    Order #<?php echo e($order->increment_id); ?> | Volanti Jet Catering
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seo'); ?>
<meta name="title" content="Order #<?php echo e($order->increment_id); ?> | Volanti Jet Catering" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .account-content .account-layout .account-head {
            margin-bottom: 0px;
        }

        .sale-summary .dash-icon {
            margin-right: 30px;
            float: right;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-detail-wrapper'); ?>

    <div class="account-head text-center">
        <div class="head w-100">
            <div class="back-icon text-left">
            <a href="/customer/account/orders">
                <img src="/themes/volantijetcatering/assets/images/left-arrow.png" style="height:25px; width:25px;" alt="Left Arrow">
            </a>

    </div>
            <div class="order-detail first-section mt-3">
                <h2 class="m-0">Thank you for your order !</h2>
                <br>
                <span class="order-no">Order No.(#<?php echo e($order->id); ?>)</span>
            </div>
            <div class="order-detail second-section text-left ">
                <div class="discription p-3 my-4">
                    <p class="m-0 ">You will receive an email confirmation shortly at volantijetcatering@gmail.com</p>
                    
                    
                </div>

                

                <div class="container my-5">
                    <div class="row">
                        <div class="col">
                            <div class="timeline-steps aos-init aos-animate <?php echo e($order->status_id == 10 || $order->status_id == 11 ? 'rejected' : ''); ?>" data-aos="fade-up">
                                <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <div class="timeline-step">
                                        <div class="timeline-content 
                                            <?php echo e(($order->status_id == 10 || $order->status_id == 11) ? ($status->status == 'cancel' || $status->status == 'rejected' ? '' : 'completed') : ($status->updated_at !== null ? 'completed' : '')); ?>">
                                            <div class="inner-circle"></div>
                                            <p style="font-size: 13px; font-weight: 600;" class="h6 mt-3 mb-1 capitalize-first">
                                                <?php if($status->status == 'cancel'): ?>
                                                    Cancelled
                                                <?php else: ?>
                                                    <?php echo e($status->status); ?>

                                                <?php endif; ?>
                                            </p>
                                            <span style="font-weight: 600; font-size: 11px;">
                                                
                                                <?php echo e($status->updated_at ? date('m-d-Y h:i:s A', strtotime($status->updated_at)) : ''); ?>

                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                                                
                                                
                        </div>
                    </div>
                </div>
                <h3 class="m-0 text-center">order Details</h3>
            </div>
            <div class='row w-70 order-location-section my-4 mx-0    '>
                <div class="airport-address col-lg-5 col-md-6 col-12 p-3">
                    <div class="row pl-2">
                        <div class="col-12 p-0 title text-left shipping_address">
                            <span id="shipping_address_heading" style="font-weight: bold">Shipping Address: </span>
                        </div>
                        
                        <div class="col-lg-9 col-md-9 col-12 mt-2 mt-lg-3 mt-md-3">
                            <?php if(!is_null($order->shipping_address)): ?>
                                <div class="order-address">
                                    <div class="row pl-2">
                                        <img src="/themes/volantijetcatering/assets/images/location-black.png"
                                            class="location-icon mt-2" alt="">

                                        <div class="col-lg-10 col-md-10 col-11  text-left">
                                            <span class="airport-name"><?php echo e($order->shipping_address->airport_name); ?></span>
                                            <br>
                                            <span class="airport-address"><?php echo e($order->shipping_address->address1); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            
                <div class="Fbo-details col-lg-5 col-md-5 p-3">
                    <div class="row w-100">
                        <div class="col-12 p-0 title text-left">
                            <span id="account_information" style="font-weight: bold"><?php echo e(__('shop::app.fbo-detail.client-info')); ?> : </span>
                        </div>
                        <div class="col-lg-9 col-md-9 col-12 user_information">
                            <?php if(!is_null($order->billing_address)): ?>
                                <div class="order-address">
                                    <div class="row">
                                        <!-- sandeep remove image -->
                                    <!-- <img src="/themes/volantijetcatering/assets/images/profile-user.png" style="height:20px"> -->
                                        <div class="col-lg-10 col-md-10 col-12 mt-2 mt-lg-3 mt-md-3 text-left account_information">
                                        
                                           
                                            <span class="fbo-customer-name  "><?php echo e($order->fbo_full_name); ?></span>
                                            <br>
                                            <span
                                                class="fbo-customer-mobile fbo-data"><?php echo e($order->fbo_phone_number); ?></span>
                                            <br>
                                            <span
                                                class="fbo-customer-email fbo-data"><?php echo e($order->fbo_email_address); ?></span>
                                            <br>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12 p-0 title text-left mt-3">
                            <span id="aircraft_information" style="font-weight: bold"><?php echo e(__('shop::app.fbo-detail.aircraft-info')); ?> : </span>
                        </div>
                        <div class="col-lg-9 col-md-9 col-12 mt-2 mt-lg-3 mt-md-3 aircraft_info">
                            <?php if(!is_null($order->billing_address)): ?>
                                <div class="order-address"> 
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-12  text-left aircraft_information">
                                            <span class="fbo-tail-no fbo-data"> <?php echo e($order->fbo_tail_number); ?></span>
                                            <br>
                                            <?php if(isset($order->fbo_packaging) && $order->fbo_packaging != ''): ?>
                                                <span class="fbo-tail-no fbo-data"> <?php echo e($order->fbo_packaging); ?></span>
                                            <?php endif; ?>
                                            <br>
                                            
                                            <?php if(isset($order->fbo_service_packaging) && $order->fbo_service_packaging != ''): ?>
                                                <span class="fbo-tail-no fbo-data"> <?php echo e($order->fbo_service_packaging); ?></span>
                                            <?php endif; ?>
                                            <br>
                        
                                            <?php if(isset($order->delivery_date) && $order->delivery_date != ''): ?>
                                                <?php
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
                                                ?>
                                                <span class="fbo-tail-no fbo-data"> <?php echo e($formattedDate); ?></span>
                                            <?php endif; ?>
                                            <br>
                                            <?php if(isset($order->delivery_time) && $order->delivery_time != ''): ?>
                                                <span class="fbo-tail-no fbo-data"> <?php echo e($order->delivery_time); ?></span>
                                            <?php endif; ?>
                                            <br>
                                            <span class="fbo-tail-no fbo-data"><b>Airport FBO:</b>

                                             <p class="m-0">
                                                <?php echo e(DB::table('airport_fbo_details')->where('id', $order->airport_fbo_id)->value('name')); ?>

                                             </p>
                                             <p class="m-0"> 
                                                <?php echo e(DB::table('airport_fbo_details')->where('id', $order->airport_fbo_id)->value('address')); ?>

                                             </p>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <?php if($order->billing_address->address1 !== ''): ?>
                    <div class="airport-address col-lg-5  col-md-6 col-12 p-3">
                        <div class="row">
                            <div class="col-12 p-0 pl-lg-1 pl-md-2 title text-left">
                                <span id="billing_address" style="font-weight: bold">Billing Address: </span>
                            </div>
                            <div class="col-lg-9 col-md-9 col-12 mt-lg-3 mt-md-3 mt-2">
                                <?php if(isset($order->billing_address->address1) && $order->billing_address->address1 != ''): ?>
                                    <div class="order-address">
                                        <div class="row pl-lg-3 pl-md-3">
                                            <img src="/themes/volantijetcatering/assets/images/location-black.png"
                                                class="location-icon mt-2" alt="">

                                            <div class="col-lg-10 col-md-10 col-11  text-left">
                                                <span class="airport-name">
                                                    <?php echo e(isset($order->billing_address->address1) ? $order->billing_address->address1 . ',' : ''); ?>

                                                    <?php echo e(isset($order->billing_address->city) ? $order->billing_address->city . ',' : ''); ?>

                                                    <?php echo e(isset($order->billing_address->postcode) ? $order->billing_address->postcode . ',' : ''); ?>

                                                    <?php echo e(isset($order->billing_address->state) ? $order->billing_address->state : ''); ?>

                                                </span>
                                                <br>
                                                <span class="m-0">Phone:
                                                    <?php echo e(isset($order->billing_address->phone) ? $order->billing_address->phone : ''); ?>

                                                </span>
                                                <br>
                                                <span class="m-0">Vat:
                                                    <?php echo e(isset($order->billing_address->vat_id) ? $order->billing_address->vat_id : ''); ?>

                                                </span>


                                            </div>
                                        </div>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endif; ?>

            </div>

        </div>


        <?php if($order->canCancel()): ?>
            <span class="account-action">
                <form id="cancelOrderForm" action="<?php echo e(route('shop.customer.orders.cancel', $order->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                </form>

                <a href="javascript:void(0);" class="cancel-order theme-btn light unset float-right"
                    onclick="cancelOrder('<?php echo e(__('shop::app.customer.account.order.view.cancel-confirm-msg')); ?>')"
                    style="float: right">
                    <?php echo e(__('shop::app.customer.account.order.view.cancel-btn-title')); ?>

                </a>
            </span>
        <?php endif; ?>
    </div>

    <?php echo view_render_event('bagisto.shop.customers.account.orders.view.before', ['order' => $order]); ?>



    <div class="sale-container mt10">

        
        

        <div class="section-content">
            <div class="table-responsive" style="max-height: 500px">
                <div class="table order-detail-table">
                    <table class="customer_order_view_table">
                        <!-- sandeep add code  -->
                        <thead>
                                    <tr style="text-align:center">
                                        <!-- <th><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th> -->
                    <th class="order_view_heading"><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                    <th class="order_view_heading"><?php echo e(__('shop::app.customer.account.order.view.price')); ?></th>
                    <th class="order_view_heading"><?php echo e(__('shop::app.customer.account.order.view.qty')); ?></th>
                    <!-- <th><?php echo e(__('shop::app.customer.account.order.view.subtotal')); ?></th> -->
                    <!-- <th><?php echo e(__('shop::app.customer.account.order.view.tax-amount')); ?></th> -->
                    <th class="order_view_heading"><?php echo e(__('shop::app.customer.account.order.view.total')); ?></th>
                    <th class="order_view_heading">Order Notes</th>
                    </tr>
                    </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <tr style="text-align:center">
                                    
                                    <td class="order_view_data" style="border-right: 1px solid #cccccc !important;">
                                        <div class="row m-0 justify-content-center">
                                            <!-- <div class="col-lg-3 col-md-4 col-4 single_order_img" >
                                                 <img class="order-img"
                                                    src="/cache/medium/product/278/s09QJX1kqQwX8zLXByqS8gU836SU5oPgp47G7ov3.png"
                                                    alt=""> -->
                                                <!-- <p><?php echo e($item->additional_notes); ?> </p> -->
                                            <!-- </div>  -->
                                            <!-- <div class="col-lg-8 col-md-7 col-8"> -->
                                                
                                                <div class="customer_single_order_view">
                                                    <span class="order-name" style="font-weight: 500;"> *<?php echo e($item->name); ?></span>
                                                    <br><br>
                                                  
                                                    <?php
                                                    $optionLabel = null;
                                                    
                                                    if(isset($item->additional['attributes'])){
                                                    $attributes = $item->additional['attributes'];
                    
                                                      foreach ($attributes as $attribute) {
                                                      if(isset($attribute['option_label']) && $attribute['option_label']!=''){
                                                      $optionLabel = $attribute['option_label'];
                                                    }
                                                  }
                                                }
                                                  ?>

                                                    <?php if(isset($optionLabel)): ?>
                                                        <p><strong>Preference:
                                                            </strong><span><?php echo e($optionLabel); ?></span>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if(isset($item->additional) &&
                                                            isset($item->additional['special_instruction']) &&
                                                            $item->additional['special_instruction'] != ''): ?>
                                                        <p class="m-0"><strong>Special Instruction:</strong>
                                                        <div class="word_wrap" style="
                                                            overflow-y: auto;">
                                                            <span><?php echo e($item->additional['special_instruction']); ?></span>
                                                        </div>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            <!-- </div> -->

                                        </div>
                                    </td>

                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>"
                                        class="order-price-col order_view_data" style="border-right: 1px solid #cccccc !important;">
                                        <?php if($order->status != 'pending'): ?>
                                            <div class="order-price mb-2">
                                                
                                                <?php echo e(core()->formatPrice($item->price, $order->order_currency_code)); ?>

                                            </div>
                                            <?php else: ?>
                                              <span>N/A</span>
                                        <?php endif; ?>
                                    </td>


                                    <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>"
                                        class="order-price-col order_view_data" style="border-right: 1px solid #cccccc !important;">
                                        <div class="order-qty">
                                            <span>Quantity: </span> <?php echo e($item->qty_ordered); ?>

                                        </div>

                                    </td>


                                    <td class="total-col text-right order_view_data"
                                        data-value="<?php echo e(__('shop::app.customer.account.order.view.grand-total')); ?>" style="border-right: 1px solid #cccccc !important;">
                                        <?php if($order->status != 'pending'): ?>
                                            <?php echo e(core()->formatPrice($item->total, $order->order_currency_code)); ?>

                                            <div class="order-tax">
                                                <span class="extra-price">+</span>
                                                <span class="extra-price"><?php echo e($item->tax_amount); ?></span>
                                            </div>


                                            <?php if($item->discount_amount > 0): ?>
                                                <div class="discount">
                                                    <span class="extra-price">-</span>
                                                    <span
                                                        class="discount extra-price"><?php echo e(core()->formatPrice($item->discount_amount, $order->order_currency_code)); ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="total">
                                                <span>Item total:
                                                    <?php echo e(core()->formatPrice($item->tax_amount + $item->total, $order->order_currency_code)); ?></span>

                                            </div>
                                        <?php else: ?>
                                            <div class="order-tax">
                                                <span class="extra-price">N/A</span>
                                            </div>



                                            <!-- <div class="discount">
                                                <span>N/A</span>
                                            </div>


                                            <div class="total">
                                                <span>N/A</span>

                                            </div> -->
                                        <?php endif; ?>

                                    </td>
                                     <!-- sandeep  -->
                                    <td class="order_view_data" style="border-right: 1px solid #cccccc !important;">
                                        <div class="notes">
                                    <p><?php echo e($item->additional_notes); ?> </p>
                                    </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="totals price-total-table mt-3">
                <?php if(isset($admin_notes) && $admin_notes !== null): ?>
                    <div class="col-12 col-md-6 col-lg-6 order__view_admin_comments py-3">
                        <h3 class="text-start mt-2" style="text-align: left;">Notes</h3>
                        <div class="notes mb-4">
                            <div class="table m-0 d-flex">
                                <tbody>
                                    <tr>
                                        <td><strong class="" style="color: rgb(101 101 101);">Support:</strong></td>
                                        <td><span class="pl-2" style="color: #9d9d9d;"><?php echo e($admin_notes->notes); ?></span>
                                        </td>
                                        <td>
                                            
                                            <span class="float-right"
                                                style="color: #9d9d9d;">(<?php echo e(date('m-d-Y h:i:s A', strtotime($admin_notes->created_at))); ?>)</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12 col-md-6 col-lg-6">
                    <table class="sale-summary ml-auto">
                        <tr>
                            
                            <?php if($order->status != 'pending'): ?>
                                <td>Sub-Total:
                                    <?php echo e(core()->formatPrice($order->sub_total, $order->order_currency_code)); ?>

                                </td>
                            <?php else: ?>
                                <td>Sub-Total: N/A</td>
                            <?php endif; ?>
                        </tr>

                        

                        <?php if($order->discount_amount > 0): ?>
                            <tr>
                                
                                <td class="extra-price">Offer Discount:
                                    <?php echo e(core()->formatPrice($order->discount_amount, $order->order_currency_code)); ?>

                                </td>

                            </tr>
                        <?php endif; ?>

                        <?php if($order->tax_amount > 0): ?>
                            <tr>
                                <?php if($order->status != 'pending'): ?>
                                    <td class="extra-price">Tax:
                                        <?php echo e(core()->formatPrice($order->tax_amount, $order->order_currency_code)); ?></td>
                                <?php else: ?>
                                    <td>Tax: N/A</td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                        
                        <tr class="">
                            
                            <?php if($order->status != 'pending'): ?>
                                <td class="">Agent Handling:
                                    <?php if(isset($agent) && $agent->Handling_charges != null): ?>
                                   <?php echo e(core()->formatBasePrice($agent->Handling_charges)); ?>

                                <?php else: ?>
                                    <?php echo e(core()->formatBasePrice(0)); ?>

                                <?php endif; ?>
                                </td>

                            <?php else: ?>
                                <td>Agent Handling: N/A</td>
                            <?php endif; ?>


                            
                        </tr>

                        <tr class="fw6">
                            
                            <?php if($order->status != 'pending'): ?>
                                <td class="total-price">Order Total:
                                    <?php if(isset($agent->Handling_charges)): ?>
                                    <?php echo e(core()->formatPrice($order->grand_total + $agent->Handling_charges, $order->order_currency_code)); ?>

                                    <?php else: ?>
                                    <?php echo e(core()->formatPrice($order->grand_total, $order->order_currency_code)); ?>

                                    <?php endif; ?>
                                    
                            <?php else: ?>
                                <td>Order Total: N/A</td>
                            <?php endif; ?>


                            
                        </tr>

                    </table>
                </div>


            </div>
        </div>
    </div>
    

    

    
    

    
    
    


    
    

    

    
    

    

    
    
    
    
    
    
    

    

    
    </tabs>

    <div class="sale-section">
        <div class="section-content" style="border-bottom: 0">
            <div class="order-box-container">

                

                

                
            </div>
        </div>
    </div>
    </div>

    <?php echo view_render_event('bagisto.shop.customers.account.orders.view.after', ['order' => $order]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function cancelOrder(message) {
            if (!confirm(message)) {
                return;
            }

            $('#cancelOrderForm').submit();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('shop::customers.account.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/customers/account/orders/view.blade.php ENDPATH**/ ?>