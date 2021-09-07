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
	nom VARCHAR(64),
	prenom VARCHAR(64),
	email VARCHAR(255),
	date_naissance DATE,
	lieu_naissance VARCHAR(64),
	adresse VARCHAR(255),
	ville VARCHAR(64),
	cp VARCHAR(15),
	tel VARCHAR(20),
	date_inscription DATE,
	utilisateur_fk INT
);
	ALTER TABLE eleve ADD CONSTRAINT FOREIGN KEY(utilisateur_fk) 
	REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE;

CREATE TABLE classe(
	id_classe int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom_classe varchar(64),
	annee_scolaire_classe varchar(64)
	);

CREATE TABLE scolarite(
	id_scolarite int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	annee_scolaire varchar(64),
	eleve_fk int,
	classe_fk int
	);
		
	ALTER TABLE scolarite ADD CONSTRAINT FOREIGN KEY(eleve_fk) 
	REFERENCES eleve(id_eleve) ON DELETE CASCADE;

	ALTER TABLE scolarite ADD CONSTRAINT FOREIGN KEY(classe_fk) 
	REFERENCES classe(id_classe) ON DELETE CASCADE;

CREATE TABLE controle(
	id_controle int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	classe_fk int,
	matiere varchar(64),
	date_controle varchar(64) 
	);
		
	ALTER TABLE controle ADD CONSTRAINT FOREIGN KEY(classe_fk) 
	REFERENCES classe(id_classe) ON DELETE CASCADE;

CREATE TABLE note_controle(
	id_note_controle int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	controle_fk int,
	eleve_fk int,
	absence tinyint(1),
	note varchar(64) 
);

	ALTER TABLE note_controle ADD CONSTRAINT FOREIGN KEY(controle_fk) 
	REFERENCES controle(id_controle) ON DELETE CASCADE;

	ALTER TABLE note_controle ADD CONSTRAINT FOREIGN KEY(eleve_fk) 
	REFERENCES eleve(id_eleve) ON DELETE CASCADE;


CREATE TABLE livre (
	isbn int AUTO_INCREMENT PRIMARY KEY,
	titre_livre varchar(64),
	type_livre varchar(64),
	auteur_livre varchar(64),
	etat tinyint(1),
	img_livre text
);

CREATE TABLE emprunt (
	id_emprunt int AUTO_INCREMENT PRIMARY KEY,
	eleve_fk int,
	isbn_fk int,
	date_emprunt DATE
);

	ALTER TABLE emprunt ADD CONSTRAINT FOREIGN KEY(eleve_fk) 
	REFERENCES eleve(id_eleve) ON DELETE CASCADE;

	ALTER TABLE emprunt ADD CONSTRAINT FOREIGN KEY(isbn_fk) 
	REFERENCES livre(isbn);

INSERT INTO `utilisateur` (`id_utilisateur`,`nom`, `prenom`,`login`,`pwd`,`role`,`email`) VALUES 
 	(1,'Directeur','Admin','admin','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Directeur','admin@school.com'),
 	(2,'Okay','Sec','sec','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Secrétaire','sec1@school.com'),
	(3,'Damiri','Hind','Damiri','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Eléve','hind@gmail.com'),
	(4,'Kaftani','Souad','Souad1','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Eléve','souad@gmail.com'),
	(5,'Damiri','Hind1','Damiri1','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Eléve','hind1@gmail.com'),
	(6,'Damiri','Hind2','Damiri2','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Eléve','hind2@gmail.com'),
	(7,'Damiri','Hind3','Damiri3','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Eléve','hind3@gmail.com'),
	(8,'Dodumentaliste','Doc','doc','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Documentaliste','documentaliste@school.com'),
	(9,'Enseignant','Prof','prof','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','Enseignant','enseignant@school.com');

			 
