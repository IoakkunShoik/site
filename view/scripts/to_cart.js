
    function clicked(id){
        $.ajax({
            url: ["?page=hidden&to_cart="+ id],
            success: function(){
                console.log(id +  " success");
            }
        });
    }
