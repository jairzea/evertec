/*=======================================
=            TABLA DE IRDENES           =
=======================================*/
$(document).ready(function(){

  email = localStorage.getItem("emaiOrdenes");
  console.log("email", email);
  
  $('.nombreOrdenesUsr').append(email);

  tabla = $('.tablaOrdenesUsuarios').DataTable({
      "ajax": {
        'method':'post',
        "url": "ajax/MostrarOrdenesAjax.php",
        "dataSrc": "",
        "dataType": 'json',
         "data": d => { 
            d.item = 'email';
            d.valor = email;
        },
      },
      "columns": [
        { "data": "id_orden" },
        { "data": "nombre" },
        { "data": "telefono" },
        { "data": "email" },
        { "data": "referencia_orden" },
        { "data": "url_pago" },
        { "data": "nombre_producto" },
        { "data": "precio_producto" },
        { "data": "estado" },
        { render: (data, type, row) => {
          return `<figure>
                        <img src="${row.imagen_producto}" style="width:50%"  alt="${row.name}">
                  </figure>`;
                  }
        },
        { "data": "created_at" },
        { "data": "boton" },
      ],
      destroy: true,
      responsive: true,
      "order": [[ 0, "desc" ]],
      "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

      }
  });

})

$('.tablaOrdenesUsuarios').on('click', '.btnReintentarPago', function(){

  let username = $(this).attr('id_cliente');
  let password = $(this).attr('llave_secreta');

  let headers = new Headers();

  headers.append('Authorization', 'Basic ' + btoa(username + ":" + password));
  
  fetch('ajax/ResumenDeOrdenesAjax.php', {
   method: 'GET',
   headers: headers
  }).then((response) => response.json())
  .then((responseJson) => {
    console.log("responseJson", responseJson[0]);

    var listaOrden = [];

    localStorage.clear()

    /*===========================================================
    =            Agregar informacion al localstorage            =
    ===========================================================*/

    let precio = Number(responseJson[0]['precio_producto'] - responseJson[0]['precio_producto'] * 0.9)

    listaOrden.push({'nombre' : responseJson[0]['nombre'],
             'email' : responseJson[0]['email'],
             'nombre_producto' : responseJson[0]['nombre_producto'],
             'descripcion_producto': responseJson[0]['descripcion_producto'],
             'id_orden': responseJson[0]['id_orden'],
             'telefono': responseJson[0]['telefono'],
             'imagen': responseJson[0]['imagen_producto'],
             'precio_producto': precio})

    localStorage.setItem("listaProducto", JSON.stringify(listaOrden))
    console.log(listaOrden);

    window.location = rutaOculta+"resumen-de-orden";


  }).catch((error) => {

    console.error(error);
    
  });
})
