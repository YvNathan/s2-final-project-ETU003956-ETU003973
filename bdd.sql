/* Table */
CREATE
OR REPLACE TABLE s2fp_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    date_naissance DATE,
    genre CHAR(1),
    email VARCHAR(50),
    ville VARCHAR(50),
    mdp VARCHAR(50),
    image_profil VARCHAR(100)
);

CREATE
OR REPLACE TABLE s2fp_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);

CREATE
OR REPLACE TABLE s2fp_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(50),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES s2fp_categorie_objet (id_categorie),
    FOREIGN KEY (id_membre) REFERENCES s2fp_membre (id_membre)
);

CREATE
OR REPLACE TABLE s2fp_image_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(100),
    FOREIGN KEY (id_objet) REFERENCES s2fp_objet (id_objet)
);

CREATE
OR REPLACE TABLE s2fp_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES s2fp_objet (id_objet),
    FOREIGN KEY (id_membre) REFERENCES s2fp_membre (id_membre)
);

/* Données */
INSERT INTO s2fp_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Toky Rakoto', '1990-05-12', 'M', 'toky.rakoto@gmail.com', 'Antananarivo', 'mdp1', 'toky.jpg'),
('Fara Rasoanaivo', '1988-07-23', 'F', 'fara.rasoanaivo@gmail.com', 'Toamasina', 'mdp2', 'fara.jpg'),
('Hery Randrianarisoa', '1992-11-04', 'M', 'hery.randria@gmail.com', 'Fianarantsoa', 'mdp3', 'hery.jpg'),
('Soa Andrianantenaina', '1995-02-15', 'F', 'soa.andriana@gmail.com', 'Mahajanga', 'mdp4', 'soa.jpg');

INSERT INTO s2fp_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Objets de Toky
INSERT INTO s2fp_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Perceuse', 2, 1), ('Clé à molette', 3, 1), ('Mixeur', 4, 1),
('Rouge à lèvres', 1, 1), ('Scie sauteuse', 2, 1), ('Tournevis', 3, 1), ('Cafetière', 4, 1),
('Mascara', 1, 1), ('Marteau', 2, 1);

-- Objets de Fara
INSERT INTO s2fp_objet (nom_objet, id_categorie, id_membre) VALUES
('Tondeuse', 1, 2), ('Ponceuse', 2, 2), ('Cric hydraulique', 3, 2), ('Four', 4, 2),
('Lime à ongles', 1, 2), ('Tournevis électrique', 2, 2), ('Pompe à huile', 3, 2), ('Blender', 4, 2),
('Fer à lisser', 1, 2), ('Perceuse à colonne', 2, 2);

-- Objets de Hery
INSERT INTO s2fp_objet (nom_objet, id_categorie, id_membre) VALUES
('Crème visage', 1, 3), ('Établi', 2, 3), ('Compresseur', 3, 3), ('Micro-ondes', 4, 3),
('Vernis', 1, 3), ('Scie circulaire', 2, 3), ('Pistolet à graisse', 3, 3), ('Grille-pain', 4, 3),
('Fard à paupières', 1, 3), ('Tournevis plat', 2, 3);

-- Objets de Soa
INSERT INTO s2fp_objet (nom_objet, id_categorie, id_membre) VALUES
('Baume à lèvres', 1, 4), ('Visseuse', 2, 4), ('Manomètre', 3, 4), ('Robot pâtissier', 4, 4),
('Gel coiffant', 1, 4), ('Perforateur', 2, 4), ('Dynamomètre', 3, 4), ('Friteuse', 4, 4),
('Poudre libre', 1, 4), ('Ponceuse à bande', 2, 4);

INSERT INTO s2fp_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(3, 2, '2025-06-01', '2025-06-15'),
(7, 3, '2025-06-10', '2025-06-20'),
(14, 1, '2025-06-12', '2025-06-30'),
(22, 4, '2025-06-14', '2025-06-28'),
(25, 2, '2025-06-18', '2025-07-02'),
(31, 1, '2025-06-20', '2025-07-05'),
(35, 3, '2025-06-25', '2025-07-10'),
(27, 4, '2025-06-28', '2025-07-12'),
(19, 1, '2025-07-01', '2025-07-14'),
(38, 2, '2025-07-04', '2025-07-18');

CREATE OR REPLACE VIEW v_s2fp_liste_objets AS
SELECT o.id_objet, o.nom_objet, o.id_categorie, c.nom_categorie
FROM s2fp_objet as o
JOIN s2fp_categorie_objet as c ON o.id_categorie = c.id_categorie;

CREATE OR REPLACE VIEW v_s2fp_liste_emprunts as
SELECT o.*, e.id_emprunt, e.date_emprunt, e.date_retour, m.id_membre, m.nom, m.email, m.image_profil
FROM s2fp_emprunt as e
JOIN v_s2fp_liste_objets_img as o ON e.id_objet = o.id_objet
JOIN s2fp_membre as m ON e.id_membre = m.id_membre;

CREATE OR REPLACE VIEW v_s2fp_objet_premier_img AS
SELECT 
    id_objet,
    MIN(id_image) AS id_image
FROM s2fp_image_objet
GROUP BY id_objet;

CREATE OR REPLACE VIEW v_s2fp_liste_objets_img AS
SELECT v.*, coalesce(ipm.id_image, 0) as id_image, coalesce(im.nom_image, 'default.png') as nom_image
FROM v_s2fp_liste_objets v
LEFT JOIN v_s2fp_objet_premier_img ipm ON v.id_objet = ipm.id_objet
LEFT JOIN s2fp_image_objet im ON ipm.id_image = im.id_image;
