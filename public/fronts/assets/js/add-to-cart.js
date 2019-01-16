function add_to_cart(obj, id)
{
        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
        $.ajax({
           type:'POST',
           url:'/buyer/cart/save',
           data:{p_id:id},
           success:function(data){
              $('#count_cart').text(data);
           },
           error:function(e){
            console.log(e);
           }
        });
}