<?php $__env->startSection('content-wrapper'); ?>
    <div class="inner-section">

        <div class="content-wrapper">

            <?php echo $__env->make('admin::layouts.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/layouts/content.blade.php ENDPATH**/ ?>