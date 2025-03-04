<a class="mini-cart-btn">
    <mini-cart
        is-tax-inclusive="{{ Webkul\Tax\Helpers\Tax::isTaxInclusive() }}"
        view-cart-route="{{ route('shop.checkout.cart.index') }}"
        checkout-route="{{ route('shop.checkout.onepage.show_fbo_detail') }}"
        check-minimum-order-route="{{ route('shop.checkout.check_minimum_order') }}"
        cart-text="{{ __('shop::app.minicart.cart') }}"
        view-cart-text="{{ __('shop::app.minicart.view-cart') }}"
        checkout-text="{{ __('shop::app.minicart.checkout') }}"
        subtotal-text="{{ __('shop::app.checkout.cart.cart-subtotal') }}">
    </mini-cart>
</a>