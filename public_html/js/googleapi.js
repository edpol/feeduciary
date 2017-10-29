    // Google asks for all API users to sign up for an API key
    // For simple tests, still works without an API key
    var api = 'http://maps.googleapis.com/maps/api/geocode/json';
    console.log ("Initial Load...");

console.log(encodeURIComponent("1421 Adams St Hollywood FL 33020"));
console.log(encodeURI("1421 Adams St Hollywood FL 33020"));

    function findLocation() {
        console.log("findLocation...");
        var zipcode = document.getElementById('zipcode');
        var url = api + '?address=' + zipcode.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, false);
        xhr.onreadystatechange = function () {
            if(xhr.readyState < 4) {
                showLoading();
            }
            if(xhr.readyState == 4 && xhr.status == 200) {
			    console.log(xhr.responseText);
                outputLocation(xhr.responseText);
            }
        };
        xhr.send();
    }

    function showLoading() {
        console.log("Loading...");
        var target = document.getElementById('location');
        target.innerHTML = 'Loading...';
    }

    function outputLocation(data) {
        console.log("outputLocation...");
        var target = document.getElementById('location');
        var json = JSON.parse(data);
        var address = json.results[0].formatted_address;
        target.innerHTML = address;
		console.log("Latitude:  " + json.results[0].geometry.location.lat);
		console.log("Longitude: " + json.results[0].geometry.location.lng);

        var lat = document.createElement("input");
        lat.setAttribute("type", "hidden");
        lat.setAttribute("name", "lat");
        lat.setAttribute("value", json.results[0].geometry.location.lat);
        target.appendChild(lat);

        var lng = document.createElement("input");
        lng.setAttribute("type", "hidden");
        lng.setAttribute("name", "lng");
        lng.setAttribute("value", json.results[0].geometry.location.lng);
        target.appendChild(lng);

    }

    // button is not type submit so we look for click event
    var button = document.getElementById("calculateFee");
    button.addEventListener("click", function(event) {
        // I don't think we need this line
        event.preventDefault();
        findLocation();
		// submit form with id form1
		document.forms["form1"].submit();
    });
