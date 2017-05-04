DROP TABLE IF EXISTS users;

CREATE TABLE users(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(64) NOT NULL UNIQUE,
   password VARCHAR(128) NOT NULL,
   `group` VARCHAR(16) NOT NULL
);

INSERT INTO users(username, password, `group`)
VALUES('Jeremy', 'bddb2d1de33c698d369d86b81ec8a233', 'Admin');

INSERT INTO users(username, password, `group`)
VALUES('Investor', 'babb17168110c6415844d610970218bf', 'Admin');

SELECT *
FROM users
ORDER BY username;
