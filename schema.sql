CREATE TABLE users (
    id int auto_increment primary key,
    name varchar(150) not null,
    email varchar(150) unique not null,
    password varchar(150) not null
)

CREATE TABLE auditorium (
    id int auto_increment primary key,
    date datetime not null,
    idUser int not null,
    state boolean not null,
    foreign key(idUser) references users(id) on delete cascade on update cascade
)

CREATE TABLE account (
    id int auto_increment primary key,
    idUser int not null,
    agency int not null,
    accountNumber int not null,
    money float default 50.00,
    foreign key(idUser) references users(id) on delete cascade on update cascade
)

CREATE TABLE levy (
    id int auto_increment primary key,
    money float not null,
    idUser int not null,
    typePayment int default null,
    status boolean default true,
    foreign key(idUser) references users(id) on delete cascade on update cascade
)

CREATE TABLE applique (
    id int auto_increment primary key,
    idUser int not null,
    money float not null,
    appliqueDate datetime default now(),
    foreign key(idUser) references users(id) on delete cascade on update cascade
)