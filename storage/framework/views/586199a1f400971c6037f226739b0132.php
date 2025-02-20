<?php $__env->startComponent('shop::emails.layouts.master'); ?>
    <div style="text-align: center;">
        <a href="<?php echo e(route('shop.home.index')); ?>">
            
            <img style="width: 100%;
            max-width: 300px;
            display: block;
            margin: 0 auto;"
                src="https://images.squarespace-cdn.com/content/v1/6171dbc44e102724f1ce58cf/eda39336-24c7-499b-9336-c9cee87db776/VolantiStickers-11.jpg?format=1500w"
                alt="Volantijet Catering" />
        </a>
    </div>
    
    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                <?php echo e(__('shop::app.mail.order.heading')); ?>

            </span> <br>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo e(__('shop::app.mail.order.dear', ['customer_name' => $order->customer_full_name == '' ? $order->fbo_full_name : $order->customer_full_name])); ?>,
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo __('shop::app.mail.order.greeting', [
                    'order_id' =>
                        '<a href="' .
                        route('shop.customer.orders.view', $order->id) .
                        '" style="color: #0041FF; font-weight: bold;">#' .
                        $order->increment_id .
                        '</a>',
                    'created_at' => core()->formatDate($order->created_at, 'Y-m-d H:i:s'),
                ]); ?>

            </p>
        </div>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            <?php echo e(__('shop::app.mail.order.summary')); ?>

        </div>

        <div style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 40px;">
            <?php if($order->shipping_address): ?>
                <div style="line-height: 25px;">
                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        <?php echo e(__('shop::app.mail.order.shipping-address')); ?>

                    </div>

                    <div>
                        <?php echo e($order->shipping_address->company_name ?? ''); ?>

                    </div>

                    <div>
                        <?php echo e($order->shipping_address->name); ?>

                    </div>

                    <div>
                        <?php echo e($order->shipping_address->address1); ?>

                    </div>

                    <div>
                        <?php echo e($order->shipping_address->postcode . ' ' . $order->shipping_address->city); ?>

                    </div>

                    <div>
                        <?php echo e($order->shipping_address->state); ?>

                    </div>

                    <div>
                        <?php echo e(core()->country_name($order->shipping_address->country)); ?>

                    </div>

                    <div>---</div>

                    <div style="margin-bottom: 40px;">
                        <?php echo e(__('shop::app.mail.order.contact')); ?> : <?php echo e($order->shipping_address->phone); ?>

                    </div>

                    
                </div>
            <?php endif; ?>

            <!-- sandeep comment billing address code -->

            <!-- <?php if($order->billing_address): ?>
                <div style="line-height: 25px;">
                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        <?php echo e(__('shop::app.mail.order.billing-address')); ?>

                    </div>

                    <div>
                        <?php echo e($order->billing_address->company_name ?? ''); ?>

                    </div>

                    <div>
                        <?php echo e($order->billing_address->name); ?>

                    </div>

                    <div>
                        <?php echo e($order->billing_address->address1); ?>

                    </div>

                    <div>
                        <?php echo e($order->billing_address->postcode . ' ' . $order->billing_address->city); ?>

                    </div>

                    <div>
                        <?php echo e($order->billing_address->state); ?>

                    </div>

                    <div>
                        <?php echo e(core()->country_name($order->billing_address->country)); ?>

                    </div>

                    <div>---</div>

                    <div style="margin-bottom: 40px;">
                        <?php echo e(__('shop::app.mail.order.contact')); ?> : <?php echo e($order->billing_address->phone); ?>

                    </div>

                    

                    

                    
                </div>
            <?php endif; ?> -->
        </div>

        <div class="section-content">
            <div class="table mb-20">
                <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                    <thead>
                        <tr style="background-color: #f2f2f2">
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>

                            </th>
                            <th style="text-align: left;padding: 8px">
                                <?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.qty')); ?>

                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>"
                                    style="text-align: left;padding: 8px">
                                    <?php echo e($item->getTypeInstance()->getOrderedItem($item)->sku); ?></td>

                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>"
                                    style="text-align: left;padding: 8px">
                                    <?php echo e($item->name); ?>


                                    <?php if(isset($item->additional['attributes'])): ?>
                                        <div class="item-options">

                                            <?php $__currentLoopData = $item->additional['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <b><?php echo e($attribute['attribute_name']); ?> :
                                                </b><?php echo e($attribute['option_label']); ?></br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    <?php endif; ?>
                                   
                                    <?php if(isset($item->additional['special_instruction']) &&
                                    $item->additional['special_instruction'] != ''): ?>
                                    <div class="word_wrap" style="
                                        overflow-y: auto;">
                                          <b class="p-0 m-0">Special Instruction:  </b>
                                        <span><?php echo e($item->additional['special_instruction']); ?></span>
                                    </div>
                                  <?php endif; ?>

                                </td>



                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.qty')); ?>"
                                    style="text-align: left;padding: 8px"><?php echo e($item->qty_ordered); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>



        
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Shop\src/resources/views/emails/sales/new-order.blade.php ENDPATH**/ ?>