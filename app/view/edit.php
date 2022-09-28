
<?php $this->layout('template', ['title' => "Редактировать — {$post['title']} — МоиЗаметки", 'login' => $login]) ?>

<section>

    <div class="section__content">
        <div class="top">
            <a href="/" class="info"> &#8592; Назад</a>
            <div class="functions">

                <a href="/delete/<?=$post['id']?>" class="delete-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg>
                </a>
            </div>
        </div>
        <h1 style="margin-top: 20px;">Редактировать заметку</h1>
        <form class="create" action="/update" method="post">
            <input type="hidden" name="id" value="<?=$post['id'];?>">
            <label for="">Название:</label>
            <input name="title" type="text" value="<?=$post['title'];?>">

            <label for="">Описание:</label>
            <textarea name="text" ><?=$post['text'];?></textarea>

            <button class="new" name="send" type="submit">Редактировать</button>
        </form>
    </div>
</section>
