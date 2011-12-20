alter table cake_products add eng_name varchar(500);
alter table cake_products add opt_price float;

DELETE FROM cake_images WHERE id IN (
SELECT small_image_id FROM cake_catalogs UNION ALL
SELECT big_image_id   FROM cake_catalogs UNION ALL
SELECT small_image_id FROM cake_products UNION ALL
SELECT big_image_id   FROM cake_products UNION ALL
SELECT small_image_id FROM cake_product_dets UNION ALL
SELECT big_image_id   FROM cake_product_dets);

INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(5880, 'catalog/image-5880.jpg', 7, 'real/catalog/image-5880.jpg'),
(5881, 'catalog/image-5881.jpg', 7, 'real/catalog/image-5881.jpg'),
(5879, 'catalog/image-5879.jpg', 7, 'real/catalog/image-5879.jpg'),
(5877, 'catalog/image-5877.jpg', 7, 'real/catalog/image-5877.jpg'),
(5878, 'catalog/image-5878.jpg', 7, 'real/catalog/image-5878.jpg'),
(5876, 'catalog/image-5876.jpg', 7, 'real/catalog/image-5876.jpg'),
(5874, 'catalog/image-5874.jpg', 7, 'real/catalog/image-5874.jpg'),
(5875, 'catalog/image-5875.jpg', 7, 'real/catalog/image-5875.jpg'),
(5873, 'catalog/image-5873.jpg', 7, 'real/catalog/image-5873.jpg'),
(5871, 'catalog/image-5871.jpg', 7, 'real/catalog/image-5871.jpg'),
(5872, 'catalog/image-5872.jpg', 7, 'real/catalog/image-5872.jpg'),
(5870, 'catalog/image-5870.jpg', 7, 'real/catalog/image-5870.jpg');

DELETE FROM cake_catalogs;
INSERT INTO `cake_catalogs` (`id`, `name`, `small_image_id`, `sort_order`, `parent_id`, `lft`, `rght`, `big_image_id`, `catalog_type_id`, `code_1c`, `short_about`, `long_about`, `producer_id`, `name_1c`, `eng_name`, `created`, `updated`) VALUES
(100000007, 'Служебный - каталоги', NULL, 1, NULL, 1, 2, NULL, 2, NULL, '', '', NULL, NULL, 'Slujebnyiy - katalogi', '0000-00-00 00:00:00', '2011-12-18 17:17:19'),
(100000087, 'Служебный - товары', NULL, 2, NULL, 3, 4, NULL, 3, NULL, '', NULL, NULL, NULL, 'Slujebnyiy - tovaryi', '0000-00-00 00:00:00', '2011-12-18 17:17:19'),
(100000088, 'Корзина - каталоги', NULL, 3, NULL, 5, 6, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'Korzina - katalogi', '0000-00-00 00:00:00', '2011-12-18 17:17:19'),
(100000089, 'Корзина - товары', NULL, 4, NULL, 7, 8, NULL, 5, NULL, NULL, NULL, NULL, NULL, 'Korzina - tovaryi', '0000-00-00 00:00:00', '2011-12-18 17:17:19'),
(100000244, 'Красноярская мебельная компания', NULL, 7, NULL, 13, 18, NULL, 1, 'S_100000244', NULL, NULL, NULL, NULL, 'kras_mebel_company', '2011-12-18 17:17:42', '2011-12-18 19:53:44'),
(100000245, 'Корпусная мебель', NULL, 8, 100000244, 14, 15, NULL, 1, 'S_100000245', NULL, NULL, NULL, NULL, 'korpusnaya_mebel', '2011-12-18 17:25:11', '2011-12-18 17:25:23'),
(100000246, 'Мягкая мебель', NULL, 9, 100000244, 16, 17, NULL, 1, 'S_100000246', NULL, NULL, NULL, NULL, 'myagkaya_mebel', '2011-12-18 17:25:50', '2011-12-18 17:25:50'),
(100000247, 'Рамокс', NULL, 10, NULL, 19, 20, NULL, 1, 'S_100000247', NULL, NULL, NULL, NULL, 'ramoks', '2011-12-18 17:26:17', '2011-12-18 19:53:44'),
(100000248, 'Лузина', NULL, 11, NULL, 21, 22, NULL, 1, 'S_100000248', NULL, NULL, NULL, NULL, 'lyzina', '2011-12-18 17:26:34', '2011-12-18 17:26:34'),
(100000249, 'БИГ компания', NULL, 12, NULL, 23, 24, NULL, 1, 'S_100000249', NULL, NULL, NULL, NULL, 'big_companiya', '2011-12-18 17:27:02', '2011-12-18 17:27:02'),
(100000250, 'Олимп мебель', NULL, 13, NULL, 25, 26, NULL, 1, 'S_100000250', NULL, NULL, NULL, NULL, 'olimp_mebel', '2011-12-18 17:27:18', '2011-12-18 17:27:18'),
(100000251, 'Лора', NULL, 14, NULL, 27, 28, NULL, 1, 'S_100000251', NULL, NULL, NULL, NULL, 'lora', '2011-12-18 17:27:33', '2011-12-18 19:53:44'),
(100000252, 'Кристалл ТМ', NULL, 15, NULL, 29, 30, NULL, 1, 'S_100000252', NULL, NULL, NULL, NULL, 'kristall_tm', '2011-12-18 17:27:56', '2011-12-18 17:27:56'),
(100000253, 'Арсенал Плюс', NULL, 16, NULL, 31, 32, NULL, 1, 'S_100000253', NULL, NULL, NULL, NULL, 'arsenal_plus', '2011-12-18 17:28:38', '2011-12-18 19:53:44'),
(100000242, 'Арт-мебель', NULL, 5, NULL, 9, 10, NULL, 1, 'S_100000242', NULL, NULL, NULL, NULL, 'art_mebel', '2011-12-18 17:16:28', '2011-12-18 19:53:44'),
(100000243, 'Гранд-мебель', NULL, 6, NULL, 11, 12, NULL, 1, 'S_100000243', NULL, NULL, NULL, NULL, 'grand_mebel', '2011-12-18 17:16:47', '2011-12-18 19:53:44');

