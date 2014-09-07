#"Traductor de Fechas"

Clase auxiliar para manejar fechas en diferentes formatos (los mismos soportados por PHP: [formatos](http://php.net/manual/en/function.date.php) )

Nace de la necesidad de obtener fechas de los usuarios y almacenarlas en la base de datos. Ejemplo:  un usuario ingresa una fecha en formato 'd/m/Y' (es decir Día / Mes / Año) pero la base de datos, por ejemplo,
MySQL utiliza el formato 'YYYY-MM-DD HH:MM:SS' para almacenar campos tipo DATETIME, no resulta práctico pedirle al usuario sus fechas en ese formato y aun menos tener que estar haciendo la traducción "a mano" entre ambos formatos en el código cada vez que se requiera y en diferentes formatos.

La clase `DateTranslator` actua como un traductor/validador de fechas y formatos, internamente utiliza la clase DateTime de PHP para realizar sus operaciones.

```php

$traductor = new DateTranslator;
$fechaUsuario = '10/04/2014 1:35 PM'; //ej. Fecha que ingresó el usuario desde un formulario
$formatoEsperado = 'd/m/Y H:i A'; //Formato esperado de la fecha
$formatoBaseDatos = 'Y-m-d H:i:s'; //Formato en que se espera la fecha en la base de datos
//Indicamos la fecha y el formato esperado al traductor
$traductor->setDate($fechaUsuario, $formatoEsperado);
$fechaConFormatoBaseDatos = $traductor->getDateFormat($formatoBaseDatos);
echo $fechaConFormatoBaseDatos;
//2014-08-12 13:35:00

```

Si la fecha no cumple con el formato esperado se lanza la excepción ***InvalidArgumentException***

```php
try {

    $traductor = new DateTranslator;
    $fechaUsuario = '10/04/2014';
    $formatoEsperado = 'Y-m-d';
    $traductor->setDate($fechaUsuario, $formatoEsperado);

} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
    //"Formato de fecha inválido, se espera [Y-m-d]"
}
```

Los mensajes de error de la clase estan en Español (ya hay demasiadas librerías en inglés), al igual que los comentarios. Los nombres de las funciones de las especificaciones (phpSpec) y API estan en inglés por cuestiones de comodidad.