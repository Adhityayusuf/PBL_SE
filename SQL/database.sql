--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-12-02 12:14:34

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 863 (class 1247 OID 106615)
-- Name: status_mahasiswa; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.status_mahasiswa AS ENUM (
    'menunggu',
    'disetujui'
);


ALTER TYPE public.status_mahasiswa OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 224 (class 1259 OID 106647)
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(50) NOT NULL,
    email character varying(100) NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 106646)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_id_admin_seq OWNER TO postgres;

--
-- TOC entry 5003 (class 0 OID 0)
-- Dependencies: 223
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 230 (class 1259 OID 106686)
-- Name: artikel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.artikel (
    id_artikel integer NOT NULL,
    kategori_id integer NOT NULL,
    title text NOT NULL,
    subtitle text,
    isi_konten text NOT NULL,
    penulis character varying(50) DEFAULT 'admin'::character varying NOT NULL,
    tanggal_publikasi timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    image_url character varying(255)
);


ALTER TABLE public.artikel OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 106685)
-- Name: artikel_id_artikel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.artikel_id_artikel_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.artikel_id_artikel_seq OWNER TO postgres;

--
-- TOC entry 5004 (class 0 OID 0)
-- Dependencies: 229
-- Name: artikel_id_artikel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.artikel_id_artikel_seq OWNED BY public.artikel.id_artikel;


--
-- TOC entry 218 (class 1259 OID 106620)
-- Name: kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori (
    id_kategori integer NOT NULL,
    nama character varying(100) NOT NULL
);


ALTER TABLE public.kategori OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 106619)
-- Name: kategori_id_kategori_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kategori_id_kategori_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kategori_id_kategori_seq OWNER TO postgres;

--
-- TOC entry 5005 (class 0 OID 0)
-- Dependencies: 217
-- Name: kategori_id_kategori_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_id_kategori_seq OWNED BY public.kategori.id_kategori;


--
-- TOC entry 228 (class 1259 OID 106671)
-- Name: mahasiswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa (
    id_mahasiswa integer NOT NULL,
    nim character varying(25) NOT NULL,
    nama character varying(100) NOT NULL,
    prodi_id integer NOT NULL,
    angkatan character varying(150) NOT NULL,
    status public.status_mahasiswa DEFAULT 'menunggu'::public.status_mahasiswa
);

ALTER TABLE public.mahasiswa
ADD COLUMN minat character varying(150) NOT NULL;

ALTER TABLE public.mahasiswa OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 106670)
-- Name: mahasiswa_id_mahasiswa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mahasiswa_id_mahasiswa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mahasiswa_id_mahasiswa_seq OWNER TO postgres;

--
-- TOC entry 5006 (class 0 OID 0)
-- Dependencies: 227
-- Name: mahasiswa_id_mahasiswa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_id_mahasiswa_seq OWNED BY public.mahasiswa.id_mahasiswa;


--
-- TOC entry 226 (class 1259 OID 106658)
-- Name: personil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personil (
    id_personil integer NOT NULL,
    nip character varying(25) NOT NULL,
    nama character varying(100) NOT NULL,
    email character varying(50),
    jabatan character varying(150) NOT NULL,
    ruang_dosen character varying(50),
    content_social jsonb,
    photo_url character varying(100)
);


ALTER TABLE public.personil OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 106657)
-- Name: personil_id_personil_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personil_id_personil_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personil_id_personil_seq OWNER TO postgres;

--
-- TOC entry 5007 (class 0 OID 0)
-- Dependencies: 225
-- Name: personil_id_personil_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personil_id_personil_seq OWNED BY public.personil.id_personil;


--
-- TOC entry 234 (class 1259 OID 106717)
-- Name: prestasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prestasi (
    id_prestasi integer NOT NULL,
    prestasi character varying(100) NOT NULL,
    image_url character varying(255)
);


ALTER TABLE public.prestasi OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 106716)
-- Name: prestasi_id_prestasi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prestasi_id_prestasi_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prestasi_id_prestasi_seq OWNER TO postgres;

