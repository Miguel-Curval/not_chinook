

PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL
/*******************************************************************************
   Drop Tables
********************************************************************************/

DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Department;

/*******************************************************************************
   Create Tables
********************************************************************************/


CREATE TABLE Department (
    name TEXT PRIMARY KEY
);

CREATE TABLE User (
    id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT CHECK(role IN ('client','agent','admin')) NOT NULL DEFAULT 'client',
    departmentName TEXT REFERENCES Department(name)
);

CREATE TABLE Ticket (
    id INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    status TEXT CHECK(status IN ('open','assigned','closed')) NOT NULL DEFAULT 'open',
    idCreator INTEGER REFERENCES User(id) NOT NULL,
    idAssigned INTEGER REFERENCES User(id),
    departmentName TEXT REFERENCES Department(name),
    priority INTEGER
);

CREATE TABLE Hashtag (
    hashtag TEXT NOT NULL,
    idTicket INTEGER REFERENCES Ticket(id),
    PRIMARY KEY (hashtag, idTicket)
);

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL,
    idCreator INTEGER REFERENCES User(id) NOT NULL,
    idTicket INTEGER REFERENCES Ticket(id) NOT NULL
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/


/*******************************************************************************
   Populate Tables
********************************************************************************/

INSERT INTO Department (name) VALUES ('IT');
INSERT INTO User (username, name, email, password, role, departmentName) VALUES ('mike', 'Miguel', 'mike@gmail.com', 'a17fed27eaa842282862ff7c1b9c8395a26ac320', 'client', 'IT'); /* pass is "mike" */
INSERT INTO User (username, name, email, password, role, departmentName) VALUES ('mary', 'mary', 'mary@gmail.com', '5665331b9b819ac358165f8c38970dc8c7ddb47d', 'client', 'IT'); /* pass is "mary" */
INSERT INTO User (username, name, email, password, role, departmentName) VALUES ('john', 'Agent John', 'john@gmail.com', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', 'agent', 'IT'); /* pass is "john" */
INSERT INTO Ticket (title, idCreator, idAssigned, departmentName, priority) VALUES ('My laptop keeps restarting', 1, 3, 'IT', 1);
INSERT INTO Ticket (title, idCreator, idAssigned, departmentName, priority) VALUES ('My software is malfunctioning', 2, 3, 'IT', 1);
INSERT INTO Comment (content, idCreator, idTicket) VALUES ('help please', 1, 1);
