#!/usr/bin/php
<?php
/* License: free for private and commercial use
   This code is free to use and modify as long as this comment stays untouched on top and one exception.
   URL of original source: http://google-rank-checker.squabbel.com
   Author of original source: justone@squabbel.com
   This tool should be completely legal but in any case you may not sue or seek compensation from the original Author for any damages or legal issues the use may cause.
   By using this source code you agree NOT to increase the request rates beyond the IP management function limitations, this would only harm our common cause.
   Exception:
   Public redistributing modifications of this source code project is not allowed without written agreement. Contact me by email if you are unsure.
   Using this work for private and commercial projects is allowed, redistributing it is not allowed.
   The reason behind this is that my website shall stay the primary location for this source.

   If you need customization of this source code you are welcome to contact me justone@squabbel.com
   Some possible extensions:
   * database integration with in/out queue for synchronous/asynchronous full automated script interaction
   * increasing available functionality, adding different search modes, different resultset parsing
   * modification into a scheduled script with custom data retrieval/placement
   * modification into a background service
 */
 
require "functions.php";
require "scaperdb.php";

error_reporting(E_ALL); 

$conn = db_connect_100_scraper();
$query = "SELECT name FROM `seoterm` WHERE `searched` IS NULL limit 1";
echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name);
    while (mysqli_stmt_fetch($stmt)) {
    
    echo $name;

    }
    mysqli_stmt_close($stmt);
}

$mysqltime = date("Y-m-d H:i:s");

$query = "UPDATE `scraper`.`seoterm` SET `searched` = 'Y' WHERE `seoterm`.`name` = '".$name."';";
echo $query;
if ($stmt = mysqli_prepare($conn, $query)) {
	mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$mysqltime = date("Y-m-d H:i:s");

$query = "UPDATE `scraper`.`seoterm` SET `datesearched` = '".$mysqltime."' WHERE `seoterm`.`name` = '".$name."';";
echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
	mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);


// ************************* Configuration variables *************************
// Your seo-proxies api credentials
$pwd="13563c809622af330d9acfc5b854b77f";            // Your www.seo-proxies.com API password
$uid=6755;                                   // Your www.seo-proxies.com API userid

// General configuration
$test_website_url="";						// The URL, or a sub-string of it, of the indexed website. you can use a domain/hostname as well but including http:// is recommended to avoid false positives (like http://alexa.com/siteinfo/domain) !
$search_string = $name." filetype:pdf";	// comma separated keywords to test the rank for
$search_string = urlencode($search_string);
$test_max_pages=1;														 	// The number of result pages to test until giving up per keyword. Each page contains up to 100 results or 10 results when using Google Instant
$test_100_resultpage=100;													// Warning: Google ranking results will become inaccurate! Set to 1 to receive 100 instead of 10 results and reduce the amount of proxies required. Mainly useful for scraping relevant websites.
//$test_safe_search="medium";										// {right now not supported by the script}. Google safe search configuration. Possible choices: off, medium (default), high  

/* Local result configuration. Enter 'help' to receive a list of possible choices. use global and en for the default worldwide results in english 
 * You need to define a country as well as the language. Visit the Google domain of the specific country to see the available languages.
 * Only a correct combination of country and language will return the correct search engine result pages. */
$test_country="US";
$country_data="US";													// Country code. "global" is default. Use "help" to receive a list of available codes. [com,us,uk,fr,de,...]
$test_language="en";													 	// Language code. "EN" is default Use "help" to receive a list. Visit the local Google domain to find available langauges of that domain. [en,fr,de,...]
$filter=1; 																			// 0 for no filter (recommended for maximizing content), 1 for normal filter (recommended for accuracy)
$force_cache=0;																	// set this to 1 if you wish to force the loading of cache files, even if the files are older than 24 hours. Set to -1 if you wish to force a new scrape.
$load_all_ranks=1;															/* set this to 0 if you wish to stop scraping once the $test_website_url has been found in the search engine results,
																								 * if set to 1 all $test_max_pages will be downloaded. This might be useful for more detailed ranking analysis.*/
$portal="int"; // int or us (must match your settings, int is default)
$show_html=0;																	 	// 1 means: output formated with HTML tags. 0 means output for console (recommended script usage)
$show_all_ranks=1;															// set to 1 to display a complete list of all ranks per keyword, set to 0 to only display the ranks for the specified website
// ***************************************************************************
$working_dir="wd_rank_checker";

