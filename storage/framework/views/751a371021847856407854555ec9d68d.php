<?php $__env->startSection('page_title'); ?>
    Airport Fbo Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="window.location = '<?php echo e(route('admin.cateringpackage.index')); ?>'"></i>
                    Airport Fbo Details
                </h1>
            </div>

            <div class="page-action">

                <div class="page-action">
                    <?php if(bouncer()->hasPermission('admin.cateringpackage.airport-fbo-details.create')): ?>
                        <a href="<?php echo e(route('admin.cateringpackage.fbo-details.create', ['id' => $id])); ?>"
                            class="btn btn-lg btn-primary">
                            
                            Add Fbo
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="page-content">  

            <datagrid-plus
                src="<?php echo e(route('admin.cateringpackage.airport-fbo-details.index', ['id' => $id])); ?>"></datagrid-plus>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\CateringPackage\src\Providers/../Resources/views/admin/airport-fbo-details/index.blade.php ENDPATH**/ ?>