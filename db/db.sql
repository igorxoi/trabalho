USE estaciona_aqui;

CREATE TABLE tipo_vaga (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('MOTO', 'CARRO PEQUENO', 'CARRO GRANDE', 'CAMINHÃO') NOT NULL
);

CREATE TABLE tarifa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_vaga_id INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data_inicio DATE,
    data_fim DATE,
    FOREIGN KEY (tipo_vaga_id) REFERENCES tipo_vaga(id)
);

CREATE TABLE configuracao_vaga (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_vaga_id INT NOT NULL,
    quantidade INT NOT NULL,
    data_inicio DATE,
    data_fim DATE,
    FOREIGN KEY (tipo_vaga_id) REFERENCES tipo_vaga(id)
);

CREATE TABLE registro_estacionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_proprietario VARCHAR(100) NOT NULL,
    telefone_proprietario VARCHAR(20),
    email_proprietario VARCHAR(100),
    placa VARCHAR(20) NOT NULL,
    modelo VARCHAR(50),
    marca VARCHAR(50),
    cor VARCHAR(30),
    tipo_vaga_id INT NOT NULL,
    tarifa_id INT NOT NULL,
    vaga VARCHAR(10),
    FOREIGN KEY (tipo_vaga_id) REFERENCES tipo_vaga(id),
    FOREIGN KEY (tarifa_id) REFERENCES tarifa(id)
);

CREATE TABLE status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) NOT NULL
);

CREATE TABLE status_estacionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registro_estacionamento_id INT NOT NULL,
    status_id INT NOT NULL,
    data_inicio DATETIME NOT NULL,
    data_fim DATETIME,
    FOREIGN KEY (registro_estacionamento_id) REFERENCES registro_estacionamento(id),
    FOREIGN KEY (status_id) REFERENCES status(id)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    permissoes TEXT
);

INSERT INTO tipo_vaga (tipo) VALUES 
    ('MOTO'),
    ('CARRO PEQUENO'),
    ('CARRO GRANDE'),
    ('CAMINHÃO');

INSERT INTO status (descricao) VALUES 
    ('Cancelado'),
    ('Estacionado'),
    ('Pronto para saída'),
    ('Baixa realizada');
