<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label for="cep">CEP</label>
            <input id="cep" name="cep" value="<?php if(isset($endereco['cep'])){ echo $endereco['cep']; }?>" type="text" class="form-control m-input" placeholder="Código de endereçamento postal">
            <span class="m-form__help">Informe para autocompletar</span>
        </div>
    </div>
</div>
<?php include 'Core/Rotas/Endereco/include_select_estado.php'; ?>
<div style="display: none;" id="load_input_estado_municipio">

</div>

<div class="col-md-12">
    <div id='endereco_from_cep' class="form-group m-form__group row">
        <div class="col-md-4">
            <label for="bairro">Bairro</label>
            <input name="bairro" type="text" value="<?php if(isset($endereco['bairro'])){ echo $endereco['bairro']; }?>" class="form-control m-input" placeholder="Informe o bairro">
            <!--<span class="m-form__help">Informe o nome completo</span>-->
        </div>
        <div class="col-md-6">
            <label for="logradouro">Logradouro</label>
            <input name="logradouro" type="text" value="<?php if(isset($endereco['logradouro'])){ echo $endereco['logradouro']; }?>" class="form-control m-input" placeholder="Logradouro">
            <!--<span class="m-form__help">Somente números</span>-->
        </div>
        <div class="col-md-2">
            <label for="numero">Número</label>
            <input name="numero" type="text" class="form-control m-input" value="<?php if(isset($endereco['numero'])){ echo $endereco['numero']; }?>" placeholder="Número do imóvel">
            <!--<span class="m-form__help">Informe o nome completo</span>-->
        </div>
    </div>	 
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label for="complemento">Complemento (Opcional)</label>
            <div class="m-input-icon m-input-icon--right">
                <input name="complemento" type="text" class="form-control m-input" id="usuario" value="<?php if(isset($endereco['complemento'])){ echo $endereco['complemento']; }?>" placeholder="Bloco, apto, andar, etc.">
                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-user"></i></span></span>
            </div>
            <!--<span class="m-form__help">Somente letras e números. Sem espaço.</span>-->
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $("#cep").mask("00000-000");

        $('#cep').off("blur");
        $('#cep').on("input", function () {
            var cep = $(this).val();
            if (cep.length === 9) {
                blockPage();
                $.ajax({
                    url: "http://apps.widenet.com.br/busca-cep/api/cep/" + cep + ".json",
                    success: function (endereco) {
                        unblockPage();
                        preencher_endereco(endereco);
                    }

                });
            }
        });
    });


    function preencher_endereco(endereco) {
        if (endereco.status == 1) {
            $("#reset_geolocation").attr("disabled", false);

            $("#include_estado_municipio").slideUp();
            $("#include_estado_municipio select").prop("disabled", true);
            $('#include_estado_municipio .selectpicker').selectpicker('refresh');
            $("#include_estado_municipio input").prop("disabled", true);

            $("input[name=bairro]").val(endereco.district);
            $("input[name=logradouro]").val(endereco.address);
            $("#load_input_estado_municipio").load("load/input/estado/municipio",
                    {estado_long: endereco.state, estado_short: endereco.state, municipio: endereco.city}, function () {
                $("#load_input_estado_municipio").slideDown();
            });
            var geocoding_address = "Brazil " + endereco.state + " " + endereco.city + " " + endereco.district + " " + endereco.address;
            geocoding(geocoding_address, 15);
        } else {
            $("#endereco_from_cep input").val('');
            notify("CEP não encontrado", "alert-danger");
        }


    }
</script>