<?php ?>
<footer id="footer"><!--Футер-->

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Интернет магазин <?php echo $shop['name']; ?> ©
                    <?php
                    $datatime = date("Y");
                    echo "2016 - ". $datatime ." г.";
                    ?>
                    Все права защищены.</p>
                <p class="pull-right">Разработанно <span><a target="_blank" href="http://www.themeum.com">iCRM</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Футер-->



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
<script src="../js/eshop.js"></script>
<script src="../js/check_cart.js"></script>
</body>
</html>
