CREATE DATABASE das;

use `das`;

CREATE TABLE
    `das`.`usuario` (
        `IDUsuario` INT NOT NULL AUTO_INCREMENT,
        `NombreU` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `ApellidoP` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `ApellidoM` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
        `Rol` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `Contrasenna` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `CorreoU` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDUsuario`),
        UNIQUE (`CorreoU`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`prevision` (
        `IDPrev` INT NOT NULL,
        `NombrePrev` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDPrev`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`contrato` (
        `IDCon` INT NOT NULL,
        `NombreCon` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDCon`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`categoria`(
        `IDCat` INT NOT NULL,
        `NombreCat` VARCHAR (250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDcat`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`afp` (
        `IDAFP` INT NOT NULL,
        `NombreAFP` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDAFP`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`lugar` (
        `IDLugar` INT NOT NULL,
        `NombreLug` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        PRIMARY KEY (`IDLugar`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE
    `das`.`trabajador` (
        `IDTra` INT NOT NULL AUTO_INCREMENT,
        `IDCat` INT NOT NULL,
        `IDCon` INT NOT NULL,
        `IDAFP` INT NULL,
        `IDPrev` INT NULL,
        `IDLugar` INT NOT NULL,
        `NombreTra` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `PaternoTra` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `MaternoTra` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
        `Rut` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `Decreto` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `Genero` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `Medico` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
        `Profesion` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
        `Sector` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
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
        `RutaContrato` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
        `Observ` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
        PRIMARY KEY (`IDTra`),
        FOREIGN KEY (`IDCat`) REFERENCES categoria (`IDCat`),
        FOREIGN KEY (`IDCon`) REFERENCES contrato (`IDCon`),
        FOREIGN KEY (`IDAFP`) REFERENCES afp (`IDAFP`),
        FOREIGN KEY (`IDPrev`) REFERENCES prevision (`IDPrev`),
        FOREIGN KEY (`IDLugar`) REFERENCES lugar (`IDLugar`),
        UNIQUE (`Rut`)
    ) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

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

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (2, 'CESFAM Dra. Eloisa Diaz');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (3, 'CESFAM/SAPU La leonera');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (4, 'CESFAM Valle la Piedra');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (5, 'CESFAM Chiguayante');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (6, 'SAR Chiguayante');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (7, 'Centro de Salud Mental');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (8, 'Farmacia Municipal');

INSERT INTO `lugar`(`IDLugar`, `NombreLug`) VALUES (9,'Droguería');


INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (1,'FONASA');

INSERT INTO `prevision`(`IDPrev`, `NombrePrev`) VALUES (2,'ISAPRE');


INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (1,'a) Médicos Cirujanos, Farmacéuticos, Químico-Farmacéuticos, Bioquímicos y Cirujano-Dentistas.');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (2, 'b) Otros profesionales.');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (3,'c) Técnicos de nivel superior.');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (4, 'd) Técnicos de Salud.');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (5,'e) Administrativos de Salud.');

INSERT INTO `categoria`(`IDCat`, `NombreCat`) VALUES (6,'f) Auxiliares de servicios de Salud.');













INSERT INTO trabajador (IDCat) VALUES ('$categoriaP');
    INSERT INTO trabajador (IDCon) VALUES ('$contratoP');----tipo de contrato--
    INSERT INTO trabajador (IDAFP) VALUES ('$afpP');
    INSERT INTO trabajador (IDPrev) VALUES ('$prevP');
    INSERT INTO trabajador (IDLugar) VALUES ('$lugarP');
    INSERT INTO trabajador (NombreTra) VALUES ('$nombreP');
    INSERT INTO trabajador (PaternoTra) VALUES ('$paternoP');
    INSERT INTO trabajador (MaternoTra) VALUES ('$maternoP');
    INSERT INTO trabajador (Rut) VALUES ('$rutPersona');
    INSERT INTO trabajador (Genero) VALUES ('$generoP');
    INSERT INTO trabajador (Profesion) VALUES ('$profesionP');
    INSERT INTO trabajador (Sector) VALUES ('$sector');
    INSERT INTO trabajador (Decreto) VALUES ('$decreto');
    INSERT INTO trabajador (Medico) VALUES ('$medicoOno');
    INSERT INTO trabajador (CelularTra) VALUES ('$CelularP');
    INSERT INTO trabajador (CorreoTra) VALUES ('$correoP');
    INSERT INTO trabajador (RutaPrev) VALUES ('$ruta_PrevisionFINAL');
    INSERT INTO trabajador (RutaCV) VALUES ('$ruta_CurriculumFINAL');
    INSERT INTO trabajador (RutaAFP) VALUES ('$ruta_afpFINAL');
    INSERT INTO trabajador (RutaContrato) VALUES ('$ruta_ContratoFINAL'); ---contrato en pdf ruta---
    INSERT INTO trabajador (RutaNac) VALUES ('$ruta_nacFINAL');
    INSERT INTO trabajador (RutaAntec) VALUES ('$ruta_AntecedentesFINAL');
    INSERT INTO trabajador (RutaCedula) VALUES ('$ruta_CedulaFINAL');
    INSERT INTO trabajador (RutaEstudio) VALUES ('$ruta_EstudiosFINAL');
    INSERT INTO trabajador (RutaDJur) VALUES ('$ruta_DJuradaFINAL');
    INSERT INTO trabajador (RutaSerM) VALUES ('$ruta_militarFINAL');
    INSERT INTO trabajador (RutaSCom) VALUES ('$ruta_SaludCompatFINAL');
    INSERT INTO trabajador (RutaExaM) VALUES ('$ruta_ExamenMFINAL');
    INSERT INTO trabajador (Obser) VALUES ('$obsP');";































