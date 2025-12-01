CREATE TYPE status_mhs AS ENUM ('menunggu', 'setuju');

CREATE TABLE mahasiswa (
    id_mahasiswa SERIAL PRIMARY KEY,
    nim VARCHAR(25) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi_id int NOT NULL,
    angkatan VARCHAR(150) NOT NULL,
    status status_mhs NOT NULL DEFAULT 'menunggu',

    CONSTRAINT fk_prodi
        FOREIGN KEY (prodi_id)
        REFERENCES prodi(id_prodi)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
)

