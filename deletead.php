<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Edit Ad  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, only members can delete Ads! </h1> </div>';
            return;
        }
    ?>
    <?php
      
      if(!isset($_GET["id"])) {
        echo '<div class="aside"> </div><div class="content"><h1> No AD ID specified. </h1> </div>';
        return;
      }   
      
      
      $showform = true;
      $provinces;
      $cities;





      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $stmt = $conn->prepare("SELECT * FROM Ad WHERE Id=:id");
      $stmt->bindParam(':id', $_GET["id"]); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $ads = $stmt->fetchAll();

      if(count($ads) != 1) {
        echo '<div class="aside"> </div><div class="content"><h1> No advertisment was found with that ID </h1> </div>';
        return;
      }
      
      $ad = $ads[0];
      
      $mine = ($ad["Username"] == $_SESSION["Username"]);

      if(!$mine) {
        echo '<div class="aside"> </div><div class="content"><h1> You do not have permission to delete this AD </h1> </div>';
        return;
      }




      
       
        

        try {
          $stmt = $conn->prepare("DELETE FROM Ad WHERE Username=:username AND Id=:id");
          
          
          //$number = 0;
          // Prepare statement
          $stmt->bindParam(':id', $_GET["id"]);
          $stmt->bindParam(':username', $_SESSION["Username"]);

          
          // execute the query
          $result = $stmt->execute();
      
          if($result) {
            $showform = false;
            echo "<h1> New AD edited! </h1> <br>";
            echo "<script> window.location.href='/userpage.php' </script>";
          }
      
      } catch (PDOException $e) {
          // $error =  array('error' => $e->getMessage());
          // echo json_encode($error);
          echo "<h1> Error deleting AD </h1>";
          print_r(var_dump($_POST));
      }
      
      
      $conn = null;
      return;
    
    ?>
    

   



    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
  </body>
</html>

