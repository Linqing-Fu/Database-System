####################################################
##3
####################################################
insert into Login_User (U_name, U_ID, U_phonenum, U_cardID, U_logname, U_password)
values (username, ID, phonenum, cardID, logname, password);

eg:
insert into Login_User (U_name, U_ID, U_phonenum, U_cardID, U_logname, U_password)
values ('Lynn', '410303100012345678', '13938836839', '123456789123456', 'qing', '970927');

insert into Login_User (U_name, U_ID, U_phonenum, U_cardID, U_logname, U_password)
values ('陈二花', '110102190012120000', '15611111111', '123456789123457', 'ying', 'hahaha');

#login
select count(*) 
from Login_User
where Login_User.U_logname = logname and Login_User.U_password = password;

eg:
select count(*) 
from Login_User
where Login_User.U_logname = 'ying' and Login_User.U_password = 'hahahad';

##################################################
##4
###################################################
select  Via_Station.V_order, Via_Station.V_Station,  Via_Station.V_TTime, Via_Station.V_STime,
		Via_Station.V_hard_price, 
		Via_Station.V_soft_price, 
		Via_Station.V_hard_up_price, 
		Via_Station.V_hard_mid_price, 
		Via_Station.V_hard_dw_price,
		Via_Station.V_soft_up_price, 
		Via_Station.V_soft_dw_price
from Via_Station
where 
	Via_Station.V_TID = trainid 
order by Via_Station.V_order asc;

eg:
select  Via_Station.V_order, Via_Station.V_Station,  Via_Station.V_TTime, Via_Station.V_STime,
		Via_Station.V_hard_price, 
		Via_Station.V_soft_price, 
		Via_Station.V_hard_up_price, 
		Via_Station.V_hard_mid_price, 
		Via_Station.V_hard_dw_price,
		Via_Station.V_soft_up_price, 
		Via_Station.V_soft_dw_price
from Via_Station
where 
	Via_Station.V_TID = 'K544'
order by Via_Station.V_order asc;

eg:
select  Via_Station.V_order, Via_Station.V_Station,  Via_Station.V_TTime, Via_Station.V_STime,
		Via_Station.V_hard_price, 
		Via_Station.V_soft_price, 
		Via_Station.V_hard_up_price, 
		Via_Station.V_hard_mid_price, 
		Via_Station.V_hard_dw_price,
		Via_Station.V_soft_up_price, 
		Via_Station.V_soft_dw_price
from Via_Station
where 
	Via_Station.V_TID = 'C2211'
order by Via_Station.V_order asc;

select  Via_Station.V_order, Via_Station.V_Station,  Via_Station.V_TTime, Via_Station.V_STime,
		Via_Station.V_hard_price, 
		Via_Station.V_soft_price, 
		Via_Station.V_hard_up_price, 
		Via_Station.V_hard_mid_price, 
		Via_Station.V_hard_dw_price,
		Via_Station.V_soft_up_price, 
		Via_Station.V_soft_dw_price
from Via_Station
where 
	Via_Station.V_TID = 'G22'
order by Via_Station.V_order asc;


#tickets left
select Tickets.Ti_TrID, Tickets.Ti_SeatType, Tickets.Ti_quantity
from Train, Tickets
where
	Train.Tr_ID = trainid and
	Tickets.Ti_TrID = Train.Tr_ID and 
	Tickets.Ti_SStation = Train.Tr_SStation and Tickets.Ti_TStation = Train.Tr_TStation and
	Tickets.Ti_SDate = departdate and 
	(Tickets.Ti_SeatType = 'hardseat' or Tickets.Ti_SeatType = 'softseat' or
	Tickets.Ti_SeatType = 'hardbedu' or Tickets.Ti_SeatType = 'hardbedm' or
	Tickets.Ti_SeatType = 'hardbedd' or Tickets.Ti_SeatType = 'softbedu' or
	Tickets.Ti_SeatType = 'softbedd');

eg:
select Tickets.Ti_TrID, Tickets.Ti_SeatType, Tickets.Ti_quantity
from Train, Tickets
where
	Train.Tr_ID = '1148' and
	Tickets.Ti_TrID = Train.Tr_ID and 
	Tickets.Ti_SStation = Train.Tr_SStation and Tickets.Ti_TStation = Train.Tr_TStation and
	Tickets.Ti_SDate = '2017-12-01' and 
	(Tickets.Ti_SeatType = 'hardseat' or Tickets.Ti_SeatType = 'softseat' or
	Tickets.Ti_SeatType = 'hardbedu' or Tickets.Ti_SeatType = 'hardbedm' or
	Tickets.Ti_SeatType = 'hardbedd' or Tickets.Ti_SeatType = 'softbedu' or
	Tickets.Ti_SeatType = 'softbedd');
