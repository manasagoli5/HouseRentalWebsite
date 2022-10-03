CREATE TABLE USERS(
	UserID varchar(50) NOT NULL AUTO_INCREMENT=1,
	UserName varchar(25) NOT NULL,
	FirstName varchar(50) default NULL,
	LastName varchar(50) default NULL,
	PhoneNumber char(12), 
	Address longtext default NULL,
	Email varchar(50) default NULL,
	Role int default 0,
	Password varchar(1024) default NULL,
	CONSTRAINT PK_userprofile PRIMARY KEY (userid)
)