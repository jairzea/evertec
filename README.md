# evertec Tienda en linea

### CONFIGURAR PROYECTO LOCAL

>Paso 1) Realice un:  git clone https://github.com/jairzea/evertec.git o descargue el .zip del proyecto

>Paso 2) Cree una base de datos en su servidor de nombre: evertec - si desea colocar otro nombre, debe modificar el archivo de configuración tal y como se le indica en el siguiente paso.

>Paso 3) Importe la base de datos: evertec.sql en la BD que caba de crear

>Paso 4)Modifique el archivo de configuración .env_example con los siguientes variables de entorno:
```HTML
	HOST_NAME=SERVIDOR
	DB_USER=USUARIO_BD
	DB_PASSWORD=CONTRASEÑA_USUARIO_BD
	DB_NAME=NOMBRE_BD

	LOGIN=LOGIN_PLACETOPAY
	TANKEY=TANKEY_PLACETOPAY
	URL_REDIRECT=URL_DE_PAGO/REDIRECT/WEB-CHEKOUT
	PROJECT_FOLDER=EN CASO DE CAMBIAR LA CARPETA DEL PROYECTO, MODIFIQUE ESTA VARIABLE
```

*Nota: el archivo .env_example contienen los datos por defecto para probar la tienda, asumiendo localhost 
como servidor de pruebas, si no es necesario cambiar algunas variables de entorno, puede utilizar los mismos datos
solo cambie el nombre del archivo de .env_example a .env*

>Paso 5) Solo si obtiene errores al importar la base de datos:
>CREACION DE VISTAS
>>Cree las siguientes vistas en su base de datos, en caso de obtener algun error al momento de importar la BD
```HTML
	//Vista para el resumen de ordenes
	CREATE OR REPLACE VIEW vista_resumen_orders AS
	SELECT orders.customer_name AS nombre, orders.customer_email AS email, products.name AS nombre_producto, products.description AS descripcion_producto, products.price AS precio_producto, products.img AS imagen_producto, orders.id AS id_orden, orders.customer_mobile AS telefono, orders.token 
	FROM orders orders
	INNER JOIN products products
	ON orders.id_product = products.id
```
```HTML
	//Vista para el relacion de ordenes y productos
	CREATE OR REPLACE VIEW vista_orders_products AS
    SELECT o.customer_name AS nombre, o.customer_mobile AS telefono, o.customer_email AS email,
    o.created_at, o.id_product AS id_producto, o.status AS estado, o.processUrl AS url_pago, 
    o.reference AS referencia_orden, o.requestId, o.updateD_at, o.id AS id_orden, o.id_cliente, o.llave_secreta, 
    p.name AS nombre_producto, 
    p.price AS precio_producto, p.img AS imagen_producto, p.description AS descripcion_producto
    FROM orders o
    INNER JOIN products p
    ON o.id_product = p.id
```