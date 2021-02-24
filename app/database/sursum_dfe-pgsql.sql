CREATE TABLE arquivos( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (100)   , 
      num_tipo_arquivo integer   , 
      tamanho integer   , 
      dt_hr_criacao timestamp   , 
      dt_hr_exclusao timestamp   , 
      transacao_id integer   , 
      uid_arquivo integer   , 
      chave_origem varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cmds( 
      id  SERIAL    NOT NULL  , 
      transacao_id integer   , 
      tipo_comando_id integer   , 
      dt_hr_comando timestamp   , 
      comando text   , 
      dt_hr_retorno timestamp   , 
      retorno text   , 
      num_metodo_comunicacao integer   , 
      log_erro boolean   , 
      num_situacao integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE docs_fiscal( 
      id integer   NOT NULL  , 
      emissor_id integer   , 
      dt_hr_emissao timestamp   , 
      dt_hr_saida timestamp   , 
      unid_controle_id integer   , 
      pessoa_id integer   , 
      nr_docto char  (50)   , 
      serie_docto char  (5)   , 
      num_modelo_docto integer   , 
      vl_docto float   , 
      transacao_id integer   , 
      cod_versao_nfe varchar  (20)   , 
      num_protocolo integer   , 
      cod_versao_apl varchar  (50)   , 
      dt_hr_recbto_protocolo timestamp   , 
      arquivo_id integer   , 
      num_tipo_ambiente integer   , 
      chave_acesso varchar  (60)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE emissores( 
      id  SERIAL    NOT NULL  , 
      num_tipo_emissor integer   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estados( 
      id integer   NOT NULL  , 
      uf char  (2)   , 
      nome varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE eventos( 
      id  SERIAL    NOT NULL  , 
      cod_evento varchar  (50)   , 
      nome varchar  (50)   , 
      grupo_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE formatos_chave_origem( 
      id  SERIAL    NOT NULL  , 
      origem_id integer   , 
      posicao integer   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupos_evento( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE listas( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (50)   , 
      descricao text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE movtos_evento_doc_fiscal( 
      id  SERIAL    NOT NULL  , 
      cod_protocolo varchar  (30)   , 
      doc_fiscal_id integer   , 
      dt_hr_envio timestamp   , 
      descr_envio text   , 
      cod_retorno integer   , 
      descr_retorno varchar  (200)   , 
      transacao_id integer   , 
      dt_hr_retorno timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE msgs_movto_evento_doc_fiscal( 
      id  SERIAL    NOT NULL  , 
      movto_evento_docto_fiscal_id integer   , 
      cod_mensagem integer   , 
      descr_mensagem varchar  (200)   , 
      dt_hr_consulta timestamp   , 
      dt_hr_retorno timestamp   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE municipios( 
      id integer   NOT NULL  , 
      nome varchar  (100)   , 
      estado_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE opcoes_lista( 
      id  SERIAL    NOT NULL  , 
      cod_opcao varchar  (20)   , 
      desc_opcao varchar  (100)   , 
      lista_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE origens( 
      id  SERIAL    NOT NULL  , 
      codigo varchar  (50)   , 
      titulo varchar  (100)   , 
      descricao text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE parametros_acbr( 
      id  SERIAL    NOT NULL  , 
      cod_parametro varchar  (100)   , 
      val_parametro varchar  (500)   , 
      unid_controle_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoas( 
      id  SERIAL    NOT NULL  , 
      id_federal char  (20)   NOT NULL  , 
      razao_social varchar  (100)   NOT NULL  , 
      num_tipo_pessoa integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id integer   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id integer   , 
      system_unit_id integer   , 
      active char  (1)   , 
      cod_usuario_erp varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id integer   NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_unit_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipos_comando( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE transacoes( 
      id  SERIAL    NOT NULL  , 
      dt_hr_ini timestamp   , 
      usuario_id integer   , 
      origem_id integer   , 
      dt_hr_fim timestamp   , 
      cod_programa varchar  (50)   , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE origens ADD UNIQUE (codigo);
 ALTER TABLE pessoas ADD UNIQUE (id_federal);
  
 ALTER TABLE arquivos ADD CONSTRAINT fk_arquivos_1 FOREIGN KEY (transacao_id) references transacoes(id); 
ALTER TABLE cmds ADD CONSTRAINT fk_cmds_1 FOREIGN KEY (transacao_id) references transacoes(id); 
ALTER TABLE cmds ADD CONSTRAINT fk_cmds_2 FOREIGN KEY (tipo_comando_id) references tipos_comando(id); 
ALTER TABLE docs_fiscal ADD CONSTRAINT fk_docs_fiscal_1 FOREIGN KEY (unid_controle_id) references system_unit(id); 
ALTER TABLE docs_fiscal ADD CONSTRAINT fk_docs_fiscal_2 FOREIGN KEY (pessoa_id) references pessoas(id); 
ALTER TABLE docs_fiscal ADD CONSTRAINT fk_docs_fiscal_3 FOREIGN KEY (transacao_id) references transacoes(id); 
ALTER TABLE docs_fiscal ADD CONSTRAINT fk_docs_fiscal_4 FOREIGN KEY (arquivo_id) references arquivos(id); 
ALTER TABLE docs_fiscal ADD CONSTRAINT fk_docs_fiscal_6 FOREIGN KEY (emissor_id) references emissores(id); 
ALTER TABLE eventos ADD CONSTRAINT fk_eventos_1 FOREIGN KEY (grupo_id) references grupos_evento(id); 
ALTER TABLE formatos_chave_origem ADD CONSTRAINT fk_formatos_chave_origem_1 FOREIGN KEY (origem_id) references origens(id); 
ALTER TABLE movtos_evento_doc_fiscal ADD CONSTRAINT fk_movtos_evento_doc_fiscal_1 FOREIGN KEY (doc_fiscal_id) references docs_fiscal(id); 
ALTER TABLE movtos_evento_doc_fiscal ADD CONSTRAINT fk_movtos_evento_doc_fiscal_2 FOREIGN KEY (transacao_id) references transacoes(id); 
ALTER TABLE municipios ADD CONSTRAINT fk_municipios_1 FOREIGN KEY (estado_id) references estados(id); 
ALTER TABLE opcoes_lista ADD CONSTRAINT fk_opcoes_lista_1 FOREIGN KEY (lista_id) references listas(id); 
ALTER TABLE parametros_acbr ADD CONSTRAINT fk_parametros_acbr_1 FOREIGN KEY (unid_controle_id) references system_unit(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE transacoes ADD CONSTRAINT fk_transacoes_1 FOREIGN KEY (origem_id) references origens(id); 

  
