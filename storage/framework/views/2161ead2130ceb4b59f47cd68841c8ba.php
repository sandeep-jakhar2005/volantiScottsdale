<?php $__env->startComponent('shop::emails.layouts.master'); ?>

    <div>
        <div style="text-align: center;">
            <a href="<?php echo e(config('app.url')); ?>">
                <?php echo $__env->make('shop::emails.layouts.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </a>
        </div>

        <div  style="font-size:16px; color:#242424; font-weight:600; margin-top: 60px; margin-bottom: 15px">
            <?php echo e(__('shop::app.mail.customer.new.dear', ['customer_name' => $customer['name']])); ?>,

        </div>

        <div>
            <?php echo __('shop::app.mail.customer.new.summary'); ?>


        </div>

        <div>
            <b> <?php echo __('shop::app.mail.customer.new.username-email'); ?> </b> - <?php echo e($customer['email']); ?> <br>
            <b> <?php echo __('shop::app.mail.customer.new.password'); ?> </b> - <?php echo e($password); ?>

        </div>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            <?php echo e(__('shop::app.mail.customer.new.thanks')); ?>

        </p>
    </div>

<?php echo $__env->renderComponent(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Shop\src/resources/views/emails/customer/new-customer.blade.php ENDPATH**/ ?>