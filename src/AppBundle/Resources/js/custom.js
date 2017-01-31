$(document).ready(function() {

    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('.flash-message .alert-success').delay( 3000 ).slideUp( 400 );

    $(".collapse").collapse();
    $("button[data-toggle=collapse]").click(function(){
        $(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up')
    });

});
