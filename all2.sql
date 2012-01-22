-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 22 2012 г., 09:16
-- Версия сервера: 5.5.8
-- Версия PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rsmebel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cake_catalogs`
--

CREATE TABLE IF NOT EXISTS `cake_catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `small_image_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `big_image_id` int(11) DEFAULT NULL,
  `catalog_type_id` int(11) NOT NULL DEFAULT '1',
  `code_1c` varchar(100) DEFAULT NULL,
  `short_about` text,
  `long_about` text,
  `producer_id` int(11) DEFAULT NULL,
  `name_1c` varchar(300) DEFAULT NULL,
  `eng_name` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eng_name` (`eng_name`),
  KEY `catalog_ind_small_image` (`small_image_id`),
  KEY `catalog_ind_big_image` (`big_image_id`),
  KEY `catalog_ind_producer` (`producer_id`),
  KEY `catalog_ind_catalog_type` (`catalog_type_id`),
  KEY `catalog_ind_code_1c` (`code_1c`),
  KEY `catalog_ind_lft_rght` (`lft`,`rght`),
  KEY `catalog_ind_parent` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=100000254 ;

--
-- Дамп данных таблицы `cake_catalogs`
--

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

-- --------------------------------------------------------

--
-- Структура таблицы `cake_catalog_types`
--

CREATE TABLE IF NOT EXISTS `cake_catalog_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `cake_catalog_types`
--

INSERT INTO `cake_catalog_types` (`id`, `name`) VALUES
(1, 'Стандартный'),
(2, 'Служебный - каталоги'),
(3, 'Служебный - товары'),
(4, 'Корзина - каталоги'),
(5, 'Корзина - товары');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_client_infos`
--

CREATE TABLE IF NOT EXISTS `cake_client_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fio` varchar(100) DEFAULT NULL,
  `post_index` varchar(10) DEFAULT NULL,
  `post_region` varchar(100) DEFAULT NULL,
  `post_city` varchar(50) DEFAULT NULL,
  `post_street` varchar(50) DEFAULT NULL,
  `post_hnumber` varchar(20) DEFAULT NULL,
  `post_office` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `company_type_id` int(11) DEFAULT NULL,
  `reg_num` varchar(50) DEFAULT NULL,
  `profil_type_id` int(11) DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `phone_kod` varchar(10) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax_kod` varchar(10) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `jur_index` varchar(10) DEFAULT NULL,
  `jur_region` varchar(100) DEFAULT NULL,
  `jur_city` varchar(50) DEFAULT NULL,
  `jur_street` varchar(50) DEFAULT NULL,
  `jur_hnumber` varchar(20) DEFAULT NULL,
  `jur_office` varchar(20) DEFAULT NULL,
  `INN` varchar(50) DEFAULT NULL,
  `KPP` varchar(50) DEFAULT NULL,
  `operating_account` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `correspondent_account` varchar(50) DEFAULT NULL,
  `BIK` varchar(50) DEFAULT NULL,
  `OKPO` varchar(50) DEFAULT NULL,
  `OKVED` varchar(50) DEFAULT NULL,
  `on_news` int(1) DEFAULT '0',
  `filial_type_id` int(1) DEFAULT '0',
  `client_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_info_ind_user` (`user_id`),
  KEY `client_info_ind_company_type` (`company_type_id`),
  KEY `client_info_ind_profil_type` (`profil_type_id`),
  KEY `client_info_ind_filial_type` (`filial_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=473 ;

--
-- Дамп данных таблицы `cake_client_infos`
--

