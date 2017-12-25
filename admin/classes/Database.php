<?php

class Database{
    public $isConn;
    protected $datab;
    static $username, $password, $host, $dbname;



    // Соединение с БД
        public function __construct($username="root", $password="root", $host="localhost", $dbname="torpix", $options = []){
        //public function __construct($username="ce72683_magaz", $password="UC7dQbZC", $host="localhost", $dbname="ce72683_magaz", $options = []){
            $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            ?>
            <!DOCTYPE html>
            <html lang="ru">
            <head>
                <meta charset="utf-8">
                <title>Система управления интернет торговлей</title>
                <meta name="" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link rel="shortcut icon" href="/../../icon.ico" type="image/x-icon">
                <link rel="stylesheet" href="/../admin/css/bootstrap.css">
                <link rel="stylesheet" href="/../admin/css/font-awesome.min.css">
                <link rel="stylesheet" href="/../admin/css/font.css">
                <link rel="stylesheet" href="/../admin/js/select2/select2.css">
                <link rel="stylesheet" href="/../admin/css/style.css">
                <link rel="stylesheet" href="/../admin/css/plugin.css">
                <link rel="stylesheet" href="/../admin/css/landing.css">
<br><br><br><br><center><strong>Не удалось подключиться к БД, проверьте параметры соединения</strong></center>
            <br>
            <br>
            <br>
            <br>



            <section class="panel">
                <header class="panel-heading text-center">
                    Подключение
                </header>
                <form action="/admin/install_db.php" class="panel-body" method="POST">

                    <div class="block">
                        <label class="control-label">}{ост</label>
                        <input type="text" placeholder="ваш логин" name="localhost" value="localhost" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">БД</label>
                        <input type="text" placeholder="ваш логин" name="db" value="" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">Логин</label>
                        <input type="text" placeholder="ваш логин" name="login" value="" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">Пароль</label>
                        <input type="password" id="inputPassword" placeholder="ваш пароль" value="" autocomplete="on" name="password" class="form-control">
                    </div>


                    </div>
                    <center>
                        <button type="submit" class="btn btn-info"><i class="icon-signin"></i> Подключить</button>
                    </center>
                </form>
            </section>
            <?
            exit;
        }

    }


    // отключение от бд
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }
    // получить данные
    public function getRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // получить массив данных
    public function getRows($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // вставить данные
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // обновить данные
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // удалить данные
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // получить последний добавленный ID
    public function lastInsertId($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            $stmt = $this->datab->lastInsertId($query);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }



}

?>