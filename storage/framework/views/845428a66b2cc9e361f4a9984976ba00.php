<?php echo view_render_event('bagisto.shop.products.price.before', ['product' => $product]); ?>


<div class="product-price">
    <?php echo $product->getTypeInstance()->getPriceHtml(); ?>

</div>

<?php echo view_render_event('bagisto.shop.products.price.after', ['product' => $product]); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/products/price.blade.php ENDPATH**/ ?>