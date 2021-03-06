<div class="album py-5 bg-light flex-shrink-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 d-flex justify-content-center">
                <h1>商品一覽</h1>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row mx-auto">
            <div class="col-md-12 col-sm-12 d-flex flex-wrap">
                <?php
                //SQL 敘述
                $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemPrice`, 
                                `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,
                                `categories`.`categoryName`
                        FROM `items` INNER JOIN `categories`
                        ON `items`.`itemCategoryId` = `categories`.`categoryId`
                        ORDER BY `items`.`itemId` ASC ";
                // $sql.= "LIMIT ?, ? ";
                //設定繫結值
                // $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                //查詢分頁後的商品資料
                $stmt = $pdo->prepare($sql);
                $stmt->execute(); //$arrParam

                //若數量大於 0，則列出商品
                if($stmt->rowCount() > 0) {
                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for($i = 0; $i < count($arr); $i++) { ?>
                    <div class="card mb-3 mx-2 shadow-sm itemListCard">
                        <a class="card-img-top list-item itemListImg d-flex center-all" href="./itemDetail.php?itemId=<?php echo $arr[$i]['itemId']; ?>">
                            <img class="img-fluid" src="./images/items/<?php echo $arr[$i]['itemImg']; ?>">
                        </a>
                        <div class="card-body">
                            <p class="card-text list-item-card itemListText"><?php echo $arr[$i]['itemName']; ?></p>
                            <div class="d-flex center-all flex-column">
                                <small class="itemListCTime">上架日期：<?php echo $arr[$i]['created_at']; ?></small>
                            </div>
                        </div>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</div>