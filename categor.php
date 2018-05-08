<?

# Страница вывода категорий и товаров открытой категории

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name`,`parent` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"] = $pdo->getRow("SELECT `name` FROM `categor` WHERE `id` = ?",[$_GET['cat']]); // имя открытой категории




//  ВЫВОД СТРАНИЦ НАВИГАЦИИ
$arra = $pdo->getRows("SELECT count(*) FROM `tovar` WHERE `categor_id` = ? GROUP BY `article`",[ $_GET['cat'] ]);
$total_articles_number = count($arra); //общее количество статей
$articles_per_page = 6; // количество заказов на странице
$b = $_GET['page'];
if (!isset($_GET['page'])) {
    $b=0;
}
$a = $b + $articles_per_page;
//получаем количество страниц
$total_pages = ceil($total_articles_number/$articles_per_page);

// запускаем цикл - количество итераций равно количеству страниц
for ( $i=0; $i<$total_pages; $i++ )
{
// получаем значение $from (как $page_number) для использования в формировании ссылки
    $page_number=$i*$articles_per_page;
// если $page_number (фактически это проверка того является ли $from текущим) не соответствует
// текущей странице,
// выводим ссылку на страницу со значением $from равным $page_number
    if ($total_articles_number > $articles_per_page ) {
        if ($page_number!=$from) {
            $step = $i+1;
            if ($_GET['i'] == $step) {
                $template["NAVIGATION"][] = "<a class='active' href='".$PHP_SELF."?page=".$page_number."&i=".$step."&cat=".$_GET['cat']."'> ".($i+1). " </a>";
            } else {
                $template["NAVIGATION"][] = "<a href='".$PHP_SELF."?page=".$page_number."&i=".$step."&cat=".$_GET['cat']."'> ".($i+1). " </a>";
            }


        }
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
        else {
            $page_number='1';
            $step = $i+1;
            if ($step == '1' and $_GET['page'] == '1') {
                $template["NAVIGATION"][] = "<a class='active' href='".$PHP_SELF."?page=".$page_number."&cat=".$_GET['cat']."'> ".($i+1)." </a>";
            } else {
                $template["NAVIGATION"][] = "<a href='".$PHP_SELF."?page=".$page_number."&cat=".$_GET['cat']."'> ".($i+1)." </a>";
            }
        } // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
    }
}





$template["TOVARS"] = $pdo->getRows("SELECT COUNT(*) AS kolvo_in_group, 
`id`,
`image`,
`name`,
`kolvo`,
`article`,
`chena_output`,
`categor_id`,
`new`,
`skidka`,
`model`,
`firma`,
`shows` 
FROM `tovar` WHERE `kolvo` > 0 AND `categor_id` = ? GROUP BY `article` LIMIT $b,$articles_per_page",[ $_GET['cat'] ]); // список товара в открытой категории

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"]    = $template["MAGAZIN"]['keywords'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["MAGAZIN"]['description'].' '.$template["MAGAZIN"]['city']; // Описание

include $template["TEMPLATE_PATH"].'categor.php'; // подключение страницы шаблона
?>

