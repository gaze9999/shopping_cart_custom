<?php
require_once('./checkAdmin.php'); //引用資料庫連線
require_once('../db.inc.php'); //引用資料庫連線
require_once('./templates/title.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

$sqlComment = "INSERT INTO `comments` (`author`, `contents`, `rating`, `parentId`, `itemId`)";
$sqlComment.= "VALUES (?, ?, ?, ?, ?)";
// $sqlComment.= "WHERE `parentId` = 0";

$commentParam = [
    "管理員",
    $_POST['content'],
    0,
    $_POST['parentId'],
    $_POST['itemId']
];

// print_r($commentParam);
// exit;

$stmtComment = $pdo->prepare($sqlComment);

// echo "<pre>";
// echo $arr;
// print_r($commentParam);
// echo "</pre>";
// exit();

$stmtComment->execute($commentParam);
// $commentId = $pdo->lastInsertId();

if($stmtComment->rowCount() > 0) {
    header("Refresh: 3; url=./comments.php?itemId=".$_POST['itemId']);
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "留言新增成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 3; url=./comments.php?itemId=".$_POST['itemId']);
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "留言新增失敗";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
