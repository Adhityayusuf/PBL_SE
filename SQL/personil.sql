CREATE TABLE personil (
    nip INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(50) UNIQUE,
    jabatan VARCHAR(150) NOT NULL,
    ruang_id INT NOT NULL,
    linkedin VARCHAR(250),
    github VARCHAR(250),
    photo_url VARCHAR(250)
);

ALTER TABLE personil
ADD CONSTRAINT fk_personil_ruang
FOREIGN KEY (ruang_id)
REFERENCES ruang_dosen(id_ruang);