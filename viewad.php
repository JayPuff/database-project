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
    <title>  View Ad  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, Please log in to see Ads </h1> </div>';
            return;
        }
    ?>


    <? 

    if(!isset($_GET["id"])) {
        echo '<div class="aside"> </div><div class="content"><h1> No AD ID specified. </h1> </div>';
        return;
    }   

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

    ?>

    <? if($_SESSION["Usertype"] == "REGULAR") { ?>
        <div class="aside"> 
            <button type="button" onclick="back()"> Back </button>
            <hr>

            <?  if($mine) {  ?>
            
            <button type="button" onclick="editAd()"> Edit Info </button>
            <button style="color:darkred;" type="button" onclick="deleteAd()"> Delete AD </button>
            <button type="button" onclick="promote()"> Promote this AD </button>
            <hr>
            <? } else { ?>
            
                <button type="button" onclick="buy()"> Purchase Online </button>

            <? } ?>

            
        </div>

        <div class="content ad-content"> 
            <?php showAdRight($ad); ?>
        </div>
    <? } ?>

    <? if($_SESSION["Usertype"] == "ADMIN") { ?>
        <div class="aside"> 
            <button type="button" onclick="back()"> Back </button>
            <hr>

            <?  if($mine) {  ?>
            
            <button type="button" onclick="editAd()"> Edit Info </button>
            <button style="color:darkred;" type="button" onclick="deleteAd()"> Delete AD </button>
            <button type="button" onclick="promote()"> Promote this AD </button>
            <hr>
            <? } else { ?>
            
                <button type="button" onclick="buy()"> Purchase Online </button>

            <? } ?>
        </div>

        <div class="content ad-content"> 
                <?php showAdRight($ad); ?>
        </div>
    <? } ?>


    <script>
        <? echo "var id = " . $ad["Id"] ?>
    </script>


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="viewad.js" type="text/javascript"> </script>

  </body>
</html>

