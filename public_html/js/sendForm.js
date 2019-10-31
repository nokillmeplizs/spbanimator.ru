(function () {
    'use strict';

    function sendForm(event) {
        event.preventDefault();
        console.log(1);

        let form_data = new FormData(this);
        console.log(form_data);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", this.action, true);
        xhr.send(form_data);

        xhr.onload = function (oEvent) {
            if (xhr.status == 200) {
                console.log("xhr response", xhr.responseText);
                responseHandler(xhr.responseText);
            }
        };
    }
    function wait() {
        window.location.href = "/";
    }
    function responseHandler(response) {
        if (response === "VIDEO_DELETE") {
            window.location.href = "/video";
        }
        if (response === "ABOUT_UPDATE") {
            document.getElementById('response2').style.color = "green";
            document.getElementById('response2').innerHTML='Информация обнавлена';
            setTimeout(function () {
                window.location.href ='/';
            }, 2000);
        }
        if (response === "VIDEO_ADDED"){
            document.getElementById('response2').style.color = "green";
            document.getElementById('response2').innerHTML='видео добавлено';
            let url = document.location.href;
            setTimeout(function () {
                window.location.href = url;
            }, 2000);
        }
        if (response === "PHOTO_SHOW_DELETE"){
            document.getElementById('response2').style.color = "red";
            document.getElementById('response2').innerHTML='фото удалено';
            let url = document.location.href;
            setTimeout(function () {
                window.location.href = url;
            }, 2000);
        }
        if (response === "PHOTO_DELETE"){
            document.getElementById('response2').style.color = "red";
            document.getElementById('response2').innerHTML='фото удалено';
            let url = document.location.href;
            setTimeout(function () {
                window.location.href = url;
            }, 2000);
        }
        if (response === "CHAR_UPDATE"){
            document.getElementById('response2').style.color = "green";
            document.getElementById('response2').innerHTML='Информация о персонаже обновлена';
            setTimeout(function () {
                window.location.href = "/characters";
            }, 3000);
        }
        if (response === "toobig"){
            document.getElementById('response2').style.color = "red";
            document.getElementById('response2').innerHTML='файл слишком большой и не будет загружен';
        }
        if (response === "SHOW_UPDATE"){
            window.location.href = "/show";
        }
        else if (response === "COMMENT_ADD") {
            document.getElementById('response3').style.color = "green";
            document.getElementById('response3').innerHTML='Отзыв отправлен на модерацию';
            document.getElementById('sendComment').style.display = "none";
            setTimeout(wait, 3000);

        }
        else if (response === "USER_ADDED") {
            window.location.href = "/";
        }else if (response === "CHAR_DELETE") {
                window.location.href = "/characters";
        }
        else if (response === "SHOW_DELETE") {
            window.location.href = "/show";
        }
        else if (response === "USER_AUTH"){
            window.location.href = "/";
        } else if (response === "LOGIN_ERROR"){
            document.getElementById('response').style.color = "red";
            document.getElementById('response').innerHTML='Пользователь с таким логином не зарегистрирован!';
        } else if (response === "PWD_ERROR"){
            document.getElementById('response').style.color = "red";
            document.getElementById('response').innerHTML='Вы ввели не верный пароль';
        }
        else if (response === "CHAR_ADDED"){
            document.getElementById('response2').style.color = "green";
            document.getElementById('response2').innerHTML='Персонаж добавлен';
            document.getElementById("characterAddForm").reset();
        }
        else if (response === "SHOW_ADDED"){
            document.getElementById('response3').style.color = "green";
            document.getElementById('response3').innerHTML='шоу добавлено';
            document.getElementById("addShowForm").reset();
        }
        else {
            console.log("вывод ошибки данных");
        }
    }

    function addFormListener() {
        for (let i = 0; i < document.forms.length; i++) {
            document.forms[i].addEventListener('submit', sendForm);
        }
    }

    addFormListener();

}());