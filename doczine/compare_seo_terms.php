<?php

include('db.php');
include('search_output.php');
include('search_functions.php');
require('/usr/local/www/apache22/data/mod/apache-solr-3.3.0/SolrPhpClient/Apache/Solr/Service.php');


function pp($arr){
    $retStr = '<ul>';
    if (is_array($arr)){
        foreach ($arr as $key=>$val){
            if (is_array($val)){
                $retStr .= '<li>' . $key . ' => ' . pp($val) . '</li>';
            }else{
                $retStr .= '<li>' . $key . ' => ' . $val . '</li>';
            }
        }
    }
    $retStr .= '</ul>';
    return $retStr;
}


/*
$i = 0;
do {
    $i++;
    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);

    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);

    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);	

} while ($i < 100000);
//test
*/ 

function multiexplode ($delimiters,$string) {
    $ary = explode($delimiters[0],$string);
    array_shift($delimiters);
    if($delimiters != NULL) {
        foreach($ary as $key => $val) {
             $ary[$key] = multiexplode($delimiters, $val);
        }
    }
    return  $ary;
}

$query = "Senior Systems Administrator
Operations | San Mateo, CA, United States
Share:
Copy Link:
 Marketo is a leader in cloud software and are growing like crazy.  We are delighting our customers and hiring some of the best minds in Silicon Valley. Our headquarters is located in San Mateo, California and we continue to expand globally. We offer competitive salaries, great benefits, and a high-energy environment with lots of room for personal and professional growth.

This critical member of Marketo’s Operations team will be responsible for maintaining the production systems and applications for a fast-growing Marketing Automation SaaS company. A bright, enthusiastic, flexible, energetic, and results-driven professional who works best in a multi skilled team, sometimes during non-core business hours, is the perfect candidate for this important position
 
Responsibilities:

The Senior Systems Administrator will work as part of a high-caliber team of experienced Systems Administrators, Network Administrators, DBAs, and Application Administrators to ensure uptime, availability, and performance SLAs are met in an environment that is constantly evolving and expanding.
Duties include:
 

    Exploring new technologies to improve efficiency and maximize performance
    Establishing operations policies and procedures for production Installing, configuring, and maintaining production systems and and SaaS applications
    Building and tools, scripts, and operating procedures for continuous efficiency improvement
    Fault detection, isolation, resolution, and root cause analysis
    Deploying new releases and patches to test and production environments
    Evaluating commercial and open-source tools to improve efficiency
    Performance analysis and optimization
    Capacity planning
    Script and procedure development

Required Skills/ Experience:

    Expert knowledge of Linux systems administration
    Managing LAMP servers in a Highly-Available, 24x7 production environment (8-10 years)
    Experienced with hosting and scaling Java application servers (Tomcat, JBoss, etc) in a highly available and high throughput environment
    Implementing and supporting management tools
    Expert-level scripting skills using Unix scripting toolkits (bash, sed, awk, etc)
    MySQL 5.x scripting and maintenance
    Demonstrated knowledge of systems and infrastructure security
    Operational experience supporting large, high-volume sites, ideally at a major SaaS company
    Demonstrated experience working with monitoring and analytics tools (e.g. Nagios, Cacti, Splunk)
    Working knowledge of deployment and distribution automation tools (YUM, Puppet, RPM, etc)
    BS degree in a technical discipline (Computer Science or Computer Engineering is preferred).  MS preferred.

Nice-to-haves:

    Storage administration experience, especially with Network Appliance filers
    MySQL database administration experience
    Virtual systems build and management utilizing VMware, KVM, Xen, etc.

 About Marketo
 
Marketo provides easy-to-use, powerful and complete marketing software that propels fast-growing small companies and global enterprises, turning marketing from a cost center into a revenue driver.  Marketo’s marketing automation and sales effectiveness software – including the world’s first integrated solution for social marketing automation – helps thousands of companies around the world streamline marketing processes, deliver more campaigns, generate more win-ready leads, and dramatically improve sales performance.

 
Marketo is an Equal Opportunity Employer";


