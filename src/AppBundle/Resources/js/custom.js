var diveData = null;

$(document).ready(function() {

    $('#map').toggle();

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
    $('.btn-show-map').click(onClickMap);

    $('.btn-search-dive-sites').click(function(e) {
        $.ajax({
            url: "/app_dev.php/map/geolocation",
            data: {
                country: $('#dive_log_country').val(),
                location: $('#dive_log_location').val(),
                range: $('#range').val()
            },
            success: function (result) {

                diveData = result['data'];

                    var html = '<div id="nearest_dive_sites">' +
                        '<div class="form-group select-list">' +
                            '<label>Select the dive site or fill in the dive site name</label>' +
                            '<div class="table-responsive">' +
                            '<table class="table table-striped table-bordered table-hover">' +
                                '<thead>' +
                                    '<tr><th>#</th>' +
                                    '<th>Dive site name</th>' +
                                    '<th>Latitude</th>' +
                                    '<th>Longitude</th>' +
                                    '<th>Distance from selected country and location in Nautical miles (NM)</th>' +
                                    '<th>Kilometers (KM)</th>' +
                                    '</tr></thead><tbody>';

                    var i = 1;
                    $.each(result['data'], function(key, value) {

                        html = html + '<tr onclick="onClickRow(' + key + ')" class="btn-set-dive-site"><td>' + i + '</td>' +
                            '<td>' + value['name'] + '</td>' +
                            '<td>' + value['lat'] + '</td>' +
                            '<td>' + value['lng'] + '</td>' +
                            '<td>' + value['distance'] + '</td>' +
                            '<td>' + (value['distance'] * 1.85200).toFixed(2) + '</td>' +
                            '</tr>';
                        i = i + 1;

                    });
                    html = html + '</tbody></table></div></div></div>';
                    $('#diveSites').html(html);
            }
        });

    });


});

function onClickMap() {

    $('#map').toggle();

    var data = {};
    data['lat']  = $('#dive_log_lat').val();
    data['lng']  = $('#dive_log_lng').val();
    data['name'] = $('#dive_log_diveSite').val();

    initMap(data);
}

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

    initMap(data)
}

function clearResult() {
    $('#nearest_dive_sites').remove();
    $('#map').css('height', '0px');
    $('#map').css('width', '0px');
    $('#dive_log_country').val('');
    $('#dive_log_location').val('');
    $('#range').val('');
    $('#dive_log_divesite').val('');
    $('#dive_log_lat').val('');
    $('#dive_log_lng').val('');
}

function initMap(data) {

    $('#map').css('height', '400px');

    var myLatLng = {lat: parseFloat(data['lat']), lng: parseFloat(data['lng'])};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: data['name'],
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
