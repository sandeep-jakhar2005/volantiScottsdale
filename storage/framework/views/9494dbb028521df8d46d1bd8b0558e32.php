

<?php $__env->startSection('page_title'); ?>
    
    Edit Airport Fbo Detail
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">

        <form method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data"
            action="<?php echo e(route('admin.cateringpackage.fbo-details.update', ['id' => $airportfbo->id, 'airport_id' => $airportfbo->airport_id])); ?>">

            <div class="page-header">

                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="window.location = '<?php echo e(route('admin.cateringpackage.airport-fbo-details.index', ['id' => $airportfbo->airport_id])); ?>'"></i>

                        
                        Edit Airport Fbo
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        
                        Save Airport Fbo
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <?php echo view_render_event('bagisto.admin.settings.slider.create.before'); ?>


                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        
                        <label for="sort_order">Fbo Name</label>
                        <input type="text" class="control" id="sort_order" name="name" v-validate="'required'"
                            value="<?php echo e($airportfbo->name); ?>" />
                        <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>

                    </div>

                    
                        
                        

                    
                        
                        


                    <input type="hidden" value="<?php echo e($airportfbo->state); ?>" id="hidden_state">

                    <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                        <label for="content"><?php echo e(__('admin::app.settings.cateringpackages.address')); ?></label>

                        <textarea v-validate="'required'" id="" class="control" id="address" name="address" rows="5"><?php echo e($airportfbo->address); ?></textarea>

                        <span class="control-error" v-if="errors.has('address')">{{ errors.first('address') }}</span>
                    </div> 








                    
                            
                        


                    <div class="control-group" :class="[errors.has('notes') ? 'has-error' : '']">
                        <label for="content">Notes (Optional)</label>

                        <textarea class="control" id="notes" name="notes" rows="5"><?php echo e($airportfbo->notes); ?></textarea>

                        <span class="control-error" v-if="errors.has('notes')">{{ errors.first('notes') }}</span>
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


            // added by umesh 15-06-2023 

            var selectedCountryId = $("#country").val();
            var selectedStateId = $("#hidden_state").val();

            var data = JSON.parse(<?php echo json_encode($states); ?>);

            $.each(data, function(key, value) {

                if (value.country_id == selectedCountryId) {
                    $("#state").append('<option value="' + value.id + '">' + value.default_name +
                        '</option>');

                    if (selectedStateId == value.id) {
                        console.log(value.default_name);
                        $("#state").val(value.id).prop("selected", true);
                    }

                }

            });


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

            // end added by umesh   
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\ACME\CateringPackage\src\Providers/../Resources/views/admin/airport-fbo-details/edit.blade.php ENDPATH**/ ?>