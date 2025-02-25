//.........................add-to-cart and quantity fixed position view......................//


jQuery(window).scroll(function () {

    if (
        /Android|webOS|iPhone|BlackBerry|IEMobile|Opera Mini|ipad|Tablet/i.test(
            navigator.userAgent
        )
    ) {
        var offsetY = jQuery(window).scrollTop();
        if (offsetY >= 300) {
            jQuery("#scroll").removeClass("fixed-add-to-cart");
        } else {
            jQuery("#scroll").addClass("fixed-add-to-cart");
        }
    }
});


//......................... mini-cart slide-open......................//

jQuery("body").on("click", "#mini-cart", function () {
    if (!jQuery("#cart-modal-content").hasClass("hide")) {
        jQuery("#cart-modal-content").toggleClass("slide-cart-modal");
    }
});

/* close mini cart on outside click*/
jQuery("body").on("click", function (event) {
    if (
        !jQuery("#cart-modal-content").is(event.target) &&
        jQuery("#cart-modal-content").has(event.target).length === 0
    ) {
        jQuery("#cart-modal-content").removeClass("slide-cart-modal");
    }
});
/* end close mini cart on outside click*/

jQuery("body").on("click", "#close-btn", function () {
    jQuery("#cart-modal-content").removeClass("slide-cart-modal");
});

jQuery("body").on("click", "#small-mini", function () {
    jQuery("#cart-modal-content").toggleClass("slide-cart-modal");
});

jQuery("body").on("click", "#button-1", function () {
    jQuery(".button-1").addClass("btn-login");
    jQuery(".button-2").removeClass("btn-login");
    jQuery(".login-form").removeClass("display-none");
    jQuery(".register-form").addClass("display-none");
});
jQuery("body").on("click", "#button-2", function () {
    jQuery(".button-2").addClass("btn-login");
    jQuery(".button-1").removeClass("btn-login");
    jQuery(".register-form").removeClass("display-none");
    jQuery(".login-form").addClass("display-none");
});

function togglePopup() {
    var popup = document.getElementById("popup");
    popup.style.display =
        popup.style.display === "none" || popup.style.display === ""
            ? "block"
            : "none";
}


jQuery(document).ready(function () {
    function checkElement(selector, callback) {
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if ($(selector).length > 0) {
                    callback();
                    observer.disconnect(); // Stop observing once the element is found
                }
            });
        });

        // Start observing the target node for mutations
        observer.observe(document.body, { childList: true, subtree: true });
    }


    checkElement('.default_address', function () {
        if ($('body').find('.default_address').length == 1) {
            $('#checked-radio').parent().hide();
            $('#Edit_Airport').parent().removeClass('col-1').addClass('col-3 text-right pr-1 pr-lg-3 pr-md-3');
            $('.address-column').removeClass('col-9').addClass('col-9');
            $('#address-section').find('.custom-form').removeClass('pl-3');
            $('.address-container  #checked-radio input').click();
        } else {
            // Your code to run after the element is added to the DOM
            $('.default_address:contains("true")').each(function () {
                $(this).closest(".row").find("ul .airport_name").text();
                $(this).closest(".row").find('input[type="radio"]').click();
            });
        }
    });


    /* open add*/

    jQuery("body").on("click", ".open_app", function () {
        // Attempt to open the app's custom URL
        window.location.href = 'com.volantiscottsdale.app.volanti://';

        // Set a timeout to check whether the app was successfully opened
        setTimeout(function () {
            // If the code reaches here, the app is likely not installed
            alert('The app is not installed on this device.');
        }, 1000); // Adjust the timeout duration as needed
    });

});

// sandeep commnet code
// $('body').on('click', '#checkout-place-order-button', function () {
    
//     $(this).prop('disabled', true);
//     $(this).html('<span class="btn-ring"></span>');
//     $(".btn-ring").show();
//     $(this).val('disabled');
//     setTimeout(function () {
//         $(".btn-ring").hide();
//         $(this).prop('disabled', false);
//     }, 50000);
// });


