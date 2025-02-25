

<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.cateringpackages.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">


        <form method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data"
            action="<?php echo e(route('admin.cateringpackage.store')); ?>">

            <div class="page-header">

                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="window.location = '<?php echo e(route('admin.cateringpackage.index')); ?>'"></i>
                        <?php echo e(__('admin::app.settings.cateringpackages.add-title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.settings.cateringpackages.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <?php echo view_render_event('bagisto.admin.settings.slider.create.before'); ?>


                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="sort_order"><?php echo e(__('admin::app.settings.cateringpackages.name')); ?></label>
                        <input type="text" class="control" id="sort_order" name="name" v-validate="'required'"
                            value="" />
                        <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>

                    </div>



                    <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                        <label for="content"><?php echo e(__('admin::app.settings.cateringpackages.address')); ?></label>

                        <textarea v-validate="'required'" id="" class="control" id="address" name="address" rows="5"></textarea>

                        <span class="control-error" v-if="errors.has('address')">{{ errors.first('address') }}</span>
                    </div>


                    <div class="control-group" :class="[errors.has('zipcode') ? 'has-error' : '']">
                        <label for="sort_order"><?php echo e(__('admin::app.settings.cateringpackages.zipcode')); ?></label>
                        <input v-validate="'required'" type="text" class="control" id="zipcode" name="zipcode"
                            value="" />
                        <span class="control-error" v-if="errors.has('zipcode')">{{ errors.first('zipcode') }}</span>
                    </div>



                    <div class="control-group multi-select" :class="[errors.has('country') ? 'has-error' : '']">
                        <label for="locale"><?php echo e(__('admin::app.settings.cateringpackages.country')); ?></label>

                        <select v-validate="'required'" class="control" id="country" name="country" value=""
                            v-validate="'required'">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>">
                                    <?php echo e($country->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="control-error" v-if="errors.has('country')">{{ errors.first('country') }}</span>
                    </div>


                    <div class="control-group multi-select" :class="[errors.has('state') ? 'has-error' : '']">
                        <label for="locale"><?php echo e(__('admin::app.settings.cateringpackages.state')); ?></label>

                        <select class="control" id="state" name="state"
                            data-vv-as="&quot;<?php echo e(__('admin::app.datagrid.state')); ?>&quot;" value=""
                            v-validate="'required'">
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->id); ?>">
                                   <?php echo e($state->default_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="control-error" v-if="errors.has('state')">{{ errors.first('state') }}</span>
                    </div>




                    <div class="control-group" :class="[errors.has('latitude') ? 'has-error' : '']">
                        <label for="sort_order"><?php echo e(__('admin::app.settings.cateringpackages.latitude')); ?></label>
                        <input type="number" class="control" id="sort_order" name="latitude" value=""
                            v-validate="'required'" data-vv-as="&quot;<?php echo e(__('admin::app.datagrid.latitude')); ?>&quot;" />
                        <span class="control-error" v-if="errors.has('latitude')">{{ errors.first('latitude') }}</span>
                    </div>


                    <div class="control-group" :class="[errors.has('longitude') ? 'has-error' : '']">
                        <label for="sort_order"><?php echo e(__('admin::app.settings.cateringpackages.longitude')); ?></label>
                        <input type="number" class="control" id="sort_order"
                            data-vv-as="&quot;<?php echo e(__('admin::app.datagrid.longitude')); ?>&quot;" name="longitude"
                            value="" v-validate="'required'" />
                        <span class="control-error" v-if="errors.has('longitude')">{{ errors.first('longitude') }}</span>
                    </div>


                    <div class="control-group" :class="[errors.has('display_order') ? 'has-error' : '']">
                        <label for="sort_order"><?php echo e(__('admin::app.settings.cateringpackages.display_order')); ?></label>
                        <input type="text" data-vv-as="&quot;<?php echo e(__('admin::app.datagrid.display_order')); ?>&quot;"
                            class="control" id="sort_order" name="display_order" value="" v-validate="'required'" />

                        <span class="control-error" v-if="errors.has('display_order')">{{ errors.first('display_order') }}</span>
                    </div>

                    

                    
                    <div class="control-group" :class="[errors.has('active') ? 'has-error' : '']">
                       <div class="active_airport_button">
                        <label for="active"><?php echo e(__('admin::app.settings.cateringpackages.active')); ?></label>
                        <input type="checkbox" class="control active_airport_checkbox" id="active" name="active"
                           />
                       </div>
                        <span class="control-error" v-if="errors.has('active')">{{ errors.first('active') }}</span>
                    </div>

                    <?php $channels = core()->getAllChannels() ?>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin::layouts.tinymce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {
            tinyMCEHelper.initTinyMCE({
                selector: 'textarea#tiny',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | table',
                image_advtab: true,
                templates: [{
                        title: 'Test template 1',
                        content: 'Test 1'
                    },
                    {
                        title: 'Test template 2',
                        content: 'Test 2'
                    }
                ],
            });

            // added by umesh 14-06-2023 for state binding according to country

            $("#country").change(function() {

                $("#state").empty();

                var countryId = $(this).val();

                var data = JSON.parse(<?php echo json_encode($states); ?>);

                $.each(data, function(key, value) {

                    if (value.country_id == countryId) {
                        $("#state").append('<option value="' + value.id + '">' + value
                            .default_name + '</option>');
                    }

                });

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\CateringPackage\src\Providers/../Resources/views/admin/create.blade.php ENDPATH**/ ?>