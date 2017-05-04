/*CREATE TABLE IF NOT EXISTS timecard(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   employee INT NOT NULL FOREIGN KEY REFERENCES employees(id),
   start_time DECIMAL(12, 0) NOT NULL,
   end_time DECIMAL(12, 0) NOT NULL
);*/

CREATE TABLE IF NOT EXISTS timecard(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   employee INT NOT NULL,
   start_time DECIMAL(12, 0) NOT NULL,
   end_time DECIMAL(12, 0) NOT NULL,
   FOREIGN KEY(employee) REFERENCES employees(id)
);

SELECT *
FROM timecard
ORDER BY start_time;

SELECT id, first_name, last_name, pay_rate, hours_worked, pay_rate * hours_worked AS amount_due
FROM employees e
JOIN(
   SELECT employee, SUM(end_time - start_time) / 3600 AS hours_worked
   FROM timecard
   GROUP BY employee
) t1
ON t1.employee = e.id
ORDER BY last_name, first_name;
