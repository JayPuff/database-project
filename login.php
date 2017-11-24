<?php include 'config.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Register  </title>
  </head>
  <body>
    <?php
    $showform = true;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    if(isset($_POST["username"]) && isset($_POST["pass"])) {
         
        try {
            
          $stmt = $conn->prepare("SELECT * FROM User WHERE Username= :username AND Pass= :pass");
          
          // Prepare statement
          $stmt->bindParam(':username', $_POST["username"]);
          $stmt->bindParam(':pass', $_POST["pass"]);

          
          
          // execute the query
          $stmt->execute();

          

          $stmt->setFetchMode(PDO::FETCH_ASSOC);

          $results = $stmt->fetchAll();
          
          $count = 0;
          for($i = 0; $i < count($results); $i++) {
            $count = 1;
         }

          if($count==0)
          {
            echo "<h1> Error logging in, please try again! </h1>";
          }
          else
          {
            $showform = false;
            echo "<h1> Logged in successfully! </h1>";
          }
          
      
      } catch (PDOException $e) {
           $error =  array('error' => $e->getMessage());
           echo json_encode($error);

      }
      
      
      $conn = null;
    }

    if($showform) {
        echo "<form action='login.php' method='post'>
                <h2> Login Form </h2>
                <div> Username: <input required name='username' type='text'/> </div> <br>
                <div> Password: <input required name='pass' type='password'> </div> <br>";
        
        

        echo "<button type='submit' > LOGIN </button>
            </form>";
    }

    ?>





    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="index.js" type="text/javascript"> </script>
  </body>
</html>

