CREATE DATABASE IF NOT EXISTS grp_16_bangu_noite;

CREATE TABLE groups_permissions_acl(
    id BIGINT AUTO_INCREMENT,
    description varchar(255) NOT NULL,
    permission_create ENUM("Y", "N") NOT NULL,
    permission_read ENUM("Y", "N") NOT NULL,
    permission_update ENUM("Y", "N") NOT NULL,
    permission_delete ENUM("Y", "N") NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO groups_permissions_acl (id, description, permission_create, permission_read, permission_update, permission_delete) VALUES (1, 'Administrator', 'Y', 'Y', 'Y', 'Y');
INSERT INTO groups_permissions_acl (id, description, permission_create, permission_read, permission_update, permission_delete) VALUES (2, 'Common',        'N', 'Y', 'N', 'N');
INSERT INTO groups_permissions_acl (id, description, permission_create, permission_read, permission_update, permission_delete) VALUES (3, 'Moderator',     'Y', 'Y', 'N', 'N');

CREATE TABLE users(
        id BIGINT AUTO_INCREMENT,
        isadmin BOOLEAN DEFAULT 0,
        id_groups_permissions_acl BIGINT,
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
        PRIMARY KEY (id),
        FOREIGN KEY (id_groups_permissions_acl) REFERENCES groups_permissions_acl(id)
    );

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
        PRIMARY KEY (id)
    );

INSERT INTO asks_2fa (id, ask_1, ask_2, ask_3) VALUES (1, "Qual o nome da sua mãe", "Qual a data do seu nascimento", "Qual o CEP do seu endereço");