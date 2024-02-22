<?php

/**
 * @author Carlos García Cachón
 * @version 1.0
 * @since 16/02/2024
 * @copyright Todos los derechos reservados a Carlos García
 * 
 * @Annotation Aplicación Final - Parte de 'cBajaLogicaAnimal' 
 * 
 */
// Utilizo el metodo 'bajaLogicaAnimal' de la clase 'AnimalPDO' para actualizar la fecha de baja de Animal
AnimalPDO::bajaLogicaAnimal($_SESSION['codAnimalActual']);

$_SESSION['paginaAnterior'] = 'bajaAnimal'; // Almaceno la página anterior para poder volver
$_SESSION['paginaEnCurso'] = 'consultarAnimales'; // Asigno a la página en curso la pagina de consultarAnimales
header('Location: index.php'); // Redirecciono al index de la APP
exit;
