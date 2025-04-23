-- Debug
DROP SCHEMA IF EXISTS StoreConfig;


-- Creation de la bd
CREATE SCHEMA IF NOT EXISTS StoreConfig;
USE StoreConfig;


-- Table utilisateurs
CREATE TABLE IF NOT EXISTS Utilisateurs (
	Id INT NOT NULL AUTO_INCREMENT,
    NomUtilisateur VARCHAR(50) NOT NULL,
    Courriel VARCHAR(100) NOT NULL,
    MDP VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id, NomUtilisateur, Courriel)
);

-- Table des reseaux (Plusieurs reseaux par utilisateur)
CREATE TABLE IF NOT EXISTS Reseaux (
	Id INT NOT NULL AUTO_INCREMENT,
    NomReseau VARCHAR(50) NOT NULL,
    IdProprietaire INT NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (IdProprietaire) REFERENCES Utilisateurs(Id)
);

-- Table des machines (Plusieurs machine par reseau)
CREATE TABLE IF NOT EXISTS Machines (
	Id INT NOT NULL AUTO_INCREMENT,
    NomMachine VARCHAR(50) NOT NULL,
    Modele INT NOT NULL,
    IdReseau INT NOT NULL,
    API bool NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (IdReseau) REFERENCES Reseaux(Id)
);

-- Table des modeles de machines
CREATE TABLE IF NOT EXISTS Modeles (
	Id INT NOT NULL AUTO_INCREMENT,
    NomModele VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
);


-- Table des API des machines
CREATE TABLE IF NOT EXISTS API (
	Id INT NOT NULL AUTO_INCREMENT,
    IdMachine INT NOT NULL,
    AdresseServeur VARCHAR(100) NOT NULL,
    NomUtilisateur VARCHAR(50) NOT NULL,
    MDP VARCHAR(128) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (IdMachine) REFERENCES Machines(Id)
    
);

-- Table de l'API de proxmox
CREATE TABLE IF NOT EXISTS APIProxmox (
	Id INT NOT NULL AUTO_INCREMENT,
    IdAPI INT NOT NULL,
    PVEName VARCHAR(10) NOT NULL,
    VMID INT,
    PRIMARY KEY (Id),
    FOREIGN KEY (IdAPI) REFERENCES API(Id)

);

-- Table des types d'interface (VLAN, BRIDGE, ETHER, TUNNEL, AUTRES)
CREATE TABLE IF NOT EXISTS TypesInterface (
	Id INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(20),
    PRIMARY KEY (Id)
);


-- Table des configs des machines (Plusieurs configs d'interfaces par machine)
CREATE TABLE IF NOT EXISTS Interfaces (
	Id INT NOT NULL AUTO_INCREMENT,
    IdMachine INT NOT NULL,
    Nom VARCHAR(20) NOT NULL,
    IdType INT NOT NULL,
    AddressMAC VARCHAR(20),
    AddresseIP VARCHAR(20),
    CIDR INT,
    Passerelle VARCHAR(20),
    Commentaires VARCHAR(250),
    PRIMARY KEY (Id),
    FOREIGN KEY (IdMachine) REFERENCES Machines(Id),
    FOREIGN KEY (IdType) REFERENCES TypesInterface(Id)
);







