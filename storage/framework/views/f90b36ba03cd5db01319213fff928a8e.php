<form
    method="POST"
    action="<?php echo e(route('admin.customer.update', $customer->id)); ?>"
    @submit.prevent="onSubmit">
    <div class="page-content">
        <div class="form-container">
            <?php echo csrf_field(); ?>

            <input name="_method" type="hidden" value="PUT">

            <div class="style:overflow: auto;">&nbsp;</div>

            <div slot="body">
                <?php echo view_render_event('bagisto.admin.customer.edit.form.before', ['customer' => $customer]); ?>


                <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                    <label for="first_name" class="required"> <?php echo e(__('admin::app.customers.customers.first_name')); ?></label>

                    <input
                        type="text"
                        class="control"
                        id="first_name"
                        name="first_name"
                        value="<?php echo e(old('first_name') ?:$customer->first_name); ?>"
                        v-validate="'required'"
                        data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.firstname')); ?>&quot;"/>

                    <span class="control-error" v-if="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.first_name.after', ['customer' => $customer]); ?>


                <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                    <label for="last_name" class="required"> <?php echo e(__('admin::app.customers.customers.last_name')); ?></label>

                    <input
                        type="text"
                        class="control"
                        id="last_name"
                        name="last_name"
                        value="<?php echo e(old('last_name') ?:$customer->last_name); ?>"
                        v-validate="'required'"
                        data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.lastname')); ?>&quot;">

                    <span class="control-error" v-if="errors.has('last_name')">{{ errors.first('last_name') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.last_name.after', ['customer' => $customer]); ?>


                <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                    <label for="email" class="required"> <?php echo e(__('admin::app.customers.customers.email')); ?></label>

                    <input
                        type="email"
                        class="control"
                        id="email"
                        name="email"
                        value="<?php echo e(old('email') ?:$customer->email); ?>"
                        v-validate="'required|email'"
                        data-vv-as="&quot;<?php echo e(__('shop::app.customer.signup-form.email')); ?>&quot;">

                    <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.email.after', ['customer' => $customer]); ?>


                <div class="control-group" :class="[errors.has('gender') ? 'has-error' : '']">
                    <label for="gender" class="required"><?php echo e(__('admin::app.customers.customers.gender')); ?></label>

                    <select
                        class="control"
                        id="gender"
                        name="gender"
                        value="<?php echo e($customer->gender); ?>"
                        v-validate="'required'"
                        data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.gender')); ?>&quot;">

                        <option value="" <?php echo e($customer->gender == "" ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.select-gender')); ?></option>
                        <option value="<?php echo e(__('admin::app.customers.customers.male')); ?>" <?php echo e($customer->gender == __('admin::app.customers.customers.male') ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.male')); ?></option>
                        <option value="<?php echo e(__('admin::app.customers.customers.female')); ?>" <?php echo e($customer->gender == __('admin::app.customers.customers.female') ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.female')); ?></option>
                        <option value="<?php echo e(__('admin::app.customers.customers.other')); ?>" <?php echo e($customer->gender == __('admin::app.customers.customers.other') ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.other')); ?></option>

                    </select>

                    <span class="control-error" v-if="errors.has('gender')">{{ errors.first('gender') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.gender.after', ['customer' => $customer]); ?>


                <div class="control-group">
                    <label for="status" class="required"><?php echo e(__('admin::app.customers.customers.status')); ?></label>

                    <label class="switch">
                        <input
                            type="checkbox"
                            id="status"
                            name="status"
                            value="<?php echo e($customer->status); ?>" <?php echo e($customer->status ? 'checked' : ''); ?>>

                        <span class="slider round"></span>
                    </label>

                    <span class="control-error" v-if="errors.has('status')">{{ errors.first('status') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.status.after', ['customer' => $customer]); ?>


                <div class="control-group">
                    <label for="isSuspended" class="required"><?php echo e(__('admin::app.customers.customers.suspend')); ?></label>

                    <label class="switch">
                        <input
                            id="isSuspended"
                            type="checkbox"
                            name="is_suspended"
                            value="<?php echo e($customer->is_suspended); ?>" <?php echo e($customer->is_suspended ? 'checked' : ''); ?>>

                        <span class="slider round"></span>
                    </label>

                    <span class="control-error" v-if="errors.has('is_suspended')">{{ errors.first('is_suspended') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.is_suspended.after', ['customer' => $customer]); ?>


                <div class="control-group date" :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                    <label for="dob"><?php echo e(__('admin::app.customers.customers.date_of_birth')); ?></label>

                    <date>
                        <input
                            type="date"
                            class="control"
                            id="dob"
                            name="date_of_birth"
                            value="<?php echo e(old('date_of_birth') ?:$customer->date_of_birth); ?>"
                            v-validate=""
                            data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.date_of_birth')); ?>&quot;">
                    </date>
                    <span class="control-error" v-if="errors.has('date_of_birth')">{{ errors.first('date_of_birth') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.date_of_birth.after', ['customer' => $customer]); ?>


                <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                    <label for="phone"><?php echo e(__('admin::app.customers.customers.phone')); ?></label>

                    <input
                        type="text"
                        class="control usa_mobile_number"
                        id="phone"
                        name="phone"
                        value="<?php echo e($customer->phone); ?>"
                        v-validate="'required|min:14'"
                        data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.phone')); ?>&quot;">

                    <span class="control-error" v-if="errors.has('phone')">{{ errors.first('phone') }}</span>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.phone.after', ['customer' => $customer]); ?>


                <div class="control-group">
                    <label for="customerGroup" ><?php echo e(__('admin::app.customers.customers.customer_group')); ?></label>

                    <?php if(! is_null($customer->customer_group_id)): ?>
                        <?php $selectedCustomerOption = $customer->group->id ?>
                    <?php else: ?>
                        <?php $selectedCustomerOption = '' ?>
                    <?php endif; ?>

                    <select class="control" id="customerGroup" name="customer_group_id">
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($group->id); ?>" <?php echo e($selectedCustomerOption == $group->id ? 'selected' : ''); ?>>
                                <?php echo e($group->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <?php echo view_render_event('bagisto.admin.customer.edit.form.after', ['customer' => $customer]); ?>

            </div>

            <button type="submit" class="btn btn-lg btn-primary"><?php echo e(__('admin::app.customers.customers.save-btn-title')); ?></button>
        </div>
    </div>
</form>


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
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale\packages\Webkul\Admin\src/resources/views/customers/general.blade.php ENDPATH**/ ?>