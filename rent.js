(function() {

    setInterval(calculatePrice,100);

    
    function calculatePrice() {
        var duration = $("#duration").val() || 0;
        var delivery = $("#delivery").val() || 'F';
        var location = $("#location").val() || 'SL-1';
        var date = $("#requesteddate").val() || 'SL-1';

        var weekend = false;

        var myDate = new Date();
        myDate.setFullYear(date.split('-')[0]);
        myDate.setMonth(parseInt(date.split('-')[1]) - 1);
        myDate.setDate(parseInt(date.split('-')[2]));


        
        if(myDate.getDay() == 6 || myDate.getDay() == 0) {
            weekend = true;   
        }

        var locationCost = 0;
        if(location == "SL-1") {
            locationCost = 1.2;
        } else if (location == "SL-2") {
            locationCost = 1.15;
        } else if (location == "SL-3") {
            locationCost = 1.1;
        } else if (location == "SL-4") {
            locationCost = 1.05;
        } 

        var deliveryCost = 0;
        if(delivery == "T") {
            deliveryCost =  ((weekend) ? 10 : 5) * duration;
        }


        var durationCost = 0;
        durationCost = parseInt(duration) * ((weekend) ? 15 : 10);


        var totalCost = parseInt(durationCost * locationCost) + deliveryCost;

        $('#cost').html(totalCost);
    }


})();