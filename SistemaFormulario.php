<?php
/* Script php que define o timezone e armazena a data em uma variavel   */
date_default_timezone_set("America/Sao_Paulo");
$datahoje = date("Y-m-d"); #utilizado no value do input_data 

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/SistemaFormulario.css" media="screen">
    <title>SISTEMA | CRUNCH TIMES</title>
</head>

<body>


    <div class="card">
        <h1>Entrada de dados para OEE</h1>
        <h2>Insira os dados</h2>
        <br>

        <form class="form" method="post" action="SistemaFormulario_enviaDB.php">
            <div>
                <fieldset class="container" id="geral">

                    <div class="campo" id="data">
                        <label for="input_Data"> Data</label>
                        <input type="date" id="input_Data" name="input_data" value="<?php echo $datahoje; ?>" required>
                    </div>
                    <div class="campo" id="produto">
                        <label for=""> Produto</label>
                        <select id="produto" name="input_produto" required>
                            <option selected disabled value="">Selecione</option>
                            <option>Floco de Arroz</option>
                            <option>Caramelo Crocante</option>
                            <option>Amendoim</option>
                        </select>
                    </div>
                    <div class="campo" id="H_disp">
                        <label for="input_H_disp" title="horas disponíveis no dia (até 24h)"> Horas Disponíveis (H_disp)</label>
                        <input type="text" id="input_H_disp" name="input_H_disp" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                    </div>
                    <div class="campo" id="HH_Prog">
                        <label for="input_HH_Prog" title="Horas programadas de produção para o dia, descontando paradas programadas">
                            Horas Programadas (HH_Prog)</label>
                        <input type="text" id="input_HH_Prog" name="input_HH_Prog" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                    </div>
                    <div class="campo" id="Q_CS">
                        <label for="input_Q_CS" title="Volume (em kg) de Chocolate Sólido Fundido">Chocolate Fundido(kg) (Q_CS)</label>
                        <input type="text" id="input_Q_CS" name="input_Q_CS" placeholder="6.00" oninput="substituirVirgulaPorPonto(this)" required>
                    </div>
                    <div class="campo" id="Q_Sol">
                        <label for="input_Q_Sol" title="Volume (em kg) de carga consumida no dia"> Carga Consumida(kg) (Q_Sol)</label>
                        <input type="text" id="input_Q_Sol" name="input_Q_Sol" placeholder="4.00" oninput="substituirVirgulaPorPonto(this)" required>
                    </div>

                    <fieldset class="container" id="tanque_de_fusao">
                        <h2>Tanque de Fusão</h2>

                        <div class="campo" id="Ag_Tq_Fus">
                            <label for="input_Ag_Tq_Fus" title="Horas de operação do Agitador do Tanque de Fusão"> Horas de Operação do Agitador (Ag_Tq_Fus)</label>
                            <input type="text" id="input_Ag_Tq_Fus" name="input_Ag_Tq_Fus" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>

                        <div class="campo" id="Bat_TQ_Fus">
                            <label for="input_Bat_TQ_Fus" title="N° de bateladas (n° inteiro) feitas no dia na Fusão">
                                Nº de Bateladas (Bat_TQ_Fus)</label>
                            <input type="number" min="0" id="input_Bat_TQ_Fus" name="input_Bat_TQ_Fus" placeholder="5" required>
                        </div>
                        <div class="campo" id="BB_Fus">
                            <label for="input_BB_Fus" title="Horas de operação da bomba de transferência da fusão">
                                Horas de Operação da Bomba de Transferência (BB_Fus)</label>
                            <input type="text" id="input_BB_Fus" name="input_BB_Fus" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="container" id="tanque_de_mistura">


                        <h2>Tanque de Mistura</h2>

                        <div class="campo" id="Ag_Tq_Mis">
                            <label for="input_Ag_Tq_Mis" title="Horas de operação do Agitador do Tanque de Mistura">
                                Horas de Operação do Agitador (Ag_Tq_Mis)</label>
                            <input type="text" id="input_Ag_Tq_Mis" name="input_Ag_Tq_Mis" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>

                        <div class="campo" id="Bat_TQ_Mis">
                            <label for="input_Bat_TQ_Mis" title="N° de bateladas (n° inteiro) feitas no dia na Mistura">
                                Nº de Bateladas (Bat_TQ_Mis)</label>
                            <input type="number" min="0" id="input_Bat_TQ_Mis" name="input_Bat_TQ_Mis" placeholder="5" required>
                        </div>

                        <div class="campo" id="BB_Mis">
                            <label for="input_BB_Mis" title="Horas de operação da bomba de transferência de mistura">
                                Horas de Operação da Bomba de Transferência (BB_Mis)</label>
                            <input type="text" id="input_BB_Mis" name="input_BB_Mis" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="container" id="tanque_de_Alimentacao">
                        <h2>Tanque de Alimentação</h2>

                        <div class="campo" id="Ag_Tq_Ali">
                            <label for="input_Ag_Tq_Ali" title="Horas de operação do Agitador do Tanque de Alimentação">
                                Horas de Operação do Agitador (Ag_Tq_Ali)</label>
                            <input type="text" id="input_Ag_Tq_Ali" name="input_Ag_Tq_Ali" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>
                        <div class="campo" id="BB_Ali">
                            <label for="input_BB_Ali" title="Horas de operação da bomba de transferência de Alimentação">
                                Horas de Operação da Bomba de Transferência (BB_Ali)</label>
                            <input type="text" id="input_BB_Ali" name="input_BB_Ali" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset class="container" id="maquina_de_formacao_de_chocolates">
                        <h2>Máquina de Formação de Chocolates</h2>
                        <div class="campo" id="Acc_Maq_form">
                            <label for="input_Acc_Maq_form" title="Horas de operação da Máquina de Formação de Chocolates">
                                Horas de Operação da Máquina de Formação (Acc_Maq_form)</label>
                            <input type="text" id="input_Acc_Maq_form" name="input_Acc_Maq_form" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>
                        <div class="campo" id="Acc_trans_Estoc">
                            <label for="input_Acc_trans_Estoc" title="Horas de operação da Esteira transportadora de Chocolate">
                                Horas de operação da Esteira transportadora (Acc_trans_Estoc)</label>
                            <input type="text" id="input_Acc_trans_Estoc" name="input_Acc_trans_Estoc" placeholder="24.00" oninput="validaHora(this)" pattern="^(?:[0-9]|1[0-9]|2[0-4])(?:\.[0-9]{1,2})?$" required>
                        </div>

                        <div class="campo" id="Q_MF_real">
                            <label for="input_Q_MF_real" title="Volume (em kg) de carga produzida no dia">Volume de carga produzida no dia(kg) (Q_MF_real)</label>
                            <input type="text" id="input_Q_MF_real" name="input_Q_MF_real" placeholder="10.00" oninput="substituirVirgulaPorPonto(this)" required>
                        </div>
                        <div class="campo" id="Aprov_qual">
                            <label for="input_Aprov_qual" title="Valor, em porcentagem do produto aprovado no dia">Percentual de Qualidade (Aprov_qual)</label>
                            <input type="text" id="input_Aprov_qual" name="input_Aprov_qual" placeholder="70.00" oninput="substituirVirgulaPorPonto(this)" required>
                        </div>
                    </fieldset>


                    <!--   <div class="campo">
                                <label for="input_Disponibilidade" title="Disponibilidade do Processo para a produção"> Disponibilidade:</label>
                                <input type="text" id="input_Disponibilidade" name="input_Disponibilidade">
                            </div>
                            
                            <div class="campo">
                                <label for="input_Performance" title="Competência do processo em atingir a capacidade máxima de produção">
                                    Performance:</label>
                                <input type="text" id="input_Performance" name="input_Performance">
                            </div>
                            
                            <div class="campo">
                                <label for="input_OEE" title="Overall Equipment Efficiency"> OEE:</label>
                                <input type="text" id="input_OEE" name="input_OEE">
                            </div> -->



                    <div class="campo">
                        <button class="bt_enviar" type="submit" name="enviar">Enviar</button>
                    </div>
                </fieldset>
            </div>

    </div>

    </form>
    <div class='confirmation-modal'>
        <div class='modal-content'>
            <p>Tem certeza de que quer enviar?</p>
            <button class='confirm-btn'>Confirmar</button>
            <button class='cancel-btn'>Cancelar</button>
        </div>
    </div>
