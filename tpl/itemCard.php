<?php
    $sqlRatSum = "SELECT m.`rating`, m.`item_id`, i.`itemId`, SUM(rating) AS 'rating' ";
    $sqlRatSum.= "FROM `comments` as m INNER JOIN `items` as i ";
    $sqlRatSum.= "ON m.`item_id` = i.`itemId` ";
    $sqlRatSum.= "GROUP BY i.`itemId` ";

    // $sqlRatSum.= "WHERE m.`item_id` = ? ";

    $stmtRatSum = $pdo->prepare($sqlRatSum);
    $stmtRatSum->execute();

    // $RatSumPARAM = 1;

    // echo "<pre>";
    // print_r($arr);
    // echo "</pre>";
    // exit;

    $stmtRatSum = $pdo->prepare($sqlRatSum);
    $stmtRatSum->execute();
    $stmtRatSum = $stmtRatSum->fetchAll(PDO::FETCH_ASSOC);
    
    // echo "<pre>";
    // print_r($stmtRatSum);
    // echo "</pre>";
    // exit;

?>

<div class="mx-2 filter-items" data-price="<?php echo $arr[$i]['itemPrice']; ?>">
    <div class="card mb-3 shadow-sm itemListCard">
        <a class="card-img-top list-item itemListImg d-flex center-all" href="./itemDetail.php?itemId=<?php echo $arr[$i]['itemId']; ?>">
            <img class="img-fluid" src="./images/items/<?php echo $arr[$i]['itemImg']; ?>">
        </a>
        <div class="card-body">
            <p class="card-text list-item-card itemListText"><?php echo $arr[$i]['itemName']; ?></p>
            <div class="d-flex center-all flex-column">
                <small class="itemListPrice">總讚數：
                <!-- <?php echo $stmtRatSum[$i]['rating'];
                if (isset($stmtRatSum[$i]['rating'])) {
                } else {
                    echo "0";
                };
                ?> -->
                </small>
                <small class="itemListPrice">價格：<?php echo $arr[$i]['itemPrice']; ?></small>
                <small class="itemListCTime">上架日期：<?php echo $arr[$i]['created_at']; ?></small>
            </div>
        </div>
    </div>
</div>