eg:
select Tickets.Ti_TrID, Tickets.Ti_SeatType, Tickets.Ti_quantity
from Train, Tickets
where
	Train.Tr_ID = 'K544' and
	Tickets.Ti_TrID = Train.Tr_ID and 
	Tickets.Ti_SStation = Train.Tr_SStation and Tickets.Ti_TStation = Train.Tr_TStation and
	Tickets.Ti_SDate = '2017-12-02' and 
	(Tickets.Ti_SeatType = 'hardseat' or Tickets.Ti_SeatType = 'softseat' or
	Tickets.Ti_SeatType = 'hardbedu' or Tickets.Ti_SeatType = 'hardbedm' or
	Tickets.Ti_SeatType = 'hardbedd' or Tickets.Ti_SeatType = 'softbedu' or
	Tickets.Ti_SeatType = 'softbedd');

####################################################
##5
####################################################
#through
select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
		Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price
from Tickets, Station as S1, Station as S2, Via_Station as V1, Via_Station as V2
where S1.S_city = departcity and S2.S_city = arrivecity and 
	Tickets.Ti_SStation = S1.S_name and Tickets.Ti_TStation = S2.S_name and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
	Tickets.Ti_SDate = departdate and V1.V_STime >= departtime and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	Tickets.Ti_quantity > 0 
order by Tickets.Ti_price asc
limit 10;

eg:
select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
		Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price
from Tickets, Station as S1, Station as S2, Via_Station as V1, Via_Station as V2
where S1.S_city = '北京' and S2.S_city = '天津' and 
	Tickets.Ti_SStation = S1.S_name and Tickets.Ti_TStation = S2.S_name and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
	Tickets.Ti_SDate = '2017-12-01' and V1.V_STime >= '00:00' and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	Tickets.Ti_quantity > 0 
order by Tickets.Ti_price asc
limit 10;

select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
		Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price
from Tickets, Station as S1, Station as S2, Via_Station as V1, Via_Station as V2
where S1.S_city = '北京' and S2.S_city = '洛阳' and 
	Tickets.Ti_SStation = S1.S_name and Tickets.Ti_TStation = S2.S_name and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
	Tickets.Ti_SDate = '2017-12-01' and V1.V_STime >= '00:00' and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	Tickets.Ti_quantity > 0 
order by Tickets.Ti_price asc
limit 10;


#transfer
select T1.Ti_TrID, T1.Ti_SStation, T1.Ti_TStation, T1.Ti_SDate, V1.V_STime, T1.Ti_TDate, V2.V_TTime,
		T1.Ti_SeatType, T1.Ti_quantity, T1.Ti_price,

		T2.Ti_TrID, T2.Ti_SStation, T2.Ti_TStation, T2.Ti_SDate, V3.V_STime, T2.Ti_TDate, V4.V_TTime,
		T2.Ti_SeatType, T2.Ti_quantity, T2.Ti_price,
		(T1.Ti_price + T2.Ti_price) as pricesum 

from Tickets as T1, Tickets as T2,
	Station as S1, Station as S2, Station as S3, Station as S4,
	Via_Station as V1, Via_Station as V2, Via_Station as V3, Via_Station as V4

where S1.S_city = departcity and S4.S_city = arrivecity and 
	T1.Ti_SDate = departdate and V1.V_STime >= '00:00' and
	
	T1.Ti_TrID = V1.V_TID and T1.Ti_TrID = V2.V_TID and
	T2.Ti_TrID = V3.V_TID and T2.Ti_TrID = V4.V_TID and
	T1.Ti_SStation = S1.S_name and T1.Ti_TStation = S2.S_name and
	T2.Ti_SStation = S3.S_name and T2.Ti_TStation = S4.S_name and
	
	S2.S_city = S3.S_city and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	V3.V_Station = S3.S_name and V4.V_Station = S4.S_name and
	T1.Ti_quantity > 0 and 
	T2.Ti_quantity > 0 and 


	((T2.Ti_SDate = T1.Ti_TDate and V3.V_STime - V2.V_TTime <= '04:00:00' and
	      (S2.S_ID  = S3.S_ID and V3.V_STime - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime - V2.V_TTime >= '02:00:00'))

	or

	(T2.Ti_SDate > T1.Ti_TDate and  V3.V_STime < V2.V_TTime and V3.V_STime - V2.V_TTime <= '04:00:00'  and
		  (S2.S_ID  = S3.S_ID and V3.V_STime  - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime  - V2.V_TTime >= '02:00:00')))
