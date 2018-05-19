<? include_once 'header.php'; // подключение хэдера ?>
    <div class="content">
        <nav class="menu_content">
            <div class="container">
                <a href="index.php">Главная</a>
                <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]["name"];?>
            </div>
        </nav>

        <main>
            <article>
                <div class="container">
                    <?
                    if ($_POST['sha1_hash']) {
                        $secret_key = '51v9SQ86bzc9GDgM8sGhtWFO'; // секретное слово, которое мы получили в предыдущем шаге.
                        // формирование хэша
                        $sha1 = sha1($_POST['notification_type'] . '&' . $_POST['operation_id'] . '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&' . $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key . '&' . $_POST['label']);

                        if ($sha1 != $_POST['sha1_hash']) {
                            // тут содержится код на случай, если верификация не пройдена

                        }
                        // тут код на случай, если проверка прошла успешно
                        $pdo->updateRow("UPDATE `priem` SET `color`= ?,`oplata`= ? WHERE `number_zakaza`= ? ", ['1', 'Оплачен', $_POST['label']]);

                    }
                    ?>
                    <h2>Ваш заказ № <?=$_REQUEST["orderid"];?> успешно оплачен</h2>
                    <p>
                        <?=$_SESSION["USER"]["name"]?>, <?=$template["MAGAZIN"]["name"]?> благодарит Вас, за покупку в нашем интернет-магазине.
                    </p>
                    <p>
                        Вы можете отследить статус своего заказа в <a href="/lc.php">личном кабинете</a>.
                    </p>
                    <p>
                        Будем рады ответить на все ваши вопросы: <a href="tel:<?=$template["MAGAZIN"]['phone']?>"><?=$template["MAGAZIN"]['phone']?></a>, <a href="mailto:<?=$template["MAGAZIN"]['email']?>"><?=$template["MAGAZIN"]['email']?></a>
                    </p>
                </div>
            </article>
        </main>

    </div>
<? include_once 'footer.php'; // подключение футера ?>