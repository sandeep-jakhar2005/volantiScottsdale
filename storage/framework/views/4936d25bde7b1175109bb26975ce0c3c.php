<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.sales.shipments.view-title', ['shipment_id' => $shipment->id])); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content-wrapper'); ?>
    <?php $order = $shipment->order; ?>

    <div class="content full-page">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="window.location = '<?php echo e(route('admin.paymentprofile.shipments.index')); ?>'"></i>

                    <?php echo e(__('admin::app.sales.shipments.view-title', ['shipment_id' => $shipment->id])); ?>

                </h1>
            </div>

            <div class="page-action">
            </div>
        </div>

        <div class="page-content">
            <div class="sale-container">

                <accordian title="<?php echo e(__('admin::app.sales.orders.order-and-account')); ?>" :active="true">
                    <div slot="body">
                        <div class="sale">
                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.order-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.shipments.order-id')); ?>

                                        </span>

                                        <span class="value">
                                            <a
                                                href="<?php echo e(route('admin.sales.orders.view', $order->id)); ?>">#<?php echo e($order->increment_id); ?></a>
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.order-date')); ?>

                                        </span>
                                        
                                        <span class="value">
                                            <?php echo e(core()->formatDate($order->created_at, 'm-d-Y h:i:s')); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.order-status')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->status); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.channel')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->channel_name); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.account-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.customer-name')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($shipment->order->customer_full_name); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.email')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($shipment->order->customer_email); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </accordian>

                <?php if($order->billing_address || $order->shipping_address): ?>
                    <accordian title="<?php echo e(__('admin::app.sales.orders.address')); ?>" :active="true">
                        <div slot="body">
                            <div class="sale">
                                <?php if($order->billing_address): ?>
                                    <div class="sale-section">
                                        <div class="secton-title">
                                            <span><?php echo e(__('admin::app.sales.orders.billing-address')); ?></span>
                                        </div>

                                        <div class="section-content">

                                            <?php echo $__env->make('admin::sales.address', [
                                                'address' => $order->billing_address,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->shipping_address): ?>
                                    <div class="sale-section">
                                        <div class="secton-title">
                                            <span><?php echo e(__('admin::app.sales.orders.shipping-address')); ?></span>
                                        </div>

                                        <div class="section-content">

                                            <?php echo $__env->make('admin::sales.address', [
                                                'address' => $order->shipping_address,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </accordian>
                <?php endif; ?>
                <accordian title="<?php echo e(__('admin::app.sales.orders.payment-and-shipping')); ?>" :active="true">
                    <div slot="body">
                        <div class="sale">
                            <div class="sale-section">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.payment-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <?php if(isset($order->payment)): ?>
                                        <div class="row">
                                            <span class="title">
                                                <?php echo e(__('admin::app.sales.orders.payment-method')); ?>

                                            </span>

                                            <span class="value">
                                                <?php echo e(core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title')); ?>

                                            </span>
                                        </div>
                                    <?php endif; ?>


                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.currency')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->order_currency_code); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section admin_shipment">
                                <div class="secton-title">
                                    <span><?php echo e(__('admin::app.sales.orders.shipping-info')); ?></span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.shipping-method')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($order->shipping_title); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.orders.shipping-price')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e(core()->formatBasePrice($order->base_shipping_amount)); ?>

                                        </span>
                                    </div>

                                    <?php if($shipment->inventory_source || $shipment->inventory_source_name): ?>
                                        <div class="row">
                                            <span class="title">
                                                <?php echo e(__('admin::app.sales.shipments.inventory-source')); ?>

                                            </span>

                                            <span class="value">
                                                <?php echo e($shipment->inventory_source ? $shipment->inventory_source->name : $shipment->inventory_source_name); ?>

                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.shipments.carrier-title')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($shipment->carrier_title); ?>

                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            <?php echo e(__('admin::app.sales.shipments.tracking-number')); ?>

                                        </span>

                                        <span class="value">
                                            <?php echo e($shipment->track_number); ?>

                                        </span>
                                    </div>
                                    


                                    <div class="row">

                                        <!-- Hidden dropdown, initially not displayed -->
                                        <form id="deliveryPartnerForm"
                                            action="<?php echo e(route('admin.shipment.deliveryPartner.update', $shipment->id)); ?>"
                                            method="POST" class="deliveryPartnerForm">
                                            <?php echo csrf_field(); ?>
                                            <span class="title">
                                                Delivery Partner
                                            </span>
                                            <span class="value" id="deliveryPartnerName">
                                                <?php echo e($deliver_partners->firstWhere('id', $shipment->delivery_partner)->name ?? 'Not Assigned'); ?>

                                            </span>
                                            <select class="value-dropdown" name="delivery_partner"
                                                id="deliveryPartnerDropdown" style="display: none;">
                                                <?php $__currentLoopData = $deliver_partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($partner->id); ?>"
                                                        <?php echo e($partner->id == $shipment->delivery_partner ? 'selected' : ''); ?>>
                                                        <?php echo e($partner->name); ?> (<?php echo e($partner->email); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if(auth('admin')->user()->role_id == 1 && $order->status != 'delivered'): ?>
                                                <!-- Edit button -->
                                                <button type="button" id="editDeliveryPartner">edit</button>
                                                <button type="button" id="closeDeliveryPartnerDropdown"
                                                    style="display: none;">close</button>

                                                <!-- Save button for the form -->
                                                <button type="submit" id="saveDeliveryPartner"
                                                    style="display: none;">save</button>
                                            <?php endif; ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </accordian>

                <accordian title="Order Summary" :active="true">
                    <div slot="body" class="delivery__images__container">
                        <section class="order__summary mt-5">
                            


                            <?php if($order->total_item_count < 1): ?>
                                <div class="empty__item text-center my-4">
                                    <p class="my-3">Order item is empty, Please add products to show here!</p>
                                </div>
                            <?php else: ?>
                                <div class="table">
                                    <div class="table-responsive">
                                        <table>

                                            <thead>

                                                <?php if(auth('admin')->user()->role_id == 1): ?>

                                                    <tr class="order_view_table_head">
                                                        <th>Item</th>
                                                        <th>Product</th>
                                                        <th>Special instructions</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Sub Total</th>
                                                        <?php if($order->status === 'pending' || $order->status === 'accepted'): ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr class="order_view_table_head">
                                                        <th>Item</th>
                                                        <th>Product</th>
                                                        <th>Special instructions</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                <?php endif; ?>

                                            </thead>

                                            <tbody class="table__body">
                                                <?php
                                                    $orders = DB::table('order_items')
                                                        ->where('order_id', $order->id)
                                                        ->where('parent_id', null)
                                                        ->get();

                                                ?>
                                                
                                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $optionLabel = null;
                                                        $specialInstruction = null;
                                                        $notes = null;
                                                        if (isset($item->additional['attributes'])) {
                                                            $attributes = $item->additional['attributes'];

                                                            foreach ($attributes as $attribute) {
                                                                if (
                                                                    isset($attribute['option_label']) &&
                                                                    $attribute['option_label'] != ''
                                                                ) {
                                                                    $optionLabel = $attribute['option_label'];
                                                                }
                                                            }
                                                        }

                                                        if (isset($item->additional['special_instruction'])) {
                                                            $specialInstruction =
                                                                $item->additional['special_instruction'];
                                                        }
                                                        // dd($notes);
                                                        $notes = DB::table('order_items')
                                                            ->where('id', $item->id)
                                                            ->where('order_id', $order->increment_id)
                                                            ->value('additional_notes');

                                                    ?>

                                                    <tr class="order_view_table_body">
                                                        <td
                                                            style="
                                                            max-width: 130px;">
                                                            

                                                            <?php if(isset($notes)): ?>
                                                                <p class="m-0 display__notes"><?php echo e($notes); ?></p>
                                                            <?php endif; ?>

                                                            

                                                            

                                                            
                                                            

                                                            

                                                            <?php
                                                                $inventoryQty1 = 0;
                                                                $inventoryQty2 = 0;

                                                                if ($item->type === 'configurable') {
                                                                    $optionId = DB::table('order_items')
                                                                        ->select('product_id')
                                                                        ->where('parent_id', $item->id)
                                                                        ->first();

                                                                    // Check if $optionId is not null before proceeding
                                                                    if ($optionId) {
                                                                        $optionInventory = DB::table(
                                                                            'product_inventory_indices',
                                                                        )
                                                                            ->where('product_id', $optionId->product_id)
                                                                            ->select('qty')
                                                                            ->first();

                                                                        // Use the quantity of the option if it exists
                                                                        if ($optionInventory) {
                                                                            $inventoryQty1 = $optionInventory->qty;
                                                                        }
                                                                    }
                                                                }

                                                                // If the product is not of type 'configurable' or no option quantity is found

                                                                if ($item->product_id) {
                                                                    $productInventory = DB::table(
                                                                        'product_inventory_indices',
                                                                    )
                                                                        ->where('product_id', $item->product_id)
                                                                        ->select('qty')
                                                                        ->first();

                                                                    // Use the quantity of the product if it exists
                                                                    if ($productInventory) {
                                                                        $inventoryQty2 = $productInventory->qty;
                                                                    }
                                                                }

                                                                $modalId = 'product-edit' . $item->id;
                                                            ?>

                                                            

                                                        </td>
                                                        <td>
                                                            <?php echo e($item->name); ?>

                                                            <?php if($optionLabel): ?>
                                                                (<?php echo e($optionLabel); ?>)
                                                            <?php endif; ?>
                                                        </td>

                                                        <?php if(isset($specialInstruction)): ?>
                                                            <td class="special-intruction">
                                                                <p><?php echo e($specialInstruction); ?></p>
                                                            </td>
                                                        <?php else: ?>
                                                            <td class="special-intruction text-center">
                                                                <p></p>
                                                            </td>
                                                        <?php endif; ?>

                                                        <?php if(auth('admin')->user()->role_id == 1): ?>
                                                            <td><?php echo e(core()->formatBasePrice($item->base_price)); ?></td>
                                                        <?php endif; ?>

                                                        <td>
                                                            <span class="qty-row">
                                                                <?php echo e($item->qty_ordered); ?>

                                                            </span>

                                                        </td>
                                                        <?php if(auth('admin')->user()->role_id == 1): ?>
                                                            <td><?php echo e(core()->formatBasePrice($item->base_total + $item->base_tax_amount - $item->base_discount_amount)); ?>

                                                            </td>
                                                        <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </accordian>


                <?php if(auth('admin')->user()->role_id != 1): ?>
                    <accordian title="Delivery Confirmation Snapshot" :active="true">
                        <div slot="body" class="delivery__images__container delivery_buttton">

                            <?php echo view_render_event('sales.order.page_action.before', ['order' => $order]); ?>


                            <?php if($order->status !== 'delivered'): ?>
                                <div class="shipped_button my-3 d-flex justify-content-center w-100">
                                    <!-- sandeep add code image accept -->
                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="images[]" class="d-none" multiple
                                        style="display: none">
                                    <button id="uploadTrigger" class="btn btn-primary">Upload Image</button>
                                    <input type="hidden" id="order_id" value="<?php echo e($order->id); ?>"></input>
                                    <input type="hidden" id="shipment_id" value="<?php echo e($shipment->id); ?>"></input>


                                </div>
                                <span id="image_size_vaild" style="color: red"></span>

                                <div class="image-preview-container my-3 d-flex justify-content-center flex-wrap w-100">
                                    <!-- Images will be appended here by the JavaScript -->
                                </div>
                                <?php endif; ?>
                            <?php if(isset($delivery_images) && count($delivery_images) > 0): ?>
                                <div class="image-preview">
                                    <?php $__currentLoopData = $delivery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <div class="m-2">
                                            <img class="image-preview-item"
                                                src="<?php echo e(asset($delivery_image->attachment)); ?>" alt="Delivery Image" />
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($order->status !== 'delivered'): ?>
                            <div class="shipped_button delivery_button_center" style="text-align:right">
                                <button id="order_view_shipped" class="order__shipped modal_open_button" disabled
                                    style=" cursor: not-allowed;">Submit</button>

                                    <div class="modal_parent">
                                        <div class="modal">
                                            <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="delivery_confirm_image">
                                                    <img src="<?php echo e(asset('/themes/volantijetcatering/assets/images/accept.png')); ?>"
                                                        alt="">
                                                </div>
                                                <p>Are you sure </p>
                                                <p>You want to proceed ?</p>
                                                <button id="order_delivery_confirm" class="modal_submit_button"
                                                    style="">Confirm <span class="btn-ring"></span></button>
                                            </div>
                                        </div>


                                    </div>
                            </div>

                            <?php endif; ?>
                                
                            <?php echo view_render_event('sales.order.page_action.after', ['order' => $order]); ?>

                        </div>
                    </accordian>
                <?php endif; ?>


                <?php if(auth('admin')->user()->role_id == 1 && isset($delivery_images) && count($delivery_images) > 0): ?>
                    <accordian title="Delivery Confirmation Snapshot" :active="true">
                        <div slot="body" class="delivery__images__container">

                            <div class="image-preview">
                                <?php $__currentLoopData = $delivery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="m-2">
                                        <img class="image-preview-item" src="<?php echo e(asset($delivery_image->attachment)); ?>"
                                            alt="Delivery Image" />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                    </accordian>
                <?php endif; ?>



                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Edit button click event
            $('#editDeliveryPartner').click(function() {
                $('#deliveryPartnerName').hide();
                $('#deliveryPartnerDropdown').show();
                $('#closeDeliveryPartnerDropdown').show();
                $('#saveDeliveryPartner').show(); // Show the save button
                $(this).hide();
            });

            // Close button click event
            $('#closeDeliveryPartnerDropdown').click(function() {
                $('#deliveryPartnerName').show();
                $('#deliveryPartnerDropdown').hide();
                $(this).hide();
                $('#saveDeliveryPartner').hide(); // Hide the save button
                $('#editDeliveryPartner').show();
            });



            $(".modal_open_button").click(function() {
                var modal = $(this).parent().find(".modal");
                modal.show();

                modal.find(".close").click(function() {
                    modal.hide();
                });
            });

            $(window).click(function(event) {
                if ($(event.target).hasClass('modal')) {
                    $('.modal').hide();
                }
            });
        });

        $(document).ready(function() {
            // Trigger file input click when upload button is clicked
            $('#uploadTrigger').on('click', function() {
                $('#imageUpload').click();
            });


            
            $('#imageUpload').on('change', function() {
                console.log(this.files, 'Files selected');
                if (this.files.length > 0) {
                    // Clear previous images
                    $('.image-preview-container').empty();

                    // Loop through all selected files
                    for (let i = 0; i < this.files.length; i++) {
                        let file = this.files[i];
                        let fileType = file.type;
                        let fileSize = file.size / 1024 / 1024; // Size in MB


                     // Check if file is an image
                        console.log('filetype',fileType);
                        if (!fileType.match('image.*')) {
                            $('#image_size_vaild').text('Please select a valid image file.');
                            return;
                        }


                        // Check if file size is greater than 5MB
                        if (fileSize > 5) {
                            $('#image_size_vaild').text('File size should not exceed 5MB.');
                            return;
                        }


                        // If file is valid, read and preview the image
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            // Create an image element for preview
                            let img = $('<img />', {
                                src: e.target.result,
                                class: 'img-preview',
                                style: 'max-width: 100px; max-height: 100px; margin: 5px;' // Example styling
                            });

                            // Append the image to the container for previewing
                            $('.image-preview-container').append(img).show();
                        }
                        reader.readAsDataURL(file);
                    }

                    // Enable the button if all files are valid
                    $('#order_view_shipped').prop('disabled', false).css('cursor', 'pointer');
                    $('#image_size_vaild').hide();
                } else {
                    // Disable the button if no files are selected
                    $('#order_view_shipped').prop('disabled', true);
                    $('.image-preview-container').hide();
                }
            });

            jQuery('body').on('click', '#order_delivery_confirm', function() {
                console.log('dsgsdgsdfgsdfgdfsg');
                var button = $(this);
                button.prop('disabled', true);
                $('#uploadTrigger').hide();
                button.html('<span class="btn-ring"></span>');
                $(".btn-ring").show().css('display', 'flex');

                // Set a timeout to hide the loading animation and re-enable the button
                setTimeout(function() {
                    $(".btn-ring").hide();
                    button.prop('disabled', false).text('Delivery');
                    $('#uploadTrigger').show();
                }, 20000);

                var formData = new FormData();
                var imageFiles = $('#imageUpload')[0].files; // Get all files
                for (var i = 0; i < imageFiles.length; i++) {
                    formData.append('images[]', imageFiles[i]); // Append each file to formData
                }
                formData.append('shipment_id', $('#shipment_id').val());
                formData.append('order_id', $('#order_id').val());
                formData.append('_token', $('meta[name="csrf-token"]').attr(
                    'content')); // Get CSRF token from meta tag
console.log('formdata',['form data',formData]);

                // AJAX request
                $.ajax({
                    url: "<?php echo e(route('admin.order.status')); ?>", // Replace with the correct URL
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result.success) {
                            // alert(result.success); // Show success message
                            location.reload(); // Reload the page or redirect as needed
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert(
                            'An error occurred while processing your request. Please try again.'
                        ); // Provide user feedback
                    },
                    complete: function() {
                        $(".btn-ring").hide();
                        button.prop('disabled', false).text('Delivery');
                        $('#uploadTrigger').show();
                    }
                });
            });


        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\paymentProfile\src\Providers/../Resources/views/admin/sales/shipments/view.blade.php ENDPATH**/ ?>