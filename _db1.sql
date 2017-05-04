--Set up tables
CREATE TABLE users(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(64) NOT NULL UNIQUE,
   password VARCHAR(128) NOT NULL
);

CREATE TABLE menu(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   description VARCHAR(255) NOT NULL UNIQUE,
   category VARCHAR(16) NOT NULL,
   price DECIMAL(3, 2) DEFAULT 0
);

--Users table
INSERT INTO users(username, password)
VALUES('Jeremy', 'bddb2d1de33c698d369d86b81ec8a233');

INSERT INTO users(username, password)
VALUES('Investor', 'babb17168110c6415844d610970218bf');

--Menu table
--See menu.sql

--Get a list of categories
SELECT DISTINCT category
FROM menu
ORDER BY category;


