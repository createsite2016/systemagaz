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
                                            <?=$res_chena;?> Р
                                        <?} else {?>
                                            <?=$res_chena = $item["chena_output"]?> Р
                                        <?}?>
                                    </span>
                                    <span class="price_met"><img src="<?=$item["image"]?>" alt="image" width="47" height="28"></span>
                                </td>
                                <td class="vert_top">
                                    <ul class="dash_list">
                                        <li><a href="http://magaz/product.php?id=<?=$item["tovar"]?>&cat=<?=$item["categor_id"]?>" target="_blank"><?=$item["name"]?> (<?=$item["kolvo"]?> шт.)</a></li>
                                    </ul>
                                </td>
                                <td><b class="status"><?=$item["status"]?></b></td>
                                <td><?=$item["number_zakaza"]?></td>
                                <td>
                                    <?if ($item["status"] == 'Новый заказ') {?>
                                    <a class="bnt_close" onclick="lc_delete_order(<?=$item["id"]?>)"></a>
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
