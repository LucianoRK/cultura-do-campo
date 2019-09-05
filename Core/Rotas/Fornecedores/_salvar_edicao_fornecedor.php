<?php
    
    $o_telefone       = new FornecedorTelefone();
    $o_endereco       = new Endereco();
    $o_conta_bancaria = new ContaBancaria();
    $o_fornecedor     = new Fornecedor();

        
    try {
        $db = DB::get_instance();
        $db->beginTransaction();
        
        /*
        * Endereço
        */
        if(!isset($_POST['municipio']) || empty($_POST['municipio'])){
            APP::return_response(false, "Município selecionado é inválido");
        }
        
        $id_estado = $o_endereco->get_id_from_uf($_POST['estado']);
        $id_municipio = $o_endereco->get_id_from_nome_municipio($_POST['municipio']);
        if (!$id_estado) {
            APP::return_response(false, "Estado selecionado é inválido");
        }
        if (!$id_municipio) {
            APP::return_response(false, "Município selecionado é inválido");
        }
        $o_endereco->set_estado($id_estado);
        $o_endereco->set_municipio($id_municipio);
        $o_endereco->set_complemento($_POST['complemento']);
        $o_endereco->set_bairro($_POST['bairro']);
        $o_endereco->set_cep($_POST['cep'], false);
        $o_endereco->set_logradouro($_POST['logradouro'], false);
        $o_endereco->set_numero($_POST['numero'], false);
        $fk_endereco = $o_endereco->updateEndereco($_POST['id_endereco']);
        
        
        // Fornecedor
        //$o_fornecedor->setCnpj($_POST['cnpj']);
        $o_fornecedor->setNomeFantasia($_POST['nome_fantasia']);
        $o_fornecedor->setRazaoSocial($_POST['razao_social']);
        $id_fornecedor = $o_fornecedor->updateFornecedor($_POST['id_fornecedor']);

        
        // Contas bancarias
        if(isset($_POST['banco']) && !empty($_POST['banco'])){
            $o_conta_bancaria->setAgencia($_POST['agencia']);
            $o_conta_bancaria->setBanco($_POST['banco']);
            $o_conta_bancaria->setConta($_POST['conta']);
            $o_conta_bancaria->updateContaBancaria($_POST['id_conta_bancaria']);
        }
        
        
        // Telefone
        if(isset($_POST['telefones'][0]['telefone']) && !empty($_POST['telefones'][0]['telefone'])){
            $telefones = $_POST['telefones'];
            
            /* Caso seja digitado algum numero de telefone na edição
                eu desativo todos os numeros existente no banco deste fornecedor */
            $o_telefone->desativa_telefone($_POST['id_fornecedor']);
            
            foreach($telefones as $telefone){
                $o_telefone->setTipoTelefone($telefone['tipo_telefone']);
                $o_telefone->setTelefone($telefone['telefone']);
                $o_telefone->insert_telefone($_POST['id_fornecedor']);
            }
        }

        $db->commit();
        APP::return_response(true, "Alteração realizada com sucesso");
        
    } catch (Exception $exc) {
        $db->rollback();
        //gravar o erro no banco com o handling
    }
    
?>