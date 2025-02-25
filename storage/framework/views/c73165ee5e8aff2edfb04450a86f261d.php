<?php if(! empty($shipping)): ?>
    <div :class="`col-12 form-field mb30 ${errors.has('address-form.shipping[first_name]') ? 'has-error' : ''}`">
        <label for="shipping[first_name]" class="mandatory" style="width: unset;">
            <?php echo e(__('shop::app.checkout.onepage.first-name')); ?>

        </label>

        <input
            class="control"
            id="shipping[first_name]"
            type="text"
            name="shipping[first_name]"
            v-model="address.shipping.first_name"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.first-name')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[first_name]')"
            v-if="errors.has('address-form.shipping[first_name]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[last_name]') ? 'has-error' : ''}`">
        <label for="shipping[last_name]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.last-name')); ?>

        </label>

        <input
            class="control"
            id="shipping[last_name]"
            type="text"
            name="shipping[last_name]"
            v-model="address.shipping.last_name"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.last-name')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[last_name]')"
            v-if="errors.has('address-form.shipping[last_name]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[email]') ? 'has-error' : ''}`">
        <label for="shipping[email]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.email')); ?>

        </label>

        <input
            class="control"
            id="shipping[email]"
            type="text"
            name="shipping[email]"
            v-model="address.shipping.email"
            v-validate="'required|email'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.email')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[email]')"
            v-if="errors.has('address-form.shipping[email]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[address1][]') ? 'has-error' : ''}`" style="margin-bottom: 0;">
        <label for="shipping_address_0" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.address1')); ?>

        </label>

        <input
            class="control"
            id="shipping_address_0"
            type="text"
            name="shipping[address1][]"
            v-model="address.shipping.address1[0]"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.address1')); ?>&quot;" 
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[address1][]')"
            v-if="errors.has('address-form.shipping[address1][]')">
        </span>
    </div>

    <?php if(
        core()->getConfigData('customer.address.information.street_lines')
        && core()->getConfigData('customer.address.information.street_lines') > 1
    ): ?>
        <?php for($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++): ?>
            <div class="col-12 form-field" style="margin-top: 10px; margin-bottom: 0">
                <input
                    class="control"
                    id="shipping_address_<?php echo e($i); ?>"
                    type="text"
                    name="shipping[address1][<?php echo e($i); ?>]"
                    v-model="address.shipping.address1[<?php echo e($i); ?>]"
                    @change="validateForm('address-form')" />
            </div>
        <?php endfor; ?>
    <?php endif; ?>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[country]') ? 'has-error' : ''}`" style="margin-top: 15px;">
        <label for="shipping[country]" class="<?php echo e(core()->isCountryRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.country')); ?>

        </label>

        <select
            class="control styled-select"
            id="shipping[country]"
            type="text"
            name="shipping[country]"
            v-model="address.shipping.country"
            v-validate="'<?php echo e(core()->isCountryRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.country')); ?>&quot;" 
            @change="validateForm('address-form')">

            <option value="" disabled><?php echo e(__('ui::form.select-attribute', ['attribute' => __('shop::app.checkout.onepage.country')])); ?></option>

            <option v-for='(country, index) in countries' :value="country.code">
                {{ country.name }}
            </option>
        </select>

        <div class="select-icon-container">
            <i class="select-icon rango-arrow-down"></i>
        </div>

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[country]')"
            v-if="errors.has('address-form.shipping[country]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[state]') ? 'has-error' : ''}`">
        <label for="shipping[state]" class="<?php echo e(core()->isStateRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.state')); ?>

        </label>

        <input
            class="control"
            id="shipping[state]"
            type="text"
            name="shipping[state]"
            v-model="address.shipping.state"
            v-validate="'<?php echo e(core()->isStateRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"
            v-if="! haveStates('shipping')"
            @change="validateForm('address-form')" />

        <select
            class="control styled-select"
            id="shipping[state]"
            name="shipping[state]"
            v-model="address.shipping.state"
            v-validate="'<?php echo e(core()->isStateRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"
            v-if="haveStates('shipping')"
            @change="validateForm('address-form')">

            <option value=""><?php echo e(__('shop::app.checkout.onepage.select-state')); ?></option>

            <option v-for='(state, index) in countryStates[address.shipping.country]' :value="state.code">
                {{ state.default_name }}
            </option>
        </select>

        <div class="select-icon-container" v-if="haveStates('shipping')">
            <i class="select-icon rango-arrow-down"></i>
        </div>

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[state]')"
            v-if="errors.has('address-form.shipping[state]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[city]') ? 'has-error' : ''}`">
        <label for="shipping[city]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.city')); ?>

        </label>

        <input
            class="control"
            id="shipping[city]"
            type="text"
            name="shipping[city]"
            v-model="address.shipping.city"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.city')); ?>&quot;" 
            @change="validateForm('address-form')"/>

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[city]')"
            v-if="errors.has('address-form.shipping[city]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[postcode]') ? 'has-error' : ''}`">
        <label for="shipping[postcode]" class="<?php echo e(core()->isPostCodeRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.postcode')); ?>

        </label>

        <input
            class="control"
            id="shipping[postcode]"
            type="text"
            name="shipping[postcode]"
            v-model="address.shipping.postcode"
            v-validate="'<?php echo e(core()->isPostCodeRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.postcode')); ?>&quot;"
            @keyup="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[postcode]')"
            v-if="errors.has('address-form.shipping[postcode]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.shipping[phone]') ? 'has-error' : ''}`">
        <label for="shipping[phone]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.phone')); ?>

        </label>

        <input
            class="control"
            id="shipping[phone]"
            type="text"
            name="shipping[phone]"
            v-model="address.shipping.phone"
            v-validate="'required|numeric'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.phone')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.shipping[phone]')"
            v-if="errors.has('address-form.shipping[phone]')">
        </span>
    </div>

    <?php if(auth()->guard('customer')->check()): ?>
        <div class="mb10">
            <span class="checkbox fs16 display-inbl no-margin">
                <input
                    id="shipping[save_as_address]"
                    type="checkbox"
                    name="shipping[save_as_address]"
                    v-model="address.shipping.save_as_address" />

                
                <label for="shipping[save_as_address]" class="checkbox-view"></label>

                <span>
                    <?php echo e(__('shop::app.checkout.onepage.save_as_address')); ?>

                </span>
            </span>
        </div>
    <?php endif; ?>
