<?php

if ( ! defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );

function flash ( $level, $message )
{
	$CI = & get_instance(); // get instance, access the CI superobject
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