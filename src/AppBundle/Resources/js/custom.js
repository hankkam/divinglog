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
        $("#certification").attr('class', 'panel-body collapse in').attr('aria-expanded', 'true').removeAttr('style');
        education_fields(event);
    });

    $('.btn-remove').click(function() {
        event.target.closest('.row').remove();
    });

    function education_fields()
    {
        var certificatePrototype = $('#certificatePrototype');
        var newWidget = certificatePrototype.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g);

        $('#education_fields').append($(newWidget));

        $('.btn-remove').click(function() {
            event.target.closest('.row').remove();
        });
    }

    $("#btn-add-specialty").click(function() {
        $("#specialties").attr('class', 'panel-body collapse in').attr('aria-expanded', 'true').removeAttr('style');
        specialty_fields(event);
    });

    $('.btn-remove-specialty').click(function() {
        event.target.closest('.row').remove();
    });

    function specialty_fields()
    {
        var specialtyPrototype = $('#specialtyPrototype');
        var newWidget = specialtyPrototype.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g);

        $('#specialty_fields').append($(newWidget));

        $('.btn-remove-specialty').click(function() {
            event.target.closest('.row').remove();
        });
    }
});
