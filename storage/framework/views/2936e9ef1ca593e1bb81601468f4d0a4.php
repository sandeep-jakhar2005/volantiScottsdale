<?php $__env->startComponent('shop::emails.layouts.master'); ?>
    <div style="text-align: center;">
        <a href="<?php echo e(route('admin.session.create')); ?>">
            <?php if(core()->getConfigData('general.design.admin_logo.logo_image')): ?>
                <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image'))); ?>" alt="<?php echo e(config('app.name')); ?>" style="height: 40px; width: 110px;"/>
            <?php else: ?>
                <img src="<?php echo e(asset('vendor/webkul/ui/assets/images/logo.png')); ?>" alt="<?php echo e(config('app.name')); ?>"/>
            <?php endif; ?>
        </a>
    </div>

    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                <?php echo e(__('shop::app.mail.order.heading')); ?>

            </span> <br>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo e(__('shop::app.mail.order.dear-admin', ['admin_name' => core()->getAdminEmailDetails()['name']])); ?>,
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo __('shop::app.mail.order.greeting-admin', [
                    'order_id' => '<a href="' . route('admin.sales.orders.view', $order->id) . '" style="color: #0041FF; font-weight: bold;">#' . $order->increment_id . '</a>',
                    'created_at' => $order->created_at
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
                        <?php echo e($order->shipping_address->postcode . " " . $order->shipping_address->city); ?>

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

                    <div style="font-size: 16px;color: #242424;">
                        <?php echo e(__('shop::app.mail.order.shipping')); ?>

                    </div>

                    <div style="font-weight: bold;font-size: 16px;color: #242424;">
                        <?php echo e($order->shipping_title); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if($order->billing_address): ?>
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
                        <?php echo e($order->billing_address->postcode . " " . $order->billing_address->city); ?>

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

                    <div style="font-size: 16px; color: #242424;">
                        <?php echo e(__('shop::app.mail.order.payment')); ?>

                    </div>

                    <div style="font-weight: bold; font-size: 16px; color: #242424; margin-bottom: 20px;">
                        <?php echo e(core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title')); ?>

                    </div>

                    <?php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); ?>

                    <?php if(! empty($additionalDetails)): ?>
                        <div style="font-size: 16px; color: #242424;">
                            <div><?php echo e($additionalDetails['title']); ?></div>
                            <div><?php echo e($additionalDetails['value']); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="section-content">
            <div class="table mb-20">
                <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                    <thead>
                        <tr style="background-color: #f2f2f2">
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.SKU')); ?></th>
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.product-name')); ?></th>
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.price')); ?></th>
                            <th style="text-align: left;padding: 8px"><?php echo e(__('shop::app.customer.account.order.view.qty')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.SKU')); ?>" style="text-align: left;padding: 8px">
                                    <?php echo e($item->getTypeInstance()->getOrderedItem($item)->sku); ?>

                                </td>

                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.product-name')); ?>" style="text-align: left;padding: 8px">
                                    <?php echo e($item->name); ?>


                                    <?php if(isset($item->additional['attributes'])): ?>
                                        <div class="item-options">

                                            <?php $__currentLoopData = $item->additional['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <b><?php echo e($attribute['attribute_name']); ?> : </b><?php echo e($attribute['option_label']); ?></br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.price')); ?>" style="text-align: left;padding: 8px">
                                    <?php echo e(core()->formatPrice($item->price, $order->order_currency_code)); ?>

                                </td>

                                <td data-value="<?php echo e(__('shop::app.customer.account.order.view.qty')); ?>" style="text-align: left;padding: 8px">
                                    <?php echo e($item->qty_ordered); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="font-size: 16px;color: #242424;line-height: 30px;float: right;width: 40%;margin-top: 20px;">
            <div>
                <span><?php echo e(__('shop::app.mail.order.subtotal')); ?></span>
                <span style="float: right;">
                    <?php echo e(core()->formatBasePrice($order->base_sub_total)); ?>

                </span>
            </div>

            <div>
                <span><?php echo e(__('shop::app.mail.order.shipping-handling')); ?></span>
                <span style="float: right;">
                    <?php echo e(core()->formatBasePrice($order->base_shipping_amount)); ?>

                </span>
            </div>

            <?php $__currentLoopData = Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($order, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxRate => $baseTaxAmount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <span id="taxrate-<?php echo e(core()->taxRateAsIdentifier($taxRate)); ?>"><?php echo e(__('shop::app.mail.order.tax')); ?> <?php echo e($taxRate); ?> %</span>
                <span id="basetaxamount-<?php echo e(core()->taxRateAsIdentifier($taxRate)); ?>" style="float: right;">
                    <?php echo e(core()->formatBasePrice($baseTaxAmount)); ?>

                </span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($order->discount_amount > 0): ?>
                <div>
                    <span><?php echo e(__('shop::app.mail.order.discount')); ?></span>
                    <span style="float: right;">
                        <?php echo e(core()->formatBasePrice($order->base_discount_amount)); ?>

                    </span>
                </div>
            <?php endif; ?>

            <div style="font-weight: bold">
                <span><?php echo e(__('shop::app.mail.order.grand-total')); ?></span>
                <span style="float: right;">
                    <?php echo e(core()->formatBasePrice($order->base_grand_total)); ?>

                </span>
            </div>
        </div>

        <div style="width: 100%;margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo __('shop::app.mail.order.help', [
                        'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.admin.address') . '">' . config('mail.admin.address') . '</a>'
                        ]); ?>

            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo e(__('shop::app.mail.order.thanks')); ?>

            </p>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Shop\src/resources/views/emails/sales/new-admin-order.blade.php ENDPATH**/ ?>