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
    customer_message text
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
    foreign key(cate_id) references tbl_category(cate_id)
);


insert into tbl_category(cate_name)
values
('ASUS'),
('Macbook'),
('Dell'),
('HP');

insert into tbl_product(prd_name,prd_price,prd_image,cate_id)
values
('Macbook Air 2022 13.6 inch Apple M2 – 16GB RAM 512GB SSD',700,'macbook.jpg',2),
('Laptop Asus Vivobook M1403QA-LY022W R5 5600H/8GB/512GB',500,'img1.jpg',1),
('Dell XPS 13 Plus 9320 (2022) - I7/32GB/1TB/UHD 4K Touch',550,'laptop-dell.jpg',3),
('Laptop HP Pavilion 15 eg2062TU i3 1215U/8GB/256GB',600,'laptop-hp.jpg',4),
('Macbook Air 2020 i3 8GB 256GB | MWTJ2/ MWTL2/ MWTK2',1900,'img2.jpg',2),
('Laptop Dell Latitude 7390 2in1',450,'laptop-dell2.jpeg',3);


