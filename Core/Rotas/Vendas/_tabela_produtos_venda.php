<!--begin: Datatable -->
<table class="table table-bordered table-hover table-bordered" id="rotas_table">
    <thead>
        <tr>
            <th class="text-center ">ID</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Produto</th>
            <th class="text-center">QTD</th>
            <th class="text-center">Tipo</th>
            <th class="text-center">Valor</th>
            <th class="text-center"> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">  
                <p> - </p>
            </td>
            <td class="text-center">  
                <p> - </p>
            </td>
            <td class="text-center">  
               <p> - </p>
            </td>
            <td class="text-center">  
               <p> - </p>
            </td>
            <td class="text-center">  
               <p> - </p>
            </td>
            <td class="text-center">  
               <p> - </p>
            </td>
            <td>
                <?php if(isset($_POST['id_produto']) && !empty($_POST['id_produto'])){ ?>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-danger btn-sm" type="button"><span class="flaticon-delete"></span></button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </td>
        </tr>
    </tbody>
</table>