<!DOCTYPE html>
<html lang="<?php echo get_locale() ?>">	
<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?php include( TEMPLATEPATH.'/app/inc/header/title.php' ); ?></title>
	
	<?php wp_head(); ?>
	
</head>

<?php include( TEMPLATEPATH.'/app/inc/header/bodyclass.php' ); ?>
<body <?php body_class($bodyclass); ?> >

	<div class="wrap-main">
    
		<header class="header">        
        	<?php include( TEMPLATEPATH.'/app/inc/header/logo.php' ); ?>
			<?php include( TEMPLATEPATH.'/app/inc/header/nav.php' ); ?>
		</header>
        
		<div class="wrap-content">