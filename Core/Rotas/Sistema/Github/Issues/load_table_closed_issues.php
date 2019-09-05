<?php
$issues = GITHUB::get_closed_issues();
?> 

<table id="table_closed_issues" class="table table-hover animated fadeIn" style="border: 1px solid #ECEFF1;">
    <thead style="display: none">
        <tr>
            <td>Título</td>
            <td>Responsáveis</td>
            <td>Comentários</td>
            <td>Link</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($issues) { ?>

            <?php foreach ($issues as $value) { ?>
                <tr style="background: #fefefe">
                    <td>
                        <span class="text-dark" style="font-size: 14px">
                            <a style="text-decoration:line-through;" href="<?php echo $value['html_url']; ?>" target="_blank" class="text-dark"><?php echo $value['title']; ?></a></span>
                        <?php if ($value['labels']) { ?>
                            <?php foreach ($value['labels'] as $label) { ?>
                                <!--<label class="badge" style="color: white; background-color: #<?php // echo $label['color'] ?>"><?php // echo $label['name']; ?></label>-->
                            <?php } ?>
                        <?php } ?>

                        <br>
                        <small class="text-muted">
                            #<?php echo $value['number']; ?> 
                            <strong>fechado</strong> no dia <?php echo strftime("%d de %b, %Y", strtotime($value['closed_at'])); ?>
                            
                        </small>
                    </td>

                    <td>
                        <?php if ($value['assignees']) { ?>
                            <?php foreach ($value['assignees'] as $assignee) { ?>
                                <?php if ($assignee['login'] !== "culturadocampo") { ?>
                                    <img title="<?php echo $assignee['login']; ?>" class="issue_avatar img-thumbnail" width="40px" height="auto" src='<?php echo $assignee['avatar_url']; ?>'>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($value['comments'] > 0) { ?>
                            <i style="font-size: 16px;" class="flaticon-comment"></i>
                            <span style="font-size: 16px;"><?php echo $value['comments']; ?></span>
                        <?php } ?>

                    </td>
                    <td>
                        <a href="<?php echo $value['html_url']; ?>" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-external-link-alt text-muted"></i></a>
                    </td>
                </tr>
            <?php } ?>

        <?php } else { ?>
            <tr>
                <td colspan="4" class="text-center">Nenhuma issues fechada.</td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<script>
    $(document).ready(function () {
        $("#table_closed_issues").DataTable({
            paging: false
        });
    });
</script>
