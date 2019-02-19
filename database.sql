create database if not exists time_records_db;

create table if not exists time_records (
  id int(11) auto_increment NOT NULL,
  title varchar (55) not null,
  initDateTime varchar(20),
  endDateTime varchar(20),
  duration varchar(15),
  primary key (id)
)engine=InnoDb;