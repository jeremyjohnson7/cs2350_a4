DROP TABLE IF EXISTS visits;

CREATE TABLE visits(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   ip_address VARCHAR(40) NOT NULL,
   hostname VARCHAR(255),
   url VARCHAR(4096),
   unix_time DECIMAL(12, 0) NOT NULL
);

SELECT *
FROM visits
ORDER BY ip_address;


SELECT t1.ip_address, t2.hostname, t1.number_of_visits, t2.most_recent
FROM(
   SELECT ip_address, COUNT(*) AS number_of_visits
   FROM visits
   GROUP BY ip_address
   ORDER BY ip_address
) t1
JOIN(
   SELECT ip_address, hostname, MAX(unix_time) AS most_recent
   FROM visits
   GROUP BY ip_address, hostname
   ORDER BY ip_address
) t2
ON t1.ip_address = t2.ip_address
ORDER BY t1.number_of_visits DESC, t2.most_recent DESC, t1.ip_address;


SELECT mcmlxx, COUNT(ip_address) AS unique_visitors, SUM(visits) AS page_views
FROM(
   SELECT FLOOR(unix_time / 86400) AS mcmlxx, ip_address, COUNT(*) AS visits
   FROM visits
   GROUP BY FLOOR(unix_time / 86400), ip_address
) t1
GROUP BY mcmlxx
ORDER BY mcmlxx DESC;


SELECT DISTINCT url, COUNT(*) AS views, MAX(unix_time) AS most_recent
FROM visits
GROUP BY url;


