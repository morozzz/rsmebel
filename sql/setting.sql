CREATE TABLE cake_settings (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(1000),
  image_id INTEGER,
  value_str VARCHAR(1000),
  value_text TEXT
);
INSERT INTO cake_settings (id, name, image_id, value_str, value_text) VALUES
(1, 'Подвал', null, '', '');