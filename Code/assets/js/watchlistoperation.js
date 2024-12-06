// JavaScript Document
//js function for adding product to watchlist
function addWatchItem(obj,user_id) {
    console.log('tester');
    if (user_id == undefined || user_id == null || user_id == '') {

        loginRegister();
        return ;
    }
    $product_id = $(obj).data('product');
    $user_id = $(obj).data('user');
    $url = $(obj).data('url');
    $watch_url = $url + "home/add_product_watchlist/";
    //console.log($product_id + ' : ' + $user_id + " : " + $url);

    //ajax to add 
     $('.img-loader').removeClass('hidden');
    jQuery.ajax({
        type: "POST",
        url: $watch_url,
        data: {
            product_id: $product_id,
            user_id: $user_id
        },
        success: function(data) {
            // alert(data);
             $('.img-loader').addClass('hidden');
            if (data == 'success') {
                //$('#watch-response_' + $product_id).html('Added');
// alert(data);
                console.log(data);
                $('#addWatchList_' + $product_id).addClass('watched');               
                $('#addWatchList_' + $product_id).attr("data-original-title", "You have added this product to your watchlist");
                $('#addWatchList_' + $product_id).attr("title", "You have added this product to your watchlist");
                $('#addWatchList_' + $product_id).attr("onclick", "return removeCheckedWatchItem(this)");
                $('#heart' + $product_id ).removeClass('fa-heart-o');
                $('#heart' + $product_id).addClass('fa-heart');
                setTimeout(function() {
                    $('#watch-response_' + $product_id).hide()
                }, 5000);
                //alert('watchlist added successfully');

            } else {
                //$('#watch-response_' + $product_id).html('Error');
                setTimeout(function() {
                    $('#watch-response_' + $product_id).hide()
                }, 5000);
                //alert('unable to add watchlist');			   	
            }
        },
        error: function(request, status, error) {
            //alert(request.responseText);
            $('#watch-response_' + $product_id).html('System Error');
            setTimeout(function() {
                $('#watch-response_' + $product_id).hide()
            }, 5000);
        }
    });
    //alert($product_id + " : " + $user_id);
}

// This function removes watchlist product by clicking checked item
function removeCheckedWatchItem(obj) {
    //alert('triggered');
    $product_id = $(obj).data('product');
    $user_id = $(obj).data('user');
    $url = $(obj).data('url');
    $r_url = $url + 'home/remove_product_watchlist'
        //console.log($product_id + ' : ' + $user_id + " : " + $url);
 $('.img-loader').removeClass('hidden');
    //ajax to add 
    jQuery.ajax({
        type: "POST",
        url: $r_url,
        data: {
            product_id: $product_id,
            user_id: $user_id
        },
        success: function(data) {
             $('.img-loader').addClass('hidden');
            //alert(data);
            if (data == 'success') {
               $('#addWatchList_' + $product_id).removeClass('watched');
                $('#addWatchList_' + $product_id).attr("data-original-title", "Add to watch list");
                $('#addWatchList_' + $product_id).attr("title", "Add to watch list");
                $('#addWatchList_' + $product_id).attr("onclick", "return addWatchItem(this,"+$user_id+")");
                $('#heart' + $product_id).removeClass('fa-heart');
                $('#heart' + $product_id ).addClass('fa-heart-o');
                
            } else {
                //do nothing
                //alert('Error Occured');       
            }
        },
        error: function(request, status, error) {
            //alert(request.responseText);
            $('#watch-response_' + $product_id).html('System Error');
            setTimeout(function() {
                $('#watch-response_' + $product_id).hide()
            }, 5000);
        }
    });
    //alert($product_id + " : " + $user_id);
}

function removeWatchItem(obj) {
    //alert('triggered');
    $product_id = $(obj).data('product');
    $user_id = $(obj).data('user');
    $url = $(obj).data('url');
    $r_url = $url + '/home/remove_product_watchlist'
        //console.log($product_id + ' : ' + $user_id + " : " + $url);

    //ajax to add 
    jQuery.ajax({
        type: "POST",
        url: $r_url,
        data: {
            product_id: $product_id,
            user_id: $user_id
        },
        success: function(data) {
            //alert(data);
            if (data == 'success') {
                $('#watchtr_' + $product_id).hide(3000);

            } else {
                //do nothing
                //alert('Error Occured');   	
            }
        },
        error: function(request, status, error) {
            //alert(request.responseText);
            $('#watch-response_' + $product_id).html('System Error');
            setTimeout(function() {
                $('#watch-response_' + $product_id).hide()
            }, 5000);
        }
    });
    //alert($product_id + " : " + $user_id);
}




function deleteBulkWatchList(url) {
    if ($(".selectall").prop('checked') == true) {

        job = confirm("Are you sure to delete permanently?");
        if (job != true) {
            return false;
        } else {
            $full_url = url + '/home/remove_watchlist_products_in_batch'
            //console.log(url + ' : ' + $full_url);
            //ajax to remove 
            jQuery.ajax({
                type: "POST",
                url: $full_url,
                data: $("#watchedProducts").serialize(),
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    //console.log(obj);
                    $totalRemoved = obj.totalRemoved;

                    if (obj.response == 'success') {
                        delete obj['response'];
                        delete obj['totalRemoved'];
                        //console.log(obj);
						$(".selectall").prop('checked', false); 
                        $('#bulkRemoveMessage').show(3000);
                        $('#bulkRemoveMessage').removeClass('error').addClass('text-success');
                        $('#bulkRemoveMessage').html(bulkRemoveSuccess);

                        //foreach loop to hide deleted rows
                        $.each(obj, function(key, value) {
                            $('#watchtr_' + value).hide(3000);
                            //console.log(key + ":" + value);
                        });

                    } else {
                        //do nothing
                        //alert('Error Occured');
                        $('#bulkRemoveMessage').show(3000);
                        $('#bulkRemoveMessage').removeClass('text-success').addClass('error');
                        $('#bulkRemoveMessage').html(bulkRemoveError);
                    }
                },
                error: function(request, status, error) {
                    //alert(request.responseText);
                    $('#bulkRemoveMessage').show(3000);
					$('#bulkRemoveMessage').removeClass('text-success').addClass('error');
                 	$('#bulkRemoveMessage').html(bulkRemoveError);
                }
            });
        }
    } else {
        $('#bulkRemoveMessage').show();
        $('#bulkRemoveMessage').removeClass('text-success').addClass('error');
        $('#bulkRemoveMessage').html(bulkRemoveNotChecked);
    }
}