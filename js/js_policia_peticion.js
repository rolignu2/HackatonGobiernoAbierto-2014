 
 function Police_Responsive_delegacion(){

        var parametros = {
                'info' : informacion
        };
        $.ajax({
                data:  parametros,
                url:    r,
                type:  'post',
                beforeSend: function () {
                        $("#informacion-delegacion").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#informacion-delegacion").html(response);
                }
       });
 }
    

