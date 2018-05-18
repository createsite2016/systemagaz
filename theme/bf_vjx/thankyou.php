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