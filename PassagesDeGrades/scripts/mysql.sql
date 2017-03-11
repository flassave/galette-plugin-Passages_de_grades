--
-- Table structure for table `galette_PassagesDeGrades_notes`
--

DROP TABLE IF EXISTS galette_PassagesDeGrades_notes;
CREATE TABLE galette_PassagesDeGrades_notes (
  id_adh int(10) unsigned NOT NULL,
  uv1 int(2) unsigned,
  uv2 int(2) unsigned,
  uv3 int(2) unsigned,
  uv4 int(2) unsigned,
  uv5 int(2) unsigned,
  uv6 int(2) unsigned,
  PRIMARY KEY (id_adh)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

