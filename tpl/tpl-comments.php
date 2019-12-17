<div class="container">
    <form name="myForm" method="POST" action="insertComment.php">
    <table>
        <thead>
            <tr>
                <th>名字</th>
                <th>留言內容</th>
                <th>讚</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="name" value="" placeholder="請記得輸入名字!" maxlength="50">
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
            <td colspan="5"><input type="submit" name="smb" value="留言"></td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="ratCount" id="putCount" value="">
    <input type="hidden" name="itemId" value="<?php echo $_GET['itemId'] ?>">
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
        ratCount.value =ratCon;
        // console.log(ratCon);
    } else {
        ratWarn.textContent = `讚數已達上限!`;
        // console.log(`讚數已達上限!`);
    };
 });    
</script>