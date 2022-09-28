<?php $this->layout('auth-register', ['title' => 'Регистрация — МоиЗаметки']) ?>

<section>


        <h1 style="margin-top: 20px;">Регистрация</h1>
        <form class="create" action="/create-user" method="post">

            <label for="">Email:</label>
            <input name="email" type="email" >

            <label for="">Имя пользователя:</label>
            <input name="username" type="text" >

            <label for="">Пароль:</label>
            <input name="password" type="password" >

            <button class="new" name="send" type="submit">Регистрация</button>
            <h2>
                Зарегистророваны?
                <a href="/auth">Войти</a>
            </h2>
        </form>
    </div>
</section>
