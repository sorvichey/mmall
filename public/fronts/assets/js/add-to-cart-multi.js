

// when user detail product then making add to cart
function add_to_cart_m(obj, evt) {
    evt.preventDefault();
    // var form_data = new FormData();
        // form_data.append('product_id', $(obj).data('id'));
        // form_data.append("buyer_id", $("#buyer_id").val());
        var data = $("#variations_form").serialize();
        alert(data);
        $.ajax({
            url:burl + '/buyer/wish/save',
            data: form_data,
            type: 'POST',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success:function(sms){
                $(obj).attr("href", burl + "/buyer/wishlist").html(
                    '<span> Added to</span><span class="text-primary"> wish list</span>'
                );
                $(obj).removeAttr('onclick');
            },
        });
}