$matches = array();
$matches = preg_split("/[\s,]+/", $query);
//$t = preg_match('/ \ /s', $query, $matches);




$query = "Rumen Telbizov

Senior Unix Systems Administrator

a: Burnaby, British Columbia, Canada
e: telbizov@gmail.com
w: http://telbizov.com
i: http://linkedin.com/in/rumentelbizov

Technical Skills
OS
Networking

Daemons

Programming

Databases
Storage

FreeBSD; Linux: Debian/Ubuntu, Gentoo, RedHat/CentOS
TCP/IP, IP Routing, BGP, RIP, Firewalls (ipfw, ipf, iptables, pf), NAT, CARP, Load balancing, Traffic shaping, Cisco
administration, HP Procurve, VLANs, STP, HTTP, SSL, SSH, DNS, RADIUS, SMTP, POP3, IMAP, FTP, TFTP, SIP, IAX2,
DHCP, NFS, SMB, SNMP, IPMI
Apache (mod_perl, mod_ssl, mod_proxy, mod_security), Nginx, MySQL, proftpd, OpenSSH, Qmail, vpopmail, Courier IMAP,
Dovecot, Exim, Asterisk PBX, HAproxy, djbdns, BIND, IceCast MP3 Streaming Server, Cacti, RRDTool, Nagios, Trac,
OpenVPN, Heartbeat, LVS, Puppet
Python + Django, C, C++, Perl/mod_perl, bash, HTML5, CSS3, JavaScript, jQuery, NodeJS, Meteor, Underscore.js,
Handlebars.js, Bootstrap, less. Forked, threaded, iterative highly efficient daemons. Sockets programming (blocking, nonblocking, libevent, gevent). Application debugging and troubleshooting on code and system level: strace, ltrace, truss, lsof,
tcpdump, netstat
MySQL (replication, query optimization), sqlite, MongoDB, MongoEngine
ZFS (FreeBSD and Linux/ZoL), NetApp, iSCSI (istgt), DRBD, MooseFS

Work Experience
Senior Unix Systems Administrator

May 2010 - May 2013

The Electric Mail Company, Burnaby, BC
Hosted email, archiving and email security

Large scale server environment with more than 500 physical servers and 400 OpenVZ VEs in 5 colo facilities, hosting over 12 million mailboxes
and serving over 1Gbit/s customer traffic
Administrated a mix of CentOS 5.x, Gentoo 32/64bit, FreeBSD 8.x and legacy OpenBSD systems as well as OpenVZ instances
Designed, documented and supervised the addition of two new colo facilities in Phoenix and Chandler, Arizona, US. Built redundant pairs or
FreeBSD routers in each data center running 10GbE network, BGP, binat and pf firewall. Implemented successful failover between the two
DataCenters and between ISPs
Implemented redundant, instant-failover, VPN tunnels between five data centers running on top of dedicated MPLS circuits and the Internet using
OpenVPN. Cut downtime related to inter-colo connectivity blips to virtually zero - a significant improvement over previous IPSec based solution
Rebuilt and migrated all routers to FreeBSD and successfully replicated functionality from OpenBSD like: pf firewall, carp failover, etc. Removed
router-related downtime due to improved stability and eliminated previous double kernel panics across the redundant pairs
Designed, documented and supervised the addition of a new colo facility in Data Electronics/Telecity in Dublin, Ireland. This included power, rack
space, network and cabling, servers configuration and purchasing, routing and redundancy
Applied and received a /22 Provider Independent IP address space from RIPE for the new Dublin colo. Implemented a redundant FreeBSD-based
pair of routers running OpenBGPd between two ISPs - Level3 and Cogent. Introduced source routing and traffic separation between the different
subnets for better utilization of available bandwidth
Developed automated FreeBSD installer based on PXE boot, NFS and bash script. Host for binary packages, cvsup server providing fast updates
of base OS sources
Developed automated Gentoo installer based on PXE boot, NFS, bash script and puppet
Designed custom SuperMicro-based server configurations tailored specifically for the needs of the main application they were meant to run.
Achieved high cost-efficiency due to the lack of big vendor brand name overhead. Incorporated SSD into certain server configurations resulting in
double and triple performance boost over previous setups. Assembled individual hardware components, stress tested complete server
configurations, eliminated bottlenecks and performed hardware troubleshooting
Participated into the migration and merger of Electric Mail with FuseMail and the following technical re-engineering challenges
Implemented ZFS-based backup solutions over NFS and iSCSI providing cheap redundant storage of over 200 TB
Added cacti/rrdtool based graphing and monitoring of Linux and NetApp systems which helped us identify bottlenecks and improve reliability
Provided Tier 2 support to the company's Help Desk

