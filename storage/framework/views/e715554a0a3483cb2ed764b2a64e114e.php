

<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('Customers Inquery')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1 class="customer_inquery_title"><?php echo e(__('Customers Inquery')); ?></h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>
            </div>
        </div>

        <div class="page-content customer-inquiry-content">
            <order-datagrid-plus src="<?php echo e(route('admin.sales.customersInquery.displayInquerys')); ?>"></order-datagrid-plus>
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header"><?php echo e(__('admin::app.export.download')); ?></h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <?php echo $__env->make('admin::export.export', ['gridName' => app('Webkul\Admin\DataGrids\CustomerInqueryDataGrid')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\paymentProfile\src\Providers/../Resources/views/admin/sales/customersInquery/index.blade.php ENDPATH**/ ?>