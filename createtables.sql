-- DB: webdevproj PW: webdev

/* Products Table */
CREATE TABLE products (

    id int(11) NOT NULL,
    nam varchar(255) NOT NULL,
    img varchar(255) NOT NULL,
    price float NOT NULL,
    PRIMARY KEY (id)

);

/* About us table for admin modification */
CREATE TABLE about_us (

    id int(11) NOT NULL,
    about text(6500),
    PRIMARY KEY (id)

);

/* registered users table */
CREATE TABLE users (

    usernum int(11) NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    address text(6500),
    PRIMARY KEY (usernum)

);

/* insertions for default products */
INSERT INTO products (id, nam, price, img) VALUES
(1, 'Spooked Cat', 400.99, 'images/cat1.jpg'),
(2, 'Orange Cat', 129.99, 'images/cat2.jpg'),
(3, 'Black Cat', 299.49, 'images/cat3.jpg'),
(4, 'Kitten', 500.01, 'images/cat4.jpg'),
(5, 'Cat Treats', 19.99, 'images/treats1.png'),
(6, 'Cat Food', 29.99, 'images/catfood1.png');

/* Insertion for default about page */
INSERT INTO about_us (id, about) VALUES
(1, 'This is some sample about us text. Update this with the admin/admin account');

/* insertion of admin account */
INSERT INTO users (usernum, username, password, address) VALUES
(1, 'admin', 'admin', '123 admin blvd');
