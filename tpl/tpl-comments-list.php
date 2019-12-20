<div class="container" id="comments">

<?php
require_once('./db.inc.php'); 
$sqlRatSum = "SELECT SUM(rating) as 'rating'";
$sqlRatSum.= "FROM `comments` ";
$sqlRatSum.= "WHERE `itemId` = ? ";

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

if(isset($_GET['itemId'])){

    //SQL 敘述
    $sql = "SELECT `id`, `author`,`contents`, `rating`, `itemId`, `createdTime`, `updatedTime`
            FROM `comments`
            WHERE `itemId` = ? AND `parentId` = 0
            ORDER BY `createdTime` DESC ";

    //查詢分頁後的商品資料
    $stmt = $pdo->prepare($sql);
    $arrParam = [ $_GET['itemId'] ];
    $stmt->execute($arrParam); //
?>
<p id="ratCon" name="ratCon">總讚數: <?php echo $RatSumNum; ?></p>
<?php
    //若商品項目個數大於 0，則列出商品
    if($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for($i = 0; $i < count($arr); $i++) {
    ?>
        <div class="row">
            <div class="media">
                <img src="http://www.likoda.com.tw/style/images/frontpage/default_user_icon.png" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $arr[$i]["author"]; ?></h5>
                    <p><?php echo nl2br($arr[$i]["contents"]); ?></p>
                    <p>評分: <?php echo $arr[$i]["rating"]; ?></p>
                    <p>留言時間: <?php echo $arr[$i]["createdTime"]; ?></p>
                </div>
            </div>
        </div>

        <?php
         $sqlReply = "SELECT `id`, `author`,`contents`, `rating`, `itemId`, `createdTime`, `updatedTime`
                    FROM `comments`
                    WHERE `itemId` = ? AND `parentId` = ?
                    ORDER BY `createdTime` ASC ";
        //查詢分頁後的商品資料
        $stmtReply = $pdo->prepare($sqlReply);
        $arrReplyParam = [ 
            $_GET['itemId'],
            $arr[$i]["id"]
        ];
        $stmtReply->execute($arrReplyParam); //

        //若商品項目個數大於 0，則列出商品
        if($stmtReply->rowCount() > 0) {
            $arrReply = $stmtReply->fetchAll(PDO::FETCH_ASSOC);
            for($j = 0; $j < count($arrReply); $j++) {
        ?>
            <div class="row">
                <div class="col-md-3"><?php echo $arrReply[$j]['author'] ?>回覆</div>
                <div class="col-md-9"><?php echo nl2br($arrReply[$j]['contents']) ?></div>
            </div>
        <?php
            }
        } else {
        ?>
            <div class="row">管理員尚未回覆</div>
        <?php
        }
        ?>

    <?php
        }
    }
} 
?>

</div>