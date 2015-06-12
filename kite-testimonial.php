<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:06 PM
 */
    global $kite_muri;
?>
<!-- Loyal Clients & Testimonial Section -->
<section class="section-wrapper" id="clients">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="section-title wow fadeInDown">
                    <h2><?=$kite_muri['testimonial-title'];?></h2>
                </div>
            </div>
        </div><!-- /.row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div id="carousel-testimonial" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php
                            $loop = get_custom_post('testimonial',4);
                            $i = 0;
                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                <div class="item <?php echo ($i===0) ? ' active  ' : '';  ?> <?php echo the_ID();?> ">
                                    <span class="quote-icon"><i class="fa fa-quote-right"></i></span>
                                    <div class="testimonial-img">
                                        <div class="img-responsive"><img src="<?php echo $profile_img = get_post_meta($post->ID, '_kite_client_pic', true );?>" alt="KITE :CloudBee" /></div>
                                    </div>
                                    <div class="testimonial-content">
                                        <p><?php echo $bio = get_post_meta($post->ID, '_kite_client_bio', true );?></p>
                                        <h4><?=the_title();?></h4>
                                        <p class="job-post"><?php echo $designation = get_post_meta($post->ID, '_kite_client_designation', true );?></p>
                                    </div>
                                </div>
                            <?php $i++;wp_reset_postdata(); endwhile; ?>
                        </div>
                        <div class="clear"></div>
                        <ol class="carousel-indicators">
                            <?php
                            $loop = get_custom_post('testimonial',4);
                            $in = 0;
                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                <li data-target="#carousel-testimonial" data-slide-to="<?=$in;?>" class="client-logo <?php echo ($in==0) ? ' active' : ' '; ?> client-logo-<?php echo the_ID();?>"></li>
                                <style type="text/css">
                                    .client-logo-<?php echo the_ID();?>{
                                        background: url('<?php echo $logo = get_post_meta($post->ID, '_kite_client_logo', true );?>') no-repeat transparent;
                                    }
                                </style>
                                <?php $in++;
                            endwhile;
                            ?>
                        </ol>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-testimonial" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-testimonial" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                        <!-- Indicators -->
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div><!-- /.container -->
</section><!-- /.section-wrapper -->