$(document).ready(function () {

    var address_checkbox = $('.address-container input[type="radio"]');

    // sandeep delete code && $('#airport-fbo-input').val() !== ''
    $('body').on('change', '#acknowledge_checkbox', function () {
        // sandeep add code
        var fbo_name = $('#airport_fbo_details').find('#AirportFbo_Name').text();
        //console.log('fbo_name',fbo_name);
        if ($(this).is(':checked') && address_checkbox && fbo_name !== "") {
            $('#checkout-place-order-button').prop('disabled', false);
        } else {
            $('#checkout-place-order-button').prop('disabled', true);
        }
    });


    $('body').on('click', '.register-form .register-btn', function () {

        $(this).prop('disabled', true);
    });

    $('body').on('click', '#daySelect', function () {
        $('.delivery_select_date').toggle();
    })
    $('body').on('click', '#dayList li', function () {
        //console.log($(this).text());
        $('#daySelect').val($(this).text());
        $('.delivery_select_date').hide();
        // sandeep || add code for remove erorr from delivery date input 
        $('#daySelect').closest('.control-group').removeClass('has-error');
        $('#daySelect').closest('.control-group').find('.control-error').addClass('d-none');


        const form = $(this).closest('form');
        let allEmpty = true;
        let hasError = false;
        const fields = form.find('.control, .control-group input, select');
        fields.each(function () {
            const fieldValue = $(this).is('select') ? $(this).find('option:selected').val() : $(this).val();
            const errorVisible = $(this).siblings('.control-error:visible').length > 0;

            if (fieldValue.length === 0 || parseFloat(fieldValue) <= 0 || errorVisible) {
                hasError = true;
            } else {
                allEmpty = false;
            }
        });

        const buttonDisabled = allEmpty || hasError;
        form.find('.fbo_detail_button').prop('disabled', buttonDisabled);


        var val = $('#selected-fbo-id').val();
        //console.log(val);

        if ($('#auto_search').val() != '' && $('#timeSlots').val() != '' && $('#selected-fbo-id').val() != '') {
            jQuery('#address_btn').prop('disabled', false);
            jQuery('.search-button').prop('disabled', false);
        }
    });


    $('body').on('click', '#timeSlots', function () {
        $('.delivery_select_time').toggle();
    })
    $('body').on('click', '#timeSlotsList li', function () {
        //console.log($(this).text());
        $('#timeSlots').val($(this).text());
        $('.delivery_select_time').hide();

        // sandeep || add code for remove erorr from delivery time input 
        $('#timeSlots').closest('.control-group').removeClass('has-error');
        $('#timeSlots').closest('.control-group').find('.control-error').addClass('d-none');


        const form = $(this).closest('form');
        let allEmpty = true;
        let hasError = false;
        const fields = form.find('.control, .control-group input, select');
        fields.each(function () {
            const fieldValue = $(this).is('select') ? $(this).find('option:selected').val() : $(this).val();
            const errorVisible = $(this).siblings('.control-error:visible').length > 0;

            if (fieldValue.length === 0 || parseFloat(fieldValue) <= 0 || errorVisible) {
                hasError = true;
            } else {
                allEmpty = false;
            }
        });

        const buttonDisabled = allEmpty || hasError;
        form.find('.fbo_detail_button').prop('disabled', buttonDisabled);


        if ($('#auto_search').val() != '' && $('#daySelect').val() != '' && $('#selected-fbo-id').val() != '') {
            jQuery('#address_btn').prop('disabled', false);
            jQuery('.search-button').prop('disabled', false);
        }
    });



    var date = new Date(new Date().toLocaleString("en-US", { timeZone: "America/Los_Angeles" }));
    var days = [];

    // Get the year, month, and day
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);

    // Format the date

    var formattedDate = year + '-' + month + '-' + day;
    //console.log(formattedDate);
    for (var i = 0; i < 14; i++) {
        if (i == 0) {
            days.push({
                text: "Today",
                value: formattedDate,
            });
        } else {
            date.setDate(date.getDate() + 1);
            if (date.getDate() == 1 && i != 1) {
                date.setDate(1);
            }
            days.push({
                text: (i == 1 ? "Tomorrow" : (date.toLocaleDateString('default', {
                    weekday: 'long'
                }) + " " + (date.getMonth() + 1) + "/" + date.getDate())),
                value: date.toISOString().split('T')[0] // Extract only the date part
            });
        }
    }
    setTimeout(() => {
        $.each(days, function (index, day) {

            $('#dayList').append($('<li>', {
                value: day.value,
                text: day.text
            }));

        });
    }, 2000)

    //console.log($('#dayList').length, 'check');

    $('body').on('click', '#dayList li', function () {
        //console.log('dddd111');
        showTimeSlots();
    })

    // sandeep add code
    $('body').on('click', '#timeSlots', function () {
        showTimeSlots();
    })

    showTimeSlots(); // Show time slots by default
});

