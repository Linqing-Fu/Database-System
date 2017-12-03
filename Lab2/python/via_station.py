import os

# sql文件名
current_path = os.getcwd()
sql_file = os.path.join(current_path,'via_station.sql')
sql_file_hd = open(sql_file, 'w')

# 原始文件目录
path = os.path.join(current_path,'train-2016-10')

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

        for line in lines:
            via_station_array = line.split(',')
            if via_station_array[0].strip() == '':
                continue
            order = via_station_array[0].strip()  # order
            station = via_station_array[1].strip()
            ttime = via_station_array[2].strip()
            if ttime == '-':
                ttime = '00:00'
            stime = via_station_array[3].strip()
            if stime == '-':
                stime = ttime
            seat_array = via_station_array[7].split('/')
            if order == '1':
                hsprice = '0'
                ssprice = '0'
            else:
                hsprice = seat_array[0].strip()
                ssprice = seat_array[1].strip()
            if hsprice == '-':
                hsprice = '0'
            if ssprice == '-':
                ssprice = '0'
            #print (hsprice)
            #print (ssprice)

            hbed_array = via_station_array[8].split('/')
            if order == '1':
                hbuprice = '0'
                hbmprice = '0'
                hbdprice = '0'
            else:
                hbuprice = hbed_array[0].strip()
                hbmprice = hbed_array[1].strip()
                hbdprice = hbed_array[2].strip()
            if hbuprice == '-':
                hbuprice = '0'
            if hbmprice == '-':
                hbmprice = '0'
            if hbdprice == '-':
                hbdprice = '0'
            #print (hbuprice)
            #print (hbmprice)
            #print (hbdprice)
            sbed_array = via_station_array[9].split('/')
            if order == '1':
                sbuprice = '0'
                sbdprice = '0'
            else:
                sbuprice = sbed_array[0].strip()
                sbdprice = sbed_array[1].strip()
            if sbuprice == '-':
                sbuprice = '0'
            if sbdprice == '-':
                sbdprice = '0'
            #print (sbuprice)
            #print (sbdprice)

            sql = 'INSERT INTO via_station VALUES (\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\');\n' % (train_id, order, station, ttime, stime, hsprice, ssprice, hbuprice, hbmprice, hbdprice, sbuprice, sbdprice)
            #print (sql)

            # sql写入文件
            sql_file_hd.write(sql)

sql_file_hd.close()
