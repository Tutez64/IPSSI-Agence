CREATE TABLE Vehicle (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   brand VARCHAR(25),
   model VARCHAR(25),
   number VARCHAR(25) UNIQUE,
   daily_price DECIMAL(7,2),
   type VARCHAR(25),
   is_available BOOL DEFAULT TRUE,
   photo VARCHAR(50)
) ENGINE = InnoDB;

CREATE TABLE Person (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   civility VARCHAR(25),
   first_name VARCHAR(25),
   last_name VARCHAR(25),
   login VARCHAR(25) UNIQUE,
   email VARCHAR(50) UNIQUE,
   role VARCHAR(15) DEFAULT 'Customer',
   signup_date DATETIME DEFAULT NOW(),
   phone_number VARCHAR(20) UNIQUE,
   password VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE Comment (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   content TEXT,
   date DATETIME DEFAULT NOW(),
   note INT,
   vehicle INT NOT NULL,
   person INT NOT NULL,
   FOREIGN KEY(vehicle) REFERENCES Vehicle(id),
   FOREIGN KEY(person) REFERENCES Person(id)
) ENGINE = InnoDB;

CREATE TABLE Reservation (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   date DATETIME DEFAULT NOW(),
   start DATE,
   end DATE,
   vehicle INT NOT NULL,
   person INT NOT NULL,
   FOREIGN KEY(vehicle) REFERENCES Vehicle(id),
   FOREIGN KEY(person) REFERENCES Person(id)
) ENGINE = InnoDB;
