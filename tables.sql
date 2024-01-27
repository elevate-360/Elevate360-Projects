CREATE TABLE tblUser (
    userId int primary key AUTO_INCREMENT,
    userFirstName varchar(128) not null,
    userLastName varchar(128) not null,
    userEmail varchar(512) not null,
    userContactNumber char(10) not null,
    userPassword varchar(128) not null,
    userImage varchar(512) not null,
    userRole char(1) not null,
    isActive char(1) not null default '0'
);
CREATE TABLE tblBruteforce (
    bfId int primary key AUTO_INCREMENT,
    bfUserId int,
    bfIP varchar(39) not null,
    bfCount int not null default 0,
    bfBrowserInfo varchar(128) not null,
    bfOperatingSystem varchar(128) not null,
    bfDeviceType varchar(128) not null,
    bfTime datetime not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    FOREIGN KEY (bfUserId) REFERENCES tblUser(userId)
);
CREATE TABLE tblMails (
    mailId int primary key AUTO_INCREMENT,
    mailBy int not null,
    mailTo text not null,
    mailToName varchar(512) not null,
    mailSubject varchar(128) not null,
    mailContent text not null,
    mailDate datetime not null default CURRENT_TIMESTAMP,
    FOREIGN KEY (mailBy) REFERENCES tblUser(userId)
);
CREATE TABLE tblAttempts (
    atpId int primary key AUTO_INCREMENT,
    atpProjectName varchar(256) not null,
    atpPlatform char(1) not null,
    atpTechnology char(1) not null,
    atpProjectAmount decimal(10, 2) not null,
    atpContactType char(1) not null,
    atpStatus char(1) not null,
    atpDate datetime not null default CURRENT_TIMESTAMP,
    atpUser int not null,
    FOREIGN KEY (atpUser) REFERENCES tblUser(userId)
);
CREATE TABLE tblPlatforms (
    pltId int primary key AUTO_INCREMENT,
    pltName varchar(128) not null,
    pltLogin varchar(512) not null,
    pltPassword varchar(64) not null
);
