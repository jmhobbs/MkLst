<?php

	class uri {
		public static function path ( $resource ) {
			global $config;
			//! \todo Reverse routing for shortest paths
			return $config['uri_prefix'] . $resource;
		}
		public static function full_path ( $resource ) {
			global $config;
			return 'http://' . $_SERVER['SERVER_NAME'] . $config['uri_prefix'] . $resource;
		}
		public static function redirect ( $resource ) {
			global $config;
			header( 'Location: ' . $config['uri_prefix'] . $resource );
			exit();
		}
	}