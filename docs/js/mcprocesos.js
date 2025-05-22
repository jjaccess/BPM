function agregarMcproceso() {
	var mcproceso = $('#nombreMcproceso').val();

    if (mcproceso == "") {
        swal("Debes agregar un macro proceso");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:"mcproceso=" + mcproceso,
            url:"../procesos/mcprocesos/agregarMcproceso.php",
            success:function(respuesta){
            respuesta = respuesta.trim();
                if (respuesta == 1) {
                    $('#nombreMcproceso').val("");
                    swal(":D", "Agregado con éxito!", "success");
                    $('#tablaMcprocesos').load("mcprocesos/tablaMcproceso.php");
                } else {
                    swal(":(", "Fallo al agregar!", "error");
                }                
            }
        });
    }
}

function eliminarMcproceso(idMcproceso) {
	idMcproceso = parseInt(idMcproceso);
	if (idMcproceso < 1 ) {
		swal("No tenes id de Macro Proceso!");
		return false;
	} else {
  		//**************************************************
  		swal({
  			title:"Está seguro de elimina éste registro?",
  			text: "Una vez eliminado, no podrá recuperarse!",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  		  if (willDelete) {
  				$.ajax({
  					type:"POST",
  					data:"idMcproceso=" + idMcproceso,
  					url:"../procesos/mcprocesos/eliminarMcproceso.php",
  					success:function(respuesta){
                        respuesta = respuesta.trim();

                        if (respuesta == 1) {
                            $('#tablaMcprocesos').load("mcprocesos/tablaMcproceso.php");
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

function obtenerDatosMcproceso(idMcproceso) {
    $.ajax({
        type:"POST",
        data:"idMcproceso=" + idMcproceso,
        url:"../procesos/mcprocesos/obtenerMcproceso.php",
        success:function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idMcproceso').val(respuesta['idMcproceso']);
            $('#mcprocesoU').val(respuesta['nombreMcproceso']);
       }
    })
}

function actualizaMcproceso(){
    if ($('#mcprocesoU').val() == ""){
        swal("No hay proceso!!");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:$('#frmActualizarMcproceso').serialize(),
            url:"../procesos/mcprocesos/actualizaMcproceso.php",
            success:function(respuesta){
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#tablaMcprocesos').load("mcprocesos/tablaMcproceso.php");                    
                    swal(":D", "Actualizado con éxito", "success");
                    $('#btnCerrarUpdateMcproceso').click();
                } else {
                    swal(":(", "No se ha podido Actualizar!", "error");
                }
            }
        })
    }
}