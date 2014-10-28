
DROP TABLE IF EXISTS {{user_oauth}};
CREATE TABLE IF NOT EXISTS {{user_oauth}} (
  user_id integer NOT NULL,
  provider character varying(45) NOT NULL,
  identifier character varying(64) NOT NULL,
  profile_cache text,
  session_data text  
);

--ALTER TABLE ONLY {{user_oauth}}
--    ADD CONSTRAINT {{user_oauth}}_pkey PRIMARY KEY (provider);

ALTER TABLE ONLY {{user_oauth}}
    ADD CONSTRAINT {{user_oauth}}_pkey PRIMARY KEY (identifier);
