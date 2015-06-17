<?php

if ( ! defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );

/**
 * Ne pas utiliser cette fonction directement ! Utiliser flash_'level' à la place.
 * 
 * @param unknown $level
 *        	valeur parmis 'error', 'warning', 'info', 'success'
 * @param unknown $message
 *        	message à afficher à l'utilisateur
 */
function flash ( $level, $message )
{
	// TODO trouver comment rendre 'private' alors qu'on est dans un helper...
	$CI = & get_instance();
	$CI -> session -> set_flashdata( $level, $message );
}

function flash_success ( $message )
{
	flash( 'success', $message );
}

function flash_error ( $message )
{
	flash( 'error', $message );
}

function flash_info ( $message )
{
	flash( 'info', $message );
}

function flash_warning ( $message )
{
	flash( 'warning', $message );
}

function get_flashs ()
{
	$CI = & get_instance(); // get instance, access the CI superobject
	$data = array ( 
		
			'error' => $CI -> session -> flashdata( 'error' ), 
			'warning' => $CI -> session -> flashdata( 'warning' ), 
			'success' => $CI -> session -> flashdata( 'success' ), 
			'info' => $CI -> session -> flashdata( 'info' ) 
	);
	return $data;
}

?>