INSERT INTO `cake_client_infos` (`id`, `user_id`, `fio`, `post_index`, `post_region`, `post_city`, `post_street`, `post_hnumber`, `post_office`, `name`, `company_type_id`, `reg_num`, `profil_type_id`, `activity`, `phone_kod`, `phone`, `fax_kod`, `fax`, `jur_index`, `jur_region`, `jur_city`, `jur_street`, `jur_hnumber`, `jur_office`, `INN`, `KPP`, `operating_account`, `bank`, `correspondent_account`, `BIK`, `OKPO`, `OKVED`, `on_news`, `filial_type_id`, `client_type_id`) VALUES
(4, 4, '123', '3', '4', '5', '6', '7', '8', 'Рога и копытца', NULL, '', NULL, NULL, '1', '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 2),
(7, 7, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, NULL),
(46, 4, '', '', '', '', '', '', '', 'Доп филиал', 4, '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '345235345', '', '', 'апаапап', '', '', '', '', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_client_types`
--

CREATE TABLE IF NOT EXISTS `cake_client_types` (
  `id` int(1) NOT NULL,
  `client_type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cake_client_types`
--

INSERT INTO `cake_client_types` (`id`, `client_type_name`) VALUES
(1, 'Розничный'),
(2, 'Оптовый');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_cnews`
--

CREATE TABLE IF NOT EXISTS `cake_cnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eng_name` varchar(500) DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `text` text,
  `stamp` date DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_cnews`
--

INSERT INTO `cake_cnews` (`id`, `eng_name`, `enabled`, `caption`, `text`, `stamp`, `sort_order`, `created`, `updated`) VALUES
(1, 'rossiiskie_biatlonistki', 1, 'Российские биатлонистки завоевали бронзу в эстафете на этапе КМ', '<div>	<div>		<div>			<font size="3">Женская сборная России по биатлону выиграла бронзовые медали по итогам эстафетной гонки 4х6 км на втором этапе Кубка мира, который завершился в австрийском Хохфильцене.</font></div>		<div>			<span style="font-size: medium; ">Светлана Слепцова, Наталья Сорокина, Анна Богалий-Титовец и Ольга Зайцева финишировали третьими с шестью промахами, уступив лишь командам Франции (Мари Лор-Брюне, Анаи Бескон, Софи Буайе и Мари Дорен-Абер) и Норвегии (Фанни Велле-Странн Хорн, Элиса Ринген, Сюнневе Сулемдаль и Тура Бергер). Норвежки, показавшие с 10 промахами время 1 час 7 минут 13,3 секунды, взяли золото, француженки (3 промаха) проиграли им 13,6 секунды, а россиянки - 29,4 секунды.</span></div>		<div>			<span style="font-size: medium; ">Слепцова ошиблась трижды на первой стрельбе лежа, однако на &quot;стойке&quot; исправилась, закрыв все мишени с пяти попыток. Наталья Сорокина повторила стрелковый результат Слепцовой, однако передала эстафету Анне Богалий-Титовец занимая седьмое место и находясь более чем в 35 секундах позади вышедшей в лидеры украинки Виты Семеренко, которую сменила Инна Супрун.</span></div>		<div>			<span style="font-size: medium; ">Богалий-Титовец отстрелялась блестяще, но при передаче эстафеты отставала от Сулемдаль на 38,8 секунды. Зайцева также обошлась без промахов, но ликвидировать более чем полуминутное отставание от опытной Бергер не сумела.</span></div>		<div>			<span style="font-size: medium; ">Для сборной России это пятая медаль на австрийском этапе Кубка мира. Третий этап Кубка мира пройдет также в Хохфильцене и откроется 15 декабря мужской спринтерской гонкой.</span></div>	</div></div>', '2012-01-16', 2, '2011-12-22 16:18:44', '2011-12-22 16:34:07'),
(2, 'sibirskie_biologi', 1, 'Сибирские биологи изучают межпланетных микробов', '<div>	<div>		Ученые из красноярского Института биофизики СО РАН начинают большой научный эксперимент по изучению размножения и развития патогенных микроорганизмов в условиях Международной космической станции (МКС).</div>	<div>		В проекте участвуют несколько российских и зарубежных институтов. В одном из герметичных модулей под названием БИОС&ndash;3, созданных в Красноярске, сибирские учёные будут создавать среду, сходную по параметрам с МКС, а финские специалисты &ndash; моделировать распределение микроорганизмов с помощью искусственных аэрозолей. Данные измерения и контроля будут доступны всем участникам проекта в режиме онлайн.</div>	<div>		Компенсировать отсутствие невесомости, в которой микроорганизмы дольше парят в пространстве и медленнее оседают, исследователи собираются с помощью подбора скорости и направления воздушных потоков. Под контролем будет также температура и влажность воздуха, освещённость.</div>	<div>		На втором этапе учёные, на этот раз бельгийские, будут использовать непатогенные микроорганизмы, типичные для МКС, а подбором биологического материала займутся российские исследователи из Института медико-биологических проблем (ИМБП) РАН.</div>	<div>		За время работы настоящей МКС на орбите обнаружили 76 видов микроорганизмов. Среди них оказались условно-патогенные бактерии, грибы и микробы-технофилы, способные вызывать не то что заболевание космонавтов, но даже биокоррозию металлов и изоляции проводов, что грозит выводом из строя бортовой аппаратуры.</div>	<div>		Общая координация проекта возложена на французский Институт космической физиологии и медицины (MEDES).</div>	<div>		Наша справка:</div>	<div>		Экспериментальный комплекс БИОС&ndash;3 в Красноярске был создан в 1970-х годах для изучения возможных вариантов замкнутых систем жизнеобеспечения будущих космических кораблей и баз на других планетах. Экипажи из двух-трёх человек проводили в БИОС&ndash;3 до полугода, не получая снаружи ни воды, ни кислорода, лишь 20% пищи из запасов внутри модуля.</div></div>', '2011-12-08', 1, '2011-12-22 16:19:52', '2011-12-22 16:34:07');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_company_infos`
--

CREATE TABLE IF NOT EXISTS `cake_company_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` int(11) DEFAULT NULL,
  `eng_name` varchar(500) DEFAULT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `text` text,
  `sort_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_company_infos`
--

INSERT INTO `cake_company_infos` (`id`, `enabled`, `eng_name`, `caption`, `text`, `sort_order`, `created`, `updated`) VALUES
(1, 1, 'about', 'Компания', '<div>	Наша компания на рынке с 2006г. Мы занимаемся оптовой продажей мягкой и корпусной мебели ведущих производителей г. Красноярска. География наших продаж велика: Красноярский край, Иркутская область, Республика Бурятия, Республика Тыва, Республика Саха Якутия, Сахалинская область, Хабаровский край, Томская область, Тюменская область, Ханты-Мансийский автономный округ, Кемеровская область, Ямало-Ненецкий автономный округ</div><div>	Преимуществом работы с нами является то, что Вы сможете заказать мебель с разных фабрик, в нужной Вам ткани. Мы отслеживаем&nbsp; Ваш заказ с момента получения его нами до поступления этой мебели на Ваш склад или в магазин. На себя мы берем организацию по транспортировке мебели до места назначения.</div><div>	Работая с нами, Вы расширите свой ассортимент. Мы являемся региональным представителем компании &quot;Олимп-Мебель&quot; производителя корпусной мебели в Нижнем Новгороде. Мы сотрудничаем с мебельными фабриками Гонконга. Вся мебель имеет международный сертификат качества.</div><div>	Вы можете позвонить к нам в офис и наши менеджеры дадут Вам полную консультацию по ассортименту выпускаемой продукции. Мы вышлем Вам каталоги мебели, прайсы. Вы сможете заказать мебель по Вашему вкусу.</div><div>	Яркие и современные модели мягкой мебели сделают интерьер Вашего дома или офиса ярким, презентабельным и неповторимым. На нашем сайте представлена только небольшая часть всего ассортимента мебели, производимой на фабрике.</div>', 1, '2011-12-23 09:39:38', '2011-12-23 09:52:31'),
(2, 1, 'contacts', 'Контакты', '<div>	<p>		<strong>Наш адрес:</strong> г. Красноярск, ул. Рейдовая 68а</p>	<p>		<strong>Телефон:</strong>&nbsp;8 (391) 264-97-22, Факс: 8 (391) 263-62-09</p>	<p>		Директор ООО &laquo;РегионСибМебель&raquo;:<br />		Лексикова Светлана Анатольевна, телефон: 8-950-403-59-90<br />		<br />		Руководитель отдела продаж:<br />		Гудик Виктор Романович, телефон:&nbsp;8-902-992-05-39</p>	<p>		Менеджер:<br />		Матюхина Ольга Анатольевна,</p>	<p>		тел.: 8 (391) 264-97-22, факс: 8 (391) 263-62-09</p>	<p>		e-mail: <a href="mailto:regionsibmebel@mail.ru">regionsibmebel@mail.ru</a>, <a href="mailto:regionsibmebel@yandex.ru">regionsibmebel@yandex.ru</a></p></div>', 2, '2011-12-23 09:40:26', '2011-12-23 09:41:23');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_company_types`
--

CREATE TABLE IF NOT EXISTS `cake_company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `cake_company_types`
--

INSERT INTO `cake_company_types` (`id`, `type_name`) VALUES
(1, 'ООО'),
(2, 'ЗАО'),
(3, 'ОАО'),
(4, 'ИП'),
(5, 'ГУП'),
(6, 'Другая форма');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_customs`
--

CREATE TABLE IF NOT EXISTS `cake_customs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `custom_status_type_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `note` text,
  `pay_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customs_ind_user` (`user_id`),
  KEY `customs_ind_custom_status_type` (`custom_status_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=187 ;

--
-- Дамп данных таблицы `cake_customs`
--

INSERT INTO `cake_customs` (`id`, `user_id`, `custom_status_type_id`, `created`, `note`, `pay_type_id`) VALUES
(182, NULL, 1, '2012-01-21 17:10:53', NULL, NULL),
(184, NULL, 1, '2012-01-21 18:17:21', NULL, NULL),
(185, NULL, 1, '2012-01-21 18:17:49', NULL, NULL),
(186, 4, 2, '2012-01-21 19:44:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_custom_client_infos`
--

CREATE TABLE IF NOT EXISTS `cake_custom_client_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `fio` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `post_index` varchar(10) DEFAULT NULL,
  `post_region` varchar(100) DEFAULT NULL,
  `post_city` varchar(50) DEFAULT NULL,
  `post_street` varchar(50) DEFAULT NULL,
  `post_hnumber` varchar(20) DEFAULT NULL,
  `post_office` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `company_type_id` int(11) DEFAULT NULL,
  `reg_num` varchar(50) DEFAULT NULL,
  `phone_kod` varchar(10) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax_kod` varchar(10) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `jur_index` varchar(10) DEFAULT NULL,
  `jur_region` varchar(100) DEFAULT NULL,
  `jur_city` varchar(50) DEFAULT NULL,
  `jur_street` varchar(50) DEFAULT NULL,
  `jur_hnumber` varchar(20) DEFAULT NULL,
  `jur_office` varchar(20) DEFAULT NULL,
  `INN` varchar(50) DEFAULT NULL,
  `KPP` varchar(50) DEFAULT NULL,
  `operating_account` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `correspondent_account` varchar(50) DEFAULT NULL,
  `BIK` varchar(50) DEFAULT NULL,
  `OKPO` varchar(50) DEFAULT NULL,
  `OKVED` varchar(50) DEFAULT NULL,
  `pay_type_id` int(11) DEFAULT NULL,
  `transport_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_client_info_ind_custom` (`custom_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=139 ;

--
-- Дамп данных таблицы `cake_custom_client_infos`
--

INSERT INTO `cake_custom_client_infos` (`id`, `custom_id`, `fio`, `email`, `post_index`, `post_region`, `post_city`, `post_street`, `post_hnumber`, `post_office`, `name`, `company_type_id`, `reg_num`, `phone_kod`, `phone`, `fax_kod`, `fax`, `jur_index`, `jur_region`, `jur_city`, `jur_street`, `jur_hnumber`, `jur_office`, `INN`, `KPP`, `operating_account`, `bank`, `correspondent_account`, `BIK`, `OKPO`, `OKVED`, `pay_type_id`, `transport_type_id`) VALUES
(135, 182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 184, 'Илья', NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(137, 185, 'Илья', NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2),
(138, 186, 'Детинкин Илья Алексеевич', NULL, '660118', 'Красноярский край', 'Красноярск', 'Парижской комунны', '41', '1', 'КрасИнформ', 4, 'регномер', '953', '5901829', 'факс', 'факс2', '6601182', 'Красноярский край2', 'Красноярск2', 'Парижской комунны2', '412', '12', 'инн', 'кпп', 'рс', 'банк', 'кс', 'бик', 'окпо', 'оквэд', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_custom_dets`
--

CREATE TABLE IF NOT EXISTS `cake_custom_dets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_det_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `cnt` int(11) NOT NULL DEFAULT '1',
  `price` float NOT NULL,
  `code_1c` varchar(300) DEFAULT NULL,
  `name_1c` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_det_ind_custom` (`custom_id`),
  KEY `custom_det_ind_product` (`product_id`),
  KEY `custom_det_ind_product_det` (`product_det_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=782 ;

--
-- Дамп данных таблицы `cake_custom_dets`
--

INSERT INTO `cake_custom_dets` (`id`, `custom_id`, `product_id`, `product_det_id`, `name`, `cnt`, `price`, `code_1c`, `name_1c`) VALUES
(778, 182, 10666, NULL, 'Герда', 1, 550, NULL, NULL),
(779, 184, 10666, NULL, 'Герда', 1, 550, NULL, NULL),
(780, 185, 10666, NULL, 'Герда', 1, 550, NULL, NULL),
(781, 186, 10666, NULL, 'Герда', 1, 520, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_custom_statuses`
--

CREATE TABLE IF NOT EXISTS `cake_custom_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `custom_status_type_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_status_ind_custom` (`custom_id`),
  KEY `custom_status_ind_user` (`user_id`),
  KEY `custom_status_ind_custom_status_type` (`custom_status_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=386 ;

--
-- Дамп данных таблицы `cake_custom_statuses`
--

INSERT INTO `cake_custom_statuses` (`id`, `custom_id`, `custom_status_type_id`, `created`, `user_id`) VALUES
(376, 182, 1, '2012-01-21 17:10:53', NULL),
(377, 184, 1, '2012-01-21 18:17:21', NULL),
(378, 185, 1, '2012-01-21 18:17:49', NULL),
(379, 186, 1, '2012-01-21 19:44:42', 4),
(383, 186, 2, '2012-01-21 21:34:07', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_custom_status_types`
--

CREATE TABLE IF NOT EXISTS `cake_custom_status_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_status_type_ind_image` (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `cake_custom_status_types`
--

INSERT INTO `cake_custom_status_types` (`id`, `name`, `image_id`) VALUES
(1, 'Ожидание', 2474),
(2, 'Рассмотрение', 2475),
(3, 'Оплата', 2476),
(4, 'Оформление', 2477),
(5, 'Доставка', 2478),
(6, 'Отменен', 2479),
(7, 'Выполнен', 2480);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_dispatches`
--

CREATE TABLE IF NOT EXISTS `cake_dispatches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(500) NOT NULL,
  `dispatch_header` varchar(500) NOT NULL,
  `dispatch_body` text,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=105 ;

--
-- Дамп данных таблицы `cake_dispatches`
--

INSERT INTO `cake_dispatches` (`id`, `address`, `dispatch_header`, `dispatch_body`, `created`, `modified`) VALUES
(98, '<br>tvanriulia@mail.ru<br>remroom.ru@gmail.com<br>aquamagaz@gmail.com<br>gryglewskirit@gmail.com<br>silvas.amuel127@gmail.com<br>hedodoony@mail.ru<br>tvanriulise@mail.ru<br>hafoxoxebofsg@gmail.com<br>corvallisbuildercom@mail.ru<br>dachenka@uganska.net<br>gipercubz@mail.ru<br>drin@drin.ru<br>n.a.dez.dare.wo.sar@gmail.com<br>fexenenogew@mail.ru<br>sretiksli@mail.ru<br>evdokden@gmail.com<br>evdokden@gmail.com<br>evdokden1@rambler.ru<br>wkejalk@mail.ru<br>crazyfinance@gmail.com<br>cocclaseratos@ramb', 'Добрый день !! ', '<div>\r\n	Добрый день ! Компания Анжелика , хочет осведомить вас с приходом большого количества манекенов, взрослых и детских в полный рост !!</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<img src="http://mail.yandex.ru/message_part/logo.jpg?hid=1.2&amp;ids=2000000001299867321&amp;name=logo.jpg" /></div>\r\n<div>\r\n	С уважением компания &quot;Склад Магазин Торгового Оборудования&quot; Анжелика.</div>\r\n<div>\r\n	Сайт : <a href="http://www.mto24.ru"><span style="color:#ff0000;">www.mto24.ru</span></a></div>\r\n<div>\r\n	E-mail: <a href="mailto:mto24@mail.ru"><span style="color:#ff0000;">mto24@mail.ru</span></a></div>\r\n<div>\r\n	Телефон: 8(391)2-265-365</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>', '2011-02-15', '2011-02-15');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_files`
--

CREATE TABLE IF NOT EXISTS `cake_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `stamp` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cake_files`
--

INSERT INTO `cake_files` (`id`, `filename`, `extension`, `stamp`) VALUES
(1, 'test', 'docx', '2011-02-20');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_guestbooks`
--

CREATE TABLE IF NOT EXISTS `cake_guestbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `text` text,
  `sort_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `cake_guestbooks`
--

INSERT INTO `cake_guestbooks` (`id`, `enabled`, `name`, `city`, `email`, `phone`, `text`, `sort_order`, `created`, `updated`) VALUES
(1, 1, 'Светлана', '', '', '', 'Уважаемые посетители нашего сайта большое Вам спасибо за Ваше к нам внимание, но очень большая просьба не забивать сайт не нужной информацией. С Уважением, Светлана Л.', 11, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(2, 1, 'RambplaypeRup', '', '', '', 'Респект! сайт сделан с умом..', 10, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(3, 1, 'Борат Сагдиев', '', '', '', 'Всем привет! Отличный сайт,отличная погода,отличное настроение! Спасибо,что вы есть!', 9, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(4, 1, 'Юлия', '', '', '', 'Прекрасные женщины! Поздравляю вас с праздником 8 марта! Желаю приятного весеннего настроения, веселого общения.', 8, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(5, 1, 'Оксана', '', '', '', 'Здравствуйте всем. Хочу приобрести мебель и избороздила за пару суток уже кучу инфо по этой теме. Задумка сайта не плохая, но качество фото - просто ужасное! Не возможно рассмотреть то, что собственно и предлагается купить... :\\\\ Желаю вам со временем вырасти в больших, красивых, информативных и полезных! :) (а по личным ощущениям удобства мне импонируют лотус и 8-е марта)', 7, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(6, 1, 'Игорь', '', '', '', 'Добрый день, господа партнеры! Пжлст обновите наш раздел в Вашем каталоге. Все фото (хорошего качества)и инфу в электронном виде предоставлю. P.S. Вышел каталог по корпусной мебели. С уважением, КМК', 6, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(7, 1, 'Юлия', '', '', '', 'Сайт создали - молодцы, но его еще надо доработать. Фото мебели мелкие и без ценников! Хочется чтобы сайт заменил поход в магазин, а то во все мгазаины не заедешь, вся экономия может уйти на бензин, муж будет ныть и придеться купить чего-нибудь по быстрее, а так я дома присмотрюсь и определюсь!', 5, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(8, 1, 'александр', '', '', '', 'предлагаю оптовые поставки корпусной мебели стенки модуля кухни детские', 4, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(9, 1, 'Александр', '', '', '', 'Корпусная мебель от Мебельной Фабрики ЕвроКорпус. Модерн. Обратите внимание на наши кровати серии Сан-Марино из МДФ и Массива бука. Оптовая цена от 5.650 руб.', 3, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(10, 1, 'Александр', '', '', '', 'Добрый день. А почему у вас нет мебели производства мебельной фарики командор? У них очень хорошая мягкая мебель. Особенно мне офисная понравилась.', 2, '2011-12-25 00:00:00', '2011-12-25 00:00:00'),
(11, 1, 'Чинчи', '', '', '', 'Здравствуйте! Могу я заказать по моим размерам кухню, спальню, детскую и горку. Если можно, то сколько процентов предоплата и в какие сроки будет готово. Также с компанией РАТЭК работаете?', 1, '2011-12-25 00:00:00', '2011-12-25 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_images`
--

CREATE TABLE IF NOT EXISTS `cake_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(50) DEFAULT NULL,
  `image_type_id` int(11) NOT NULL,
  `real_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_ind_image_type` (`image_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5896 ;

--
-- Дамп данных таблицы `cake_images`
--

INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(1, 'notes/image-1.JPG', 2, 'real/notes/image-1.JPG'),
(2, 'notes/image-2.gif', 2, 'real/notes/image-2.gif'),
(3, 'catalog/ple4001.gif', 1, 'real/catalog/ple4001.gif'),
(4, 'catalog/plechiki.jpeg', 1, 'real/catalog/plechiki.jpeg'),
(5, 'catalog/Akril_steklo.jpeg', 1, 'real/catalog/Akril_steklo.jpeg'),
(6, 'catalog/Pistolet.jpeg', 1, 'real/catalog/Pistolet.jpeg'),
(7, 'catalog/veshala.gif', 1, 'real/catalog/veshala.gif'),
(8, 'catalog/veshala_Preview.jpeg', 1, 'real/catalog/veshala_Preview.jpeg'),
(9, 'catalog/delta_preveiw.jpeg', 1, 'real/catalog/delta_preveiw.jpeg'),
(10, 'catalog/nasten_preview.jpeg', 1, 'real/catalog/nasten_preview.jpeg'),
(11, 'catalog/korzin001.gif', 1, 'real/catalog/korzin001.gif'),
(13, 'catalog/shkaf.bmp', 1, 'real/catalog/shkaf.bmp'),
(2800, 'banners/image-2800.gif', 4, 'real/banners/image-2800.gif'),
(16, 'catalog/maneken001.gif', 1, 'real/catalog/maneken001.gif'),
(17, 'catalog/demonstracionue_formu.asp.jpeg', 1, 'real/catalog/demonstracionue_formu.asp.jpeg'),
(18, 'catalog/glavnai.asp.jpeg', 1, 'real/catalog/glavnai.asp.jpeg'),
(19, 'catalog/vodolei001.gif', 1, 'real/catalog/vodolei001.gif'),
(21, 'catalog/archivniy_001.jpg', 1, 'real/catalog/archivniy_001.jpg'),
(22, 'catalog/skladskoi_stellaj.jpg', 1, 'real/catalog/skladskoi_stellaj.jpg'),
(23, 'catalog/sborniy.jpg', 1, 'real/catalog/sborniy.jpg'),
(24, 'catalog/stile_preview001.jpeg', 1, 'real/catalog/stile_preview001.jpeg'),
(25, 'catalog/standarti_sm.jpg', 1, 'real/catalog/standarti_sm.jpg'),
(26, 'catalog/gl_00127.bmp', 1, 'real/catalog/gl_00127.bmp'),
(27, 'catalog/Previewgl.jpeg', 1, 'real/catalog/Previewgl.jpeg'),
(28, 'catalog/Preview.jpeg', 1, 'real/catalog/Preview.jpeg'),
(29, 'catalog/jok_logo01.bmp', 1, 'real/catalog/jok_logo01.bmp'),
(30, 'catalog/Joker.jpeg', 1, 'real/catalog/Joker.jpeg'),
(31, 'catalog/joker_32.bmp', 1, 'real/catalog/joker_32.bmp'),
(32, 'catalog/Play.jpeg', 1, 'real/catalog/Play.jpeg'),
(33, 'catalog/Primo.jpeg', 1, 'real/catalog/Primo.jpeg'),
(34, 'catalog/R-System.jpeg', 1, 'real/catalog/R-System.jpeg'),
(35, 'catalog/Tritix.gif', 1, 'real/catalog/Tritix.gif'),
(36, 'catalog/Uno.gif', 1, 'real/catalog/Uno.gif'),
(37, 'catalog/ograda001.gif', 1, 'real/catalog/ograda001.gif'),
(39, 'catalog/Image_mspreview002.jpeg', 1, 'real/catalog/Image_mspreview002.jpeg'),
(40, 'catalog/ico_67(PREview).gif', 1, 'real/catalog/ico_67(PREview).gif'),
(41, 'catalog/Nakopitel_Preview.gif', 1, 'real/catalog/Nakopitel_Preview.gif'),
(42, 'catalog/pe4at_preview001.jpeg', 1, 'real/catalog/pe4at_preview001.jpeg'),
(43, 'catalog/trosu.jpeg', 1, 'real/catalog/trosu.jpeg'),
(44, 'catalog/arm_pw.bmp', 1, 'real/catalog/arm_pw.bmp'),
(45, 'catalog/ep001.gif', 1, 'real/catalog/ep001.gif'),
(46, 'catalog/Preview907.jpeg', 1, 'real/catalog/Preview907.jpeg'),
(47, 'catalog/view07.jpeg', 1, 'real/catalog/view07.jpeg'),
(48, 'catalog/preview_alumin.bmp', 1, 'real/catalog/preview_alumin.bmp'),
(49, 'catalog/imgdmg.jpg', 1, 'real/catalog/imgdmg.jpg'),
(51, 'catalog/IMG_0637_sm.jpg', 1, 'real/catalog/IMG_0637_sm.jpg'),
(52, 'catalog/beskarkas_logatip.jpg', 1, 'real/catalog/beskarkas_logatip.jpg'),
(53, 'catalog/Vitrina_logatip.bmp', 1, 'real/catalog/Vitrina_logatip.bmp'),
(1263, 'catalog/j01sx(It)L.gif', 1, 'real/catalog/j01sx(It)L.gif'),
(1265, 'catalog/j08(Kit)L.gif', 1, 'real/catalog/j08(Kit)L.gif'),
(1267, 'catalog/j015(Kit)L.jpeg', 1, 'real/catalog/j015(Kit)L.jpeg'),
(1268, 'catalog/u01(It)L.jpeg', 1, 'real/catalog/u01(It)L.jpeg'),
(1269, 'catalog/u01(Kit)L.jpeg', 1, 'real/catalog/u01(Kit)L.jpeg'),
(1270, 'catalog/u02(It)L.jpeg', 1, 'real/catalog/u02(It)L.jpeg'),
(1271, 'catalog/u02(Kit)L.jpeg', 1, 'real/catalog/u02(Kit)L.jpeg'),
(1272, 'catalog/u03(It)L.jpeg', 1, 'real/catalog/u03(It)L.jpeg'),
(1273, 'catalog/u03(Kit)L.jpeg', 1, 'real/catalog/u03(Kit)L.jpeg'),
(1274, 'catalog/u04(It)L.jpeg', 1, 'real/catalog/u04(It)L.jpeg'),
(1275, 'catalog/u04(Kit)L.jpeg', 1, 'real/catalog/u04(Kit)L.jpeg'),
(1276, 'catalog/u05(It)L.jpeg', 1, 'real/catalog/u05(It)L.jpeg'),
(1277, 'catalog/u06(It)L.jpeg', 1, 'real/catalog/u06(It)L.jpeg'),
(1278, 'catalog/u06(Kit)L.jpeg', 1, 'real/catalog/u06(Kit)L.jpeg'),
(1279, 'catalog/u07(It)L.jpeg', 1, 'real/catalog/u07(It)L.jpeg'),
(1280, 'catalog/u07(Kit)L.jpeg', 1, 'real/catalog/u07(Kit)L.jpeg'),
(1281, 'catalog/u09(It)L.jpeg', 1, 'real/catalog/u09(It)L.jpeg'),
(1282, 'catalog/u09(Kit)L.jpeg', 1, 'real/catalog/u09(Kit)L.jpeg'),
(1283, 'catalog/u010(It)L.jpeg', 1, 'real/catalog/u010(It)L.jpeg'),
(1284, 'catalog/u08(It)L.jpeg', 1, 'real/catalog/u08(It)L.jpeg'),
(1285, 'catalog/u011(It)L.jpeg', 1, 'real/catalog/u011(It)L.jpeg'),
(1286, 'catalog/u012(It)L.jpeg', 1, 'real/catalog/u012(It)L.jpeg'),
(1287, 'catalog/u013(It)L.jpeg', 1, 'real/catalog/u013(It)L.jpeg'),
(1288, 'catalog/u014(It)L.jpeg', 1, 'real/catalog/u014(It)L.jpeg'),
(1289, 'catalog/u015(It)L.jpeg', 1, 'real/catalog/u015(It)L.jpeg'),
(1290, 'catalog/u015(Kit)L.jpeg', 1, 'real/catalog/u015(Kit)L.jpeg'),
(1291, 'catalog/u016(It)L.jpeg', 1, 'real/catalog/u016(It)L.jpeg'),
(1292, 'catalog/u017(It)L.jpeg', 1, 'real/catalog/u017(It)L.jpeg'),
(1293, 'catalog/u018(It)L.jpeg', 1, 'real/catalog/u018(It)L.jpeg'),
(1295, 'catalog/u022(It)L.jpeg', 1, 'real/catalog/u022(It)L.jpeg'),
(1296, 'catalog/u023(It)L.jpeg', 1, 'real/catalog/u023(It)L.jpeg'),
(1297, 'catalog/u024(Kit)L.jpeg', 1, 'real/catalog/u024(Kit)L.jpeg'),
(1298, 'catalog/u024(It)L.jpeg', 1, 'real/catalog/u024(It)L.jpeg'),
(1299, 'catalog/u025(It)L.jpeg', 1, 'real/catalog/u025(It)L.jpeg'),
(1300, 'catalog/j01dx(It)L.gif', 1, 'real/catalog/j01dx(It)L.gif'),
(1301, 'catalog/j01sx(Kit)L.gif', 1, 'real/catalog/j01sx(Kit)L.gif'),
(1302, 'catalog/j01dx(Kit)L.gif', 1, 'real/catalog/j01dx(Kit)L.gif'),
(1303, 'catalog/j02(It)L.gif', 1, 'real/catalog/j02(It)L.gif'),
(1304, 'catalog/j03(It)L.gif', 1, 'real/catalog/j03(It)L.gif'),
(1305, 'catalog/j04(It)L.gif', 1, 'real/catalog/j04(It)L.gif'),
(1307, 'catalog/j04(Kit)L.gif', 1, 'real/catalog/j04(Kit)L.gif'),
(1308, 'catalog/j06(It)L.gif', 1, 'real/catalog/j06(It)L.gif'),
(1309, 'catalog/j07(It)L.gif', 1, 'real/catalog/j07(It)L.gif'),
(1310, 'catalog/j08(It)L.gif', 1, 'real/catalog/j08(It)L.gif'),
(1312, 'catalog/j011(It)L.gif', 1, 'real/catalog/j011(It)L.gif'),
(1313, 'catalog/j012(It)L.gif', 1, 'real/catalog/j012(It)L.gif'),
(1314, 'catalog/j014(Kit)L.gif', 1, 'real/catalog/j014(Kit)L.gif'),
(1315, 'catalog/j013(It)L.gif', 1, 'real/catalog/j013(It)L.gif'),
(1316, 'catalog/j014(It)L.gif', 1, 'real/catalog/j014(It)L.gif'),
(1317, 'catalog/j015(It)L.jpeg', 1, 'real/catalog/j015(It)L.jpeg'),
(1318, 'catalog/j015(Ket)L.gif', 1, 'real/catalog/j015(Ket)L.gif'),
(1319, 'catalog/j016(It)L.jpeg', 1, 'real/catalog/j016(It)L.jpeg'),
(1320, 'catalog/j016(Kit)L.jpeg', 1, 'real/catalog/j016(Kit)L.jpeg'),
(1321, 'catalog/j017(It)L.gif', 1, 'real/catalog/j017(It)L.gif'),
(1322, 'catalog/j017(Kit)L.gif', 1, 'real/catalog/j017(Kit)L.gif'),
(1323, 'catalog/j018(It)L.gif', 1, 'real/catalog/j018(It)L.gif'),
(1324, 'catalog/j019(It)L.gif', 1, 'real/catalog/j019(It)L.gif'),
(1325, 'catalog/j020(It)L.gif', 1, 'real/catalog/j020(It)L.gif'),
(1326, 'catalog/j021(It)L.jpeg', 1, 'real/catalog/j021(It)L.jpeg'),
(1327, 'catalog/j021(Kit)L.jpeg', 1, 'real/catalog/j021(Kit)L.jpeg'),
(1328, 'catalog/j022(It)L.jpeg', 1, 'real/catalog/j022(It)L.jpeg'),
(1330, 'catalog/j023(It)L.jpeg', 1, 'real/catalog/j023(It)L.jpeg'),
(1331, 'catalog/j024(It)L.jpeg', 1, 'real/catalog/j024(It)L.jpeg'),
(1332, 'catalog/j025(It)L.jpeg', 1, 'real/catalog/j025(It)L.jpeg'),
(1333, 'catalog/j026(It)L.jpeg', 1, 'real/catalog/j026(It)L.jpeg'),
(1334, 'catalog/j027(It)L.gif', 1, 'real/catalog/j027(It)L.gif'),
(1335, 'catalog/j028(It)L.gif', 1, 'real/catalog/j028(It)L.gif'),
(1336, 'catalog/j030(It)L.gif', 1, 'real/catalog/j030(It)L.gif'),
(1337, 'catalog/j030(Kit)L.gif', 1, 'real/catalog/j030(Kit)L.gif'),
(1338, 'catalog/j031sx(It)L.gif', 1, 'real/catalog/j031sx(It)L.gif'),
(1339, 'catalog/j031dx(It)L.gif', 1, 'real/catalog/j031dx(It)L.gif'),
(1340, 'catalog/j031sx(Kit)L.gif', 1, 'real/catalog/j031sx(Kit)L.gif'),
(1341, 'catalog/j031dx(Kit)L.gif', 1, 'real/catalog/j031dx(Kit)L.gif'),
(1342, 'catalog/j032(It)L.jpeg', 1, 'real/catalog/j032(It)L.jpeg'),
(1343, 'catalog/GL 9L.jpeg', 1, 'real/catalog/GL 9L.jpeg'),
(1345, 'catalog/GL 1.jpeg', 1, 'real/catalog/GL 1.jpeg'),
(1346, 'catalog/GL 109L.jpeg', 1, 'real/catalog/GL 109L.jpeg'),
(1349, 'catalog/GL 11.jpeg', 1, 'real/catalog/GL 11.jpeg'),
(1351, 'catalog/GL 110.gif', 1, 'real/catalog/GL 110.gif'),
(1352, 'catalog/GL 19B.jpeg', 1, 'real/catalog/GL 19B.jpeg'),
(1353, 'catalog/j033(It)L.jpeg', 1, 'real/catalog/j033(It)L.jpeg'),
(1356, 'catalog/j032(Kit)L.jpeg', 1, 'real/catalog/j032(Kit)L.jpeg'),
(1361, 'catalog/GL 23(mini).jpeg', 1, 'real/catalog/GL 23(mini).jpeg'),
(1362, 'catalog/j033(Kit)L.jpeg', 1, 'real/catalog/j033(Kit)L.jpeg'),
(1363, 'catalog/j034a(It)L.jpeg', 1, 'real/catalog/j034a(It)L.jpeg'),
(1364, 'catalog/j034c(It)L.jpeg', 1, 'real/catalog/j034c(It)L.jpeg'),
(1365, 'catalog/j035(It)L.jpeg', 1, 'real/catalog/j035(It)L.jpeg'),
(1366, 'catalog/j036(It)L.jpeg', 1, 'real/catalog/j036(It)L.jpeg'),
(1367, 'catalog/j037(It)L.jpeg', 1, 'real/catalog/j037(It)L.jpeg'),
(1368, 'catalog/j038(It)L.jpeg', 1, 'real/catalog/j038(It)L.jpeg'),
(1369, 'catalog/j039(It)L.jpeg', 1, 'real/catalog/j039(It)L.jpeg'),
(1370, 'catalog/j040(It)L.jpeg', 1, 'real/catalog/j040(It)L.jpeg'),
(1371, 'catalog/j040met(It)L.jpeg', 1, 'real/catalog/j040met(It)L.jpeg'),
(1372, 'catalog/j041(It)L.jpeg', 1, 'real/catalog/j041(It)L.jpeg'),
(1373, 'catalog/j045(It)L.jpeg', 1, 'real/catalog/j045(It)L.jpeg'),
(1374, 'catalog/j046(It)L.jpeg', 1, 'real/catalog/j046(It)L.jpeg'),
(1375, 'catalog/j047(It)L.jpeg', 1, 'real/catalog/j047(It)L.jpeg'),
(1376, 'catalog/j047(Kit)L.jpeg', 1, 'real/catalog/j047(Kit)L.jpeg'),
(1377, 'catalog/j050a(It)L.jpeg', 1, 'real/catalog/j050a(It)L.jpeg'),
(1378, 'catalog/j050b(It)L.gif', 1, 'real/catalog/j050b(It)L.gif'),
(1379, 'catalog/j051(It)L.gif', 1, 'real/catalog/j051(It)L.gif'),
(1380, 'catalog/j051(Kit)L.gif', 1, 'real/catalog/j051(Kit)L.gif'),
(1381, 'catalog/j052(It)L.jpeg', 1, 'real/catalog/j052(It)L.jpeg'),
(1382, 'catalog/j053(It)L.jpeg', 1, 'real/catalog/j053(It)L.jpeg'),
(1383, 'catalog/j054(It)L.jpeg', 1, 'real/catalog/j054(It)L.jpeg'),
(1384, 'catalog/j055(It)L.jpeg', 1, 'real/catalog/j055(It)L.jpeg'),
(1385, 'catalog/j055(Kit)L.jpeg', 1, 'real/catalog/j055(Kit)L.jpeg'),
(1386, 'catalog/j056(It)L.jpeg', 1, 'real/catalog/j056(It)L.jpeg'),
(1387, 'catalog/j057(It)L.jpeg', 1, 'real/catalog/j057(It)L.jpeg'),
(1388, 'catalog/j058(It)L.jpeg', 1, 'real/catalog/j058(It)L.jpeg'),
(1389, 'catalog/j058(Kit)L.jpeg', 1, 'real/catalog/j058(Kit)L.jpeg'),
(1390, 'catalog/j059(It)L.gif', 1, 'real/catalog/j059(It)L.gif'),
(1391, 'catalog/j059(Kit)L.gif', 1, 'real/catalog/j059(Kit)L.gif'),
(1392, 'catalog/j060(It)L.jpeg', 1, 'real/catalog/j060(It)L.jpeg'),
(1393, 'catalog/j061(It)L.gif', 1, 'real/catalog/j061(It)L.gif'),
(1394, 'catalog/j062(It)L.gif', 1, 'real/catalog/j062(It)L.gif'),
(1395, 'catalog/j063(It)L.jpeg', 1, 'real/catalog/j063(It)L.jpeg'),
(1396, 'catalog/j064(It)L.jpeg', 1, 'real/catalog/j064(It)L.jpeg'),
(1397, 'catalog/j063(Kit)L.jpeg', 1, 'real/catalog/j063(Kit)L.jpeg'),
(1398, 'catalog/j064(Kit)L.jpeg', 1, 'real/catalog/j064(Kit)L.jpeg'),
(1399, 'catalog/j070(It)L.jpeg', 1, 'real/catalog/j070(It)L.jpeg'),
(1408, 'catalog/GL 39(sm).jpeg', 1, 'real/catalog/GL 39(sm).jpeg'),
(1409, 'catalog/j071(It)L.jpeg', 1, 'real/catalog/j071(It)L.jpeg'),
(1410, 'catalog/j072(It)L.jpeg', 1, 'real/catalog/j072(It)L.jpeg'),
(1411, 'catalog/j073(It)L.jpeg', 1, 'real/catalog/j073(It)L.jpeg'),
(1412, 'catalog/j074(It)L.jpeg', 1, 'real/catalog/j074(It)L.jpeg'),
(1413, 'catalog/j075(It)L.jpeg', 1, 'real/catalog/j075(It)L.jpeg'),
(1414, 'catalog/j076(It)L.jpeg', 1, 'real/catalog/j076(It)L.jpeg'),
(1415, 'catalog/j077(It)L.jpeg', 1, 'real/catalog/j077(It)L.jpeg'),
(1416, 'catalog/j078(It)L.jpeg', 1, 'real/catalog/j078(It)L.jpeg'),
(1417, 'catalog/j078(Kit)L.jpeg', 1, 'real/catalog/j078(Kit)L.jpeg'),
(1418, 'catalog/j080(It)L.jpeg', 1, 'real/catalog/j080(It)L.jpeg'),
(1419, 'catalog/j080(Kit)L.jpeg', 1, 'real/catalog/j080(Kit)L.jpeg'),
(1420, 'catalog/j081(It)L.jpeg', 1, 'real/catalog/j081(It)L.jpeg'),
(1421, 'catalog/j081(Kit)L.jpeg', 1, 'real/catalog/j081(Kit)L.jpeg'),
(1422, 'catalog/j0304(It)L.jpeg', 1, 'real/catalog/j0304(It)L.jpeg'),
(1423, 'catalog/j0651(It)L.jpeg', 1, 'real/catalog/j0651(It)L.jpeg'),
(1424, 'catalog/j0652(It)L.jpeg', 1, 'real/catalog/j0652(It)L.jpeg'),
(1425, 'catalog/j0671(It)L.jpeg', 1, 'real/catalog/j0671(It)L.jpeg'),
(1426, 'catalog/j0672(It)L.jpeg', 1, 'real/catalog/j0672(It)L.jpeg'),
(1427, 'catalog/j0651(Kit)L.jpeg', 1, 'real/catalog/j0651(Kit)L.jpeg'),
(1428, 'catalog/j0652(Kit)L.jpeg', 1, 'real/catalog/j0652(Kit)L.jpeg'),
(1429, 'catalog/j065(Kit)L.jpeg', 1, 'real/catalog/j065(Kit)L.jpeg'),
(1430, 'catalog/r105sm.jpg', 1, 'real/catalog/r105sm.jpg'),
(1431, 'catalog/r109.jpg', 1, 'real/catalog/r109.jpg'),
(1432, 'catalog/r111.jpg', 1, 'real/catalog/r111.jpg'),
(1433, 'catalog/r112.jpg', 1, 'real/catalog/r112.jpg'),
(1434, 'catalog/r113.jpg', 1, 'real/catalog/r113.jpg'),
(1439, 'catalog/r290.jpg', 1, 'real/catalog/r290.jpg'),
(1440, 'catalog/GL 101o(01).jpg', 1, 'real/catalog/GL 101o(01).jpg'),
(1441, 'catalog/GL 29(sm).jpeg', 1, 'real/catalog/GL 29(sm).jpeg'),
(1442, 'catalog/R02 (sm).jpg', 1, 'real/catalog/R02 (sm).jpg'),
(1443, 'catalog/R03 (sm).jpg', 1, 'real/catalog/R03 (sm).jpg'),
(1445, 'catalog/tr01(Kit)L.gif', 1, 'real/catalog/tr01(Kit)L.gif'),
(1446, 'catalog/tr01b(It)L.gif', 1, 'real/catalog/tr01b(It)L.gif'),
(1447, 'catalog/tr01b(Kit)L.gif', 1, 'real/catalog/tr01b(Kit)L.gif'),
(1448, 'catalog/tr02(It)L.gif', 1, 'real/catalog/tr02(It)L.gif'),
(1449, 'catalog/tr02(Mosk)L.gif', 1, 'real/catalog/tr02(Mosk)L.gif'),
(1450, 'catalog/R04(r109)(sm).jpeg', 1, 'real/catalog/R04(r109)(sm).jpeg'),
(1451, 'catalog/tr02(Kit)L.gif', 1, 'real/catalog/tr02(Kit)L.gif'),
(1452, 'catalog/tr02b(It)L.gif', 1, 'real/catalog/tr02b(It)L.gif'),
(1453, 'catalog/tr02b(Kit)L.gif', 1, 'real/catalog/tr02b(Kit)L.gif'),
(1454, 'catalog/tr03(It)L.gif', 1, 'real/catalog/tr03(It)L.gif'),
(1455, 'catalog/tr03(Kit)L.gif', 1, 'real/catalog/tr03(Kit)L.gif'),
(1456, 'catalog/R05(sm).jpg', 1, 'real/catalog/R05(sm).jpg'),
(1457, 'catalog/R07(sm).jpg', 1, 'real/catalog/R07(sm).jpg'),
(1458, 'catalog/R06(sm).jpg', 1, 'real/catalog/R06(sm).jpg'),
(1459, 'catalog/r08-400(sm).jpg', 1, 'real/catalog/r08-400(sm).jpg'),
(1460, 'catalog/R09(sm).jpg', 1, 'real/catalog/R09(sm).jpg'),
(1462, 'catalog/tr03b(It)L.gif', 1, 'real/catalog/tr03b(It)L.gif'),
(1463, 'catalog/tr03b(Kit)L.gif', 1, 'real/catalog/tr03b(Kit)L.gif'),
(1464, 'catalog/RT 014(sm).gif', 1, 'real/catalog/RT 014(sm).gif'),
(1465, 'catalog/RT 015(sm).gif', 1, 'real/catalog/RT 015(sm).gif'),
(1466, 'catalog/RT 026(sm).gif', 1, 'real/catalog/RT 026(sm).gif'),
(1467, 'catalog/RT 027(sm).gif', 1, 'real/catalog/RT 027(sm).gif'),
(1468, 'catalog/RT 063(sm).gif', 1, 'real/catalog/RT 063(sm).gif'),
(1469, 'catalog/17(sm).jpg', 1, 'real/catalog/17(sm).jpg'),
(1470, 'catalog/RC 24-400(sm).jpeg', 1, 'real/catalog/RC 24-400(sm).jpeg'),
(1471, 'catalog/ar111sm.jpeg', 1, 'real/catalog/ar111sm.jpeg'),
(1473, 'catalog/GL21sm.jpeg', 1, 'real/catalog/GL21sm.jpeg'),
(1474, 'catalog/GL55sm.jpeg', 1, 'real/catalog/GL55sm.jpeg'),
(1475, 'catalog/GL56sm.jpeg', 1, 'real/catalog/GL56sm.jpeg'),
(1476, 'catalog/FR163sm.gif', 1, 'real/catalog/FR163sm.gif'),
(1477, 'catalog/GL 38(sm).jpeg', 1, 'real/catalog/GL 38(sm).jpeg'),
(1478, 'catalog/GL 8sm.jpeg', 1, 'real/catalog/GL 8sm.jpeg'),
(1484, 'catalog/201 (150)sm.jpeg', 1, 'real/catalog/201 (150)sm.jpeg'),
(1485, 'catalog/328sm.jpeg', 1, 'real/catalog/328sm.jpeg'),
(1486, 'catalog/jheadsm.jpg', 1, 'real/catalog/jheadsm.jpg'),
(1487, 'catalog/n62.jpg', 1, 'real/catalog/n62.jpg'),
(1488, 'catalog/m130.jpg', 1, 'real/catalog/m130.jpg'),
(1489, 'catalog/m1840.jpg', 1, 'real/catalog/m1840.jpg'),
(1491, 'catalog/m790.jpg', 1, 'real/catalog/m790.jpg'),
(1492, 'catalog/tr04(It)L.gif', 1, 'real/catalog/tr04(It)L.gif'),
(1493, 'catalog/tr05(It)L.gif', 1, 'real/catalog/tr05(It)L.gif'),
(1494, 'catalog/tr06(It)L.gif', 1, 'real/catalog/tr06(It)L.gif'),
(1495, 'catalog/tr07(It)L.gif', 1, 'real/catalog/tr07(It)L.gif'),
(1496, 'catalog/tr08(It)L.gif', 1, 'real/catalog/tr08(It)L.gif'),
(1497, 'catalog/tr09(It)L.gif', 1, 'real/catalog/tr09(It)L.gif'),
(1498, 'catalog/tr10(It)L.gif', 1, 'real/catalog/tr10(It)L.gif'),
(1499, 'catalog/tr12(It)L.gif', 1, 'real/catalog/tr12(It)L.gif'),
(1500, 'catalog/tr14(It)L.gif', 1, 'real/catalog/tr14(It)L.gif'),
(1501, 'catalog/tr16(It)L.gif', 1, 'real/catalog/tr16(It)L.gif'),
(1502, 'catalog/tr17(It)L.gif', 1, 'real/catalog/tr17(It)L.gif'),
(1503, 'catalog/tr18(It)L.gif', 1, 'real/catalog/tr18(It)L.gif'),
(1504, 'catalog/tr22(It)L.gif', 1, 'real/catalog/tr22(It)L.gif'),
(1505, 'catalog/tr26(It)L.gif', 1, 'real/catalog/tr26(It)L.gif'),
(1506, 'catalog/tr27(It)L.gif', 1, 'real/catalog/tr27(It)L.gif'),
(1507, 'catalog/tr43(It)L.gif', 1, 'real/catalog/tr43(It)L.gif'),
(1508, 'catalog/tr44(It)L.gif', 1, 'real/catalog/tr44(It)L.gif'),
(1509, 'catalog/tr45(It)L.gif', 1, 'real/catalog/tr45(It)L.gif'),
(1510, 'catalog/tr46(It)L.gif', 1, 'real/catalog/tr46(It)L.gif'),
(1511, 'catalog/tr47(It)L.gif', 1, 'real/catalog/tr47(It)L.gif'),
(1512, 'catalog/tr48(It)L.gif', 1, 'real/catalog/tr48(It)L.gif'),
(1513, 'catalog/tr49(It)L.gif', 1, 'real/catalog/tr49(It)L.gif'),
(1514, 'catalog/tr19(It)L.gif', 1, 'real/catalog/tr19(It)L.gif'),
(1515, 'catalog/tr50(It)L.gif', 1, 'real/catalog/tr50(It)L.gif'),
(1516, 'catalog/tr51(It)L.gif', 1, 'real/catalog/tr51(It)L.gif'),
(1517, 'catalog/tr52(It)L.gif', 1, 'real/catalog/tr52(It)L.gif'),
(1518, 'catalog/tr53(It)L.gif', 1, 'real/catalog/tr53(It)L.gif'),
(1519, 'catalog/tr54(It)L.gif', 1, 'real/catalog/tr54(It)L.gif'),
(1520, 'catalog/tr07008(It)L.jpeg', 1, 'real/catalog/tr07008(It)L.jpeg'),
(1521, 'catalog/tr07040(It)L.jpeg', 1, 'real/catalog/tr07040(It)L.jpeg'),
(1522, 'catalog/tr07041(It)L.jpeg', 1, 'real/catalog/tr07041(It)L.jpeg'),
(1523, 'catalog/tr07048(It)L.jpeg', 1, 'real/catalog/tr07048(It)L.jpeg'),
(1524, 'catalog/tr07050(It)L.jpeg', 1, 'real/catalog/tr07050(It)L.jpeg'),
(1525, 'catalog/pr01(It)L.jpeg', 1, 'real/catalog/pr01(It)L.jpeg'),
(1526, 'catalog/pr02(It)L.jpeg', 1, 'real/catalog/pr02(It)L.jpeg'),
(1527, 'catalog/pr03(It)L.jpeg', 1, 'real/catalog/pr03(It)L.jpeg'),
(1528, 'catalog/pr04(It)L.jpeg', 1, 'real/catalog/pr04(It)L.jpeg'),
(1529, 'catalog/pr05(It)L.jpeg', 1, 'real/catalog/pr05(It)L.jpeg'),
(1530, 'catalog/pr06(It)L.jpeg', 1, 'real/catalog/pr06(It)L.jpeg'),
(1531, 'catalog/pr07(It)L.jpeg', 1, 'real/catalog/pr07(It)L.jpeg'),
(1532, 'catalog/pr08(It)L.jpeg', 1, 'real/catalog/pr08(It)L.jpeg'),
(1533, 'catalog/pr011(It)L.jpeg', 1, 'real/catalog/pr011(It)L.jpeg'),
(1534, 'catalog/pr012(It)L.jpeg', 1, 'real/catalog/pr012(It)L.jpeg'),
(1535, 'catalog/pr013(It)L.jpeg', 1, 'real/catalog/pr013(It)L.jpeg'),
(1536, 'catalog/pr014(It)L.jpeg', 1, 'real/catalog/pr014(It)L.jpeg'),
(1537, 'catalog/pr015(It)L.jpeg', 1, 'real/catalog/pr015(It)L.jpeg'),
(1538, 'catalog/pr09(It)L.jpeg', 1, 'real/catalog/pr09(It)L.jpeg'),
(1539, 'catalog/pr10(It)L.jpeg', 1, 'real/catalog/pr10(It)L.jpeg'),
(1540, 'catalog/pr0011(It)L.jpeg', 1, 'real/catalog/pr0011(It)L.jpeg'),
(1541, 'catalog/pr0012(It)L.jpeg', 1, 'real/catalog/pr0012(It)L.jpeg'),
(1542, 'catalog/pr0013(It)L.jpeg', 1, 'real/catalog/pr0013(It)L.jpeg'),
(1543, 'catalog/pr0014(It)L.jpeg', 1, 'real/catalog/pr0014(It)L.jpeg'),
(1544, 'catalog/pr016(It)L.jpeg', 1, 'real/catalog/pr016(It)L.jpeg'),
(1545, 'catalog/pr017(It)L.jpeg', 1, 'real/catalog/pr017(It)L.jpeg'),
(1546, 'catalog/pr018(It)L.jpeg', 1, 'real/catalog/pr018(It)L.jpeg'),
(1547, 'catalog/pr019(It)L.jpeg', 1, 'real/catalog/pr019(It)L.jpeg'),
(1548, 'catalog/pr020(It)L.jpeg', 1, 'real/catalog/pr020(It)L.jpeg'),
(1549, 'catalog/pr021(It)L.jpeg', 1, 'real/catalog/pr021(It)L.jpeg'),
(1550, 'catalog/pr022(It)L.jpeg', 1, 'real/catalog/pr022(It)L.jpeg'),
(1551, 'catalog/pr023(It)L.jpeg', 1, 'real/catalog/pr023(It)L.jpeg'),
(1552, 'catalog/pr024(It)L.jpeg', 1, 'real/catalog/pr024(It)L.jpeg'),
(1553, 'catalog/pr025(It)L.jpeg', 1, 'real/catalog/pr025(It)L.jpeg'),
(1554, 'catalog/pr026(It)L.jpeg', 1, 'real/catalog/pr026(It)L.jpeg'),
(1555, 'catalog/pr029(It)L.jpeg', 1, 'real/catalog/pr029(It)L.jpeg'),
(1556, 'catalog/pr030(It)L.jpeg', 1, 'real/catalog/pr030(It)L.jpeg'),
(1557, 'catalog/pr031(It)L.jpeg', 1, 'real/catalog/pr031(It)L.jpeg'),
(1558, 'catalog/pr047(It)L.jpeg', 1, 'real/catalog/pr047(It)L.jpeg'),
(1559, 'catalog/pr048(It)L.jpeg', 1, 'real/catalog/pr048(It)L.jpeg'),
(1560, 'catalog/pr059(It)L.jpeg', 1, 'real/catalog/pr059(It)L.jpeg'),
(1561, 'catalog/pr065(It)L.jpeg', 1, 'real/catalog/pr065(It)L.jpeg'),
(1562, 'catalog/pr066(It)L.jpeg', 1, 'real/catalog/pr066(It)L.jpeg'),
(1563, 'catalog/pr067(It)L.jpeg', 1, 'real/catalog/pr067(It)L.jpeg'),
(1564, 'catalog/pr068(It)L.jpeg', 1, 'real/catalog/pr068(It)L.jpeg'),
(1565, 'catalog/pr070(It)L.jpeg', 1, 'real/catalog/pr070(It)L.jpeg'),
(1566, 'catalog/pr071(It)L.jpeg', 1, 'real/catalog/pr071(It)L.jpeg'),
(1567, 'catalog/pr072(It)L.jpeg', 1, 'real/catalog/pr072(It)L.jpeg'),
(1568, 'catalog/pr073(It)L.jpeg', 1, 'real/catalog/pr073(It)L.jpeg'),
(1569, 'catalog/pr075(It)L.jpeg', 1, 'real/catalog/pr075(It)L.jpeg'),
(1570, 'catalog/pr076(It)L.jpeg', 1, 'real/catalog/pr076(It)L.jpeg'),
(1571, 'catalog/pr077(It)L.jpeg', 1, 'real/catalog/pr077(It)L.jpeg'),
(1572, 'catalog/pr0104A4(It)L.jpeg', 1, 'real/catalog/pr0104A4(It)L.jpeg'),
(1573, 'catalog/pr0483(It)L.jpeg', 1, 'real/catalog/pr0483(It)L.jpeg'),
(1574, 'catalog/pr0107(It)L.jpeg', 1, 'real/catalog/pr0107(It)L.jpeg'),
(1575, 'catalog/pr0485(It)L.jpeg', 1, 'real/catalog/pr0485(It)L.jpeg'),
(1576, 'catalog/m79070(sm).jpg', 1, 'real/catalog/m79070(sm).jpg'),
(1577, 'catalog/22(sm).jpg', 1, 'real/catalog/22(sm).jpg'),
(1578, 'catalog/m184070(sm).jpg', 1, 'real/catalog/m184070(sm).jpg'),
(1580, 'catalog/202 (150)sm.jpeg', 1, 'real/catalog/202 (150)sm.jpeg'),
(1582, 'catalog/md5sm.jpg', 1, 'real/catalog/md5sm.jpg'),
(1584, 'catalog/772sm.jpg', 1, 'real/catalog/772sm.jpg'),
(1585, 'catalog/md4sm.jpg', 1, 'real/catalog/md4sm.jpg'),
(1586, 'catalog/md6sm.jpeg', 1, 'real/catalog/md6sm.jpeg'),
(1587, 'catalog/mk11sm.jpg', 1, 'real/catalog/mk11sm.jpg'),
(1588, 'catalog/mk14sm.jpg', 1, 'real/catalog/mk14sm.jpg'),
(1589, 'catalog/mk10sm.jpg', 1, 'real/catalog/mk10sm.jpg'),
(1590, 'catalog/mk12sm.jpg', 1, 'real/catalog/mk12sm.jpg'),
(1591, 'catalog/mk15sm.jpg', 1, 'real/catalog/mk15sm.jpg'),
(1592, 'catalog/mk16sm.jpg', 1, 'real/catalog/mk16sm.jpg'),
(1593, 'catalog/mk187sm.jpg', 1, 'real/catalog/mk187sm.jpg'),
(1594, 'catalog/102sm.jpeg', 1, 'real/catalog/102sm.jpeg'),
(1595, 'catalog/101sm.jpeg', 1, 'real/catalog/101sm.jpeg'),
(1597, 'catalog/103sm.jpeg', 1, 'real/catalog/103sm.jpeg'),
(1599, 'catalog/104sm.jpeg', 1, 'real/catalog/104sm.jpeg'),
(1600, 'catalog/d38sm.jpg', 1, 'real/catalog/d38sm.jpg'),
(1604, 'catalog/6grsm.jpg', 1, 'real/catalog/6grsm.jpg'),
(1605, 'catalog/tr01sm.jpg', 1, 'real/catalog/tr01sm.jpg'),
(1606, 'catalog/tr02sm.jpg', 1, 'real/catalog/tr02sm.jpg'),
(1607, 'catalog/pr0911(It)L.jpeg', 1, 'real/catalog/pr0911(It)L.jpeg'),
(1608, 'catalog/pr0937(It)L.jpeg', 1, 'real/catalog/pr0937(It)L.jpeg'),
(1609, 'catalog/pr0936(It)L.jpeg', 1, 'real/catalog/pr0936(It)L.jpeg'),
(1610, 'catalog/r02(It)L.jpeg', 1, 'real/catalog/r02(It)L.jpeg'),
(1611, 'catalog/r02h(It)L.jpeg', 1, 'real/catalog/r02h(It)L.jpeg'),
(1612, 'catalog/r03h(It)L.jpeg', 1, 'real/catalog/r03h(It)L.jpeg'),
(1613, 'catalog/r023(It)L.jpeg', 1, 'real/catalog/r023(It)L.jpeg'),
(1614, 'catalog/r01(It)L.jpeg', 1, 'real/catalog/r01(It)L.jpeg'),
(1615, 'catalog/r023r(It)L.jpeg', 1, 'real/catalog/r023r(It)L.jpeg'),
(1616, 'catalog/r023t(It)L.jpeg', 1, 'real/catalog/r023t(It)L.jpeg'),
(1617, 'catalog/r03c1mt(It)L.jpeg', 1, 'real/catalog/r03c1mt(It)L.jpeg'),
(1618, 'catalog/pl04(It)L.gif', 1, 'real/catalog/pl04(It)L.gif'),
(1619, 'catalog/pl02(It)L.jpeg', 1, 'real/catalog/pl02(It)L.jpeg'),
(1620, 'catalog/pl03(It)L.jpeg', 1, 'real/catalog/pl03(It)L.jpeg'),
(1621, 'catalog/pl09(It)L.jpeg', 1, 'real/catalog/pl09(It)L.jpeg'),
(1622, 'catalog/pl10(It)L.jpeg', 1, 'real/catalog/pl10(It)L.jpeg'),
(1623, 'catalog/pl11(It)L.jpeg', 1, 'real/catalog/pl11(It)L.jpeg'),
(1624, 'catalog/pl13(It)L.jpeg', 1, 'real/catalog/pl13(It)L.jpeg'),
(1625, 'catalog/pl15(It)L.jpeg', 1, 'real/catalog/pl15(It)L.jpeg'),
(1629, 'catalog/f107sm.jpeg', 1, 'real/catalog/f107sm.jpeg'),
(1630, 'catalog/f109sm.jpeg', 1, 'real/catalog/f109sm.jpeg'),
(1631, 'catalog/f112sm.jpeg', 1, 'real/catalog/f112sm.jpeg'),
(1635, 'catalog/f119sm.jpeg', 1, 'real/catalog/f119sm.jpeg'),
(1636, 'catalog/f130sm.jpeg', 1, 'real/catalog/f130sm.jpeg'),
(1637, 'catalog/f131sm.jpeg', 1, 'real/catalog/f131sm.jpeg'),
(1638, 'catalog/f132sm.gif', 1, 'real/catalog/f132sm.gif'),
(1640, 'catalog/f197sm.gif', 1, 'real/catalog/f197sm.gif'),
(1641, 'catalog/f204sm.jpeg', 1, 'real/catalog/f204sm.jpeg'),
(1642, 'catalog/f220sm.jpeg', 1, 'real/catalog/f220sm.jpeg'),
(1645, 'catalog/f221sm.jpeg', 1, 'real/catalog/f221sm.jpeg'),
(1655, 'catalog/f342sm.jpeg', 1, 'real/catalog/f342sm.jpeg'),
(1656, 'catalog/f363sm.gif', 1, 'real/catalog/f363sm.gif'),
(1657, 'catalog/f364sm.jpeg', 1, 'real/catalog/f364sm.jpeg'),
(1658, 'catalog/f365sm.gif', 1, 'real/catalog/f365sm.gif'),
(1659, 'catalog/f373sm.gif', 1, 'real/catalog/f373sm.gif'),
(1660, 'catalog/f597sm.jpeg', 1, 'real/catalog/f597sm.jpeg'),
(1661, 'catalog/f701sm.bmp', 1, 'real/catalog/f701sm.bmp'),
(1669, 'catalog/a7esm.jpeg', 1, 'real/catalog/a7esm.jpeg'),
(1670, 'catalog/525k17sm.jpeg', 1, 'real/catalog/525k17sm.jpeg'),
(1671, 'catalog/ep_gor_klen_sm.bmp', 1, 'real/catalog/ep_gor_klen_sm.bmp'),
(1677, 'catalog/ep_gor_belaya_sm.bmp', 1, 'real/catalog/ep_gor_belaya_sm.bmp'),
(1678, 'catalog/ep_belaya_sm.bmp', 1, 'real/catalog/ep_belaya_sm.bmp'),
(1679, 'catalog/ep_vishnya_sm.jpg', 1, 'real/catalog/ep_vishnya_sm.jpg'),
(1680, 'catalog/ep_granit_sm.bmp', 1, 'real/catalog/ep_granit_sm.bmp'),
(1681, 'catalog/ep_klen_sm.bmp', 1, 'real/catalog/ep_klen_sm.bmp'),
(1682, 'catalog/ep_krem_sm.bmp', 1, 'real/catalog/ep_krem_sm.bmp'),
(1684, 'catalog/108sm.jpg', 1, 'real/catalog/108sm.jpg'),
(1685, 'catalog/832sm.jpg', 1, 'real/catalog/832sm.jpg'),
(1686, 'catalog/vstavAsm.gif', 1, 'real/catalog/vstavAsm.gif'),
(1687, 'catalog/f113sm.jpg', 1, 'real/catalog/f113sm.jpg'),
(1688, 'catalog/pp1_prozra4naya_sm.bmp', 1, 'real/catalog/pp1_prozra4naya_sm.bmp'),
(1689, 'catalog/swhsm.jpeg', 1, 'real/catalog/swhsm.jpeg'),
(1691, 'catalog/f106sm.jpeg', 1, 'real/catalog/f106sm.jpeg'),
(1706, 'catalog/ms13sm.jpeg', 1, 'real/catalog/ms13sm.jpeg'),
(1707, 'catalog/ms14sm.jpeg', 1, 'real/catalog/ms14sm.jpeg'),
(1708, 'catalog/ms18sm.gif', 1, 'real/catalog/ms18sm.gif'),
(1709, 'catalog/ms19sm.gif', 1, 'real/catalog/ms19sm.gif'),
(1710, 'catalog/ms20sm.gif', 1, 'real/catalog/ms20sm.gif'),
(1722, 'catalog/ms12sm.JPG', 1, 'real/catalog/ms12sm.JPG'),
(1724, 'catalog/reshsm.gif', 1, 'real/catalog/reshsm.gif'),
(1725, 'catalog/ms39sm.jpg', 1, 'real/catalog/ms39sm.jpg'),
(1726, 'catalog/gw770sm.gif', 1, 'real/catalog/gw770sm.gif'),
(1735, 'catalog/tz289(ch)sm.JPG', 1, 'real/catalog/tz289(ch)sm.JPG'),
(1741, 'catalog/tz289sm.jpeg', 1, 'real/catalog/tz289sm.jpeg'),
(1744, 'catalog/tz301sm.gif', 1, 'real/catalog/tz301sm.gif'),
(1749, 'catalog/KP707sm.jpeg', 1, 'real/catalog/KP707sm.jpeg'),
(1750, 'catalog/tz106_10sm.JPG', 1, 'real/catalog/tz106_10sm.JPG'),
(1751, 'catalog/tz106sm.jpeg', 1, 'real/catalog/tz106sm.jpeg'),
(1752, 'catalog/tz105sm.jpeg', 1, 'real/catalog/tz105sm.jpeg'),
(1753, 'catalog/tz110sm.jpeg', 1, 'real/catalog/tz110sm.jpeg'),
(1754, 'catalog/18101.gif', 1, 'real/catalog/18101.gif'),
(1755, 'catalog/18115sm.gif', 1, 'real/catalog/18115sm.gif'),
(1756, 'catalog/18116sm.jpeg', 1, 'real/catalog/18116sm.jpeg'),
(1757, 'catalog/001sm.jpg', 1, 'real/catalog/001sm.jpg'),
(1758, 'catalog/for_oboism.jpg', 1, 'real/catalog/for_oboism.jpg'),
(1759, 'catalog/buk_sm.jpg', 1, 'real/catalog/buk_sm.jpg'),
(1762, 'catalog/vstavka_chernaya_sm.bmp', 1, 'real/catalog/vstavka_chernaya_sm.bmp'),
(1763, 'catalog/vstavka_sinyaya_sm.bmp', 1, 'real/catalog/vstavka_sinyaya_sm.bmp'),
(1764, 'catalog/vstavka_seraya_sm.bmp', 1, 'real/catalog/vstavka_seraya_sm.bmp'),
(1765, 'catalog/vstavka_krasnaya_sm.bmp', 1, 'real/catalog/vstavka_krasnaya_sm.bmp'),
(1766, 'catalog/vstavka_korichnevaya_sm.bmp', 1, 'real/catalog/vstavka_korichnevaya_sm.bmp'),
(1768, 'catalog/vstavka_bejevaya_sm.bmp', 1, 'real/catalog/vstavka_bejevaya_sm.bmp'),
(1769, 'catalog/vstavka_belaya_sm.bmp', 1, 'real/catalog/vstavka_belaya_sm.bmp'),
(1770, 'catalog/f114sm.gif', 1, 'real/catalog/f114sm.gif'),
(1771, 'catalog/fm_kruchek_sm.bmp', 1, 'real/catalog/fm_kruchek_sm.bmp'),
(1773, 'catalog/L-obraznaya_sm.bmp', 1, 'real/catalog/L-obraznaya_sm.bmp'),
(1774, 'catalog/f300sm.jpeg', 1, 'real/catalog/f300sm.jpeg'),
(1775, 'catalog/18201sm.jpeg', 1, 'real/catalog/18201sm.jpeg'),
(1776, 'catalog/18206sm.jpeg', 1, 'real/catalog/18206sm.jpeg'),
(1777, 'catalog/FBC_shag_sm.bmp', 1, 'real/catalog/FBC_shag_sm.bmp'),
(1781, 'catalog/Polkoder_kit_sm.bmp', 1, 'real/catalog/Polkoder_kit_sm.bmp'),
(1783, 'catalog/Polkoder_usil_sm.bmp', 1, 'real/catalog/Polkoder_usil_sm.bmp'),
(1784, 'catalog/f194sm.gif', 1, 'real/catalog/f194sm.gif'),
(1785, 'catalog/polka_s_cennikom_sm.jpg', 1, 'real/catalog/polka_s_cennikom_sm.jpg'),
(1786, 'catalog/dlya_obuv_1200_sm.bmp', 1, 'real/catalog/dlya_obuv_1200_sm.bmp'),
(1787, 'catalog/f96c_sm.bmp', 1, 'real/catalog/f96c_sm.bmp'),
(1788, 'catalog/f95c_sm.bmp', 1, 'real/catalog/f95c_sm.bmp'),
(1789, 'catalog/f94c_sm.bmp', 1, 'real/catalog/f94c_sm.bmp'),
(1790, 'catalog/f93c_sm.bmp', 1, 'real/catalog/f93c_sm.bmp'),
(1791, 'catalog/f290sm.jpeg', 1, 'real/catalog/f290sm.jpeg'),
(1792, 'catalog/gusak_ep_sm.bmp', 1, 'real/catalog/gusak_ep_sm.bmp'),
(1793, 'catalog/zigzag_ep_sm.bmp', 1, 'real/catalog/zigzag_ep_sm.bmp'),
(1794, 'catalog/kr_12_shar_ep_sm.bmp', 1, 'real/catalog/kr_12_shar_ep_sm.bmp'),
(1795, 'catalog/kr_viemki_ep_sm.bmp', 1, 'real/catalog/kr_viemki_ep_sm.bmp'),
(1796, 'catalog/40x27_sm.jpg', 1, 'real/catalog/40x27_sm.jpg'),
(1797, 'catalog/14shtirei350_ep_sm.bmp', 1, 'real/catalog/14shtirei350_ep_sm.bmp'),
(1798, 'catalog/002_sm.bmp', 1, 'real/catalog/002_sm.bmp'),
(1799, 'catalog/003_sm.bmp', 1, 'real/catalog/003_sm.bmp'),
(1800, 'catalog/004_sm.bmp', 1, 'real/catalog/004_sm.bmp'),
(1801, 'catalog/005_sm.bmp', 1, 'real/catalog/005_sm.bmp'),
(1802, 'catalog/007_sm.bmp', 1, 'real/catalog/007_sm.bmp'),
(1803, 'catalog/008_sm.bmp', 1, 'real/catalog/008_sm.bmp'),
(1804, 'catalog/6_krukov_sm.bmp', 1, 'real/catalog/6_krukov_sm.bmp'),
(1805, 'catalog/5_krukov_sm.bmp', 1, 'real/catalog/5_krukov_sm.bmp'),
(1806, 'catalog/009_sm.bmp', 1, 'real/catalog/009_sm.bmp'),
(1807, 'catalog/010_sm.bmp', 1, 'real/catalog/010_sm.bmp'),
(1808, 'catalog/for_ball_sm.bmp', 1, 'real/catalog/for_ball_sm.bmp'),
(1809, 'catalog/for_baseball_sm.bmp', 1, 'real/catalog/for_baseball_sm.bmp'),
(1810, 'catalog/for_head1_sm.bmp', 1, 'real/catalog/for_head1_sm.bmp'),
(1811, 'catalog/for_head_sm.bmp', 1, 'real/catalog/for_head_sm.bmp'),
(1812, 'catalog/for_head2_sm.bmp', 1, 'real/catalog/for_head2_sm.bmp'),
(1813, 'catalog/011sm.bmp', 1, 'real/catalog/011sm.bmp'),
(1814, 'catalog/012sm.bmp', 1, 'real/catalog/012sm.bmp'),
(1818, 'catalog/reshetka_bel-ser_sm.bmp', 1, 'real/catalog/reshetka_bel-ser_sm.bmp'),
(1821, 'catalog/reshetka_cink_sm.bmp', 1, 'real/catalog/reshetka_cink_sm.bmp'),
(1822, 'catalog/reshetka_panel_sm.bmp', 1, 'real/catalog/reshetka_panel_sm.bmp'),
(1823, 'catalog/krep_reshetki_sm.bmp', 1, 'real/catalog/krep_reshetki_sm.bmp'),
(1824, 'catalog/opora_komplekt_sm.bmp', 1, 'real/catalog/opora_komplekt_sm.bmp'),
(1825, 'catalog/GW 11_sm.bmp', 1, 'real/catalog/GW 11_sm.bmp'),
(1826, 'catalog/tz_9shtirei_sm.bmp', 1, 'real/catalog/tz_9shtirei_sm.bmp'),
(1827, 'catalog/tz_001_sm.bmp', 1, 'real/catalog/tz_001_sm.bmp'),
(1828, 'catalog/tz_7shar_kv_sm.bmp', 1, 'real/catalog/tz_7shar_kv_sm.bmp'),
(1829, 'catalog/tz_9shtir_pr_sm.bmp', 1, 'real/catalog/tz_9shtir_pr_sm.bmp'),
(1830, 'catalog/tz_12_viemok_sm.bmp', 1, 'real/catalog/tz_12_viemok_sm.bmp'),
(1833, 'catalog/tz_polka1_sm.bmp', 1, 'real/catalog/tz_polka1_sm.bmp'),
(1834, 'catalog/tz_9sharik01_sm.bmp', 1, 'real/catalog/tz_9sharik01_sm.bmp'),
(1835, 'catalog/tz_zigzag_sm.bmp', 1, 'real/catalog/tz_zigzag_sm.bmp'),
(1836, 'catalog/tz_6krukov_sm.bmp', 1, 'real/catalog/tz_6krukov_sm.bmp'),
(1837, 'catalog/tz_14stirei_sm.bmp', 1, 'real/catalog/tz_14stirei_sm.bmp'),
(1838, 'catalog/tz_5sharikov_sm.bmp', 1, 'real/catalog/tz_5sharikov_sm.bmp'),
(1839, 'catalog/tz_7sharikov_izogn_sm.bmp', 1, 'real/catalog/tz_7sharikov_izogn_sm.bmp'),
(1840, 'catalog/tz_forhead_sm.bmp', 1, 'real/catalog/tz_forhead_sm.bmp'),
(1841, 'catalog/tz_r6_sm.bmp', 1, 'real/catalog/tz_r6_sm.bmp'),
(1842, 'catalog/tz_114_sm.bmp', 1, 'real/catalog/tz_114_sm.bmp'),
(1843, 'catalog/for_snow_sm.bmp', 1, 'real/catalog/for_snow_sm.bmp'),
(1844, 'catalog/tz_polka2_sm.bmp', 1, 'real/catalog/tz_polka2_sm.bmp'),
(1845, 'catalog/ms_gusak_sm.bmp', 1, 'real/catalog/ms_gusak_sm.bmp'),
(1846, 'catalog/44003_sm.gif', 1, 'real/catalog/44003_sm.gif'),
(1847, 'catalog/g2039_sm.gif', 1, 'real/catalog/g2039_sm.gif'),
(1848, 'catalog/st87_sm.jpeg', 1, 'real/catalog/st87_sm.jpeg'),
(1849, 'catalog/st88_sm.jpeg', 1, 'real/catalog/st88_sm.jpeg'),
(1850, 'catalog/nakopit_s_cennikom_sm.jpeg', 1, 'real/catalog/nakopit_s_cennikom_sm.jpeg'),
(1851, 'catalog/aswk30_sm.jpeg', 1, 'real/catalog/aswk30_sm.jpeg'),
(1852, 'catalog/a24-10_sm.jpeg', 1, 'real/catalog/a24-10_sm.jpeg'),
(1853, 'catalog/a24-15_sm.jpeg', 1, 'real/catalog/a24-15_sm.jpeg'),
(1855, 'catalog/a33_sm.jpeg', 1, 'real/catalog/a33_sm.jpeg'),
(1857, 'catalog/a4_sm.jpeg', 1, 'real/catalog/a4_sm.jpeg'),
(1858, 'catalog/a7k_sm.jpeg', 1, 'real/catalog/a7k_sm.jpeg'),
(1860, 'catalog/k010_sm.jpeg', 1, 'real/catalog/k010_sm.jpeg'),
(1863, 'catalog/tk3_sm.jpeg', 1, 'real/catalog/tk3_sm.jpeg'),
(1864, 'catalog/k010s_sm.gif', 1, 'real/catalog/k010s_sm.gif'),
(1865, 'catalog/solnishko_sm.jpeg', 1, 'real/catalog/solnishko_sm.jpeg'),
(1866, 'catalog/rotonat_sm.jpeg', 1, 'real/catalog/rotonat_sm.jpeg'),
(1867, 'catalog/k011_sm.jpeg', 1, 'real/catalog/k011_sm.jpeg'),
(1868, 'catalog/aa36_sm.jpeg', 1, 'real/catalog/aa36_sm.jpeg'),
(1869, 'catalog/az8_sm.jpeg', 1, 'real/catalog/az8_sm.jpeg'),
(1871, 'catalog/tc197_sm.jpeg', 1, 'real/catalog/tc197_sm.jpeg'),
(1872, 'catalog/tc357_sm.jpeg', 1, 'real/catalog/tc357_sm.jpeg'),
(1873, 'catalog/Rokita_sm.gif', 1, 'real/catalog/Rokita_sm.gif'),
(1874, 'catalog/Rokita_w_sm.jpg', 1, 'real/catalog/Rokita_w_sm.jpg'),
(1875, 'catalog/e001_sm.jpeg', 1, 'real/catalog/e001_sm.jpeg'),
(1879, 'catalog/Telejka_klo-a_sm.jpeg', 1, 'real/catalog/Telejka_klo-a_sm.jpeg'),
(1880, 'catalog/Performance tip21 women(a).jpg', 1, 'real/catalog/Performance tip21 women(a).jpg'),
(1881, 'catalog/Performance tip21 women blace(a).jpg', 1, 'real/catalog/Performance tip21 women blace(a).jpg'),
(1882, 'catalog/Gioellosecondo 1a.jpg', 1, 'real/catalog/Gioellosecondo 1a.jpg'),
(1883, 'catalog/GIOELLOSECONDO 2(a).jpg', 1, 'real/catalog/GIOELLOSECONDO 2(a).jpg'),
(1884, 'catalog/Bu9450(a).jpg', 1, 'real/catalog/Bu9450(a).jpg'),
(1885, 'catalog/Bu9460(a).jpg', 1, 'real/catalog/Bu9460(a).jpg'),
(1886, 'catalog/obzor_sm.jpeg', 1, 'real/catalog/obzor_sm.jpeg'),
(1887, 'catalog/zaglushka_sm.gif', 1, 'real/catalog/zaglushka_sm.gif'),
(1888, 'catalog/profile_sm.gif', 1, 'real/catalog/profile_sm.gif'),
(1889, 'catalog/p-obraz_sm.gif', 1, 'real/catalog/p-obraz_sm.gif'),
(1890, 'catalog/g-obraz_sm.gif', 1, 'real/catalog/g-obraz_sm.gif'),
(1891, 'catalog/st010r_sm.jpeg', 1, 'real/catalog/st010r_sm.jpeg'),
(1892, 'catalog/st030_sm.jpeg', 1, 'real/catalog/st030_sm.jpeg'),
(1893, 'catalog/st036_sm.gif', 1, 'real/catalog/st036_sm.gif'),
(1894, 'catalog/st050_sm.jpeg', 1, 'real/catalog/st050_sm.jpeg'),
(1895, 'catalog/st070_sm.jpeg', 1, 'real/catalog/st070_sm.jpeg'),
(1896, 'catalog/st011_sm.jpeg', 1, 'real/catalog/st011_sm.jpeg'),
(1897, 'catalog/Polukrug_sm.jpeg', 1, 'real/catalog/Polukrug_sm.jpeg'),
(1898, 'catalog/1-003_sm.jpeg', 1, 'real/catalog/1-003_sm.jpeg'),
(1899, 'catalog/1-008_sm.jpeg', 1, 'real/catalog/1-008_sm.jpeg'),
(1900, 'catalog/175_sec_sm.jpeg', 1, 'real/catalog/175_sec_sm.jpeg'),
(1901, 'catalog/ky158g_sm.jpeg', 1, 'real/catalog/ky158g_sm.jpeg'),
(1902, 'catalog/ky160A_sm.jpeg', 1, 'real/catalog/ky160A_sm.jpeg'),
(1903, 'catalog/ky159d_sm.jpeg', 1, 'real/catalog/ky159d_sm.jpeg'),
(1904, 'catalog/ky2-007_sm.jpg', 1, 'real/catalog/ky2-007_sm.jpg'),
(1905, 'catalog/mq74s_sm.jpeg', 1, 'real/catalog/mq74s_sm.jpeg'),
(1906, 'catalog/mq74c_sm.jpeg', 1, 'real/catalog/mq74c_sm.jpeg'),
(1907, 'catalog/3-014_sm.jpeg', 1, 'real/catalog/3-014_sm.jpeg'),
(1908, 'catalog/3-015_sm.jpeg', 1, 'real/catalog/3-015_sm.jpeg'),
(1909, 'catalog/3-042_sm.jpeg', 1, 'real/catalog/3-042_sm.jpeg'),
(1910, 'catalog/hda-211_sm.jpg', 1, 'real/catalog/hda-211_sm.jpg'),
(1916, 'catalog/at40_sm.jpeg', 1, 'real/catalog/at40_sm.jpeg'),
(1917, 'catalog/at40(s_ptrekladinoi)_sm.jpeg', 1, 'real/catalog/at40(s_ptrekladinoi)_sm.jpeg'),
(1919, 'catalog/ec38_sm.jpeg', 1, 'real/catalog/ec38_sm.jpeg'),
(2801, 'banners/image-2801.gif', 4, 'real/banners/image-2801.gif'),
(1926, 'catalog/cl42_sm.jpeg', 1, 'real/catalog/cl42_sm.jpeg'),
(1933, 'catalog/razmernik_sm.jpeg', 1, 'real/catalog/razmernik_sm.jpeg'),
(1934, 'catalog/siluet_jenskiy_sm.jpg', 1, 'real/catalog/siluet_jenskiy_sm.jpg'),
(1937, 'catalog/balka_sm.bmp', 1, 'real/catalog/balka_sm.bmp'),
(1938, 'catalog/zadnaya_stenka_sm.bmp', 1, 'real/catalog/zadnaya_stenka_sm.bmp'),
(1939, 'catalog/zadnaya_stenka_500_sm.bmp', 1, 'real/catalog/zadnaya_stenka_500_sm.bmp'),
(1940, 'catalog/zadnaya_st_perf_500_sm.bmp', 1, 'real/catalog/zadnaya_st_perf_500_sm.bmp'),
(1941, 'catalog/zadnaya_st_perf_sm.bmp', 1, 'real/catalog/zadnaya_st_perf_sm.bmp'),
(1942, 'catalog/zadnaya_stenka_ugl_sm.bmp', 1, 'real/catalog/zadnaya_stenka_ugl_sm.bmp'),
(1943, 'catalog/zadnaya_st_perf_ugl_sm.bmp', 1, 'real/catalog/zadnaya_st_perf_ugl_sm.bmp'),
(1946, 'catalog/Kronshtein_sm.bmp', 1, 'real/catalog/Kronshtein_sm.bmp'),
(1947, 'catalog/opora_sm.bmp', 1, 'real/catalog/opora_sm.bmp'),
(1948, 'catalog/plintus1000_sm.bmp', 1, 'real/catalog/plintus1000_sm.bmp'),
(1949, 'catalog/plintus500_sm.bmp', 1, 'real/catalog/plintus500_sm.bmp'),
(1950, 'catalog/plintus_vnesh_ugl_sm.bmp', 1, 'real/catalog/plintus_vnesh_ugl_sm.bmp'),
(1951, 'catalog/pluntus_vnutr_ugl_sm.bmp', 1, 'real/catalog/pluntus_vnutr_ugl_sm.bmp'),
(1952, 'catalog/shrm14_sm.jpg', 1, 'real/catalog/shrm14_sm.jpg'),
(1953, 'catalog/shrm28_sm.jpg', 1, 'real/catalog/shrm28_sm.jpg'),
(1955, 'catalog/aptechka02.jpg', 1, 'real/catalog/aptechka02.jpg'),
(1956, 'catalog/kp-3_sm.jpg', 1, 'real/catalog/kp-3_sm.jpg'),
(1957, 'catalog/ds_23_e_sm.jpg', 1, 'real/catalog/ds_23_e_sm.jpg'),
(1958, 'catalog/sd_101_t_sm.jpg', 1, 'real/catalog/sd_101_t_sm.jpg'),
(1959, 'catalog/sd_103_sm.jpg', 1, 'real/catalog/sd_103_sm.jpg'),
(1962, 'catalog/sft_30_ea_sm.jpg', 1, 'real/catalog/sft_30_ea_sm.jpg'),
(1963, 'catalog/sft_20_en_sm.jpg', 1, 'real/catalog/sft_20_en_sm.jpg'),
(1964, 'catalog/4000-11_sm.jpeg', 1, 'real/catalog/4000-11_sm.jpeg'),
(1965, 'catalog/4000-14_sm.jpeg', 1, 'real/catalog/4000-14_sm.jpeg'),
(1966, 'catalog/4000-16_sm.jpeg', 1, 'real/catalog/4000-16_sm.jpeg'),
(1967, 'catalog/4000-17_sm.jpeg', 1, 'real/catalog/4000-17_sm.jpeg'),
(1968, 'catalog/4000-18_sm.jpeg', 1, 'real/catalog/4000-18_sm.jpeg'),
(1969, 'catalog/4000-19_sm.jpeg', 1, 'real/catalog/4000-19_sm.jpeg'),
(1970, 'catalog/gs860_sm.jpeg', 1, 'real/catalog/gs860_sm.jpeg'),
(1971, 'catalog/gs861_sm.jpeg', 1, 'real/catalog/gs861_sm.jpeg'),
(1972, 'catalog/gs998_sm.jpeg', 1, 'real/catalog/gs998_sm.jpeg'),
(1973, 'catalog/ygr212_sm.gif', 1, 'real/catalog/ygr212_sm.gif'),
(1974, 'catalog/j077(Kit)L.jpeg', 1, 'real/catalog/j077(Kit)L.jpeg'),
(1975, 'catalog/j041(Kit)L.jpeg', 1, 'real/catalog/j041(Kit)L.jpeg'),
(1976, 'catalog/p16_sm.JPG', 1, 'real/catalog/p16_sm.JPG'),
(1977, 'catalog/maierelectr.gmp202.jpg', 1, 'real/catalog/maierelectr.gmp202.jpg'),
(1978, 'catalog/maierelectr.gma205.jpg', 1, 'real/catalog/maierelectr.gma205.jpg'),
(1979, 'catalog/c4_b(a).jpg', 1, 'real/catalog/c4_b(a).jpg'),
(1980, 'catalog/P1010129_b(a).jpg', 1, 'real/catalog/P1010129_b(a).jpg'),
(1981, 'catalog/P1010128_b(a).jpg', 1, 'real/catalog/P1010128_b(a).jpg'),
(1982, 'catalog/d29(a).jpg', 1, 'real/catalog/d29(a).jpg'),
(1983, 'catalog/d28(a).jpg', 1, 'real/catalog/d28(a).jpg'),
(1984, 'catalog/maniken_malish_na_kolenyah(a).jpg', 1, 'real/catalog/maniken_malish_na_kolenyah(a).jpg'),
(1985, 'catalog/P1010126_(a).jpg', 1, 'real/catalog/P1010126_(a).jpg'),
(1986, 'catalog/maniken_b18(a).jpg', 1, 'real/catalog/maniken_b18(a).jpg'),
(1987, 'catalog/3004d_sm.jpeg', 1, 'real/catalog/3004d_sm.jpeg'),
(1988, 'catalog/hd-h114_sm.jpeg', 1, 'real/catalog/hd-h114_sm.jpeg'),
(1989, 'catalog/pl210_green_sm.gif', 1, 'real/catalog/pl210_green_sm.gif'),
(1990, 'catalog/pl210_red_sm.jpeg', 1, 'real/catalog/pl210_red_sm.jpeg'),
(1991, 'catalog/pl210_blue_sm.jpeg', 1, 'real/catalog/pl210_blue_sm.jpeg'),
(1992, 'catalog/pl318_green_sm.jpeg', 1, 'real/catalog/pl318_green_sm.jpeg'),
(1993, 'catalog/pl318_red_sm.jpeg', 1, 'real/catalog/pl318_red_sm.jpeg'),
(1994, 'catalog/pl318_blue_sm.jpeg', 1, 'real/catalog/pl318_blue_sm.jpeg'),
(1995, 'catalog/hd-c117_sm.jpeg', 1, 'real/catalog/hd-c117_sm.jpeg'),
(1996, 'catalog/Jok_zerkalo_s_polkoi_sm.bmp', 1, 'real/catalog/Jok_zerkalo_s_polkoi_sm.bmp'),
(1997, 'catalog/primo018(It)L.jpeg', 1, 'real/catalog/primo018(It)L.jpeg'),
(1999, 'catalog/ugolok_arch_sm.bmp', 1, 'real/catalog/ugolok_arch_sm.bmp'),
(2000, 'catalog/svyazka_archiv_sm.bmp', 1, 'real/catalog/svyazka_archiv_sm.bmp'),
(2003, 'catalog/polka_vod_450x100_sm.bmp', 1, 'real/catalog/polka_vod_450x100_sm.bmp'),
(2010, 'catalog/uglovaya_polka_sm.bmp', 1, 'real/catalog/uglovaya_polka_sm.bmp'),
(2011, 'catalog/f227_sm.bmp', 1, 'real/catalog/f227_sm.bmp'),
(2012, 'catalog/f321c_sm.bmp', 1, 'real/catalog/f321c_sm.bmp'),
(2035, 'catalog/dvoinoi_kru4ek_sm.bmp', 1, 'real/catalog/dvoinoi_kru4ek_sm.bmp'),
(2036, 'catalog/kru4ek_perf_sm.bmp', 1, 'real/catalog/kru4ek_perf_sm.bmp'),
(2038, 'catalog/s342_t_sm.bmp', 1, 'real/catalog/s342_t_sm.bmp'),
(2040, 'catalog/gruz_stell002_sm.jpg', 1, 'real/catalog/gruz_stell002_sm.jpg'),
(2042, 'catalog/gruz_stell003_sm.jpg', 1, 'real/catalog/gruz_stell003_sm.jpg'),
(2043, 'catalog/polka500x300_sm.bmp', 1, 'real/catalog/polka500x300_sm.bmp'),
(2044, 'catalog/polka500x400_sm.bmp', 1, 'real/catalog/polka500x400_sm.bmp'),
(2045, 'catalog/polka1000x300_sm.bmp', 1, 'real/catalog/polka1000x300_sm.bmp'),
(2046, 'catalog/polka1000x400_sm.bmp', 1, 'real/catalog/polka1000x400_sm.bmp'),
(2047, 'catalog/vodoley_1000_kom_sm.jpg', 1, 'real/catalog/vodoley_1000_kom_sm.jpg'),
(2048, 'catalog/vodoley_500_kom_sm.jpg', 1, 'real/catalog/vodoley_500_kom_sm.jpg'),
(2050, 'catalog/uglovoi_kom(vnutr)_sm.jpg', 1, 'real/catalog/uglovoi_kom(vnutr)_sm.jpg'),
(2051, 'catalog/dopolnit_balka_sm.bmp', 1, 'real/catalog/dopolnit_balka_sm.bmp'),
(2052, 'catalog/dopolnit_balka_ostrov_sm.bmp', 1, 'real/catalog/dopolnit_balka_ostrov_sm.bmp'),
(2053, 'catalog/perf_stell001_sm.jpg', 1, 'real/catalog/perf_stell001_sm.jpg'),
(2054, 'catalog/kompl_vnytren_polka_sm.bmp', 1, 'real/catalog/kompl_vnytren_polka_sm.bmp'),
(2055, 'catalog/ostrovnoi_sm.bmp', 1, 'real/catalog/ostrovnoi_sm.bmp'),
(2056, 'catalog/vnesh_ugl_stell_sm.bmp', 1, 'real/catalog/vnesh_ugl_stell_sm.bmp'),
(2057, 'catalog/left(L).jpeg', 1, 'real/catalog/left(L).jpeg'),
(2058, 'catalog/rigte(L).jpeg', 1, 'real/catalog/rigte(L).jpeg'),
(2059, 'catalog/PervSbore(L).gif', 1, 'real/catalog/PervSbore(L).gif'),
(2060, 'catalog/pole1(L).gif', 1, 'real/catalog/pole1(L).gif'),
(2061, 'catalog/pole2(L).gif', 1, 'real/catalog/pole2(L).gif'),
(2062, 'catalog/pole3(L).gif', 1, 'real/catalog/pole3(L).gif'),
(2063, 'catalog/poleT(L).gif', 1, 'real/catalog/poleT(L).gif'),
(2064, 'catalog/myfta_kreplenie_trybu(L).jpeg', 1, 'real/catalog/myfta_kreplenie_trybu(L).jpeg'),
(2065, 'catalog/Avtomatik_vorota(L).jpeg', 1, 'real/catalog/Avtomatik_vorota(L).jpeg'),
(2066, 'catalog/Avtomatik_vorota1(L).jpeg', 1, 'real/catalog/Avtomatik_vorota1(L).jpeg'),
(2067, 'catalog/Ogranichitel(L).jpeg', 1, 'real/catalog/Ogranichitel(L).jpeg'),
(2068, 'catalog/Vorota_dli_telegek(L).jpeg', 1, 'real/catalog/Vorota_dli_telegek(L).jpeg'),
(2069, 'catalog/Vorota_dli_telegek1(L).jpeg', 1, 'real/catalog/Vorota_dli_telegek1(L).jpeg'),
(2070, 'catalog/Igla_MTX-05R(L).jpeg', 1, 'real/catalog/Igla_MTX-05R(L).jpeg'),
(2071, 'catalog/Igolchetui_pistolet_MTX-05R(L).jpeg', 1, 'real/catalog/Igolchetui_pistolet_MTX-05R(L).jpeg'),
(2072, 'catalog/Kreplenie_etiketok(L).jpeg', 1, 'real/catalog/Kreplenie_etiketok(L).jpeg'),
(2073, 'catalog/Katridge_ot_MX (L).jpeg', 1, 'real/catalog/Katridge_ot_MX (L).jpeg'),
(2074, 'catalog/Motex-10 (L).jpeg', 1, 'real/catalog/Motex-10 (L).jpeg'),
(2075, 'catalog/Motex-8 (L).jpeg', 1, 'real/catalog/Motex-8 (L).jpeg'),
(2076, 'catalog/Lenta(L).jpeg', 1, 'real/catalog/Lenta(L).jpeg'),
(2077, 'catalog/Vitrina8200(a).bmp', 1, 'real/catalog/Vitrina8200(a).bmp'),
(2078, 'catalog/Vitrina5750(a).bmp', 1, 'real/catalog/Vitrina5750(a).bmp'),
(2079, 'catalog/Vitrina8200 dverki podsvetka(a).bmp', 1, 'real/catalog/Vitrina8200 dverki podsvetka(a).bmp'),
(2080, 'catalog/Vitrina7350(a).bmp', 1, 'real/catalog/Vitrina7350(a).bmp'),
(2081, 'catalog/Vitrina6500(a).bmp', 1, 'real/catalog/Vitrina6500(a).bmp'),
(2082, 'catalog/Vitrina9250(a).bmp', 1, 'real/catalog/Vitrina9250(a).bmp'),
(2083, 'catalog/Vitrina Prilavok(a).bmp', 1, 'real/catalog/Vitrina Prilavok(a).bmp'),
(2084, 'catalog/polka_dlya_295(a).bmp', 1, 'real/catalog/polka_dlya_295(a).bmp'),
(2085, 'catalog/polka_dlya_330(a).bmp', 1, 'real/catalog/polka_dlya_330(a).bmp'),
(2086, 'catalog/jok_2x_poloznoe_sm.bmp', 1, 'real/catalog/jok_2x_poloznoe_sm.bmp'),
(2087, 'catalog/jok_odnopoloz_na_koles_sm.bmp', 1, 'real/catalog/jok_odnopoloz_na_koles_sm.bmp'),
(2088, 'catalog/jok_odnopoloznoe_sm.bmp', 1, 'real/catalog/jok_odnopoloznoe_sm.bmp'),
(2089, 'catalog/jok_2x_poloz_2_radiusa_sm.bmp', 1, 'real/catalog/jok_2x_poloz_2_radiusa_sm.bmp'),
(2090, 'catalog/Veshalo_primo_sm.bmp', 1, 'real/catalog/Veshalo_primo_sm.bmp'),
(2091, 'catalog/zerkalo_002_sm.bmp', 1, 'real/catalog/zerkalo_002_sm.bmp'),
(2092, 'catalog/Rogoza_sm.jpeg', 1, 'real/catalog/Rogoza_sm.jpeg'),
(2097, 'catalog/lesenka_3sm.jpeg', 1, 'real/catalog/lesenka_3sm.jpeg'),
(2098, 'catalog/lesenka_5_sm.jpeg', 1, 'real/catalog/lesenka_5_sm.jpeg'),
(2099, 'catalog/sot_telephon_sm.jpg', 1, 'real/catalog/sot_telephon_sm.jpg'),
(2100, 'catalog/monetnizza_sm.jpg', 1, 'real/catalog/monetnizza_sm.jpg'),
(2105, 'catalog/cennik_tip_sm.jpeg', 1, 'real/catalog/cennik_tip_sm.jpeg'),
(2106, 'catalog/ugolok_120_sm.jpeg', 1, 'real/catalog/ugolok_120_sm.jpeg'),
(2107, 'catalog/pl_11_sm.jpg', 1, 'real/catalog/pl_11_sm.jpg'),
(2108, 'catalog/pl_16_sm.jpg', 1, 'real/catalog/pl_16_sm.jpg'),
(2109, 'catalog/pl_24_sm.jpg', 1, 'real/catalog/pl_24_sm.jpg'),
(2110, 'catalog/pl_25_sm.jpg', 1, 'real/catalog/pl_25_sm.jpg'),
(2111, 'catalog/pl_26_sm.jpg', 1, 'real/catalog/pl_26_sm.jpg'),
(2112, 'catalog/pl_27_sm.jpg', 1, 'real/catalog/pl_27_sm.jpg'),
(2113, 'catalog/pl_28_sm.jpg', 1, 'real/catalog/pl_28_sm.jpg'),
(2114, 'catalog/pl_46_sm.jpg', 1, 'real/catalog/pl_46_sm.jpg'),
(2115, 'catalog/pl_47_sm.jpg', 1, 'real/catalog/pl_47_sm.jpg'),
(2116, 'catalog/pl_55_sm.jpg', 1, 'real/catalog/pl_55_sm.jpg'),
(2117, 'catalog/zakladnaya_sm.bmp', 1, 'real/catalog/zakladnaya_sm.bmp'),
(2118, 'catalog/verhushka_balyas_sm.bmp', 1, 'real/catalog/verhushka_balyas_sm.bmp'),
(2119, 'catalog/pl_derj_trub_sm.bmp', 1, 'real/catalog/pl_derj_trub_sm.bmp'),
(2120, 'catalog/pl_kons_litaya_sm.bmp', 1, 'real/catalog/pl_kons_litaya_sm.bmp'),
(2121, 'catalog/pl_kons_prost_sm.bmp', 1, 'real/catalog/pl_kons_prost_sm.bmp'),
(2122, 'catalog/pl_kons_raspor_sm.bmp', 1, 'real/catalog/pl_kons_raspor_sm.bmp'),
(2123, 'catalog/pl_ubka_prost_sm.bmp', 1, 'real/catalog/pl_ubka_prost_sm.bmp'),
(2124, 'catalog/pl_th_dist_derj_sm.bmp', 1, 'real/catalog/pl_th_dist_derj_sm.bmp'),
(2125, 'catalog/zaglushka_vnutr_pl_sm.bmp', 1, 'real/catalog/zaglushka_vnutr_pl_sm.bmp'),
(2126, 'catalog/zaglushka_kolp_pl_sm.bmp', 1, 'real/catalog/zaglushka_kolp_pl_sm.bmp'),
(2127, 'catalog/zaglushka_kit_sm.bmp', 1, 'real/catalog/zaglushka_kit_sm.bmp'),
(2128, 'catalog/Pl7_sm.bmp', 1, 'real/catalog/Pl7_sm.bmp'),
(2129, 'catalog/pl_otvod_sm.bmp', 1, 'real/catalog/pl_otvod_sm.bmp'),
(2130, 'catalog/pl_soedin2tr_sm.bmp', 1, 'real/catalog/pl_soedin2tr_sm.bmp'),
(2131, 'catalog/pl_soed3tr_sm.bmp', 1, 'real/catalog/pl_soed3tr_sm.bmp'),
(2132, 'catalog/pl_udlin_sm.bmp', 1, 'real/catalog/pl_udlin_sm.bmp'),
(2133, 'catalog/pl_th05_sm.jpg', 1, 'real/catalog/pl_th05_sm.jpg'),
(2134, 'catalog/pl_ubka_na_zakl_sm.bmp', 1, 'real/catalog/pl_ubka_na_zakl_sm.bmp'),
(2135, 'catalog/ple4_pl_40.jpg', 1, 'real/catalog/ple4_pl_40.jpg'),
(2138, 'catalog/vod_polka_vnesh_sm.bmp', 1, 'real/catalog/vod_polka_vnesh_sm.bmp'),
(2139, 'catalog/qm-b_sm.jpeg', 1, 'real/catalog/qm-b_sm.jpeg'),
(2140, 'catalog/s4-b_sm.jpeg', 1, 'real/catalog/s4-b_sm.jpeg'),
(2141, 'catalog/UZ_4590B_sm.jpeg', 1, 'real/catalog/UZ_4590B_sm.jpeg'),
(2142, 'catalog/W_45120B_sm.jpeg', 1, 'real/catalog/W_45120B_sm.jpeg'),
(2145, 'catalog/W_45150IB_sm.jpeg', 1, 'real/catalog/W_45150IB_sm.jpeg'),
(2146, 'catalog/WBF_2545B_sm.jpeg', 1, 'real/catalog/WBF_2545B_sm.jpeg'),
(2148, 'catalog/WGZ_3590B_sm.jpeg', 1, 'real/catalog/WGZ_3590B_sm.jpeg'),
(2149, 'catalog/WH_4590B_sm.jpeg', 1, 'real/catalog/WH_4590B_sm.jpeg'),
(2150, 'catalog/WX2Z3590B_sm.jpeg', 1, 'real/catalog/WX2Z3590B_sm.jpeg'),
(2151, 'catalog/MK_4590B_sm.jpeg', 1, 'real/catalog/MK_4590B_sm.jpeg'),
(2152, 'catalog/T_2020B_sm.jpeg', 1, 'real/catalog/T_2020B_sm.jpeg'),
(2153, 'catalog/w3z_4545b_sm.jpg', 1, 'real/catalog/w3z_4545b_sm.jpg'),
(2154, 'catalog/kronshnein_04_sm.bmp', 1, 'real/catalog/kronshnein_04_sm.bmp'),
(2155, 'catalog/kronshtein_05_sm.bmp', 1, 'real/catalog/kronshtein_05_sm.bmp'),
(2157, 'catalog/gruzst_polka_sm.bmp', 1, 'real/catalog/gruzst_polka_sm.bmp'),
(2160, 'catalog/svyazgruz_sm.bmp', 1, 'real/catalog/svyazgruz_sm.bmp'),
(2161, 'catalog/gruzstoika_sm.bmp', 1, 'real/catalog/gruzstoika_sm.bmp'),
(2162, 'catalog/lotok_sm.bmp', 1, 'real/catalog/lotok_sm.bmp'),
(2164, 'catalog/polka_ms_sm.bmp', 1, 'real/catalog/polka_ms_sm.bmp'),
(2166, 'catalog/ugolok_mc_sm.bmp', 1, 'real/catalog/ugolok_mc_sm.bmp'),
(2167, 'catalog/korzina_dlya_fruktov_i_ovoschei_sm.jpg', 1, 'real/catalog/korzina_dlya_fruktov_i_ovoschei_sm.jpg'),
(2169, 'catalog/lotok_konditerskii_sm.jpg', 1, 'real/catalog/lotok_konditerskii_sm.jpg'),
(2172, 'catalog/polka_sm.jpg', 1, 'real/catalog/polka_sm.jpg'),
(2175, 'catalog/polka_torcevaya_sm.jpg', 1, 'real/catalog/polka_torcevaya_sm.jpg'),
(2178, 'catalog/polka_uglovaya_vnutrennyaya_sm.jpg', 1, 'real/catalog/polka_uglovaya_vnutrennyaya_sm.jpg'),
(2181, 'catalog/polka_uglovaya_vneshnyaya_sm.jpg', 1, 'real/catalog/polka_uglovaya_vneshnyaya_sm.jpg'),
(2184, 'catalog/polkoderjatel_dvuhzacepnyi_sm.jpg', 1, 'real/catalog/polkoderjatel_dvuhzacepnyi_sm.jpg');
INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(2185, 'catalog/polkoderjatel_trehzacepnyi_sm.jpg', 1, 'real/catalog/polkoderjatel_trehzacepnyi_sm.jpg'),
(2189, 'catalog/stenka_zadnyaya_perforirovann_sm.jpg', 1, 'real/catalog/stenka_zadnyaya_perforirovann_sm.jpg'),
(2190, 'catalog/stenka_zadnyaya_sm.jpg', 1, 'real/catalog/stenka_zadnyaya_sm.jpg'),
(2191, 'catalog/stoika_stellaja_pristennogo_sm.jpg', 1, 'real/catalog/stoika_stellaja_pristennogo_sm.jpg'),
(2192, 'catalog/stoika_stellaja_ostrovnogo_sm.jpg', 1, 'real/catalog/stoika_stellaja_ostrovnogo_sm.jpg'),
(2193, 'catalog/stoika_stellaja_torcevogo_sm.jpg', 1, 'real/catalog/stoika_stellaja_torcevogo_sm.jpg'),
(2194, 'catalog/stoika_stellaja_uglovogo_vneshnego_sm.jpg', 1, 'real/catalog/stoika_stellaja_uglovogo_vneshnego_sm.jpg'),
(2195, 'catalog/e02(a).jpg', 1, 'real/catalog/e02(a).jpg'),
(2196, 'catalog/S1027 women(a).jpg', 1, 'real/catalog/S1027 women(a).jpg'),
(2197, 'catalog/m-04_sm.jpg', 1, 'real/catalog/m-04_sm.jpg'),
(2198, 'catalog/m-05_sm.jpg', 1, 'real/catalog/m-05_sm.jpg'),
(2199, 'catalog/m-05sh_sm.jpg', 1, 'real/catalog/m-05sh_sm.jpg'),
(2200, 'catalog/m-05t_sm.jpg', 1, 'real/catalog/m-05t_sm.jpg'),
(2203, 'catalog/m-10_sm.jpg', 1, 'real/catalog/m-10_sm.jpg'),
(2204, 'catalog/m-06_sm.jpg', 1, 'real/catalog/m-06_sm.jpg'),
(2205, 'catalog/m-07_sm.jpg', 1, 'real/catalog/m-07_sm.jpg'),
(2206, 'catalog/m-08_sm.jpg', 1, 'real/catalog/m-08_sm.jpg'),
(2207, 'catalog/m-09_sm.jpg', 1, 'real/catalog/m-09_sm.jpg'),
(2208, 'catalog/m-11_sm.jpg', 1, 'real/catalog/m-11_sm.jpg'),
(2209, 'catalog/m311_sm.jpg', 1, 'real/catalog/m311_sm.jpg'),
(2210, 'catalog/t401sm.jpeg', 1, 'real/catalog/t401sm.jpeg'),
(2211, 'catalog/t402sm.jpeg', 1, 'real/catalog/t402sm.jpeg'),
(2212, 'catalog/t411sm.jpeg', 1, 'real/catalog/t411sm.jpeg'),
(2213, 'catalog/Evrobust man(a).jpg', 1, 'real/catalog/Evrobust man(a).jpg'),
(2214, 'catalog/Veer nogi(a).jpg', 1, 'real/catalog/Veer nogi(a).jpg'),
(2215, 'catalog/trenoga_sm.jpg', 1, 'real/catalog/trenoga_sm.jpg'),
(2216, 'catalog/1280 women(a).jpg', 1, 'real/catalog/1280 women(a).jpg'),
(2217, 'catalog/pp1_matovaya_sm.bmp', 1, 'real/catalog/pp1_matovaya_sm.bmp'),
(2218, 'catalog/pp1_w_and_bl_sm.jpg', 1, 'real/catalog/pp1_w_and_bl_sm.jpg'),
(2219, 'catalog/jurnalnica_sm.bmp', 1, 'real/catalog/jurnalnica_sm.bmp'),
(2220, 'catalog/8_695_sm.jpg', 1, 'real/catalog/8_695_sm.jpg'),
(2223, 'catalog/12_699_sm.jpg', 1, 'real/catalog/12_699_sm.jpg'),
(2224, 'catalog/14_703_sm.jpg', 1, 'real/catalog/14_703_sm.jpg'),
(2225, 'catalog/stellaj_prist_perfor_sm.jpg', 1, 'real/catalog/stellaj_prist_perfor_sm.jpg'),
(2226, 'catalog/bazis_1500_sm.jpg', 1, 'real/catalog/bazis_1500_sm.jpg'),
(2227, 'catalog/stellaj_pristennyi_bez_friza_sm.jpg', 1, 'real/catalog/stellaj_pristennyi_bez_friza_sm.jpg'),
(2228, 'catalog/stellaj_torcevoi_odnostoronnii_sm.jpg', 1, 'real/catalog/stellaj_torcevoi_odnostoronnii_sm.jpg'),
(2229, 'catalog/stellaj_pristennyi_uglovoi_vnutrennii_sm.j', 1, NULL),
(2230, 'catalog/stellaj_pristennyi_uglovoi_vneshnii_sm.jpg', 1, 'real/catalog/stellaj_pristennyi_uglovoi_vneshnii_sm.jpg'),
(2231, 'catalog/stelaj_2_sm.jpg', 1, 'real/catalog/stelaj_2_sm.jpg'),
(2232, 'catalog/stelaj_3_sm.jpg', 1, 'real/catalog/stelaj_3_sm.jpg'),
(2233, 'catalog/stellaj_ostrovnoi_dvustoronnii_sm.jpg', 1, 'real/catalog/stellaj_ostrovnoi_dvustoronnii_sm.jpg'),
(2234, 'catalog/bazis_2250_sm.jpg', 1, 'real/catalog/bazis_2250_sm.jpg'),
(2236, 'catalog/polka_vod_100_sm.bmp', 1, 'real/catalog/polka_vod_100_sm.bmp'),
(2237, 'catalog/polka_vod_200_sm.bmp', 1, 'real/catalog/polka_vod_200_sm.bmp'),
(2238, 'catalog/polka_vod_450x200_sm.bmp', 1, 'real/catalog/polka_vod_450x200_sm.bmp'),
(2239, 'catalog/jok_zerkalo_22-24_sm.bmp', 1, 'real/catalog/jok_zerkalo_22-24_sm.bmp'),
(2240, 'catalog/jok_zerkalo_74-24_sm.bmp', 1, 'real/catalog/jok_zerkalo_74-24_sm.bmp'),
(2245, 'catalog/th86c-sm.jpg', 1, 'real/catalog/th86c-sm.jpg'),
(2246, 'catalog/th86s-sm.jpg', 1, 'real/catalog/th86s-sm.jpg'),
(2247, 'catalog/th87c-sm.jpg', 1, 'real/catalog/th87c-sm.jpg'),
(2248, 'catalog/th87s-sm.jpg', 1, 'real/catalog/th87s-sm.jpg'),
(2251, 'catalog/j012_sm.gif', 1, 'real/catalog/j012_sm.gif'),
(2253, 'catalog/j032_sm.jpeg', 1, 'real/catalog/j032_sm.jpeg'),
(2254, 'catalog/j017_sm.jpeg', 1, 'real/catalog/j017_sm.jpeg'),
(2255, 'catalog/3015_sm.jpeg', 1, 'real/catalog/3015_sm.jpeg'),
(2256, 'catalog/j31_sm.jpeg', 1, 'real/catalog/j31_sm.jpeg'),
(2257, 'catalog/j15_kit_sm.bmp', 1, 'real/catalog/j15_kit_sm.bmp'),
(2258, 'catalog/konsol_prostaya32_sm.bmp', 1, 'real/catalog/konsol_prostaya32_sm.bmp'),
(2259, 'catalog/j42_sm.jpg', 1, 'real/catalog/j42_sm.jpg'),
(2260, 'catalog/j63_sm.jpg', 1, 'real/catalog/j63_sm.jpg'),
(2261, 'catalog/j64_sm.jpeg', 1, 'real/catalog/j64_sm.jpeg'),
(2262, 'catalog/j04_sm.gif', 1, 'real/catalog/j04_sm.gif'),
(2263, 'catalog/j04_oval_sm.jpeg', 1, 'real/catalog/j04_oval_sm.jpeg'),
(2265, 'catalog/konsol_kvadr_38_32_sm.bmp', 1, 'real/catalog/konsol_kvadr_38_32_sm.bmp'),
(2266, 'catalog/zajim_derevyanaya_vstavka_sm.jpg', 1, 'real/catalog/zajim_derevyanaya_vstavka_sm.jpg'),
(2267, 'catalog/c-1_sm.gif', 1, 'real/catalog/c-1_sm.gif'),
(2268, 'catalog/c-2_sm.gif', 1, 'real/catalog/c-2_sm.gif'),
(2269, 'catalog/porolon_sm.jpg', 1, 'real/catalog/porolon_sm.jpg'),
(2270, 'catalog/Silikon_derevyanaya_vstavka_sm.jpg', 1, 'real/catalog/Silikon_derevyanaya_vstavka_sm.jpg'),
(2271, 'catalog/Silikon_prost_sm.jpg', 1, 'real/catalog/Silikon_prost_sm.jpg'),
(2272, 'catalog/ple4_pryamoe_520_sm.jpg', 1, 'real/catalog/ple4_pryamoe_520_sm.jpg'),
(2273, 'catalog/al142_sm.jpg', 1, 'real/catalog/al142_sm.jpg'),
(2277, 'catalog/lux_sm.jpg', 1, 'real/catalog/lux_sm.jpg'),
(2279, 'catalog/2086_sm.jpg', 1, 'real/catalog/2086_sm.jpg'),
(2280, 'catalog/hd-24_sm.jpg', 1, 'real/catalog/hd-24_sm.jpg'),
(2281, 'catalog/hd-026_sm.jpg', 1, 'real/catalog/hd-026_sm.jpg'),
(2282, 'catalog/revolving_sm.jpg', 1, 'real/catalog/revolving_sm.jpg'),
(2283, 'catalog/s-2_sm.jpg', 1, 'real/catalog/s-2_sm.jpg'),
(2284, 'catalog/s-obraz_sm.jpg', 1, 'real/catalog/s-obraz_sm.jpg'),
(2285, 'catalog/r5-ple4_sm.jpg', 1, 'real/catalog/r5-ple4_sm.jpg'),
(2286, 'catalog/4erniy_porolon_sm.jpg', 1, 'real/catalog/4erniy_porolon_sm.jpg'),
(2287, 'catalog/zajim(hr-zn)_sm.jpeg', 1, 'real/catalog/zajim(hr-zn)_sm.jpeg'),
(2288, 'catalog/ws057_sm.gif', 1, 'real/catalog/ws057_sm.gif'),
(2290, 'catalog/a5-ple4_sm.jpg', 1, 'real/catalog/a5-ple4_sm.jpg'),
(2291, 'catalog/at45_sm.jpg', 1, 'real/catalog/at45_sm.jpg'),
(2292, 'catalog/wu36_sm.jpg', 1, 'real/catalog/wu36_sm.jpg'),
(2295, 'catalog/0-5_5-10_bel_sm.jpg', 1, 'real/catalog/0-5_5-10_bel_sm.jpg'),
(2296, 'catalog/0-5_5-10_cvet_sm.jpg', 1, 'real/catalog/0-5_5-10_cvet_sm.jpg'),
(2297, 'catalog/4_urovnya_sm.jpg', 1, 'real/catalog/4_urovnya_sm.jpg'),
(2298, 'catalog/ple4_gus_sm.jpg', 1, 'real/catalog/ple4_gus_sm.jpg'),
(2299, 'catalog/ple4_krug_sm.jpg', 1, 'real/catalog/ple4_krug_sm.jpg'),
(2300, 'catalog/ramka_oranjevaya_sm.jpg', 1, 'real/catalog/ramka_oranjevaya_sm.jpg'),
(2301, 'catalog/ple4_rebristoe_sm.jpg', 1, 'real/catalog/ple4_rebristoe_sm.jpg'),
(2302, 'catalog/ramka_belaya_sm.jpg', 1, 'real/catalog/ramka_belaya_sm.jpg'),
(2303, 'catalog/ramka_rozovaya_sm.jpg', 1, 'real/catalog/ramka_rozovaya_sm.jpg'),
(2304, 'catalog/ramka_sinyaya_sm.jpg', 1, 'real/catalog/ramka_sinyaya_sm.jpg'),
(2305, 'catalog/sorti_sm.jpg', 1, 'real/catalog/sorti_sm.jpg'),
(2306, 'catalog/ple4_belevoe_matoviy_sm.jpg', 1, 'real/catalog/ple4_belevoe_matoviy_sm.jpg'),
(2307, 'catalog/ple4_belevoe_prozra4_sm.jpg', 1, 'real/catalog/ple4_belevoe_prozra4_sm.jpg'),
(2308, 'catalog/ple4_belevoe_prozra4_l270_sm.jpg', 1, 'real/catalog/ple4_belevoe_prozra4_l270_sm.jpg'),
(2309, 'catalog/ple4_belevoe_prozra4_logo_sm.jpg', 1, 'real/catalog/ple4_belevoe_prozra4_logo_sm.jpg'),
(2310, 'catalog/ple4_belevoe_prozra4_pryamoi_sm.jpg', 1, 'real/catalog/ple4_belevoe_prozra4_pryamoi_sm.jpg'),
(2312, 'catalog/ple4_beloe_sm.jpg', 1, 'real/catalog/ple4_beloe_sm.jpg'),
(2313, 'catalog/ple4_derevo_c_perekladinoi_sm.jpg', 1, 'real/catalog/ple4_derevo_c_perekladinoi_sm.jpg'),
(2314, 'catalog/ple4_c_bolshim_kru4kom_sm.jpg', 1, 'real/catalog/ple4_c_bolshim_kru4kom_sm.jpg'),
(2315, 'catalog/ple4_dlya_ubok_sm.jpg', 1, 'real/catalog/ple4_dlya_ubok_sm.jpg'),
(2316, 'catalog/ple4_detskoe_shirokoe_l320_sm.jpg', 1, 'real/catalog/ple4_detskoe_shirokoe_l320_sm.jpg'),
(2317, 'catalog/ple4_pokatoe_l320_sm.jpg', 1, 'real/catalog/ple4_pokatoe_l320_sm.jpg'),
(2318, 'catalog/ple4_s_zajimom_sm.jpg', 1, 'real/catalog/ple4_s_zajimom_sm.jpg'),
(2320, 'catalog/semnik_r3_sm.jpg', 1, 'real/catalog/semnik_r3_sm.jpg'),
(2321, 'catalog/TRP-1_sm.jpg', 1, 'real/catalog/TRP-1_sm.jpg'),
(2322, 'catalog/D3-06_sm.jpeg', 1, 'real/catalog/D3-06_sm.jpeg'),
(2323, 'catalog/266-1_sm.jpg', 1, 'real/catalog/266-1_sm.jpg'),
(2324, 'catalog/niryalshica(a).jpg', 1, 'real/catalog/niryalshica(a).jpg'),
(2325, 'catalog/maniken_c-2(a).jpg', 1, 'real/catalog/maniken_c-2(a).jpg'),
(2326, 'catalog/maniken_basket_kri4it(a).jpg', 1, 'real/catalog/maniken_basket_kri4it(a).jpg'),
(2327, 'catalog/maniken_db-18(a).jpg', 1, 'real/catalog/maniken_db-18(a).jpg'),
(2328, 'catalog/maniken_malish_lejit(a).jpg', 1, 'real/catalog/maniken_malish_lejit(a).jpg'),
(2329, 'catalog/Evrobuste women blace noga(a).jpg', 1, 'real/catalog/Evrobuste women blace noga(a).jpg'),
(2330, 'catalog/Evrobuste women wint noga(a).jpg', 1, 'real/catalog/Evrobuste women wint noga(a).jpg'),
(2331, 'catalog/6_kru4kov_nastenniy_sm.bmp', 1, 'real/catalog/6_kru4kov_nastenniy_sm.bmp'),
(2332, 'catalog/nastenniy_derjatel_trubi70_sm.bmp', 1, 'real/catalog/nastenniy_derjatel_trubi70_sm.bmp'),
(2333, 'catalog/nastenniy_derjatel_trub300_sm.bmp', 1, 'real/catalog/nastenniy_derjatel_trub300_sm.bmp'),
(2334, 'catalog/gusak_nastenniy_sm.jpg', 1, 'real/catalog/gusak_nastenniy_sm.jpg'),
(2343, 'catalog/8910-9_sm.jpg', 1, 'real/catalog/8910-9_sm.jpg'),
(2352, 'catalog/mods_sm.jpg', 1, 'real/catalog/mods_sm.jpg'),
(2355, 'catalog/pelikan_sm.jpg', 1, 'real/catalog/pelikan_sm.jpg'),
(2356, 'catalog/a320_4ernoe_sm.jpg', 1, 'real/catalog/a320_4ernoe_sm.jpg'),
(2357, 'catalog/a3110_beloe_sm.jpg', 1, 'real/catalog/a3110_beloe_sm.jpg'),
(2358, 'catalog/a3110_4ernoe_sm.jpg', 1, 'real/catalog/a3110_4ernoe_sm.jpg'),
(2359, 'catalog/a320_beloe_sm.jpg', 1, 'real/catalog/a320_beloe_sm.jpg'),
(2360, 'catalog/zerkalo_white_sm.jpg', 1, 'real/catalog/zerkalo_white_sm.jpg'),
(2361, 'catalog/zerkalo_black_sm.jpg', 1, 'real/catalog/zerkalo_black_sm.jpg'),
(2362, 'catalog/zerkalo_pink_sm.jpg', 1, 'real/catalog/zerkalo_pink_sm.jpg'),
(2363, 'catalog/kru4ek_n01_bronza_sm.jpg', 1, 'real/catalog/kru4ek_n01_bronza_sm.jpg'),
(2364, 'catalog/kru4ek_0434_sm.jpg', 1, 'real/catalog/kru4ek_0434_sm.jpg'),
(2365, 'catalog/kru4ek_mogilev_sm.jpg', 1, 'real/catalog/kru4ek_mogilev_sm.jpg'),
(2366, 'catalog/kru4ek_n08 _satinhrom_sm.jpg', 1, 'real/catalog/kru4ek_n08 _satinhrom_sm.jpg'),
(2367, 'catalog/kru4ek_n10_antibronza_sm.jpg', 1, 'real/catalog/kru4ek_n10_antibronza_sm.jpg'),
(2369, 'catalog/kru4ek_n44_sm.jpg', 1, 'real/catalog/kru4ek_n44_sm.jpg'),
(2371, 'catalog/zerkalo_nastolnoe_sm.jpg', 1, 'real/catalog/zerkalo_nastolnoe_sm.jpg'),
(2372, 'catalog/maniken_golova_j1_sm.jpg', 1, 'real/catalog/maniken_golova_j1_sm.jpg'),
(2373, 'catalog/maniken_golova_j2_sm.jpg', 1, 'real/catalog/maniken_golova_j2_sm.jpg'),
(2374, 'catalog/maniken_golova_m1_sm.jpg', 1, 'real/catalog/maniken_golova_m1_sm.jpg'),
(2376, 'catalog/maniken_golova_4er_kit_sm.jpg', 1, 'real/catalog/maniken_golova_4er_kit_sm.jpg'),
(2377, 'catalog/beskarkas_a1_(a).jpg', 1, 'real/catalog/beskarkas_a1_(a).jpg'),
(2378, 'catalog/beskarkas_a2_(a).jpg', 1, 'real/catalog/beskarkas_a2_(a).jpg'),
(2379, 'catalog/beskarkas_a3_(a).jpg', 1, 'real/catalog/beskarkas_a3_(a).jpg'),
(2380, 'catalog/beskarkas_a4_(a).jpg', 1, 'real/catalog/beskarkas_a4_(a).jpg'),
(2381, 'catalog/beskarkas_b1_(a).jpg', 1, 'real/catalog/beskarkas_b1_(a).jpg'),
(2382, 'catalog/beskarkas_b2_(a).jpg', 1, 'real/catalog/beskarkas_b2_(a).jpg'),
(2383, 'catalog/beskarkas_b3_(a).jpg', 1, 'real/catalog/beskarkas_b3_(a).jpg'),
(2384, 'catalog/beskarkas_b4_(a).jpg', 1, 'real/catalog/beskarkas_b4_(a).jpg'),
(2385, 'catalog/beskarkas_c1_(a).jpg', 1, 'real/catalog/beskarkas_c1_(a).jpg'),
(2386, 'catalog/kru4ek_n01_satin_sm.jpg', 1, 'real/catalog/kru4ek_n01_satin_sm.jpg'),
(2387, 'catalog/kru4ek_n01_chrom_sm.jpg', 1, 'real/catalog/kru4ek_n01_chrom_sm.jpg'),
(2388, 'catalog/kru4ek_n08 _bronza_sm.jpg', 1, 'real/catalog/kru4ek_n08 _bronza_sm.jpg'),
(2389, 'catalog/kru4ek_n08 _satinnikel_sm.jpg', 1, 'real/catalog/kru4ek_n08 _satinnikel_sm.jpg'),
(2390, 'catalog/kru4ek_n10_gold_sm.jpg', 1, 'real/catalog/kru4ek_n10_gold_sm.jpg'),
(2391, 'catalog/kru4ek_n45 _antibronza_sm.jpg', 1, 'real/catalog/kru4ek_n45 _antibronza_sm.jpg'),
(2392, 'catalog/kru4ek_n45 _satinhrom_sm.jpg', 1, 'real/catalog/kru4ek_n45 _satinhrom_sm.jpg'),
(2393, 'catalog/kr_nasten_5shar_sm.jpg', 1, 'real/catalog/kr_nasten_5shar_sm.jpg'),
(2394, 'catalog/kr_volna_sm.jpg', 1, 'real/catalog/kr_volna_sm.jpg'),
(2395, 'catalog/ep_metallic_sm.bmp', 1, 'real/catalog/ep_metallic_sm.bmp'),
(2396, 'catalog/j015_sm.jpeg', 1, 'real/catalog/j015_sm.jpeg'),
(2397, 'catalog/j018_sm.gif', 1, 'real/catalog/j018_sm.gif'),
(2398, 'catalog/u021(It)L.jpeg', 1, 'real/catalog/u021(It)L.jpeg'),
(2399, 'catalog/pr_pc24_sm.jpeg', 1, 'real/catalog/pr_pc24_sm.jpeg'),
(2400, 'catalog/pr_zaglushka_sm.bmp', 1, 'real/catalog/pr_zaglushka_sm.bmp'),
(2401, 'catalog/tr01(It)L.gif', 1, 'real/catalog/tr01(It)L.gif'),
(2402, 'catalog/pl_otvod148gr_sm.bmp', 1, 'real/catalog/pl_otvod148gr_sm.bmp'),
(2403, 'catalog/d32(b).jpg', 1, 'real/catalog/d32(b).jpg'),
(2404, 'catalog/dd1(a).jpg', 1, 'real/catalog/dd1(a).jpg'),
(2405, 'catalog/e15(a).jpg', 1, 'real/catalog/e15(a).jpg'),
(2406, 'catalog/f5(a).jpg', 1, 'real/catalog/f5(a).jpg'),
(2407, 'catalog/f7(a).jpg', 1, 'real/catalog/f7(a).jpg'),
(2408, 'catalog/j11(a).jpg', 1, 'real/catalog/j11(a).jpg'),
(2409, 'catalog/jsz(a).jpg', 1, 'real/catalog/jsz(a).jpg'),
(2410, 'catalog/kare(a).jpg', 1, 'real/catalog/kare(a).jpg'),
(2411, 'catalog/lijnik(a).jpg', 1, 'real/catalog/lijnik(a).jpg'),
(2412, 'catalog/mb(a).jpg', 1, 'real/catalog/mb(a).jpg'),
(2413, 'catalog/mm(a).jpg', 1, 'real/catalog/mm(a).jpg'),
(2414, 'catalog/msb(a).jpg', 1, 'real/catalog/msb(a).jpg'),
(2415, 'catalog/mst(a).jpg', 1, 'real/catalog/mst(a).jpg'),
(2416, 'catalog/mv(a).jpg', 1, 'real/catalog/mv(a).jpg'),
(2417, 'catalog/ng4-025(a).jpg', 1, 'real/catalog/ng4-025(a).jpg'),
(2418, 'catalog/ng8(a).jpg', 1, 'real/catalog/ng8(a).jpg'),
(2419, 'catalog/ng16(a).jpg', 1, 'real/catalog/ng16(a).jpg'),
(2420, 'catalog/skalolazka(a).jpg', 1, 'real/catalog/skalolazka(a).jpg'),
(2421, 'catalog/tennisistka(a).jpg', 1, 'real/catalog/tennisistka(a).jpg'),
(2422, 'catalog/w029(a).jpg', 1, 'real/catalog/w029(a).jpg'),
(2423, 'catalog/z-2(a).jpg', 1, 'real/catalog/z-2(a).jpg'),
(2424, 'catalog/d7(a).jpg', 1, 'real/catalog/d7(a).jpg'),
(2425, 'catalog/c-1(a).jpg', 1, 'real/catalog/c-1(a).jpg'),
(2426, 'catalog/d30(a).jpg', 1, 'real/catalog/d30(a).jpg'),
(2427, 'catalog/d2(a).jpg', 1, 'real/catalog/d2(a).jpg'),
(2428, 'catalog/d11(a).jpg', 1, 'real/catalog/d11(a).jpg'),
(2429, 'catalog/d31(a).jpg', 1, 'real/catalog/d31(a).jpg'),
(2430, 'catalog/d6(a).jpg', 1, 'real/catalog/d6(a).jpg'),
(2431, 'catalog/B1(a).jpg', 1, 'real/catalog/B1(a).jpg'),
(2432, 'catalog/c33(a).jpg', 1, 'real/catalog/c33(a).jpg'),
(2433, 'catalog/B01-023(a).jpg', 1, 'real/catalog/B01-023(a).jpg'),
(2434, 'catalog/c6-w14(a).jpg', 1, 'real/catalog/c6-w14(a).jpg'),
(2435, 'catalog/js(a).jpg', 1, 'real/catalog/js(a).jpg'),
(2436, 'catalog/d11(c).jpg', 1, 'real/catalog/d11(c).jpg'),
(2437, 'catalog/100-108wm(a).jpg', 1, 'real/catalog/100-108wm(a).jpg'),
(2438, 'catalog/104-92man(a).jpg', 1, 'real/catalog/104-92man(a).jpg'),
(2439, 'catalog/1280(a).jpg', 1, 'real/catalog/1280(a).jpg'),
(2440, 'catalog/woman(100-104)a.jpg.jpg', 1, 'real/catalog/woman(100-104)a.jpg.jpg'),
(2441, 'catalog/man(100-88)a.jpg', 1, 'real/catalog/man(100-88)a.jpg'),
(2442, 'catalog/woman(104-112)a.jpg.jpg', 1, 'real/catalog/woman(104-112)a.jpg.jpg'),
(2443, 'catalog/man(104-96)a.jpg', 1, 'real/catalog/man(104-96)a.jpg'),
(2444, 'catalog/woman(108-116)a.jpg.jpg', 1, 'real/catalog/woman(108-116)a.jpg.jpg'),
(2445, 'catalog/woman(108-98)a.jpg.jpg', 1, 'real/catalog/woman(108-98)a.jpg.jpg'),
(2446, 'catalog/man(112-100)a.jpg', 1, 'real/catalog/man(112-100)a.jpg'),
(2447, 'catalog/man(112-106)a.jpg.jpg', 1, 'real/catalog/man(112-106)a.jpg.jpg'),
(2448, 'catalog/man(112-118)a.jpg.jpg', 1, 'real/catalog/man(112-118)a.jpg.jpg'),
(2449, 'catalog/woman(112-120)a.jpg.jpg', 1, 'real/catalog/woman(112-120)a.jpg.jpg'),
(2450, 'catalog/man(116-110)a.jpg.jpg', 1, 'real/catalog/man(116-110)a.jpg.jpg'),
(2451, 'catalog/woman(116-124)a.jpg.jpg', 1, 'real/catalog/woman(116-124)a.jpg.jpg'),
(2452, 'catalog/woman(116-124)c.jpg.jpg', 1, 'real/catalog/woman(116-124)c.jpg.jpg'),
(2453, 'catalog/man(120-118)a.jpg.jpg', 1, 'real/catalog/man(120-118)a.jpg.jpg'),
(2454, 'catalog/woman(120-128)a.jpg.jpg', 1, 'real/catalog/woman(120-128)a.jpg.jpg'),
(2455, 'catalog/woman(124-132)a.jpg.jpg', 1, 'real/catalog/woman(124-132)a.jpg.jpg'),
(2456, 'catalog/woman(128-136)a.jpg.jpg', 1, 'real/catalog/woman(128-136)a.jpg.jpg'),
(2457, 'catalog/man(128-136)a.jpg.jpg', 1, 'real/catalog/man(128-136)a.jpg.jpg'),
(2458, 'catalog/woman(96-100)a.jpg.jpg', 1, 'real/catalog/woman(96-100)a.jpg.jpg'),
(2459, 'catalog/woman(96-104)a.jpg.jpg', 1, 'real/catalog/woman(96-104)a.jpg.jpg'),
(2460, 'catalog/woman(96-104)c.jpg.jpg', 1, 'real/catalog/woman(96-104)c.jpg.jpg'),
(2461, 'catalog/woman(96-108)a.jpg.jpg', 1, 'real/catalog/woman(96-108)a.jpg.jpg'),
(2462, 'catalog/Evrobust womane(a).jpg', 1, 'real/catalog/Evrobust womane(a).jpg'),
(2463, 'catalog/Evrobust man blace(a).jpg', 1, 'real/catalog/Evrobust man blace(a).jpg'),
(2464, 'catalog/Evrobust women blace(a).jpg', 1, 'real/catalog/Evrobust women blace(a).jpg'),
(2465, 'catalog/Evrobuste man noga(a).jpg', 1, 'real/catalog/Evrobuste man noga(a).jpg'),
(2466, 'catalog/Head WW-224 womane(a).jpg', 1, 'real/catalog/Head WW-224 womane(a).jpg'),
(2467, 'catalog/Head WM-2086 man(a).jpg', 1, 'real/catalog/Head WM-2086 man(a).jpg'),
(2468, 'catalog/Children(a).jpg', 1, 'real/catalog/Children(a).jpg'),
(2469, 'catalog/image-2469.jpg', 1, 'real/catalog/image-2469.jpg'),
(4815, 'catalog/image-4815.jpg', 7, 'real/catalog/image-4815.jpg'),
(2474, 'catalog/image-2474.png', 1, 'real/catalog/image-2474.png'),
(2475, 'catalog/image-2475.png', 1, 'real/catalog/image-2475.png'),
(2476, 'catalog/image-2476.png', 1, 'real/catalog/image-2476.png'),
(2477, 'catalog/image-2477.png', 1, 'real/catalog/image-2477.png'),
(2478, 'catalog/image-2478.png', 1, 'real/catalog/image-2478.png'),
(2479, 'catalog/image-2479.png', 1, 'real/catalog/image-2479.png'),
(2480, 'catalog/image-2480.png', 1, 'real/catalog/image-2480.png'),
(2481, 'catalog/image-2481.jpeg', 1, 'real/catalog/image-2481.jpeg'),
(2482, 'catalog/image-2482.jpg', 1, 'real/catalog/image-2482.jpg'),
(4814, 'catalog/image-4814.jpg', 7, 'real/catalog/image-4814.jpg'),
(2487, 'catalog/image-2487.png', 1, 'real/catalog/image-2487.png'),
(2488, 'catalog/image-2488.gif', 1, 'real/catalog/image-2488.gif'),
(2489, 'catalog/image-2489.jpg', 1, 'real/catalog/image-2489.jpg'),
(2490, 'catalog/image-2490.jpg', 1, 'real/catalog/image-2490.jpg'),
(2491, 'catalog/image-2491.jpg', 1, 'real/catalog/image-2491.jpg'),
(2492, 'catalog/image-2492.jpg', 7, 'real/catalog/image-2492.jpg'),
(2493, 'catalog/image-2493.jpg', 7, 'real/catalog/image-2493.jpg'),
(2494, 'catalog/image-2494.jpg', 1, 'real/catalog/image-2494.jpg'),
(2495, 'catalog/image-2495.jpg', 1, 'real/catalog/image-2495.jpg'),
(2500, 'catalog/image-2500.jpg', 1, 'real/catalog/image-2500.jpg'),
(2501, 'catalog/image-2501.jpg', 1, 'real/catalog/image-2501.jpg'),
(2970, 'catalog/image-2970.jpg', 7, 'real/catalog/image-2970.jpg'),
(2508, 'catalog/image-2508.jpg', 7, 'real/catalog/image-2508.jpg'),
(2509, 'catalog/image-2509.jpg', 7, 'real/catalog/image-2509.jpg'),
(2510, 'catalog/image-2510.jpg', 7, 'real/catalog/image-2510.jpg'),
(2511, 'catalog/image-2511.jpg', 7, 'real/catalog/image-2511.jpg'),
(2522, 'design/image-2522.jpg', 3, 'real/design/image-2522.jpg'),
(2523, 'design/image-2523.JPG', 3, 'real/design/image-2523.JPG'),
(2524, 'catalog/image-2524.png', 1, 'real/catalog/image-2524.png'),
(2525, 'catalog/image-2525.png', 1, 'real/catalog/image-2525.png'),
(2526, 'catalog/image-2526.png', 1, 'real/catalog/image-2526.png'),
(2527, 'catalog/image-2527.png', 1, 'real/catalog/image-2527.png'),
(2528, 'catalog/image-2528.png', 1, 'real/catalog/image-2528.png'),
(2530, 'catalog/image-2530.png', 1, 'real/catalog/image-2530.png'),
(2531, 'catalog/image-2531.png', 1, 'real/catalog/image-2531.png'),
(2532, 'catalog/image-2532.png', 1, 'real/catalog/image-2532.png'),
(2533, 'catalog/image-2533.jpg', 1, 'real/catalog/image-2533.jpg'),
(2534, 'catalog/image-2534.jpg', 1, 'real/catalog/image-2534.jpg'),
(2535, 'catalog/image-2535.jpg', 1, 'real/catalog/image-2535.jpg'),
(2536, 'catalog/image-2536.jpg', 1, 'real/catalog/image-2536.jpg'),
(2539, 'catalog/image-2539.jpg', 7, 'real/catalog/image-2539.jpg'),
(2540, 'catalog/image-2540.jpg', 7, 'real/catalog/image-2540.jpg'),
(2541, 'catalog/image-2541.jpg', 1, 'real/catalog/image-2541.jpg'),
(2542, 'catalog/image-2542.jpeg', 1, 'real/catalog/image-2542.jpeg'),
(2543, 'catalog/image-2543.jpg', 1, 'real/catalog/image-2543.jpg'),
(2544, 'catalog/image-2544.jpeg', 1, 'real/catalog/image-2544.jpeg'),
(2547, 'catalog/image-2547.jpg', 7, 'real/catalog/image-2547.jpg'),
(2548, 'catalog/image-2548.jpg', 7, 'real/catalog/image-2548.jpg'),
(2549, 'catalog/image-2549.html', 1, 'real/catalog/image-2549.html'),
(2550, 'catalog/image-2550.gif', 1, 'real/catalog/image-2550.gif'),
(2553, 'catalog/image-2553.jpg', 7, 'real/catalog/image-2553.jpg'),
(2554, 'catalog/image-2554.jpeg', 7, 'real/catalog/image-2554.jpeg'),
(2559, 'catalog/image-2559.jpg', 7, 'real/catalog/image-2559.jpg'),
(2560, 'catalog/image-2560.jpeg', 7, 'real/catalog/image-2560.jpeg'),
(2561, 'catalog/image-2561.jpg', 1, 'real/catalog/image-2561.jpg'),
(2562, 'catalog/image-2562.jpg', 1, 'real/catalog/image-2562.jpg'),
(2973, 'catalog/image-2973.jpg', 1, 'real/catalog/image-2973.jpg'),
(2971, 'catalog/image-2971.jpeg', 7, 'real/catalog/image-2971.jpeg'),
(2565, 'catalog/image-2565.jpg', 1, 'real/catalog/image-2565.jpg'),
(2566, 'catalog/image-2566.jpeg', 1, 'real/catalog/image-2566.jpeg'),
(2567, 'catalog/image-2567.jpg', 1, 'real/catalog/image-2567.jpg'),
(2568, 'catalog/image-2568.jpeg', 1, 'real/catalog/image-2568.jpeg'),
(2569, 'catalog/image-2569.jpg', 1, 'real/catalog/image-2569.jpg'),
(2570, 'catalog/image-2570.jpeg', 1, 'real/catalog/image-2570.jpeg'),
(2571, 'catalog/image-2571.jpg', 1, 'real/catalog/image-2571.jpg'),
(2572, 'catalog/image-2572.jpeg', 1, 'real/catalog/image-2572.jpeg'),
(2573, 'catalog/image-2573.bmp', 1, 'real/catalog/image-2573.bmp'),
(2574, 'catalog/image-2574.bmp', 1, 'real/catalog/image-2574.bmp'),
(2575, 'catalog/image-2575.jpg', 7, 'real/catalog/image-2575.jpg'),
(2576, 'catalog/image-2576.jpeg', 7, 'real/catalog/image-2576.jpeg'),
(2577, 'catalog/image-2577.jpg', 7, 'real/catalog/image-2577.jpg'),
(2578, 'catalog/image-2578.jpeg', 7, 'real/catalog/image-2578.jpeg'),
(2579, 'catalog/image-2579.jpg', 7, 'real/catalog/image-2579.jpg'),
(2580, 'catalog/image-2580.jpeg', 7, 'real/catalog/image-2580.jpeg'),
(2588, 'catalog/image-2588.jpg', 7, 'real/catalog/image-2588.jpg'),
(2589, 'catalog/image-2589.jpg', 7, 'real/catalog/image-2589.jpg'),
(3091, 'catalog/image-3091.JPG', 7, 'real/catalog/image-3091.JPG'),
(3090, 'catalog/image-3090.JPG', 7, 'real/catalog/image-3090.JPG'),
(2596, 'catalog/image-2596.jpg', 7, 'real/catalog/image-2596.jpg'),
(2597, 'catalog/image-2597.jpg', 7, 'real/catalog/image-2597.jpg'),
(3085, 'catalog/image-3085.jpg', 1, 'real/catalog/image-3085.jpg'),
(2600, 'catalog/image-2600.html', 1, 'real/catalog/image-2600.html'),
(2601, 'catalog/image-2601.bmp', 1, 'real/catalog/image-2601.bmp'),
(2606, 'catalog/image-2606.jpg', 7, 'real/catalog/image-2606.jpg'),
(2607, 'catalog/image-2607.jpg', 7, 'real/catalog/image-2607.jpg'),
(2608, 'catalog/image-2608.jpg', 7, 'real/catalog/image-2608.jpg'),
(2609, 'catalog/image-2609.jpg', 7, 'real/catalog/image-2609.jpg'),
(2610, 'catalog/image-2610.jpg', 7, 'real/catalog/image-2610.jpg'),
(2611, 'catalog/image-2611.jpg', 7, 'real/catalog/image-2611.jpg'),
(2612, 'catalog/image-2612.jpg', 7, 'real/catalog/image-2612.jpg'),
(2613, 'catalog/image-2613.jpg', 7, 'real/catalog/image-2613.jpg'),
(2614, 'catalog/image-2614.jpg', 7, 'real/catalog/image-2614.jpg'),
(2615, 'catalog/image-2615.jpg', 7, 'real/catalog/image-2615.jpg'),
(2616, 'catalog/image-2616.jpg', 7, 'real/catalog/image-2616.jpg'),
(2617, 'catalog/image-2617.jpg', 7, 'real/catalog/image-2617.jpg'),
(2618, 'catalog/image-2618.jpg', 7, 'real/catalog/image-2618.jpg'),
(2619, 'catalog/image-2619.jpg', 7, 'real/catalog/image-2619.jpg'),
(2620, 'catalog/image-2620.jpg', 7, 'real/catalog/image-2620.jpg'),
(2621, 'catalog/image-2621.jpeg', 7, 'real/catalog/image-2621.jpeg'),
(2624, 'catalog/image-2624.jpg', 7, 'real/catalog/image-2624.jpg'),
(2625, 'catalog/image-2625.jpg', 7, 'real/catalog/image-2625.jpg'),
(2628, 'catalog/image-2628.jpg', 7, 'real/catalog/image-2628.jpg'),
(2629, 'catalog/image-2629.jpg', 7, 'real/catalog/image-2629.jpg'),
(2630, 'catalog/image-2630.jpg', 7, 'real/catalog/image-2630.jpg'),
(2631, 'catalog/image-2631.jpg', 7, 'real/catalog/image-2631.jpg'),
(2632, 'catalog/image-2632.jpg', 7, 'real/catalog/image-2632.jpg'),
(2633, 'catalog/image-2633.jpg', 7, 'real/catalog/image-2633.jpg'),
(2634, 'catalog/image-2634.jpg', 7, 'real/catalog/image-2634.jpg'),
(2635, 'catalog/image-2635.jpg', 7, 'real/catalog/image-2635.jpg'),
(2636, 'catalog/image-2636.jpg', 1, 'real/catalog/image-2636.jpg'),
(2637, 'catalog/image-2637.jpg', 1, 'real/catalog/image-2637.jpg'),
(2638, 'catalog/image-2638.jpg', 7, 'real/catalog/image-2638.jpg'),
(2639, 'catalog/image-2639.jpeg', 7, 'real/catalog/image-2639.jpeg'),
(2640, 'catalog/image-2640.jpg', 7, 'real/catalog/image-2640.jpg'),
(2641, 'catalog/image-2641.jpeg', 7, 'real/catalog/image-2641.jpeg'),
(2642, 'catalog/image-2642.jpg', 7, 'real/catalog/image-2642.jpg'),
(2643, 'catalog/image-2643.jpeg', 7, 'real/catalog/image-2643.jpeg'),
(2648, 'catalog/image-2648.jpg', 7, 'real/catalog/image-2648.jpg'),
(2649, 'catalog/image-2649.jpg', 7, 'real/catalog/image-2649.jpg'),
(2652, 'catalog/image-2652.html', 1, 'real/catalog/image-2652.html'),
(2653, 'catalog/image-2653.gif', 1, 'real/catalog/image-2653.gif'),
(2660, 'catalog/image-2660.jpg', 7, 'real/catalog/image-2660.jpg'),
(2661, 'catalog/image-2661.jpg', 7, 'real/catalog/image-2661.jpg'),
(2662, 'catalog/image-2662.jpg', 7, 'real/catalog/image-2662.jpg'),
(2663, 'catalog/image-2663.jpg', 7, 'real/catalog/image-2663.jpg'),
(2664, 'catalog/image-2664.jpg', 7, 'real/catalog/image-2664.jpg'),
(2665, 'catalog/image-2665.jpg', 7, 'real/catalog/image-2665.jpg'),
(2672, 'catalog/image-2672.jpg', 7, 'real/catalog/image-2672.jpg'),
(2673, 'catalog/image-2673.jpg', 7, 'real/catalog/image-2673.jpg'),
(2674, 'catalog/image-2674.jpg', 7, 'real/catalog/image-2674.jpg'),
(2675, 'catalog/image-2675.jpg', 7, 'real/catalog/image-2675.jpg'),
(2678, 'catalog/image-2678.jpg', 7, 'real/catalog/image-2678.jpg'),
(2679, 'catalog/image-2679.jpeg', 7, 'real/catalog/image-2679.jpeg'),
(2680, 'catalog/image-2680.jpg', 7, 'real/catalog/image-2680.jpg'),
(2681, 'catalog/image-2681.jpeg', 7, 'real/catalog/image-2681.jpeg'),
(2682, 'catalog/image-2682.jpg', 7, 'real/catalog/image-2682.jpg'),
(2683, 'catalog/image-2683.jpeg', 7, 'real/catalog/image-2683.jpeg'),
(2694, 'catalog/image-2694.jpg', 7, 'real/catalog/image-2694.jpg'),
(2695, 'catalog/image-2695.jpg', 7, 'real/catalog/image-2695.jpg'),
(2696, 'catalog/image-2696.jpg', 7, 'real/catalog/image-2696.jpg'),
(2697, 'catalog/image-2697.jpg', 7, 'real/catalog/image-2697.jpg'),
(2698, 'catalog/image-2698.jpg', 7, 'real/catalog/image-2698.jpg'),
(2699, 'catalog/image-2699.jpeg', 7, 'real/catalog/image-2699.jpeg'),
(2700, 'catalog/image-2700.jpg', 7, 'real/catalog/image-2700.jpg'),
(2701, 'catalog/image-2701.jpeg', 7, 'real/catalog/image-2701.jpeg'),
(2972, 'catalog/image-2972.jpg', 1, 'real/catalog/image-2972.jpg'),
(2710, 'catalog/image-2710.html', 1, 'real/catalog/image-2710.html'),
(2711, 'catalog/image-2711.gif', 1, 'real/catalog/image-2711.gif'),
(2712, 'catalog/image-2712.html', 1, 'real/catalog/image-2712.html'),
(2713, 'catalog/image-2713.gif', 1, 'real/catalog/image-2713.gif'),
(2714, 'catalog/image-2714.html', 1, 'real/catalog/image-2714.html'),
(2715, 'catalog/image-2715.gif', 1, 'real/catalog/image-2715.gif'),
(2724, 'catalog/image-2724.jpg', 7, 'real/catalog/image-2724.jpg'),
(2725, 'catalog/image-2725.jpeg', 7, 'real/catalog/image-2725.jpeg'),
(2726, 'catalog/image-2726.jpg', 7, 'real/catalog/image-2726.jpg'),
(2727, 'catalog/image-2727.jpeg', 7, 'real/catalog/image-2727.jpeg'),
(2730, 'catalog/image-2730.jpg', 1, 'real/catalog/image-2730.jpg'),
(2753, 'catalog/image-2753.jpg', 7, 'real/catalog/image-2753.jpg'),
(2754, 'catalog/image-2754.jpg', 7, 'real/catalog/image-2754.jpg'),
(2861, 'catalog/image-2861.jpg', 1, 'real/catalog/image-2861.jpg'),
(2804, 'design/image-2804.png', 3, 'real/design/image-2804.png'),
(2805, 'catalog/image-2805.jpeg', 1, 'real/catalog/image-2805.jpeg'),
(2806, 'catalog/image-2806.jpeg', 1, 'real/catalog/image-2806.jpeg'),
(2807, 'catalog/image-2807.jpg', 1, 'real/catalog/image-2807.jpg'),
(2808, 'catalog/image-2808.jpeg', 1, 'real/catalog/image-2808.jpeg'),
(2809, 'banners/image-2809.jpg', 4, 'real/banners/image-2809.jpg'),
(2874, 'catalog/image-2874.png', 1, 'real/catalog/image-2874.png'),
(2875, 'catalog/image-2875.png', 1, 'real/catalog/image-2875.png'),
(2820, 'catalog/image-2820.jpg', 1, 'real/catalog/image-2820.jpg'),
(2863, 'catalog/image-2863.jpg', 1, 'real/catalog/image-2863.jpg'),
(2862, 'catalog/image-2862.jpg', 1, 'real/catalog/image-2862.jpg'),
(2823, 'catalog/image-2823.JPG', 1, 'real/catalog/image-2823.JPG'),
(2825, 'catalog/image-2825.JPG', 1, 'real/catalog/image-2825.JPG'),
(2826, 'catalog/image-2826.JPG', 1, 'real/catalog/image-2826.JPG'),
(2827, 'catalog/image-2827.JPG', 1, 'real/catalog/image-2827.JPG'),
(2828, 'catalog/image-2828.JPG', 1, 'real/catalog/image-2828.JPG'),
(2829, 'catalog/image-2829.JPG', 1, 'real/catalog/image-2829.JPG'),
(2830, 'catalog/image-2830.JPG', 1, 'real/catalog/image-2830.JPG'),
(2831, 'catalog/image-2831.JPG', 1, 'real/catalog/image-2831.JPG'),
(2832, 'catalog/image-2832.JPG', 1, 'real/catalog/image-2832.JPG'),
(2833, 'catalog/image-2833.JPG', 1, 'real/catalog/image-2833.JPG'),
(2834, 'catalog/image-2834.JPG', 1, 'real/catalog/image-2834.JPG'),
(2835, 'catalog/image-2835.JPG', 1, 'real/catalog/image-2835.JPG'),
(2836, 'catalog/image-2836.JPG', 1, 'real/catalog/image-2836.JPG'),
(2837, 'catalog/image-2837.JPG', 1, 'real/catalog/image-2837.JPG'),
(2838, 'catalog/image-2838.JPG', 1, 'real/catalog/image-2838.JPG'),
(2839, 'catalog/image-2839.JPG', 1, 'real/catalog/image-2839.JPG'),
(2841, 'catalog/image-2841.JPG', 1, 'real/catalog/image-2841.JPG'),
(2842, 'catalog/image-2842.JPG', 1, 'real/catalog/image-2842.JPG'),
(2843, 'catalog/image-2843.JPG', 1, 'real/catalog/image-2843.JPG'),
(2844, 'catalog/image-2844.JPG', 1, 'real/catalog/image-2844.JPG'),
(2845, 'catalog/image-2845.JPG', 1, 'real/catalog/image-2845.JPG'),
(2846, 'catalog/image-2846.JPG', 1, 'real/catalog/image-2846.JPG'),
(2847, 'catalog/image-2847.JPG', 1, 'real/catalog/image-2847.JPG'),
(2848, 'catalog/image-2848.JPG', 1, 'real/catalog/image-2848.JPG'),
(2849, 'catalog/image-2849.JPG', 1, 'real/catalog/image-2849.JPG'),
(2850, 'catalog/image-2850.JPG', 1, 'real/catalog/image-2850.JPG'),
(2851, 'catalog/image-2851.JPG', 1, 'real/catalog/image-2851.JPG'),
(2853, 'catalog/image-2853.JPG', 1, 'real/catalog/image-2853.JPG'),
(2854, 'catalog/image-2854.JPG', 1, 'real/catalog/image-2854.JPG'),
(2855, 'catalog/image-2855.JPG', 1, 'real/catalog/image-2855.JPG'),
(2857, 'banners/image-2857.gif', 4, 'real/banners/image-2857.gif'),
(2864, 'catalog/image-2864.jpg', 1, 'real/catalog/image-2864.jpg'),
(2865, 'catalog/image-2865.gif', 1, 'real/catalog/image-2865.gif'),
(2866, 'catalog/image-2866.jpg', 1, 'real/catalog/image-2866.jpg'),
(2867, 'catalog/image-2867.jpg', 1, 'real/catalog/image-2867.jpg'),
(2868, 'catalog/image-2868.jpg', 1, 'real/catalog/image-2868.jpg'),
(4810, 'catalog/image-4810.jpg', 7, 'real/catalog/image-4810.jpg'),
(3778, 'catalog/image-3778.jpg', 1, 'real/catalog/image-3778.jpg'),
(2892, 'catalog/image-2892.jpg', 1, 'real/catalog/image-2892.jpg'),
(2893, 'catalog/image-2893.jpeg', 1, 'real/catalog/image-2893.jpeg'),
(2895, 'catalog/image-2895.jpg', 1, 'real/catalog/image-2895.jpg'),
(2896, 'catalog/image-2896.jpg', 1, 'real/catalog/image-2896.jpg'),
(2897, 'catalog/image-2897.jpg', 1, 'real/catalog/image-2897.jpg'),
(2898, 'catalog/image-2898.jpeg', 1, 'real/catalog/image-2898.jpeg'),
(5625, 'catalog/image-5625.jpg', 1, 'real/catalog/image-5625.jpg'),
(5627, 'catalog/image-5627.jpg', 1, 'real/catalog/image-5627.jpg'),
(5628, 'catalog/image-5628.jpg', 1, 'real/catalog/image-5628.jpg'),
(5629, 'catalog/image-5629.jpg', 1, 'real/catalog/image-5629.jpg'),
(5630, 'catalog/image-5630.jpg', 1, 'real/catalog/image-5630.jpg'),
(5631, 'catalog/image-5631.jpg', 1, 'real/catalog/image-5631.jpg'),
(5632, 'catalog/image-5632.jpg', 1, 'real/catalog/image-5632.jpg'),
(5633, 'catalog/image-5633.jpg', 1, 'real/catalog/image-5633.jpg'),
(5634, 'catalog/image-5634.jpg', 1, 'real/catalog/image-5634.jpg'),
(5635, 'catalog/image-5635.jpg', 1, 'real/catalog/image-5635.jpg'),
(5636, 'catalog/image-5636.jpg', 1, 'real/catalog/image-5636.jpg'),
(5637, 'catalog/image-5637.jpg', 1, 'real/catalog/image-5637.jpg'),
(5643, 'catalog/image-5643.jpg', 1, 'real/catalog/image-5643.jpg'),
(5642, 'catalog/image-5642.jpg', 1, 'real/catalog/image-5642.jpg'),
(5640, 'catalog/image-5640.jpg', 1, 'real/catalog/image-5640.jpg'),
(5641, 'catalog/image-5641.jpg', 1, 'real/catalog/image-5641.jpg'),
(5644, 'catalog/image-5644.jpg', 1, 'real/catalog/image-5644.jpg'),
(5645, 'catalog/image-5645.jpg', 1, 'real/catalog/image-5645.jpg'),
(5646, 'catalog/image-5646.jpg', 1, 'real/catalog/image-5646.jpg'),
(5647, 'catalog/image-5647.jpg', 1, 'real/catalog/image-5647.jpg'),
(5648, 'catalog/image-5648.jpg', 1, 'real/catalog/image-5648.jpg'),
(5649, 'catalog/image-5649.jpg', 1, 'real/catalog/image-5649.jpg'),
(5617, 'catalog/image-5617.jpg', 1, 'real/catalog/image-5617.jpg'),
(5619, 'catalog/image-5619.jpg', 1, 'real/catalog/image-5619.jpg'),
(5615, 'catalog/image-5615.jpg', 1, 'real/catalog/image-5615.jpg'),
(5618, 'catalog/image-5618.jpg', 1, 'real/catalog/image-5618.jpg'),
(3073, 'catalog/image-3073.jpg', 1, 'real/catalog/image-3073.jpg'),
(3074, 'catalog/image-3074.jpg', 1, 'real/catalog/image-3074.jpg'),
(3092, 'catalog/image-3092.JPG', 1, 'real/catalog/image-3092.JPG'),
(3093, 'catalog/image-3093.jpg', 1, 'real/catalog/image-3093.jpg'),
(3094, 'catalog/image-3094.jpg', 7, 'real/catalog/image-3094.jpg'),
(3095, 'catalog/image-3095.jpg', 7, 'real/catalog/image-3095.jpg'),
(3096, 'catalog/image-3096.jpg', 7, 'real/catalog/image-3096.jpg'),
(3097, 'catalog/image-3097.jpg', 7, 'real/catalog/image-3097.jpg'),
(3098, 'catalog/image-3098.jpg', 7, 'real/catalog/image-3098.jpg'),
(3099, 'catalog/image-3099.jpg', 7, 'real/catalog/image-3099.jpg'),
(3100, 'catalog/image-3100.jpg', 7, 'real/catalog/image-3100.jpg'),
(3101, 'catalog/image-3101.jpg', 7, 'real/catalog/image-3101.jpg'),
(3102, 'catalog/image-3102.jpg', 7, 'real/catalog/image-3102.jpg'),
(3103, 'catalog/image-3103.jpg', 7, 'real/catalog/image-3103.jpg'),
(3104, 'catalog/image-3104.jpg', 7, 'real/catalog/image-3104.jpg'),
(3105, 'catalog/image-3105.jpg', 7, 'real/catalog/image-3105.jpg'),
(3111, 'catalog/image-3111.jpg', 1, 'real/catalog/image-3111.jpg'),
(3110, 'catalog/image-3110.jpg', 1, 'real/catalog/image-3110.jpg'),
(3112, 'catalog/image-3112.jpg', 1, 'real/catalog/image-3112.jpg'),
(3113, 'catalog/image-3113.jpg', 1, 'real/catalog/image-3113.jpg'),
(3114, 'catalog/image-3114.jpg', 1, 'real/catalog/image-3114.jpg'),
(3115, 'catalog/image-3115.gif', 1, 'real/catalog/image-3115.gif'),
(3116, 'catalog/image-3116.jpg', 1, 'real/catalog/image-3116.jpg'),
(3117, 'catalog/image-3117.jpg', 1, 'real/catalog/image-3117.jpg'),
(3118, 'catalog/image-3118.jpg', 7, 'real/catalog/image-3118.jpg'),
(3119, 'catalog/image-3119.jpg', 7, 'real/catalog/image-3119.jpg'),
(3120, 'catalog/image-3120.jpg', 7, 'real/catalog/image-3120.jpg'),
(3121, 'catalog/image-3121.jpg', 7, 'real/catalog/image-3121.jpg'),
(3128, 'catalog/image-3128.jpg', 7, 'real/catalog/image-3128.jpg'),
(3129, 'catalog/image-3129.jpg', 7, 'real/catalog/image-3129.jpg'),
(3140, 'catalog/image-3140.gif', 7, 'real/catalog/image-3140.gif'),
(3141, 'catalog/image-3141.gif', 7, 'real/catalog/image-3141.gif'),
(3146, 'catalog/image-3146.jpg', 7, 'real/catalog/image-3146.jpg'),
(3147, 'catalog/image-3147.jpg', 7, 'real/catalog/image-3147.jpg'),
(3156, 'catalog/image-3156.jpg', 7, 'real/catalog/image-3156.jpg'),
(3157, 'catalog/image-3157.jpg', 7, 'real/catalog/image-3157.jpg'),
(3162, 'catalog/image-3162.jpg', 7, 'real/catalog/image-3162.jpg'),
(3163, 'catalog/image-3163.jpg', 7, 'real/catalog/image-3163.jpg'),
(3170, 'catalog/image-3170.jpg', 7, 'real/catalog/image-3170.jpg'),
(3171, 'catalog/image-3171.jpg', 7, 'real/catalog/image-3171.jpg'),
(3172, 'catalog/image-3172.jpg', 7, 'real/catalog/image-3172.jpg'),
(3173, 'catalog/image-3173.jpg', 7, 'real/catalog/image-3173.jpg'),
(3176, 'catalog/image-3176.jpg', 7, 'real/catalog/image-3176.jpg'),
(3177, 'catalog/image-3177.jpg', 7, 'real/catalog/image-3177.jpg'),
(3184, 'catalog/image-3184.jpg', 7, 'real/catalog/image-3184.jpg'),
(3185, 'catalog/image-3185.jpg', 7, 'real/catalog/image-3185.jpg'),
(3190, 'catalog/image-3190.jpg', 7, 'real/catalog/image-3190.jpg'),
(3191, 'catalog/image-3191.jpg', 7, 'real/catalog/image-3191.jpg'),
(3200, 'catalog/image-3200.jpg', 7, 'real/catalog/image-3200.jpg'),
(3201, 'catalog/image-3201.jpg', 7, 'real/catalog/image-3201.jpg'),
(3206, 'catalog/image-3206.jpg', 7, 'real/catalog/image-3206.jpg'),
(3207, 'catalog/image-3207.jpg', 7, 'real/catalog/image-3207.jpg'),
(3208, 'catalog/image-3208.jpg', 7, 'real/catalog/image-3208.jpg'),
(3209, 'catalog/image-3209.jpg', 7, 'real/catalog/image-3209.jpg'),
(3210, 'catalog/image-3210.jpg', 7, 'real/catalog/image-3210.jpg'),
(3211, 'catalog/image-3211.jpg', 7, 'real/catalog/image-3211.jpg'),
(3222, 'catalog/image-3222.jpg', 7, 'real/catalog/image-3222.jpg'),
(3223, 'catalog/image-3223.jpg', 7, 'real/catalog/image-3223.jpg'),
(3224, 'catalog/image-3224.jpg', 7, 'real/catalog/image-3224.jpg'),
(3225, 'catalog/image-3225.jpg', 7, 'real/catalog/image-3225.jpg'),
(3226, 'catalog/image-3226.jpg', 7, 'real/catalog/image-3226.jpg'),
(3227, 'catalog/image-3227.jpg', 7, 'real/catalog/image-3227.jpg'),
(3228, 'catalog/image-3228.jpg', 7, 'real/catalog/image-3228.jpg'),
(3229, 'catalog/image-3229.jpg', 7, 'real/catalog/image-3229.jpg'),
(3236, 'catalog/image-3236.jpg', 7, 'real/catalog/image-3236.jpg'),
(3237, 'catalog/image-3237.jpg', 7, 'real/catalog/image-3237.jpg'),
(3238, 'catalog/image-3238.jpg', 7, 'real/catalog/image-3238.jpg'),
(3239, 'catalog/image-3239.jpg', 7, 'real/catalog/image-3239.jpg'),
(3244, 'catalog/image-3244.jpg', 7, 'real/catalog/image-3244.jpg'),
(3245, 'catalog/image-3245.jpg', 7, 'real/catalog/image-3245.jpg'),
(3246, 'catalog/image-3246.jpg', 7, 'real/catalog/image-3246.jpg'),
(3247, 'catalog/image-3247.jpg', 7, 'real/catalog/image-3247.jpg'),
(3250, 'catalog/image-3250.jpg', 7, 'real/catalog/image-3250.jpg'),
(3251, 'catalog/image-3251.jpg', 7, 'real/catalog/image-3251.jpg'),
(3260, 'catalog/image-3260.jpg', 7, 'real/catalog/image-3260.jpg'),
(3261, 'catalog/image-3261.jpg', 7, 'real/catalog/image-3261.jpg'),
(3262, 'catalog/image-3262.jpg', 7, 'real/catalog/image-3262.jpg'),
(3263, 'catalog/image-3263.jpg', 7, 'real/catalog/image-3263.jpg'),
(3276, 'catalog/image-3276.jpg', 7, 'real/catalog/image-3276.jpg'),
(3277, 'catalog/image-3277.jpg', 7, 'real/catalog/image-3277.jpg'),
(3278, 'catalog/image-3278.jpg', 7, 'real/catalog/image-3278.jpg'),
(3279, 'catalog/image-3279.jpg', 7, 'real/catalog/image-3279.jpg'),
(3290, 'catalog/image-3290.jpg', 7, 'real/catalog/image-3290.jpg'),
(3291, 'catalog/image-3291.jpg', 7, 'real/catalog/image-3291.jpg'),
(3292, 'catalog/image-3292.jpg', 7, 'real/catalog/image-3292.jpg'),
(3293, 'catalog/image-3293.jpg', 7, 'real/catalog/image-3293.jpg'),
(3296, 'catalog/image-3296.jpg', 7, 'real/catalog/image-3296.jpg'),
(3297, 'catalog/image-3297.jpg', 7, 'real/catalog/image-3297.jpg'),
(3298, 'catalog/image-3298.jpg', 7, 'real/catalog/image-3298.jpg'),
(3299, 'catalog/image-3299.jpg', 7, 'real/catalog/image-3299.jpg'),
(3300, 'catalog/image-3300.jpg', 7, 'real/catalog/image-3300.jpg'),
(3301, 'catalog/image-3301.jpg', 7, 'real/catalog/image-3301.jpg'),
(3306, 'catalog/image-3306.jpg', 7, 'real/catalog/image-3306.jpg'),
(3307, 'catalog/image-3307.jpg', 7, 'real/catalog/image-3307.jpg'),
(3322, 'catalog/image-3322.jpg', 7, 'real/catalog/image-3322.jpg'),
(3323, 'catalog/image-3323.jpg', 7, 'real/catalog/image-3323.jpg'),
(3324, 'catalog/image-3324.jpg', 7, 'real/catalog/image-3324.jpg'),
(3325, 'catalog/image-3325.jpg', 7, 'real/catalog/image-3325.jpg'),
(3344, 'catalog/image-3344.jpg', 7, 'real/catalog/image-3344.jpg'),
(3345, 'catalog/image-3345.jpg', 7, 'real/catalog/image-3345.jpg'),
(3350, 'catalog/image-3350.jpg', 7, 'real/catalog/image-3350.jpg'),
(3351, 'catalog/image-3351.jpg', 7, 'real/catalog/image-3351.jpg'),
(3356, 'catalog/image-3356.jpg', 7, 'real/catalog/image-3356.jpg'),
(3357, 'catalog/image-3357.jpg', 7, 'real/catalog/image-3357.jpg'),
(3358, 'catalog/image-3358.jpg', 7, 'real/catalog/image-3358.jpg'),
(3359, 'catalog/image-3359.jpg', 7, 'real/catalog/image-3359.jpg'),
(3364, 'catalog/image-3364.jpg', 7, 'real/catalog/image-3364.jpg'),
(3365, 'catalog/image-3365.jpg', 7, 'real/catalog/image-3365.jpg'),
(3366, 'catalog/image-3366.jpg', 7, 'real/catalog/image-3366.jpg'),
(3367, 'catalog/image-3367.jpg', 7, 'real/catalog/image-3367.jpg'),
(3368, 'catalog/image-3368.jpg', 7, 'real/catalog/image-3368.jpg'),
(3369, 'catalog/image-3369.jpg', 7, 'real/catalog/image-3369.jpg'),
(3370, 'catalog/image-3370.jpg', 7, 'real/catalog/image-3370.jpg'),
(3371, 'catalog/image-3371.jpg', 7, 'real/catalog/image-3371.jpg'),
(3374, 'catalog/image-3374.jpg', 7, 'real/catalog/image-3374.jpg'),
(3375, 'catalog/image-3375.jpg', 7, 'real/catalog/image-3375.jpg'),
(3376, 'catalog/image-3376.jpg', 7, 'real/catalog/image-3376.jpg'),
(3377, 'catalog/image-3377.jpg', 7, 'real/catalog/image-3377.jpg'),
(3382, 'catalog/image-3382.jpg', 7, 'real/catalog/image-3382.jpg'),
(3383, 'catalog/image-3383.jpg', 7, 'real/catalog/image-3383.jpg'),
(3384, 'catalog/image-3384.jpg', 7, 'real/catalog/image-3384.jpg'),
(3385, 'catalog/image-3385.jpg', 7, 'real/catalog/image-3385.jpg'),
(3386, 'catalog/image-3386.jpg', 7, 'real/catalog/image-3386.jpg'),
(3387, 'catalog/image-3387.jpg', 7, 'real/catalog/image-3387.jpg'),
(3388, 'catalog/image-3388.jpg', 7, 'real/catalog/image-3388.jpg'),
(3389, 'catalog/image-3389.jpg', 7, 'real/catalog/image-3389.jpg'),
(3390, 'catalog/image-3390.jpg', 7, 'real/catalog/image-3390.jpg'),
(3391, 'catalog/image-3391.jpg', 7, 'real/catalog/image-3391.jpg'),
(3394, 'catalog/image-3394.jpg', 7, 'real/catalog/image-3394.jpg'),
(3395, 'catalog/image-3395.jpg', 7, 'real/catalog/image-3395.jpg'),
(3396, 'catalog/image-3396.jpg', 7, 'real/catalog/image-3396.jpg'),
(3397, 'catalog/image-3397.jpg', 7, 'real/catalog/image-3397.jpg'),
(3404, 'catalog/image-3404.jpg', 7, 'real/catalog/image-3404.jpg'),
(3405, 'catalog/image-3405.jpg', 7, 'real/catalog/image-3405.jpg'),
(3406, 'catalog/image-3406.jpg', 7, 'real/catalog/image-3406.jpg'),
(3407, 'catalog/image-3407.jpg', 7, 'real/catalog/image-3407.jpg'),
(3410, 'catalog/image-3410.jpg', 7, 'real/catalog/image-3410.jpg'),
(3411, 'catalog/image-3411.jpg', 7, 'real/catalog/image-3411.jpg'),
(3412, 'catalog/image-3412.jpg', 7, 'real/catalog/image-3412.jpg'),
(3413, 'catalog/image-3413.jpg', 7, 'real/catalog/image-3413.jpg'),
(3416, 'catalog/image-3416.jpg', 7, 'real/catalog/image-3416.jpg'),
(3417, 'catalog/image-3417.jpg', 7, 'real/catalog/image-3417.jpg'),
(3418, 'catalog/image-3418.jpg', 7, 'real/catalog/image-3418.jpg'),
(3419, 'catalog/image-3419.jpg', 7, 'real/catalog/image-3419.jpg'),
(3422, 'catalog/image-3422.jpg', 7, 'real/catalog/image-3422.jpg'),
(3423, 'catalog/image-3423.jpg', 7, 'real/catalog/image-3423.jpg'),
(3424, 'catalog/image-3424.jpg', 7, 'real/catalog/image-3424.jpg'),
(3425, 'catalog/image-3425.jpg', 7, 'real/catalog/image-3425.jpg'),
(3430, 'catalog/image-3430.jpg', 7, 'real/catalog/image-3430.jpg'),
(3431, 'catalog/image-3431.jpg', 7, 'real/catalog/image-3431.jpg'),
(3432, 'catalog/image-3432.jpg', 7, 'real/catalog/image-3432.jpg'),
(3433, 'catalog/image-3433.jpg', 7, 'real/catalog/image-3433.jpg'),
(3436, 'catalog/image-3436.jpg', 7, 'real/catalog/image-3436.jpg'),
(3437, 'catalog/image-3437.jpg', 7, 'real/catalog/image-3437.jpg'),
(3438, 'catalog/image-3438.jpg', 7, 'real/catalog/image-3438.jpg'),
(3439, 'catalog/image-3439.jpg', 7, 'real/catalog/image-3439.jpg'),
(3442, 'catalog/image-3442.jpg', 7, 'real/catalog/image-3442.jpg'),
(3443, 'catalog/image-3443.jpg', 7, 'real/catalog/image-3443.jpg'),
(3444, 'catalog/image-3444.jpg', 7, 'real/catalog/image-3444.jpg'),
(3445, 'catalog/image-3445.jpg', 7, 'real/catalog/image-3445.jpg'),
(3448, 'catalog/image-3448.jpg', 7, 'real/catalog/image-3448.jpg'),
(3449, 'catalog/image-3449.jpg', 7, 'real/catalog/image-3449.jpg'),
(3450, 'catalog/image-3450.jpg', 7, 'real/catalog/image-3450.jpg'),
(3451, 'catalog/image-3451.jpg', 7, 'real/catalog/image-3451.jpg'),
(3454, 'catalog/image-3454.jpg', 7, 'real/catalog/image-3454.jpg'),
(3455, 'catalog/image-3455.jpg', 7, 'real/catalog/image-3455.jpg'),
(3456, 'catalog/image-3456.jpg', 7, 'real/catalog/image-3456.jpg'),
(3457, 'catalog/image-3457.jpg', 7, 'real/catalog/image-3457.jpg'),
(3460, 'catalog/image-3460.jpg', 7, 'real/catalog/image-3460.jpg'),
(3461, 'catalog/image-3461.jpg', 7, 'real/catalog/image-3461.jpg'),
(3462, 'catalog/image-3462.jpg', 7, 'real/catalog/image-3462.jpg'),
(3463, 'catalog/image-3463.jpg', 7, 'real/catalog/image-3463.jpg'),
(3466, 'catalog/image-3466.jpg', 7, 'real/catalog/image-3466.jpg'),
(3467, 'catalog/image-3467.jpg', 7, 'real/catalog/image-3467.jpg'),
(3468, 'catalog/image-3468.jpg', 7, 'real/catalog/image-3468.jpg'),
(3469, 'catalog/image-3469.jpg', 7, 'real/catalog/image-3469.jpg'),
(3472, 'catalog/image-3472.jpg', 1, 'real/catalog/image-3472.jpg'),
(3473, 'catalog/image-3473.jpg', 1, 'real/catalog/image-3473.jpg'),
(3474, 'catalog/image-3474.jpg', 7, 'real/catalog/image-3474.jpg'),
(3475, 'catalog/image-3475.jpg', 7, 'real/catalog/image-3475.jpg'),
(3476, 'catalog/image-3476.jpg', 7, 'real/catalog/image-3476.jpg'),
(3477, 'catalog/image-3477.gif', 7, 'real/catalog/image-3477.gif'),
(3478, 'catalog/image-3478.jpg', 1, 'real/catalog/image-3478.jpg'),
(3481, 'catalog/image-3481.jpg', 7, 'real/catalog/image-3481.jpg'),
(3482, 'catalog/image-3482.jpg', 7, 'real/catalog/image-3482.jpg'),
(3483, 'catalog/image-3483.jpg', 7, 'real/catalog/image-3483.jpg'),
(3484, 'catalog/image-3484.jpg', 7, 'real/catalog/image-3484.jpg'),
(3485, 'catalog/image-3485.jpg', 7, 'real/catalog/image-3485.jpg'),
(3486, 'catalog/image-3486.jpg', 7, 'real/catalog/image-3486.jpg'),
(3487, 'catalog/image-3487.jpg', 7, 'real/catalog/image-3487.jpg'),
(3488, 'catalog/image-3488.jpg', 7, 'real/catalog/image-3488.jpg'),
(3489, 'catalog/image-3489.jpg', 7, 'real/catalog/image-3489.jpg'),
(3490, 'catalog/image-3490.jpg', 7, 'real/catalog/image-3490.jpg'),
(3491, 'catalog/image-3491.jpg', 7, 'real/catalog/image-3491.jpg'),
(3492, 'catalog/image-3492.jpg', 7, 'real/catalog/image-3492.jpg'),
(3497, 'catalog/image-3497.jpg', 7, 'real/catalog/image-3497.jpg'),
(3498, 'catalog/image-3498.jpg', 7, 'real/catalog/image-3498.jpg'),
(3499, 'catalog/image-3499.jpg', 7, 'real/catalog/image-3499.jpg'),
(3500, 'catalog/image-3500.jpg', 7, 'real/catalog/image-3500.jpg'),
(3509, 'catalog/image-3509.jpg', 7, 'real/catalog/image-3509.jpg'),
(3510, 'catalog/image-3510.jpg', 7, 'real/catalog/image-3510.jpg'),
(3511, 'catalog/image-3511.jpg', 7, 'real/catalog/image-3511.jpg'),
(3512, 'catalog/image-3512.jpg', 7, 'real/catalog/image-3512.jpg'),
(3513, 'catalog/image-3513.jpg', 7, 'real/catalog/image-3513.jpg'),
(3514, 'catalog/image-3514.jpg', 7, 'real/catalog/image-3514.jpg'),
(3519, 'catalog/image-3519.jpg', 7, 'real/catalog/image-3519.jpg'),
(3520, 'catalog/image-3520.jpg', 7, 'real/catalog/image-3520.jpg'),
(3521, 'catalog/image-3521.jpg', 7, 'real/catalog/image-3521.jpg'),
(3522, 'catalog/image-3522.jpg', 7, 'real/catalog/image-3522.jpg'),
(3529, 'catalog/image-3529.jpg', 7, 'real/catalog/image-3529.jpg'),
(3530, 'catalog/image-3530.jpg', 7, 'real/catalog/image-3530.jpg'),
(3531, 'catalog/image-3531.jpg', 7, 'real/catalog/image-3531.jpg'),
(3532, 'catalog/image-3532.jpg', 7, 'real/catalog/image-3532.jpg'),
(3535, 'catalog/image-3535.jpg', 7, 'real/catalog/image-3535.jpg'),
(3536, 'catalog/image-3536.jpg', 7, 'real/catalog/image-3536.jpg'),
(3537, 'catalog/image-3537.jpg', 7, 'real/catalog/image-3537.jpg'),
(3538, 'catalog/image-3538.jpg', 7, 'real/catalog/image-3538.jpg'),
(3543, 'catalog/image-3543.jpg', 7, 'real/catalog/image-3543.jpg'),
(3544, 'catalog/image-3544.jpg', 7, 'real/catalog/image-3544.jpg'),
(3545, 'catalog/image-3545.jpg', 7, 'real/catalog/image-3545.jpg'),
(3546, 'catalog/image-3546.jpg', 7, 'real/catalog/image-3546.jpg'),
(3549, 'catalog/image-3549.jpg', 7, 'real/catalog/image-3549.jpg'),
(3550, 'catalog/image-3550.jpg', 7, 'real/catalog/image-3550.jpg'),
(3559, 'catalog/image-3559.jpg', 7, 'real/catalog/image-3559.jpg'),
(3560, 'catalog/image-3560.jpg', 7, 'real/catalog/image-3560.jpg'),
(3569, 'catalog/image-3569.jpeg', 1, 'real/catalog/image-3569.jpeg'),
(3570, 'catalog/image-3570.jpg', 7, 'real/catalog/image-3570.jpg'),
(3571, 'catalog/image-3571.jpg', 7, 'real/catalog/image-3571.jpg'),
(3574, 'catalog/image-3574.jpg', 7, 'real/catalog/image-3574.jpg'),
(3575, 'catalog/image-3575.jpg', 7, 'real/catalog/image-3575.jpg'),
(3582, 'catalog/image-3582.jpg', 7, 'real/catalog/image-3582.jpg'),
(3583, 'catalog/image-3583.jpg', 7, 'real/catalog/image-3583.jpg'),
(3586, 'catalog/image-3586.jpg', 7, 'real/catalog/image-3586.jpg'),
(3587, 'catalog/image-3587.jpg', 7, 'real/catalog/image-3587.jpg'),
(3592, 'catalog/image-3592.jpg', 7, 'real/catalog/image-3592.jpg'),
(3593, 'catalog/image-3593.jpg', 7, 'real/catalog/image-3593.jpg'),
(3594, 'catalog/image-3594.jpg', 7, 'real/catalog/image-3594.jpg'),
(3595, 'catalog/image-3595.jpg', 7, 'real/catalog/image-3595.jpg'),
(3612, 'catalog/image-3612.jpg', 7, 'real/catalog/image-3612.jpg'),
(3613, 'catalog/image-3613.jpg', 7, 'real/catalog/image-3613.jpg'),
(3614, 'catalog/image-3614.jpg', 7, 'real/catalog/image-3614.jpg'),
(3615, 'catalog/image-3615.jpg', 7, 'real/catalog/image-3615.jpg');
INSERT INTO `cake_images` (`id`, `url`, `image_type_id`, `real_url`) VALUES
(3618, 'catalog/image-3618.jpg', 7, 'real/catalog/image-3618.jpg'),
(3619, 'catalog/image-3619.jpg', 7, 'real/catalog/image-3619.jpg'),
(3620, 'catalog/image-3620.jpg', 7, 'real/catalog/image-3620.jpg'),
(3621, 'catalog/image-3621.jpg', 7, 'real/catalog/image-3621.jpg'),
(3622, 'catalog/image-3622.jpg', 7, 'real/catalog/image-3622.jpg'),
(3623, 'catalog/image-3623.jpg', 7, 'real/catalog/image-3623.jpg'),
(3650, 'catalog/image-3650.jpg', 7, 'real/catalog/image-3650.jpg'),
(3651, 'catalog/image-3651.jpg', 7, 'real/catalog/image-3651.jpg'),
(3652, 'catalog/image-3652.jpg', 7, 'real/catalog/image-3652.jpg'),
(3653, 'catalog/image-3653.jpg', 7, 'real/catalog/image-3653.jpg'),
(3656, 'catalog/image-3656.jpg', 7, 'real/catalog/image-3656.jpg'),
(3657, 'catalog/image-3657.jpg', 7, 'real/catalog/image-3657.jpg'),
(3658, 'catalog/image-3658.jpg', 7, 'real/catalog/image-3658.jpg'),
(3659, 'catalog/image-3659.jpg', 7, 'real/catalog/image-3659.jpg'),
(3660, 'catalog/image-3660.jpg', 7, 'real/catalog/image-3660.jpg'),
(3661, 'catalog/image-3661.jpg', 7, 'real/catalog/image-3661.jpg'),
(3664, 'catalog/image-3664.jpg', 7, 'real/catalog/image-3664.jpg'),
(3665, 'catalog/image-3665.jpg', 7, 'real/catalog/image-3665.jpg'),
(3668, 'catalog/image-3668.jpg', 1, 'real/catalog/image-3668.jpg'),
(3673, 'catalog/image-3673.jpg', 7, 'real/catalog/image-3673.jpg'),
(3674, 'catalog/image-3674.jpg', 7, 'real/catalog/image-3674.jpg'),
(3675, 'catalog/image-3675.jpg', 7, 'real/catalog/image-3675.jpg'),
(3676, 'catalog/image-3676.jpg', 7, 'real/catalog/image-3676.jpg'),
(3679, 'catalog/image-3679.jpg', 7, 'real/catalog/image-3679.jpg'),
(3680, 'catalog/image-3680.jpg', 7, 'real/catalog/image-3680.jpg'),
(3681, 'catalog/image-3681.jpg', 7, 'real/catalog/image-3681.jpg'),
(3682, 'catalog/image-3682.jpg', 7, 'real/catalog/image-3682.jpg'),
(3683, 'catalog/image-3683.jpg', 7, 'real/catalog/image-3683.jpg'),
(3684, 'catalog/image-3684.jpg', 7, 'real/catalog/image-3684.jpg'),
(3689, 'catalog/image-3689.jpg', 7, 'real/catalog/image-3689.jpg'),
(3690, 'catalog/image-3690.jpg', 7, 'real/catalog/image-3690.jpg'),
(3691, 'catalog/image-3691.jpg', 7, 'real/catalog/image-3691.jpg'),
(3692, 'catalog/image-3692.jpg', 7, 'real/catalog/image-3692.jpg'),
(3717, 'catalog/image-3717.jpg', 7, 'real/catalog/image-3717.jpg'),
(3718, 'catalog/image-3718.jpg', 7, 'real/catalog/image-3718.jpg'),
(3719, 'catalog/image-3719.jpg', 7, 'real/catalog/image-3719.jpg'),
(3720, 'catalog/image-3720.jpg', 7, 'real/catalog/image-3720.jpg'),
(3725, 'catalog/image-3725.jpg', 7, 'real/catalog/image-3725.jpg'),
(3726, 'catalog/image-3726.jpg', 7, 'real/catalog/image-3726.jpg'),
(3727, 'catalog/image-3727.jpg', 7, 'real/catalog/image-3727.jpg'),
(3728, 'catalog/image-3728.jpg', 7, 'real/catalog/image-3728.jpg'),
(3773, 'catalog/image-3773.jpg', 1, 'real/catalog/image-3773.jpg'),
(3774, 'catalog/image-3774.jpg', 1, 'real/catalog/image-3774.jpg'),
(3775, 'catalog/image-3775.jpg', 1, 'real/catalog/image-3775.jpg'),
(3776, 'catalog/image-3776.jpg', 1, 'real/catalog/image-3776.jpg'),
(3777, 'templates/image-3777.jpg', 6, 'real/templates/image-3777.jpg'),
(5623, 'catalog/image-5623.jpg', 1, 'real/catalog/image-5623.jpg'),
(5620, 'catalog/image-5620.jpg', 1, 'real/catalog/image-5620.jpg'),
(5621, 'catalog/image-5621.jpg', 1, 'real/catalog/image-5621.jpg'),
(5612, 'catalog/image-5612.jpg', 1, 'real/catalog/image-5612.jpg'),
(5611, 'catalog/image-5611.jpg', 1, 'real/catalog/image-5611.jpg'),
(5597, 'catalog/image-5597.jpg', 1, 'real/catalog/image-5597.jpg'),
(5598, 'catalog/image-5598.jpg', 1, 'real/catalog/image-5598.jpg'),
(5599, 'catalog/image-5599.jpg', 1, 'real/catalog/image-5599.jpg'),
(5600, 'catalog/image-5600.jpg', 1, 'real/catalog/image-5600.jpg'),
(5601, 'catalog/image-5601.jpg', 1, 'real/catalog/image-5601.jpg'),
(5602, 'catalog/image-5602.jpg', 1, 'real/catalog/image-5602.jpg'),
(5610, 'catalog/image-5610.jpg', 1, 'real/catalog/image-5610.jpg'),
(5605, 'catalog/image-5605.jpg', 1, 'real/catalog/image-5605.jpg'),
(5606, 'catalog/image-5606.jpg', 1, 'real/catalog/image-5606.jpg'),
(5607, 'catalog/image-5607.jpg', 1, 'real/catalog/image-5607.jpg'),
(5608, 'catalog/image-5608.jpg', 1, 'real/catalog/image-5608.jpg'),
(5609, 'catalog/image-5609.jpg', 1, 'real/catalog/image-5609.jpg'),
(4569, 'catalog/image-4569.jpg', 1, 'real/catalog/image-4569.jpg'),
(5659, 'catalog/image-5659.jpg', 1, 'real/catalog/image-5659.jpg'),
(5653, 'catalog/image-5653.jpg', 1, 'real/catalog/image-5653.jpg'),
(5626, 'catalog/image-5626.jpg', 1, 'real/catalog/image-5626.jpg'),
(5658, 'catalog/image-5658.jpg', 1, 'real/catalog/image-5658.jpg'),
(5657, 'catalog/image-5657.jpg', 1, 'real/catalog/image-5657.jpg'),
(5656, 'catalog/image-5656.jpg', 1, 'real/catalog/image-5656.jpg'),
(5652, 'catalog/image-5652.jpg', 1, 'real/catalog/image-5652.jpg'),
(5624, 'catalog/image-5624.jpg', 1, 'real/catalog/image-5624.jpg'),
(4294, 'catalog/image-4294.jpeg', 1, 'real/catalog/image-4294.jpeg'),
(4809, 'catalog/image-4809.jpg', 7, 'real/catalog/image-4809.jpg'),
(4293, 'catalog/image-4293.jpeg', 1, 'real/catalog/image-4293.jpeg'),
(4292, 'catalog/image-4292.jpeg', 1, 'real/catalog/image-4292.jpeg'),
(4291, 'catalog/image-4291.jpeg', 1, 'real/catalog/image-4291.jpeg'),
(4811, 'catalog/image-4811.jpg', 7, 'real/catalog/image-4811.jpg'),
(4812, 'catalog/image-4812.jpg', 7, 'real/catalog/image-4812.jpg'),
(4813, 'catalog/image-4813.jpg', 7, 'real/catalog/image-4813.jpg'),
(3779, 'catalog/image-3779.jpg', 7, 'real/catalog/image-3779.jpg'),
(3780, 'catalog/image-3780.jpg', 7, 'real/catalog/image-3780.jpg'),
(3781, 'catalog/image-3781.jpg', 7, 'real/catalog/image-3781.jpg'),
(3782, 'catalog/image-3782.jpg', 7, 'real/catalog/image-3782.jpg'),
(3787, 'catalog/image-3787.jpg', 7, 'real/catalog/image-3787.jpg'),
(3788, 'catalog/image-3788.jpg', 7, 'real/catalog/image-3788.jpg'),
(3789, 'catalog/image-3789.jpg', 7, 'real/catalog/image-3789.jpg'),
(3790, 'catalog/image-3790.jpg', 7, 'real/catalog/image-3790.jpg'),
(3791, 'catalog/image-3791.jpg', 7, 'real/catalog/image-3791.jpg'),
(3792, 'catalog/image-3792.jpg', 7, 'real/catalog/image-3792.jpg'),
(3797, 'catalog/image-3797.jpg', 7, 'real/catalog/image-3797.jpg'),
(3798, 'catalog/image-3798.jpg', 7, 'real/catalog/image-3798.jpg'),
(3799, 'catalog/image-3799.jpg', 7, 'real/catalog/image-3799.jpg'),
(3800, 'catalog/image-3800.jpg', 7, 'real/catalog/image-3800.jpg'),
(3805, 'catalog/image-3805.jpg', 7, 'real/catalog/image-3805.jpg'),
(3806, 'catalog/image-3806.jpg', 7, 'real/catalog/image-3806.jpg'),
(3807, 'catalog/image-3807.jpg', 7, 'real/catalog/image-3807.jpg'),
(3808, 'catalog/image-3808.jpg', 7, 'real/catalog/image-3808.jpg'),
(3837, 'catalog/image-3837.jpeg', 1, 'real/catalog/image-3837.jpeg'),
(3852, 'catalog/image-3852.jpg', 1, 'real/catalog/image-3852.jpg'),
(3853, 'catalog/image-3853.jpg', 1, 'real/catalog/image-3853.jpg'),
(3854, 'catalog/image-3854.jpg', 1, 'real/catalog/image-3854.jpg'),
(3855, 'catalog/image-3855.jpg', 1, 'real/catalog/image-3855.jpg'),
(3856, 'catalog/image-3856.jpg', 1, 'real/catalog/image-3856.jpg'),
(3857, 'catalog/image-3857.jpg', 7, 'real/catalog/image-3857.jpg'),
(3858, 'catalog/image-3858.jpg', 7, 'real/catalog/image-3858.jpg'),
(3859, 'catalog/image-3859.jpg', 7, 'real/catalog/image-3859.jpg'),
(3860, 'catalog/image-3860.jpg', 7, 'real/catalog/image-3860.jpg'),
(3867, 'catalog/image-3867.jpg', 7, 'real/catalog/image-3867.jpg'),
(3868, 'catalog/image-3868.jpg', 7, 'real/catalog/image-3868.jpg'),
(3869, 'catalog/image-3869.jpg', 7, 'real/catalog/image-3869.jpg'),
(3870, 'catalog/image-3870.jpg', 7, 'real/catalog/image-3870.jpg'),
(3875, 'catalog/image-3875.jpg', 7, 'real/catalog/image-3875.jpg'),
(3876, 'catalog/image-3876.jpg', 7, 'real/catalog/image-3876.jpg'),
(3877, 'catalog/image-3877.jpg', 7, 'real/catalog/image-3877.jpg'),
(3878, 'catalog/image-3878.jpg', 7, 'real/catalog/image-3878.jpg'),
(3879, 'catalog/image-3879.jpg', 7, 'real/catalog/image-3879.jpg'),
(3880, 'catalog/image-3880.jpg', 7, 'real/catalog/image-3880.jpg'),
(3891, 'catalog/image-3891.jpg', 7, 'real/catalog/image-3891.jpg'),
(3892, 'catalog/image-3892.jpg', 7, 'real/catalog/image-3892.jpg'),
(3893, 'catalog/image-3893.jpg', 7, 'real/catalog/image-3893.jpg'),
(3894, 'catalog/image-3894.jpg', 7, 'real/catalog/image-3894.jpg'),
(3895, 'catalog/image-3895.jpg', 7, 'real/catalog/image-3895.jpg'),
(3896, 'catalog/image-3896.jpg', 7, 'real/catalog/image-3896.jpg'),
(3897, 'catalog/image-3897.jpg', 7, 'real/catalog/image-3897.jpg'),
(3898, 'catalog/image-3898.jpg', 7, 'real/catalog/image-3898.jpg'),
(3899, 'catalog/image-3899.jpg', 7, 'real/catalog/image-3899.jpg'),
(3900, 'catalog/image-3900.jpg', 7, 'real/catalog/image-3900.jpg'),
(3901, 'catalog/image-3901.jpg', 7, 'real/catalog/image-3901.jpg'),
(3902, 'catalog/image-3902.jpg', 7, 'real/catalog/image-3902.jpg'),
(3905, 'catalog/image-3905.jpg', 7, 'real/catalog/image-3905.jpg'),
(3906, 'catalog/image-3906.jpg', 7, 'real/catalog/image-3906.jpg'),
(3907, 'catalog/image-3907.jpg', 7, 'real/catalog/image-3907.jpg'),
(3908, 'catalog/image-3908.jpg', 7, 'real/catalog/image-3908.jpg'),
(3909, 'catalog/image-3909.jpg', 7, 'real/catalog/image-3909.jpg'),
(3910, 'catalog/image-3910.jpg', 7, 'real/catalog/image-3910.jpg'),
(3915, 'catalog/image-3915.JPG', 7, 'real/catalog/image-3915.JPG'),
(3916, 'catalog/image-3916.JPG', 7, 'real/catalog/image-3916.JPG'),
(3917, 'catalog/image-3917.JPG', 7, 'real/catalog/image-3917.JPG'),
(3918, 'catalog/image-3918.JPG', 7, 'real/catalog/image-3918.JPG'),
(3919, 'catalog/image-3919.JPG', 7, 'real/catalog/image-3919.JPG'),
(3920, 'catalog/image-3920.JPG', 7, 'real/catalog/image-3920.JPG'),
(3937, 'catalog/image-3937.JPG', 1, 'real/catalog/image-3937.JPG'),
(3938, 'catalog/image-3938.jpg', 1, 'real/catalog/image-3938.jpg'),
(3939, 'catalog/image-3939.jpg', 7, 'real/catalog/image-3939.jpg'),
(3940, 'catalog/image-3940.jpg', 7, 'real/catalog/image-3940.jpg'),
(3941, 'catalog/image-3941.jpg', 7, 'real/catalog/image-3941.jpg'),
(3942, 'catalog/image-3942.jpg', 7, 'real/catalog/image-3942.jpg'),
(3975, 'catalog/image-3975.jpg', 7, 'real/catalog/image-3975.jpg'),
(3976, 'catalog/image-3976.jpg', 7, 'real/catalog/image-3976.jpg'),
(3977, 'catalog/image-3977.jpg', 7, 'real/catalog/image-3977.jpg'),
(3978, 'catalog/image-3978.jpg', 7, 'real/catalog/image-3978.jpg'),
(3983, 'catalog/image-3983.jpg', 7, 'real/catalog/image-3983.jpg'),
(3984, 'catalog/image-3984.jpg', 7, 'real/catalog/image-3984.jpg'),
(3985, 'catalog/image-3985.jpg', 7, 'real/catalog/image-3985.jpg'),
(3986, 'catalog/image-3986.jpg', 7, 'real/catalog/image-3986.jpg'),
(4001, 'catalog/image-4001.jpg', 7, 'real/catalog/image-4001.jpg'),
(4002, 'catalog/image-4002.jpg', 7, 'real/catalog/image-4002.jpg'),
(4003, 'catalog/image-4003.jpg', 7, 'real/catalog/image-4003.jpg'),
(4004, 'catalog/image-4004.jpg', 7, 'real/catalog/image-4004.jpg'),
(4009, 'catalog/image-4009.jpg', 7, 'real/catalog/image-4009.jpg'),
(4010, 'catalog/image-4010.jpg', 7, 'real/catalog/image-4010.jpg'),
(4011, 'catalog/image-4011.jpg', 7, 'real/catalog/image-4011.jpg'),
(4012, 'catalog/image-4012.jpg', 7, 'real/catalog/image-4012.jpg'),
(4013, 'catalog/image-4013.jpg', 7, 'real/catalog/image-4013.jpg'),
(4014, 'catalog/image-4014.jpg', 7, 'real/catalog/image-4014.jpg'),
(4019, 'catalog/image-4019.jpg', 7, 'real/catalog/image-4019.jpg'),
(4020, 'catalog/image-4020.jpg', 7, 'real/catalog/image-4020.jpg'),
(4021, 'catalog/image-4021.jpg', 7, 'real/catalog/image-4021.jpg'),
(4022, 'catalog/image-4022.jpg', 7, 'real/catalog/image-4022.jpg'),
(4023, 'catalog/image-4023.jpg', 7, 'real/catalog/image-4023.jpg'),
(4024, 'catalog/image-4024.jpg', 7, 'real/catalog/image-4024.jpg'),
(4025, 'catalog/image-4025.jpg', 7, 'real/catalog/image-4025.jpg'),
(4026, 'catalog/image-4026.jpg', 7, 'real/catalog/image-4026.jpg'),
(4027, 'catalog/image-4027.jpg', 7, 'real/catalog/image-4027.jpg'),
(4028, 'catalog/image-4028.jpg', 7, 'real/catalog/image-4028.jpg'),
(4029, 'catalog/image-4029.jpg', 7, 'real/catalog/image-4029.jpg'),
(4030, 'catalog/image-4030.jpg', 7, 'real/catalog/image-4030.jpg'),
(4031, 'catalog/image-4031.jpg', 7, 'real/catalog/image-4031.jpg'),
(4032, 'catalog/image-4032.jpg', 7, 'real/catalog/image-4032.jpg'),
(4033, 'catalog/image-4033.jpg', 7, 'real/catalog/image-4033.jpg'),
(4034, 'catalog/image-4034.jpg', 7, 'real/catalog/image-4034.jpg'),
(4055, 'catalog/image-4055.jpeg', 1, 'real/catalog/image-4055.jpeg'),
(4056, 'catalog/image-4056.jpeg', 1, 'real/catalog/image-4056.jpeg'),
(4057, 'catalog/image-4057.jpeg', 1, 'real/catalog/image-4057.jpeg'),
(4060, 'catalog/image-4060.jpg', 7, 'real/catalog/image-4060.jpg'),
(4061, 'catalog/image-4061.jpg', 7, 'real/catalog/image-4061.jpg'),
(4062, 'catalog/image-4062.jpg', 7, 'real/catalog/image-4062.jpg'),
(4063, 'catalog/image-4063.jpg', 7, 'real/catalog/image-4063.jpg'),
(4180, 'design/image-4180.pdf', 3, 'real/design/image-4180.pdf'),
(4181, 'design/image-4181.pdf', 3, 'real/design/image-4181.pdf'),
(4192, 'catalog/image-4192.jpg', 7, 'real/catalog/image-4192.jpg'),
(4193, 'catalog/image-4193.jpg', 7, 'real/catalog/image-4193.jpg'),
(4194, 'catalog/image-4194.jpg', 7, 'real/catalog/image-4194.jpg'),
(4195, 'catalog/image-4195.jpg', 7, 'real/catalog/image-4195.jpg'),
(4196, 'catalog/image-4196.jpg', 7, 'real/catalog/image-4196.jpg'),
(4197, 'catalog/image-4197.jpg', 7, 'real/catalog/image-4197.jpg'),
(4208, 'catalog/image-4208.jpg', 7, 'real/catalog/image-4208.jpg'),
(4209, 'catalog/image-4209.jpg', 7, 'real/catalog/image-4209.jpg'),
(4210, 'catalog/image-4210.jpg', 7, 'real/catalog/image-4210.jpg'),
(4211, 'catalog/image-4211.jpg', 7, 'real/catalog/image-4211.jpg'),
(4212, 'catalog/image-4212.jpg', 7, 'real/catalog/image-4212.jpg'),
(4213, 'catalog/image-4213.jpg', 7, 'real/catalog/image-4213.jpg'),
(4214, 'catalog/image-4214.jpg', 7, 'real/catalog/image-4214.jpg'),
(4215, 'catalog/image-4215.jpg', 7, 'real/catalog/image-4215.jpg'),
(4216, 'catalog/image-4216.jpg', 7, 'real/catalog/image-4216.jpg'),
(4217, 'catalog/image-4217.jpg', 7, 'real/catalog/image-4217.jpg'),
(4218, 'catalog/image-4218.jpg', 7, 'real/catalog/image-4218.jpg'),
(4219, 'catalog/image-4219.jpg', 7, 'real/catalog/image-4219.jpg'),
(4220, 'catalog/image-4220.jpg', 7, 'real/catalog/image-4220.jpg'),
(4221, 'catalog/image-4221.jpg', 7, 'real/catalog/image-4221.jpg'),
(4222, 'catalog/image-4222.jpg', 7, 'real/catalog/image-4222.jpg'),
(4223, 'catalog/image-4223.jpg', 7, 'real/catalog/image-4223.jpg'),
(4224, 'catalog/image-4224.jpg', 7, 'real/catalog/image-4224.jpg'),
(4225, 'catalog/image-4225.jpeg', 7, 'real/catalog/image-4225.jpeg'),
(4226, 'catalog/image-4226.jpg', 7, 'real/catalog/image-4226.jpg'),
(4227, 'catalog/image-4227.jpeg', 7, 'real/catalog/image-4227.jpeg'),
(4228, 'catalog/image-4228.jpg', 7, 'real/catalog/image-4228.jpg'),
(4229, 'catalog/image-4229.jpg', 7, 'real/catalog/image-4229.jpg'),
(4230, 'catalog/image-4230.jpg', 7, 'real/catalog/image-4230.jpg'),
(4231, 'catalog/image-4231.jpg', 7, 'real/catalog/image-4231.jpg'),
(4232, 'catalog/image-4232.jpg', 7, 'real/catalog/image-4232.jpg'),
(4233, 'catalog/image-4233.jpg', 7, 'real/catalog/image-4233.jpg'),
(4234, 'catalog/image-4234.jpg', 7, 'real/catalog/image-4234.jpg'),
(4235, 'catalog/image-4235.jpg', 7, 'real/catalog/image-4235.jpg'),
(4256, 'catalog/image-4256.jpg', 1, 'real/catalog/image-4256.jpg'),
(4257, 'catalog/image-4257.jpg', 1, 'real/catalog/image-4257.jpg'),
(4331, 'catalog/image-4331.jpg', 7, 'real/catalog/image-4331.jpg'),
(4332, 'catalog/image-4332.jpg', 7, 'real/catalog/image-4332.jpg'),
(4425, 'catalog/image-4425.jpeg', 1, 'real/catalog/image-4425.jpeg'),
(4426, 'catalog/image-4426.jpeg', 1, 'real/catalog/image-4426.jpeg'),
(4451, 'catalog/image-4451.jpg', 7, 'real/catalog/image-4451.jpg'),
(4452, 'catalog/image-4452.jpg', 7, 'real/catalog/image-4452.jpg'),
(4455, 'catalog/image-4455.jpg', 7, 'real/catalog/image-4455.jpg'),
(4456, 'catalog/image-4456.jpg', 7, 'real/catalog/image-4456.jpg'),
(4457, 'catalog/image-4457.jpg', 7, 'real/catalog/image-4457.jpg'),
(4458, 'catalog/image-4458.jpg', 7, 'real/catalog/image-4458.jpg'),
(4461, 'catalog/image-4461.jpg', 7, 'real/catalog/image-4461.jpg'),
(4462, 'catalog/image-4462.jpg', 7, 'real/catalog/image-4462.jpg'),
(4463, 'catalog/image-4463.jpg', 7, 'real/catalog/image-4463.jpg'),
(4464, 'catalog/image-4464.jpg', 7, 'real/catalog/image-4464.jpg'),
(4570, 'catalog/image-4570.jpg', 1, 'real/catalog/image-4570.jpg'),
(4593, 'catalog/image-4593.jpg', 1, 'real/catalog/image-4593.jpg'),
(4594, 'catalog/image-4594.jpg', 1, 'real/catalog/image-4594.jpg'),
(4595, 'catalog/image-4595.jpg', 1, 'real/catalog/image-4595.jpg'),
(4596, 'catalog/image-4596.jpg', 1, 'real/catalog/image-4596.jpg'),
(4597, 'catalog/image-4597.jpg', 1, 'real/catalog/image-4597.jpg'),
(4598, 'catalog/image-4598.jpg', 1, 'real/catalog/image-4598.jpg'),
(4599, 'catalog/image-4599.jpg', 1, 'real/catalog/image-4599.jpg'),
(4600, 'catalog/image-4600.jpg', 1, 'real/catalog/image-4600.jpg'),
(4601, 'catalog/image-4601.jpg', 1, 'real/catalog/image-4601.jpg'),
(4602, 'catalog/image-4602.jpg', 1, 'real/catalog/image-4602.jpg'),
(4603, 'catalog/image-4603.jpeg', 1, 'real/catalog/image-4603.jpeg'),
(4604, 'catalog/image-4604.jpeg', 1, 'real/catalog/image-4604.jpeg'),
(4637, 'catalog/image-4637.jpeg', 1, 'real/catalog/image-4637.jpeg'),
(4638, 'catalog/image-4638.jpeg', 1, 'real/catalog/image-4638.jpeg'),
(4643, 'catalog/image-4643.jpg', 1, 'real/catalog/image-4643.jpg'),
(4644, 'catalog/image-4644.jpg', 1, 'real/catalog/image-4644.jpg'),
(4703, 'catalog/image-4703.jpg', 7, 'real/catalog/image-4703.jpg'),
(4704, 'catalog/image-4704.jpg', 7, 'real/catalog/image-4704.jpg'),
(4705, 'catalog/image-4705.jpg', 7, 'real/catalog/image-4705.jpg'),
(4706, 'catalog/image-4706.jpg', 7, 'real/catalog/image-4706.jpg'),
(4707, 'catalog/image-4707.jpg', 7, 'real/catalog/image-4707.jpg'),
(4708, 'catalog/image-4708.jpg', 7, 'real/catalog/image-4708.jpg'),
(4709, 'catalog/image-4709.jpg', 7, 'real/catalog/image-4709.jpg'),
(4710, 'catalog/image-4710.jpg', 7, 'real/catalog/image-4710.jpg'),
(4713, 'catalog/image-4713.jpg', 1, 'real/catalog/image-4713.jpg'),
(4714, 'catalog/image-4714.jpg', 1, 'real/catalog/image-4714.jpg'),
(4721, 'catalog/image-4721.jpg', 7, 'real/catalog/image-4721.jpg'),
(4722, 'catalog/image-4722.jpg', 7, 'real/catalog/image-4722.jpg'),
(4723, 'catalog/image-4723.jpeg', 7, 'real/catalog/image-4723.jpeg'),
(4724, 'catalog/image-4724.jpeg', 7, 'real/catalog/image-4724.jpeg'),
(4725, 'catalog/image-4725.jpg', 7, 'real/catalog/image-4725.jpg'),
(4726, 'catalog/image-4726.jpg', 7, 'real/catalog/image-4726.jpg'),
(4727, 'catalog/image-4727.jpeg', 7, 'real/catalog/image-4727.jpeg'),
(4728, 'catalog/image-4728.jpeg', 7, 'real/catalog/image-4728.jpeg'),
(4729, 'catalog/image-4729.jpg', 7, 'real/catalog/image-4729.jpg'),
(4730, 'catalog/image-4730.jpg', 7, 'real/catalog/image-4730.jpg'),
(4731, 'catalog/image-4731.jpg', 7, 'real/catalog/image-4731.jpg'),
(4732, 'catalog/image-4732.jpg', 7, 'real/catalog/image-4732.jpg'),
(4733, 'catalog/image-4733.jpg', 7, 'real/catalog/image-4733.jpg'),
(4734, 'catalog/image-4734.jpg', 7, 'real/catalog/image-4734.jpg'),
(4737, 'catalog/image-4737.jpeg', 7, 'real/catalog/image-4737.jpeg'),
(4738, 'catalog/image-4738.jpeg', 7, 'real/catalog/image-4738.jpeg'),
(4739, 'catalog/image-4739.jpg', 7, 'real/catalog/image-4739.jpg'),
(4740, 'catalog/image-4740.jpg', 7, 'real/catalog/image-4740.jpg'),
(4741, 'catalog/image-4741.jpeg', 7, 'real/catalog/image-4741.jpeg'),
(4742, 'catalog/image-4742.jpeg', 7, 'real/catalog/image-4742.jpeg'),
(4743, 'catalog/image-4743.jpeg', 7, 'real/catalog/image-4743.jpeg'),
(4744, 'catalog/image-4744.jpeg', 7, 'real/catalog/image-4744.jpeg'),
(4749, 'catalog/image-4749.jpg', 7, 'real/catalog/image-4749.jpg'),
(4750, 'catalog/image-4750.jpg', 7, 'real/catalog/image-4750.jpg'),
(4751, 'catalog/image-4751.jpg', 7, 'real/catalog/image-4751.jpg'),
(4752, 'catalog/image-4752.jpg', 7, 'real/catalog/image-4752.jpg'),
(4753, 'catalog/image-4753.jpeg', 7, 'real/catalog/image-4753.jpeg'),
(4754, 'catalog/image-4754.jpeg', 7, 'real/catalog/image-4754.jpeg'),
(4755, 'catalog/image-4755.jpg', 7, 'real/catalog/image-4755.jpg'),
(4756, 'catalog/image-4756.jpg', 7, 'real/catalog/image-4756.jpg'),
(4757, 'catalog/image-4757.jpg', 7, 'real/catalog/image-4757.jpg'),
(4758, 'catalog/image-4758.jpg', 7, 'real/catalog/image-4758.jpg'),
(4763, 'catalog/image-4763.jpeg', 7, 'real/catalog/image-4763.jpeg'),
(4764, 'catalog/image-4764.jpeg', 7, 'real/catalog/image-4764.jpeg'),
(4767, 'catalog/image-4767.jpg', 7, 'real/catalog/image-4767.jpg'),
(4768, 'catalog/image-4768.jpg', 7, 'real/catalog/image-4768.jpg'),
(4771, 'catalog/image-4771.jpg', 7, 'real/catalog/image-4771.jpg'),
(4772, 'catalog/image-4772.jpg', 7, 'real/catalog/image-4772.jpg'),
(4773, 'catalog/image-4773.jpg', 7, 'real/catalog/image-4773.jpg'),
(4774, 'catalog/image-4774.jpg', 7, 'real/catalog/image-4774.jpg'),
(4775, 'catalog/image-4775.jpeg', 7, 'real/catalog/image-4775.jpeg'),
(4776, 'catalog/image-4776.jpeg', 7, 'real/catalog/image-4776.jpeg'),
(4783, 'catalog/image-4783.jpg', 7, 'real/catalog/image-4783.jpg'),
(4784, 'catalog/image-4784.jpg', 7, 'real/catalog/image-4784.jpg'),
(4791, 'catalog/image-4791.jpeg', 7, 'real/catalog/image-4791.jpeg'),
(4792, 'catalog/image-4792.jpeg', 7, 'real/catalog/image-4792.jpeg'),
(4793, 'catalog/image-4793.jpeg', 7, 'real/catalog/image-4793.jpeg'),
(4794, 'catalog/image-4794.jpeg', 7, 'real/catalog/image-4794.jpeg'),
(4803, 'catalog/image-4803.jpg', 7, 'real/catalog/image-4803.jpg'),
(4804, 'catalog/image-4804.jpg', 7, 'real/catalog/image-4804.jpg'),
(4805, 'catalog/image-4805.jpg', 7, 'real/catalog/image-4805.jpg'),
(4806, 'catalog/image-4806.jpg', 7, 'real/catalog/image-4806.jpg'),
(4816, 'catalog/image-4816.jpg', 7, 'real/catalog/image-4816.jpg'),
(4863, 'catalog/image-4863.jpg', 7, 'real/catalog/image-4863.jpg'),
(4864, 'catalog/image-4864.jpg', 7, 'real/catalog/image-4864.jpg'),
(4869, 'catalog/image-4869.jpg', 7, 'real/catalog/image-4869.jpg'),
(4870, 'catalog/image-4870.jpg', 7, 'real/catalog/image-4870.jpg'),
(4899, 'catalog/image-4899.jpg', 1, 'real/catalog/image-4899.jpg'),
(4900, 'catalog/image-4900.jpg', 1, 'real/catalog/image-4900.jpg'),
(4901, 'catalog/image-4901.jpg', 1, 'real/catalog/image-4901.jpg'),
(4902, 'catalog/image-4902.jpg', 1, 'real/catalog/image-4902.jpg'),
(4911, 'catalog/image-4911.jpeg', 1, 'real/catalog/image-4911.jpeg'),
(4912, 'catalog/image-4912.jpeg', 1, 'real/catalog/image-4912.jpeg'),
(4913, 'catalog/image-4913.jpg', 1, 'real/catalog/image-4913.jpg'),
(4914, 'catalog/image-4914.jpg', 1, 'real/catalog/image-4914.jpg'),
(4921, 'catalog/image-4921.jpg', 1, 'real/catalog/image-4921.jpg'),
(4922, 'catalog/image-4922.jpg', 1, 'real/catalog/image-4922.jpg'),
(4923, 'catalog/image-4923.jpeg', 1, 'real/catalog/image-4923.jpeg'),
(4924, 'catalog/image-4924.jpeg', 1, 'real/catalog/image-4924.jpeg'),
(4929, 'catalog/image-4929.jpg', 7, 'real/catalog/image-4929.jpg'),
(4930, 'catalog/image-4930.jpg', 7, 'real/catalog/image-4930.jpg'),
(4933, 'catalog/image-4933.jpg', 7, 'real/catalog/image-4933.jpg'),
(4934, 'catalog/image-4934.jpg', 7, 'real/catalog/image-4934.jpg'),
(4941, 'catalog/image-4941.jpg', 7, 'real/catalog/image-4941.jpg'),
(4942, 'catalog/image-4942.jpg', 7, 'real/catalog/image-4942.jpg'),
(4955, 'catalog/image-4955.jpg', 7, 'real/catalog/image-4955.jpg'),
(4956, 'catalog/image-4956.jpg', 7, 'real/catalog/image-4956.jpg'),
(4957, 'catalog/image-4957.jpg', 7, 'real/catalog/image-4957.jpg'),
(4958, 'catalog/image-4958.jpg', 7, 'real/catalog/image-4958.jpg'),
(4961, 'catalog/image-4961.jpg', 7, 'real/catalog/image-4961.jpg'),
(4962, 'catalog/image-4962.jpg', 7, 'real/catalog/image-4962.jpg'),
(4963, 'catalog/image-4963.jpg', 7, 'real/catalog/image-4963.jpg'),
(4964, 'catalog/image-4964.jpg', 7, 'real/catalog/image-4964.jpg'),
(4965, 'catalog/image-4965.jpg', 7, 'real/catalog/image-4965.jpg'),
(4966, 'catalog/image-4966.jpg', 7, 'real/catalog/image-4966.jpg'),
(4967, 'catalog/image-4967.jpg', 7, 'real/catalog/image-4967.jpg'),
(4968, 'catalog/image-4968.jpg', 7, 'real/catalog/image-4968.jpg'),
(4969, 'catalog/image-4969.jpg', 7, 'real/catalog/image-4969.jpg'),
(4970, 'catalog/image-4970.jpg', 7, 'real/catalog/image-4970.jpg'),
(4971, 'catalog/image-4971.jpg', 7, 'real/catalog/image-4971.jpg'),
(4972, 'catalog/image-4972.jpg', 7, 'real/catalog/image-4972.jpg'),
(4973, 'catalog/image-4973.jpg', 7, 'real/catalog/image-4973.jpg'),
(4974, 'catalog/image-4974.jpg', 7, 'real/catalog/image-4974.jpg'),
(4977, 'catalog/image-4977.jpg', 7, 'real/catalog/image-4977.jpg'),
(4978, 'catalog/image-4978.jpg', 7, 'real/catalog/image-4978.jpg'),
(4979, 'catalog/image-4979.jpg', 7, 'real/catalog/image-4979.jpg'),
(4980, 'catalog/image-4980.jpg', 7, 'real/catalog/image-4980.jpg'),
(4981, 'catalog/image-4981.jpg', 7, 'real/catalog/image-4981.jpg'),
(4982, 'catalog/image-4982.jpg', 7, 'real/catalog/image-4982.jpg'),
(4983, 'catalog/image-4983.jpg', 7, 'real/catalog/image-4983.jpg'),
(4984, 'catalog/image-4984.jpg', 7, 'real/catalog/image-4984.jpg'),
(4985, 'catalog/image-4985.jpg', 7, 'real/catalog/image-4985.jpg'),
(4986, 'catalog/image-4986.jpg', 7, 'real/catalog/image-4986.jpg'),
(4987, 'catalog/image-4987.jpg', 7, 'real/catalog/image-4987.jpg'),
(4988, 'catalog/image-4988.jpg', 7, 'real/catalog/image-4988.jpg'),
(4989, 'catalog/image-4989.jpg', 7, 'real/catalog/image-4989.jpg'),
(4990, 'catalog/image-4990.jpg', 7, 'real/catalog/image-4990.jpg'),
(4991, 'catalog/image-4991.jpg', 7, 'real/catalog/image-4991.jpg'),
(4992, 'catalog/image-4992.jpg', 7, 'real/catalog/image-4992.jpg'),
(4993, 'catalog/image-4993.jpg', 7, 'real/catalog/image-4993.jpg'),
(4994, 'catalog/image-4994.jpg', 7, 'real/catalog/image-4994.jpg'),
(4995, 'catalog/image-4995.jpg', 7, 'real/catalog/image-4995.jpg'),
(4996, 'catalog/image-4996.jpg', 7, 'real/catalog/image-4996.jpg'),
(4997, 'catalog/image-4997.jpg', 7, 'real/catalog/image-4997.jpg'),
(4998, 'catalog/image-4998.jpg', 7, 'real/catalog/image-4998.jpg'),
(4999, 'catalog/image-4999.jpg', 1, 'real/catalog/image-4999.jpg'),
(5000, 'catalog/image-5000.jpg', 1, 'real/catalog/image-5000.jpg'),
(5001, 'catalog/image-5001.jpg', 1, 'real/catalog/image-5001.jpg'),
(5002, 'catalog/image-5002.jpg', 1, 'real/catalog/image-5002.jpg'),
(5003, 'catalog/image-5003.jpg', 1, 'real/catalog/image-5003.jpg'),
(5004, 'catalog/image-5004.jpg', 1, 'real/catalog/image-5004.jpg'),
(5019, 'catalog/image-5019.jpg', 1, 'real/catalog/image-5019.jpg'),
(5020, 'catalog/image-5020.jpg', 1, 'real/catalog/image-5020.jpg'),
(5021, 'catalog/image-5021.jpg', 1, 'real/catalog/image-5021.jpg'),
(5022, 'catalog/image-5022.jpg', 1, 'real/catalog/image-5022.jpg'),
(5023, 'catalog/image-5023.jpg', 1, 'real/catalog/image-5023.jpg'),
(5024, 'catalog/image-5024.jpg', 1, 'real/catalog/image-5024.jpg'),
(5025, 'catalog/image-5025.jpg', 1, 'real/catalog/image-5025.jpg'),
(5026, 'catalog/image-5026.jpg', 1, 'real/catalog/image-5026.jpg'),
(5027, 'catalog/image-5027.jpg', 1, 'real/catalog/image-5027.jpg'),
(5028, 'catalog/image-5028.jpg', 1, 'real/catalog/image-5028.jpg'),
(5029, 'catalog/image-5029.jpg', 1, 'real/catalog/image-5029.jpg'),
(5030, 'catalog/image-5030.jpg', 1, 'real/catalog/image-5030.jpg'),
(5039, 'catalog/image-5039.jpg', 7, 'real/catalog/image-5039.jpg'),
(5040, 'catalog/image-5040.jpg', 7, 'real/catalog/image-5040.jpg'),
(5041, 'catalog/image-5041.jpg', 7, 'real/catalog/image-5041.jpg'),
(5042, 'catalog/image-5042.jpg', 7, 'real/catalog/image-5042.jpg'),
(5049, 'catalog/image-5049.jpg', 1, 'real/catalog/image-5049.jpg'),
(5050, 'catalog/image-5050.jpg', 1, 'real/catalog/image-5050.jpg'),
(5051, 'catalog/image-5051.jpg', 1, 'real/catalog/image-5051.jpg'),
(5052, 'catalog/image-5052.jpg', 1, 'real/catalog/image-5052.jpg'),
(5053, 'catalog/image-5053.jpg', 1, 'real/catalog/image-5053.jpg'),
(5054, 'catalog/image-5054.jpg', 1, 'real/catalog/image-5054.jpg'),
(5097, 'catalog/image-5097.jpg', 1, 'real/catalog/image-5097.jpg'),
(5098, 'catalog/image-5098.jpg', 1, 'real/catalog/image-5098.jpg'),
(5105, 'catalog/image-5105.jpg', 1, 'real/catalog/image-5105.jpg'),
(5106, 'catalog/image-5106.jpg', 1, 'real/catalog/image-5106.jpg'),
(5107, 'catalog/image-5107.bmp', 1, 'real/catalog/image-5107.bmp'),
(5108, 'catalog/image-5108.bmp', 1, 'real/catalog/image-5108.bmp'),
(5137, 'catalog/image-5137.jpg', 1, 'real/catalog/image-5137.jpg'),
(5138, 'catalog/image-5138.jpg', 1, 'real/catalog/image-5138.jpg'),
(5143, 'catalog/image-5143.jpg', 7, 'real/catalog/image-5143.jpg'),
(5144, 'catalog/image-5144.jpg', 7, 'real/catalog/image-5144.jpg'),
(5145, 'catalog/image-5145.jpg', 7, 'real/catalog/image-5145.jpg'),
(5146, 'catalog/image-5146.jpg', 7, 'real/catalog/image-5146.jpg'),
(5147, 'catalog/image-5147.jpg', 7, 'real/catalog/image-5147.jpg'),
(5148, 'catalog/image-5148.jpg', 7, 'real/catalog/image-5148.jpg'),
(5161, 'catalog/image-5161.jpg', 1, 'real/catalog/image-5161.jpg'),
(5162, 'catalog/image-5162.jpg', 1, 'real/catalog/image-5162.jpg'),
(5167, 'catalog/image-5167.jpg', 7, 'real/catalog/image-5167.jpg'),
(5168, 'catalog/image-5168.jpg', 7, 'real/catalog/image-5168.jpg'),
(5169, 'catalog/image-5169.jpg', 7, 'real/catalog/image-5169.jpg'),
(5170, 'catalog/image-5170.jpg', 7, 'real/catalog/image-5170.jpg'),
(5187, 'catalog/image-5187.jpg', 1, 'real/catalog/image-5187.jpg'),
(5188, 'catalog/image-5188.jpg', 1, 'real/catalog/image-5188.jpg'),
(5195, 'catalog/image-5195.jpg', 1, 'real/catalog/image-5195.jpg'),
(5196, 'catalog/image-5196.jpg', 1, 'real/catalog/image-5196.jpg'),
(5221, 'catalog/image-5221.jpg', 1, 'real/catalog/image-5221.jpg'),
(5222, 'catalog/image-5222.jpg', 1, 'real/catalog/image-5222.jpg'),
(5223, 'catalog/image-5223.jpg', 1, 'real/catalog/image-5223.jpg'),
(5224, 'catalog/image-5224.jpg', 1, 'real/catalog/image-5224.jpg'),
(5770, 'catalog/image-5770.jpg', 7, 'real/catalog/image-5770.jpg'),
(5769, 'catalog/image-5769.jpg', 7, 'real/catalog/image-5769.jpg'),
(5766, 'catalog/image-5766.jpg', 7, 'real/catalog/image-5766.jpg'),
(5765, 'catalog/image-5765.jpg', 7, 'real/catalog/image-5765.jpg'),
(5229, 'catalog/image-5229.jpg', 7, 'real/catalog/image-5229.jpg'),
(5230, 'catalog/image-5230.jpg', 7, 'real/catalog/image-5230.jpg'),
(5231, 'catalog/image-5231.jpg', 7, 'real/catalog/image-5231.jpg'),
(5232, 'catalog/image-5232.jpg', 7, 'real/catalog/image-5232.jpg'),
(5233, 'catalog/image-5233.jpg', 7, 'real/catalog/image-5233.jpg'),
(5234, 'catalog/image-5234.jpg', 7, 'real/catalog/image-5234.jpg'),
(5247, 'catalog/image-5247.jpg', 7, 'real/catalog/image-5247.jpg'),
(5248, 'catalog/image-5248.jpg', 7, 'real/catalog/image-5248.jpg'),
(5249, 'catalog/image-5249.jpg', 7, 'real/catalog/image-5249.jpg'),
(5250, 'catalog/image-5250.jpg', 7, 'real/catalog/image-5250.jpg'),
(5255, 'catalog/image-5255.jpg', 7, 'real/catalog/image-5255.jpg'),
(5256, 'catalog/image-5256.jpg', 7, 'real/catalog/image-5256.jpg'),
(5257, 'catalog/image-5257.JPG', 7, 'real/catalog/image-5257.JPG'),
(5258, 'catalog/image-5258.JPG', 7, 'real/catalog/image-5258.JPG'),
(5776, 'catalog/image-5776.jpg', 7, 'real/catalog/image-5776.jpg'),
(5775, 'catalog/image-5775.jpg', 7, 'real/catalog/image-5775.jpg'),
(5267, 'catalog/image-5267.jpg', 7, 'real/catalog/image-5267.jpg'),
(5268, 'catalog/image-5268.jpg', 7, 'real/catalog/image-5268.jpg'),
(5269, 'catalog/image-5269.jpg', 7, 'real/catalog/image-5269.jpg'),
(5270, 'catalog/image-5270.jpg', 7, 'real/catalog/image-5270.jpg'),
(5275, 'catalog/image-5275.jpg', 7, 'real/catalog/image-5275.jpg'),
(5276, 'catalog/image-5276.jpg', 7, 'real/catalog/image-5276.jpg'),
(5279, 'catalog/image-5279.jpg', 7, 'real/catalog/image-5279.jpg'),
(5280, 'catalog/image-5280.jpg', 7, 'real/catalog/image-5280.jpg'),
(5317, 'catalog/image-5317.jpg', 7, 'real/catalog/image-5317.jpg'),
(5318, 'catalog/image-5318.jpg', 7, 'real/catalog/image-5318.jpg'),
(5319, 'catalog/image-5319.jpg', 7, 'real/catalog/image-5319.jpg'),
(5320, 'catalog/image-5320.jpg', 7, 'real/catalog/image-5320.jpg'),
(5323, 'catalog/image-5323.jpg', 1, 'real/catalog/image-5323.jpg'),
(5324, 'catalog/image-5324.jpg', 1, 'real/catalog/image-5324.jpg'),
(5325, 'catalog/image-5325.jpg', 1, 'real/catalog/image-5325.jpg'),
(5326, 'catalog/image-5326.jpg', 1, 'real/catalog/image-5326.jpg'),
(5327, 'catalog/image-5327.jpeg', 7, 'real/catalog/image-5327.jpeg'),
(5328, 'catalog/image-5328.jpeg', 7, 'real/catalog/image-5328.jpeg'),
(5329, 'catalog/image-5329.jpeg', 7, 'real/catalog/image-5329.jpeg'),
(5330, 'catalog/image-5330.jpeg', 7, 'real/catalog/image-5330.jpeg'),
(5331, 'catalog/image-5331.jpeg', 7, 'real/catalog/image-5331.jpeg'),
(5332, 'catalog/image-5332.jpeg', 7, 'real/catalog/image-5332.jpeg'),
(5333, 'catalog/image-5333.jpeg', 7, 'real/catalog/image-5333.jpeg'),
(5334, 'catalog/image-5334.jpeg', 7, 'real/catalog/image-5334.jpeg'),
(5343, 'catalog/image-5343.jpg', 1, 'real/catalog/image-5343.jpg'),
(5344, 'catalog/image-5344.jpg', 1, 'real/catalog/image-5344.jpg'),
(5379, 'catalog/image-5379.jpg', 7, 'real/catalog/image-5379.jpg'),
(5380, 'catalog/image-5380.jpg', 7, 'real/catalog/image-5380.jpg'),
(5381, 'catalog/image-5381.jpg', 7, 'real/catalog/image-5381.jpg'),
(5382, 'catalog/image-5382.jpg', 7, 'real/catalog/image-5382.jpg'),
(5383, 'catalog/image-5383.jpg', 7, 'real/catalog/image-5383.jpg'),
(5384, 'catalog/image-5384.jpg', 7, 'real/catalog/image-5384.jpg'),
(5385, 'catalog/image-5385.jpg', 7, 'real/catalog/image-5385.jpg'),
(5386, 'catalog/image-5386.jpg', 7, 'real/catalog/image-5386.jpg'),
(5387, 'catalog/image-5387.jpg', 7, 'real/catalog/image-5387.jpg'),
(5388, 'catalog/image-5388.jpg', 7, 'real/catalog/image-5388.jpg'),
(5395, 'catalog/image-5395.jpg', 7, 'real/catalog/image-5395.jpg'),
(5396, 'catalog/image-5396.jpg', 7, 'real/catalog/image-5396.jpg'),
(5397, 'catalog/image-5397.jpg', 7, 'real/catalog/image-5397.jpg'),
(5398, 'catalog/image-5398.jpg', 7, 'real/catalog/image-5398.jpg'),
(5527, 'catalog/image-5527.jpg', 1, 'real/catalog/image-5527.jpg'),
(5528, 'catalog/image-5528.jpg', 1, 'real/catalog/image-5528.jpg'),
(5541, 'catalog/image-5541.jpg', 1, 'real/catalog/image-5541.jpg'),
(5542, 'catalog/image-5542.jpg', 1, 'real/catalog/image-5542.jpg'),
(5660, 'catalog/image-5660.jpg', 1, 'real/catalog/image-5660.jpg'),
(5661, 'catalog/image-5661.jpg', 1, 'real/catalog/image-5661.jpg'),
(5662, 'catalog/image-5662.jpg', 1, 'real/catalog/image-5662.jpg'),
(5663, 'catalog/image-5663.jpg', 1, 'real/catalog/image-5663.jpg'),
(5664, 'catalog/image-5664.jpg', 1, 'real/catalog/image-5664.jpg'),
(5665, 'catalog/image-5665.jpg', 1, 'real/catalog/image-5665.jpg'),
(5666, 'catalog/image-5666.jpg', 1, 'real/catalog/image-5666.jpg'),
(5667, 'catalog/image-5667.jpg', 1, 'real/catalog/image-5667.jpg'),
(5668, 'catalog/image-5668.jpg', 1, 'real/catalog/image-5668.jpg'),
(5669, 'catalog/image-5669.jpg', 1, 'real/catalog/image-5669.jpg'),
(5670, 'catalog/image-5670.jpg', 1, 'real/catalog/image-5670.jpg'),
(5671, 'catalog/image-5671.jpg', 1, 'real/catalog/image-5671.jpg'),
(5672, 'catalog/image-5672.jpg', 1, 'real/catalog/image-5672.jpg'),
(5673, 'catalog/image-5673.jpg', 1, 'real/catalog/image-5673.jpg'),
(5674, 'catalog/image-5674.jpg', 1, 'real/catalog/image-5674.jpg'),
(5675, 'catalog/image-5675.jpg', 1, 'real/catalog/image-5675.jpg'),
(5676, 'catalog/image-5676.jpg', 1, 'real/catalog/image-5676.jpg'),
(5677, 'catalog/image-5677.jpg', 1, 'real/catalog/image-5677.jpg'),
(5678, 'catalog/image-5678.jpg', 1, 'real/catalog/image-5678.jpg'),
(5679, 'catalog/image-5679.jpg', 1, 'real/catalog/image-5679.jpg'),
(5728, 'catalog/image-5728.jpg', 1, 'real/catalog/image-5728.jpg'),
(5729, 'catalog/image-5729.jpg', 1, 'real/catalog/image-5729.jpg'),
(5730, 'catalog/image-5730.jpg', 1, 'real/catalog/image-5730.jpg'),
(5731, 'catalog/image-5731.jpg', 1, 'real/catalog/image-5731.jpg'),
(5732, 'catalog/image-5732.jpg', 1, 'real/catalog/image-5732.jpg'),
(5733, 'catalog/image-5733.jpg', 1, 'real/catalog/image-5733.jpg'),
(5734, 'catalog/image-5734.jpg', 1, 'real/catalog/image-5734.jpg'),
(5735, 'catalog/image-5735.jpg', 1, 'real/catalog/image-5735.jpg'),
(5736, 'article/image-5736.jpg', 5, 'real/article/image-5736.jpg'),
(5737, 'article/image-5737.jpg', 5, 'real/article/image-5737.jpg'),
(5738, 'article/image-5738.jpeg', 5, 'real/article/image-5738.jpeg'),
(5739, 'article/image-5739.jpg', 5, 'real/article/image-5739.jpg'),
(5740, 'article/image-5740.jpg', 5, 'real/article/image-5740.jpg'),
(5741, 'article/image-5741.jpg', 5, 'real/article/image-5741.jpg'),
(5742, 'article/image-5742.jpg', 5, 'real/article/image-5742.jpg'),
(5743, 'article/image-5743.jpg', 5, 'real/article/image-5743.jpg'),
(5744, 'article/image-5744.jpg', 5, 'real/article/image-5744.jpg'),
(5745, 'article/image-5745.jpg', 5, 'real/article/image-5745.jpg'),
(5746, 'catalog/image-5746.jpg', 1, 'real/catalog/image-5746.jpg'),
(5747, 'catalog/image-5747.jpg', 1, 'real/catalog/image-5747.jpg'),
(5748, 'catalog/image-5748.jpg', 1, 'real/catalog/image-5748.jpg'),
(5749, 'catalog/image-5749.jpg', 1, 'real/catalog/image-5749.jpg'),
(5750, 'catalog/image-5750.jpg', 1, 'real/catalog/image-5750.jpg'),
(5751, 'catalog/image-5751.jpg', 1, 'real/catalog/image-5751.jpg'),
(5752, 'catalog/image-5752.jpg', 1, 'real/catalog/image-5752.jpg'),
(5753, 'catalog/image-5753.jpg', 1, 'real/catalog/image-5753.jpg'),
(5754, 'catalog/image-5754.jpg', 1, 'real/catalog/image-5754.jpg'),
(5755, 'catalog/image-5755.jpg', 1, 'real/catalog/image-5755.jpg'),
(5756, 'catalog/image-5756.jpg', 1, 'real/catalog/image-5756.jpg'),
(5757, 'catalog/image-5757.jpg', 1, 'real/catalog/image-5757.jpg'),
(5758, 'catalog/image-5758.jpg', 1, 'real/catalog/image-5758.jpg'),
(5759, 'design/image-5759.jpg', 3, 'real/design/image-5759.jpg'),
(5760, 'design/image-5760.png', 3, 'real/design/image-5760.png'),
(5767, 'catalog/image-5767.jpg', 7, 'real/catalog/image-5767.jpg'),
(5768, 'catalog/image-5768.jpg', 7, 'real/catalog/image-5768.jpg'),
(5771, 'catalog/image-5771.jpg', 7, 'real/catalog/image-5771.jpg'),
(5772, 'catalog/image-5772.jpg', 7, 'real/catalog/image-5772.jpg'),
(5773, 'catalog/image-5773.jpg', 7, 'real/catalog/image-5773.jpg'),
(5774, 'catalog/image-5774.jpg', 7, 'real/catalog/image-5774.jpg'),
(5787, 'article/image-5787.jpg', 5, 'real/article/image-5787.jpg'),
(5788, 'catalog/image-5788.jpg', 7, 'real/catalog/image-5788.jpg'),
(5789, 'catalog/image-5789.jpg', 7, 'real/catalog/image-5789.jpg'),
(5790, 'catalog/image-5790.jpg', 7, 'real/catalog/image-5790.jpg'),
(5791, 'catalog/image-5791.jpg', 7, 'real/catalog/image-5791.jpg'),
(5792, 'catalog/image-5792.jpg', 7, 'real/catalog/image-5792.jpg'),
(5793, 'catalog/image-5793.jpg', 7, 'real/catalog/image-5793.jpg'),
(5794, 'catalog/image-5794.jpg', 7, 'real/catalog/image-5794.jpg'),
(5795, 'catalog/image-5795.jpg', 7, 'real/catalog/image-5795.jpg'),
(5796, 'catalog/image-5796.jpg', 7, 'real/catalog/image-5796.jpg'),
(5797, 'catalog/image-5797.jpg', 7, 'real/catalog/image-5797.jpg'),
(5798, 'catalog/image-5798.jpg', 7, 'real/catalog/image-5798.jpg'),
(5799, 'catalog/image-5799.jpg', 7, 'real/catalog/image-5799.jpg'),
(5800, 'catalog/image-5800.jpg', 7, 'real/catalog/image-5800.jpg'),
(5801, 'catalog/image-5801.jpg', 7, 'real/catalog/image-5801.jpg'),
(5895, 'catalog/image-5895.jpg', 7, 'real/catalog/image-5895.jpg'),
(5894, 'catalog/image-5894.jpg', 7, 'real/catalog/image-5894.jpg'),
(5892, 'catalog/image-5892.jpg', 7, 'real/catalog/image-5892.jpg'),
(5893, 'catalog/image-5893.jpg', 7, 'real/catalog/image-5893.jpg'),
(5891, 'catalog/image-5891.jpg', 7, 'real/catalog/image-5891.jpg'),
(5889, 'catalog/image-5889.jpg', 7, 'real/catalog/image-5889.jpg'),
(5890, 'catalog/image-5890.jpg', 7, 'real/catalog/image-5890.jpg'),
(5888, 'catalog/image-5888.jpg', 7, 'real/catalog/image-5888.jpg'),
(5886, 'catalog/image-5886.jpg', 7, 'real/catalog/image-5886.jpg'),
(5887, 'catalog/image-5887.jpg', 7, 'real/catalog/image-5887.jpg'),
(5885, 'partners/image-5885.jpg', 9, 'real/partners/image-5885.jpg'),
(5882, 'catalog/image-5882.jpg', 1, 'real/catalog/image-5882.jpg'),
(5884, 'partners/image-5884.jpg', 9, 'real/partners/image-5884.jpg'),
(5883, 'catalog/image-5883.jpg', 1, 'real/catalog/image-5883.jpg'),
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

-- --------------------------------------------------------

--
-- Структура таблицы `cake_image_templates`
--

CREATE TABLE IF NOT EXISTS `cake_image_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `percent` int(11) DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cake_image_templates`
--

INSERT INTO `cake_image_templates` (`id`, `image_id`, `percent`) VALUES
(1, 3777, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_image_types`
--

CREATE TABLE IF NOT EXISTS `cake_image_types` (
  `id` int(11) NOT NULL,
  `image_type_name` varchar(50) DEFAULT NULL,
  `image_template_id` int(11) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `real_prefix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cake_image_types`
--

INSERT INTO `cake_image_types` (`id`, `image_type_name`, `image_template_id`, `prefix`, `real_prefix`) VALUES
(1, 'Каталог', NULL, 'catalog/', 'real/catalog/'),
(2, 'Пользовательский', NULL, 'notes/', 'real/notes/'),
(3, 'Заявки на дизайн', NULL, 'design/', 'real/design/'),
(4, 'Баннеры', NULL, 'banners/', 'real/banners/'),
(5, 'Статьи', NULL, 'article/', 'real/article/'),
(6, 'Шаблоны', NULL, 'templates/', 'real/templates/'),
(7, 'Товары', 1, 'catalog/', 'real/catalog/'),
(8, 'Фотоальбом', NULL, 'album/', 'real/album/'),
(9, 'Партнеры', NULL, 'partners/', 'real/partners/');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_load_catalogs`
--

CREATE TABLE IF NOT EXISTS `cake_load_catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `status_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `load_catalog_ind_status` (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `cake_load_catalogs`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cake_load_catalog_dets`
--

CREATE TABLE IF NOT EXISTS `cake_load_catalog_dets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `load_catalog_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT '0',
  `flag` int(11) NOT NULL,
  `1c_kod_catalog` varchar(50) DEFAULT NULL,
  `1c_kod_product` varchar(50) DEFAULT NULL,
  `pname` varchar(200) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `load_catalog_det_ind_load_catalog` (`load_catalog_id`),
  KEY `load_catalog_det_ind_status` (`status_id`),
  KEY `load_catalog_det_ind_1c_kod_catalog` (`1c_kod_catalog`),
  KEY `load_catalog_det_ind_1c_kod_product` (`1c_kod_product`),
  KEY `load_catalog_det_ind_flag` (`flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=75277 ;

--
-- Дамп данных таблицы `cake_load_catalog_dets`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cake_partners`
--

CREATE TABLE IF NOT EXISTS `cake_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enabled` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `text` text,
  `image_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_partners`
--

INSERT INTO `cake_partners` (`id`, `enabled`, `name`, `text`, `image_id`, `sort_order`) VALUES
(1, 1, 'ГРАНД МЕБЕЛЬ', '<div>	<div>		Мебельная фабрика &quot;Гранд Мебель&quot; является одним из крупнейших производителей мягкой и корпусной мебели.</div>	<div>		В компании ведется четкий контроль за качеством производимой продукции.</div></div>', 5884, 1),
(2, 1, 'КРАСНОЯРСКАЯ МЕБЕЛЬНАЯ КОМПАНИЯ', '<div>	Красноярская Мебельная Компания-один из ведущих производителей корпусной и мягкой мебели в Красноярском крае отмечает свой восьмой день рождения.Производство оснащено современным технологичным оборудованием, позволяющим реализовать все передовые мебельные проекты.</div>', 5885, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_pay_types`
--

CREATE TABLE IF NOT EXISTS `cake_pay_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `cake_pay_types`
--

INSERT INTO `cake_pay_types` (`id`, `name`, `sort_order`) VALUES
(1, 'Наличный расчет', 1),
(2, 'Безналичный расчет', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_products`
--

CREATE TABLE IF NOT EXISTS `cake_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  `small_image_id` int(11) DEFAULT NULL,
  `big_image_id` int(11) DEFAULT NULL,
  `article` varchar(50) DEFAULT NULL,
  `code_1c` varchar(100) DEFAULT NULL,
  `about` text,
  `producer_id` int(11) DEFAULT NULL,
  `name_1c` varchar(300) DEFAULT NULL,
  `fix_price` int(11) NOT NULL DEFAULT '0',
  `fix_cnt` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `eng_name` varchar(500) DEFAULT NULL,
  `opt_price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_ind_catalog` (`catalog_id`),
  KEY `product_ind_small_image` (`small_image_id`),
  KEY `product_ind_big_image` (`big_image_id`),
  KEY `product_ind_producer` (`producer_id`),
  KEY `product_ind_code_1c` (`code_1c`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=10668 ;

--
-- Дамп данных таблицы `cake_products`
--

INSERT INTO `cake_products` (`id`, `catalog_id`, `name`, `sort_order`, `price`, `cnt`, `small_image_id`, `big_image_id`, `article`, `code_1c`, `about`, `producer_id`, `name_1c`, `fix_price`, `fix_cnt`, `created`, `updated`, `eng_name`, `opt_price`) VALUES
(10662, 100000242, 'Соня - 7 угол', 2, 150, NULL, 5872, 5873, NULL, 'S_10662', NULL, NULL, NULL, 0, 0, '2011-12-18 18:51:52', '2011-12-18 18:51:52', 'sonya_7_ugol', 140),
(10663, 100000242, 'Соня - 9 угол', 3, 200, NULL, 5874, 5875, NULL, 'S_10663', '<div> 	Механизм трансформации: &quot;Венеция&quot;. Комплектация: угол + кресло.</div>', NULL, NULL, 0, 0, '2011-12-18 18:54:12', '2011-12-18 18:54:43', 'sonya_9_ugol', 190),
(10664, 100000243, 'Агат', 1, 10, NULL, 5876, 5877, NULL, 'S_10664', NULL, NULL, NULL, 0, 0, '2011-12-18 19:01:34', '2011-12-18 19:02:51', 'agat', 9),
(10665, 100000243, 'Агат угол', 2, 90, NULL, 5878, 5879, NULL, 'S_10665', NULL, NULL, NULL, 0, 0, '2011-12-18 19:02:01', '2011-12-18 19:02:51', 'agat_ygol', 80),
(10666, 100000243, 'Герда', 3, 550, NULL, 5880, 5881, NULL, 'S_10666', NULL, NULL, NULL, 0, 0, '2011-12-18 19:02:19', '2011-12-18 19:02:51', 'gerda', 520),
(10661, 100000245, 'Пион-1 мини-диван', -1, 100, NULL, 5870, 5871, NULL, 'S_10661', NULL, NULL, NULL, 0, 0, '2011-12-18 18:16:22', '2012-01-04 12:41:01', 'pion_1_mini_divan', 90),
(10667, 100000242, 'Сакура', 3, 30700, NULL, 5888, 5889, NULL, 'S_10667', '<div>	Мебель для спальни &quot;Сакура&quot; рассчитана на современных людей, для которых одной из составляющих является стильный и удобный интерьер любимого дома, созданный с помощью надежной и функциональной мебели. Коллекция выполнена в современном, популярном на Российском рынке, декоре &quot;Венге&quot;.</div>', NULL, NULL, 0, 0, '2012-01-08 15:07:50', '2012-01-08 15:08:21', 'sakura', 30500);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_product_dets`
--

CREATE TABLE IF NOT EXISTS `cake_product_dets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `about` text,
  `code_1c` int(11) DEFAULT NULL,
  `name_1c` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `opt_price` float DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  `small_image_id` int(11) DEFAULT NULL,
  `big_image_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_product_dets`
--

INSERT INTO `cake_product_dets` (`id`, `product_id`, `name`, `about`, `code_1c`, `name_1c`, `price`, `opt_price`, `cnt`, `small_image_id`, `big_image_id`, `sort_order`, `created`, `updated`) VALUES
(1, 10662, 'синенький2', NULL, NULL, NULL, 11, 222, NULL, 5886, 5887, 1, '2012-01-04 13:18:34', '2012-01-08 13:48:01'),
(2, 10662, 'красненький', NULL, NULL, NULL, 345, 432, NULL, NULL, NULL, 2, '2012-01-04 13:41:30', '2012-01-04 13:45:29');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_product_images`
--

CREATE TABLE IF NOT EXISTS `cake_product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `small_image_id` int(11) DEFAULT NULL,
  `big_image_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `cake_product_images`
--

INSERT INTO `cake_product_images` (`id`, `product_id`, `name`, `small_image_id`, `big_image_id`, `sort_order`, `created`, `updated`) VALUES
(1, 10662, 'qwe', 5890, 5891, 1, '2012-01-22 08:44:10', '2012-01-22 08:44:38'),
(2, 10662, 'rtuyuii', 5892, 5893, 2, '2012-01-22 08:49:35', '2012-01-22 08:50:08'),
(3, 10662, 'fgds gf gdf', 5894, 5895, 3, '2012-01-22 08:49:47', '2012-01-22 08:50:08');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_profil_types`
--

CREATE TABLE IF NOT EXISTS `cake_profil_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `cake_profil_types`
--

INSERT INTO `cake_profil_types` (`id`, `profil_name`) VALUES
(1, 'Одежда'),
(2, 'Обувь'),
(3, 'Продукты питания'),
(4, 'Торговое оборудование'),
(5, 'Компьютеры, электроника, быт.техника'),
(6, 'Книги, журналы, газеты'),
(7, 'Ювелирные изделия, украшения'),
(8, 'Парфюмерия, косметика'),
(9, 'Автоматизация торговли'),
(10, 'Наружная, интерьерная реклама'),
(11, 'Консалтинг, информационный бизнес'),
(12, 'Другое');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_roles`
--

CREATE TABLE IF NOT EXISTS `cake_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cake_roles`
--

INSERT INTO `cake_roles` (`id`, `role_name`) VALUES
(1, 'Клиент'),
(2, 'Менеджер'),
(3, 'Модератор');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_settings`
--

CREATE TABLE IF NOT EXISTS `cake_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `value_str` varchar(1000) DEFAULT NULL,
  `value_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cake_settings`
--

INSERT INTO `cake_settings` (`id`, `name`, `image_id`, `value_str`, `value_text`) VALUES
(1, 'Подвал', NULL, '', '<div> 	ООО РегионСибМебель 2011 (С)</div> <div> 	Все права защищены</div> <div> 	&nbsp;</div> <div> 	Телефон: 8 (391) 264-97-22, Факс: 8 (391) 263-62-09</div> <div> 	&nbsp;</div> <div> 	e-mail: regionsibmebel@mail.ru, regionsibmebel@yandex.ru</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_specials`
--

CREATE TABLE IF NOT EXISTS `cake_specials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `cake_specials`
--

INSERT INTO `cake_specials` (`id`, `image_id`, `product_id`, `sort_order`, `enabled`) VALUES
(2, 5882, 10666, 1, 1),
(3, 5883, 10662, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_strings`
--

CREATE TABLE IF NOT EXISTS `cake_strings` (
  `id` int(11) NOT NULL,
  `string_type_id` int(11) NOT NULL,
  `str` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cake_strings`
--

INSERT INTO `cake_strings` (`id`, `string_type_id`, `str`) VALUES
(6, 6, '<div> 	Здравствуйте!<br /> 	&nbsp;Вы держите в руках новый каталог торгового оборудования компании &laquo;Анжелика&raquo;. Наша компания много лет оснащает магазины самой разной специализации: от ювелирных украшений до бытовой техники, от модных бутиков до продуктовых супермаркетов.<br /> 	&nbsp;Это требует широчайшего ассортимента торгового оборудования, который и представлен на страницах данного издания.</div> '),
(2, 2, '<div>	<span style="color:#000000;">Компания <a class="red-link" href="/">&laquo;Анжелика&raquo;</a> представляет вам галерею интерьеров магазинов и бутиков. Здесь вы можете увидеть самые разные проекты, от одежды до электроники, от спортивных товаров до ювелирных изделий. Для вашего удобства сделан рубрикатор по товарным группам.<br />	</span><span style="color:#ff0000;">Вам нужен дизайн магазина?</span><span style="color:#000000;"> Обратитесь к профессионалам! Вы можете приехать к нам в офис для личного общения с дизайнером или заполнить онлайн заявку на <a class="red_link" href="http://www.mto24.ru/design_order_dets/add">дизайн магазина</a> прямо сейчас!<br />	Проект магазина может иметь разные уровни в зависимости от требований арендодателя и ваших пожеланий. Для вас будет спроектирован и реализован проект магазина любой сложности, включая архитектурный проект, трехмерное моделирование и визуализацию.<br />	По созданному проекту производство изготовит торговое оборудование. Сервисная служба произведет доставку и монтаж в интерьере магазина.</span></div>'),
(12, 12, '<div>	Анжелика - Торговое оборудование, оборудование для магазинов, продажа торгового оборудования. Доставка торгового оборудования в Красноярск, Новосибирск, Томск, Барнаул, Екатеринбург, Иркутск, Канск, Ачинск, Улан-Удэ, Абакан, Омск, Ангарск, Москва, Бийск, Кемерово.</div>'),
(3, 3, ''),
(11, 11, '<div> 	Всего новостей: 1</div>'),
(4, 4, 'магазин торгового оборудования, Анжелика, торговое оборудование, манекены, экономпанели, корзина, вешала, плечики, дизайн магазинов, ценникодержатели, плечико'),
(5, 5, 'манекены, экономпанели, ценникодержатели, вешала, стойки, торговые системы, Joker, UNO, Primo, Tritix, R-system, FIRE, Global, Vertical, витрины, металлические шкафы, стойки, сейфы, мусорницы, настенные держатели, парогенераторы, дизайн магазинов, оформление магазинов, аксессуары для торговли, ограждения и охранные системы, троссовые системы'),
(7, 7, '<div> 	<span style="color:#ffff00;"><span style="font-size:14px;"><strong><span style="font-family:tahoma,geneva,sans-serif;">К сожалению, в настоящий момент, данного товара нет в наличии</span></strong></span></span></div> '),
(8, 8, '<div> 	<span class="Apple-style-span" style="font-size: medium;"><img alt="" src="/cake/img/notes/image-1.JPG" style="width: 280px; height: 120px; float: left;" />Анжелика - Торговое оборудование, г. Красноярск, ул. Вавилова 3, индекс 660093</span></div> <div> 	тел.<strong> (83912) 265-365 (офис);</strong></div> <div> 	тел.<strong> (83912) 941-495 (сотовый);</strong></div> <div> 	тел.<strong> (83912) 265-365 (факс);</strong></div> <div> 	Сайт:&nbsp;<a href="http://mto24.ru">mto24.ru</a></div> <div> 	Электронная почта:&nbsp;<a href="mailto:mto24@mail.ru">mto24@mail.ru</a></div>'),
(9, 9, '<div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;"><span class="Apple-style-span">Анжелика - Торговое оборудование</span></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;"><span class="Apple-style-span">г. Красноярск, ул. Вавилова 3, индекс 660093</span></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;">тел.<strong>&nbsp;(83912) 265-365 (офис);</strong></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;">тел.<strong>&nbsp;(83912) 941-495 (сотовый);</strong></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;">тел.<strong>&nbsp;(83912) 265-365 (факс);</strong></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;">Сайт:&nbsp;<a href="http://mto24.ru/">mto24.ru</a></span></div> 	<div style="margin: 0px; padding: 0px; font-size: 14px;"> 		<span style="font-size: 10px;">Электронная почта:&nbsp;<a href="mailto:mto24@mail.ru">mto24@mail.ru</a></span></div> </div>'),
(10, 10, '<div> 	<p> 		Уважаемые партнеры!</p> 	<p> 		<b>Если вам необходим дизайн-проект магазина, мы с радостью вам поможем!</b></p> 	<p> 		Для наиболее плодотворного начала нашего сотрудничества просим вас заполнить эту форму.</p> 	<p> 		Обратите внимание! <span style="color: rgb(255, 255, 0);"><b>Поля, отмеченные звездочкой(</b></span><span style="color: rgb(255, 0, 0);"><b>*</b></span><span style="color: rgb(255, 255, 0);"><b>), обязательны для заполнения.</b></span> Остальные поля можно оставить пустыми, если вы еще не приняли решение по этим вопросам.<br /> 		<span style="color: rgb(255, 255, 0);">Общий объем прикрепленных файлов не более 20 Мб.</span></p> 	<p> 		Вместе с тем хотим заметить: чем подробнее вы заполните форму, тем быстрее и эффективнее</p> 	<p> 		будет протекать работа над вашим магазином!</p> 	<p> 		<span style="color: rgb(255, 255, 0);">Спасибо за обращение в нашу компанию!</span></p> </div>');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_string_types`
--

CREATE TABLE IF NOT EXISTS `cake_string_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `cake_string_types`
--

INSERT INTO `cake_string_types` (`id`, `name`) VALUES
(6, 'Заголовок для pdf'),
(2, 'Портфолио - верх'),
(3, 'Портфолио - низ'),
(4, 'Для роботов - keyword'),
(5, 'Для роботов - description'),
(7, 'При отсутствии товара на складе'),
(8, 'Шапка каталога на печать'),
(9, 'Шапка excel'),
(10, 'Шапка в заявке на дизайн'),
(11, 'Новости - верх и низ'),
(12, 'Шапка сайта');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_transport_types`
--

CREATE TABLE IF NOT EXISTS `cake_transport_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_transport_types`
--

INSERT INTO `cake_transport_types` (`id`, `name`, `price`, `sort_order`) VALUES
(1, 'Самовывоз', 0, 1),
(2, 'Доставка по Красноярску', 400, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_url_descriptions`
--

CREATE TABLE IF NOT EXISTS `cake_url_descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `cake_url_descriptions`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cake_url_keywords`
--

CREATE TABLE IF NOT EXISTS `cake_url_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) DEFAULT NULL,
  `keyword` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `cake_url_keywords`
--

INSERT INTO `cake_url_keywords` (`id`, `url`, `keyword`) VALUES
(2, '/company_infos/index/', '');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_url_titles`
--

CREATE TABLE IF NOT EXISTS `cake_url_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) DEFAULT NULL,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `cake_url_titles`
--


-- --------------------------------------------------------

--
-- Структура таблицы `cake_users`
--

CREATE TABLE IF NOT EXISTS `cake_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `activation_token` varchar(36) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `ip_addr` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=472 ;

--
-- Дамп данных таблицы `cake_users`
--

INSERT INTO `cake_users` (`id`, `username`, `password`, `email`, `role_id`, `is_active`, `activation_token`, `created`, `updated`, `ip_addr`) VALUES
(4, 'admin', '546e26a1f5dbdfa6c912c3490eb8c2ba514bc4d5', 'admin555@mail.ru', 3, 1, '', '2010-06-11 06:34:59', '2012-01-15 20:45:27', NULL),
(7, 'test', 'd823d1fa84375a0d220283ecf7e050f610ba04c6', 'zic@mail.ru', 1, 1, '', '2010-07-12 08:10:14', '2011-04-22 10:28:20', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cake_user_logs`
--

CREATE TABLE IF NOT EXISTS `cake_user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stamp` datetime DEFAULT NULL,
  `user_log_type_id` int(11) NOT NULL,
  `ip_addr` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=295 ;

--
-- Дамп данных таблицы `cake_user_logs`
--

INSERT INTO `cake_user_logs` (`id`, `user_id`, `stamp`, `user_log_type_id`, `ip_addr`) VALUES
(294, 4, '2012-01-21 17:14:09', 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `cake_user_log_types`
--

CREATE TABLE IF NOT EXISTS `cake_user_log_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cake_user_log_types`
--

INSERT INTO `cake_user_log_types` (`id`, `name`) VALUES
(1, 'Вход');
