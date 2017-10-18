<?php ?>
<footer id="footer"><!--Футер-->

    <div class="footer-bottom">
        <div class="container">
            <br>
            <div class="row">
                <br>
                <p class="pull-left">Интернет магазин <?php echo $shop['name']; ?> ©
                    <?php
                    $datatime = date("Y");
                    echo "2016 - ". $datatime ." г.";
                    ?>
                    Все права защищены.</p>
                <p class="pull-right">
                    <?php
                    if (!empty($shop['instagram_login'])) {?>
                        <a target="_blank" href="https://www.instagram.com/<?php echo $shop['instagram_login']; ?>"><img src="../images/instagram.png" width="48">Мы в Instagram</a>
                    <?} ?>
                    <?php
                    if (!empty($shop['id_ok_group'])) {?>
                        <a target="_blank" href="https://ok.ru/group/<?php echo $shop['id_ok_group']; ?>"><img src="../images/odnoklassniki.png" width="48">Мы в ОК</a>
                    <?} ?>
                    <?php
                    if (!empty($shop['id_ok_page'])) {?>
                        <a target="_blank" href="https://ok.ru/profile/<?php echo $shop['id_ok_page']; ?>"><img src="../images/odnoklassniki.png" width="48">Мы в ОК</a>
                    <?} ?>
                    </span></p>
            </div>
            <br>
            <br>
            <br><br>

        </div>
    </div>

</footer><!--/Футер-->

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
<script src="../js/eshop.js"></script>
<script src="../js/check_cart.js"></script>
</body>
</html>
