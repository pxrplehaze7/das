CREATE DATABASE das;

use `das`;

CREATE TABLE `das`.`usuario` (
    `IDUsuario` INT NOT NULL AUTO_INCREMENT,
    `NombreU` VARCHAR(200) NOT NULL,
    `ApellidoP` VARCHAR(100) NOT NULL,
    `ApellidoM` VARCHAR(100) NULL,
    `Rol` VARCHAR(50) NOT NULL,
    `Contrasenna` VARCHAR(300) NOT NULL,
    `CorreoU` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`IDUsuario`),
    UNIQUE (`CorreoU`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`prevision` (
    `IDPrev` INT NOT NULL,
    `NombrePrev` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IDPrev`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`contrato` (
    `IDCon` INT NOT NULL,
    `NombreCon` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`IDCon`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`categoria`(
    `IDCat` INT NOT NULL,
    `NombreCat` VARCHAR (250) NOT NULL,
    PRIMARY KEY (`IDcat`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`afp` (
    `IDAFP` INT NOT NULL,
    `NombreAFP` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IDAFP`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`lugar` (
    `IDLugar` INT NOT NULL,
    `NombreLug` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IDLugar`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`sector` (
    `IDSector` INT NOT NULL,
    `IDLugar` INT NOT NULL,
    `NombreSector` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IDSector`),
    FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`trabajador` (
    `IDTra` INT NOT NULL AUTO_INCREMENT,
    `IDCat` INT NOT NULL,
    `IDCon` INT NOT NULL,
    `IDAFP` INT NOT NULL,
    `IDPrev` INT NOT NULL,
    `IDLugar` INT NOT NULL,
    `IDSector` INT NOT NULL,
    `NombreTra` VARCHAR(200) NOT NULL,
    `PaternoTra` VARCHAR(100) NOT NULL,
    `MaternoTra` VARCHAR(100) NULL,
    `Rut` VARCHAR(10) NOT NULL,
    `Decreto` VARCHAR(30) NOT NULL,
    `Genero` VARCHAR(10) NOT NULL,
    `Medico` VARCHAR(2) NULL,
    `Inscripcion` BOOLEAN NOT NULL,
    `Profesion` VARCHAR(300) NOT NULL,
    `CelularTra` VARCHAR (9) NULL,
    `CorreoTra` VARCHAR(100) NULL,
    `RutaPrev` VARCHAR(400) NULL,
    `RutaCV` VARCHAR(400) NULL,
    `RutaAFP` VARCHAR(400) NULL,
    `RutaNac` VARCHAR(400) NULL,
    `RutaAntec` VARCHAR(400) NULL,
    `RutaCedula` VARCHAR(400) NULL,
    `RutaEstudio` VARCHAR(400) NULL,
    `RutaDJur` VARCHAR(400) NULL,
    `RutaSerM` VARCHAR(400) NULL,
    `RutaSCom` VARCHAR(400) NULL,
    `RutaExaM` VARCHAR(400) NULL,
    `RutaContrato` VARCHAR(400) NULL,
    `RutaInscripcion` VARCHAR(400) NULL,
    `Observ` VARCHAR(1000) NULL,
    `Cumple` BOOLEAN NOT NULL,
    PRIMARY KEY (`IDTra`),
    FOREIGN KEY (`IDCat`) REFERENCES categoria (`IDCat`),
    FOREIGN KEY (`IDCon`) REFERENCES contrato (`IDCon`),
    FOREIGN KEY (`IDAFP`) REFERENCES afp (`IDAFP`),
    FOREIGN KEY (`IDPrev`) REFERENCES prevision (`IDPrev`),
    FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`),
    UNIQUE (`Rut`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`calificaciones` (
    `IDCalif` INT NOT NULL AUTO_INCREMENT,
    `IDTra` INT NOT NULL,
    `fecha` VARCHAR(9) NOT NULL,
    `apelo` VARCHAR(2) NOT NULL,
    `RutaCalificacion` VARCHAR(400) NULL,
    `RutaApelacion` VARCHAR(400) NULL,
    PRIMARY KEY (`IDCalif`),
    FOREIGN KEY (`IDTra`) REFERENCES trabajador (`IDTra`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (1, 'No posee');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (2, 'AFP Cuprum');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (3, 'AFP Habitat');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (4, 'AFP Modelo');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (5, 'AFP PlanVital');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (6, 'AFP Provida');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (7, 'AFP Uno');

INSERT INTO
    `afp`(`IDAFP`, `NombreAFP`)
VALUES
    (8, 'AFP Capital');

INSERT INTO
    `contrato`(`IDCon`, `NombreCon`)
VALUES
    (1, 'Reemplazo');

INSERT INTO
    `contrato`(`IDCon`, `NombreCon`)
VALUES
    (2, 'Plazo Fijo');

INSERT INTO
    `contrato`(`IDCon`, `NombreCon`)
VALUES
    (3, 'Honorarios');

INSERT INTO
    `contrato`(`IDCon`, `NombreCon`)
VALUES
    (4, 'Indefinido');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (1, 'Dirección de Administración de Salud');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (2, 'CESFAM Dra. Eloisa Diaz');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (3, 'CESFAM/SAPU La leonera');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (4, 'CESFAM Valle la Piedra');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (5, 'CESFAM Chiguayante');

INSERT INTO
    `lugar`(`IDLugar`, `NombreLug`)
VALUES
    (6, 'SAR Chiguayante');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (1, 1, 'No Aplica');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (2, 1, 'Droguería');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (3, 2, 'No Aplica');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (4, 2, 'Óptica Municipal');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (5, 2, 'Ruka Antü');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (6, 3, 'No Aplica');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (7, 4, 'No Aplica');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (8, 4, 'Laboratorio Dental');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (9, 5, 'No Aplica');


INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (10, 5, 'Farmacia Municipal');

INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (11, 5, 'Casa de Salud Mental');

    INSERT INTO
    `sector`(`IDSector`, `IDLugar`, `NombreSector`)
VALUES
    (12, 6, 'No Aplica');

INSERT INTO
    `prevision`(`IDPrev`, `NombrePrev`)
VALUES
    (1, 'No posee');

INSERT INTO
    `prevision`(`IDPrev`, `NombrePrev`)
VALUES
    (2, 'FONASA');

INSERT INTO
    `prevision`(`IDPrev`, `NombrePrev`)
VALUES
    (3, 'ISAPRE');

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (
        1,
        'a) Médicos Cirujanos, Farmacéuticos, Químico-Farmacéuticos, Bioquímicos y Cirujano-Dentistas.'
    );

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (2, 'b) Otros profesionales.');

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (3, 'c) Técnicos de nivel superior.');

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (4, 'd) Técnicos de Salud.');

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (5, 'e) Administrativos de Salud.');

INSERT INTO
    `categoria`(`IDCat`, `NombreCat`)
VALUES
    (6, 'f) Auxiliares de servicios de Salud.');