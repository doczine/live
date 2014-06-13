<?php


$str = "

Job Description

This position is based in Santa Barbara, CA... known as the American Riviera... it really is that nice here.

We build payment software that constantly challenges our teams to build scalable and reliable systems.

Over the years, we have embraced automation and testing which allows us to create great systems... AND maintain a balanced lifestyle (i.e. get rid of BS alerts in the middle of the night).

We know our strengths, and realize our weaknesses... and take pride in actually *doing something* to fix things that can be better.

We have the resources for top of the line equipment and love finding ways to implement them to maintain our goal of constantly improving.

There are always new things to work on so you won't be bored with just package updates.  If you are interested in building modern security systems that scale, look no further.

We are looking for top tier engineers, and we are willing to pay a premium salary for the right people.  True computer scientists looking to get your hands on cutting edge systems apply now.

Skills & Requirements

Dev Skills

    Know Puppet, Git, a scripting language and love to automate everything
    Jenkins, VM's, continuos integration, and one step deployments

Networking Skills

    Router / Firewall configurations (ScreenOS, Junos, Cisco)
    BGP Routing, VPN, DNS, Radius, DAI, load balancing, tcpdump

Security Penetration Testing Skills

    Internal penetration testing / PCI compliance
    IPS, SSL Scan, OpenVas, Ettercap, Injection, XSS, CSRF, on and on, bring your White Hat skills

Server and Workstation Skills

    Servers - Linux (Ubuntu), package updates, backup, and DB maintenance
    Workstations - Mac OSX, MCX Records, Profile Management
    Bash, LDAP, Basic MySQL, Apache, SSL, SNMP, Nagios, Splunk, OSSEC

About PayJunction

PayJunction is the leading developer of paperless payment software, enabling businesses to process secure transactions in real-time from anywhere in the world. We are dedicated to building innovative products that make it easier for businesses to process payments in their office, through their website, and on the go.  Founded in 2000, our systems have grown to handle millions of transactions for thousands of businesses across the US.

Benefits

    Health, Dental, & Vision paid 100%
    401k with 6% match

Environment

    Large corporate HQ in downtown Santa Barbara, California
    Xbox Gaming Center  (Halo skills required ;-)
    Fußball, Full Bar and Keg-o-Rator
    Onsite movie theatre with 40+ bean bags
    Onsite bar with chalkboard walls, flat screen tv, direct tv, Pay Per View UFC Matches

Company Ethos

    We value long term relationships over short term profit.
    We are building something that will last longer than us.
    We are passionate about our work and inspired by the team we have created.
    We create products that improve the lives of our customers.
    We build green technology that costs less than our prospective clients pay now.
    We are constantly innovating.

Pay: Highly Competitive DOE

Tags:  SysAdmin  Systems Administrator
";

$new_file_name = str_replace("'", " ", $str);
$new_file_name1 = str_replace(".", " ", $new_file_name);
$new_file_name2 = str_replace(")", " ", $new_file_name1);
$new_file_name3 = str_replace("(", " ", $new_file_name2);
$new_file_name4 = str_replace(",", " ", $new_file_name3);
$new_file_name5 = str_replace("’", " ", $new_file_name4);
$new_file_name6 = str_replace("/", " ", $new_file_name5);
$new_file_name7 = str_replace("\\", " ", $new_file_name6);
$new_file_name8 = str_replace("|", " ", $new_file_name7);
$new_file_name9 = str_replace("-", " ", $new_file_name8);
$new_file_name10 = str_replace("–", " ", $new_file_name9);

$query = strtolower($new_file_name10);

$matches = array();
$matches = preg_split("/[\s,]+/", $query);
//$t = preg_match('/ \ /s', $query, $matches);


$str = "


Cover Letter

I have been using and creating HTML and CSS sites since 2002. I have been using and administering PHP applications since 2004, and programming them since 2009. I wrote the JQuery, Javascript, PHP and MySQL for Doczine.com.

I regularly build dynamic web applications using up to date visual display methods, and I regularly browse sites like Drupal, Github, Stack Overflow and Google Code for updates on technologies in the front and backend.

I have a long history in data analysis, database modeling, programming, systems engineering and design. I have been using spreadsheet applications since Excel 95. I am good at writing technical specifications and software design documentation, because I studied it and other technical knowledge at Azusa Pacific University and Santa Barbara City College.
Work Experience
July 2012 - Present
Software Architect
Doczine.com | Las Vegas, Nevada

    Wrote PHP and MySQL scripts for the site wide system
    Wrote original design specifications and code
    Wrote MySQL database structure and SQL database creation script
    Wrote JQuery and Javascript for upload form and home page
    Wrote infinite scroll script for home page, and user file list pages
    Maintained, upgraded, and installed Ubuntu and FreeBSD servers
    Created file upload and conversion algorithm
    Created document web crawler
    Integrated Solr based search engine
    Configured PFSense router and firewall

Feb 2013 - Aug 2013
IT Manager
Troy Capital LLC. | Las Vegas, Nevada

    Managed Windows Server 2008 servers, and Windows 7 and Vista desktops
    Managed, fixed and maintained the Collect! collection database
    Wrote custom reports using Collect! collections database
    Maintained group drive data backups, off-site server backups, Ghost desktop backups
    Integrated You've Got Claims data with the Collect! database
    Processed and integrated Experian credit bureau reports into Collect!
    Managed projects to upgrade the company's infrastructure
    Managed network upgrades, and built IP camera monitoring system

