<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:21 PM
 */
?>
<?php
    global $kite_muri;
?>
<!-- Team Section -->
<section class="section-wrapper team" id="team-section">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="section-title-white wow fadeInDown"><h2><?=$kite_muri['team_section_title'];?></h2></div>
            </div>
        </div><!-- /.row -->

        <div class="container-fluid">
            <div class="row">
                <div id="team-members">
                    <div class="text-center">
                        <?php
                            $max = $kite_muri['team_max_display'];
                            $loop = get_custom_post('team',$max);
                            while ( $loop->have_posts() ) : $loop->the_post();
                        ?>
                                <div class="col-md-3">
                                    <figure data-toggle="modal" data-target="#<?=the_ID();?>" class="wow fadeInUp">
                                        <img src="<?php echo get_post_meta($post->ID, '_kite_team_img', true );?>">
                                        <a href="#">
                                            <figcaption>
                                                <h4><?php echo the_title();?></h4>
                                                <p><?php echo get_post_meta($post->ID, '_kite_rl_position', true );?></p>
                                                <div class="team-social-icon">
                                                    <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_tw', true );?>"><i class="fa fa-twitter"></i></a>
                                                    <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_fb', true );?>"><i class="fa fa-facebook"></i></a>
                                                    <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_linkedin', true );?>"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </figcaption>
                                        </a>
                                    </figure>
                                </div>

                                <div class="modal fade " id="<?=the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="row">
                                                <div class="modal-body">
                                                    <div class="col-md-4">
                                                        <img src="<?php echo get_post_meta($post->ID, '_kite_team_img', true );?>">
                                                        <div class="modal-team-social-icon">
                                                            <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_tw', true );?>"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_fb', true );?>"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="<?php echo get_post_meta($post->ID, '_kite_team_social_linkedin', true );?>"><i class="fa fa-linkedin"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="team-detail-title"><?=the_title();?></div>
                                                        <div class="team-detail-designation">
                                                            <?php echo get_post_meta($post->ID, '_kite_rl_position', true );?>
                                                        </div>
                                                        <div class="team-detail-bio">
                                                            <?php echo get_post_meta($post->ID, '_kite_team_bio', true );?>
                                                        </div>
                                                        <div class="team-detail-close">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Oky!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container fluid -->
    </div><!-- /.container -->
</section><!-- /.section-wrapper -->