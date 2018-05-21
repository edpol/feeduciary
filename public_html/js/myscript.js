
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

function addCommas(target) {
    target.addEventListener("keyup", function(event) {
        noCommas = target.value.replace(/\D/g, '');
        num = Number(noCommas);
        noCommas = num.toString();
        newValue = noCommas;
        if (noCommas.length>0) newValue = "$ " + noCommas;
        if (noCommas.length > 3) { 
            newValue = "";
            while (noCommas.length>3) {
                // 1,234,567,890
                last3 = noCommas.slice(-3,noCommas.length); 
                noCommas = noCommas.slice(0,-3);
                newValue = "," + last3 + newValue;
            }
            newValue = noCommas + newValue;
            newValue = "$ " + newValue;
        }
        target.value = newValue;

        if (event.key === "Enter") {
            document.forms[0].submit();
        }
    });
}
function comma(){
    var comma = document.getElementsByClassName("comma");
    if (comma !== null && comma !== undefined) {
        for (var i=0; i<comma.length; i++) {
console.log("hello");
            addCommas(comma[i]);
        }
    }
}


/* I lose original formatting */
function formatPhone(target) {
    target.addEventListener('input', function (e) {
      var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
      e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
}
function phone(){
    var phone = document.getElementsByClassName("phone");
    if (phone !== null && phone !== undefined) {
        for (var i=0; i<phone.length; i++) {
            formatPhone(phone[i]);
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
function numberWithCommas(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}

function slider() {
    var slider = document.getElementById("myRange");
    var output = document.getElementById("displayDistance");
    if (output !== null && output !== undefined) {
        output.innerHTML = numberWithCommas(slider.value);

        slider.oninput = function() { 
            output.innerHTML = numberWithCommas(this.value);
        }
        slider.onchange = function() {
            window.location.href = "/advisors/range/" + this.value;
        }
    }
}

function feeSlider() {
    var slider = document.getElementById("myFee");
    var output = document.getElementById("displayFee");
    if (output !== null && output !== undefined) {
console.log(slider.value);
        output.innerHTML = numberWithCommas(slider.value);

        slider.oninput = function() { 
            output.innerHTML = numberWithCommas(this.value);
        }
        slider.onchange = function() {
            window.location.href = "/advisors/feeRange/" + this.value;
        }
    }
}

function chooseFile() {
    document.getElementById("fileUpload").click();
}

window.onload = function () {
    greyout();
    buttonSetup("del");
    slider();
    feeSlider();
    comma();
    phone();
};