INSERT INTO `eleve` (`id_eleve`,`sexe`,`nom`,`prenom`, `email`,`date_naissance`,`lieu_naissance`,`adresse`,`ville`,`cp`,`tel`,`date_inscription`,`utilisateur_fk`) VALUES
	(1,'Mme','Damiri','Hind','hind@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05',3),
	(2,'Mme','Kaftani','Souad','souad@gmail.com','1998-02-25','Paris','120 Massira','Paris','75000','0644222322', '2020-10-05',4),
	(3,'Mme','Damiri','Hind1','hind1@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05',5),
	(4,'Mme','Damiri','Hind2','hind2@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05',6),
	(5,'Mme','Damiri','Hind3','hind3@gmail.com', '1997-11-21','Paris','154 Imlil','Paris','75000','0666222344', '2020-10-05',7);

INSERT INTO `classe`(`id_classe`,`nom_classe`,`annee_scolaire_classe`) VALUES
	(null,'6éme A','2020/2021'),
	(null,'5éme A','2020/2021'),
	(null,'4éme A','2020/2021'),
	(null,'3éme A','2020/2021'),
	(null,'6éme B','2021/2022'),
	(null,'5éme B','2021/2022'),
	(null,'4éme B','2021/2022'),
	(null,'3éme B','2021/2022');

INSERT INTO `scolarite`(`id_scolarite`,`annee_scolaire`,`eleve_fk`,`classe_fk`) VALUES
	(null,'2020/2021',1,1),
	(null,'2021/2022',2,6),
	(null,'2020/2021',3,1),
	(null,'2020/2021',4,1),
	(null,'2020/2021',5,1);

INSERT INTO `controle`(`id_controle`,`classe_fk`,`matiere`,`date_controle`) VALUES
	(null,1,'Mathématiques','2020-10-05'),
	(null,1,'Physiques','2020-10-05');

INSERT INTO `note_controle`(`id_note_controle`,`controle_fk`,`eleve_fk`,`absence`,`note`) VALUES
	(null,1,1,0,15),
	(null,1,3,0,5),
	(null,1,4,1,0),
	(null,1,5,0,10),
	(null,2,1,0,10),
	(null,2,3,0,15),
	(null,2,4,0,08),
	(null,2,5,0,13);
	
