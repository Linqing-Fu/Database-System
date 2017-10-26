for q in `seq 1 22`; do
      DSS_QUERY=/home/dbms/Lab1/TPCH/tpch-gen/queries /home/dbms/Lab1/TPCH/tpch-gen/qgen -d -s 0.01 $q > pg-queries/$q.sql
    done
