--
-- Simple create in one line a database named: lacagna
-- give privilege to user: valtom
-- with password: CHANGEME
-- @author Jodaille
--
CREATE database lacagna;GRANT ALL PRIVILEGES ON lacagna.* TO "valtom"@"localhost" IDENTIFIED BY "CHANGEME";FLUSH PRIVILEGES;
