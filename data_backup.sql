--
-- PostgreSQL database dump
--

-- Dumped from database version 14.17 (Homebrew)
-- Dumped by pg_dump version 14.17 (Homebrew)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO admin;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO admin;

--
-- Name: calagen_ebook; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.calagen_ebook (
    id bigint NOT NULL,
    nama_lengkap character varying(255) NOT NULL,
    nama_panggilan character varying(255) NOT NULL,
    kota_domisili character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    nomor_whatsapp character varying(255) NOT NULL,
    jenis_kelamin character varying(255) NOT NULL,
    is_converted_to_user boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT calagen_ebook_jenis_kelamin_check CHECK (((jenis_kelamin)::text = ANY ((ARRAY['Laki-Laki'::character varying, 'Perempuan'::character varying])::text[])))
);


ALTER TABLE public.calagen_ebook OWNER TO admin;

--
-- Name: calagen_ebook_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.calagen_ebook_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.calagen_ebook_id_seq OWNER TO admin;

--
-- Name: calagen_ebook_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.calagen_ebook_id_seq OWNED BY public.calagen_ebook.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO admin;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO admin;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO admin;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO admin;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO admin;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO admin;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO admin;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO admin;

--
-- Name: sessions; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO admin;

--
-- Name: travel_packages; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.travel_packages (
    id bigint NOT NULL,
    travel_partner_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    destination character varying(255) NOT NULL,
    duration_days integer NOT NULL,
    price numeric(12,2) NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    max_participants integer NOT NULL,
    itinerary text,
    includes text,
    excludes text,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.travel_packages OWNER TO admin;

--
-- Name: travel_packages_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.travel_packages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.travel_packages_id_seq OWNER TO admin;

--
-- Name: travel_packages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.travel_packages_id_seq OWNED BY public.travel_packages.id;


--
-- Name: travel_partners; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.travel_partners (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    contact_person character varying(255),
    phone character varying(255),
    email character varying(255),
    address text,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.travel_partners OWNER TO admin;

--
-- Name: travel_partners_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.travel_partners_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.travel_partners_id_seq OWNER TO admin;

--
-- Name: travel_partners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.travel_partners_id_seq OWNED BY public.travel_partners.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255) DEFAULT 'user'::character varying NOT NULL
);


ALTER TABLE public.users OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: webinar_registrations; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.webinar_registrations (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    gender character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    whatsapp character varying(255) NOT NULL,
    city character varying(255) NOT NULL,
    source character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT webinar_registrations_gender_check CHECK (((gender)::text = ANY ((ARRAY['male'::character varying, 'female'::character varying])::text[])))
);


ALTER TABLE public.webinar_registrations OWNER TO admin;

--
-- Name: webinar_registrations_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.webinar_registrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.webinar_registrations_id_seq OWNER TO admin;

--
-- Name: webinar_registrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.webinar_registrations_id_seq OWNED BY public.webinar_registrations.id;


--
-- Name: calagen_ebook id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.calagen_ebook ALTER COLUMN id SET DEFAULT nextval('public.calagen_ebook_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: travel_packages id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.travel_packages ALTER COLUMN id SET DEFAULT nextval('public.travel_packages_id_seq'::regclass);


--
-- Name: travel_partners id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.travel_partners ALTER COLUMN id SET DEFAULT nextval('public.travel_partners_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: webinar_registrations id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.webinar_registrations ALTER COLUMN id SET DEFAULT nextval('public.webinar_registrations_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: calagen_ebook; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.calagen_ebook (id, nama_lengkap, nama_panggilan, kota_domisili, email, username, password, nomor_whatsapp, jenis_kelamin, is_converted_to_user, created_at, updated_at) FROM stdin;
1	Reza Aldiansyah	reza	Depok	raldiansyah339@gmail.com	raldiansyah	$2y$12$PLovwrNqmVeZEx1KFJF.fOQI/y2yp/5jU75mLn3P4TYnPKPZTt2va	+6281111123	Laki-Laki	t	2025-07-23 10:35:25	2025-07-23 10:35:25
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2024_01_17_000001_create_webinar_registrations_table	1
5	2025_01_20_000001_add_role_to_users_table	2
6	2025_01_20_000002_create_travel_partners_table	2
7	2025_01_20_000003_create_travel_packages_table	2
9	2025_07_23_093234_create_calagen_ebook_table	3
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
HStcxM1HHXiz4M3prVG9TT484AT0ZLX7AdQqW34u	2	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGh2NmxTNmlzMlFpVWhTQm1qS1plV1lXcHRqWjViYVYydUMzZmo2eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuL2Vib29rLWdyYXRpcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==	1753330741
\.


--
-- Data for Name: travel_packages; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.travel_packages (id, travel_partner_id, name, description, destination, duration_days, price, start_date, end_date, max_participants, itinerary, includes, excludes, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: travel_partners; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.travel_partners (id, name, description, contact_person, phone, email, address, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) FROM stdin;
1	Admin Web	adminweb@jalanharamain.com	\N	$2y$12$V.NIVoMQjSLk0xxtea0YZOkcKz9NqMYl8gv3hTkzWx0DDd.HKxKB6	\N	2025-07-23 04:25:14	2025-07-23 04:25:14	admin
2	Reza Aldiansyah	raldiansyah339@gmail.com	\N	$2y$12$LX/hgrvHRTcqHFQkSs8ycurp4ytkiVTWJjooEJhourwWcF7kY7.YC	\N	2025-07-23 10:35:25	2025-07-24 03:59:34	calon-agen
\.


--
-- Data for Name: webinar_registrations; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.webinar_registrations (id, name, gender, email, whatsapp, city, source, created_at, updated_at) FROM stdin;
\.


--
-- Name: calagen_ebook_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.calagen_ebook_id_seq', 1, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.migrations_id_seq', 9, true);


--
-- Name: travel_packages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.travel_packages_id_seq', 1, false);


--
-- Name: travel_partners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.travel_partners_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: webinar_registrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.webinar_registrations_id_seq', 1, false);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: calagen_ebook calagen_ebook_email_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.calagen_ebook
    ADD CONSTRAINT calagen_ebook_email_unique UNIQUE (email);


--
-- Name: calagen_ebook calagen_ebook_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.calagen_ebook
    ADD CONSTRAINT calagen_ebook_pkey PRIMARY KEY (id);


--
-- Name: calagen_ebook calagen_ebook_username_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.calagen_ebook
    ADD CONSTRAINT calagen_ebook_username_unique UNIQUE (username);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: travel_packages travel_packages_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.travel_packages
    ADD CONSTRAINT travel_packages_pkey PRIMARY KEY (id);


--
-- Name: travel_partners travel_partners_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.travel_partners
    ADD CONSTRAINT travel_partners_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: webinar_registrations webinar_registrations_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.webinar_registrations
    ADD CONSTRAINT webinar_registrations_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: travel_packages travel_packages_travel_partner_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.travel_packages
    ADD CONSTRAINT travel_packages_travel_partner_id_foreign FOREIGN KEY (travel_partner_id) REFERENCES public.travel_partners(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

