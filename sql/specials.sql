drop table cake_specials;
create table cake_specials (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  product_id INTEGER,
  enabled INTEGER
);