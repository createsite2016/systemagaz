<? include_once 'header.php'; // подключение хэдера ?>
<div class="content">
    <nav class="menu_content">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]["name"];?>
        </div>
    </nav>

    <main>
        <section class="person_cab_sect">
            <div class="container">
                <?if (!empty($template["priem"])) {?>
                <h1>Мои заказы</h1>
                <div class="table_hold">
                    <table>
                        <tbody><tr>
                            <th>&nbsp;</th>
                            <th>ДАТА</th>
                            <th>Цена</th>
                            <th>Товар</th>
                            <th>Статус</th>
                            <th>Номер заказа</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        </tbody><tbody>

                        <? include('admin/showdata_forpeople.php'); // подключение библиотеки для вывода человеко-понятной даты?>
                        <?foreach ($template["priem"] as $item) {?>
                            <tr>
                                <td>&nbsp;</td>
                                <td class="vert_top">
                                    <span class="time">
                                        <? $vremya = date_smart($item["datatime"]); echo $vremya ?>
                                    </span>
                                    <span class="dil">Самовывоз</span>
                                </td>
                                <td class="vert_top">
                                    <span class="price">
                                        <?if ($item["skidka"] !== ''){?>
                                            <?$res_chena = $item["chena_output"]-($item["chena_output"]/100 * $item["skidka"]);?>
                                            <?=$res_chena;?> руб.
                                        <?} else {?>
                                            <?=$res_chena = $item["chena_output"]?> руб.
                                        <?}?>
                                    </span>
                                    <span class="price_met"><img src="<?=$item["image"]?>" alt="image" width="47" height="28"></span>
                                </td>
                                <td class="vert_top">
                                    <ul class="dash_list">
                                        <li><a href="http://magaz/product.php?id=<?=$item["tovar"]?>&cat=<?=$item["categor_id"]?>" target="_blank"><?=$item["name"]?> (<?=$item["kolvo"]?> шт.)</a></li>
                                    </ul>
                                </td>
                                <td><b class="status"><?=$item["status"]?></b><br>(<?=$item["oplata"]?>)</td>
                                <td>
                                    <?=$item["number_zakaza"]?>
                                    <?
                                    $summa = 0;
                                    $zakaz = $pdo->getRows("SELECT * FROM `tovar` AS `t`, `priem` AS `p` WHERE `p`.`tovar` = `t`.`id` AND `p`.`number_zakaza` = ?",[$item[number_zakaza]]);
                                    foreach ($zakaz as $value){
                                        if($value["skidka"]){
                                            $res_chena = $value["chena_output"]-($value["chena_output"]/100 * $value['skidka']);
                                            $summa = ($value["kolvo"]*$res_chena) + $summa;
                                        } else {
                                            $summa = ($value["kolvo"] * $value["chena_output"]) + $summa;
                                        }
                                    }
                                    ?>
                                    <br>
                                    <?if($item["oplata"]=="Оплачен"){echo '<font color="green">('.$item["oplata"].')</font>';}else{?>
                                        <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
                                            <input type="hidden" name="receiver" value="<?=$template["MAGAZIN"]["ya_money"]?>">
                                            <input type="hidden" name="formcomment" value="<?=$template["MAGAZIN"]["name"]?>">
                                            <input type="hidden" name="short-dest" value="Оплата заказа № <?=$item["number_zakaza"]?>">
                                            <input type="hidden" name="label" value="<?=$item["number_zakaza"]?>">
                                            <input type="hidden" name="successURL" value="http://<?=$_SERVER['HTTP_HOST']?>/thankyou.php?orderid=<?=$item["number_zakaza"]?>">
                                            <input type="hidden" name="quickpay-form" value="shop">
                                            <input type="hidden" name="targets" value="транзакция № <?=$item["number_zakaza"]?>">
                                            <input type="hidden" name="sum" id="sum" value="<?=$summa?>">
                                            <?
                                            $date_today = date("m.d.y");
                                            $today[1] = date("H:i:s");
                                            ?>
                                            <input type="hidden" name="comment" value="Оплачен время: <?=$today[1]?> дата: <?=$date_today?>");">
                                            <input type="hidden" name="need-fio" value="false">
                                            <input type="hidden" name="need-email" value="false">
                                            <input type="hidden" name="need-phone" value="false">
                                            <input type="hidden" name="need-address" value="false">
                                            <label><input type="hidden" name="paymentType" value="AC"></label>
                                            <input type="submit" value="Оплатить заказ (<?=$summa?> рублей)">
                                        </form>
                                    <?}?>
                                </td>
                                <td>
                                    <?if ($item["status"] == 'Новый заказ') {?>
                                        <?if($item["oplata"]=="Оплачен"){

                                        }else{?>
                                            <a class="bnt_close" onclick="lc_delete_order(<?=$item["id"]?>)"></a>
                                        <?}?>
                                    <?}?>

                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                </div>
                <?} else {?>
                <h1>У Вас нет ни одного активного заказа</h1>
                    <br>
                    <br>
                    <br>
                    <br>
                <?}?>
            </div>
            <!-- end .container -->
        </section>


        <script type="text/javascript" src="js/mask.js"></script>

        <script>
            $("#myphone").mask("7(999) 999-9999", {placeholder: "7(___) ___ - ____" });
        </script>

        <section class="prs_sect_hold">
            <div class="container">
                <div class="prs_sect_cont">
                    <div class="person_cab_form">
                        <h2 class="h2">Мои личные данные</h2>
                        <div class="half_hold">
                            <div class="half">
                                <div class="input_hold">
                                    <label>Имя:</label>
                                    <div class="input">
                                        <input name="" required="" id="myname" type="text" value="<?=$_SESSION["USER"]["name"]?>">
                                    </div>
                                    <!-- end .input -->
                                </div>
                                <!-- end .input_hold -->
                                <div class="input_hold">
                                    <label>Телефон (логин):</label>
                                    <div class="input">
                                        <input name="" required="" id="myphone" disabled type="text" value="<?=$_SESSION["USER"]["phone"]?>">
                                    </div>
                                    <!-- end .input -->
                                </div>

                                <!-- end .input_hold -->
                            </div>
                            <!-- end .half -->
                            <div class="half">
                                <div class="input_hold">
                                    <label>Адрес доставки</label>
                                    <div class="input">
                                        <input name="" required="" id="myadress" value="<?=$_SESSION["USER"]["adress"]?>">
                                    </div>
                                    <!-- end .input -->
                                </div>
                                <!-- end .input_hold -->
                                <div class="input_hold">
                                    <label>пароль</label>
                                    <div class="input">

                                        <input name="" value="<?=$_SESSION["USER"]["password"]?>" id="mypassword" placeholder="" required="" type="password">

                                        <label class="custom_check_lab">
                                            <input class="outtaHere" name="" id="myCheckBox" type="checkbox" onclick="check();">
                                            <span class="custom_checkbox"></span>
                                            Показать пароль
                                        </label>

                                    </div>
                                    <!-- end .input -->
                                </div>
                            </div>
                            <!-- end .half -->
                        </div>

                        <button class="btn btn_red_big" onclick="lc_save_newdata_klient();">Сохранить</button>
                    </div>

                </div>

                <!-- end .prs_sect_left -->

                <!-- end .prs_sect_right -->
            </div>
            <!-- end .container -->
        </section>
        <!-- end .prs_sect_hold -->
    </main>

</div>
<? include_once 'footer.php'; // подключение футера ?>
