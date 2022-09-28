<?php $this->layout('template', ['title' => 'Создать — МоиЗаметки', 'login' => $login]) ?>

<section>

    <div class="section__content">
        <a href="/" class="info"> &#8592; Назад</a>
        <h1 style="margin-top: 20px;">Добавить заметку</h1>
        <form class="create" action="/store" method="post">
            <label for="">Название:</label>
            <input name="title" type="text" >
            <label for="">Описание:</label>
            <textarea name="text" ></textarea>
            <button class="new" name="send" type="submit">Добавить</button>
        </form>
    </div>
</section>
