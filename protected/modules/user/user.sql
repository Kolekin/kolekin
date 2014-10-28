

SET default_with_oids = false;


CREATE TABLE tbl_user_users (
    id integer NOT NULL,
    username character varying(20) DEFAULT ''::character varying NOT NULL,
    password character varying(128) DEFAULT ''::character varying NOT NULL,
    email character varying(128) DEFAULT ''::character varying NOT NULL,
    activkey character varying(128) DEFAULT ''::character varying NOT NULL,
    superuser smallint DEFAULT 0 NOT NULL,
    status smallint DEFAULT 0 NOT NULL,
    create_at timestamp without time zone DEFAULT now() NOT NULL,
    lastvisit_at timestamp without time zone DEFAULT '1970-01-01 00:00:00'::timestamp without time zone NOT NULL
);




CREATE SEQUENCE tbl_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




ALTER SEQUENCE tbl_users_id_seq OWNED BY tbl_user_users.id;




ALTER TABLE ONLY tbl_user_users ALTER COLUMN id SET DEFAULT nextval('tbl_users_id_seq'::regclass);




INSERT INTO tbl_user_users VALUES (1, 'adminweb', '6495a0d4abb60e528822f10c5c93fd6d6516954b', 'info@bukapeta.com', 'a40f4d3dcd5cba9ca0a111bce4afcbf2', 1, 1, '2013-04-29 19:26:56.069058', '1970-01-01 00:00:00');




SELECT pg_catalog.setval('tbl_users_id_seq', 1, true);



ALTER TABLE ONLY tbl_user_users
    ADD CONSTRAINT tbl_users_pkey PRIMARY KEY (id);




CREATE UNIQUE INDEX user_email ON tbl_user_users USING btree (email);



CREATE UNIQUE INDEX user_username ON tbl_user_users USING btree (username);


CREATE TABLE tbl_user_profiles_fields (
    id integer NOT NULL,
    varname character varying(50) DEFAULT ''::character varying NOT NULL,
    title character varying(255) DEFAULT ''::character varying NOT NULL,
    field_type character varying(50) DEFAULT ''::character varying NOT NULL,
    field_size integer DEFAULT 0 NOT NULL,
    field_size_min integer DEFAULT 0 NOT NULL,
    required smallint DEFAULT 0 NOT NULL,
    match character varying(255) DEFAULT ''::character varying NOT NULL,
    range character varying(255) DEFAULT ''::character varying NOT NULL,
    error_message character varying(255) DEFAULT ''::character varying NOT NULL,
    other_validator text,
    "default" character varying(255) DEFAULT ''::character varying NOT NULL,
    widget character varying(255) DEFAULT ''::character varying NOT NULL,
    widgetparams text,
    "position" integer DEFAULT 0 NOT NULL,
    visible smallint DEFAULT 0 NOT NULL
);



CREATE SEQUENCE tbl_profiles_fields_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




ALTER SEQUENCE tbl_profiles_fields_id_seq OWNED BY tbl_user_profiles_fields.id;



ALTER TABLE ONLY tbl_user_profiles_fields ALTER COLUMN id SET DEFAULT nextval('tbl_profiles_fields_id_seq'::regclass);



SELECT pg_catalog.setval('tbl_profiles_fields_id_seq', 2, true);


INSERT INTO tbl_user_profiles_fields VALUES (1, 'first_name', 'First Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 1, 3);
INSERT INTO tbl_user_profiles_fields VALUES (2, 'last_name', 'Last Name', 'VARCHAR', 255, 4, 2, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 2, 3);



ALTER TABLE ONLY tbl_user_profiles_fields
    ADD CONSTRAINT tbl_profiles_fields_pkey PRIMARY KEY (id);



CREATE TABLE tbl_user_profiles (
    user_id integer NOT NULL,
    first_name character varying(255),
    last_name character varying(255)
);




CREATE SEQUENCE tbl_profiles_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE tbl_profiles_user_id_seq OWNED BY tbl_user_profiles.user_id;



ALTER TABLE ONLY tbl_user_profiles ALTER COLUMN user_id SET DEFAULT nextval('tbl_profiles_user_id_seq'::regclass);



SELECT pg_catalog.setval('tbl_profiles_user_id_seq', 1, true);



INSERT INTO tbl_user_profiles VALUES (1, '', '');



ALTER TABLE ONLY tbl_user_profiles
    ADD CONSTRAINT tbl_profiles_pkey PRIMARY KEY (user_id);



ALTER TABLE ONLY tbl_user_profiles
    ADD CONSTRAINT user_profile_id FOREIGN KEY (user_id) REFERENCES tbl_user_users(id) ON UPDATE RESTRICT ON DELETE CASCADE;

