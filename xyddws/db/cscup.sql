/**
 * Filename: cscup.sql
 * Author: LiuXintong
 * Date: 2013-9-21
 * Descriprion:  
 * Modify: import to MySQL
 *  None
 */

create table user  (
  uid int unsigned not null auto_increment primary key,
  uname varchar(20) not null,
  upassword char(40) not null,
  uemail varchar(100) not null,
  ucreated timestamp,
  ulogged timestamp,
  ugroup char(10) default 'user',
  ugrade int,
  udescription text,
  uconfirm int,
  uhead varchar(100)
);

create table post (
  pid int unsigned not null auto_increment primary key,
  uid int unsigned not null,
  ptitle varchar(50),
  pdetail text,
  pcreated timestamp,
  ptype char(10),
  pallowc int,
  phint int
);

create table comment (
  cid int unsigned not null auto_increment primary key,
  pid int unsigned not null,
  uid int unsigned not null,
  ccreated timestamp,
  cdetail text
);

