
CREATE DATABASE twitter_clone;

CREATE TABLE utilizadores (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    utilizador varchar(50) not null,
    email varchar(100) not null,
    password varchar(32) not null
);

UPDATE utilizadores SET password = md5(password);

CREATE TABLE tweet (
	id int not null PRIMARY KEY AUTO_INCREMENT,
	id_utilizador int not null,
	tweet varchar(140) not null,
	data datetime default CURRENT_TIMESTAMP
);

CREATE TABLE utilizadores_seguidores (
	id_utilizador_seguidor int not null PRIMARY KEY AUTO_INCREMENT,
	id_utilizador int not null,
	seguir_id_utilizador int not null,
	data datetime default CURRENT_TIMESTAMP
);