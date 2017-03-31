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

            var html = '' +
                '<div class="form-group select-list">' +
                    '<label>Select the dive site</label>' +
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
                html = html + '</tbody></table></div></div>';
                $('#diveSites').html(html);
            }
        });

    });


});

function onClickRow(key) {

    var data = diveData[key];
    $('#dive_log_divesite').val(data['name']);
    $('#dive_log_lat').val(data['lat']);
    $('#dive_log_lng').val(data['lng']);
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
