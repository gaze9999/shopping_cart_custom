<?php 
session_start();
require_once('./db.inc.php'); 
require_once('./tpl/tpl-html-head.php');
require_once('./tpl/header.php');
require_once("./tpl/func-buildTree.php");
require_once("./tpl/func-getRecursiveCategoryIds.php"); 
?>

<div class="container-fluid">
    <div class="row">
        <!-- 樹狀商品種類連結 -->
        <div class="col-md-2 col-sm-3"><?php buildTree($pdo, 0); ?></div>

        <!-- 商品項目清單 -->
        <div class="col-md-8 col-sm-6">
            <div class="row">
            <?php
            if(isset($_GET['categoryId'])){
                $strCategoryIds = "";
                $strCategoryIds.= $_GET['categoryId'];
                getRecursiveCategoryIds($pdo, $_GET['categoryId']);
            }

            //SQL 敘述
            $sql = "SELECT i.`itemId`, i.`itemName`, i.`itemImg`, i.`itemPrice`, i.`itemQty`, i.`itemCategoryId`, i.`created_at`, i.`updated_at`, c.`categoryName`, COALESCE(SUM(m.`rating`), 0) as 'ratingSum'
                    FROM `items` as i INNER JOIN `categories` as c LEFT JOIN `comments` as m
                    ON i.`itemCategoryId` = c.`categoryId` AND m.`itemId` = i.`itemId` ";

            //若網址有商品種類編號，則整合字串來操作 SQL 語法
            if(isset($_GET['categoryId'])) {$sql .= "WHERE i.`itemCategoryId` in ({$strCategoryIds}) ";}
            $sql .= "GROUP BY i.`itemId` ";
            $sql .= "ORDER BY i.`itemId` ASC ";

            //查詢分頁後的商品資料
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //若商品項目個數大於 0，則列出商品
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($arr); $i++) {
            ?>
            <?php require('./tpl/tpl-itemCard.php'); ?>                
            <?php
                }
            }
            ?>
            </div>
        </div>

        <!-- 商品過濾 -->
        <div class="col-md-2 col-sm-3"><?php require_once("./tpl/tpl-filter.php"); ?></div>
    </div>
</div>

<?php require_once('./tpl/footer.php'); ?>
<?php require_once('./tpl/tpl-html-foot.php'); ?>
<script src="./src/js/func-loadList.js"></script>