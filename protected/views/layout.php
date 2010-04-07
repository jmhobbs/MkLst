<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" media="screen" href="<?php echo uri::path( 'css/screen.css' ); ?>" />
		<link rel="stylesheet" media="screen,print" href="<?php echo uri::path( 'css/mixed.css' ); ?>" />
		<link rel="stylesheet" media="print" href="/mklst/css/print.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<?php if ( $edit ) : ?>
			<script type="text/javascript" src="<?php echo uri::path( 'js/mklst.js' ); ?>" ></script>
		<?php endif; ?>
	</head>
	<body>
		<?php if( isset( $flash ) ) : ?>
			<div class="flash">
				<?php echo $flash; ?>
			</div>
		<?php endif; ?>
		<?php echo $content; ?>
	</body>
</html>