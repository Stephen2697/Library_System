/*
AUTHOR NAME: Stephen Alger

DATE OF LAST MAJOR UPDATE: 23-10-2017
VERION IDENTIFIER: 1.0
FILE TYPE: Structured Query Language (.sql)

DOCUMENT SPECIFICATION(s): 
{"NULL"}

CODE DEBUGGED WITH ORACLE LIVE SQL - 'https://livesql.oracle.com'
*/


/*Create new table: USERS*/
CREATE TABLE USERS
(
	userName VARCHAR(32) NOT NULL ,
	userPassword VARCHAR(6) NOT NULL ,
	firstName VARCHAR(64) NOT NULL ,
    secondName VARCHAR(64) NOT NULL ,
    addressLine1 VARCHAR(128) NOT NULL ,
    addressLine2 VARCHAR(128) NOT NULL ,
    cityName VARCHAR(64) NOT NULL ,
    telephone VARCHAR(10) NOT NULL ,
    mobilePhone VARCHAR(10) NOT NULL ,
    
    CONSTRAINT USERS_PK PRIMARY KEY (userName),
    CONSTRAINT MOBILE_UNIQUE_CK UNIQUE (mobilePhone),
    CONSTRAINT TELEPHONE_UNIQUE_CK UNIQUE (telephone)

);

/*Create new table: CATEGORIES*/
CREATE TABLE CATEGORIES
(
    categoryID VARCHAR(3) NOT NULL ,
    categoryDescription VARCHAR(32) NOT NULL ,
    
    CONSTRAINT CATEGORIES_PK PRIMARY KEY (categoryID)

);

/*Create new table: BOOKS*/
CREATE TABLE BOOKS
(
    ISBN VARCHAR(13) NOT NULL ,
    bookTitle VARCHAR(64) NOT NULL ,
    authorName VARCHAR(64) NOT NULL ,
    editionVersion INTEGER(1) NOT NULL ,
    editionYear YEAR NOT NULL ,
    categoryID VARCHAR(3) NOT NULL ,
    reservationStatus VARCHAR(1) NOT NULL ,
    
    CONSTRAINT BOOKS_PK PRIMARY KEY (ISBN),
    CONSTRAINT BOOKS_CATEGORIES_FK FOREIGN KEY (categoryID) REFERENCES CATEGORIES(categoryID)

);

/*Create new table: RESERVATIONS*/
CREATE TABLE RESERVATIONS
(
    ISBN VARCHAR(13) NOT NULL ,
    userName VARCHAR(32) NOT NULL ,
    reservationDate DATE NOT NULL,
    
    CONSTRAINT BOOKS_CATEGORIES_ISBN_FK FOREIGN KEY (ISBN) REFERENCES BOOKS(ISBN),
    CONSTRAINT BOOKS_CATEGORIES_USERNAME_FK FOREIGN KEY (userName) REFERENCES USERS(userName),
    CONSTRAINT RESERVATIONS_PK PRIMARY KEY (ISBN)
    

);

/*Insert Data into Users Table
//Format: INSERT INTO USERS VALUES (UN, PW, FN, SN, AD1, AD2, CN, T,MP);*/
INSERT INTO USERS VALUES ('alanjmckenna', 't1234s', 'Alan', 'McKenna', '38 Cranley Road', 'Fairview', 'Dublin', '9998377','0856625567');
INSERT INTO USERS VALUES ('joecrotty', 'kj7899', 'Joseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', '8887889','0876654456');
INSERT INTO USERS VALUES ('tommy100', '123456', 'tom', 'behan', '14 hyde road', 'dalkey', 'dublin', '9983747','0876738782');

/*Insert Data into Category Table
//Format: INSERT INTO CATEGORIES VALUES (CATID, CATDESC);*/
INSERT INTO CATEGORIES VALUES ('001', 'Health');
INSERT INTO CATEGORIES VALUES ('002', 'Business');
INSERT INTO CATEGORIES VALUES ('003', 'Biography');
INSERT INTO CATEGORIES VALUES ('004', 'Technology');
INSERT INTO CATEGORIES VALUES ('005', 'Travel');
INSERT INTO CATEGORIES VALUES ('006', 'Self-Help');
INSERT INTO CATEGORIES VALUES ('007', 'Cookery');
INSERT INTO CATEGORIES VALUES ('008', 'Fiction');

/*Insert Data into Books Table
//Format: INSERT INTO BOOKS VALUES (ISBN, BT, AUT, ED, YR, CATID, RES);*/
INSERT INTO BOOKS VALUES ('093-403992', 'Computers In Business', 'Alicia Oneill', 3, '1997', '003', 'N');
INSERT INTO BOOKS VALUES ('23472-8729', 'Exploring Peru', 'Stephanie Birch', 4, '2005', '005', 'N');
INSERT INTO BOOKS VALUES ('237-34823', 'Business Strategy', 'Jeff Peppard', 2, '2002', '002', 'N');
INSERT INTO BOOKS VALUES ('23U8-923849', 'A guide to nutrition', 'John Thorpe', 2, '1997', '001', 'N');
INSERT INTO BOOKS VALUES ('2983-3494', 'Cooking for children', 'Anabelle Sharpe', 1, '2003', '007', 'N');
INSERT INTO BOOKS VALUES ('82N8-308', 'computers for idiots', 'Susan Oneill', 5, '1998', '004', 'N');
INSERT INTO BOOKS VALUES ('9823-23984', 'My life in picture', 'Kevin Graham', 8, '2004', '001', 'N');
INSERT INTO BOOKS VALUES ('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, '2003', '008', 'N');
INSERT INTO BOOKS VALUES ('98234-029384', 'My ranch in Texas', 'George Bush', 1, '2005', '001', 'Y');
INSERT INTO BOOKS VALUES ('9823-98345', 'How to cook Italian food', 'Jamie Oliver', 2, '2005', '007', 'Y');
INSERT INTO BOOKS VALUES ('9823-98487', 'Optimising your business', 'Cleo Blair', 1, '2001', '002', 'N');
INSERT INTO BOOKS VALUES ('988745-234', 'Tara Road', 'Maeve Binchy', 4, '2002', '008', 'N');
INSERT INTO BOOKS VALUES ('993-004-00', 'My Life in Bits', 'John Smith', 1, '2001', '001', 'N');
INSERT INTO BOOKS VALUES ('9987-0039882', 'Shooting History', 'Jon Snow', 1, '2003', '001', 'N');

/*Insert Data into Reservations Table
//Format: INSERT INTO RESERVATIONS VALUES (ISBN, UN , RESDATE);*/
INSERT INTO RESERVATIONS VALUES ('98234-029384', 'joecrotty', '11-Oct-2008');
INSERT INTO RESERVATIONS VALUES ('9823-98345', 'tommy100', '11-Oct-2008');
