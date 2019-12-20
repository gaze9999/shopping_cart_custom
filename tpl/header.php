<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a href="./index.php">OO羊</a>
    </h5>

    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="./itemList.php">商品一覽</a>
        <a class="p-2 text-dark" href="./myCart.php">
            <span>我的購物車</span>
            <?php 
            if(isset($_SESSION["cart"])){
                echo "(".count($_SESSION["cart"]).")";
            } else {
                echo "(0)";
            }
            ?>
        </a>
        <?php if(isset($_SESSION["username"])) { ?>
        <a class="p-2 text-dark" href="./check.php">我的訂單</a>
        <?php } ?>
    </nav>    
    <a href="./phpTest.php">測試頁面</a>
    <?php if(!isset($_SESSION["username"])){ ?>
    <a class="btn" href="./register.php">註冊</a>
    <?php } else { ?>
    <span><?php echo $_SESSION["name"] ?> 您好</span>
    <?php } ?>
    <?php if(isset($_SESSION['identity'])){ if ($_SESSION['identity'] == 'admin'){ ?>
        <a class="btn" href="./admin/admin.php">管理介面</a>
    <?php } } ?>

    <div class="btn-group dropleft accDropdown ml-4">
        <button class="btn dropdown-toggle accBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        X
        </button>
        <div class="dropdown-menu accMenu" aria-labelledby="">
            <div class="accItem">
            <?php require_once("./tpl/login.php") ?>
            </div>
        </div>
    </div>
</div>