<?php
/**
 *  Template Name: Kite One page
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:01 PM
 */
get_header();
global $kite_muri;?>
    <?php
        if($kite_muri['slider_switch-on']==true){
            get_template_part('kite','header' );
        }
    ?>
    <?php
        if($kite_muri['servicePage_switch-on']==true){
            get_template_part('kite','service' );
        }
    ?>
    <?php
        get_template_part('kite','calltoaction' );
    ?>
    <?php
        if($kite_muri['portfolio_switch-on']==true){
            get_template_part('kite','portfolio' );
        }
    ?>
    <?php get_template_part('kite','calltoaction' ); ?>
    <?php
        if($kite_muri['about_switch-on']==true){
            get_template_part('kite','about' );
        }
    ?>
    <?php
        if($kite_muri['team_switch-on']==true){
            get_template_part('kite','team' );
        }
    ?>
    <?php
        if($kite_muri['testimonial_switch-on']==true){
            get_template_part('kite','testimonial' );
        }
    ?>
    <?php
        if($kite_muri['price_switch-on']==true){
            get_template_part('kite','price' );
        }
    ?>
    <?php get_template_part('kite','calltoaction' ); ?>
    <?php
        if($kite_muri['blog_switch-on']==true){
            get_template_part('kite','blog' );
        }
    ?>
    <?php
        if($kite_muri['contact_switch-on']==true){
            get_template_part('kite','contact' );
        }
    ?>
<?php get_footer(); ?>