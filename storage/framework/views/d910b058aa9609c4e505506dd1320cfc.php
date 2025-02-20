<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    
    <title><?php echo $__env->yieldContent('page_title'); ?></title>

    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="<?php echo e(app()->getLocale()); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="base-url" content="<?php echo e(url()->to('/')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!---------added by umesh 14-07-2023--------->
    
    <link rel="stylesheet" href="<?php echo e(asset('themes/volantijetcatering/assets/css/style.css')); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    

    <link rel="preload" href="<?php echo e(asset('themes/volantijetcatering/assets/fonts/font-awesome/Fino-Sans-Regular.otf')); ?>" as="font" type="font/otf" 
      crossorigin="anonymous">

    

    <!---------end by umesh 14-07-2023--------->

    <link rel="stylesheet" href="<?php echo e(asset('themes/volantijetcatering/assets/css/jquery-ui.min.css')); ?>" />

    <!---------end by shyam 01-08-2023--------->

    <?php echo view_render_event('bagisto.shop.layout.head'); ?>


    
    <?php echo $__env->yieldContent('head'); ?>

    
    <?php echo $__env->yieldContent('seo'); ?>

    
    <meta name="robots" content="nofollow">
    
    <?php if($favicon = core()->getCurrentChannel()->favicon_url): ?>
        <link rel="icon" sizes="16x16" href="<?php echo e($favicon); ?>" />
    <?php else: ?>
        <link rel="icon" sizes="16x16" href="<?php echo e(asset('/themes/velocity/assets/images/static/v-icon.png')); ?>" />
    <?php endif; ?>

    
    <?php echo $__env->make('shop::layouts.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <style>
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-color: rgba(255, 255, 255, 0.8); */
            background-color: rgba(255, 255, 255, 0.918);
            z-index: 9999;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid rgb(237, 40, 73) !important;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loaded .loader-wrapper {
            display: none;
        }

        .not-loaded #app,
        .not-loaded .footer {
            display: none;
        }

        .loaded #app {
            display: block;
        }
    </style>
</head>

<body class="not-loaded">
    
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>

    <?php echo view_render_event('bagisto.shop.layout.body.before'); ?>


    
    <div id="app">
        <product-quick-view v-if="$root.quickView"></product-quick-view>

        <div class="main-container-wrapper">
            <?php $__env->startSection('body-header'); ?>
                

                

                <?php echo view_render_event('bagisto.shop.layout.header.before'); ?>


                
                <?php echo $__env->make('shop::layouts.header.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo view_render_event('bagisto.shop.layout.header.after'); ?>


                <div class="main-content-wrapper col-12 no-padding shop-by-category">

                    
                    <header class="row velocity-divide-page vc-header header-shadow active">

                        
                        <div class="vc-small-screen container header-background " v-if='$root.currentScreen <= 992'>
                            <?php echo $__env->make('shop::layouts.header.mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        
                        

                    </header>

                    <div class="">
                        <div class="row col-12 remove-padding-margin ">
                            <sidebar-component main-sidebar=true id="sidebar-level-0" url="<?php echo e(url()->to('/')); ?>"
                                category-count="<?php echo e($velocityMetaData ? $velocityMetaData->sidebar_category_count : 10); ?>"
                                add-class="category-list-container pt10">
                            </sidebar-component>
                            <!-- commented by shyam 09-08-23 -->
                            <div class="col-12 no-padding content  row-display-none" id="home-right-bar-container">
                                <div class="container-right row no-margin col-12 no-padding">
                                    <?php echo view_render_event('bagisto.shop.layout.content.before'); ?>


                                    <?php echo $__env->yieldContent('content-wrapper'); ?>

                                    <?php echo view_render_event('bagisto.shop.layout.content.after'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo $__env->yieldSection(); ?>

            <div class="container-fuild">
                <?php echo view_render_event('bagisto.shop.layout.full-content.before'); ?>


                <?php echo $__env->yieldContent('full-content-wrapper'); ?>

                <?php echo view_render_event('bagisto.shop.layout.full-content.after'); ?>

            </div>
        </div>

        
        <velocity-overlay-loader></velocity-overlay-loader>

        <go-top bg-color="#26A37C"></go-top>
    </div>

    
    <?php $__env->startSection('footer'); ?>
        <?php echo view_render_event('bagisto.shop.layout.footer.before'); ?>


        <?php echo $__env->make('shop::layouts.footer.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo view_render_event('bagisto.shop.layout.footer.after'); ?>

    <?php echo $__env->yieldSection(); ?>

    <?php echo view_render_event('bagisto.shop.layout.body.after'); ?>


    
    <div id="alert-container"></div>

    
    <?php echo $__env->make('shop::layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.js">
    </script>
    <script src="<?php echo e(asset('themes/volantijetcatering/assets/js/custom.js')); ?>"></script>

    
    <script>
        window.addEventListener('load', function() {
            document.body.classList.remove('not-loaded');
            document.body.classList.add('loaded');
        });
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/layouts/master.blade.php ENDPATH**/ ?>