psql -d train -f delete_table.sql
psql -d train -f create_table.sql
psql -d train -f /home/dbms/train/data/table_station.sql
psql -d train -f /home/dbms/train/data/table_Train.sql
psql -d train -f /home/dbms/train/data/table_via_station.sql
psql -d train -f /home/dbms/train/data/table_tickets.sql
