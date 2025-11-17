CREATE TABLE mahasiswa (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    nim VARCHAR(50) UNIQUE NOT NULL,
    prodi VARCHAR(30) NOT NULL,
    angkatan SMALLINT NOT NULL,
    status VARCHAR(10) NOT NULL DEFAULT 'menunggu'
        CHECK (status IN ('setuju', 'menunggu'))
)

