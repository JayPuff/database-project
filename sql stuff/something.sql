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

INSERT INTO User VALUES ('john','john','John','Smith',14,'Quebec','Montreal',"REGULAR");

INSERT INTO User VALUES ('harry','harry','Harry','Potter',30,'Quebec','Montreal',"REGULAR");

INSERT INTO User VALUES ('jim','jim','James','Jones',30,'Quebec','Montreal',"REGULAR");

INSERT INTO User VALUES ('pat','pat','Patrick','Stewart',7,'Quebec','Quebec City',"REGULAR");

INSERT INTO User VALUES ('Mat','Mat','Matthew','Robinson',7,'Quebec','Quebec City',"REGULAR");

INSERT INTO User VALUES ('sarah','sarah','Sarah','Lynn',14,'Quebec','Quebec City',"REGULAR");

INSERT INTO User VALUES ('kara','kara','Kara','Edwards',14,'Quebec','Quebec City',"REGULAR");

INSERT INTO User VALUES ('michel','michel','Michel','Perlsteyn',14,'Ontario','Ottowa',"REGULAR");

INSERT INTO User VALUES ('rick','rick','Richard','Dawson',14,'Ontario','Ottowa',"REGULAR");


INSERT INTO User VALUES ('tony','tony','Tony','Montana',14,'Ontario','Ottowa',"REGULAR");


INSERT INTO User VALUES ('kim','kim','Kim','Kardashian',7,'Ontario','Ottowa',"REGULAR");

INSERT INTO User VALUES ('jamie','jamie','Jamie','Fox',30,'Ontario','Toronto',"REGULAR");


INSERT INTO User VALUES ('joe','joe','Joe','Lewis',7,'Ontario','Toronto',"REGULAR");

INSERT INTO User VALUES ('maggie','maggie','Maggie','Moon',30,'Ontario','Toronto',"REGULAR");

INSERT INTO User VALUES ('james','james','James','Brown',7,'Ontario','Toronto',"REGULAR");


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
VALUES( 'Nova-Scotia' ),( 'New-Brunswick' ),( 'Manitoba' ),
('British-Columbia'),
('Prince-Edward-Island'),
('Saskatchewan'),
('Alberta'),
('Newfoundland-and-Labrador'),
('Northwest-Territories'),
('Yukon'),
('Nunavut');


INSERT INTO City VALUES('Montreal','Quebec');
INSERT INTO City VALUES('Quebec City','Quebec');
INSERT INTO City VALUES('Toronto','Ontario');

INSERT INTO City VALUES('Ottowa','Ontario');

INSERT INTO City(city_name, province_name)
VALUES('Edmonton','Alberta'),('Winnipeg','Manitoba'),('Victoria','British-Columbia'),
('Kelowna','British-Columbia'),
('Moncton','New-Brunswick'),
('Saint John','New-Brunswick'),
('Fredericton','New-Brunswick'),
('Labrador City','Newfoundland-and-Labrador'),
('Corner Brook','Newfoundland-and-Labrador'),
('Gander','Newfoundland-and-Labrador'),
('Fort Simpson','Northwest-Territories'),
('Yellowknife','Northwest-Territories'),
('Inuvik','Northwest-Territories'),
('Halifax','Nova-Scotia'),
('Sydney','Nova-Scotia'),
('Truro','Nova-Scotia'),
('Iqaluit','Nunavut'),
('Baker Lane','Nunavut'),
('Rankin Inlet','Nunavut'),
('Charlottetown','Prince-Edward-Island'),
('Summerside','Prince-Edward-Island'),
('Montague','Prince-Edward-Island'),
('Regina','Saskatchewan'),
('Saskatoon','Saskatchewan'),
('Moose Jaw','Saskatchewan'),
('Whitehorse','Yukon'),
('Dawson City','Yukon'),
('Watson Lake','Yukon');




/*  *****************************************  */
/*  *****************************************  */
/*  *****************************************  */
/*  *****************************************  */
/*  *****************************************  */



CREATE TABLE Category (
    CategoryName varchar(50) PRIMARY KEY NOT NULL
);


CREATE TABLE SubCategory (
    SubCategoryName varchar(50) PRIMARY KEY NOT NULL,
    CategoryName varchar(50) NOT NULL
);


INSERT INTO Category VALUES ('BuyAndSell');
INSERT INTO Category VALUES ('Services');
INSERT INTO Category VALUES ('Rent');
INSERT INTO Category VALUES ('Pets');


INSERT INTO SubCategory VALUES ('Clothing','BuyAndSell');
INSERT INTO SubCategory VALUES ('Books','BuyAndSell');
INSERT INTO SubCategory VALUES ('Electronics','BuyAndSell');
INSERT INTO SubCategory VALUES ('Musical Instruments','BuyAndSell');

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
    Price float NOT NULL,
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
    Promotion int NOT NULL DEFAULT 0,
    Rating int NOT NULL DEFAULT 0,
    Deleted varchar(1) NOT NULL DEFAULT 'F',
    Img    varchar(500) NOT NULL DEFAULT ""
);


INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',25,"ONLINE", "Owner",
"Selling Dog Toys","Hey guys, Im selling these dog toys! Thanks!", "Somewhere 5525",
'Pets','Accessories','Quebec','Montreal','2017-12-03','F',0,0,,'F',"");


INSERT INTO Ad VALUES(0,'admin','something@gmail.com','514-235-2352',25,"ONLINE", "Owner",
"Selling Some cat food","Please buy it, it's haunted", "Somewhere 5525",
'Pets','Accessories','Quebec','Montreal','2017-11-20','F',14,0,'F',"");

INSERT INTO Ad VALUES(0,'admin','something@gmail.com','514-235-2352',25,"ONLINE", "Owner",
"Selling Some cat food","Please buy it, it's haunted", "Somewhere 5525",
'Pets','Accessories','Quebec','Montreal','2017-11-20','F',14,0,'F',"");

INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',40,"ONLINE", "Owner",
"Cowboy Boots","They have never been used", "Somewhere 5525",
'BuyAndSell','Clothing','Quebec','Montreal','2017-12-04','F',0,0,'F',"");


INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',26.5,"ONLINE", "Owner",
"Cowboy Hat","Authentic Swade", "Somewhere 5525",
'BuyAndSell','Clothing','Quebec','Montreal','2017-12-04','F',0,0,'F',"");

INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',40,"ONLINE", "Owner",
"Cowboy Boots","They have never been used", "Somewhere 5525",
'BuyAndSell','Clothing','Quebec','Montreal','2017-12-04','F',0,0,'F',"");


INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',15,"ONLINE", "Owner",
"Cowboy Belt","leather brand new", "Somewhere 5525",
'BuyAndSell','Clothing','Quebec','Montreal','2017-12-04','F',0,0,'F',"");

INSERT INTO Ad VALUES(0,'nick','something@gmail.com','514-235-2352',15,"ONLINE", "Owner",
"winter jacket for sale","it's really good!", "Somewhere 5525",
'BuyAndSell','Clothing','Quebec','Montreal','2017-12-04','F',0,0,'F',"");


CREATE TABLE Physicalstore (
    PSID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    status varchar(50) NOT NULL DEFAULT "PENDING",
    weekType varchar(50) NOT NULL,
    strategicLocation varchar(50) NOT NULL,
    totalCost float NOT NULL,
    delivery float NOT NULL,
    startTime int NOT NULL,
    endTime int NOT NULL,
    date Date,
    tempID int NOT NULL
);

/*
QUERIES

The following reports must be supported by the OCN system:
1. Give a list of user(s) who have posted the highest number of ads in each category.


SELECT DISTINCT(t1.Category), t1.Username, t1.Total FROM (SELECT u.Username, a.Category, COUNT(a.Id) as Total FROM User u, Ad a WHERE u.Username = a.Username GROUP BY a.Category, a.Username) as t1 GROUP BY Category HAVING MAX(Total);

2. Give the details of the items posted within the last 10 days in buying/selling category.

SELECT * FROM Ad WHERE DATE_ADD(Posted, INTERVAL 10 DAY) >= CURDATE() AND Category = 'BuyAndSell';

3. Fetch the information of the users from the “Quebec” province selling winter men’s
jacket.

SELECT DISTINCT u.Username, u.* FROM User u, Ad a WHERE a.Username = u.Username AND u.Province = "Quebec" and a.Title like '%winter%';

4. Give a list of all the items in the Rent category.

SELECT * FROM Ad WHERE Category = 'Rent';

5. Generate one report for all categories that indicates the sellers whose items, sold in a
given city, have the highest average rating for all items posted in that category and in the
specified city.

SELECT Username, Category, AVG(Rating) FROM Ad WHERE Sold = 'T' GROUP BY Username, Category;

6. For a given physical store manager, generate a report that indicates the daily revenue and
the total number of transactions “online payments” of each physical store belonging to
the manager for the past 15 days.
7. Is it profitable for a seller to rent store in SL-1 or SL-4 on weekends or weekdays.
8. Generate a report that indicates all different types of items sold by each physical store
located in a given province.

5

9. For a given seller, generate a report that indicates the amount they have to pay for
delivery services per day for the coming 7 days, and the total amount they have paid per
day for the past 7 days.
10. Create a report of your choice that you see needed by every user type of the OCN system.
The report should generate significant information/data for each one of the OCN system
user types: admin, seller, buyer/regular user, store manager. This means that you need to
generate at least four extra reports to satisfy the need of these types of users.


*/


/* Need Ad -> images table */
/* Sorting by Promotion */ /* DONE */
/* Province/city setting on main page? */
/* change membership */ /* also goes to purchase page */

/* View ad page */
/* User: buy */  /* payment page, (rate after) */
/* User: Delete / edit / add promotion  */
/* store payment details in new table */


/* admin reports */
/* admin view all */