// function showTimeSlots() {

//     var selectedDay;
//     var timeSlotsSelect = $('#timeSlots');
//     timeSlotsSelect.empty();

//     if (!$('#daySelect').val() || $('#daySelect').val() === 'Today') {
//         selectedDay = new Date(); // Use current date
//     } else if ($('#daySelect').val() === 'Tomorrow') {
//         var date = new Date();
//         date.setDate(date.getDate() + 1); // Add 1 day to get tomorrow's date
//         selectedDay = date;
//     } else {
//         selectedDay = parseCustomDate($('#daySelect').val());
//     }

//     var startDate = new Date(selectedDay);
//     if (selectedDay.toDateString() === new Date().toDateString()) {
//         var currentHour = startDate.getHours();
//         var currentMinute = startDate.getMinutes();
//         var currentSlotTime = Math.ceil(currentMinute / 15) * 15;
//         startDate.setHours(currentHour, currentSlotTime, 0, 0);
//     } else {
//         startDate.setHours(0, 0, 0, 0);
//     }

//     var currentDate = new Date(startDate);
//     var endDate = new Date(startDate);
//     endDate.setHours(23, 59, 59, 999);

//     $('#timeSlotsList li').remove();
//     while (currentDate <= endDate) {
//         var hours = currentDate.getHours();
//         var minutes = currentDate.getMinutes().toString().padStart(2, '0');
//         var amPm = hours >= 12 ? "PM" : "AM";
//         hours = hours % 12;
//         hours = hours ? hours : 12; // the hour '0' should be '12'
//         var timeValue = hours + ":" + minutes + " " + amPm;

//         $('#timeSlotsList').append($('<li>', {
//             label: timeValue,
//             text: timeValue,
//         }));

//         currentDate.setMinutes(currentDate.getMinutes() + 30); // Increment by 30 minutes
//     }
// }


function showTimeSlots() {
    var selectedDay;
    var timeSlotsSelect = $('#timeSlots');
    timeSlotsSelect.empty();

    if (!$('#daySelect').val() || $('#daySelect').val() === 'Today') {
        selectedDay = new Date(); // Use current date
    } else if ($('#daySelect').val() === 'Tomorrow') {
        var date = new Date();
        date.setDate(date.getDate() + 1); // Add 1 day to get tomorrow's date
        selectedDay = date;
    } else {
        selectedDay = parseCustomDate($('#daySelect').val());
    }

    // Convert selectedDay to PST (America/Los_Angeles timezone) manually
    var options = {
        timeZone: 'America/Los_Angeles',
        hour12: true,
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
    };

    // Get formatted string in PST
    var pstDateString = selectedDay.toLocaleString('en-US', options);
    var newDateString = new Date().toLocaleString('en-US', options);

    // Create a new Date object using the PST string
    var selectedDayPST = new Date(pstDateString);
    var newDatePST = new Date(newDateString);

    var startDate = new Date(selectedDayPST);

    // Adjust time for Today or Tomorrow logic
    if (selectedDayPST.toDateString() === newDatePST.toDateString()) {
        console.log('1');
        var currentHour = startDate.getHours();
        var currentMinute = startDate.getMinutes();
        var currentSlotTime = Math.ceil(currentMinute / 15) * 15; // Round to the nearest 15 minutes
        startDate.setHours(currentHour, currentSlotTime, 0, 0);
    } else {
        console.log('2');

        startDate.setHours(0, 0, 0, 0); // Midnight for selected day
    }

    var currentDate = new Date(startDate);
    console.log('Current Date:', currentDate);

    var endDate = new Date(startDate);
    console.log('End Date:', endDate);

    // Set end date to the end of the day
    endDate.setHours(23, 59, 59, 999);
    console.log('End Date Final:', endDate);

    // Clear existing time slots and create new ones
    $('#timeSlotsList li').remove();
    while (currentDate <= endDate) {
        var hours = currentDate.getHours();
        var minutes = currentDate.getMinutes().toString().padStart(2, '0');
        var amPm = hours >= 12 ? "PM" : "AM";
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        var timeValue = hours + ":" + minutes + " " + amPm;

        $('#timeSlotsList').append($('<li>', {
            label: timeValue,
            text: timeValue,
        }));

        currentDate.setMinutes(currentDate.getMinutes() + 30); // Increment by 30 minutes
    }
}







