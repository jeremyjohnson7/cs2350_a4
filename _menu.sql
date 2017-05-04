DROP TABLE IF EXISTS menu;

CREATE TABLE menu(
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   description VARCHAR(255) NOT NULL UNIQUE,
   category VARCHAR(16) NOT NULL,
   price DECIMAL(8, 2) DEFAULT 0
);

INSERT INTO menu(description, category, price)
VALUES('Enchilladas (Chicken)', 'Entrees', 8.99);

INSERT INTO menu(description, category, price)
VALUES('Enchilladas (Beef)', 'Entrees', 8.99);

INSERT INTO menu(description, category, price)
VALUES('Enchilladas (Cheese)', 'Entrees', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Coconut Chicken Curry with Rice', 'Entrees', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Fried Steak', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Pumpkin Pie', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Lasagne', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Spaghetti', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Liver &amp; Onions', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Sirloin Steak', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Pot Roast', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Nachos', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Quesadilla', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Spinach &amp; Artichoke Dip', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Breaded Zuccini', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Chef Salad', 'Salads', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Taco Salad', 'Salads', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Garden Salad', 'Salads', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Caesar Salad', 'Salads', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Salad', 'Salads', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Clam Chowder', 'Soup', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Noodle Soup', 'Soup', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Potato Soup with Bacon', 'Soup', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Split Pea Soup', 'Soup', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Corn Chowder', 'Soup', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Classic Club Sandwich', 'Sandwiches', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Bacon, Lettuce, &amp; Tomato Sandwich', 'Sandwiches', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Turkey Bacon Swiss Avacado', 'Sandwiches', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Pecan Salad Sandwich', 'Sandwiches', 9.99);

INSERT INTO menu(description, category, price)
VALUES('French Dip', 'Sandwiches', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Carrot Cake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Lemon Bars', 'Dessert', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Banana Cake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Pineapple Cononut Cake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('German Chocolate Cake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Cononut Cream Pie', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Cherry Cheesecake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Blueberry Cheesecake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Cheesecake', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Apple Crisp', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Peach Cobler', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Apple Pie', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Lemon Pie', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Cherry Pie', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Chocolate Eclairs', 'Dessert', 4.99);

INSERT INTO menu(description, category, price)
VALUES('Ice Cream', 'Dessert', 3.25);

INSERT INTO menu(description, category, price)
VALUES('Chicken Cordon Bleu', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Tikka Masala', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Roast Turkey', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Fried Chicken', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Veal Parmesan', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Breaded Veal', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Parmesan', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Halibut Fish &amp; Chips', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Parmesan Noodles', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Garlic Bread', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Trout', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Salmon', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Filet Mignon', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Lobster', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Crab', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Swedish Meatballs', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Barbecue Ribs', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Guacamole', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Onion Rings', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Breaded Cheese Sticks', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Corn', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Mashed Potatoes', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Deviled Eggs', 'Appetizers', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Mixed Vegetables', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Sauteed Onions', 'Sides', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Raspberry Lemonade', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Lemonade', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Milk', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Sprite', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Ginger Ale', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Root Beer', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Pancakes', 'Breakfast', 7.99);

INSERT INTO menu(description, category, price)
VALUES('Waffles', 'Breakfast', 8.99);

INSERT INTO menu(description, category, price)
VALUES('Eggs', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Omelets', 'Breakfast', 9.99);

INSERT INTO menu(description, category, price)
VALUES('Citrus Water', 'Beverages', 2.50);

INSERT INTO menu(description, category, price)
VALUES('Crepes', 'Breakfast', 8.99);

INSERT INTO menu(description, category, price)
VALUES('French Toast', 'Breakfast', 8.99);

INSERT INTO menu(description, category, price)
VALUES('Hash Browns', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Sausage', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Bacon', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Ham', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Toast', 'Breakfast', 1.50);

INSERT INTO menu(description, category, price)
VALUES('Cinnamon Rolls', 'Breakfast', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Oatmeal', 'Breakfast', 5.99);

INSERT INTO menu(description, category, price)
VALUES('Danish', 'Breakfast', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Donuts', 'Breakfast', 1.75);

INSERT INTO menu(description, category, price)
VALUES('Blueberry Muffins', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Bran Muffins', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Choclotate Chip Muffins', 'Breakfast', 2.99);

INSERT INTO menu(description, category, price)
VALUES('Apple Turnovers', 'Dessert', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Cherry Turnovers', 'Dessert', 3.99);

INSERT INTO menu(description, category, price)
VALUES('Beef Stroganoff', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Beef Chimichangas', 'Entrees', 15.99);

INSERT INTO menu(description, category, price)
VALUES('Chicken Chimichangas', 'Entrees', 15.99);

SELECT *
FROM menu
ORDER BY category, description;
