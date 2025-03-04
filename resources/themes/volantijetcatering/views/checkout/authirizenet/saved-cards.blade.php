@php
    $cards = collect();
    if(auth()->guard('customer')->check()) {
        $customer_id = auth()->guard('customer')->user()->id;
        $cards = app('Webkul\MpAuthorizeNet\Repositories\MpAuthorizeNetRepository')->findWhere(['customers_id' => $customer_id]);
    }
    
@endphp

@if(auth()->guard('customer')->check())
    <div class="mpauthorizenet-cards-block" id="saved-cards" style="padding-left: 27px; margin-bottom:10px; display:block;">
        <div class="control-info mt-10 mb-10">
            @foreach($cards as $card)
                    <div class="authroizenet-card-info" id="{{ $card->id }}">
                        <label class="radio-container">
                            <input type="radio" name="saved-card" class="saved-card-list" id="{{ $card->id }}" value="{{ $card->id }}" @if($card->is_default == '1') checked="checked" @endif>
                            <span class="checkmark"></span>
                        </label>
                        <span class="icon currency-card-icon"></span>
                        <span class="card-last-four" style="margin-left:16px;"> {{ $card->last_four }}</span>
                        <a id="delete-card" style="color: #ff0000 !important; cursor: pointer;" data-id="{{ $card->id }}">{{ __('mpauthorizenet::app.delete') }}</a>
                    </div>
            @endforeach
        </div>
    </div>
@endif