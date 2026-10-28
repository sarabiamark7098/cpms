DROP INDEX idx_served_enc ON tbl_transaction;

DROP INDEX idx_served_sw  ON tbl_transaction;

CREATE INDEX idx_served_enc ON tbl_transaction (status_client, encoded_encoder,   date_accomplished, client_id);

CREATE INDEX idx_served_sw  ON tbl_transaction (status_client, encoded_socialWork, date_accomplished, client_id);

ALTER TABLE `api_send_log`
    ADD COLUMN `sync_batch_id` VARCHAR(40) NULL DEFAULT NULL AFTER `id`;

ALTER TABLE `api_send_log`
    ADD INDEX `idx_sync_batch_id` (`sync_batch_id`);

ALTER TABLE `api_send_log`
    RENAME COLUMN `assist_type_desc` TO `assistance_type`;

DROP TABLE IF EXISTS `records`;

CREATE TABLE IF NOT EXISTS `records` (
  `record_id`     INT NOT NULL AUTO_INCREMENT,
  `trans_id`      VARCHAR(40) NOT NULL,
  `received`      VARCHAR(255) DEFAULT NULL,
  `other_specify` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `idx_records_trans_id` (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX idx_tx_status_dateacc ON tbl_transaction (status_client, date_accomplished);

CREATE INDEX idx_assist_trans_mode ON assistance (trans_id, mode);

ANALYZE TABLE tbl_transaction;
ANALYZE TABLE assistance;

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

ALTER TABLE `client_data`
  ADD COLUMN `gender_identity` VARCHAR(100) DEFAULT NULL,
  ADD COLUMN `type_of_disability` VARCHAR(255) DEFAULT NULL,
  ADD COLUMN `others_subCategory` VARCHAR(255) DEFAULT NULL,  
  ADD COLUMN `below_monthly_income` VARCHAR(255) DEFAULT NULL,
  ADD COLUMN `others_subcat`        VARCHAR(255) DEFAULT NULL;

ALTER TABLE `beneficiary_data`
  ADD COLUMN `b_gender_identity` VARCHAR(100) DEFAULT NULL,
  ADD COLUMN `b_type_of_disability` VARCHAR(255) DEFAULT NULL,
  ADD COLUMN `b_others_subCategory` VARCHAR(255) DEFAULT NULL,
  ADD COLUMN `b_below_monthly_income` VARCHAR(255) DEFAULT NULL,
  ADD COLUMN `b_others_subcat`        VARCHAR(255) DEFAULT NULL;

ALTER TABLE `assistance`
  ADD COLUMN `free_funeral_service` VARCHAR(255) DEFAULT NULL AFTER `cause_of_death`;

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `subcat_id` INT NOT NULL AUTO_INCREMENT,
  `sub_category` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`subcat_id`),
  UNIQUE KEY `uq_sub_category` (`sub_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `sub_categories` (`sub_category`) VALUES
('Indigent'),
('Out of School Youth'),
('Pre-delinquent Youth'),
('Sexually-abused'),
('Physically-abused/maltreated/battered'),
('Victims of Illegal Recruitment'),
('Victims of armed conflict'),
('Victims of trafficking'),
('Surrendered drug users'),
('Repatriated OFW'),
('Killed in Action (KIA)'),
('Wounded in Action (WIA)'),
('Indigenous People'),
('Individuals with Cancer'),
('Former Rebels'),
('Dialysis Patients'),
('Tuberculosis Patients'),
('Person of Concerns – Refugees'),
('Person of Concerns - Stateless Persons'),
('Person of Concerns - Asylum Seeker'),
('Persons Deprived of Liberty'),
('Student'),
('Solo Parent'),
('4Ps Beneficiaries'),
('Orthopedically handicapped'),
('Hearing/Speech impaired'),
('Visually impaired'),
('Mentally challenged'),
('Mental Disabilities'),
('Recovering Person who used drugs'),
('Street Dwellers'),
('Minimum Wage Earners'),
('Below Minimum Wage Earners'),
('No Regular Income'),
('Low Income'),
('Internally Displaced Family'),
('Abandoned'),
('Abused'),
('Neglected'),
('Orphaned'),
('Homeless'),
('Overseas Filipino Workers'),
('Victims of Natural Calamities'),
('Victims of Man-made Calamities'),
('Victims of Disaster'),
('Victims of Human Trafficking'),
('Victims of Domestic Violence'),
('Victims of Sexual Harassment'),
('Victims of Rape'),
('Victims of Physical Assault'),
('Victims of Robbery/ Theft/ Burglary/ Hold-up'),
('Victims of Arson/ Fire Incidents'),
('Victims of Road Traffic Accidents'),
('Victims of Involuntary Prostitution'),
('Victims of Abduction/ Kidnapping'),
('Victims of Illegal Detention'),
('Victims of Torture/ Inhuman Treatment'),
('Victims of Discrimination'),
('Victims of Bullying/ Harassment'),
('Victims of Stalking/ Cyberstalking'),
('Victims of Online Scams/ Fraud'),
('Victims of Identity Theft'),
('Victims of Hate Crimes'),
('Victims of Terrorism/ Bombings'),
('Victims of Child Labor'),
('Victims of Child Trafficking'),
('Children in Situations of Armed Conflict'),
('Voluntary Committed/Surrendered'),
('Sexually-Exploited'),
('Street Children'),
('Children with HIV/AIDS'),
('Children with Disabilities'),
('Children in Need of Special Protection'),
('Children in Conflict with the Law (CICL)'),
('Children in Conflict with the Law (below 9 yrs. old)'),
('Children in Conflict with the Law (18 yrs. old and above)'),
('Children in Conflict with the Law (Juvenile Offenders)'),
('Children in Conflict with the Law (Juvenile Delinquents)'),
('Children in Conflict with the Law (Juvenile Victims)'),
('Children in Conflict with the Law (Juvenile Witnesses)'),
('Children in Conflict with the Law (Juvenile Offenders and Victims)'),
('Children in Conflict with the Law (Juvenile Offenders and Witnesses)'),
('Children in Conflict with the Law (Juvenile Victims and Witnesses)'),
('Others Specify'),
('None of the Above');

ALTER TABLE assistance
    ADD COLUMN amount_num DECIMAL(15,2)
        GENERATED ALWAYS AS
        (CAST(NULLIF(REPLACE(REPLACE(COALESCE(amount, ''), ',', ''), ' ', ''), '') AS DECIMAL(15,2)))
        STORED;
CREATE INDEX idx_assist_mode_amt ON assistance (trans_id, mode, amount_num);

ALTER TABLE tbl_coe_fund
    ADD COLUMN fs_amount_num DECIMAL(15,2)
        GENERATED ALWAYS AS
        (CAST(NULLIF(REPLACE(REPLACE(COALESCE(fs_amount, ''), ',', ''), ' ', ''), '') AS DECIMAL(15,2)))
        STORED;
CREATE INDEX idx_coefund_fund ON tbl_coe_fund (trans_id, fundsource, fs_amount_num);

ANALYZE TABLE assistance;
ANALYZE TABLE tbl_coe_fund;

ALTER TABLE `api_send_log`
    MODIFY COLUMN `assistance_type` VARCHAR(50) NOT NULL;

SET SQL_SAFE_UPDATES = 0;

UPDATE `api_send_log` asl 
JOIN `assistance` a 
  ON a.trans_id = asl.trans_id 
 AND a.type_description = asl.assistance_type 
SET asl.assistance_type = a.type;

SET SQL_SAFE_UPDATES = 1;
