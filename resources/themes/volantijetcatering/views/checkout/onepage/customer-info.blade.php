@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
    use Webkul\Checkout\Facades\Cart;
    use Illuminate\Support\Facades\Request;
    use Webkul\Checkout\Repositories\CartRepository;

    // $guestToken = Session::token();
    // $airportArr = Db::table('delivery_location_airports')->pluck('name')->toArray();

    // // Retrieve the guest session ID
    // $guestSessionId = Session::getId();
    // $cartItems = Session::get('cart');
    //echo session()->get('cart')->id;

    // $customer = auth()->guard('customer')->user();

    // if (Auth::check()) {
    //     $islogin = 1;
    //     $address = Db::table('addresses')
    //         ->where('customer_id', $customer->id)
    //         ->where('address_type', 'customer')
    //         ->orderBy('id', 'desc') // Assuming 'created_at' is a timestamp column
    //         ->first();

    // } else {
    //     $islogin = 0;
    //     $address = Db::table('addresses')
    //         ->where('customer_token', $guestToken)
    //         ->where('address_type', 'customer')
    //         ->first();
    // }

    // // sandeep
    // if ($address) {
    //     $airpport = DB::table('delivery_location_airports as al')
    //         ->join('airport_fbo_details as af', 'af.airport_id', '=', 'al.id')
    //         ->where('al.name', $address->airport_name)
    //         ->where('af.id', $address->airport_fbo_id)
    //         ->select('af.name as fbo_name', 'al.id as airport_id')
    //         ->first();
    //     // dd($airpport);
    // }

    // dd($AirportId);
    // if ($address) {
    //     $AirportsName = DB::table('delivery_location_airports')
    //         ->select('name','id')
    //         ->get();

    //  }

    // sandeep get airport data and fbo data
    $Airports = DB::table('delivery_location_airports')->select('name', 'id')->get();

    
    // $AirportsFbo = DB::table('airport_fbo_details')->select('name', 'id')->get();
    
    if(Auth::check()){
        $AirportsFbo = DB::table('airport_fbo_details')
            ->select('name', 'id')
            ->where('customer_id', $customer->id)
            ->orWhere(function ($query) {
                $query->whereNull('customer_id')
                    ->whereNull('customer_token');
            })
            ->get();
       }else{
        $AirportsFbo = DB::table('airport_fbo_details')
            ->select('name', 'id')
            ->where('customer_token', $guestToken)
            ->orWhere(function ($query) {
                $query->whereNull('customer_id')
                    ->whereNull('customer_token');
            })
            ->get();
       }
    //    dd($AirportsFbo);
    //    dd($defaultAddress);
@endphp

  

<!-- Modal -->
@if (Auth::check())
    <form action="">
        @csrf
        <div class="modal fade sandeep_model" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header address-header pb-0">
                        <h3 v-if="allAddress.length > 0">Update location</h3>
                        <h3 v-else>Select location</h3>

                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="search-content">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-8 pr-0">
                                        <input type="text" id="auto_search" class="form-control"
                                            placeholder="Search Delivery Location" attr=""
                                            @if (isset($address)) value="" @endif>
                                        <div id="address-list" class="suggestion-list"></div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-3">
                                        <input type="hidden" id="airport_id" value="0" class="">
                                        <button v-if="allAddress.length > 0" class="btn btn-danger m-auto address-btn"
                                            disabled type="button" id="address_update">Search</button>
                                        <button v-else class="btn btn-danger m-auto address-btn" disabled type="button"
                                            id="address_update">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- sandeep add fbo detail model --}}
                        <div class="search__wrapper">
                            <input type="text" id="airport-fbo-input" class="form-control pr-4 pl-1 bg-white pointer"
                                placeholder="Airport Fbo Detail" readonly
                                @if (isset($airpport)) value="" @endif>
                            <img class="Navigation-image pointer pr-2" id="airportImageFbo"
                                src="{{ asset('themes/volantijetcatering/assets/images/home/down-arrow.svg') }}"
                                alt="" height="20px" />
                            <div id="checkout_airport-fbo-list" class="custom-dropdown-list text-justify d-none">
                            </div>

                            <input type="hidden" id="selected-fbo-id" name="selected_fbo_id">

                        </div>

                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade add_fbo_modal" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">
                    <img class="Navigation-image"
                        src="{{ asset('themes/volantijetcatering/assets/images/home/store.svg') }}"
                        alt="" />
                    Add New Fbo
                </h5>
                <button type="button" class="fboClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <div class="input_wrapper">
                        <label for="fbo-name" class="mandatory">Fbo Name</label>
                        <input type="text" class="control" id="fbo-name" name="name"
                            v-validate="'required'" value="" />
                            <!-- sandeep comment code -->
                         <!-- <span class="control-error"
                            v-if="errors.has('name')">@{{ errors.first('name') }}</span> -->
                            <span class="control-error" id="name-error">
                            </span>
                    </div> 

                    <div class="input_wrapper">
                        <label for="fbo-address" class="mandatory">Address</label>
                        <textarea v-validate="'required'" class="control" id="fbo-address" name="address" rows="5"></textarea>
                         <!-- sandeep comment code -->
                        <!-- <span class="control-error"
                            v-if="errors.has('address')">@{{ errors.first('address') }}</span> -->
                            <span class="control-error" id="address-error">
                            </span>
                    </div>
                    <div class="input_wrapper">
                        <label for="fbo-notes">Notes (Optional)</label>
                        <textarea class="control" id="fbo-notes" name="notes" rows="5"></textarea>
                        <!-- <span class="control-error"
                            v-if="errors.has('notes')">@{{ errors.first('notes') }}</span> -->
                            <span class="control-error" id="notes-error">
                            </span>
                    </div>

                    <button id="add-fbo-button">
                        <img class='suggestion-icon'
                            src='/themes/volantijetcatering/assets/images/home/plus-circle1.svg'>
                        ADD</button>
                </div>
            </div>

        </div>
    </div>
