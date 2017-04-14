var diveData = null;

$(document).ready(function() {

    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('.flash-message .alert-success').delay( 3000 ).slideUp( 400 );

    $("button[data-toggle=collapse]").click(function(){
        $(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
    });
    $(".btn-add").click(onAddRow);

    $('.btn-remove').click(onRowRemove);
    $('.btn-clear-result').click(clearResult);

    $('.btn-search-dive-sites').click(function(e) {

        if ($('#dive_log_country').val() === '') {

            return;
        }


        $.ajax({
        url: "/app_dev.php/map/geolocation",
        data: {
        country: $('#dive_log_country').val(),
        location: $('#dive_log_location').val(),
        range: $('#range').val()
        },
        success: function (result) {
                buildMap(result['data']);
            }
        });

    });


});

function onClickRow(key) {

    var data = diveData[key];
    $('#dive_log_diveSite').val(data['name']);
    $('#dive_log_lat').val(data['lat']);
    $('#dive_log_lng').val(data['lng']);

    var location = $('#dive_log_location').val();
    if (!location.trim()) {
        $('#dive_log_location').val(data['name']);
    }
    $("#nearest_dive_sites").remove();
}

function clearResult() {
    $('#show-dive-site-details').hide();
    $('#nearest_dive_sites').remove();
    $('#map').css('height', '0px');
    $('#dive_log_country').val('');
    $('#dive_log_location').val('');
    $('#range').val('');
    $('#dive_log_diveSite').val('');
    $('#dive_log_lat').val('');
    $('#dive_log_lng').val('');
}

function buildMap(locations) {

    $('#show-dive-site-details').show();
    $('#map').css('height', '500px');

    var latLngFirst = {lat: parseFloat(locations[0]['lat']), lng: parseFloat(locations[0]['lng'])};
    var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 12,
         center: latLngFirst
    });

    var infowindow = new google.maps.InfoWindow();

    Object.keys(locations).forEach(function(key) {

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[key]['lat'], locations[key]['lng']),
            map: map
        });

        marker.addListener('mouseover', function() {
            infowindow.setContent(locations[key]['name']);
            infowindow.open(map, this);
        });

        marker.addListener('mouseout', function() {
            infowindow.close();
        });

        google.maps.event.addListener(marker, 'click', (function(marker, key) {
            return function() {
                $('#dive_log_diveSite').val(locations[key]['name']);
                $('#dive_log_lat').val(locations[key]['lat']);
                $('#dive_log_lng').val(locations[key]['lng']);
                $('#dive_log_location').val(locations[key]['name']);
            }
        })(marker, key));
    });

}

function onRowRemove() {
    $(this).closest('.row').remove();
}

function expandDiv(collection) {
    $(collection).addClass('in').attr('aria-expanded', 'true').removeAttr('style');
}

function onAddRow() {
    var collection = $(this).closest('button').data('target');
    expandDiv(collection);

    var certificatePrototype = $(collection + '_prototype');
    var newWidget = certificatePrototype.data('prototype');

    var index = certificatePrototype.data('index');
    newWidget = newWidget.replace(/__name__/g, index);

    certificatePrototype.data('index', index + 1);

    var $newWidget = $(newWidget);
    $(collection + '_fields').append($newWidget);

    $newWidget.find('.btn-remove').click(onRowRemove);
}
