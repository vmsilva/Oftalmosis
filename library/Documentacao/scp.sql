Create Table cerof.scp_t0005(
	cd_empresa tinyint(2) unsigned not null,
	nr_solic_mov bigint(10) unsigned not null,
	dt_solic_mov char(8) not null,
	hr_solic_mov char(4) not null,
	cd_usu_solic_mov tinyint(2) unsigned not null,
	dt_atend_solic_mov char(8) null,
	hr_atend_solic_mov char(4) null,
	cd_usu_atend_solic_mov tinyint(2) unsigned null
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Solicitacao Prontuario';

Create Table cerof.scp_t0006(
	cd_empresa tinyint(2) unsigned not null,
	nr_solic_mov bigint(10) unsigned not null,
	cd_pac int(7) unsigned not null,
	cd_prateleira smallint(4) unsigned not null,
	nr_linha smallint(4) unsigned not null,
	nr_coluna smallint(4) unsigned not null,
	nr_posicao smallint(4) unsigned not null,
	nr_prontuario char(11) not null,
	st_solic_mov char(1) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Solicitacao Movimentacao Prontuario Paciente';

/* Chave Primária */
Alter Table scp_t0005 Add Constraint PK_SCP_T0005 Primary Key(cd_empresa, nr_solic_mov);
Alter Table scp_t0006 Add Constraint PK_SCP_T0006 Primary Key(cd_empresa, nr_solic_mov, cd_pac);

/* Chave Estrangeira */
Alter Table scp_t0005 Add Constraint FK_SCP_T0005_SCA_T0001 Foreign Key(cd_empresa) References sca_t0001(cd_empresa);
Alter Table scp_t0005 Add Constraint FK_SCP_T0005_SCA_T0002_SOLI Foreign Key(cd_usu_solic_mov) References sca_t0002(cd_usuario);
Alter Table scp_t0005 Add Constraint FK_SCP_T0005_SCA_T0002_ATEN Foreign Key(cd_usu_atend_solic_mov) References sca_t0002(cd_usuario);
Alter Table scp_t0006 Add Constraint FK_SCP_T0006_SCA_T0001 Foreign Key(cd_empresa) References sca_t0001(cd_empresa);
Alter Table scp_t0006 Add Constraint FK_SCP_T0006_SCP_T0005 Foreign Key(cd_empresa, nr_solic_mov) References scp_t0005(cd_empresa, nr_solic_mov);
Alter Table scp_t0006 Add Constraint FK_SCP_T0006_SMG_T0014 Foreign Key(cd_pac) References smg_t0014(cd_pac);
Alter Table scp_t0006 Add Constraint FK_SCP_T0006_SCP_T0002 Foreign Key(cd_empresa, cd_prateleira, nr_linha, nr_coluna, nr_posicao) References scp_t0002(cd_empresa, cd_prateleira, nr_linha, nr_coluna, nr_posicao);

/* Enumerador */
Alter Table scp_t0006 Modify Column st_solic_mov Enum('0','1','2') Character Set utf8 Collate utf8_general_ci not null comment '0-Pendente,1-Atendido,2-Devolvido,3-Não Localizado';