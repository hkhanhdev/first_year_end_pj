create schema final_project;
use final_project;
create table tbl_user (
	user_id int(11) primary key auto_increment,
    username varchar(50) not null,
    user_pass varchar(100) not null,
    email varchar(50) not null unique key,
    fullname varchar(100),
    customer_address varchar(255),
    customer_phone int(10) unique key,
    customer_email varchar(50) unique key,
    customer_message text,
    is_accessible int default 1
);
create table tbl_category (
	cate_id int(11) primary key auto_increment,
    cate_name varchar(255)
);


create table tbl_product(
	prd_id int(11) primary key auto_increment,
    prd_name varchar(255) not null,
    prd_price decimal(8,0) not null,
    prd_image varchar(255),
    cate_id int(11) not null,
    prd_ram varchar(255) not null,
    prd_gpu varchar(255) not null,
    prd_resolution varchar(255) not null,
    prd_operating_system varchar(255) not null,
    is_displayed int default 1,
    foreign key(cate_id) references tbl_category(cate_id)
);
    
create table tbl_order (
	ord_id int(11) primary key auto_increment,
    customer_id int(11) not null,
    prd_id int(11),
    ord_amount int(5) not null,
    ord_buy_date DATETIME not null,
    ord_total_price DECIMAL(8,0) not null,
    ord_status varchar(50) not null,
    foreign key(prd_id) references tbl_product(prd_id),
	foreign key(customer_id) references tbl_user(user_id)
);

insert into tbl_category(cate_name)
values
('Asus'),
('Macbook'),
('Dell'),
('HP');

insert into tbl_product(prd_name,prd_price,prd_image,cate_id,prd_ram,prd_gpu ,prd_resolution,prd_operating_system )
values
('Macbook Air Apple M2',700,'macbook.jpg',2,"64GB","M1 Pro Max","2560 x 1600 pixels (2K)","MacOS"),
('Asus Vivobook R5 ',500,'img1.jpg',1,"64GB","NVIDIA GeForce RTX 4090 Ti","1920 x 1080 pixels (FullHD)","Windowns"),
('Dell XPS 13 Plus 9320',550,'laptop-dell.jpg',3,"64GB","NVIDIA GeForce RTX 4090 Ti","1920 x 1080 pixels (FullHD)","Windowns"),
('HP Pavilion 15',600,'laptop-hp.jpg',4,"64GB","NVIDIA GeForce RTX 4090 Ti","1920 x 1080 pixels (FullHD)","Windowns"),
('Macbook Air 2020 i3',1900,'img2.jpg',2,"64GB","M1 Pro Max","2560 x 1600 pixels (2K)","MacOS"),
('Dell Latitude 7390',450,'laptop-dell2.jpeg',3,"64GB","NVIDIA GeForce RTX 4090 Ti","1920 x 1080 pixels (FullHD)","Windowns");


