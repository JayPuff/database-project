"use strict";

(function() {
    window.logout = function() {
        window.location.href = "/logout.php";
    }

    window.viewMyAds = function() {
        window.location.href = "/userpage.php?myads=true";
    }

    window.viewAllAds = function() {
        window.location.href = "/userpage.php";
    }

    window.rent = function() {
        window.location.href = "/rent.php";
    }

    window.purchaseDetails = function() {
        window.location.href = "/purchasedetails.php";
    }

    window.membership = function() {
        window.location.href = "/purchase.php?type=membership";
    }

    window.requests = function() {
        window.location.href = "/requests.php";
    }

    window.newAd = function() {
        window.location.href = "/newad.php";
    }

    window.filter = function() {
        var $province = $('#province');
        var province = "";

        if($province && $province[0] && $province[0].value) {
            province = $province[0].value;
        }

        var city = "";
        if(province != "") {
            var $city = $('.' + province + '-dropdown');
            if($city && $city[0] && $city[0].value) {
                city = $city[0].value;
            }
        }
        
        var category = "";
        var $category = $("#category");

        if($category && $category[0] && $category[0].value) {
            category = $category[0].value;
        }


        var seller = "";
        var $seller = $("#seller");

        if($seller && $seller[0] && $seller[0].value) {
            seller = $seller[0].value;
        }
        

        window.location.href = "/userpage.php?province=" + province + "&city=" + city + "&category=" + category + "&seller=" + seller;
    }
})();