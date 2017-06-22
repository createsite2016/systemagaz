<?php
session_start();

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();

// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}
// Иначе открываем для него контент
else { include("verh.php"); ?>

    <!-- / nav -->
    <section id="content">
        <section class="main padder">
            <div class="row">
                <div class="col-lg-12">
                    <section class="toolbar clearfix m-t-large m-b">

                    </section>
                </div>
            </div></section></section>

    </div>

    </div>
    <div class="row">
    <?php
    $id = $_GET['id'];
    $params = $pdo->getRow( "SELECT * FROM `pages` WHERE `id`= ? ", [$id] ); //извлекаем из базы все данные о странице
    ?>
    <section class="panel">
        <div class="panel-body">
            <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                    <div class="col-lg-9 media">
                        <center><h4><i class="icon-edit"></i>Редактирование старницы</h4></center>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Название страницы:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="name" placeholder="" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>" >
                        <input type="hidden" name="action" value="izm_pages">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Описание страницы:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="about" placeholder="" class="form-control parsley-validated" value="<?php echo $params['about']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Описание страницы:</label>
                    <div class="col-lg-8">
                        <script src="js/nicedit.js" type="text/javascript"></script>
                        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

                        <div id="sample">
                            <script type="text/javascript" src="js/nicedit2.js"></script> <script type="text/javascript">
                                //<![CDATA[
                                bkLib.onDomLoaded(function() {
                                    new nicEditor({fullPanel : true}).panelInstance('area2');
                                    new nicEditor({maxHeight : 100}).panelInstance('area2');
                                });
                                //]]>
                            </script>


                            <textarea cols="100" rows="30" id="area2" name="datapage">
                                <?php echo $params['datapage']; ?>
                            </textarea>

                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        <span class="center"><a href="pages.php" class="btn btn-default btn-xs">Отмена</a></span>
                    </div>
                </div>
            </form>


        </div>
    </section>

    <?php include("niz.php"); }?>