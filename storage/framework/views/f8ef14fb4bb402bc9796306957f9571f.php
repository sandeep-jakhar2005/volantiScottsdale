<div id="product-list">
<?php $__currentLoopData = $categoryproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="container product-card-new product-custom-class product-item" data-name="<?php echo e(strtolower($categoryproduct['name'])); ?>">
        
        <div class="row my-4 ml-0">
            

            <div class="col-10 p-md-0 p-lg-0">
                <div class="product-name no-padding custom-product-name ">
                    <span class="fs16" id = "ProductName"><?php echo e($categoryproduct['name']); ?></span>
                    <br />
                    <p><?php echo e($categoryproduct['description']); ?></p>
                    <?php if($categoryproduct['isSaleable']): ?>
                    <?php if($categoryproduct['type'] == 'simple'): ?>
                    <a id="category_instructions" data-toggle="collapse" class="m-0"
                        href="#category_instructions_Div<?php echo e($categoryproduct['id']); ?>" role="button" aria-expanded="false"
                        aria-controls="category_instructions_Div">Special Instructions
                        (optional)
                        +</a>
                    <div class="collapse multi-collapse mt-2 mb-2" id="category_instructions_Div<?php echo e($categoryproduct['id']); ?>">
                        <div id="category_instructions_Div" class="">
                            <textarea id="textarea-customize" name="special_instruction"></textarea>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="AddToCartButton col-2 mt-0 mt-lg-2 mt-md-2 p-md-0 p-lg-0 pt-2">
                <input type="hidden" name="product_id" value="<?php echo e($categoryproduct['id']); ?>" id="ProductId">
                <?php if($categoryproduct['isSaleable']): ?>
                    <?php if($categoryproduct['type'] == 'simple'): ?>
                    <quantity-changer
                    :product-id="<?php echo e($categoryproduct['id']); ?>"
                    :quantity-id="'quantity_' + <?php echo e($categoryproduct['id']); ?>"
                    quantity-text="<?php echo e(__('shop::app.products.quantity')); ?>">
                  </quantity-changer>
                  
                     <div id="quantityError_<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" class="text-danger quantityError_message" style="color: red"></div>

                        <div class="AddButton text-center">
                            <button type="submit" class="add_button" id="AddToCartButton" data="<?php echo e($categoryproduct['type']); ?>" attr="<?php echo e($cate_id); ?>">Add</button>
                            <span id="successMessage_<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" class="text-success successMessage"></span>
                        </div>
                    <?php else: ?>
                        <div class="configurable_product">
                            <div class="AddButton text-center">
                                <input type="hidden" id="slug" value="<?php echo e($categoryproduct['slug']); ?>">
                                <button type="button" data-toggle="modal" data-target="#exampleModal<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" class="OptionsAddButton"
                                    id="AddToCartButtonpopup">Add</button>
                                <span class="customisable">Customisable</span>
                                <br>
                                
                                <span id="successMessage_<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" class="text-success successMessage" style="display: none;"></span>
                                
                            </div>
                            <!-- Modal -->
                            <div class="modal custom_modal fade" id="exampleModal<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" data="<?php echo e($categoryproduct['id']); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered " role="document">
                                    <div class="modal-content pb-3">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add To Cart</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="fs16 ProductName" id = "ProductName"><?php echo e($categoryproduct['name']); ?></span>
                                            <br />
                                            <p class="description"><?php echo e($categoryproduct['description']); ?></p>
                                            <quantity-changer
                                            :product-id="<?php echo e($categoryproduct['id']); ?>"
                                            :quantity-id="'quantity_' + <?php echo e($categoryproduct['id']); ?>"
                                            quantity-text="<?php echo e(__('shop::app.products.quantity')); ?>">
                                          </quantity-changer>
                                          
                                            
                                            <div id="quantityError_<?php echo e($categoryproduct['id']); ?>_<?php echo e($cate_id); ?>" class="text-danger quantityError_message" style="color: red"></div>
                                            <div class="variant__option"></div>
                                        </div>

                                        
                                            <button type="submit" class="add_button OptionsAddButton mx-auto" data="<?php echo e($categoryproduct['type']); ?>" id="Add_Button_Popop" attr="<?php echo e($cate_id); ?>">Add</button>
                                            

                                    </div>
                                </div> 
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="AddButton text-center p-md-0 p-lg-0">
                        <button type="submit" class="stockoutButton" disabled>Out of stock</button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/products/category-products/category-product-list.blade.php ENDPATH**/ ?>