<?php elseif(! empty($billing)): ?>
    <div :class="`col-12 form-field ${errors.has('address-form.billing[company_name]') ? 'has-error' : ''}`">
        <label for="billing[company_name]">
            <?php echo e(__('shop::app.checkout.onepage.company-name')); ?>

        </label>

        <input
            class="control"
            id="billing[company_name]"
            type="text"
            name="billing[company_name]"
            v-model="address.billing.company_name"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.company-name')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[company_name]')"
            v-if="errors.has('address-form.billing[company_name]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[first_name]') ? 'has-error' : ''}`">
        <label for="billing[first_name]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.first-name')); ?>

        </label>

        <input
            class="control"
            id="billing[first_name]"
            type="text"
            name="billing[first_name]"
            v-model="address.billing.first_name"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.first-name')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[first_name]')"
            v-if="errors.has('address-form.billing[first_name]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[last_name]') ? 'has-error' : ''}`">
        <label for="billing[last_name]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.last-name')); ?>

        </label>

        <input
            class="control"
            id="billing[last_name]"
            type="text"
            name="billing[last_name]"
            v-model="address.billing.last_name"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.last-name')); ?>&quot;" 
            @change="validateForm('address-form')"/>

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[last_name]')"
            v-if="errors.has('address-form.billing[last_name]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[email]') ? 'has-error' : ''}`">
        <label for="billing[email]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.email')); ?>

        </label>

        <input
            class="control"
            id="billing[email]"
            type="text"
            name="billing[email]"
            v-model="address.billing.email"
            v-validate="'required|email'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.email')); ?>&quot;"
            @blur="isCustomerExist" />

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[email]')"
            v-if="errors.has('address-form.billing[email]')">
        </span>
    </div>

    <?php if(! auth()->guard('customer')->check()): ?>
        <?php echo $__env->make('shop::checkout.onepage.customer-checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[address1][]') ? 'has-error' : ''}`" style="margin-bottom: 0;">
        <label for="billing_address_0" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.address1')); ?>

        </label>

        <input
            class="control"
            id="billing_address_0"
            type="text"
            name="billing[address1][]"
            v-model="address.billing.address1[0]"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.address1')); ?>&quot;" 
            @change="validateForm('address-form')"/>

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[address1][]')"
            v-if="errors.has('address-form.billing[address1][]')">
        </span>
    </div>

    <?php if(
        core()->getConfigData('customer.address.information.street_lines')
        && core()->getConfigData('customer.address.information.street_lines') > 1
    ): ?>
        <?php for($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++): ?>
            <div class="col-12 form-field" style="margin-top: 10px; margin-bottom: 0">
                    <input
                        class="control"
                        id="billing_address_<?php echo e($i); ?>"
                        type="text"
                        name="billing[address1][<?php echo e($i); ?>]"
                        v-model="address.billing.address1[<?php echo e($i); ?>]" 
                        @change="validateForm('address-form')"/>
            </div>
        <?php endfor; ?>
    <?php endif; ?>
    
    <div :class="`col-12 form-field ${errors.has('address-form.billing[country]') ? 'has-error' : ''}`"  style="margin-top: 15px;">
        <label for="billing[country]" class="<?php echo e(core()->isCountryRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.country')); ?>

        </label>

        <select
            class="control styled-select"
            id="billing[country]"
            type="text"
            name="billing[country]"
            v-model="address.billing.country"
            v-validate="'<?php echo e(core()->isCountryRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.country')); ?>&quot;"
            @change="validateForm('address-form')" >

            <option value="" disabled><?php echo e(__('ui::form.select-attribute', ['attribute' => __('shop::app.checkout.onepage.country')])); ?></option>

            <option v-for='(country, index) in countries' :value="country.code" v-text="country.name"></option>
        </select>

        <div class="select-icon-container">
            <i class="select-icon rango-arrow-down"></i>
        </div>

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[country]')"
            v-if="errors.has('address-form.billing[country]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[state]') ? 'has-error' : ''}`">
        <label for="billing[state]" class="<?php echo e(core()->isStateRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.state')); ?>

        </label>

        <input
            class="control"
            id="billing[state]"
            type="text"
            name="billing[state]"
            v-model="address.billing.state"
            v-validate="'<?php echo e(core()->isStateRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"
            v-if="! haveStates('billing')"
            @change="validateForm('address-form')" />

        <select
            class="control styled-select"
            id="billing[state]"
            name="billing[state]"
            v-model="address.billing.state"
            v-validate="'<?php echo e(core()->isStateRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"
            v-if="haveStates('billing')"
            @change="validateForm('address-form')">

            <option value=""><?php echo e(__('shop::app.checkout.onepage.select-state')); ?></option>

            <option v-for='(state, index) in countryStates[address.billing.country]' :value="state.code" v-text="state.default_name"></option>
        </select>

        <div class="select-icon-container" v-if="haveStates('billing')">
            <i class="select-icon rango-arrow-down"></i>
        </div>

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[state]')"
            v-if="errors.has('address-form.billing[state]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[city]') ? 'has-error' : ''}`">
        <label for="billing[city]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.city')); ?>

        </label>

        <input
            class="control"
            id="billing[city]"
            type="text"
            name="billing[city]"
            v-model="address.billing.city"
            v-validate="'required'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.city')); ?>&quot;" 
            @change="validateForm('address-form')"/>

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[city]')"
            v-if="errors.has('address-form.billing[city]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[postcode]') ? 'has-error' : ''}`">
        <label for="billing[postcode]" class="<?php echo e(core()->isPostCodeRequired() ? 'mandatory' : ''); ?>">
            <?php echo e(__('shop::app.checkout.onepage.postcode')); ?>

        </label>

        <input
            class="control"
            id="billing[postcode]"
            type="text"
            name="billing[postcode]"
            v-model="address.billing.postcode"
            v-validate="'<?php echo e(core()->isPostCodeRequired() ? 'required' : ''); ?>'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.postcode')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[postcode]')"
            v-if="errors.has('address-form.billing[postcode]')">
        </span>
    </div>

    <div :class="`col-12 form-field ${errors.has('address-form.billing[phone]') ? 'has-error' : ''}`">
        <label for="billing[phone]" class="mandatory">
            <?php echo e(__('shop::app.checkout.onepage.phone')); ?>

        </label>

        <input
            class="control"
            id="billing[phone]"
            type="text"
            name="billing[phone]"
            v-model="address.billing.phone"
            v-validate="'required|numeric'"
            data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.phone')); ?>&quot;"
            @change="validateForm('address-form')" />

        <span
            class="control-error"
            v-text="errors.first('address-form.billing[phone]')"
            v-if="errors.has('address-form.billing[phone]')">
        </span>
    </div>

    <?php if($cart->haveStockableItems()): ?>
        <div class="mb10">
            <span class="checkbox fs16 display-inbl no-margin">
                <input
                    id="billing[use_for_shipping]"
                    type="checkbox"
                    name="billing[use_for_shipping]"
                    v-model="address.billing.use_for_shipping"
                    @change="setTimeout(() => validateForm('address-form'), 0)" />

                <label for="billing[use_for_shipping]" class="checkbox-view"></label>

                <span>
                    <?php echo e(__('shop::app.checkout.onepage.use_for_shipping')); ?>

                </span>
            </span>
        </div>
    <?php endif; ?>

    <?php if(auth()->guard('customer')->check()): ?>
        <div class="mb10">
            <span class="checkbox fs16 display-inbl no-margin">
                <input
                    id="billing[save_as_address]"
                    type="checkbox"
                    name="billing[save_as_address]"
                    ref="billingSaveAsAddress"
                    v-model="address.billing.save_as_address"
                    @change="validateForm('address-form')" />

                <label for="billing[save_as_address]" class="checkbox-view"></label>

                <span>
                    <?php echo e(__('shop::app.checkout.onepage.save_as_address')); ?>

                </span>
            </span>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sandeep-projects\VolantiScottsdale/resources/themes/volantijetcatering/views/checkout/onepage/customer-new-form.blade.php ENDPATH**/ ?>