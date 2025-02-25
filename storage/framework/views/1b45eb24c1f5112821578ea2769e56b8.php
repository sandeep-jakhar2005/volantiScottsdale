<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.customers.customers.edit-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link" onclick="window.location = '<?php echo e(route('admin.customer.index')); ?>'"></i>
                    <?php echo e($customer->first_name . " " . $customer->last_name); ?>

                </h1>
            </div>

            <div class="page-action"></div>
        </div>

        <tabs>
            <?php echo view_render_event('bagisto.admin.customer.edit.before', ['customer' => $customer]); ?>


                <tab name="<?php echo e(__('admin::app.sales.orders.info')); ?>" :selected="true">
                    <div class="sale-container">
                        <?php echo $__env->make('admin::customers.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </tab>

                <tab name="<?php echo e(__('admin::app.customers.customers.addresses')); ?>" :selected="false">                
                    <div class="page-content">
                        <div class="page-content-button">
                            <a href="<?php echo e(route('admin.customer.addresses.create', ['id' => $customer->id])); ?>" class="btn btn-lg btn-primary">
                                <?php echo e(__('admin::app.customers.addresses.create-btn-title')); ?>

                            </a>
                        </div>

                        <div class="page-content-datagrid">
                            <datagrid-plus src="<?php echo e(route('admin.customer.addresses.index', $customer->id)); ?>"></datagrid-plus>
                        </div>
                    </div>
                </tab>

                <tab name="<?php echo e(__('admin::app.layouts.invoices')); ?>" :selected="false">
                    <div class="page-content">

                    <?php echo view_render_event('bagisto.admin.customer.invoices.list.before'); ?>


                        <datagrid-plus src="<?php echo e(route('admin.customer.invoices.data', $customer->id)); ?>"></datagrid-plus>

                    <?php echo view_render_event('bagisto.admin.customer.invoices.list.after'); ?>

                    </div>
                </tab>

                <tab name="<?php echo e(__('admin::app.customers.orders.title')); ?>" :selected="false">
                    <div class="page-content">

                    <?php echo view_render_event('bagisto.admin.customer.orders.list.before'); ?>


                        <datagrid-plus src="<?php echo e(route('admin.customer.orders.data', $customer->id)); ?>"></datagrid-plus>

                    <?php echo view_render_event('bagisto.admin.customer.orders.list.after'); ?>

                    </div>
                </tab>

            <?php echo view_render_event('bagisto.admin.customer.edit.after', ['customer' => $customer]); ?>

        </tabs>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/customers/edit.blade.php ENDPATH**/ ?>