function parseCustomDate(dateString) {
    const parts = dateString.split(' ');
    const monthDay = parts[1].split('/');
    const month = parseInt(monthDay[0]) - 1;
    const day = parseInt(monthDay[1]);
    const year = new Date().getFullYear();

    return new Date(year, month, day);
}

$(document).ready(function () {


    function toggleSearchBar() {
        $('.search-bar-container').toggleClass('open');
        $('#search-icon, .header_searchbar_close_button').toggle();
    }
    $('body').on('click', '#search-icon, .header_searchbar_close_button', toggleSearchBar);

    // sandeep || add code search category page 
    $('body').on('input', '#tnb-google-search-input', function () {
        var searchTerm = $(this).val().toLowerCase();
        var hasVisibleProductInMainCategory = false;
        var hasVisibleProductInChildCategory = false;

        $('.childCategoryheading').show();
        $('#categoryheading').show();

        // Remove any existing "No results found!" message
        $('.no-results-message').remove();
        // Check main category products
        $('.sub-category .product-item').each(function () {
            var productName = $(this).data('name').toLowerCase();
            if (productName.includes(searchTerm)) {
                $(this).removeClass('hidden');
                hasVisibleProductInMainCategory = true;
            } else {
                $(this).addClass('hidden');
            }
        });

        // Check child category products
        $('.child_category .product-item').each(function () {
            var productName = $(this).data('name').toLowerCase();
            if (productName.includes(searchTerm)) {
                $(this).removeClass('hidden');
                hasVisibleProductInChildCategory = true;
            } else {
                $(this).addClass('hidden');
            }
        });

        // Update visibility of headings based on search results
        if (hasVisibleProductInMainCategory && hasVisibleProductInChildCategory) {
            // Both categories have visible products
            $('.childCategoryheading').show();
            $('#categoryheading').show();
        } else if (hasVisibleProductInMainCategory) {
            // Only main category has visible products
            $('.childCategoryheading').hide();
            $('#categoryheading').show();
        } else if (hasVisibleProductInChildCategory) {
            // Only child category has visible products
            $('.childCategoryheading').show();
            $('#categoryheading').hide();
        } else {
            // No products found in either category
            $('.childCategoryheading').hide();
            $('#categoryheading').hide();
            $('#products_header').append('<div class="no-results-message text-center">No results found!</div>');
        }

    });
});





