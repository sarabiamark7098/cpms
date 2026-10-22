-- Gender identities lookup table
--
-- Reference list of gender identities for client/beneficiary records.
-- Follows the existing lookup-table convention (prefixed id + a single
-- descriptive column, e.g. tbl_relationship.r_id / relation).
--
-- Safe to re-run: the table is created only if missing and the seed uses
-- INSERT IGNORE against the unique identity name.

CREATE TABLE IF NOT EXISTS `gender_identities` (
  `gender_id` INT NOT NULL AUTO_INCREMENT,
  `gender_identity` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`gender_id`),
  UNIQUE KEY `uq_gender_identity` (`gender_identity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `gender_identities` (`gender_identity`) VALUES
('Man'),
('Woman'),
('Lesbian'),
('Gay'),
('Bisexual'),
('Transgender'),
('Queer/Questioning'),
('Intersex'),
('Asexual/Agender'),
('Non-Binary'),
('Genderfluid'),
('Bigender'),
('Trigender/Polygender'),
('Pangender/Omnigender'),
('Demigender'),
('Neutrois'),
('Androgynous');
