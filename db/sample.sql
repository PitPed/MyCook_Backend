USE mycook;

INSERT INTO users (name, email, password) VALUES
('Anon', 'anon@example.com', 'password123'),
('Maria', 'maria@example.com', 'securepass'),
('Pedro', 'pedro@example.com', 'mypassword'),
('Ana', 'ana@example.com', 'anapassword'),
('Carlos', 'carlos@example.com', 'carlospass'),
('Laura', 'laura@example.com', 'laurapass'),
('Sofia', 'sofia@example.com', 'sofiapassword'),
('Luis', 'luis@example.com', 'luispass'),
('Elena', 'elena@example.com', 'elenapass'),
('Diego', 'diego@example.com', 'diegopassword');

INSERT INTO ingredients (name, calories, carbohydrates, sugars, fat, saturated, protein, salt) VALUES
('Tomato', 25.6, 4.8, 3.2, 0.3, 0.1, 1.2, 0.03),
('Chicken Breast', 165.2, 0.0, 0.0, 3.6, 1.0, 31.9, 0.06),
('Rice', 130.0, 28.7, 0.0, 0.3, 0.1, 2.7, 0.0),
('Broccoli', 54.6, 10.6, 1.2, 0.6, 0.1, 4.2, 0.05),
('Egg', 68.0, 0.6, 0.6, 4.8, 1.6, 6.0, 0.2),
('Olive Oil', 119.2, 0.0, 0.0, 13.5, 1.9, 0.0, 0.0),
('Milk', 42.0, 4.7, 4.7, 1.0, 0.6, 3.4, 0.1),
('Apple', 52.0, 14.0, 10.0, 0.2, 0.0, 0.3, 0.0),
('Beef', 250.0, 0.0, 0.0, 20.0, 8.0, 25.0, 0.05),
('Lettuce', 14.0, 2.9, 1.4, 0.1, 0.0, 1.4, 0.01);

INSERT INTO channels (name, is_public, open_posting) VALUES
('Recipes', TRUE, TRUE),
('Healthy Eating', TRUE, TRUE),
('Desserts', TRUE, FALSE),
('Vegetarian', TRUE, TRUE),
('Grilling', FALSE, FALSE),
('Drinks', TRUE, TRUE),
('Quick Meals', TRUE, TRUE),
('Baking', FALSE, TRUE),
('Seafood', TRUE, TRUE),
('Slow Cooker', TRUE, TRUE);

INSERT INTO measurements (name, type, equals_to) VALUES
('Teaspoon', 'volume', 5),
('Tablespoon', 'volume', 15),
('Cup', 'volume', 240),
('Gram', 'weight', 1),
('Ounce', 'weight', 28.35),
('Pound', 'weight', 453.59),
('Milliliter', 'volume', 1),
('Liter', 'volume', 1000),
('Kilogram', 'weight', 1000),
('Fluid Ounce', 'volume', 29.57);

INSERT INTO methods (name) VALUES
('Boiling'),
('Grilling'),
('Baking'),
('Sauteing'),
('Roasting'),
('Steaming'),
('Frying'),
('Slow Cooking'),
('Microwaving'),
('Blending');

INSERT INTO categories (name) VALUES
('Appetizers'),
('Main Dishes'),
('Salads'),
('Side Dishes'),
('Desserts'),
('Snacks'),
('Drinks'),
('Soups'),
('Breakfast'),
('Sandwiches');

INSERT INTO tags (name) VALUES
('Healthy'),
('Easy'),
('Quick'),
('Vegetarian'),
('Low Carb'),
('Gluten Free'),
('Vegan'),
('Family Friendly'),
('Low Calorie'),
('Budget Friendly');

INSERT INTO menus (user_id, name) VALUES
(1, 'Healthy Week Menu'),
(2, 'Vegetarian Delights'),
(3, 'Quick and Easy Meals'),
(4, 'Low Carb Recipes'),
(5, 'Family Favorites'),
(6, 'Dessert Extravaganza'),
(7, 'Summer Grilling'),
(8, 'Budget Meals'),
(9, 'Sunday Brunch'),
(10, 'Holiday Feast');

INSERT INTO posts (title, body, user_id) VALUES
('Delicious Tomato Soup', 'Here is a great recipe for homemade tomato soup...', 1),
('Grilled Chicken Skewers', 'Try these flavorful grilled chicken skewers for your next BBQ...', 3),
('Easy Baked Salmon', 'This baked salmon recipe is perfect for a quick and healthy dinner...', 2),
('Vegetarian Chili', 'Warm up with a bowl of hearty vegetarian chili...', 4),
('Chocolate Chip Cookies', 'Indulge your sweet tooth with these classic chocolate chip cookies...', 6),
('Refreshing Summer Cocktails', 'Beat the heat with these delicious summer cocktails...', 5),
('10-Minute Pasta Primavera', 'Make this quick and easy pasta primavera for a satisfying weeknight meal...', 7),
('Homemade Bread', "There's nothing like the smell of freshly baked bread...", 8),
('Shrimp Tacos', 'These shrimp tacos are bursting with flavor and perfect for taco night...', 9),
('Holiday Roast Turkey', 'Impress your guests with this juicy and flavorful roast turkey...', 10);

