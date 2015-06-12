<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:07 PM
 */
    global $kite_muri;
?>
<!-- Timeline Blog Section -->
<section class="section-wrapper blog-section" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="section-title wow fadeInDown">
                    <h2><?=$kite_muri['blogPage_subtitle'];?></h2>
                    <h4><?=$kite_muri['blogPage_subtitle_2'];?></h4>
                </div>
            </div>
        </div><!-- /.row -->
        <?php
            if($kite_muri['blog_style']==true){
                if($kite_muri['blog_style_opt']==1){ ?>
                    <!-- Timeline Blog -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="timeline">
                                <?php
                                $limit = $kite_muri['blog_limit'];
                                $args = array( 'posts_per_page' => $limit );
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <li>
                                        <div class="timeline-img wow fadeInUp">
                                            <?php
                                            if (has_post_thumbnail( $post->ID ) ){
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_default' );?>
                                                <img class="img-circle img-responsive" src="<?php echo $image[0];?>" alt="<?=the_title();?>">
                                            <?php }
                                            else{ ?>
                                                <img class="img-circle img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/img/portfolio_2.jpg" alt="<?=the_title();?>">
                                            <?php }
                                            ?>
                                        </div>
                                        <div class="timeline-panel  wow fadeInLeft">
                                            <div class="timeline-heading">
                                                <p><?= the_time('M j, Y');?></p>
                                                <a href="<?=get_permalink();?>"><h4 class="heading"><?=the_title();?></h4></a>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="text-muted"><?=the_excerpt();?></p>
                                                <a href="<?=get_permalink();?>" class="btn btn-small-default">Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile;
                                ?>
                            </ul>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-12 btn-position-center"><a href="/blog" class="btn btn-default">Load More</a></div>
                    </div>
              <?php  }elseif($kite_muri['blog_style_opt']==2){?>
                    <div class="row">
                        <div class="col-md-7 padless">
                            <?php
                                $loop = get_blog_post(1,0);
                                foreach($loop as $post):setup_postdata( $post );
                                    if (has_post_thumbnail( $post->ID ) ){
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_style2_1' );
                                    }else{
                                        $image[0]= '';
                                    }
                            ?>
                                    <div class="block-1" style="background: url(<?php echo $image[0];?>);">
                                        <div class="effect">
                                            <div class="caption">
                                                <h4>
                                                    <a href="<?php the_permalink();?>">
                                                        <?php the_title();?>
                                                    </a>
                                                </h4>
                                                <span><?php the_time('M j, Y');?></span>
                                                   <?php the_content();?>
                                                <a href="<?php the_permalink();?>" class="btn btn-default btn-orange">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php  endforeach;
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="col-md-5 padless">
                                <?php
                                $loop = get_blog_post(1,1);
                                foreach($loop as $post):setup_postdata( $post );
                                    if (has_post_thumbnail( $post->ID ) ){
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_style2_2' );
                                    }else{
                                        $image[0]= '';
                                    }
                                    ?>
                                    <div class="block-2" style="background: url(<?php echo $image[0];?>);">
                                        <div class="effect">
                                            <div class="caption">
                                                <h4>
                                                    <a href="<?php the_permalink();?>">
                                                        <?php the_title();?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php  endforeach;
                                wp_reset_postdata();
                                ?>
                                <div class="block-4">
                                        <?php
                                        $loop = get_blog_post(2,2);
                                        foreach($loop as $post):setup_postdata( $post );
                                            if (has_post_thumbnail( $post->ID ) ){
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_style2_3' );
                                            }else{
                                                $image[0]= '';
                                            }
                                            ?>
                                            <div class="block-5" style="background: url(<?php echo $image[0];?>);">
                                                <div class="effect">
                                                    <div class="caption">
                                                        <h4>
                                                            <a href="<?php the_permalink();?>">
                                                                <?php the_title();?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php  endforeach;
                                        wp_reset_postdata();
                                        ?>
                                </div>
                        </div>
                    </div>
              <?php  }
                else{ ?>
                    <!-- Timeline Blog -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="timeline">
                                <?php
                                $limit = $kite_muri['blog_limit'];
                                $args = array( 'posts_per_page' => $limit );
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <li>
                                        <div class="timeline-img wow fadeInUp">
                                            <?php
                                            if (has_post_thumbnail( $post->ID ) ){
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_default' );?>
                                                <img class="img-circle img-responsive" src="<?php echo $image[0];?>" alt="<?=the_title();?>">
                                            <?php }
                                            else{ ?>
                                                <img class="img-circle img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/img/portfolio_2.jpg" alt="<?=the_title();?>">
                                            <?php }
                                            ?>
                                        </div>
                                        <div class="timeline-panel  wow fadeInLeft">
                                            <div class="timeline-heading">
                                                <p><?= the_time('M j, Y');?></p>
                                                <a href="<?=get_permalink();?>"><h4 class="heading"><?=the_title();?></h4></a>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="text-muted"><?=the_excerpt();?></p>
                                                <a href="<?=get_permalink();?>" class="btn btn-small-default">Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile;
                                ?>
                            </ul>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-12 btn-position-center"><a href="/blog" class="btn btn-default">Load More</a></div>
                    </div>
             <?php   }
            }else{ ?>
                <!-- Timeline Blog -->
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <?php
                            $limit = $kite_muri['blog_limit'];
                            $args = array( 'posts_per_page' => $limit );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <li>
                                    <div class="timeline-img wow fadeInUp">
                                        <?php
                                        if (has_post_thumbnail( $post->ID ) ){
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog_default' );?>
                                            <img class="img-circle img-responsive" src="<?php echo $image[0];?>" alt="<?=the_title();?>">
                                        <?php }
                                        else{ ?>
                                            <img class="img-circle img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/img/portfolio_2.jpg" alt="<?=the_title();?>">
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="timeline-panel  wow fadeInLeft">
                                        <div class="timeline-heading">
                                            <p><?= the_time('M j, Y');?></p>
                                            <a href="<?=get_permalink();?>"><h4 class="heading"><?=the_title();?></h4></a>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted"><?=the_excerpt();?></p>
                                            <a href="<?=get_permalink();?>" class="btn btn-small-default">Read More</a>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile;
                            ?>
                        </ul>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-12 btn-position-center"><a href="/blog" class="btn btn-default">Load More</a></div>
                </div>
        <?php } ?>
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->