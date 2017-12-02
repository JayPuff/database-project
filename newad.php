<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  New Ad  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, only members can create new Ads! </h1> </div>';
            return;
        }
    ?>
    <?php
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



      if(isset($_POST["title"]) && isset($_POST["addesc"]) && isset($_POST["price"]) && isset($_POST["available"]) && isset($_POST["forsaleby"]) && isset($_POST["province"]) && isset($_POST["city"]) && isset($_POST["subcategory"]) && isset($_POST["category"]) && isset($_POST["email"]) && isset($_POST["addr"]) && isset($_POST["phonenumber"]) ) {
       
        

        try {
          $stmt = $conn->prepare("INSERT INTO Ad VALUES (0, :username, :email, :phonenumber, :price, :available, :forsaleby, :title, :addesc, :addr, :category, :subcategory, :province, :city, CURDATE(), 'F', 0)");
          
          //$number = 0;
          // Prepare statement
          $stmt->bindParam(':username', $_SESSION["Username"]);
          $stmt->bindParam(':email', $_POST["email"]);
          $stmt->bindParam(':phonenumber', $_POST["phonenumber"]);
          $stmt->bindParam(':price', floatval($_POST["price"]));
          $stmt->bindParam(':available', $_POST["available"]);
          $stmt->bindParam(':forsaleby', $_POST["forsaleby"]);
          $stmt->bindParam(':title', $_POST["title"]);
          $stmt->bindParam(':addesc', $_POST["addesc"]);
          $stmt->bindParam(':addr', $_POST["addr"]);
          $stmt->bindParam(':category', $_POST["category"]);
          $stmt->bindParam(':subcategory', $_POST["subcategory"]);
          $stmt->bindParam(':province', $_POST["province"]);
          $stmt->bindParam(':city', $_POST["city"]);

          
          
          // execute the query
          $result = $stmt->execute();
      
          if($result) {
            $showform = false;
            echo "<h1> New AD created! </h1> <br>";
            echo "<button type='button' onclick='window.location.href=" . '"' . "/userpage.php?myads=true"  . '"' . "'> View My Ads </button>";
          }
      
      } catch (PDOException $e) {
          // $error =  array('error' => $e->getMessage());
          // echo json_encode($error);
          echo "<h1> Error creating AD </h1>";
          print_r(var_dump($_POST));
      }
      
      
      $conn = null;
      return;
    }
    ?>


    <?  
    
    if($showform) {
      echo "<form class='ad-form' action='newad.php' method='post'>
              <h2> New Advertisment </h2>
              <div> Title: <input required name='title' type='text'/> </div> <br>
              <div> Description: <input required name='addesc' type='textarea'> </div> <br>
              <div> Price: <input required name='price' type='number' step='0.01'> </div> <br>
              <div> Available: <select required name='available'> <option value='ONLINE'> Online </option> <option value='IN STORE'> In Store </option> </select> </div> <br>
              <div> For Sale by: <select required name='forsaleby' > <option value='OWNER'> Owner </option> <option value='BUSINESS'> Business </option> </select> </select> </div> <br>";

              echo "<div>";
              echo "Category: ";
        
              categoryDropdown($categories,$subcategories);
        
              echo "</div>";
        
              echo "<div>";
              echo "Province: ";
        
              locationDropdown($provinces,$cities);
        
              echo "</div>";


              echo "<hr>
              <h3> Contact Info </h3>
              <div> Email: <input required name='email' type='email'/> </div> <br>
              <div> Phone Number: <input required name='phonenumber' type='text'/> </div> <br>
              <div> Address: <input required name='addr' type='text'/> </div> <br>
              ";
      
      

      echo "<button type='submit' > CREATE </button>
            </form>";
     } ?>  





    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="locationDropdown.js" type="text/javascript"> </script>
    <script src="categoryDropdown.js" type="text/javascript"> </script>
  </body>
</html>

