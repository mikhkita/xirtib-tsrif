var myWidth,
    isDesktop = false,
    isTablet = false,
    isMobile = false,
    progress = new KitProgress("#FF345F", 2),
    countQueue = {},
    catalogAjax = null;

function LineBlockHeight(block){

    $(block).css("height","");

    var maxHeight = $(block).innerHeight();

    $(block).each(function(){
      if ( $(this).innerHeight() > maxHeight ) 
      { 
        maxHeight = $(this).innerHeight();
      }
    });
     
    $(block).innerHeight(maxHeight);
}

$(document).ready(function(){	

    if( $(".order-adress-map-form").length ){
        $(".b-input input, .b-input select").each(function(){
            $(this).parents(".b-input").removeClass("focus");
            if( $(this).val() != "" && $(this).val() != "+7 (   )    -  -  " ){
                $(this).parents(".b-input").addClass("not-empty");
            }else{
                $(this).parents(".b-input").removeClass("not-empty");
            }
        });
    }

    $('.b-comment-reply').on('click', function(){
        var comment = $(this).parents('.parrent-comment');
        var form = $('#comment-form');
        if (!comment.find('.b-comment-block-form-container').html()) {
            comment.find('.b-comment-body').first().after(form.html());
            comment.addClass('current-reply');
        }else{
            comment.find('.b-comment-block-form-container').remove();
            comment.removeClass('current-reply');
        }
        return false;
    });

    $('.b-catalog-preview .b-big-tabs h2').on('click', function(){
        var tab = $(this).attr('data-tab');
        $('.b-big-tab-container.tab-link').addClass('hide');
            

        if (tab == 'catalog-new') {
            $('.b-big-tab-container.tab-link').removeClass('hide');
        }

        $(this).parent().siblings().find('h2').addClass('deactive');
        $(this).removeClass('deactive');
        $('.b-catalog-preview .b-catalog-list').addClass('hide');
        $('#'+tab).removeClass('hide');
    });

    if($("#city").val() == "Москва"){
        $('.b-addresss-item__metro').removeClass('hide');
    }

    $("#city").on('change', function(){
        if ($(this).val() == "Москва") {
            $('.b-addresss-item__metro').removeClass('hide');
        } else {
            $('.b-addresss-item__metro').addClass('hide');
        }
    });

    if( typeof autosize == "function" )
        autosize(document.querySelectorAll('textarea'));

    function resize(){
       if( typeof( window.innerWidth ) == 'number' ) {
            myWidth = window.innerWidth;
            myHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || 
        document.documentElement.clientHeight ) ) {
            myWidth = document.documentElement.clientWidth;
            myHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
            myWidth = document.body.clientWidth;
            myHeight = document.body.clientHeight;
        }

        if( myWidth > 1024 ){
            isDesktop = true;
            isTablet = false;
            isMobile = false;
        }else if( myWidth > 767 && myWidth < 1023 ){
            isDesktop = false;
            isTablet = true;
            isMobile = false;
        }else{
            isDesktop = false;
            isTablet = false;
            isMobile = true;
        }


        footerOuterHeight = !!$('.b-footer').outerHeight() ? $('.b-footer').outerHeight(true) + 30 : 0,
        headerHeight = 0;
        if($('.b-header').length){
            headerHeight = $('.b-header').outerHeight(true) + $(".b-header").offset().top;
        }
        var minHeight = myHeight - footerOuterHeight - headerHeight;
        if(minHeight >= 0){
            $('.b-content-block').css({
                'min-height': minHeight
            });
        } 
    }

    progress.endDuration = 0.2;

    $(window).resize(resize);
    resize();

    $(window).resize(function(){
        if (myWidth < 960) {
            // $('.b-category-left-list').addClass('hide');
        }
    });

    $.fn.placeholder = function() {
        if(typeof document.createElement("input").placeholder == 'undefined') {
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('placeholder');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                }
            }).blur().parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });
            });
        }
    }
    $.fn.placeholder();

    // $('.b-sort-block a').on('click', function(){
    //     if ($(this).hasClass('active')) {
    //         if ($(this).hasClass('up')) {
    //             $(this).removeClass('up');
    //             $(this).addClass('down');
    //         }
    //         else{
    //             $(this).removeClass('down');
    //             $(this).addClass('up');
    //         }
    //     }
    //     else{
    //         $('.b-sort-block a').removeAttr('class');
    //         $('.b-sort-block a').addClass('icon-arrow');
    //         $(this).addClass('active up');
    //     }
    //     return false;
    // });

    if (!isDesktop) {
        tabs_slider();
        // advSlider();
    }

    setInterval(function(){
        if( $(".b-gift").length ){
            $(".b-catalog-gifts").show();
        }else{
            $(".b-catalog-gifts").hide();
        }
    }, 200);

/******************************************/

    var menuSlideout = new Slideout({
        'panel': document.getElementById('panel-page'),
        'menu': document.getElementById('mobile-menu'),
        'side': 'left',
        'padding': 300,
        'touch': false
    });

    if ($('#mobile-catalog').length) {
        var catalogSlideout = new Slideout({
            'panel': document.getElementById('panel-page'),
            'menu': document.getElementById('mobile-catalog'),
            'side': 'right',
            'padding': 300,
            'touch': false
        });
    }

    $('.mobile-menu').removeClass("hide");
    $('.mobile-catalog').removeClass("hide");

    $('.burger-menu').click(function() {
        menuSlideout.open();
        $('.mobile-menu').show();
        $('.mobile-catalog').hide();
        $(".b-menu-overlay").show();
        return false;
    });

    $('#catalog-menu-btn').click(function() {
        catalogSlideout.open();
        $('.mobile-catalog').show();
        $('.mobile-menu').hide();
        $(".b-menu-overlay").show();
        return false;
    });

    $('.b-menu-overlay').click(function() {
        menuSlideout.close();
        catalogSlideout.close();
        $('.b-menu-overlay').hide();
        return false;
    });

    menuSlideout.on('open', function() {
        $('.mobile-menu').removeClass("hide");
        $(".b-menu-overlay").show();
    });

    if ($('#mobile-catalog').length){
        catalogSlideout.on('open', function() {
            $('.mobile-catalog').removeClass("hide");
            $(".b-menu-overlay").show();
        });
    }

    menuSlideout.on('close', function() {
        setTimeout(function(){
            $("body").unbind("touchmove");
            $("#mobile-catalog, #mobile-menu").hide();
            $(".b-menu-overlay").hide();
        },100);
    });
    if ($('#mobile-catalog').length){
        catalogSlideout.on('close', function() {
            setTimeout(function(){
                $("body").unbind("touchmove");
                $("#mobile-catalog, #mobile-menu").hide();
                $(".b-menu-overlay").hide();
            },100);
        });
    }

    // var e = $('.b-menu-overlay, .mobile-menu');
    // var ev = $('.b-menu-overlay, .mobile-catalog');

    // e.touch();
    // ev.touch();

    // e.on('swipeLeft', function(event) {
    //     menuSlideout.close();
    // });

    // ev.on('swipeRight', function(event) {
    //     setTimeout(function(){
    //         $(".b-menu-overlay").hide();
    //     },200);
    //     catalogSlideout.close();
    // });

