
/*******************************************************************************
   Drop Tables
********************************************************************************/

DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS User;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL,
    idCreator INTEGER REFERENCES User(id) NOT NULL,
    idTicket INTEGER REFERENCES Ticket(id) NOT NULL
);

CREATE TABLE Department (
    name TEXT PRIMARY KEY
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

CREATE TABLE User (
    id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT CHECK(role IN ('client','agent','admin')) NOT NULL DEFAULT 'client',
    idDepartment INTEGER REFERENCES Department(id)
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/


/*******************************************************************************
   Populate Tables
********************************************************************************/

INSERT INTO User (username, name, email, password) VALUES ('mike', 'Miguel', 'm@m.com', 'a17fed27eaa842282862ff7c1b9c8395a26ac320');
INSERT INTO Ticket (title, idCreator) VALUES ('It does not #justwerk', 1);
INSERT INTO Comment (content, idCreator, idTicket) VALUES ('halp plz', 1, 1);
