<?php
    // $cards = collect();
    if(auth()->guard('customer')->check()) {
        $customer_id = auth()->guard('customer')->user()->id;
        $cards = app('Webkul\MpAuthorizeNet\Repositories\MpAuthorizeNetRepository')->findWhere(['customers_id' => $customer_id]);
    }
?>

<?php if(isset($cards) && !$cards->isEmpty()): ?>
<div class="mpauthorizenet-add-card" style="padding-left:50px; padding-right:10px; margin-top:-15px; margin-bottom:8px; display:none" id="saved-card-heading">
    <span class="control-info mb-5 mt-5"> Choose a saved card or 
        <a id="open-mpauthorizenet-modal" style="color: #0041FF !important; cursor: pointer;">
            <?php echo e(__('mpauthorizenet::app.add-card')); ?>

        </a>
        to proceed.
    </span>
</div>
<?php else: ?>
<div class="mpauthorizenet-add-card" style="padding-left:50px; padding-right:10px; margin-top:-15px; margin-bottom:8px; display:none" id="unsave-card-heading">
    <span class="control-info mb-5 mt-5">Please
        <a id="open-mpauthorizenet-modal" style="color: #0041FF !important; cursor: pointer;">
            <?php echo e(__('mpauthorizenet::app.add-card')); ?></a> to proceed.
    </span>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\MpAuthorizeNet\src\Providers/../Resources/views/shop/volantijetcatering/components/add-card.blade.php ENDPATH**/ ?>