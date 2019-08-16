//To slide up alert
$(document).ready(function(){
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });

    $('.btn_product_update').click(function(){
        var product_image = $('.product_image').val();
        if(product_image == '')
        {
            alert("Please select image for product!");
            $('.product_image').addClass('error');
        }
        else
        {
            $('.product_image').addClass('success');
        }
    });
});

//Counter is set from here.
$('.bidding_time').ready(function(){
    $('.bidding_time').each(function(){      
                var id = $(this).attr('auction_id');
                var auction_ends_at = $(this).attr('auction_ends_at');
                var date_auction_ends_at = new Date(auction_ends_at);
        
                if(date_auction_ends_at < new Date())
                {
                    $('#start_bidding'+id).show();
                    $('#bidding_time'+id).css('display','none');
                    // timer(id);
                    timer_add_hours(date_auction_ends_at,id);
                }
                else
                {
                    setCountdown(date_auction_ends_at,id);
                    $('#start_bidding'+id).hide();
                    $('#bidding_time'+id).css('display','');
                }
                
                var xyz = document.getElementById("credits_div");
                
                if(xyz.innerHTML.length == 55)
                {
                    $('#start_bidding'+id).hide();
                }
                else
                {
                    $('#start_bidding'+id).click(function(){
                        var lastBidderId = $('#user_id').val();
                        var auctionedProductId = $('#product_id'+id).val();
                        var creditsPerBid = $('#credits_per_bid'+id).val();
                        var _token = $('meta[name="csrf-token"]').attr('content');
                       
                        $.ajax({
                            url : '/buyer/start-bid',
                            type : 'post',
                            // datatype: "json",
                            // async: false, //To access ajax result out side the class
                            data : {'lastBidderId':lastBidderId, 'auctionedProductId':auctionedProductId,'creditsPerBid':creditsPerBid,'_token':_token},
                            success: function(result)
                            {
                                // console.log(result);
                                $('#credits_div').load(document.URL +  ' #credits_div');
                            },
                            error: function(result)
                            {
                                // console.log(result);
                            }
                        });
                    });
                }
        lastBidderName(id);
    });
});

//Last Bidder Name return from this function
function lastBidderName(id) {
    $('.start_bidding').ready(function(){
        $('.start_bidding').each(function(){

            var lastBidderId = $('#user_id').val();
            var auctionedProductId = $('#product_id'+id).val();
            var _token = $('meta[name="csrf-token"]').attr('content');

            f1();
            function f1()
            {   
                $.ajax({
                    url : 'buyer/last-bidder-name',
                    type : 'post',
                    data : {'lastBidderId':lastBidderId, 'auctionedProductId':auctionedProductId, '_token':_token},
                    success: function(result)
                    {       
                            $('#last_bidder_id'+id).text(result);
                            f1();
                            // console.log(result);
                    },
                    error: function(result)
                    {
                        // console.log(result);
                    }  
                })
            }
            setInterval(function(){
                    f1();
            },2000);
        });
    });
    // CSRF token setting.!Note : This is neccersary to define this $.ajaxSetup() method. 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

//function for set countdown on product display to buyer
function setCountdown(time,id){
    const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

    let countDown = time.getTime(),
    x = setInterval(function() 
    {
    
    let now = new Date().getTime(),
        distance = countDown - now;

    var days = "days" + id;
    var hours = "hours" + id;
    var minutes = "minutes" + id;
    var seconds = "seconds" + id;

    document.getElementById(days).innerHTML = (Math.floor(distance / (day))),
    document.getElementById(hours).innerHTML = (Math.floor((distance % (day)) / (hour))),
    document.getElementById(minutes).innerHTML = (Math.floor((distance % (hour)) / (minute))),
    document.getElementById(seconds).innerHTML = (Math.floor((distance % (minute)) / (second)));

    //do something later when date is reached.
    if (distance < 0) {
        clearInterval(x);
        window.location.reload(true);
    }
    }, 1000)
}

//function for After product ready to be auctioned (3 hours auction).
function timer_add_hours(time,id){

    var dt = time;
    dt.setHours( dt.getHours() + 3 );
    
    const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

    let countDown = dt.getTime(),
    x = setInterval(function() 
    {
    
    let now = new Date().getTime(),
        distance = countDown - now;

    var countdowntimer = "countdowntimer" + id;
    document.getElementById(countdowntimer).innerHTML = (Math.floor((distance % (day)) / (hour))) + ':' + (Math.floor((distance % (hour)) / (minute))) +':' + (Math.floor((distance % (minute)) / (second)));
    
    //do something after 3 hours are completed.
    if (distance < 0) {
        clearInterval(x);
        $('#start_bidding'+id).hide();
        $('#bidding_time'+id).css('display','none');
        $('#countdowntimer'+id).hide();
        $('#winner'+id).show();
        
    }
    }, 1000)   
}

//Loader Image script
$(window).on('load',function(){
    // To apply hide() to all id which has prefix "start_bidding"
    // $('a[id^="start_bidding"]').hide();
    
    // PAGE IS FULLY LOADED  
    // FADE OUT YOUR OVERLAYING DIV
    $('.loader').fadeOut(1000);
});

/**
 * Auction Winners List
 */