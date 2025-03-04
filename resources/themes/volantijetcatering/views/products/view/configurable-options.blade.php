@if (Webkul\Product\Helpers\ProductType::hasVariants($product->type))
    @php
        $defaultVariant = $product->getTypeInstance()->getDefaultVariant();
// dd($defaultVariant);
        $config = app('Webkul\Product\Helpers\ConfigurableOption')->getConfigurationConfig($product);

        $galleryImages = product_image()->getGalleryImages($product);

        // dd($galleryImages);
        // dd($config['options']);
    @endphp

    {!! view_render_event('bagisto.shop.products.view.configurable-options.before', ['product' => $product]) !!}

        <product-options></product-options>

    {!! view_render_event('bagisto.shop.products.view.configurable-options.after', ['product' => $product]) !!}

    @push('scripts')
        <script type="text/x-template" id="product-options-template">
            <div class="col-12 attributes" v-if="childAttributes.length > 0">
                <input
                    type="hidden"
                    :value="selectedProductId"
                    id="selected_configurable_option"
                    name="selected_configurable_option"/>

                <div
                    :key="index"
                    v-for='(attribute, index) in childAttributes'
                    :class="`attribute control-group ${errors.has('super_attribute[' + attribute.id + ']') ? 'has-error' : ''}
                    `">
                    <label class="required fs-4">@{{ attribute.label }}</label>

                    <span
                        class="custom-form"
                        v-if="
                            ! attribute.swatch_type
                            || attribute.swatch_type == ''
                            || attribute.swatch_type == 'dropdown'
                        ">

                        <select
                            v-validate="'required'"
                            class="control styled-select"
                            :disabled="attribute.disabled"
                            :id="['attribute_' + attribute.id]"
                            :name="['super_attribute[' + attribute.id + ']']"
                            @change="configure(attribute, $event.target.value)"
                            :data-vv-as="'&quot;' + attribute.label + '&quot;'">

                            <option
                                :value="option.id"
                                v-for='(option, index) in attribute.options'
                                :selected="index == attribute.selectedIndex">
                                @{{ option.label }}
                            </option>

                        </select>

                        <div class="select-icon-container">
                            <span class="select-icon rango-arrow-down"></span>
                        </div>
                    </span>

                    <span class="swatch-container" v-else>
                        <label class="swatch single-product-page-buttons"
                            v-for='(option, index) in attribute.options'
                            v-if="option.id"
                            :data-id="option.id"
                            :for="['attribute_' + attribute.id + '_option_' + option.id]">

                            <input
                                type="radio"
                                :value="option.id"
                                v-validate="'required'"
                                :name="['super_attribute[' + attribute.id + ']']"
                                :id="['attribute_' + attribute.id + '_option_' + option.id]"
                                :data-vv-as="'&quot;' + attribute.label + '&quot;'"
                                @change="configure(attribute, $event.target.value)"
                                :checked="index == attribute.selectedIndex">

                            <div class="single-product-page-button-group-1">
                                <span v-if="attribute.swatch_type == 'color'" :style="{ background: option.swatch_value }"></span>

                                <img v-if="attribute.swatch_type == 'image'" :src="option.swatch_value" :title="option.label" alt="" />

                                <span class="btn-secondary span" v-if="attribute.swatch_type == 'text'">
                                    @{{ option.label }}
                                </span>
                            </div>

                        </label>

                        <span v-if="! attribute.options.length" class="no-options">{{ __('shop::app.products.select-above-options') }}</span>
                    </span>

                    <span class="control-error" v-if="errors.has('super_attribute[' + attribute.id + ']')" v-text="errors.first('super_attribute[' + attribute.id + ']')"></span>
                </div>

            </div>
        </script>

        <script type="text/javascript">
            (() => {
                let galleryImages = @json($galleryImages);

                Vue.component('product-options', {
                    template: '#product-options-template',

                    inject: ['$validator'],

                    data: function() {
                        return {
                            defaultVariant: @json($defaultVariant),

                            config: @json($config),

                            galleryImages: [],

                            simpleProduct: null,

                            childAttributes: [],

                            selectedProductId: '',
                        }
                    },

                    mounted: function () {
                        this.init();

                        this.initDefaultSelection();
                    },

                    methods: {
                        init: function () {
                            let config = @json($config);

                            let childAttributes = this.childAttributes,
                                attributes = config.attributes.slice(),
                                index = attributes.length,
                                attribute;

                            while (index--) {
                                attribute = attributes[index];

                                attribute.options = [];

                                if (index) {
                                    attribute.disabled = true;
                                } else {
                                    this.fillSelect(attribute);
                                }

                                attribute = Object.assign(attribute, {
                                    childAttributes: childAttributes.slice(),
                                    prevAttribute: attributes[index - 1],
                                    nextAttribute: attributes[index + 1]
                                });

                                childAttributes.unshift(attribute);
                            }
                        },

                        initDefaultSelection: function() {
                            if (this.defaultVariant) {
                                this.childAttributes.forEach((attribute) => {
                                    let attributeValue = this.defaultVariant[attribute.code];

                                    this.configure(attribute, attributeValue);
                                });
                            }
                        },

                        configure: function(attribute, value) {
                            this.simpleProduct = this.getSelectedProductId(attribute, value);

                            if (value) {
                                attribute.selectedIndex = this.getSelectedIndex(attribute, value);

                                if (attribute.nextAttribute) {
                                    attribute.nextAttribute.disabled = false;

                                    this.fillSelect(attribute.nextAttribute);
                                    this.resetChildren(attribute.nextAttribute);
                                } else {
                                    this.selectedProductId = this.simpleProduct;
                                }
                            } else {
                                attribute.selectedIndex = 0;
                                this.resetChildren(attribute);
                                this.clearSelect(attribute.nextAttribute)
                            }

                            this.reloadPrice();
                            this.changeProductImages();
                            this.changeStock(this.simpleProduct);
                        },

                        getSelectedIndex: function(attribute, value) {
                            let selectedIndex = 0;

                            attribute.options.forEach(function(option, index) {
                                if (option.id == value) {
                                    selectedIndex = index;
                                }
                            })

                            return selectedIndex;
                        },

                        getSelectedProductId: function(attribute, value) {
                            let options = attribute.options,
                                matchedOptions;
                    

                            matchedOptions = options.filter(function (option) {
                                return option.id == value;
                            });

                            if (matchedOptions[0] != undefined && matchedOptions[0].allowedProducts != undefined) {
                                return matchedOptions[0].allowedProducts[0];
                            }

                            return undefined;
                        },

                        fillSelect: function(attribute) {
                            let options = this.getAttributeOptions(attribute.id);
                            let prevOption;
                            let index = 1;
                            let allowedProducts;
                            let i;
                            let j;

                            this.clearSelect(attribute)

                            attribute.options = [{'id': '', 'label': this.config.chooseText, 'products': []}];

                            if (attribute.prevAttribute) {
                                prevOption = attribute.prevAttribute.options[attribute.prevAttribute.selectedIndex];
                            }

                            if (options) {
                                for (i = 0; i < options.length; i++) {
                                    allowedProducts = [];

                                    if (prevOption) {
                                        for (j = 0; j < options[i].products.length; j++) {
                                            if (prevOption.allowedProducts && prevOption.allowedProducts.indexOf(options[i].products[j]) > -1) {
                                                allowedProducts.push(options[i].products[j]);
                                            }
                                        }
                                    } else {
                                        allowedProducts = options[i].products.slice(0);
                                    }

                                    if (allowedProducts.length > 0) {
                                        options[i].allowedProducts = allowedProducts;

                                        attribute.options[index] = options[i];

                                        index++;
                                    }
                                }
                            }
                        },

                        resetChildren: function(attribute) {
                            if (attribute.childAttributes) {
                                attribute.childAttributes.forEach(function (set) {
                                    set.selectedIndex = 0;
                                    set.disabled = true;
                                });
                            }
                        },

                        clearSelect: function (attribute) {
                            if (! attribute)
                                return;

                            if (! attribute.swatch_type
                                || attribute.swatch_type == ''
                                || attribute.swatch_type == 'dropdown'
                            ) {
                                let element = document.getElementById(`attribute_${attribute.id}`);

                                if (element) {
                                    element.selectedIndex = "0";
                                }
                            } else {
                                let elements = document.getElementsByName(`super_attribute[${attribute.id}]`);

                                elements.forEach(function(element) {
                                    element.checked = false;
                                })
                            }
                        },

                        getAttributeOptions: function (attributeId) {
                            let options;

                            this.config.attributes.forEach(function(attribute, index) {
                                if (attribute.id == attributeId) {
                                    options = attribute.options;
                                }
                            })

                            return options;
                        },

                        reloadPrice: function () {
                            let selectedOptionCount = 0;

                            this.childAttributes.forEach(function(attribute) {
                                if (attribute.selectedIndex) {
                                    selectedOptionCount++;
                                }
                            });

                            let priceLabelElement = document.querySelector('.price-label');
                            let priceElement = document.querySelector('.special-price') ? document.querySelector('.special-price') : document.querySelector('.final-price');
                            let regularPriceElement = document.querySelector('.regular-price');

                            if (this.childAttributes.length == selectedOptionCount) {
                                priceLabelElement.style.display = 'none';

                                if (regularPriceElement) {
                                    regularPriceElement.style.display = 'none';
                                }

                                priceElement.innerHTML = this.config.variant_prices[this.simpleProduct].final_price.formatted_price;
                                   
                                if (
                                    this.config.variant_prices[this.simpleProduct].regular_price.formatted_price == "$0.00" 
                                    || this.config.variant_prices[this.simpleProduct].regular_price.formatted_price == this.config.variant_prices[this.simpleProduct].final_price.formatted_price
                                ) {
                                    regularPriceElement.innerHTML = "";
                                }
                                
                                if (
                                    regularPriceElement 
                                    && this.config.variant_prices[this.simpleProduct].regular_price.formatted_price != "$0.00" 
                                    && this.config.variant_prices[this.simpleProduct].regular_price.formatted_price != this.config.variant_prices[this.simpleProduct].final_price.formatted_price 
                                ) {
                                    regularPriceElement.innerHTML = this.config.variant_prices[this.simpleProduct].regular_price.formatted_price;
                                    regularPriceElement.style.display = 'inline-block';
                                }

                                eventBus.$emit('configurable-variant-selected-event', this.simpleProduct)
                            } else {
                                priceLabelElement.style.display = 'inline-block';

                                priceElement.innerHTML = this.config.regular_price.formatted_price;

                                eventBus.$emit('configurable-variant-selected-event', 0)
                            }
                        },

                        changeProductImages: function () {
                            galleryImages.splice(0, galleryImages.length)

                            this.galleryImages.forEach(function(image) {
                                galleryImages.push(image)
                            });

                            if (this.simpleProduct) {
                                this.config.variant_images[this.simpleProduct].forEach(function(image) {
                                    galleryImages.push(image)
                                });

                                this.config.variant_videos[this.simpleProduct].forEach(function(video) {
                                    galleryImages.push(video)
                                });
                            }

                            galleryImages.forEach(function(image){
                                if (image.type == 'video') {
                                    image.small_image_url = image.medium_image_url = image.large_image_url = image.original_image_url= image.video_url;
                                }
                            });

                            eventBus.$emit('configurable-variant-update-images-event', galleryImages);
                        },

                        changeStock: function (productId) {
                            let inStockElement = document.querySelector('.disable-box-shadow');

                            if (productId) {
                                inStockElement.style.display= "block";
                            } else {
                                inStockElement.style.display= "none";
                            }
                        },
                    }
                });
            })();
        </script>
    @endpush
@endif