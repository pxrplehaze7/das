CREATE DATABASE dasPruebas;
use `dasPruebas`;

CREATE TABLE `dasPruebas`.`afp` (
    `IDAFP` INT NOT NULL,
    `NombreAFP` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (`IDAFP`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `dasPruebas`.`trabajador` (
    `IDTra` INT NOT NULL AUTO_INCREMENT,
    `IDAFP` INT NOT NULL,
    `Rut`VARCHAR(10)CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `Genero` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `RutaAFP` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `RutaNac` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `RutaSerM` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    PRIMARY KEY (`IDTra`),
    FOREIGN KEY (`IDAFP`) REFERENCES afp (`IDAFP`),
    UNIQUE (`Rut`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;