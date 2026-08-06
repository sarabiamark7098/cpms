-- Records / RDV Sync
-- api_send_log.assistance_type should store the real assistance type
-- (assistance.type, e.g. "Medical Assistance") instead of the type_description
-- code ("Type1").
--
-- 1) Widen the column to match assistance.type (varchar(50)) so long type names
--    are not truncated. Truncation would break the sync dedup match.
-- 2) Backfill existing rows, which currently hold the type_description code,
--    with the real assistance type from the assistance table.

ALTER TABLE `api_send_log`
    MODIFY COLUMN `assistance_type` VARCHAR(50) NOT NULL;

UPDATE `api_send_log` asl
JOIN `assistance` a
    ON a.trans_id = asl.trans_id
    AND a.type_description = asl.assistance_type
SET asl.assistance_type = a.type;
