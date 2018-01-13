<?php

/**
 * Выгрузка в группу одноклассников
 * $params   - Выгрузка картинки
 * $message  - Выгрузка комментария к ней
 */

class Ok
{
    private $ok_access_token;    // Наш вечный токен
    private $ok_private_key;     // Секретный ключ приложения
    private $ok_public_key;      // Публичный ключ приложения
    private $ok_group_id;        // ID группы
    private $message;            // Текст для выгрузки
    private $path;               // Путь до картинки      "../../foto_tovar/" . $_FILES['foto']['name']

    public function send_ok($ok_access_token,$ok_private_key,$ok_public_key,$ok_group_id,$message,$path) {

        // Запрос
        function getUrl($url, $type = "GET", $params = array(), $timeout = 30, $image = false, $decode = true)
        {
            if ($ch = curl_init())
            {
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, false);

                if ($type == "POST")
                {
                    curl_setopt($ch, CURLOPT_POST, true);

                    // Картинка
                    if ($image) {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    }
                    // Обычный запрос
                    elseif($decode) {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
                    }
                    // Текст
                    else {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                    }
                }

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot');
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $data = curl_exec($ch);

                curl_close($ch);

                // Еще разок, если API завис
                if (isset($data['error_code']) && $data['error_code'] == 5000) {
                    $data = getUrl($url, $type, $params, $timeout, $image, $decode);
                }

                return $data;

            }
            else {
                return "{}";
            }
        }

        // Массив аргументов в строку
        function arInStr($array)
        {
            ksort($array);

            $string = "";

            foreach($array as $key => $val) {
                if (is_array($val)) {
                    $string .= $key."=".arInStr($val);
                } else {
                    $string .= $key."=".$val;
                }
            }

            return $string;
        }

        // 1. Получим адрес для загрузки 1 фото
        $params = array(
            "application_key"   =>  $ok_public_key,
            "method"            => "photosV2.getUploadUrl",
            "count"             => 1,  // количество фото для загрузки
            "gid"               => $ok_group_id,
            "format"            =>  "json"
        );

        // Подпишем запрос
        $sig = md5( arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

        $params['access_token'] = $ok_access_token;
        $params['sig']          = $sig;

        // Выполним
        $step1 = json_decode(getUrl("https://api.ok.ru/fb.do", "POST", $params), true);

        // Если ошибка
        if (isset($step1['error_code'])) {
            echo "Ошибка подписания параметров запроса на сервер Одноклассников";
            echo "<br>Проверьте актуальность токена и ключей в настройках профиля";
            //var_dump($step1);
            exit();
        }

        // Идентификатор для загрузки фото
        $photo_id = $step1['photo_ids'][0];

        // 2. Закачаем фотку

        // Предполагается, что картинка располагается в каталоге со скриптом
        $params = array(
            "pic1" => new \CURLFile($path),
        );

        // Отправляем картинку на сервер, подписывать не нужно
        $step2 = json_decode( getUrl( $step1['upload_url'], "POST", $params, 30, true), true);

        // Если ошибка
        if (isset($step2['error_code'])) {
            // Обработка ошибки
            //echo 'Ошибка добавления фото и комментария в группу одноклассников';
            echo 'ошибка на шаге: 2';
            exit();
        }

        // Токен загруженной фотки
        $token = $step2['photos'][$photo_id]['token'];

        // Заменим переносы строк, чтоб не вываливалась ошибка аттача
        $message_json = str_replace("\n", "\\n", $message);

        // 3. Запостим в группу
        $attachment = '{
                    "media": [
                        {
                            "type": "text",
                            "text": "'.$message_json.'"
                        },
                        {
                            "type": "photo",
                            "list": [
                                {
                                    "id": "'.$token.'"
                                }
                            ]
                        }
                    ]
                }';

        $params = array(
            "application_key"   =>  $ok_public_key,
            "method"            =>  "mediatopic.post",
            "gid"               =>  $ok_group_id,
            "type"              =>  "GROUP_THEME",
            "attachment"        =>  $attachment,
            "format"            =>  "json",
        );

        // Подпишем
        $sig = md5( arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

        $params['access_token'] = $ok_access_token;
        $params['sig']          = $sig;

        $step3 = json_decode( getUrl("https://api.ok.ru/fb.do", "POST", $params, 30, false, false ), true);

        // Если ошибка
        if (isset($step3['error_code'])) {
            // Обработка ошибки
            echo 'ошибка на шаге: 3';
            exit();
        }

        // Успешно
        echo '1';

    }

}