CREATE DATABASE IF NOT EXISTS grp_16_bangu_noite;

CREATE TABLE profiles (
    id BIGINT AUTO_INCREMENT,
    name VARCHAR(50),
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id)
);

INSERT INTO profiles (id, name, created_at) VALUES (1, 'Default', NOW());
INSERT INTO profiles (id, name, created_at) VALUES (2, 'Administrator', NOW());

CREATE TABLE users(
        id BIGINT AUTO_INCREMENT,
        profile_id BIGINT,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        mother_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(16) UNIQUE NOT NULL,
        cpf VARCHAR(14) UNIQUE NOT NULL,
        cep VARCHAR(9) NOT NULL,
        address VARCHAR(255) NOT NULL,
        birth DATE NOT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME,
        deleted_at DATETIME,
        FOREIGN KEY (profile_id) REFERENCES profiles(id),
        PRIMARY KEY (id)
    );

CREATE TABLE modules(
    id BIGINT AUTO_INCREMENT,
    name VARCHAR(50),
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY(id)
);

INSERT INTO modules (id, name, created_at) VALUES (1, 'perfil', NOW());
INSERT INTO modules (id, name, created_at) VALUES (2, 'usuários', NOW());
INSERT INTO modules (id, name, created_at) VALUES (3, 'logs', NOw());
INSERT INTO modules (id, name, created_at) VALUES (4, 'relatórios', NOW());
INSERT INTO modules (id, name, created_at) VALUES (5, 'perfis', NOW());

CREATE TABLE profiles_modules_acl(
    profile_id BIGINT,
    module_id BIGINT,
    permission_create ENUM("Y", "N") NOT NULL,
    permission_read ENUM("Y", "N") NOT NULL,
    permission_update ENUM("Y", "N") NOT NULL,
    permission_delete ENUM("Y", "N") NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    FOREIGN KEY (module_id) REFERENCES modules(id),
    FOREIGN KEY (profile_id) REFERENCES profiles(id)
);

INSERT INTO profiles_modules_acl VALUES (2, 1, 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (2, 2, 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (2, 3, 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (2, 4, 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (2, 5, 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);

INSERT INTO profiles_modules_acl VALUES (1, 1, 'N', 'Y', 'Y', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (1, 2, 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (1, 3, 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (1, 4, 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (1, 5, 'N', 'N', 'N', 'N', NOW(), NULL, NULL);

CREATE TABLE auth(
    id BIGINT AUTO_INCREMENT,
    user_id bigint UNIQUE NOT NULL,
    basic_token varchar(255) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE log(
    id BIGINT AUTO_INCREMENT,
    user_id bigint NOT NULL,
    changed_entity_id bigint NOT NULL,
    type_log varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE asks_2fa(
        id BIGINT AUTO_INCREMENT,
        ask_1 varchar(255) DEFAULT "Qual o nome da sua mãe",
        ask_2 varchar(255) DEFAULT "Qual a data do seu nascimento",
        ask_3 varchar(255) DEFAULT "Qual o CEP do seu endereço",
        created_at DATETIME NOT NULL,
        updated_at DATETIME,
        deleted_at DATETIME,
        PRIMARY KEY (id)
    );

INSERT INTO asks_2fa (id, ask_1, ask_2, ask_3, created_at) VALUES (1, "Qual o nome da sua mãe", "Qual a data do seu nascimento", "Qual o CEP do seu endereço", NOW());