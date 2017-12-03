#####################Deal with data

1. copy primary data folder(train-2016-10) to curren path.

2. python3 train.py

3. python3 via_station.py

4. python3 tickets.py
   Better divide the data to several folder, or the csv file may be too big.
   It may cause the database halting. 

5. copy the generated Tickets data to ~/train/data/data_csv
6. copy the Train and via_station data to ~/train/data

#first time open v_box
#remember to put the whole document in ~/
$ sudo su
$ su postgres
$ psql -U postgres
ALTER USER dbms WITH PASSWORD 'dbms';
\q

#login
$ psql -d dbms -U dbms -W
#input password:
dbms

#now we are in user: dbms
#we need to create a database
create database train;


#quit
\q

#############################################
#use shell to insert data
#remember to put the whole document in ~/
#connect database need password:dbms
#you need to input password all the time
#############################################
./shell.sh



###############################################
##### if you need connect database in psql:
###############################################

#connect database
\c database

#delete table
drop table xxx;

#list table
\dt

#list database
\l

#quit
\q
