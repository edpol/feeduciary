
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

window.onload = function () {
    greyout();
};
