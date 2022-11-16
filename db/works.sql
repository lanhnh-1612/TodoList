CREATE TABLE works (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    starting_date DATETIME NOT NULL,
    ending_date DATETIME NOT NULL,
    status ENUM('Planning','Doing','Complete'),
    PRIMARY KEY (id)
)