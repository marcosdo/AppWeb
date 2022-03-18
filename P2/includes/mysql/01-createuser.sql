CREATE USER IF NOT EXISTS 'lifetyuser'@'localhost' IDENTIFIED BY 'lifetypass';
GRANT ALL PRIVILEGES ON `lifety`.* TO 'lifetyuser'@'localhost';