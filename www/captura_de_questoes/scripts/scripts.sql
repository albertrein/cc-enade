CREATE TABLE questoes(
	questaopk INT AUTO_INCREMENT PRIMARY KEY,
	resposta VARCHAR(20) NOT NULL,
	ano INT NOT NULL,
	nrquestao INT NOT NULL,
	duvida INT(10) DEFAULT 0,
	acertos INT DEFAULT 0,
	erros INT DEFAULT 0
);

CREATE TABLE cc(
	questaopk INT AUTO_INCREMENT PRIMARY KEY,
	resposta VARCHAR(20) NOT NULL,
	ano INT NOT NULL,
	nrquestao INT NOT NULL,
	duvida INT(10) DEFAULT 0,
	acertos INT DEFAULT 0,
	erros INT DEFAULT 0
);

ALTER TABLE questoes ADD CONSTRAINT chk_resposta CHECK (resposta IN ('A' , 'B' , 'C' , 'D' , 'E'));

CREATE TABLE usuarios(
	usuariopk INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(60) NOT NULL UNIQUE,
	email VARCHAR(60) NOT NULL UNIQUE,
	isprofessor INT(8),
	pontuacao INT DEFAULT 0,
	curso VARCHAR(60)
);

CREATE TABLE comentarios(
	comentariopk INT AUTO_INCREMENT PRIMARY KEY,
	mensagem VARCHAR(255) NOT NULL,
	data date,
	hora time,
	usuariofk INT NOT NULL,
	questaofk INT NOT NULL,
	INDEX `fk_usuarios` (`usuariofk`),
	INDEX `fk_questoes` (`questaofk`),
	CONSTRAINT `fk_usuarios` FOREIGN KEY (usuariofk) REFERENCES usuarios (usuariopk) ON UPDATE CASCADE ON DELETE NO ACTION,
	CONSTRAINT `fk_questoes` FOREIGN KEY (questaofk) REFERENCES questoes (questaopk) ON UPDATE CASCADE ON DELETE NO ACTION
);

