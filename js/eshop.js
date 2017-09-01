
checkCart();
showMiniCart();
showCart();



var cart = {}; // моя корзина

function minusCart(id) {
    checkCart();
    // Уменьшаю количество товара в карзине
    if (cart[id]!=undefined) {
        // Увеличиваю количество, если товар есть
        cart[id]--;
    } else {
        // Иначе создаю новый параметр массива
        cart[id] = 1;
    }

    localStorage.setItem('cart',JSON.stringify(cart));
    showMiniCart();
    showCart();
}

function removeCart(id,kolvo) {
        checkCart();
            // Уменьшаем количество, если товар есть
    var count = 0;
    while (count < kolvo) {
        cart[id]--;
        count++;
        console.log(count);
    }
        localStorage.setItem('cart',JSON.stringify(cart));
        showMiniCart();
        showCart();
}

function plusCart_mini(id) {
    checkCart();
    // Прибовляю количество товара в карзине
    if (cart[id]!=undefined) {
        // Увеличиваю количество, если товар есть
        cart[id]++;
    } else {
        // Иначе создаю новый параметр массива
        cart[id] = 1;
    }

    localStorage.setItem('cart',JSON.stringify(cart));
    //showMiniCart();
    //showCart();
}

function plusCart(id) {
    checkCart();
    // Прибовляю количество товара в карзине
    if (cart[id]!=undefined) {
        // Увеличиваю количество, если товар есть
        cart[id]++;
    } else {
        // Иначе создаю новый параметр массива
        cart[id] = 1;
    }

    localStorage.setItem('cart',JSON.stringify(cart));
    showMiniCart();
    showCart();
}

function test(id) {
    console.log('====== начало ========= ');
    console.log('1 выбран айди: ',id);
    if ( localStorage.getItem('cart') != null ) {
        cart = JSON.parse(localStorage.getItem('cart'));
        console.log('2 Объект cart загружен ');
    }
    if ( cart[id] != undefined ) { // Если есть ключ id в LS то продолжаем
        console.log('3 есть ключ id в LS',id);

// перед тем как увеличить на единицу проверяем остатки
        for ( var arr_id in cart ) { // делаю перебор объекта корзины в массив
            console.log('4 Цикл for перебирает cart, arr_id = ',arr_id);
            if ( arr_id == id ) { // если попался айдишник
                console.log('5 Найден в цикле arr_id:',arr_id, 'равный начальному id',id);
                $.ajax({
                    url: '../ajax_cart.php',
                    type: 'post',
                    response:'text',
                    data: {id_: arr_id, kolvo_: cart[arr_id]}, // отправляю номер товара и его количество
                    success: function (data) { // выполнение отправки
                        console.log('6 Ушел запрос на сервер с параметрами id:',arr_id, 'количество',cart[arr_id]);
                        console.log('7 Получен ответ от сервера:',data);

                        if ( cart[arr_id] <  +data) {
                            checkCart();
                            plusCart_mini(id);
                        }

                         if ( cart[arr_id] >= +data ) { // Если на складе и в корзине поровну
                             checkCart();
                             stop();
                             }
                        cart[arr_id] = null;
                        console.log('====== конец ========= ');
                    }
                });
                break;
            }

        }


    } else {
        // Иначе, если нет айдишника в LS создаю новый
        console.log('1.1 Создан новый параметр в cart с ключем: ',id);
        cart[id] = 1;

    }

    localStorage.setItem('cart',JSON.stringify(cart));
    showMiniCart(); // прорисовка мини корзины
}

function addToCart(id) {
    checkCart();
    // Делаю проверку на наличие товара в карзине
    if (cart[id]!=undefined) {
        // Увеличиваю количество, если товар есть
        cart[id]++;
    } else {
        // Иначе создаю новый параметр массива
        cart[id] = 1;
    }

    localStorage.setItem('cart',JSON.stringify(cart));
    showMiniCart(); // прорисовка мини корзины
    showCart(); // прорисовка открытой корзины
}

function checkCart() {
    //проверяю наличие корзины в localStorage
    if ( localStorage.getItem('cart') != null ) {
       cart = JSON.parse(localStorage.getItem('cart'));
    }
}

function showMiniCart() {
    //показываю содержимое корзины
    //var out = '';
    var all = 0;
    var cartdiv = document.getElementById("cart");
    for (var w in cart) {
        all += +cart[w];

    }
    if (all == 0) {
        localStorage.removeItem('cart');
    }
    cartdiv.innerHTML = 'Корзина: ('+all+')';
}

function showCart() {
    //показываю содержимое на страницы корзины
    out = '';
    var out = '<tbody><tr><th>Артикул товара</th><th>Название</th><th>Стомость, рублей</th><th>Количество, шт</th><th>Удалить</th></tr>';
    var rexdiv = document.getElementById("rex");
    if ( rexdiv != undefined ) {
        // если есть элемент корзины, тогда прорисовываем ее
        rexdiv.innerHTML = out;
        var ids = [];
        var count = [];
        var i = 0;
        console.log('===== корзина начало ======== ');
        for (var z in cart) {
            if (cart[z] > 0 ) {
                ids.push(z);
                count.push(cart[z]);
                console.log('отправка запроса на сервер с параметрами id:',z,' Количество:',cart[z]);
                i++;

            }
        }
        //console.log('Ключи :',ids);
        //console.log('Количество :',count);
        $.ajax({
            url: '../ajax_cart.php', // на этот скрипт отправка
            type: 'post', // метод post
            response:'text',
            data: {id: ids, kolvo: count}, // параметры отправки
            success: function (data) { // выполнение отправки
                console.log('заполенение переменной out для прорисовки',data);
                out += data;
                rexdiv.innerHTML = out;
                if (data == 'Нет ниодного товара в корзине') {
                    document.getElementById('ndsfnsdfjsklf').style.display = 'none';
                }
            }
        });
    }
}
