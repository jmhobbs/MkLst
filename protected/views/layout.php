<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" media="screen" href="/mklst/css/main.css" />
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