--
-- TOC entry 5008 (class 0 OID 0)
-- Dependencies: 233
-- Name: prestasi_id_prestasi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prestasi_id_prestasi_seq OWNED BY public.prestasi.id_prestasi;


--
-- TOC entry 220 (class 1259 OID 106629)
-- Name: prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prodi (
    id_prodi integer NOT NULL,
    nama character varying(100) NOT NULL
);


ALTER TABLE public.prodi OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 106628)
-- Name: prodi_id_prodi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prodi_id_prodi_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prodi_id_prodi_seq OWNER TO postgres;

--
-- TOC entry 5009 (class 0 OID 0)
-- Dependencies: 219
-- Name: prodi_id_prodi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prodi_id_prodi_seq OWNED BY public.prodi.id_prodi;


--
-- TOC entry 232 (class 1259 OID 106702)
-- Name: profile; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profile (
    id_profile integer NOT NULL,
    tipe_konten integer NOT NULL,
    isi_konten text NOT NULL,
    last_updated timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    image_url character varying(255)
);


ALTER TABLE public.profile OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 106701)
-- Name: profile_id_profile_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.profile_id_profile_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.profile_id_profile_seq OWNER TO postgres;

--
-- TOC entry 5010 (class 0 OID 0)
-- Dependencies: 231
-- Name: profile_id_profile_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.profile_id_profile_seq OWNED BY public.profile.id_profile;


--
-- TOC entry 222 (class 1259 OID 106638)
-- Name: tipe_konten; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipe_konten (
    id_tipe_konten integer NOT NULL,
    nama_tipe_konten character varying(50) NOT NULL
);


ALTER TABLE public.tipe_konten OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 106637)
-- Name: tipe_konten_id_tipe_konten_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipe_konten_id_tipe_konten_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipe_konten_id_tipe_konten_seq OWNER TO postgres;

--
-- TOC entry 5011 (class 0 OID 0)
-- Dependencies: 221
-- Name: tipe_konten_id_tipe_konten_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipe_konten_id_tipe_konten_seq OWNED BY public.tipe_konten.id_tipe_konten;


--
-- TOC entry 4788 (class 2604 OID 106650)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4792 (class 2604 OID 106689)
-- Name: artikel id_artikel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artikel ALTER COLUMN id_artikel SET DEFAULT nextval('public.artikel_id_artikel_seq'::regclass);


--
-- TOC entry 4785 (class 2604 OID 106623)
-- Name: kategori id_kategori; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori ALTER COLUMN id_kategori SET DEFAULT nextval('public.kategori_id_kategori_seq'::regclass);


--
-- TOC entry 4790 (class 2604 OID 106674)
-- Name: mahasiswa id_mahasiswa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa ALTER COLUMN id_mahasiswa SET DEFAULT nextval('public.mahasiswa_id_mahasiswa_seq'::regclass);


--
-- TOC entry 4789 (class 2604 OID 106661)
-- Name: personil id_personil; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil ALTER COLUMN id_personil SET DEFAULT nextval('public.personil_id_personil_seq'::regclass);


--
-- TOC entry 4797 (class 2604 OID 106720)
-- Name: prestasi id_prestasi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestasi ALTER COLUMN id_prestasi SET DEFAULT nextval('public.prestasi_id_prestasi_seq'::regclass);


--
-- TOC entry 4786 (class 2604 OID 106632)
-- Name: prodi id_prodi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi ALTER COLUMN id_prodi SET DEFAULT nextval('public.prodi_id_prodi_seq'::regclass);


--
-- TOC entry 4795 (class 2604 OID 106705)
-- Name: profile id_profile; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile ALTER COLUMN id_profile SET DEFAULT nextval('public.profile_id_profile_seq'::regclass);


--
-- TOC entry 4787 (class 2604 OID 106641)
-- Name: tipe_konten id_tipe_konten; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipe_konten ALTER COLUMN id_tipe_konten SET DEFAULT nextval('public.tipe_konten_id_tipe_konten_seq'::regclass);


