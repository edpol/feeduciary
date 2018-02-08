
function greyout() {
    // if the href is this page, grey it out
    var x = document.getElementsByClassName("nav-link");
    for (i=0; i<x.length; i++) {
        if (location.pathname==x[i].getAttribute("href")) {
             x[i].classList.add("disabled");
             x[i].setAttribute("href","#");                
        }
    }
}

/*
 *    setup listeners on class blue, pink and admin
 */
function buttonSetup (button) {

    function makeItHappenDown(x,buttonDown) {
        return function(){
            x.className=buttonDown;
        }
    }
    function makeItHappenUp(x,buttonUp) {
        return function(){
            x.className=buttonUp;
        }
    }

    if (document.getElementsByClassName(button+"_up")) {
        var a = document.getElementsByClassName(button+"_up");
        var x;
        for (var i = 0; i < a.length; ++i) {
            x = a[i];
            x.addEventListener("mousedown", makeItHappenDown(x,button+"_down"), false);
            x.addEventListener("mouseup",   makeItHappenUp(x,button+"_up"), false);
        }
    }
}

    function numbersonly(e) {
        var unicode=e.charCode? e.charCode : e.keyCode;
        if  (unicode!=8 && unicode!=9) { //if the key isn't the backspace key or TAB (which we should allow)
            if (unicode<48||unicode>57) return false;//if not a number return false //disable key press
        }
    } 

function comma(){
    var investment = document.getElementById("investment");

    if (investment !== null && investment !== undefined) {
        investment.addEventListener("keyup", function(event) {
            noCommas = investment.value.replace(/\D/g, '');
            newValue = noCommas;
            if (noCommas.length>0) newValue = "$ " + noCommas;
            console.log("no Commas: " + noCommas); 
            if (noCommas.length > 3) { 
                newValue = "";
                while (noCommas.length>3) {
                    // 1,234,567,890
                    last3 = noCommas.slice(-3,noCommas.length); 
                    noCommas = noCommas.slice(0,-3);
                    newValue = "," + last3 + newValue;
                console.log("noCommas: " + noCommas + " - last3: " + last3 );
                }
                newValue = noCommas + newValue;
                console.log("newValue: " + newValue);
                newValue = "$ " + newValue;
            }
                investment.value = newValue;

            if (event.key === "Enter") {
                // Do work
              document.forms[0].submit();
            }
        });
    }
}

/*
 *      Display number for slider
 *
 *      so this:
 *          object.oninput = handler;   
 *      is the same as this:
 *          object.addEventListener ("input", handler, useCapture)
 *
 */
function slider(){
    var slider = document.getElementById("myRange");
    var output = document.getElementById("displayDistance");

    if (output !== null && output !== undefined) {
        output.innerHTML = slider.value;

        slider.oninput = function() { 
            output.innerHTML = this.value;
        }
        slider.onchange = function() {
            window.location.href = "/advisors/range/" + this.value;
        }
    }
}

window.onload = function () {
    greyout();
    buttonSetup("del");
    slider();
    comma();
};