order by pricesum asc
limit 10;


eg:
######  50s
select T1.Ti_TrID, T1.Ti_SStation, T1.Ti_TStation, T1.Ti_SDate, V1.V_STime, T1.Ti_TDate, V2.V_TTime,
		T1.Ti_SeatType, T1.Ti_quantity, T1.Ti_price,

		T2.Ti_TrID, T2.Ti_SStation, T2.Ti_TStation, T2.Ti_SDate, V3.V_STime, T2.Ti_TDate, V4.V_TTime,
		T2.Ti_SeatType, T2.Ti_quantity, T2.Ti_price,
		(T1.Ti_price + T2.Ti_price) as pricesum 

from Tickets as T1, Tickets as T2,
	Station as S1, Station as S2, Station as S3, Station as S4,
	Via_Station as V1, Via_Station as V2, Via_Station as V3, Via_Station as V4

where S1.S_city = '北京' and S4.S_city = '成都' and 
	T1.Ti_SDate = '2017-12-01' and V1.V_STime >= '00:00' and
	
	T1.Ti_TrID = V1.V_TID and T1.Ti_TrID = V2.V_TID and
	T2.Ti_TrID = V3.V_TID and T2.Ti_TrID = V4.V_TID and
	T1.Ti_SStation = S1.S_name and T1.Ti_TStation = S2.S_name and
	T2.Ti_SStation = S3.S_name and T2.Ti_TStation = S4.S_name and
	
	S2.S_city = S3.S_city and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	V3.V_Station = S3.S_name and V4.V_Station = S4.S_name and
	T1.Ti_quantity > 0 and 
	T2.Ti_quantity > 0 and 


	((T2.Ti_SDate = T1.Ti_TDate and V3.V_STime - V2.V_TTime <= '04:00:00' and
	      (S2.S_ID  = S3.S_ID and V3.V_STime - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime - V2.V_TTime >= '02:00:00'))

	or

	(T2.Ti_SDate > T1.Ti_TDate and  V3.V_STime < V2.V_TTime and (('23:59:59' - V2.V_TTime) + V3.V_STime <= '04:00:00' ) and
		  (S2.S_ID  = S3.S_ID and V3.V_STime  - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime  - V2.V_TTime >= '02:00:00')))
order by pricesum asc
limit 10;


##################################################################
###6
##################################################################
you need to convert departcity and arrivecity
default departdate should be changed to the nextday of T2.Ti_TDate

select Tickets.Ti_TrID, Tickets.Ti_SStation, Tickets.Ti_TStation, V1.V_STime, V2.V_TTime,
		Tickets.Ti_SeatType, Tickets.Ti_quantity, Tickets.Ti_price
from Tickets, Station as S1, Station as S2, Via_Station as V1, Via_Station as V2
where S1.S_city = departcity and S2.S_city = arrivecity and 
	Tickets.Ti_SStation = S1.S_name and Tickets.Ti_TStation = S2.S_name and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SStation = V1.V_Station and Tickets.Ti_TStation = V2.V_Station and
	Tickets.Ti_SDate = departdate and V1.V_STime >= departtime and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	Tickets.Ti_quantity > 0 
order by Tickets.Ti_price asc
limit 10;

#transfer
select T1.Ti_TrID, T1.Ti_SStation, T1.Ti_TStation, T1.Ti_SDate, V1.V_STime, T1.Ti_TDate, V2.V_TTime,
		T1.Ti_SeatType, T1.Ti_quantity, T1.Ti_price,

		T2.Ti_TrID, T2.Ti_SStation, T2.Ti_TStation, T2.Ti_SDate, V3.V_STime, T2.Ti_TDate, V4.V_TTime,
		T2.Ti_SeatType, T2.Ti_quantity, T2.Ti_price,
		(T1.Ti_price + T2.Ti_price) as pricesum 

from Tickets as T1, Tickets as T2,
	Station as S1, Station as S2, Station as S3, Station as S4,
	Via_Station as V1, Via_Station as V2, Via_Station as V3, Via_Station as V4

