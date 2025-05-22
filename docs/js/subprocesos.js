function agregarProceso() {
    var formData = new FormData(document.getElementById('frmProcesos'));
    $.ajax({
        url:"../procesos/subprocesos/agregarSubproceso.php",
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
                $('#frmProcesos')[0].reset();
                $('#tablaProcesos').load("subprocesos/tablaSubproceso.php");
                swal(":D", "Agregado con éxito!", "success");
            } else {
                swal(":(", "Error al agregar!", "error");
            }
        }
    });
    }

function eliminarProceso(idProceso) {
	idProceso = parseInt(idProceso);
	if (idProceso < 1 ) {
		swal("No tenes id de SubProceso!");
		return false;
	} else {
  		//**************************************************
  		swal({
  			title:"Está seguro de elimina éste SubProceso?",
  			text: "Una vez eliminado, no podrá recuperarse!",
  			icon: "warning",
  			buttons: true,
  			dangerMode: true,
  		})
  		.then((willDelete) => {
  		  if (willDelete) {
  				$.ajax({
  					type:"POST",
  					data:"idProceso=" + idProceso,
  					url:"../procesos/subprocesos/eliminarSubproceso.php",
  					success:function(respuesta){
                        respuesta = respuesta.trim();

                        if (respuesta == 1) {
                            $('#tablaProcesos').load("subprocesos/tablaSubproceso.php");
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

function obtenerDatosProceso(idProceso) {
    $.ajax({
        type:"POST",
        data:"idProceso=" + idProceso,
        url:"../procesos/subprocesos/obtenerSubproceso.php",
        success:function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idProceso').val(respuesta['idProceso']);
            $('#procesoU').val(respuesta['nombreProceso']);
       }
    })
}

function actualizaProceso(){
    if ($('#procesoU').val() == ""){
        swal("No hay Subproceso!!");
        return false;
    } else {
        $.ajax({
            type:"POST",
            data:$('#frmActualizarProceso').serialize(),
            url:"../procesos/subprocesos/actualizaSubproceso.php",
            success:function(respuesta){
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#tablaProcesos').load("subprocesos/tablaSubproceso.php");                    
                    swal(":D", "Actualizado con éxito", "success");
                    $('#btnCerrarUpdateProceso').click();
                } else {
                    swal(":(", "No se ha podido Actualizar!", "error");
                }
            }
        })
    }
}