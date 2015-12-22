# mcm-mailer

A tool that takes energy consumption data as input and visualizes the data in a way that motivates the user to reduce his energy consumption.

## Documentation

### How to to create a required table for mcm-mailer

  - connect via SSH on server and with `mysql -u root -p` to mysql DB
  - change to database `***REMOVED***` with
    `use ***REMOVED***`
  - Create new table:
  ```
CREATE TABLE `***REMOVED***`.`bires_mcm_mailing` (   `ID` INT NOT NULL auto_increment,    `b1user_ID` INT,   `lastMailingSent` DATE NULL,   UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),   PRIMARY KEY (`ID`),   CONSTRAINT `b1user`     FOREIGN KEY (`b1user_ID`)         REFERENCES `***REMOVED***`.`b1user` (`id`)     ON DELETE NO ACTION     ON UPDATE NO ACTION);
  ```
  - to insert data in the table, execute:
  ```
  insert into bires_mcm_mailing (b1user_ID,lastMailingSent) values (10,NOW());
  ```
