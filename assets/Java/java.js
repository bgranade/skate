$(function () {
    $("#the_select").change(function () {
        if (this.value != '') {

            var dropdownSelect = document.getElementById("the_select");
            var parkAddress = dropdownSelect.options[dropdownSelect.selectedIndex].text;
            var latlong = this.value.split(",");

            $.ajax({
                url: "https://cors-anywhere.herokuapp.com/http://tomtom.technology-minds.com/weather_api_request.php",
                type: 'GET',
                data: {
                    'lat': latlong[0],
                    'long': latlong[1],
                },

                success: function (data) {
                    $("#temperature").html('');
                    $("#temperature").html(data);
                },
                error: function (request, error) {
                    //alert("Request: "+JSON.stringify(request));
                }
            });

            //return false;

            document.getElementById('weathermap').innerHTML = '';
            document.getElementById('weathermap').innerHTML = "<div id='map' style='width: 500px; height: 500px;'></div>";
            var speedyPizzaCoordinates = [latlong[0], latlong[1]];
            var map = tomtom.L.map('map', {

                key: 'iZAhBvw5ckar7UniTofXBzCUvfzrPwYp',
                basePath: '/sdk',
                //source: 'vector',
                center: speedyPizzaCoordinates,
                zoom: 15

            });

            var marker = tomtom.L.marker([latlong[0], latlong[1]], {
                draggable: true
            }).bindPopup(parkAddress).addTo(map);

            // Show popup each time the marker is moved
            marker.on('dragend', function (e) {
                tomtom.reverseGeocode({ position: e.target.getLatLng() })
                    .go(function (response) {
                        if (response && response.address && response.address.freeformAddress) {
                            marker.setPopupContent(response.address.freeformAddress);
                        } else {
                            marker.setPopupContent('No results found');
                        }
                        marker.openPopup();
                    });
            });
        }
    });
});