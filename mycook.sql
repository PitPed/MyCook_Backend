CREATE DATABASE IF NOT EXISTS mycook CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

USE mycook;

-- Tabla users
CREATE TABLE users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla ingredients
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

-- Tabla channels
CREATE TABLE channels (
    channel_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    is_public BOOLEAN NOT NULL,
    open_posting BOOLEAN NOT NULL
);

-- Tabla measurements
CREATE TABLE measurements (
    measurement_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('volume', 'weight')
);

-- Tabla methods
CREATE TABLE methods (
    method_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla categories
CREATE TABLE categories (
    category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tabla recipes
CREATE TABLE recipes (
    recipe_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    duration TIME NOT NULL,
    difficulty ENUM('facil', 'medio', 'dificil') NOT NULL,
    quantity INT UNSIGNED NOT NULL
);

-- Tabla posts
CREATE TABLE posts (
    post_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    recipe_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
);

-- Tabla comment
CREATE TABLE comment (
    comment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    body TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

-- Tabla images
CREATE TABLE images (
    image_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    alt VARCHAR(255) NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

-- Tabla members
CREATE TABLE members (
    member_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    channel_id INT UNSIGNED NOT NULL,
    rol ENUM('admin', 'manager', 'poster', 'member') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (channel_id) REFERENCES channels(channel_id)
);

-- Tabla post_channel
CREATE TABLE post_channels (
    post_channel_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED NOT NULL,
    channel_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (channel_id) REFERENCES channels(channel_id)
);

-- Tabla recipe_ingredient
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

CREATE TABLE ingredient_categories(
    ingredient_category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ingredient_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Creación del usuario mycook_backend
CREATE USER 'mycook_backend'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('MyC00k1324');

-- Darle permisos en mycook
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON `mycook`.* TO 'mycook_backend'@'localhost';