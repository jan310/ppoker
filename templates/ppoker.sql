CREATE DATABASE ppoker;

CREATE TABLE IF NOT EXISTS `ppoker`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) NULL,
  `lastName` VARCHAR(45) NULL,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(45) NULL,
  `registrationDate` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `ppoker`.`planningGame` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userStory` VARCHAR(255) NULL,
  `description` TEXT(3000) NULL,
  `creationDate` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `ppoker`.`participation` (
  `participationId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `gameId` INT NOT NULL,
  `card` INT NOT NULL,
  `date` DATE NULL,
  PRIMARY KEY (participationId),
  FOREIGN KEY (userId) REFERENCES user(id),
  FOREIGN KEY (gameId) REFERENCES planningGame(id))
ENGINE = InnoDB;