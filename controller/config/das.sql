CREATE DATABASE das;
USE `das`;

CREATE TABLE `das`.`usuario` (
    `IDUsuario` INT NOT NULL AUTO_INCREMENT,
    `RutU` VARCHAR(10) NOT NULL,
    `NombreU` VARCHAR(200) NOT NULL,
    `ApellidoP` VARCHAR(100) NOT NULL,
    `ApellidoM` VARCHAR(100) NULL,
    `Rol` BOOLEAN NOT NULL,
    `Contrasenna` VARCHAR(300) NOT NULL,
    `CorreoU` VARCHAR(100) NOT NULL,
    `Eliminable` BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY (`IDUsuario`),
    UNIQUE (`CorreoU`),
    UNIQUE (`RutU`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

    DELIMITER $$
    CREATE TRIGGER before_delete_usuario
    BEFORE DELETE ON usuario
    FOR EACH ROW
    BEGIN
        IF OLD.IDUsuario = 1 AND OLD.Eliminable = 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede eliminar el usuario con ID 1.';
        END IF;
    END$$
    DELIMITER ;


CREATE TABLE `das`.`prevision` (
    `IDPrev` INT NOT NULL,
    `NombrePrev` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`IDPrev`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`categoria` (
    `IDCat` INT NOT NULL,
    `NombreCat` VARCHAR(250) NOT NULL,
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

CREATE TABLE `das`.`contrato` (
    `IDCon` INT NOT NULL,
    `NombreCon` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`IDCon`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `das`.`trabajador` (
    `IDTra` INT NOT NULL,
    `IDCat` INT NOT NULL,
    `IDAFP` INT NOT NULL,
    `IDPrev` INT NOT NULL,
    `NombreTra` VARCHAR(200) NOT NULL,
    `PaternoTra` VARCHAR(100) NOT NULL,
    `MaternoTra` VARCHAR(100) NULL,
    `Rut` VARCHAR(10) NOT NULL,
    `Genero` VARCHAR(10) NOT NULL,
    `Medico` VARCHAR(2) NOT NULL,
    `Inscripcion` BOOLEAN NOT NULL,
    `Profesion` VARCHAR(300) NOT NULL,
    `CelularTra` VARCHAR(9) NULL,
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
    `RutaInscripcion` VARCHAR(400) NULL,
    `Observ` VARCHAR(1000) NULL,
    `Cumple` BOOLEAN NOT NULL,
    PRIMARY KEY (`IDTra`),
    FOREIGN KEY (`IDCat`) REFERENCES categoria (`IDCat`),
    FOREIGN KEY (`IDAFP`) REFERENCES afp (`IDAFP`),
    FOREIGN KEY (`IDPrev`) REFERENCES prevision (`IDPrev`),
    UNIQUE (`Rut`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;




CREATE TABLE `das`.`honorario` (
    `IDTraH` INT NOT NULL,
    `IDCat` INT NOT NULL,
    `NombreH` VARCHAR(200) NOT NULL,
    `PaternoH` VARCHAR(100) NOT NULL,
    `MaternoH` VARCHAR(100) NULL,
    `Rut` VARCHAR(10) NOT NULL,
    `Genero` VARCHAR(10) NOT NULL,
    `Medico` VARCHAR(2) NOT NULL,
    `Inscripcion` BOOLEAN NOT NULL,
    `Profesion` VARCHAR(300) NOT NULL,
    `CelularH` VARCHAR(9) NULL,
    `CorreoH` VARCHAR(100) NULL,
    `RutaCV` VARCHAR(400) NULL,
    `RutaAntec` VARCHAR(400) NULL,
    `RutaCedula` VARCHAR(400) NULL,
    `RutaEstudio` VARCHAR(400) NULL,
    `RutaExaM` VARCHAR(400) NULL,
    `RutaInscripcion` VARCHAR(400) NULL,
    `Observ` VARCHAR(1000) NULL,
    `Cumple` BOOLEAN NOT NULL,
    PRIMARY KEY (`IDTraH`),
    FOREIGN KEY (`IDCat`) REFERENCES categoria (`IDCat`),
    UNIQUE (`Rut`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;





CREATE TABLE `das`.`decretosH` (
    `IDdecretoH` INT NOT NULL AUTO_INCREMENT,
    `IDTraH` INT NOT NULL,
    `IDLugar` INT NULL,
    `IDSector` INT NULL,
    `TipodeHono` VARCHAR(100) NOT NULL,
    `NDecreto` INT (10) NULL,
    `FechaDoc` DATE NULL,
    `RutaCon` VARCHAR(400) NULL,
    `FechaInicio` DATE NULL,
    `FechaTermino` DATE NULL,
    `FechaAlerta` DATE NULL,
    `Estado` INT (1) NULL,
    `Confirmacion` INT (1) NOT NULL,
    PRIMARY KEY (`IDdecretoH`),
    FOREIGN KEY (`IDTraH`) REFERENCES honorario (`IDTraH`),
    FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;





CREATE TABLE `das`.`decretos` (
    `IDdecreto` INT NOT NULL AUTO_INCREMENT,
    `IDTra` INT NOT NULL,
    `IDCon` INT NULL,
    `IDLugar` INT NULL,
    `IDSector` INT NULL,
    `NDecreto` INT (10) NULL,
    `FechaDoc` DATE NULL,
    `RutaCon` VARCHAR(400) NULL,
    `FechaInicio` DATE NULL,
    `FechaTermino` DATE NULL,
    `FechaAlerta` DATE NULL,
    `Estado` INT (1) NULL,
    `Confirmacion` INT (1) NOT NULL,
    PRIMARY KEY (`IDdecreto`),
    FOREIGN KEY (`IDTra`) REFERENCES trabajador (`IDTra`),
    FOREIGN KEY (`IDCon`) REFERENCES contrato (`IDCon`),
    FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`)
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


CREATE TABLE `das`.`informes` (
    `IDinf` INT NOT NULL AUTO_INCREMENT,
    `IDTraH` INT NOT NULL,
    `mes` VARCHAR (10) NOT NULL,
    `anno` VARCHAR(4) NOT NULL,
    `RutaInforme` VARCHAR(400) NULL,
    `funcion` VARCHAR(400) NOT NULL,
    PRIMARY KEY (`IDinf`),
    FOREIGN KEY (`IDTraH`) REFERENCES honorario (`IDTraH`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;



INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (1, 'Reemplazo');
INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (2, 'Plazo Fijo');
INSERT INTO `contrato`(`IDCon`, `NombreCon`) VALUES (3, 'Indefinido');


INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (1, 'No posee');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (2, 'AFP Cuprum');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (3, 'AFP Habitat');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (4, 'AFP Modelo');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (5, 'AFP PlanVital');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (6, 'AFP Provida');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (7, 'AFP Uno');
INSERT INTO `afp`(`IDAFP`, `NombreAFP`) VALUES (8, 'AFP Capital');



INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (1, 'Dirección de Administración de Salud');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (2, 'CESFAM Pinares');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (3, 'CESFAM La Leonera');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (4, 'CESFAM Valle la Piedra');
INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (5, 'CESFAM Chiguayante');


INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (1, 1, 'Dirección de Administración de Salud');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (2, 1, 'Droguería Comunal');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (3, 2, 'CESFAM Pinares');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (4, 2, 'Centro Oftalmológico');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (5, 2, 'Ruka Antü');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (6, 3, 'CESFAM La Leonera');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (7, 3, 'SAPU La Leonera');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (8, 4, 'CESFAM Valle la Piedra');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (9, 4, 'Laboratorio Comunal Dental');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (10, 5, 'CESFAM Chiguayante');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (11, 5, 'Farmacia Municipal');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (12, 5, 'Centro de Salud Mental');
INSERT INTO `sector`(`IDSector`, `IDLugar`, `NombreSector`) VALUES (13, 5, 'SAR Chiguayante');

INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (1, 'No posee');
INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (2, 'FONASA');
INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (3, 'ISAPRE');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (1, 'a) Médicos Cirujanos, Farmacéuticos, Químico-Farmacéuticos, Bioquímicos y Cirujano-Dentistas.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (2, 'b) Otros profesionales.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (3, 'c) Técnicos de nivel superior.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (4, 'd) Técnicos de Salud.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (5, 'e) Administrativos de Salud.');
INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (6, 'f) Auxiliares de servicios de Salud.');


INSERT INTO `usuario` (`RutU`, `NombreU`, `ApellidoP`, `ApellidoM`, `Rol`, `Contrasenna`, `CorreoU`, `Eliminable`) VALUES ('11111111-1', 'Admin', 'Admin', '', 1, '$2y$10$iA0W10c.3RkqRixtFYDr9Oitl/ZSOrh5/1U46D3N90fcwlmX6P9Ni', 'admin@gmail.com', 0);




