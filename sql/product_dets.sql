drop table if exists cake_product_dets;
create table cake_product_dets (
  id integer not null primary key auto_increment,
  product_id integer,
  name varchar(500),
  about text,
  code_1c integer,
  name_1c integer,
  price float,
  opt_price float,
  cnt integer,
  small_image_id integer,
  big_image_id integer,
  sort_order integer,
  created datetime,
  updated datetime
);