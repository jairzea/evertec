/*===================================================================
=            Llenando la informacion de resumen de orden            =
===================================================================*/

$(document).ready(function(){

	let datos = JSON.parse(localStorage.getItem("listaProducto"));

	if (datos) {

		$('#nombreResumen').append(datos[0]['nombre']);

		$('#correoResumen').append(datos[0]['email'])
		$('#telefonoResumen').append(datos[0]['telefono'])

		$('.tituloResumenOrden').append(datos[0]['nombre_producto'])
		$('.descripcionResumenOrden').append(datos[0]['descripcion_producto'])
		$('.precioResumen').append(datos[0]['precio_producto'])

		$('.imgResumenOrden').append(`<img src="${datos[0]['imagen']}" alt="${datos[0]['nombre_producto']}" class="img-thumbnail">`)
	}

})

/*=====================================
=            PROCESAR PAGO            =
=====================================*/
$('.btnRealizarPago').on('click', function(){

	let datos = JSON.parse(localStorage.getItem("listaProducto"));

	var texto = $(datos[0]['descripcion_producto']).text();

	if (texto.length >= 10) {
      var textCort = texto.substring(0, 10) + '...';
    }

	$.ajax({
		url: 'ajax/ProcesarPagoAjax.php',
        method: 'POST',
        dataType: 'json',
        data:{
          'precio': datos[0]['precio_producto'],
          'descripcion' : textCort, 
          'id_orden' : datos[0]['id_orden'],
        },
        success: function(respuesta){
        	console.log("respuesta", respuesta);

        	if (respuesta['requestId']) {

				window.open(respuesta['processUrl'], '_blank');

			}else{

				swal({
		          type:"error",
		          title: respuesta,
		          showConfirmButton: true,
		          confirmButtonText: "Cerrar"
		        
		      	})
			}
        }
	})

})

/*=====  End of PROCESAR PAGO  ======*/

/*=======================================
=            Limpiar carrito            =
=======================================*/
$('.btnLimpiarCarrito').on('click', function(){

	localStorage.clear();
	location.reload();

})







