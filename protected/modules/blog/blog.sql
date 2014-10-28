CREATE TABLE tbl_blog_lookup
(
	id INTEGER NOT NULL,
	name character varying(128) NOT NULL,
	code INTEGER NOT NULL,
	type character varying(128) NOT NULL,
	position INTEGER NOT NULL
) ;

CREATE SEQUENCE tbl_blog_lookup_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

-- ALTER TABLE public.tbl_blog_lookup_id_seq OWNER TO iyo;
ALTER SEQUENCE tbl_blog_lookup_id_seq OWNED BY tbl_blog_lookup.id;
ALTER TABLE ONLY tbl_blog_lookup ALTER COLUMN id SET DEFAULT nextval('tbl_blog_lookup_id_seq'::regclass);

ALTER TABLE ONLY tbl_blog_lookup
    ADD CONSTRAINT tbl_blog_lookup_pkey PRIMARY KEY (id);
    


CREATE TABLE tbl_blog_post
(
	id INTEGER NOT NULL,
	title character varying(128) NOT NULL,
	content TEXT NOT NULL,
	gambar character varying(128),
	tags TEXT,
	status INTEGER NOT NULL,
	create_time INTEGER,
	update_time INTEGER,
	author_id INTEGER NOT NULL
) ;


CREATE SEQUENCE tbl_blog_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

-- ALTER TABLE public.tbl_blog_post_id_seq OWNER TO iyo;
ALTER SEQUENCE tbl_blog_post_id_seq OWNED BY tbl_blog_post.id;
ALTER TABLE ONLY tbl_blog_post ALTER COLUMN id SET DEFAULT nextval('tbl_blog_post_id_seq'::regclass);

ALTER TABLE ONLY tbl_blog_post
    ADD CONSTRAINT tbl_blog_post_pkey PRIMARY KEY (id);
    
ALTER TABLE ONLY tbl_blog_post
    ADD CONSTRAINT tbl_blog_post_author_id FOREIGN KEY (author_id) REFERENCES tbl_user_users(id) ON UPDATE RESTRICT ON DELETE CASCADE;    



CREATE TABLE tbl_blog_comment
(
	id INTEGER NOT NULL,
	content TEXT NOT NULL,
	status INTEGER NOT NULL,
	create_time INTEGER,
	author character varying(128) NOT NULL,
	email character varying(128) NOT NULL,
	url character varying(128),
	post_id INTEGER NOT NULL
) ;

CREATE SEQUENCE tbl_blog_comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

-- ALTER TABLE public.tbl_blog_comment_id_seq OWNER TO iyo;
ALTER SEQUENCE tbl_blog_comment_id_seq OWNED BY tbl_blog_comment.id;
ALTER TABLE ONLY tbl_blog_comment ALTER COLUMN id SET DEFAULT nextval('tbl_blog_comment_id_seq'::regclass);

ALTER TABLE ONLY tbl_blog_comment
    ADD CONSTRAINT tbl_blog_comment_pkey PRIMARY KEY (id);
    
ALTER TABLE ONLY tbl_blog_comment
    ADD CONSTRAINT tbl_blog_comment_post_id FOREIGN KEY (post_id) REFERENCES tbl_blog_post(id) ON UPDATE RESTRICT ON DELETE CASCADE;    


CREATE TABLE tbl_blog_tag
(
	id INTEGER NOT NULL,
	name character varying(128) NOT NULL,
	frequency INTEGER DEFAULT 1
) ;

CREATE SEQUENCE tbl_blog_tag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

-- ALTER TABLE public.tbl_blog_tag_id_seq OWNER TO iyo;
ALTER SEQUENCE tbl_blog_tag_id_seq OWNED BY tbl_blog_tag.id;
ALTER TABLE ONLY tbl_blog_tag ALTER COLUMN id SET DEFAULT nextval('tbl_blog_tag_id_seq'::regclass);

ALTER TABLE ONLY tbl_blog_tag
    ADD CONSTRAINT tbl_blog_tag_pkey PRIMARY KEY (id);
    

INSERT INTO tbl_blog_lookup (name, type, code, position) VALUES ('Draft', 'PostStatus', 1, 1);
INSERT INTO tbl_blog_lookup (name, type, code, position) VALUES ('Published', 'PostStatus', 2, 2);
INSERT INTO tbl_blog_lookup (name, type, code, position) VALUES ('Archived', 'PostStatus', 3, 3);
INSERT INTO tbl_blog_lookup (name, type, code, position) VALUES ('Pending Approval', 'CommentStatus', 1, 1);
INSERT INTO tbl_blog_lookup (name, type, code, position) VALUES ('Approved', 'CommentStatus', 2, 2);

SELECT pg_catalog.setval('tbl_blog_lookup_id_seq', 5, true);

INSERT INTO tbl_blog_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('Welcome!','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.

Feel free to try this system by writing new posts and posting comments.',2,1230952187,1230952187,1,'yii, blog');
INSERT INTO tbl_blog_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2,1230952187,1230952187,1,'test');

SELECT pg_catalog.setval('tbl_blog_post_id_seq', 2, true);


INSERT INTO tbl_blog_comment (content, status, create_time, author, email, post_id) VALUES ('This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', 2);

SELECT pg_catalog.setval('tbl_blog_comment_id_seq', 1, true);


INSERT INTO tbl_blog_tag (name) VALUES ('yii');
INSERT INTO tbl_blog_tag (name) VALUES ('blog');
INSERT INTO tbl_blog_tag (name) VALUES ('test');

SELECT pg_catalog.setval('tbl_blog_comment_id_seq', 3, true);


--
-- Name: tbl_blog_banner; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_blog_banner (
    id integer NOT NULL,
    gambar character varying NOT NULL,
    keterangan character varying,
    status smallint DEFAULT 1,
    posisi integer DEFAULT 0,
    link character varying
);



--
-- Name: tbl_blog_banner_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_blog_banner_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



--
-- Name: tbl_blog_banner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_blog_banner_id_seq OWNED BY tbl_blog_banner.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_blog_banner ALTER COLUMN id SET DEFAULT nextval('tbl_blog_banner_id_seq'::regclass);


--
-- Name: tbl_blog_banner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_blog_banner
    ADD CONSTRAINT tbl_blog_banner_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--



CREATE TABLE tbl_blog_gallery (
    id integer NOT NULL,
    url character varying NOT NULL,
    keterangan character varying,
    status smallint DEFAULT 1,
    tags character varying,
    tipe character varying
);

CREATE SEQUENCE tbl_blog_gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE tbl_blog_gallery_id_seq OWNED BY tbl_blog_gallery.id;

ALTER TABLE ONLY tbl_blog_gallery ALTER COLUMN id SET DEFAULT nextval('tbl_blog_gallery_id_seq'::regclass);

ALTER TABLE ONLY tbl_blog_gallery
    ADD CONSTRAINT tbl_blog_gallery_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
