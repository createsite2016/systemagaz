<?php

/**
 * Выгрузка в Instagram
 * $dest   - Выгрузка картинки
 * $caption  - Выгрузка комментария к ней
 * $username - Логин инстаграмма
 * $password - Пароль инстаграмма
 */

class Instagram
{
    private $username;      // логин
    private $password;      // пароль
    private $caption;       // сообщение к фото
    private $path_in;       // путь к картинке ("../../foto_tovar/" . $_FILES['foto']['name'])
    private $path_out;       // путь к картинке которая будет выгружаться ("../../foto_tovar/instagram.jpg")

    public function send_insta($username,$password,$caption,$path_in,$path_out) {

        // Создание квадрата 90x90
        // dest - результирующее изображение
        // w - ширина изображения
        // ratio - коэффициент пропорциональности

        // квадратная 90x90. Можно поставить и другой размер.

        // создаём исходное изображение на основе
        // исходного файла и определяем его размеры
        $im = imagecreatefromjpeg($path_in); //если оригинал был в формате jpg, то создаем изображение в этом же формате. Необходимо для последующего сжатия
        $w_src = imagesx($im); //вычисляем ширину
        $h_src = imagesy($im); //вычисляем высоту изображения

        // создаём пустую квадратную картинку
        // важно именно truecolor!, иначе будем иметь 8-битный результат
        $dest = imagecreatetruecolor($w, $h);

        // вырезаем квадратную серединку по x, если фото горизонтальное
        if ($w_src > $h_src) {
            $w = 1200;
            $h = 1200;
            $dest = imagecreatetruecolor($w, $h);
            imagecopyresampled($dest, $im, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src)) / 2), 0, $w, $h, min($w_src, $h_src), min($w_src, $h_src));
        }

        // вырезаем квадратную верхушку по y,
        // если фото вертикальное (хотя можно тоже серединку)
        if ($w_src < $h_src) {
            $w = 1200;
            $h = 1200;
            $dest = imagecreatetruecolor($w, $h);
            imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, min($w_src, $h_src), min($w_src, $h_src));
        }

        // квадратная картинка масштабируется без вырезок
        if ($w_src == $h_src) {
            $w = 1200;
            $h = 1200;
            $dest = imagecreatetruecolor($w, $h);
            imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $w_src);
        }
        imagejpeg($dest, $path_out); //сохраняем изображение формата jpg в нужную папку, именем будет текущее время. Сделано, чтобы у аватаров не было одинаковых имен.


        // ОТПРАВКА В ИНСТАГРАММ
        function SendRequest($url, $post, $post_data, $user_agent, $cookies)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://instagram.com/api/v1/' . $url);
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            if ($post) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            }
            if ($cookies) {
                curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
            } else {
                curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
            }
            $response = curl_exec($ch);
            $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return array($http, $response);
        }

        function GenerateGuid()
        {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        }

        function GenerateUserAgent()
        {
            $resolutions = array('720x1280', '320x480', '480x800', '1024x768', '1280x720', '768x1024', '480x320');
            $versions = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');
            $dpis = array('120', '160', '320', '240');
            $ver = $versions[array_rand($versions)];
            $dpi = $dpis[array_rand($dpis)];
            $res = $resolutions[array_rand($resolutions)];
            return 'Instagram 4.' . mt_rand(1, 2) . '.' . mt_rand(0, 2) . ' Android (' . mt_rand(10, 11) . '/' . mt_rand(1, 3) . '.' . mt_rand(3, 5) . '.' . mt_rand(0, 5) . '; ' . $dpi . '; ' . $res . '; samsung; ' . $ver . '; ' . $ver . '; smdkc210; en_US)';
        }

        function GenerateSignature($data)
        {
            return hash_hmac('sha256', $data, 'b4a23f5e39b5929e0666ac5de94c89d1618a2916');
        }

        function GetPostData($filename)
        {
            if (!$filename) {
                echo "The image doesn't exist " . $filename;
            } else {
                $cfile = curl_file_create($filename);
                $post_data = array('device_timestamp' => time(), 'photo' => $cfile);
                return $post_data;
            }
        }

        // Set the caption for the photo
        //$caption = $name.' цена: '.$chena_output.'руб. '.$komment.' Артикул: '.$article;
        // Set the path to the file that you wish to post.
        // This must be jpeg format and it must be a perfect square
        $filename = $path_out;
        // Define the user agent
        $agent = GenerateUserAgent();
        // Define the GuID
        $guid = GenerateGuid();
        // Set the devide ID
        $device_id = "android-" . $guid;
        /* LOG IN */
        // You must be logged in to the account that you wish to post a photo too
        // Set all of the parameters in the string, and then sign it with their API key using SHA-256
        $data = '{"device_id":"' . $device_id . '","guid":"' . $guid . '","username":"' . $username . '","password":"' . $password . '","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
        $sig = GenerateSignature($data);
        $data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';
        $login = SendRequest('accounts/login/', true, $data, $agent, false);
        if (strpos($login[1], "Sorry, an error occurred while processing this request.")) {
            echo "Request failed, there's a chance that this proxy/ip is blocked";
        } else {
            if (empty($login[1])) {
                echo "Empty response received from the server while trying to login";
            } else {
                // Decode the array that is returned
                $obj = @json_decode($login[1], true);
                if (empty($obj)) {
                    // echo "Could not decode the response: " . $body;
                } else {
                    // Post the picture
                    $data = GetPostData($filename);
                    $post = SendRequest('media/upload/', true, $data, $agent, true);
                    if (empty($post[1])) {
                        echo "Empty response received from the server while trying to post the image";
                    } else {
                        // Decode the response
                        $obj = @json_decode($post[1], true);
                        //var_dump($obj);
                        if (empty($obj)) {
                            echo "Could not decode the response";
                        } else {
                            $status = $obj['status'];
                            if ($status == 'ok') {
                                // Remove and line breaks from the caption
                                $caption = preg_replace("/\r|\n/", "", $caption);
                                $media_id = $obj['media_id'];
                                $device_id = "android-" . $guid;
                                $data = '{"device_id":"' . $device_id . '","guid":"' . $guid . '","media_id":"' . $media_id . '","caption":"' . trim($caption) . '","device_timestamp":"' . time() . '","source_type":"5","filter_type":"0","extra":"{}","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
                                $sig = GenerateSignature($data);
                                $new_data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';
                                // Now, configure the photo
                                $conf = SendRequest('media/configure/', true, $new_data, $agent, true);
                                if (empty($conf[1])) {
                                    echo "Empty response received from the server while trying to configure the image";
                                } else {
                                    if (strpos($conf[1], "login_required")) {
                                        echo "You are not logged in. There's a chance that the account is banned";
                                    } else {
                                        $obj = @json_decode($conf[1], true);
                                        $status = $obj['status'];
                                        if ($status != 'fail') {
                                            echo "Success";
                                        } else {
                                            echo 'Fail';
                                        }
                                    }
                                }
                            } else {
                                echo "Не удалось выполнить загрузку в Instagram";
                                exit();
                            }
                        }
                    }
                }
            }
        }
        unlink($path_out);
    }
    }


