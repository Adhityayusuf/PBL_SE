CREATE TABLE profile (
    id_profile SERIAL PRIMARY KEY,
    konten_id INT NOT NULL,
    konten VARCHAR(255) NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_profile_konten
        FOREIGN KEY (konten_id)
        REFERENCES konten(id_konten)
);