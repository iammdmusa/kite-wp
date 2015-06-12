<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:05 PM
 */
    global $kite_muri;
?>
<!-- Portfolio Section -->
<section class="section-wrapper" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="section-title wow fadeInDown">
                    <h2><?php echo $title = $kite_muri['protfolioPage'];?></h2>
                    <h4><?php echo $subTitle = $kite_muri['protfolio-sub-title'];?></h4>
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div id="portfolio-items">
                <div class="controls text-center portfolio-filters">
                    <?php if(!is_tax()) {
                    $terms = get_terms("portfolio_categories");
                    $count = count($terms);
                    if ( $count > 0 ){ ?>
                        <a class="filter btn btn-default" data-filter="all"><?php  _e('All', 'kite'); ?></a>
                    <?php foreach ( $terms as $term ) { ?>
                        <a class="filter btn btn-default" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                    <?php } } } ?>
                </div>
                <div class="text-center">
                    <?php
                        $loop = get_custom_post('portfolio',-1);
                        while ( $loop->have_posts() ) : $loop->the_post();?>
                            <div <?php post_class('col-md-3 mix') ?> data-myorder="<?php echo $pId = the_ID();;?>">
                                <figure class="wow fadeInRightBig animated">
                                    <img src="<?php echo $img = get_post_meta($post->ID, '_kite_portfolio_img', true );?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <figcaption>
                                            <div class="featured-icon"><i class="fa fa-link"></i></div>
                                            <h4><?php the_title(); ?></h4>
                                            <p><?php echo $desc = get_post_meta($post->ID, '_kite_portfolio_description', true );?></p>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                       <?php endwhile;
                    ?>
                </div>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->