</body>
<script>
    var reg = /[a-zA-Z\u00C0-\u00FF ]+/i;

    function substituirVirgulaPorPonto(input) {
        if(isNaN(input.value)){
            
            input.value = input.value.replace(reg,'')
        }
        
        
        if(input.value != null){
            input.value = input.value.replace(',', '.'); // Substitui vírgula por ponto
        }
        
    }

    function validaHora(input) {
        if(isNaN(input.value)){
            input.value = input.value.replace(reg,'')
        }
        if((input.value != null) && (input.value !== '')){
            input.value = input.value.replace(',', '.'); // Substitui vírgula por ponto e converte para um valor numérico

            if (input.value > 24) {
                input.value = '24.00'; // Define o valor máximo como 24.00
            }
        }
       
    }
    // Selecionar os elementos relevantes
    var deleteButtons = document.querySelector('.bt_enviar');
    var confirmationModal = document.querySelector('.confirmation-modal');
    var formModal = documente.querySelector('.FormularioInvalido');
    var confirmButton = document.querySelector('.confirm-btn');
    var cancelButton = document.querySelector('.cancel-btn');
    var formulario = document.querySelector('.form');

// Função para exibir a janela de confirmação
function showConfirmationModal(event) {
        event.preventDefault();
        confirmationModal.style.display = 'flex';
        const deleteUrl = this.getAttribute('href');
        confirmButton.setAttribute('data-delete-url', deleteUrl);
    }

// Função para fechar a janela de confirmação
function closeConfirmationModal() {
    confirmationModal.style.display = 'none';
}
// Função para fechar a janela de erro do formulário
function closeFormModal() {
    formModal.style.display = 'none';
}
// Função para enviar o formulário
function submitForm() {
    formulario.submit();
}
formulario.addEventListener('submit', showConfirmationModal)
formulario.addEventListener('submit', verificaFormulario);
deleteButtons.addEventListener('click', verificaFormulario);

// Adicionar evento de clique aos botões de enviar
/* deleteButtons.forEach((button) => {
    button.addEventListener('click', showConfirmationModal);
}); */

// Adicionar evento de clique ao botão de confirmar
confirmButton.addEventListener('click', () => {
    submitForm();
});

// Adicionar evento de clique ao botão de cancelar
cancelButton.addEventListener('click', closeConfirmationModal);



function verificaFormulario(event){
     // Verificar se todos os campos obrigatórios foram preenchidos
     event.preventDefault();

     alert('VerificaFormulario()');
    var inputs = document.querySelectorAll('input[required], select[required]');
    var formularioValido = true;
        
    for (var i = 0; i < inputs.length; i++) {
        if (!inputs[i].value) {
            formularioValido = false;
            break;
        }
    } 
    // Se algum campo obrigatório estiver vazio, impede o envio do formulário
    if (!formularioValido) {
        event.preventDefault(); 
        alert('Por favor, preencha todos os campos.');
        formModal.style.display = 'flex';
    }else{
        
        showConfirmationModal();
    }
}


</script>

</html>