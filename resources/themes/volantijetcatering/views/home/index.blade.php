@extends('shop::layouts.master')

@inject ('productRatingHelper', 'Webkul\Product\Helpers\Review')

@php
    $channel = core()->getCurrentChannel();
    $homeSEO = $channel->home_seo;

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    {{ $metaTitle ?? '' }}
@endsection

@section('head')
    @if (isset($homeSEO))
        @isset($metaTitle)
            <meta name="title" content="{{ $metaTitle }}" />
        @endisset

        @isset($metaDescription)
            <meta name="description" content="{{ $metaDescription }}" />
        @endisset

        @isset($metaKeywords)
            <meta name="keywords" content="{{ $metaKeywords }}" />
        @endisset
    @endif

    <link rel="canonical" href="{{ url()->current() }}">

    
@endsection

@push('css')
    @if (!empty($sliderData))
        <link rel="preload" as="image" href="{{ Storage::url($sliderData[0]['path']) }}">
    @else
        <link rel="preload" as="image" href="{{ asset('/themes/velocity/assets/images/banner.webp') }}">
    @endif

    <style type="text/css">
        .product-price span:first-child,
        .product-price span:last-child {
            font-size: 18px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content-wrapper')
    {{-- @include('shop::home.slider') --}}
@endsection

@section('full-content-wrapper')
    <div class="full-content-wrapper">
        {!! view_render_event('bagisto.shop.home.content.before') !!}

        @if ($velocityMetaData)
            {!! Blade::render($velocityMetaData->home_page_content) !!}
            <div class="modal fade add_fbo_modal" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalCenterTitle">
                                <img class="Navigation-image"
                                    src="{{ asset('themes/volantijetcatering/assets/images/home/store.svg') }}"
                                    alt="store image" />
                                Add New 
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
                                    <!-- <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span> -->
                                    <span class="control-error" id="name-error">
                                </div>
                                <div class="input_wrapper">
                                    <label for="fbo-address" class="mandatory">Address</label>
                                    <textarea v-validate="'required'" class="control" id="fbo-address" name="address" rows="5"></textarea>
                                    <!-- <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span> -->
                                    <span class="control-error" id="address-error">
                                </div>
                                <div class="input_wrapper">
                                    <label for="fbo-notes">Notes (Optional)</label>
                                    <textarea class="control" id="fbo-notes" name="notes" rows="5"></textarea>
                                    <!-- <span class="control-error" v-if="errors.has('notes')">@{{ errors.first('notes') }}</span> -->
                                    <span class="control-error" id="notes-error">
                                </div>

                                <button id="add-fbo-button">
                                    <img class='suggestion-icon'
                                        src='/themes/volantijetcatering/assets/images/home/plus-circle1.svg' alt="plus circle image">
                                    ADD</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="custom-enquiry-banner py-5">
                <div class="decorative-circle"></div>
                <div class="container text-center">
                    <h2>Need Assistance?</h2>
            
                    <p>
                        Our dedicated team is here to help with your aviation catering needs. Whether you have questions about our services, special dietary requirements, or need to make a custom order, we're just a click away.
                    </p>
                    
                    <div class="feature-list">
                        <div class="feature-item">
                            <div>24/7 Support</div>
                            <div>Always available for you</div>
                        </div>
                        
                        <div class="feature-item">
                            <div>Custom Solutions</div>
                            <div>Tailored to your needs</div>
                        </div>
                        
                        <div class="feature-item">
                            <div>Quick Response</div>
                            <div>Fast and efficient service</div>
                        </div>
                    </div>
                    
                   <div class="enquiry-button">
                    <a href="{{ route('show.inquery') }}" class="custom-enquiry-button custom-link">
                        Custom Enquiry
                    </a>
                </div>
                </div>
                
            </div>
            <div class="custom-enquiry-banner-botom"></div>
            
        @else
            @include('shop::home.advertisements.advertisement-four')
            @include('shop::home.featured-products')
            @include('shop::home.advertisements.advertisement-three')
            @include('shop::home.new-products')
            @include('shop::home.advertisements.advertisement-two')
        @endif

        {{ view_render_event('bagisto.shop.home.content.after') }}
    </div>
@endsection
