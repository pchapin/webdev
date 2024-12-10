
-- Information about the students selling goods.
CREATE TABLE student(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(16),
    grade       INTEGER,
    homeroom    VARCHAR(16)
);

-- Populate the student table with some real data.
INSERT INTO student (name, grade, homeroom) VALUES
    ('sam',5 ,'Mrs B'), ('betty', 4, 'Mr H');

-- See if the student table looks right.
SELECt * from student;

-- Create a table for the bake sale information.
-- Note that MariaDB requires the verbose form of the foreign key reference syntax.
CREATE TABLE bake_sale(
    student_id     INTEGER,
    description    VARCHAR(32),
    category       VARCHAR(16),
    init_quantity  INTEGER,
    unit_price     NUMERIC(4, 2),
    sold           INTEGER,
    sale_day       CHAR(3),
    FOREIGN KEY (student_id) REFERENCES student(id)
);

-- Populate it with some data.
LOAD DATA LOCAL INFILE '/Users/peter/BOK/PHP/Astro/bake-sale-data.csv'
INTO TABLE bake_sale
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

-- See if the data looks good.
SELECT * from bake_sale;

-- Use SELECT to view some information from both tables by joining them together.
SELECT student.name, student.grade, bake_sale.description, bake_sale.category, bake_sale.sold
FROM bake_sale JOIN student ON bake_sale.student_id = student.id;

-- Clean up...
DROP TABLE bake_sale;  -- Referential integrity should require that bake_sale be dropped first.
DROP TABLE student;