//sandeep || this add the product to cart before adding it check the type of the product and make the data accordingly
jQuery('body').on('click', '.add_button', function () {
    // check options

    let addbutton = $(this);
    let cate_id = $(this).attr('attr');
    let productType = $(this).attr('data');
    let selectedOptions = {};
    $('input.product_variant:checked').each(function () {
        let attributeId = $(this).attr('name').match(/\d+/)[0];
        let optionId = $(this).val();
        selectedOptions[attributeId] = optionId;
    });

    let selected_configurable_option = $('#selected_configurable_option').val();
    let $originalButtonText = $(this).text(); // Store the original button text

    let productId = $(this).closest('.product-card-new').find('#ProductId').val();
    let SpecialInstruction = $(this).closest('.product-card-new').find('#textarea-customize').val();
    let Quantity = $(this).closest('.product-card-new').find('#quantity-changer').val();
    let token = $('meta[name="csrf-token"]').attr('content'); // Retrieve CSRF token

    var successMessageSpan = $('#successMessage_' + productId + '_' + cate_id);


    var modalSelector = $('#exampleModal' + productId + '_' + cate_id);


    if (/^0+/.test(Quantity)) {
        return false;
    }

    let data = {
        '_token': token,
        'product_id': productId,
        'special_instruction': SpecialInstruction,
        'quantity': Quantity,
    };

    if (productType === 'configurable') {
        data.selected_configurable_option = selected_configurable_option;
        data.super_attribute = selectedOptions;
        if (selected_configurable_option == '') {
            var redioError = $(this).closest('.modal-content').find('#redioErrorMessage_' + productId).text('Please select option').fadeIn();

            setTimeout(function () {
                redioError.fadeOut('slow', function () {
                    $(this).empty();
                });
            }, 3000);

            return false;
        }

    }


    $(this).prop('disabled', true);
    $(this).text('');
    $(this).append('<span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>');
    $.ajax({
        url: '/checkout/cart/add/' + productId,
        type: 'POST',
        data: data,
        success: function (response) {
            let cartItem = response.cartDetail.original.mini_cart.cart_items;

            update_mini_cart(response);

            successMessageSpan.text("Item added!").fadeIn();

            $('#selected_configurable_option').val('')
            let modalTextarea = $('#exampleModal' + productId + '_' + cate_id + ' #textarea-customize');
            let nonModalTextarea = $('.product-card-new #textarea-customize');

            if (modalTextarea.length > 0) {
                modalTextarea.val('');
            } else {
                nonModalTextarea.val('');
                $('#category_instructions_Div' + productId).removeClass('show in');
            }


            var modalSelector = $('#exampleModal' + productId + '_' + cate_id);

            setTimeout(function () {
                successMessageSpan.fadeOut('slow', function () {
                    $(this).empty();
                });
            }, 3000);

            $(addbutton).prop('disabled', false);
            $(addbutton).find('.spinner-border').remove();
            $(addbutton).text($originalButtonText);

            // sandeep add close model code
            let closeButton = modalSelector.find('.close');
            if (closeButton.length) {
                closeButton.click(); // Trigger the click event to close the modal
                $('.modal-backdrop').remove();
                $(modalSelector).removeClass('show');
                $(modalSelector).removeAttr('aria-modal');
                $(modalSelector).attr('aria-hidden', 'true');
            }

        },
        error: function (xhr) {
            errorMessage = xhr.responseJSON.error;
            var quantityError = $('#quantityError_' + productId + '_' + cate_id);
            quantityError.text(errorMessage).fadeIn();

            setTimeout(function () {
                quantityError.fadeOut('slow', function () {
                    $(this).empty();
                });
            }, 3000);

            $('.add_button').prop('disabled', false);
            $('.add_button').find('.spinner-border').remove();
            $('.add_button').text($originalButtonText);
        }
    });
});


// sandeep add code for select option value 

$('body').on('click', '.product_variant', function () {
    let variant_id = $(this).attr('attr');
    //console.log(variant_id)
    $('#selected_configurable_option').val(variant_id)
});

// sandeep add code for open popop for a particular configurable product and insert the option

