# webservice-searchjson
 Webservice básico para búsquedas en archivo json

## Table of Contents
1. [Información General](#general-info)
2. [Tecnologías](#technologies)
3. [Instalación](#installation)
***
<a name="general-info"></a>
### Información General
Prueba planteada:

Realizar webservice en PHP que permite realizar búsquedas por los campos título y autor.
El endpoint funcionará únicamente por método GET y tendrá un único parámetro de entrada que será "texto" y será el texto a buscar.
La respuesta del endpoint serán dos arrays uno con los tíutlos y otro con los autores.
Dentro del array de autores se devolverá otro array con los datos de los dos últimos libros (ordenación por fecha).


Se espera un solo fichero PHP para la prueba y el fichero JSON se encontrará siempre en el mismo directorio.
La busqueda será exacta por texto entrado no es necesario el uso de patrones de búsqueda.

***
<a name="technologies"></a>
## Tecnologías
Los lenguajes y tecnologías empleados para el desarrollo de este software han sido:
* PHP v.7.3

Este software ha sido desarrollado en un servidor con Apache v.2.4.46.

<a name="installation"></a>
## Instalación
Para la instalación es suficiente con realizar el deploy de todas las fuentes en un servidor con Apache.
