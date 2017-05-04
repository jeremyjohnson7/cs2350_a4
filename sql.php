<?php
   include_once("globvar.php");
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of users
      $users = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare("
CREATE TABLE IF NOT EXISTS users(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(64) NOT NULL UNIQUE,
   password VARCHAR(128) NOT NULL,
   `group` VARCHAR(16) NOT NULL
);

INSERT IGNORE INTO users(username, password, `group`)
VALUES('Jeremy', 'bddb2d1de33c698d369d86b81ec8a233', 'Admin');

INSERT IGNORE INTO users(username, password, `group`)
VALUES('Investor', 'babb17168110c6415844d610970218bf', 'Admin');

CREATE TABLE IF NOT EXISTS visits(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   ip_address VARCHAR(40) NOT NULL,
   hostname VARCHAR(255),
   url VARCHAR(4096),
   unix_time DECIMAL(12, 0) NOT NULL
);

CREATE TABLE IF NOT EXISTS menu(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   description VARCHAR(255) NOT NULL UNIQUE,
   category VARCHAR(16) NOT NULL,
   price DECIMAL(8, 2) DEFAULT 0
);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Enchilladas (Chicken)', 'Entrees', 8.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Enchilladas (Beef)', 'Entrees', 8.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Enchilladas (Cheese)', 'Entrees', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Coconut Chicken Curry with Rice', 'Entrees', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Fried Steak', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Pumpkin Pie', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Lasagne', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Spaghetti', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Sirloin Steak', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Pot Roast', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Nachos', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Quesadilla', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Spinach & Artichoke Dip', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Breaded Zuccini', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chef Salad', 'Salads', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Taco Salad', 'Salads', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Garden Salad', 'Salads', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Caesar Salad', 'Salads', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Salad', 'Salads', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Clam Chowder', 'Soup', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Noodle Soup', 'Soup', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Potato Soup with Bacon', 'Soup', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Split Pea Soup', 'Soup', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Corn Chowder', 'Soup', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Classic Club Sandwich', 'Sandwiches', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Bacon, Lettuce, & Tomato Sandwich', 'Sandwiches', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Turkey Bacon Swiss Avacado', 'Sandwiches', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Pecan Salad Sandwich', 'Sandwiches', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('French Dip', 'Sandwiches', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Carrot Cake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Lemon Bars', 'Dessert', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Banana Cake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Pineapple Cononut Cake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('German Chocolate Cake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cononut Cream Pie', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cherry Cheesecake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Blueberry Cheesecake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cheesecake', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Apple Crisp', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Peach Cobler', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Apple Pie', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Lemon Pie', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cherry Pie', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chocolate Eclairs', 'Dessert', 4.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Ice Cream', 'Dessert', 3.25);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Cordon Bleu', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Tikka Masala', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Roast Turkey', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Fried Chicken', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Veal Parmesan', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Breaded Veal', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Parmesan', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Halibut Fish & Chips', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Parmesan Noodles', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Garlic Bread', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Trout', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Salmon', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Filet Mignon', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Lobster', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Crab', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Swedish Meatballs', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Barbecue Ribs', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Guacamole', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Onion Rings', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Breaded Cheese Sticks', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Corn', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Mashed Potatoes', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Deviled Eggs', 'Appetizers', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Mixed Vegetables', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Sauteed Onions', 'Sides', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Raspberry Lemonade', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Lemonade', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Milk', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Sprite', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Ginger Ale', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Root Beer', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Pancakes', 'Breakfast', 7.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Waffles', 'Breakfast', 8.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Eggs', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Omelets', 'Breakfast', 9.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Citrus Water', 'Beverages', 2.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Crepes', 'Breakfast', 8.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('French Toast', 'Breakfast', 8.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Hash Browns', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Sausage', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Bacon', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Ham', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Toast', 'Breakfast', 1.50);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cinnamon Rolls', 'Breakfast', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Oatmeal', 'Breakfast', 5.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Danish', 'Breakfast', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Donuts', 'Breakfast', 1.75);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Blueberry Muffins', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Bran Muffins', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Choclotate Chip Muffins', 'Breakfast', 2.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Apple Turnovers', 'Dessert', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Cherry Turnovers', 'Dessert', 3.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Beef Stroganoff', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Beef Chimichangas', 'Entrees', 15.99);

INSERT IGNORE INTO menu(description, category, price)
VALUES('Chicken Chimichangas', 'Entrees', 15.99);

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

DROP TABLE IF EXISTS employees;

CREATE TABLE IF NOT EXISTS employees(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   first_name VARCHAR(64) NOT NULL,
   last_name VARCHAR(64) NOT NULL,
   title VARCHAR(64) NOT NULL,
   email VARCHAR(128) NOT NULL,
   pay_rate DECIMAL(8, 2) NOT NULL
);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Conrad', 'Price', 'Chef', 'cprice@example.com', 80.85);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Kenneth', 'Blackwell', 'Assistant Chef', 'kblackwell@example.com', 30.94);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('George', 'Clayton', 'Manager', 'gclayton@example.com', 75.18);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Jeff', 'Greer', 'Waiter', 'jgreer@example.com', 9.46);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Violet', 'Ellison', 'Waitress', 'vellison@example.com', 8.10);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Donald', 'Anderson', 'Waiter', 'danderson@example.com', 8.86);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Sarah', 'Stafford', 'Supervisor', 'sstafford@example.com', 12.00);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Paula', 'Bernard', 'Waitress', 'pbernard@example.com', 9.46);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Georgia', 'Campbell', 'Waitress', 'gcampbell@example.com', 8.00);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Chester', 'Casey', 'Waiter', 'ccasey@example.com', 9.50);

INSERT IGNORE INTO employees(first_name, last_name, title, email, pay_rate)
VALUES('Leo', 'Wilcox', 'Janitor', 'lwilcox@example.com', 10.53);

DROP TABLE IF EXISTS suppliers;

CREATE TABLE IF NOT EXISTS suppliers(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   company VARCHAR(64) NOT NULL,
   location VARCHAR(64),
   first_name VARCHAR(64),
   last_name VARCHAR(64),
   email VARCHAR(128),
   telephone VARCHAR(64)
);

INSERT IGNORE INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Nonexistent Fishery', 'South Sandwich Islands', 'Daniel', 'Burke', 'dburke@example.com', '435-555-0143');

INSERT IGNORE INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Standard Bverage Co.', 'United States', 'Joel', 'Hoover', 'jhoover@example.com', '801-555-0168');

INSERT IGNORE INTO suppliers(company, location, first_name, last_name, email, telephone)
VALUES('Example Agricultural Cooperative', 'Australia', 'Albert', 'Nelson', 'anelson@example.com', '982-555-0172');

CREATE TABLE IF NOT EXISTS timecard(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   employee INT NOT NULL,
   start_time DECIMAL(12, 0) NOT NULL,
   end_time DECIMAL(12, 0) NOT NULL,
   FOREIGN KEY(employee) REFERENCES employees(id) ON DELETE CASCADE
);

      ")){
         $stmt->execute();
         $stmt->close();
      }
      
      //Terminate db connection
      $mysqli->close();
   }
?>
