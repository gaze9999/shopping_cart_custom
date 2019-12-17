<?php
$sqlRatSum = "SELECT SUM(rating) as 'rating'";
$sqlRatSum.= "FROM `comments` ";
$sqlRatSum.= "WHERE `item_id` = ? ";

$RatSumRaram = [
    $_GET['itemId']
];

$stmtRatSum = $pdo->prepare($sqlRatSum);
$stmtRatSum->execute($RatSumRaram);
$stmtRatSum = $stmtRatSum->fetchAll(PDO::FETCH_ASSOC);

$RatSumNum = $stmtRatSum[0]['rating'];

if (!$RatSumNum > 0) {
    $RatSumNum = 0;
};
?>

總讚數: 
<span id="ratCon" name="ratCon"><?php echo $RatSumNum; ?></span>

<div class="container">
    <?php
        $sqlComList = "SELECT `id`, `author`, `contents`, `rating`, `createdTime`, `item_id`, `updatedTime` ";
        $sqlComList.= "FROM `comments` ";
        $sqlComList.= "WHERE `item_id` = ? ";
        $sqlComList.= "ORDER BY `createdTime` DESC ";

        $stmtComList = $pdo->prepare($sqlComList);
        $stmtComList->execute($RatSumRaram);
        // $stmtComList = $stmtComList->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($stmtComList);
        // echo "</pre>";
        // exit();

        if ($stmtComList->rowCount() > 0) {
            $arr = $stmtComList = $stmtComList->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($arr); $i++) {
    ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">留言者: <?php echo $arr[$i]['author']; ?></h5>
            <div>
            <p class="card-text">留言內容: </p><br>
            <p class="card-text"><?php echo $arr[$i]['contents']; ?></p>
            </div>
            <small class="card-tex">留言時間: <?php echo $arr[$i]['createdTime']; ?></small>
        </div>
    </div>

    <?php } } ?>
</car>