Senior Linux Systems Administrator and Software Developer

November 2009 - February 2010

The Internet Marketing Center, Vancouver, BC
Marketing Resources and Training for Small Businesses

Linux (CentOS, Ubuntu Server) Systems Administration. Server hardware maintenance, troubleshooting and installation
Exim mail server installation and configuration for custom needs. GoodMail integration. SPF and DKIM/DomainKeys
Asterisk PBX configuration, maintenance and troubleshooting
Perl CGI programming

Systems Operations Engineer

September 2008 - October 2009

Electronic Arts (Canada) Inc, Burnaby, BC
Global Interactive Entertainment

Core member of the EA Sports Online Operations Team responsible for EASports.com and EASportsWorld.com
Participated in the full life cycle of PlayStation3 and XBOX360 based console games that used online features provided by our group including
FIFA, Madden, Tiger Woods PGA, NBA, NHL, NCAA, etc.
Provided systems administration, monitoring, maintenance, deployments, troubleshooting and continuous integration services to the web, engine
and game teams involved in the project
Built and maintained the production environment as well as multiple development, test and certification environments
Maintenance, troubleshooting and optimization of applications running on Red Hat Enterprise Servers, JBoss, PHP/Symfony, Memcached,
Oracle, HAproxy
Designed and developed a custom system, based on RRDtool, for analysis and graphical representation of the load and utilization of the backend
infrastructure and the REST interface it provides to users
Software Engineer II title with systems administration and support functions

Senior Linux Systems and Network Administrator

November 2006 - July 2008

ICDSoft Ltd, Sofia, BG
Shared Web Hosting

Administrated large scale (more than 400) Linux and Unix servers (RedHat, Debian, FreeBSD) and Cisco switches
Hardware management, assembly, debugging, stress testing, server monitoring, troubleshooting and high level technical support
Network administration: VLAN, FreeBSD based firewalling with pf and ipfw, RIP, Linux iptables, etc.
Implemented the office open-source PBX based on Asterisk
Resolved customer incidents and security issues

Chief Technical Officer

May 2003 - October 2006

E-Card Ltd, Sofia, BG
Applications Service Provider

Started as a Unix Systems Administrator and shortly after added software development duties (Perl, mod_perl, C). Later officially acquired the title
CTO (Chief Technical Officer) of the company
Analyzed all technical aspects of the projects, architected and implemented solutions
Programmed high-performance server applications of heavily loaded web sites in Perl (mod_perl), C and MySQL
Successfully built and ran high-profile websites like: Big Brother, Star Academy, Who Wants to Be A Millionaire, MVBox, flashassistant.net, IQ test
of the nation
Redesigned the existing online payment system of the company and applied a new security model. Chose the technology, implemented the
system, optimized it and performed a thorough security analysis
Developed premium-rate SMS based applications and video streaming solutions
Used internet telephony based on Asterisk (IAX2 protocol) and implemented a custom VoIP softphone
Created, administrated and maintained the server and office network including BGP, firewall, load balancing, etc.
Worked with short deadlines and always met expectations. The job was a mixture of programming and systems/network administration with
emphasis on programming

Linux Systems and Network Administrator

July 2001 - January 2003

EuroIntegra Ltd, Sofia, BG
Internet Service Provider

