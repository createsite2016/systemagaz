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
                    $secret_key = '51v9SQ86bzc9GDgM8sGhtWFO'; // секретное слово, которое мы получили в предыдущем шаге.

                    // возможно некоторые из нижеперечисленных параметров вам пригодятся
                    // $_POST['operation_id'] - номер операция
                    // $_POST['amount'] - количество денег, которые поступят на счет получателя
                    // $_POST['withdraw_amount'] - количество денег, которые будут списаны со счета покупателя
                    // $_POST['datetime'] - тут понятно, дата и время оплаты
                    // $_POST['sender'] - если оплата производится через Яндекс Деньги, то этот параметр содержит номер кошелька покупателя
                    // $_POST['label'] - лейбл, который мы указывали в форме оплаты
                    // $_POST['email'] - email покупателя (доступен только при использовании https://)

                    $sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

                    if ($sha1 != $_POST['sha1_hash'] ) {
                        // тут содержится код на случай, если верификация не пройдена
                        exit();
                    }

                    // тут код на случай, если проверка прошла успешно
                    $pdo->insertRow("INSERT INTO `klient` (`name`) VALUES (?)",[$_POST['label']]);

                    exit();
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