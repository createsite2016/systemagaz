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
$params = $pdo->getRow( "SELECT * FROM `magazins` WHERE `id`= ? ", [$id] ); //извлекаем из базы все данные о пользователе с введенным логином
?>
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование магазина</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Название:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="name" placeholder="" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="action" value="izm_magaz">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Номер телефона:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="phone" placeholder="" class="form-control parsley-validated" value="<?php echo $params['phone']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Емаил:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="email" placeholder="" class="form-control parsley-validated" value="<?php echo $params['email']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Примечание:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" placeholder="" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">ID группы в ОК:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="idokgroup" placeholder="" class="form-control parsley-validated" value="<?php echo $params['id_ok_group']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Вечный токен</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="token" placeholder="" class="form-control parsley-validated" value="<?php echo $params['token']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Секретный ключ</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="private_key" placeholder="" class="form-control parsley-validated" value="<?php echo $params['private_key']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Публичный ключ</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="public_key" placeholder="" class="form-control parsley-validated" value="<?php echo $params['public_key']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Виджет группы ОК?</label>
                  <div class="col-lg-8">
                    <select name="reklama">
                      <option selected="" value="Да">Да</option>
                      <option value="Нет">Нет</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Instagram логин:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="instagramlogin" placeholder="" class="form-control parsley-validated" value="<?php echo $params['instagram_login']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Instagram пароль:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="instagrampassword" placeholder="" class="form-control parsley-validated" value="<?php echo $params['instagram_password']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Лимит дней:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="time_day" placeholder="" class="form-control parsley-validated" value="<?php echo $params['time_day']; ?>">
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="magazins.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>