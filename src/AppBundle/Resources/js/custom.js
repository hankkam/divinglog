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

    function onRowRemove()
    {
        $(this).closest('.row').remove();
    }

    function expandDiv(collection)
    {
        $(collection).addClass('in').attr('aria-expanded', 'true').removeAttr('style');
    }

    function onAddRow()
    {
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

});
