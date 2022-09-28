<?php $this->layout('auth-register', ['title' => 'Авторизация — МоиЗаметки']) ?>

<section>


    <h1 style="margin-top: 20px;">Авторизация</h1>
    <form class="create" action="/log-in" method="post">

        <label for="">Email:</label>
        <input name="email" type="email" >
        <label for="">Пароль:</label>
        <input name="password" type="password" >

        <button class="new" name="send" type="submit">Войти</button>
        <h2>
            Нет страницы?
            <a href="/register">Создать</a>
        </h2>
    </form>

    </div>
</section>
