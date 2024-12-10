-- lab 5 task 1 - demonstrate CRUD for single table;

-- create new database
create database advwebdev;
use advwebdev;
show tables;

-- create new table
CREATE TABLE foobar (
  id INT
);
show tables;

-- create new data in table
insert into foobar (id) values (123),(456);
-- read from table
select * from foobar;

-- update a value
update foobar set id=789
where id=456;
select * from foobar;


-- drop the table
drop table foobar;
show tables;
