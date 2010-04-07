<?php

	class uri {
		public static function path ( $resource ) {
			global $config;
			return $config['uri_prefix'] . $resource;
		}
		public static function redirect ( $resource ) {
			global $config;
			header( 'Location: ' . $config['uri_prefix'] . $resource );
			exit();
		}
	}