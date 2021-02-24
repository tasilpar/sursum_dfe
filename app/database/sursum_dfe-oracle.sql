CREATE TABLE arquivos( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      num_tipo_arquivo number(10)   , 
      tamanho number(10)   , 
      dt_hr_criacao timestamp(0)   , 
      dt_hr_exclusao timestamp(0)   , 
      transacao_id number(10)   , 
      uid_arquivo number(10)   , 
      chave_origem varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cmds( 
      id number(10)    NOT NULL , 
      transacao_id number(10)   , 
      tipo_comando_id number(10)   , 
      dt_hr_comando timestamp(0)   , 
      comando varchar(10000)   , 
      dt_hr_retorno timestamp(0)   , 
      retorno varchar(10000)   , 
      num_metodo_comunicacao number(10)   , 
      log_erro char(1)   , 
      num_situacao number(10)  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE docs_fiscal( 
      id number(10)    NOT NULL , 
      emissor_id number(10)  (2)   , 
      dt_hr_emissao timestamp(0)   , 
      dt_hr_saida timestamp(0)   , 
      unid_controle_id number(10)   , 
      pessoa_id number(10)   , 
      nr_docto char  (50)   , 
      serie_docto char  (5)   , 
      num_modelo_docto number(10)   , 
      vl_docto binary_double   , 
      transacao_id number(10)   , 
      cod_versao_nfe varchar  (20)   , 
      num_protocolo number(10)   , 
      cod_versao_apl varchar  (50)   , 
      dt_hr_recbto_protocolo timestamp(0)   , 
      arquivo_id number(10)   , 
      num_tipo_ambiente number(10)   , 
      chave_acesso varchar  (60)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE emissores( 
      id number(10)    NOT NULL , 
      num_tipo_emissor number(10)   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estados( 
      id number(10)    NOT NULL , 
      uf char  (2)   , 
      nome varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE eventos( 
      id number(10)    NOT NULL , 
      cod_evento varchar  (50)   , 
      nome varchar  (50)   , 
      grupo_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE formatos_chave_origem( 
      id number(10)    NOT NULL , 
      origem_id number(10)   , 
      posicao number(10)   , 
      nome varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupos_evento( 
      id number(10)    NOT NULL , 
      descricao varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE listas( 
      id number(10)    NOT NULL , 
      nome varchar  (50)   , 
      descricao varchar(10000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE movtos_evento_doc_fiscal( 
      id number(10)    NOT NULL , 
      cod_protocolo varchar  (30)   , 
      doc_fiscal_id number(10)   , 
      dt_hr_envio timestamp(0)   , 
      descr_envio varchar(10000)   , 
      cod_retorno number(10)   , 
      descr_retorno varchar  (200)   , 
      transacao_id number(10)   , 
      dt_hr_retorno timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE msgs_movto_evento_doc_fiscal( 
      id number(10)    NOT NULL , 
      movto_evento_docto_fiscal_id number(10)   , 
      cod_mensagem number(10)   , 
      descr_mensagem varchar  (200)   , 
      dt_hr_consulta timestamp(0)   , 
      dt_hr_retorno timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE municipios( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      estado_id number(10)  (2)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE opcoes_lista( 
      id number(10)    NOT NULL , 
      cod_opcao varchar  (20)   , 
      desc_opcao varchar  (100)   , 
      lista_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE origens( 
      id number(10)    NOT NULL , 
      codigo varchar  (50)   , 
      titulo varchar  (100)   , 
      descricao varchar(10000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE parametros_acbr( 
      id number(10)    NOT NULL , 
      cod_parametro varchar  (100)   , 
      val_parametro varchar  (500)   , 
      unid_controle_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoas( 
      id number(10)    NOT NULL , 
      id_federal char  (20)    NOT NULL , 
      razao_social varchar  (100)    NOT NULL , 
      num_tipo_pessoa number(10)  (2)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id number(10)    NOT NULL , 
      name varchar(10000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)    NOT NULL , 
      preference varchar(10000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id number(10)    NOT NULL , 
      name varchar(10000)    NOT NULL , 
      controller varchar(10000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id number(10)    NOT NULL , 
      name varchar(10000)    NOT NULL , 
      connection_name varchar(10000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id number(10)    NOT NULL , 
      name varchar(10000)    NOT NULL , 
      login varchar(10000)    NOT NULL , 
      password varchar(10000)    NOT NULL , 
      email varchar(10000)   , 
      frontpage_id number(10)   , 
      system_unit_id number(10)   , 
      active char  (1)   , 
      cod_usuario_erp varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_unit_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipos_comando( 
      id number(10)    NOT NULL , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE transacoes( 
      id number(10)    NOT NULL , 
      dt_hr_ini timestamp(0)   , 
      usuario_id number(10)   , 
      origem_id number(10)   , 
      dt_hr_fim timestamp(0)   , 
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
 CREATE SEQUENCE arquivos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER arquivos_id_seq_tr 

BEFORE INSERT ON arquivos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT arquivos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cmds_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cmds_id_seq_tr 

BEFORE INSERT ON cmds FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cmds_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE emissores_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER emissores_id_seq_tr 

BEFORE INSERT ON emissores FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT emissores_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE eventos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER eventos_id_seq_tr 

BEFORE INSERT ON eventos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT eventos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE formatos_chave_origem_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER formatos_chave_origem_id_seq_tr 

BEFORE INSERT ON formatos_chave_origem FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT formatos_chave_origem_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE grupos_evento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER grupos_evento_id_seq_tr 

BEFORE INSERT ON grupos_evento FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT grupos_evento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE listas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER listas_id_seq_tr 

BEFORE INSERT ON listas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT listas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE movtos_evento_doc_fiscal_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER movtos_evento_doc_fiscal_id_seq_tr 

BEFORE INSERT ON movtos_evento_doc_fiscal FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT movtos_evento_doc_fiscal_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE msgs_movto_evento_doc_fiscal_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER msgs_movto_evento_doc_fiscal_id_seq_tr 

BEFORE INSERT ON msgs_movto_evento_doc_fiscal FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT msgs_movto_evento_doc_fiscal_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE opcoes_lista_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER opcoes_lista_id_seq_tr 

BEFORE INSERT ON opcoes_lista FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT opcoes_lista_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE origens_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER origens_id_seq_tr 

BEFORE INSERT ON origens FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT origens_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE parametros_acbr_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER parametros_acbr_id_seq_tr 

BEFORE INSERT ON parametros_acbr FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT parametros_acbr_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoas_id_seq_tr 

BEFORE INSERT ON pessoas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pessoas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipos_comando_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipos_comando_id_seq_tr 

BEFORE INSERT ON tipos_comando FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipos_comando_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE transacoes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER transacoes_id_seq_tr 

BEFORE INSERT ON transacoes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT transacoes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
