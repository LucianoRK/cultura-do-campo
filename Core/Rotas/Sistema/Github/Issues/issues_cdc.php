<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Issues abertas
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a target="_blank" href="https://github.com/culturadocampo/admin/issues/new" class="m-portlet__nav-link m-portlet__nav-link--icon"><i style="color:white" class=" la la-plus "></i></a>
                </li>

            </ul>
        </div>
    </div>
    <div id="tabela_issues" class="m-portlet__body" style="min-height: 150px;">	

    </div>

</div>

<div class="m-portlet m-portlet--green m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Issues fechadas
                </h3>
            </div>
        </div>
    </div>
    <div id="tabela_closed_issues" class="m-portlet__body" style="min-height: 150px;">	

    </div>

</div>


<script>
    $(document).ready(function () {
        var openedIssues = $("#tabela_issues");
        var closedIssues = $("#tabela_closed_issues");

        blockElement(openedIssues);
        blockElement(closedIssues);
        $("#tabela_issues").load("sistema/issues/tabela", {}, function () {
            unblockElement(openedIssues);
        });
        $("#tabela_closed_issues").load("sistema/issues/tabela/closed", {}, function () {
            unblockElement(closedIssues);
        });
    });
</script>