Administrated Cisco routers and Linux/FreeBSD servers. Configured and tuned network services for the company and external clients
Built local networks and installed structured cabling. Gained experience with ISDN lines, telephone exchanges, Zyxel DSL routers, DOCSIS cable
modems and networks, Network Access Servers. Supported clients over the telephone and on-site. Created applications for automation of the
administrative tasks

Education
Degree
Major
University

Master
Distributed Systems and Mobile Technologies
Sofia University St. Kl. Ohridski

Degree
Major
University

Bachelor
Computer Science
University of National and World Economy in Sofia

Personal Information
Fluent in English, native in Bulgarian, beginner in French and Russian
Strong team player and fast learner
Dedicated and responsible with attention to detail
Class 5 BC driver's license
References available upon request

September 2006 - unfinished

October 1998 - June 2005

";

//set q1 for split every other space
$q1 = $query;

//set q1 for split every second space
$q2 = $query;

//set q1 for split every third space
$q3 = $query;

//set q1 for split every third space
$q4 = $query;


//set matches1 array for first split
$matches1 = array();

//run split command on $q1
$matches1 = preg_split("/[\s,]+/", $q1);

pp($matches1);

echo "<br>";

//loop through each value in the single space split array
foreach($matches1 as $i) {
		//echo "<br>".$i;
}




//set matches2 array for second array split
$matches3 = array();

//run split command on $q2
$matches3 = preg_split("/[\s,]+[\s,]+/", $q2);
print_r($matches3);
echo "<br>";




//run every space split command on $q3
$tmp10 = preg_split("/[\s,]+/", $q3);

$i=0;
$j=0;
echo "<br>";

foreach($tmp10 as $piece10) {
   if(! ($i++ %2)) $j++;   //increment every 
   $result10[$j] .= $piece10." ";
}
print_r($result10);




$q100 = "prepend2 ".$query;

//run every space split command on $q3
$tmp11 = preg_split("/[\s,]+/", $q100);

$i=0;
$j=0;
echo "<br>";

foreach($tmp11 as $piece11) {
   if(! ($i++ %2)) $j++;   //increment every 3 
   $result11[$j] .= $piece11." ";
}
print_r($result11);






//run every space split command on $q3
$tmp1 = preg_split("/[\s,]+/", $q3);

$i=0;
$j=0;
echo "<br>";

foreach($tmp1 as $piece1) {
   if(! ($i++ %3)) $j++;   //increment every 3 
   $result1[$j] .= $piece1." ";
}
print_r($result1);


//run every space split command on $q3 push array forward one word
$q = "prepended ";
$q1s = $q.$q4;
//run every space split command on $q3
$tmp2 = preg_split("/[\s,]+/", $q1s);

$i=0;
$j=0;
echo "<br>";

foreach($tmp2 as $piece2) {
   if(! ($i++ %3)) $j++;   //increment every 3 
   $result2[$j] .= $piece2." ";
}
print_r($result2);



//run every space split command on $q3 push array forward two words
$q = "prepended prepended ";
$q1s = $q.$q3;
//run every space split command on $q3
$tmp3 = preg_split("/[\s,]+/", $q1s);

$i=0;
$j=0;
echo "<br>";

foreach($tmp3 as $piece3) {
   if(! ($i++ %3)) $j++;   //increment every 3 
   $result3[$j] .= $piece3." ";
}
print_r($result3);

$Q = "'".$result3[16]."'";
$Q = urlencode($Q);


$xmlUrl = "curl 'http://192.168.1.150:8983/solr/select?q=".$Q."' > /usr/local/www/apache22/data/compare_seo_term.xml";
$work = exec($xmlUrl);
echo $work;

$work = system($xmlUrl, $ret);
echo $work;

echo $ret;

echo $xmlUrl;
$uri = $xmlUrl;

$xmlStr = file_get_contents("http://doczine.com/compare_seo_term.xml");
echo $xmlStr;

$xmlObj = simplexml_load_string($xmlStr);
$arrXml = objectsIntoArray($xmlObj);
//print_r($arrXml);
//var_dump($arrXml);
//$whyuknow = multiarray_keys($arrXml);
//print_r($whyuknow);

