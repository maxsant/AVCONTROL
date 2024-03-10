CREATE DATABASE AVCONTROL;
USE AVCONTROL;

/* 
Creacion entidades DB
*/

-- AVCONTROL.roles definition
CREATE TABLE roles
(
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`description` VARCHAR(200),
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.identifications definition
CREATE TABLE identifications
(
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`description` VARCHAR(200),
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.users definition
CREATE TABLE users (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
	`identification` VARCHAR(20) NOT NULL,
    `phone` VARCHAR(15),
    `email` VARCHAR(255) NOT NULL,
	`password_hash` VARCHAR(255) NOT NULL,
	`role_id` INT(11) NOT NULL,
	`identification_type_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`identification_type_id`) REFERENCES identifications (`id`),
	FOREIGN KEY (`role_id`) REFERENCES roles (`id`),
	INDEX `idx_identification_type_id` (`identification_type_id`) USING BTREE,
	INDEX `idx_role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.suppliers definition
CREATE TABLE suppliers (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `contact` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255),
    `phone` VARCHAR(15),
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.egg_production_records definition
CREATE TABLE egg_production_records (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `production_date` DATE NOT NULL,
    `production_quantity` INT(11) NOT NULL,
    `egg_status` VARCHAR(50) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.chickens definition
CREATE TABLE chickens (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `breed` VARCHAR(255) NOT NULL,
    `birthdate` DATE NOT NULL,
    `condition` VARCHAR(250) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.foods defitinion
CREATE TABLE foods (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `stock` INT(11) NOT NULL,
    `required_quantity` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.farms definition
CREATE TABLE farms (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `size` INT(11),
	`chicken_id` INT(11),
	`food_id` INT(11),
    `egg_production_record_id` INT(11),
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`egg_production_record_id`) REFERENCES egg_production_records (`id`),
	FOREIGN KEY (`chicken_id`) REFERENCES chickens (`id`),
	FOREIGN KEY (`food_id`) REFERENCES foods (`id`),
	INDEX `idx_egg_production_record_id` (`egg_production_record_id`) USING BTREE,
	INDEX `idx_chicken_id` (`chicken_id`) USING BTREE,
	INDEX `idx_food_id` (`food_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.purchases definition
CREATE TABLE purchases (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `invoice_number` VARCHAR(100) NOT NULL,
    `purchase_date` DATE NOT NULL,
    `purchase_total` DECIMAL(10, 2) NOT NULL,
    `supplier_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
    FOREIGN KEY (`supplier_id`) REFERENCES suppliers (`id`),
	INDEX `idx_supplier_id` (`supplier_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.purchase_details definition
CREATE TABLE purchase_details (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `stock` INT(11) NOT NULL,
    `unit_price` DECIMAL(10, 2),
    `subtotal` DECIMAL(10, 2) NOT NULL,
    `purchase_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`purchase_id`) REFERENCES purchases (`id`),
	INDEX `idx_purchase_id` (`purchase_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.product_types definition
CREATE TABLE product_types (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.products definition
CREATE TABLE products (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `product_type_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`product_type_id`) REFERENCES product_types (`id`),
	INDEX `idx_product_type_id` (`product_type_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE purchase_products
(
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT(11) NOT NULL,
	`purchase_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`product_id`) REFERENCES products (`id`),
	FOREIGN KEY (`purchase_id`) REFERENCES purchases (`id`),
	INDEX `idx_product_id` (`product_id`) USING BTREE,
	INDEX `idx_purchase_id` (`purchase_id`) USING BTREE
);

-- AVCONTROL.product_farms definition
CREATE TABLE product_farms (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT(11) NOT NULL,
    `farm_id` INT(11) NOT NULL,
	FOREIGN KEY (`farm_id`) REFERENCES farms (`id`),
	FOREIGN KEY (`product_id`) REFERENCES products (`id`),
	INDEX `idx_farm_id` (`farm_id`) USING BTREE,
	INDEX `idx_product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.sales definition
CREATE TABLE sales (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `invoice_number` VARCHAR(50) NOT NULL,
    `date_sale` DATE NOT NULL,
	`sale_total` DECIMAL(10, 2) NOT NULL,
    `user_id` INT(11) NOT NULL,
	`product_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`user_id`) REFERENCES users (`id`),
	FOREIGN KEY (`product_id`) REFERENCES products (`id`),
	INDEX `idx_user_id` (`user_id`) USING BTREE,
	INDEX `idx_product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- Tabla DetalleVenta
CREATE TABLE sale_details (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `sale_quantity` INT(11) NOT NULL,
    `unit_price` DECIMAL(10, 2) NOT NULL,
    `subtotal` DECIMAL(10, 2) NOT NULL,
    `sale_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	FOREIGN KEY (`sale_id`) REFERENCES sales (`id`),
	INDEX `idx_sale_id` (`sale_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;
