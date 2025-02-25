<div class="customer-sidebar row no-margin no-padding">
    <div class="account-details col-12">
        <?php if(auth('customer')->user()->image): ?>
            <div>
                <img style="width:80px;height:80px;border-radius:50%;" src="<?php echo e(auth('customer')->user()->image_url); ?>" alt="<?php echo e(auth('customer')->user()->first_name); ?>"/>
            </div>
        <?php else: ?>
            <div class="customer-name col-12 text-uppercase">
                <?php echo e(substr(auth('customer')->user()->first_name, 0, 1)); ?>

            </div>
        <?php endif; ?>
        <div class="col-12 customer-name-text text-capitalize text-break mt-3"><?php echo e(auth('customer')->user()->first_name . ' ' . auth('customer')->user()->last_name); ?></div>
        
        <div class="customer-email col-12 text-break"><?php echo e(auth('customer')->user()->email); ?></div>
    </div>


    <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
        <ul type="none" class="navigation">
            
            
            <?php
                $subMenuCollection = [];
                try {
                    $subMenuCollection['profile'] = $menuItem['children']['profile'];
                    $subMenuCollection['orders'] = $menuItem['children']['orders'];
                    // $subMenuCollection['downloadables'] = $menuItem['children']['downloadables']; // commented 13-10-203 (not required)

                    if ((bool) core()->getConfigData('general.content.shop.wishlist_option')) {
                        // $subMenuCollection['wishlist'] = $menuItem['children']['wishlist']; // commented 13-10-203 (not required)
                    }

                    if ((bool) core()->getConfigData('general.content.shop.compare_option')) {
                        // $subMenuCollection['compare'] = $menuItem['children']['compare']; // commented 13-10-203 (not required)
                    }

                    // $subMenuCollection['reviews'] = $menuItem['children']['reviews']; // commented 13-10-203 (not required)
                    // sandeep commnet 
                    // $subMenuCollection['address'] = $menuItem['children']['address'];
                
                    unset(
                        $menuItem['children']['profile'],
                        $menuItem['children']['orders'],
                        $menuItem['children']['downloadables'],
                        $menuItem['children']['wishlist'],
                        $menuItem['children']['compare'],
                        $menuItem['children']['reviews'],
                        $menuItem['children']['address']
                    );

                    foreach ($menuItem['children'] as $key => $remainingChildren) {
                        $subMenuCollection[$key] = $remainingChildren;
                    }
                } catch (\Exception $exception) {
                    $subMenuCollection = $menuItem['children'];
                }
            ?>

            <?php $__currentLoopData = $subMenuCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subMenuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($menu->getActive($subMenuItem)); ?>" title="<?php echo e(trans($subMenuItem['name'])); ?>">
                    <a class="unset fw6 full-width" href="<?php echo e($subMenuItem['url']); ?>">
                        <i class="icon <?php echo e($index); ?> text-down-3"></i>
                        <span><?php echo e(trans($subMenuItem['name'])); ?><span>
                        <i class="rango-arrow-right float-right text-down-3"></i>
                    </a>
                </li>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .main-content-wrapper {
            margin-bottom: 0px;
            min-height: 100vh;
        }
    </style>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/customers/account/partials/sidemenu.blade.php ENDPATH**/ ?>