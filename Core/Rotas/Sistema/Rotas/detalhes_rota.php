<?php
$o_rota = new Rota();
$o_parametro = new Parametro();
$o_permissao = new Permissao();

$arr_permissoes = $o_permissao->select_all_permissoes();

$o_rota->set_id_rota($_GET['id_rota']);
$rota = $o_rota->select_rota_from_id();

$permissoes_rota = explode(",", $rota['permissoes']);

if (!$rota) {
    $base_url = APP::get_base_url();
    header("Location: {$base_url}/dashboard", true, 301);
}
$parametros_get = $o_parametro->select_parametros($_GET['id_rota']);

$arquivos_base = $o_rota->get_arquivos_base();
$array_parametros = explode("/", $rota['expressao']);

foreach ($array_parametros as $key => $value) {
    $array['nome'] = STRINGS::string_to_uri($value);

    $array['expressao'] = "Palavra fixa";
    if (!isset($array_parametros[$key])) {
        $array_parametros[$key] = array();
    }
    $array_parametros[$key] = $array;
}

foreach ($parametros_get as $value) {
    $index = $value['indice'];
    $array_parametros[$index]['nome'] = $value['nome'];
    $array_parametros[$index]['expressao'] = $value['expressao'];
}

foreach ($array_parametros as $key => $value) {
    if ($value['expressao'] == "STRING" || $value['expressao'] == "INT") {
        $value['categoria'] = "1";
    } else {
        $value['categoria'] = "2";
    }
    $array_parametros[$key] = $value;
}

array_pop($array_parametros);
$json_parametros = json_encode($array_parametros);
?>

