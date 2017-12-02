DROP TABLE User;
DROP TABLE Province;
DROP TABLE City;
DROP TABLE Category;
DROP TABLE SubCategory;
DROP TABLE Ad;

CREATE TABLE User (
    Username varchar(50) PRIMARY KEY NOT NULL,
    Pass varchar(50) NOT NULL,
    Firstname varchar(50) NOT NULL,
    Lastname varchar(50) NOT NULL,
    Membership int DEFAULT 7,
    Province varchar(25) NOT NULL,
    City varchar(50) NOT NULL,
    Usertype varchar(30) NOT NULL DEFAULT "REGULAR"
);

INSERT INTO User VALUES ('admin','admin','Admin','Admin',30,'Quebec','Montreal',"ADMIN");
INSERT INTO User VALUES ('nick','nick','Nicolas','Correa',7,'Quebec','Montreal',"REGULAR");


CREATE TABLE Province (
    province_name varchar(50) PRIMARY KEY NOT NULL
);


CREATE TABLE City (
    city_name varchar(50) PRIMARY KEY NOT NULL,
    province_name varchar(50) NOT NULL
);


INSERT INTO Province VALUES('Quebec');
INSERT INTO Province VALUES('Ontario');
INSERT INTO Province(province_name)
VALUES( 'Nova Scotia' ),( 'New Brunswick' ),( 'Manitoba' ),
('British Columbia'),
('Prince Edward Island'),
('Saskatchewan'),
('Alberta'),
('Newfoundland and Labrador'),
('Northwest Territories'),
('Yukon'),
('Nunavut');


INSERT INTO City VALUES('Montreal','Quebec');
INSERT INTO City VALUES('Quebec City','Quebec');
INSERT INTO City VALUES('Toronto','Ontario');

INSERT INTO City(city_name, province_name)
VALUES('Victoria','British Columbia'),
('Kelowna','British Columbia'),
('Moncton','New Brunswick'),
('Saint John','New Brunswick'),
('Fredericton','New Brunswick'),
('Labrador City','Newfoundland and Labrador'),
('Corner Brook','Newfoundland and Labrador'),
('Gander','Newfoundland and Labrador'),
('Fort Simpson','Northwest Territories'),
('Yellowknife','Northwest Territories'),
('Inuvik','Northwest Territories'),
('Halifax','Nova Scotia'),
('Sydney','Nova Scotia'),
('Truro','Nova Scotia'),
('Iqaluit','Nunavut'),
('Baker Lane','Nunavut'),
('Rankin Inlet','Nunavut'),
('Charlottetown','Prince Edward Island'),
('Summerside','Prince Edward Island'),
('Montague','Prince Edward Island'),
('Regina','Saskatchewan'),
('Saskatoon','Saskatchewan'),
('Moose Jaw','Saskatchewan'),
('Whitehorse','Yukon'),
('Dawson City','Yukon'),
('Watson Lake','Yukon');



CREATE TABLE Category (
    CategoryName varchar(50) PRIMARY KEY NOT NULL
);


CREATE TABLE SubCategory (
    SubCategoryName varchar(50) PRIMARY KEY NOT NULL,
    CategoryName varchar(50) NOT NULL
);


INSERT INTO Category VALUES ('Buy and Sell');
INSERT INTO Category VALUES ('Services');
INSERT INTO Category VALUES ('Rent');
INSERT INTO Category VALUES ('Pets');


INSERT INTO SubCategory VALUES ('Clothing','Buy and Sell');
INSERT INTO SubCategory VALUES ('Books','Buy and Sell');
INSERT INTO SubCategory VALUES ('Electronics','Buy and Sell');
INSERT INTO SubCategory VALUES ('Musical Instruments','Buy and Sell');

INSERT INTO SubCategory VALUES ('Tutors','Services');
INSERT INTO SubCategory VALUES ('EventPlanners','Services');
INSERT INTO SubCategory VALUES ('Photographers','Services');
INSERT INTO SubCategory VALUES ('Personal Trainers','Services');

INSERT INTO SubCategory VALUES ('Electronics','Rent');
INSERT INTO SubCategory VALUES ('Car','Rent');
INSERT INTO SubCategory VALUES ('apartments','Rent');
INSERT INTO SubCategory VALUES ('Wedding Dresses','Rent');

INSERT INTO SubCategory VALUES ('Lost and Found','Pets');
INSERT INTO SubCategory VALUES ('Rehoming','Pets');
INSERT INTO SubCategory VALUES ('Accessories','Pets');
INSERT INTO SubCategory VALUES ('Other','Pets');


CREATE TABLE Ad (
    Id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Username varchar(50) NOT NULL,
    Email varchar(50) NOT NULL,
    PhoneNumber varchar(20) NOT NULL,
    Price int NOT NULL,
    Available varchar(20) NOT NULL DEFAULT "ONLINE",
    ForSaleBy varchar(50) NOT NULL,
    Title varchar(50) NOT NULL,
    AdDesc varchar(255) NOT NULL,
    Addr varchar(100) NOT NULL,
    Category varchar(50) NOT NULL,
    SubCategory varchar(50) NOT NULL,
    Province varchar(50) NOT NULL,
    City varchar(50) NOT NULL,
    Posted Date,
    Sold   varchar(1) NOT NULL DEFAULT 'F',
    Promotion int NOT NULL DEFAULT 0
);

/*  */

INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',25,"ONLINE", "Owner",
"Selling Dog Toys","Hey guys, Im selling these dog toys! Thanks!", "Somewhere 5525",
'Pets','Accessories','Quebec','Montreal','2017-12-03','F',0);

INSERT INTO Ad VALUES(0,'admin','something@gmail.com','514-235-2352',25,"ONLINE", "Owner",
"Selling Dog Toys","Hey guys, Im selling these dog toys! Thanks!", "Somewhere 5525",
'Pets','Accessories','Quebec','Montreal','2017-11-20','F',0);


/* Need Ad -> images table */