</div>
    </form>

@else
    <form id="AirportForm">
        @csrf
        <div class="modal fade sandeep_model" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header address-header pb-0">
                        @if ($customer_address)
                            <h3>Update location</h3>
                        @else
                            <h3>Add location</h3>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="search-content">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-8 pr-0">
                                        <input type="text" id="auto_search" class="form-control"
                                            placeholder="Search Delivery Location"
                                            attr="{{ isset($airpport) ? $airpport->airport_id : '' }}"
                                            @if (isset($address)) value="{{ $address->airport_name }}" @endif>
                                        <div id="address-list" class="suggestion-list"></div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-3">
                                        <input type="hidden" id="airport_id" value="0">
                                        @if ($customer_address)
                                            <button class="btn btn-danger m-auto address-btn" disabled type="button"
                                                id="address_update">Search</button>
                                        @else
                                            <button class="btn btn-danger m-auto address-btn" disabled type="button"
                                                id="address_update">Search</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- sandeep add fbo detail --}}

                        <div class="search__wrapper">
                            <input type="text" id="airport-fbo-input" class="form-control bg-white pr-4 pl-1 pointer"
                                {{-- attr="{{ isset($airport_fbo) ? $airport_fbo : '' }}" --}} placeholder="Airport Fbo Detail" readonly
                                @if (isset($airpport)) value="{{ $airpport->fbo_name }}" @endif>
                            <img class="Navigation-image pointer pr-2" id="airportImageFbo"
                                src="{{ asset('themes/volantijetcatering/assets/images/home/down-arrow.svg') }}"
                                alt="" height="20px" />
                            <div id="checkout_airport-fbo-list" class="custom-dropdown-list text-justify d-none">
                                <!-- Options will be inserted here -->
                            </div>

                            <input type="hidden" id="selected-fbo-id" name="selected_fbo_id">


                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- Popup to add FBO detail --}}
         <div class="modal fade add_fbo_modal" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title text-center" id="exampleModalCenterTitle">
                         <img class="Navigation-image"
                             src="{{ asset('themes/volantijetcatering/assets/images/home/store.svg') }}"
                             alt="" />
                         Add New Fbo
                     </h5>
                     <button type="button" class="fboClose" data-dismiss="modal"
                         aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-container">
                         <div class="input_wrapper">
                             <label for="fbo-name" class="mandatory">Fbo Name</label>
                             <input type="text" class="control" id="fbo-name" name="name"
                                 v-validate="'required'" value="" />
                             
                                 <span class="control-error" id="name-error">
                                 </span>
                         </div>
                         <div class="input_wrapper">
                             <label for="fbo-address" class="mandatory">Address</label>
                             <textarea v-validate="'required'" class="control" id="fbo-address" name="address" rows="5"></textarea>
                             
                             <span class="control-error" id="address-error">
                             </span>
                         </div>
                         <div class="input_wrapper">
                             <label for="fbo-notes">Notes (Optional)</label>
                             <textarea class="control" id="fbo-notes" name="notes" rows="5"></textarea>
                             
                             <span class="control-error" id="notes-error">
                             </span>
                         </div>

                         <button id="add-fbo-button">
                             <img class='suggestion-icon'
                                 src='/themes/volantijetcatering/assets/images/home/plus-circle1.svg'>
                             ADD</button>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <!-- End Modal for adding FBO -->


    </form>


@endif

