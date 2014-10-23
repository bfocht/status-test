<?php
  include('db.php');
  $OFF = "off";
  $ON  = "on";

  $status = $ON;
  $db = new Database();

  if (!empty($_POST)){
     $post_status = $_POST["status"];
    if ($post_status == $ON) {
      $status=$db->update($_SERVER['REQUEST_URI'], $OFF);
    }
    else {
      $status=$db->update($_SERVER['REQUEST_URI'], $ON);
    }
  }
  else
  {
    $status = $db->select($_SERVER['REQUEST_URI'], $ON); 
  }

  if ($status == $OFF) {
    header("HTTP/1.0 500 Internal Server Error!");
  }
  else {
    header("HTTP/1.1 200 OK");
  }

?>
<html>
    <head>
   <title>Status Test Page</title>
   <meta name="description" content="<?php echo "The status of the site is $status" ?>">
   <link rel="stylesheet" href="status.css">
  </head>
  <body>
    <FORM action="" method="post">
      <INPUT type="hidden" name="status" value="<?php echo $status ?>">
      <INPUT class="<?php echo $status ?>" type="submit" value="">
    </FORM>
    <a href="https://github.com/Resellers/status-test"><img class="github-forkme" src="https://camo.githubusercontent.com/a6677b08c955af8400f44c6298f40e7d19cc5b2d/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png"></a>
  </body>
</html>