--
-- TOC entry 4987 (class 0 OID 106647)
-- Dependencies: 224
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (id_admin, username, password, email) FROM stdin;
1	superadmin	hashedpass1	admin@labse.com
2	editor_konten	hashedpass2	editor@labse.com
3	kontak_admin	hashedpass3	kontak@labse.com
4	webmaster	hashedpass4	web@labse.com
5	user_testing	hashedpass5	test@labse.com
\.


--
-- TOC entry 4993 (class 0 OID 106686)
-- Dependencies: 230
-- Data for Name: artikel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.artikel (id_artikel, kategori_id, title, subtitle, isi_konten, penulis, tanggal_publikasi, image_url) FROM stdin;
1	1	Pendaftaran Asisten Lab Dibuka	Batas akhir pendaftaran: 30 Desember.	Detail persyaratan dan jadwal seleksi telah diumumkan di portal.	superadmin	2025-12-02 06:33:03.038644+07	\N
2	2	Lab SE Raih Penghargaan Inovasi	Aplikasi E-Surat Lab mendapatkan apresiasi dari rektorat.	Berita mengenai perolehan penghargaan ini dapat dilihat di majalah kampus.	editor_konten	2025-12-02 06:33:03.038644+07	\N
3	3	Publikasi Jurnal Q2 Bidang DevOps	Penelitian terbaru Bapak Joko Susilo telah diterima di jurnal internasional.	Artikel membahas implementasi CI/CD pada skala Enterprise.	Joko Susilo	2025-12-02 06:33:03.038644+07	\N
4	4	Workshop UI/UX Mobile App 2026	Pelatihan desain antarmuka mobile menggunakan Figma.	Acara akan dilaksanakan pada 15 Januari 2026.	Lina Putri	2025-12-02 06:33:03.038644+07	\N
5	5	Tips Cepat Kuasai PostgreSQL	Panduan singkat mengenai sintaks dan optimasi kueri PostgreSQL.	Pelajari cara menggunakan fitur JSONB dan Array dengan efektif.	Rudi Herman	2025-12-02 06:33:03.038644+07	\N
\.


--
-- TOC entry 4981 (class 0 OID 106620)
-- Dependencies: 218
-- Data for Name: kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kategori (id_kategori, nama) FROM stdin;
1	Pengumuman
2	Berita Akademik
3	Riset
4	Event Internal
5	Tips & Trik Coding
\.


--
-- TOC entry 4991 (class 0 OID 106671)
-- Dependencies: 228
-- Data for Name: mahasiswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa (id_mahasiswa, nim, nama, prodi_id, angkatan, status, minat) FROM stdin;
1	2341720001	Rina Wijaya 1   2023    disetujui   Web
2	2241720002	Andi Pratama	2	2022	menunggu    Mobile
3	2441720003	Dewi Kartika	3	2024	disetujui   QA
4	2341720004	Fajri Rahman	4	2023	menunggu    DevOps
5	2141720005	Gita Cahyani	5	2021	disetujui   Web
\.


--
-- TOC entry 4989 (class 0 OID 106658)
-- Dependencies: 226
-- Data for Name: personil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personil (id_personil, nip, nama, email, jabatan, ruang_dosen, content_social, photo_url) FROM stdin;
5	198811302012024005	Joko Susilo, Ph.D.	joko.s@uni.ac.id	Penguji Software	D-205	{"github": "joko_sus"}	personil5.jpg
4	199507252019013004	Lina Putri, M.Cs.	lina.p@uni.ac.id	Asisten Lab	D-204	{"instagram": "lina.put"}	personil4.jpg
3	198505152010031003	Rudi Herman, S.Kom., M.TI.	rudi.h@uni.ac.id	Dosen Riset	D-203	{"twitter": "@rudi_ti"}	personil3.jpg
2	199002022015012002	Siti Aisyah, S.T., M.Eng.	siti.a@uni.ac.id	Dosen Pembimbing	D-202	{"linkedin": "siti_ai"}	personil2.jpg
1	198001012005011001	Dr. Budi Santoso, M.Kom.	budi.s@uni.ac.id	Kepala Lab SE	D-201	{"github": "budidev", "linkedin": "budi_s"}	personil1.jpg
\.