/*Description:
 * This is a working and full featured Google Rank Checker
 * Tis script can and should be use as a base for own developments and customizations but it is also useful as standalone tool
 * Knowing your website rank for important keywords and watching how it changes related to website changes or competition is essential, this tool can be a great help on that.
 * There are websites that might do the same for you but they are unreliable and often produce wrong results, this tool puts that power into your own hands.
 * Traffic estimation: 450kb per 100 results
 *Features:
 *  + seo-proxies.com API support - getting reliable results from Google can be a pain and most proxies are not well suited for this, seo-proxies makes it easy
 *  + local country result feature (default is the main english google result set) (read more in last notes)
 *  + multipage DOM parsing - this tool is an advanced project, it can test for more than one result page and will interpret the results like a real browser (DOM)
 *  + correct proxy management - built in IP management, the tool will use and manage IPs in an optimal way to avoid blocks, wrong results and similar issues
 *  + multi-keyword support - test for more than one keyword
 *  + local cache (file based) to prevent unrequired serp lookups (resolution is one lookup per keyword-page per day)
 *Requirements:
 *  + local write rights to create the working directory and store files in it (script will create directory and files automated)
 *  + Remove timeout for console scripts (when run on console)
 *  + Based on usage consider increasing max memory for console scripts (when run on console)
 *
 *Possible upgrades and ideas:
 *  + Multi-threading support can easily be added. delay_time() and the proxy API need adaption (&offset=n) for custom seo-proxies licenses with parallel proxy support.
 *  + Database support for ranking results is recommended for professional usage, this would easily allow a ranking history.
 *  + When used in production environments, emailing support should be added so any warnings or aborts result in an emergency email to the project manager
 *  
 *
 *Last notes: 
 * DONATE if you like the source or information so I can keep working and updating.
 * The recommended source of IPs is the built in seo-proxies.com service. It is of course possible to modify the source code and change the proxy support.
 * But this can result in accuracy/gray+blocklist troubles and even legal issues with Google, it is not recommended to change the proxy source or the IP management functions without advanced scraping experience.
 * From time to time Google changes parts of the design, sometimes this can cause parsing issues. The website will try to always stay up to date on such changes.
 *
 * In general it is not recommended to use 100 results per page, this will reduce the amount of proxies required (in best case by 10) but also reduce the 
 * accuracy of the ranking results. It is required to use the '10 results per page' option if ranking results shall be accurate.
 *
 * The country specific results have been verified using geolocated IP addresses and browsers for UK, USA, DE and AT.
 * In this project I'm using the small "google api" from seo-proxies to retrieve country codes and google domains.
 * In my tests it has been found that the Rank checker is able to produce IDENTICAL ranking results when using my seo-proxies.com license.
 * So it is possible to test for local results WITHOUT maintaining expensive proxies or servers in each of the countries.
 * However, I can't guarantee this for all results. But this was true for resultset I've personally tested.
 *
 *
 * The cache files contain a serialized php array. The main reason for this is that Google changes their layout from time to time, storing the raw html content
 * in cache files would require to keep all "old" processing methods to be able to parse the output at a later time.
 * The cache can be cleared by a crontab/scheduler which removes files older than 24 hours (based on unix "find" for example)
 *
 */


$page=0;
$PROXY=array();														// after the rotate api call this variable contains these elements: [address](proxy host),[port](proxy port),[external_ip](the external IP),[ready](0/1)
$LICENSE=array();													// contains details about the seo-proxies.com license used for proper IP management
$results=array();


if ($show_html) $NL="<br>\n"; else $NL="\n";
if ($show_html) $HR="<hr>\n"; else $HR="---------------------------------------------------------------------------------------------------\n";
if ($show_html) $B="<b>"; else $B="!";
if ($show_html) $B_="</b>"; else $B_="!";


/*
 * Start of main()
 */
 
if ($show_html)
{
	echo "<html><body>";
}

$keywords=explode(",",$test_keywords);

$ch=NULL;
$rotate_ip=0; // variable that triggers an IP rotation (normally only during keyword changes)
$max_errors_total=3; // abort script if there are 3 keywords that can not be scraped (something is going wrong and needs to be checked)

$rank_data=array();
$siterank_data=array();
$raw_data=scrape_serp_google($search_string,$page,$country_data); // scrape html from search engine
$array_html = process_raw($raw_data, $page, $search_string);

?>
