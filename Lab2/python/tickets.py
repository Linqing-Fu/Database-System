
import os
from enum import Enum
import datetime

# sql文件名
current_path = os.getcwd()
sql_file = os.path.join(current_path,'tickets.csv')
sql_file_hd = open(sql_file, 'w')

# 原始文件目录
path = os.path.join(current_path,'train-2016-10')

class SeatType(Enum):
    hardseat = 1
    softseat = 2
    hardbedu = 3
    hardbedm = 4
    hardbedd = 5
    softbedu = 6
    softbedd = 7

zero_time_str = '00:00'
zero_time = datetime.datetime.strptime(zero_time_str, "%H:%M")

sdate_str = '2017-12-01'

# 遍历原始文件目录
for sub_path in os.listdir(path):
    full_sub_path = os.path.join(path, sub_path)  # 拼接出查出来的子目录/文件的绝对路径
    if not os.path.isdir(full_sub_path):
        #  是文件，不是目录，跳到下一个文件/子目录
        continue

    print (full_sub_path)

    # 遍历每一个子目录
    for csv_file in os.listdir(full_sub_path):
        full_csv_file = os.path.join(full_sub_path, csv_file)  # csv文件的绝对路径
        if not os.path.splitext(full_csv_file)[1] == '.csv':
            # 不是csv文件，跳到下一个文件
            continue

        train_id = csv_file.replace('.csv', '')  # sql~trainID

        print (full_csv_file)

        # 文件内容读到列表
        file_hd = open(full_csv_file, 'r')
        lines = file_hd.readlines()
        file_hd.close()

        lines_len = len(lines)

        if lines_len < 3:
            # 文件内容小于3行，则信息不全，跳到下一个文件
            continue
        
        for i in range(1, lines_len-1): #for all start station
            day_on_train = 0
            days_at_stop = 0
            stay_at_stop = 0
            start = lines[i].replace('/',',')
            start_station_array = start.split(',')
            start_time_str = start_station_array[3].strip()
            standard_time = datetime.datetime.strptime(start_time_str, "%H:%M")
            delta1 = standard_time - zero_time
            sorder = start_station_array[0].strip()
            sstation = start_station_array[1].strip()
            for j in range(i+1, lines_len): #for all end station
                end = lines[j].replace('/',',')
                end_station_array = end.split(',')
                torder = end_station_array[0].strip()
                tstation = end_station_array[1].strip()
                quantity = '5'
                end_time_str = end_station_array[2].strip()
                #if end_time_str == '-':
                #    end_time_str = end_station_array[2].strip()
                end_time = datetime.datetime.strptime(end_time_str, "%H:%M")
                delta2 = end_time - zero_time
                print(delta1.seconds)
                print(delta2.seconds)
                if int(torder) < lines_len-1:
                    delta_at_stop = datetime.datetime.strptime(end_station_array[3].strip(),"%H:%M") - zero_time
                    stay_at_stop = (delta_at_stop.seconds < delta2.seconds)
                    if stay_at_stop:
                        days_at_stop = days_at_stop + 1
                        print('passed a day at stop')
                if delta2.seconds < delta1.seconds: #passed a day on the train
                    day_on_train = day_on_train + 1
                    print('passed a day on train')
                start_time_str = end_station_array[3].strip() #update standard
                if start_time_str == '-':
                    start_time_str = end_station_array[2].strip()
                standard_time = datetime.datetime.strptime(start_time_str, "%H:%M")
                delta1 = standard_time - zero_time
                for k in range(1, 8):
                    seattype = str(SeatType(k))[9:]
                    if end_station_array[6+k].strip() == '-':
                        continue
                    end_price = float(end_station_array[6+k].strip())
                    if sorder == '1':
                        start_price = 0.0
                    else:
                        if start_station_array[6+k].strip() == '-':
                            continue
                        else:
                            start_price = float(start_station_array[6+k].strip())
                    price = str(end_price - start_price)
                    if float(price) <= 0:
                        continue
                    for l in range(0, 7):
                        sdate_time = datetime.datetime.strptime(sdate_str, "%Y-%m-%d")
                        sdate_delta = datetime.timedelta(days = l)
                        actual_sdate = sdate_time + sdate_delta
                        sdate = actual_sdate.strftime("%Y-%m-%d")
                        if stay_at_stop:
                            days_du = day_on_train + days_at_stop - 1
                        else:
                            days_du = day_on_train + days_at_stop
                        tsdelta = datetime.timedelta(days = days_du)
                        actual_tdate = actual_sdate + tsdelta
                        tdate = actual_tdate.strftime("%Y-%m-%d")
                        #csv_line = 'INSERT INTO tickets VALUES (\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\');\n' % (train_id, sorder, torder, sstation, tstation, seattype, price, quantity, sdate, tdate)
                        csv_line = '%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n' % (train_id, sorder, torder, sstation, tstation, seattype, price, quantity, sdate, tdate)
                        print (csv_line)

                        # sql写入文件
                        sql_file_hd.write(csv_line)

sql_file_hd.close()
