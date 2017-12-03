create table Station   (
                        S_ID        integer unique,
                        S_name      varchar(20) primary key,
                        S_city      varchar(20) not null
                        );

create table Train      (
                          Tr_ID      varchar(8) primary key,
                          Tr_SStation varchar(20) not null,
                          Tr_TStation varchar(20) not null,
                          Tr_departtime time not null,
                          Tr_arrivetime time not null,
                          foreign key (Tr_SStation) references Station(S_name),
                          foreign key (Tr_TStation) references Station(S_name)
                        );



create table Administrator (
                            Ad_name     varchar(20) primary key,
                            Ad_password varchar(20) not null
                            );

create table Login_User (
                            U_name      varchar(20) not null,
                            U_ID        char(18) primary key,
                            U_phonenum  char(11) unique,
                            U_cardID    char(16) not null, 
                            U_logname   varchar(20) not null,  
                            U_password  varchar(20) not null
                            );

create table Via_Station   (
                            V_TID       varchar(8) not null,
                            V_order     integer not null,
                            V_Station       varchar(20) not null,
                            V_TTime     time not null,
                            V_STime     time not null,
                            V_hard_price     decimal(15,2) not null,
                            V_soft_price     decimal(15,2) not null,
                            V_hard_up_price     decimal(15,2) not null,
                            V_hard_mid_price     decimal(15,2) not null,
                            V_hard_dw_price     decimal(15,2) not null,
                            V_soft_up_price     decimal(15,2) not null,
                            V_soft_dw_price     decimal(15,2) not null,
                            foreign key (V_TID) references Train(Tr_ID),
                            foreign key (V_Station) references Station(S_name),
                            primary key(V_TID, V_Station)
                            );



create table Tickets  (
                      Ti_TrID       varchar(8) not null,
                      Ti_Sorder     integer not null,
                      Ti_Torder     integer not null,
                      Ti_SStation   varchar(20) not null,
                      Ti_TStation   varchar(20) not null,
                      Ti_SeatType   varchar(20) not null,
                      Ti_price      decimal(15,2) not null,
                      Ti_quantity   integer not null,
                      Ti_SDate      date not null,
                      Ti_TDate      date not null,
                      primary key (Ti_TrID, Ti_TStation, Ti_SStation, Ti_SeatType, Ti_SDate),
                      foreign key (Ti_TrID) references Train(Tr_ID),
                      foreign key (Ti_SStation) references Station(S_name),
                      foreign key (Ti_TStation) references Station(S_name)
                      );


create table User_Order    (
                      O_ID            char(18) primary key,
                      O_TID           varchar(8) not null,
                      O_SStation      varchar(20) not null,
                      O_TStation      varchar(20) not null,
                      O_seattype      varchar(20) not null,
                      O_price         decimal(15,2) not null,
                      O_STime         time not null,
                      O_SDate         date not null,
                      O_TTime         time not null,
                      O_TDate         date not null,
                      O_UID           char(18) not null,
                      O_status        varchar(20) not null,
                      foreign key (O_UID) references Login_User(U_ID),
                      foreign key (O_TID) references Train(Tr_ID),
                      foreign key (O_SStation) references Station(S_name),
                      foreign key (O_TStation) references Station(S_name)
                      );