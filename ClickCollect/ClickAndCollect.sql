Drop Database if exists ClickAndCollect;
Create Database ClickAndCollect;
Use ClickAndCollect;

Create Table Utilisateur (
	Numero Int Primary Key auto_increment,
    Nom Varchar(30),
    Prenom Varchar(30),
    Mdp Varchar(255),
    Adresse Varchar(100),
    Ville Varchar(255),
    CodePostal Int(5),
    Email Varchar(255),
    Tel Int(10),
    DateNaiss Date
)Engine InnoDB;

Create Table Restaurateur (
	Numero Int Primary Key auto_increment,
    NomE Varchar(30),
    Mdp Varchar(255),
    Adresse Varchar(100),
    Ville Varchar(255),
    CodePostal Varchar(255),
    Email Varchar(255),
    Siret BigInt(14),
    Tel Int(10),
    UrlSite Varchar(255) Null
)Engine InnoDB;

Create Table Commande(
	Id Int,
    NumUtil Int,
    NumRest Int,
    Primary Key (id, NumUtil, NumRest),
    Foreign key (NumUtil) references Utilisateur(Numero),
	Foreign key (NumRest) references Restaurateur(Numero)
)Engine InnoDB;

Create Table Plat(
	Id Int Primary Key auto_increment,
    Description Varchar(255),
    Prix float(2)
)Engine InnoDB;

Create Table Commande_Plat(
	IdCommande Int,
	IdUtil Int,
    IdRest Int,
    IdPlat Int,
    NbPlat Int,
    Primary Key (IdCommande, IdUtil, IdRest, IdPlat, NbPlat),
    Foreign key (IdCommande) references Commande(Id),
    Foreign key (IdUtil) references Utilisateur(Numero),
    Foreign key (IdRest) references Restaurateur(Numero),
    Foreign key (IdPlat) references Plat(Id) 
)Engine InnoDB;

