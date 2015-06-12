<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:07 PM
 */
global $kite_muri;
?>
<!-- Contact Us Section -->
<section class="section-wrapper" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="section-title wow fadeInDown">
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div><!-- /.row -->
        <div class="container" id="feedback">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <?php
                    $fm = $kite_muri['contact_form'];
                    echo do_shortcode($fm);
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->

<!-- Map -->
<section class="map">
    <div id="googleMap" style="width:100%;height:100%;">
        <iframe src="<?=$kite_muri['map_url'];?>" width="100%" height="400" frameborder="0" style="border:0"></iframe>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-push-7">
                <div class="contact-details wow fadeInRight">
                    <h4><?=$kite_muri['address_title'];?></h4>
                    <div class="fa fa-map-marker"></div>
                    <div class="contact-details-item">
                        <p>
                            <?=$kite_muri['the_address'];?>
                        </p>
                    </div>
                    <div class="clear"></div>
                    <div class="fa fa-envelope"></div>
                    <div class="contact-details-item">
                        <a target="_blank" href="<?=$kite_muri['address_web'];?>"><?=$kite_muri['address_web'];?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Social Media & Newsletter -->
<section class="section-wrapper" id="social-media">
    <div class="container">
        <div class="row">
            <div class="col-md-8 footer-newsletters">
<!--                <div class="newsletter-content left wow fadeInLeft">-->
<!--                    <h4>Newsletter</h4>-->
<!--                    <form name="newsletter" role="form" action="#" method="post">-->
<!--                        <div class="form-group">-->
<!--                            <input type="email" class="form-control" id="InputEmail1" placeholder="enter email address here" required>-->
<!--                            <button type="submit" class="btn btn-submit"><i class="fa fa-send"></i></button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
                <?php dynamic_sidebar( 'sidebar-2' ); ?>
            </div>
            <div class="col-md-4">
                <div class="social-media-content right wow fadeInRight">
                    <h4>Social Media</h4>
                    <div class="social-media-icon">
                        <?php
                            if(!empty($kite_muri['social_media_fb'])){ ?>
                                <a target="_blank" href="<?=$kite_muri['social_media_fb'];?>"><i class="fa fa-facebook"></i></a>
                        <?php }?>
                        <?php
                        if(!empty($kite_muri['social_media_tw'])){ ?>
                            <a target="_blank" href="<?=$kite_muri['social_media_tw'];?>"><i class="fa fa-twitter"></i></a>
                        <?php }?>
                        <?php
                        if(!empty($kite_muri['social_media_gplus'])){ ?>
                            <a target="_blank" href="<?=$kite_muri['social_media_gplus'];?>"><i class="fa fa-google-plus"></i></a>
                        <?php }?>
                        <?php
                        if(!empty($kite_muri['social_media_linkedin'])){ ?>
                            <a target="_blank" href="<?=$kite_muri['social_media_linkedin'];?>"><i class="fa fa-linkedin"></i></a>
                        <?php }?>
                        <?php
                        if(!empty($kite_muri['social_media_pin'])){ ?>
                            <a target="_blank" href="<?=$kite_muri['social_media_pin'];?>"><i class="fa fa-pinterest"></i></a>
                        <?php }?>
                        <?php
                        if(!empty($kite_muri['social_media_instagram'])){ ?>
                            <a target="_blank" href="<?=$kite_muri['social_media_instagram'];?>"><i class="fa fa-instagram"></i></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->
<!--  top Scroller   -->