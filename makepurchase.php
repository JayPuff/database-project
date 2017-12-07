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
    <title>  Purchase Confirm Page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, Must be logged in to purchase! </h1> </div>';
            return;
        }
    ?>


    <? 
    $mode = "NONE";


    if(!isset($_GET["type"])) {
        echo '<div class="aside"> </div><div class="content"><h1> No type of purchase specified. </h1> </div>';
        return;
    }   

    if($_GET["type"] == "AD") {
         if (!isset($_GET["id"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No ID for purchase specified. </h1> </div>';
            return;
         }

         if (!isset($_GET["price"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No price for purchase specified. </h1> </div>';
            return;
         }

         $mode = "AD";

    } else if ($_GET["type"] == "MEMBERSHIP") {
        if (!isset($_GET["price"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No price for purchase specified. </h1> </div>';
            return;
        }

        $mode = "MEMBERSHIP";

    } else if ($_GET["type"] == "PROMOTION") {
        if (!isset($_GET["price"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No price for purchase specified. </h1> </div>';
            return;
         }

        if (!isset($_GET["id"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No ID for purchase specified. </h1> </div>';
            return;
         }

         $mode = "PROMOTION";
    } else if ($_GET["type"] == "STORE") {
        if (!isset($_GET["requesteddate"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No requested date for renting specified. </h1> </div>';
            return;
         }

         if (!isset($_GET["requestedtime"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No requested time for renting specified. </h1> </div>';
            return;
         }

         if (!isset($_GET["location"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No requested location for renting specified. </h1> </div>';
            return;
         }

         if (!isset($_GET["duration"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No requested duration for renting specified. </h1> </div>';
            return;
         }

         if (!isset($_GET["delivery"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No requested delivery for renting specified. </h1> </div>';
            return;
         }



         $mode = "STORE";
    }


    if($mode == "NONE") {
        echo '<div class="aside"> </div><div class="content"><h1> No MODE of purchase specified. </h1> </div>';
        return;
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $mine;
    $ad;

    if($mode == "PROMOTION" || $mode == "AD") {
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

        if(!$mine && $mode == "MEMBERSHIP") {
            echo '<div class="aside"> </div><div class="content"><h1> Cant purchase membership for not owned AD </h1> </div>';
            return;
        }

        if($mine && $mode == "AD") {
            echo '<div class="aside"> </div><div class="content"><h1> Cant purchase own AD </h1> </div>';
            return;
        }
    }

    if($ad["Sold"] == 'T') {
        echo '<div class="aside"> </div><div class="content"><h1> Sorry, that item has been already sold! </h1> </div>';
        return;
    }

    $result;
    $transactionID;
    if($mode == "AD") {
        try {
            $stmt = $conn->prepare("UPDATE Ad SET Sold='T' WHERE Id=:id");
            // Prepare statement
            $stmt->bindParam(':id', $ad["Id"]);
           
  
            // execute the query
            $result = $stmt->execute();     
            
        } catch (PDOException $e) {
            // $error =  array('error' => $e->getMessage());
            // echo json_encode($error);
        }


        if($result) {
            $stmt = $conn->prepare("INSERT INTO Purchase VALUES(0,:soldby,:username,:id,:cardtype,:cardnumber,:amount,NOW(),'ONLINE','AD','T')");
            // Prepare statement
            $stmt->bindParam(':username', $_SESSION["Username"]);
            $stmt->bindParam(':soldby', $ad["Username"]);
            $stmt->bindParam(':cardtype', $_GET["card"]);
            $stmt->bindParam(':cardnumber', $_GET["number"]);
            $stmt->bindParam(':amount', $ad["Price"]);

            $stmt->bindParam(':id', $ad["Id"]);
           
  
            // execute the query
            $result = $stmt->execute(); 

            if($result) {
                $transactionID = $conn->lastInsertId();
            }
        }
    }

    if($mode == "PROMOTION") {
        try {
            $amount = 0;
            if($_GET["price"] == 7) {
                $amount = 10;
            }
            if($_GET["price"] == 14) {
                $amount = 50;
            }
            if($_GET["price"] == 30) {
                $amount = 90;
            }
            $stmt = $conn->prepare("UPDATE Ad SET Promotion=:promotion WHERE Id=:id");
            // Prepare statement
            $stmt->bindParam(':promotion', $_GET["price"]);
            $stmt->bindParam(':id', $ad["Id"]);
           
  
            // execute the query
            $result = $stmt->execute();     
            
        } catch (PDOException $e) {
            // $error =  array('error' => $e->getMessage());
            // echo json_encode($error);
        }


        if($result) {
            $stmt = $conn->prepare("INSERT INTO Purchase VALUES(0,'',:username,:id,:cardtype,:cardnumber,:amount,NOW(),'ONLINE','PROMOTION','T')");
            // Prepare statement
            $stmt->bindParam(':username', $_SESSION["Username"]);
            $stmt->bindParam(':cardtype', $_GET["card"]);
            $stmt->bindParam(':cardnumber', $_GET["number"]);
            $stmt->bindParam(':amount', $amount);

            $stmt->bindParam(':id', $ad["Id"]);
           
  
            // execute the query
            $result = $stmt->execute(); 

            if($result) {
                $transactionID = $conn->lastInsertId();
            }
        }
    }


    if($mode == "MEMBERSHIP") {
        try {
            $amount = 0;
            if($_GET["price"] == 7) {
                $amount = 10;
            }
            if($_GET["price"] == 14) {
                $amount = 50;
            }
            if($_GET["price"] == 30) {
                $amount = 90;
            }
            $stmt = $conn->prepare("UPDATE User SET Membership=:membership WHERE Username=:username");
            // Prepare statement
            $stmt->bindParam(':membership', $_GET["price"]);
            $stmt->bindParam(':username', $_SESSION["Username"]);
           
  
            // execute the query
            $result = $stmt->execute();     
            
        } catch (PDOException $e) {
            // $error =  array('error' => $e->getMessage());
            // echo json_encode($error);
        }


        if($result) {
            $stmt = $conn->prepare("INSERT INTO Purchase VALUES(0,'',:username,:id,:cardtype,:cardnumber,:amount,NOW(),'ONLINE','MEMBERSHIP','T')");
            // Prepare statement
            $stmt->bindParam(':username', $_SESSION["Username"]);
            $stmt->bindParam(':cardtype', $_GET["card"]);
            $stmt->bindParam(':cardnumber', $_GET["number"]);
            $stmt->bindParam(':amount', $amount);

            $stmt->bindParam(':id', $ad["Id"]);
           
  
            // execute the query
            $result = $stmt->execute(); 

            if($result) {
                $transactionID = $conn->lastInsertId();
            }
        }
    }

    if($mode == "STORE") {
        try {
            $weekday = "WEEKDAY";

            function isWeekend($date) {
                return (date('N', strtotime($date)) >= 6);
            }

            if(isWeekend($_GET["requesteddate"])) {
                $weekday = "WEEKEND";
            }

            $amount = 0;
            $deliveryfee = 0;

            if($weekday == "WEEKDAY") {
                $amount = 10 * intval($_GET["duration"]);
                if($_GET["delivery"] == 'T') {
                    $deliveryfee = 5 * intval($_GET["duration"]);
                }
            } else {
                $amount = 15 * intval($_GET["duration"]);
                if($_GET["delivery"] == 'T') {
                    $deliveryfee = 10 * intval($_GET["duration"]);
                }
            }
            
            if($_GET["location"] == "SL-1") {
                $amount = $amount * 1.20;
            } else if($_GET["location"] == "SL-2") {
                $amount = $amount * 1.15;
            } else if($_GET["location"] == "SL-3") {
                $amount = $amount * 1.10;
            } else if($_GET["location"] == "SL-4") {
                $amount = $amount * 1.05;
            }

            $amount = $amount + $deliveryfee;

            $stmt = $conn->prepare("INSERT INTO Purchase VALUES(0,'',:username,NULL,:cardtype,:cardnumber,:amount,NOW(),'ONLINE','STORE','F')");
            // Prepare statement
            $stmt->bindParam(':username', $_SESSION["Username"]);
            $stmt->bindParam(':cardtype', $_GET["card"]);
            $stmt->bindParam(':cardnumber', $_GET["number"]);
            $stmt->bindParam(':amount', intval($amount));

           
  
            // execute the query
            $result = $stmt->execute(); 

            if($result) {
                $transactionID = $conn->lastInsertId();
            }
            
        } catch (PDOException $e) {
            // $error =  array('error' => $e->getMessage());
            // echo json_encode($error);
        }


        if($result) {
            $stmt = $conn->prepare("INSERT INTO PhysicalStore VALUES(0,NULL,:username,:paymentid,:sl,:delivery,:requesteddate,CURDATE(),:duration,:requestedtime,:week,'PENDING')");
            // Prepare statement
            $stmt->bindParam(':paymentid', $transactionID);
            $stmt->bindParam(':username', $_SESSION["Username"]);
            $stmt->bindParam(':sl', $_GET["location"]);
            $stmt->bindParam(':delivery', $_GET["delivery"]);
            $stmt->bindParam(':requesteddate', $_GET["requesteddate"]);
            $stmt->bindParam(':duration', intval($_GET["duration"]));
            $stmt->bindParam(':requestedtime', $_GET["requestedtime"]);
            $stmt->bindParam(':week', $weekday);
           
  
            // execute the query
            $result = $stmt->execute();     
        }
    }
    

    ?>

   
        <div class="aside"> 

            <? if($mode == "MEMBERSHIP") { ?>
                Membership Purchase Confirmation
            <? } ?>

            <? if($mode == "PROMOTION") { ?>
                Promotion Purchase Confirmation
            <? } ?>

            <? if($mode == "AD") { ?>
                Ad Purchase Confirmation
            <? } ?>

            <? if($mode == "STORE") { ?>
                Form submission and pre-payment Confirmation
            <? } ?>

            <hr>
        </div>

        <div class="content ad-content"> 
            <? if($mode == "MEMBERSHIP") { ?>
                <h2> Purchase Complete </h2>
                <p> Transaction ID: <? echo $transactionID; ?> </p>
            <? } ?>

            <? if($mode == "PROMOTION") { ?>
                <h2> Purchase Complete </h2>
                <p> Transaction ID: <? echo $transactionID; ?> </p>
            <? } ?>

            <? if($mode == "AD") { ?>
                <h2> Purchase Complete </h2>
                <p> Transaction ID: <? echo $transactionID; ?> </p>

                <hr>
                <p> Rate your purchase! </p>
                <select id="rating">
                    <option value='1'> 1 Star </option>
                    <option value='2'> 2 Stars </option>
                    <option value='3'> 3 Stars </option>
                    <option value='4'> 4 Stars </option>
                    <option value='5'> 5 Stars </option>
                </select>

                <script>
                    <? echo "var id = " . $ad["Id"] . ";" ?>
                </script>

                <button type="button" onclick="rate()"> Rate! </button>
            <? } ?>

            <? if($mode == "STORE") { ?>
                <h2> Purchase Complete </h2>
                <p> Transaction ID: <? echo $transactionID; ?> </p>
                <p> You will be emailed, when your rental is approved! </p>
            <? } ?>

        </div>

        
      


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="makepurchase.js" type="text/javascript"> </script>

  </body>
</html>

