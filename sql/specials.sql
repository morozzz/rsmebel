drop table cake_specials;
create table cake_specials (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  image_id INTEGER,
  product_id INTEGER,
  sort_order INTEGER,
  enabled INTEGER
);
INSERT INTO `cake_specials` (`id`, `image_id`, `product_id`, `sort_order`, `enabled`) VALUES
(2, 5882, 10666, 1, 1),
(3, 5883, 10662, 2, 1);

INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(5883, 'catalog/image-5883.jpg', 1, 'real/catalog/image-5883.jpg'),
(5882, 'catalog/image-5882.jpg', 1, 'real/catalog/image-5882.jpg');