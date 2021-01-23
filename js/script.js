$(document).ready(function() {
    buttonsListener();
    printTable1();

    // la tb2 è già nell'html. .datatable() la stilizza e aggiunge funzionalità
    $('#tb2').DataTable({
        'searching': false,
        'paging': false
    });
});

// la funzione mostra nasconde le tabelle e attiva/disattiva i bottoni corrispondenti
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


// una chiamata ajax al file che restituisce un json con le righe della tabella da stampare. Poi la funzione dataTable() crea la tabella nell'html
function printTable1(){

    $.ajax({
        url: 'http://localhost/api/api.php',
        method: 'GET',
        success: function(data){
            
            $('#tb1').DataTable(
                {
                    'data': data,
                    // le due righe disabilitano le funzioni di ricerca e la divisione in pagine della tabella
                    'searching': false,
                    'paging': false
                });

        },
        error: function(err){
            console.log(err);
        }
    });

}