--
-- TOC entry 4997 (class 0 OID 106717)
-- Dependencies: 234
-- Data for Name: prestasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prestasi (id_prestasi, prestasi, image_url) FROM stdin;
1	Juara 1 Hackathon Nasional	acv1.jpg
2	Publikasi Jurnal Q2	acv2.jpg
3	Dosen Terbaik 2025 (Dr. Budi Santoso)	acv3.jpg
\.


--
-- TOC entry 4983 (class 0 OID 106629)
-- Dependencies: 220
-- Data for Name: prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prodi (id_prodi, nama) FROM stdin;
1	Teknik Informatika
2	Sistem Informasi
3	Manajemen Data
4	Rekayasa Perangkat Lunak
5	Bisnis Digital
\.


--
-- TOC entry 4995 (class 0 OID 106702)
-- Dependencies: 232
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profile (id_profile, tipe_konten, isi_konten, last_updated, image_url) FROM stdin;
2	2	Visi: Menjadi pusat unggulan riset dan pengembangan RPL di tingkat nasional.	2025-12-02 06:33:03.038644+07	assets/visi.jpg
3	3	2024: Penguatan dasar pemrograman dan SDLC.	2025-12-02 06:33:03.038644+07	\N
4	4	Web Development	2025-12-02 06:33:03.038644+07	bi-code-slash
5	5	Tersedia 30 unit komputer spek tinggi untuk praktikum pemrograman lanjut.	2025-12-02 06:33:03.038644+07	assets/fasilitas/komputer.jpg
1	1	Lab Software Engineering berfokus pada pengembangan sistem berbasis rekayasa perangkat lunak, mulai dari analisis kebutuhan, desain, implementasi, hingga pengujian.	2025-12-02 06:33:03.038644+07	maskot.png
6   2   1. Menyelenggarakan pendidikan berkualitas di bidang RPL.\n2. Mengembangkan penelitian terapan yang inovatif.\n3. Membangun kerjasama dengan industri teknologi.    2025-12-03 19:19:05.818548+07   \N
\.


--
-- TOC entry 4985 (class 0 OID 106638)
-- Dependencies: 222
-- Data for Name: tipe_konten; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipe_konten (id_tipe_konten, nama_tipe_konten) FROM stdin;
1	Tentang Lab
2	Visi Misi
3	Roadmap
4	Focus dan Scope
5	Fasilitas Lab
\.


--
-- TOC entry 5012 (class 0 OID 0)
-- Dependencies: 223
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 5, true);


--
-- TOC entry 5013 (class 0 OID 0)
-- Dependencies: 229
-- Name: artikel_id_artikel_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.artikel_id_artikel_seq', 5, true);


--
-- TOC entry 5014 (class 0 OID 0)
-- Dependencies: 217
-- Name: kategori_id_kategori_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kategori_id_kategori_seq', 5, true);


--
-- TOC entry 5015 (class 0 OID 0)
-- Dependencies: 227
-- Name: mahasiswa_id_mahasiswa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_id_mahasiswa_seq', 5, true);


--
-- TOC entry 5016 (class 0 OID 0)
-- Dependencies: 225
-- Name: personil_id_personil_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personil_id_personil_seq', 5, true);


--
-- TOC entry 5017 (class 0 OID 0)
-- Dependencies: 233
-- Name: prestasi_id_prestasi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prestasi_id_prestasi_seq', 3, true);


--
-- TOC entry 5018 (class 0 OID 0)
-- Dependencies: 219
-- Name: prodi_id_prodi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prodi_id_prodi_seq', 5, true);


