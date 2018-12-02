/* Initialize this database and seed values. */
CREATE DATABASE IF NOT EXISTS coding;

CREATE TABLE IF NOT EXISTS users (
                                   id INT PRIMARY KEY AUTO_INCREMENT,
                                   login_name VARCHAR(30) NOT NULL,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(45) NOT NULL
  );

INSERT INTO users (login_name, first_name, last_name)
VALUES ("admin", "Admin", "User");
