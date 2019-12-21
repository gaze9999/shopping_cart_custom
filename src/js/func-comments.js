itemList.ready(()=>{
  $.ajax({
      method: "POST",
      url: "./tpl/func-.php",
      dataType: "json",
      data: {
      }
  })
  .done(()=>{
    itemList.html(`
    <div class="row">
      <?php
      //若商品項目個數大於 0，則列出商品
      if($stmt->rowCount() > 0) {
          $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
          for($i = 0; $i < count($arr); $i++) {
      ?>
      <?php require('./tpl/tpl-itemCard.php'); ?>                
      <?php } } ?>
      </div>
    </div>
    `);
  })
  .fail(( jqXHR, textStatus)=>{
      // console.log( "Request failed: " + textStatus );
      // console.log(`---------`);
      // console.log(jqXHR);
      // itemList.html(JSON.stringify(jqXHR));
      // itemList.html(jqXHR.responseText);
  });
});