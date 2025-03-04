@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.sales.shipments.add-title') }}
@stop
{{-- @dd($order) --}}
@section('content-wrapper')
    <div class="content full-page">
        <form method="POST" action="{{ route('admin.paymentprofile.shipments.store', $order->id) }}" @submit.prevent="onSubmit">
            @csrf()

            <div class="page-header">
                <div class="page-title">
                    <h1 class="order_shipment_title">
                        <i
                            class="icon angle-left-icon back-link"
                            onclick="window.location = '{{ route('admin.sales.shipments.index') }}'"
                        >
                        </i>

                        {{ __('admin::app.sales.shipments.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.shipments.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="sale-container">
                    <accordian title="{{ __('admin::app.sales.orders.order-and-account') }}" :active="true">
                        <div slot="body">
                            <div class="sale">
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.order-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.shipments.order-id') }}
                                            </span>

                                            <span class="value">
                                                <a
                                                    href="{{ route('admin.sales.orders.view', $order->id) }}"
                                                >
                                                    #{{ $order->increment_id }}
                                                </a>
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.order-date') }}
                                            </span>

                                            <span class="value">
                                                {{-- sandeep change date time formate --}}
                                                {{ core()->formatDate($order->created_at, 'm-d-Y h:i:s') }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.order-status') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->status }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.channel') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->channel_name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.account-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.customer-name') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->customer_full_name }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.email') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->customer_email }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </accordian>


                    @if ($order->billing_address || $order->shipping_address)
                        <accordian title="{{ __('admin::app.sales.orders.address') }}" :active="true">
                            <div slot="body">
                                <div class="sale">
                                    @if ($order->billing_address)
                                        <div class="sale-section">
                                            <div class="secton-title">
                                                <span>{{ __('admin::app.sales.orders.billing-address') }}</span>
                                            </div>

                                            <div class="section-content">
                                                @include ('admin::sales.address', ['address' => $order->billing_address])
                                            </div>
                                        </div>
                                    @endif

                                    @if ($order->shipping_address)
                                        <div class="sale-section">
                                            <div class="secton-title">
                                                <span>{{ __('admin::app.sales.orders.shipping-address') }}</span>
                                            </div>

                                            <div class="section-content">
                                                @include ('admin::sales.address', ['address' => $order->shipping_address])
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </accordian>
                    @endif

                    <accordian title="{{ __('admin::app.sales.orders.payment-and-shipping') }}" :active="true">
                        <div slot="body">
                            <div class="sale">
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>
                                            {{ __('admin::app.sales.orders.payment-info') }}
                                        </span>
                                    </div>

                                    <div class="section-content">
                                        @if (isset($order->payment->method))
                                            <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.payment-method') }}
                                            </span>

                                            <span class="value">
                                                {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                                            </span>
                                        </div>
                                        @endif
                                        

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.currency') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->order_currency_code }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.shipping-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.shipping-method') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->shipping_title }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.shipping-price') }}
                                            </span>

                                            <span class="value">
                                                {{ core()->formatBasePrice($order->base_shipping_amount) }}
                                            </span>
                                        </div>

                                        <div class="control-group" style="margin-top: 40px">
                                            <label
                                                for="shipment[carrier_title]"
                                            >
                                                {{ __('admin::app.sales.shipments.carrier-title') }}
                                            </label>

                                            <input
                                                class="control"
                                                id="shipment[carrier_title]"
                                                type="text"
                                                name="shipment[carrier_title]"
                                            />
                                        </div>

                                        <div class="control-group">
                                            <label
                                                for="shipment[track_number]"
                                            >
                                                {{ __('admin::app.sales.shipments.tracking-number') }}
                                            </label>

                                            <input
                                                class="control"
                                                id="shipment[track_number]"
                                                type="text"
                                                name="shipment[track_number]"
                                            />
                                        </div>

                                        {{-- delivery partner start --}}

                                        <div class="control-group" :class="[errors.has('shipment[delivery_partner]') ? 'has-error' : '']">
                                            <label for="shipment[delivery_partner]" class="required">Delivery Partner</label>
                            
                                            <select v-validate="'required'" class="control" name="shipment[delivery_partner]" id="shipment[delivery_partner]"   >
                                                <option value="">Please select delivery partner</option>
                            
                                                @foreach ($delivery_partners as $key => $delivery_partner)
                                                    <option value="{{ $delivery_partner->id }}">{{ $delivery_partner->name}} ({{$delivery_partner->email}})</option>
                                                @endforeach
                                            </select>
                            
                                            <span class="control-error" v-if="errors.has('shipment[delivery_partner]')">
                                                {{-- @{{ errors.first('delivery_partner') }} --}}
                                                The "Delivery Partner" field is required
                                            </span>
                                        </div>

                                        {{-- delivery partner end --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </accordian>

                    <accordian title="{{ __('admin::app.sales.orders.products-ordered') }}" :active="true">
                        <div slot="body">
                            <order-item-list></order-item-list>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script type="text/x-template" id="order-item-list-template">
        <div>
            <div class="control-group" :class="[errors.has('shipment[source]') ? 'has-error' : '']">
                <label for="shipment[source]" class="required">{{ __('admin::app.sales.shipments.source') }}</label>

                <select v-validate="'required'" class="control" name="shipment[source]" id="shipment[source]" data-vv-as="&quot;{{ __('admin::app.sales.shipments.source') }}&quot;" v-model="source" @change="onSourceChange">
                    <option value="">{{ __('admin::app.sales.shipments.select-source') }}</option>

                    @foreach ($order->channel->inventory_sources as $key => $inventorySource)
                        <option value="{{ $inventorySource->id }}">{{ $inventorySource->name }}</option>
                    @endforeach
                </select>

                <span class="control-error" v-if="errors.has('shipment[source]')">
                    @{{ errors.first('shipment[source]') }}
                </span>
            </div>

            <div class="table">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('admin::app.sales.orders.SKU') }}</th>

                                <th>{{ __('admin::app.sales.orders.product-name') }}</th>

                                <th>{{ __('admin::app.sales.shipments.qty-ordered') }}</th>

                                <th>{{ __('admin::app.sales.shipments.qty-invoiced') }}</th>

                                <th>{{ __('admin::app.sales.shipments.qty-to-ship') }}</th>

                                <th>{{ __('admin::app.sales.shipments.available-sources') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($order->items as $item)

                                @if (
                                    $item->qty_to_ship > 0
                                    && $item->product
                                )
                                    <tr>
                                        <td>{{ $item->getTypeInstance()->getOrderedItem($item)->sku }}</td>

                                        <td>
                                            {{ $item->name }}

                                            @if (isset($item->additional['attributes']))
                                                <div class="item-options">
                                                    @foreach ($item->additional['attributes'] as $attribute)
                                                    {{-- @dd($attribute) --}}
                                                        {{-- <b>{{ $attribute['attribute_name'] }} : </b> --}}
                                                        ({{ $attribute['option_label'] }})</br>
                                                    @endforeach

                                                </div>
                                            @endif
                                        </td>

                                        <td>{{ $item->qty_ordered }}</td>

                                        <td>{{ $item->qty_invoiced }}</td>

                                        <td>{{ $item->qty_to_ship }}</td>

                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('admin::app.sales.shipments.source') }}</th>

                                                        <th>{{ __('admin::app.sales.shipments.qty-available') }}</th>

                                                        <th>{{ __('admin::app.sales.shipments.qty-to-ship') }}</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($order->channel->inventory_sources as $key => $inventorySource)
                                                        <tr>
                                                            <td>
                                                                {{ $inventorySource->name }}
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $product = $item->getTypeInstance()->getOrderedItem($item)->product;

                                                                    $sourceQty = $product->type == 'bundle' ? $item->qty_ordered : $product->inventory_source_qty($inventorySource->id);
                                                                @endphp

                                                                {{ $sourceQty }}
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $inputName = "shipment[items][$item->id][$inventorySource->id]";
                                                                @endphp

                                                                <div class="control-group" :class="[errors.has('{{ $inputName }}') ? 'has-error' : '']">
                                                                    <input
                                                                        ref="{{ $inputName }}"
                                                                        class="control"
                                                                        id="{{ $inputName }}"
                                                                        type="text"
                                                                        name="{{ $inputName }}"
                                                                        value="{{ $item->qty_to_ship }}"
                                                                        v-validate="'required|numeric|min_value:0|max_value:{{$item->qty_ordered}}'"
                                                                        data-vv-as="&quot;{{ __('admin::app.sales.shipments.qty-to-ship') }}&quot;"
                                                                        data-original-quantity="{{ $item->qty_to_ship }}"
                                                                        :disabled="'{{ empty($sourceQty) }}' || source != '{{ $inventorySource->id }}'"
                                                                    />

                                                                    <span class="control-error" v-if="errors.has('{{ $inputName }}')" v-text="errors.first('{{ $inputName }}')"></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('order-item-list', {
            template: '#order-item-list-template',

            inject: ['$validator'],

            data: function() {
                return {
                    source: ""
                }
            },

            methods: {
                onSourceChange() {
                    this.$validator.reset();

                    this.setOriginalQuantityToAllShipmentInputElements();
                },

                getAllShipmentInputElements() {
                    let allRefs = this.$refs;

                    let allInputElements = [];

                    Object.keys(allRefs).forEach((key) => {
                        if (key.startsWith('shipment')) {
                            allInputElements.push(allRefs[key]);
                        }
                    });

                    return allInputElements;
                },

                setOriginalQuantityToAllShipmentInputElements() {
                    this.getAllShipmentInputElements().forEach((element) => {
                        element.value = element.dataset.originalQuantity;
                    });
                }
            },
        });
    </script>
@endpush
