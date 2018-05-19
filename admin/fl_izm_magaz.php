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
  <?php
  $id = $_GET['id'];
  $params = $pdo->getRow( "SELECT * FROM `magazins` WHERE `id`= ? ", [$id] ); //извлекаем из базы все данные о пользователе с введенным логином
  ?>
  <!-- / nav -->
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
          <section class="toolbar clearfix m-t-large m-b">
            <center><h4><i class="icon-edit"></i>Настройки</h4></center>
            <section class="panel">
              <header class="panel-heading">
                <ul class="nav nav-tabs nav-justified">

                    <?if ( empty($_GET["razdel"]) ) {
                        $home = 'tab-pane active';
                        $homel = 'active';
                    } else {
                        $home = 'tab-pane';
                        $homel = '';
                    }?>

                    <?if ($_GET["razdel"] == "profile" ) {
                        $profile = 'tab-pane active';
                        $profilel = 'active';
                    } else {
                        $profile = 'tab-pane';
                        $profilel = '';
                    }?>

                    <?if ($_GET["razdel"] == "messages" ) {
                        $messages = 'tab-pane active';
                        $messagesl = 'active';
                    } else {
                        $messages = 'tab-pane';
                        $messagesl = '';
                    }?>

                    <?if ($_GET["razdel"] == "money" ) {
                        $money = 'tab-pane active';
                        $moneyl = 'active';
                    } else {
                        $money = 'tab-pane';
                        $moneyl = '';
                    }?>

                    <?if ($_GET["razdel"] == "settings" ) {
                        $settings = 'tab-pane active';
                        $settingsl = 'active';
                    } else {
                        $settings = 'tab-pane';
                        $settingsl = '';
                    }?>

                    <?if ($_GET["razdel"] == "sms" ) {
                        $sms = 'tab-pane active';
                        $smsl = 'active';
                    } else {
                        $sms = 'tab-pane';
                        $smsl = '';
                    }?>

                    <?if ($_GET["razdel"] == "chats" ) {
                        $chats = 'tab-pane active';
                        $chatsl = 'active';
                    } else {
                        $chats = 'tab-pane';
                        $chatsl = '';
                    }?>

                    <?if ($_GET["razdel"] == 'social' ) {
                        $social = 'tab-pane active';
                        $sociall = 'active';
                    } else {
                        $social = 'tab-pane';
                        $sociall = '';
                    }?>


                  <li class="<?=$homel?>"><a href="#home" data-toggle="tab">Магазин</a></li>
                  <li class="<?=$profilel?>"><a href="#profile" data-toggle="tab">Одноклассники</a></li>
                  <li class="<?=$messagesl?>"><a href="#messages" data-toggle="tab">Instagram</a></li>
                  <li class="<?=$moneyl?>"><a href="#money" data-toggle="tab">Яндекс Деньги</a></li>
                  <li class="<?=$settingsl?>"><a href="#settings" data-toggle="tab">SEO (Продвижение)</a></li>
                  <li class="<?=$smsl?>"><a href="#sms" data-toggle="tab">SMS сервер
                                                  <i class="icon-info-sign text-muted" data-toggle="popover" data-html="true" data-placement="top" data-content="API сервиса: (https://smsgateway.me)" title="" data-trigger="hover" data-original-title=""></i>
                      </a>
                  </li>
                  <li class="<?=$chatsl?>"><a href="#chats" data-toggle="tab">Чат и Звонки</a></li>
                  <li class="<?=$sociall?>"><a href="#social" data-toggle="tab">Ссылки на соц.сети</a></li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">

