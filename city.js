$(function() {
	$("#city").on("keyup", function(){
		var value = String($("#city").val());

		//User must type at least 2 or more charachters before auto-suggest kicks-in
		if (value.length > 1) {
				$.ajax({
				url: "city.php",
				type: "POST",
				data: {
					city: value 
				},
				dataType: "json",
				success: function(json) {
					$("#suggestion-box").show();
					var addOn = $("<ul></ul>");
					//Loop through results
					for (i = 0; i < json.length; i++) {
						var li = $("<li>" + json[i]['name'] + ", " + json[i]['state'] + "</li>");
						li.data("city_id", json[i]['city_id']);
						//On-click functionality assigned to li
						//And weather displayed
						li.on("click", function() {
							var identifier = $(this).data("city_id");
							$("#display").empty();
							//Request to API
							$.getJSON(weather.makeURL("current", identifier), function(data) {
								var name = $("<h3>" + data.name + "</h3>");
								$("#display").append(name);
								var temp = weather.kelvin(data.main.temp);
								$("#display").append("<h5>" + temp + "&deg; F</h5>");
								var conditions = $("<h6>" + data.weather[0].description + "</h6>");
								$("#display").append(conditions);
							});
							//Hide suggestions after user clicks city
							$("#suggestion-box").hide();
							$("#city").val("");
						}); // end of on-click
						$(addOn).append(li);	
					} // end of for loop
					$("#suggestion-box").html(addOn);
				},
				error: function(xhr, status, thrown) {
					console.log("Error: " + thrown);
					console.log("Status: " + status);
					console.log(xhr);
				},
				complete: function() {
					console.log("ajax complete");
				}
			}); // end of ajax
		} else {
			//if user deletes input, hide the suggestion box
			$("#suggestion-box").hide();
		}
	}); // end of on key up action

	//When body clicked, hide suggestion box and clear search
	$("body").on("click", function(){
		$("#suggestion-box").hide();
		$("#city").val("");
	});

	var weather = {
			//Enter your own API key here
		key: "YOUR OWN API KEY GOES HERE",

		url: {
			//Gives the week's weather
			forecast: "http://api.openweathermap.org/data/2.5/forecast/daily",

			//Gives today's weather
			current: "http://api.openweathermap.org/data/2.5/weather"
		},

		makeURL: function(type, city_id) {
			return this.url[type] + "?id=" + city_id + "&APPID=" + this.key;
		},

		kelvin: function(n) {
			return Math.round(n * (9/5) - 459.67);
		}
	};	
}); // end of ready