<form data-vv-scope="address-form" class="custom-form pl-3">
    <div class="form-container" v-if="! this.new_billing_address">
        <div slot="body">
            <div class="address-container row full-width no-margin" id="address-container">
                <div :key="index" class="col-lg-6 col-md-12 address-holder pl0 ordering-from"
                    v-for='(addresses, index) in allAddress'>
                    
                    <div class="border-0" style="width: 100%;">
                        <div class="row address-row">
                            <div class="col-1">
                                <div class="radio" id="checked-radio">
                                    <input type="radio" name="billing[address_id]" class="Billing_Address_button"
                                        :id="'billing_address_id_' + addresses.id" :value="addresses.id"
                                        v-model="address.billing.address_id"
                                        data-vv-as="&quot;{{ __('shop::app.checkout.onepage.billing-address') }}&quot;"
                                        @change="validateForm('address-form')" />
                                    <label :for="'billing_address_id_' + addresses.id" class="radio-view px-2"></label>
                                </div>
                            </div>
                            
                            <div class="col-9 address-column">
                                <h4 class="card-title fw6">Ordering From</h4>
                                {{-- sandeep --}}
                                <!-- Button trigger modal -->
                                <ul type="none" class="order-body">
                                    {{-- sandeep add airport fbo id --}}
                                    {{-- <li class="Address_Id" id = "Address_Id" v-text="addresses.id" value = ""
                                        hidden></li> --}}
                                    <li class="airport_fbo_id" v-text="addresses.airport_fbo_id" hidden></li>
                                    {{-- sandeep add id  --}}
                                    <li class="address_Id" v-text="addresses.id" hidden></li>

                                    <li class="airport_name" v-text="addresses.airport_name" id="airport_name"></li>

                                    <li v-text="addresses.address1" id="Airport_Address"></li>
                                    <li v-text="addresses.default_address" class="default_address"
                                        style="display:none"></li>
                                    <!-- <li v-text="addresses.state"></li>
                                        <li>
                                            <span v-text="addresses.country"></span>
                                            <span v-text="addresses.postcode"></span>
                                        </li> -->
                                    <!-- <li>{{ __('shop::app.customer.account.address.index.contact') }} : @{{ addresses.phone }}</li> -->
                                    <div class="mt-2 text-break"  id="airport_fbo_details" :class="{ 'd-none': !addresses.fbo_name }">
                                        <h5 class="child-card-title mb-0">Airport Fbo</h5>
                                        <li class="airport_fboName" v-text="addresses.fbo_name" id="AirportFbo_Name"></li>
                                        {{-- <li class="airport_fboAddress" v-text="addresses.fbo_address" id="airport_fbo_address"></li> --}}
                                    </div>
                                </ul>
                            </div>
                            <div class="col-1">
                                <span class="text-danger pointer edit-airport" data-toggle="modal"
                                    data-target="#exampleModal" id="Edit_Airport">edit</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- hide add new address -->
                <!-- <div class="col-lg-6 col-md-12 address-holder pl0">
                        <div class="card">
                            <div
                                @click="validateFormAfterAction"
                                class="card-body add-address-button">
                                <div class="cursor-pointer" @click="newBillingAddress()">
                                    <i class="material-icons">add_circle_outline</i>

                                    <span>{{ __('shop::app.checkout.onepage.new-address') }}</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
            </div>
            {{-- sandeep show fbo --}}


            <div :class="`col-12 mt15 has-error ${errors.has('address-form.billing[address_id]') ? 'has-error' : ''}`">
                <span class="control-error" v-if="errors.has('address-form.billing[address_id]')"
                    v-text="errors.first('address-form.billing[address_id]')">
                </span>
            </div>

            {{-- @if ($cart->haveStockableItems())
                <div class="mt10 mb10" v-if="address.billing.address_id">
                    <span class="checkbox fs16 display-inbl">
                        <input id="billing[use_for_shipping]" type="checkbox" name="billing[use_for_shipping]"
                            v-model="address.billing.use_for_shipping" @change="validateFormAfterAction"  />
                    
                        <label for="billing[use_for_shipping]" class="checkbox-view"></label>
                    
                        <span>
                            {{ __('shop::app.checkout.onepage.use_for_shipping') }}
                        </span>
                    </span>
                    
                </div>
            @endif   --}}
        </div>


    </div>

    <div class="form-container" v-else>
        <!-- <accordian :title="'{{ __('shop::app.checkout.onepage.billing-address') }}'" :active="true">
            <div class="form-header" slot="header">
                <h3 class="fw6 display-inbl">
                    {{ __('shop::app.checkout.onepage.billing-address') }}
                </h3>

                <i class="rango-arrow"></i>
            </div>

            <div class="col-12 no-padding" slot="body">
                @auth('customer')
    @if (count(auth('customer')->user()->addresses))
    <a class="theme-btn light back-button text-up-14" @click="backToSavedBillingAddress()">

                                                                        {{ __('shop::app.checkout.onepage.back') }}
                                                                    </a>
    @endif
