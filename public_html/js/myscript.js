
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



window.onload = function () {
    greyout();
    buttonSetup("del");
};
