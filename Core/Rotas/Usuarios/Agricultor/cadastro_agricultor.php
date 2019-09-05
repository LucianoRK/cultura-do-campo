<div id="cadastro_agricultor">

</div>




<script>
    $(document).ready(function () {
        blockPage();
        load_form();

    });

    function load_form() {
        $("#cadastro_agricultor").load("usuario/form/agricultor", {}, unblockPage());
    }

</script>