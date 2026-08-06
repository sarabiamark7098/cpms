-- Records / RDV Sync
-- Rename api_send_log.assist_type_desc -> assistance_type for clarity.
-- Column keeps the same definition and stored values (the assistance
-- type_description used as the per-transaction sync dedup key).

ALTER TABLE `api_send_log`
    RENAME COLUMN `assist_type_desc` TO `assistance_type`;
