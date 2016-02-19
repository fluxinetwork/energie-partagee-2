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

	<div class="top-display">
    	<p class="p-ss">Pour aller sur le site de souscription, <a href="#">cliquez ici</a></p>
    </div>

	<div class="wrap-main">
    
		<header class="navbar">        
			<?php include( TEMPLATEPATH.'/app/inc/header/nav.php' ); ?>
		</header>
        
		<div class="wrap-content">