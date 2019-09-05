<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label for="nome_completo">Nome completo</label>
            <input name="nome_completo" type="text" class="form-control m-input" placeholder="Nome do usuário">
            <span class="m-form__help">Informe o nome completo</span>
        </div>
        <div class="col-lg-6">
            <label for="cpf">CPF</label>
            <input id="cpf" name="cpf" type="text" class="form-control m-input cpf" placeholder="CPF do responsável por esta conta">
            <span class="m-form__help">Somente números</span>
        </div>
    </div>	 
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label for="email">Endereço eletrônico</label>
            <div class="m-input-icon m-input-icon--right">
                <input name="email" type="email" class="form-control m-input" id="email" placeholder="E-mail do usuário">
                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
            </div>
            <span class="m-form__help text-info">A senha de acesso será enviada a este e-mail</span>
        </div>
        
        <div class="col-lg-6">
            <label for="email">Associado</label>
            <div class="m-input-icon m-input-icon--right">
               
            </div>
        </div>
        
    </div>
</div>

<?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>

<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
                Cadastro de vendas 
            </h3>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-2">
            <select data-style="btn-outline-info" name="id_usuario_coordenador" class="form-control selectpicker text-center">
                <option selected disabled="true"> Selecione a categoria </option>
                <option  value=""> </option>
            </select>
        </div>

        <div class="col-md-2">
            <select data-style="btn-outline-info" name="id_usuario_coordenador" class="form-control selectpicker text-center">
                <option selected disabled="true"> Produto </option>
                <option  value=""> </option>
            </select>
        </div>
        
        <div class="col-md-2">
            <input name="qtd" type="text" class="form-control m-input text-center" placeholder="Quantida">
        </div>
        
        <div class="col-md-2">
            <select name="tipo" class="form-control m-input selectpicker text-center">
                <option selected="true" disabled="true" value="">Escolha um tipo </option>
                <option value="1"> Unidade </option>
                <option value="2"> KG </option>
            </select>
        </div>
        
        <div class="col-md-2">
            <input name="valor" type="text" class="form-control m-input text-center" placeholder="Valor">
        </div>
        
        <button type="button" class="btn btn-primary"> <i class="la la-plus"></i> Adicionar </button>
    </div>
        <div id="compra_tabela">
            
            
        </div>
</div>


<script>
    function load_form() {
        $("#compra_tabela").load("venda/tabela/produtos", {}, function () {
            unblockPage();
        });
    }
    
    $(document).ready(function () {
        load_form();
        $(".selectpicker").selectpicker();
        $('.cpf').mask("000.000.000-00");
    });
</script>