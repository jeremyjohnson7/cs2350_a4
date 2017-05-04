DROP TABLE IF EXISTS employees;

CREATE TABLE employees(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   first_name VARCHAR(64) NOT NULL,
   last_name VARCHAR(64) NOT NULL,
   title VARCHAR(64) NOT NULL,
   email VARCHAR(128) NOT NULL,
   pay_rate DECIMAL(8, 2) NOT NULL
);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Conrad', 'Price', 'Chef', 'cprice@example.com', 80.85);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Kenneth', 'Blackwell', 'Assistant Chef', 'kblackwell@example.com', 30.94);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('George', 'Clayton', 'Manager', 'gclayton@example.com', 75.18);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Jeff', 'Greer', 'Waiter', 'jgreer@example.com', 9.46);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Violet', 'Ellison', 'Waitress', 'vellison@example.com', 8.10);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Donald', 'Anderson', 'Waiter', 'danderson@example.com', 8.86);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Sarah', 'Stafford', 'Supervisor', 'sstafford@example.com', 12.00);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Paula', 'Bernard', 'Waitress', 'pbernard@example.com', 9.46);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Georgia', 'Campbell', 'Waitress', 'gcampbell@example.com', 8.00);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Chester', 'Casey', 'Waiter', 'ccasey@example.com', 9.50);

INSERT INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Leo', 'Wilcox', 'Janitor', 'lwilcox@example.com', 10.53);

SELECT *
FROM employees
ORDER BY last_name, first_name;
