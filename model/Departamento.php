<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 03/01/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Clase Usuario 
 * 
 */

class Departamento {
    /**
     * Código de Departamento
     * @var string
     */
    private $codDepartamento;
    /**
     * Descripción de Departamento
     * @var string
     */
    private $descDepartamento;
    /**
     * Fecha de Creación de Departamento
     * @var DateTime
     */
    private $fechaCreacionDepartamento;
    /**
     * Volumen de Negocio
     * @var float
     */
    private $volumenDeNegocio;
    /**
     * Fecha de Baja de Departamento
     * @var DateTime
     */
    private $fechaBajaDepartamento;
    
    /**
     * Contructor de la clase Departamento
     * 
     * @param string $codDepartamento
     * @param string $descDepartamento
     * @param DateTime $fechaCreacionDepartamento
     * @param float $volumenDeNegocio
     * @param DateTime $fechaBajaDepartamento
     */
    public function __construct($codDepartamento, $descDepartamento, $fechaCreacionDepartamento, $volumenDeNegocio, $fechaBajaDepartamento = NULL) {
        $this->codDepartamento = $codDepartamento;
        $this->descDepartamento = $descDepartamento;
        $this->fechaCreacionDepartamento = $fechaCreacionDepartamento;
        $this->volumenDeNegocio = $volumenDeNegocio;
        $this->fechaBajaDepartamento = $fechaBajaDepartamento;
    }
    /**
     * Obtiene el código de Departamento.
     *
     * @return string El código de Departamento.
     */
    public function get_CodDepartamento() {
        return $this->codDepartamento;
    }

    /**
     * Obtiene la descripción de Departamento.
     *
     * @return string La descripción de Departamento.
     */
    public function get_DescDepartamento() {
        return $this->descDepartamento;
    }

    /**
     * Obtiene la fecha de creación de Departamento.
     *
     * @return DateTime La fecha de creación de Departamento.
     */
    public function get_FechaCreacionDepartamento() {
        return $this->fechaCreacionDepartamento;
    }

    /**
     * Obtiene el Volumen de Negocio de Departamento.
     *
     * @return float El volumne de negocio.
     */
    public function get_VolumenDeNegocio() {
        return $this->volumenDeNegocio;
    }

    /**
     * Obtiene la fecha de baja de Departamento.
     *
     * @return DateTime La fecha de baja de Departamento.
     */
    public function get_FechaBajaDepartamento() {
        return $this->fechaBajaDepartamento;
    }

    /**
     * Establece el código de Departamento
     *
     * @param string $codDepartamento El nuevo código del Departamento.
     */
    public function set_CodDepartamento($codDepartamento) {
        $this->codDepartamento = $codDepartamento;
    }

    /**
     * Establece la descripción de Departamento
     *
     * @param string $descDepartamento La nueva descripción del Departamento.
     */
    public function set_DescDepartamento($descDepartamento) {
        $this->descDepartamento = $descDepartamento;
    }

    /**
     * Establece la fecha de creación de Departamento
     *
     * @param DateTime $fechaCreacionDepartamento La nueva fecha de creación del Departamento.
     */
    public function set_FechaCreacionDepartamento($fechaCreacionDepartamento) {
        $this->fechaCreacionDepartamento = $fechaCreacionDepartamento;
    }

    /**
     * Establece el volumen de negocio del Departamento
     *
     * @param float $volumenDeNegocio El nuevo volumen de negocio del Departamento.
     */
    public function set_VolumenDeNegocio($volumenDeNegocio) {
        $this->volumenDeNegocio = $volumenDeNegocio;
    }

    /**
     * Establece la fecha de baja de Departamento
     *
     * @param DateTime $fechaBajaDepartamento La nueva fecha de baja del Departamento.
     */
    public function set_FechaBajaDepartamento($fechaBajaDepartamento) {
        $this->fechaBajaDepartamento = $fechaBajaDepartamento;
    }



}
