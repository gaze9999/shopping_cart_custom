<?php
    $sqlRatSum = "SELECT m.`rating`, m.`itemId`, i.`itemId`, COALESCE(SUM(rating), 0) as 'ratingSum'
                    FROM `comments` as m RIGHT JOIN `items` as i
                    ON m.`itemId` = i.`itemId`
                    GROUP BY i.`itemId` ";

    // echo "<pre>";
    // print_r($arr);
    // echo "</pre>";
    // exit;

    $stmtRatSum = $pdo->prepare($sqlRatSum);
    $stmtRatSum->execute();
    $stmtRatSum = $stmtRatSum->fetchAll(PDO::FETCH_ASSOC);

    if (isset($stmtRatSum)) {
    for ($x=0; $x< count($stmtRatSum); $x++) {
    $rating[$x] = array('rating'=>$stmtRatSum[$x]['ratingSum']);
    $arr[$x] = array_merge($arr[$x], $rating[$x]);
    }; };
    
    // echo "<pre>";
    // print_r($rating);
    // print_r($stmtRatSum);
    // print_r($arr);
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
                <small class="itemListPrice">
                <?php if (isset($stmtRatSum)) { echo "總讚數：".$arr[$i]['rating']; } ?>

                </small>
                <small class="itemListPrice">價格：<?php echo $arr[$i]['itemPrice']; ?></small>
                <small class="itemListCTime">上架日期：<?php echo $arr[$i]['created_at']; ?></small>
            </div>
        </div>
    </div>
</div>