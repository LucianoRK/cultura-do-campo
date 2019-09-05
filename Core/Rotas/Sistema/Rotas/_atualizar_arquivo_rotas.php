<?php

try {
    APP::check_htaccess();
    APP::return_response(true, "Arquivo atualizado com sucesso");
} catch (Exception $exc) {
    
}

