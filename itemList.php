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

            //SQL 敘述
            $sql = "SELECT i.`itemId`, i.`itemName`, i.`itemImg`, i.`itemPrice`, 
                            i.`itemQty`, i.`itemCategoryId`, i.`created_at`, i.`updated_at`,
                            c.`categoryName`
                    FROM `items` as i INNER JOIN `categories` as c
                    ON i.`itemCategoryId` = c.`categoryId`
                    WHERE i.`itemCategoryId` in ({$strCategoryIds})
                    ORDER BY i.`itemId` ASC ";

            //查詢分頁後的商品資料
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); //$arrParam

            //若商品項目個數大於 0，則列出商品
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($arr); $i++) {
            ?>

                    <?php require('./tpl/itemCard.php'); ?>

            <?php
                }
            }
        } else {
            //SQL 敘述
            $sql = "SELECT `itemId`, `itemName`, `itemImg`, `itemPrice`, 
                            `itemQty`, `itemCategoryId`, `created_at`, `updated_at`
                     FROM `items` 
                     ORDER BY `itemId` ASC ";

            //查詢分頁後的商品資料
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); //$arrParam

            //若商品項目個數大於 0，則列出商品
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($arr); $i++) {
            ?>

            <?php require('./tpl/itemCard.php'); ?>

            <?php } } } ?>
            </div>
        </div>

        <!-- 商品過濾 -->
        <div class="col-md-2 col-sm-3"><?php require_once("./tpl/tpl-filter.php"); ?></div>
    </div>
</div>

<?php require_once('./tpl/footer.php'); ?>
<?php require_once('./tpl/tpl-html-foot.php'); ?>