DELETE FROM cake_products;
DELETE FROM cake_product_dets;
INSERT INTO `cake_products` (`id`, `catalog_id`, `name`, `sort_order`, `price`, `cnt`, `small_image_id`, `big_image_id`, `article`, `code_1c`, `short_about`, `long_about`, `producer_id`, `name_1c`, `fix_price`, `fix_cnt`, `created`, `updated`, `eng_name`, `opt_price`) VALUES
(10662, 100000242, 'Соня - 7 угол', 2, 150, NULL, 5872, 5873, NULL, 'S_10662', NULL, NULL, NULL, NULL, 0, 0, '2011-12-18 18:51:52', '2011-12-18 18:51:52', 'sonya_7_ugol', 140),
(10663, 100000242, 'Соня - 9 угол', 3, 200, NULL, 5874, 5875, NULL, 'S_10663', '<div> 	Механизм трансформации: &quot;Венеция&quot;. Комплектация: угол + кресло.</div>', NULL, NULL, NULL, 0, 0, '2011-12-18 18:54:12', '2011-12-18 18:54:43', 'sonya_9_ugol', 190),
(10664, 100000243, 'Агат', 1, 10, NULL, 5876, 5877, NULL, 'S_10664', NULL, NULL, NULL, NULL, 0, 0, '2011-12-18 19:01:34', '2011-12-18 19:02:51', 'agat', 9),
(10665, 100000243, 'Агат угол', 2, 90, NULL, 5878, 5879, NULL, 'S_10665', NULL, NULL, NULL, NULL, 0, 0, '2011-12-18 19:02:01', '2011-12-18 19:02:51', 'agat_ygol', 80),
(10666, 100000243, 'Герда', 3, 550, NULL, 5880, 5881, NULL, 'S_10666', NULL, NULL, NULL, NULL, 0, 0, '2011-12-18 19:02:19', '2011-12-18 19:02:51', 'gerda', 520),
(10661, 100000242, 'Пион-1 мини-диван', 1, 100, NULL, 5870, 5871, NULL, 'S_10661', NULL, NULL, NULL, NULL, 0, 0, '2011-12-18 18:16:22', '2011-12-18 20:06:28', 'pion_1_mini_divan', 90);