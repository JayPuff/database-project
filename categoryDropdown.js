"use strict";

(function() {
    var $category = $('#category');
    
        $category.on('change',function() {
            console.log(this.value);
            $('.subcategory-dropdown').attr("hidden","true");
            $('.subcategory-dropdown').addClass("form-hidden");
    
            var $subCategoryDD = $('.' + this.value + '-dropdown'); 
    
            $subCategoryDD.removeAttr('hidden');
            $subCategoryDD.removeClass('form-hidden');
        })
})();

