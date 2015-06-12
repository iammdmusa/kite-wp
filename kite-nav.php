<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/25/2015
 * Time: 10:43 PM
 */
global $kite_muri;
?>
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
            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="row-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand page-scroll" href="<?php echo get_site_url();?>">
                                <div class="brand-logo">

                                </div>
                            </a>
                        </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden"><a href="#page-top"></a></li>
                    <li>
                        <a href="<?php echo get_site_url();?>" class=""><?php echo $kite_muri['homePage'];?></a>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['servicePage_switch-on']==true){?>
                                <a class="page-scroll" href="#featured-services-secton"><?php echo $kite_muri['servicePage'];?></a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['portfolio_switch-on']==true){?>
                            <a class="page-scroll" href="#portfolio"><?php echo $kite_muri['portfolioPage'];?></a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['about_switch-on']==true){?>
                                <a class="page-scroll" href="#aboutus"><?php echo $kite_muri['aboutPage'];?></a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['testimonial_switch-on']==true){?>
                                <a class="page-scroll" href="#clients"><?php echo $kite_muri['testimonialPage'];?></a>
                        <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['price_switch-on']==true){?>
                                <a class="page-scroll" href="#price-table"><?php echo $kite_muri['pricePage'];?></a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['blog_switch-on']==true){?>
                                <a class="page-scroll" href="#blog"><?php echo $kite_muri['blogPage'];?></a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <?php
                            if($kite_muri['contact_switch-on']==true){?>
                                <a class="page-scroll" href="#contact"><?php echo $kite_muri['contactPage'];?></a>
                            <?php }
                        ?>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.row -->
    </div>
    <!-- /.container -->
</nav>