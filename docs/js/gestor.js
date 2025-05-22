function agregarArchivosGestor() {
	var formData = new FormData(document.getElementById('frmArchivos'));
	$.ajax({
	    url:"../procesos/gestor/guardarArchivos.php",
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
				$('#frmArchivos')[0].reset();
				$('#tablaGestorArchivos').load("gestor/TablaGestor.php");
				swal(":D", "Agregado con éxito!", "success");
			} else {
				swal(":(", "Error al agregar!", "error");
			}
		}
	});
}

function eliminarArchivo(idArchivo) {
	swal({
	  title: "¿Estás seguro de eliminar este archivo?",
	  text: "Una vez eliminado, no podrá recuperarse!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	   		$.ajax({
	   			type:"POST",
	   			data:"idArchivo=" + idArchivo,
	   			url:"../procesos/gestor/eliminaArchivo.php",
	   			success:function(respuesta){
					console.log(respuesta);
	   				respuesta = respuesta.trim();
	   				if (respuesta == 1) {	
	   					$('#tablaGestorArchivos').load("gestor/TablaGestor.php");
	   				 	swal("Eliminado!", {
	     				 icon: "success",
	    				});
	    			} else {
	    				swal("Error al eliminar!", {
	     				 icon: "error",
	    				});
	    			}
	   			}
	   		});
	  }
 	});
}

function obtenerArchivoPorId(idArchivo){
	$.ajax({
		type:"POST",
		data:"idArchivo=" + idArchivo,
		url:"../procesos/gestor/obtenerArchivo.php",
		success:function(respuesta){
			$('#archivoObtenido').html(respuesta);
		}

	})
}