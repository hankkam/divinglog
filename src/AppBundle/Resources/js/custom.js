$(document).ready(function() {

    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('.flash-message .alert-success').delay( 3000 ).slideUp( 400 );

    $(".collapse").collapse();
    $("button[data-toggle=collapse]").click(function(){
        $(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
    });

    $("#btn-add").click(function() {
        $("#certification").attr('class', 'panel-body collapse in');
        education_fields();
    });

    $('.btn-remove').click(function(event) {
        event.target.closest('.row').remove();
    });

    function education_fields()
    {
        var certificatePrototype = $('#certificatePrototype');
        var newWidget = certificatePrototype.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g);

        $('#education_fields').append($(newWidget).addClass('form-group'));

        obj = $('#education_fields').next('.btn-remove');
        console.log(obj);

    }

});
