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
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, only members can edit Ads! </h1> </div>';
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

      $stmt = $conn->prepare("SELECT * FROM Province"); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $provinces = $stmt->fetchAll();

      $stmt = $conn->prepare("SELECT * FROM City"); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $cities = $stmt->fetchAll();

      $stmt = $conn->prepare("SELECT * FROM Category"); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $categories = $stmt->fetchAll();

      $stmt = $conn->prepare("SELECT * FROM SubCategory"); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $subcategories = $stmt->fetchAll();

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
      
      $mine = ($ad["Username"] == $_SESSION["Username"]) || $_SESSION["Usertype"] == "ADMIN";

      
      if(!$mine) {
        echo '<div class="aside"> </div><div class="content"><h1> You do not have permission to edit this AD </h1> </div>';
        return;
      }




      if(isset($_POST["title"]) && isset($_POST["addesc"]) && isset($_POST["price"]) && isset($_POST["available"]) && isset($_POST["forsaleby"]) && isset($_POST["province"]) && isset($_POST["category"]) && isset($_POST["email"]) && isset($_POST["addr"]) && isset($_POST["phonenumber"]) ) {
       
        

        try {
          $stmt = $conn->prepare("UPDATE Ad SET Email=:email, PhoneNumber=:phonenumber, Price=:price, Available=:available, ForSaleBy=:forsaleby, Title=:title, AdDesc=:addesc, Addr=:addr, Category=:category, SubCategory=:subcategory, Province=:province, City=:city WHERE Id=:id");
          
          
          //$number = 0;
          // Prepare statement
          $stmt->bindParam(':id', $_GET["id"]);

          $stmt->bindParam(':email', $_POST["email"]);
          $stmt->bindParam(':phonenumber', $_POST["phonenumber"]);
          $stmt->bindParam(':price', floatval($_POST["price"]));
          $stmt->bindParam(':available', $_POST["available"]);
          $stmt->bindParam(':forsaleby', $_POST["forsaleby"]);
          $stmt->bindParam(':title', $_POST["title"]);
          $stmt->bindParam(':addesc', $_POST["addesc"]);
          $stmt->bindParam(':addr', $_POST["addr"]);
          $stmt->bindParam(':category', $_POST["category"]);
          $stmt->bindParam(':subcategory', $_POST[$_POST["category"] . "-subcategory"]);
          $stmt->bindParam(':province', $_POST["province"]);
          $stmt->bindParam(':city', $_POST[$_POST["province"] . "-city"]);

          //print_r(var_dump($_POST));
          
          // execute the query
          $result = $stmt->execute();
      
          if($result) {
            $showform = false;
            echo "<h1> New AD edited! </h1> <br>";
            echo "<script> window.location.href='/viewad.php?id=" . $_GET["id"] ."' </script>";
          }
      
      } catch (PDOException $e) {
          // $error =  array('error' => $e->getMessage());
          // echo json_encode($error);
          echo "<h1> Error editing AD </h1>";
          print_r(var_dump($_POST));
      }
      
      
      $conn = null;
      return;
    }
    ?>


    <?  
    
    if($showform) {
      echo "<form class='ad-form' action='editad.php?id=" . $_GET["id"] ."' method='post'>
              <h2> Edit Advertisment </h2>
              <div> Title: <input required name='title' type='text' value='" . $ad["Title"] . "' /></div> <br>
              <div> Description: <input required name='addesc' type='textarea' value='" . $ad["AdDesc"] . "' /></div> <br>
              <div> Price: <input required name='price' type='number' step='0.01' value='" . $ad["Price"] . "' /></div> <br>";

              if($ad["Available"] == "ONLINE") {
                echo "<div> Available: <select required name='available'> <option selected='selected' value='ONLINE'> Online </option> <option value='IN STORE'> In Store </option> </select> </div> <br>";
              } else {
                echo "<div> Available: <select required name='available'> <option value='ONLINE'> Online </option> <option selected='selected' value='IN STORE'> In Store </option> </select> </div> <br>";
              }

              if($ad["ForSaleBy"] == "OWNER") {
                echo "<div> For Sale by: <select required name='forsaleby' > <option selected='selected' value='OWNER'> Owner </option> <option value='BUSINESS'> Business </option> </select> </select> </div> <br>";
              } else {
                echo "<div> For Sale by: <select required name='forsaleby' > <option value='OWNER'> Owner </option> <option selected='selected' value='BUSINESS'> Business </option> </select> </select> </div> <br>";
              }
              
              

              echo "<div>";
              echo "Category: ";
        
              categoryDropdown($categories,$subcategories,$ad["Category"],$ad["SubCategory"]);
        
              echo "</div>";
        
              echo "<div>";
              echo "Province: ";
        
              locationDropdown($provinces,$cities,$ad["Province"],$ad["City"]);
        
              echo "</div>";


              echo "<hr>
              <h3> Contact Info </h3>
              <div> Email: <input required name='email' type='email' value='" . $ad["Email"] . "' /> </div> <br>
              <div> Phone Number: <input required name='phonenumber' type='text' value='" . $ad["PhoneNumber"] . "' /> </div> <br>
              <div> Address: <input required name='addr' type='text' value='" . $ad["Addr"] . "' /> </div> <br>
              ";
      
      

      echo "<button type='submit' > EDIT </button>
            </form>";
     } ?>  


    <?

    echo "<script>";
    echo " var city = '" . $ad["City"] . "'; ";
    echo " var subcategory = '" . $ad["SubCategory"] . "';";
    echo "</script>";

    ?>



    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="locationDropdown.js" type="text/javascript"> </script>
    <script src="categoryDropdown.js" type="text/javascript"> </script>
  </body>
</html>