June 2011 - Nov 2011
Data Integration Analyst
Newegg Marketplace | Industry, California

    Managed item data integration process for new and existing item sellers
    Assisted sellers with integrating data using Soap API, CSV, XLS, XML data sources
    Created weekly and monthly statistic reports on integration progress for sellers
    Managed large item lists and troubleshot errors with item integration
    Worked with development team to find and fix errors with the integration process
    Helped tracked and find bugs in the Newegg Marketplace seller portal
    Created OLAP reports to track system errors and integration progress
    Extensive work with Excel spreadsheets and SharePoint reporting and tracking
    Studied sellers web applications in order to provide solutions on how to better integrate their data with the Newegg Marketplace database

May 2010 - Apr 2011
Data Manager
AdMax Media Inc. | Santa Barbara, California

    Managed lead buying and delivery process for two education lead generation call centers
    Co-managed Discount Lead Network lead reselling division of AdMax Media
    Managed email auto-responder platform integrated into lead database
    Managed the creation of new lists, column mappings, and providers in the lead database
    Managed CSV, CSV email and real time exports leaving the lead database
    Managed weekly and monthly call center media buy reports education campaigns
    Created lead analysis reports used to launch a new SMS marketing campaign
    Calculated and approved invoices for call center and Discount Lead Network media buys
    Created reports that measured data needs based on man hours and number of dials
    Wrote use cases in JIRA in order to add new features in the lead management database
    Helped Director of Engineering to document bugs in the lead management database
    Created technical and user documentation for job processes
    Used pivot tables querying OLAP cubes to create dynamic dialer reports to analyze performance metrics over periods of time

Jan 2009 - Jul 2010
Billing Coordinator
Aeria Games and Entertainment | San Jose, California

    Researched fraudulent transaction activity in Aeria Games billing admin system
    Responded and tracked Google and PayPal chargebacks correspondance
    Reviewed fraudulent IP address activity reports
    Reconciled Google and PayPal chargebacks and balances
    Awarded and compiled reports for events, rebates and promotions
    Responded to billing email inquiries in email ticketing system
    Researched other micro-transaction billing systems
    Created and compiled ad-hoc Excel reports and statistic calculations
    Tested payment options on the billing test site and helped develop test documentation
    Filed JIRA bug tickets to implement new features or when software issues arose
    Coordinated with other teams to mitigate and combat fraudulent accounts
    Created and ran complex Macro express and VBA macros to automate receptive tasks

Sept 2005 - Jun 2008
Sr. Fraud Prevention Specialist
Citrix Online | Santa Barbara, California

    Researched fraudulent transaction activity in GoToMyPC and GoToMeeting customer database in real-time
    Ran fraud reports through an internal reporting system in combination with Excel
    Ran IP/DNS reports on fraudulent accounts, ran reverse phone lookups, IP matching, ran manual checks on IP and other information linked to duplicate fraudulent accounts, ran Melissa data lookups
    Tracked American Express and Paymentech chargebacks using Excel
    High volume of merchant chargeback correspondence with American Express and Paymentech using merchant ecommerce solutions, paperwork and facsimiles
    High volume of account analysis required the ability to find inconsistencies in large quantities of data. ~200 accounts a day, sometimes more depending on report and frequency
    Helped make decisions and suggestions for new tools and policy changes in response to the ever changing carder and fraud attempts
    Corresponded with customers to verify high dollar, and suspicious looking transactions
    Large amounts of Excel, Word, Outlook and PDF editing and correspondence, Updated Excel report formulas

Mar 2005 - Sep 2005
Customer Care Representative
Citrix Online | Santa Barbara, California

    Handled technical support phone calls for GoToMyPC and GoToMeeting
    Dealt with general account modifications, refunds, edits, purchases etc.
    Coordinated meetings and duties through Outlook, Excel, Word
    Worked in a high tech call center with a high volume of calls
    Walked customers through ordering online
    Handled technical support emails for GoToMyPC and GoToMeeting through internal ticketing system
    Used the remote support application GoToAssist to troubleshoot GoToMyPC and GoToMeeting web applications. (GoToMyPC.com, GoToMeeting.com etc.)

Feb 2002 - Mar 2005
Online Customer Support Representative
Bargain Network Inc. | Santa Barbara, California

    Assisted customers over phone, with technical/non-technical support questions
    Respond to emails regarding technical support, general customer support, and general website servicing questions
    Respond to Live Online Agent Chat requests, regarding technical support questions and general servicing questions
    Process account maintenance, refunds, editing, auditing and account modifications requests
    Evaluated beta customer support application upgrades
    Dealt with usual users level apps, worked in excel, email applets, chat applets, customer support apps, web apps, intranet, database etc.

Education
Azusa Pacific University
Management Information Systems Bachelors

Santa Barbara City College
Associates of Science in Computer Information Systems

";

$new_file_name = str_replace("'", " ", $str);
$new_file_name1 = str_replace(".", " ", $new_file_name);
$new_file_name2 = str_replace(")", " ", $new_file_name1);
$new_file_name3 = str_replace("(", " ", $new_file_name2);
$new_file_name4 = str_replace(",", " ", $new_file_name3);
$new_file_name5 = str_replace("’", " ", $new_file_name4);
$new_file_name6 = str_replace("/", " ", $new_file_name5);
$new_file_name7 = str_replace("\\", " ", $new_file_name6);
$new_file_name8 = str_replace("|", " ", $new_file_name7);
$new_file_name9 = str_replace("-", " ", $new_file_name8);
$new_file_name10 = str_replace("–", " ", $new_file_name9);

$query = strtolower($new_file_name10);


$matches1 = array();
$matches1 = preg_split("/[\s,]+/", $query);
//$t = preg_match('/ \ /s', $query, $matches);

foreach ($matches as $i) {
	if (in_array($i, $matches1)) {
		//echo "In ".$i;
	} 
	else
	{
		echo " ".$i;
	}

}


?>
