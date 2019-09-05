<?php
    if (isset($_POST['categoria'])) {
        $o_produtos = new Produto();
        $produtos = $o_produtos->select_produtos_por_categoria($_POST['categoria']);
    } else {
        $produtos = false;
    }
?>

<?php if ($produtos) { ?>
     <select data-live-search="true" name="produto" id="produto" class="form-control m-input selectpicker text-center">
        <option selected="" disabled="">Produtos</option>
        <?php foreach ($produtos as $value) { ?>
            <option value="<?php echo $value['id_produto']; ?>"><?php echo $value['nome']; ?></option>
        <?php } ?>
    </select>
<?php } else { ?>
    <select disabled="" class="form-control m-input selectpicker text-center">
        <option selected="" readonly="">Produtos</option>
    </select>
<?php } ?>

<script>
    $(document).ready(function () {
        $(".selectpicker").selectpicker();
    });
</script>
