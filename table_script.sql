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
-- Table `integration`.`tbClub`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbClub` (
  `clubId` INT(11) NOT NULL AUTO_INCREMENT,
  `clubPseudo` VARCHAR(20) NULL DEFAULT NULL,
  `Name` VARCHAR(50) NULL DEFAULT NULL,
  `Address` VARCHAR(50) NULL DEFAULT NULL,
  `zipCode` INT(11) NULL DEFAULT NULL,
  `mdp` VARCHAR(50) NULL DEFAULT NULL,
  `mail` VARCHAR(25) NULL DEFAULT NULL,
  `DateInscription` DATE NULL DEFAULT NULL,
  `telephone` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`clubId`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `integration`.`tbSport`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbSport` (
  `sId` INT(11) NOT NULL AUTO_INCREMENT,
  `sport` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`sId`),
  UNIQUE INDEX `sport_UNIQUE` (`sport` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `integration`.`tbTerrains`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbTerrains` (
  `tId` INT(11) NOT NULL AUTO_INCREMENT,
  `sId` INT(11) NOT NULL,
  `clubId` INT(11) NULL DEFAULT NULL,
  `reserve` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`tId`),
  UNIQUE INDEX `tId_UNIQUE` (`tId` ASC),
  INDEX `sport_idx` (`sId` ASC),
  CONSTRAINT `sport`
    FOREIGN KEY (`sId`)
    REFERENCES `integration`.`tbSport` (`sId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `integration`.`tbUsers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `integration`.`tbUsers` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `userPseudo` VARCHAR(20) NOT NULL,
  `LastName` VARCHAR(20) NOT NULL,
  `FirstName` VARCHAR(20) NOT NULL,
  `address` VARCHAR(50) NULL DEFAULT NULL,
  `zipCode` INT(11) NULL DEFAULT NULL,
  `mdp` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(25) NOT NULL,
  `dateInscription` DATE NULL DEFAULT NULL,
  `dateBirth` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC),
  UNIQUE INDEX `userPseudo_UNIQUE` (`userPseudo` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
