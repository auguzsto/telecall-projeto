CREATE TABLE IF NOT EXISTS users(
        id BIGINT AUTO_INCREMENT,
        isadmin BOOLEAN NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(14) UNIQUE NOT NULL,
        cpf VARCHAR(14) UNIQUE NOT NULL,
        cep VARCHAR(9) NOT NULL,
        PRIMARY KEY (id)
    );