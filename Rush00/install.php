<?php
include ('global/global.php');
include ('lib/include.php');

$show_form = TRUE;

if (isset($_POST['drop']))
{
    if ($_POST['drop'] == 'Oui')
    {
        destroy_cart();
        $sql = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
                
                DROP SCHEMA IF EXISTS snosky_rush00 ;
                
                CREATE SCHEMA IF NOT EXISTS snosky_rush00 DEFAULT CHARACTER SET utf8 ;
                USE snosky_rush00 ;
                
                DROP TABLE IF EXISTS snosky_rush00.t_user ;
                
                CREATE TABLE IF NOT EXISTS snosky_rush00.t_user (
                  usr_id INT NOT NULL AUTO_INCREMENT,
                  usr_name VARCHAR(255) NULL,
                  usr_email VARCHAR(255) NULL,
                  usr_password VARCHAR(255) NULL,
                  usr_salt VARCHAR(255) NULL,
                  usr_role VARCHAR(255) NULL,
                  PRIMARY KEY (usr_id))
                ENGINE = InnoDB;
                
                DROP TABLE IF EXISTS snosky_rush00.t_item ;
                
                CREATE TABLE IF NOT EXISTS snosky_rush00.t_item (
                  itm_id INT NOT NULL AUTO_INCREMENT,
                  itm_name VARCHAR(255) NULL,
                  itm_description LONGTEXT NULL,
                  itm_price FLOAT NULL,
                  itm_quantity INT NULL,
                  PRIMARY KEY (itm_id))
                ENGINE = InnoDB;
                
                DROP TABLE IF EXISTS snosky_rush00.t_category ;
                
                CREATE TABLE IF NOT EXISTS snosky_rush00.t_category (
                  cat_id INT NOT NULL AUTO_INCREMENT,
                  cat_name VARCHAR(255) NULL,
                  PRIMARY KEY (cat_id))
                ENGINE = InnoDB;
                
                DROP TABLE IF EXISTS snosky_rush00.t_category_has_t_item ;
                
                CREATE TABLE IF NOT EXISTS snosky_rush00.t_category_has_t_item (
                  cat_id INT NOT NULL,
                  itm_id INT NOT NULL,
                  PRIMARY KEY (cat_id, itm_id),
                  INDEX fk_t_category_has_t_item_t_item1_idx (itm_id ASC),
                  INDEX fk_t_category_has_t_item_t_category_idx (cat_id ASC),
                  CONSTRAINT fk_t_category_has_t_item_t_category
                    FOREIGN KEY (cat_id)
                    REFERENCES snosky_rush00.t_category (cat_id)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT fk_t_category_has_t_item_t_item1
                    FOREIGN KEY (itm_id)
                    REFERENCES snosky_rush00.t_item (itm_id)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;
                
                DROP TABLE IF EXISTS snosky_rush00.t_command ;
                
                CREATE TABLE IF NOT EXISTS snosky_rush00.t_command (
                  com_id INT NOT NULL AUTO_INCREMENT,
                  usr_id INT NOT NULL,
                  com_data LONGTEXT NULL,
                  com_status INT NULL,
                  com_date TIMESTAMP NULL,
                  PRIMARY KEY (com_id),
                  INDEX fk_t_command_t_user1_idx (usr_id ASC),
                  CONSTRAINT fk_t_command_t_user1
                    FOREIGN KEY (usr_id)
                    REFERENCES snosky_rush00.t_user (usr_id)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB;
                
                
                SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
                
                START TRANSACTION;
                USE snosky_rush00;
                INSERT INTO snosky_rush00.t_user (usr_id, usr_name, usr_email, usr_password, usr_salt, usr_role) VALUES (DEFAULT, 'admin', 'tpayen@student.42.fr', 'd69c2c0de23149d7f56c13a8f13dd52801158215fc932d12f1fd7a6c243e72497f5dc6d16789676644c31757c73a2d3e1af951ddd5ad9e8ec86a1590b2de0d9b', '230d68a35ab07d234d64a7a52060f574', 'ROLE_ADMIN');
                
                COMMIT;
                
                START TRANSACTION;
                USE snosky_rush00;
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Carte mere');
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Processeur');
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Carte graphique');
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Boitier');
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Memoire RAM');
                INSERT INTO snosky_rush00.t_category (cat_id, cat_name) VALUES (DEFAULT, 'Refroidissement');
                
                COMMIT;";

        $sql = explode(';', $sql);
        $error = FALSE;
        foreach ($sql as $line)
        {
            $line = trim($line);
            if (!empty($line) && !(mysqli_query($db, $line)))
            {
                add_flash_message('error', 'Erreur sql'.mysqli_error($db));
                $error = TRUE;
            }
        }
        if (!$error)
            $show_form = FALSE;

    }
}

render('install.php', array(
    'show_form' => $show_form,
));
?>
