CREATE DATABASE IF NOT EXISTS grp_16_bangu_noite;

CREATE TABLE profiles (
    id UUID,
    name VARCHAR(50),
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id)
);

INSERT INTO profiles (id, name, created_at) VALUES ('be73c606-eb68-47e7-80f6-457ca8f52e62', 'Default', NOW());
INSERT INTO profiles (id, name, created_at) VALUES ('f1aad8e0-6316-4afe-b9aa-63803834bcad', 'Administrator', NOW());

CREATE TABLE users(
        id UUID,
        profile_id UUID,
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
    id UUID,
    name VARCHAR(50),
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY(id)
);

INSERT INTO modules (id, name, created_at) VALUES ('01bd5e14-dd31-4785-84cc-047d76e98aa4', 'perfil', NOW());
INSERT INTO modules (id, name, created_at) VALUES ('f615a51d-07ef-4a21-b119-50ed123d2b92', 'usuários', NOW());
INSERT INTO modules (id, name, created_at) VALUES ('c9a0f215-eaf8-4ff5-bc02-ffda284f6b8a', 'logs', NOw());
INSERT INTO modules (id, name, created_at) VALUES ('0941f6d4-0f2e-4fde-99fd-dcd066b4e4f6', 'relatórios', NOW());
INSERT INTO modules (id, name, created_at) VALUES ('fcdaf206-28bb-48d6-b310-da107999c85c', 'perfis', NOW());

CREATE TABLE profiles_modules_acl(
    id UUID,
    profile_id UUID,
    module_id UUID,
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

INSERT INTO profiles_modules_acl VALUES (UUID(), 'f1aad8e0-6316-4afe-b9aa-63803834bcad', '01bd5e14-dd31-4785-84cc-047d76e98aa4', 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'f1aad8e0-6316-4afe-b9aa-63803834bcad', 'f615a51d-07ef-4a21-b119-50ed123d2b92', 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'f1aad8e0-6316-4afe-b9aa-63803834bcad', 'c9a0f215-eaf8-4ff5-bc02-ffda284f6b8a', 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'f1aad8e0-6316-4afe-b9aa-63803834bcad', '0941f6d4-0f2e-4fde-99fd-dcd066b4e4f6', 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'f1aad8e0-6316-4afe-b9aa-63803834bcad', 'fcdaf206-28bb-48d6-b310-da107999c85c', 'Y', 'Y', 'Y', 'Y', NOW(), NULL, NULL);

INSERT INTO profiles_modules_acl VALUES (UUID(), 'be73c606-eb68-47e7-80f6-457ca8f52e62', '01bd5e14-dd31-4785-84cc-047d76e98aa4', 'N', 'Y', 'Y', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'be73c606-eb68-47e7-80f6-457ca8f52e62', 'f615a51d-07ef-4a21-b119-50ed123d2b92', 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'be73c606-eb68-47e7-80f6-457ca8f52e62', 'c9a0f215-eaf8-4ff5-bc02-ffda284f6b8a', 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'be73c606-eb68-47e7-80f6-457ca8f52e62', '0941f6d4-0f2e-4fde-99fd-dcd066b4e4f6', 'N', 'N', 'N', 'N', NOW(), NULL, NULL);
INSERT INTO profiles_modules_acl VALUES (UUID(), 'be73c606-eb68-47e7-80f6-457ca8f52e62', 'fcdaf206-28bb-48d6-b310-da107999c85c', 'N', 'N', 'N', 'N', NOW(), NULL, NULL);

CREATE TABLE auth(
    id UUID,
    user_id UUID UNIQUE NOT NULL,
    basic_token varchar(255) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE log(
    id UUID,
    author varchar(90) NOT NULL,
    type varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME,
    deleted_at DATETIME,
    PRIMARY KEY (id)
);

CREATE TABLE asks_2fa(
        id UUID,
        ask_1 varchar(255) DEFAULT "Qual o nome da sua mãe",
        ask_2 varchar(255) DEFAULT "Qual a data do seu nascimento",
        ask_3 varchar(255) DEFAULT "Qual o CEP do seu endereço",
        created_at DATETIME NOT NULL,
        updated_at DATETIME,
        deleted_at DATETIME,
        PRIMARY KEY (id)
    );

INSERT INTO asks_2fa (id, ask_1, ask_2, ask_3, created_at) VALUES ('e77da62c-d756-461e-a29f-ec8d86abb874', "Qual o nome da sua mãe", "Qual a data do seu nascimento", "Qual o CEP do seu endereço", NOW());