/*
    Lab 9 - PHP sessions
          - users, roles, authentication, credentials, salted hash pw
*/

-- use advwebdev;

-- ---------------------------------------------------------------
-- the salted pw hash string from PHP password_hash() function is a 60-byte char
-- you could also just use sql md5() of the plain text pw.  md5 is char(32)

CREATE TABLE users (
 userid     char(16) not null unique,
 firstname  varchar(16),
 lastname   varchar(24),
 salthashpw char(60),
PRIMARY KEY (userid)
);

-- the salthashpw is left null here to be inserted by
--  the PHP password_hash() function
insert into users values
 ('bobby','Bob','Smith',NULL),
 ('prof','Steve','Ruegsegger',NULL),
 ('susie','Susie','Jones',NULL),
 ('mark','Mark','Tums',NULL),
 ('admin','acct','Admin',NULL),
 ('sales','acct','Sales',NULL),
 ('report','acct','Report',NULL);
select * from users;



-- -----------------------------------------------------
-- role priority: higher number is more authorization
drop table roles;
create table roles (
    roleid INT unsigned not null unique,
    rolename char(8),
    description varchar(48),
    priority  int unsigned,
    primary key (roleid) );

insert into roles values
   (1001, 'user',  'a user of my apps reports',1),
   (1002, 'admin', 'administration',3),
   (1003, 'sales', 'can sell items at lunch',2);
select * from roles;



-- ---------------------------------------------
-- junction table:  connect PKs of users and their role

drop table permission_fact;
create table permission_fact (
    userid varchar(16),
    roleid INT unsigned not null
);

insert into permission_fact values
('bobby', 1001),
('prof',  1002),
('susie', 1001),
('mark',  1003),
('admin',  1002),
('sales',  1003),
('report',  1001);

select * from permission_fact;


-- ------------------------------

select b.*, c.*
from permission_fact a
inner join users b on a.userid=b.userid
inner join roles c on a.roleid=c.roleid
;
