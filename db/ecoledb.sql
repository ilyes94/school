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
	civilite VARCHAR(1) ,
	nom VARCHAR(50),
	prenom VARCHAR(50),
	date_naissance DATE,
	lieu_naissance VARCHAR(50),
	adresse VARCHAR(255),
	ville VARCHAR(50),
	cp VARCHAR(5),
	tel VARCHAR(50),
	date_inscription date
);

CREATE TABLE scolarite(
	id_scolarite int not null auto_increment primary key,
	annee_scolaire varchar(50),
	eleve_fk int,
	classe varchar(50) 
	);
		
	alter table scolarite add constraint foreign key(eleve_fk) 
	references eleve(id_eleve) ON DELETE CASCADE;

INSERT INTO `utilisateur` (`id_utilisateur`,`nom`, `prenom`,`login`,`pwd`,`role`,`email`) VALUES 
 			(1,'Pog','Champ','admin','123','Directeur','admin@gmail.com'),
 			(2,'Okay','Champ','sec','123','Secrétaire','sec1@gmail.com');
			 
INSERT INTO `eleve` (`id_eleve`,`civilite`,`nom`,`prenom`,`date_naissance`,`lieu_naissance`,`adresse`,`ville`,`cp`,`tel`,`date_inscription`) VALUES

	( 1,'f','Damiri','Hind','1997-11-21','Marrakech','154 Imlil','Paris','75000','06 66 22 23 44', '2017-10-05'),
	( 2,'f','Kaftani','Souad','1998-02-25','Marrakech','120 Massira','Paris','75000','06 44 22 23 22', '2017-10-05');

INSERT INTO `scolarite`(`id_scolarite`,`annee_scolaire`,`eleve_fk`,`classe`) VALUES
		
		(null,'2020/2021',1,'6eme'),
		(null,'2020/2021',2,'5eme');
	