@endauth



                @include('shop::checkout.onepage.customer-new-form', ['billing' => true])
            
                {{-- </div> --}}
        </accordian> -->
        @if (Auth::check())
            <h4 class="card-title fw6 mt-3">Ordering From</h4>
            <button type="button" class="btn mb-3 theme-btn add-address-btn" style="font-size:14px" data-toggle="modal"
                data-target="#exampleModal">Choose Location</button>
        @else
            @if ($customer_address == null)
                <h4 class="card-title fw6 mt-3">Ordering From</h4>
                <button type="button" class="btn  mb-3 theme-btn add-address-btn" data-toggle="modal"
                    data-target="#exampleModal">Choose Location</button>
            @else
                <div class="address-container row full-width no-margin">
                    <div :key="" class="col-lg-6 col-md-12 address-holder pl0 ordering-from">
                        <div class="border-0" style="width: 100%;">
                            <div class="row address-row">
                                <div class="col-1">
                                    <div class="radio" id="checked-radio">
                                        <input type="radio" name="billing[{{ $customer_address->id }}]"
                                            :id="'billing_address_id_{{ $customer_address->id }}'"
                                            :value="{{ $customer_address->id }}" v-model="address.billing.address_id"
                                            data-vv-as="&quot;{{ __('shop::app.checkout.onepage.billing-address') }}&quot;"
                                            @change="validateForm('address-form')" />
                                        <label :for="'billing_address_id_{{ $customer_address->id }}'"
                                            class="radio-view px-2"></label>
                                        <!-- <label :for="'billing_address_id_' + addresses.id" class="radio-view px-2"></label> -->
                                    </div>
                                </div>
                                <div class="col-9 address-column">
                                    <h4 class="card-title fw6">Ordering From</h4>
                                    <!-- Button trigger modal -->
                                    <ul type="none" class="order-body">
                                        {{-- sandeep add id --}}
                                        {{-- <input type="hidden" id="Address_Id" name="Address_Id" --}}
                                        {{-- value="{{ $address->id }}" /> --}}
                                        <li class="airport_name" id="airport_name">
                                            {{ $customer_address->airport_name }}</li>
                                        <input type="hidden" id="selected_airport_id"
                                            value="{{ $airpport->airport_id??'' }}" />
                                        <li class="airport_fbo_id" hidden>{{$customer_address->airport_fbo_id}}</li>
                                        <li id="Airport_Address">{{ $customer_address->address1 }}</li>
                                        <li class="default_address" style="display:none">
                                            {{ $customer_address->default_address }}</li>
                                        <!-- <li v-text="addresses.state"></li>
                                        <li>
                                            <span v-text="addresses.country"></span>
                                            <span v-text="addresses.postcode"></span>
                                        </li> -->
                                        <!-- <li>{{ __('shop::app.customer.account.address.index.contact') }} : @{{ addresses.phone }}</li> -->
                                    </ul>
                                </div>
                                <div class="col-1">
                                    <span class="text-danger pointer Airport_Edit" id="Edit_Airport"
                                        data-toggle="modal" data-target="#exampleModal">edit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
           
        <div class="mt-2 text-break pl-4 pl-lg-3 mb-2 ml-lg-1  {{!isset($airpport) ? 'd-none' : ''}}" id="airport_fbo_details" type="none">
            <h5 class="child-card-title mb-0">Airport Fbo</h5>
            <p class="airport_fboName mb-0" id="AirportFbo_Name">{{ isset($airpport) ? $airpport->fbo_name : ''  }}</p>
        </div>

                            {{-- sandeep add fbo detail  --}}  
                             {{-- <div class='row mt-2 order-body pl-3 {{!isset($airpport) ? 'd-none' : ''}}' id="airport_fbo_details" type="none">
                                <div class='col-12'><h5 class="card-title child-card-title fw6">Airport Fbo</h5></div>
                                <div class='fbo-body px-3 mb-2'>
                                      <h6 class="ml-2" id="AirportFbo_Name">{{ isset($airpport) ? $airpport->fbo_name : ''  }}</h6>
                                    </div>
                                </div>  --}}
    </div>

    @if ($cart->haveStockableItems())
        <div class="form-container" v-if="! address.billing.use_for_shipping && ! this.new_shipping_address">

            <accordian :active="true" :title="'{{ __('shop::app.checkout.onepage.shipping-address') }}'">

                <div class="form-header mb-30" slot="header">
                    <h3 class="fw6 display-inbl">
                        {{ __('shop::app.checkout.onepage.shipping-address') }}
                    </h3>

                    <i class="rango-arrow"></i>
                </div>

                <div class="address-container row mb30 remove-padding-margin" slot="body">
                    <div class="col-lg-6 address-holder pl0" v-for='(addresses, index) in this.allAddress'>

                        <div class="card">
                            <div class="card-body row">
                                <div class="col-1">
                                    <div class="radio">
                                        <input type="radio" name="shipping[address_id]"
                                            :id="'shipping_address_id_' + addresses.id" :value="addresses.id"
                                            v-model="address.shipping.address_id" v-validate="'required'"
                                            data-vv-as="&quot;{{ __('shop::app.checkout.onepage.shipping-address') }}&quot;"
                                            @change="validateForm('address-form')" />

                                        <label :for="'shipping_address_id_' + addresses.id"
                                            class="radio-view"></label>
                                    </div>
                                </div>

                                <div class="col-10">
                                    <h5 class="card-title fw6"
                                        v-text="`${addresses.first_name} ${addresses.last_name}`"></h5>

                                    <ul type="none">
                                        <li v-text="addresses.address1"></li>
                                        <li v-text="addresses.city"></li>
                                        <li v-text="addresses.state"></li>
                                        <li>
                                            <span v-text="addresses.country"></span>
                                            <span v-text="addresses.postcode"></span>
                                        </li>
                                        <li>{{ __('shop::app.customer.account.address.index.contact') }} :
                                            @{{ addresses.phone }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 address-holder pl0">
                        <div class="card">
                            <div @click="validateFormAfterAction" class="card-body add-address-button">
                                <div class="cursor-pointer" @click="newShippingAddress()">
                                    <i class="material-icons">
                                        add_circle_outline
                                    </i>

                                    <span>{{ __('shop::app.checkout.onepage.new-address') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        :class="`col-12 mt15 has-error pl0 ${errors.has('address-form.shipping[address_id]') ? 'has-error' : ''}`">
                        <span class="control-error" v-if="errors.has('address-form.shipping[address_id]')"
                            v-text="errors.first('address-form.shipping[address_id]')"></span>
                    </div>
                </div>
            </accordian>
        </div>

        <div class="form-container" v-if="! address.billing.use_for_shipping && this.new_shipping_address">

            <accordian :active="true" :title="'{{ __('shop::app.checkout.onepage.shipping-address') }}'">

                <div class="form-header" slot="header">
                    <h3 class="fw6 display-inbl">
                        {{ __('shop::app.checkout.onepage.shipping-address') }}
                    </h3>

                    <i class="rango-arrow"></i>
                </div>

                <div class="col-12 no-padding" slot="body">
                    @auth('customer')
                        @if (count(auth('customer')->user()->addresses))
                            <a class="theme-btn light float-right text-up-14" @click="backToSavedShippingAddress()">

                                {{ __('shop::app.checkout.onepage.back') }}
                            </a>
                        @endif
                    @endauth

                    @include('shop::checkout.onepage.customer-new-form', ['shipping' => true])
                </div>
            </accordian>
        </div>
    @endif
</form>

@push('scripts')
    
    <script>

      // Sandeep: Show all airport and FBO data
        var airportsData = @json(isset($Airports) ? $Airports : []);
        var airportsFboData = @json(isset($AirportsFbo) ? $AirportsFbo : []);
        var defaultAddressId = @json(isset($defaultAddress->id) ? $defaultAddress->id : 0);
        var isAuthenticated = @json(auth('customer')->check());
        
        var airport_id = 0;
        @if (isset($airport_id))
        airport_id = {{ $airport_id->id }};
        @endif
        // 

        jQuery(document).ready(function() {
            
            $('body').on('click','#acknowledge_checkbox',function(){
                if (isAuthenticated) {
                    console.log('user is login');
                }else{
                    console.log('user not login');
                }
            });



            console.log('checkout page');

            // sandeep auto select last address in multiple address
            function checkElement(selector, callback) {
                var observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if ($(selector).length > 1) {
                            callback();
                            observer.disconnect(); // Stop observing once the element is found
                        }
                    });
                });

                // Start observing the target node for mutations
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }


            checkElement('.Billing_Address_button', function() {
                if ($('body').find('.Billing_Address_button').length > 1) {
                    // sandeep add code 
                    var airport_fbo_id = $('.Billing_Address_button:checked').closest(".row").find(".airport_fbo_id").text();
                    if (defaultAddressId) {
                        var defaultAddress = jQuery('#billing_address_id_' + defaultAddressId);
                        defaultAddress.click();
                    } else {
                        var lastAddressData = $('#address-container #checked-radio input').last();
                        lastAddressData.click();
                    }
                    var airport_name = $('.edit-airport').closest(".row").find("ul .airport_name").text();
                }
            });


            // sandeep  add fbo detail 
            jQuery('body').on('click', '.edit-airport', function() {

                var airport_name = $(this).closest(".row").find("ul .airport_name").text();
                var airport_id = $(this).closest(".row").find("input[type='radio']").val();
                // var fbo_name = $(this).closest(".row").find("#AirportFbo_Name").text();
                var airport_fbo_id = $(this).closest(".row").find(".airport_fbo_id").text();
                var addresses_id = $(this).closest(".row").find(".address_Id").text();
                var fbo_name = $(this).closest(".row").find("ul #AirportFbo_Name").text();
                //console.log('fbo_name',fbo_name);
                // Update the input fields with the selected airport data
                $('#auto_search').val(airport_name);
                $('#auto_search').attr('data', addresses_id);

                // sandeep get airport id
                // Compare the selected airport name with the airport data and set the airport ID
                var matchedAirport = airportsData.find(airport => airport.name === airport_name);
                if (matchedAirport) {
                    $('#auto_search').attr('attr', matchedAirport.id);
                    // $('#Airports_Id').val(matchedAirport.id);
                }

                // // sandeep get fbo name 
                // var matchedAirportFbo = airportsFboData.find(airportFbo => airportFbo.id == airport_fbo_id);
                if (fbo_name) {
                    $('#airport-fbo-input').val(fbo_name);
                    $('#airport-fbo-input').attr('attr',fbo_name);
                    // $('#AirportFbo_Name').text(matchedAirportFbo.name);
                } else {
                    $('#airport-fbo-input').val('');
                }
                
            });


            // sandeep  check auto search and fbo input and enable button
            jQuery('body').on('click', '#Edit_Airport', function() {
                // sandeep check airport name and fbo input 
                var airport_fbo_id = $(this).closest(".row").find(".airport_fbo_id").text();
                $('#selected-fbo-id').val(airport_fbo_id);  
                var name = jQuery('#auto_search').val();
                var airportFbo = jQuery('#airport-fbo-input').val();
                var airportFboiD = jQuery('#selected-fbo-id').val();
                // Disable the button if both inputs are empty
                if (name === "" || airportFbo === "") {
                    jQuery('#address_update').prop('disabled', true);
                } else {
                    jQuery('#address_update').prop('disabled', false);
                }
            });



            //sandeep show aiport fbo
            jQuery('body').on('click', '.Billing_Address_button', function() {
                //console.log('sandeeo click redio buttton');
                var airport_fbo_id = $(this).closest(".row").find(".airport_fbo_id").text();
                var addresses_id = $(this).val();
                // if (airport_fbo_id == '' || airport_fbo_id === '0') {
                //     $('#airport_fbo_details').addClass('d-none');
                //     $('#AirportFbo_Name').text("");
                // } else {
                //     $('#airport_fbo_details').removeClass('d-none');
                // }

                // var matchedAirportFbo = airportsFboData.find(airportFbo => airportFbo.id == airport_fbo_id);
                // if (matchedAirportFbo) {
                //     $('#AirportFbo_Name').text(matchedAirportFbo.name);
                // }else{
                //     $('#AirportFbo_Name').text("");
                // } 

                var acknowledge_checkbox = $('#acknowledge_checkbox');

                var isAcknowledgeChecked = acknowledge_checkbox.prop('checked'); 
                var fbo_name = $('#airport_fbo_details').find('#AirportFbo_Name').text().trim();
                // var isButtonChecked = $(this).prop('checked');

                if (isAcknowledgeChecked && paymentsaved && fbo_name !== "") {
                    $('#checkout-place-order-button').prop('disabled', false);
                } else {
                    $('#checkout-place-order-button').prop('disabled', true); 
                }

                // sandeep update default addresss at 
                // here when ajax hit then create airport or update
                $.ajax({
                    url: "{{ route('shop.home.create') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "addresses_id": addresses_id,
                        'type': 'Update_Fbo_Billing',
                    },
                    success: function(result) {
                        
                    }

                });


            });

            if (window.location.pathname == '/') {
                jQuery('#home-right-bar-container').hide();
            }

            var islogin = '<?php echo $islogin; ?>';
            var customer_token = '<?php echo $guestToken; ?>';
            var customerArray = <?php echo json_encode($airportArr); ?>;

          // sandeep ||add timeout code for airport list search
             let typingTimer;
            const typingDelay = 500;
            jQuery('body').on('keyup click', '#auto_search', function() {
                var name = jQuery(this).val();
                clearTimeout(typingTimer); 
                // here when ajax hit then show airport  
                jQuery('#checkout_airport-fbo-list').hide();
                if ($.inArray(name, customerArray) === -1) {
                    jQuery('#address_update').prop('disabled', true);
                }
 
                typingTimer = setTimeout(function() {
                $.ajax({
                    url: "{{ route('shop.home.index') }}",

                    type: 'GET',
                    data: {
                        'name': name,
                        'type': 'address_search'
                    },
                    success: function(result) {
                        //console.log(result);
                        jQuery("#address-list").html(result);
                    }
                });

            }, typingDelay);

            })



            jQuery('body').on('click', 'li', function() {
                // sandeep
                $('#airport-fbo-input').val('');
                $('#checkout_airport-fbo-list').hide();
                var airportFbo = jQuery('#airport-fbo-input').val();
                var fbo_id = jQuery("#selected-fbo-id").val();
                if (airportFbo && fbo_id != '') {
                    jQuery('#address_update').prop('disabled', false);
                }

                var name = jQuery(this).attr('data-attr');
                var airport_id = jQuery(this).attr('attr');
                var input_val = jQuery("#auto_search").val(name);
                // sandeep 
                airport_id = jQuery(this).attr('attr');
                jQuery("#auto_search").attr('attr', airport_id);
                jQuery("#auto_search").val(name);


                jQuery("#address-list").html("");

            });

            //  sandeep update address detail  
            jQuery('body').on('click', '#address_update', function() {
console.log('click address button');
                var fbo_id = jQuery("#selected-fbo-id").val();
                var airport_id = jQuery('#auto_search').attr('attr');
                var delivery_address = jQuery("#auto_search").val();
                var address_Id = jQuery("#auto_search").attr('data');
                // fbo 
                var name = jQuery("#airport-fbo-input").val();
                //sandeep 
                if (delivery_address === '' || name === '' || fbo_id === '') {
                    jQuery('#address_update').prop('disabled', true);
                    e.preventDefault();
                    return false;
                }

                let originalContent = $(this).html();
                $(this).css('min-width', $(this).outerWidth());
                $(this).html('<span class="btn-ring"></span>');
                $(this).find(".btn-ring").show();
                $(this).find('.btn-ring').css({
                    'display': 'flex',
                    'justify-content': 'center',
                    'align-items': 'center'
                });

                jQuery("#airport-fbo-input").attr('value', name);

                var csrfToken = jQuery('meta[name="csrf-token"]').attr('content');

                // here when ajax hit then create airport or update
                $.ajax({
                    url: "{{ route('shop.home.create') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'islogin': islogin,
                        'delivery_address': delivery_address,
                        'airport_id': airport_id,
                        'update_airport_id': jQuery('#airport_id').val(),
                        'selected_fbo_id': fbo_id,
                        'address_id': address_Id,
                        'customer_token': customer_token
                    },

                    success: function(result) {

                        //console.log(result);
                        var airportId = result.data.id;        
                        location.reload();
                        window.flashMessages = [{
                            'type': 'alert-success',
                            'message': 'Updated'
                        }];
                    },
                    error: function(xhr, status, error) {
                    if (xhr.status === 419) {
                        window.location.href = '/';
                    }
               }
                });
            });

            
            $(document).on('click', '.custom-option', function() {
                var selectedText = $(this).find('.airport-name').text().trim();
                var selectedId = $(this).data('id');
                // Check if selectedId is "abc" and return early if it is
                if ($(this).attr('id') === 'option_id') {
                    $('#checkout_airport-fbo-list').hide();
                    // sandeep
                    return;
                }
                $('#airport-fbo-input').val(selectedText);
                $('#airport-fbo-input').data('selected-id', selectedId);
                $('#selected-fbo-id').val(selectedId); // Store the selected ID in the hidden input
                $('#checkout_airport-fbo-list').hide();

                // sandeep
                jQuery('#address_update').prop('disabled', false);

            });

            jQuery('body').on('click', '#airport-fbo-input', function() {
                if (jQuery('.custom-dropdown-list').css('display') == 'block') {
                    return;
                }
                
                var airport_id = jQuery('#auto_search').attr('attr');
                $('#checkout_airport-fbo-list').toggle();
                // If an airport_id is present, make the AJAX call
                if (airport_id) {
                    $.ajax({
                        url: "{{ route('shop.home.index') }}",
                        method: 'GET',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'airport_id': airport_id,
                            'type': 'airport_fbo_detail'
                            },
                            success: function(response) {
                            //console.log(response.options);
                            if (response.options) {
                                $('#checkout_airport-fbo-list').removeClass('d-none');
                                $("#checkout_airport-fbo-list").html(response.options);
                            }
                        },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                            }
                    });
                }
            });


            jQuery('body').on('click', '#add-fbo-button', function(event) {
                event.preventDefault();
                let originalContent = $(this).html();
                $(this).html('<span class="btn-ring"></span>');
                $(this).find(".btn-ring").show();

                let airport_id = jQuery('#auto_search').attr('attr');
                let input_airport_id = $('#input_airport_id').val();
                let address_Id = jQuery("#auto_search").attr('data');
                //console.log('dsad', address_Id);
                let fboName = $('#fbo-name').val();
                let fboaddress = $('#fbo-address').val();
                let fboNotes = $('#fbo-notes').val();

                if (airport_id || input_airport_id) {
                    $.ajax({
                        url: "{{ route('shop.home.fbo-details.store') }}",
                        method: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'name': fboName,
                            'address': fboaddress,
                            'notes': fboNotes,
                            'address_Id': address_Id,
                            'airport_id': airport_id || input_airport_id, // Use || for fallback

                        },
                        success: function(response) {
                            $('#airport-fbo-input').val(response.data.name);
                            $('#selected-fbo-id').val(response.data.id);
                            var fboId = $('#selected-fbo-id').val();
                            // sandeep search disabled button
                            if (fboId === "") {
                                jQuery('#address_update').prop('disabled', true);
                            } else {
                                jQuery('#address_update').prop('disabled', false);
                            }
                            if (response.response) {
                                resetFormFields();
                                // updateFboDetails(response.data);

                            }
                            $('#add-fbo-button').html(originalContent);
                            $('.btn-ring').hide();
                        },
                        error: function(xhr,status,error) {
                            if (xhr.status === 422) {
                                $('#add-fbo-button').prop('disabled',true);
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    $('#' + key + '-error').text(value[0]);
                                });
                            }
                            // sandeep add code
                            if (xhr.status === 419) {
                                window.location.href = '/';
                            }
                            $('#add-fbo-button').html(originalContent);
                            $('.btn-ring').hide();
                        }
                    });
                }
            });
            

            // sandeep ||add code 
            $('body').on('click','.modal_open_button',function(){
                $('#add-fbo-button').prop('disabled',true);
            });


            // sandeep hide airport list after click
            $('body').on('click', '.close', function() {
                $('#checkout_airport-fbo-list').hide();
                $('.modal-backdrop').removeClass('modal-backdrop fade');
            });



            // sandeep || open modal code
            jQuery('body').on('click','.modal_open_button',function(){
             $('#exampleModalCenter').on('show.bs.modal', function (event) {
                    $('#exampleModalCenter').addClass('show');
                    $('.modal-backdrop').remove();
                    if (!$('.modal-backdrop.fade.show').length) {
                    $('<div>', {
                        class: 'modal-backdrop fade show'
                    }).appendTo('body');
                    }
                    if (!$('.modal-backdrop.fade.in').length) {
                        $('<div>', {
                            class: 'modal-backdrop fade in'
                        }).appendTo('body');
                    }

               })
                $('#exampleModalCenter').on('shown.bs.modal', function (event) {
                    $('body').addClass('modal-open');
               })
            });

            //Function to reset form fields
            function resetFormFields() {
                $('#fbo-name, #fbo-address, #fbo-notes').val('');
                $('.fboClose').click();
                $('#exampleModalCenter').removeClass('show').css('display', 'none');
                $('#exampleModalCenter').on('hidden.bs.modal', function (event) {
                  $('body').addClass('modal-open'); 
                });
           }

            jQuery('body').on('click', '#add_airport_fbo', function() {
                var delivery_address = jQuery("#auto_search").val();
                var csrfToken = jQuery('meta[name="csrf-token"]').attr('content');
                airportFbo(jQuery(this).data('id'));
            });
        });
                
        // sandeep add code
            $(document).on('click', 'body, .fboClose', function() {
            $('#exampleModalCenter').on('hidden.bs.modal', function (event) {
                    $('body').addClass('modal-open');
            })
        });

            // sandeep || check erorr in fbo model and stop form submitting
                $('body').on('click', '.fbo_Info', function(event) {
                    var hasError = false;
                    $('.control-group').each(function() {
                        var errorText = $(this).find('.control-error').text();
                        if (errorText.trim() !== '') {
                            hasError = true; 
                        }
                    });
                    if (hasError) {
                        event.preventDefault();
                    }else{
                        $(this).html('<span class="btn-ring"></span>');
                        $(this).find(".btn-ring").show();
                        $(this).find('.btn-ring').css({
                        'display': 'flex',
                        'justify-content': 'center',
                        'align-items': 'center'
                    });
                    }
                });

    </script>
@endpush
