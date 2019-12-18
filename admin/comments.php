<?php
require_once('./checkAdmin.php'); //引用資料庫連線
require_once('../db.inc.php'); //引用資料庫連線
require_once('./templates/title.php');
echo "<hr>";
// require_once("./checkSession.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2>商品留言</h2><br>

        <?php
            $sqlRatSum = "SELECT SUM(rating) as 'rating'";
            $sqlRatSum.= "FROM `comments` ";
            $sqlRatSum.= "WHERE `itemId` = ? ";
                    
            if (isset($_GET['itemId'])) {
                $RatSumRaram = [
                    $_GET['itemId']
                ];
            } else {
                $RatSumRaram = 0;
                exit;
            };
            
            $stmtRatSum = $pdo->prepare($sqlRatSum);
            $stmtRatSum->execute($RatSumRaram);
            $stmtRatSum = $stmtRatSum->fetchAll(PDO::FETCH_ASSOC);
            
            $RatSumNum = $stmtRatSum[0]['rating'];
            if (!isset($RatSumNum)) {
                    $RatSumNum = 0; } else { ?>
                <span id="ratCon" name="ratCon"><?php echo "總讚數: ".$RatSumNum; ?></span> 
            <?php }; ?>
            
            <?php
                $sqlComList = "SELECT `id`, `author`, `contents`, `rating`, `createdTime`, `itemId`, `updatedTime`, `parentId` ";
                $sqlComList.= "FROM `comments` ";
                $sqlComList.= "WHERE `itemId` = ? ";
                $sqlComList.= "ORDER BY `createdTime` DESC ";
        
                $stmtComList = $pdo->prepare($sqlComList);
                $stmtComList->execute($RatSumRaram);
                // $arr = $stmtComList->fetchAll(PDO::FETCH_ASSOC);
                // echo "<pre>";
                // echo $arr[0]['id'];
                // // print_r($arr);
                // echo "</pre>";
                // exit();
        
                if ($stmtComList->rowCount() > 0) {
                    $arr = $stmtComList = $stmtComList->fetchAll(PDO::FETCH_ASSOC);
                    for($i = 0; $i < count($arr); $i++) {
            ?>

            <div class="col-md-12">
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
                
                <hr>
                <div class="col-md-12 d-flex justify-content-center">
                    <form name="myForm" method="POST" action="./insertComment.php">
                    <table>
                        <thead>
                            <tr>
                                <th>管理員回覆</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea id="ComContent" name="content" rows=""></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="5"><input type="submit" name="smb" value="留言"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" name="itemId" value="<?php echo $_GET['itemId'] ?>">
                    <input type="hidden" name="parentId" value="<?php echo $arr[$i]['id'] ?>">
                    </form>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>