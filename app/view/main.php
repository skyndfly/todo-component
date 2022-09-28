<?php $this->layout('template', ['title' => 'МоиЗаметки', 'login' => $login]) ?>

<a href="/add" class="new">Добавить</a>
<table>
    <tr class="table__head">
        <td>#</td>
        <td>Название</td>
        <td>Опции</td>
    </tr>

        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?=$post['id']?></td>
                <td><?=$post['title']?></td>
                <td>
                    <a href="/view/<?=$post['id']?>" class="info">Открыть</a>
                    <a href="/edit/<?=$post['id']?>" class="edit">Изменить</a>
                    <a href="/delete/<?=$post['id']?>" class="delete">Удалить</a>
                </td>
            </tr>
        <?php endforeach;?>



</table>
<div class="paginator">
    <ul class="pagination">
        <?php if ($paginator->getPrevUrl()): ?>
            <li><a href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Назад</a></li>
        <?php endif; ?>

        <?php foreach ($paginator->getPages() as $page): ?>
            <?php if ($page['url']): ?>
                <li <?php echo $page['isCurrent'] ? 'class="active"' : ''; ?>>
                    <a href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                </li>
            <?php else: ?>
                <li class="disabled"><span><?php echo $page['num']; ?></span></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($paginator->getNextUrl()): ?>
            <li><a href="<?php echo $paginator->getNextUrl(); ?>">Вперед &raquo;</a></li>
        <?php endif; ?>
    </ul>
</div>

