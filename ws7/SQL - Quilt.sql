CREATE TABLE Quilt (
    QuiltID INT AUTO_INCREMENT PRIMARY KEY,
    Size VARCHAR(255),
    Area FLOAT,
    Story TEXT,
    ForSale BOOLEAN
);

CREATE TABLE Photograph (
    PhotoID INT AUTO_INCREMENT PRIMARY KEY,
    QuiltID INT,
    PhotoURL VARCHAR(255),
    Description TEXT,
    FOREIGN KEY (QuiltID) REFERENCES Quilt(QuiltID)
);

CREATE TABLE Maker (
    MakerID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Email VARCHAR(255),
    WebsiteURL VARCHAR(255),
    Story TEXT
);

CREATE TABLE QuiltMaker (
    QuiltID INT,
    MakerID INT,
    PRIMARY KEY (QuiltID, MakerID),
    FOREIGN KEY (QuiltID) REFERENCES Quilt(QuiltID),
    FOREIGN KEY (MakerID) REFERENCES Maker(MakerID)
);

CREATE TABLE Member (
    MemberID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Email VARCHAR(255)
);

CREATE TABLE Comment (
    CommentID INT AUTO_INCREMENT PRIMARY KEY,
    QuiltID INT,
    MemberID INT,
    Content TEXT,
    CommentDate DATETIME,
    Language VARCHAR(255),
    FOREIGN KEY (QuiltID) REFERENCES Quilt(QuiltID),
    FOREIGN KEY (MemberID) REFERENCES Member(MemberID)
);





