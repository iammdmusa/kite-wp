<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:05 PM
 */
?>
<!-- About Us Section -->
<?php global $kite_muri; ?>
<style type="text/css" media="screen">
    #aboutus{
        background: url(<?php echo $bg = $kite_muri['aboutPage_bg'][url];?>) no-repeat transparent;
        background-size:cover;
    }
</style>
    
</style>
<section class="section-wrapper" id="aboutus">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-push-5">
                <div class="section-title wow fadeInDown">
                    <h2><?php echo $about_title = $kite_muri['aboutPage_title'];?></h2>
                    <h4><?php echo $about_subTile = $kite_muri['aboutPage_subTitle'];?></h4>
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-push-5">
                <div class="content-about wow zoomInRight">
                    <div class="content-icon"><img src="<?php echo $icon1 = $kite_muri['aboutPage_item1_icon'][url] ;?>"></div>
                    <div class="content-text">
                        <h4><?php echo $itmeTitle1 = $kite_muri['aboutPage_item1'] ;?></h4>
                        <p><?php echo $itmetext1 = $kite_muri['aboutPage_item1_text'] ;?></p>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="content-about wow zoomInRight" data-wow-delay="0.2s">
                    <div class="content-icon"><img src="<?php echo $icon2 = $kite_muri['aboutPage_item2_icon'][url] ;?>"></div>
                    <div class="content-text">
                        <h4><?php echo $itmeTitle2 = $kite_muri['aboutPage_item2'] ;?></h4>
                        <p><?php echo $itmetext2 = $kite_muri['aboutPage_item2_text'] ;?></p>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="content-about wow zoomInRight" data-wow-delay="0.4s">
                    <div class="content-icon"><img src="<?php echo $icon3 = $kite_muri['aboutPage_item3_icon'][url] ;?>"></div>
                    <div class="content-text">
                        <h4><?php echo $itmeTitle3 = $kite_muri['aboutPage_item3'] ;?></h4>
                        <p><?php echo $itmetext3 = $kite_muri['aboutPage_item3_text'] ;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->