/******************************************/

    $('.menu-accordion').accordion({
        header: "> div > h3",
        collapsible: true,
        heightStyle: "content",
        active: false
    });

    $('.b-detail-top-slider').slick({
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'ease', 
        speed: 100,
        arrows: true,
        fade: true,
        asNavFor: '.b-detail-bottom-slider',
        prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
        touchThreshold: 100,
    });

    $('#catalog-lead').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'ease', 
        speed: 100,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
        touchThreshold: 100,
        responsive: [
            {
              breakpoint: 1240,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 960,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 650,
              settings: {
                slidesToShow: 1,
                adaptiveHeight: true,
              }
            },
        ]
    });

    $('.b-detail-bottom-slider').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'ease', 
        speed: 300,
        arrows: false,
        asNavFor: '.b-detail-top-slider',
        prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
        touchThreshold: 100,
        focusOnSelect: true,
        variableWidth: true
    });

    $('.b-sort-item select').styler();
    // $('.detail-select-block select').styler();
    $('.b-cart-input select').styler();

    var maxBasketCount = 999;

    //увеличить количество
    $(document).on('click', '.b-product-quantity .quantity-add', function(){
        // console.log('click');
        var $input = $('.quantity-input');

        if ($input.attr('data-quantity') != 0) {
            var count = parseInt($input.val()) + 1;
            count = (count > maxBasketCount || isNaN(count) === true) ? maxBasketCount : count;
            $input.val(count);
        }

        $input.change();
        return false;
    });

    //уменьшить количество
    $(document).on('click', '.b-product-quantity .quantity-reduce', function(){
        var $input = $('.quantity-input');
        var count = parseInt($input.val()) - 1; 
        count = (count < 1 || isNaN(count) === true) ? 1 : count;
        $input.val(count).change();
        return false;
    });

    $(document).on('change', '.b-product-quantity .quantity-input', function(){
        
        if($(this).val()*1 == '' || $(this).val()*1 == 0){
            $(this).val(Number($(this).attr('value')));
        }

        if($(this).val()*1 >= $(this).attr('data-quantity')*1){
            $(this).val(Number($(this).attr('data-quantity')));
            if ($('.b-product-quantity-info').hasClass('hide')) {
                $('.b-product-quantity-info').removeClass('hide');
            }
        } else {
            if (!$('.b-product-quantity-info').hasClass('hide')) {
                $('.b-product-quantity-info').addClass('hide');
            }
        }

    });

    // if (offers.length) {
    //     console.log(offers);
    // }



    // $('#colorSelect').on('change', function(){
    //     var colorID = $('#colorSelect').find('option:selected').attr('data-color-id'),
    //         sizeID = $('#sizeSelect').find('option:selected').attr('data-size-id');

    //     if (!checkOffer(colorID, sizeID)){
    //         sizeID = false;
    //     }

    //     showPhotoColor(ID);
    // });

    $('.detail-select-block select').on('change', function(){
        var $this = $(this);
        $('#wholesale-text').html('');
        $('.b-default-price').removeClass('.b-discount-price');
        $('.b-detail-discount').addClass('hide');
        $('.b-detail-buy').removeClass('unavailable-btn');
        $('.bx-catalog-subscribe-button').removeClass('disabled');

        if ($(document).find('.detail-select-block select').length == 2) {
            var color = $('#colorSelect option:selected').attr('data-id');

            if ($this.attr('id') == 'colorSelect'){
                $('#sizeSelect').find('option').each(function(){
                    $(this).prop('disabled', true).prop('selected', false);
                });

                for (size in offers[color]){
                    $('#sizeSelect option[data-id='+size+']').prop('disabled', false);
                }

                $('#sizeSelect option:not([disabled]):first').prop('selected', true).trigger('chosen:updated');

            } else {
                // console.log('2');
            }

            var size = $('#sizeSelect option:selected').attr('data-id');
            // console.log(offers[color][size].OFFER_ID);
            showPhotoColor(offers[color][size].OFFER_ID);
            $('.b-btn-to-cart').attr('data-id', offers[color][size].OFFER_ID);
            console.log(offers[color][size]);
            $('.bx-catalog-subscribe-button').attr('data-id', offers[color][size].OFFER_ID);
            $('.bx-catalog-subscribe-button').attr('data-name', offers[color][size].NAME);

            $('.quantity-input').attr('data-quantity', offers[color][size].QUANTITY).val(1).trigger('change');
            $('#quantity-info').text(offers[color][size].QUANTITY);
            
            if (offers[color][size].QUANTITY <= 0) {
                $('.b-detail-buy').addClass('unavailable-btn');
            }

            if (parseInt(offers[color][size].PRICE) !== parseInt(offers[color][size].DISCOUNT_PRICE)){
                $('.price-container').addClass('b-discount-price');
                $('.b-detail-discount').removeClass('hide');
                $('.b-detail-disount-icon').html('-'+Math.round(100 - (parseInt(offers[color][size].DISCOUNT_PRICE) * 100 / parseInt(offers[color][size].PRICE)))+'%');
            } else {
                $('.price-container').removeClass('b-discount-price');
            }

            $('.old-price').text(new Intl.NumberFormat('ru-RU').format(offers[color][size].PRICE));
            $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[color][size].DISCOUNT_PRICE));

            if (offers[color][size].ITEM_PRICES.length > 1) {

                var html = '';
                for (var i = 0; i < offers[color][size].ITEM_PRICES.length; i++) {
                    if (i == 0) {
                        continue;
                    }

                    if (parseInt($('.quantity-input').val()) >= parseInt(offers[color][size].ITEM_PRICES[i].QUANTITY_FROM)) {
                        $('.b-default-price').addClass('.b-discount-price');
                    }

                    html += 'от '+offers[color][size].ITEM_PRICES[i].QUANTITY_FROM+' шт. – '+(new Intl.NumberFormat('ru-RU').format(offers[color][size].ITEM_PRICES[i].PRICE))+'&nbsp;<span class="price icon-rub"></span><br>';
                }

                $('#wholesale-text').html(html);
            }

        } else {
            var option = $this.find('option:selected').attr('data-id');
            showPhotoColor(offers[option].OFFER_ID);
            
            $('.b-btn-to-cart').attr('data-id', offers[option].OFFER_ID);
            $('.bx-catalog-subscribe-button').attr('data-id', offers[option].OFFER_ID);
            $('.bx-catalog-subscribe-button').attr('data-name', offers[option].NAME);
            
            $('.quantity-input').attr('data-quantity', offers[option].QUANTITY).val(1).trigger('change');
            $('#quantity-info').text(offers[option].QUANTITY);

            if (offers[option].QUANTITY <= 0) {
                $('.b-detail-buy').addClass('unavailable-btn');
            }

            if (parseInt(offers[option].PRICE) !== parseInt(offers[option].DISCOUNT_PRICE)){
                $('.price-container').addClass('b-discount-price');
                $('.b-detail-disount-icon').html('-'+Math.round(100 - (parseInt(offers[option].DISCOUNT_PRICE) * 100 / parseInt(offers[option].PRICE)))+'%');
                $('.b-detail-discount').removeClass('hide');
            } else {
                $('.price-container').removeClass('b-discount-price');
            }

            $('.old-price').text(new Intl.NumberFormat('ru-RU').format(offers[option].PRICE));
            $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[option].DISCOUNT_PRICE));

            if (offers[option].ITEM_PRICES.length > 1) {
                for (var i = 0; i < offers[option].ITEM_PRICES.length; i++) {
                    if (i == 0) {
                        continue;
                    }

                    if (parseInt($('.quantity-input').val()) >= parseInt(offers[option].ITEM_PRICES[i].QUANTITY_FROM)) {
                        $('.b-default-price').addClass('.b-discount-price');
                    }

                    html += 'от '+offers[option].ITEM_PRICES[i].QUANTITY_FROM+' шт. – '+(new Intl.NumberFormat('ru-RU').format(offers[option].ITEM_PRICES[i].PRICE))+'&nbsp;<span class="price icon-rub"></span><br>';
                }

                $('#wholesale-text').html(html);
            }
        }
    });

    chosenElementInit();

    function chosenElementInit(){
        $('.detail-select-block select').chosen({
            width: "210px",
            disable_search_threshold: 10000
        });
    }

    function count(obj) {
        var count = 0;
        for(var prs in obj){
            if(obj.hasOwnProperty(prs)) count++;
        }
        return count;
    }


    function showPhotoColor(ID) {
        $('.b-detail-bottom-slider').each(function(){
            $(this).find('.b-detail-small-pic[data-id='+ID+']').click();
            // var slickID = parseInt($(this).find('.b-detail-small-pic[data-id='+ID+']').index() + 1);
            // $(this).slick('slickGoTo', slickID);
        }); 
    }

    function checkOffer(colorID, sizeID) {
        for (var i = 0; i < offers.length - 1; i++) {
            if (offers[i].COLOR == colorID && offers[i].SIZE == sizeID){
                return true;
            }
        }

        return false;
    }

    // $(document).on('beforeChange', '.b-detail-bottom-slider', function(event, slick, currentSlide, nextSlide){
    //     var id = $(".b-detail-small-pic[data-slick-index='"+nextSlide+"']").attr('data-color-id');
    //     $("#colorSelect option[data-color-id='"+id+"']").prop('selected', true);
    // });

    // Добавление в корзину
    var cartTimeout = 0,
        successTimeout = 0;

    $("body").on("click", ".b-btn-to-cart-detail", function(){

        if ($(this).hasClass('unavailable')) {
            return false;
        }

        var $this = $(this),
            $cap = $this.siblings('.b-btn-to-cart-cap'),
            href = $(this).attr("href"),
            id = $(this).attr("data-id"),
            quantity = $(this).parents('.b-detail-item').find('input[name=count]').val();
        
        clearTimeout(cartTimeout);
        progress.start(1.5);
        $cap.removeClass('hide').addClass('after-load');
        $this.addClass('hide');

        url = href+"&ELEMENT_ID="+id+"&quantity="+quantity;
        $.ajax({
            type: "GET",
            url: url,
            success: function(msg){
                progress.end();
                if( isValidJSON(msg) ){
                    var json = JSON.parse(msg);
                    if( json.result == "success" ){
                        if( json.action == "reload" ){
                            window.location.reload();
                        }else{
                            updateBasket(json.count, json.sum);
                        }
                        $cap.removeClass('error');
                        $cap.find('.b-cap-text').text('Товар успешно добавлен');
                    }else{
                        $cap.addClass('error');
                        $cap.find('.b-cap-text').text((json.error) ? json.error : 'Ошибка!');
                    }
                }else{
                    $cap.addClass('error');
                    $cap.find('.b-cap-text').text('Ошибка!');
                }
            },
            error: function(){
                $cap.addClass('error');
                $cap.find('.b-cap-text').text('Ошибка!');
            },
            complete : function(){
                $this.siblings('.b-btn-to-cart-cap').addClass('loaded');
                setTimeout(function(){
                    $cap.removeClass('loaded');
                    $cap.addClass('hide');
                    $this.removeClass('hide');
                }, 1500);
            }
        });
        return false;
    });

    $("body").on("click", ".b-btn-to-cart-list",function(){
        var url = $(this).attr("href"),
            $cont = $(this).parents(".b-basket-count-cont"),
            $this = $(this);

        if( $cont.find("input[name=quantity]").length ){
            $cont.find("input[name=quantity]").val($cont.find("input[name=quantity]").attr("data-min"));
            url = url + "&quantity=" + $cont.find("input[name=quantity]").attr("data-min");
        }
        
        clearTimeout(cartTimeout);

        $(this).parents(".b-basket-count-cont").addClass("b-item-in-basket");

        progress.start(1.5);

        $.ajax({
            type: "GET",
            url: url,
            success: function(msg){
                progress.end();

                if( isValidJSON(msg) ){
                    var json = JSON.parse(msg);

                    if( json.result == "success" ){
                        if( json.action == "reload" ){
                            window.location.reload();
                        }else{
                            updateBasket(json.count, json.sum);
                        }
                    }
                }else{
                    alert("Ошибка добавления в корзину");
                }
            },
            error: function(){
                alert("Ошибка добавления в корзину");
            }
        });

        return false;
    });

    function isValidJSON(src) {
        var filtered = src+"";
        filtered = filtered.replace(/\\["\\\/bfnrtu]/g, '@');
        filtered = filtered.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']');
        filtered = filtered.replace(/(?:^|:|,)(?:\s*\[)+/g, '');

        return (/^[\],:{}\s]*$/.test(filtered));
    }



    function changeWholesale(){
        
        // console.log('1');
        if( $(".b-dynamic-price").length && $(".b-dynamic-discount-price").length ){
            // console.log('11');
            $(".b-dynamic-price").parents(".b-catalog-item-bottom:not(.wholesale-item)").each(function(){
                var value = $(this).find(".b-quantity-input").val()*1,
                    $this = $(this);

                // console.log(value);

                $(this).find(".b-dynamic-discount-price").hide();
                $(this).find(".price, .b-default-price").show();

                $(this).find(".b-dynamic-discount-price").each(function(){
                    var from = $(this).attr("data-from")*1;
                    if( value >= from ){
                        $this.find(".b-dynamic-price, .price, b-dynamic-discount-price, .b-default-price").hide();
                        $(this).show();
                    }
                });
            });
        }
    }

    changeWholesale();

    $('.b-works-sort-item select').change(function(){
        var $form = $(this).parents('form'),
            type = $form.attr('type'),
            url = '?'+$form.serialize();
        $('.b-works-list-container').addClass('preloader');
        // console.log(url);
        $.ajax({
            type: type,
            url: url,
            dataType: 'html',
            success: function(data){
                $('.b-works-list-container').html($(data).find('.b-works-list-container').html());
            },
            complete: function(){
                $('.b-works-list-container').removeClass('preloader');
            }
        })
    })

    $('.b-work-slider-top').slick({
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'ease', 
        speed: 500,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
        asNavFor: '.b-work-slider-bottom',
        touchThreshold: 100
    });

    $('.b-work-slider-bottom').slick({
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'ease', 
        speed: 500,
        arrows: false,
        asNavFor: '.b-work-slider-top',
        touchThreshold: 100,
        focusOnSelect: true,
        responsive: [
            {
              breakpoint: 500,
              settings: {
                slidesToShow: 1
              }
            },
        ]
    });

    function addContent($this){
        progress.start(3.5);
        var url = $this.attr('href'),
            text = parseInt($this.text());

        if ($this.hasClass('active')){
            text -= 1;
            $this.removeClass('active');
        } else {
            if($this.siblings('.active')){
                otherText = parseInt($this.siblings('.active').text()) - 1;
                $this.siblings('.active').text(otherText);
                $this.siblings('.active').removeClass('active');
            }
            text += 1;
            $this.addClass('active');
        }

        $this.text(text);

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                error: function(){

                    if ($this.hasClass('active')) {
                        $this.removeClass('active');
                        text -= 1;
                    } else {
                        $this.addClass('active');
                        text += 1;
                    }

                    $this.text(text);
                }
            })
        }
        progress.end();
    }

    $('.sort-icon').on('click', function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        var $form = $(this).parents('form');
        $(this).siblings().attr('checked', false);
        $(this).attr('checked', true);
        window.history.replaceState(null , null, '?'+$form.serialize());
        var catalog = $(this).parents('.b-block').find('.b-catalog-list');
        catalog.removeAttr('class').addClass('b-catalog-list').addClass($(this).val());

        return false;
    });

    $(document).on('click', '.b-work-detail-like a, .b-comment-mark, .b-like',  function(){
        addContent($(this));
        return false;
    });

    // Изменение количества в каталоге по кнопкам
    $("body").on("click", ".b-change-quantity", function(){
        var $input = $(this).parents(".b-input-cont").find("input"),
            quantity = $input.val()*1,
            side = $(this).attr("data-side"),
            maxBasketCount = $input.attr("data-max")*1,
            minBasketCount = $input.attr("data-min")*1;

        if( (quantity == 0 && side == "-") || (quantity == maxBasketCount && side == "+") ){
            if( quantity == maxBasketCount && side == "+" ){
                $(this).parents(".b-basket-count-cont").find(".b-error-max-count").show();
            }

            return false;
        }
        $(this).parents(".b-basket-count-cont").find(".b-error-max-count").hide();

        if( quantity == minBasketCount && side == "-" ){
            quantity = 0;
        }else{
            quantity = (side == "+")?(quantity+1):(quantity-1);

            if( quantity < minBasketCount ){
                quantity = minBasketCount;
            }
        }        
        
        $input.val(quantity).change();

        if( quantity == 0 ){
            $(this).parents(".b-basket-count-cont").removeClass("b-item-in-basket");
        }

        return false;
    });

    $("body").on("change", ".quantity-input", function(){

        if( $(".b-dynamic-discount-price").length ){
            $(".b-dynamic-price").parents(".b-detail-right-block").each(function(){
                var value = $(this).find(".quantity-input").val()*1,
                    $this = $(this);

                $(this).find(".b-dynamic-discount-price").hide();
                $(this).find(".b-default-price").show();

                $(this).find(".b-dynamic-discount-price").each(function(){
                    var from = $(this).attr("data-from")*1;
                    if( value >= from ){
                        $this.find(".b-dynamic-discount-price, .b-default-price").hide();
                        $(this).show();
                    }
                });
            });
        }

        if ($(document).find('.detail-select-block select').length) {
            
            if ($('#wholesale-text').length) {
                $('#wholesale-text').html('');
            }

            $('.b-default-price').removeClass('b-discount-price');

            if ($(document).find('.detail-select-block select').length == 2) {

                var color = $('#colorSelect option:selected').attr('data-id'),
                    size = $('#sizeSelect option:selected').attr('data-id');

                $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[color][size].DISCOUNT_PRICE));

                if (offers[color][size].ITEM_PRICES.length > 1) {
                    var html = '';
                    for (var i = 0; i < offers[color][size].ITEM_PRICES.length; i++) {
                        if (i == 0) {
                            continue;
                        }

                        if (parseInt($('.quantity-input').val()) >= parseInt(offers[color][size].ITEM_PRICES[i].QUANTITY_FROM)) {
                            $('.b-default-price').addClass('b-discount-price');
                            $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[color][size].ITEM_PRICES[i].PRICE));
                        }

                        html += 'от '+offers[color][size].ITEM_PRICES[i].QUANTITY_FROM+' шт. – '+ (new Intl.NumberFormat('ru-RU').format(offers[color][size].ITEM_PRICES[i].PRICE)) +'&nbsp;<span class="price icon-rub"></span><br>';
                    }

                    $('#wholesale-text').html(html);
                }

            } else {
                $this = $(document).find('.detail-select-block select');
                var option = $this.find('option:selected').attr('data-id');

                $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[option].DISCOUNT_PRICE));

                if (offers[option].ITEM_PRICES.length > 1) {
                    for (var i = 0; i < offers[option].ITEM_PRICES.length; i++) {
                        if (i == 0) {
                            continue;
                        }

                        if (parseInt($('.quantity-input').val()) >= parseInt(offers[option].ITEM_PRICES[i].QUANTITY_FROM)) {
                            $('.b-default-price').addClass('.b-discount-price');
                            $('.new-price').text(new Intl.NumberFormat('ru-RU').format(offers[option].ITEM_PRICES[i].PRICE));
                        }

                        html += 'от '+offers[option].ITEM_PRICES[i].QUANTITY_FROM+' шт. – '+(new Intl.NumberFormat('ru-RU').format(offers[option].ITEM_PRICES[i].PRICE))+'&nbsp;<span class="price icon-rub"></span><br>';
                    }

                    $('#wholesale-text').html(html);
                }
            }
        }
    });

    // Изменение количества в каталоге путем ввода
    $("body").on("change", ".b-quantity-input", function(){
        var url = $(this).parents(".input-cont").find(".icon-minus").attr("href"),
            $item = $(".b-cart-item[data-id='"+$(this).parents("li, tr").attr("data-id")+"']"),
            $input = $(this),
            quantity = $input.val()*1,
            maxBasketCount = $input.attr("data-max"),
            minBasketCount = $input.attr("data-min"),
            id = $(this).attr("data-id")*1;

        if( quantity > maxBasketCount ){
            $(this).parents(".b-basket-count-cont").find(".b-error-max-count").show();
        }else{
            $(this).parents(".b-basket-count-cont").find(".b-error-max-count").hide();
        }

        quantity = ( quantity < 0 )?0:quantity;
        quantity = ( quantity > maxBasketCount )?maxBasketCount:quantity;

        if( quantity == 0 ){
            $(this).parents(".b-basket-count-cont").removeClass("b-item-in-basket");
        }else{
            if( quantity < minBasketCount ){
                quantity = minBasketCount;
            }
        }
        
        $input.val(quantity);
        $item.find("p.b-basket-item-count").text(quantity+" шт.");
        $item.find("select.b-basket-item-count").val(quantity);

        ajaxChangeQuantity(id, quantity);
    });

    $('body').on("click", ".b-catalog-remove-link", function(){
        var url = $(this).attr("href"),
            $el = $(this).parents(".b-catalog-item");

        progress.start(1);

        $el.fadeOut();
        $.ajax({
            type: "GET",
            url: url,
            success: function(msg){
                var json = JSON.parse(msg);
                if( json.result == "success" ){
                    $el.remove();
                }else{
                    alert(json.error);
                    $el.fadeIn();    
                }
            },
            error: function(){
                $el.fadeIn();
            },
            complete: function(){
                progress.end();
            }
        });

        return false;
    });

    var quantityDelays = [];

    $(document).on("click", '.bx-catalog-subscribe-button', function(){
        if (!$(this).hasClass('disabled')) {
            var href = $(this).attr("href"),
                id = $(this).attr("data-id"),
                name = $(this).attr('data-name'),
                $this = $(this);

            $this.addClass('disabled');
            name = name.replace(/ /g, "_");
            var url = href + "&id="+ id + "&name=" + name;

            $.ajax({
                type: "GET",
                url: url,
                success: function(msg){
                    if(msg != "error"){
                        $this.siblings(".b-thanks-link").click();
                    } else {
                        $this.removeClass('disabled');
                        $this.siblings(".b-error-link").click();
                    }
                },
                error: function(){

                }
            });
        }
        return false;
    });

    function ajaxChangeQuantity(id, quantity){
        if( typeof quantityDelays[id] == "undefined" ){
            quantityDelays[id] = 0;
        }
        if( typeof countQueue[id] == "undefined" ){
            countQueue[id] = 0;
        }

        clearTimeout(quantityDelays[id]);

        changeWholesale();

        quantityDelays[id] = setTimeout(function(){
            quantityDelays[id] = 0;

            countQueue[id]++;

            progress.start(1.5);

            $.ajax({
                type: "GET",
                url: "/ajax/?action=QUANTITY",
                data: { 
                    QUANTITY : quantity,
                    ELEMENT_ID : id
                },
                success: function(msg){
                    var reg = /<!--([\s\S]*?)-->/mig;
                    msg = msg.replace(reg, "");
                    var json = JSON.parse(msg);

                    countQueue[id]--;

                    progress.end();

                    if( json.result == "success" ){

                        if( countQueue[id] == 0 && quantityDelays[id] == 0 ){
                            // console.log(json.quantity);
                            $(".b-quantity-input[data-id='"+json.id+"']").val(json.quantity);

                            if( json.quantity == 0 ){
                                $(".b-quantity-input[data-id='"+json.id+"']").parents(".b-basket-count-cont").removeClass("b-item-in-basket");
                            }
                        }

                        updateBasket(json.count, json.sum);
                    }else{
                        alert("Ошибка изменения количеста, пожалуйста, обновите страницу");
                    }
                },
                error: function(){
                    countQueue[id]--;
                }
            });
        }, 500);
    }

    function updateBasket(count, sum){
        $(".cart-count").text( count + " шт." );
        $(".cart-sum").text( sum );

        if(count == 0){
            $('.b-cart-text').addClass('empty');
        } else {
            $('.b-cart-text').removeClass('empty');
        }

        // if( $(".cart-sum").text() == "0" ){
        //     $('.b-cart-text').addClass('empty');
        //     $(".cart-sum").hide();
        //     $(".cart-count").hide();
        // }else{
        //     $('.b-cart-text').removeClass('empty');
        //     $(".cart-sum").show();
        //     $(".cart-count").show();
        // }
    }

    function trigger(id, event){
        var evt = document.createEvent("HTMLEvents");
        evt.initEvent(event, true, true); 
        document.getElementById(id).dispatchEvent(evt);
    }

    if( $(".b-detail-text-wrap").length ){
        if( $(".b-detail-text-wrap").height() > $(".b-detail-text").height() ){
            $(".b-detail-text-more").css("display", "inline-block");
        }else{
            $(".b-detail-text").removeClass("limit");
        }
    }

     $("body").on("click", ".b-detail-text-more", function(){
        if( $("#b-detail-text").hasClass("limit") ){
            // console.log('1');
            $("#b-detail-text").removeClass("limit");
            $(this).text("Скрыть текст");
        }else{
            // console.log('2');
            $("#b-detail-text").addClass("limit");
            $(this).text("Читать полностью");

            $("body, html").animate({
                scrollTop : $("#b-detail-text").offset().top - 8
            }, 300);
        }
        return false;
    });

    if( $("select#delivery").length ){
        var delTimer = null;
        $("select#delivery").change(function(){
            var price = ($("select#delivery option:checked").attr("data-price"))?$("select#delivery option:checked").attr("data-price"):0 ,
                date = $("select#delivery option:checked").attr("data-date"),
                calc = $("select#delivery option:checked").attr("data-calc");
            $("select#delivery").attr("data-price", price);
            $("select#delivery").attr("data-date", date);

            $("#time").html('');
            $("#mkad").val('');

            $(".b-pickpoint, .b-cdek-choose, .b-order-addr-cont, #b-time-input, #b-mkad-input, #b-metro-input, .b-srok-delivery").hide();

            $(".cdekaddr, .b-postamat-error, #no_price_to_pocikpoint").remove();
            $("#b-cdek-punk-addr").html("не выбран");

            // if( isValidJSON(price) ){
            //     var json = JSON.parse(price);
            //     if( json.length ){
            //         price = 0;
            //     }
            // }
            // alert(price);
            // console.log(price*1);
            // console.log(typeof price);

            if( $(this).val() !== "53" && $(this).val() !== "54" && $(this).val() !== "55" ){
                $("#b-delivery-price-input").val( price*1 ).trigger("change");
                // trigger("b-delivery-price-input", "change");
            }

            $(".b-delivery-info").hide();
            if( $("#delivery-info-"+$(this).val()).length ){
                $("#delivery-info-"+$(this).val()).show();
            }

            $("#b-date-deliv").html("Дата доставки");

            if( ["26", "27", "122", "53", "54", "55"].indexOf( $(this).val() ) !== -1 ){
                $(".b-order-addr-cont").show();
                if( !$(".b-addr-radio:checked").length ){
                    $(".b-addr-radio").eq(0).prop("checked", true).trigger("change");
                }else{
                    $(".b-addr-radio:checked").trigger("change");
                }
            }

            switch ($(this).val()) {
                case "26":
                    $("#time").html(
                        '<option value="с 10 до 18">с 10 до 18</option>'
                    );
                    $("#b-mkad-input").show();
                    $("#b-time-input").show();
                    break;
                case "27":
                    $("#time").html(
                        '<option value="с 10 до 18">с 10 до 18</option>'+
                        '<option value="с 10 до 15">с 10 до 15</option>'+
                        '<option value="с 13 до 18">с 13 до 18</option>'
                    );
                    $("#b-metro-input").show();
                    $("#b-time-input").show();
                    break;
                case "30":
                    $("#b-date-deliv").html("Дата сборки");
                    $(".b-pickpoint").show();
                    $( window ).trigger( 'pickpoint_ready' );
                    break;
                case "53":
                case "54":
                case "55":
                    $("#b-date-deliv").html("Дата сборки");
                    break;
                case "116":
                    $("#b-date-deliv").html("Дата сборки");
                    break;
                case "120":
                    $("#b-date-deliv").html("Дата сборки");
                    $(".b-cdek-input").show();
                    $("#cdek_type").trigger("change");

                    if( $("#b-srok-delivery").text() != "" ){
                        $(".b-srok-delivery").show();
                    }
                    break;
                default:
                    
                    break;
            }

            $("#CALL").trigger("change");

            disableDates();

        });

        $("#cdek_type").change(function(){
            if( $(this).val() == 2 ){
                $(".b-cdek-addr").hide();
                $(".b-order-addr-cont").show();

                if( !$(".b-addr-radio:checked").length ){
                    $(".b-addr-radio").eq(0).prop("checked", true).trigger("change");
                }else{
                    $(".b-addr-radio:checked").trigger("change");
                }

                $("#city").trigger("change");
            }else{
                $(".b-cdek-addr").show();
                $(".b-order-addr-cont").hide();

                IPOLSDEK_pvz.setPrices();
            }
        });

        $("#CALL").change(function(){
            if( !$(this).prop("checked") && ["120", "53", "54", "55", "30"].indexOf( $("#delivery").val() ) !== -1 ){
                $(this).prop("checked", true);
            }
        });

        // $('input[name=address]').change(function(){
        //     $('select[name=metro-addr]').trigger("change");
        // })

        $('#metro-addr').change(function(){
            $('input[name=ORDER_PROP_28]').val($(this).find('option:selected').text());
        });

        $("#b-delivery-price-input").on("change", function(){
            var price = $(this).val();

            // console.log($(this).val());

            $("#b-delivery-price").html( price + " руб." );

            clearTimeout(delTimer);
            delTimer = setTimeout(function(){
                BX.Sale.BasketComponent.sendRequest('refreshAjax', {
                    fullRecalculation: 'Y'
                });
            }, 300);
        });

        $("#mkad").change(function(){
            var value = $(this).val(),
                price = $("select#delivery option:checked").attr("data-price");

            if( value*1 < 0 ){
                $(this).val(0);
                value = 0;
            }
            if( price ){
                price = price*1 + (value * 25);

                $("#b-delivery-price-input").val( price ).trigger("change");
            }
        });

        var $totalsum = $("#total_sum_pickpoint"),
            levels = $totalsum.attr( 'data-levels' ),
            levels_list = [];

        for ( var t = 1; t < levels; t++ ) {
                     // console.log( levels_list, t, levels, $totalsum );
            levels_list.push( {
                'match': new RegExp( $totalsum.attr( 'data-' + t + '-match' ), 'i' ),
                'price': parseFloat( $totalsum.attr( 'data-' + t + '-price' ) ),
                'level': t
            } );
        }

        $( window ).on( 'pickpoint_ready', function() {
            var addr_string = $(".pickpointaddr").val();

            $( '#no_price_to_pocikpoint' ).remove();

            var price_found = false;

            if ( typeof levels_list !== 'undefined' && price_found === false )
            {
                $.each( levels_list, function()
                {
                    try
                    {
                        if ( this.match.test( addr_string ) && price_found === false )
                        {
                            // console.log(this);
                            $("#b-delivery-price-input").val( this.price ).trigger("change");

                            price_found = true;
                        }
                    }
                    catch ( e )
                    {
                        // console.error( e );
                    }
                } );
            }

            if ( price_found === false && $(".pickpointaddr").length && $(".pickpointaddr").val() != "" )
            {
                $("#b-delivery-price-input").val( 0 ).trigger("change");

                $("#b-delivery-price").html('<span id="no_price_to_pocikpoint">Окончательную стоимость рассчитывает оператор</span>' );
            }
        } );

        $(".b-addr-radio").change(function(){
            var address = $(this).attr("data-address"),
                index = $(this).attr("data-index"),
                region = $(this).attr("data-region"),
                city = $(this).attr("data-city"),
                room = $(this).attr("data-room"),
                metro = $(this).attr("data-metro"),
                value = $(this).val();

            if( ["120", "53", "54", "55"].indexOf( $("#delivery").val() ) !== -1 ){
                $(".basket-checkout-block-btn").addClass("loading");
            }

            if( value == "NEW" ){
                address = index = region = room = metro = "";   

                $(".b-order-addr-new").show();
                $("#js-order-adress-map-input").trigger("focusin").focus();
            }else{
                $(".b-order-addr-new").hide();
            }

            $("#js-order-adress-map-input").val(address);
            $("#city").val(city);
            $("#number-room-input").val(room);
            $("#postal-code").val(index);
            $("#region").val(region);
            $("#metro-addr").val(metro).trigger('change');

            if( $("#delivery").val() == "120" ){
                $("#city").trigger("change");
            }else{
                $("#region").trigger("change");
            }
        });

        $("#region").change(function(){
            calculatePost();
        });

        $("#city").on("change", function(){
            // alert($(this).val());
            // console.log($(this).val()+Math.random());
            if( $("select#delivery").val() == "120" ){
                // IPOLSDEK_pvz.chooseCity($(this).val());
            }
        });
    }

    function calculatePost(){
        var deliveryID = $("select#delivery").val();
        if( deliveryID != "53" && deliveryID != "54" && deliveryID != "55" ){
            return true;
        }
        
        var sum = $(".basket-coupon-block-total-price-current").attr("data-price").replace(/\D\.+/g,""),
            weigth = $(".basket-coupon-block-total-price-current").attr("data-weigth").replace(/\D\.+/g,""),
            calc = $("#delivery").attr("data-price"),
            priceAr = null,
            price = 0;

        $( '#no_price_to_pocikpoint' ).remove();

        if( isValidJSON(calc) && calc != "" ){
            calc = JSON.parse(calc);

            if( calc.length ){
                priceAr = calc;
            }
        }else{
            priceAr = null;
        }

        price = getDeliveryPriceBySum(sum, priceAr);

        // if( price == null ){

        // }else{
        if( sum*1 >= 20000 || weigth*1 >= 10 || isNeedMessage() ){
            $(".b-delivery-price").after('<span id="no_price_to_pocikpoint" class="red">Точная стоимость доставки будет рассчитана оператором индивидуально и может поменяться.</span>' );
        }

        price *= getPriceK( $("#region").val() );

        $("#b-delivery-price-input").val( price*1 ).trigger("change");
        // }
    }

    function isNeedMessage(){
        var cities = new RegExp( "Магадан|Саратов|Норильск", 'i' );

        return cities.test( $("#region").val() );
    }

    function getDeliveryPriceBySum(sum, priceAr){
        sum = sum*1;

        for( var i in priceAr ){
            var from = priceAr[i][0]*1,
                to = priceAr[i][1]*1,
                price = priceAr[i][2]*1;
            
            if( from <= sum && sum <= to ){
                return price;
            }
        }

        return 0;
    }

    $(document).on('change', '.b-catalog-form', function(){
        var $form = $(this),
            $catalog = $form.parents('.b-catalog-preview').find('.b-catalog-list'),
            $pagination = $(this).parents('.pagination-container').find('.b-load-more-container'),
            type = $form.attr('type');
            // url = '?'+$form.serialize();
            if ($('#pagen').length) {
                $('#pagen').val('1');
            }

            window.history.replaceState(null , null, '?'+$form.serialize());
            var url = window.location.href;
            progress.start(1.5);

        if(catalogAjax !== null ){
            catalogAjax.abort();
        }

        $catalog.addClass('preloader');
        catalogAjax = $.ajax({
            type: type,
            url: url,
            dataType: 'html',
            success: function(data){
                if ($(data).find('.b-catalog-list').html()) {
                    $catalog.html($(data).find('.b-catalog-list').html());
                } else {
                    $catalog.html("<p>По Вашему запросу товаров не найдено.</p>")
                }
                $pagination.html($(data).find('.b-load-more-container').html());
            },
            complete: function(){
                $catalog.removeClass('preloader');
                progress.end();
            }
        })
    })

    $('.b-faq-item').accordion({
        active: false,
        header: "> .b-faq-header",
        collapsible: true,
        heightStyle: "content"
    });

    $("body").on("change", "#basket-sort", function(){
        BX.Sale.BasketComponent.sortSortedItems(true);
        BX.Sale.BasketComponent.shownItems = [];
        $("#basket-item-table").html("");
        BX.Sale.BasketComponent.initializeBasketItems();
    });

    function disableDates(){
        var date = $("select#delivery").attr("data-date"),
            deliveryID = $("select#delivery").val();

        $("select#date option").each(function(){
            // if( deliveryID != 4 && $(this).attr("data-isSunday") == "Y" ){
            //     date++;
            // }
            if( $(this).index() < date || ( deliveryID != 32 && $(this).attr("data-isSunday") == "Y" )  || $(this).attr("data-disabled") == "Y"){
                $(this).prop("disabled", true);
            }else{
                $(this).prop("disabled", false);
            }
        });

        if( deliveryID == 53 || deliveryID == 54 || deliveryID == 55 || deliveryID == 30 || deliveryID == 120 ){
            $("select#date").prop( "disabled", true );
        }else{
            $("select#date").prop( "disabled", false );
        }

        // if( !$('select#date option:not([disabled]):selected').length ){
            $("select#date").val( $('select#date option:not([disabled]):first').attr("value") );
        // }
    }

    $(".b-catalog-slider").each(function(){
        $(this).slick({
            dots: false,
            slidesToShow: $(this).hasClass("b-limit")?5:4,
            slidesToScroll: $(this).hasClass("b-limit")?5:4,
            infinite: true,
            cssEase: 'ease', 
            speed: 500,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
            nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
            touchThreshold: 100,
            responsive: [
                {
                    breakpoint: 1150,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    });

    function tabs_slider(){

        $('.b-catalog-tabs-slider').each(function(){
            // var tabs_count = $(this).find('.b-tab').length;
            $(this).slick({
                dots: false,
                arrows: false,
                slidesToShow: 3,
                infinite: true,
                slidesToScroll: 1,
                cssEase: 'ease', 
                speed: 500,
                variableWidth: true,
                prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
                nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
                touchThreshold: 100,
                focusOnSelect: true,
                touchMove: true,
                swipeToSlide: true,
            });

        });
    };

    function advSlider(){
        $('.about-advantages').each(function(){
            $(this).slick({
                dots: false,
                slidesToShow: 1,
                infinite: true,
                slidesToScroll: 1,
                cssEase: 'ease', 
                speed: 500,
                variableWidth: true,
                centerMode: true,
                centerPadding: '10px',
                prevArrow: '<button type="button" class="slick-prev slick-arrow icon-arrow"></button>',
                nextArrow: '<button type="button" class="slick-next slick-arrow icon-arrow"></button>',
                touchThreshold: 100,
                focusOnSelect: true,
                touchMove: true,
                swipeToSlide: true,
                adaptiveHeight: true
            });

        });
    }

    $(document).on('beforeChange', '.b-catalog-tabs-slider', function(event, slick, currentSlide, nextSlide){
        $(this).find("[data-slick-index='"+nextSlide+"']").trigger('click');
    });

    $('.b-tab').on('click', function(){

        if (!$(this).parent().hasClass('b-tab-links')) {
            var tab = $(this).attr('data-tab');
            $(this).siblings().removeClass('active');
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
            }

            if (!$(this).parents('.b-tabs-container').hasClass('ajax-tabs')) {
                $(this).parents('.b-tabs-container').siblings('.b-tab-item').addClass('hide');
                if ($('#'+tab).hasClass('hide')) {
                     $('#'+tab).removeClass('hide');
                }
            } else {
                $('.b-catalog-form').find('#data-tab').val(tab);
                $('.b-catalog-form').trigger('change');
            }
        }

    });

    $(".b-reviews-count p").click(function(){
        if( $(".b-detail-reviews").length ){
            $("body, html").animate({
                scrollTop : $(".b-detail-reviews").offset().top + 1
            }, 300);
        }
    });

    $('.b-review-input .b-star').hover(function(){

        var index = parseInt($(this).index()) + 1;

        $(this).parent().find('.b-star').each(function(){
            $(this).css('color', '#CCC');
            if ($(this).index() < index) {
                $(this).css('color', '#FFAC00');
            }
        });
    })

    $('.b-review-input .b-star').mouseout(function() {
        $(this).parent().find('.b-star').css('color', '');
    });

    $('.b-review-input .b-star').on('click', function(){

        var index = parseInt($(this).index()) + 1;
        $(this).parent().removeClass('b-stars-0 b-stars-1 b-stars-2 b-stars-3 b-stars-4 b-stars-5');
        $(this).parent().addClass(('b-stars-'+index));
        $(this).parents('.b-review-input').find('input').val(index);

    });

    $('.item-review-btn').on('click', function(){ // добавить id товара в action формы

        var form = $('#b-review-form').find('form')
        var text = form.attr('action');
        var term = "product_id=";
        var id = $(this).attr('data-id');

        if (text.indexOf(term) != -1){
            if (text.indexOf(term) + term.length == text.length) {
                form.attr('action', text + id);
            }
        }
            
    });

    if ($('#pluploadCont').length){

        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : 'pickfiles', // you can pass an id...
            container: document.getElementById('pluploadCont'), // ... or DOM Element itself
            url : $('#b-form-review').attr("data-file-action"),
            multi_selection: false,
            resize: {
                preserve_headers: false
            },
            
            filters : {
                max_file_size : '20mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg,gif,png"},
                    {title : "Documents", extensions : "doc,docx,pdf,rtf,xls,xlsx"},
                    {title : "Archive", extensions : "zip,rar,7z"},
                ]
            },

            init: {
                PostInit: function() {
                    // var msgNoSupport = document.getElementById('plupload-no-support');
                    // msgNoSupport.parentNode.removeChild(msgNoSupport);
                    
                },
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        if (up.files.length > 1) {
                            up.removeFile(up.files[0]);
                        }

                        $("#original_filename").val(file.name);
                        document.getElementById("pickfiles").className = "attach successful";
                    });
                    up.start();
                    
                },
                UploadProgress: function(up, file) {
                    document.getElementById("pickfiles").innerHTML = "Загрузка&nbsp;" + file.percent + "%";
                },
                FileUploaded: function(up, file, res) {
                    document.getElementById("pickfiles").innerHTML = "Файл прикреплен";
                    document.getElementById("pickfiles").className = "attach successful";
                    var json = JSON.parse(res.response);
                    $("#random_filename").val(json.filePath); 
                    // console.log(res.response);
                },
                Error: function(up, err) {
                    // alert("При загрузке файла произошла ошибка.\n" + err.code + ": " + err.message);
                    if (err.code == -600) {
                        document.getElementById("pickfiles").innerHTML = "Файл слишком большой";
                        document.getElementById("pickfiles").className = "attach error";
                    };
                    if (err.code == -601) {
                        document.getElementById("pickfiles").innerHTML = "Неверный формат файла";
                        document.getElementById("pickfiles").className = "attach error";
                    };
                }
            }
        });
        uploader.init();
    }

     if ($('#add-photo').length){

        var uploaderAddPhoto = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : 'pickfiles', // you can pass an id...
            container: document.getElementById('add-photo'), // ... or DOM Element itself
            url : $('#b-popup-add-work-form').attr("data-file-action"),
            multi_selection: true,
            filters : {
                max_file_size : '20mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg,gif,png"},
                    {title : "Documents", extensions : "doc,docx,pdf,rtf,xls,xlsx"},
                    {title : "Archive", extensions : "zip,rar,7z"},
                ]
            },
            init: {
                PostInit: function() {
                    
                },
                FilesAdded: function(up, files) {
                    progress.start(1.5);
                    plupload.each(files, function(file) {
                        
                    });
                    up.start();
                },
                UploadProgress: function(up, file) {
                    $('.b-popup-add-link.icon-add-photo:before').css('content', '\e922');
                },
                FileUploaded: function(up, file, res) {
                    var json = JSON.parse(res.response);

                    var block = 
                    '<div class="b-popup-add-photo" style="background-image:url(\'/upload/tmp/'+json.filePath+'\')">'+
                        '<a href="#" class="work-delete">'+
                            '<div></div>'+
                            '<div></div>'+
                        '</a>'+
                        '<input id="work-'+json.filePath+'", type="hidden", name="work-'+json.filePath+'", value="'+json.filePath+'">'+
                    '</div>';

                    $(block).appendTo('#b-popup-add-photo-list');
                    // $('<input>',{id:'work-'+json.filePath, type:'hidden', name:'work-'+json.filePath, value: json.filePath}).appendTo('#add-photo');
                    // $('<div>',{class:'b-popup-add-photo', style:'background-image:url("/upload/tmp/'+json.filePath+'")'}).appendTo('#b-popup-add-photo-list');
                },
                Error: function(up, err) {
                    // alert("При загрузке файла произошла ошибка.\n" + err.code + ": " + err.message);
                    if (err.code == -600) {
                        $("#pickfiles").innerHTML = "Файл слишком большой";
                        $("#pickfiles").addClass('error');
                    };
                    if (err.code == -601) {
                        $("#pickfiles").innerHTML = "Неверный формат файла";
                        $("#pickfiles").addClass('error');
                    };
                },
                UploadComplete: function() {
                    progress.end();
                }
            }
        });
        uploaderAddPhoto.init();
    }

    if( $('.menu-accordion').length ){
        $('.menu-accordion').accordion({
            header: "> div > h3",
            collapsible: true,
            heightStyle: "content",
            active: false
        });
    }

    if( $('.b-accordion-item').length ){
        $('.b-accordion-item').accordion({
            header: ">h3",
            collapsible: true,
            heightStyle: "content",
            active: false
        });
    }

    if( $('.b-delivery-accordion-inner-item').length ){
        $('.b-delivery-accordion-inner-item').accordion({
            header: "h4",
            collapsible: true,
            heightStyle: "content",
            active: false
        });
    }

    if( isIE() ){
        $("body").on('mousedown click', ".b-input input, .b-input textarea", function(e) {
            $(this).parents(".b-input").addClass("focus");
        });
    }

    $("body").on("focusin", ".b-input input, .b-input textarea", function(){
        $(this).parents(".b-input").addClass("focus");
    });

    $("body").on("change", ".b-input select", function(){
        if( $(this).val() != ""){
            $(this).parents(".b-input").addClass("not-empty");
        }else{
            $(this).parents(".b-input").removeClass("not-empty");
        }
    });

    $("body").on("focusout", ".b-input input, .b-input textarea", function(){
        $(this).parents(".b-input").removeClass("focus");
        if( $(this).val() != "" && $(this).val() != "+7 (   )    -  -  " ){
            $(this).parents(".b-input").addClass("not-empty");
        }else{
            $(this).parents(".b-input").removeClass("not-empty");
        }
    });

    function isIE() {
        var rv = -1;
        if (navigator.appName == 'Microsoft Internet Explorer')
        {
            var ua = navigator.userAgent;
            var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat( RegExp.$1 );
        }
        else if (navigator.appName == 'Netscape')
        {
            var ua = navigator.userAgent;
            var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat( RegExp.$1 );
        }
        return rv == -1 ? false: true;
    }

    $('.b-addressee-switch').on('click', function(){
        if($('.b-addressee-left').hasClass("active")){//Вход
            $('.b-addressee-left').removeClass("active");
            $('.b-addressee-right').addClass("active");
            $('#b-form-auth').addClass("hide");
            $('#b-form-reg').removeClass("hide");
        }else{//Регистрация
            $('.b-addressee-right').removeClass("active");
            $('.b-addressee-left').addClass("active");
            $('#b-form-reg').addClass("hide");
            $('#b-form-auth').removeClass("hide");
        }
        return false;
    });

    $('.edit-checkbox').on('change', function(){
        if ($('.edit-pass-cont').hasClass('hide')) {
            $('.edit-pass-cont').removeClass('hide');
            $('.edit-pass-cont').find('input').prop({disabled: false, required: true});
        } else {
            $('.edit-pass-cont').addClass('hide');
            $('.edit-pass-cont').find('input').prop({disabled: false, required: true}).removeClass('error valid').val('');
            $('.pass-error').addClass('hide');
        }
    });

    if ($('#editForm').length && typeof(plupload) == "object"){

        if($('.b-profile-photo').hasClass("has-photo")){
            $('.b-profile-photo .icon-add-photo').addClass("hide");
            $('.b-profile-photo .icon-change-photo').removeClass("hide");
        }

        var uploaderEdit = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : 'pickfilesEdit',
            container: document.getElementById('editForm'),
            url : $('#editForm').attr("data-file-action"),
            multi_selection: false,
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg,gif,png,bmp"},
                ]
            },
            resize: {
                preserve_headers: false
            },
            init: {
                PostInit: function() {
                    
                },
                FilesAdded: function(up, files) {
                    progress.start(1.5);
                   
                    // $.each(files, function(){
        
                    //     var img = new moxie.Image();

                    //     img.onload = function() {
                    //         this.embed($('#preview').get(0), {
                    //             width: 100,
                    //             height: 100,
                    //             crop: true
                    //         });
                    //     };

                    //     img.onembedded = function() {
                    //         this.destroy();
                    //     };

                    //     img.onerror = function() {
                    //         this.destroy();
                    //     };

                    //     img.load(this.getSource());
                    // })

                    up.start();
                },
                UploadProgress: function(up, file) {

                },
                FileUploaded: function(up, file, res) {
                    var json = JSON.parse(res.response);
                    if(json){
                        $('#photo').remove();//удалить input с предыдущим фото
                        $('.b-profile-photo').removeClass('icon-add-photo').css('background-image', 'url("/upload/tmp/'+json.filePath+'")');
                        $('.b-profile-photo .icon-add-photo').addClass("hide");
                        $('.b-profile-photo .icon-change-photo').removeClass("hide");
                        $('<input>',{id:'photo', type:'hidden', name:'user[PERSONAL_PHOTO]', value: json.filePath}).appendTo('#editForm');
                    }
                },
                Error: function(up, err) {
                    // alert("При загрузке файла произошла ошибка.\n" + err.code + ": " + err.message);
                    if (err.code == -600) {
                        $("#pickfilesEdit").innerHTML = "Файл слишком большой";
                        $("#pickfilesEdit").addClass('error');
                    };
                    if (err.code == -601) {
                        $("#pickfilesEdit").innerHTML = "Неверный формат файла";
                        $("#pickfilesEdit").addClass('error');
                    };
                },
                UploadComplete: function() {
                    progress.end();
                }
            }
        });
        uploaderEdit.init();
    }

    if( $(".sticky").length && myWidth > 1150){
        Stickyfill.add($('.sticky'));
    }

    $(document).on('click', '.b-load-more-works', function(){
        var $container = $(this).parents('.pagination-container'),
            $list = $container.find('.pagination-list'),
            $pagination = $container.find('.b-load-more-container'),
            $this = $(this),
            url = $(this).attr('href');
        $container.addClass('preloader');
        if (!$this.hasClass('b-load-more-works')) {
            $("body, html").animate({
                scrollTop : $container.offset().top - 150
            },800);
        }
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){

                    if ($this.hasClass('b-load-more-works')) {
                        $list.append($(data).find('.pagination-list').html());
                    } else { 
                        $list.html($(data).find('.pagination-list').html());
                    }

                    $pagination.html($(data).find('.b-load-more-container').html());
                },
                complete: function(){
                    $pagination.remove();
                    $container.removeClass('preloader');
                }
            })
        }
        return false;
    });

    // // Первая анимация элементов в слайде
    // $(".b-step-slide[data-slick-index='0'] .slider-anim").addClass("show");

    // // Кастомные переключатели (тумблеры)
    // $(".b-step-slider").on('beforeChange', function(event, slick, currentSlide, nextSlide){
    //     $(".b-step-tabs li.active").removeClass("active");
    //     $(".b-step-tabs li").eq(nextSlide).addClass("active");
    // });

    // // Анимация элементов в слайде
    // $(".b-step-slider").on('afterChange', function(event, slick, currentSlide, nextSlide){
    //     $(".b-step-slide .slider-anim").removeClass("show");
    //     $(".b-step-slide[data-slick-index='"+currentSlide+"'] .slider-anim").addClass("show");
    // });


    if ($('#contacts-map').length) {
        var myPlace = new google.maps.LatLng(55.754407, 37.625151);
        var myOptions = {
            zoom: 16,
            center: myPlace,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true
        }
        var map = new google.maps.Map(document.getElementById("contacts-map"), myOptions); 

        var marker = new google.maps.Marker({
            position: myPlace,
            map: map,
            title: "Первый магазин"
        });
    }

});

