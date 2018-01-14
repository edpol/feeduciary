
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
};