INSERT INTO post_votes (liked, user_id, post_id) VALUES
(true, 1, 1),
(false, 2, 1),
(true, 3, 2),
(false, 4, 2),
(true, 5, 3),
(false, 6, 3),
(true, 7, 4),
(false, 8, 4),
(true, 9, 5),
(false, 10, 5),
(true, 1, 6),
(false, 2, 6),
(true, 3, 7),
(false, 4, 7),
(true, 5, 8),
(false, 6, 8),
(true, 7, 9),
(false, 8, 9),
(true, 9, 10),
(false, 10, 10);

INSERT INTO recipes (post_id, duration, difficulty, quantity) VALUES
(1, '01:00:00', 'medio', 4),
(2, '00:45:00', 'facil', 6),
(3, '00:30:00', 'facil', 2),
(4, '01:30:00', 'medio', 8),
(5, '00:20:00', 'facil', 24),
(6, '00:15:00', 'facil', 1),
(7, '00:20:00', 'medio', 4),
(8, '02:30:00', 'dificil', 2),
(9, '00:45:00', 'medio', 4),
(10, '03:00:00', 'dificil', 10);

INSERT INTO comments (body, user_id, post_id) VALUES
('Great recipe, I will definitely make it again!', 2, 1),
('These skewers were a hit at our BBQ, thanks for sharing!', 4, 2),
('Simple and delicious, my family loved it!', 3, 3),
('I added extra beans to the chili and it turned out great!', 5, 4),
('Best cookies ever, thanks for the recipe!', 7, 5),
("Can't wait to try these cocktails, they look amazing!", 6, 6),
('Made this pasta for dinner tonight, it was a hit!', 8, 7),
('The bread came out perfect, thanks for the recipe!', 9, 8),
('These shrimp tacos are my new favorite!', 10, 9),
('First time cooking a turkey and it was a success!', 1, 10);

INSERT INTO images (url, alt) VALUES
('image1.jpg', 'Tomato Soup'),
('image2.jpg', 'Grilled Chicken Skewers'),
('image3.jpg', 'Baked Salmon'),
('image4.jpg', 'Vegetarian Chili'),
('image5.jpg', 'Chocolate Chip Cookies'),
('image6.jpg', 'Summer Cocktails'),
('image7.jpg', 'Pasta Primavera'),
('image8.jpg', 'Homemade Bread'),
('image9.jpg', 'Shrimp Tacos'),
('image10.jpg', 'Roast Turkey');

INSERT INTO members (user_id, channel_id, rol) VALUES
(1, 1, 'admin'),
(2, 2, 'manager'),
(3, 3, 'poster'),
(4, 4, 'member'),
(5, 5, 'member'),
(6, 6, 'admin'),
(7, 7, 'poster'),
(8, 8, 'member'),
(9, 9, 'member'),
(10, 10, 'manager');

INSERT INTO post_channels (post_id, channel_id) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 6),
(9, 7),
(10, 8);

INSERT INTO recipe_ingredients (recipe_id, ingredient_id, measurement_id, quantity) VALUES
(1, 1, 7, 100),
(2, 2, 8, 500),
(3, 3, 9, 2),
(4, 4, 7, 300),
(5, 5, 6, 200),
(6, 6, 10, 24),
(7, 7, 1, 1),
(8, 8, 6, 200),
(9, 9, 3, 1),
(10, 10, 5, 5);

INSERT INTO ingredient_categories (ingredient_id, category_id) VALUES
(1, 3),
(2, 1),
(3, 4),
(4, 3),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO recipe_tags (recipe_id, tag_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO menu_recipes (menu_id, recipe_id, day, meal) VALUES
(1, 1, 1, 1),
(2, 3, 2, 2),
(3, 5, 3, 3),
(4, 7, 4, 1),
(5, 9, 5, 2),
(6, 2, 6, 3),
(7, 4, 7, 1),
(8, 6, 8, 2),
(9, 8, 9, 3),
(10, 10, 10, 1);

INSERT INTO steps (title, description, time, recipe_id, method_id) VALUES
('Chop Tomatoes', 'Dice the tomatoes into small pieces.', '00:10:00', 1, 4),
('Marinate Chicken', 'Marinate the chicken with spices and let it sit for 30 minutes.', '00:30:00', 2, 7),
('Season Salmon', 'Season the salmon fillets with salt, pepper, and lemon juice.', '00:05:00', 3, 4),
('Prepare Ingredients', 'Chop vegetables and gather all ingredients.', '00:15:00', 4, 10),
('Mix Dough', 'Combine flour, water, yeast, and salt in a bowl.', '00:20:00', 5, 10),
('Blend Ingredients', 'Combine all ingredients in a blender and blend until smooth.', '00:05:00', 6, 10),
('Cook Pasta', 'Boil water and cook pasta according to package instructions.', '00:12:00', 7, 1),
('Knead Dough', 'Knead the dough on a floured surface until smooth and elastic.', '00:15:00', 8, 10),
('Grill Shrimp', 'Grill the shrimp skewers for 3-4 minutes on each side.', '00:08:00', 9, 2),
('Roast Turkey', 'Roast the turkey in the oven at 350°F for 3-4 hours, basting occasionally.', '03:30:00', 10, 5);

INSERT INTO post_images (post_id, image_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO user_images (user_id, image_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO step_images (step_id, image_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);