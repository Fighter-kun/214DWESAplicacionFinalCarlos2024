<?php
/**
 * @author Carlos García Cachón
 * @version 1.1
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Proyecto LoginLogoutMulticapaPOO - Clase ErrorApp
 * 
 */
class ErrorApp {
    /**
     * Codigo del ErrorApp
     * 
     * @var string 
     */
    private $codError;
    /**
     * Descripcion del ErrorApp
     * 
     * @var string 
     */
    private $descError;
    /**
     * Archivo del ErrorApp
     * 
     * @var string 
     */
    private $archivoError;
    /**
     * Línea del ErrorApp
     * 
     * @var int 
     */
    private $lineaError;
    /**
     * Página siguiente, es la página anterior a mostrar el ErrorApp
     * 
     * @var string 
     */
    private $paginaSiguiente;
    
    /**
     * Metodo magico __construct()
     * 
     * Metodo constructor de la clase ErrorApp
     * 
     * @param string $codError Código de descripción del ErrorApp
     * @param string $descError Descripción del ErrorApp
     * @param string $archivoError Enlace del ErrorApp
     * @param int $lineaError Línea en la que se produjo el ErrorApp
     * @param string $paginaSiguiente Página siguiente, es la página anterior a mostrar el ErrorApp
     */
    function __construct($codError, $descError, $archivoError, $lineaError, $paginaSiguiente) {
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
        $this->paginaSiguiente = $paginaSiguiente;
    }
    /**
     * Metodo getCodError()
     * 
     * Metodo get que devuelve el código del ErrorApp
     * 
     * @return string
     */
    function get_CodError(){
        return $this->codError;
    }
    /**
     * Metodo getDescError()
     * 
     * Metodo get que devuelve la descripción del ErrorApp
     * 
     * @return string
     */
    function get_DescError(){
       return $this->descError; 
    }
    /**
     * Metodo getArchivoError()
     * 
     * Metodo get que devuelve el archivo del ErrorApp
     * 
     * @return string
     */
    function get_ArchivoError(){
       return $this->archivoError; 
    }
    /**
     * Metodo getLineaError()
     * 
     * Metodo get que devuelve la línea en la que se produjo el ErrorApp
     * 
     * @return int 
     */
    function get_LineaError(){
       return $this->lineaError; 
    }
    /**
     * Metodo getPaginaSiguiente()
     * 
     * Metodo get que devuelve la página siguiente, es la página anterior a mostrar el ErrorApp
     * 
     * @return string
     */
    function get_PaginaSiguiente(){
       return $this->paginaSiguiente; 
    }
}