function getPriceK(region){
    var regions = [
        'Амурская',
        'Камчатский',
        'Магаданская',
        'Приморский',
        'Саха /Якутия/',
        'Сахалинская',
        'Хабаровский',
        'Чукотский',

        'Алтайский',
        'Забайкальский',
        'Иркутская',
        'Красноярский',
        'Кемеровская',
        'Новосибирская',
        'Омская',
        'Алтай',
        'Бурятия',
        'Тыва',
        'Хакасия',
        'Томская',

        'Курганская',
        'Свердловская',
        'Тюменская',
        'Ханты-Мансийский Автономный округ - Югра',
        'Челябинская',
        'Ямало-Ненецкий',

        'Карелия',
        'Коми',
        'Архангельская',
        'Ненецкий',
        'Мурманская',
    ];

    for( var i in regions ){
        if( region.indexOf(regions[i], 0) !== -1){
            return 2
        }
    }
    return 1;
}

function pickPointHandler(object){
    $(".pickpointinfo").remove();
    $( "#pickpoint-delivery-point" )
        .html( object.name + '<br />' + object.address )
        .after( '<input type="hidden" class="pickpointinfo" name="ORDER_PROP_19" value="' + object.id + '" />' )
        .after( '<input type="hidden" class="pickpointinfo" name="ORDER_PROP_18" value="' + object.name + '" />' )
        .after( '<input type="hidden" class="pickpointinfo pickpointaddr" name="ORDER_PROP_7" value="' + object.address + '" />' );

    $(".b-postamat-error").remove();

    $( window ).trigger( 'pickpoint_ready' );
}