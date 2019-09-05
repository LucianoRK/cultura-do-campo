<?php
$term   = $_POST['term'];
$result = array();
if (strlen($term) > 0) {
    $o_rota = new Rota();
    $result = $o_rota->find_rota_or_conteudo($term);
}
?>

<ul id="myUL">



    <?php if (is_array($result)) { ?>
        <?php foreach ($result as $value) { ?>
            <li>
                <a href="#"><?php echo STRINGS::regex_to_url($value['expressao']); ?><br><small class="text-muted"><?php echo $value['conteudo']; ?></small></a>
                
            </li>
        <?php } ?>
    <?php } else { ?>

    <?php } ?>

</ul>
