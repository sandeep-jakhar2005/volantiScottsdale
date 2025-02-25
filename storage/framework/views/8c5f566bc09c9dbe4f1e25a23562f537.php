<?php $__env->startSection('page_title'); ?>
    
    Account | Volanti Jet Catering
<?php $__env->stopSection(); ?>


<?php $__env->startSection('seo'); ?>
<meta name="title" content="Account | Volanti Jet Catering" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-detail-wrapper'); ?>
    <div class="account-head mb-15">
        <span class="account-heading"><?php echo e(__('shop::app.customer.account.profile.index.title')); ?></span>

        <span></span>
    </div>

    <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]); ?>


    <form
        method="POST"
        @submit.prevent="onSubmit"
        action="<?php echo e(route('shop.customer.profile.store')); ?>"
        enctype="multipart/form-data">

        <div class="account-table-content">
            <?php echo csrf_field(); ?>
            <div class="row edit-profile">

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div :class="`row ${errors.has('first_name') ? 'has-error' : ''}`">
                    <label class="col-12 mandatory">
                        <?php echo e(__('shop::app.customer.account.profile.fname')); ?>

                    </label>

                    <div class="col-12">
                        <input value="<?php echo e($customer->first_name); ?>" name="first_name" type="text" class="control" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('shop::app.customer.account.profile.fname')); ?>&quot;" />
                        <span class="control-error" v-if="errors.has('first_name')" v-text="errors.first('first_name')"></span>
                    </div>
                </div>
            </div>
            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div :class="`row ${errors.has('last_name') ? 'has-error' : ''}`">
                    <label class="col-12 mandatory">
                        <?php echo e(__('shop::app.customer.account.profile.lname')); ?>

                    </label>

                    <div class="col-12">
                        <input value="<?php echo e($customer->last_name); ?>" name="last_name" type="text" class="control" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('shop::app.customer.account.profile.lname')); ?>&quot;" />
                        <span class="control-error" v-if="errors.has('last_name')" v-text="errors.first('last_name')"></span>
                    </div>
                </div>
            </div>
            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.last_name.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div :class="`row ${errors.has('gender') ? 'has-error' : ''}`">
                    <label class="col-12 mandatory">
                        <?php echo e(__('shop::app.customer.account.profile.gender')); ?>

                    </label>

                    <div class="col-12">
                        <select
                            name="gender"
                            v-validate="'required'"
                            class="control styled-select"
                            data-vv-as="&quot;<?php echo e(__('shop::app.customer.account.profile.gender')); ?>&quot;">

                            <option value=""
                                <?php if($customer->gender == ""): ?>
                                    selected="selected"
                                <?php endif; ?>>
                                <?php echo e(__('admin::app.customers.customers.select-gender')); ?>

                            </option>

                            <option value="Other"
                                <?php if($customer->gender == "Other"): ?>
                                    selected="selected"
                                <?php endif; ?>>
                                <?php echo e(__('velocity::app.shop.gender.other')); ?>

                            </option>

                            <option
                                value="Male"
                                <?php if($customer->gender == "Male"): ?>
                                    selected="selected"
                                <?php endif; ?>>
                                <?php echo e(__('velocity::app.shop.gender.male')); ?>

                            </option>

                            <option
                                value="Female"
                                <?php if($customer->gender == "Female"): ?>
                                    selected="selected"
                                <?php endif; ?>>
                                <?php echo e(__('velocity::app.shop.gender.female')); ?>

                            </option>
                        </select>

                        <div class="select-icon-container">
                            <span class="select-icon rango-arrow-down"></span>
                        </div>

                        <span class="control-error" v-if="errors.has('gender')" v-text="errors.first('gender')"></span>
                    </div>
                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.gender.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div :class="`row ${errors.has('date_of_birth') ? 'has-error' : ''}`">
                    <label class="col-12">
                        <?php echo e(__('shop::app.customer.account.profile.dob')); ?>

                    </label>

                    <div class="col-12">
                        <date id="date-of-birth">
                            <input
                                type="date"
                                name="date_of_birth"
                                placeholder="yyyy/mm/dd"
                                value="<?php echo e(old('date_of_birth') ?? $customer->date_of_birth); ?>"
                                v-validate="" data-vv-as="&quot;<?php echo e(__('shop::app.customer.account.profile.dob')); ?>&quot;" />
                        </date>

                        <span class="control-error" v-if="errors.has('date_of_birth')" v-text="errors.first('date_of_birth')"></span>
                    </div>
                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.date_of_birth.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div class="row">
                    <label class="col-12 mandatory">
                        <?php echo e(__('shop::app.customer.account.profile.email')); ?>

                    </label>

                    <div class="col-12">
                        <input value="<?php echo e($customer->email); ?>" name="email" class="control" type="text" v-validate="'required'" />
                        <span class="control-error" v-if="errors.has('email')" v-text="errors.first('email')"></span>
                    </div>
                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.email.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div class="row">
                    <label class="col-12">
                        <?php echo e(__('shop::app.customer.account.profile.phone')); ?>

                    </label>

                    <div class="col-12">
                        <input value="<?php echo e(old('phone') ?? $customer->phone); ?>" name="phone"  type="number" v-validate="'length:10,14'"/>
                        <span class="control-error" v-if="errors.has('phone')" v-text="errors.first('phone')"></span>
                    </div>
                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.phone.after', ['customer' => $customer]); ?>

            <div class="col-12 mt-3">
                <div class="row image-container <?php echo $errors->has('image.*') ? 'has-error' : ''; ?>">
                    <label class="col-12">
                        <?php echo e(__('admin::app.catalog.categories.image')); ?>

                    </label>

                    <div class="col-12">
                        <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="image" :multiple="false" :images='"<?php echo e($customer->image_url); ?>"'></image-wrapper>

                        <span class="control-error" v-if="<?php echo $errors->has('image.*'); ?>">
                            <?php $__currentLoopData = $errors->get('image.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo str_replace($key, 'Image', $message[0]); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                    </div>
                </div>
            </div>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.image.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div class="row">
                    <label class="col-12">
                        <?php echo e(__('velocity::app.shop.general.enter-current-password')); ?>

                    </label>

                    <div :class="`col-12 ${errors.has('oldpassword') ? 'has-error' : ''}`">
                        <input value="" name="oldpassword" type="password" />
                    </div>
                </div>
            </div>
            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div class="row">
                    <label class="col-12">
                        <?php echo e(__('velocity::app.shop.general.new-password')); ?>

                    </label>

                    <div :class="`col-12 ${errors.has('password') ? 'has-error' : ''}`">
                        <input
                            value=""
                            name="password"
                            ref="password"
                            type="password"
                            v-validate="'min:6'" />

                        <span class="control-error" v-if="errors.has('password')" v-text="errors.first('password')"></span>
                    </div>
                </div>
            </div>
            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.password.after', ['customer' => $customer]); ?>

            <div class="col-6 mt-3 user-profile-input">
                <div class="row">
                    <label class="col-12">
                        <?php echo e(__('velocity::app.shop.general.confirm-new-password')); ?>

                    </label>

                    <div :class="`col-12 ${errors.has('password_confirmation') ? 'has-error' : ''}`">
                        <input value="" name="password_confirmation" type="password"
                        v-validate="'min:6|confirmed:password'" data-vv-as="confirm password" />

                        <span class="control-error" v-if="errors.has('password_confirmation')" v-text="errors.first('password_confirmation')"></span>
                    </div>
                </div>
            </div>

            <?php if(core()->getConfigData('customer.settings.newsletter.subscription')): ?>
                <div class="control-group">
                    <input type="checkbox" id="checkbox2" name="subscribed_to_news_letter" <?php if(isset($customer->subscription)): ?> value="<?php echo e($customer->subscription->is_subscribed); ?>" <?php echo e($customer->subscription->is_subscribed ? 'checked' : ''); ?> <?php endif; ?>  style="width: auto;">
                    <span><?php echo e(__('shop::app.customer.signup-form.subscribe-to-newsletter')); ?></span>
                </div>
            <?php endif; ?>

            <?php echo view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]); ?>

            <div class="col-12 mt-5 d-flex justify-content-center">
                <button
                    type="submit"
                    class="theme-btn mb20 profile_update_button" style="width:200px">
                    <?php echo e(__('velocity::app.shop.general.update')); ?>

                </button>
            </div>
            </div>
        </div>
    </form>

    <?php echo view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('shop::customers.account.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/customers/account/profile/edit.blade.php ENDPATH**/ ?>