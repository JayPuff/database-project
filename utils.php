<?php

function categoryDropdown($categories,$subcategories,$selectedCategory = null, $selectedSubCategory = null) {
    echo "<select required id='category' name='category' type='text'>";
    
    echo "<option value=''> </option>";
    for($i = 0; $i < count($categories); $i++) {
      if($categories[$i]["CategoryName"] == $selectedCategory) {
        echo "<option selected='selected' value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
      } else {
        echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
      }
    }
    
    echo "&nbsp;";
    echo "</select>";

    for($i = 0; $i < count($categories); $i++) {
        echo "<select hidden='true' class='form-hidden subcategory-dropdown " . $categories[$i]["CategoryName"]  .  "-dropdown' name='". $categories[$i]["CategoryName"] . "-subcategory' type='text'>";
        for($j = 0; $j < count($subcategories); $j++) {
          if($categories[$i]["CategoryName"] == $subcategories[$j]["CategoryName"]) {
            if($subcategories[$j]["SubCategoryName"] == $selectedSubCategory) {
              echo "<option selected='selected' value='" . $subcategories[$j]["SubCategoryName"] .  "' >";
              echo $subcategories[$j]["SubCategoryName"];
              echo "</option>";
            } else {
              echo "<option value='" . $subcategories[$j]["SubCategoryName"] .  "' >";
              echo $subcategories[$j]["SubCategoryName"];
              echo "</option>";
            }
          }
        }
        echo "</select>";
      }
}



function locationDropdown($provinces,$cities,$selectedProvince = null,$selectedCity = null) {
    echo "<select required id='province' name='province' type='text'>";
    
    echo "<option value=''> </option>";
    for($i = 0; $i < count($provinces); $i++) {
      if($provinces[$i]["province_name"] == $selectedProvince) {
        echo "<option selected='selected' value='" . $provinces[$i]["province_name"]  . "'>" . str_replace("-"," ",$provinces[$i]["province_name"])  . "</option>";
      } else {
        echo "<option value='" . $provinces[$i]["province_name"]  . "'>" . str_replace("-"," ",$provinces[$i]["province_name"])  . "</option>";
      }
    }
    
    echo "&nbsp;";
    echo "</select>";

    for($i = 0; $i < count($provinces); $i++) {
        echo "<select hidden='true' class='form-hidden city-dropdown " . $provinces[$i]["province_name"]  .  "-dropdown' name='" . $provinces[$i]["province_name"] ."-city' type='text'>";
        for($j = 0; $j < count($cities); $j++) {
          if($provinces[$i]["province_name"] == $cities[$j]["province_name"]) {
            if($cities[$j]["city_name"] == $selectedCity) {
              echo "<option selected='selected' value='" . $cities[$j]["city_name"] .  "' >";
              echo $cities[$j]["city_name"];
              echo "</option>";
            } else {
              echo "<option value='" . $cities[$j]["city_name"] .  "' >";
              echo $cities[$j]["city_name"];
              echo "</option>";
            }
          }
        }
        echo "</select>";
      }
}



function displayAds($ads,$mode = "NORMAL") {
    if($mode == "NORMAL") {
        for($i = 0; $i < count($ads); $i++) {
            echo "<div onclick='window.location.href=" . "\"viewad.php?id=" . $ads[$i]["Id"]  . "\"" . ";'" . "class='ad'><h2>" . $ads[$i]["Title"] . '</h2>';
            echo "<p>"  . $ads[$i]["AdDesc"] .  "</p>";
            echo "<p>" . $ads[$i]["Posted"] . "</p>";
            echo "</div>";
        }
    }
}

function showAdRight($ad) {
  echo "<p style='color:#666666;'>" . str_replace("-"," ",$ad["Province"]) . " &gt; " . $ad["City"] . " &gt; "  . $ad["Category"] . " &gt; " . $ad["SubCategory"] . "</p>";
  echo "<h1>" . $ad["Title"] . "</h1>";
  echo "<p style='color:#424141;'>" . $ad["AdDesc"] . "</p>";
  echo "<p style='color:#9e631b; font-size:1.2em' > Price: " . $ad["Price"] . "$ </p>";

  echo "<hr> <br>";

  echo "<h3> Get in contact with " . $ad["Username"] . '</h3>';
  echo "<p> Phone number: " . $ad["PhoneNumber"] . "</p>";
  echo "<p> Email: " . $ad["Email"] . "</p>";
}


?>