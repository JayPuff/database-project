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
    <title>  User page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Please login!</h1> </div>';
            return;
        }
    ?>


    <? 

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Category"); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $categories = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT * FROM Province"); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $provinces = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT * FROM City"); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $cities = $stmt->fetchAll();

    $stmt = $conn->prepare("SELECT DISTINCT a.Username FROM Ad a, User u WHERE u.Username = a.Username AND DATE_ADD(a.Posted, INTERVAL u.Membership DAY) >= CURDATE() AND a.Available='ONLINE' AND a.Deleted='F' AND Sold='F'"); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $sellers = $stmt->fetchAll();

    $ads = array();
    $tempads = array();

    if(isset($_GET["myads"])) {
        if($_GET["myads"] != "") {
            $stmt = $conn->prepare("SELECT * FROM Ad WHERE Username=:username");
            $stmt->bindParam(':username', $_SESSION["Username"]);
            
            $stmt->execute();
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
            $ads = $stmt->fetchAll();
        } 
    } else {
        $stmt = $conn->prepare("SELECT a.* FROM Ad a, User u WHERE u.Username = a.Username AND DATE_ADD(a.Posted, INTERVAL u.Membership DAY) >= CURDATE() AND a.Available='ONLINE' AND a.Deleted='F' AND Sold='F' ORDER BY a.Promotion DESC");
        $stmt->bindParam(':username', $_SESSION["Username"]);
        
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        $tempads = $stmt->fetchAll();

        for($i = 0; $i < count($tempads); $i++) {
            $filtered = false;
            if(isset($_GET["province"])) {
                if($_GET["province"] != "") {
                    if($tempads[$i]["Province"] != $_GET["province"]) {
                        $filtered = true;
                    }
                }
            }

            if(isset($_GET["city"])) {
                if($_GET["city"] != "") {
                    if($tempads[$i]["City"] != $_GET["city"]) {
                        $filtered = true;
                    }
                }
            }

            if(isset($_GET["category"])) {
                if($_GET["category"] != "") {
                    if($tempads[$i]["Category"] != $_GET["category"]) {
                        $filtered = true;
                    }
                }
            }

            if(isset($_GET["seller"])) {
                if($_GET["seller"] != "") {
                    if($tempads[$i]["Username"] != $_GET["seller"]) {
                        $filtered = true;
                    }
                }
            }

            if(!$filtered) {
                array_push($ads,$tempads[$i]);
            }
        }
        
    }
 

    ?>

    <? if($_SESSION["Usertype"] == "REGULAR") { ?>
        <div class="aside"> 
            <button type="button" onclick="viewMyAds()"> View my ADS </button>
            <button type="button" onclick="newAd()"> Post new AD </button>
            <button type="button" onclick="membership()"> Change Membership </button>
            <button type="button" onclick="rent()"> Rent a Physical Store </button>
            <hr>

            <h2> Browse ADS </h2>
            
            &nbsp;By Location: <br>
            <?php locationDropdown($provinces,$cities); ?>

            <br>
            &nbsp;By Category: <br>
            <select id="category"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($categories); $i++) {
                    echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
                } ?>
            </select>
            <br> &nbsp;By Seller: <br>
            <select id="seller"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($sellers); $i++) {
                    echo "<option value='" . $sellers[$i]["Username"]  . "'>" . $sellers[$i]["Username"]  . "</option>";
                } ?>
            </select>
            
            <button type="button" onclick="filter()" >  Filter </button>

            
            <br>
            <hr>
            <button type="button" onclick="logout()"> Log out </button>
        </div>
        <div class="content"> 
                <?php displayAds($ads); ?>
        </div>
    <? } ?>

    <? if($_SESSION["Usertype"] == "ADMIN") { ?>
        <div class="aside"> 
            <button type="button" onclick="viewAllAds()"> View all ADS </button>
            <button type="button" onclick="something()"> View Purchase Details </button>
            <button type="button" onclick="requests()"> View Store Requests </button>
            <hr>

            <h2> Browse ADS </h2>

            &nbsp;By Location: <br>
            <?php locationDropdown($provinces,$cities); ?>

            <br>
            &nbsp;By Category: <br>
            <select id="category"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($categories); $i++) {
                    echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
                } ?>
            </select>
            <br> &nbsp;By Seller: <br>
            <select id="seller"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($sellers); $i++) {
                    echo "<option value='" . $sellers[$i]["Username"]  . "'>" . $sellers[$i]["Username"]  . "</option>";
                } ?>
            </select>

            <button type="button" onclick="filter()" >  Filter </button>

            <hr>
            <br>
            <button type="button" onclick="logout()"> Log out </button>
        </div>
        <div class="content"> 
                <?php displayAds($ads); ?>
        </div>
    <? } ?>




    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="userpage.js" type="text/javascript"> </script>
    <script src="locationDropdown.js" type="text/javascript"> </script>
    

    <? 
        if(isset($_GET["province"])) {
            if($_GET["province"] != "") {
                echo "<script>";
                echo " $('#province').val('";
                echo $_GET["province"];
                echo "');";
                echo "</script>";

                if(isset($_GET["city"])) {
                    if($_GET["city"] != "") {
                        echo "<script>";
                        echo "$('." . $_GET["province"] . "-dropdown').val('";
                        echo $_GET["city"]; 
                        echo "');";
                        
                        echo "$('." . $_GET["province"] . "-dropdown').removeAttr('hidden'); " . "$('." . $_GET["province"] . "-dropdown').removeClass('form-hidden');";

                        echo "</script>";
                    }
                }  
            }
        }  


        if(isset($_GET["category"])) {
            if($_GET["category"] != "") {
                echo "<script>";
                echo " $('#category').val('";
                echo $_GET["category"];
                echo "');";
                echo "</script>";
            }
        }  

        if(isset($_GET["seller"])) {
            if($_GET["seller"] != "") {
                echo "<script>";
                echo " $('#seller').val('";
                echo $_GET["seller"];
                echo "');";
                echo "</script>";
            }
        }  
    ?>

  </body>
</html>

