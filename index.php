<?php
    require_once('config.php');
    require_once('functions.php');

    $startDate = "2020-11-30";
    $data = getAll($conn);
    $conn -> close();

    setlocale(LC_TIME, 'it_IT.UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script scr="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Libemax</title>
</head>
<body>
    <div class="container">
        <div class="row pt-4 pb-3">
            <div class="col-12">
                <h1 class="text-center text-info">Libemax Test</h1>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-12 text-center">
                <button class="btn btn-info " id="show-tb1" disabled>Tabella Timbrate</button>
                <button class="btn btn-info " id="show-tb2">Tabella Settimana</button>
            </div>
        </div>
        <div class="row bg-white rounded" id="tb1-row">
            <div class="col-12 py-2">
                <table id="tb1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Entrata</th>
                            <th>Uscita</th>
                            <th>Ore Lavorate</th>
                            <th>Pausa</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row d-none bg-white rounded" id="tb2-row">
            <div class="col-12 py-2">
                <table id="tb2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <?php
                                $date = new DateTime($startDate);
                                for ($i=1; $i < 6; $i++) { 
                                    $giorno = strftime("%a %d", $date -> getTimestamp());
                                    $date -> add(new DateInterval('P1D'));
                                    echo "<th>" . $giorno . "</th>";
                                }
                            ?>
                            <th>Tot.</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                
                                foreach($data as $nome => $dipendente){
                                    $date = new DateTime($startDate);
                                    $tot = "00:00";

                                    echo "<tr>";
                                    echo "<td>" . $nome . "</td>";

                                    for ($i=1; $i < 6; $i++) { 

                                        $giorno = $date -> format('d-m-Y');
                                        $date -> add(new DateInterval('P1D'));

                                        if(isset($dipendente[$giorno]['TOT'])){

                                            echo "<td>" . $dipendente[$giorno]['TOT'] . "</td>";
                                            
                                            $tot = sumHours($tot, $dipendente[$giorno]['TOT']);

                                        }else{
                                            echo "<td></td>";
                                        }

                                    }

                                    echo "<td>" . $tot . "</td>";
                                    echo "</tr>";

                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>