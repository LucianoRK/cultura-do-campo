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
        if(!isset($_POST['estado']) || empty($_POST['estado'])){
            $_POST['estado'] = false;
        }
        
        if(!isset($_POST['municipio']) || empty($_POST['municipio'])){
            $_POST['municipio'] = false;
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
        $fk_endereco = $o_endereco->insertEndereco();
        
        
        // Fornecedor
        $o_fornecedor->setCnpj($_POST['cnpj']);
        $o_fornecedor->setNomeFantasia($_POST['nome_fantasia']);
        $o_fornecedor->setRazaoSocial($_POST['razao_social']);
        $id_fornecedor = $o_fornecedor->insertFornecedor($fk_endereco, SESSION::get_id_filiado());

        
        // Contas bancarias
        if(isset($_POST['banco']) && !empty($_POST['banco'])){
            $o_conta_bancaria->setAgencia($_POST['agencia']);
            $o_conta_bancaria->setBanco($_POST['banco']);
            $o_conta_bancaria->setConta($_POST['conta']);
            $o_conta_bancaria->insertContaBancaria($id_fornecedor);
        }
        
        
        // Telefone
        if(!isset($_POST['telefones']) || empty($_POST['telefones'])){
            $telefones = false;
        }else{
            $telefones = $_POST['telefones'];
        }
        
        if($telefones){
            foreach($telefones as $telefone){
                $o_telefone->setTipoTelefone($telefone['tipo_telefone']);
                $o_telefone->setTelefone($telefone['telefone']);
                $o_telefone->insert_telefone($id_fornecedor);
            }
        }

        $db->commit();
        APP::return_response(true, "Cadastro realizada com sucesso");
        
    } catch (Exception $exc) {
        $db->rollback();
        //gravar o erro no banco com o handling
    }
    
?>