<!--Магазин-->
                  <div class="<?=$home?>" id="home">
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
                        <script src="../js/jquery.js"></script>
                        <script src="../js/mask.js"></script>
                        <script>
                          $("#checkphone").mask("+79999999999", {placeholder: "+7(___) ___ - ____" });
                        </script>
                        <input type="text" placeholder="" name="phone" id="checkphone" class="form-control parsley-validated" value="<?php echo $params['phone']; ?>">

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Емаил:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="email" placeholder="" class="form-control parsley-validated" value="<?php echo $params['email']; ?>">
                      </div>
                    </div>
                      
                    <div class="form-group" style="display: none">
                      <label class="col-lg-3 control-label">Тема оформления:</label>
                      <div class="col-lg-8">
                          <select name="theme">
                                        <?php
                                        $step = 0;
                                        $theme_sheme = array('yelow','blue','pink');
                                        $sql_get_categor = $pdo->getRow("SELECT * FROM `magazins`");
                                        foreach ($theme_sheme as $key=>$value) {
                                            if ($value == $sql_get_categor['theme']) {
                                                echo '<option selected="'.$sql_get_categor['theme'].'" value="'.$sql_get_categor['theme'].'">'.$sql_get_categor['theme'].'</option>';
                                            } else {
                                                echo '<option value="'.$value.'">'.$value.'</option>';
                                            }
                                        }
                                        ?>    
                                          
                                        </select>
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Примечание:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="komment" placeholder="" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                      </div>
                    </div>
                  </div>

<!--Одноклассники-->

                    <div class="<?=$profile?>" id="profile">
                        <div class="form-group">
                            <center>
                                <b>Инструкция по интеграции <a href="https://pixlpark.ru/faq/social/odnoklassniki" target="blank">ТУТ</a><b>
                                    </b></b>
                            </center>
                        </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">ID группы в ОК:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="idokgroup" placeholder="" class="form-control parsley-validated" value="<?php echo $params['id_ok_group']; ?>">
                      </div>
                    </div>

                    <div class="form-group" style="display: none">
                      <label class="col-lg-3 control-label">ID страницы в ОК:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="idokpage" placeholder="" class="form-control parsley-validated" value="<?php echo $params['id_ok_page']; ?>">
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

                    <div class="form-group" style="display: none">
                      <label class="col-lg-3 control-label">Виджет группы ОК?</label>
                      <div class="col-lg-8">
                        <select name="reklama">
                          <?php
                          if ($params['reklama'] == '') { ?>
                            <option value="Да">Да</option>
                            <option selected="" value="Нет">Нет</option>
                          <?} ?>
                          <?php
                          if ($params['reklama'] == 'Да') { ?>
                            <option selected="" value="Да">Да</option>
                            <option value="Нет">Нет</option>
                          <?} ?>
                          <?php
                          if ($params['reklama'] == 'Нет') { ?>
                            <option value="Да">Да</option>
                            <option selected="" value="Нет">Нет</option>
                          <?} ?>
                        </select>
                      </div>
                    </div>
                  </div>

<!--Яндекс Деньги-->
                  <div class="<?=$money?>" id="money">
                      <div class="form-group">
                          <center><a href="https://money.yandex.ru/myservices/online.xml" target="_blank">Настройки HTTP-уведомления по этой ссылке</a></center>
                      </div>

                      <div class="form-group">
                          <label class="col-lg-3 control-label"> Адрес для уведомлений:</label>
                          <div class="col-lg-8">
                              <input type="text" autocomplete="off" name="instagramlogin" placeholder="" class="form-control parsley-validated" value="http://<?=$_SERVER['HTTP_HOST']?>/thankyou.php">
                          </div>
                      </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Яндекс кошелек:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="ya_money" placeholder="" class="form-control parsley-validated" value="<?php echo $params['ya_money']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Яндекс секретное слово:</label>
                      <div class="col-lg-8">
                        <input type="password" autocomplete="off" name="ya_secret" placeholder="" class="form-control parsley-validated" value="<?php echo $params['ya_secret']; ?>">
                      </div>
                    </div>
                  </div>


<!--Инстаграмм-->
                    <div class="<?=$messages?>" id="messages">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Instagram логин:</label>
                            <div class="col-lg-8">
                                <input type="text" autocomplete="off" name="instagramlogin" placeholder="" class="form-control parsley-validated" value="<?php echo $params['instagram_login']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Instagram пароль:</label>
                            <div class="col-lg-8">
                                <input type="password" autocomplete="off" name="instagrampassword" placeholder="" class="form-control parsley-validated" value="<?php echo $params['instagram_password']; ?>">
                            </div>
                        </div>
                    </div>

