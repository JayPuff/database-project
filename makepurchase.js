"use strict";

(function() {
    window.rate = function() {
        window.location.href = '/rating.php?id=' + id + '&rating=' + $("#rating").val();
    }

})();