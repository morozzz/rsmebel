DELETE FROM cake_pay_types;
INSERT INTO cake_pay_types(id, name, sort_order) VALUES(1, 'Наличный расчет', 1);
INSERT INTO cake_pay_types(id, name, sort_order) VALUES(2, 'Безналичный расчет', 2);

DROP TABLE IF EXISTS cake_transport_addresses;
DROP TABLE IF EXISTS cake_transport_datas;
DROP TABLE IF EXISTS cake_transport_type_abouts;
DROP TABLE IF EXISTS cake_transport_types;

CREATE TABLE cake_transport_types (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(500),
  price FLOAT,
  sort_order INTEGER
);
INSERT INTO cake_transport_types(id, name, price, sort_order)
VALUES(1, 'Самовывоз', 0, 1);
INSERT INTO cake_transport_types(id, name, price, sort_order)
VALUES(2, 'Доставка по Красноярску', 400, 2);

ALTER TABLE cake_custom_client_infos DROP profil_type_id;
ALTER TABLE cake_custom_client_infos DROP activity;
ALTER TABLE cake_custom_client_infos DROP on_news;
ALTER TABLE cake_custom_client_infos ADD pay_type_id INTEGER;
ALTER TABLE cake_custom_client_infos ADD transport_type_id INTEGER;

ALTER TABLE cake_customs MODIFY user_id INTEGER;
ALTER TABLE cake_custom_statuses MODIFY user_id INTEGER;