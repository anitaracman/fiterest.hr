drop database if exists fiterest;
create database fiterest default character set utf8;
use fiterest;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL primary key auto_increment,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_b_day` date NOT NULL,
  `user_image` text NOT NULL,
  `register_date` date NOT NULL,
  `status` text NOT NULL,
  `posts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create table operater(
sifra       int not null primary key auto_increment,
email       varchar(50) not null,
lozinka     char(60) not null,
ime         varchar(50) not null,
prezime     varchar(50) not null,
uloga       varchar(20) not null
);
insert into operater values 
(null,'edunova@edunova.hr',
'$2y$10$Gon3gm9JXPxiyWn574J2tuuxm16VspDxiyl.zt3eDOIo9qegHznFC',
'Edunova','Operater','oper');
insert into operater values 
(null,'admin@edunova.hr',
'$2y$10$Gon3gm9JXPxiyWn574J2tuuxm16VspDxiyl.zt3eDOIo9qegHznFC',
'Edunova','Administrator','admin');

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL primary key auto_increment,
  `topic_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL primary key auto_increment,
 
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `image` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_public` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;








alter table posts add foreign key (topic_id) references topics(topic_id);

