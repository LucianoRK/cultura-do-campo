<?php
    try {
        $db = DB::get_instance();
        $db->beginTransaction();
        
        if(isset($_POST['id_compra']) && !empty($_POST['id_compra'])){
            $id_compra = $_POST['id_compra'];
        }else{
            APP::return_response(false, "Não foi possível efetivar esta compra");
        }
        
        $o_compra = new Compras();
        $o_compra->efetivar_compra($id_compra);
        
        $db->commit();
        APP::return_response(true, "Compra efetivada com sucesso");
    } catch (Exception $exc) {
        $db->rollback();
        //gravar o erro no banco com o handling
    }