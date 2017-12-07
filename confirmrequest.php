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
    <title>  Confirm Request  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Please login!</h1> </div>';
            return;
        }
    ?>


    <? 

    if($_SESSION["Usertype"] != "ADMIN") {
        echo '<div class="aside"> </div><div class="content"><h1> You must be an admin to approve or reject a request. </h1> </div>';
        return;
    }


    if(!isset($_GET['type']) || !isset($_GET['id'])) {
        echo '<div class="aside"> </div><div class="content"><h1> No approve or reject defined, or ID not there. </h1> </div>';
        return;
    }

    $type = $_GET['type'];
    $requests = array();
    $request;

    $updateStatement = "UPDATE PhysicalStore SET Status='REJECTED',AdminUsername=:admin WHERE Id=:id";

    if($type == 'APPROVE') {
        $updateStatement = "UPDATE PhysicalStore SET Status='APPROVED',AdminUsername=:admin WHERE Id=:id";
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $conn->prepare("SELECT r.* FROM PhysicalStore r WHERE r.Id=:id");
    $stmt->bindParam(':id', $_GET["id"]);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $requests = $stmt->fetchAll();
    $request = $requests[0];



   
    $stmt = $conn->prepare($updateStatement);
    $stmt->bindParam(':id', $_GET["id"]);
    $stmt->bindParam(':admin', $_SESSION["Username"]);
    
    $stmt->execute();





    if($type == "APPROVE") {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $requests = array();
    
       
        $stmt = $conn->prepare("UPDATE Purchase SET Authorized='T' WHERE Id=:id");
        $stmt->bindParam(':id', $request["PaymentId"]);
    
        $stmt->execute();
    }

    
    
    echo "Success!";
    

    ?>


    




    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <!-- <script src="requests.js" type="text/javascript"> </script> -->


  </body>
</html>

