"use strict";

(function() {
    window.back = function() {
        window.location.href = "/userpage.php";
    }

    window.approve = function(id) {
        window.location.href = "/confirmrequest.php?type=APPROVE&id=" + id;
    }

    window.reject = function(id) {
        window.location.href = "/confirmrequest.php?type=REJECT&id=" + id;
    }

})();