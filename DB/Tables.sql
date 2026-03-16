-- 1. Create independent table: Localizações
CREATE TABLE localizacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    edificio VARCHAR(100) NOT NULL,
    piso VARCHAR(50),
    servico_departamento VARCHAR(100) NOT NULL,
    sala_gabinete VARCHAR(100)
);

-- 2. Create independent table: Fornecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_empresa VARCHAR(150) NOT NULL,
    nif VARCHAR(20) UNIQUE,
    contacto_telefonico VARCHAR(20),
    email VARCHAR(100),
    morada TEXT,
    website VARCHAR(150),
    pessoa_contacto VARCHAR(100),
    telefone_contacto VARCHAR(20),
    tipo_fornecedor VARCHAR(100),
    observacoes TEXT
);

-- 3. Create core table: Equipamentos (Depends on Localizações)
CREATE TABLE equipamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_interno VARCHAR(50) NOT NULL UNIQUE, -- Business rule: must be unique 
    designacao VARCHAR(150) NOT NULL,
    categoria VARCHAR(100),
    marca VARCHAR(100),
    modelo VARCHAR(100),
    numero_serie VARCHAR(100),
    fabricante VARCHAR(100),
    data_aquisicao DATE,
    ano_fabrico YEAR,
    custo_aquisicao DECIMAL(10, 2),
    tipo_entrada VARCHAR(50),
    estado VARCHAR(50) NOT NULL,
    criticidade VARCHAR(50),
    observacoes TEXT,
    localizacao_id INT NOT NULL, -- Business rule: must have a location 
    parent_id INT DEFAULT NULL, -- To link components to a main unit [cite: 86, 91]
    
    FOREIGN KEY (localizacao_id) REFERENCES localizacoes(id) ON DELETE RESTRICT,
    FOREIGN KEY (parent_id) REFERENCES equipamentos(id) ON DELETE SET NULL,
    
    -- Business rule: Serial number should not duplicate for same manufacturer and model 
    UNIQUE (fabricante, modelo, numero_serie)
);

-- 4. Create junction table: Equipamento_Fornecedor (Depends on Equipamentos & Fornecedores)
CREATE TABLE equipamento_fornecedor (
    equipamento_id INT,
    fornecedor_id INT,
    tipo_relacao VARCHAR(100), -- e.g., "Assistência Técnica", "Distribuidor" [cite: 272, 281-289]
    PRIMARY KEY (equipamento_id, fornecedor_id, tipo_relacao),
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id) ON DELETE CASCADE,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE CASCADE
);

-- 5. Create table: Documentação (Depends on Equipamentos & optionally Fornecedores)
CREATE TABLE documentacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_documento VARCHAR(100) NOT NULL,
    nome_documento VARCHAR(150) NOT NULL,
    data_documento DATE,
    data_validade DATE,
    equipamento_id INT NOT NULL,
    fornecedor_id INT DEFAULT NULL,
    ficheiro_path VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id) ON DELETE CASCADE,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE SET NULL
);

-- 6. Create table: Garantias e Contratos (Depends on Equipamentos & Fornecedores)
CREATE TABLE garantias_contratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipamento_id INT NOT NULL,
    data_inicio_garantia DATE,
    data_fim_garantia DATE,
    existencia_contrato BOOLEAN DEFAULT FALSE,
    tipo_contrato VARCHAR(100),
    entidade_responsavel INT, -- This is the supplier/company responsible [cite: 315]
    periodicidade VARCHAR(50),
    observacoes TEXT,
    
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id) ON DELETE CASCADE,
    FOREIGN KEY (entidade_responsavel) REFERENCES fornecedores(id) ON DELETE SET NULL
);

-- Create table for Users (Utilizadores) [cite: 369]
CREATE TABLE utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
