-- Create Data Base : --
CREATE DATABASE DataWare;
USE DataWare;

-- Table pour les équipes
CREATE TABLE IF NOT EXISTS Equipes (
    ID_Equipe INT PRIMARY KEY AUTO_INCREMENT,
    Name_Eq VARCHAR(255) NOT NULL,
    DateCreation DATE,
    Description VARCHAR(255)
);
-- Table pour les utilisateurs (Admin - User)
CREATE TABLE IF NOT EXISTS Users (
    ID_Users INT PRIMARY KEY AUTO_INCREMENT,
    Matricule VARCHAR(50) UNIQUE,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Telephone VARCHAR(15),
    Role VARCHAR(50) NOT NULL,
    ID_Equipe INT,
    Statut VARCHAR(50),
    Date_naissance DATE,
    Adresse VARCHAR(255),
    Password VARCHAR(255) NOT NULL, 
    EstAdmin BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (ID_Equipe) REFERENCES Equipes(ID_Equipe)
);

-- Insertion la tabe Equipes :

INSERT INTO Equipes (NomEquipe, DateCreation, Description) VALUES
    ('ÉquipeX', '2023-11-01', 'Description X'),
    ('ÉquipeY', '2023-11-15', 'Description Y'),
    ('ÉquipeZ', '2023-11-25', 'Description Z'),
    ('ÉquipeW', '2023-12-01', 'Description W'),
    ('ÉquipeV', '2023-11-30', 'Description V');
-- Insertion des utilisateurs
INSERT INTO Users (Matricule, Nom, Prenom, Email, Telephone, Role, ID_Equipe, Statut, Date_naissance, Adresse, Password, EstAdmin)
VALUES
    ('M12345', 'Admin', 'Admin', 'admin@example.com', '+212612345678', 'Admin', 1, 'Active', '1980-01-01', '15° Rue Principale, SAFI', 'ad@123', TRUE),
    ('M67890', 'John', 'Doe', 'john.doe@example.com', '+212612345679', 'Developer', 2, 'Active', '1990-02-01', '123 Main St, SAFI', 'user@123', FALSE),
    ('M67891', 'Alice', 'Smith', 'alice.smith@example.com', '+212612345680', 'Developer', 3, 'Active', '1990-03-01', '456 Oak St, SAFI', 'user@1232', FALSE),
    ('M67892', 'Bob', 'Johnson', 'bob.johnson@example.com', '+212612345681', 'Tester', 4, 'Inactif', '1990-04-01', '789 Pine St, SAFI', 'user@1233', FALSE),
    ('M67893', 'Eva', 'Brown', 'eva.brown@example.com', '+212612345682', 'Security Analyst', 5, 'Active', '1990-05-01', '101 Cedar St, SAFI', 'user@1234', FALSE),
    ('M67894', 'David', 'Miller', 'david.miller@example.com', '+212612345683', 'DevOps Engineer', 6, 'Inactif', '1990-06-01', '202 Maple St, SAFI', 'user@1235', FALSE);

SELECT 
    Users.Matricule, Users.Nom, Users.Prenom, Users.Email, Users.Telephone, Users.Role, 
    Users.ID_Eq, Users.Statut, Users.Date_naissance, Users.Adresse, Users.Password, Users.EstAdmin,
    Equipes.Name_Eq
FROM 
    Users
INNER JOIN 
    Equipes ON Users.ID_Eq = Equipes.ID_Eq;
