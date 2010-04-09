ALTER TABLE `alist`
	CHANGE COLUMN `passphrase` `edit_password` VARCHAR(255) NOT NULL,
	ADD COLUMN `view_password` VARCHAR(255)  NOT NULL AFTER `edit_password`,
	ADD COLUMN `delete_password` VARCHAR(255)  NOT NULL AFTER `view_password`;
