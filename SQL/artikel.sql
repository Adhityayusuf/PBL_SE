CREATE TABLE artikel (
    id_artikel SERIAL PRIMARY KEY,
    kategori_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    isi_artikel TEXT NOT NULL,
    penulis VARCHAR(50) NOT NULL DEFAULT 'admin',
    tanggal_publikasi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT fk_kategori
        FOREIGN KEY (kategori_id)
        REFERENCES kategori(id_kategori)
);