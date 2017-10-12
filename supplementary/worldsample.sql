/**
 * sqlstart/worldsample.sql
 * @package MVCnA
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */

drop database if exists worldsample;
create database worldsample;
use worldsample;

drop table if exists country;
create table country (
  code char(3) not null default '',
  name varchar(52) default null,
  continent enum('asia','europe','north america','africa',
                 'oceania','antarctica','south america') 
                    not null default 'asia',
  region varchar(26) default null,
  surfacearea float(10,2) not null default '0.00',
  indepyear smallint default null,
  population int not null default '0',
  lifeexpectancy float(3,1) default null,
  gnp float(10,2) default null,
  gnpold float(10,2) default null,
  localname varchar(45) default null,
  governmentform char(45) not null default '',
  headofstate varchar(60) default null,
  capital int default null,
  code2 char(2) not null default '',
  primary key (code)
);

drop table if exists countrylanguage;
create table countrylanguage (
  countrycode char(3) not null default '',
  language char(30) not null default '',
  isofficial enum('t','f') not null default 'f',
  percentage float(4,1) not null default '0.0',
  primary key (countrycode,language),
  foreign key (countrycode) references country (code)
);

drop table if exists city;
create table city (
  id int not null auto_increment,
  name varchar(35) default null,
  countrycode char(3) not null default '',
  district varchar(20) default null,
  population int not null default '0',
  primary key (id),
  foreign key (countrycode) references country (code)
);

drop table if exists user;
create table user (
  uid varchar(8) not null primary key,
  password blob not null,
  activated boolean not null default false
);

insert into country values ('DNK','Denmark','Europe','Nordic Countries',43094.00,800,5330000,76.5,174099.00,169264.00,'Danmark','Constitutional Monarchy','Margrethe II',3315,'DK');

insert into city values (3315, 'København', 'DNK', 'Udkantsdanmark Ø', 500000);
insert into city values (3316, 'Aarhus', 'DNK', 'Region Midt', 300000);
insert into city values (3317, 'Odense', 'DNK', 'Region Syd', 180000);

insert into countrylanguage values ('DNK','Danish', 't', 98.1);
insert into countrylanguage values ('DNK','Swedish', 'f', 1.1);

insert into user values('anybody', '$2y$10$9tkG3R7unLcTQn2MAjLYROp9WwsAnMfjzlq.brGVppPhuKf5u240i', false);
insert into user values('somebody', '$2y$10$6S035zYRuq2wDcQXpdlBcOpQO1snuok9DvLUL8co5uegU6vl52xy2', true);

-- the application as used in DbP:
create user nobody@localhost identified by 'test';
grant all on worldsample.* to nobody@localhost;