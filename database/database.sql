
/*******************************************************************************
   Drop Tables
********************************************************************************/

DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS TicketHashtag;
DROP TABLE IF EXISTS User;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL
);

CREATE TABLE Department (
    name TEXT PRIMARY KEY
);

CREATE TABLE Hashtag (
    name TEXT PRIMARY KEY
);

CREATE TABLE Ticket (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    status TEXT NOT NULL,
    createdBy TEXT REFERENCES User(username) NOT NULL,
    beingSolvedBy TEXT REFERENCES User(username)
    departmentName TEXT REFERENCES Department(name),
    priority INTEGER,
);

CREATE TABLE TicketHashtag (
    name TEXT REFERENCES Hashtag(name),
    idTicket INTEGER REFERENCES Ticket(id),
    PRIMARY KEY (name, idTicket)
);

CREATE TABLE User (
    username TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    password TEXT NOT NULL,
    email TEXT NOT NULL,
    role TEXT NOT NULL,
    departmentName TEXT REFERENCES Department(Name)
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/


/*******************************************************************************
   Populate Tables
********************************************************************************/


