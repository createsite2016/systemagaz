
checkCart();

function checkCart() {
    //проверяю наличие корзины в localStorage
    if ( localStorage.getItem('cart') != null ) {
        cart = JSON.parse(localStorage.getItem('cart'));
    } else { cart = []; }
}

function showCart() {
    //показываю содержимое на страницы корзины
    out = '';
    var out = '<tbody><tr><th>Артикул товара</th><th>Название</th><th>Стомость, рублей</th><th>Количество, шт</th><th>Удалить</th></tr>';
    var rexdiv = document.getElementById("rex");
    if ( rexdiv != undefined ) {
        // если есть элемент корзины, тогда прорисовываем ее
        rexdiv.innerHTML = out;
        console.log('===== корзина начало ======== ');
        for (var z in cart) {
            console.log('отправка запроса на сервер с параметрами id:',z,' Количество:',cart[z]);
            $.ajax({
                url: '../ajax_cart.php', // на этот скрипт отправка
                type: 'post', // метод post
                response:'text',
                data: {id: z, kolvo: cart[z]}, // параметры отправки
                success: function (data) { // выполнение отправки
                    console.log('заполенение переменной out для прорисовки',data);
                    out += data;
                    rexdiv.innerHTML = out;
                }
            });
        }
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

function addCheck() {
    // оформеление заказа
    var checkname = document.getElementById("checkname").value;
    var check_phone = document.getElementById("checkphone").value;
    var check_adress = document.getElementById("checkadress").value;
    var check_komment = document.getElementById("checkkomment").value;

    for (var z in cart) {
        $.ajax({
            url: '../ajax_check.php', // на этот скрипт отправка
            type: 'post', // метод post
            response: 'text',
            data: {id: z, kolvo: cart[z], name: checkname, phone: check_phone, adress: check_adress, komment: check_komment}, // параметры отправки
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
    document.getElementById("checkname").value = '';
    document.getElementById("checkphone").value= '';
    document.getElementById("checkadress").value= '';
    document.getElementById("checkkomment").value= '';

}
