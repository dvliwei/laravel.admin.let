/**
 * Created by liwei on 2018/5/24.
 */
/*
* 隐藏提示信息
* */
var labelKey;
var timedMsg = function (labelKey)
{
    var t=setTimeout(function(){
        console.log(labelKey);
        $(labelKey).attr('class','Hui-iconfont');
        $(labelKey).text('');
    },5000);
}

/**
 * 设置otc币种
 * @constructor
 */
var _token  = $('#_token').val();

var SetOtcInventory = function(){
    var inventory = $('.otc #otc-coin-count').val();

    if(inventory){
        $.post('/admin/os/setOtc',{symbol:'USDT' ,inventory:inventory,_token:_token},function(data,status){
            if(status && data.status==1){
                $('#otc-coin-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#otc-coin-mes').text(data.data.mag);
            }else{
                $('#otc-coin-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#otc-coin-mes').text(data.data.mag);
            }
        },'JSON');
    }
    timedMsg('#otc-coin-mes');
}

var setCoinBuyPrice = function(){
    var price = $('#coin-buy-price').val();
    if(price){
        $.post('/admin/os/setBuyCoin',{price:price, _token:_token},function(data,status){
            if(status && data.status==1){
                $('#coin-buy-price-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#coin-buy-price-mes').text(data.data.mag);
            }else{
                $('#coin-buy-price-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#coin-buy-price-mes').text(data.data.mag);
            }
        },'JSON');
    }
    timedMsg('#coin-buy-price-mes');
}

var setCoinSellPrice = function(){
    var price = $('#coin-sell-price').val();
    if(price){
        $.post('/admin/os/setSellCoin',{price:price, _token:_token},function(data,status){
            if(status && data.status==1){
                $('#coin-sell-price-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#coin-sell-price-mes').text(data.data.mag);
            }else{
                $('#coin-sell-price-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#coin-sell-price-mes').text(data.data.mag);
            }
        },'JSON');
    }
    timedMsg('#coin-buy-price-mes');

}


/**
 *
 *设置其它参数
 * @constructor
 */
var key ,idName   ,idNameMes ;
var  BuyOrderDuration = function(key,idName){
    idName = '#'+idName;
    idNameMes = idName+'-mes';
    var value = $(idName).val();
    if(value){
        $.post('/admin/os/setConfigures',{key:key ,value:value, _token:_token},function(data,status){
            if(status && data.status==1){
                $(idNameMes).attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $(idNameMes).text(data.data.mag);
            }else{
                $(idNameMes).attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $(idNameMes).text(data.data.mag);
            }
        },'JSON');
    }
    timedMsg(idNameMes);
}



/**
 * 查询otc库存
 */