INSERT INTO `livre` (`isbn`, `titre_livre`, `type_livre`, `auteur_livre`, `etat`, `img_livre`) VALUES
(1, 'Naruto', 'Manga', 'Masashi Kishimito', 0, 'ouvrages/Naruto.jpg'),
(2, 'L''alchimiste', 'Roman', 'Coelho Paulo', 1, 'ouvrages/L''alchimiste.jpg'),
(3, 'Onze minutes', 'Roman', 'Coelho Paulo', 0, 'ouvrages/11min.jpg'),
(4, 'L''etranger', 'Roman', 'Camus Albert', 0, 'ouvrages/L''etranger.jpg'),
(5, 'Dragon Ball 21', 'Manga', 'Akira Toriyama', 0, 'ouvrages/Dragon_ball.jpg'),
(6, 'Un marocain a New York', 'Roman', 'Elalamy Youssouf Amine', 0, 'ouvrages/Un_Marocain_a_New_York.jpg'),
(7, 'One piece 57', 'Manga', 'Eichiro Oda', 0, 'ouvrages/One_piece.jpg'),
(8, 'Aleph', 'Roman', 'Coelho Paulo', 0, 'ouvrages/Aleph.jpg'),
(9, 'Bleach 13', 'Manga', 'Tite Kubo', 0, 'ouvrages/Bleach.jpg'),
(10, 'Astérix en corse', 'BD', 'Goscinny René', 1, 'ouvrages/Asterix.jpg'),
(11, 'Le petit prince', 'Roman', 'Antoine de Saint-Exupéry', 0, 'ouvrages/Le_petit_prince.jpg'),
(12, 'Premiers pas en CSS et HTML', 'Informatique', 'Draillard Francis', 0, 'ouvrages/Html_Css.jpg'),
(13, 'La dévouverte de l''Amérique', 'Histoire', 'Colomb Cristophe', 0, 'ouvrages/La_decouverte_de_l''amerique.jpg'),
(14, 'Chimie organique Les grands principes', 'Sciences appliquees', 'Simanek Eric', 0, 'ouvrages/Chimie_organique.jpg'),
(15, 'Le C en 20 heures', 'Informatique', 'Schang Daniel', 1, 'ouvrages/Le_C_en_20_heures.jpg'),
(16, 'Le beau livre de la physique', 'Sciences appliquees', 'Pickover Clifford', 0, 'ouvrages/Physique.jpg'),
(17, 'Apologie de Socrate', 'Philosophie', 'Platon Tom', 0, 'ouvrages/Apologie_de_socrate.jpg'),
(18, 'Durée et simultaneité', 'Philosophie', 'Bergson Henri', 0, 'ouvrages/Duree_et_simultaneite.jpg'),
(19, 'Anthropologie naïve Anthropologie savante', 'Sciences Sociales', 'Stoczkowski Wiktor', 0, 'ouvrages/Anthropologie_naive_savante.jpg'),
(20, 'L''économie POUR LES NULS', 'Economie', 'Musolino Michel', 0, 'ouvrages/L''economie_pour_les_nuls.jpg'),
(21, 'Réseaux informatiques Notions fondamentales', 'Informatique', 'Gomez Sylvain', 0, 'ouvrages/Reseaux_informatiques.jpg'),
(22, 'Anthropologie 1-Culture et personalité', 'Sciences sociales', 'Sapir Edward', 0, 'ouvrages/Anthropologie_culture_personnalite.jpg'),
(23, 'L''étourdi ou les contretemps', 'L_art', 'Moliere Andi ', 0, 'ouvrages/L''etourdi_ou_les_contretemps.jpg'),
(24, 'Débuter sous LINUX', 'Informatique', 'Cartron Daniel', 0, 'ouvrages/Linux.jpg'),
(25, 'Premiers pas en CSS3 & HTML5', 'Informatique', 'Draillard Francis', 0, 'ouvrages/Html5_Css3.jpg'),
(26, 'La première guerre mondiale', 'Histoire', 'Sheffield Gary', 0, 'ouvrages/La_1ere_guerre_mondiale.jpg'),
(27, 'Antigone', 'Roman', 'Anouilh Jean', 0, 'ouvrages/Antigone.jpg'),
(28, 'Ainsi parlait Zarathoustra', 'Philosophie', 'Nietzsche Friedrich', 0, 'ouvrages/Ainsi_parlait_zarathoustra.jpg'),
(29, 'Dom Juan', 'L_art', 'Classiques Moliere Andi', 0, 'ouvrages/Dom_juan.jpg'),
(30, 'Le dernier jour d''un condamné', 'Roman', 'Hugo Victor', 0, 'ouvrages/Le_dernier_jour_d''un_condamne.jpg'),
(31, 'Hunter X Hunter 17', 'Manga', 'Yoshihiro Togashi', 0, 'ouvrages/HunterxHunter.jpg'),
(32, 'Lucky Luke La légende de l''ouest', 'BD', 'Morris', 0, 'ouvrages/Lucky_Luke.jpg'),
(33, 'Le beau livre des maths', 'Sciences appliquees', 'Pickover Clifford', 0, 'ouvrages/Maths.jpg'),
(34, 'Aide-Mémoire JAVA', 'Informatique', 'Granet Vincent', 0, 'ouvrages/Aide_memoire_java.jpg'),
(35, 'Comprendre l''économie', 'Economie', 'Rocca Michel', 0, 'ouvrages/Comprendre_l''economie.jpg'),
(36, 'échec de la force', 'philosophie', 'GALLIMARD', 0, 'ouvrages/Echec_de_la_force.jpg'),
(37, 'Ainsi parlaient nos ancêtres', 'Sciences sociales', 'Alain Arbi', 0, 'ouvrages/Ainsi.jpg'),
(38, 'Tintin en Amérique', 'BD', 'Hergé', 0, 'ouvrages/Tintin.jpg'),
(39, 'Le livre du premier langage C', 'Informatique', 'Delannoy Claude', 0, 'ouvrages/Le_livre_du_1er_langage_C.jpg'),
(40, 'Titeuf 9', 'BD', 'Zep', 0, 'ouvrages/Titeuf.jpg');

INSERT INTO `emprunt` (`id_emprunt`, `eleve_fk`, `isbn_fk`, `date_emprunt`) VALUES
(NULL, 1, 10, '2020-08-22'),
(NULL, 2, 15, '2016-08-03'),
(NULL, 1, 2, '2016-08-03');