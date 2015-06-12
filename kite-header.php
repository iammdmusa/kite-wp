<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:02 PM
 */
global $kite_muri;
?>
<!-- Navigation -->
<!-- Full Page Carousel Header -->
<header id="myCarousel" class="carousel slide">
    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
        <?php
        $limit = $kite_muri['slider_max_number'];
        $loop = get_custom_post('slider',$limit);
        $i = 1;
        while ( $loop->have_posts() ) : $loop->the_post();
        ?>
            <!-- Slider 01 -->
            <div class="item<?php echo ($i===1) ? ' active' : ''; ?>">
            <div class="fill"><img alt="CloudBee : kite" src="<?php echo $img = get_post_meta( $post->ID, '_kite_slider_media', true );?>"></div>
            <div class="carousel-caption carousel-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-md-push-6 wow fadeInUp">
                            <h2><?php echo the_title();?></h2>
                            <h5><?php echo $sub = get_post_meta($post->ID, '_kite_slider_sub_title', true );?></h5>
                            <a href="<?php echo $url = get_post_meta($post->ID, '_kite_slider_btn_url', true );?>" class="btn btn-white"><?php echo $sub = get_post_meta($post->ID, '_kite_slider_btn_title', true );?></i></a>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div>
        </div><!-- /Slider 01 -->
        <?php $i++; endwhile ;?>
    <!-- Controls -->
        <span>
        	<a class="left carousel-control carousel-control-navi" href="#myCarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
        </span>
        <span>
        	<a class="right carousel-control carousel-control-navi" href="#myCarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </span>
    <!-- /Controls -->
</header>
<!-- /Full Page Carousel Header -->