<div class="" > 
    <div class="m-subheader ">
        <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
            <div class="m-portlet__head portlet_round">
                <div class="m-portlet__head-progress">
                    <!-- here can place a progress bar-->
                </div>
                <div class="m-portlet__head-wrapper">
                    <div class="m-portlet__head-caption">

                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <!--<span class="fa fa-user-secret m--margin-right-20 text-dark"></span>--> 
                                <span class="text-dark" style="font-weight: lighter;">Rota #<?php echo $_GET['id_rota']; ?> - Detalhes</span>
                            </h3>

                        </div>
                    </div>
                    <div class="m-portlet__head-tools">

                        <div class="btn-group">
                            <div class="m-portlet__head-tools">

                                <button id="excluir_rota" id_rota="<?php echo $rota['id_rota']; ?>" class="btn btn-danger m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                    <span>
                                        <i class="la la-trash"></i>
                                        <span>Desativar rota</span>
                                    </span>
                                </button>
                                <div class="btn-group">
                                    <button id="salvar_alteracoes" type="button" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md">
                                        <span>
                                            <i class="la la-check"></i>
                                            <span>Salvar alterações</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Form Body -->
                <div class="m-portlet__body">
                    <form id="form_rotas" class="m-form m-form--fit m-form--label-align-right">
                        <input readonly="" type="hidden" id="id_rota" class="form-control" value="<?php echo $rota['id_rota']; ?>">

                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <div class="row m--padding-bottom-20">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>Conteúdo</label>
                                            <div class="input-group mb-3">
                                                <input disabled="" type="text" class="form-control" value="<?php echo $rota['conteudo']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Matriz *</label>
                                            <select name="matriz" class="form-control selectpicker" id="select_matriz">
                                                <option selected value="0">Arquivo load/ajax</option>

                                                <?php if ($arquivos_base) { ?>
                                                    <?php foreach ($arquivos_base as $arquivo) { ?>
                                                        <option <?php echo $rota['matriz'] == $arquivo['arquivo'] ? 'selected' : '' ?> value="<?php echo $arquivo['arquivo']; ?>"><?php echo $arquivo['nome']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m--padding-bottom-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">URI*</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-icon-addon1">.com.br/</span>
                                                </div>
                                                <input name="url" id="input_url" type="text" class="form-control m-input" placeholder="Nome do caminho (Somente letras)" value="<?php echo $rota['url']; ?>">

                                            </div>
                                            <small class="form-text text-muted">URI identificador da página (ex: perfil, anuncios)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Precisa estar logado? *</label>
                                            <select id="publico" name="publico" class="form-control selectpicker" id="">
                                                <option <?php echo!$rota['publico'] ? 'selected' : '' ?> value="0">Sim, precisa de uma sessão ativa</option>
                                                <option <?php echo $rota['publico'] ? 'selected' : '' ?> value="1" >Não importa, qualquer um pode acessar</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="row m--padding-bottom-20">
                                    <div class="col-md-6">
                                        <label class="">Vincular permissões (Opcional):</label>
                                        <select id="vinculo_permissoes" name="permissoes[]" class="form-control m-input selectpicker" multiple>
                                            <?php if ($arr_permissoes) { ?>
                                                <?php foreach ($arr_permissoes as $value) { ?>
                                                    <?php
                                                    if (in_array($value['id_permissao'], $permissoes_rota)) {
                                                        ?>
                                                        <option selected value='<?php echo $value['id_permissao']; ?>'><?php echo $value['descricao']; ?></option>
                                                    <?php } else { ?>
                                                        <option value='<?php echo $value['id_permissao']; ?>'><?php echo $value['descricao']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div id="div_parametros" class="m--margin-top-50">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Categoria</label>

                                                <select class="form-control selectpicker" id="categoria">
                                                    <option value="1">Expressão regular</option>
                                                    <option value="2">Palavra fixa</option>
                                                </select>
                                            </div>
                                            <div id="expressao_regular">

                                                <div class="form-group">
                                                    <label>Tipo regex</label>
                                                    <select class="form-control selectpicker" id="expressao_select">
                                                        <option value="STRING">Somente letras ou números</option>
                                                        <option value="INT">Somente números</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <div class="input-group mb-3">
                                                        <input id="nome_parametro" type="text" class="form-control somente_letras" placeholder="Nome do parâmetro (e.g. id, nome, valor)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="palavra_fixa" style="display: none">

                                                <div class="form-group">
                                                    <label>Palavra</label>
                                                    <div class="input-group mb-3">
                                                        <input id="palavra_url" type="text" class="form-control somente_letras" placeholder="Nome do parâmetro (e.g. id, nome, valor)" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-1">
                                            <div class="text-center m--margin-top-50">
                                                <button type="button" id="add_parametro" class="btn btn-info btn-outline-info"><span class="la la-arrow-right"></span></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table id="tabela_de_parametros" class="table table-bordered">
                                                    <thead>
                                                        <tr style="background: rgba(0,0,0,0.025)">
                                                            <th class="text-center">Parâmetro</th>
                                                            <th class="text-center">Tipo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        var parametros_array = '<?php echo $json_parametros ?>';
        parametros_array = JSON.parse(parametros_array);
        parametros_array.shift();
        add_on_table(parametros_array);

        $("#salvar_alteracoes").on("click", function () {
            var id_rota = $("#id_rota").val();

            var url = $("#input_url").val();
            var publico = $("#publico").val();
            var matriz = $("#select_matriz").val();
            var conteudo = $("#select_conteudo").val();
            var permissoes = $("#vinculo_permissoes").val()

            $.post(
                    'sistema/rotas/editar',
                    {id_rota: id_rota, url: url, publico: publico, matriz: matriz, conteudo: conteudo, params: parametros_array, permissoes: permissoes},
                    function (response) {
                        alert(response);
//                        if (is_json(response)) {
//                            response = JSON.parse(response);
//                            swal(response.message);
//                            if (response.result) {
//                                load_rotas();
//                            }
//                        }
                    });

        });


        $("#add_parametro").on("click", function () {
            var categoria = $("#categoria").val();
            var array_parametro = [];
            var nome_parametro = $("#nome_parametro").val();
            if (nome_parametro.length > 0 || categoria !== "1") {
                if (categoria === "1") {
                    array_parametro = {expressao: $("#expressao_select").val(), nome: nome_parametro, categoria: categoria};
                } else {
                    array_parametro = {expressao: "Palavra fixa", nome: $("#palavra_url").val(), categoria: categoria};
                }
                parametros_array.push(array_parametro);
                add_on_table(parametros_array);
            } else {
                swal("Informe o nome do parâmetro");
            }
        });


        $("#categoria").on("change", function () {
            if (this.value === "1") {
                $("#expressao_regular").show();
                $("#palavra_fixa").hide();

            } else {
                $("#expressao_regular").hide();
                $("#palavra_fixa").show();
            }

        });


        $("#input_url").on("keydown", function (event) {
            // Allow controls such as backspace, tab etc.
            var arr = [8, 9, 16, 17, 20, 35, 36, 37, 38, 39, 40, 45, 46, 173, 109];

            // Allow varters
            for (var i = 65; i <= 90; i++) {
                arr.push(i);
            }

            // Prevent default if not in array
            if (jQuery.inArray(event.which, arr) === -1) {
                event.preventDefault();
            } else {
                $(".url").html($("#input_url").val());
            }
        });

        $("#input_url").on("input", function () {
            var regexp = /[^a-zA-Z-]/g;
            if ($(this).val().match(regexp)) {
                $(this).val($(this).val().replace(regexp, ''));
            } else {
                $(".url").html($("#input_url").val());

            }
        });

        $(".somente_letras").on("keydown", function (event) {
            // Allow controls such as backspace, tab etc.
            var arr = [8, 9, 16, 17, 20, 35, 36, 37, 38, 39, 40, 45, 46, 189];

            // Allow varters
            for (var i = 65; i <= 90; i++) {
                arr.push(i);
            }

            // Prevent default if not in array
            if (jQuery.inArray(event.which, arr) === -1 && (event.which === 189 && event.shiftKey === true)) {
                event.preventDefault();
            } else {
            }
        });

        $(".somente_letras").on("input", function () {
            var regexp = /[^a-zA-Z-_]/g;
            if ($(this).val().match(regexp)) {
                $(this).val($(this).val().replace(regexp, ''));
            } else {
            }
        });

        $("#excluir_rota").off("click");
        $("#excluir_rota").on("click", function () {
            var id = $(this).attr('id_rota');
            $.post("sistema/rotas/excluir", {id_rota: id}, function (response) {
                alert(response);
            });
        });


    });


    function add_on_table(parametros_array) {
        $("#tabela_de_parametros tbody").html("");
        $.each(parametros_array, function (key, value) {
            if (value.categoria === "1") {
                $("#tabela_de_parametros tbody").append("<tr><td class='text-center'>$_GET['" + value.nome + "']</td> <td class='text-center'>" + value.expressao + "</td></tr>");
            } else {
                $("#tabela_de_parametros tbody").append("<tr><td class='text-center'>" + value.nome + "</td><td class='text-center'>Palavra fixa</td></tr>");
            }
        });
    }
</script>