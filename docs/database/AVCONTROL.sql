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
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.menus definition
CREATE TABLE menus
(
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `route` VARCHAR(200),
    `identification` VARCHAR(200),
    `group` VARCHAR(150),
    `created` DATETIME NOT NULL,
    `modified` TIMESTAMP NOT NULL,
    `is_active` TINYINT(11) DEFAULT 1,
    `custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.menu_roles definition
CREATE TABLE menu_roles
(
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `menu_id` INT(11) NOT NULL,
    `role_id` INT(11) NOT NULL,
    `permission` VARCHAR(2) NOT NULL,
    `created` DATETIME NOT NULL,
    `modified` TIMESTAMP NOT NULL,
    `is_active` TINYINT(11) DEFAULT 1,
    `custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
    FOREIGN KEY (menu_id) REFERENCES menus (id),
    FOREIGN KEY (role_id) REFERENCES roles (id),
    INDEX idx_menu_id (menu_id) USING BTREE,
    INDEX idx_role_id (role_id) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.identifications definition
CREATE TABLE identifications
(
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`description` VARCHAR(200),
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.users definition
CREATE TABLE users (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
	`identification` VARCHAR(20) UNIQUE NOT NULL,
    `phone` VARCHAR(15) UNIQUE,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `validate` INT(11) DEFAULT 0 NOT NULL,
    `register_google` INT(11) DEFAULT 0 NOT NULL,
    `email_token` VARCHAR(255) UNIQUE,
	`password_hash` VARCHAR(255) NOT NULL,
    `api_key` VARCHAR(255) UNIQUE,
	`profile_image` VARCHAR(500) DEFAULT NULL,
	`role_id` INT(11) NOT NULL,
	`identification_type_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`identification_type_id`) REFERENCES identifications (`id`),
	FOREIGN KEY (`role_id`) REFERENCES roles (`id`),
	INDEX `idx_identification_type_id` (`identification_type_id`) USING BTREE,
	INDEX `idx_role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.suppliers definition
CREATE TABLE suppliers (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `RUC` VARCHAR(50) NOT NULL,
    `address` VARCHAR(150) NOT NULL,
    `email` VARCHAR(255) UNIQUE,
    `phone` VARCHAR(15) UNIQUE,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- compra_ventadb.payments definition
CREATE TABLE payments
(
	`id` INT(11) AUTO_INCREMENT,
	`name` VARCHAR(200) DEFAULT NULL,
	`created` DATETIME NOT NULL,
    `modified` TIMESTAMP NOT NULL,
    `is_active` TINYINT(2) NOT NULL DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- compra_ventadb.delivery_types definition
CREATE TABLE delivery_types
(
	`id` INT(11) AUTO_INCREMENT,
	`name` VARCHAR(200) DEFAULT NULL,
	`created` DATETIME NOT NULL,
    `modified` TIMESTAMP NOT NULL,
    `is_active` TINYINT(2) NOT NULL DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.deliveries defitinion
CREATE TABLE deliveries (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `delivery_type_id` INT(11) NOT NULL,
    `stock` INT(11) NOT NULL,
    `price` DECIMAL(18, 2) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`delivery_type_id`) REFERENCES delivery_types (`id`),
	INDEX `idx_delivery_type_id` (`delivery_type_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.productions definition
CREATE TABLE productions (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(150) NOT NULL,
	`stock` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.farms definition
CREATE TABLE farms (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `size` INT(11),
	`eggs_a` INT(11),
	`eggs_b` INT(11),
	`eggs_c` INT(11),
	`chicken_meet` INT(11),
	`third_party_products` INT(11),
	`chiecken_farm_capacity` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.farm_productions definition
CREATE TABLE farm_productions (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`stock` INT(11) DEFAULT NULL,
	`price` DECIMAL(50, 2) DEFAULT NULL,
    `chicken_birthdate` DATE NOT NULL,
    `chicken_condition` VARCHAR(250) NOT NULL,
	`chicken_weihg` DECIMAL(20, 2) NOT NULL,
	`chicken_egg_production_date` DATE NOT NULL,
    `chicken_egg_production_quantity` INT(11) NOT NULL,
    `chicken_egg_status` VARCHAR(50) NOT NULL,
	`third_party_product_name` VARCHAR(100) NOT NULL,
	`status_product` INT(11) NOT NULL,
	`production_id` INT(11) DEFAULT NULL,
	`farm_id` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`production_id`) REFERENCES productions (`id`),
	FOREIGN KEY (`farm_id`) REFERENCES farms (`id`),
	INDEX `idx_production_id` (`production_id`) USING BTREE,
	INDEX `idx_farm_id` (`farm_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.farm_deliveries definition
CREATE TABLE farm_deliveries (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `farm_name` VARCHAR(50) DEFAULT NULL,
    `farm_location` VARCHAR(150) DEFAULT NULL,
    `subtotal` DECIMAL(50, 2) DEFAULT 0,
    `iva` DECIMAL(50, 2) DEFAULT 0,
    `total` DECIMAL(50, 2) DEFAULT 0,
    `comment` VARCHAR(255) DEFAULT NULL,
    `farm_id` INT(11) DEFAULT NULL,
	`payment_id` INT(11) DEFAULT NULL,
	`status_farm_delivery` INT(11) DEFAULT 2,
	`status_payment` INT(11) DEFAULT NULL,
	`user_id` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
    FOREIGN KEY (`farm_id`) REFERENCES farms (`id`),
	FOREIGN KEY (`payment_id`) REFERENCES payments (`id`),
	FOREIGN KEY (`user_id`) REFERENCES users (`id`),
	INDEX `idx_farm_id` (`farm_id`) USING BTREE,
	INDEX `idx_payment_id` (`payment_id`) USING BTREE,
	INDEX `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.farm_delivery_details definition
CREATE TABLE farm_delivery_details (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `stock` INT(11) NOT NULL,
    `price` DECIMAL(50, 2),
    `total` DECIMAL(50, 2) NOT NULL,
    `farm_delivery_id` INT(11) NOT NULL,
    `delivery_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`farm_delivery_id`) REFERENCES farm_deliveries (`id`),
	FOREIGN KEY (`delivery_id`) REFERENCES deliveries (`id`),
	INDEX `idx_farm_delivery_id` (`farm_delivery_id`) USING BTREE,
	INDEX `idx_delivery_id` (`delivery_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.purchases definition
CREATE TABLE purchases (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `supplier_ruc` VARCHAR(50) DEFAULT NULL,
    `supplier_address` VARCHAR(150) DEFAULT NULL,
    `supplier_email` VARCHAR(255) DEFAULT NULL,
	`supplier_phone` VARCHAR(15) DEFAULT NULL,
    `subtotal` DECIMAL(50, 2) DEFAULT 0,
    `iva` DECIMAL(50, 2) DEFAULT 0,
    `total` DECIMAL(50, 2) DEFAULT 0,
    `comment` VARCHAR(255) DEFAULT NULL,
    `supplier_id` INT(11) DEFAULT NULL,
	`payment_id` INT(11) DEFAULT NULL,
	`status_purchase` INT(11) DEFAULT 2,
	`status_payment` INT(11) DEFAULT NULL,
	`user_id` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
    FOREIGN KEY (`supplier_id`) REFERENCES suppliers (`id`),
	FOREIGN KEY (`payment_id`) REFERENCES payments (`id`),
	FOREIGN KEY (`user_id`) REFERENCES users (`id`),
	INDEX `idx_supplier_id` (`supplier_id`) USING BTREE,
	INDEX `idx_payment_id` (`payment_id`) USING BTREE,
	INDEX `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.purchase_details definition
CREATE TABLE purchase_details (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `stock` INT(11) NOT NULL,
    `price` DECIMAL(50, 2),
    `total` DECIMAL(50, 2) NOT NULL,
    `purchase_id` INT(11) NOT NULL,
    `delivery_id` INT(11) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`purchase_id`) REFERENCES purchases (`id`),
	FOREIGN KEY (`delivery_id`) REFERENCES deliveries (`id`),
	INDEX `idx_purchase_id` (`purchase_id`) USING BTREE,
	INDEX `idx_delivery_id` (`delivery_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.products definition
CREATE TABLE products (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255),
	`expiration_date` DATE DEFAULT NULL,
    `stock` INT(11) NOT NULL,
	`image` VARCHAR(500) DEFAULT NULL,
	`price` DECIMAL(10, 2) NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`))
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

-- AVCONTROL.product_farms definition
CREATE TABLE product_farms (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT(11) NOT NULL,
    `farm_id` INT(11) NOT NULL,
    `created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
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
	`payment_id` INT(11) DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL,
	`is_active` TINYINT(11) DEFAULT 1,
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`user_id`) REFERENCES users (`id`),
	FOREIGN KEY (`product_id`) REFERENCES products (`id`),
	FOREIGN KEY (`payment_id`) REFERENCES payments (`id`),
	INDEX `idx_user_id` (`user_id`) USING BTREE,
	INDEX `idx_product_id` (`product_id`) USING BTREE,
	INDEX `idx_payment_id` (`payment_id`)
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
	`custom_fields` LONGTEXT CHECK (json_valid(`custom_fields`)),
	FOREIGN KEY (`sale_id`) REFERENCES sales (`id`),
	INDEX `idx_sale_id` (`sale_id`) USING BTREE
) ENGINE=InnoDB DEFAULT charset=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO
	roles (name, description, created)
VALUES
	('Administrador', 'Administrador del sistema', '2024-06-02'),
    ('Cliente', 'Cliente de una granja', '2024-06-02');
	
INSERT INTO
	identifications (name, description, created)
VALUES
    ('Cedula de Ciudadania', 'Documento nacional', '2024-06-02'),
    ('Tarjeta de Identidad', 'Documento nacional para jóvenes', '2024-06-02'),
    ('Cedula de Extranjeria', 'Documento para los extranjeros', '2024-06-02');
	
INSERT INTO
	payments (name, created)
VALUES
    ('Efectivo', '2024-06-02'),
    ('Tarjeta de Credito', '2024-06-02'),
    ('Trasnferencia', '2024-06-02');
	
INSERT INTO
	delivery_types (name, created)
VALUES
    ('Alimento', '2024-06-02'),
    ('Medicina', '2024-06-02');

INSERT INTO
	users (name, lastname, identification, phone, email, validate, email_token, password_hash, api_key, role_id, identification_type_id, created)
VALUES
	('Admin', 'Prueba', '12345678910', '3256781821', 'adminp@gmail.com', 1, 'iazicxtyjqswcdjpxetqplardvaswenxxewgqmwdveebwjuaphjlksugicskutzu', '$2y$10$0kFnZhqxkDdLl93Jb60cfuusVJ8X8w5H7cSV2eohrn55HsVFt1KTm', 'X3nNRvHfZcpKrmVogkNNAQAbc2rs2ekoT5dZyf1pPCulTKT4H4J1bmIMLSr9Hn7d', 1, 1, NOW());

INSERT INTO menus (name,route,identification,`group`,created,modified,is_active,custom_fields) VALUES
	 ('Dashboard','../home/','dashboard','Dashboard','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Usuarios','../users/','users','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Identificaciones','../identifications/','identifications','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Roles','../roles/','roles','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Producciones','../productions/','productions','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Suministros','../deliveries/','deliveries','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Granjas','../farms/','farms','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Productos','../products/','products','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Producto Granjas','../productFarms/','productFarms','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Proveedores','../suppliers/','suppliers','Mantenimiento','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Nueva Compra','../purchases/','purchases','Compra','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Lista Compras','../listPurchases/','listpurchases','Compra','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Descargue Inventario','../farmDeliveries/','farmdeliveries','Inventario','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 ('Lista de Descargues','../listFarmDeliveries/','listfarmdeliveries','Inventario','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL);

INSERT INTO menu_roles (menu_id,role_id,permission,created,modified,is_active,custom_fields) VALUES
	 (1,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (2,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (3,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (4,1,'Si','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (5,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (6,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (7,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (8,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (9,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (10,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (11,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (12,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (13,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL),
	 (14,1,'No','2024-04-16 00:00:00','2024-04-16 11:26:45',1,NULL);
