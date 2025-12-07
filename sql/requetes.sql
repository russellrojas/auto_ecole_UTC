-- Eleves
CREATE TABLE eleves (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    dateNaiss DATE NOT NULL,
    dateInscription DATE DEFAULT CURRENT_DATE
);

-- Themes
CREATE TABLE themes (
    idtheme SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    descriptif TEXT,
    supprime BOOLEAN DEFAULT FALSE
);

-- Seances
CREATE TABLE seances (
    idseance SERIAL PRIMARY KEY,
    idtheme INT REFERENCES themes(idtheme),
    DateSeance DATE NOT NULL,
    effmax INT NOT NULL
);

-- Inscription
CREATE TABLE inscription (
    id SERIAL PRIMARY KEY,
    idseance INT REFERENCES seances(idseance),
    ideleve INT REFERENCES eleves(id),
    note INT DEFAULT -1 CHECK (note >= -1 AND note <= 40),
    UNIQUE (idseance, ideleve)
);

-- Eleves
INSERT INTO eleves (nom, prenom, dateNaiss, dateInscription) VALUES
('Dupont', 'Marie', '2005-03-12', '2023-09-01'),
('Martin', 'Paul', '2004-07-25', '2023-09-02'),
('Lefevre', 'Claire', '2006-11-05', '2023-09-03'),
('Moreau', 'Lucas', '2005-01-17', '2023-09-04'),
('Garcia', 'Sophie', '2004-06-30', '2023-09-05'),
('Petit', 'Antoine', '2005-09-21', '2023-09-06'),
('Roux', 'Emma', '2006-04-10', '2023-09-07'),
('Blanc', 'Louis', '2005-12-02', '2023-09-08'),
('Fournier', 'Chloé', '2006-08-15', '2023-09-09');

-- Themes
INSERT INTO themes (nom, descriptif, supprime) VALUES
('Code de la route', 'Apprentissage des règles de conduite', FALSE),
('Sécurité routière', 'Comportement et prévention des accidents', FALSE),
('Mécanique de base', 'Révision des parties principales d''une voiture', FALSE),
('Conduite en ville', 'Techniques pour circuler en ville', FALSE),
('Conduite sur autoroute', 'Pratique sur routes rapides', FALSE),
('Stationnement', 'Techniques de stationnement', FALSE),
('Manœuvres', 'Apprentissage des manœuvres spécifiques', FALSE),
('Premiers secours', 'Savoir réagir en cas d''accident', FALSE),
('Éco-conduite', 'Techniques pour économiser le carburant', FALSE);

-- Seances
INSERT INTO seances (idtheme, DateSeance, effmax) VALUES
(1, '2025-12-10', 15),
(2, '2025-12-12', 12),
(3, '2025-12-15', 10),
(4, '2025-12-18', 20),
(5, '2025-12-20', 18),
(6, '2025-12-22', 8),
(7, '2025-12-25', 16),
(8, '2025-12-28', 12),
(9, '2025-12-30', 14);

-- Inscription
INSERT INTO inscription (idseance, ideleve, note) VALUES
(1, 1, -1),
(1, 2, -1),
(2, 3, -1),
(2, 4, -1),
(3, 5, -1),
(3, 6, -1),
(4, 7, -1),
(4, 8, -1),
(5, 9, -1),
(6, 1, -1),
(7, 2, -1),
(8, 3, -1),
(9, 4, -1);

-- Eleves (+ de données)
INSERT INTO eleves (nom, prenom, dateNaiss, dateInscription) VALUES
('Dubois', 'Claire', '2005-05-14', '2023-09-10'),
('Morel', 'Julien', '2004-08-19', '2023-09-11'),
('Garnier', 'Léa', '2006-02-22', '2023-09-12'),
('Rousseau', 'Marc', '2005-11-30', '2023-09-13'),
('Fabre', 'Anaïs', '2006-06-07', '2023-09-14'),
('Chevalier', 'Thomas', '2005-04-25', '2023-09-15'),
('Henry', 'Camille', '2004-12-01', '2023-09-16'),
('Noël', 'Lucas', '2005-07-18', '2023-09-17');

-- Themes (+ de données)
INSERT INTO themes (nom, descriptif, supprime) VALUES
('Conduite de nuit', 'Techniques pour la conduite après le coucher du soleil', FALSE),
('Conduite par temps de pluie', 'Sécurité et techniques sur routes mouillées', FALSE),
('Règles de priorité', 'Étude des règles de priorité et panneaux', FALSE);


INSERT INTO seances (idtheme, DateSeance, effmax) VALUES
(22, '2025-12-05', 12),  -- Conduite de nuit
(23, '2025-12-07', 14),  -- Conduite par temps de pluie
(24, '2025-12-09', 15),  -- Règles de priorité
(22, '2025-12-11', 10),
(23, '2025-12-13', 16);
