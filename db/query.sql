CREATE TABLE product_general_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_title VARCHAR(255),
    product_description TEXT,
    main_image VARCHAR(255),
    price VARCHAR(50),
    quantity INT,
    general_detail_id INT,
    FOREIGN KEY (general_detail_id) REFERENCES product_general_detail(id)
);

CREATE TABLE product_thumbnails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    thumbnail_image VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE product_configurations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    configuration VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE pc_parts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT
);

INSERT INTO product_general_detail (description) VALUES (
    'Step Into The World Of High-Performance Gaming With Our Meticulously Curated PCs. Select From The Best Gaming PCs Under $2000 Or Explore Our Range Under $1500, All Offering Exceptional Performance And Value. Experience Top-Tier Graphics And Processing Power With Our 3080 Prebuilt PCs, Delivering Impressive Performance For The Most Demanding Games. Regardless Of Your Budget, Our Under $2000 And $1500 Gaming PCs Ensure A Seamless And Immersive Gaming Experience Without Breaking The Bank.'
);

INSERT INTO products (product_title, product_description, main_image, price, quantity, general_detail_id) VALUES
('Silicon Slayer', 'Silicon Slayer Gaming PC', 'img/products/prod1/img1.png', '€1,099.99', 1, 1),
('Hypernova Hero', 'Hypernova Gaming PC', 'img/products/prod2/img1.png', '€1,199.99', 1, 1),
('Alpine Avenger', 'Alpine Avenger Gaming PC', 'img/products/prod3/img1.png', '€1,299.99', 1, 1),
('Arctic', 'Arctic Assassin Gaming PC', 'img/products/prod4/img1.png', '€1,599.99', 1, 1),
('Arctic Avenger', 'Arctic Avenger Gaming PC', 'img/products/prod5/img1.png', '€1,699.99', 1, 1),
('Blizzard Beast', 'Blizzard Gaming PC', 'img/products/prod6/img2.png', '€1,799.99', 1, 1),
('Cloud Crusher', 'Cloud Crusher Gaming PC', 'img/products/prod7/img1.png', '€1,999.99', 1, 1),
('Data', 'Data Dominator', 'img/products/prod8/img1.png', '€2,099.99', 1, 1);

INSERT INTO product_thumbnails (product_id, thumbnail_image) VALUES
(1, 'img/products/prod1/img1.png'),
(1, 'img/products/prod1/img2.png'),
(1, 'img/products/prod1/img3.png'),
(1, 'img/products/prod1/img4.png'),

(2, 'img/products/prod2/img1.png'),
(2, 'img/products/prod2/img2.png'),
(2, 'img/products/prod2/img3.png'),
(2, 'img/products/prod2/img4.png'),

(3, 'img/products/prod3/img1.png'),
(3, 'img/products/prod3/img2.png'),
(3, 'img/products/prod3/img3.png'),
(3, 'img/products/prod3/img4.png'),

(4, 'img/products/prod4/img1.png'),
(4, 'img/products/prod4/img2.png'),
(4, 'img/products/prod4/img3.png'),
(4, 'img/products/prod4/img4.png'),

(5, 'img/products/prod5/img1.png'),
(5, 'img/products/prod5/img2.png'),
(5, 'img/products/prod5/img3.png'),
(5, 'img/products/prod5/img4.png'),

(6, 'img/products/prod6/img1.png'),
(6, 'img/products/prod6/img2.png'),
(6, 'img/products/prod6/img3.png'),
(6, 'img/products/prod6/img4.png'),

(7, 'img/products/prod7/img1.png'),
(7, 'img/products/prod7/img2.png'),
(7, 'img/products/prod7/img3.png'),
(7, 'img/products/prod7/img4.png'),

(8, 'img/products/prod8/img1.png'),
(8, 'img/products/prod8/img2.png'),
(8, 'img/products/prod8/img3.png'),
(8, 'img/products/prod8/img4.png');

INSERT INTO pc_parts (image_path, name, price, description) VALUES
('img/parts/case.png', 'CoolerMaster Mastercase H500M Gaming Midi Tower PC Case', 239.99, ''),
('img/parts/motherboard.png', 'Gigabyte Z690 Gaming X DDR4 (rev. 1.0) Motherboard ATX', 229.99, ''),
('img/parts/cpu.png', 'AMD Ryzen 9 7900X3D 4.4GHz', 417.99, ''),
('img/parts/gpu.png', 'Asus GeForce RTX 4090 24GB GDDR6X', 2155.99, ''),
('img/parts/ram.png', 'G.Skill Trident Z RGB 16GB DDR4 RAM', 319.99, ''),
('img/parts/ssd.png', 'Corsair Force Series Gen.4 SSD 500GB M.2 NVMe PCI Express 4.0', 99.99, ''),
('img/parts/power-supply.png', 'CoolerMaster V850 SFX Gold 850W PC Power Supply', 239.99, '');