USE mycook;
INSERT INTO ingredients (ingredient_id, name, calories, carbohydrates, sugars, fat, saturated, protein, salt) VALUES 
(11, 'Wheat flour', 364, 76, 0.3, 1, 0.2, 10, 0.01),
(12, 'Sugar', 387, 100, 100, 0, 0, 0, 0.01),
(13, 'Butter', 717, 0.1, 0.1, 81, 51, 1, 1.5),
(14, 'Milk', 42, 5, 5, 1, 0.6, 3.4, 0.05),
(15, 'Egg', 155, 1.1, 1.1, 11, 3.3, 13, 0.32),
(16, 'Salt', 0, 0, 0, 0, 0, 0, 38.7),
(17, 'Olive oil', 884, 0, 0, 100, 14, 0, 0),
(18, 'Tomato', 18, 3.9, 2.6, 0.2, 0, 0.9, 0.01),
(19, 'Cheddar cheese', 403, 1.3, 0.5, 33, 19, 25, 1.7),
(20, 'Pasta', 131, 25, 0.8, 1.1, 0.2, 5, 0.01);

INSERT INTO measurements (measurement_id, name, type, equals_to) VALUES
(11, 'Cup', 'volume', 240),
(12, 'Tablespoon', 'volume', 15),
(13, 'Teaspoon', 'volume', 5),
(14, 'Grams', 'weight', 1),
(15, 'Kilograms', 'weight', 1000),
(16, 'Milliliters', 'volume', 1),
(17, 'Liters', 'volume', 1000),
(18, 'Ounces', 'weight', 28.35),
(19, 'Pounds', 'weight', 453.6);

INSERT INTO methods (method_id, name) VALUES
(11, 'Bake'),
(12, 'Fry'),
(13, 'Boil'),
(14, 'Grill'),
(15, 'Saute'),
(16, 'Whisk'),
(17, 'Mix'),
(18, 'Stir');

-- Create the post
INSERT INTO posts (post_id, title, body, user_id) VALUES 
(11, 'Chocolate Cake', 'A delicious and moist chocolate cake perfect for any occasion.', 1);

-- Create the recipe
INSERT INTO recipes (recipe_id, post_id, duration, difficulty, quantity) VALUES 
(11, 11, '01:30:00', 'medio', 8);

-- Insert ingredients for Chocolate Cake
INSERT INTO recipe_ingredients (recipe_ingredient_id, recipe_id, ingredient_id, measurement_id, quantity) VALUES 
(11, 11, 11, 14, 200),  -- 200 grams of wheat flour
(12, 11, 12, 14, 200),  -- 200 grams of sugar
(13, 11, 13, 14, 200),  -- 200 grams of butter
(14, 11, 14, 17, 250),  -- 250 milliliters of milk
(15, 11, 15, 14, 4),    -- 4 eggs
(16, 11, 16, 13, 1);    -- 1 teaspoon of salt

-- Insert steps for Chocolate Cake
INSERT INTO steps (step_id, title, description, time, recipe_id, method_id) VALUES 
(11, 'Preheat oven', 'Preheat your oven to 180°C (350°F).', '00:10:00', 11, 11),
(12, 'Mix dry ingredients', 'In a bowl, mix the flour, sugar, and salt.', '00:05:00', 11, 17),
(13, 'Mix wet ingredients', 'In another bowl, whisk the eggs, then add the melted butter and milk.', '00:10:00', 11, 16),
(14, 'Combine ingredients', 'Gradually add the dry ingredients to the wet mixture, stirring until smooth.', '00:10:00', 11, 18),
(15, 'Bake', 'Pour the batter into a greased baking tin and bake for 45 minutes.', '00:45:00', 11, 11);

-- Create the post
INSERT INTO posts (post_id, title, body, user_id) VALUES 
(12, 'Pasta with Tomato Sauce', 'A simple and classic pasta dish with a rich tomato sauce.', 2);

-- Create the recipe
INSERT INTO recipes (recipe_id, post_id, duration, difficulty, quantity) VALUES 
(12, 12, '00:30:00', 'facil', 4);

