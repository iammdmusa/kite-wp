<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package kite
 */
?>
<?php
    global $kite_muri;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KITE - Multi-purpose One Page Template</title>
    <link rel="icon" href="<?php $kite_muri['fabicon'][url]?>" type="image">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .brand-logo {
            height: 40px;
            width: 180px;
            margin-left: 16px;
            background: url(<?php echo $kite_muri['kite_logo'][url];?>) no-repeat transparent;
            background-size: auto 100%;
            background-position: left center;
        }
        .top-nav-collapse .brand-logo{
            height: 40px;
            width: 180px;
            margin-left: 16px;
            background: url(<?php echo $kite_muri['kite_logo_afix'][url];?>) no-repeat transparent;
            background-size: auto 100%;
            background-position: left center;
            margin-top: -5px;
            height: 30px;
        }
    </style>
<?php wp_head(); ?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<?php
    if(!is_page_template('kite-light.php')&& !is_page_template('kite.php')){?>
        <nav style="background: #1A1A1A;height: 60px;" class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="row-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand page-scroll" href="#page-top"><div class="brand-logo"></div></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <?php wp_nav_menu( array('container' => ' ','theme_location' => 'primary', 'menu_class' => 'nav navbar-nav' ) ); ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.row -->
            </div>
            <!-- /.container -->
        </nav>
   <?php }
    else{
        get_template_part('kite','nav' );
    }
?>
