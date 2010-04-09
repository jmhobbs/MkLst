ALTER TABLE `alist`
	CHANGE COLUMN `edit_password` `passphrase` VARCHAR(255) NOT NULL,
	DROP COLUMN `view_password`,
	DROP COLUMN `delete_password`;