CREATE TABLE USERS (
UserID       	Int             NOT NULL AUTO_INCREMENT,
UserName		VarChar(25)     NOT NULL,
FirstName     	VarChar(25)     NOT NULL,
LastName    	VarChar(25)     NOT NUll,
Password     	VarChar(1024)   NOT NULL,
PhoneNumber  	Char(12)        NOT NULL,
Email        	VarChar(50)     NOT NULL,
Address 		longtext  	 NOT NULL,
Role           Int             NOT NULL DEFAULT 0,
CONSTRAINT PK_USERS PRIMARY KEY(UserID)
);
ALTER TABLE USERS AUTO_INCREMENT=1;

CREATE TABLE PROPERTY_RENTAL (
PropertyID      Int            NOT NULL AUTO_INCREMENT,
PropertyName    Varchar(50)    NOT NULL,
Address         longtext       NOT NULL,
PictureURL      longtext       NULL,
Price           Int            NOT NULL,
LeaseType       Varchar(25)    NOT NULL,
No_of_Bedrooms  Int            NOT NULL,
No_of_Bathrooms Int            NOT NULL,
Description     longtext		 NULL,
PhoneNumber  	Char(12)        NOT NULL,
UserID          Int            NOT NULL,
CONSTRAINT      PK_PROPERTY_RENTAL PRIMARY KEY(PropertyID),
CONSTRAINT      FK_USER_PROP	FOREIGN KEY(UserID)
REFERENCES USERS(UserID) ON DELETE CASCADE
);
ALTER TABLE PROPERTY_RENTAL AUTO_INCREMENT=10000;


            
CREATE TABLE RATING (
RatingID        Int             NOT NULL AUTO_INCREMENT,                  
Rating          Int(5)          NOT NULL,
Comment         longtext        NULL,
UserName        VarChar(25)     NOT NULL,
RatDate 		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
UserID          Int             NOT NULL,
PropertyID      Int             NOT NULL,
CONSTRAINT      PK_RATING 	    PRIMARY KEY(RatingID),
CONSTRAINT      FK_RATE_USERS	    FOREIGN KEY(UserID) 
REFERENCES USERS(UserID),   
CONSTRAINT      FK_RATE_PROP	   FOREIGN KEY(PropertyID)
REFERENCES PROPERTY_RENTAL(PropertyID) ON DELETE CASCADE
);

ALTER TABLE RATING AUTO_INCREMENT=100000;

CREATE TABLE REQUEST_TOUR (
TourID        Int             NOT NULL AUTO_INCREMENT,                 
TourDate      Date            NOT NULL,
TourMessage       VarChar(25)     NULL,
TourFlag Int NOT NULL DEFAULT 0,
UserID          Int             NOT NULL,
PropertyID    Int             NOT NULL, 
CONSTRAINT    PK_REQUEST_TOUR  PRIMARY KEY(TourID), 
CONSTRAINT      FK_USER_TOUR	    FOREIGN KEY(UserID) 
REFERENCES USERS(UserID) ON DELETE CASCADE,     
CONSTRAINT    FK_PRO_REQ		FOREIGN KEY(PropertyID)
REFERENCES PROPERTY_RENTAL(PropertyID) ON DELETE CASCADE
);
ALTER TABLE REQUEST_TOUR AUTO_INCREMENT=10;

CREATE TABLE  BOOKING (
BookingID     Int             NOT NULL AUTO_INCREMENT,
BookingDate   Date            NOT NULL,
BookingMessage       VarChar(25)     NULL,
BookFlag Int NOT NULL DEFAULT 0,
UserID        Int             NOT NULL,    
PropertyID    Int             NOT NULL ,
CONSTRAINT    PK_BOOKING      PRIMARY KEY(BookingID),
CONSTRAINT    FK_USER_BOOK	FOREIGN KEY(UserID)
REFERENCES USERS(UserID) ON DELETE CASCADE,
	CONSTRAINT    FK_PROP_BOOK	FOREIGN KEY(PropertyID)
REFERENCES PROPERTY_RENTAL(PropertyID) ON DELETE CASCADE
	);     
ALTER TABLE BOOKING AUTO_INCREMENT=1000;


CREATE TABLE USER_TOUR (
TourID        Int             NOT NULL,   
UserID        Int             NOT NULL,
CONSTRAINT    PK_USER_TOUR    PRIMARY KEY (TourID,UserID),
CONSTRAINT    FK_USER_TOUR	  FOREIGN KEY(UserID)
REFERENCES    USERS(UserID)   ON DELETE CASCADE,
CONSTRAINT    FK_TOUR		  FOREIGN KEY(TourID)
REFERENCES REQUEST_TOUR(TourID) ON DELETE CASCADE
);