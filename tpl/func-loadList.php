<?php
  require_once('../db.inc.php'); 

  //SQL 敘述
  $sql = "SELECT i.`itemId`, i.`itemName`, i.`itemImg`, i.`itemPrice`, i.`itemQty`, i.`itemCategoryId`, i.`created_at`, i.`updated_at`, c.`categoryName`, COALESCE(SUM(m.`rating`), 0) as 'ratingSum'
          FROM `items` as i INNER JOIN `categories` as c LEFT JOIN `comments` as m
          ON i.`itemCategoryId` = c.`categoryId` AND m.`itemId` = i.`itemId` ";

  //若網址有商品種類編號，則整合字串來操作 SQL 語法
  // if($_POST['cId'] != "") {$sql .= "WHERE i.`itemCategoryId` in ({$_POST['cIds']}) ";}
  $sql .= "WHERE i.`itemCategoryId` in (1, 2, 3)";
  $sql .= "GROUP BY i.`itemId` ";
  $sql .= "ORDER BY i.`itemId` ASC ";

  //查詢分頁後的商品資料
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
?>