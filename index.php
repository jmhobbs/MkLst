<?php
	require_once( 'config.php' );

	// Parse URI
	if( false === strpos( $_SERVER['REQUEST_URI'], $config['uri_prefix'] ) )
		die( 'Configuration Error - Bad uri_prefix' );

	$path = substr( $_SERVER['REQUEST_URI'], strlen( $config['uri_prefix'] ) );
	$components = explode( '/', $path );

	for( $i = 0;  $i < count( $components ); ++$i )
		if( empty( $components[$i] ) )
			unset( $components[$i] );

	$controller = $config['default_controller'];
	$method = 'index';
	$arguments = array();

	if( 1 <= count( $components ) ) { $controller = strtolower( $components[0] ); }
	if( 2 <= count( $components ) ) { $method = strtolower( $components[1] ); }
	if( 3 <= count( $components ) ) { $arguments = array_slice( $components, 2 ); }

	if( ! file_exists( 'controllers/' . $controller . '.php' ) )
		die( "Bad Controller: $controller" );

	require_once( 'controllers/' . $controller . '.php' );

	if( ! class_exists( $controller ) )
		die( "Bad Controller: $controller" );

	$controller_obj = new $controller();

	if( ! method_exists( $controller_obj, $method ) )
		die( "Bad Method for $controller: $method" );

	if( false === call_user_func_array( array( &$controller_obj, $method ), $arguments ) )
		die( "Error Calling Method for $controller: $method" );