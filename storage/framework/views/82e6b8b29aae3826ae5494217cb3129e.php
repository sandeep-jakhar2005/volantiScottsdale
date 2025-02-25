<?php $__env->startSection('page_title'); ?>
    
    Account | Volanti Jet Catering
<?php $__env->stopSection(); ?>


<?php $__env->startSection('seo'); ?>
<meta name="title" content="Account | Volanti Jet Catering" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .account-head {
            height: 50px;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('page-detail-wrapper'); ?>
    <div class="profile-header my-4">
        <h3 class="account-heading mt-3 pl-0">
            <?php echo e(__('shop::app.customer.account.profile.index.title')); ?>

        </h3>
    </div>

    <?php echo view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]); ?>


    <div class="account-table-content profile-page-content border">

        <div class="row mt-3">
            <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.before', ['customer' => $customer]); ?>

            <div class="col-sm-12 col-md-6 col-lg-6 profile-left mt-2">
                <img src="/../themes/volantijetcatering/assets/images/catering_img.jpg " alt="">
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 d-block profile-right">
                
                <div class="profilename d-flex flex-wrap">
                <h1><?php echo e($customer->first_name); ?></h1>
                <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.first_name.after', [
                    'customer' => $customer,
                ]); ?>


                
                <h1><?php echo e($customer->last_name); ?></h1>
                <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.last_name.after', [
                    'customer' => $customer,
                ]); ?>

                </div>
                <div class="mt-3">
                <?php if($customer->date_of_birth!=''): ?>
                <div class="profile-info ">
                    
                    <img src="/../themes/volantijetcatering/assets/images/calendar.png" alt="">
                    <p><?php echo e($customer->date_of_birth ?? '-'); ?></p>
                    <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.date_of_birth.after', [
                        'customer' => $customer,
                    ]); ?>

                </div>
                <?php endif; ?>
                <?php if($customer->phone!=''): ?>
                <div class="profile-info">
                    
                    <img src="/../themes/volantijetcatering/assets/images/telephone.png " alt="">
                    <p><?php echo e($customer->phone ?? '-'); ?></p>
                    <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.phone.after', [
                        'customer' => $customer,
                    ]); ?>

                </div>
            <?php endif; ?>

                <div class="profile-info">
                    
                    <img src="/../themes/volantijetcatering/assets/images/email.png " alt="">
                    <p><?php echo e($customer->email); ?></p>
                </div>
                <?php if($customer->gender!=''): ?>
                <div class="profile-info">
                    
                    <img src="/../themes/volantijetcatering/assets/images/sex.png " alt="">
                    <p><?php echo e($customer->gender ?? '-'); ?></p>
                    <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.gender.after', [
                        'customer' => $customer,
                    ]); ?>

                </div>
                <?php endif; ?>
            </div>
                
                <div class="row mt-1">
                    <div class="col-7">
                        <span class="account-action d-flex">
                            <a href="<?php echo e(route('shop.customer.profile.edit')); ?>"
                                class="theme-btn light unset profile-edit text-center text-white float-right ">
                                <?php echo e(__('shop::app.customer.account.profile.index.edit')); ?>

                            </a>
                        </span>
                    </div>
                    
                </div>

            </div>
            <?php echo view_render_event('bagisto.shop.customers.account.profile.view.table.after', ['customer' => $customer]); ?>

        </div>



        
        
        
        
        















        



        <div id="deleteProfileForm" class="d-none">
            <form method="POST" action="<?php echo e(route('shop.customer.profile.destroy')); ?>" @submit.prevent="onSubmit">
                <?php echo csrf_field(); ?>

                <modal id="deleteProfile" :is-open="modalIds.deleteProfile">
                    <h3 slot="header">
                        <?php echo e(__('shop::app.customer.account.address.index.enter-password')); ?>

                    </h3>

                    <i class="rango-close"></i>

                    <div slot="body">
                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="required"><?php echo e(__('admin::app.users.users.password')); ?></label>

                            <input type="password" v-validate="'required|min:6'" class="control" id="password"
                                name="password" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.password')); ?>&quot;" />

                            <span class="control-error" v-if="errors.has('password')"
                                v-text="errors.first('password')"></span>
                        </div>

                        <div class="page-action">
                            <button type="submit" class="theme-btn mb20">
                                <?php echo e(__('shop::app.customer.account.address.index.delete')); ?>

                            </button>
                        </div>
                    </div>
                </modal>
            </form>
        </div>
    </div>

    <?php echo view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        /**
         * Show delete profile modal.
         */
        function showDeleteProfileModal() {
            document.getElementById('deleteProfileForm').classList.remove('d-none');

            window.app.showModal('deleteProfile');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('shop::customers.account.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/customers/account/profile/index.blade.php ENDPATH**/ ?>