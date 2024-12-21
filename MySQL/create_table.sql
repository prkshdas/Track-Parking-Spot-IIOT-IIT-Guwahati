CREATE DATABASE parking_system;

USE parking_system;

CREATE TABLE iit_parking_status (
  id INT AUTO_INCREMENT PRIMARY KEY,
  temperature FLOAT NOT NULL,
  humidity FLOAT NOT NULL,
  parking_status_1 VARCHAR(50) NOT NULL,
  parking_status_2 VARCHAR(50) NOT NULL,
  parking_status_3 VARCHAR(50) NOT NULL,
  parking_status_4 VARCHAR(50) NOT NULL,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
