"use strict";

(function() {
    TweenLite.to($('body'),10,{
        backgroundColor: 'blue',
        ease: Elastic                
    });


    // lodash / underscore tests:
    

    // **************************
    // Simple log of element values:
    // **************************

    var array = [1,2,3,4,5,6,7];
    var objects = [{name:"bob"},{name:"nick"}];

    // _.forEach(array,function(value) {
    //     console.log(value);
    // })

    // for(var i in array) {
    //     console.log(array[i]);
    // }


    // **************************
    // Keep an array of only odds
    // **************************
    // var newArray = [];
    // for(var i in array) {
    //     if(!(array[i] % 2 == 0)) {
    //         newArray.push(array[i]);
    //     } 
    // }

    // console.log(newArray);

    // var newArray = _.filter(array, function(o) {
    //     return !(o % 2 == 0);
    // });
    // console.log(newArray);

    // **************************
    // mapping (works on arrays too)
    // **************************
    var newArray = objects.map(function(o) {
        return Object.assign({},o,{greeting: "Hey " + o.name});
    });

    
    var newArray = _.map(objects,function(o) {
        return Object.assign({},o,{greeting: "Hey " + o.name});
    });

    console.log(objects,newArray);

    // **************************
    // dropping (works on arrays too)
    // **************************

    // var droppedArray = _.drop(array,2);
    // console.log(array,droppedArray);

    // // **************************
    // // dropping while //Stops dropping when condition met
    // // **************************

    // var droppedArray = _.dropWhile(array, function(o) { return !(o % 2 == 0); })

    // console.log(array,droppedArray);


    // Fetch uses GET by default!
    // Fetch does not catch HTTP error codes!
    // json parse myself?
    fetch('/session').then(function( response ) {
        if(!response.ok) {
            throw new Error("My error!");
        } else {
            return response.json();
        }
    }).then(json => {
        console.log(json);
    }).catch(err => {
        console.log('Error with JSON parse', err);
    })
    
})();

