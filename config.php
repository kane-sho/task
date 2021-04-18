<?php

define('DSN', 'mysql:host=db;dbname=task_app;cahrset=utf8');
define('USER', 'testuser');
define('PASSWORD', '9999');

// エラーメッセージを定数として定義
define('MSG_TITLE_REQUIRED', 'タスク名を入力して下さい');

// ステータスを定数として定義
define('TASK_STATUS_NOTYET', 'notyet');
define('TASK_STATUS_DONE', 'done');