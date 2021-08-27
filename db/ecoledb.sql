DROP DATABASE IF EXISTS school;

CREATE DATABASE school;

USE school;

CREATE TABLE utilisateur(
	id_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom varchar(64),
	prenom varchar(64),
	login VARCHAR(100),
	pwd VARCHAR(255),
	role VARCHAR(50),
	email VARCHAR(255)
);

CREATE TABLE eleve (
	id_eleve INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	sexe VARCHAR(5) ,
	nom VARCHAR(50),
	prenom VARCHAR(50),
	email VARCHAR(255),
	date_naissance DATE,
	lieu_naissance VARCHAR(50),
	adresse VARCHAR(255),
	ville VARCHAR(50),
	cp VARCHAR(5),
	tel VARCHAR(50),
	date_inscription date,
	utilisateur_fk INT
);
	alter table eleve add constraint foreign key(utilisateur_fk) 
	references utilisateur(id_utilisateur) ON DELETE CASCADE;

CREATE TABLE classe(
	id_classe int not null auto_increment primary key,
	nom_classe varchar(50) 
	);

CREATE TABLE scolarite(
	id_scolarite int not null auto_increment primary key,
	annee_scolaire varchar(50),
	eleve_fk int,
	classe_fk int
	);
		
	alter table scolarite add constraint foreign key(eleve_fk) 
	references eleve(id_eleve) ON DELETE CASCADE;

	alter table scolarite add constraint foreign key(classe_fk) 
	references classe(id_classe) ON DELETE CASCADE;

CREATE TABLE controle(
	id_controle int not null auto_increment primary key,
	classe_fk int,
	matiere varchar(50),
	date varchar(50) 
	);
		
	alter table controle add constraint foreign key(classe_fk) 
	references classe(id_classe) ON DELETE CASCADE;

CREATE TABLE note_controle(
	id_note_controle int not null auto_increment primary key,
	controle_fk int,
	eleve_fk int,
	absence boolean,
	note varchar(50) 
);

	alter table note_controle add constraint foreign key(controle_fk) 
	references controle(id_controle) ON DELETE CASCADE;

	alter table note_controle add constraint foreign key(eleve_fk) 
	references eleve(id_eleve) ON DELETE CASCADE;


INSERT INTO `utilisateur` (`id_utilisateur`,`nom`, `prenom`,`login`,`pwd`,`role`,`email`) VALUES 
 	(1,'Pog','Champ','admin','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Directeur','admin@gmail.com'),
 	(2,'Okay','Champ','sec','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Secrétaire','sec1@gmail.com');
			 
INSERT INTO `eleve` (`id_eleve`,`sexe`,`nom`,`prenom`, `email`,`date_naissance`,`lieu_naissance`,`adresse`,`ville`,`cp`,`tel`,`date_inscription`) VALUES
	( 1,'Mme','Damiri','Hind','hind@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05'),
	( 2,'Mme','Kaftani','Souad','souad@gmail.com','1998-02-25','Paris','120 Massira','Paris','75000','0644222322', '2020-10-05'),
	( 3,'Mme','Damiri','Hind1','hind1@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05'),
	( 4,'Mme','Damiri','Hind2','hind2@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05'),
	( 5,'Mme','Damiri','Hind3','hind3@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05');

INSERT INTO `classe`(`id_classe`,`nom_classe`) VALUES
	(null,'6éme'),
	(null,'5éme'),
	(null,'4éme'),
	(null,'3éme');

INSERT INTO `scolarite`(`id_scolarite`,`annee_scolaire`,`eleve_fk`,`classe_fk`) VALUES
	(null,'2020/2021',1,1),
	(null,'2020/2021',2,2);

INSERT INTO `controle`(`id_controle`,`classe_fk`,`matiere`,`date`) VALUES
	(null,1,'Math','2020-10-05'),
	(null,1,'Physiques','2020-10-05');

INSERT INTO `note_controle`(`id_note_controle`,`controle_fk`,`eleve_fk`,`absence`,`note`) VALUES
	(null,1,1,0,15),
	(null,2,1,0,10),
	(null,1,3,0,5),
	(null,1,4,1,0),
	(null,1,5,0,10);
	