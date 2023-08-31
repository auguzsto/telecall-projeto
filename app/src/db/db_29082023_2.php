CREATE TABLE users(
        id BIGINT AUTO_INCREMENT,
        isadmin BOOLEAN NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(14) UNIQUE NOT NULL,
        cpf VARCHAR(14) UNIQUE NOT NULL,
        cep VARCHAR(9) NOT NULL,
        created_at DATATIME NOT NULL,
        updated_at DATATIME NOT NULL,
        deleted_at DATATIME NOT NULL,
        PRIMARY KEY (id)
    );

CREATE TABLE auth(
    id BIGINT AUTO_INCREMENT,
    user_id bigint NOT NULL,
    basic_token varchar(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);