$(function(){
    $.get('/admin/os/getOtc',{},function(data,status){
        var count = 0;
        if(status && data.status==1){
            count = data.data.inventory;
            $('#otc-coin-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
            $('#otc-coin-mes').text(data.data.mag);
        }else{
            $('#otc-coin-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
            $('#otc-coin-mes').text(data.data.mag);
        }
        $('.otc #otc-coin-count').val(count);
        $('.otc #otc-coin-count').removeAttr('readonly')
    },'JSON');
    timedMsg('#otc-coin-mes');


    //设置买价格接口
    $.get('/admin/os/getBuyCoin',{},function(data,status){
        var count = 0;
        if(status && data.status==1){
            count = data.data.price;
            $('#coin-buy-price-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
            $('#coin-buy-price-mes').text(data.data.mag);
        }else{
            $('#coin-buy-price-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
            $('#coin-buy-price-mes').text(data.data.mag);
        }
        $('#coin-buy-price').val(count);
        $('#coin-buy-price').removeAttr('readonly')
    },'JSON');
    timedMsg('#coin-buy-price-mes');

    //设置卖价格接口
    $.get('/admin/os/getSellCoin',{},function(data,status){
        var count = 0;
        if(status && data.status==1){
            count = data.data.outer_price;
            $('#coin-sell-price-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
            $('#coin-sell-price-mes').text(data.data.mag);
        }else{
            $('#coin-sell-price-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
            $('#coin-sell-price-mes').text(data.data.mag);
        }
        $('#coin-sell-price').val(count);
        $('#coin-sell-price').removeAttr('readonly')
    },'JSON');
    timedMsg('#coin-sell-price-mes');



    $.get('/admin/os/getConfigures',{},function(data,status){
        var count = 0;
        if(status && data.status==1){
            if(data.data.buy_order_duration){
                $('#buy-order-duration').val(data.data.buy_order_duration);
                $('#buy-order-duration-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#buy-order-duration-mes').text(data.data.mag);
            }else{
                $('#buy-order-duration-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#buy-order-duration-mes').text(data.data.mag);
            }
            timedMsg('#buy-order-duration-mes');

            if(data.data.buy_order_duration){
                $('#buy-order-lower-limit').val(data.data.buy_order_lower_limit);
                $('#buy-order-lower-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#buy-order-lower-limit-mes').text(data.data.mag);
            }else{
                $('#buy-order-lower-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#buy-order-lower-limit-mes').text(data.data.mag);
            }
            timedMsg('#buy-order-lower-limit-mes');


            if(data.data.buy_order_upper_limit){
                $('#buy-order-upper-limit').val(data.data.buy_order_upper_limit);
                $('#buy-order-upper-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#buy-order-upper-limit-mes').text(data.data.mag);
            }else{
                $('#buy-order-upper-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#buy-order-upper-limit-mes').text(data.data.mag);
            }
            timedMsg('#buy-order-upper-limit-mes');

            if(data.data.sell_order_duration){
                $('#sell-order-duration').val(data.data.sell_order_duration);
                $('#sell-order-duration-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#sell-order-duration-mes').text(data.data.mag);
            }else{
                $('#sell-order-duration-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#sell-order-duration-mes').text(data.data.mag);
            }
            timedMsg('#sell-order-duration-mes');

            if(data.data.sell_order_lower_limit){
                $('#sell-order-lower-limit').val(data.data.sell_order_lower_limit);
                $('#sell-order-lower-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#sell-order-lower-limit-mes').text(data.data.mag);
            }else{
                $('#sell-order-lower-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#sell-order-lower-limit-mes').text(data.data.mag);
            }
            timedMsg('#sell-order-lower-limit-mes');


            if(data.data.sell_order_upper_limit){
                $('#sell-order-upper-limit').val(data.data.sell_order_upper_limit);
                $('#sell-order-upper-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#sell-order-upper-limit-mes').text(data.data.mag);
            }else{
                $('#sell-order-upper-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#sell-order-upper-limit-mes').text(data.data.mag);
            }
            timedMsg('#sell-order-upper-limit-mes');

            if(data.data.verification_code_duration){
                $('#verification-code-duration').val(data.data.verification_code_duration);
                $('#verification-code-duration-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#verification-code-duration-mes').text(data.data.mag);
            }else{
                $('#verification-code-duration-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#verification-code-duration-mes').text(data.data.mag);
            }
            timedMsg('#verification-code-duration-mes');

            if(data.data.buy_order_daily_number_limit){
                $('#buy-order-daily-number-limit').val(data.data.buy_order_daily_number_limit);
                $('#buy-order-daily-number-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#buy-order-daily-number-limit-mes').text(data.data.mag);
            }else{
                $('#buy-order-daily-number-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#buy-order-daily-number-limit-mes').text(data.data.mag);
            }
            timedMsg('#buy-order-daily-number-limit-mes');

            if(data.data.buy_order_daily_volume_limit){
                $('#buy-order-daily-volume-limit').val(data.data.buy_order_daily_volume_limit);
                $('#buy-order-daily-volume-limit-mes').attr('class','Hui-iconfont c-success Hui-iconfont-shenhe-tongguo');
                $('#buy-order-daily-volume-limit-mes').text(data.data.mag);
            }else{
                $('#buy-order-daily-volume-limit-mes').attr('class','Hui-iconfont c-error Hui-iconfont-close2');
                $('#buy-order-daily-volume-limit-mes').text(data.data.mag);
            }
            timedMsg('#buy-order-daily-volume-limit-mes');

        }

    },'JSON');


});




