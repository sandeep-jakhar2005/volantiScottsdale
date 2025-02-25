<?php $__env->startSection('page_title'); ?>
    PaymentProfile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1>PaymentProfile</h1>
            </div>

            <div class="page-action">
            </div>
        </div>

        <div class="page-content">
            <datagrid-plus src="<?php echo e(route('admin.paymentprofile.index')); ?>"></datagrid-plus>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\paymentProfile\src\Providers/../Resources/views/admin/index.blade.php ENDPATH**/ ?>