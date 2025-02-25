<?php $__env->startSection('content-wrapper'); ?>
    <div class="account-content row no-margin velocity-divide-page">
        <div class="sidebar left mobile-user-profile">
            <?php echo $__env->make('shop::customers.account.partials.sidemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="account-layout right mt10 ">
            <?php if(request()->route()->getName() !== 'shop.customer.profile.index'): ?>
                <?php if(Breadcrumbs::exists()): ?>
                    <?php echo e(Breadcrumbs::render()); ?>

                <?php endif; ?>
            <?php endif; ?>

            <?php echo $__env->yieldContent('page-detail-wrapper'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/ui/assets/js/ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/customers/account/index.blade.php ENDPATH**/ ?>