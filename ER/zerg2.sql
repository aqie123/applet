CREATE DATABASE IF NOT EXISTS zerg DEFAULT CHARSET utf8;
use zerg;
drop table if exists banner;
create table banner(
  id int(11) not null auto_increment,
  name varchar(50) default null  comment 'banner名称,用作标识',
  description varchar(255) default null comment 'banner描述',
  delete_time int(11) default null,
  update_time int(11) default null,
  primary key (`id`)
)engine=innodb default charset=utf8 comment="banner管理表";
insert into banner values ('1','首页置顶','首页轮播图',null,null);

drop table if exists banner_item;
create table banner_item(
  id int(11) not null auto_increment,
  img_id int(11) not null comment '外键,关联image表',
  key_word varchar(100) not null comment '执行关键字，根据不停type含义不同',
  type tinyint(4) not null default '1' comment '跳转类型，商品详情页或者商品列表',
  delete_time int(11) default null,
  banner_id int(11) not null comment '外键,关联banner表',
  update_time int(11) default null,
  primary key (`id`)
)engine=innodb default charset=utf8 comment="banner详情表";
insert into banner_item values('1','65','6','1',null,'1',null);
insert into banner_item values('2','2','25','1',null,'1',null);
insert into banner_item values('3','3','6','1',null,'1',null);
insert into banner_item values('4','4','6','1',null,'1',null);