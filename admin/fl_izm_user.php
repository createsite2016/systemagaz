<?php
session_start();
// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}  
// Иначе открываем для него контент
else { include("verh.php"); ?>

<!-- / Тело страницы -->
  <nav id="nav" class="nav-primary hidden-xs nav-vertical">
    <ul class="nav" data-spy="affix" data-offset-top="50">
<?php include('menu_left.php'); ?>

      </li>
    </ul>
  </nav>
  <!-- / nav -->
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="toolbar clearfix m-t-large m-b">

          </section>
        </div>
</div>

        </div>

      </div>
      <div class="row">
<?php
$id = $_GET['id'];
$get_params = mysql_query("SELECT * FROM `users_8897532` WHERE `id`='$id' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_user.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Изменение данных сотрудника</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Должность:</label>
                  <div class="col-lg-8">
                  <select class="select2-offscreen" name="profes" tabindex="-1" id="select2-option" style="width:300px">
                          
                          <?php if ($params['profes']=="Менеджер") { 
                            echo "<option value='Менеджер' selected>Менеджер</option>";
                            echo "<option value='Директор'>Директор</option>";
                            echo "<option value='Администратор'>Администратор</option>";
                          } ?>
                          <?php if ($params['profes']=="Директор") {
                            echo "<option value='Директор' selected>Директор</option>";
                            echo "<option value='Менеджер'>Менеджер</option>";
                            echo "<option value='Администратор'>Администратор</option>";
                          } ?>
                          <?php if ($params['profes']=="Администратор") {
                            echo "<option value='Администратор' selected>Администратор</option>";
                            echo "<option value='Менеджер'>Менеджер</option>";
                            echo "<option value='Директор'>Директор</option>";
                          } ?>
                  
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Имя:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_name" placeholder="Иван" data-required="true" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Логин:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_login" placeholder="ivan" data-required="true" class="form-control parsley-validated" value="<?php echo $params['login']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Пароль:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_password" placeholder="123qwe" data-required="true" class="form-control parsley-validated" value="<?php echo $params['password']; ?>">
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="users.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>