jQuery('body').on('click', '#AddToCartButtonpopup', function () {

    let cate_id = $(this).closest('.configurable_product').find('#Add_Button_Popop').attr('attr');
    let slug = $(this).closest('.AddButton').find('#slug').val();
    let productId = $(this).closest('.configurable_product').find('.custom_modal').attr('data');
    let modalSelector = '#exampleModal' + productId + '_' + cate_id;

    let token = $('meta[name="csrf-token"]').attr('content'); // Retrieve CSRF token
    //  sandeep || add popop open code
    $(modalSelector).on('show.bs.modal', function () {
        // setTimeout(function() {
        $(modalSelector).addClass('modal custom_modal fade show in');
        $(modalSelector).removeAttr('aria-hidden');
        $(modalSelector).attr('aria-modal', 'true');

        if (!$('.modal-backdrop.fade.show').length) {
            $('<div>', {
                class: 'modal-backdrop fade show',
                'bis_skin_checked': '1'
            }).appendTo('body');
        }

        // Check and add modal backdrop for 'fade in'
        if (!$('.modal-backdrop.fade.in').length) {
            $('<div>', {
                class: 'modal-backdrop fade in',
                'bis_skin_checked': '1'
            }).appendTo('body');
        }
        // }, 200);
    });

    $(modalSelector).on('shown.bs.modal', function () {
        if (!$('body').hasClass('modal-open')) {
            $('body').addClass('modal-open');
        }
        $('body').addClass('pr-0');
    });

    // Ensure this runs after modal has time to display

    $(modalSelector + ' .modal-body > *').hide();
    $(modalSelector + ' #Add_Button_Popop').hide();
    $(modalSelector + ' .modal-body').append(`
            <div class="loading-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                <div class="lds-dual-ring"></div>
            </div>
        `);

    $.ajax({
        url: '/single-product',
        type: 'GET',
        data: {
            // '_token': token,
            'slug': slug,
            'product_id': productId
        },
        success: function (response) {
            $(modalSelector + ' .variant__option').html(response.html);
            $(modalSelector + ' .modal-body').find('.loading-container').remove();
            $(modalSelector + ' .modal-body > *').show();
            $(modalSelector + ' #Add_Button_Popop').show();
        },

        error: function (xhr) {
            alert('An error occurred. Please try again.');
            $(modalSelector + ' .modal-body').find('.loading-container').remove();
            $(modalSelector + ' .modal-body > *').show();
            $(modalSelector + ' #Add_Button_Popop').show();
        }
    });
});


//sandeep || add code for remove products to carts

$('body').on('click', '.custom-remove-item', function () {
    var item_id = $(this).attr('data-item-id');
    let token = $('meta[name="csrf-token"]').attr('content');

    let $clickedElement = $(this);
    $clickedElement.closest('.bin-icon').hide();
    $clickedElement.closest('.display-inbl').find(".bin-btn-ring").show();


    $.ajax({
        url: "/cart/remove/" + item_id,
        type: 'DELETE',
        data: {
            '_token': token,
        },
        success: function (response) {
            update_mini_cart(response, 'empty');
            // $clickedElement.closest('.bin-icon').show();
            // $clickedElement.closest('.display-inbl').find(".bin-btn-ring").hide();

            $clickedElement.closest('.bin-icon').hide();
            $clickedElement.closest('.display-inbl').find(".bin-btn-ring").show();

        },
        error: function (xhr) {
            $clickedElement.closest('.bin-icon').show();
            $clickedElement.closest('.display-inbl').find(".bin-btn-ring").hide();
        }
    });


})

// sandeep add common function use for remove products and add products

