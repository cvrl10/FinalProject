DROP DATABASE IF EXISTS info;
CREATE DATABASE info;
use info;

CREATE TABLE Members (first_name VARCHAR(15) NOT NULL, 
                      last_name VARCHAR(15) NOT NULL, 
                      id INT PRIMARY KEY, 
                      usr_name VARCHAR(10) NULL,
                      passwrd VARCHAR(10) NUll
                      email VARCHAR(50) NULL);

INSERT INTO Members (first_name, last_name, id) VALUES ('Carl', 'Archemetre', 011235);
INSERT INTO Members (first_name, last_name, id) VALUES ('Rose', 'Archemetre', 581321);