<?php
$o_entrega = new Entrega();
$o_entrega->set_id_entrega($_GET['id_entrega']);
$array_clientes = $o_entrega->select_clientes_entrega();

?>

<script src='Public/Scripts/mapbox_entregas.js'></script>
<div class="" > 

<section class="page-content animated ">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card card-border-primary">
                <div class="card-header">
                    Informações da entrega
                </div>

                <ul class="nav sub-nav v-sub-nav flex-column">
                    <li>
                        <a class="nav-link" href="#"><i class="icon dripicons-pin text-dark font-size-22 v-align-middle p-r-15 p-t-5"></i><span class="font-weight-500" id="num_entregas">0 Entregas</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"><i class="icon text-dark dripicons-meter  font-size-22 v-align-middle p-r-15 p-t-5"></i><span class="font-weight-500" id="distancia">0.00 KM</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"><i class="icon dripicons-clock font-size-22 v-align-middle p-r-15 p-t-5"></i><span class="font-weight-500" id="tempo">0:00 horas</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"><i class="icon dripicons-calendar font-size-22 v-align-middle p-r-15 p-t-5"></i><span class="font-weight-500" id="">05/11/2018</span></a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"><i class="icon dripicons-wallet font-size-22 v-align-middle p-r-15 p-t-5"></i><span class="font-weight-500" id="">R$ 38.00</span></a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card card-tabs">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs primary-tabs m-0">
                        <li role="presentation"><a href="#mapa-de-rotas" class="nav-link active show" data-toggle="tab" aria-expanded="true"><i class="la la-map m-r-10"></i> Itinerário</a></li>
                        <li role="presentation"><a href="#profile-photos" class="nav-link" data-toggle="tab" aria-expanded="true"><i class="la la-group m-r-10"></i> Clientes</a></li>
                        <li role="presentation"><a href="#profile-contacts" class="nav-link" data-toggle="tab" aria-expanded="true"><i class="la la-check m-r-10"></i> Processo de entrega</a></li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content">
                        <div class="tab-pane fadeIn active p-0 m-0" id="mapa-de-rotas">
                            <div id='entrega_mapbox' class='rounded p-0 m-0' style="min-height: 667px; max-height: 667px"></div>
                        </div>
                        <div class="tab-pane fadeIn" id="profile-photos">
                            <div class="tab-pane fade active show" id="sales-month-tab" role="tabpanel" aria-labelledby="sales-month-tab">
                                <table class="table v-align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="p-l-20">Nome</th>
                                            <th>Valor</th>
                                            <th>Itens</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($array_clientes) { ?>
                                            <?php foreach ($array_clientes as $value) { ?>
                                                <tr>
                                                    <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/27.jpg" alt="">
                                                        <strong class="nowrap"><?php echo STRINGS::proper_case($value['nome']); ?></strong>
                                                    </td>
                                                    <td>R$ 5.00</td>
                                                    <td><span class="badge badge-pill badge-success">1</span></td>
                                                </tr>
                                            <?php } ?>

                                        <?php } ?>




                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="sales-year-tab" role="tabpanel" aria-labelledby="sales-year-tab">
                                <table class="table v-align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Earnings</th>
                                            <th>Quota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/02.jpg" alt="">
                                                <strong class="nowrap">Mike Jones </strong>
                                            </td>
                                            <td>$587,000</td>
                                            <td><span class="badge badge-pill badge-success">Above</span></td>
                                        </tr>
                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/6.jpg" alt="">
                                                <strong class="nowrap">Leslie	Chapman</strong></td>
                                            <td>$427,600</td>
                                            <td><span class="badge badge-pill badge-success">Above</span></td>
                                        </tr>
                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/7.jpg" alt="">
                                                <strong class="nowrap">Taylor Collier</strong></td>
                                            <td>$323,200</td>

                                            <td><span class="badge badge-pill badge-success">Above</span></td>
                                        </tr>
                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/35.jpg" alt="">
                                                <strong class="nowrap">Dominic Shaw</strong></td>
                                            <td>$321,000</td>

                                            <td><span class="badge badge-pill badge-info">Met</span></td>
                                        </tr>
                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/38.jpg" alt="">
                                                <strong class="nowrap">Josh Lynch</strong></td>
                                            <td>$293,500</td>
                                            <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                        </tr>

                                        <tr>
                                            <td><img class="align-self-center mr-3 ml-2 w-50 rounded-circle" src="../assets/img/avatars/30.jpg" alt="">
                                                <strong class="nowrap">Angelo	Parker</strong></td>
                                            <td>$87,300</td>
                                            <td><span class="badge badge-pill badge-danger">Danger</span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fadeIn contact-list" id="profile-contacts">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    </div>


<script>
    $(document).ready(function () {
        $.post('entregas/_informacoes_entrega', {id_entrega: '<?php echo $_GET['id_entrega']; ?>'}, function (response) {
            if (is_json(response)) {
                alert(response);
                var data = JSON.parse(response);
                initMapbox(data);
            }
        });
    });
</script>
