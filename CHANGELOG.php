<?php
/**
* @version $Id$
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
?>
1. Copyright and disclaimer
---------------------------
This application is opensource software released under the GPL.  Please
see source code and the LICENSE file


2. Changelog
------------
This is a non-exhaustive (but still near complete) changelog for
Joomla! 1.0, including beta and release candidate versions.
Our thanks to all those people who've contributed bug reports and
code fixes.


3. Legend
---------
* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note


02-Jul-2007 Rob Schley
 * SECURITY A6 [LOW Level]: Fixed [#5630] HRS attack on variable "url"
 * SECURITY A1 [LOW Level]: Fixed [#5654] Multiple fields subjected to cross-site scripting vulnerabilities
 * SECURITY A7 [LOW Level]: Fixed possible session fixation vulnerability in administrator application


29-Jun-2007 Louis Landry
 ^ Hardened password storage mechanism to use a random salt
 ! Remember Me cookies will be invalid and require a re-login


20-May-2007 Rob Schley
 # Fixed key reference lookups to match whole results only
 # Fixed two help screen naming issues.
 ^ Changed RG_EMULATION warning message to refer to Global Configuration Setting


17-May-2007 Rob Schley
 ^ Moved register globals emulation controls into Global Configuration


15-May-2007 Rob Schley
 # Fixed [topic,170296] : Typos in Search Mambot configurations


14-May-2007 Rob Schley
 # Fixed [topic,153233] : "Mail to Friend" parameter checks not checking content item setings
 # Fixed [topic,126371] : IE7 left align problem
 # Fixed [topic,167745] : Added JavaScript alert for empty category title


28-Apr-2007 Rob Schley
 ^ Changed cookie naming conventions to not break when using HTTPS
 # Fixed [topic,156116] : Optimzed queries for menu creation to improve performance.
 * SECURITY A4 [ LOW Level ]: XSS issue in com_search and com_content
 * SECURITY A4 [ LOW Level ]: XSS vulnerability in mod_login


16-Apr-2007 Enno Klasing
 # Re-enabled Itemid behaviour of 1.0.11 (optional, default is behaviour of 1.0.12)

----------------------------------------------------------------------------------------
--------------- 1.0.12 Stable Released -- [25-December-2006 01:00 UTC] -----------------

24-Dec-2006 Rob Schley
 # Fixed two hard coded alt tags
 + Added new language constant _BANNER_ALT
 ^ Preparations for Stable packaging
 # Removed local help screen content and replaced it with links to the online versions


19-Dec-2006 Rob Schley
 + Added 119 help screen files.
 ^ Changed 20 help screen titles.
 # Fixed several grammar problems throughtout the Joomla! core


18-Dec-2006 Enno Klasing
 # Fixed [artf5166] : Server Time offset issue, while submitting news
 # Fixed [artf6439] : https switchover


18-Dec-2006 Rob Schley
 # Fixed bug in offline.php when using the database class without a working database connection.
 # Fixed spelling and grammar mistakes in english.php as per suggestions.


15-Dec-2006 Enno Klasing
 # Fixed sample data: removed (nonexistent) RSS feed from OSM
 # Fixed redirect to installation directory: removed need for lowercase directory names


13-Dec-2006 Rob Schley
 # Fixed spelling and grammar errors in com_menus
 # Fixed changelog formatting.


13-Dec-2006 Enno Klasing
 + Added security warning message to the installer component
 # Fixed [artf6522] : Quotes in User Name breaks checkedOut overlib
 * SECURITY A1 [ Medium Level ] : Removed unneeded legacy functions


12-Dec-2006 Enno Klasing
 # Fixed bug in TinyMCE: help screen disabled
 # Fixed IE7 display bug with mosTabs
 # Fixed [artf7028] : Two bugs in TinyMCE


11-Dec-2006 Enno Klasing
 # Fixed [artf7021] : Bug with com_messages and message titles including a single quote


10-Dec-2006 Rob Schley
 # Fixed grammar problems in SQL data.
 # Fixed grammar problem in com_config.
 # Fixed usages of "Joomla!" missing the exclamation point.


10-Dec-2006 Enno Klasing
 # Fixed [artf6762] : mos_section showing unexpected behavior
 # Fixed IE7 display bug in the toolbar of the polls component


07-Dec-2006 Rob Schley
 # Fixed [artf6863] : Changed the include file from template_css.css to offline.css to avoid conflicting styles


07-Dec-2006 Enno Klasing
 # Fixed [artf6296] : josSpoofCheck does not check arrays and generates php warning


06-Dec-2006 Marko Schmuck
 # Fixed [artf6884] : mosimage align=right causes problems in IE6
 # Fixed [artf6779] : Link-URL containing character ] breaks


06-Dec-2006 Enno Klasing
 # Fixed [artf6922] : Registration not working as expected (JavaScript popups)


06-Dec-2006 Mateusz Krzeszowiec
 # Fixed [artf6832] : getItemid() function in joomla.php will not return correct $Itemid
 # Fixed [artf6522] : Quotes in User Name breaks checkedOut overlib, continued
 # Fixed [artf6786] : sef.php and multilingual config


05-Dec-2006 Rastin Mehr
 # Fixed [artf6751] : Banner upload target directory bug
 # Fixed [artf6522] : Quotes in User Name breaks checkedOut overlib, fixed similiar bugs from another report


02-Dec-2006 Sam Moffatt
 # Fixed [artf6484] : com_registration bug (removed SQL error message)


01-Dec-2006 Enno Klasing
 # Fixed [artf6903] : Anchors to Frontpage in SEF-URLs
 # Fixed [artf6901] : LIMIT in MySQL queries
 # Fixed [artf6844] : Javascript escape bug for poll.php
 # Fixed [artf5788] : Frontpage content item category links enable section links


30-Nov-2006 Rastin Mehr
 # Fixed [artf6577] : Registration name, username & email cleanups: spaces not allowed


30-Nov-2006 Emir Sakic
 # Fixed [artf6841] : Submit Contact Form doesn't work with deactivated cookies
 # Fixed [artf6846] : Error with new document - without categories


30-Nov-2006 Mateusz Krzeszowiec
 # Fixed [artf6786] : sef.php and multilingual config


30-Nov-2006 Marko Schmuck
 # Fixed [artf6921] : [patch] fixing a bug on modules/mod_archive.php
 # Fixed [artf6876] : Orphan user information in phpGACL tables after user was deleted


29-Nov-2006 Mateusz Krzeszowiec
 # Fixed [artf6749] : bot mosloadposition stippes $
 # Fixed [artf1527] : "open_basedir restriction" warning


28-Nov-2006 Enno Klasing
 # Fixed [artf6766] : Login form; you are not authorized...
 # Fixed [artf6765] : Login form problem
 # Fixed [artf6567] : Change error message for cookie test failure


27-Nov-2006 Enno Klasing
 # Fixed [artf6860] : Admin Login and PHP's session.auto_start


27-Nov-2006 Emir Sakic
 # Fixed [artf6865] : Relocate <script> element below <title> and <meta> elements for XHTML compliance
 # Fixed [artf6863] : Extra CSS include for styling offline.php
 # Fixed [artf6858] : Encoding/Template issues on backend
 # Fixed [artf6859] : Bug in com_content security check for new content


25-Nov-2006 Rastin Mehr
 # Fixed [artf6439] : https switchover not working (as did in mambo 4.5.2 and early joomla)


21-Nov-2006 Emir Sakic
 # Fixed [artf6847] : XHTML syntax incompliance
 # Fixed [artf6833] : Javascript alert messages on IE display without proper encoding in Internet Explorer


21-Nov-2006 Marko Schmuck
 # Fixed [artf6828] : Poorly formed HTML in admin.contact.html.php


21-Nov-2006 Andrew Eddie
 # Added 3 new language constants for systems errors (namely database issues)


20-Nov-2006 Marko Schmuck
 # Fixed [artf6673] : Untranslated submit button, content component


20-Nov-2006 Enno Klasing
 # Fixed [artf6816] : Hit counter not correct if caching is enabled
 # Fixed [artf6753] : add banner client ID in admin view


19-Nov-2006 Enno Klasing
 # Fixed [artf6764] : IE7 Table Alignment Bug


15-Nov-2006 Marko Schmuck
 # Fixed [artf6763] : Joomla.php - build the multiple select list
 # Fixed [artf6752] : mms:// not resolving in menus


15-Nov-2006 Enno Klasing
 # Fixed [artf6613] : User rating, second rating, incorrect message


15-Nov-2006 Mateusz Krzeszowiec
 # Fixed [artf5926] : Few other Itemid issues solved


14-Nov-2006 Marko Schmuck
 # Fixed : css file handling in content backend preview


13-Nov-2006 Enno Klasing
 # Fixed [artf5924] : JavaScript and HTML-Error in mod_wrapper


12-Nov-2006 Alex Kempkens
 # Fixed [artf6713] : double title in the pathway


12-Nov-2006 Mateusz Krzeszowiec
 # Fixed [artf6611] : Admin, copy section issues


11-Nov-2006 Enno Klasing
 # Fixed [artf6720] : Wrong markup on com_media


10-Nov-2006 Emir Sakic
 # Fixed [artf6709] : Media Manager Error for uploading a file, without select anything


09-Nov-2006 Enno Klasing
 # Fixed [artf6058] : Apostrophes not stripslashed in Category names


09-Nov-2006 Emir Sakic
 # Fixed [artf6175] : Javascript - Error in function previewImage()


08-Nov-2006 Rey Gigataras
 # Fixed [artf6689] : TinyMCE updated to 2.0.8
 # Fixed [artf6689] : TinyMCE GZip compressors updated to 1.0.9


08-Nov-2006 Enno Klasing
 # Fixed [artf6528] : Wrong markup in two admin modules
 # Fixed [artf6350] : overDiv not created in proper place


03-Nov-2006 Alex Kempkens
 # Fixed [artf6415] : Tooltip or function is not correct in Global Configuration
 # Fixed [artf6650] : Flyover help not translated in com_content


03-Nov-2006 Mateusz Krzeszowiec
 # Fixed [artf6542] : Quotes in User Name lost when editing
 # Fixed [artf6522] : Quotes in User Name breaks checkedOut overlib


03-Nov-2006 Enno Klasing
 # Fixed [artf6589] : Missing index.html files
 # Fixed [artf6500] : media manager too easily classifies a file as a mediafile


02-Nov-2006 Samuel Moffatt
 # Fixed [artf6484] : com_registration bug


01-Nov-2006 Emir Sakic
 ^ Changed new version and forum security links to universal ones with redirects on joomla.org
 # Fixed [artf6131] : UNC support in Joomla
 # Fixed wrong align of drop-down lists in admin content item manager


30-Oct-2006 Mateusz Krzeszowiec
 # Fixed [artf6132] : Admin Session not completely emptied on logout, also removed some code (doublecheck) in administrator/logout.php continued


29-Oct-2006 Mateusz Krzeszowiec
 # Fixed [artf6132] : Admin Session not completely emptied on logout, also removed some code (doublecheck) in administrator/logout.php
 # Fixed templates/madeyourweb/images/indent1.png and indent2.png file size
 # Fixed [artf6160] : Admin, copy category issues, changed message after copy
 # Fixed : Admin, move category issues, changed message after move
 # Fixed [artf6581] : #__poll_data install SQL incorrect


26-Oct-2006 Emir Sakic
 ^ Removed version check - [artf6486] : Remove "Your Joomla! Installation is ... days old" messages


22-Oct-2006 Mateusz Krzeszowiec
 # Fixed [artf6441] : Incorrect spelling Poll
 # Fixed [artf6160] : Admin, copy category issues
 # Fixed : Admin, move category issues
 # Fixed : Small security issue in com_categories - no input validation


21-Oct-2006 Enno Klasing
 # Fixed [artf6253] : Content Blog Section, several notices
 # Fixed [artf6440] : Menu name htmlentitized when toggling published/unpublished


19-Oct-2006 Enno Klasing
 # Fixed [artf6470] : pageNavigation/php - minor bug/improvement
 # Fixed [artf5890] : Content item count incorrect (public/registered)


18-Oct-2006 Marko Schmuck
 # Fixed [artf5229] : database.php: loadRowList($key) not working as expected


16-Oct-2006 Alex Kempkens
 ^ little query issue for multilingual support (frontpage/search bot)


15-Oct-2006 Enno Klasing
 # Fixed [artf6430] : htaccess tweak


15-Oct-2006 Emir Sakic
# Fixed [artf5760] : 'more' functionality in blogs showing links even though they shouldn't
# Fixed [artf6058] : Apostrophes not stripslashed in Category names


11-Oct-2006 Emir Sakic
# Fixed [artf6141] : check all in com_trash for menu items


10-Oct-2006 Emir Sakic
^ Refactored admin trash manager to be consistent with other managers
# Fixed [artf6141] : com_trash administrative component navigation problem


04-Oct-2006 Sam Moffatt
# Fixed [artf5955] : get_group_parents() with default $recurse parameter
# Fixed [artf6181] : Search: Itemid in com_search also gets wrong Itemid's
# Fixed [artf6172] : (FRONTEND)mosPageNavigation::writeLeafsCounter doesn't diplay correct page numbers
# Fixed [artf6169] : showCategories produces non w3c valid list


03-Oct-2006 Mateusz Krzeszowiec
# Fixed [artf5926] : Incorrect determination of Itemid for content items links in Blog - Content Section, look in tracker for details


01-Oct-2006 Mateusz Krzeszowiec
 # Fixed [artf6074] : Joomla! using trashed menu item permission level in some cases
 # Fixed [artf6084] : com_content division by zero warning
 # Fixed [artf6153] : Invalid constant in field description


23-Sep-2006 Mateusz Krzeszowiec
 # Fixed [artf6004] : Search results include several hits for the same document
 # Fixed [artf6041] : username when sending PM instead of name
 # Fixed [artf5989] : not optimal mosMakePassword()


22-Sep-2006 Enno Klasing
 # Fixed [artf5983] : Undefined variables in com_content
 # Fixed [artf5985] : Missing htmlspecialchars for module title
 # Fixed [artf5934] : Mail sent via "Email a friend" has bad link
 # Fixed [artf6011] : HTML entities appearing in plain-text emails from com_content
 # Fixed [artf5986] : mosMail and empty sender information
 # Fixed [artf6075] : "CheckIn My Items" checks in all Items


22-Sep-2006 Marko Schmuck
 # Fixed [artf5507] : "&" character in Global Site Meta Description field results in "&amp;amp;"
 # Fixed [artf5788] : Frontpage content item category links enable section links, and section links generate '&' and not '&amp;' in their html


20-Sep-2006 Emir Sakic
 # Fixed [artf5202] : administrator typed content search pagination problem
 # Fixed [artf5908] : Menu Item in Pathway not linked when custom pathway appended


18-Sep-2006 Mateusz Krzeszowiec
 # Fixed [artf5848] : Poll component not displaying info, XML file moved to proper directory


18-Sep-2006 Sam Moffatt
 # Fixed [artf5887] : mosMakePath mkdir with trailing slash not working (when using hardened PHP)


17-Sep-2006 Enno Klasing
 # Full scale audit of all database queries
 # Altered mosArrayToInts to allow arrays with non-numeric indexes
 # Added check to com_categories if requested table exists
 # Fixed [artf5961] : mosMessage::send() uses noninitialized variables


14-Sep-2006 Marko Schmuck
 # Fixed [artf5481] : Parameter values not made HTML safe in editing form input control
 # Fixed [artf5906] : "New" icon missing in sections with categories but no content
 # Fixed [artf5166] : Server Time offset issue, while submitting news


14-Sep-2006 Sam Moffatt
 # Fixed [artf5476] : Template media import broken. Cannot import media files.


12-Sep-2006 Sam Moffatt
 # Fixed [artf5866] : com_content uses corrupted global $id for page navigation
 # Fixed [artf5719] : header_version.png right top


10-Sep-2006 Marko Schmuck
 # Fixed [artf5761] : single quote in sitename formats incorrectly with massmail
 # Fixed [artf5249] : Image align="center" command is Invalid - Should be align="middle"


09-Sep-2006 Marko Schmuck
 # Fixed [artf5753] : ampersand in action URL of showArchiveCategory form should be an entity
 # Fixed [artf5493][topic,81903] : Search error in PHP5 arraymerge - search for static content without a menulink


06-Sep-2006 Marko Schmuck
 # Fixed [artf5367] : Better mysql statement in content.searchbot.php
 # Fixed [artf5141] : image attribute name="image" breaks xhtml compliance when output multiple times
 # Fixed [artf5811] : Search component generates invalid html


06-Sep-2006 Andrew Eddie
 # Fixed [artf5799] : mysql_real_escape_string called incorrectly in database.php
 # Fixed [artf5581] : canDelete method doesn't work


31-August-2006 Mateusz Krzeszowiec
 # Fixed [artf5780] : lack of 'new' task in allowed tasks check
 # Fixed [artf5779] : lack of 'com_typedcontent' option in allowed options check


31-August-2006 Marko Schmuck
 # Fixed [artf5770] : $query variable not defined in functions in gacl.api.class.php
 # Fixed [artf3978] : mosBindArrayToObject ignore bug
 # Fixed [artf5169] : mosDBTable::publish hard coded key again
 # Fixed [artf5280] : SEF drops anchors
 # Fixed [topic,90725] : incorrect timezone values in config_offset_user dropdown
 # Fixed [artf5766] : Bannerupload failt
 # Fixed [artf5727] : mosTabs parent div class name error
 # Fixed [artf5432] : slashes not stripped in WebLinks
 # Fixed [artf5215][artf5412] : Successfully Saved Item: {title} ... slashes not stripped from title


----------------------------------------------------------------------------------------
---------------- 1.0.11 Stable Released -- [28-August-2006 20:00 UTC] ------------------


This Release Contains the following 26 Security Fixes

Joomla! utilizes the Open Web Application Security Project (OWASP) Top Ten Project to categorize security vunerabilities found within Joomla!
http://www.owasp.org/index.php/OWASP_Top_Ten_Project

--- - - - - - - - - ---

04 HIGH Level Threats fixed

A1 Unvalidated Input
 * Secured mosMail() against unvalidated input
 * Secured JosIsValidEmail() - in previous versions the existance of an email address somewhere in the string was sufficient

A6 Injection Flaws
 * Fixed remote execution issue in PEAR.php
 * Fixed Zend Hash Del Key Or Index Vulnerability

--- - - - - - - - - ---

04 MEDIUM Level Threats fixed

A1 Unvalidated Input
 * globals.php not included in administrator/index.php

A2 Broken Access Control
 * Added Missing defined( '_VALID_MOS' ) checks
 * Limit Admin `Upload Image` from uploading below `/images/stories/` directory
 * Fixed do_pdf command bypassing the user authentication

--- - - - - - - - - ---

18 LOW Level Threats fixed

A1 Unvalidated Input
 * Hardened Admin `User Manager`
 * Hardened poll module
 * Fixed josSpoofValue function to ensure the hash is a string

A2 Broken Access Control
 * Secured com_content to not allow the tasks 'emailform' and 'emailsend' if $mosConfig_hideEmail is set
 * Fixed emailform com_content task bypassing the user authentication
 * Limit access to Admin `Popups` functionality

A4 Cross Site Scripting
 * Fixed XSS injection issue in Admin `Module Manager`
 * Fixed XSS injection issue in Admin `Help`
 * Fixed XSS injection issue in Search

A6 Injection Flaws
 * Harden loading of globals.php by using require() instead of include_once();
 * Block potential misuse of $option variable
 * Block against injection issue in Admin `Upload Image`
 * Secured against possible injection attacks on ->load()
 * Secured against injection attack on content submissions where frontpage is selected
 * Secured against possible injection attack thru mosPageNav constructor
 * Secured against possible injection attack thru saveOrder functions
 * Add exploit blocking rules to htaccess
 * Harden ACL from possible injection attacks


-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --


28-Aug-2006 Rey Gigataras
 # SECURITY A6 [ LOW Level ]: Block potential misuse of $option variable


28-Aug-2006 Andrew Eddie
 # SECURITY A6 [ LOW Level ]: Harden ACL from possible injection attacks


24-Aug-2006 Rey Gigataras
 # SECURITY A6 [ LOW Level ]: Add exploit blocking rules to htaccess
 # SECURITY A6 [ LOW Level ]: Harden loading of globals.php by using require() instead of include_once();

 + Installation Security Warning check
 + Admin & Installation Version age warning


23-Aug-2006 Rey Gigataras
 # SECURITY A2 [ MEDIUM Level ]: Missing defined( '_VALID_MOS' ) checks

 + Admin Security Warning check


21-Aug-2006 Rey Gigataras
 # SECURITY A1 [ LOW Level ]: Hardened Admin `User Manager`


19-Aug-2006 Rey Gigataras
 # SECURITY A2 [ MEDIUM Level ]: Limit Admin `Upload Image` from uploading below `/images/stories/` directory
 # SECURITY A2 [ LOW Level ]: Limit access to Admin `Popups` functionality
 # SECURITY A4 [ LOW Level ]: [topic,73761] : XSS injection issue in Admin `Module Manager`
 # SECURITY A4 [ LOW Level ]: [topic,73761] : XSS injection issue in Admin `Help`
 # SECURITY A4 [ LOW Level ]: [topic,73761] : XSS injection issue in Search
 # SECURITY A6 [ LOW Level ]: [topic,73761] : Block against injection issue in Admin `Upload Image`


19-Aug-2006 Enno Klasing
 # SECURITY A1 [ HIGH Level ]: Secured mosMail() against unvalidated input
 # SECURITY A1 [ HIGH  Level ]: Secured JosIsValidEmail() - in previous versions the existance of an email address somewhere in the string was sufficient
 # SECURITY A2 [ LOW Level ]: Secured com_content to not allow the tasks 'emailform' and 'emailsend' if $mosConfig_hideEmail is set

 # Fixed : Empty subject in com_content mail2friend no longer possible
 # Fixed : Show error message if com_content mail2friend fails
 # Fixed : Show error message if com_contact mail fails
 ^ Moved all instances of is_email() amalgamated into JosIsValidEmail in /includes/joomla.php


18-Aug-2006 Rey Gigataras
 # SECURITY A1 [ MEDIUM Level ]: globals.php not included in administrator/index.php
 # SECURITY A2 [ MEDIUM Level ]: do_pdf command bypasses the user authentication
 # SECURITY A2 [ LOW Level ]: emailform com_content task bypasses the user authentication
 # SECURITY A1 [ LOW Level ]: harden poll module

 # Fixed [topic,72209] : Mambots fired on Modules
 + enable selective disabling of `Email Cloaking` bot via {emailcloak=off}


17-Aug-2006 Rey Gigataras
 + PERFORMANCE : Cache handling expanded to com_content showItem
 # Fixed [artf5266] : Blog-view shows "more..." even without intros
 # Fixed [topic,81673] : frontend.php itemid issue


17-Aug-2006 Mateusz Krzeszowiec
 # Fixed logging query before applying LIMIT


15-Aug-2006 Marko Schmuck
 # SECURITY A6 [ LOW Level ]: possible injection attacks on ->load()


15-Aug-2006 Andrew Eddie
 # SECURITY A6 [ HIGH Level ]: remote execution issue in PEAR.php


15-Aug-2006 Mateusz Krzeszowiec
 # PERFORMANCE [topic,83325] : SQL LIMIT in com_content frontend


14-Aug-2006 Andrew Eddie
 # SECURITY A6 [ LOW Level ]: Injection attack on content submissions where frontpage is selected
 # SECURITY A6 [ LOW Level ]: possible injection attack thru mosPageNav constructor
 # SECURITY A6 [ LOW Level ]: possible injection attack thru saveOrder functions


07-Aug-2006 Andrew Eddie
 # SECURITY A6 [ HIGH Level ]: Zend Hash Del Key Or Index Vulnerability
 # SECURITY A1 [ LOW Level ]: josSpoofValue function to ensure the hash is a string


28-July-2006 Robin Muilwijk
 # Fixed [artf5291] : missing onChange javascript code for filter field


27-July-2006 Robin Muilwijk
 # SECURITY A2 [ MEDIUM Level ]: [artf5335] : missing direct access line

 # Fixed [artf5282] : missing table row tag and self closing tag
 # Fixed [artf5297] : small html errors


17-July-2006 Robin Muilwijk
 # Fixed [artf5157] : typo in media manager
 # Fixed [artf5218] : duplicate entry of artf5157, typo in media manager


03-July-2006 Rey Gigataras
 # Fixed [artf5181] : 5 step for unrecoverable admin-page crash.
 # Fixed [artf5123] : Wrong name of function in joomla.cache.php
 # Fixed [artf5126] : includes/database.php uses deprecated function
 # Fixed [artf5171] : mosGetParam Default value issue
 # Fixed [artf5112] : A mere mistake in the file contact.html.php


--------------------------------------------------------------------------------------
---------------- 1.0.10 Stable Released -- [26-June-2006 00:00 UTC] ------------------


This Release Contains following Security Fixes

Joomla! utilizes the Open Web Application Security Project (OWASP) web application security system to categorize security vunerabilities found within Joomla!
http://www.owasp.org/index.php/OWASP_Top_Ten_Project


03 HIGH Level Threats fixed in 1.0.10

A1 Unvalidated Input
 * A1 - Secured `Remember Me` functionality against SQL injection attacks
 * A1 - Secured `Related Items` module against SQL injection attacks
 * A1 - Secured `Weblinks` submission against SQL injection attacks


01 MEDIUM Level Threats fixed in 1.0.10

A4 Cross Site Scripting
 * A4 - Secured SEF from XSS vulnerability


05 LOW Level Threats fixed in 1.0.10

A1 Unvalidated Input
 * A1 - Hardened frontend submission forms against spoofing
 * A1 - Secured mosmsg from misuse
 * A1 - Hardened mosgetparam by setting variable type to integer if default value is detected as numeric

A4 Cross Site Scripting
 * A4 - Secured com_messages from XSS vulnerability
 * A4 - Secured getUserStateFromRequest() from XSS vulnerability

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --


25-June-2006 Rey Gigataras
 # SECURITY A1 [ Low Level ]: mosgetparam sets variable type to integer if default value is detected as numeric

 # Fixed [artf5091] : Missing closing "}" in one of PatFactory templates
 # Fixed [topic,71858] : Content Archive issue when caching on
 # Fixed [topic,71859] : Unable to login frontend
 # Fixed [topic,67902] : SEF.php breaking community builder homepages


23-June-2006 Rey Gigataras
 # SECURITY A1 [ Low Level ]: mosmsg hardened

 # Fixed [artf5059] : Blog ordering, items by - most hits
 # Fixed [artf4969] : Missing Itemid in readmore with multi category blog
 # Fixed [artf5083] : Problem with Description/Description Image parameters of "List - Content Section"
 # Fixed [topic,67719] : Email Cloaking Ads extra space after cloaked address
 # Fixed [topic,66966] : E-mailing Cloaking Issue
 # Fixed [topic,67141] : pathway empty when showing poll results
 # Fixed [topic,67068] : Caching of Custom Heads still not working (not a full fix)


21-June-2006 Alex Kempkens
 # Fixed [artf5051] : Making cache aware of different languages
 ! Be aware that it is now important to include all parameters, even optional once, in the cached calls.


21-June-2006 David Gal
 # Fixed [topic,66858] : Can't set language


21-June-2006 Rey Gigataras
 # SECURITY A4 [ Medium Level ]: XSS vulerability when using SEF
 # SECURITY A4 [ Low Level ]: XSS vulerability in com_messages
 # SECURITY A4 [ Low Level ]: XSS vulerability in getUserStateFromRequest()

 # Fixed [artf4976] : htaccess file instructions confusing users
 # Fixed [artf4917] : PHP getenv function fails in ISAPI mode
 # Fixed [topic,69083] : mambots not being applied to `User` Module content
 # Fixed [topic,69894] : Filter doesn't work when cache on


20-June-2006 Rey Gigataras
 # Fixed [artf5025] : Category Titles with an Apostraphe leave a leading slash
 # Fixed [artf4927] : blocked user receives wrong error message
 # Fixed [topic,70612] : Very small text error in file sample_data.sql
 # Fixed [topic,69871] : mossef notice
 # Fixed [topic,68031] : Problems with banner.php
 # Fixed [topic,67826] : content.html weblinks.html display issues in Opera
 # Fixed [topic,67594] : Extra space in content.html.php
 # Fixed [topic,67016] : ATOM 0.3 Always enable even I disable ATOM 0.3 in Administrator Panel


19-June-2006 Rey Gigataras
 # SECURITY A1 [ High Level ]: `Remember Me` functionality SQL injection vulnerability
 # SECURITY A1 [ High Level ]: `Related Items` module SQL injection vulnerability
 # SECURITY A1 [ High Level ]: `weblinks` submission SQL injection vulnerability
 # SECURITY A1 [ Low Level ]: frontend submission forms hardened against spoofing

 # Fixed [artf5031] : Frontend Editing of Content Changes Start Publishing Time
 # Fixed [artf4951] : author submitting content gets error message
 # Fixed [artf5028] : Page navigation incorrect on pages viewed through archive module


16-June-2006 Rey Gigataras
 # Fixed [artf5006] : Contact-item print button
 # Fixed [artf4925] : alt="" not always output 1.0.9
 # Fixed [artf4921] : anchor links break
 # Fixed [artf4888] : too many columns in table layout of params
 # Fixed [topic,66859] : Table views of content category in backend
 # Fixed [topic,68201] : Permissions check page missing /mambots/system/
 # Fixed [topic,67115] : Error warning frontend.php
 # Fixed [topic,67144] : Check for status of SEF in mossef incorrectly commented out
 # Fixed [topic,67279] : Voting/Rating not working when disabled globally, but enabled locally for selected items

 # PERFORMANCE [topic,63468] : mod_fullmenu unnecessary count of archived items in section query


12-June-2006 Rey Gigataras
 # Fixed [artf4913] : Poll Module breaks "Add Article"
 # Fixed [artf4929] : Finish date not shown
 # Fixed [artf4881] : Extra space in English email text string
 # Fixed [topic,68467] : If 2 polls published - voiting on second poll not work


10-June-2006 Robin Muilwijk
 # Fixed [topic,68168] : Typo /administrator/components/com_content/admin.content.html.php - line 478
 # Fixed [topic,68168] : Typo /administrator/components/com_typedcontent/admin.typedcontent.html.php - line 266


--------------------------------------------------------------------------------------
---------------- 1.0.9 Stable Released -- [05-June-2006 16:00 UTC] ------------------


This Release Contains following Security Fixes

Joomla! utilizes the Open Web Application Security Project (OWASP) web application security system to categorize security vunerabilities found within Joomla!
http://www.owasp.org/index.php/OWASP_Top_Ten_Project


12 Low Level Threats fixed in 1.0.9

A1 Unvalidated Input
 * A1 - Harden mosmsg
 * A1 - Hardening of backend `User Manager` to stop 'Adminstrators' from being able to create 'Super Administrator' users

A2 Broken Access Control
 * A2 - Breadcrumbs title visibility even when access restricted
 * A2 - 'Edit Your Details' page now needs a published menu item to be accessible
 * A2 - 'Check-In My Items' page now needs a published menu item to be accessible
 * A2 - 'Submit News' page now needs a published menu item to be accessible
 * A2 - 'Submit Weblink' page now needs a published menu item to be accessible
 * A2 - Add ability to selectively disable certain types of syndicated feeds
 * A2 - Ensure module caching does not inadvertently make special level modules visible to registered users
 * A2 - Add ability to totally disable access to frontend login page
 * A2 - Add ability to disable frontend user params

A3 - Broken Authentication and Session Management
 * A3 - Changes to access level of user account will kill any active session for that user

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --


04-June-2006 Rey Gigataras
 # Fixed [artf4878] : inlegal dates in mysqll tables
 # Fixed : missing content cache clearing calls


03-June-2006 Rey Gigataras
 # Fixed [artf4864] : /includes/frontend.php
 # Fixed [topic,66138] : Invailid Session at Admin login
 # Fixed [topic,66044] : Installation checks
 # Fixed [topic,66276] : admin password ="0"
 # Fixed : No ability to set Cache time for Syndication modules
 # Fixed : `Remember Expired Admin page` functionality changed from 600 seconds to half the `Admin Session Lifetime` value
 # Fixed : Admin session purge (to limit only one active session per account) deleting frontend logged in session


03-June-2006 Robin Muilwijk
 # Fixed [topic,66360] : Fatal error com_contact/contact.php


01-June-2006 Rey Gigataras
 # Fixed : New Global Config params (added in 1.0.9) not created on clean install


31-May-2006 Rey Gigataras
 # SECURITY A2 [ Low Level ]: New `Global Config` param to allow disabling of Frontend Login
 # SECURITY A2 [ Low Level ]: New `Global Config` param to allow disabling of Frontend User params

 # Fixed [artf4844] : initial setup failure on IIS when installed in subdirectory
 # Fixed [topic,65009] : "Email to Friend" Can Send Unusable URLs
 # Fixed [topic,65604] : Notices when adding static content
 # Fixed [topic,65485] : Bug with menu item selector
 # Fixed : DB error when attempting a checkin action after cancelling from creating a New item


30-May-2006 Rey Gigataras
 # Fixed [topic,65381] : Override Created Date
 # Fixed [artf4830] : top menu items reversed in madeyourweb template


29-May-2006 Rey Gigataras
 # SECURITY A2 [ Low Level ]: [artf4752] : caching makes modules assigned to special user visible to registered users

 # Fixed [artf4812] : In footer.php (C) should be &copy;
 # Fixed [artf4806] : typo in mambots/search/contacts.searchbot.php causes sef errors
 # Fixed [artf4752] : patTemplate strip comments problems
 # Fixed [artf4752] : rss.php unnecessary logic code check
 # Fixed [topic,64994] : problem with related items
 # Fixed [topic,64046] : adding new content Frontend fails with Authorization Error


27-May-2006 Rey Gigataras
 # Fixed [topic,64308] : cache and content items on frontpage
 # Fixed [topic,63824] : Notice on com_contact
 # Fixed [artf4801] : inputFilter::filterTags prints unexpected text


23-May-2006 Rey Gigataras
 # Fixed [topic,63674] : MySQL 5 strict mode in Admin Backend


22-May-2006 Rey Gigataras
 # PERFORMANCE [topic,63468] : slow auto-login because of new MD5 calculations on whole users DB

 # Fixed [topic,63446] : Category and Section


21-May-2006 Rey Gigataras
 # Fixed [artf4714] : Can't add Menu Item :: Link - Static Content
 # Fixed : "Unique Itemid" handling for `Link - Content Item`
 # Fixed : Add "Unique Itemid" handling for `Link - Static Content`
 # Fixed [artf4714] : Can't add Menu Item :: Link - Static Content
 # Fixed [topic,62056] : Copyright date


20-May-2006 Rey Gigataras
 # Fixed [artf4733] : Module Manager reorder via save button broken
 # Fixed [artf4736] : Quotation marks in Site Name
 # Fixed [topic,63257] : Notice when creating new category


18-May-2006 Rey Gigataras
 # Fixed [artf4700] : pathway ampReplaces item name twice
 # Fixed [artf4712] : 'type' of $mosConfig_error_reporting does not match code

 + Remember Expired Admin page functionality


17-May-2006 Rey Gigataras
 # Fixed [artf4673] : setlocale
 # Fixed [artf4685] : unhandled fragment identifier with core SEF enabled
 # Fixed [artf4678] : Print, PDF and email buttons aren't accessible
 # Fixed [topic,62124] : Hover for icons when editing content in front-end
 # Fixed [topic,62165] : Canot login - admin_session_life not set


15-May-2006 Rey Gigataras
 # Fixed [topic,61926] : Frontend static language text
 # Fixed [topic,61971] : E-mail cloaking broken, TinyMCE `mce_href` problem
 # Fixed : Frontend Content editing does not display correct publishing date/time
 # Fixed : Frontend Content editing incorrect handling of 'Never' in `Finish Publishing`
 # Fixed : Incorrect date/time values on `Content Items Manager` and `Static Content Manager` pages


14-May-2006 Rey Gigataras
 * SECURITY A2 [ Low Level ]: add ability to selectively disable certain types of syndicated feeds

 ^ Upgrade to TinyMCE 2.0.6.1

 # Fixed [topic,61897] : Changing any parameter for logged user returns to login screen


13-May-2006 Rey Gigataras
 * SECURITY A1 [ Low Level ]: [artf4529] : User with access to administration area can easly create super administrator.

 # Fixed [artf4555] : Slight Bug in registration system
 # Fixed [artf4641] : Module sites with one template - modules should not show up - itemid issue
 # Fixed : `Itemid=99999999` appearing in next & prev navigation links
 # Fixed : `Itemid=` appearing in `Blog` links items


13-May-2006 Andrew Eddie
 # Fixed [artf3302] : PatTemplate custom Functions getpage() undefined


12-May-2006 Louis Landry
 # Fixed [artf4284] : database::load() resets private properties


12-May-2006 Rey Gigataras
 # Fixed [topic,60970] : Finish Publishing Time not working as expected


11-May-2006 Rey Gigataras
 # Fixed [artf4614] : Warning in mosCreateGUID
 # Fixed [artf4619] : task=category shows unpublished items
 # Fixed [artf4621] : Media manager with long filenames = no button
 # Fixed [artf4613] : Sub Menu Item deletion Security Bug
 # Fixed [artf4613] : Restoring menu items without a valid parent
 # Fixed [topic,59258] : bug when editing user profile
 # Fixed [topic,61190] : Menu Item Inconsistency


10-May-2006 Sam Moffatt
 # Fixed issue with login directly after activation causing error, now redirects to index.php


09-May-2006 Rey Gigataras
 # Fixed [artf4577] : saveUser in com_user has incorrect escaping for password


28-Apr-2006 Alex Kempkens
 # Fixed artf : Language loading incorrect in offline mode (related to Joom!Fish language changes)


27-Apr-2006 Rey Gigataras
 + Support for restricting ability to access certain functionality for demo sites

 # Fixed [artf4527] : incorrect style in function botNoEditorEditorArea
 # Fixed [topic,57926] : mod_poll.php Warning


26-Apr-2006 Rey Gigataras
 # Fixed [artf3912] : Pear's cache lite and safe_mode
 # Fixed [artf3711] : mosemailcloak generates invalid XHTML
 # Fixed [artf3251] : Wrong file count in Media Manager
 # Fixed [artf3196] : com_media does not properly manage file names with simple quotes (')


25-Apr-2006 Rey Gigataras
 ^ PERFORMANCE [topic,54215] : MOSimage array affects edit page load time


24-Apr-2006 Rey Gigataras
 * SECURITY A3 [ Low Level ]: logged in user session are not affected by changes of user account

 # Fixed [artf4503] : Hardcoded text in page navigation
 # Fixed [artf4473] : Bad char in search
 # Fixed [artf4499] : Editing Quotated Menu Item
 # Fixed [artf4472] : Creating New User system message only sends to superusers
 # Fixed : Unable to 'Delete' `Super Administrator` - with check to ensure at least one active `Super Administrator` still exists
 # Fixed : Unable to 'change' group of `Administrator` & `Super Administrator` - with check to ensure at least one active `Super Administrator` still exists


20-Apr-2006 Rey Gigataras
 * SECURITY A3 [ Low Level ]: Allow only one session per user account in Admin Backend

 + Allow `save` and `apply` actions to be completed before logging out expired sessions


20-Apr-2006 Andrew Eddie
 # Fixed slow query in com_polls
 # Fixed return address errors in patErrorManager
 # Fixed MySQL 5 error when saving menu items


18-Apr-2006 Rey Gigataras
 + Javascript validation checks to mod_poll


16-Apr-2006 Rey Gigataras
 # Fixed [artf4424] : gethostbyaddr(): Address is not a valid IPv4 or IPv6 address
 # Fixed [artf4407] : Image preview doesn't work with custom directory
 # Fixed [topic,54741] :  Who's Online guest count increments with RSS feed access


14-Apr-2006 Rey Gigataras
 # Fixed [artf4400] : Search: Itemid in mod_search also finds trashed Itemid's
 # Fixed [artf4399] : Search title in com_search is never from language file


12-Apr-2006 Rey Gigataras
 # Fixed [artf4346] : $mainframe->login($username,$pwd) compatibility broken
 # Fixed : `body` parameter for mailto tags


11-Apr-2006 Rey Gigataras
 # Fixed [artf4340] : Itemid on menu - multiple links to same content
 # Fixed : cache support for `Blog - Content Section Archive` & `Blog - Content Category Archive`
 # Fixed : SEF.php incorrect handling of `mailto` & `javascript` links
 # Fixed : $shownoauth default value in `configuration.php-dist`
 # Fixed : `live_bookmarks` not being disbaled properly by security check;
 # Fixed : admin `contact` and `weblink` ordering


08-Apr-2006 Rey Gigataras
 # Fixed [topic,45136.0] : stop Cache system from creating large amount of Cache files
 # Fixed [artf4302] : 'Read more' link is always displayed if 'Linked Titles' option enabled
 # Fixed [artf4304] : Bugs in search.html.php
 # Fixed : Content Popup page behaviour


07-Apr-2006 Rey Gigataras
 # Fixed [artf4294] : InputFilter failed escaping string
 # Fixed [artf4050] : mod_mainmenu.php not setting id=active_menu


06-Apr-2006 Rey Gigataras
 * SECURITY A2 [ Low Level ]: check for menu item added to 'Edit Your Details' page
 * SECURITY A2 [ Low Level ]: check for menu item added to 'Check-In My Items' page
 * SECURITY A2 [ Low Level ]: check for menu item added to 'Submit News' page
 * SECURITY A2 [ Low Level ]: check for menu item added to 'Submit Weblink' page

 # Fixed [artf4282] : Extra Empty Menu Span Tags


05-Apr-2006 Rey Gigataras
 # Fixed [artf4010] : When creating new module. Two modules are created when clicking save


02-Apr-2006 Rey Gigataras
 # Fixed [artf3575] : Correction needed in stylesheet
 # Fixed [artf4089] : Problem with domit, extended characters and PHP 5.0.2


01-Apr-2006 Rey Gigataras
 # Fixed [topic,50547.0.html] : Print statement left in class.inputfilter.php
 # Fixed [topic,48908.0.html] : Duplicate usernames / Length Checking


31-Mar-2006 Rey Gigataras
 # Fixed [topic,46614.0.html] : mod_templatechooser not working when templates name has dashes


30-Mar-2006 Rey Gigataras
 * SECURITY A1 [ Low Level ]: [artf3702] : breadcrumbs: information gathering possible by simple urlhacks

 # Fixed [topic,47932.0.html] : 1.0.8 com_contact - incorrect URL?

 ^ Upgrade to Geshi 1.0.7.8


29-Mar-2006 Rey Gigataras
 # Fixed [artf4133] : Blog - Content Section Archive
 # Fixed [artf4093] : No parameter tool tip when ' is used in module.xml
 # Fixed [artf4028] : url to the site is added to the entered link in a menu item (SEF disabled)
 # Fixed [artf4102] : mosimage.php - Erroneous right alignment of images
 # Fixed [artf4131] : com_contact displays non-localized message

 ^ Upgrade to TinyMCE 2.0.5.1
 ^ Upgrade to TinyMCE compressor 1.0.8
 ^ TinyMCE remove `Help` tab in help popup
 ^ TinyMCE 'word wrap' by default for html source mode


27-Mar-2006 Alex Kempkens
 # corrcted searchbot; finding dynamic content while searching for static
 # updated core-SEF support for new multilingual_content config var


24-Mar-2006 Alex Kempkens
 + Check for mambot/system directory in installer and installation dialogs
 # [artf4066]	content sections not being translated


16-Mar-2006 Rey Gigataras
 # Fixed [artf3913] : [artf3809]: Error with < AND > in tinymce - static content manager
 # Fixed : checked out lock icon visible for same user
 # Fixed : Global Config JS error when no session_type value yet set - issue only when upgrading
 # Fixed [topic,44206.0.html] : XML help files no longer supported


15-Mar-2006 Rey Gigataras
 # Fixed [artf3927] : Typo in Installer Screen
 # Fixed [artf3940] : single quotes/apostrophes (')
 # Fixed [topic,46202.0.html] : Problem found in Session id function


13-Mar-2006 Rey Gigataras
 ^ PERFORMANCE : com_content only add call to jos_content_rating where voting option activated


12-Mar-2006 Rey Gigataras
 # Fixed [topic,44117.0.html] : com_menumanager can not handle simple quotes (')
 # Fixed [topic,34821.0.html] : Allow search on static contents not linked to a menu

 ^ PERFORMANCE : com_statistics `Search Engine Text` page, results returned off by default as highly query intensive and can cause site lockup
 ^ `Page Hits` into `Content` sub-menu


11-Mar-2006 Alex Kempkens
 # Fixed some queries missing primary key for translations (contact, newsfeed)


11-Mar-2006 Rey Gigataras
 # Fixed [artf3873] : Invalid Itemid for com_content Category Link
 # Fixed [topic,45343.0.html] : Random image default behavoir

 + PERFORMANCE : Auto purge of expired messages for com_messages [default of 7 days]


10-Mar-2006 Rey Gigataras
 # Fixed [artf3885] : Remove the last hardcoded texts
 # Fixed [artf3713] : Joomla still doesn't work with SQL mode enabled

 ^ Ensure showPathway is only called once


09-Mar-2006 Rey Gigataras
 # Fixed [artf3863] : mod_whosonline double ONLINE
 # Fixed [topic,44644.0.html] : Miss spelled Position as Postition
 # Fixed [topic,41593.0.html] : Table - content section - filter works only for the first page


08-Mar-2006 Rey Gigataras
 # Fixed [artf3847] : A mistake in joomla_admin template
 # Fixed [artf3748] : Archive - Access Denied
 # Fixed [artf3592] : Archive Pagination Problem
 # Fixed [topic,41627.0.html] : "Undefined variable: filter"
 # Fixed [topic,43315.0.html] : Static text in content.php
 # Fixed [topic,41466.0.html] : NullDate AND '0000-00-00 00:00:00'

 ^ Global define of _CURRENT_SERVER_TIME
 ^ sef.php optimization


07-Mar-2006 Rey Gigataras
 + Show whether Cache directory is writable where it is used - com_newsfeeds, com_syndicate, custom modules

 # Fixed [artf3818] : Path error for agent_browser.php in joomla.php
 # Fixed ensure all require and include calls are using absolute paths


06-Mar-2006 Rey Gigataras
 # Fixed [artf3756] : mossef bot rewrites javascript:void(0) in href
 # Fixed [artf3745] : includes/joomla.php on line 790 setSessionGarbageClean
 # Fixed [topic,41619.0.html] : mosimage caption problem
 # Fixed [topic,42023.0.html] : sample data error with Link - Static Content CID value


02-Mar-2006 Rey Gigataras
 # Fixed [artf3728] : Error if change the "Syndicate" name in db table "jos_components"
 # Fixed [artf3731] : mod_newsflash shows errors when no items are available
 # Fixed [artf3733] : Site (frontend): url to the site is added to the entered link in a content item.
 # Fixed [artf3696] : Typo Site Mambot: Edit [ TinyMCE WYSIWYG Editor ]
 # Fixed [artf3658] : "New" Content Link/Image Showing With No Categories Present
 # Fixed [artf3697] : sefreltoabs error with links to other sites


01-Mar-2006 Rey Gigataras
 * SECURITY A1 [ Low Level ]: Harden mosmsg

 # Fixed [artf3656] : contact-component, dropdown


28-Feb-2006 Rey Gigataras
 # Fixed [artf3655] : Login module error
 # Fixed [artf3668] : mosemailcloak bug with mailto:
 # Fixed [artf3681] : invalid markup in com_content showCategories()
 # Fixed [artf3688] : Hardcoded text in contact.html.php
 # Fixed [artf3664] : Image links gets preceeded by "Live Site" URL after v1.0.8 upgrade
 # Fixed [artf3703] : configuration.php-dist has a typo
 # Fixed [topic,41404.0.html] : configuration.php-dist missing `;`


--------------------------------------------------------------------------------------
---------------- 1.0.8 Stable Released -- [25-Feb-2006 04:00 UTC] ------------------

This Release Contains following Security Fixes

Medium Level Threat
 * Hardening of Remember Me login functionality
 * Protect against real server path disclosure via syndication component
 * Limit arbitrary file creation via syndication component
 * Protect against real server path disclosure in mod_templatechooser

 * Disallow `Weblink` item from being accessible when 'unpublished'
 * Disallow `Polls` item from being accessible when 'unpublished'

 * Disallow `Newfeeds` item from being accessible when category 'unpublished'
 * Disallow `Weblinks` item from being accessible when category 'unpublished'

 * Disallow `Content` item from being accessible despite section/category 'access level'
 * Disallow `Newsfeed` item from being accessible despite category 'access level'
 * Disallow `Weblink` item from being accessible despite category 'access level'

 * Disallow `Content` item from being visible despite category 'access level' in `Content Section` view  - `Blog - Content Section` & `Blog - Content Section Archive`

 * Disallow `Content` items from being viewable when category/section 'unpublished' - mod_newsflash


 Low Level Threat
 * Harden frontend Session ID
 * Harden against multiple Admin SQL Injection Vulnerabilities
 * Disable ability to enter more than one email address in Contact Component contact form
 * Harden Contact Component with param option to check for existance of session cookie - enabled by default
 * Addiotnal check for correct Admin session name

 * Disallow access to syndication functionality
 * Disallow `Newsfeeds` Categories from being accessible when 'unpublished'
 * Disallow `Contact` Categories from being accessible when 'unpublished'
 * Disallow `Weblink` Categories from being accessible when 'unpublished'
 * Disallow `Content Section` from being accessible when section 'unpublished' - `List - Content Section`
 * Disallow `Content Category` from being accessible when category/section 'unpublished' - `Table - Content Category`

 * Disallow `Contact` Categories from being accessible as per category 'access level'
 * Disallow `Newsfeeds` Categories from being accessible as per category 'access level'
 * Disallow `Weblinks` Categories from being accessible as per category 'access level'
 * Disallow `Content Section` from being accessible as per section 'access level' - `List - Content Section`
 * Disallow `Content Category` from being accessible as per section/category 'access level' - `Table - Content Category`
 * Disallow `Content Category` from being accessible as per category 'access level' - `Blog - Content Category` & `Blog - Content Category Archive`

 * Disallow `Content` item links from being visible as per category/section 'access level' - mod_newsflash, mod_latestnews, mod_mostread

 * Disallow Category Search returning items despite section 'access level' & section 'state'
 * Disallow Contact Search returning items despite 'access level' & category 'state'
 * Disallow Content Search returning items despite section 'access level'
 * Disallow Newsfeed Search returnings items despite category 'state'
 * Disallow Weblink Search returning items despite category 'state'

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --


25-Feb-2006 Rey Gigataras
 # Fixed [topic,40568.0.html] : Conversion of &amp; to & when editing 'new' modules, breaking xhtml compliance
 # Fixed [topic,40568.0.html] : Itemid=99999999 visible when navigating polls
 # Fixed [artf3630] : Site name printed twice in the popup window title (print, email to friend)

 ^ Upgraded to TinyMCE 2.0.4

 - Depreciated Admin templates - mambo_admin & mambo_admin_blue


24-Feb-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Add check for correct Admin session name

 # Fixed HTTP_ACCEPT_ENCODING problems
 # Fixed incorrect handling of external links with mossef

 ^ Special Flag to allow different login behaviour of site for Production vs online Demo site


23-Feb-2006 Robin Muilwijk
 # Fixed [topic,39449.0.html] : typo in menu manager


23-Feb-2006 Rey Gigataras
 ^ Global Config session life only controls purging of frontend logged in sessions
 ^ Guests session separately purged at a hardcoded 900 seconds


22-Feb-2006 Rey Gigataras
 # Fixed [artf3591] : Error if unpublish menu item
 # Fixed [topic,39295.0.html] : SEF handling of custom .htaccess reconfigured urls
 # Fixed [topic,39295.0.html] : mod_login return value incorrectly returning 'index.php?' if coming from site homepage

 ^ Frontend Session Tracking cookie uses `Expire at End of Session`, rather than expiry by a set time to resolve issues with incorrect system clocks


21-Feb-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: Real server path disclosure in mod_templatechooser

 # Fixed [topic,39295.0.html] : Incorrect favicon path in installer
 # Fixed [topic,39295.0.html] : Admin logout does not clear/delete session being logged out

 ^ Remember Me Cookie amalgamated into a single cookie.


20-Feb-2006 Rey Gigataras
 # Fixed [topic,39295.0.html] : error in TinyMCE 2.0.3 (toggle fullscreen mode)


20-Feb-2006 Andrew Eddie
 # Fixed filelist param - would always show list entries related to images for default and do not use


19-Feb-2006 Rey Gigataras
 # Fixed [topic,36462.0.html] : time check incorrectly being based on local time - rather than server time
 # Fixed [topic,39103.0.html] : utf-8 encoded newsfeeds in a ISO-8559-1 site


18-Feb-2006 Rey Gigataras
 # Fixed [topic,39101.0.html] : Newsfeeds do not display

 ^ PERFORMANCE : General query reduction work
 ^ PERFORMANCE : Reduce queries used by search bots to load params
 ^ PERFORMANCE : 'editor-xtd' bot group loaded only once - affect = reduction in queries
 ^ Refactored session handling code for Admin sessions

 + session.gc_maxlifetime setting for Admin Sessions


17-Feb-2006 Rey Gigataras
 # Fixed [artf3543] : Rev 2393 Language Manager Error
 # Fixed [topic,22061.0.html] : Wrapper Autoheight ability set to off by default, as causes javascript errors when used on sites not on your domain
 # Fixed [topic,30542.0.html] : MySQL 5 support in strict mode
 # Fixed [artf3605] : Spelling error when saving content
 # Fixed [artf3576] : Javascript conflict in mod_wrapper

 ^ PERFORMANCE : `dynamic` Itemid checks store previous query results - affect = reduction in queries
 ^ PERFORMANCE : `static` Itemid counters now loads only once - affect = reduction in queries
 ^ PERFORMANCE : 'content' bot group loaded only once instead of each time content is loaded - affect = reduction in queries
 ^ PERFORMANCE : individual 'content' bot query to pull params loaded only once instead of each time content is loaded - affect = reduction in queries

 + new Admin Session Life Global Config param, allowing setting of admin session idle logout time
 + query debug mode to backend


16-Feb-2006 Rey Gigataras
 # Fixed [artf3523] : mosemailcloak issue with mailto params
 # Fixed : disable mossef bot from working on mailto links
 # Fixed [topic,36637.0.html] : SEF deactivated relative & absolute url handling
 # Fixed [topic,36637.0.html] : Session username not correct for those coming from `Remember Me` cookie

 + PERFORMANCE : Simple check for all bots to determine whether they should process further
 ^ PERFORMANCE : Reduce queries used by bots to load params - mosemailcloak, mosimage, mosloadposition, mospaging - affect = reduction in queries
 ^ PERFORMANCE : 'editor-xtd' bot group loaded only when needed - affect = reduction in queries


15-Feb-2006 Rey Gigataras
 # Fixed [artf3527] : "New" Content Link and Image Not Present When Category Empty
 # Fixed [topic,36462.0.html] : Static Content Start/Finish publishing time is based on server time, not local time
 # Fixed : Publisher submission message for frontend content editing/submission


14-Feb-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Disable ability to enter more than one email address in Contact Component contact form

 # Fixed [artf3144] : NULL values from SQL tables not loaded
 # Fixed [topic,31769.0.html] : $access variable conflict com_content
 # Fixed [topic,32201.0.html] : mod_related_items urls not xhtml compliant
 # Fixed [topic,31185.0.html] : heading in pagination not working
 # Fixed [topic,10947.0.html] : Add Prefix check to installer
 # Fixed [artf3082] : Template preview *still* not available
 # Fixed [artf2925] : mosGetParam has side affects
 # Fixed [topic,38017.0.html] : Content -> New -> Cancel

 ^ Upgraded TinyMCE to 2.0.3 & TinyMCE GZip Compressor to 1.0.7


13-Feb-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: Hardening of Remember Me login functionality
 * SECURITY [ Low Level ]: Harden Contact Component with param option to check for existance of session cookie - enabled by default


12-Feb-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Multiple Admin SQL Injection Vulnerabilities
 * SECURITY [ Low Level ]: Category Search returns items despite section 'access level' & section 'state'
 * SECURITY [ Low Level ]: Contact Search returns items despite 'access level' & category 'state'
 * SECURITY [ Low Level ]: Content Search returns items despite section 'access level'
 * SECURITY [ Low Level ]: Newsfeed Search returns items despite category 'state'
 * SECURITY [ Low Level ]: Weblink Search returns items despite category 'state'

 # Fixed [artf3391] : Aphostrophes in Category: Edit
 # Fixed [artf3291] : Alert() problem
 # Fixed [artf3188] : Unnecessary table cell in contact.html.php
 # Fixed [artf3121] : css errors in tiny_mce and rhuk_solarflare_ii template
 # Fixed [artf3181] : Task routing class
 # Fixed [artf3400] : showCalendar does not get value of date
 # Fixed [artf3348] : Bold tag overrides css in mod_poll.php
 # Fixed [artf3120] : &and & &link not defined in admin.categories.php
 # Fixed [artf3446] : Problems with mosimage with caption
 # Fixed [artf3100] : Incorrect Response Headers for Missing Pages
 # Fixed [artf3220] : Search bug: No way to update referenced search component
 # Fixed [artf3438] : RSS Feed Created it not base on the same encoding of the content
 # Fixed [artf3108] : Joomla 1.0.7 core SEF bug gives 404 on homepage
 # Fixed [artf3169] : RSS feeds does not work with SEF disabled


11-Feb-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: Protect against real server path disclosure via syndication component
 * SECURITY [ Medium Level ]: Limit arbitrary file creation via syndication component

 # Fixed [artf3397] : link to menu and loss of images list
 # Fixed [artf3109] : 1.0.7 "The XML page cannot be displayed ERROR" ob_gzhandler issue
 # Fixed [artf3447] : TinyMCE and relative urls
 # Fixed [artf3183] : Sub-menu items of separators not showing in module menu selection list
 # Fixed [artf3103] : $mosConfig_cachepath not used everywhere
 # Fixed [artf3114] : mod_related_items outputs nothing
 # Fixed [artf3234] : mod_related_items unitialized mosConfig_offset variable
 # Fixed [artf3402] : Missing param in module
 # Fixed [artf3067] : Reopen: Unhandled fragment identifier with core SEF enabled
 # Fixed [topic,31813.0.html] : new .htaccess gives proper 404s [Steve Graham]

 + Disable session.use_trans_sid to .htaccess


10-Feb-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Harden frontend Session ID

 # Fixed [artf3421] : Session cleanup relies on administrator login
 # Fixed [artf3307] : Error in code - non critical, but logout setcookie not working
 # Fixed [artf3126] : Short open PHP tag in pathway.php
 # Fixed [artf3126] : [artf3413] : small problem with variable in xml_domit_lite_parser.php
 # Fixed [topic,34620.0.html] : Excessive Joomla Sessions, and AOL Login Problem [Steve Graham]
 # Fixed mosWarning() $title error

 + New Session Type Global Config param

08-Feb-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: # Fixed : `Content` items viewable when category/section 'unpublished' - mod_newsflash
 * SECURITY [ Low Level ]: # Fixed : `Content` item links visible despite category/section 'access level' - mod_newsflash, mod_latestnews, mod_mostread

 # Fixed [artf3393] : Latestnews doesn't show static content


07-Feb-2006 Robin Muilwijk
 # Fixed [artf3328], 1.0.7 EN Installation Typo - Step 1
 # Fixed [artf3401] : Spelling errors in two modules


31-Jan-2006 Rey Gigataras
 + Additional Contact Component hardening


30-Jan-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: # Fixed : `Content` item accessible despite section/category 'access level'
 * SECURITY [ Medium Level ]: # Fixed : `Content Section` view `Content` items visible despite category 'access level' - `Blog - Content Section` & `Blog - Content Section Archive`
 * SECURITY [ Medium Level ]: # Fixed : `Newsfeed` item accessible despite category 'access level'
 * SECURITY [ Medium Level ]: # Fixed : `Weblink` item accessible despite category 'access level'
 * SECURITY [ Low Level ]: # Fixed : `Contact` Categories accessible despite category 'access level'
 * SECURITY [ Low Level ]: # Fixed : `Newsfeeds` Categories accessible despite category 'access level'
 * SECURITY [ Low Level ]: # Fixed : `Weblinks` Categories accessible despite category 'access level'
 * SECURITY [ Low Level ]: # Fixed : `Content Category` view accessible despite section/category 'access level' - `Table - Content Category`
 * SECURITY [ Low Level ]: # Fixed : `Content Category` view accessible despite category 'access level' - `Blog - Content Category` & `Blog - Content Category Archive`
 * SECURITY [ Low Level ]: # Fixed : `Content Section` view accessible despite section 'access level' - `Table - Content Section`

 ^ Contact Items display Authorization block text if category 'access level' denies access
 ^ Blog pages display Authorization block text if section/category 'access level' denies access


29-Jan-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: # Fixed : `Weblinks` item accessible when category 'unpublished'

 ^ Blog pages display Authorization block text if section/category being unpublished


25-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: # Fixed : No way to disable access to syndication functionality


17-Jan-2006 Rey Gigataras
 * SECURITY [ Medium Level ]: # Fixed : `Weblink` item accessible when 'unpublished'
 * SECURITY [ Medium Level ]: # Fixed : `Polls` item accessible when 'unpublished'
 * SECURITY [ Medium Level ]: # Fixed : `Newfeeds` item accessible when category 'unpublished'
 * SECURITY [ Low Level ]: # Fixed : 'unpublished' `Newfeeds` Categories accessible
 * SECURITY [ Low Level ]: # Fixed : 'unpublished' `Contact` Categories accessible
 * SECURITY [ Low Level ]: # Fixed : 'unpublished' `Weblink` Categories accessible
 * SECURITY [ Low Level ]: # Fixed : `Content Section` accessible when section 'unpublished' - `List - Content Section`
 * SECURITY [ Low Level ]: # Fixed : `Content Category` view accessible when category/section 'unpublished' - `Table - Content Category`


--------------------------------------------------------------------------------------
---------------- 1.0.7 Released -- [15-Jan-2006 20:00 UTC] ------------------


15-Jan-2006 Rey Gigataras
 # Fixed : database password being incorrectly overwritten with a blank


--------------------------------------------------------------------------------------
---------------- 1.0.6 Released -- [15-Jan-2006 15:00 UTC] ------------------

This Release Contains following Security Fixes

Low Level Threat
* Disallow Author from publishing items or changing publish state
* Hardened Contact Component against misuse
* Added simple filtering control ability to Contact Component
* Hardened misuse of Contact Component `email copy` ability when not activated
* Hardened misuse of Contact Component `VCard` ability when not activated
* `VCard` & `Email Copy` options set to hide by default
* Multiple Vulnerabilities in TinyMCE Compressor
* Hardened Itemid against misuse
* Hide database password in Global Configuration

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --

15-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Hide database password in Global Configuration
 # Fixed [artf3064] : Warning: Invalid argument supplied mod_fullmenu Line 57
 # Fixed [artf3063] : Poll Component Output Display Error

14-Jan-2006  Louis Landry
 # Fixed Caching `Blog` pagination problem

14-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: disallow Author from publishing items or changing publish state [identified Max Dymond]
 # Fixed [artf3055] : Weblink submit, no email to admin
 # Fixed [artf3045] : Unhandled fragment identifier with core SEF enabled
 # Fixed [artf3032] : 1783: Can't get custom CSS in Tiny MCE
 # Fixed [artf3052] : Contact Component Re-Direct Issue
 # Fixed [artf3043] : Login & Logout redirecting to $mosConfig_live_site
 # Fixed [artf3040] : Site Modules | Display can be duplicated on Pages
 # Fixed problem with display mod_rssfeed twice on a page
 ^ Contact Component confirmation now uses mosredireect msg, rather than JS

13-Jan-2005 Andrew Eddie
 # Fixed bug in database::loadRowList that reutrn assoc and not numerical array
 # Fixed bug in index2.php where joomlajavascript.js is not included

13-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: + simple filter check to Contact Component
 # Fixed [artf3038] : Warning: array_search(): Wrong datatype for second argument in
 # Fixed [artf3037] : New 404 tags aren't translated
 # Fixed [artf3035] : Bug with mod_newsflash

12-Jan-2006 Alex Kempkens
 # Fixed mosFormateDate, handling offset's with value 0

12-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: changed `Email Copy` param option for new Contacts now set to `hide`
 # Fixed [artf2070] : mosHTML:encoding_converter() breaks with &ouml;
 # Fixed missing <li> tag in newsfeed component
 # Fixed [artf1487] : Media Manager breaks when illegal characters in uploaded file name
 # Fixed [artf2108] : Saving a parent inside of a child
 + caching support to `Frontpage` component
 + missing param for `Table - Weblink Category`
 - sef handling in mod_search.php as SEF
 - unnecessary `checked out` check in  mod_latestnews.php and mod_mostread.php
 - unnecessary param variable in mod_latestnews.php

10-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Fixed [artf2386] : Preventing Spambots through com_contact
 # Fixed [artf2622] : admin.users.php session_start called when a session is already open
 # Fixed [artf2789] : invalid xhtml
 # Fixed [artf2989] : User WYSIWYG editor setting resets after adding new user from backend
 # Fixed [artf2986] : Wrong link to image-icon in weblinks

08-Jan-2006 Johan Janssens
 * SECURITY [ Low Level ]: Fixed Security Vulnerability in TinyMCE Compressor

08-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Fixed [artf2950] : Information leak with Vcard hide function
 * SECURITY [ Low Level ]: changed `VCard` param option for new Contacts now set to `hide`
 # Fixed DOMIT bugs [identified by sarahk] http://sarahk.pcpropertymanager.com/blog/using-domit-rss/225/
 # Fixed [artf2793] : New user confirmation link warning on login
 # Fixed [artf2732] : Pagination in the Blog section/category doesnt work
 # Fixed [artf2943] : Incorrect Redirect for Weblinks
 # Fixed [artf2945] : Undefined constant in php_http_exceptions.php

07-Jan-2006 Rey Gigataras
 # Fixed [artf2933] : Pathway problem on Windows

06-Jan-2006 Rey Gigataras
 ^ changed mod_archive so that no Itemid is assigned, meaning it uses the default Itemid=99999999
 # Fixed [artf2738] : Incorrect SEF links for archive com_content links
 # Fixed [artf1809] : mospagebreak problem with "Special Characters"
 # Fixed [artf2861] : article_seperator glitch

05-Jan-2006 Rey Gigataras
 # Fixed [artf2825] : RSS module SEF urls

04-Jan-2006 Rey Gigataras
 * SECURITY [ Low Level ]: Fixed [artf2050] : Itemid in index2.php
 # Fixed Related items Module shows Expired items - Mambo Tracker [#7590]
 # Fixed [artf2185] : Changing weblinks possible for everyone

03-Jan-2006 Andy Miller
 ^ Updated copyright information for iCandy Junior icons

03-Jan-2005 Rey Gigataras
 # Fixed XHTML validation error in `Blog` view with decmimal value widths
 # Fixed XHTML validation error in `Table - Content Category`
 # Fixed [artf2791] : RSS item links not SEF'd
 # Fixed [artf2791] : RSS items have no category
 # Fixed [artf2813] : Media Manager doesn't support ICO files

02-Jan-2006 Rey Gigataras
 # Fixed [artf2802] : All content made bold for Rss module published on the frontpage
 # Fixed [artf2780] : Newsflash Read More bad link
 # Fixed [artf2786] : Newsflash module not picking up "linked title" global setting
 # Fixed [artf2810] : 1.0.x changelog incorrectly states release date of 1.0.5

30-Dec-2005 Rey Gigataras
 # Fixed `Unlimited` banner impressions option
 # Fixed [artf2776] : Multiple banners not possible
 # Fixed [artf2788] : admin template css errors

29-Dec-2005 Rey Gigataras
 # Fixed [artf2646] : name="" not valid XHTML
 # Fixed [artf2747] : title_alias is missing in mambots
 # Fixed `Reset Clicks` button not working in admin component `Banner Manager`
 # Fixed [artf2712] : Clicks reset on save

29-Dec-2005 Andrew Eddie
 ^ SEF error handling throws to new /templates/404.php file
 # Rolled back changes to database::insertObject
 + New prototype MySQL 5 driver

24-Dec-2005 Emir Sakic
 # Fixed a bug with 404 header being returned for homepage when SEF activated
 # Fixed a bug with all items on frontpage returning Itemid=1 (duplicate content)


--------------------------------------------------------------------------------------
---------------- 1.0.5 Released -- [24-Dec-2005 10:00 UTC] ------------------


This Release Contains following Security Fixes

Medium Level Threats
* Hardened ability to use the contact component to proliferate spam

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --

21-Dec-2005 Andrew Eddie
 # Fixed slow query in com_content (Author text in a content item is now set to Written By)
 # Fixed bug in backend poll entry with ' is in option name
 # Fixed bug where content modified date is not updated on a bluck publish/archive operation
 + Added TEMPLATEURL to patTemplate preloaded variables
 ^ patTemplate Translate now recognises 1.0 version language constants

20-Dec-2005 Emir Sakic
 # Fixed [artf2432] : Apostrophe in paths isn't escaped properly

20-Dec-2005 Johan Janssens
 # Fixed [artf2389] : gzip compression not operational
 # Fixed [artf2599] : loosing Itemid afet submitting "ask for new password"
 # Fixed [artf1712] : Search Mambots return duplicate results
 # Fixed [artf2534] : Template chooser no longer able to manage SEF urls / XHTML validation
 # Fixed [artf1410] : 'Special' access menu locks out 'public' menu's articles "read more" content
 # Fixed [artf2595] : Deleted "mass mail" item menu in component menu
 # Fixed [artf2518] : mod_latestnews problem
 # Fixed [artf2591] : mosMakePath problem with mkdir on strato
 # Fixed [artf2665] : Most Read module generates incorrect class for <li> statement
 # Fixed [artf2666] : Pagination Error in Category Manager
 # Fixed [artf2407] : parameter type=mos_category show only "- Select Content Category -"

16-Dec-2005 Andy Miller
 # Fixed mod_whosonline not rendering list properly

07-Dec-2005 Andrew Eddie
 + Added database::getAffectedRows to db connectors

10-Dec-2005 Emir Sakic
 # Fixed [artf2517] : "Cancel" the editing of content after "apply" not possible

09-Dec-2005 Emir Sakic
 # Fixed [artf2324] : SEF for components assumes option is always first part of query
 # Fixed [artf1955] : Search results bug

07-Dec-2005 Andrew Eddie
 # Fixed unitialised array in mosHTML::MenuSelect method
 + Added mosBackTrace debugging function
 # Fixed bug in mosDBTable::load where null table values don't overwrite properly

07-Dec-2005 Johan Janssens
 # Fixed [artf2430] : invalid values in tabpane.css
 # Fixed [artf2457] : VCard bug IS a bug
 # Fixed [artf2218] : RSS Newsfeed module generates wrong rendering output
 # Fixed [artf2453] : Random Image Module
 # Fixed [artf2251] : Poll title error
 # Fixed [artf2393] : Original editor cannot open content item if checked out
 # Fixed [artf2323] : overlib_hideform_mini.js parse error
 # Fixed [artf2248] : Incorrect hits count on multipage articles
 # Fixed [artf2342] : getBlogCategoryCount
 # Fixed [artf2464] : Contacts Component image path error
 # Fixed [artf2404] : Contact detail html bug
 ^ Replaced install.png with transparent image - contributed by joomlashack
 # Fixed [artf2245] : RSS not showing enclosure tags
 # Fixed [artf2247] : RSS newsfeed on Frontend missing link
 # Fixed bug in Domit lite parser
 # Fixed mosMail() is missing "ReplyTo:" field to avoid anti-spam rules (SPF)
 # Fixed Small typo in mosBindArrayToObject

06-Dec-2005 Alex Kempkens
 # Fixed [artf2434]: Typo in database.php checkout function line 1050
 # Fixed [artf2398] : Parameter Text Area field name

06-Dec-2005 Johan Janssens
 # Fixed [artf2418] : Banners Client Manager Next Page Issue: Joomla 1.04
 # Fixed [artf2156] : memory exhastion error in joomla.xml.php
 # Fixed [artf2378] : mosCommonHTML::CheckedOutProcessing not checking if the current user
                    has checked out the document
 # Fixed [artf1948] : Pagination problem still exists
 ^ Upgraded TinyMCE Compressor [1.0.4]
 ^ Upgraded TinyMCE [2.0.1]

01-Dec-2005 Andrew Eddie
 # Fixed nullDate error in mosDBTable::checkin method
 # Removed $migrate global in mosDBTable::store method
 # Fixed some MySQL 5 issues (still very unreliable)
 + Component may force frontend application to include joomla.javascript.js by:
   $mainframe->set( 'joomlaJavascript', 1 );

01-Dec-2005 Andrew Eddie
 # Fixed limit error in sections search bot
 # Bug in gacl_api::add_group query [c/o Mambo bug #8199]
 # Search highlighting fails when a "?" is entered [c/o Mambo bug #8260]

30-Nov-2005 Emir Sakic
 + Added 404 handling for missing content and components
 + Added 404 handling to SEF for unknown files

30-Nov-2005 Andrew Eddie
 # Site templates allowed to have custom index2.php (fixes problems where custom code is required in index2)

29-Nov-2005 Andrew Eddie
 # Fixed [artf2258] : Parameter tooltips missing in 1.0.4

28-Nov-2005 Andrew Eddie
 # Fixed [artf2329] : mosMainFrame::getBasePath refers to non-existant JFile class.
 # Fixed [artf2246] : Error in frontend.html.php
 # Fixed [artf2190] : mod_poll.php modification
 # Fixed [artf2292] : [WITH FIX] Sql query missing hits

24-Nov-2005 Emir Sakic
 # Fixed [artf2225] : Email / Print redirects to homepage
 # Fixed [artf1705] : Not same URL for same item : duplicate content

23-Nov-2005 Johan Janssens
 # Fixed : Content Finish Publishing & not authorized

22-Nov-2005 Marko Schmuck
 # Fixed [artf2240] : 1.0.4 URL encoding entire frontend?
 # Fixed [artf2222] : ampReplace in content.html.php
 + Versioncheck for new_link parameter for mysql_connect.

22-Nov-2005 Levis Bisson
 # Fixed [artf2221] : 1.0.4: includes/database.php faulty on PHP < 4.2.0
 # Fixed [artf2219] : Bug in pageNavigation.php - added "if not define _PN_LT or _PN_RT"

22-Nov-2005 Johan Janssens
 # Fixed [artf2224] : Problem with Media Manager
 # Fixed : Can't create new folders in media manager


--------------------------------------------------------------------------------------
---------------- 1.0.4 Released -- [21-Nov-2005 10:00 UTC] ------------------


This Release Contains following Security Fixes

Critical Level Threat
 * Potentional XSS injection through GET and other variables
 * Hardened SEF against XSS injection

Low Level Threat
 * Potential SQL injection in Polls modules through the Itemid variable
 * Potential SQL injection in several methods in mosDBTable class
 * Potential misuse of Media component file management functions
 * Add search limit param (default of 50) to `Search` Mambots to prevent search flooding

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --

20-Nov-2005 Levis Bisson
 # Fixed Artifact [artf1967] displays with an escaped apostrophe in both title and TOC.

20-Nov-2005 Emir Sakic
 * SECURITY [ Critical Level ]: Hardened SEF against XSS injection

19-Nov-2005 Levis Bisson
 # replaced charset=utf-8 to charset=iso-8859-1 in language file

19-Nov-2005 Andrew Eddie
 * SECURITY [ Critical Level ]: Fixed XSS injection of global variable through the _GET array

17-Nov-2005 Johan Janssens
 ^ Replaced install.png with new image
 - Reverted [artf2139] : admin menu xhtml
 + Added clone function for PHP5 backwards compatibility

16-Nov-2005 Rey Gigataras
 # Fixed [artf2137] : editorArea xhtml
 # Fixed [artf2139] : admin menu xhtml
 # Fixed [artf2136] : Admin menubar valid xhtml
 # Fixed [artf2135] : Admin invalid xhtml
 # Fixed [artf2140] : mosMenuBar::publishList
 # Fixed [artf2027] : uploading images from custom component

13-Nov-2005 Rey Gigataras
 # PERFORMANCE: Fixed [artf1993] : Inefficient queries in com_content
 # Fixed [artf2021] : [artf1791] : Failed Login results in redirect to referring page
 # Fixed [artf2021] : appendMetaTag() prepends instead of appends
 # Fixed [artf1981] : incorrect url's at next/previous links at content items
 # Fixed [artf2079] : SQL error in category manager thru contact manager
 # Fixed [artf1586] : .htaccess - RewriteEngine problem
 # Fixed [artf1976] : Check for custom icon in mod_quickicon.php

11-Nov-2005 Andy Miller
 # Fixed issue with RSS module not displaying inside module rendering wrapper

10-Nov-2005 Rey Gigataras
 # Fixed contact component dropdown select category bug

07-Nov-2005 Rey Gigataras
 # Fixed mod_quickicon `redeclaration of function` error possibilities

07-Nov-2005 Johan Janssens
 # Fixed  [artf1648] : tinyMCE BR and P elements
 # Fixed [artf1700] : TinyMCE doesn't support relative URL's for images

07-Nov-2005 Andrew Eddie
 * SECURITY [ Low Level ]: Fixed [artf1978] : mod_poll SQL Injection Vulnerability
 * SECURITY [ Low Level ]: Fixed SQL injection possibility in several mosDBTable methods
 * SECURITY [ Low Level ]: Fixed malicious injection into filename variables in com_media
 ^ mosDBTable::publish_array renamed to publish
 ^ mosDBTable::save no longer updates the ordering (must now be done separately)

06-Nov-2005 Rey Gigataras
 * SECURITY [ Low Level ]: Add search limit param (default of 50) to `Search` Mambots to prevent search flooding
 # Fixed custom() & customX() functions in menu.html.php no checking for image in /administrator/images/

04-Nov-2005 Rey Gigataras
 # Fixed [artf1953] : Page Class Suffix in Contacts component
 # Fixed [artf1945] : mosToolTip not generating valid xhtml

03-Nov-2005 Rey Gigataras
 + modduleclass_sfx support to mod_poll
 # Fixed [artf1902] : Incorrect number of table cells in mod_poll

03-Nov-2005 Samuel Moffatt
 # Fixed bug which prevented component uninstall if another XML file was in the directory

01-Nov-2005 Rey Gigataras
 # Fixed [artf1888] : linkable [category|section] URL incorrect
 # Fixed [artf1620] : Hardcoded words in pdf.php
 # Fixed [artf1887] : Content: Bug in creation date generation

31-Oct-2005 Johan Janssens
 # Fixed [artf1277] : News Feed Display Bad Accent character

31-Oct-2005 Rey Gigataras
 # Fixed [artf1739] : Problem with the menuitem type url and assigned templates and modules
 # Fixed [artf1574] : Who is online after update to Joomla 1.0.3 no more work correctly
 # Fixed [artf1666] : Notice: on component installation
 # Fixed [artf1573] : Manage Banners | Error in Field Name
 # Fixed [artf1597] : Small bug in loadAssocList function in database.php
 # Fixed [artf1832] : Logout problem
 # Fixed [artf1769] : Undefined index: 2 in includes/joomla.php on line 2721
 # Fixed [artf1749] : Email-to-friend is NOT actually from friend
 # Fixed [artf1591] : page is expired at installation
 # Fixed [artf1851] : 1.0.2 copy content has error
 # Fixed [artf1569] : Display of mouseover in IE gives a problem with a dropdown-box
 # Fixed [artf1869] : Poll produces MySQL-Error when accessed via Component Link
 # Fixed [artf1694] : 1.0.3 undefined indexes filter_sectionid and catid on "Add New Content"
 # Fixed [artf1834] : English Localisation
 # Fixed [artf1771] : Wrong mosmsg
 # Fixed [artf1792] : "Receive Submission Emails" label is misleading
 # Fixed [artf1770] : Undefined index: HTTP_USER_AGENT

30-Oct-2005 Rey Gigataras
 ^ Upgraded TinyMCE Compressor [1.02]
 ^ Upgraded TinyMCE [2.0 RC4]

27-Oct-2005 Johan Janssens
 # Fixed [artf1671] : Media Manager
 # Fixed [artf1814] : Tab Class wrong
 # Fixed [artf1086] : Icons at the control panel fall apart

26-Oct-2005 Samuel Moffatt
 # Fixed bug where a new database object with the same username, password and host but different database name would kill Joomla!

25-Oct-2005 Johan Janssens
 # Fixed [artf1733] : $contact->id used instead of $Itemid
 # Fixed [artf1654] : base url above title tag
 # Fixed [artf1738] : Registration - javascript alert

23-Oct-2005 Rey Gigataras
 # Fixed [artf1695] : Show Empty Categories in Section does not work
 # Fixed [artf1710] : Unnecessary queries (optimization)
 # Fixed [artf1711] : Missing whitespace in search results
 # Fixed [artf1706] : Mambo logo not removed from admin images
 # Fixed [artf1708] : Search CMT: Hardcoded date format
 # Fixed [artf1689] : Joomla! Installer - Wording still not correct
 # Fixed [artf1692] : email and print buttons (maybe also the PDF) does not validate

19-Oct-2005 Andrew Eddie
 # Fixed missing autoclear in "list-item" stock template

19-Oct-2005 Rey Gigataras
 # Fixed [artf1577] : MenuLink Blog section error

19-Oct-2005 Levis Bisson
  Applyed Feature Requests:
^ Artifact [artf1282] : Easier sorting of static content in creating menu links
^ Artifact [artf1162] : Remove hardcoding of <<, <, > and >> in pageNavigation.php


--------------------------------------------------------------------------------------
---------------- 1.0.3 Released -- [14-Oct-2005 10:00 UTC] ------------------


Contains following Security Fixes
Medium Level Threat
 * Fixed SQL injection bug in content submission (thanks Dead Krolik)

Low Level Threat
 * Fixed securitybug in admin.content.html.php when 2 logged in and try to edit the same content
 * Fixed Search Component flooding, by limiting searching to between 3 and 20 characters
 * Fixed [artf1405] : Joomla shows Items to unauthorized users

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --

14-Oct-2005 Rey Gigataras
 # Fixed edit icon not showing on frontpage
 # Fixed [artf1553] : database.php fails to pass resource id into mysql_get_server_info() call
 # Fixed [artf1560] : Install1.php doesn't enforce rule against old_ table prefix

13-Oct-2005 Andy Miller
 # Fixed [artf1504] : rhuk_solarflare_ii Template | Menus with " not displaying correctly

13-Oct-2005 Rey Gigataras
 # Fixed duplicated module creation in install
 # Fixed XHTML issue in rss feed module
 # Fixed XHTML issue in com_search
 # Fixed [artf1550] : Properly SEFify com_registration links
 # Fixed [artf1533] : rhuk_solarflare_ii 2.2 active_menu
 # Fixed [artf1354] : Can't create new user
 # Fixed [artf1433] : Images in Templates
 # Fixed [artf1531] : RSS Feed showing wrong livesite URL

12-Oct-2005 Marko Schmuck
 * SECURITY [ Low Level ]: Fixed security bug in admin.content.html.php when 2 logged in and try to edit the same content

12-Oct-2005 Johan Janssens
 # Fixed [artf1266] : gzip compression conflict
 # Fixed [artf1453] : Weblink item missing approved parameter
 # Fixed [artf1452] : Error deleting Language file
 # Fixed [artf1373] : Pagination error

12-Oct-2005 Rey Gigataras
 ^ Core now automatically calculates the offset between yourself and the server
 # Fixed bug in Global Config param `Time Offset`
 # Fixed [artf1414] : Missing images in HTML_toolbar
 # Fixed [artf1513] : PDF format does not work at version 1.0.2

11-Oct-2005 Rey Gigataras
 * SECURITY [ Low Level ]: Fixed Search Component flooding, by limiting searching to between 3 and 20 characters
 ^ Blog - Content Category Archive will no longer show dropdown selector when coming from Archive Module
 # Fixed [artf1470] : Archives not working in the front end
 # Fixed [artf1495] : Frontend Archive blog display
 # Fixed [artf1364] : TinyMCE loads wrong template styles
 # Fixed [artf1494] : Template fault in offline preview
 # Fixed [artf1497] : mosemailcloak adds trailing space
 # Fixed [artf1493] : mod_whosonline.php

09-Oct-2005 Rey Gigataras
 * SECURITY [ Medium Level ]: Fixed SQL injection bug in content submission
 * SECURITY [ Low Level ]: Fixed [artf1405] : Joomla shows Items to unauthorized users
 # Fixed [artf1454] : After update email_cloacking bot is always on
 # Fixed [artf1447] : Bug in mosloadposition mambot
 # Fixed [artf1483] : SEF default .htaccess file settings are too lax
 # Fixed [artf1480] : Administrator type user can loggof Super Adminstrator
 # Fixed [artf1422] : PDF Icon is set to on when it should be off
 # Fixed [artf1476] : Error at "number of Trashed Items" in sections
 # Fixed [artf1415] : Wrong image in editList() function of mosToolBar class

08-Oct-2005 Johan Janssens
 # Fixed [artf1384] : tinyMCE doesnt save converted entities

07-Oct-2005 Andy Miller
 # Fixed tabpane css font issue

07-Oct-2005 Johan Janssens
 # Fixed [artf1421] : unneeded file includes\domit\testing_domit.php

07-Oct-2005 Andy Stewart
 # Fixed [artf1382] : Added installation check to ensure "//" is not generated via PHP_SELF
 # Fixed [artf1439] : Used correct ErrorMsg function and updated javascript redirect to remove POSTDATA message
 # Fixed [artf1400] : Added a check of $other within com_categories to skip section exists check if set to "other"

05-Oct-2005 Robin Muilwijk
 # Fixed [artf1366] : Typo in admin, Adding a new menu item - Blog Content Category


--------------------------------------------------------------------------------------
---------------- 1.0.2 Released -- [02-Oct-2005 16:00 UTC] ------------------


02-Oct-2005 Rey Gigataras
 ^ Added check to mosCommonHTML::loadOverlib(); function that will stop it from being loaded twice on a page
 # Fixed Content display not honouring Section or Category publish state
 # Fixed [artf1344] : Link to menu shows wrong menu type
 # Fixed [artf1189] : Long menu names get truncated, duplicate menus made
 # Fixed [artf1192] : Unpublished Bots
 # Fixed [artf1223] : Error with Edit items in categories and sections
 # Fixed [artf1219] : Joomla Component Module displays Error!
 # Fixed [artf1183] : Section module: Still "no items to display"
 # Fixed [artf1241] : Editing content fails with MySQL 5.0.12b
 # Fixed [artf1306] : modules - parameters of type text not stored correctly

01-Oct-2005 Andy Miller
 # Fixed base href in Content Preview for broken images

01-Oct-2005 Johan Janssens
 ^ Updated TinyMCE editor to version RC 3
 # Fixed [artf1221] : Unable to Submit Content (still not working post-patch)
 # Fixed [artf1108] : Tooltips on mouseover causes parameter panel to widen
 # Fixed [artf1217] : WYSIWYG-Editor and mospagebreak with 2 parameters

01-Oct-2005 Andy Stewart
 # Fixed [artf1305] - Added a check within mosimage mambot for introtext being hidden
 # Fixes [artf1343] - Removed xml declaration at top of gpl.html

01-Oct-2005 Arno Zijlstra
 ^ Changed OSM banner 2 a little to show banner changing

01-Oct-2005 Levis Bisson
 # Fixed [artf1311] : Banners not showing / returning PHP error
 # Fixed [artf1319] : Banners not showing in frontend / admin

30-Sep-2005 Andy Miller
 # Fixed poor rendering of fieldset with solarflare2
 ^ Updated solarflare2 template with new colors and logos
 ^ Moved modules to divs, and shuffled pathway to give more button room
 ^ Updated favicon and other Joomla! logos for admin
 # Fixed alignment of footer in admin for safari/opera

30-Sep-2005 Andy Stewart
 + Updated installation routine to recognise port numbers other than 80
 # Fixed [artf1293] : added $op=mosGetParam so sendmail is called when running globals.php-off

30-Sep-2005 Rey Gigataras
 ^ Module Manager `position` dropdown ordering alphabetically
 ^ Ability to Hide feed title for `New` modules used to display feeds
 ^ Content Items `New` button sensitive to dropdown filters
 # Fixed Seach Module not using Itemid of existng `Seach` component menu item
 # Fixed `Link to Menu` problem with Sections menu ordering
 # Fixed `Link to Menu` problem with Category = `Content Category`
 # Fixed [artf1300] : PDF shows Author name despite setting content item

30-Sep-2005 Levis Bisson
 + Added UTF-8 support
 # Fixed tooltips empty links
 # Fixed [artf1265] : url in 'edit-menue-item' of submenues is wrong
 # Fixed [artf1277] : News Feed Display Bad Accent character

29-Sep-2005 Arno Zijlstra
 # Fixed publish/unpublish select check in contacts

29-Sep-2005 Rey Gigataras
 # Fixed [artf1276] : tiny mce background
 # Fixed [artf1281] : Bad name of XML file
 # Fixed [artf1180] : Call-by-reference warning when editing menu
 # Fixed [artf1188] : includes/vcard.class.php uses short open tags

29-Sep-2005 Levis Bisson
 # Fixed [artf1274] : Module display bug when using register/forgot password links
 # Fixed [artf1238] : header("Location: $url")- some servers require an absolute URI

28-Sep-2005 Levis Bisson
 # Fixed [artf1250] : Order is no use when many pages
 # Fixed [artf1254] : Unable to delete when count > 1
 # Fixed [artf1248] : Invalid argument supplied for 3P modules

27-Sep-2005 Arno Zijlstra
 # Fixed [artf1253] : Apply button image path
 # Fixed [artf1240] : WITH FIX: banners component - undefined var task
 # Fixed [artf1242] : Problem with "Who's online"
 # Fixed [artf1218] : 'Search' does not include weblinks?

25-Sep-2005 Emir Sakic
 # Fixed [artf1185] : globals.php-off breaks pathway
 # Fixed [artf1196] : undefined constant categoryid
 # Fixed [artf1216] : madeyourweb no </head> TAG

24-Sep-2005 Rey Gigataras
 ^ [artf1214] : pastarchives.jpg seems unintuitive.

22-Sep-2005 Rey Gigataras
 + Added Version Information to bottom of joomla_admin template, with link to 'Joomla! 1.0.x Series Information'
 # Fixed [artf1175] : Create catagory with selection of Section
 # Fixed [artf1179] : Custom RSS Newsfeed Module has nested <TR>


--------------------------------------------------------------------------------------
---------------- 1.0.1 Released -- [21-Sep-2005 16:30 UTC] ------------------


21-Sep-2005 Rey Gigataras
 # Fixed [artf1157] : Section module: Content not displayed, wrong header
 # Fixed [artf1159] : Can't cancel "Submit - Content" menu item type form
 # Fixed [artf1172] : "Help" link in Administration links to Mamboserver.com
 # Fixed [artf1171] : mod_related_items shows all items twice
 # Fixed [artf1167] : Component - Search
 # Fixed [RC] incorrect redirect when cancelling from Frontend 'Submit - Content'
 # Fixed undefined variable in Trash Manager
 # Fixed [RC] `Trash` button when no item selected
 # Fixed [RC] `New` Menu Item Type `Next` button bug

20-Sep-2005 Levis Bisson
 ^ added a chmod to the install unlink function
 # Fixed [artf1150] : the created_by on initial creation of Static Content Item

20-Sep-2005 Marko Schmuck
 ^ Changed Time Offsets to hardcoded list with country/city names

20-Sep-2005 Rey Gigataras
 # Fixed /installation/ folder check
 # Fixed [artf1153] : Quote appears in com_poll error
 # Fixed [artf1151] : empty span
 # Fixed [artf1089] : multile select image insert reverses list order
 # Fixed [artf1138] : Joomla allows creation of double used username
 # Fixed [artf1133] : There is no install request to make /mambot/editor writeable

19-Sep-2005 Andrew Eddie
 # Fixed incorrect js function in patTemplate sticky and ordering templates/links

19-Sep-2005 Rey Gigataras
 ^ Changed Overlib styling when creating new menu items
 ^ Additional Overlib info for non-image files and directories
 ^ 'Cancel' button for Media Manager
 ^ Option to run TinyMCE in compressed mode - off by default
 # Fixed [artf1111] : mosShowHead and the order of headers
 # Fixed [artf1117] : database.php - bcc
 # Fixed [artf1114] : database.php _nullDate
 # Fixed TinyMCE errors caused by use of compressed tinymce_gzip.php [[artf1088]||[artf1034]||[artf1090]||[artf1044]]
 # Installed Editor Mambots are now published by default
 # Fixed error in RSS module
 # Fixed [artf1106] : Default Editor Will Not Take Codes Like Java Script
 # Fixed delete file in Media Manager

18-Sep-2005 Arno Zijlstra
 # Fixed [artf1084] : <br> stays in empty content
 # Fixed [artf1101]: Typo in Global Config

18-Sep-2005 Andrew Eddie
 # Fixed issues in patTemplate Translate Function and Modifier
 # Fixed issue with patTemplate variable for Tabs graphics

18-Sep-2005 Rey Gigataras
 # Fixed [artf1046] : Menu Manager Item Publishing
 # Fixed [artf1036] : newsflash error when logged in in frontend
 # Fixed [artf1033] : madeyourweb template logo path
 # Fixed [artf1039] : & to &amp; translation in menu and contenttitle
 # Fixed PHP5 passed by reference error in admin.content.php
 # Fixed [artf1068] : live bookmark link is wrong
 # Fixed [artf1030] : Bug Joomla 1.0.0 Stable (un)publishing News Feeds
 # Fixed [artf1048] : Custom Module Bug
 # Fixed [artf1080] : Joomla! Installer
 # Fixed [artf1050] : error in sql - database update
 # Fixed [artf1081] : com_categories can't edit category when clicking hyperlink
 # Fixed [artf1053] : Can not unassign template
 # Fixed [artf1079] : com_weblinks can't edit links
 # Fixed [artf1029] : Site -> Global Configuration = greyed out top menu
 # Fixed [artf1064] : Deletion of Modules and Fix
 # Fixed [artf1052] : Double Installer Locations
 # Fixed [artf1051] : Copyright bumped to the right of the site
 # Fixed [artf1059] : component editor bug
 # Fixed [artf1041] : mod_mainmenu.xml: escape character for apostrophe missing
 # Fixed [artf1040] : category manager not in content-menu

17-Sep-2005 Levis Bisson
 # Fixed [artf1037]: Media Manager not uploading
 # Fixed [artf1025]: Registration admin notification
 # Fixed [artf1043]: Template Chooser doesn't work
 # Fixed [artf1042]: Template Chooser shows rogue entry


--------------------------------------------------------------------------------------
---------------- 1.0.0 Released -- [17-Sep-2005 00:30 UTC] ------------------


Contains following Security Fixes
Medium Level Threat
 * Fixed SQL injection bugs in user activation (thanks Enno Klasing)

Low Level Threat
 * Fixed [#6775] Display of static content without Itemid

-- -- -- -- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- ---- -- --

16-Sep-2005 Andrew Eddie
 # Fixed: 1014 : & amp ; in pathway
 # Fixed: Missing space in mosimage IMG tags
 # Fixed: Incomplete function call - mysql_insert_id()
 + Added nullDate handling to database class
 + Added database::NameQuote function for quoting field names
 # Fixed: com_checkin to properly use database class
 # Fixed: Missed stripslashes in`global configuration - site`
 + Added admin menu item to clear all caches (for 3rd party addons)

16-Sep-2005 Emir Sakic
 # Fixed sorting by author on frontend category listing
 + Added time offset to copyright year in footer
 # Fixed spelling in sam
 # Reflected some file name changes in installer CHMOD
 # Fixed bugs in paged search component

16-Sep-2005 Alex Kempkens
 + template contest winner 'MadeYourWeb' added

16-Sep-2005 Rey Gigataras
 + Pagination Support for Search Component
 ^ Ordering of Toolbar Icons/buttons now more consistent
 ^ Frontend Edit, status info moved to an overlib
 ^ Search Component converted to GET method
 # Fixed [artf1018] : Warning Backend Statistic
 # Fixed [artf1016] : Notice: RSS undefined constant
 # Fixed [artf1020] : Hide mosimages in blogview doesn't work
 # Various Search Component Fixes
 # Fixed Search Component not honouring Show/Hide Date Global Config setting
 # Fixed [#6668] No static content edit icon for frontend logged in author
 # Fixed [#6710] `Link to menu` function from components Category not working
 # Fixed [#7011] Subtle bug in saveUser() - admin.users.php
 # Fixed [#7120] Articles with `publish_up` today after noon are shown with status `pending`
 # Fixed [#6669] mosmail BCC not working, send as CC
 # Fixed [#7422] Weblink submission emails
 # Fixed [#7196] mosRedirect and Input Filter CGI Error
 # Fixed [#6814] com_wrapper Iframe Name tag / relative url modifications
 # Fixed [#6844] rss version is wrong in the Live Bookmark feeds
 # Fixed [#7120] Articles with `publish_up` today after noon are shown with status `pending`
 # Fixed [#7161] Apparently unncessary code in sendNewPass - registration.php

15-Sep-2005 Andy Miller
 ^ Fixed some width issues with Admin template in IE
 ^ Fixed some UI issues with Banners Component
 ^ Added a default header image for components that don't specify one

15-Sep-2005 Andrew Eddie
 - Removed unused globals from joomla.php
 + Added mosAbstractLog class

15-Sep-2005 Rey Gigataras
 + added `Apply` button to frontend Content editing
 ^ Added publish date to syndicated feeds output [credit: gharding]
 ^ Added RSS Enclosure support to feedcreator [credit: Joseph L. LeBlanc]
 ^ Added Google Sitemap support to feedcreator
 ^ Modified layout of Media Manager
 ^ Added Media Manager support for XCF, ODG, ODT, ODS, ODP file formats
 # Fixed use of 302 redirect instead of 301
 # Content frontend `Save` Content redirects to full content view
 # Fixed Wrapper auto-height problem
 # Queries cleaned of incorrect encapsulation of integer values
 # Fixed Login Component redirection [credit: David Gal]

15-Sep-2005 Arno Zijlstra
 ^ changed tab images to fit new color
 ^ changed overlib colors

14-Sep-2005 Rey Gigataras
 ^ Ugraded TinyMCE [2.0 RC2]
 ^ Param tip style change to dashed underline
 # Queries cleaned of incorrect encapsulation of integer values

14-Sep-2005 Andrew Eddie
 # Added PHP 5 compatibility functions file_put_contents and file_get_contents
 + Added new version of js calendar
 + mosAbstractTasker::setAccessControl method
 + mosUser::getUserListFromGroup
 + mosParameters::toObject and mosParameters::toArray

13-Sep-2005 Andrew Eddie
 ^ Rationalised global configuration handling
 # Fixed polls access bug
 # Fixed module positions preview to show positions regardless of module count
 ^ Modified database:setQuery method to take offset and record limit
 + Added alternative version of globals.php that emulates register_globals=off
 # Added missing parent_id field from mosCategory class

12-Sep-2005 Rey Gigataras
 + Per User Editor selection
 # Module styling applied to custom/new modules
 # Fixed Agent Browser bug

12-Sep-2005 Andrew Eddie
 + New onAfterMainframe event added to site index.php
 + Added dtree javascript library
 + Added some extra useful toolbar icons
 + Added css for fieldsets and legends and some 1.1 admin style formating
 + Added mosDBTable::isCheckedOut() method, applied to components
 # fixed bug in typedcontent edit - checked out is done before object load and always passes
 ^ Updated Help toolbar button to accept component based help files
 ^ Updated version class with new methods
 + Added support for params file to have <mosparams> root tag

12-Sep-2005 Andy Stewart
 # Fixed issue with new content where Categories weren't displayed for sections

12-Sep-2005 Andrew Eddie
 ^ Upgrade DOMIT! and DOMIT!RSS (fixes issues in PHP 4.4.x)
 + Added database.mysqli.php, a MySQL 4.1.x compatible version
 + Added [Check Again] button to installation check screen
 ^ Changed web installer to always use the database connector
 # Fixed PHP 4.4 issues with new objects returning by reference

11-Sep-2005 Rey Gigataras
 + Output Buffering for Admin [pulled from Johan's work in 1.1]
 + Loading of WYSIWYG Editor only when `editorArea` is present [pulled from Johan's work in 1.1]
 ^ Upgraded JSCookMenu [1.4.3]
 ^ Upgraded wz_tooltip [3.34]
  ^ Upgraded Overlib [4.21]
 ^ editor-xtd mosimage & mospagebreak button hidden on category, section & module pages
 # Poll class $this-> bug
 # Fixed change creator dropdown to exclude registered users (who do not have author rights)

11-sep-2005 Arno Zijlstra
 + Added offlinebar.php
 ^ Changed site offline check
 ^ Cosmetic change to offline.php

11-Sep-2005 Andrew Eddie
 + Added sort up and down icons
 + Added mosPageNav::setTemplateVars method

10-Sep-2005 Rey Gigataras
 + `Submit - Content` menu type [credit: Jason Murpy]

09-Sep-2005 Andy Miller
 ^ made changes to new joomla admin template
 ^ changed login lnf to match new admin template
 ^ removed border and width, set padding on div.main in admin
 ^ changed Force Logout text

09-Sep-2005 Alex Kempkens
 ^ changed mosHTML::makeOption to handle different coulmn names
 ^ corrected several calls from makeOption in order to become multi lingual compatible
 ^ corrected little fixes in query handling in order to get multi lingual compatible
 + Added system bot's for better integration of ml support, ssl & multi sites

08-Sep-2005 Rey Gigataras
 + Added back Sys Info link in menubar
 + Added Changelog link to Help area
 ^ Cosmetic change to Toolbar Icon appearance
 ^ Cosmetic change to QuickIcon appearance
 ^ Toolbar icons now 'coloured' no longer 'greyed out'
 ^ Dropdown menu now shows on edit pages but is inactive
 # Fixed Newsfeed component generates image tag instead of img tag
 # Fixed Joomlaxml: tooltips need to use label instead of name
 # Fixed One parameter too many in orderModule call in admin.modules.php
 # Fixed inabiility to show/hide VCard
 # Fixed Mambot Manager filtering

08-Sep-2005 Alex Kempkens
 + mosParameter::_mos_filelist for xml parameters
 ^ mos_ table prefix to jos_ in installation and in some other files.
 + added category handling for contact component
 + added color adapted joomla_admin template

07-Sep-2005 Andrew Eddie
 # Added label tags to mod_login (WCAG compliance)
 # Added label tags to com_contact (WCAG compliance)
 # Added label tags to com_search (WCAG compliance)
 # Added label tag support to mosHTML::selectList (WCAG compliance)
 # Added label tag support to mosHTML::radioList (WCAG compliance)

01-Sep-2005 Andrew Eddie
 + Added article_separator span after a content item
 * SECURITY [ Critical Level ]: Hardened mosGetParam by using phpInputFilter for NO_HTML mode
 + Added new mosHash function to produce secure keys
 * SECURITY [ Low Level ]: Hardened Email to Friend form

31-Aug-2005 Andrew Eddie
 + Added setTemplateVars method to admin pageNavigation class
 ^ Added auto mapping function to mosAbstractTasker constructor
 + Added patHTML class for patTemplate utility methods
 ^ Upgraded patTemplate library
 ! patTemplate::createTemplate has changed parameters
 - Removed requirement to accept GPL on installation
 # Fixed bug in Send New Password function - mail from not defined
 # Fixed undefined $row variable in wrapper component
 # Fixed undefined $params in contacts component
 - Removed unused getids.php
 - Removed redundant whitespace
 ^ Convert 4xSpace to tab

08-Aug-2005 Andrew Eddie
 * SECURITY [ Medium Level ]: Fixed SQL injection bugs in user activation (thanks Enno Klasing)
 ^ Encased text files in PHP wrapper to help obsfucate version info
 # Changed admin session name to hash of live_site to allow you to log into more than one Joomla! on the same host
 # Fixed hardcoded (c) character in web installer files
 # Fixed slow query in admin User Manager list screen
 # Fixed bug in poll stats calculation
 # Updated bug fixes in phpMailer class
 # Fixed login bug for nested Joomla! sites on the same domain

02-Aug-2005 Alex Kempkens
 * SECURITY [ Low Level ]: Fixed [#6775] Display of static content without Itemid
 # Fixed [#6330] Corrected default value of field


----- Derived from Mambo 4.5.2.3 circa. 17 Aug 12005 -----
--------------------------------------------------------------------------------------

