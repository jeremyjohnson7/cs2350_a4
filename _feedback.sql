CREATE TABLE IF NOT EXISTS feedback(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(64) NOT NULL,
   age DECIMAL(3, 0),
   email VARCHAR(128) NOT NULL,
   telephone VARCHAR(64),
   address VARCHAR(256),
   city VARCHAR(64),
   `state` VARCHAR(64),
   zip VARCHAR(32),
   country VARCHAR(64),
   food_quality DECIMAL(1, 0),
   overall_qos DECIMAL(1, 0),
   cleanliness DECIMAL(1, 0),
   order_accuracy DECIMAL(1, 0),
   timely_service DECIMAL(1, 0),
   overall_value DECIMAL(1, 0),
   overall_experience DECIMAL(1, 0),
   comments VARCHAR(4096),
   ip_address VARCHAR(40),
   hostname VARCHAR(255),
   unix_time DECIMAL(12, 0) NOT NULL
);

SELECT *
FROM feedback
ORDER BY last_name, first_name;
