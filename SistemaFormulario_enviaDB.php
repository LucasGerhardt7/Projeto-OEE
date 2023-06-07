<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERRO</title>
</head>
<body>
    <a href="index.php"><button>Página inicial</button></a>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   

    include('Conexao.php');
    echo '<br>';
    /* $id = $_POST['input_id']; */

    $data = $_POST['input_data'];
    $produto = $_POST['input_produto'];
    $H_disp = $_POST['input_H_disp'];
    $Q_CS = $_POST['input_Q_CS'];
    $Ag_Tq_Fus = $_POST['input_Ag_Tq_Fus'];
    $Bat_TQ_Fus = $_POST['input_Bat_TQ_Fus'];
    $BB_Fus = $_POST['input_BB_Fus'];
    $Q_Sol = $_POST['input_Q_Sol'];
    $HH_Prog = $_POST['input_HH_Prog'];
    $Ag_Tq_Mis = $_POST['input_Ag_Tq_Mis'];
    $Bat_TQ_Mis = $_POST['input_Bat_TQ_Mis'];
    $BB_Mis = $_POST['input_BB_Mis'];
    $Ag_Tq_Ali = $_POST['input_Ag_Tq_Ali'];
    $BB_Ali = $_POST['input_BB_Ali'];
    $Acc_Maq_form = $_POST['input_Acc_Maq_form'];
    $Acc_trans_Estoc = $_POST['input_Acc_trans_Estoc'];
    $Q_MF_real = $_POST['input_Q_MF_real'];
    $Aprov_qual = $_POST['input_Aprov_qual'];

    /* ************ Calculos *************** */

    // Obter o número da semana usando a função date()
    $numeroSemana = date('W', strtotime($data));
    // Obter o número do dia da semana considerando segunda-feira como 1
    $numeroDiaSemana = date('N', strtotime($data));
    $mes = date('m', strtotime($data));

    $Entrada = $numeroSemana . " (" . $numeroDiaSemana . ")";
    $Q_MF_max = $Acc_Maq_form * 4;
    $Disponibilidade = $Acc_trans_Estoc / $HH_Prog;
    $Performance = $Q_MF_real / $Q_MF_max;
    $OEE = $Aprov_qual * $Disponibilidade * $Performance;

    echo "var_damp $data: ";
    var_dump($data);
    echo '<br>';
    /* $H_disp = 20.0; */
    /* essa primeira linha do sql configura SEGUNDA como primeiro dia da semana */
    $sql = " INSERT INTO Producao
    (Entrada, Semana, Mes, data, Produto, H_disp, Q_CS, Ag_Tq_Fus, Bat_TQ_Fus , Q_Sol, HH_Prog, BB_Fus, Ag_Tq_Mis, Bat_TQ_Mis,
        BB_Mis, Ag_Tq_Ali, BB_Ali, Acc_Maq_form, Acc_trans_Estoc, Q_MF_real, Aprov_qual, Q_MF_max, Disponibilidade, Performance, OEE)
    VALUES ('$Entrada','$numeroSemana','$mes','$data','$produto','$H_disp','$Q_CS','$Ag_Tq_Fus','$Bat_TQ_Fus', '$Q_Sol', '$HH_Prog', '$BB_Fus', '$Ag_Tq_Mis', '$Bat_TQ_Mis', '$BB_Mis','$Ag_Tq_Ali', '$BB_Ali', '$Acc_Maq_form', '$Acc_trans_Estoc', '$Q_MF_real', '$Aprov_qual', '$Q_MF_max', '$Disponibilidade', '$Performance', '$OEE')";

    /* var_dump($sql); */

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // O formulário não foi enviado, redirecione ou exiba uma mensagem de erro
    echo 'erro';
}


?>

<script>
    window.location.replace("loginChecked.php");
</script>