-- Insert ingredients for Pasta with Tomato Sauce
INSERT INTO recipe_ingredients (recipe_ingredient_id, recipe_id, ingredient_id, measurement_id, quantity) VALUES 
(17, 12, 20, 14, 200), -- 200 grams of pasta
(18, 12, 18, 14, 400), -- 400 grams of tomatoes
(19, 12, 17, 14, 50),  -- 50 grams of olive oil
(20, 12, 16, 13, 1);   -- 1 teaspoon of salt

-- Insert steps for Pasta with Tomato Sauce
INSERT INTO steps (step_id, title, description, time, recipe_id, method_id) VALUES 
(16, 'Boil pasta', 'Boil a pot of salted water and cook the pasta until al dente.', '00:10:00', 12, 13),
(17, 'Prepare sauce', 'Heat olive oil in a pan, add chopped tomatoes and salt, and simmer for 15 minutes.', '00:15:00', 12, 15),
(18, 'Combine pasta and sauce', 'Drain the pasta and mix it with the tomato sauce.', '00:05:00', 12, 18);

-- Create the post
INSERT INTO posts (post_id, title, body, user_id) VALUES 
(13, 'Grilled Cheddar Cheese Sandwich', 'A quick and easy grilled cheese sandwich.', 3);

-- Create the recipe
INSERT INTO recipes (recipe_id, post_id, duration, difficulty, quantity) VALUES 
(13, 13, '00:15:00', 'facil', 2);

-- Insert ingredients for Grilled Cheddar Cheese Sandwich
INSERT INTO recipe_ingredients (recipe_ingredient_id, recipe_id, ingredient_id, measurement_id, quantity) VALUES 
(21, 13, 11, 14, 50),  -- 50 grams of wheat flour
(22, 13, 12, 14, 5),   -- 5 grams of sugar
(23, 13, 13, 14, 10),  -- 10 grams of butter
(24, 13, 19, 14, 100); -- 100 grams of cheddar cheese

-- Insert steps for Grilled Cheddar Cheese Sandwich
INSERT INTO steps (step_id, title, description, time, recipe_id, method_id) VALUES 
(19, 'Prepare bread', 'Spread butter on one side of each bread slice.', '00:05:00', 13, 18),
(20, 'Add cheese', 'Place cheddar cheese slices between the bread.', '00:05:00', 13, 18),
(21, 'Grill sandwich', 'Grill the sandwich on a pan until golden brown and cheese is melted.', '00:05:00', 13, 14);

-- Create the post
INSERT INTO posts (post_id, title, body, user_id) VALUES 
(14, 'Sauteed Tomato and Pasta', 'A light and tasty pasta dish with sauteed tomatoes.', 4);

-- Create the recipe
INSERT INTO recipes (recipe_id, post_id, duration, difficulty, quantity) VALUES 
(14, 14, '00:25:00', 'medio', 4);

-- Insert ingredients for Sauteed Tomato and Pasta
INSERT INTO recipe_ingredients (recipe_ingredient_id, recipe_id, ingredient_id, measurement_id, quantity) VALUES 
(25, 14, 20, 14, 200), -- 200 grams of pasta
(26, 14, 18, 14, 400), -- 400 grams of tomatoes
(27, 14, 17, 14, 50),  -- 50 grams of olive oil
(28, 14, 16, 13, 1);   -- 1 teaspoon of salt

-- Insert steps for Sauteed Tomato and Pasta
INSERT INTO steps (step_id, title, description, time, recipe_id, method_id) VALUES 
(22, 'Boil pasta', 'Boil a pot of salted water and cook the pasta until al dente.', '00:10:00', 14, 13),
(23, 'Saute tomatoes', 'Heat olive oil in a pan, add chopped tomatoes and salt, and saute for 10 minutes.', '00:10:00', 14, 15),
(24, 'Combine pasta and tomatoes', 'Drain the pasta and mix it with the sauteed tomatoes.', '00:05:00', 14, 18);
