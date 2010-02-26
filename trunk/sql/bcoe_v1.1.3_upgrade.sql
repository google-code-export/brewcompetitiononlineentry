ALTER TABLE `contest_info` 
DROP `contestDate`,
DROP `contestJudgingLocation`,
ADD `contestEntryFee2` VARCHAR( 255 ) NULL AFTER `contestEntryFee`,
ADD `contestEntryFeeDiscount` CHAR( 1 ) NULL AFTER `contestEntryFee2`,
ADD `contestEntryFeeDiscountNum` CHAR( 4 ) NULL AFTER `contestEntryFeeDiscount`;

UPDATE `contest_info` SET `contestEntryFeeDiscount` = 'N' WHERE `id` =1;

CREATE TABLE `judging` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`judgingDate` DATE NOT NULL,
`judgingTime` VARCHAR( 255 ) NOT NULL,
`judgingLocName` VARCHAR( 255 ) NOT NULL,
`judgingLocation` TEXT NOT NULL 
) ENGINE = MYISAM ;

ALTER TABLE `brewer` 
ADD `brewerJudgeLocation` INT( 8 ) NULL,
ADD `brewerJudgeLocation2` INT( 8 ) NULL,
ADD `brewerStewardLocation` INT( 8 ) NULL,
ADD `brewerStewardLocation2` INT( 8 ) NULL,
ADD `brewerJudgeAssignedLocation` INT( 8 ) NULL,
ADD `brewerStewardAssignedLocation` INT( 8 ) NULL,
ADD `brewerAssignment` CHAR( 1 ) NULL;

ALTER TABLE `styles` 
ADD `brewStyleActive` CHAR( 1 ) NULL DEFAULT 'Y';

ALTER TABLE `brewing` 
ADD `brewJudgingLocation` INT( 8 ) NULL;

