CREATE TABLE Utilisateur( 
eMail varchar(100) PRIMARY KEY,
nom varchar(30) NOT NULL,
prenom  varchar(30) NOT NULL,
motDePasse varchar(70) NOT NULL,
estFromager bool NOT NULL
);

CREATE TABLE Fromage(
nom varchar(60),
departementFabrication varchar(30),
urlWikipedia varchar(100),
lait varchar(30) NOT NULL,
image varchar(60) NOT NULL,
typePate varchar(40) NOT NULL,
vinAssocie varchar(40) NOT NULL,
PRIMARY KEY (nom, departementFabrication)
);

CREATE TABLE Favori(
nomFromage varchar(50),
departementFromage varchar(3),
idUtilisateur varchar(100),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(eMail),
FOREIGN KEY (nomFromage,departementFromage) REFERENCES Fromage(nom,departementFabrication),
PRIMARY KEY (nomFromage, departementFromage, idUtilisateur)
);

CREATE TABLE Produire(
nomFromage varchar(50),
departementFromage varchar(3),
idUtilisateur varchar(100),
nomBoutique varchar(50) NOT NULL,
ville varchar(30) NOT NULL,
rue varchar(50) NOT NULL,
codePostal char(5) NOT NULL,
FOREIGN KEY (nomFromage,departementFromage) REFERENCES Fromage(nom,departementFabrication),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(eMail),
PRIMARY KEY (nomFromage, departementFromage, idUtilisateur)
);

CREATE TABLE Commenter(
nomFromage varchar(50),
departementFromage varchar(3),
idUtilisateur varchar(100),
avis varchar(200),
FOREIGN KEY (nomFromage,departementFromage) REFERENCES Fromage(nom,departementFabrication),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(eMail),
PRIMARY KEY (nomFromage, departementFromage, idUtilisateur, avis)
);

CREATE TABLE Noter(
nomFromage varchar(50),
departementFromage varchar(3),
idUtilisateur varchar(100),
note numeric CHECK(note<=5),
FOREIGN KEY (nomFromage,departementFromage) REFERENCES Fromage(nom,departementFabrication),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(eMail),
PRIMARY KEY (nomFromage, departementFromage, idUtilisateur)
);
