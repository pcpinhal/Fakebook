CREATE DATABASE IF NOT EXISTS Fakebook;
USE Fakebook;
-- DROP DATABASE Fakebook;
CREATE TABLE tb_login(
id_login        INT NOT NULL AUTO_INCREMENT,
login           VARCHAR(255) NOT NULL,
senha           VARCHAR(255) NOT NULL,
nome            VARCHAR(255),
foto				 VARCHAR(255),
PRIMARY KEY(id_login)
);
CREATE TABLE tb_noticia(
id_noticia      INT NOT NULL AUTO_INCREMENT,
noticia         TEXT NOT NULL,
foto            VARCHAR(255),
fk_de           INT NOT NULL,
datahora			 DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id_noticia),
FOREIGN KEY (fk_de) REFERENCES tb_login (id_login)
);

INSERT INTO tb_login (login, senha, nome, foto) VALUES
("admin","123","Administrador","login1.jpg"),
("local","123","Conta Local","login2.jpg"),
("guess","123","Conta Convidado","");

INSERT INTO tb_noticia (noticia, foto, fk_de) VALUES
("Teste do site","foto1.jpg",1),
("Noticia extraordinaria","foto2.jpg",2),
("Cerveja gratis","",3);

SELECT * FROM tb_login;
SELECT * FROM tb_noticia;