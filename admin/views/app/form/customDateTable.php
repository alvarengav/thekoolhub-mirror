<?php $uniqid = uniqid();?>
<div class="clearfix"></div>
<table id="table_<?= $uniqid ?>" class="display" style="width:100%; margin-top: 50px">
    <thead>
        <tr>
            <? foreach($rows as $i => $v) : ?>
                <th><?= $v->title ?></th> 
            <? endforeach; ?>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <? foreach($rows as $i => $v) : ?>
                <th><?= $v->title ?></th> 
            <? endforeach; ?>
        </tr>
    </tfoot>
</table>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        var dataSet = [
            <? foreach($data as $i => $row) : ?>
                {
                    <? foreach($row as $k => $v) : ?>
                        "<?= $k ?>": "<?= escapeJsonString($v) ?>",
                    <? endforeach; ?>
                },
            <? endforeach; ?>
        ];

        $('#table_<?= $uniqid ?>').DataTable({
            data: dataSet,
            columns: [
                <? foreach($rows as $i => $v) : ?>
                { data: '<?= $v->key ?>' },
                <? endforeach; ?>
            ]
        });
    });
</script>