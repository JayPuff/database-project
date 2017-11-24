DROP TABLE User;
DROP TABLE Province;
DROP TABLE City;

CREATE TABLE User (
    Username varchar(50) PRIMARY KEY NOT NULL,
    Pass varchar(50) NOT NULL,
    Firstname varchar(50) NOT NULL,
    Lastname varchar(50) NOT NULL,
    Membership int DEFAULT 0,
    Province varchar(25) NOT NULL,
    City varchar(50) NOT NULL
);



CREATE TABLE Province (
    province_name varchar(50) PRIMARY KEY NOT NULL
);


CREATE TABLE City (
    city_name varchar(50) PRIMARY KEY NOT NULL,
    province_name varchar(50) NOT NULL
);


INSERT INTO Province VALUES('Quebec');
INSERT INTO Province VALUES('Ontario');


INSERT INTO City VALUES('Montreal','Quebec');
INSERT INTO City VALUES('Quebec City','Quebec');
INSERT INTO City VALUES('Toronto','Ontario');




