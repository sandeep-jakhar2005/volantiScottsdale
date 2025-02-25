<?php $__env->startComponent('shop::emails.layouts.master'); ?>
    <div>
        <div style="text-align: center;">
            <a href="<?php echo e(route('shop.home.index')); ?>">
                <?php echo $__env->make('shop::emails.layouts.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </a>
        </div>

        <div style="padding: 30px;">
            <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
                <p style="font-weight: bold;font-size: 20px;color: #242424;line-height: 24px;">
                    <?php echo e(__('shop::app.mail.customer.registration.dear', ['customer_name' => $data['first_name']. ' ' .$data['last_name']])); ?>,
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    <?php echo __('shop::app.mail.customer.registration.greeting'); ?>

                </p>
            </div>

            <div style="font-size: 16px;color: #5E5E5E;line-height: 30px;margin-bottom: 20px !important;">
                <?php echo e(__('shop::app.mail.customer.registration.summary')); ?>

            </div>

            <p style="text-align: center;padding: 20px 0;">
                <a href="<?php echo e(route('shop.customer.session.index')); ?>" style="padding: 10px 20px;background: #0041FF;color: #ffffff;text-transform: uppercase;text-decoration: none; font-size: 16px">
                    <?php echo e(__('shop::app.header.sign-in')); ?>

                </a>
            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo __('shop::app.mail.order.help', [
                        'support_email' => '<a style="color:#0041FF" href="mailto:' . core()->getSenderEmailDetails()['email'] . '">' . core()->getSenderEmailDetails()['email']. '</a>'
                        ]); ?>

            </p>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                <?php echo e(__('shop::app.mail.customer.registration.thanks')); ?>

            </p>
        </div>
    </div>
<?php echo $__env->renderComponent(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Shop\src/resources/views/emails/customer/registration.blade.php ENDPATH**/ ?>