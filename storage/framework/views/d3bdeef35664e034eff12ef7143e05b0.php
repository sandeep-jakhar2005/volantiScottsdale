<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.users.roles.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.users.roles.title')); ?></h1>
            </div>

            <div class="page-action">
                <?php if(bouncer()->hasPermission('settings.users.roles.create')): ?> 
                    <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.users.roles.add-role-title')); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="page-content">
            <datagrid-plus src="<?php echo e(route('admin.roles.index')); ?>"></datagrid-plus>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/users/roles/index.blade.php ENDPATH**/ ?>