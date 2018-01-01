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
                <h1>Согласие на обработку персональных данных.</h1>
                <p>
                    Настоящим в соответствии с Федеральным законом № 152-ФЗ «О персональных данных» от 27.07.2006 года свободно, своей волей и в своем интересе выражаю свое безусловное согласие на обработку моих персональных данных <?=$template["FIRMA"];//$template["MAGAZIN"]["name"]?>, зарегистрированным в соответствии с законодательством РФ по адресу:
                    <?=$template["ADRESS"]?> (далее по тексту - Оператор).
                </p>
                <p>
                            Персональные данные - любая информация, относящаяся к определенному или определяемому на основании такой информации физическому лицу.
                            Настоящее Согласие выдано мною на обработку следующих персональных данных:
                </p>
                            <br>- Фамилию
                            <br>- Имя
                            <br>- Номера телефона
                            <br>- Адреса доставки

                <br>
                <br>
                <p>
                    Согласие дано Оператору для совершения следующих действий с моими персональными данными с использованием средств автоматизации и/или без использования таких средств: сбор, систематизация, накопление, хранение, уточнение (обновление, изменение), использование, обезличивание, передача третьим лицам для указанных ниже целей, а также осуществление любых иных действий, предусмотренных действующим законодательством РФ как неавтоматизированными, так и автоматизированными способами.
                    Данное согласие дается Оператору для обработки моих персональных данных в следующих целях:
                        Для приема заказа и связи с клиентом, а так же чтобы клиент смог получить доступ к личному кабинету, для просмотра деталей заказа.
                </p>

                <p>
                                    Настоящее согласие действует до момента его отзыва путем направления соответствующего уведомления на электронный адрес <?=$template["MAGAZIN"]["email"]?>. В случае отзыва мною согласия на обработку персональных данных Оператор вправе продолжить обработку персональных данных без моего согласия при наличии оснований, указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального закона №152-ФЗ «О персональных данных» от 26.06.2006 г.
                </p>
            </div>
        </article>
    </main>

</div>
<? include_once 'footer.php'; // подключение футера ?>