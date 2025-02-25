<?php echo e($address->company_name ?? ''); ?><br>
<b><?php echo e($address->name); ?></b><br>
<?php echo e($address->address1); ?><br>
<?php echo e($address->postcode); ?> <?php echo e($address->city); ?><br>
<?php echo e($address->state); ?><br>
<?php echo e(core()->country_name($address->country)); ?><br>
<?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($address->phone); ?>

<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/sales/address.blade.php ENDPATH**/ ?>