<?php
    if(isset($_POST['fornecedor']) && !empty($_POST['fornecedor'])){
            $fk_fornecedor = $_POST['fornecedor'];
            $fk_filiado = SESSION::get_id_filiado();
            
            $o_fornecedor = new Fornecedor();
            
            try {
                $db = DB::get_instance();
                $db->beginTransaction();
                
                $fornecedor = $o_fornecedor->select_fornecedor($fk_fornecedor);
                $o_fornecedor->inativar_fornecedor($fk_fornecedor, $fk_filiado, $fornecedor['fk_endereco']);
                
                $db->commit();
                APP::return_response(true, "Fornecedor excluido com sucesso");
            } catch (Exception $exc) {
                $db->rollback();
            }
    }else{
        APP::return_response(true, "Fornecedor inválido contacte o suporte");
    }