// Sandeep || 15-08-2024 || create function to  uopdate sidebar cart content 
function update_mini_cart(response, type = null) {
    //console.log(response);
    // let cartItem =response.cartDetail.original.mini_cart.cart_items;

    let cartItem = response.cartDetail?.original?.mini_cart?.cart_items;

    $('#mini-cart-duplicate-container').empty();

    if (!cartItem || cartItem.length === 0) {
        $('.badge-container .badge').text('');
        $('.dropdown').addClass('disable-active');
        $('.dropdown-toggle').addClass('cursor-not-allowed');
        $("#cart-modal-content").removeClass("slide-cart-modal");
        $("#cart-modal-content").addClass("hide");
        if (type === null) {
            //console.log('Cart is empty, type is null');
        }
        return;
    }

    let totalQuantity = 0;

    for (const item of cartItem) {
        //console.log(item.name);
        totalQuantity += parseInt(item.quantity, 10) || 0;
        if (totalQuantity > 0) {
            $('.dropdown').removeClass('disable-active');
            $('.dropdown-toggle').removeClass('cursor-not-allowed');
            // $('.modal-content').addClass('slide-cart-modal');
            $('#cart-modal-content').removeClass('hide');
        }

        // Update desktop badge
        const desktopContainer = document.querySelector('.badge-container');
        if (desktopContainer) {
            let desktopBadge = desktopContainer.querySelector('.badge');
            if (!desktopBadge) {
                desktopBadge = document.createElement('span');
                desktopBadge.className = 'badge bg-dark';
                desktopContainer.appendChild(desktopBadge);
            }
            desktopBadge.textContent = totalQuantity;
        }

        // Update mobile badge
        const mobileContainer = document.querySelector('.badge-wrapper');
        if (mobileContainer) {
            let mobileBadge = mobileContainer.querySelector('.badge');
            if (!mobileBadge) {
                mobileBadge = document.createElement('span');
                mobileBadge.className = 'badge bg-dark';
                mobileContainer.appendChild(mobileBadge);
            }
            if (totalQuantity >= 99) {
                totalQuantity = "99+";
            }
            mobileBadge.textContent = totalQuantity;
        }





        var itemId = item.id;
        const itemSelector = '[data-item-id="' + itemId + '"]';

        const $container = $('.mini-cart-container');
        const $existingItem = $container.find(itemSelector);

        if ($existingItem.length > 0) {
            $existingItem.find('input').val(item.quantity);
        } else {
            var attributesHtml = '';

            if (item.additional?.attributes && typeof item.additional.attributes === 'object') {
                Object.values(item.additional.attributes).forEach(attribute => {
                    if (attribute.option_label) {
                        attributesHtml += ` <strong>Preference: </strong><span>${attribute.option_label}</span>`;
                    }
                });
            }
            //console.log(attributesHtml);

            // append html in side mini cart

            //console.log(itemId, 'item');
            const newItemHtml =
                '<div class="row small-card-container col-12 mb-2" style="border-bottom: 1px solid rgb(222, 226, 230);">' +
                '    <div class="col-8 no-padding card-body align-vertical-top" style="padding-right:10px !important">' +
                '        <div class="no-padding">' +
                '            <div class="fs16 text-nowrap fw6 product-name">' + item.name + '</div>' +
                '        <div class="row mini-cart-instruction">' +
                '            <div class="row mini-cart-instruction" style="font-size:13px">' +
                '' + attributesHtml +
                (item.additional.special_instruction ?
                    '<span><strong>Special Instruction: </strong>' + item.additional.special_instruction + '</span>' : '') +
                '            </div>' +
                '        </div>' +
                '                </div>' +
                '            </div>' +
                '  <div class="fs14 card-current-price fw6 col-4 mt-2 p-0 text-left"">' +
                '                <div class="display-inbl">' +
                '                    <label class="fw5 m-auto">Qty:</label>' +
                '                     <span class="ml5 ml-1">' + item.quantity + '</span>' +
                '                    <span class="bin_icon">' +
                '                    <span class="bin-icon">' +
                '                        <img src="/themes/volantijetcatering/assets/images/bin.png" alt="Bin Icon" width="15" height="15" class="bin-icon-image custom-remove-item ml-2" data-item-id="' + itemId + '">' +
                '                    </span>' +
                '            <span class="bin-btn-ring ml-2"></span>' +
                '                    </span>' +
                '        </div>' +
                '    </div>' +
                '</div>';

            // Append the new item HTML to the container
            $container.append(newItemHtml);
        }
    }


    // Update the badge quantity if necessary
    const badge = document.querySelector('.badge-container .badge');
    if (badge) {
        badge.textContent = totalQuantity; // Update the badge with the total quantity
    }
}

// Hide all lists when clicking outside specific elements
$('body').on('click', function (event) {
    // Hide lists if the click is not on the address list, airport FBO list, or input elements
    if (!$(event.target).closest('#address-list, #airport-fbo-list, #airport-fbo-input, #auto_search, .searchbar, .delivery_select').length) {

        $('#address-list').css('display', 'none');
        $('#airport-fbo-list').css('display', 'none');
        $('#checkout_airport-fbo-list').css('display', 'none');
        $('.delivery_select.delivery_select_date').css('display', 'none');
        $('.delivery_select.delivery_select_time').css('display', 'none');
    }
});

// Show address list when typing in the auto_search input
$(document).on('click keyup', '#auto_search, #airport_select_searchbar', function () {
    $('#address-list').css('display', 'block');
});

$(document).on('click', '#airport-fbo-input', function () {
    $('#airport-fbo-list').css('display', 'block');
});

$(document).on('click', '#daySelect', function (event) {
    event.stopPropagation();
    $('.delivery_select.delivery_select_date').toggle();
});

$(document).on('click', '#timeSlots', function (event) {
    event.stopPropagation();
    $('.delivery_select.delivery_select_time').toggle();
});




