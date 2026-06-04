-- Adds creator tracking (created_by + created_at) to all certificate tables.
-- Import once into the `gdpsite_verify` database (phpMyAdmin / hosting panel),
-- e.g.  mysql gdpsite_verify < db/migrations/add_created_by.sql
-- Existing rows keep NULL (shown blank on the site).

ALTER TABLE `coc`
  ADD COLUMN `created_by` VARCHAR(255) NULL DEFAULT NULL,
  ADD COLUMN `created_at` DATETIME NULL DEFAULT NULL;

ALTER TABLE `cop`
  ADD COLUMN `created_by` VARCHAR(255) NULL DEFAULT NULL,
  ADD COLUMN `created_at` DATETIME NULL DEFAULT NULL;

ALTER TABLE `endorsement`
  ADD COLUMN `created_by` VARCHAR(255) NULL DEFAULT NULL,
  ADD COLUMN `created_at` DATETIME NULL DEFAULT NULL;

ALTER TABLE `medical_certificates`
  ADD COLUMN `created_by` VARCHAR(255) NULL DEFAULT NULL,
  ADD COLUMN `created_at` DATETIME NULL DEFAULT NULL;
