
CREATE DATABASE  areesh;
USE areesh;


CREATE TABLE  admin(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL
);


INSERT INTO admin(username,password)
VALUES ('AreeshA','4563');


CREATE TABLE I student(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
class VARCHAR(20) NOT NULL,
age INT NOT NULL
);




CREATE TABLE  task(
id INT AUTO_INCREMENT PRIMARY KEY,
student_id INT,
title VARCHAR(100),
description TEXT,
status VARCHAR(50),
FOREIGN KEY(student_id) REFERENCES student(id)
);


INSERT INTO task(student_id,title,description,status)
VALUES
(1,'Math Homework','Complete chapter 5','Pending');


SELECT * FROM admin;
SELECT * FROM student;
SELECT * FROM task;
