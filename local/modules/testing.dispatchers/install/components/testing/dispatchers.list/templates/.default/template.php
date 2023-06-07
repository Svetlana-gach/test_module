<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<h1><?=$arResult['TITLE']?></h1>
<table class="table">
    <thead>
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Уровень Доступа</th>
        <th>Дата и время последнего входа в систему</th>
        <th>Комментарий</th>
        <th>Объект</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($arResult['TABLE'] as $dispatcher): ?>
        <? if (!empty($dispatcher['DISPATCHER_ID'])): ?>
            <tr>
                <td><?= $dispatcher['DISPATCHER_LAST_NAME'] ?></td>
                <td><?= $dispatcher['DISPATCHER_NAME'] ?></td>
                <td><?= $dispatcher['ACCESS_LEVEL'] ?></td>
                <td><? if (!empty($dispatcher['LAST_ACTIVITY_DATE']))echo $dispatcher['LAST_ACTIVITY_DATE']->toString(); ?></td>
                <td><?= $dispatcher['COMMENT'] ?></td>
                <td><?= $dispatcher['NAME'] ?></td>
            </tr>
        <? endif; ?>
    <? endforeach; ?>

    </tbody>
</table>
