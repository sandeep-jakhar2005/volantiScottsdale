<?php $__env->startSection('page_title'); ?>
    Package CateringPackage
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.cateringpackages.title')); ?></h1>
            </div>

            <div class="page-action">

                <div class="page-action">
                <?php if(bouncer()->hasPermission('admin.cateringpackage.create')): ?>
                    <a href="<?php echo e(route('admin.cateringpackage.create')); ?>" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.settings.cateringpackages.add-title')); ?>

                    </a>
                <?php endif; ?>
            </div>
          
            </div>
        </div>

        <div class="page-content">

    <datagrid-plus src="<?php echo e(route('admin.cateringpackage.index')); ?>"></datagrid-plus>
  
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\CateringPackage\src\Providers/../Resources/views/admin/index.blade.php ENDPATH**/ ?>