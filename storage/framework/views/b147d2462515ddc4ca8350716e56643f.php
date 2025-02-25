<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.customers.customers.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="<?php echo e(route('admin.customer.store')); ?>" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '<?php echo e(route('admin.customer.index')); ?>'"></i>

                        <?php echo e(__('admin::app.customers.customers.title')); ?>


                        <?php echo e(Config::get('carrier.social.facebook.url')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.customers.customers.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <?php echo view_render_event('bagisto.admin.customers.create.before'); ?>


                    <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                        <label for="first_name" class="required"><?php echo e(__('admin::app.customers.customers.first_name')); ?></label>
                        <input type="text" class="control" id="first_name" name="first_name" v-validate="'required'" value="<?php echo e(old('first_name')); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.firstname')); ?>&quot;">
                        <span class="control-error" v-if="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.first_name.after'); ?>


                    <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                        <label for="last_name" class="required"><?php echo e(__('admin::app.customers.customers.last_name')); ?></label>
                        <input type="text" class="control" id="last_name" name="last_name" v-validate="'required'" value="<?php echo e(old('last_name')); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.lastname')); ?>&quot;">
                        <span class="control-error" v-if="errors.has('last_name')">{{ errors.first('last_name') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.last_name.after'); ?>


                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email" class="required"><?php echo e(__('shop::app.customer.signup-form.email')); ?></label>
                        <input type="email" class="control" id="email" name="email" v-validate="'required|email'" value="<?php echo e(old('email')); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.email')); ?>&quot;">
                        <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.email.after'); ?>


                    <div class="control-group" :class="[errors.has('gender') ? 'has-error' : '']">
                        <label for="gender" class="required"><?php echo e(__('admin::app.customers.customers.gender')); ?></label>
                        <select name="gender" class="control" id="gender" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.gender')); ?>&quot;">
                            <option value=""><?php echo e(__('admin::app.customers.customers.select-gender')); ?></option>
                            <option value="<?php echo e(__('admin::app.customers.customers.male')); ?>"><?php echo e(__('admin::app.customers.customers.male')); ?></option>
                            <option value="<?php echo e(__('admin::app.customers.customers.female')); ?>"><?php echo e(__('admin::app.customers.customers.female')); ?></option>
                            <option value="<?php echo e(__('admin::app.customers.customers.other')); ?>"><?php echo e(__('admin::app.customers.customers.other')); ?></option>
                        </select>
                        <span class="control-error" v-if="errors.has('gender')">{{ errors.first('gender') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.gender.after'); ?>


                    <div class="control-group date" :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                        <label for="dob"><?php echo e(__('admin::app.customers.customers.date_of_birth')); ?></label>
                        
                        <date>
                            <input 
                                type="date" 
                                class="control" 
                                id="dob" 
                                name="date_of_birth" 
                                value="<?php echo e(old('date_of_birth')); ?>" 
                                v-validate="" 
                                data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.date_of_birth')); ?>&quot;"
                                placeholder="<?php echo e(__('admin::app.customers.customers.date_of_birth_placeholder')); ?>" 
                            >
                        </date>

                        <span class="control-error" v-if="errors.has('date_of_birth')">{{ errors.first('date_of_birth') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.date_of_birth.after'); ?>


                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone"><?php echo e(__('admin::app.customers.customers.phone')); ?></label>
                        <input type="text" class="control usa_mobile_number" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" v-validate="'required'"
                         data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.phone')); ?>&quot;">
                        <span class="control-error" v-if="errors.has('phone')">{{ errors.first('phone') }}</span>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.phone.after'); ?>


                    <div class="control-group">
                        <label for="customerGroup" ><?php echo e(__('admin::app.customers.customers.customer_group')); ?></label>
                        <select  class="control" id="customerGroup" name="customer_group_id">
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($group->id); ?>"> <?php echo e($group->name); ?> </>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <?php echo view_render_event('bagisto.admin.customers.create.after'); ?>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>

        
    // sandeep add code for mobile number shhow in usa formate
    $('body').on('input', '.usa_mobile_number', function () {
    var phone = $(this).val().replace(/\D/g, ''); 

    // Only start formatting when phone length is more than 3 digits
    if (phone.length > 3 && phone.length <= 6) {
        phone = '(' + phone.slice(0, 3) + ') ' + phone.slice(3);
    } else if (phone.length > 6) {
        phone = '(' + phone.slice(0, 3) + ') ' + phone.slice(3, 6) + '-' + phone.slice(6, 10);
    }

    $(this).val(phone);
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/customers/create.blade.php ENDPATH**/ ?>