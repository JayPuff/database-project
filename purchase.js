"use strict";

(function() {
    window.purchase = function() {
        //id is global, price, type
        console.log($('#type').val());
        console.log($('#number').val());

        

        if(type == 'MEMBERSHIP') {
            price = $('#membership').val();
            id = "";
        } else if (type == 'PROMOTION') {
            price = $('#promotion').val();
            //console.log(id);
        } else if (type == 'AD') {
            // console.log(price);
            //console.log(id);
        }

        if(type != "STORE") {
            if(confirm("Are you sure you want to confirm?")) {
                window.location.href = "/makepurchase.php?type=" + type + "&price=" + price + "&card=" + $('#type').val() + "&number=" + $('#number').val() + "&id=" + id;
            }
        } else {
            if(confirm("Are you sure you want to confirm?")) {
                window.location.href = "/makepurchase.php?type=" + type + "&requesteddate=" + requesteddate + "&requestedtime=" + requestedtime + "&location=" + loc + "&duration=" + duration + "&delivery=" + delivery + "&card=" + $('#type').val() + "&number=" + $('#number').val();
            }
        }
    }

})();