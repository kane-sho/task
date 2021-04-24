<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';

/* タスク登録
---------------------------------------------*/
$title = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_input(INPUT_POST, 'title');
    $errors = insertValidate($title);

    if (empty($errors)) {
        insertTask($title);
    }
}

/* タスク照会
---------------------------------------------*/
$notyet_tasks = findTaskByStatus(TASK_STATUS_NOTYET);
$done_tasks = findTaskByStatus(TASK_STATUS_DONE);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <div class="new-task">
            <h1>My Tasks</h1>
            <?php if ($errors) echo (createErrMsg($errors)) ?>
            <form action="" method="post">
                <input type="text" name="title" placeholder="タスクを入力してください">
                <input type="submit" value="登録" class="btn submit-btn">
            </form>
        </div>
        <div class="notyet-task">
            <h2>未完了タスク</h2>
            <ul>
                <?php foreach ($notyet_tasks as $task): ?>
                    <li>
                        <a href="done.php?id=<?= h($task['id']) ?>" class="btn done-btn">完了</a>
                        <a href="edit.php?id=<?= h($task['id']) ?>" class="btn edit-btn">編集</a>
                        <a href="delete.php?id=<?= h($task['id']) ?>" class="btn delete-btn">削除</a>
                        <?= h($task['title']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <hr>
        <div class="done-task">
            <h2>完了タスク</h2>
            <ul>
                <?php foreach ($done_tasks as $task): ?>
                    <li>
                        <?= h($task['title']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>