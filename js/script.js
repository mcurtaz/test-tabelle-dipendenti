$(document).ready(function() {
    buttonsListener();
    printTable1();
    $('#tb2').DataTable({
        'searching': false,
        'paging': false
    });
});

function buttonsListener(){

    $('#show-tb1').click(function(){
       
        $('#tb1-row').removeClass('d-none');
        $('#tb2-row').addClass('d-none');
        $(this).prop("disabled",true);
        $('#show-tb2').prop("disabled",false);

    });

    $('#show-tb2').click(function(){
       
        $('#tb1-row').addClass('d-none');
        $('#tb2-row').removeClass('d-none');
        $(this).prop("disabled",true);
        $('#show-tb1').prop("disabled",false);
    });
}


function printTable1(){

    $.ajax({
        url: 'http://localhost/api/api.php',
        method: 'GET',
        success: function(data){
            
            $('#tb1').DataTable(
                {
                    'data': data,
                    'searching': false,
                    'paging': false
                });

        },
        error: function(err){
            console.log(err);
        }
    });

}
