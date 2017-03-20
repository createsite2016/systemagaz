<?php
session_start();
// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}  
// Иначе открываем для него контент
else { include("verh.php"); ?>

<!-- / Тело страницы -->
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
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" enctype = "multipart/form-data" method="POST" data-validate="parsley">

                <div class="form-group">
                  <label class="col-lg-3 control-label">Должность:</label>
                  <div class="col-lg-8">
                  <select class="select2-offscreen" name="profes" tabindex="-1" id="select2-option" style="width:300px">
                          <option value="Менеджер">Менеджер</option>
                          <option value="Администратор">Администратор</option>
                          <option value="Директор">Директор</option>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Имя:</label>
                  <div class="col-lg-8">
                    <input type="text" name="name" placeholder="Иван" class="bg-focus form-control parsley-validated" data-required="true" autocomplete="off">
                      <input type="hidden" name="action" value="add_user">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Логин:</label>
                  <div class="col-lg-8">
                    <input type="text" name="login" placeholder="ivan" data-required="true" class="form-control parsley-validated" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Пароль:</label>
                  <div class="col-lg-8">
                    <input type="text" name="password" placeholder="123qwe" data-required="true" class="form-control parsley-validated" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Добавить сотрудника</button>
                    <span class="center"><a href="users.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>
