<?php
/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 09/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Clase Animal 
 * 
 */
class Animal {
    /**
     * Código de Animal
     * @var string
     */
    private $codAnimal;
    /**
     * Descripción de Animal
     * @var string
     */
    private $descAnimal;
    /**
     * Fecha de Nacimiento de Animal
     * @var DateTime
     */
    private $fechaNacimiento;
    /**
     * Sexo del Animal
     * @var string
     */
    private $sexo;
    /**
     * Raza del Animal
     * @var string
     */
    private $raza;
    /**
     * Precio del Animal
     * @var float
     */
    private $precio;
    /**
     * Fecha de Baja de Animal
     * @var DateTime
     */
    private $fechaBaja;
    
    /**
     * Contructor de la clase Animal
     * 
     * @param string $codAnimal
     * @param string $descAnimal
     * @param DateTime $fechaNacimiento
     * @param string $sexo
     * @param string $raza
     * @param float $precio
     * @param DateTime $fechaBaja
     */  
    public function __construct($codAnimal, $descAnimal, $fechaNacimiento, $sexo, $raza, $precio, $fechaBaja = NULL) {
        $this->codAnimal = $codAnimal;
        $this->descAnimal = $descAnimal;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->raza = $raza;
        $this->precio = $precio;
        $this->fechaBaja = $fechaBaja;
    }
    
    /**
     * Obtiene el código de Animal.
     *
     * @return string El código de Animal.
     */
    public function getCodAnimal(): string {
        return $this->codAnimal;
    }

    /**
     * Obtiene la descripción de Animal.
     *
     * @return string La descripción de Animal.
     */
    public function getDescAnimal(): string {
        return $this->descAnimal;
    }

    /**
     * Obtiene la Fecha de Nacimiento de Animal.
     *
     * @return DateTime La Fecha de Nacimiento de Animal.
     */
    public function getFechaNacimiento(): DateTime {
        return $this->fechaNacimiento;
    }

    /**
     * Obtiene el sexo de Animal.
     *
     * @return string El sexo de Animal.
     */
    public function getSexo(): string {
        return $this->sexo;
    }

    /**
     * Obtiene la raza de Animal.
     *
     * @return string La raza de Animal.
     */
    public function getRaza(): string {
        return $this->raza;
    }

    /**
     * Obtiene el precio de Animal.
     *
     * @return float El precio de Animal.
     */
    public function getPrecio(): float {
        return $this->precio;
    }

    /**
     * Obtiene la Fecha de Baja de Animal.
     *
     * @return DateTime La Fecha de Baja de Animal.
     */
    public function getFechaBaja(): DateTime {
        return $this->fechaBaja;
    }

    /**
     * Establece el código de Animal
     *
     * @param string $codAnimal El nuevo código de Animal.
     */
    public function setCodAnimal(string $codAnimal): void {
        $this->codAnimal = $codAnimal;
    }

    /**
     * Establece la descripción de Animal
     *
     * @param string $descAnimal La nueva descripción de Animal.
     */
    public function setDescAnimal(string $descAnimal): void {
        $this->descAnimal = $descAnimal;
    }

    /**
     * Establece la Fecha de Nacimiento de Animal
     *
     * @param DateTime $fechaNacimiento La nueva Fecha de Nacimiento de Animal.
     */
    public function setFechaNacimiento(DateTime $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Establece el sexo de Animal
     *
     * @param string $sexo El nuevo sexo de Animal.
     */
    public function setSexo(string $sexo): void {
        $this->sexo = $sexo;
    }

    /**
     * Establece la raza de Animal
     *
     * @param string $raza La nueva raza de Animal.
     */
    public function setRaza(string $raza): void {
        $this->raza = $raza;
    }

    /**
     * Establece el precio de Animal
     *
     * @param float $precio El nuevo precio de Animal.
     */
    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }

    /**
     * Establece la Fecha de Baja de Animal
     *
     * @param DateTime $fechaBaja La nueva Fecha de Baja de Animal.
     */
    public function setFechaBaja(DateTime $fechaBaja): void {
        $this->fechaBaja = $fechaBaja;
    }



}
