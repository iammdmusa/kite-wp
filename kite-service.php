<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:03 PM
 */
    global $kite_muri;
?>
<?php
    if(is_page_template('kite.php')){ ?>
        <!-- Featured Services Section -->
        <section class="section-wrapper" id="featured-services-secton">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-push-2">
                        <div class="section-title-white wow fadeInDown">
                            <h2><?=$kite_muri['servicePage_title'];?></h2>
                            <h4><?=$kite_muri['servicePage_subTitle'];?></h4>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row wow fadeInUp">
                    <div class="col-md-4 col-sm-4 featured-item">
                        <div class="list wow fadeInRightBig">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item1_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item1'];?></h4>
                            <p><?=$kite_muri['servicePage_item1_text'];?></p>
                        </div>

                        <div class="list wow fadeInRightBig" data-wow-delay="0.4s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item2_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item2'];?></h4>
                            <p><?=$kite_muri['servicePage_item2_text'];?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 wow fadeInUpBig" style="margin-top:-30px;">
                        <img src="<?=$kite_muri['servicePage_left_img'][url];?>" class="img-responsive" alt="mobile-apps">
                    </div>
                    <div class="col-md-4 col-sm-4 featured-item">
                        <div class="list wow fadeInLeftBig" data-wow-delay="0.2s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item3_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item3'];?></h4>
                            <p><?=$kite_muri['servicePage_item3_text'];?></p>
                        </div>

                        <div class="list wow fadeInLeftBig" data-wow-delay="0.6s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item4_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item4'];?></h4>
                            <p><?=$kite_muri['servicePage_item4_text'];?></p>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.section-wrapper -->
   <?php }else{ ?>
        <!-- Featured Services Section light -->
        <section class="section-wrapper" id="featured-services-secton">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-push-2">
                        <div class="section-title wow fadeInDown">
                            <h2><?=$kite_muri['servicePage_title'];?></h2>
                            <h4><?=$kite_muri['servicePage_subTitle'];?></h4>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row wow fadeInUp">

                    <div class="col-md-4 col-sm-4 wow zoomInLeft" style="margin-top:-30px;">
                        <img src="<?=$kite_muri['servicePage_left_img'][url];?>" class="img-responsive" alt="mobile-apps">
                    </div>

                    <div class="col-md-4 col-sm-4 featured-item">
                        <div class="list wow zoomInRight">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item1_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item1'];?></h4>
                            <p><?=$kite_muri['servicePage_item1_text'];?></p>
                        </div>

                        <div class="list wow zoomInRight" data-wow-delay="0.4s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item2_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item2'];?></h4>
                            <p><?=$kite_muri['servicePage_item2_text'];?></p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 featured-item">
                        <div class="list wow zoomInRight" data-wow-delay="0.2s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item3_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item3'];?></h4>
                            <p><?=$kite_muri['servicePage_item3_text'];?></p>
                        </div>

                        <div class="list wow zoomInRight" data-wow-delay="0.6s">
                            <img class="flat-icons" src="<?=$kite_muri['servicePage_item4_icon'][url];?>" alt="flaticons">
                            <h4><?=$kite_muri['servicePage_item4'];?></h4>
                            <p><?=$kite_muri['servicePage_item4_text'];?></p>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.section-wrapper -->
   <?php }
?>

