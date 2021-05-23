<?php

class ResumenOrdenesControlador
{


    /*=========================================
    =     Mostrar Resumen de Ordenes          =
    =========================================*/
    static public function ctrMostrarResumenOrdenes($item, $valor)
    {   

        $tablaOrden = 'orders';

        $orden_activa = OrdenesModelo::mdlMostrarOrdenes($tablaOrden, $item, $valor);

        if (count($orden_activa) > 0) {
            
            $tabla = "vista_resumen_orders";

            $respuesta = ResumenOrdenesModelo::mdlMostrarResumenOrdenes($tabla, $item, $valor);

        }else{

            $respuesta = array('status' => 400,
                               'detalle' => 'No esta autorizado para esta acción');
        }

        return $respuesta;
    
    }

	
}