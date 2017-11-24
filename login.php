<?php include 'config.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Login  </title>
  </head>
  <body>
    <?php
      $showform = true;
      $registered = false;

      if(isset($_POST["username"]) && isset($_POST["pass"])) {
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      
          $stmt = $conn->prepare("INSERT INTO User (Username,Pass,Firstname,Lastname,Membership,Province,City) VALUES (:username, :pass, :firstname, :lastname, :membership, :province, :city)");
          
          $nick = "nick";
          $number = 0;
          // Prepare statement
          $stmt->bindParam(':username', $_POST["username"]);
          $stmt->bindParam(':pass', $_POST["pass"]);
          $stmt->bindParam(':firstname', $nick);
          $stmt->bindParam(':lastname', $nick);
          $stmt->bindParam(':membership', $number);
          $stmt->bindParam(':province', $nick);
          $stmt->bindParam(':city', $nick);

          
          
          // execute the query
          $result = $stmt->execute();
      
          if($result) {
            $showform = false;
            $registered = true;
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


    <?  if($showform) { 

     echo "<form action='login.php' method='post'>
        <input name='username' type='text'/>
        <input name='pass' type='password'>
        <button type='submit'> REGISTER </button>
          </form>";
     } ?>  





    
    <!-- <script type="text/javascript" src="libs/jquery/jquery-3.2.1.min.js"></script> -->
    <script src="index.js" type="text/javascript"> </script>
  </body>
</html>

