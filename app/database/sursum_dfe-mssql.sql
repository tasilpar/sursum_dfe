CREATE TABLE arquivos( 
      id  INT IDENTITY    NOT NULL  , 
      nome varchar  (100)   , 
      num_tipo_arquivo int   , 
      tamanho int   , 
      dt_hr_criacao datetime2   , 
      dt_hr_exclusao datetime2   , 
      transacao_id int   , 
      uid_arquivo int   , 
      chave_origem varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cmds( 
      id  INT IDENTITY    NOT NULL  , 
      transacao_id int   , 
      tipo_comando_id int   , 
      dt_hr_comando datetime2   , 
      comando nvarchar(max)   , 
      dt_hr_retorno datetime2   , 
      retorno nvarchar(max)   , 
      num_metodo_comunicacao int   , 
      log_erro bit   , 
      num_situacao int  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE docs_fiscal( 
      id int   NOT NULL  , 
      emissor_id int  (2)   , 
      dt_hr_emissao datetime2   , 
      dt_hr_saida datetime2   , 
      unid_controle_id int   , 
      pessoa_id int   , 
      nr_docto char  (50)   , 
      serie_docto char  (5)   , 
      num_modelo_docto int   , 
      vl_docto float   , 
      transacao_id int   , 
      cod_versao_nfe varchar  (20)   , 
      num_protocolo int   , 
      cod_versao_apl varchar  (50)   , 
      dt_hr_recbto_protocolo datetime2   , 
      arquivo_id int   , 
      num_tipo_ambiente int   , 
      chave_acesso varchar  (60)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE emissores( 
      id  INT IDENTITY    NOT NULL  , 
      num_tipo_emissor int   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estados( 
      id int   NOT NULL  , 
      uf char  (2)   , 
      nome varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE eventos( 
      id  INT IDENTITY    NOT NULL  , 
      cod_evento varchar  (50)   , 
      nome varchar  (50)   , 
      grupo_id int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE formatos_chave_origem( 
      id  INT IDENTITY    NOT NULL  , 
      origem_id int   , 
      posicao int   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupos_evento( 
      id  INT IDENTITY    NOT NULL  , 
      descricao varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE listas( 
      id  INT IDENTITY    NOT NULL  , 
      nome varchar  (50)   , 
      descricao nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE movtos_evento_doc_fiscal( 
      id  INT IDENTITY    NOT NULL  , 
      cod_protocolo varchar  (30)   , 
      doc_fiscal_id int   , 
      dt_hr_envio datetime2   , 
      descr_envio nvarchar(max)   , 
      cod_retorno int   , 
      descr_retorno varchar  (200)   , 
      transacao_id int   , 
      dt_hr_retorno datetime2   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE msgs_movto_evento_doc_fiscal( 
      id  INT IDENTITY    NOT NULL  , 
      movto_evento_docto_fiscal_id int   , 
      cod_mensagem int   , 
      descr_mensagem varchar  (200)   , 
      dt_hr_consulta datetime2   , 
      dt_hr_retorno datetime2   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE municipios( 
      id int   NOT NULL  , 
      nome varchar  (100)   , 
      estado_id int  (2)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE opcoes_lista( 
      id  INT IDENTITY    NOT NULL  , 
      cod_opcao varchar  (20)   , 
      desc_opcao varchar  (100)   , 
      lista_id int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE origens( 
      id  INT IDENTITY    NOT NULL  , 
      codigo varchar  (50)   , 
      titulo varchar  (100)   , 
      descricao nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE parametros_acbr( 
      id  INT IDENTITY    NOT NULL  , 
      cod_parametro varchar  (100)   , 
      val_parametro varchar  (500)   , 
      unid_controle_id int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoas( 
      id  INT IDENTITY    NOT NULL  , 
      id_federal char  (20)   NOT NULL  , 
      razao_social varchar  (100)   NOT NULL  , 
      num_tipo_pessoa int  (2)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      controller nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      connection_name nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      login nvarchar(max)   NOT NULL  , 
      password nvarchar(max)   NOT NULL  , 
      email nvarchar(max)   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      cod_usuario_erp varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipos_comando( 
      id  INT IDENTITY    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE transacoes( 
      id  INT IDENTITY    NOT NULL  , 
      dt_hr_ini datetime2   , 
      usuario_id int   , 
      origem_id int   , 
      dt_hr_fim datetime2   , 
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

  
