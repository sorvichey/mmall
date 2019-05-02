

    // add quantity
    $('body').on('click', '.add_qty', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var action = " add"
        $.ajax({
            method: "POST",
            url: burl+"/buyer/mycart/update",
            data: 
            {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "action": action 
            },
            success:function(data){
                $("#qty").text(data);
            }
        });
    });

    //sub quantity
    $('body').on('click', '.sub_qty', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var action = "sub";
        $.ajax({
            method: "POST",
            url: burl+"/buyer/mycart/update",
            data: 
            {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "action": action 
            },
            success:function(data){
                $("#qty").text(data);
            }
        });
    });