-- Suppression des anciennes tables
DROP TABLE IF EXISTS accounts_customer_groups;
DROP TABLE IF EXISTS accounts_customer_user_permissions;
DROP TABLE IF EXISTS auth_group_permissions;
DROP TABLE IF EXISTS blog_post_event_artworks;
DROP TABLE IF EXISTS store_cart_orders;
DROP TABLE IF EXISTS store_checkout_orders;
DROP TABLE IF EXISTS store_payment;
DROP TABLE IF EXISTS django_admin_log;
DROP TABLE IF EXISTS store_order;
DROP TABLE IF EXISTS store_cart;
DROP TABLE IF EXISTS store_checkout;
DROP TABLE IF EXISTS store_artwork;
DROP TABLE IF EXISTS blog_post;
DROP TABLE IF EXISTS auth_group;
DROP TABLE IF EXISTS auth_permission;
DROP TABLE IF EXISTS store_medium;
DROP TABLE IF EXISTS store_category;
DROP TABLE IF EXISTS accounts_customer;
DROP TABLE IF EXISTS django_content_type;
DROP TABLE IF EXISTS django_migrations;
DROP TABLE IF EXISTS django_session;

CREATE TABLE IF NOT EXISTS `phpauth_config` (
    `setting` varchar(100) NOT NULL,
    `value` text NOT NULL,
    PRIMARY KEY (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_users` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
    `dt` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_sessions` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `uid` int(11) unsigned NOT NULL,
    `hash` varchar(40) NOT NULL,
    `expiredate` datetime NOT NULL,
    `ip` varchar(45) DEFAULT NULL,
    `agent` varchar(255) DEFAULT NULL,
    `cookie_crc` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `hash` (`hash`),
    KEY `uid` (`uid`),
    CONSTRAINT `phpauth_sessions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `phpauth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_attempts` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ip` varchar(45) NOT NULL,
    `expiredate` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_requests` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `uid` int(11) unsigned NOT NULL,
    `rkey` varchar(20) NOT NULL,
    `expire` datetime NOT NULL,
    `type` varchar(20) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `rkey` (`rkey`),
    KEY `uid` (`uid`),
    CONSTRAINT `phpauth_requests_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `phpauth_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_emails_banned` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `domain` varchar(100) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `phpauth_ip_banned` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ip` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Tables de base sans dépendances
CREATE TABLE django_content_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_label VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL
);

CREATE TABLE auth_permission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_type_id INT NOT NULL,
    codename VARCHAR(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (content_type_id) REFERENCES django_content_type(id)
);

CREATE TABLE auth_group (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE store_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE store_medium (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE accounts_customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(128) NOT NULL,
    last_login DATETIME NULL,
    is_superuser BOOLEAN NOT NULL,
    username VARCHAR(150) NOT NULL UNIQUE,
    first_name VARCHAR(150) NOT NULL,
    last_name VARCHAR(150) NOT NULL,
    email VARCHAR(254) NOT NULL,
    is_staff BOOLEAN NOT NULL,
    is_active BOOLEAN NOT NULL,
    date_joined DATETIME NOT NULL
);

-- Tables avec dépendances
CREATE TABLE auth_group_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    permission_id INT NOT NULL,
    FOREIGN KEY (group_id) REFERENCES auth_group(id),
    FOREIGN KEY (permission_id) REFERENCES auth_permission(id)
);

CREATE TABLE accounts_customer_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    group_id INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES accounts_customer(id),
    FOREIGN KEY (group_id) REFERENCES auth_group(id)
);

CREATE TABLE accounts_customer_user_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    permission_id INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES accounts_customer(id),
    FOREIGN KEY (permission_id) REFERENCES auth_permission(id)
);

CREATE TABLE store_artwork (
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
    FOREIGN KEY (category_id) REFERENCES store_category(id),
    FOREIGN KEY (medium_id) REFERENCES store_medium(id)
);

CREATE TABLE blog_post (
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

CREATE TABLE store_cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME NOT NULL,
    customer_id INT NOT NULL UNIQUE,
    FOREIGN KEY (customer_id) REFERENCES accounts_customer(id)
);

CREATE TABLE store_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(30) NOT NULL UNIQUE,
    quantity INT NOT NULL,
    ordered BOOLEAN NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    ordered_at DATETIME NULL,
    artwork_id INT NOT NULL,
    customer_id INT NOT NULL,
    FOREIGN KEY (artwork_id) REFERENCES store_artwork(id),
    FOREIGN KEY (customer_id) REFERENCES accounts_customer(id)
);

CREATE TABLE store_cart_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    order_id INT NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES store_cart(id),
    FOREIGN KEY (order_id) REFERENCES store_order(id)
);

CREATE TABLE store_checkout (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(30) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL,
    customer_id INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES accounts_customer(id)
);

CREATE TABLE store_checkout_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checkout_id INT NOT NULL,
    order_id INT NOT NULL,
    FOREIGN KEY (checkout_id) REFERENCES store_checkout(id),
    FOREIGN KEY (order_id) REFERENCES store_order(id)
);

CREATE TABLE blog_post_event_artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    artwork_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES blog_post(id),
    FOREIGN KEY (artwork_id) REFERENCES store_artwork(id)
);

CREATE TABLE store_payment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency VARCHAR(10) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    status VARCHAR(15) NOT NULL,
    checkout_id INT NOT NULL,
    FOREIGN KEY (checkout_id) REFERENCES store_checkout(id)
);

CREATE TABLE django_admin_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    object_id TEXT NULL,
    object_repr VARCHAR(200) NOT NULL,
    action_flag SMALLINT UNSIGNED NOT NULL CHECK (action_flag >= 0),
    change_message TEXT NOT NULL,
    content_type_id INT NULL,
    user_id INT NOT NULL,
    action_time DATETIME NOT NULL,
    FOREIGN KEY (content_type_id) REFERENCES django_content_type(id),
    FOREIGN KEY (user_id) REFERENCES accounts_customer(id)
);

CREATE TABLE django_migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    applied DATETIME NOT NULL
);

CREATE TABLE django_session (
    session_key VARCHAR(40) NOT NULL PRIMARY KEY,
    session_data TEXT NOT NULL,
    expire_date DATETIME NOT NULL
);

CREATE TABLE sqlite_sequence (
    name VARCHAR(128) NOT NULL,
    seq INT NOT NULL
);
