-- lab 5 task 4 - user authentication

use advwebdev;
show tables;

-- create new table
drop table users;
CREATE TABLE users (
    userid char(16),
    plain_pw varchar(64),
    pw binary(40),
    first varchar(32),
    last varchar(64),
    email varchar(64),
    phone1 char(12)
  );
show tables;

-- insert appropriate schedule
delete from users;    -- clear out any rows to rerun if needed
insert into users (userid, plain_pw, pw, first, last) values
  ('bobsmith','apple123', sha1(plain_pw), 'Bob','Smith'),
  ('johndoe','banana456', sha1(plain_pw), 'John','Doe'),
  ('sally','grape98', sha1(plain_pw), 'Sally','Jones')
;

select * from users;
