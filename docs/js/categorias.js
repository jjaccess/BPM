function agregarCategoria() {
var formData = new FormData(document.getElementById('frmCategorias'));
$.ajax({
    url:"../procesos/categorias/agregarCategoria.php",
    type:"POST",
    datatype: "html",
    data: formData,
    cache:false,
    contentType:false,
    processData:false,
    success:function(respuesta){ 
        console.log(respuesta);

          respuesta = respuesta.trim();
        
          if (respuesta == 1) {
            $('#frmCategorias')[0].reset();
            $('#tablaCategorias').load("categorias/tablaCategoria.php");
            swal(":D", "Agregado con éxito!", "success");
        } else {
            swal(":(", "Error al agregar!", "error");
        }
    }
});
}

function eliminarCategoria(idCategoria) {
	idCategoria = parseInt(idCategoria);
	if (idCategoria < 1 ) {
		swal("No tenes id de categoria!");
		return false;
	} else {
  		//**************************************************
  		swal({
  			title:"Está seguro de elimina ésta categoria?",
  			text: "Una vez eliminada, no podrá recuperarse!",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  		  if (willDelete) {
  				$.ajax({
  					type:"POST",
  					data:"idCategoria=" + idCategoria,
  					url:"../procesos/categorias/eliminarCategoria.php",
  					success:function(respuesta){
                        respuesta = respuesta.trim();

                        if (respuesta == 1) {
                            $('#tablaCategorias').load("categorias/tablaCategoria.php");
                            swal("Eliminado con éxito!", {
                                icon: "success",
                            });

                        } else {
                            swal(":(","Fallo al eliminar!","error");
                        }
                    }
  				});
  			}
        });
    }
}

function obtenerDatosCategoria(idCategoria) {
    $.ajax({
        type:"POST",
        data:"idCategoria=" + idCategoria,
        url:"../procesos/categorias/obtenerCategoria.php",
        success:function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idCategoria').val(respuesta['idCategoria']);
            $('#categoriaU').val(respuesta['nombreCategoria']);
       }
    })
}

function actualizaCategoria(){
    if ($('#categoriaU').val() == ""){
        swal("No hay categoria!!");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:$('#frmActualizarCategoria').serialize(),
            url:"../procesos/categorias/actualizaCategoria.php",
            success:function(respuesta){
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#tablaCategorias').load("categorias/tablaCategoria.php");                    
                    swal(":D", "Actualizado con éxito", "success");
                    $('#btnCerrarUpdateCategoria').click();
                } else {
                    swal(":(", "No se ha podido Actualizar!", "error");
                }
            }
        })
    }
}