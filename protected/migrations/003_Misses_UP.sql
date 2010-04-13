CREATE TABLE IF NOT EXISTS `miss` (
	`ip` varchar(40)  NOT NULL,
	`list_id` varchar(255) NOT NULL,
	`missed` datetime  NOT NULL,
	PRIMARY KEY (`ip`)
)
ENGINE = MyISAM;

ALTER TABLE `miss`
	ADD CONSTRAINT `miss_alists_ibfk_1` FOREIGN KEY ( `list_id` ) REFERENCES `alist` ( `id` ) ON DELETE CASCADE;
