create table if not exists records (
  id int(11) auto_increment NOT NULL,
  initDate varchar(20),
  endDate varchar(20),
  duration varchar(15),
  primary key (id)
)engine=InnoDb;