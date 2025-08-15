CREATE DATABASE IF NOT EXISTS istria;
USE istria;

CREATE TABLE cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    attractions TEXT,
    image VARCHAR(255)
);

INSERT INTO cities (name, description, attractions, image) VALUES
('Rovinj', 'Šarmantni obalni grad sa starom gradskom jezgrom.', 'Posjet starom gradu, vožnja brodom do Crvenog otoka.', 'rovinj.jpg'),
('Pula Arena', 'Rimski amfiteatar iz 1. stoljeća.', 'Razgled Arene, šetnja centrom Pule.', 'pula.jpg'),
('Brijuni', 'Nacionalni park s otocima i poviješću.', 'Obilazak otoka, posjet safari parku.', 'brijuni.jpg'),
('Motovun', 'Srednjovjekovni gradić na brežuljku.', 'Šetnja starim ulicama, Motovun film festival.', 'motovun.jpg'),
('Poreč', 'Grad s UNESCO bazilikom.', 'Posjet Eufrazijevoj bazilici.', 'porec.jpg'),
('Rt Kamenjak', 'Prirodni park s uvalama i stijenama.', 'Kupanje, ronjenje i šetnja stazama.', 'kamenjak.jpg');

CREATE TABLE plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    locations TEXT NOT NULL,
    days INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
