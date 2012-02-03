CREATE TABLE cake_product_det_images (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  product_det_id INTEGER NOT NULL,
  name VARCHAR(500),
  small_image_id INTEGER,
  big_image_id INTEGER,
  sort_order INTEGER,
  created DATETIME,
  updated DATETIME
);