<!--SEO продвижение-->
                  <div class="<?=$settings?>" id="settings">
                    <div class="form-group" style="display: none">
                      <label class="col-lg-3 control-label">Лимит дней:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="time_day" placeholder="" class="form-control parsley-validated" value="<?php echo $params['time_day']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Ключевые слова(keywords):</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="keywords" placeholder="" class="form-control parsley-validated" value="<?php echo $params['keywords']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Описание(description):</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="description" placeholder="" class="form-control parsley-validated" value="<?php echo $params['description']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Заголовок страницы(title):</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="title" placeholder="" class="form-control parsley-validated" value="<?php echo $params['title']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Город:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="city" placeholder="" class="form-control parsley-validated" value="<?php echo $params['city']; ?>">
                      </div>
                    </div>
                  </div>


<!--SMS сервер-->
                   <div class="<?=$sms?>" id="sms">
                       
                    <div class="form-group">
                        <center>
                        <b>отправка СМС работает вот на этом <a href="https://smsgateway.me/" target="blank">сервисе:</a><b>
                        </b></b>
                        </center>
                    </div>   

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Логин:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="smslogin" placeholder="" class="form-control parsley-validated" value="<?php echo $params['smslogin']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Пароль:</label>
                      <div class="col-lg-8">
                          <input type="password" autocomplete="off" name="smspassword" placeholder="" class="form-control parsley-validated" value="<?php echo $params['smspassword']; ?>">
                      </div>
                    </div>
                                              
                    <div class="form-group">
                      <label class="col-lg-3 control-label">ID устройства:</label>
                      <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="smsid" placeholder="" class="form-control parsley-validated" value="<?php echo $params['smsid']; ?>">
                      </div>
                    </div>   
                       
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Номер куда прийдут СМС:</label>
                      <div class="col-lg-8">
                        <script src="../js/jquery.js"></script>
                        <script src="../js/mask.js"></script>
                        <script>
                          $("#numbersms").mask("+79999999999", {placeholder: "+7(___) ___ - ____" });
                        </script>
                        <input type="text" autocomplete="off" id="numbersms" name="smsnumber" placeholder="" class="form-control parsley-validated" value="<?php echo $params['smsnumber']; ?>">
                      </div>
                    </div>
                       
                  </div>

<!--Чат и звонки-->
                  <div class="<?=$chats?>" id="chats">
                    <div class="form-group">
                      <label class="col-lg-3 control-label"><a href="https://www.chatbro.com/ru/" target="blank">Chatbro</a> скрипт:</label>
                      <div class="col-lg-8">                      
                        <textarea name="chatbroscript" placeholder="Сюда поместите скрипт из сервиса Chatbro" rows="5" class="form-control parsley-validated" data-trigger="keyup"><?php echo $params['chatbroscript']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label"><a href="https://redconnect.ru/" target="blank">RedConnect</a> скрипт:</label>
                      <div class="col-lg-8">                     
                        <textarea name="redconnectscript" placeholder="Сюда поместите скрипт из сервиса RedConnect" rows="5" class="form-control parsley-validated" data-trigger="keyup"><?php echo $params['redconnectscript']; ?></textarea>
                      </div>
                    </div>
                  </div>

<!--Ссылки на соц. сети-->
                  <div class="<?=$social?>" id="social">
                    <div class="form-group">
                      <label class="col-lg-3 control-label">VK:</label>
                      <div class="col-lg-8">
                        <textarea name="vklink" placeholder="Сюда поместите ссылку на ваш ВК аккаунт формата: http://vk.com/вашаккаунт" rows="5" class="form-control parsley-validated" data-trigger="keyup"><?php echo $params['vklink']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-3 control-label">Facebook:</label>
                      <div class="col-lg-8">
                        <textarea name="facebooklink" placeholder="Сюда поместите ссылку на ваш фэйсбук аккаунт формата: https://www.facebook.com/вашаккаунт" rows="5" class="form-control parsley-validated" data-trigger="keyup"><?php echo $params['facebooklink']; ?></textarea>
                      </div>
                    </div>
                  </div>
                    
<!--кнопки сохранить и отмена-->
                  <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                      <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                      <span class="center"><a href="magazins.php" class="btn btn-default btn-xs">Отмена</a></span>
                    </div>
                  </div>


                </div>
              </div>
            </section>
          </section>
          </form>
        </div>
</div></section></section>
          
        </div>
        
      </div>
      <div class="row">
  <?php include("niz.php"); }?>