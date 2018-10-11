-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema integration
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema integration
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `integration` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `integration` ;

-- -----------------------------------------------------
-- Table `integration`.`tbUsers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbUsers` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `userPseudo` VARCHAR(255) NULL DEFAULT NULL,
  `mdp` VARCHAR(255) NULL DEFAULT NULL,
  `mail` VARCHAR(255) NULL DEFAULT NULL,
  `dateInscription` DATE NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `integration`.`tbSport`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbSport` (
  `sId` INT NOT NULL AUTO_INCREMENT,
  `sport` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  PRIMARY KEY (`sId`),
  UNIQUE INDEX `sport_UNIQUE` (`sport` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `integration`.`tbTerrains`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbTerrains` (
  `tId` INT NOT NULL AUTO_INCREMENT,
  `localite` VARCHAR(255) NOT NULL,
  `adresse` VARCHAR(255) NOT NULL,
  `telephone` VARCHAR(255) NOT NULL,
  `nom` VARCHAR(255) NOT NULL,
  `sport` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tId`),
  UNIQUE INDEX `tId_UNIQUE` (`tId` ASC),
  INDEX `sport_idx` (`sport` ASC),
  CONSTRAINT `sport`
    FOREIGN KEY (`sport`)
    REFERENCES `integration`.`tbSport` (`sport`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
