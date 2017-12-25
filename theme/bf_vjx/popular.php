<? include_once 'header.php'; // подключение хэдера ?>
<div class="content">
    <nav class="menu_content">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]["name"];?>
        </div>
    </nav>

    <main>

        <!-- end .filter_hor_sect -->
        <section class="caregory_prod_sect caregory_prod_sect2">
            <div class="container">
                <h1 class="h1"><?=$template["NAME_OPEN_CATEGOR"]["name"]?></h1>

                <!-- end .chenge_view_sect -->
                <div class="caregory_prod_hold">
                    <? include_once 'include/tovars.php'; // подключение вывода товара ?>
                </div>
                <!-- end .page -->
            </div>
            <!-- end .container -->
        </section>
        <!-- end .caregory_prod_sect -->

        <!-- end .advantage_sect -->

        <!-- end .article_sect -->
    </main>

</div>
<? include_once 'footer.php'; // подключение футера ?>
