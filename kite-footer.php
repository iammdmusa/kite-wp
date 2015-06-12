<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 1/24/2015
 * Time: 7:25 PM
 */
    global $kite_muri;
?>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-text-left"><p><?=$kite_muri['copyright_info'];?></p></div>
            </div>
            <div class="col-lg-4">
                <div class="footer-logo-img"><a class="page-scroll" href="#page-top" data-target=".navbar-fixed-bottom"><img src="<?php echo $kite_muri['kite_logo'][url];?>" alt="KITE: Home" /></a></div>
            </div>
            <div class="col-lg-4">
                <div class="footer-text-right">
                    <?php
                        if($kite_muri['dev_credit_off']==true){
                            echo $kite_muri['dev_credit_info'];
                        }else{ ?>
                        Designed & Developed by <a href="http://cloudbee-bd.com">CloudBee</a>
                     <?php   }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /.footer -->