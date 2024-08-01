-- Suppression des anciennes tables
DROP TABLE IF EXISTS post_event_artworks;
DROP TABLE IF EXISTS cart_orders;
DROP TABLE IF EXISTS checkout_orders;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS carts;
DROP TABLE IF EXISTS checkouts;
DROP TABLE IF EXISTS artworks;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS mediums;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS customers;

-- Tables de base sans dépendances
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE mediums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(128) NOT NULL,
    last_login DATETIME NULL,
    is_superuser BOOLEAN NOT NULL,
    first_name VARCHAR(150) NOT NULL,
    last_name VARCHAR(150) NOT NULL,
    email VARCHAR(254) NOT NULL UNIQUE,
    is_staff BOOLEAN NOT NULL,
    is_active BOOLEAN NOT NULL,
    date_joined DATETIME NOT NULL
);


CREATE TABLE artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL UNIQUE,
    slug VARCHAR(200) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    width INT UNSIGNED NOT NULL CHECK (width >= 0),
    height INT UNSIGNED NOT NULL CHECK (height >= 0),
    thumbnail VARCHAR(100) NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    category_id INT NOT NULL,
    medium_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (medium_id) REFERENCES mediums(id)
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL UNIQUE,
    slug VARCHAR(250) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    event_date DATETIME NOT NULL,
    event_place VARCHAR(200) NOT NULL,
    thumbnail VARCHAR(100) NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME NOT NULL,
    customer_id INT NOT NULL UNIQUE,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(30) NOT NULL UNIQUE,
    quantity INT NOT NULL,
    ordered BOOLEAN NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    ordered_at DATETIME NULL,
    artwork_id INT NOT NULL,
    customer_id INT NOT NULL,
    FOREIGN KEY (artwork_id) REFERENCES artworks(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE cart_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    order_id INT NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE checkouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(30) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL,
    customer_id INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE checkout_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checkout_id INT NOT NULL,
    order_id INT NOT NULL,
    FOREIGN KEY (checkout_id) REFERENCES checkouts(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE post_event_artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    artwork_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (artwork_id) REFERENCES artworks(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency VARCHAR(10) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    status VARCHAR(15) NOT NULL,
    checkout_id INT NOT NULL,
    FOREIGN KEY (checkout_id) REFERENCES checkouts(id)
);
