CREATE DATABASE IF NOT EXISTS mycook CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

USE mycook;

-- Tabla users (user_id, name, email, password)
CREATE TABLE users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla ingredients (ingredient_id, name, calories, carbohydrates, sugars, fat, saturated, protein, salt)
CREATE TABLE ingredients (
    ingredient_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    calories DECIMAL NOT NULL,
    carbohydrates DECIMAL NOT NULL,
    sugars DECIMAL NOT NULL,
    fat DECIMAL NOT NULL,
    saturated DECIMAL NOT NULL,
    protein DECIMAL NOT NULL,
    salt DECIMAL NOT NULL
);

-- Tabla channels (channel_id, name, is_public, open_posting)
CREATE TABLE channels (
    channel_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    is_public BOOLEAN NOT NULL,
    open_posting BOOLEAN NOT NULL
);

-- Tabla measurements (measurement_id, name)
CREATE TABLE measurements (
    measurement_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('volume', 'weight')
);

-- Tabla methods (method_id, name)
CREATE TABLE methods (
    method_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla categories (category_id, name)
CREATE TABLE categories (
    category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla tags(tag_id, name)
CREATE TABLE tags (
    tag_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla menus(menu_id, name)
CREATE TABLE menus (
    menu_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tabla posts (post_id, author, date, title, body, user_id(PK))
CREATE TABLE posts (
    post_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tabla recipes (recipe_id, duration, difficulty, portion, post_id(PK))
CREATE TABLE recipes (
    recipe_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED,
    duration TIME NOT NULL,
    difficulty ENUM('facil', 'medio', 'dificil') NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

-- Tabla comment(comment_id, body, user_id(PK), post_id(PK))
CREATE TABLE comment (
    comment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    body TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

-- Tabla image(image_id, url, alt, post_id(PK))
CREATE TABLE images (
    image_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    alt VARCHAR(255) NOT NULL
);

-- Tabla members(user_id(PK), group_id(PK), rol)

CREATE TABLE members (
    member_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    channel_id INT UNSIGNED NOT NULL,
    rol ENUM('admin', 'manager', 'poster', 'member') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (channel_id) REFERENCES channels(channel_id)
);

-- Tabla post_channel(post_id(PK), channel_id(PK))
CREATE TABLE post_channels (
    post_channel_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED NOT NULL,
    channel_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (channel_id) REFERENCES channels(channel_id)
);

-- Tabla recipe_ingredient(recipe_id(PK), ingredient_id(PK), measurement_id(pk), quantity)
CREATE TABLE recipe_ingredients (
    recipe_ingredient_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT UNSIGNED NOT NULL,
    ingredient_id INT UNSIGNED NOT NULL,
    measurement_id INT UNSIGNED NOT NULL,
    quantity DECIMAL NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id),
    FOREIGN KEY (measurement_id) REFERENCES measurements(measurement_id)
);

-- Tabla ingredient_category(ingredient_id(PK), category_id(PK))
CREATE TABLE ingredient_categories(
    ingredient_category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ingredient_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Tabla recipe_tag(recipe_id(pk), tag_id(pk))
CREATE TABLE recipe_tags(
    recipe_tag_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);

-- Tabla menu_recipe(menu_id(pk), recipe_id(pk), day, meal)
CREATE TABLE menu_recipes(
    menu_recipe_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    menu_id INT UNSIGNED NOT NULL,
    recipe_id INT UNSIGNED NOT NULL,
    day INT UNSIGNED NOT NULL,
    meal INT UNSIGNED NOT NULL,
    FOREIGN KEY (menu_id) REFERENCES menus(menu_id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
);

-- Tabla steps (step_id(PK), title, description, time, image_id(FK), method_id(FK))
CREATE TABLE steps (
    step_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    time TIME NOT NULL,
    image_id INT UNSIGNED,
    method_id INT UNSIGNED,
    FOREIGN KEY (image_id) REFERENCES images(image_id),
    FOREIGN KEY (method_id) REFERENCES methods(method_id)
);

-- Tabla recipe_steps (recipe_steps_id(PK), recipe_id(FK), step_id(FK))
CREATE TABLE recipe_steps (
    recipe_steps_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT UNSIGNED NOT NULL,
    step_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (step_id) REFERENCES steps(step_id)
);

-- Tabla post_images (post_image_id(PK), post_id(FK), image_id(FK))
CREATE TABLE post_images (
    post_image_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED NOT NULL,
    image_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (image_id) REFERENCES images(image_id)
);

-- Tabla user_images (user_image_id(PK), user_id(FK), image_id(FK))
CREATE TABLE user_images (
    user_image_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    image_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (image_id) REFERENCES images(image_id)
);

-- Tabla step_images (step_image_id(PK), step_id(FK), image_id(FK))
CREATE TABLE step_images (
    step_image_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    step_id INT UNSIGNED NOT NULL,
    image_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (step_id) REFERENCES steps(step_id),
    FOREIGN KEY (image_id) REFERENCES images(image_id)
);


-- Creación del usuario mycook_backend
CREATE USER 'mycook_backend'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('MyC00k1324');

-- Darle permisos en mycook
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON `mycook`.* TO 'mycook_backend'@'localhost';