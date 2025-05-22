function agregarUsuario() {
var formData = new FormData(document.getElementById('frmUsuarios'));
$.ajax({
    url:"../procesos/usuarios/agregarUsuario.php",
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
            $('#frmUsuarios')[0].reset();
            $('#tablaUsuarios').load("usuarios/tablaUsuarios.php");
            swal(":D", "Usuario agregado con éxito!", "success");
        } else {
            swal(":(", "Error al agregar!", "error");
        }
    }
});
}

function eliminarUsuario(idCategoria) {
	idCategoria = parseInt(idCategoria);
	if (idCategoria < 1 ) {
		swal("No tenes id de categoria!");
		return false;
	} else {
  		//**************************************************
  		swal({
  			title:"Está seguro de eliminar esté Usuario?",
  			text: "Una vez eliminado, no podrá recuperarse!",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  		  if (willDelete) {
  				$.ajax({
  					type:"POST",
  					data:"idCategoria=" + idCategoria,
  					url:"../procesos/usuarios/eliminarUsuario.php",
  					success:function(respuesta){
                        respuesta = respuesta.trim();

                        if (respuesta == 1) {
                            $('#tablaUsuarios').load("usuarios/tablaUsuarios.php");
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

function obtenerDatosUsuario(idCategoria) {
    $.ajax({
        type:"POST",
        data:"idCategoria=" + idCategoria,
        url:"../procesos/usuarios/obtenerUsuario.php",
        success:function(respuesta) {
            console.log(respuesta);
            respuesta = jQuery.parseJSON(respuesta);
            $('#idCategoria').val(respuesta['id']);
            $('#nombreU').val(respuesta['nombreU']);
            $('#correoU').val(respuesta['correoU']);
            $('#id_tipoU').val(respuesta['id_tipoU']);
            $('#activacionU').val(respuesta['activacionU']);
       }
    })
}


function obtenerDatosUsuarioR(idCategoria) {
    $.ajax({
        type:"POST",
        data:"idCategoria=" + idCategoria,
        url:"../procesos/usuarios/obtenerUsuarioR.php",
        success:function(respuesta) {
            console.log(respuesta);
            respuesta = jQuery.parseJSON(respuesta);
            $('#idR').val(respuesta['idR']);
            $('#nombreR').val(respuesta['nombreR']);
       }
    })
}

function actualizaUsuario(){
    if ($('#nombreU').val() == ""){
        swal("No hay datos!!");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:$('#frmActualizarUsuario').serialize(),
            url:"../procesos/usuarios/actualizaUsuario.php",
            success:function(respuesta){
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#tablaUsuarios').load("usuarios/tablaUsuarios.php");                   
                    swal(":D", "Actualizado con éxito", "success");
                    $('#btnCerrarUpdateUsuario').click();
                } else {
                    swal(":(", "No se ha podido Actualizar!", "error");
                }
            }
        })
    }
}

function resetUsuario(){
    if ($('#nombreR').val() == ""){
        swal("No hay datos!!");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:$('#frmResetUsuario').serialize(),
            url:"../procesos/usuarios/resetUsuario.php",
            success:function(respuesta){
                console.log(respuesta);
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#tablaUsuarios').load("usuarios/tablaUsuarios.php");                   
                    swal(":D", "Reset con éxito password por defecto: 123456", "success");
                    $('#btnCerrarResetUsuario').click();
                } else {
                    swal(":(", "Error en reset!", "error");
                }
            }
        })
    }
}

