-- Assistance Received from DSWD (records)
--
-- Stores the "NATANGGAP NA TULONG MULA SA DSWD / Assistance Received from DSWD"
-- section of the Information Sheet.
--   received       - dash-delimited tokens of the answer + programs received
--                    (e.g. "Oo-AICS-WGP-"), or "Hindi-" when none.
--   other_specify  - free text for the "Others:" option.
--
-- One row per transaction (trans_id). The table is new (no production data),
-- so it is dropped and recreated to pick up the current column set.

DROP TABLE IF EXISTS `records`;

CREATE TABLE IF NOT EXISTS `records` (
  `record_id`     INT NOT NULL AUTO_INCREMENT,
  `trans_id`      VARCHAR(40) NOT NULL,
  `received`      VARCHAR(255) DEFAULT NULL,
  `other_specify` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `idx_records_trans_id` (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
