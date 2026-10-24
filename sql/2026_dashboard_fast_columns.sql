-- Finance/Viewer dashboard: pre-parsed, indexed amount columns to speed up the
-- aggregates at scale (100k+ transactions, esp. the fund-source breakdowns and
-- the Year view).
--
-- Why: amounts are stored as formatted varchars ("15,000.00"), so the dashboard
-- queries ran REPLACE()+CAST() on every amount row (up to hundreds of thousands
-- for the fund-source sums). These STORED generated columns do that parse once,
-- at write time, and let the aggregates SUM a real DECIMAL. They are additive
-- and auto-populate for existing and future rows.
--
-- Measured effect at ~100k transactions / ~250k fund rows:
--   month full payload : 374ms -> 301ms
--   month fund (GL)     : 206ms -> 118ms
--   year  fund (GL)     : 1.84s -> 1.40s
--   year  fund (CAV)    : 1.74s -> 1.42s
--
-- NOTE: a STORED office_id column (LEFT(trans_id,9)) was tried and reverted --
-- it widened the heavily-scanned transaction table and slowed the Year scans
-- more than the (still temp-table) GROUP BY saved. The office grouping stays on
-- LEFT(trans_id,9).

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
