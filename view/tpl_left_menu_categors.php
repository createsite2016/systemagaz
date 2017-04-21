<?php ?>
<div class="left-sidebar">
    <h2>Категории</h2>
    <div class="panel-group category-products" id="accordian"><!--Категории товаров-->

        <?php
        $get_category = $pdo->getRows("SELECT * FROM `categor` ORDER BY `sort`");
        foreach ( $get_category as $category ) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="categor.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></h4>
                </div>
            </div>
        <?php } ?>
    </div><!--/Категории товара-->

    <?php
    if ( $shop['reklama'] == 'Да' ) { ?>
        <!--/Банер для рекламы-->
        <div class="shipping text-center">
            <div id="ok_group_widget"></div>
            <script>
                !function (d, id, did, st) {
                    var js = d.createElement("script");
                    js.src = "https://connect.ok.ru/connect.js";
                    js.onload = js.onreadystatechange = function () {
                        if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                            if (!this.executed) {
                                this.executed = true;
                                setTimeout(function () {
                                    OK.CONNECT.insertGroupWidget(id,did,st);
                                }, 0);
                            }
                        }}
                    d.documentElement.appendChild(js);
                }(document,"ok_group_widget","58318300250167",'{"width":250,"height":335}');
            </script>
<!--            <img src="images/home/shipping2.jpg" alt="Загрузка банера не удалась" />-->
        </div>
    <?php } else {

    } ?>



</div>