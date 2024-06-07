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
('Lettuce', 14.0, 2.9, 1.4, 0.1, 0.0, 1.4, 0.01),
('Wheat flour', 364, 76, 0.3, 1, 0.2, 10, 0.01),
('Sugar', 387, 100, 100, 0, 0, 0, 0.01),
('Butter', 717, 0.1, 0.1, 81, 51, 1, 1.5),
('Salt', 0, 0, 0, 0, 0, 0, 38.7),
('Cheddar cheese', 403, 1.3, 0.5, 33, 19, 25, 1.7),
('Pasta', 131, 25, 0.8, 1.1, 0.2, 5, 0.01),
('Mozzarella cheese', 280, 3.1, 1, 17, 11, 28, 0.8),
('Bacon', 541, 1.4, 0, 42, 14, 37, 1.8);

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
('Slow Cooker', TRUE, TRUE),
('Italian Food', TRUE, TRUE);

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
('Blending'),
('Fry'),
('Boil'),
('Whisk'),
('Mix'),
('Stir');

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
('Holiday Roast Turkey', 'Impress your guests with this juicy and flavorful roast turkey...', 10),
('Chocolate Cake', 'A delicious and moist chocolate cake perfect for any occasion.', 1),
('Pasta with Tomato Sauce', 'A simple and classic pasta dish with a rich tomato sauce.', 2),
('Grilled Cheddar Cheese Sandwich', 'A quick and easy grilled cheese sandwich.', 3),
('Sauteed Tomato and Pasta', 'A light and tasty pasta dish with sauteed tomatoes.', 4);

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
(10, '03:00:00', 'dificil', 10),
(11, '01:30:00', 'medio', 8),
(12, '00:30:00', 'facil', 4),
(13, '00:15:00', 'facil', 2),
(14, '00:25:00', 'medio', 4);

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
('image10.jpg', 'Roast Turkey'),
('image11.jpg', 'Chocolate Cake'),
('image12.jpg', 'Chocolate Cake'),
('image13.jpg', 'Pasta with Tomato Sauce'),
('image14.jpg', 'Pasta with Tomato Sauce'),
('image15.jpg', 'Cheese Sandwich'),
('image16.jpg', 'Cheese Sandwich'),
('image17.jpg', 'Sauteed Tomato and Pasta'),
('image18.jpg', 'Sauteed Tomato and Pasta');


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
(10, 10, 5, 5),
(11, 11, 4, 200),
(11, 12, 4, 200),
(11, 13, 4, 200),
(11, 14, 5, 250),
(11, 15, 4, 4),
(11, 16, 3, 1),
(12, 10, 4, 200),
(12, 18, 4, 400),
(12, 17, 4, 50),
(12, 16, 3, 1),
(13, 11, 4, 50),
(13, 12, 4, 5),
(13, 13, 4, 10),
(13, 10, 4, 100),
(14, 12, 4, 200),
(14, 14, 4, 400),
(14, 17, 4, 50),
(14, 16, 3, 1);

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
('Roast Turkey', 'Roast the turkey in the oven at 350°F for 3-4 hours, basting occasionally.', '03:30:00', 10, 5),
('Preheat oven', 'Preheat your oven to 180°C (350°F).', '00:10:00', 11, 11),
('Mix dry ingredients', 'In a bowl, mix the flour, sugar, and salt.', '00:05:00', 11, 7),
('Mix wet ingredients', 'In another bowl, whisk the eggs, then add the melted butter and milk.', '00:10:00', 11, 5),
('Combine ingredients', 'Gradually add the dry ingredients to the wet mixture, stirring until smooth.', '00:10:00', 11, 12),
('Bake', 'Pour the batter into a greased baking tin and bake for 45 minutes.', '00:45:00', 11, 11),
('Boil pasta', 'Boil a pot of salted water and cook the pasta until al dente.', '00:10:00', 12, 13),
('Prepare sauce', 'Heat olive oil in a pan, add chopped tomatoes and salt, and simmer for 15 minutes.', '00:15:00', 12, 10),
('Combine pasta and sauce', 'Drain the pasta and mix it with the tomato sauce.', '00:05:00', 12, 1),
('Prepare bread', 'Spread butter on one side of each bread slice.', '00:05:00', 13, 7),
('Add cheese', 'Place cheddar cheese slices between the bread.', '00:05:00', 13, 7),
('Grill sandwich', 'Grill the sandwich on a pan until golden brown and cheese is melted.', '00:05:00', 13, 4),
('Boil pasta', 'Boil a pot of salted water and cook the pasta until al dente.', '00:10:00', 14, 8),
('Saute tomatoes', 'Heat olive oil in a pan, add chopped tomatoes and salt, and saute for 10 minutes.', '00:10:00', 14, 4),
('Combine pasta and tomatoes', 'Drain the pasta and mix it with the sauteed tomatoes.', '00:05:00', 12, 4);

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
(10, 10),
(11, 11),
(11, 12),
(12, 13),
(12, 14),
(13, 15),
(13, 16),
(14, 17),
(14, 18);

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