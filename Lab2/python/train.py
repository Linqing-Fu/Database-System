#!/usr/bin/env python
# -*- coding:utf8 -*-
# Filename: Train.py

import os

# sql文件名
current_path = os.getcwd()
sql_file = os.path.join(current_path,'train.sql')
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

        start_station_array = lines[1].split(',')  # 起点站信息，分割为列表
        end_station_array = lines[lines_len - 1].split(',')  # 终点站信息，分割为列表

        s1 = start_station_array[1].strip()  # 起点站
        s2 = start_station_array[3].strip()  # 起点站时间
        s3 = end_station_array[1].strip()  # 终点站
        s4 = end_station_array[2].strip()  # 终点站时间

        # 拼接SQL语句，这里没有做转义，希望车站名称里面没有'，"，\
        sql = 'INSERT INTO Train VALUES (\'%s\',\'%s\',\'%s\',\'%s\',\'%s\');\n' % (train_id, s1, s3, s2, s4)
        #print (sql)

        # sql写入文件
        sql_file_hd.write(sql)

sql_file_hd.close()
