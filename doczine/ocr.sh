#!/bin/sh
STARTPAGE=1 # set to pagenumber of the first page of PDF you wish to convert
ENDPAGE=4 # set to pagenumber of the last page of PDF you wish to convert
SOURCE=/var/www/bigdata/1/1366986470_f1ab29ad18/9781905893096.pdf # set to the file name of the PDF
OUTPUT=/var/www/bigdata/1/1366986470_f1ab29ad18/9781905893096asdf.txt # set to the final output file
RESOLUTION=600 # set to the resolution the scanner used (the higher, the better)

touch $OUTPUT
for i in `seq $STARTPAGE $ENDPAGE`; do
    convert -monochrome -density $RESOLUTION $SOURCE\[$(($i - 1 ))\] page.tif
    echo processing page $i
    tesseract page.tif tempoutput
    cat tempoutput.txt >> $OUTPUT
done