--
-- TOC entry 5019 (class 0 OID 0)
-- Dependencies: 231
-- Name: profile_id_profile_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.profile_id_profile_seq', 5, true);


--
-- TOC entry 5020 (class 0 OID 0)
-- Dependencies: 221
-- Name: tipe_konten_id_tipe_konten_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipe_konten_id_tipe_konten_seq', 5, true);


--
-- TOC entry 4811 (class 2606 OID 106656)
-- Name: admin admin_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_email_key UNIQUE (email);


--
-- TOC entry 4813 (class 2606 OID 106652)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4815 (class 2606 OID 106654)
-- Name: admin admin_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_username_key UNIQUE (username);


--
-- TOC entry 4827 (class 2606 OID 106695)
-- Name: artikel artikel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artikel
    ADD CONSTRAINT artikel_pkey PRIMARY KEY (id_artikel);


--
-- TOC entry 4799 (class 2606 OID 106627)
-- Name: kategori kategori_nama_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_nama_key UNIQUE (nama);


--
-- TOC entry 4801 (class 2606 OID 106625)
-- Name: kategori kategori_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_pkey PRIMARY KEY (id_kategori);


--
-- TOC entry 4823 (class 2606 OID 106679)
-- Name: mahasiswa mahasiswa_nim_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_nim_key UNIQUE (nim);


--
-- TOC entry 4825 (class 2606 OID 106677)
-- Name: mahasiswa mahasiswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_pkey PRIMARY KEY (id_mahasiswa);


--
-- TOC entry 4817 (class 2606 OID 106669)
-- Name: personil personil_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil
    ADD CONSTRAINT personil_email_key UNIQUE (email);


--
-- TOC entry 4819 (class 2606 OID 106667)
-- Name: personil personil_nip_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil
    ADD CONSTRAINT personil_nip_key UNIQUE (nip);


--
-- TOC entry 4821 (class 2606 OID 106665)
-- Name: personil personil_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personil
    ADD CONSTRAINT personil_pkey PRIMARY KEY (id_personil);


--
-- TOC entry 4831 (class 2606 OID 106722)
-- Name: prestasi prestasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestasi
    ADD CONSTRAINT prestasi_pkey PRIMARY KEY (id_prestasi);


--
-- TOC entry 4803 (class 2606 OID 106636)
-- Name: prodi prodi_nama_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT prodi_nama_key UNIQUE (nama);


--
-- TOC entry 4805 (class 2606 OID 106634)
-- Name: prodi prodi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT prodi_pkey PRIMARY KEY (id_prodi);


--
-- TOC entry 4829 (class 2606 OID 106710)
-- Name: profile profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (id_profile);


--
-- TOC entry 4807 (class 2606 OID 106645)
-- Name: tipe_konten tipe_konten_nama_tipe_konten_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipe_konten
    ADD CONSTRAINT tipe_konten_nama_tipe_konten_key UNIQUE (nama_tipe_konten);


--
-- TOC entry 4809 (class 2606 OID 106643)
-- Name: tipe_konten tipe_konten_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipe_konten
    ADD CONSTRAINT tipe_konten_pkey PRIMARY KEY (id_tipe_konten);


--
-- TOC entry 4833 (class 2606 OID 106696)
-- Name: artikel artikel_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artikel
    ADD CONSTRAINT artikel_kategori_id_fkey FOREIGN KEY (kategori_id) REFERENCES public.kategori(id_kategori);


--
-- TOC entry 4832 (class 2606 OID 106680)
-- Name: mahasiswa mahasiswa_prodi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_prodi_id_fkey FOREIGN KEY (prodi_id) REFERENCES public.prodi(id_prodi);


--
-- TOC entry 4834 (class 2606 OID 106711)
-- Name: profile profile_tipe_konten_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_tipe_konten_fkey FOREIGN KEY (tipe_konten) REFERENCES public.tipe_konten(id_tipe_konten);


-- Completed on 2025-12-02 12:14:35

--
-- PostgreSQL database dump complete
--

