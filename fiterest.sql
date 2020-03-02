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
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `image` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_public` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL primary key auto_increment,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL primary key auto_increment,
  `user_id_from` int(10) NOT NULL,
  `user_id_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL primary key auto_increment,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `msg_sub` text NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


alter table posts add foreign key (user_id) references users(user_id);
alter table posts add foreign key (topic_id) references topics(topic_id);
alter table comments add foreign key (user_id) references users(user_id);
alter table comments add foreign key (post_id) references posts(post_id);

