

@php
    $cart = cart()->getCart();
    $cartItemsCount = $cart ? $cart->items->count() : trans('shop::app.minicart.zero');
@endphp

 <mobile-header 
    is-customer="{{ auth()->guard('customer')->check() ? 'true' : 'false' }}"
    heading= "{{ __('velocity::app.menu-navbar.text-category') }}"
    :header-content="{{ json_encode(app('Webkul\Velocity\Repositories\ContentRepository')->getAllContents()) }}"
    category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
    cart-items-count="{{ $cartItemsCount }}"
    cart-route="{{ route('shop.checkout.cart.index') }}"
    :locale="{{ json_encode(core()->getCurrentLocale()) }}"
    :all-locales="{{ json_encode(core()->getCurrentChannel()->locales()->orderBy('name')->get()) }}"
    :currency="{{ json_encode(core()->getCurrentCurrency()) }}"
    :all-currencies="{{ json_encode(core()->getCurrentChannel()->currencies) }}"
>  

    {{-- this is default content if js is not loaded --}}
    <div class="row">
        <div class="col-6">
            <div class="hamburger-wrapper ">
                <i class="rango-toggle hamburger"></i>
            </div>

            <a class="left" href="{{ route('shop.home.index') }}" aria-label="Logo">
                <img class="logo" src="{{ core()->getCurrentChannel()->logo_url ?? asset('themes/velocity/assets/images/Desktop_image3.png') }}" alt="" />
            </a>
        </div>

       {{-- <div class="right-vc-header col-6">
            <a class="unset cursor-pointer">
                <i class="material-icons">search</i>
            </ a>
            <a href="{{ route('shop.checkout.cart.index') }}" class="unset">
                <i class="material-icons text-down-3">shopping_cart</i>
                <div class="badge-wrapper">
                    <span class="badge">{{ $cartItemsCount }}</span>
                </div>
            </a>
        </div> --}}
          {!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}

<div id="account">
    <div class="d-inline-block welcome-content dropdown-toggle">
        @if (auth()->guard('customer')->user() && auth()->guard('customer')->user()->image)
       
            <i class="align-vertical-top"><img class= "profile-small-icon" src="{{ auth('customer')->user()->image_url }}" alt="{{ auth('customer')->user()->first_name }}"/></i>

        @else
           
        <img  src="{{ asset('themes/velocity/assets/images/login.png')}}" alt="" height="25px" />
        @endif


 <span class="text-center">
  

{!! auth()->guard('customer')->user() ? auth()->guard('customer')->user()->first_name : '<a href="' . route('shop.customer.session.index') . '">' . trans('shop::app.header.sign-in') . '</a>' !!}    

</span>

        @if(auth()->guard('customer')->user())
        <span class="rango-arrow-down" > </span>
        @endif
    </div>

    @guest('customer')
    
    @endguest

    @auth('customer')
        <div class="dropdown-list">
            <div class="dropdown-label">

                {{ auth()->guard('customer')->user()->first_name }}
            </div>

            <div class="dropdown-container">
                <ul type="none">
                    <li>
                        <a href="{{ route('shop.customer.profile.index') }}" class="unset">{{ __('shop::app.header.profile') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('shop.customer.orders.index') }}" class="unset">{{ __('velocity::app.shop.general.orders') }}</a>
                    </li>

                    @if ((bool) core()->getConfigData('general.content.shop.wishlist_option'))
                        <li>
                            <a href="{{ route('shop.customer.wishlist.index') }}" class="unset">{{ __('shop::app.header.wishlist') }}</a>
                        </li>
                    @endif

                    @if ((bool) core()->getConfigData('general.content.shop.compare_option'))
                        <li>
                            <a href="{{ route('velocity.customer.product.compare') }}" class="unset">{{ __('velocity::app.customer.compare.text') }}</a>
                        </li>
                    @endif

                    <li>
                        <form id="customerLogout" action="{{ route('shop.customer.session.destroy') }}" method="POST">
                            @csrf

                            @method('DELETE')
                        </form>

                        <a
                            class="unset"
                            href="{{ route('shop.customer.session.destroy') }}"
                            onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                            {{ __('shop::app.header.logout') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</div>

{!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}

<!------------ended by umesh 06-07-2023----------->
                                        
                                   
                                    <div class="cart-wrapper">
                                        <img src="{{ asset('themes/velocity/assets/images/shopping-bag-icon.png')}}" alt="" />
                                    </div>


                                    <div class="left-wrapper">
                        {!! view_render_event('bagisto.shop.layout.header.wishlist.before') !!}

                        @include('velocity::shop.layouts.particals.header-compts', ['isText' => true])

                        {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}
                    </div>
                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
<!-- shyam html end  05-07-2023-->
@push('scripts')
    <script type="text/javascript">
        (() => {
            document.addEventListener('scroll', e => {
                scrollPosition = Math.round(window.scrollY);

                if (scrollPosition > 50) {
                    document.querySelector('header').classList.add('header-shadow');
                } else {
                    document.querySelector('header').classList.remove('header-shadow');
                }
            });
        })();
    </script>
@endpush

    </div>

  
</mobile-header>  



