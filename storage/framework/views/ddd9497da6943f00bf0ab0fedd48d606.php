<?php if($logo = core()->getCurrentChannel()->logo_url): ?>
    <img src="<?php echo e($logo); ?>" alt="<?php echo e(config('app.name')); ?>" style="height: 40px; width: 110px;"/>
<?php else: ?>
    <img src="<?php echo e(asset('themes/default/assets/images/logo.svg')); ?>" alt="<?php echo e(config('app.name')); ?>"/>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Shop\src/resources/views/emails/layouts/logo.blade.php ENDPATH**/ ?>