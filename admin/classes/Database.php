<?php

class Database{
    public $isConn;
    protected $datab;

    // Соединение с БД
        //public function __construct($username = "root", $password = "root", $host = "localhost", $dbname = "systemagaz", $options = []){
        public function __construct($username = "cv93805_systemag", $password = "ZwNrkrt9", $host = "localhost", $dbname = "cv93805_systemag", $options = []){
            $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //Обработка ошибки
            echo '<br><br><br><br><center><strong>Не удалось подключиться к БД, проверьте параметры соединения</strong></center>';
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