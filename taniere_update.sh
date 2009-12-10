#!/bin/sh

#wget "http://sp.mountyhall.com/SP_GrandesTanieres.php?Numero=57256&Motdepasse=02d4502b3a62f04e4355f7aacf1bbd1d" -O /tmp/taniere.txt && \
./convert.pl /tmp/taniere.txt > taniere.txt && \ 
mysqlimport --user=taniere \
            --password=WUPhtBLPszNeZsMA \
            --host=127.0.0.1 \
            --compress \
            --fields-terminated-by=";" \
            --lines-terminated-by="\n" \
            --local \
            --delete \
            --verbose \
            taniere \
            ./taniere.txt