$('body').on('click', '.checkout__button, .fbo_button, .profile_update_button', function (event) {
    var self = this;
    var evt = event;

    setTimeout(function () {
        evt.preventDefault();
        var errorText = '';

        if ($(self).hasClass('fbo_button')) {
            errorText = $('.control-group').find('.control-error').text();
        } else if ($(self).hasClass('profile_update_button')) {
            errorText = $('.row').find('.control-error').text();
        } else if ($(self).hasClass('checkout__button')) {
            errorText = "";
        }
        if (errorText.trim() == '') {
            $(self).prop('disabled', false);
            $(self).html('<span class="btn-ring"></span>');
            $(self).find(".btn-ring").show();
            $(self).find('.btn-ring').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            });
        } else {
            $(self).prop('disabled', true);
        }
    }, 10);
});


// fbo address add validation code
$('body').on('input keyup change', '.input_wrapper input, .input_wrapper textarea', function () {
    const field = $(this);
    const value = field.val();
    let isValid = true;

    if (field.is('#fbo-name')) {
        if (value.length === 0) {
            field.siblings('#name-error').text('Fbo Name is required.').fadeIn();
            isValid = false;
        } else {
            field.siblings('#name-error').fadeOut();
        }
    }

    if (field.is('#fbo-address')) {
        if (value.length === 0) {
            field.siblings('#address-error').text('The address field is required.').fadeIn();
            isValid = false;
        } else {
            field.siblings('#address-error').fadeOut();
        }
    }

    // Collect FBO details values
    const fboName = $('#fbo-name').val();
    const fboAddress = $('#fbo-address').val();

    const fields = field.closest('form').find('.control');
    fields.each(function () {
        const fieldValue = $(this).val();
        const errorVisible = $(this).siblings('.control-error:visible').length > 0;
        if (fieldValue.length === 0 || errorVisible) {
            isValid = false;
        }
    });

    const fboNameValid = fboName.length > 0;
    const fboAddressValid = fboAddress.length > 0;

    $('#add-fbo-button').prop('disabled', !fboNameValid || !fboAddressValid);
});

// form validation code 
$('body').on('input keyup change', '.control, .control-group input, .row input, .user-profile-input input', function () {
    const field = $(this);
    const form = field.closest('form');
    let allEmpty = true;
    let hasError = false;

    const fields = form.find('.control, .control-group input, select');

    fields.each(function () {
        const fieldValue = $(this).is('select') ? $(this).find('option:selected').val() : $(this).val();
        const errorVisible = $(this).siblings('.control-error:visible').length > 0;

        if (fieldValue.length === 0 || parseFloat(fieldValue) <= 0 || errorVisible) {
            hasError = true;
        } else {
            allEmpty = false;
        }
    });

    const buttonDisabled = allEmpty || hasError;
    form.find('.fbo_detail_button, .profile_update_button').prop('disabled', buttonDisabled);

});

// sandeep disbled button first time then null required fields
$('#fbo_button, #add-fbo-button,  .register-btn, .signIn-btn').prop('disabled', true);

jQuery('body').on('click', '.custom-enquiry-button, #collect_payment', function () {
    $(this).css('min-width', $(this).outerWidth());
    $(this).html('<span class="btn-ring"></span>');
    $(this).find(".btn-ring").show();
    $(this).find('.btn-ring').css({
        'display': 'flex',
        'justify-content': 'center',
        'align-items': 'center'
    });
});


// sandeep || add code for click on body remove backdrop 
$('body').on('click', function () {
    $('#exampleModal, .custom_modal').on('hidden.bs.modal', function (event) {
        $('.modal-backdrop').remove();
    });
});






// sandeep add code for show mobile number in usa mobile number formate

$('body').on('input', '#phone', function () {
    var phone = $(this).val().replace(/\D/g, ''); 

    // Only start formatting when phone length is more than 3 digits
    if (phone.length > 3 && phone.length <= 6) {
        phone = '(' + phone.slice(0, 3) + ') ' + phone.slice(3);
    } else if (phone.length > 6) {
        phone = '(' + phone.slice(0, 3) + ') ' + phone.slice(3, 6) + '-' + phone.slice(6, 10);
    }

    $(this).val(phone);
});