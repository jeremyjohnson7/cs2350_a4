CREATE TABLE IF NOT EXISTS suppliers(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   company VARCHAR(64) NOT NULL,
   location VARCHAR(64),
   first_name VARCHAR(64),
   last_name VARCHAR(64),
   email VARCHAR(128),
   telephone VARCHAR(64)
);

INSERT INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Nonexistent Fishery', 'South Sandwich Islands', 'Daniel', 'Burke', 'dburke@example.com', '435-555-0143');

INSERT INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Standard Bverage Co.', 'United States', 'Joel', 'Hoover', 'jhoover@example.com', '801-555-0168');

INSERT INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Example Agricultural Cooperative', 'Australia', 'Albert', 'Nelson', 'anelson@example.com', '982-555-0172');

SELECT *
FROM suppliers
ORDER BY last_name, first_name;
