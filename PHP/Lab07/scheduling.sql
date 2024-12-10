
-- First, create a table to hold information about the students. Right now we only care about
-- student names. In a more realistic setting, we might also have contact information, a mailing
-- address, etc.
CREATE TABLE student(
    id         INTEGER PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(16),
    last_name  VARCHAR(16)
);

-- Populate the student table with some hypothetical students.
INSERT INTO student
    (first_name, last_name)
VALUES
    ('Peter', 'Chapin'),
    ('Jill',  'Jones'),
    ('Alice', 'Atlas'),
    ('Bob',   'Bobblehead');

-- Now, create a table to hold information about courses. It might make sense to break the
-- catalog information out separately, and then create a table that combines a reference to
-- the catalog information together with semester scheduling details to describe specific course
-- offerings. I don't do that here.
CREATE TABLE course(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    department_name  CHAR(3),
    course_number    INTEGER,
    course_name      VARCHAR(16),
    instructor       VARCHAR(16),
    semester_offered CHAR(6),
    year_offered     INTEGER,
    days             CHAR(5),
    start_time       INTEGER,
    end_time         INTEGER
);

-- Populate the course table with some hypothetical courses.
INSERT INTO course
    (department_name, course_number, course_name, instructor, semester_offered, year_offered, days, start_time, end_time)
VALUES
    ('CIS', 1152, 'Adv Web Dev', 'Chapin', 'Spring', 2023, 'TH', 1400, 1500),
    ('EES', 2001, 'Circuits 1',  'Kirkov', 'Spring', 2023, 'MF', 1200, 1400),
    ('ENG', 1234, 'English 2',   'Smith',  'Spring', 2023, 'MW', 1000, 1050);

-- The schedule table associates students with course offerings. Notice the foreign key references.
CREATE TABLE schedule(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    student_id INTEGER NOT NULL,
    course_id  INTEGER NOT NULL,
    FOREIGN KEY (student_id) REFERENCES student(id),
    FOREIGN KEY (course_id)  REFERENCES course(id)
);

-- Populate the schedule table
INSERT INTO schedule
    (student_id, course_id)
VALUES
    (1, 2),
    (2, 1),
    (2, 3),
    (3, 1),
    (3, 2),
    (3, 3);

SELECT student.first_name, student.last_name, course.course_name
FROM schedule JOIN student ON schedule.student_id = student.id
              JOIN course  ON schedule.course_id = course.id;
