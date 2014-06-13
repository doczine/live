#!/bin/bash

q=$(echo "$1" | sed 's/ /%20/g')
tmp=tmp.txt

echo "" > $tmp
for suffix in {a..z}
do
    curl -s "http://www.google.com/s?sugexp=pfwl&cp=15&q=$q%20$suffix" | sed 's/\[/\n\[/g' | cut -d'"' -f2 | tail -n +4 >> $tmp
    curl -s "http://t1-completion.amazon.com/search/complete?method=completion&q=$q%20$suffix&search-alias=aps&client=amazon-search-ui&mkt=1&x=updateISSCompletion&sc=1" | sed 's/,\[{".*//g;s/,/\n/g' | cut -d'"' -f2 | grep -v '\[\|\]\|\{\|\]' | tail -n +3 >> $tmp
    curl -s "http://sugg.us.search.yahoo.net/gossip-us-ura?droprotated=1&output=sd1&command=$q%20$suffix&nresults=10" | sed 's/{/\n{/g' | grep '"k"' | cut -d'"' -f4 >> $tmp
    # this way uses our keyword as a suffix rather than prefix. usually there are some duplicates with the first method but those are removed later.
    curl -s "http://sugg.us.search.yahoo.net/gossip-us-ura?droprotated=0&output=sd1&command=$q%20$suffix&nresults=10" | sed 's/{/\n{/g' | grep '"k"' | cut -d'"' -f4 >> $tmp
    curl -s "http://api.bing.com/qsonhs.aspx?FORM=ASAPIW&mkt=en-US&type=cb&cb=sa_inst.apiCB&q=$q%20$suffix&cp=13&bq=$q" | sed 's/{/\n{/g' | grep '"Txt"' | cut -d'"' -f4 >> $tmp
    curl -s "http://blekko.com/autocomplete?query=$q" | sed 's/.*\[//g;s/\].*//g;s/","/\n/g;s/"//g' >> $tmp
    echo >> $tmp
done

sed '/^$/d' $tmp | sort | uniq
