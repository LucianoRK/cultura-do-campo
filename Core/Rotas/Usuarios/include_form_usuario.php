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
            <label for="usuario">Usuário de acesso</label>
            <div class="m-input-icon m-input-icon--right">
                <input name="usuario" type="text" class="form-control m-input" id="usuario" placeholder="Usuário de acesso">
                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-user"></i></span></span>
            </div>
            <span class="m-form__help">Somente letras e números. Sem espaço.</span>
        </div>
        <div class="col-lg-6">
            <label for="email">Endereço eletrônico</label>
            <div class="m-input-icon m-input-icon--right">
                <input name="email" type="email" class="form-control m-input" id="email" placeholder="E-mail do usuário">
                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
            </div>
            <span class="m-form__help text-info">A senha de acesso será enviada a este e-mail</span>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.cpf').mask("000.000.000-00");

    });
</script>
