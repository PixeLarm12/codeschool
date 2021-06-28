CREATE TABLE messages
(
    id SERIAL NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    problem VARCHAR(20) NOT NULL,
    comments VARCHAR(255) NOT NULL
);

CREATE TABLE users
(
    id SERIAL NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(12) NOT NULL,
    token VARCHAR(12),
    image VARCHAR(50)
);

CREATE TABLE courses
(
    id SERIAL NOT NULL,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    value VARCHAR(20) NOT NULL,
    image VARCHAR(50),
    category VARCHAR(30)
);

CREATE TABLE classes
(
    id SERIAL NOT NULL,
    id_user INTEGER NOT NULL,
    id_course INTEGER NOT NULL,
    status VARCHAR
            (20) NOT NULL
);

INSERT INTO users
    (name, email, password, role)
VALUES
    ('admin', 'adm@adm.com.br', 'qwe123QWE', 'admin');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Introduction to PHP 7', 'This courses is to introduce the PHP 7 back-end language', '0.00', 'null.png', 'PHP');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Javascript: easy to hard', 'Here you will learn more about Javascript, starting the basics and concepts until the senior JS developer', '120.00', 'null.png', 'JAVASCRIPT');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Starting the front-end career (CSS)', 'Do you want to create a good layout for your website? Buy this course and come on!', '50.00', 'null.png', 'CSS');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Photoshop advanced', 'This courses shows you how a designer works at Photoshop', '250.00', 'null.png', 'DESIGN');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Working with MySQL', 'With this course you will learn about MySQL database and other concepts to save, with security, data', '0.00', 'null.png', 'DATABASE');

INSERT INTO courses
    (name, description, value, image, category)
VALUES
    ('Laravel: the best framework to your API', 'This course will show you the better PHP framework - Laravel. You will be able to create a simple CRUD in 10 minutes!', '70.00', 'null.png', 'BACK-END');
