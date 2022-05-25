<?php
    //Configurando o fuso horário
    date_default_timezone_set('America/Sao_Paulo');

    //Obtendo os meses anteriores e posteriores
    if(isset($_GET['mes'])) {
        $mes = $_GET['mes'];
    }
    else {
        $mes = date('Y-m');
    }
    
    //checando o formato da hora
    $timestamp = strtotime($mes . '-01');
    if($timestamp === false) {
        $mes = date('Y-m-d');
    }

    //setando o dia atual
    $hoje = date('Y-m-j', time());

    //setando o titulo da tag h3
    $titulo = date('Y / m', $timestamp);
    

    //criando os links dos meses anteriores e posteriores
    // mktime(hour, minute, second, month, day, year)
    $anterior = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $proximo = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

    //contagem dos dias do mês
    $cont_dias = date('t', $timestamp);

    //definindo os dias da semana -> 0:dom 1:seg 2:ter 3:qua 4:qui 5:sex 6:sab
    $dias = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

    // Criando calendario
    $semanas = [];
    $semana = '';

    // Adiciona as células vazias
    $semana .= str_repeat('<td></td>', $dias);

    for($dia = 1; $dia <= $cont_dias; $dia++, $dias++) {
        $data = $mes .'-'. $dia; 

        If($hoje == $data) {
            $semana .= '<td classmate="today">' .$dia;
        }
        else {
            $semana .= '<td>'. $dia;
        }
        $semana .= '</td>';

        // Verificando o final da semana
        if($dias % 7 == 6 || $dia == $cont_dias) {
            // Adiciona células vázias
            $semana .= str_repeat('<td></td>', 6 - ($dias % 7));

        
        
        $semanas[] = '<tr>' .$semana. '</tr>';

        // Preparar nova semana 
        $semana = '';    
        }
    }

?>