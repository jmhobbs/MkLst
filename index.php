<?php
	require_once( 'protected/config.php' );
	require_once( 'protected/system/database.php' );

	// Parse URI
	if( false === strpos( $_SERVER['REQUEST_URI'], $config['uri_prefix'] ) )
		die( 'Configuration Error - Bad uri_prefix' );

	$path = substr( $_SERVER['REQUEST_URI'], strlen( $config['uri_prefix'] ) );
	$components = explode( '/', $path );

	for( $i = 0;  $i < count( $components ); ++$i )
		if( empty( $components[$i] ) )
			unset( $components[$i] );

	$controller_name = $config['default_controller'];
	$method_name = 'index';
	$arguments = array();

	if( 1 <= count( $components ) ) { $controller_name = strtolower( $components[0] ); }
	if( 2 <= count( $components ) ) { $method_name = strtolower( $components[1] ); }
	if( 3 <= count( $components ) ) { $arguments = array_slice( $components, 2 ); }

	$controller_file = 'protected/controllers/' . $controller_name . '.php';
	$controller_class =  $controller_name . '_Controller';

	if( ! file_exists( $controller_file ) )
		die( "Bad Controller: $controller_name" );

	require_once( $controller_file );

	if( ! class_exists( $controller_class ) )
		die( "Bad Controller: $controller_name" );

	$controller_obj = new $controller_class();

	if( ! method_exists( $controller_obj, $method_name ) )
		die( "Bad Method for $controller_name: $method_name" );

	if( false === call_user_func_array( array( &$controller_obj, $method_name ), $arguments ) )
		die( "Error Calling Method for $controller_name: $method_name" );