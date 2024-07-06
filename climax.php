<?php


function maior($a, $b) {
    if ($a > $b)
        return $a;
    else 
        return $b;
}



function menor($a, $b) {
    if ($a < $b)
        return $a;
    else
        return $b;
}


function calcMax ($val1 = null, $val2 = null) {
    
    if (($val1 == 'null' || $val1 == null) && ($val2 == 'null' || $val2 == null)){
        return null;
    }

    $val1 = str_replace(",", ".", $val1);
    $val2 = str_replace(",", ".", $val2);
    
    if ($val1 == 'null' || $val1 == null){
        return str_replace(",", ".", $val2);
    }
    else if ($val2 == 'null' || $val2 == null){
        return str_replace(",", ".", $val1);
    }

    if ($val1 > $val2) {
        return str_replace(",", ".", $val1);
    }
    else {
        return str_replace(",", ".", $val2);
    }

    return null;
}


function calcMin($val1 = null, $val2 = null) {

    if (($val1 == 'null' || $val1 == null) && ($val2 == 'null' || $val2 == null))
        return null;



    $val1 = str_replace(",", ".", $val1);
    $val2 = str_replace(",", ".", $val2);

    if ($val1 == 'null' || $val1 == null)
        return str_replace(",", ".", $val2);
    
    else if ($val2 == 'null' || $val2 == null)
        return str_replace(",", ".", $val1);

    if ($val1 < $val2)
        return str_replace(",", ".", $val1);
    else 
        return str_replace(",", ".", $val2);

    return null;
}




#Le arquivo
$arquivoCSV = 'Vix.csv';
$lista = file_get_contents('' . $arquivoCSV);
$lista_array = explode("\n", $lista);

//$tMax = [];
//$tMin = [];
$medMax = [];
$medMin = [];

$tMax2 = [];
$tMin2 = [];

$contadorMax = [];
$contadorMin = [];

for ($i = 1990; $i <= 2023; $i++) {
    $contadorMax[$i] = 0;
    $contadorMin[$i] = 0;
    $medMax[$i] = 0;
    $medMin[$i] = 0;
}



foreach($lista_array as $lista_item) {

    $dados = explode(";", $lista_item);
    $linha = explode("	", $dados[0]);
    //print_r($linha);
    //continue;

    if (!isset($dados[0]))
        continue;

    $data = $linha[0];
    $dia = date( 'd', strtotime($data)); 
    $mes = date( 'm', strtotime($data)); 
    $ano = date( 'Y', strtotime($data)); 


    if ($ano == 1969) 
        continue;

    if ($linha[1] == 'null' && $linha[3] == 'null' && $linha[4] == 'null' && $linha[6] == 'null')
        continue;

    //if ($ano != 2012) continue;


    $max = calcMax($linha[1], $linha[4]);

    $min = calcMin($linha[3], $linha[6]);

    

    //echo "$dia/$mes/$ano\n";
    //echo "$dia/$mes/$ano ==>  $max ---- $min\n";
    //exit;
    //continue;


    #grava as temp Max e Min
    //$tMax[$ano][$mes][$dia] = $max;
    //$tMin[$ano][$mes][$dia] = $min;

    //echo "$dia/$mes/$ano\n";
    
    if ($max != 'null' && $max != null){
        $tMax2[$ano . '-' . $mes . '-' . $dia] = $max;
        #calcula e grava as medias
        $medMax[(int)$ano] +=  $max;
        $contadorMax[(int)$ano] ++;

    }
    
    if ($min != 'null' && $min != null){
        $tMin2[$ano . '-' . $mes . '-' . $dia] = $min;
        #calcula e grava as medias
        $medMin[(int)$ano] +=  $min;
        $contadorMin[(int)$ano] ++;

    }



}

//exit;

//echo $medMax[2012] . '  ' ;
//echo $contadorMax[2012] . ' ' ;
//echo $medMax[2012] / $contadorMax[2012];
//exit;


function geraMediasPorAno ($contadorMax, $contadorMin, $medMax, $medMin) {
    echo "ANO; Temp Max; Temp Min \n";

    for ($ano = 1990; $ano <= 2023; $ano++) {
        if ($contadorMax[$ano] != 0) 
            $medMax[$ano] = $medMax[$ano] / $contadorMax[$ano];
        
        if ($contadorMin[$ano] != 0) 
            $medMin[$ano] = $medMin[$ano] / $contadorMin[$ano];


        echo $ano . ";", number_format($medMax[$ano],2, ',', '') . ";" . number_format($medMin[$ano],2, ',', '') . "\n";

    }
}



function ordenaTempMax ($tMax2) {

    arsort($tMax2);

    echo "Data; Max\n";

    foreach ($tMax2 as $data=>$temp) {
        echo $data . ' ; ' . number_format($temp, 2,',', '')  . "\n";
    }
    
}

function ordenaTempMin ($tMin2) {

    asort($tMin2);

    echo "Data; Mix\n";

    foreach ($tMin2 as $data=>$temp) {
        echo $data . ' ; ' . number_format($temp, 2, ',', '') . "\n";
    }
    
}




# programa princial


//geraMediasPorAno($contadorMax, $contadorMin, $medMax, $medMin);
//ordenaTempMax($tMax2);
ordenaTempMin($tMin2);