where S1.S_city = departcity and S4.S_city = arrivecity and 
	T1.Ti_SDate = departdate and V1.V_STime >= '00:00' and
	
	T1.Ti_TrID = V1.V_TID and T1.Ti_TrID = V2.V_TID and
	T2.Ti_TrID = V3.V_TID and T2.Ti_TrID = V4.V_TID and
	T1.Ti_SStation = S1.S_name and T1.Ti_TStation = S2.S_name and
	T2.Ti_SStation = S3.S_name and T2.Ti_TStation = S4.S_name and
	
	S2.S_city = S3.S_city and
	V1.V_Station = S1.S_name and V2.V_Station = S2.S_name and
	V3.V_Station = S3.S_name and V4.V_Station = S4.S_name and
	T1.Ti_quantity > 0 and 
	T2.Ti_quantity > 0 and 


	((T2.Ti_SDate = T1.Ti_TDate and V3.V_STime - V2.V_TTime <= '04:00:00' and
	      (S2.S_ID  = S3.S_ID and V3.V_STime - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime - V2.V_TTime >= '02:00:00'))

	or

	(T2.Ti_SDate > T1.Ti_TDate and  V3.V_STime < V2.V_TTime and V3.V_STime - V2.V_TTime <= '04:00:00'  and
		  (S2.S_ID  = S3.S_ID and V3.V_STime  - V2.V_TTime >= '01:00:00'
		or S2.S_ID != S3.S_ID and V3.V_STime  - V2.V_TTime >= '02:00:00')))
order by pricesum asc
limit 10;



##################################################################
##7
##################################################################
#since we come to this page from #5, we should already know the following information:
#TrID, departing stop ID(dstopID), arriving stop(astopID), and seattype(*2) and date
#need to add two totalprice 
select Tickets.Ti_TrID, Tickets.Ti_Sorder, Tickets.Ti_Torder, Tickets.Ti_SDate, V1.V_STime, Tickets.Ti_SStation, 
		Tickets.Ti_TDate, V2.V_TTime, Tickets.Ti_TStation, 
		Tickets.Ti_SeatType, Tickets.Ti_price, Tickets.Ti_price + 5 as totalprice

from Tickets, Via_Station as V1, Via_Station as V2

where Tickets.Ti_TrID = trainid and Tickets.Ti_SeatType = seattype and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SeatType = seattype and
	Tickets.Ti_SDate = departdate and
	Tickets.Ti_SStation = dstop and Tickets.Ti_TStation = astop and
	V1.V_Station = Tickets.Ti_SStation and V2.V_Station = Tickets.Ti_TStation;

eg:
select Tickets.Ti_TrID, Tickets.Ti_Sorder, Tickets.Ti_Torder, Tickets.Ti_SDate, V1.V_STime, Tickets.Ti_SStation, 
		Tickets.Ti_TDate, V2.V_TTime, Tickets.Ti_TStation, 
		Tickets.Ti_SeatType, Tickets.Ti_price, Tickets.Ti_price + 5 as totalprice

from Tickets, Via_Station as V1, Via_Station as V2

where Tickets.Ti_TrID = 'C2211' and Tickets.Ti_SeatType = 'hardseat' and
	Tickets.Ti_TrID = V1.V_TID and Tickets.Ti_TrID = V2.V_TID and
	Tickets.Ti_SeatType = 'hardseat' and
	Tickets.Ti_SDate = '2017-12-05' and
	Tickets.Ti_SStation = '北京南' and Tickets.Ti_TStation = '天津' and
	V1.V_Station = Tickets.Ti_SStation and V2.V_Station = Tickets.Ti_TStation;


#if click on 'confirm'
#insert the order
#orderID may be a random string of 18 or just +1 each time
#stime, sdate, ttime and tdate should be copied from the table above
insert into User_Order
values (orderID, TrID, dstop, astop, seattype, totalprice, stime, sdate, ttime, tdate, uid, 'confirmed');

eg:
insert into User_Order
values ('423456789','K544','西宁','重庆北','hardbedu',222, '13:49:00', '2017-12-02', '12:50:00', '2017-12-03', '410303100012345678', 'confirmed');
eg:
insert into User_Order
values ('023456780','C2211','北京南','天津','hardseat',38.5, '10:16:00', '2017-12-05', '10:57:00', '2017-12-05', '110102190012120000', 'confirmed');

#change the remain quantity of tickets
update Tickets
set Ti_quantity = Ti_quantity - 1
where 
	Tickets.Ti_TrID = trainid and 
	(Tickets.Ti_Sorder <= 
	(select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = trainid and Tickets.Ti_SStation = dstop and Tickets.Ti_TStation = astop) 

	or Tickets.Ti_Torder >= 
	(select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = trainid and Tickets.Ti_SStation = dstop and Tickets.Ti_TStation = astop)) and
	Tickets.Ti_SeatType = seattype and Tickets.Ti_SDate = departdate;

