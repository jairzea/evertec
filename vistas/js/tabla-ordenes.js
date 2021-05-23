/*=======================================
=            TABLA DE IRDENES           =
=======================================*/
$(document).ready(function(){

  tabla = $('.tablaOrdenes').DataTable({
      "ajax": {
        'method':'get',
        "url": "ajax/MostrarOrdenesAjax.php",
        "dataSrc": "",
        "dataType": 'json',
         "data": d => {
            d.item = '';
            d.valor = '';
         },
      },
      "columns": [
        { "data": "id_orden" },
        { "data": "nombre" },
        { "data": "telefono" },
        { "data": "email" },
        { "data": "referencia_orden" },
        { "data": "created_at" },
        { "data": "url_pago" },
        { "data": "nombre_producto" },
        { "data": "precio_producto" },
        { "data": "estado" },
        { render: (data, type, row) => {
          return `<figure>
                        <img style="width:50%" src="${row.imagen_producto}" alt="${row.name}">
                  </figure>`;
                  }
        }
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