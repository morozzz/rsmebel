delete from cake_image_types where id = 9;
insert into cake_image_types(id, image_type_name, image_template_id, prefix, real_prefix)
values(9, 'Партнеры', null, 'partners/', 'real/partners/');

drop table if exists cake_partners;
create table cake_partners (
  id integer not null primary key auto_increment,
  enabled integer,
  name varchar(500),
  text text,
  image_id integer,
  sort_order integer
);

INSERT INTO `cake_partners` (`id`, `enabled`, `name`, `text`, `image_id`, `sort_order`) VALUES
(1, 1, 'ГРАНД МЕБЕЛЬ', '<div>	<div>		Мебельная фабрика &quot;Гранд Мебель&quot; является одним из крупнейших производителей мягкой и корпусной мебели.</div>	<div>		В компании ведется четкий контроль за качеством производимой продукции.</div></div>', 5884, 1),
(2, 1, 'КРАСНОЯРСКАЯ МЕБЕЛЬНАЯ КОМПАНИЯ', '<div>	Красноярская Мебельная Компания-один из ведущих производителей корпусной и мягкой мебели в Красноярском крае отмечает свой восьмой день рождения.Производство оснащено современным технологичным оборудованием, позволяющим реализовать все передовые мебельные проекты.</div>', 5885, 2);


INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(5885, 'partners/image-5885.jpg', 9, 'real/partners/image-5885.jpg'),
(5884, 'partners/image-5884.jpg', 9, 'real/partners/image-5884.jpg');