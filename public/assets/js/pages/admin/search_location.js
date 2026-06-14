const componentForm = {
    locality: "long_name",
    country: "long_name",
};
const cityComponentForm = {
    locality: "long_name",
};
const countryComponentForm = {
    country: "long_name",
};
const postcodeComponentForm = {
    postal_town: "long_name",
    postal_code: "long_name",
};

function initmap() {
    var inputs = document.getElementsByClassName('address');

    var options = {
        // types: ['geocode'],
        /*componentRestrictions: {country: 'ch'}*/ // Specific country
    };

    var autocompletes = [];
    for (var i = 0; i < inputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(inputs[i], options);
        autocomplete.inputId = inputs[i];
        autocomplete.addListener('place_changed', fillIn);
        autocompletes.push(autocomplete);

        inputs[i].addEventListener('keyup', function () {
            var _parent = $(this).closest('.location-group');
            $(_parent).find('.location, .latitude, .longitude, .country, .postcode, .city').val("");
        });
    }
}
function fillIn() {
    var _parent = $(this.inputId).closest('.location-group');
    var place = this.getPlace();

    console.log(place.address_components)

    var location = [], city = [], country = [], postcode = [];
    // Get each component of the address from the place details, and then fill-in the corresponding field on the form.
    for (const component of place.address_components) {
        component.types.forEach(element => {
            if (typeof componentForm[element] !== "undefined" && typeof component[componentForm[element]] !== "undefined") {
                location.push(component[componentForm[element]]);
            }
            if (typeof cityComponentForm[element] !== "undefined" && typeof component[cityComponentForm[element]] !== "undefined") {
                city.push(component[cityComponentForm[element]]);
            }
            if (typeof countryComponentForm[element] !== "undefined" && typeof component[countryComponentForm[element]] !== "undefined") {
                country.push(component[countryComponentForm[element]]);
            }
            if (typeof postcodeComponentForm[element] !== "undefined" && typeof component[postcodeComponentForm[element]] !== "undefined") {
                postcode.push(component[postcodeComponentForm[element]]);
            }
        });
        location = location.filter(function (item, pos) {
            return location.indexOf(item) == pos;
        });
        city = city.filter(function (item, pos) {
            return city.indexOf(item) == pos;
        });
        country = country.filter(function (item, pos) {
            return country.indexOf(item) == pos;
        });
        postcode = postcode.filter(function (item, pos) {
            return postcode.indexOf(item) == pos;
        });
    }

    $(_parent).find('.location').val(location.join(', '));
    $(_parent).find('.latitude').val(place.geometry.location.lat());
    $(_parent).find('.longitude').val(place.geometry.location.lng());
    $(_parent).find('.city').val(city.join(', '));
    $(_parent).find('.postcode').val(postcode.join(', '));
    $(_parent).find('.country').val(country.join(', '));
    $(_parent).find('.address').trigger('blur');

    $('#location').val(location.join(', ')).blur();
    $('#latitude').val(place.geometry.location.lat());
    $('#longitude').val(place.geometry.location.lng());
    $('#city').val(city.join(', ')).blur();
    $('#postcode').val(postcode.join(', ')).blur();
    $('#address').trigger('blur');
}

if (!!window.initmap) {
    initmap();
}