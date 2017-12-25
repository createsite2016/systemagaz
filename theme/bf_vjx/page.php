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
                if($user["RULES"] == 'y') {?>
                    <a class="btn btn_yellow_bord" href="/admin/fl_izm_page.php?id=<?=$_GET['id']?>" target="_blank">редактировать текст страницы</a>
                <?}?>
                <p>
                    <?=$template["NAME_OPEN_CATEGOR"]['datapage'] ?>
                </p>
            </div>
        </article>
    </main>

</div>
<? include_once 'footer.php'; // подключение футера ?>
