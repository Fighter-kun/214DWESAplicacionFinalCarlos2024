<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 06/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Task
 * 
 */
class Task {
    /**
     * Codigo de la Tarea
     * @var int
     */
    private $id;
    /**
     * Descripció de la Tarea
     * @var string
     */
    private $descripcion;
    /**
     * Estado de la Tarea
     * @var string
     */
    private $estado;
    
    /**
     * Contructor de la clase Task
     * 
     * @param string $id
     * @param string $descripcion
     * @param string $estado
     */
    public function __construct(int $id, string $descripcion, string $estado = "pendiente") {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    
    /**
     * Obtiene el código de la Tarea.
     *
     * @return int El código de la Tarea.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Obtiene la descripción de la Tarea.
     *
     * @return string La descripción de la Tarea.
     */
    public function getDescripcion(): string {
        return $this->descripcion;
    }

    /**
     * Obtiene el estado de la Tarea.
     *
     * @return string El estado de la Tarea.
     */
    public function getEstado(): string {
        return $this->estado;
    }

    /**
     * Establece el código de la Tarea
     *
     * @param int $id El nuevo código de la Tarea
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Establece la descripción de la Tarea
     *
     * @param string $descripcion La nueva descripción de la Tarea
     */
    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece el estado de la Tarea
     *
     * @param string $estado El nuevo estado de la Tarea
     */
    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

}
