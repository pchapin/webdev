-- lab 5 task 2 - bakesale table

use advwebdev;
show tables;

-- create new table
drop table bakesale;
CREATE TABLE bakesale (
    student varchar(32),
    grade int unsigned,
    homeroom varchar(32),
    description varchar(64),
    category varchar(32),
    init_quantity int unsigned,
    unit_price decimal(6,2),
    num_sold int unsigned,
    day char(8)
  );
show tables;

-- read in the provided csv file
delete from bakesale;    -- clear out any rows to rerun if needed

LOAD DATA local INFILE
'C:\\Users\\steve\\Box Sync\\VTC\\Adv Web Dev\\2020_Spring\\labs\\lab 05 DB setup and SQL\\bake sale spreadsheet.csv'
INTO TABLE bakesale
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

select * from bakesale;
