
CREATE DATABASE das;
use `das`;

CREATE TABLE `das`.`usuario` (
  `IDUsuario` INT NOT NULL AUTO_INCREMENT,
  `NombreU` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoP` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoM` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `Rol` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Contrasenna` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CorreoU` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IDUsuario`),
  UNIQUE (`CorreoU`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`prevision` (
  `IDPrev` INT NOT NULL,
  `NombrePrev` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IDPrev`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`contrato` (
    `IDCon` INT NOT NULL,
    `NombreCon` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (`IDCon`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`categoria`(
    `IDCat` INT NOT NULL,
    `NombreCat` VARCHAR (250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (`IDcat`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`afp` (
    `IDAFP` INT NOT NULL,
    `NombreAFP` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (`IDAFP`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`lugar` (
    `IDLugar` INT NOT NULL,
    `NombreLug` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (`IDLugar`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`trabajador` (
    `IDTra` INT NOT NULL AUTO_INCREMENT,
    `IDCat` INT NOT NULL,
    `IDCon` INT NOT NULL,
    `IDAFP` INT NULL,
    `IDPrev`INT NULL,
    `IDLugar` INT NOT NULL,
    `NombreTra` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `PaternoTra` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `MaternoTra` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `Rut`VARCHAR(10)CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `Genero` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `Medico` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `Profesion`VARCHAR(300)CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    `CelularTra` VARCHAR (9) NULL,
    `CorreoTra` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaPrev` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaCV` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaAFP` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaNac` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaAntec` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaCedula` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaEstudio` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaDJur` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaSerM` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaSCom` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `RutaExaM` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
    `Observ` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci  NULL,
    PRIMARY KEY (`IDTra`),
    FOREIGN KEY (`IDCat`) REFERENCES categoria (`IDCat`),
    FOREIGN KEY (`IDCon`) REFERENCES contrato (`IDCon`),
    FOREIGN KEY (`IDAFP`) REFERENCES afp (`IDAFP`),
    FOREIGN KEY (`IDPrev`) REFERENCES prevision (`IDPrev`),
    FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`),
    UNIQUE (`Rut`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_spanish_ci;


INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (1,'AFP Capital');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (2,'AFP Cuprum');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (3,'AFP Habitat');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (4,'AFP Modelo');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (5,'AFP PlanVital');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (6,'AFP Provida');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (7,'AFP Uno');

INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (1,'Reemplazo');
INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (2,'Plazo Fijo');
INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (3,'Honorarios');
INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (4,'Indefinido');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (1,'Dirección de Administración de Salud');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (2,'Cesfam Dra. Eloisa Diaz');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (3,'Cesfam La leonera');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (4,'Cesfam Valle la Piedra');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (5,'Cesfam Chiguayante');

INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (1,'FONASA');
INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (2,'ISAPRE');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (1,'a) Médicos Cirujanos, Farmacéuticos, Químico-Farmacéuticos, Bioquímicos y Cirujano-Dentistas.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (2,'b) Otros profesionales.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (3,'c) Técnicos de nivel superior.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (4,'d) Técnicos de Salud.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (5,'e) Administrativos de Salud.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (6,'f) Auxiliares de servicios de Salud.');
