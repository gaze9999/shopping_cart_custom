<div class="table-responsive">
    <form name="myForm" method="POST" action="insertComments.php">
    <?php if (isset($_SESSION['name'])) { ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>名字</th>
                    <th>留言內容</th>
                    <th>讚</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span id="nameShow" name="name"><?php echo $_SESSION['name']; ?></span>
                    </td>
                    <td>
                        <textarea id="ComContent" name="content" rows=""></textarea>
                    </td>
                    <td>
                        <span id="ratCon" name="ratCon"></span>
                        <span id="ratWarn" name="ratWarn"></span>
                        <a name="rating" id="ratBtn" class="btn btn-info" role="button">讚</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="border" colspan="3">
                        <input type="submit" name="btn_insertComments" id="btn_insertComments" value="留言">
                    </td>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="nameField" id="nameField" value="<?php echo $_SESSION['name']; ?>">
        <input type="hidden" name="ratCount" id="putCount" value="">
        <input type="hidden" name="itemId" value="<?php echo (int)$_GET['itemId']; ?>">
        <?php } else { ?>
            <div>
                <h2>請先登入才可留言!</h2>
            </div>
        <?php } ?>
    </form>
</div>

<script>
 let ratBtn =  document.querySelector('#ratBtn');
 let ratCon = 0;
 let ratShow = document.querySelector('#ratCon');
 let ratCount = document.querySelector('#putCount');

 ratBtn.addEventListener('click', function(){
    if (ratCon < 10) {
        ratCon++;
        ratCount.value = ratCon;
        // console.log(ratCon);
    } else {
        ratWarn.textContent = `讚數已達上限!`;
        // console.log(`讚數已達上限!`);
    };
 });    
</script>