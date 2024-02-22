<?php

/**
 * Clase REST
 *
 * Fichero con la clase REST 
 *
 */

/**
 * Clase REST
 * 
 * Clase que utilizamos para ejecutar las peticiones a las API REST 
 * 
 * @author Carlos García Cachón
 * @version 1.0
 * @since 22/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - REST 
*/
class REST {

    /**
     * @author Carlos García Cachón
     * 
     * Obtenemos la imagen de la API de la NASA.
     *
     * @param string $fecha La fecha para buscar la imagen (AAAA-MM-DD)
     * 
     * @return array|null En caso de éxito, devuelve toda la información. En caso de error, devuelve null.
     */
    public static function apiNasa($fecha) {
        $apiKey = 'QveGQG135NcFGUaRJG0YG5g5ifJ2ILId7FsZwO3x';
        $url = "https://api.nasa.gov/planetary/apod?api_key={$apiKey}&date={$fecha}";

        // Obtenemos los encabezados de la respuesta HTTP y con '1' le indicamos que lo devuelva en un array asociativo
        $headers = get_headers($url, 1);

        // Verificamos si la respuesta tiene un código de estado 404
        if (isset($headers[0]) && strpos($headers[0], '404') !== false) { // Preguntamos si hay al menos un elemento en el array, luego buscamos la cadena usando 'strpos'
            // Si encuentra el error devolvemos NULL
            return null;
        }

        // Continuamos con la solicitud solo si no hay errores de red u otros
        $solicitudApi = file_get_contents($url);

        // Verificamos si la solicitud fue exitosa
        if ($solicitudApi === false) {
            return null; // Si no devolvemos 'NULL'
        }

        // Decodificamos la respuesta JSON
        $aImagenJSON = json_decode($solicitudApi, true);

        // Verificamos si la decodificación fue exitosa y si la clave 'url' está presente
        if ($aImagenJSON && isset($aImagenJSON['url'])) {
            $aResultadoApiNasa['url'] = $aImagenJSON['url'];
            $aResultadoApiNasa['titulo'] = $aImagenJSON['title'];
            $aResultadoApiNasa['explicacion'] = $aImagenJSON['explanation'];

            return $aResultadoApiNasa;
        } else {
            return null; // Caso de fallar la decodificación o datos faltantes
        }
    }

    /**
     * @author: Alejandro Otálvaro Marulanda
     * @since: 31/01/2023
     * Mejorado por @author Carlos García Cachón
     * 
     * Obtenemos información de personajes de una casa concreta 
     *
     * @param string $casa gryffindor, slytherin, hufflepuff, ravenclaw
     * 
     * @return array|null En caso de éxito, devuelve toda la información. En caso de error, devuelve null. 
     */
    public static function apiHarryPotter($casa) {
        $respuestaHP = file_get_contents("https://hp-api.onrender.com/api/characters/house/{$casa}");
        // Verificamos si la solicitud fue exitosa
        if ($respuestaHP === false) {
            return null; // Si no devolvemos 'NULL'
        }
        $respuestaJsonHP = json_decode($respuestaHP, true);
        return $respuestaJsonHP;
    }

    /**
     * @author Carlos García Cachón
     */
    public static function apiTask($data = null) {
        // URL de la API
        $url = "https://apiresttodolist.000webhostapp.com/index.php";

        // Si se proporcionan datos, realizar una solicitud POST
        if ($data !== null) {
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded', // Cambiado a formulario
                    'content' => http_build_query($data), // Utilizar http_build_query para convertir los datos a formato de formulario
                ],
            ];

            $context = stream_context_create($options);
            $respuesta = @file_get_contents($url, false, $context);
        } else {
            // Si no se proporcionan datos, realizar una solicitud GET
            $respuesta = @file_get_contents($url);
        }

        // Decodificar la respuesta JSON
        $respuestaJson = json_decode($respuesta, true);

        // HACER UN FOR PARA RECORRER CADA ELEMENTO DEL ARRAY (JSON) Y CREAR UN OBJETO DE CADA ELEMENTO, METERLO EN UN ARRAY Y DEVOLVERLO
        return $respuestaJson;
    }
}
