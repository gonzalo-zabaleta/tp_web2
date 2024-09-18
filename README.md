# tp_web2
# Sistema de control de productos en almacenes
# Integrante
Gonzalo Zabaleta. 
# Descripción
En este trabajo decidi desarrollar un sistema que controle los productos que hay en cada almacen. 

La tabla almacenes está compuesta por:
  -ID_almacen INT PK(primary key)
  -nombre_almacen VARCHAR(100)
  -lugar_almacen  VARCHAR(100)
  -capacidad_almacen INT

La tabla productos está compuesta por:
  -id_producto INT PK(primary key)
  -nombre_producto VARCHAR(100)
  -cantidad_producto  INT
  -color_produto VARCHAR(100)
  -id_almacen INT (foreing key)

Para que se cumpla la relación de 1 a N, cada producto podrá estar solo en un almacen, mientras que los almacens pueden tener diferentes productos. Las tablas estan relacionadas mediante la clave foránea id_almacen que se encuentra en la tabla productos y la clave primaria ID_almacen que se encuentra en la tabla almacenes
