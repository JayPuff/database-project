"use strict";

(function() {
    window.deleteAd = function() {
        //id is global
        if(confirm("Are you sure you want to delete this AD?")) {
            window.location.href = "/deletead.php?id=" + id;
        }
    }

    window.editAd = function() {
        //id is global
        window.location.href = "/editad.php?id=" + id;
    }

    window.promote = function() {
        window.location.href = "/promote.php";
    }

    window.buy = function() {
        //id is global.
        window.location.href = "/purchase.php?type=ad&id=" + id;
    }

    window.back = function() {
        window.location.href = "/userpage.php";
    }

    window.promote = function() {
        window.location.href = "/purchase.php?type=promotion&id=" + id;
    }

    window.buy = function() {
        window.location.href = "/purchase.php?type=ad&id=" + id;
    }
})();