

//------------------
// КОРЗИНА ТОВАРОВ
//------------------

// Клик по кнопке добавить товар в корзину
function add_cart(id,chena,path) {
    // Клик по кнопке добавить
    document.getElementById('black_block').style.display = 'block';
    document.getElementById('finish_window').style.display = 'block';
    $.ajax({
        type: "POST",
        data: "id=" + id + "&chena=" + chena + "&action=" + 'add',
        url: path+"ajax/cart.php",
        dataType: "text",
        success: function (data) {
            document.getElementById('cart').innerHTML = data;
            $.ajax({
                type: "POST",
                data: "id=" + id + "&chena=" + chena + "&action=" + 'only',
                url: path+"ajax/cart.php",
                dataType: "text",
                success: function (data) {
                    document.getElementById('finish_window_text').innerHTML = data;
                }
            });
        }
    });
}

// клик по кнопке " + " в корзине товаров
function plus(id,path) {

    document.getElementById('finish_price_hide').innerText = +document.getElementById('finish_price_hide').innerText + +document.getElementById('hide_price_'+id).innerText;
    document.getElementById('finish_price_show').innerText = document.getElementById('finish_price_hide').innerText + ' руб.';

    $.ajax({
        type: "POST",
        data: "id=" + id + "&action=" + 'plus',
        url: path+"ajax/cart.php",
        dataType: "text",
        success: function (data) {
            document.getElementById('cart').innerHTML = data;
        }
    });


    // увеличиваю на 1-цу количество выбранного товара в корзине
    document.getElementById('count_'+id).value = +document.getElementById('count_'+id).value + 1;
    // увеличиваю стоимость позиции товара(без скидки), умножая на количество позиции товара
    document.getElementById('show_price_'+id).innerText = +(document.getElementById('hide_price_'+id).innerText * +document.getElementById('count_'+id).value) + ' р.';
    // увеличиваю стоимость позиции товара(cо скидкой), умножая на количество позиции товара
    document.getElementById('show_price_del_'+id).innerText = +(document.getElementById('hide_price_del_'+id).innerText * +document.getElementById('count_'+id).value) + ' р.';




}

// клик по кнопке " - " в корзине товаров
function minus(id,path) {
    if (+document.getElementById('count_'+id).value > 1) {
        document.getElementById('finish_price_hide').innerText = +document.getElementById('finish_price_hide').innerText - +document.getElementById('hide_price_'+id).innerText;
        document.getElementById('finish_price_show').innerText = document.getElementById('finish_price_hide').innerText + ' руб.';

        $.ajax({
            type: "POST",
            data: "id=" + id + "&action=" + 'minus',
            url: path+"ajax/cart.php",
            dataType: "text",
            success: function (data) {
                document.getElementById('cart').innerHTML = data;
            }
        });

        // уменьшаю на 1-цу количество выбранного товара в корзине
        document.getElementById('count_'+id).value = +document.getElementById('count_'+id).value - 1;
        // уменьшаю стоимость позиции товара(без скидки), умножая на количество позиции товара
        document.getElementById('show_price_'+id).innerText = +(document.getElementById('hide_price_'+id).innerText * +document.getElementById('count_'+id).value) + ' р.';
        // уменьшаю стоимость позиции товара(со скидкой), умножая на количество позиции товара
        document.getElementById('show_price_del_'+id).value = +(document.getElementById('hide_price_del_'+id).innerText * +document.getElementById('count_'+id).value) + ' р.';
    }
}

// клик по кнопке " X " в корзине товаров
function del(id,path){
    $.ajax({
        type: "POST",
        data: "id=" + id + "&action=" + 'del',
        url: path+"ajax/cart.php",
        dataType: "text",
        success: function (data) {
            if (data == 1) {
                location.reload();
            };
        }
    });
}

// клик по кнопке оформить заказ в корзине товаров
function order(path) {

    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var adress = document.getElementById('adress').value;
    var komment = document.getElementById('komment').value;

    if (name !== '' & adress !== '' & phone.length == 15) {
        error = 0;
    } else {
        error = 1;
    }

    if ( error == 0 ) {
        $.ajax({
            type: "POST",
            data: "name=" + name + "&action=" + 'order' + "&phone=" + phone + "&adress=" + adress + "&komment=" + komment,
            url: path+"ajax/cart.php",
            dataType: "text",
            success: function (data) {
                if (data == 1) {
                    document.getElementById('black_block').style.display = 'block';
                    document.getElementById('order_ok').style.display = 'block';
                    document.getElementById('bodycarthtml').innerHTML = '<h1>Корзина</h1>Ваша корзина пуста <a href="index.php">перейти к покупкам</a>';
                    document.getElementById('cart').innerHTML = '0 <span class="top_cart_curr"> руб.</span><span class="top_cart_num" id="cart">0</span>';
                };
            }
        });
    }

    if ( error == 1 ) {
        alert('Не все данные указанны для заказа товара');
    }

}



//------------------
// ЛИЧНЫЙ КАБИНЕТ
//------------------

// Показать окно авторизации для личного кабинета(в хедере личный кабинет)
function lc() {
    document.getElementById('black_block').style.display = 'block';
    document.getElementById('auth').style.display = 'block';
}

