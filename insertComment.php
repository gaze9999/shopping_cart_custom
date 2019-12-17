<?php
session_start();
require_once('./checkSession.php');
require_once('./db.inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

$sqlComment = "INSERT INTO `comments` (`author`, `contents`, `rating`, `item_id`)";
$sqlComment.= "VALUES (?, ?, ?, ?)";

$commentParam = [
    $_POST['name'],
    $_POST['content'],
    $_POST['ratCount'],
    $_POST['itemId']
];

$stmtComment = $pdo->prepare($sqlComment);
$stmtComment->execute($commentParam);
// $commentId = $pdo->lastInsertId();

if($stmtComment->rowCount() > 0) {
    header("Refresh: 3; url=./itemDetail.php?itemId=".$_POST['itemId']);
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "留言新增成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 3; url=./itemDetail.php?itemId=".$_POST['itemId']);
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "留言新增失敗";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
