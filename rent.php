<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Rent a Store  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, only members can rent Stores! </h1> </div>';
            return;
        }
    ?>
    <?php
      $showform = true;
      $locations;


      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $conn->prepare("SELECT * FROM Sl"); 
      $stmt->execute();
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $locations = $stmt->fetchAll();



      if(isset($_POST["requesteddate"]) && isset($_POST["requestedtime"]) && isset($_POST["duration"]) && isset($_POST["delivery"]) && isset($_POST["location"]) ) {
       
        
        // VALIDATE TIME
       $showform = false;

       echo "<script>";
       echo "window.location.href = '/purchase.php?type=store&requesteddate="  . $_POST["requesteddate"] . '&requestedtime=' . $_POST["requestedtime"]  . "&duration=" . $_POST["duration"]  . "&delivery=" . $_POST["delivery"]  . "&location=" . $_POST["location"]  . "';";
       echo "</script>";


       return;
      }
    ?>


    <?  
    
    if($showform) {
      echo "<form class='ad-form' action='rent.php' method='post'>
              <h2> Rent Physical Store Request </h2>
              <div> Requested Date: <input placeholder='2017-11-24' required name='requesteddate' type='text'/> </div> <br>
              <div> Requested Time: <input required name='requestedtime' type='number'> </div> <br>
              <div> Duration: <input required name='duration' type='number' > </div> <br>
              <div> Delivery: <select required name='delivery'> <option value='T'> Yes </option> <option value='F'> No </option> </select> </div> <br>";

              
              echo "Location: ";
              echo "<select required id='location' name='location' type='text'>";
              
              echo "<option value=''> </option>";

              for($i = 0; $i < count($locations); $i++) {
                echo "<option value='" . $locations[$i]["SlName"]  . "'>" . $locations[$i]["SlName"]  . "</option>";
              }
              
              echo "&nbsp;";
              echo "</select>";
      
      

      echo "<button type='submit' > REQUEST </button>
            </form>";
     } ?>  





    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
  </body>
</html>

