CREATE TABLE IF NOT EXISTS `list` (
  `id` varchar(255)  NOT NULL,
  `name` varchar(255)  NOT NULL,
  `email` varchar(255)  NOT NULL,
  `list` text  NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `email_index`(`email`)
)
ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS `block` (
  `ip` varchar(40)  NOT NULL,
  `blocked` datetime  NOT NULL,
  PRIMARY KEY (`ip`)
)
ENGINE = MyISAM;