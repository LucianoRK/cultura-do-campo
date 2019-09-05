

<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Documentação do sistema
                </h3>
            </div>
        </div>

    </div>
    <div class="m-portlet__body m-portlet--blue">
        <div class="row">
            <div class="col-xl-3">
                <div class="m-tabs" data-tabs="true" data-tabs-contents="#m_sections">
                    <ul class="m-nav m-nav--active-bg m-nav--active-bg-padding-lg m-nav--font-lg m-nav--font-bold m--margin-bottom-20 m--margin-top-10 m--margin-right-40" id="m_nav" role="tablist">
                        <li class="m-nav__item">
                            <a class="m-nav__link m-tabs__item m-tabs__item--active" data-tab-target="#doc1" href="#">
                                <span class="m-nav__link-text">Título</span>
                            </a>
                        </li>


                        <li class="m-nav__item">
                            <a class="m-nav__link m-tabs__item" data-tab-target="#abc" href="#">
                                <span class="m-nav__link-text">Nota fiscal</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="m-tabs-content" id="m_sections">

                    <div class="m-tabs-content__item m-tabs-content__item--active" id="doc1">
                        <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">Título</h4>
                        <div class="m-accordion m-accordion--section m-accordion--padding-lg" id="doc1_content">

                            Escreva o conteúdo aqui
                        </div>
                    </div>
                    <div class="m-tabs-content__item" id="abc">
                        <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">Dados da NFe</h4>
                        <div class="m-accordion m-accordion--section m-accordion--padding-lg" id="doc2_content">

                            <div class="m-accordion m-accordion--bordered" id="m_section_3_content">

                                <!--begin::Item-->
                                <div class="m-accordion__item">
                                    <div class="m-accordion__item-head" role="tab" id="m_section_3_content_1_head" data-toggle="collapse" href="#m_section_3_content_1_body" aria-expanded="true">
<!--                                        <span class="m-accordion__item-icon"><i class="flaticon-gift"></i></span>-->
                                        <span class="m-accordion__item-title">Cabeçalho</span>
                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse show" id="m_section_3_content_1_body" role="tabpanel" aria-labelledby="m_section_3_content_1_head" data-parent="#m_section_3_content" style="">
                                        <div class="m-accordion__item-content">
                                            <p>
                                                <strong>cUF</strong>: Código da unidade federativa (ex: 41 = Paraná)
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>cNF</strong>: Código Numérico que compõe a Chave de Acesso da NF-e. Esse campo deve ser preenchido com um número aleatório gerado pelo emitente para cada NF-e para evitar acessos indevidos da NF-e (v 2.0).
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>natOp</strong>: Na NF-e existe o campo natOp - Descrição da Natureza da Operação da NF-e. Esse campo deve ser preenchido com a natureza da operação de que decorrer a saída ou a entrada, 
                                                tais como: venda, compra, transferência, devolução, importação, consignação, remessa (para fins de demonstração, de industrialização ou outra), conforme previsto na alínea 'i', inciso I, art. 19 do CONVÊNIO S/Nº, de 15 de dezembro de 1970.
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>indPag</strong>: Na NF-e existe o campo indPag - Indicador da forma de pagamento da NF-e. Esse campo pode ser preenchido com os seguintes valores:
                                            <ul>
                                                <li>0 = Pagamento à vista</li>
                                                <li>1 = Pagamento a prazo</li>
                                                <li>2 = Outros</li>
                                            </ul>
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>mod</strong>: Modelo da nota fiscal
                                            <ul>
                                                <li>55 = NFe</li>
                                                <li>65 = NFC-e</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>serie</strong>: Número sequencial que define a numeração da nota e no caso de empresas que utilizam mais de uma série facilita a identificação do grupo de notas a que pertence tal série.
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>nNF</strong>: Número do Documento Fiscal da NF-e. Esse campo deve ser preenchido com o número do documento fiscal definido pelo emitente.
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>dhEmi</strong>: Data e hora da emissão no formato UTC (ex: 2019-04-06T20:48:00-02:00)
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>dhSaiEnt</strong>: Registra o dia e a hora exata em que ocorreu a movimentação da mercadoria, deixando ou retornando à empresa, no formato UTC (ex: 2019-04-06T20:48:00-02:00)
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>tpNF</strong>: Tipo de Operação da NF-e. Esse campo pode ser preenchido com os seguintes valores:
                                            <ul>
                                                <li>0 = Entrada</li>
                                                <li>1 = Saída</li>
                                            </ul>
                                            </p>
                                            <p>
                                                <strong>idDest</strong>: Identificador de local de destino da operação.
                                            <ul>
                                                <li>1 = Operação interna</li>
                                                <li>2 = Operação interestadual</li>
                                                <li>3 = Operação com exterior</li>
                                            </ul>
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>cMunFG</strong>: Código do Município de Ocorrência do Fato Gerador 
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>tpImp</strong>: Formato de Impressão do DANFE
                                            <ul>
                                                <li>0 = Sem geração de DANFE</li>
                                                <li>1 = DANFE retrato</li>
                                                <li>2 = DANGE paisagem</li>
                                                <li>3 = DANFE simplificado</li>
                                            </ul>

                                            </p>
                                            <hr>

                                            <p>
                                                <strong>tpEmis</strong>: Tipo de Emissão da NF-e
                                            <ul>
                                                <li>1 = Emissão normal</li>
                                                <li>Veja outras informações no site da receita</li>
                                            </ul>
                                            </p>
                                            <hr>

                                            <p>
                                                <strong>cDV</strong>: Dígito Verificador da Chave de Acesso da NF-e <a href="https://nstecnologia.com.br/blog/digito-verificador-da-chave-de-acesso/" target="_blank">Ver mais</a>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>tpAmb</strong>: Ambiente que será feita a Nfe
                                            <ul>
                                                <li>1 = Produção</li>
                                                <li>2 = Homologação/Teste</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>finNFe</strong>: Finalidade de emissão da NF-e 
                                            <ul>
                                                <li>1 = NF-e normal</li>
                                                <li>2 = NF-e complementar</li>
                                                <li>3 = NF-e de ajuste</li>
                                                <li>4 = Devolução/Retorno</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>indFinal</strong>: Indica operação com Consumidor final 
                                            <ul>
                                                <li>0 = Não</li>
                                                <li>1 = Sim</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>indPres</strong>: Indicador de presença do comprador no estabelecimento comercial no momento da operação
                                            <ul>
                                                <li>0 = Não se aplica</li>
                                                <li>1 = Presencial</li>
                                                <li>2 = Não presencial, pela Internet</li>
                                                <li>3 = Não presencial, teleatendimento</li>
                                                <li>9 = Não presencial, outros</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>procEmi</strong>: Processo de emissão da NF-e
                                            <ul>
                                                <li>0 = Emissão de NF-e com aplicativo do contribuinte</li>
                                                <li>1 = Emissão de NF-e avulsa pelo Fisco</li>
                                                <li>2 = Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco</li>
                                                <li>3 = Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco</li>
                                            </ul>
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>verProc</strong>: Versão do Processo de emissão da NF-e
                                            </p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>