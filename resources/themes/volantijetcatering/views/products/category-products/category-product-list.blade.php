<div id="product-list">
@foreach ($categoryproducts as $categoryproduct)

    <div class="container product-card-new product-custom-class product-item" data-name="{{ strtolower($categoryproduct['name']) }}">
        {{-- <form class="product-form" action="{{ route('shop.cart.add', ['id' => $categoryproduct['id']]) }}" method="POST"> --}}
        <div class="row my-4 ml-0">
            {{-- @csrf --}}

            <div class="col-10 p-md-0 p-lg-0">
                <div class="product-name no-padding custom-product-name ">
                    <span class="fs16" id = "ProductName">{{ $categoryproduct['name'] }}</span>
                    <br />
                    <p>{{ $categoryproduct['description'] }}</p>
                    @if ($categoryproduct['isSaleable'])
                    @if ($categoryproduct['type'] == 'simple')
                    <a id="category_instructions" data-toggle="collapse" class="m-0"
                        href="#category_instructions_Div{{ $categoryproduct['id'] }}" role="button" aria-expanded="false"
                        aria-controls="category_instructions_Div">Special Instructions
                        (optional)
                        +</a>
                    <div class="collapse multi-collapse mt-2 mb-2" id="category_instructions_Div{{ $categoryproduct['id'] }}">
                        <div id="category_instructions_Div" class="">
                            <textarea id="textarea-customize" name="special_instruction"></textarea>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>

            <div class="AddToCartButton col-2 mt-0 mt-lg-2 mt-md-2 p-md-0 p-lg-0 pt-2">
                <input type="hidden" name="product_id" value="{{ $categoryproduct['id'] }}" id="ProductId">
                @if ($categoryproduct['isSaleable'])
                    @if ($categoryproduct['type'] == 'simple')
                    <quantity-changer
                    :product-id="{{ $categoryproduct['id'] }}"
                    :quantity-id="'quantity_' + {{ $categoryproduct['id'] }}"
                    quantity-text="{{ __('shop::app.products.quantity') }}">
                  </quantity-changer>
                  
                     <div id="quantityError_{{ $categoryproduct['id'] }}_{{$cate_id}}" class="text-danger quantityError_message" style="color: red"></div>

                        <div class="AddButton text-center">
                            <button type="submit" class="add_button" id="AddToCartButton" data="{{$categoryproduct['type']}}" attr="{{$cate_id}}">Add</button>
                            <span id="successMessage_{{ $categoryproduct['id'] }}_{{$cate_id}}" class="text-success successMessage"></span>
                        </div>
                    @else
                        <div class="configurable_product">
                            <div class="AddButton text-center">
                                <input type="hidden" id="slug" value="{{ $categoryproduct['slug'] }}">
                                <button type="button" data-toggle="modal" data-target="#exampleModal{{ $categoryproduct['id']}}_{{$cate_id}}" class="OptionsAddButton"
                                    id="AddToCartButtonpopup">Add</button>
                                <span class="customisable">Customisable</span>
                                <br>
                                {{-- @dd($cate_id); --}}
                                <span id="successMessage_{{ $categoryproduct['id'] }}_{{$cate_id}}" class="text-success successMessage" style="display: none;"></span>
                                
                            </div>
                            <!-- Modal -->
                            <div class="modal custom_modal fade" id="exampleModal{{ $categoryproduct['id']}}_{{$cate_id}}" data="{{ $categoryproduct['id']}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered " role="document">
                                    <div class="modal-content pb-3">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add To Cart</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="fs16 ProductName" id = "ProductName">{{ $categoryproduct['name'] }}</span>
                                            <br />
                                            <p class="description">{{ $categoryproduct['description'] }}</p>
                                            <quantity-changer
                                            :product-id="{{ $categoryproduct['id'] }}"
                                            :quantity-id="'quantity_' + {{ $categoryproduct['id'] }}"
                                            quantity-text="{{ __('shop::app.products.quantity') }}">
                                          </quantity-changer>
                                          
                                            {{-- <quantity-changer quantity-text="{{ __('shop::app.products.quantity') }}"></quantity-changer> --}}
                                            <div id="quantityError_{{ $categoryproduct['id'] }}_{{$cate_id}}" class="text-danger quantityError_message" style="color: red"></div>
                                            <div class="variant__option"></div>
                                        </div>

                                        
                                            <button type="submit" class="add_button OptionsAddButton mx-auto" data="{{$categoryproduct['type']}}" id="Add_Button_Popop" attr="{{$cate_id}}">Add</button>
                                            {{-- <span id="successMessage" class="text-success" style="display: none;"></span> --}}

                                    </div>
                                </div> 
                            </div>
                        </div>
                    @endif
                @else
                    <div class="AddButton text-center p-md-0 p-lg-0">
                        <button type="submit" class="stockoutButton" disabled>Out of stock</button>
                    </div>
                @endif

            </div>
        </div>
        {{-- </form> --}}
    </div>
@endforeach

</div>
