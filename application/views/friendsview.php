<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>

    <title>php-sdk</title>
   <link href="assets/css/bootstrap.min.css" rel="stylesheet">
       <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/myMods.css" rel="stylesheet">
  </head>



  <body>
      <h3>Your Friends</h3>
      <div class="friends">
      <?php
    for ($a = 0; $a < count($friends) - 1;) {
        echo '<div class="row">';
        for ($i = 1; $i <= 3; $i++) {
          $first_name = $friends[$a]['first_name'];
          $last_name =  $friends[$a]['last_name'];
          $uid = $friends[$a]['uid'];
          $imageSource = "https://graph.facebook.com/" . $friends[$a]['uid']. "/picture?width=200&height=200";
?>
              <div class="span4">
                <?php
            if ($friends) {
?>
              <h3> <?php
                print $first_name . " " . $last_name;
?></h3>
              <img class="profilepic" src= <?php
                echo $imageSource . ">";
            }
?>
                <?php
                echo '<p>';
            if ($friends[$a]['about_me']) {
                echo '<button class ="btn">Bio</button>';
                
 

            }
            $queryString = array('firstName'=> $first_name, 'lastName' => $last_name, 'imageSource' => $imageSource, 'uid' => $uid);
            $queryString = http_build_query($queryString);
            echo '<a class="btn" href="index.php/details?' . $queryString . '">Details</a>';
            echo '</p>';
            $a += 1;
            echo '</div>'; //end of span 4
        }
        echo '</div>'; //end of row
    }
?>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src= "assets/js/bio.js"></script>
</html>