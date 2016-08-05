CREATE TABLE IF NOT EXISTS urlshortner(
id int auto_increment primary key, 
original_url varchar(255) NOT null unique,
short_url varchar(255) NOT null unique,
click_info int not null,
time varchar(255) not null
) ENGINE="INNODB";