PRAGMA foreign_keys=OFF; 

CREATE TABLE arquivos( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (100)   , 
      num_tipo_arquivo int   , 
      tamanho int   , 
      dt_hr_criacao datetime   , 
      dt_hr_exclusao datetime   , 
      transacao_id int   , 
      uid_arquivo int   , 
      chave_origem varchar  (100)   , 
 PRIMARY KEY (id),
FOREIGN KEY(transacao_id) REFERENCES transacoes(id)) ; 

CREATE TABLE cmds( 
      id  INTEGER    NOT NULL  , 
      transacao_id int   , 
      tipo_comando_id int   , 
      dt_hr_comando datetime   , 
      comando text   , 
      dt_hr_retorno datetime   , 
      retorno text   , 
      num_metodo_comunicacao int   , 
      log_erro text   , 
      num_situacao int  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(transacao_id) REFERENCES transacoes(id),
FOREIGN KEY(tipo_comando_id) REFERENCES tipos_comando(id)) ; 

CREATE TABLE docs_fiscal( 
      id int   NOT NULL  , 
      emissor_id int  (2)   , 
      dt_hr_emissao datetime   , 
      dt_hr_saida datetime   , 
      unid_controle_id int   , 
      pessoa_id int   , 
      nr_docto char  (50)   , 
      serie_docto char  (5)   , 
      num_modelo_docto int   , 
      vl_docto double   , 
      transacao_id int   , 
      cod_versao_nfe varchar  (20)   , 
      num_protocolo int   , 
      cod_versao_apl varchar  (50)   , 
      dt_hr_recbto_protocolo datetime   , 
      arquivo_id int   , 
      num_tipo_ambiente int   , 
      chave_acesso varchar  (60)   , 
 PRIMARY KEY (id),
FOREIGN KEY(unid_controle_id) REFERENCES system_unit(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoas(id),
FOREIGN KEY(transacao_id) REFERENCES transacoes(id),
FOREIGN KEY(arquivo_id) REFERENCES arquivos(id),
FOREIGN KEY(emissor_id) REFERENCES emissores(id)) ; 

CREATE TABLE emissores( 
      id  INTEGER    NOT NULL  , 
      num_tipo_emissor int   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estados( 
      id int   NOT NULL  , 
      uf char  (2)   , 
      nome varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE eventos( 
      id  INTEGER    NOT NULL  , 
      cod_evento varchar  (50)   , 
      nome varchar  (50)   , 
      grupo_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(grupo_id) REFERENCES grupos_evento(id)) ; 

CREATE TABLE formatos_chave_origem( 
      id  INTEGER    NOT NULL  , 
      origem_id int   , 
      posicao int   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id),
FOREIGN KEY(origem_id) REFERENCES origens(id)) ; 

CREATE TABLE grupos_evento( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE listas( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (50)   , 
      descricao text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE movtos_evento_doc_fiscal( 
      id  INTEGER    NOT NULL  , 
      cod_protocolo varchar  (30)   , 
      doc_fiscal_id int   , 
      dt_hr_envio datetime   , 
      descr_envio text   , 
      cod_retorno int   , 
      descr_retorno varchar  (200)   , 
      transacao_id int   , 
      dt_hr_retorno datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(doc_fiscal_id) REFERENCES docs_fiscal(id),
FOREIGN KEY(transacao_id) REFERENCES transacoes(id)) ; 

CREATE TABLE msgs_movto_evento_doc_fiscal( 
      id  INTEGER    NOT NULL  , 
      movto_evento_docto_fiscal_id int   , 
      cod_mensagem int   , 
      descr_mensagem varchar  (200)   , 
      dt_hr_consulta datetime   , 
      dt_hr_retorno datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE municipios( 
      id int   NOT NULL  , 
      nome varchar  (100)   , 
      estado_id int  (2)   , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_id) REFERENCES estados(id)) ; 

CREATE TABLE opcoes_lista( 
      id  INTEGER    NOT NULL  , 
      cod_opcao varchar  (20)   , 
      desc_opcao varchar  (100)   , 
      lista_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(lista_id) REFERENCES listas(id)) ; 

CREATE TABLE origens( 
      id  INTEGER    NOT NULL  , 
      codigo varchar  (50)   , 
      titulo varchar  (100)   , 
      descricao text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE parametros_acbr( 
      id  INTEGER    NOT NULL  , 
      cod_parametro varchar  (100)   , 
      val_parametro varchar  (500)   , 
      unid_controle_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(unid_controle_id) REFERENCES system_unit(id)) ; 

CREATE TABLE pessoas( 
      id  INTEGER    NOT NULL  , 
      id_federal char  (20)   NOT NULL  , 
      razao_social varchar  (100)   NOT NULL  , 
      num_tipo_pessoa int  (2)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      cod_usuario_erp varchar  (50)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id)) ; 

CREATE TABLE tipos_comando( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE transacoes( 
      id  INTEGER    NOT NULL  , 
      dt_hr_ini datetime   , 
      usuario_id int   , 
      origem_id int   , 
      dt_hr_fim datetime   , 
      cod_programa varchar  (50)   , 
 PRIMARY KEY (id),
FOREIGN KEY(origem_id) REFERENCES origens(id)) ; 

 
 CREATE UNIQUE INDEX idx_origens_codigo ON origens(codigo);
 CREATE UNIQUE INDEX idx_pessoas_id_federal ON pessoas(id_federal);
 
  
