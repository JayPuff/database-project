"use strict";

(function() {
    var $province = $('#province');

    $province.on('change',function() {
        console.log(this.value);
        $('.city-dropdown').attr("hidden","true");
        $('.city-dropdown').addClass("form-hidden");

        var $cityDD = $('.' + this.value + '-dropdown'); 

        $cityDD.removeAttr('hidden');
        $cityDD.removeClass('form-hidden');
    })


    if(city) {
        $('.city-dropdown').each(function() {
            if(this.value == city) {
                console.log(this.value);
                $(this).removeAttr('hidden');
                $(this).removeClass('form-hidden');
            }
        });
    }
    
})();

