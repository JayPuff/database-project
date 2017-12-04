<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <link rel="stylesheet" href="userpage.css"/>
    <title>  Rating Confirm Page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, Must be logged in to purchase! </h1> </div>';
            return;
        }
    ?>


    <? 
    

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


   
    $stmt = $conn->prepare("UPDATE Ad SET Rating=:rating WHERE Id=:id");
    // Prepare statement
    $stmt->bindParam(':rating', $_GET["rating"]);
    $stmt->bindParam(':id', $ad["Id"]);
    

    // execute the query
    $result = $stmt->execute(); 

    ?>

   
        <div class="aside"> 
        </div>

        <div class="content ad-content"> 
            Ad Rated!
        </div>

        
      


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="makepurchase.js" type="text/javascript"> </script>

  </body>
</html>

