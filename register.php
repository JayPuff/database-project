<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Register  </title>
  </head>
  <body>
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



      if(isset($_POST["username"]) && isset($_POST["pass"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["province"]) && isset($_POST["city"])) {
        try {
          $stmt = $conn->prepare("INSERT INTO User (Username,Pass,Firstname,Lastname,Membership,Province,City) VALUES (:username, :pass, :firstname, :lastname, :membership, :province, :city)");
          
          $number = 0;
          // Prepare statement
          $stmt->bindParam(':username', $_POST["username"]);
          $stmt->bindParam(':pass', $_POST["pass"]);
          $stmt->bindParam(':firstname', $_POST["firstname"]);
          $stmt->bindParam(':lastname', $_POST["lastname"]);
          $stmt->bindParam(':membership', $number);
          $stmt->bindParam(':province', $_POST["province"]);
          $stmt->bindParam(':city', $_POST["city"]);

          
          
          // execute the query
          $result = $stmt->execute();
      
          if($result) {
            $showform = false;
            echo "<h1> Registered successfully! </h1>";
          }
      
      } catch (PDOException $e) {
          // $error =  array('error' => $e->getMessage());
          // echo json_encode($error);
      }
      
      
      $conn = null;
      return;
    }
    ?>


    <?  
    
    if($showform) {
      echo "<form action='register.php' method='post'>
              <h2> Register Form </h2>
              <div> Username: <input required name='username' type='text'/> </div> <br>
              <div> Password: <input required name='pass' type='password'> </div> <br>
              <div> Firstname: <input required name='firstname' type='text'> </div> <br>
              <div> Lastname: <input required name='lastname' type='text'> </div> <br>";
      
      echo "<div>";
      echo "Province: ";

      locationDropdown($provinces,$cities);

      echo "</div>";

      echo "<button type='submit' > REGISTER </button>
            </form>";
     } ?>  





    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="locationDropdown.js" type="text/javascript"> </script>
  </body>
</html>

