create database books;

grant select, insert, update, delete, index, alter, create, drop on books.* to 'bookorama'@'localhost' identified by 'bookorama123';
grant select, insert, update, delete, index, alter, create, drop on books.* to 'bookorama'@'127.0.0.1' identified by 'bookorama123';
