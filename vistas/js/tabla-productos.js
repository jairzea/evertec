/*=======================================
=            TABLA PRODUCTOS            =
=======================================*/
$(document).ready(function(){

  tablaProductos = $('.tablaPdoductos').DataTable({
      "ajax": {
        'method':'get',
        "url": "ajax/MostrarProductosAjax.php",
        "dataSrc": "",
        "dataType": 'json',
         "data": d => {},
      },
      "columns": [
        { "data": "id" },
        { "data": "name" },
        { "data": "description" },
        { "data": "price" },
        { render: (data, type, row) => {
          return `<figure>
                        <img style="width:50%" src="${row.img}" alt="${row.name}">
                  </figure>`;
                  }
        },
        { render: (data, type, row) => {
          return `<div class="btn-group">
                        <button class="btn btn-warning btn-sm btnModalEditarProducto" title='Editar Producto' 
                        idProducto='${row.id}'' nombre='${row.name}' description='${row.description}'  
                        precio='${row.price}' imagen='${row.img}'
                        data-toggle="modal" data-target="#modalProducto">
                          <i class="fa fa-pencil"></i>
                        </button> 
                        <button class="btn btn-danger btn-sm btnEliminarProducto" 
                         idProducto='${row.id}''>
                          <i class="fa fa-trash"></i>
                        </button>
                  </div>`;
                  }
        },
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

/*=============================================
VALIDAR MONTO
=============================================*/

$('#precioProducto').change(function(){

  let monto = Number($(this).val());

  $('.alertMonto').empty();

  if (monto >= 500001) {

    $('#precioProducto').parent().before('<div class="alertMonto"><div class="alert alert-danger"><strong>ERROR:</strong> El monto no debe ser mayor a $500000</div></div>');

    return false;
  }

})

/*========================================
=            Agregar Producto            =
========================================*/
$('.btnGuardarProducto').on('click', function(){

  $.ajax({
    url: "ajax/CrearProductosAjax.php",
    method: "POST",
    dataType: "json",
    data: {
      nombreProducto: $('#nombreProducto').val(),
      descripcionProducto: $('#descripcionProducto').val(),
      precioProducto: $('#precioProducto').val(),
      imgProducto: $('#imagenProducto').val()
    },
  }).done(function (respuesta) {

    if (respuesta.status == 200) {

      swal({
        title:'Exito',
        text: respuesta.detalle,
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok!'
       }).then(function(result){

        $('#nombreProducto').val('');
        $('#descripcionProducto').summernote('code','');
        $('#precioProducto').val('');
        $('#imagenProducto').val('');
        tablaProductos.ajax.reload();
        $('#modalProducto').modal('hide');

      })

    }else{

      swal({
          type:"error",
          title: respuesta.detalle,
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        
      })
    }
  
  })

})

$('.btnAbrirCrear').on("click", function(){

  $('.btnGuardarProducto').css('display','block');
  $('.btnEditarProducto').css('display','none');

})

/*===========================================
=            Llenar modal editar            =
===========================================*/
$(".tablaPdoductos").on("click", ".btnModalEditarProducto", function(){

  let nombre = $(this).attr('nombre');
  let id = $(this).attr('idProducto');
  let precio = $(this).attr('precio');
  let imagen = $(this).attr('imagen');
  let descripcion = $(this).attr('description');

  $('#nombreProducto').val(nombre);
  $('#descripcionProducto').summernote('code', descripcion);
  $('#precioProducto').val(precio);
  $('#imagenProducto').val(imagen);
  $('#idProducto').val(id);

  $('.btnGuardarProducto').css('display','none');
  $('.btnEditarProducto').css('display','block');

})

/*========================================
=            Editar Producto            =
========================================*/
$('.btnEditarProducto').on('click', function(){

  $.ajax({
    url: "ajax/EditarProductosAjax.php",
    method: "POST",
    dataType: "json",
    data: {
      nombreProducto: $('#nombreProducto').val(),
      descripcionProducto: $('#descripcionProducto').val(),
      precioProducto: $('#precioProducto').val(),
      imgProducto: $('#imagenProducto').val(),
      id: $('#idProducto').val()
    },
  }).done(function (respuesta) {

    if (respuesta.status == 200) {

      swal({
        title:'Exito',
        text: respuesta.detalle,
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok!'
       }).then(function(result){

        $('#nombreProducto').val('');
        $('#descripcionProducto').summernote('code','');
        $('#precioProducto').val('');
        $('#imagenProducto').val('');
        tablaProductos.ajax.reload();
        $('#modalProducto').modal('hide');

      })

    }else{

      swal({
          type:"error",
          title: respuesta.detalle,
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        
      })
    }
  
  })

})


/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(".tablaPdoductos").on("click", ".btnEliminarProducto", function(){

   let id = $(this).attr('idProducto');

   swal({
    title: '¿Está seguro de borrar el producto?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar producto!'
   }).then(function(result){

    if(result.value){

     $.ajax({
      url: "ajax/EliminarProductosAjax.php",
      method: "GET",
      dataType: "json",
      data: {
        id: id,
      },
      success: function (respuesta) {
        console.log("respuesta", respuesta);

        if (respuesta.status == 200) {

          swal({
          title: 'Exito',
          text: respuesta.detalle,
          type: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok!'
         }).then(function(result){

            tablaProductos.ajax.reload();

         })

        
        }else{

          swal({
            type:"error",
            title: respuesta.detalle,
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        
          })
        }

      }

    })

   }

})
})