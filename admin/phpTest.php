<?php 
session_start();
require_once('./db.inc.php');
require_once('./tpl/tpl-html-head.php');
require_once('./templates/title.php');
require_once('./tpl/tpl-html-foot.php'); 

try {
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
  exit();
} catch(Error $e) {
    echo "Failed: " . $e->getMessage();
}
?>