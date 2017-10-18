
checkCart();

function checkCart() {
    //проверяю наличие корзины в localStorage
    if ( localStorage.getItem('cart') != null ) {
        cart = JSON.parse(localStorage.getItem('cart'));
    } else {
        cart = [];
        document.getElementById('ndsfnsdfjsklf').style.display = 'none';
    }
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
            }
        });
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
        document.getElementById('ndsfnsdfjsklf').style.display = 'none';
    }
    cartdiv.innerHTML = 'Корзина: ('+all+')';
}

function addCheck() {
    // оформеление заказа
    var checkname = document.getElementById('checkname').value;
    var checkphone = document.getElementById('checkphone').value;
    var checkadress = document.getElementById('checkadress').value;
    var checkkomment = document.getElementById('checkkomment').value;
    var error = 0;

     if (checkname.length < 3) {
         error = 1;
         document.getElementById('labelname').innerHTML = "<font color='red'>Имя слишком короткое</font>";
     } else {
         document.getElementById('labelname').innerHTML = "<font color='green'>Имя полученно</font>";
     }
     if (checkphone.length !== 16) {
         error = 1;
         document.getElementById('labelphone').innerHTML = "<font color='red'>Номер не полный</font>";
     } else {
         document.getElementById('labelphone').innerHTML = "<font color='green'>Телефон получен</font>";
     }
     if ( checkadress < 3 ) {
         error = 1;
         document.getElementById('labeladress').innerHTML = "<font color='red'>Адрес слишком короткий</font>";
     } else {
         document.getElementById('labeladress').innerHTML = "<font color='green'>Адресс получен</font>";
     }
     if (error == 0) {
         for (var z in cart) {
             $.ajax({
                 url: '../ajax_check.php', // на этот скрипт отправка
                 type: 'post', // метод post
                 response: 'text',
                 data: {id: z, kolvo: cart[z], name: checkname, phone: checkphone, adress: checkadress, komment: checkkomment}, // параметры отправки
                 success: function (data) { // выполнение отправки
                     console.log('Ответ от сервера', data);
                 }
             });
         }
         localStorage.clear();
         checkCart();
         showCart();
         showMiniCart();
         alert('Спасибо Вам ' + checkname + ', Ваш заказ принят, ожидайте звонка нашего менеджера и смс на Ваш телефон.');
         //alert(data);
         document.getElementById('checkname').value = '';
         document.getElementById('checkphone').value= '';
         document.getElementById('checkadress').value= '';
         document.getElementById('checkkomment').value= '';
     }

}
