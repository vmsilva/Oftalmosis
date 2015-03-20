<?php $id = uniqid(); ?>

<div id="grid-busca-<?php echo $this->idDivContainer?>">
    <!--Se true habilita campo de filtro -->
    <?php if ($this->inputBusca) {
 ?>
        <div class="divfiltrar">
            <i class="icon-search"></i>
            <input type="text" class="filtrar" title="Filtrar" placeholder="Filtrar" tabindex="-1"/>
        </div>
<?php } ?>
    <div class="grid_cabecalho">
        <table width="100%"  id="header-<?php echo $id;?>">
            <thead>
                <tr>
<?php $i = 1;
    foreach ($this->headers as $h) { ?>
                    <th id="<?php echo $this->idDivContainer.'_'.$i++;?>"><?php echo $h; ?></th>
<?php } ?>
                </tr>
            </thead>
        </table>
    </div>
    <div class="grid_corpo">
        <table id="content-<?php echo $id; ?>"width="100%">
            <thead style="display: none">
                <tr>
                    <?php foreach ($this->headers as $h) { ?>
                    <th><?php echo $h; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody class="grid_corpo">
                <?php foreach ($this->dados as $r) {?>
                    <tr data-data='<?php echo json_encode($r); ?>'>
                    <?php 
                        $i = 1;
                        foreach ($this->headers as $campo => $desc) { ?>
                        <td class="<?php echo $this->idDivContainer.'_'.$i++;?>"><?php echo $r[$campo]; ?></td>
                    <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">

        setTimeout(function(){
            $("#content-<?php echo $id; ?>").tablesorter();

           var $target = $('#content-<?php echo $id; ?> thead');

            $('#header-<?php echo $id; ?> thead tr th').each(function(e){
                $(this).data('count',e);
            }).unbind().click(
            function(){
                var c = $(this).data('count');
                var r = $target.find('th').eq(c);
                r.click();
            }
        );
        },900);
    </script>

</div>