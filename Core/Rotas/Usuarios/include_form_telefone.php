<hr>
<div class="col-md-12 ">
    <div class="form-group m-form__group">
        <div id="telefone_repeater" >
            <div data-repeater-list="telefones">
                <div data-repeater-item class="row align-items-center m--margin-bottom-10 telefone_fields">
                    <div class="col-md-4">
                        <select name="tipo_telefone" class="form-control tipo_telefone selectpicker">
                                <option value="1">Celular/WhatsApp</option>
                                <option value="2">Telefone fixo</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input name="telefone" type="text" class="form-control celular phone" placeholder="(xx) xxxxx-xxxx">
                            <div class="input-group-append">
                                <button data-repeater-delete="" class="btn btn-danger btn-sm" type="button"><span class="flaticon-delete"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div data-repeater-create class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--wide">
                <span>
                    <i class="la la-plus"></i>
                    <span>Adicionar</span>
                </span>
            </div>
        </div>
    </div>
</div>
<hr>

<script>
    $(document).ready(function () {
        initMask();
        setInterval(function () {
            $(".selectpicker").selectpicker();
        }, 500);

        $("#telefone_repeater").on("change", ".tipo_telefone", function () {
            var tipo_telefone = $(this).val();
            if (tipo_telefone > 0) {
                var input = $(this).parent().parent().parent().find(".phone");
                input.val("");
                if (tipo_telefone == 1) {
                    input.addClass("celular");
                    input.removeClass("telefone_fixo");
                } else {
                    input.addClass("telefone_fixo");
                    input.removeClass("celular");
                }
                initMask();

            }
        });

        $('#telefone_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
                initMask();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        });
    });

    function initMask() {
        $('.telefone_fixo').mask("00 0000 0000");
        $('.celular').mask("00 00000 0000");
    }
</script>
