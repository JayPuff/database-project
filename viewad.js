"use strict";

(function() {
    window.deleteAd = function() {
        window.location.href = "/deletead.php";
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
})();