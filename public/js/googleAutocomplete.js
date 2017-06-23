google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
	var input = document.getElementById('em-location');

	var autocomplete = new google.maps.places.Autocomplete(input);

	autocomplete.addListener('place_changed', function () {

		var place = autocomplete.getPlace();

		//set input value
		input.value = place.formatted_address;
	});
}