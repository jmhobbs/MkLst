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

	if( 1 <= count( $components ) ) { $controller = substr( $components[0] ); }
	if( 2 <= count( $components ) ) { $method = substr( $components[1] ); }