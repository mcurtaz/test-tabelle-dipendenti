<?php

function getAll($conn){
    $result = array();

    $dipendenti = $conn -> query("SELECT * FROM dipendente");

    while($rowDipendente = $dipendenti -> fetch_assoc()){

        $nome = $rowDipendente['nome'] . " " . $rowDipendente['cognome'];
        $result[$nome] = array();

        $entrate = $conn -> query("SELECT * FROM timbrata WHERE dipendente_id='" . $rowDipendente['id'] . "' AND verso='E'");

        while($rowEntrata = $entrate -> fetch_assoc()){

            $entrata = new DateTime($rowEntrata['dataora']);
            $giorno = $entrata -> format("d-m-Y");
            $ore = 0;
            
            if(isset($result[$nome][$giorno]["E"])){

                $oldEntrata = new DateTime($result[$nome][$giorno]["E"]);

                if($entrata < $oldEntrata){
                    $result[$nome][$giorno]["E"] = $entrata -> format('Y-m-d H:i:s');
                }

            }else{
                $result[$nome][$giorno]["E"] = $entrata -> format('Y-m-d H:i:s');
            }

            $queryUscita = $conn -> query("SELECT MIN(dataora) AS uscita FROM timbrata WHERE  dataora>'" . $rowEntrata['dataora'] . "' AND verso='U' AND dipendente_id='" . $rowEntrata['dipendente_id'] . "' LIMIT 1");

            $rowUscita = $queryUscita -> fetch_assoc();

            $uscita = new DateTime($rowUscita['uscita']);

            if(isset($result[$nome][$giorno]["U"])){

                $oldUscita = new DateTime($result[$nome][$giorno]["U"]);

                if($uscita > $oldUscita){
                    $result[$nome][$giorno]["U"] = $uscita -> format('Y-m-d H:i:s');
                }

            }else{
                $result[$nome][$giorno]["U"] = $uscita -> format('Y-m-d H:i:s');
            }

            $ore = $entrata -> diff($uscita);

            if(isset($result[$nome][$giorno]["TOT"])){

                $oldOre = $result[$nome][$giorno]["TOT"];
                
                $result[$nome][$giorno]["TOT"] = sumHours($oldOre, $ore -> format("%H:%i"));

            }else{

                $result[$nome][$giorno]["TOT"] = $ore -> format("%H:%I");
            }
        }

        foreach($result as $kDipendente => $dipendente){

            foreach($dipendente as $kGiorno => $giorno){
                $uscita = new DateTime($giorno['U']);
                $entrata = new DateTime($giorno['E']);

                $ore = $entrata -> diff($uscita);
                $tot = $giorno['TOT'];
                $pausa = subHours($tot, $ore -> format("%H:%I") );

                $result[$kDipendente][$kGiorno]['P'] = $pausa;

            }
        }

    }

    return $result;

}

function sumHours($h1, $h2){

    $ore = explode(':', $h2);
    //$oldOre = explode(':', $h1);
    $time = new DateTime($h1);
    $time->add(new DateInterval("PT".$ore[0]."H".$ore[1]."M"));
    return $time->format('H:i');

}

function subHours($h1, $h2){
    //$ore = explode(':', $h2);
    $tot = explode(':', $h1);
    $time = new DateTime($h2);
    $time->sub(new DateInterval("PT".$tot[0]."H".$tot[1]."M"));
    return $time->format('H:i');
}