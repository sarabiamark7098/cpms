-- Records / RDV Sync Transaction History
-- Adds a batch identifier so each sync attempt (one API POST call) can be
-- grouped and displayed as a single transaction in the Records module.
--
-- Safe to run once. Existing rows keep sync_batch_id = NULL and are grouped
-- by minute as legacy transactions in the Records view.
DROP INDEX idx_served_enc ON tbl_transaction;

DROP INDEX idx_served_sw  ON tbl_transaction;

CREATE INDEX idx_served_enc ON tbl_transaction (status_client, encoded_encoder,   date_accomplished, client_id);

CREATE INDEX idx_served_sw  ON tbl_transaction (status_client, encoded_socialWork, date_accomplished, client_id);

ALTER TABLE `api_send_log`
    ADD COLUMN `sync_batch_id` VARCHAR(40) NULL DEFAULT NULL AFTER `id`;

ALTER TABLE `api_send_log`
    ADD INDEX `idx_sync_batch_id` (`sync_batch_id`);