// Показать окно авторизации для личного кабинета(в хедере личный кабинет)
function show_reset_password() {
    document.getElementById('black_block').style.display = 'block';
    document.getElementById('auth').style.display = 'none';
    document.getElementById('password_reset').style.display = 'block';
}

// Нажатие на кнопку востановить, в форме "забыли пароль"
function reset_password() {

    var phone = document.getElementById('resetphone').value;

    if ( phone.length == 15 ) {
        $.ajax({
            type: "POST",
            data: "phone=" + phone + "&action=" + 'resetpassword',
            url: "lc.php",
            dataType: "text",
            success: function (data) {
                if (data.charAt(0) == 'y') {
                    alert('Пароль направлен к Вам в смс');
                    document.getElementById('password_reset').style.display = 'none';
                    document.getElementById('black_block').style.display = 'none';
                } else {
                    alert('Нет такого пользователя, с указанным номером');
                }
            }
        });
    } else {
        alert('Номер телефона не корректен');
    }

}

// авторизация клиента на сайте, для доступа к личному кабинету (в хедере кнопка личный кабинет)
function login_klient() {

    var phone = document.getElementById('lcphone').value;
    var password = document.getElementById('password').value;

    if ( phone !== '' & password !== '' ) {
        $.ajax({
            type: "POST",
            data: "phone=" + phone + "&password=" + password,
            url: "lc.php",
            dataType: "text",
            success: function (data) {

                if ( data.charAt(0) == 'y') {
                    window.location.replace('lc.php');
                } else {
                   alert('Логин или пароль не верный');
                }
            }
        });
    } else {
        alert('Не введен логин или пароль');
    }
}

// сохранение личной информации клиента в личном кабинете
function lc_save_newdata_klient() {
    var name = document.getElementById('myname').value;
    var adress = document.getElementById('myadress').value;
    var password = document.getElementById('mypassword').value;

    if ( password.length > 5 ) {
        $.ajax({
            type: "POST",
            data: "name=" + name + "&adress=" + adress + "&password=" + password + "&action=" + 'saveuserdata',
            url: "lc.php",
            dataType: "text",
            success: function (data) {
                if (data.charAt(0) == 'y') {
                    alert('Личные данные обновленны');
                    //window.location.replace('lc.php');
                } else {
                    alert('Личные данные не обновленны');
                }
            }
        });
    } else {
        alert('Пароль должен быть 6 или более символов');
    }
}

// удаление заказа из личного кабинета клиента со статусом новый заказ
function lc_delete_order(id) {
    $.ajax({
        type: "POST",
        data: "id=" + id + "&action=" + 'deluserorder',
        url: "lc.php",
        dataType: "text",
        success: function (data) {
            if (data.charAt(0) == 'y') {
                window.location.replace('lc.php');
            } else {
                alert('Заказ не удален');
            }
        }
    });
}

// показать / скрыть пароль в личном кабинете клиента
function check() {
    var myCheckBox = document.getElementById('myCheckBox');
    if (myCheckBox.checked)
    {document.getElementById('mypassword').setAttribute('type', 'text');}
    else
    {document.getElementById('mypassword').setAttribute('type', 'password');}
}

// галочка на согласие обработки персональных данных
function acsept() {

    var acseptCheckBox = document.getElementById('acseptCheckBox');

    if (acseptCheckBox.checked)
    {document.getElementById('btn_order').disabled = false;}
    else
    {document.getElementById('btn_order').disabled = true;}

}



//------------------
// ФОРМА ОБРАТНОЙ СВЯЗИ
//------------------

// Показать форму обратной связи (в хедере)
function show_callback_form() {
    document.getElementById('black_block').style.display = 'block';
    document.getElementById('auth').style.display = 'none';
    document.getElementById('callback_form').style.display = 'block';
}

function send_callback(path) {

    var callback_name = document.getElementById('callback_name').value;
    var callback_phone = document.getElementById('callback_phone').value;
    var callback_tema_title = document.getElementById('callback_tema_title').value;
    var callback_tema_text = document.getElementById('callback_tema_text').value;

    if (callback_name !== '' & callback_phone !== '' & callback_tema_title !== '' & callback_tema_text  !== '') {
        $.ajax({
            type: "POST",
            data: "callback_name=" + callback_name + "&callback_phone=" + callback_phone + "&callback_tema_title=" + callback_tema_title + "&callback_tema_text=" + callback_tema_text,
            url: path+"ajax/callback.php",
            dataType: "text",
            success: function (data) {
                close_win();
                document.getElementById('callback_ok').style.display = '';
                document.getElementById('black_block').style.display = '';
                document.getElementById('callback_name').value = '';
                document.getElementById('callback_phone').value = '';
                document.getElementById('callback_tema_title').value = '';
                document.getElementById('callback_tema_text').value = '';
            }
        });
    } else {
        alert('Не все поля заполнены');
    }


}



// Закрытие всплывающего окна при добавлении товара в корзину
function close_win() {
    // Закрытие всплывающего окна при добавлении товара в корзину
    document.getElementById('black_block').style.display = 'none';
    document.getElementById('finish_window').style.display = 'none';
    document.getElementById('finish_window_text').innerHTML = '';
    document.getElementById('order_ok').style.display = 'none';
    document.getElementById('auth').style.display = 'none';
    document.getElementById('password_reset').style.display = 'none';
    document.getElementById('callback_form').style.display = 'none';
    document.getElementById('callback_ok').style.display = 'none';

}

