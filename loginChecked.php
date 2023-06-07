<?php
include ('Conexao.php');
$emailusuario = $_GET['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/SistemaFormulario.css" media="screen">
    <title>Crunch Times OEE</title>
</head>
<body>
<header>
  <div class="logo">
    <img src="imagens/logoChocolate.png" alt="Logo da empresa"><!--Imagem logo-->
    <figcaption>Sugar High</figcaption><!--escrita embaixo do logo-->
  </div>

  <div class="button-enter"><!--Botões de entrar e registrar do cabeçalho-->
    
    
  </div>
    <div id='form-button'>
        <?php echo '<br>'.'<br>'.$emailusuario.'<br>';?>
        <a href="login.php"><button>sair</button></a>
        <a href='SistemaFormulario.php'> <button> inserir dados</button></a>
    </div>
</header>

        <div id="tabela-div">
            <!-- FILTROS -->
            <form id= "formulario-filtro" class="form-filtro" action="" method="get">
                <fieldset id= "container-filtros-index" class="container">
                    <h2 id="filtro-h2">Filtros</h2>
                    <div class="campo-filtro">
                        <label id="label-index-filtro-data_inicial" for="data_inicial">Data Inicial</label><br>
                        <input type="date" id="data_inicial" name="data_inicial" require>
                    </div>

                    <div class="campo-filtro">
                        <label id="label-index-filtro-data_final" for="data_final">Data Final</label><br>
                        <input type="date" id="data_final" name="data_final" require>
                    </div>

                    <br>
                    <label for="produto[]"></label>
                    <input type="checkbox" name="produto[]" value="Floco de Arroz"> Floco de Arroz
                    <input type="checkbox" name="produto[]" value="Caramelo Crocante"> Caramelo Crocante
                    <input type="checkbox" name="produto[]" value="Amendoim"> Amendoim
                    <br>
                    <button id="filtrar-button" type="submit">Filtrar</button>
                </fieldset>
            </form>
                <?php
                    $where = "";
                    $produtos ='';

                    if (isset($_GET['data_final'], $_GET['data_inicial'])) {// Se foi clicado no botão e os valores do formulário foram passados....
                        $filtros = array();
                        $filtros['data_inicial'] = $_GET['data_inicial'];
                        $filtros['data_final'] = $_GET['data_final'];

                        if (!empty($filtros['data_inicial']) && !empty($filtros['data_final'])) {// Se as chaves tiverem algum valor
                            $where = " AND Data BETWEEN " .  "'" . $filtros['data_inicial']. "'" ." AND " . "'".$filtros['data_final']. "'";
                            
                        }
                    }
                    if (isset($_GET['produto']) ) {
                        $filtros['produto'] = $_GET['produto'];
                        $produtosArray =$_GET['produto'] ;
                        $produtos = "'" . implode("', '", $produtosArray) . "'"; // Formata os valores dos produtos como uma lista de strings
                        $where .= " AND Produto IN ($produtos)";
                    }

                ?>
        <div class="tabela-scrow">   <!-- INICIO DA TABELA -->
            <table id="tabela_index" class="table text-white table-bg">
                <!-- NOME DAS COLUNAS -->    
                <thead>
                    <tr>
                        <th id="operacoes" scope="col">Operações</th>

                        <th scope="col" title="Semana (dia)">Semana</th>
                        <!-- <th id="coluna_id" scope="col" title="Código identificador">ID</th> -->
                        <th scope="col" title="Data">Data</th>
                        <th scope="col" title="Qual linha de produto estava sendo produzido no dia">Produto</th>
                        <th scope="col" title="horas disponíveis no dia (até 24h)">Horas Disp.</th>
                        <th scope="col" title="Horas programadas de produção para o dia, descontando paradas programadas">Hrs Program.</th>
                        <th scope="col" title="Volume (em kg) de Chocolate Sólido Fundido">Vol. CS Fund.</th>
                        <th scope="col" title="Volume (em kg) de carga consumida no dia">Vol. Carga</th>

                        <!-- Tanque de fusão -->
                        <th scope="col" title="Horas de operação do Agitador do Tanque de Fusão">Hrs Ag. Tq. Fus.</th>
                        <th scope="col" title="N° de bateladas (n° inteiro) feitas no dia na Fusão">N° Bat. Fus.</th>
                        <th scope="col" title="Horas de operação da bomba de transferência da fusão">Hrs Bomba Fus.</th>

                        <!-- Tanque de mistura -->
                        <th scope="col" title="Horas de operação do Agitador do Tanque de Mistura">Hrs Ag. Tq. Mis.</th>
                        <th scope="col" title="N° de bateladas (n° inteiro) feitas no dia na Mistura">N° Bat. Mis.</th>
                        <th scope="col" title="Horas de operação da bomba de transferência de mistura">Hrs Bomba Mis.</th>

                        <!-- Tanque de alimentação -->
                        <th scope="col"  title="Horas de operação do Agitador do Tanque de Alimentação">Hrs Ag. Tq. Ali.</th>
                        <th scope="col" title="Horas de operação da bomba de transferência de Alimentação">Hrs Bomba Ali.</th>

                        <!-- Maquina formadora de chocolates -->
                        <th scope="col" title="Horas de operação da Máquina de Formação de Chocolates">Hrs Maq. Form.</th>
                        <th scope="col" title="Horas de operação da Esteira transportadora de Chocolate">Hrs Esteira</th>
                        <th scope="col" title="Volume (em kg) de carga produzida no dia">Vol. Carga Prod.</th>
                        <th scope="col" title="Capacidade máxima (em kg) de ser produzida de acordo com as horas da Máquina Formadora">Capac. Max. Form.</th>
                        <th scope="col" title="Valor, em porcentagem do produto aprovado no dia">Taxa Aprovação</th>
                    

                        <!-- Cálculos -->

                        <th scope="col" title="Disponibilidade do Processo para a produção">Disponibilidade</th>
                        <th scope="col" title="Competência do processo em atingir a capacidade máxima de produção">Performance</th>
                        <th scope="col" title="Overall Equipment Efficiency">OEE</th>
                    </tr>
                </thead>
                <?php 
                    
                    
                    $sqlSelect = "SELECT * FROM Producao WHERE 1".$where." ORDER BY data";

                    /* echo ' var_dump($sqlSelect) -> '.var_dump */($sqlSelect).'<br>'; 
                    $resultado = mysqli_query($conn,$sqlSelect) or die("Erro ao retornar dados");
                    
                    $totalLinhas = mysqli_num_rows($resultado); // Obtém o número total de linhas retornadas

                    $totalOEE = 0; // Variável para armazenar a soma dos valores do OEE
                    while($registro = mysqli_fetch_assoc($resultado)){/* Exibição da Tabela/Relatório */
                        $oee = $registro['OEE'];
                        $totalOEE += $oee; // Adiciona o valor do OEE à soma total
                        
                        $Entrada = $registro['Entrada'];
                        $id = $registro['id'];
                        $data = $registro['Data'];
                        $produto = $registro['Produto'];
                        $H_disp = $registro['H_disp'];
                        $HH_Prog = $registro['HH_Prog'];
                        $Q_CS = $registro['Q_CS'];
                        $Q_Sol = $registro['Q_Sol'];

                        /* Tanque de fusão */
                        $Ag_Tq_Fus = $registro['Ag_Tq_Fus'];
                        $Bat_TQ_Fus = $registro['Bat_TQ_Fus'];
                        $BB_Fus = $registro['BB_Fus'];

                        /* Tanque de mistura */
                        $Ag_Tq_Mis = $registro['Ag_Tq_Mis'];
                        $Bat_TQ_Mis = $registro['Bat_TQ_Mis'];
                        $BB_Mis = $registro['BB_Mis'];

                        /* Tanque de Alimentação */
                        $Ag_Tq_Ali = $registro['Ag_Tq_Ali'];
                        $BB_Ali = $registro['BB_Ali'];

                        /* Maquina formadora de chocolates */
                        $Acc_Maq_form = $registro['Acc_Maq_form'];
                        $Acc_trans_Estoc = $registro['Acc_trans_Estoc'];
                        $Q_MF_real = $registro['Q_MF_real'];
                        $Aprov_qual = $registro['Aprov_qual'];

                        /* Calculos */
                        $Q_MF_max = $registro['Q_MF_max'];
                        $disponibilidade = $registro['Disponibilidade'];
                        $performance = $registro['Performance'];
                        $oee = $registro['OEE'];
                        
                        echo '<tr>';

                        echo "<td>
                                
                         <button class='bt_delete' onclick='showConfirmationModal($id)' title='deletarbtn'>Deletar</button>
                        
                        </td>";
                        /* Formatação de horas */
                        /* str_replace('.', ':', number_format($HH_Prog, 2)) .'h' */
                        echo '<td>' . $Entrada . '</td>';
                        /* echo '<td>' . $id . '</td>'; */
                        echo '<td>' . date('d/m/Y', strtotime($data)). '</td>';
                        echo '<td>' . $produto . '</td>';
                        echo '<td>' . number_format($H_disp, 2) . '</td>';
                        echo '<td>' . number_format($HH_Prog, 2). '</td>';
                        echo '<td>' . number_format($Q_CS, 2) . 'kg' . '</td>';
                        echo '<td>' . number_format($Q_Sol, 2) . 'kg' . '</td>';

                        /* Tanque de Fusão */
                        echo '<td>' . number_format($Ag_Tq_Fus, 2). '</td>';
                        echo '<td>' . $Bat_TQ_Fus .'</td>';
                        echo '<td>' . number_format($BB_Fus, 2). '</td>';

                        /* Tanque de mistura */
                        echo '<td>' . number_format($Ag_Tq_Mis, 2) . '</td>';
                        echo '<td>' . $Bat_TQ_Mis . '</td>';
                        echo '<td>' .  number_format($BB_Mis, 2). '</td>';

                        /* Tanque de Alimentação */
                        echo '<td>' . number_format($Ag_Tq_Ali, 2). '</td>';
                        echo '<td>' . number_format($BB_Ali, 2). '</td>';
                        
                        /* Maquina formadora de chocolates */
                        echo '<td>' . number_format($Acc_Maq_form, 2) . '</td>';
                        echo '<td>' . number_format($Acc_trans_Estoc, 2) . '</td>';
                        echo '<td>' . number_format($Q_MF_real, 2) . 'kg' . '</td>';
                        echo '<td>' . number_format($Q_MF_max, 2) . '</td>'; 
                        echo '<td>' . number_format($Aprov_qual, 2) . '%' .'</td>';

                        /* Cálculos */
                        echo '<td>' . number_format($disponibilidade *100, 2)  .'%' . '</td>';
                        echo '<td>' . number_format($performance *100 , 2) .'%' . '</td>';
                        echo '<td>' . number_format($oee, 2) . '%' .'</td>';
                        echo '</tr>';


                        /* Janela de confirmação */
                        echo "
                        <div class='confirmation-modal'>
                            <div class='modal-content'>
                                <p>Você tem certeza que deseja apagar esta linha?</p>
                                <button class='confirm-btn'>Confirmar</button>
                                <button class='cancel-btn'>Cancelar</button>
                            </div>
                         </div> ";
                        /* Script */
                        echo "
                         <script>
                            // Selecionar os elementos relevantes
                            var deleteButtons = document.querySelectorAll('.bt_delete');
                            var confirmationModal = document.querySelector('.confirmation-modal');
                            var confirmButton = document.querySelector('.confirm-btn');
                            var cancelButton = document.querySelector('.cancel-btn');
                            
                            // Função para exibir a janela de confirmação com o ID como parâmetro
                            function showConfirmationModal(id) {
                                event.preventDefault();
                                confirmationModal.style.display = 'flex';
                                confirmButton.setAttribute('data-delete-url', 'delete.php?id='+id);
                            }

                            
                            
                            // Função para fechar a janela de confirmação
                            function closeConfirmationModal() {
                            confirmationModal.style.display = 'none';
                            }
                            
                            // Adicionar evento de clique aos botões de apagar
                            deleteButtons.forEach((button) => {
                                button.addEventListener('click', function(event) {
                                  var id = event.target.getAttribute('onclick').match(/\d+/)[0];
                                  showConfirmationModal(id);
                                });
                              });

                            // Adicionar evento de clique ao botão de confirmar
                            confirmButton.addEventListener('click', () => {
                            // Remover a linha da tabela
                            const deleteUrl = confirmButton.getAttribute('data-delete-url');
                            window.location.href = deleteUrl;
                            });
                            
                            // Adicionar evento de clique ao botão de cancelar
                            cancelButton.addEventListener('click', closeConfirmationModal);
                
                        </script>";
                    }
                    
            
                ?>

            </table>
        </div>   
       <?php
            if($totalLinhas !==0){
                $mediaOEE = $totalOEE / $totalLinhas; // Calcula a média do OEE
            echo "<p id = 'media-oee-filtro' > Média do OEE (filtro) : ". number_format($mediaOEE, 2)."%</p>";
            }
            
            echo "<div id='form-button' >            
            <a href='SistemaFormulario.php'> <button> inserir dados</button></a>
            </div> ";
            
            
            // Consulta SQL para obter a média do OEE por mês
            $sqlSelectOeePorMes = 'SELECT MONTH(Data), AVG(OEE) FROM Producao GROUP BY MONTH(Data)';

            // Consulta SQL para obter a média do OEE por semana
            $sqlSelectOeePorSemana = "SELECT DATE_FORMAT(Data, '%v') AS Semana, AVG(OEE) FROM Producao GROUP BY Semana";

            // Consulta SQL para obter a média do OEE por produto
            $sqlSelectOeePorProduto = 'SELECT Produto, AVG(OEE) FROM Producao GROUP BY Produto';

            // Código para executar as consultas SQL e obter os resultados
            
            // Consulta por mês
            $resultadoMes = mysqli_query($conn, $sqlSelectOeePorMes);
            $mediasMes = mysqli_fetch_all($resultadoMes);

            // Consulta por semana
            $resultadoSemana = mysqli_query($conn, $sqlSelectOeePorSemana);
            $mediasSemana = mysqli_fetch_all($resultadoSemana);

            // Consulta por produto
            $resultadoProduto = mysqli_query($conn, $sqlSelectOeePorProduto);
            $mediasProduto = mysqli_fetch_all($resultadoProduto);
        ?>
        <div class="relatorio-janela">
            <h2>Resultados OEE</h2>
            <hr>
        <ul>
            <?php foreach ($mediasMes as $media) : ?>
        <?php
        // Obter o nome do mês a partir do número
        $nomeMes = date("M", mktime(0, 0, 0, $media[0], 1));
        ?>
        <li><?php echo $nomeMes; ?>: <?php echo number_format($media[1],2); ?>%</li>
    <?php endforeach; ?>
</ul>
<hr>
<ul class="relatorio-ul">
    <?php foreach ($mediasProduto as $media) : ?>
        <?php
        // Mapear o nome do produto para a média correspondente
        $nomeProduto = '';
        switch ($media[0]) {
            case 'Floco de Arroz':
                $nomeProduto = 'Floco de Arroz';
                break;
            case 'Caramelo Crocante':
                $nomeProduto = 'Caramelo Crocante';
                break;
            case 'Amendoim':
                $nomeProduto = 'Amendoim';
                break;
            default:
                $nomeProduto = 'Produto Desconhecido';
                break;
        }
        ?>
        <li><?php echo $nomeProduto; ?>: <?php echo number_format($media[1], 2); ?>%</li>
    <?php endforeach; ?>
            </ul>
            <hr>
            <ul>
                <?php foreach ($mediasSemana as $media) : ?>
                    <li>Sem <?php echo $media[0]; ?>: <?php echo number_format($media[1],2); ?>%</li>
                <?php endforeach; ?>
            </ul>
        </div>
                   
       

    </div>
</body>

</html>