eg:
update Tickets
set Ti_quantity = Ti_quantity - 1
where 
	Tickets.Ti_TrID = 'K544' and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = 'K544' and Tickets.Ti_SStation = '西宁' and Tickets.Ti_TStation = '重庆北') 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = 'K544' and Tickets.Ti_SStation = '西宁' and Tickets.Ti_TStation = '重庆北')) and
	Tickets.Ti_SeatType = 'hardbedu' and Tickets.Ti_SDate = '2017-12-02';
eg:
update Tickets
set Ti_quantity = Ti_quantity - 1
where 
	Tickets.Ti_TrID = 'C2211' and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = 'C2211' and Tickets.Ti_SStation = '北京南' and Tickets.Ti_TStation = '天津') 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = 'C2211' and Tickets.Ti_SStation = '北京南' and Tickets.Ti_TStation = '天津')) and
	Tickets.Ti_SeatType = 'hardseat' and Tickets.Ti_SDate = '2017-12-05';


#################################################################
###8
#################################################################
#input startdate, enddate
select User_Order.O_ID, User_Order.O_SDate, User_Order.O_SStation, User_Order.O_TStation, User_Order.O_seattype, User_Order.O_price, User_Order.O_status
from User_Order, Station
where User_Order.O_UID = uid and User_Order.O_SDate >= startdate and User_Order.O_SDate <= enddate;

eg:
select User_Order.O_ID, User_Order.O_SDate, User_Order.O_SStation, User_Order.O_TStation, User_Order.O_seattype, User_Order.O_price, User_Order.O_status
from User_Order
where User_Order.O_UID = '410303100012345678' and User_Order.O_SDate >= '2017-12-01' and User_Order.O_SDate <= '2017-12-05';

#############################################################
#if click on 'cancel'
#update order
#we should already know the O_ID(orderID)
############################################################
update User_Order
set O_status = 'canceled'
where O_ID = orderid;

eg:
update User_Order
set O_status = 'canceled'
where O_ID = '123456789';
#update ticket
#condition in 'where' is decided according to primary key of tickets
update Tickets
set Ti_quantity = Ti_quantity + 1
where 
	Tickets.Ti_TrID = trainid and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = trainid and Tickets.Ti_SStation = dstop and Tickets.Ti_TStation = astop) 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = trainid and Tickets.Ti_SStation = dstop and Tickets.Ti_TStation = astop)) and
	Tickets.Ti_SeatType = seattype and Tickets.Ti_SDate = departdate;

eg:
update Tickets
set Ti_quantity = Ti_quantity + 1
where 
	Tickets.Ti_TrID = 'K544' and 
	(Tickets.Ti_Sorder <= (select min(Tickets.Ti_Torder) from Tickets where Tickets.Ti_TrID = 'K544' and Tickets.Ti_SStation = '西宁' and Tickets.Ti_TStation = '重庆北') 

	or Tickets.Ti_Torder >= (select min(Tickets.Ti_Sorder) from Tickets where Tickets.Ti_TrID = 'K544' and Tickets.Ti_SStation = '西宁' and Tickets.Ti_TStation = '重庆北')) and
	Tickets.Ti_SeatType = 'hardbedu' and Tickets.Ti_SDate = '2017-12-02';



#9
select count(*)
from User_Order
where O_status = 'confirmed';

select sum(O_price) 
from User_Order
where O_status = 'confirmed';

select User_Order.O_TID, count(*) as Num
from User_Order
where O_status = 'confirmed'
group by O_TID
order by Num desc;

select Login_User.U_name, Login_User.U_logname
from Login_User;

select Login_User.U_name, User_Order.O_ID, User_Order.O_SDate, User_Order.O_SStation,
	   User_Order.O_TStation, User_Order.O_price, User_Order.O_status
from Login_User, User_Order
where
	Login_User.U_name = username and
	Login_User.U_ID = User_Order.O_UID;

eg:
select Login_User.U_name, User_Order.O_ID, User_Order.O_SDate, User_Order.O_SStation, User_Order.O_TStation, User_Order.O_price, User_Order.O_status
from Login_User, User_Order
where
	Login_User.U_name = '陈二花' and
	Login_User.U_ID = User_Order.O_UID;