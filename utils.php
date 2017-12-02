<?php

function categoryDropdown($categories,$subcategories) {
    echo "<select required id='category' name='category' type='text'>";
    
    echo "<option value=''> </option>";
    for($i = 0; $i < count($categories); $i++) {
    echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
    }
    
    echo "&nbsp;";
    echo "</select>";

    for($i = 0; $i < count($categories); $i++) {
        echo "<select hidden='true' class='form-hidden subcategory-dropdown " . $categories[$i]["CategoryName"]  .  "-dropdown' name='subcategory' type='text'>";
        for($j = 0; $j < count($subcategories); $j++) {
          if($categories[$i]["CategoryName"] == $subcategories[$j]["CategoryName"]) {
            echo "<option value='" . $subcategories[$j]["SubCategoryName"] .  "' >";
              echo $subcategories[$j]["SubCategoryName"];
            echo "</option>";
          }
        }
        echo "</select>";
      }
}



function locationDropdown($provinces,$cities) {
    echo "<select required id='province' name='province' type='text'>";
    
    echo "<option value=''> </option>";
    for($i = 0; $i < count($provinces); $i++) {
    echo "<option value='" . $provinces[$i]["province_name"]  . "'>" . str_replace("-"," ",$provinces[$i]["province_name"])  . "</option>";
    }
    
    echo "&nbsp;";
    echo "</select>";

    for($i = 0; $i < count($provinces); $i++) {
        echo "<select hidden='true' class='form-hidden city-dropdown " . $provinces[$i]["province_name"]  .  "-dropdown' name='city' type='text'>";
        for($j = 0; $j < count($cities); $j++) {
          if($provinces[$i]["province_name"] == $cities[$j]["province_name"]) {
            echo "<option value='" . $cities[$j]["city_name"] .  "' >";
              echo $cities[$j]["city_name"];
            echo "</option>";
          }
        }
        echo "</select>";
      }
}



function displayAds($ads,$mode = "NORMAL") {
    if($mode == "NORMAL") {
        for($i = 0; $i < count($ads); $i++) {
            echo "<div onclick='alert(" . "\"" . $ads[$i]["Id"]  . "\"" . ");'" . "class='ad'><h2>" . $ads[$i]["Title"] . '</h2>';
            echo "<p>"  . $ads[$i]["AdDesc"] .  "</p>";
            echo "<p>" . $ads[$i]["Posted"] . "</p>";
            echo "</div>";
        }
    }
}


?>