$whyuno = show_keys($arrXml);
echo $whyuno;

foreach ($arrXml as $i => $row)
{
    $title = $row['refid'];
    echo $title;
    $trim = $row['phrase'];
    echo $trim;
    $host = $row['score'];
    echo $host;
    $trimmed = $row['title'];
    echo $trimmed;
    $trimmed1 = $row['phrase'];
    echo $trimmed1;
    $titleasdf = $row[$i];
    echo $titleasdf;
    //var_dump($row);
}











$limit = 500;
$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : false;
$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : false;
$results = false;
$search = $query;

$conn1 = db_connect();

$i = 0;
do {
    $i++;

    $query = "SELECT `resume_seo_term` FROM `docunator`.`resume_seo_term` WHERE `resume_index` IS NULL LIMIT 1;";

    if ($stmt = mysqli_prepare($conn1, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $resume_seo_term);
        while (mysqli_stmt_fetch($stmt)) {
            echo $resume_seo_term;
        }
        mysqli_stmt_close($stmt);
    }

    $query = "UPDATE `docunator`.`resume_seo_term` SET `resume_index` = 'Y' WHERE `resume_seo_term`.`resume_seo_term` = '".$resume_seo_term."';";

    if ($stmt = mysqli_prepare($conn1, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

$resume_seo_term = $Q;

if ($resume_seo_term) {

$solr = new Apache_Solr_Service('192.168.1.150', 8983, '/solr');
$query = strip_tags(stripslashes($resume_seo_term));

$header = "Search Results: ".$query;
$description1 = "Doczine.com search results for: ".$query;
$meta = "Doczine search, ".$query;
$description2 = "Doczine File Search Results";
$author = "BorgEye.com";

//do_html_upper($query, $description1, $meta, $description2, $author);
do_html_search($query, $description1, $meta, $description2, $author, $header);

  try
  {


$rows = 20;

$additionalParameters = array();

//works
//$additionalParameters = array('fq'=>array('attr_stream_source_info:myfile','content_type:application/pdf'));

//adding wild cards:
//$additionalParameters = array('fq'=>array('title1:*jesus christ*','content_type:application/pdf'));

//$additionalParameters['fq'] = 'attr_stream_source_info:myfile';


$additionalParameters = array(
    //'fq' => 'id:1371137958_c66058621b'
);


$results = $solr->search($query, $start, $rows, $additionalParameters);
        
  }
  catch (Exception $e)
  {
        die("<html><head><title>SEARCH EXCEPTION</title><body><pre>{$e->__toString()}</pre></body></html>");
  }
}

$i = 0;
if ($results)
{

  $total = (int) $results->response->numFound;
  $start = min($start, $total);
  $end = min($limit, $total);

echo "<div>Search Term: "; 
echo $search;
echo "<br>";
echo "Results: ";
echo $start; 
echo " - ";
echo $end;
echo " of ";
echo $total;
echo "</div><br>";

  // iterate result documents
  foreach ($results->response->docs as $doc)
  {

    // iterate document fields / values
    foreach ($doc as $field => $value)
    {

if($field != "") {

switch ($field) {
case "id":
$id = $value;
break;
case "snip":
$snip = $value;
break;
case "attr_body":
$body = $value;
//echo "<textarea style='width:800px;'>";
//echo $field;
//echo ": ";
//echo $value;
//echo "</textarea>";
//echo "<br>";
//break;
default: 
//echo $field;
//echo ": ";
//echo $value;
//echo "<br>";

		}
	
	}

}
echo "<br>";

	$i = $i + 1;
	//echo $content_type;
		display_search_results($id, $i, $search, $snip, $body);
	}   
}

} while ($i < 100);











/*
$i=0;
$j=0;
echo "<br>";

foreach($tmp as $piece) {
   if(! ($i++ %3)) $j++;   //increment every 3 
   $result[$j] .= $piece." ";
}
print_r($result);
*/


/*
$delimiters = Array(",",":","|","-");

$res = multiexplode($delimiters, $query);

print_r($res);
*/

?>
