CREATE TABLE about (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    data JSONB NOT NULL,  -- menyimpan isi visi, misi, tentang lab
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO about (title, data)
VALUES (
    'Profil Lab SE',
    '{
        "visi": "Menjadi laboratorium unggulan dalam bidang rekayasa perangkat lunak.",
        "misi": [
            "Meningkatkan kualitas riset dan pengembangan perangkat lunak.",
            "Mendukung kegiatan pembelajaran berbasis proyek.",
            "Menjalin kerja sama dengan industri IT."
        ],
        "tentang": "Laboratorium Sistem dan Rekayasa Perangkat Lunak (Lab SE) merupakan wadah bagi mahasiswa untuk mengembangkan kemampuan dalam bidang software engineering."
    }'
);


SELECT * FROM about
