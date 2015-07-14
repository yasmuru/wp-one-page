<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Wp One Page
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="MobileOptimized" content="320">
<meta name="HandheldFriendly" content="True">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll logo-title" href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a>
                <a class="navbar-brand logo-img" href="<?php echo home_url(); ?>"><img src="<?php echo THEME_IMG_URL . '/logo.jpg'; ?>" width="120px"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php if( is_front_page() ) {?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Modules</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Benefits</a>
                    </li>

                    <li>
                        <a class="page-scroll" href="#clients">Clients</a>
                    </li> 
                    
                </ul>
            </div>
            <?php } ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
