        $.ajax({
            type: 'GET',
            url:burl + '/buyer/wishlist/count',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            success:function(data){
                console.log(data);
                $("#count_wishlist").text(data);
            }
        });
