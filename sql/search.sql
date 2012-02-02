DROP VIEW IF EXISTS cake_searches;
CREATE VIEW cake_searches AS
SELECT c.id,
       c.name,
       'Найдено в каталоге' caption,
       null image_id,
       NULL about,
       'catalog' type,
       1 type_order,
       c.lft sort_order
  FROM cake_catalogs c
 WHERE c.catalog_type_id = 1
UNION ALL
SELECT p.id,
       p.name,
       'Найдено в товарах' caption,
       p.small_image_id image_id,
       p.about,
       'product' type,
       2 type_order,
       c.lft*1000 + p.sort_order sort_order
  FROM cake_products p, cake_catalogs c
 WHERE p.catalog_id = c.id
   AND c.catalog_type_id = 1;