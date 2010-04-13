<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo uri::path( 'css/screen.css' ); ?>" />
		<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo uri::path( 'css/mixed.css' ); ?>" />
		<link rel="stylesheet" type="text/css" media="print" href="<?php echo uri::path( 'css/print.css' ); ?>" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<?php if ( $edit ) : ?>
			<script type="text/javascript" src="<?php echo uri::path( 'js/mklst.js' ); ?>" ></script>
		<?php endif; ?>
	</head>
	<body>
		<div id="header">
			<a href="<?php echo uri::path( '' ); ?>">Home</a> | 
			<a href="<?php echo uri::path( 'list/create' ); ?>">Create</a> |
			<a href="<?php echo uri::path( 'page/help' ); ?>">Help</a> |
			<a href="<?php echo uri::path( 'page/about' ); ?>">About</a> |
			<a href="http://github.com/jmhobbs/MkLst" target="_blank">GitHub</a>
		</div>
		<div id="core">
			<?php if( isset( $flash ) ) : ?>
				<div class="flash">
					<?php echo $flash; ?>
				</div>
			<?php endif; ?>
			<?php echo $content; ?>
		</div>
	</body>
</html>
