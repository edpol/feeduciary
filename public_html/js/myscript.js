
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

function popup(){
    console.log("infoPopup");
    window.open("/ratesInfo", "_blank", "toolbar=no,scrollbars=no,resizable=yes,top=500,left=500,width=400,height=400"); 
    return false;
}

function prepareInfoHandler() {
    infoPopup = document.getElementById("popup");
    if (infoPopup!==null) {
        infoPopup.setAttribute('onclick', "return false;");
        infoPopup.addEventListener("click",popup);
    } else {
        console.log("did not find id popup");
    }
}


window.onload = function () {
    greyout();
    prepareInfoHandler();
};
