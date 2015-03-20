<?php session_start();
    include '../../authentic/model/mecanismo.php';
    $cd_empresa = $_SESSION['cd_empresa_usu'];
    $G_MEC = new Mecanismo();
    $cd_pac = $G_MEC->recebePost($_POST, 'cd_pac');
    SMG_M0014::setcd_pac($cd_pac);
    $st_pac = '0';
    SMG_M0014::setst_pac($st_pac);
    $rs = SMG_M0014::consultaCodigo();
    if(is_array($rs)){
        SMG_M0019::setcd_empresa($cd_empresa);
        $cd_cnes = '5208706449409';
        SMG_M0019::setcd_cnes($cd_cnes);
        SMG_M0019::setcd_pac($cd_pac);
        $rsPacSMS = SMG_M0019::ConsultaCodigo();
        ?>
        <div id="scp_ha014-fa014">
            <form id="scp_fa014">
                <div class="linha">
                    <input type="hidden" id="fa014-cd_pac" name="fa014[cd_pac]" value="<?php echo $rs[0]['cd_pac']; ?>"/>
                    <input type="hidden" id="fa014-cd_pac_cnes" name="fa014[cd_pac_cnes]" value="<?php echo $rsPacSMS[0]['cd_pac_cnes']; ?>"/>
                </div>
                <div class="linha">
                    <label>Sexo:</label>
                    <input type="text" id="fa014-tp_sexo_pac_aux" name="fa014[tp_sexo_pac_aux]" title="Sexo Paciente" value="<?php echo $G_MEC->EnumSexo($rs[0]['tp_sexo_pac']); ?>" readonly/>
                    <label id="fa014-lbl_dt_nasc_pac_aux">Dt.Nasc.:</label>
                    <input type="text" id="fa014-dt_nasc_pac_aux" name="fa014[dt_nasc_pac_aux]" value="<?php echo $G_MEC->FormataDatacomBarra($rs[0]['dt_nasc_pac']); ?>" title="Data de Nascimento" readonly/>
                    <label id="fa014-lbl_cns_pac_aux">Nr.CNS:</label>
                    <input type="text" id="fa014-nr_cns_pac_aux" name="fa014[nr_cns_pac_aux]" value="<?php echo $rs[0]['nr_cns_pac']; ?>" title="N&uacute;mero Cart&atilde;o SUS" readonly/>
                </div>
                <div class="linha">
                    <label>Nome:</label>
                    <input type="text" id="fa014-nm_pac_aux" name="fa014[nm_pac_aux]" value="<?php echo $rs[0]['nm_pac']; ?>" title="Nome Paciente" readonly/>
                </div>
                <div class="linha">
                    <label>Mãe:</label>
                    <input type="text" id="fa014-nm_mae_pac_aux" name="fa014[nm_mae_pac_aux]" value="<?php echo $rs[0]['nm_mae_pac']; ?>" title="Nome M&atilde;e Paciente" readonly/>
                </div>
            </form>
        </div>
        <?php
    }
?>
<div class="linha">
    <fieldset>
        <legend>Pesquisa Paciente</legend>
        <div class="linha">
            <label for="scp_fa014-tp_sexo_pac">Sexo:</label>
            <select id="scp_fa014-tp_sexo_pac" name="scp_fa014[tp_sexo_pac]" title="Sexo Paciente">
                <option selected value=""></option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>
            <label for="scp_fa014-dt_nasc_pac">Dt.Nasc.:</label>
            <input type="text" id="scp_fa014-dt_nasc_pac" name="scp_fa014[dt_nasc_pac]" value="" title="Data de Nascimento"/>
        </div>
        <div class="linha">
            <label for="scp_fa014-nm_pac">Nome:</label>
            <input type="text" id="scp_fa014-nm_pac" name="scp_fa014[nm_pac]" value="" title="Nome Aluno"/>
        </div>
        <div class="linha">
            <label for="scp_fa014-nm_mae_pac">Mãe:</label>
            <input type="text" id="scp_fa014-nm_mae_pac" name="scp_fa014[nm_mae_pac]" value="" title="Nome M&atilde;e Aluno"/>
        </div>
        <div class="linha">
            <div id="scp_fa014-tbl_result" class="linha selecionavel"></div>
        </div>
    </fieldset>
</div>