<?php
	session_start();
	define( 'APP_ROOT', dirname( __FILE__ ) . '/protected' );

	// Get CoughPHP
	require_once( APP_ROOT . '/vendor/coughphp/load.inc.php' );
	require_once( APP_ROOT . '/vendor/coughphp/as_database/load.inc.php' );
	require_once( APP_ROOT . '/vendor/coughphp/extras/Autoloader.class.php');
	Autoloader::addClassPath( APP_ROOT . '/models/' );
	Autoloader::setCacheFilePath( APP_ROOT . '/cache/cough_class_path_cache.txt');
	spl_autoload_register( array( 'Autoloader', 'loadClass' ) );

	// Get config stuff
	require_once( APP_ROOT . '/config/config.php' );
	require_once( APP_ROOT . '/config/database.php' );

	// Get system classes
	require_once( APP_ROOT . '/system/view.php' );
	require_once( APP_ROOT . '/system/controller.php' );
	require_once( APP_ROOT . '/system/uri.php' );

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

	$controller_file = APP_ROOT . '/controllers/' . $controller_name . '.php';
	$controller_class =  $controller_name . '_Controller';

	if( ! file_exists( $controller_file ) )
		die( "Bad Controller: $controller_name" );

	require_once( $controller_file );

	if( ! class_exists( $controller_class ) )
		die( "Bad Controller: $controller_name" );

	$controller_obj = new $controller_class();

	if( ! is_callable( array( $controller_obj, $method_name ) ) )
		die( "Bad Method for $controller_name: $method_name" );

	if( false === call_user_func_array( array( &$controller_obj, $method_name ), $arguments ) )
		die( "Error Calling Method for $controller_name: $method_name" );
		
	die( $controller_obj->render() );