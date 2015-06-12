<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:21 PM
 */
?>
<?php
    if(is_page_template('kite.php')){ ?>
        <!-- Call To Action Section -->
        <section class="section-wrapper call-to-action call-to-action-dark" id="call-to-action-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-push-1">
                        <div class="section-title-white wow fadeInDown">
                            <h2>Satisfaction comes first</h2>
                            <h4>We’re passionate about simplifying...</h4>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-push-1 btn-call-to-action"><a class="btn btn-default" href="#">GET STARTED NOW</a></div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.wrapper -->
   <?php }else{ ?>
        <!-- Call To Action Section -->
        <section class="section-wrapper call-to-action call-to-action-light" id="call-to-action-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-push-1">
                        <div class="section-title wow fadeInDown">
                            <h2>Satisfaction comes first</h2>
                            <h4>We’re passionate about simplifying...</h4>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-push-1 btn-call-to-action"><a class="btn btn-default" href="#">GET STARTED NOW</a></div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.wrapper -->
   <?php }
?>