-- lab 5 task 3 - course semster schedule table

use advwebdev;
show tables;

-- create new table
drop table schedule;
CREATE TABLE schedule (
    dept char(4),
    course int,
    name varchar(64),
    instructor varchar(64),
    semester char(8),
    year int,
    days char(5),
    starttime int,
    endtime int
  );
show tables;

-- insert appropriate schedule
delete from schedule;    -- clear out any rows to rerun if needed
insert into schedule values
  ('CIS',1152,'Adv Web Dev','Ruegsegger','Spring',2020,'T',1400,1600),
  ('EES',2001,'Circuits 1','Kirkov','Spring',2020,'MF',1200,1400),
  ('ENG',1234,'English 2','Smith, M','Spring',2020,'MW',1000,1050)
;

select * from schedule;
