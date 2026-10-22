-- GIS: Client & Beneficiary sections
--
-- The GIS form now captures category, sub-category, type of disability and
-- gender identity separately for the CLIENT and the BENEFICIARY.
--
-- Reuses existing columns where present:
--   Client  : client_data.category, client_data.subCategory,
--             assessment.target_sector, assessment.type_of_disability
--   Bene    : beneficiary_data.b_category, beneficiary_data.b_subCategory
--
-- Adds the columns that did not yet exist (gender identity for both, plus the
-- beneficiary target_sector / type_of_disability). Safe to re-run.

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
