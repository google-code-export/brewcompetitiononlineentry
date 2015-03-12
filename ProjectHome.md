# Brew Competition Online Entry & Management #

## January 1, 2015: BJCP 2014 Styles Integration Coming Soon ##
Support for the new BJCP 2014 style guidelines is coming soon. However, further testing is needed to integrate into the BCOE&M core.
The BJCP fully expects that a "transition period" will be necessary for competitions in the early part of this year. If you want to use BCOE&M for your competition, it is acceptable to use the 2008 guidelines until the 2014 ones are integrated into the system.
As of January 5, 2015, the BJCP itself has not published an official version of the 2014 guidelines - nor have they updated their website style center.
Stay tuned.

## Version 1.3.0.4 Released ##
This is a bugfix release. Addresses Google Code [Issue 330](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=330), [Issue 332](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=332), [Issue 333](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=333), [Issue 334](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=334), [Issue 335](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=335), [Issue 336](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=336), [Issue 337](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=337), [Issue 338](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=338), [Issue 339](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=339), [Issue 340](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=340), and [Issue 342](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=342) as well as other minor unreported issues.

## Version 1.3.0.3 Released ##
Mostly a bugfix release. Centralized the DB calls, separating them from the "output" scripts. Created library files to centralize various functions. Updated to latest version of Fancybox. Release addresses Google Code [Issue 295](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=295), [Issue 298](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=298), [Issue 300](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=300), [Issue 302](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=302), [Issue 304](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=304), [Issue 305](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=305), [Issue 311](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=311), [Issue 313](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=313), [Issue 314](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=314), [Issue 316](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=316), [Issue 317](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=317), [Issue 318](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=318), [Issue 319](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=319), [Issue 321](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=321), [Issue 325](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=325), [Issue 326](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=326), [Issue 327](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=327), [Issue 328](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=328), and [Issue 329](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=329).

## Version 1.3.0.2 Released ##
This is a bugfix release. Addresses Google Code [Issue 295](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=295) and [Issue 298](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=298) as well as other minor unreported issues.

## Version 1.3.0.1 Released ##
This is a bugfix release. Addresses Google Code [Issue 285](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=285), [Issue 286](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=286), [Issue 288](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=288), [Issue 289](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=289), [Issue 290](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=290), [Issue 291](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=291), and [Issue 294](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=294).

For those experiencing any issues related to initial browser-based setup of BCOE&M, the bcoem\_baseline\_1.3.0.X.sql document was added to the package. It contains the necessary database structure and dummy data for a NEW installation that can be installed manually via phpMyAdmin or shell access. Be sure to follow the directions in the document **before** use, especially those relating to security.

http://help.brewcompetition.com/files/whatsnew.html

## Version 1.3.0.0 Released ##
Due to some issues that arose since the initial release of Version 1.3.0.0, it was decided to pull the release package to perform some additional tests. Those issues have been addressed and the package is now available.

## About Version 1.3.0.0 ##
This release marks some major improvements to stability, security while addressing server load issues:
  * Code extensions in the form of custom modules - admins can extend the functionality of BCOE&M with their own HTML or PHP code (advanced users only - not available for hosted installations).
  * Barcode option for bottle entry forms and entry check-in so comp staff can use a barcode scanner to check-in entries and assign judging numbers them. The methodology was tested in the 8000+ entry National Homebrewers Competition this year and was very well received by the competition staff.
  * Entry limit per user option.
  * Pre-registration option - users can create their accounts and enter their personal information, judging preferences, etc. before entries are accepted.
  * Subcategory entry limit per user option - from unlimited to a single entry per user per subcategory.
  * Subcategory entry limit exception option - for those subcategories that lend themselves to a broader range of interpretation (e.g., Specialty Beer, Spice/Herb/Vegetable Beer, Open Category Mead, Specialty Cider and Perry, etc.).
  * Admin ability to enable/disable search engine friendly URLs for all public pages.
  * Extended printing options including larger round bottle labels, labels with special ingredients, category/subcategory only labels, etc.
  * Expansion of recipe-related fields to accommodate more ingredients - malts/grains, other fermentables, and hops increase to 20 fields each, mash schedule increases to 10.
  * Enhanced recipe entry with robust checks for the presence of required information for certain styles (e.g., special ingredients for Category 23, strength for mead styles, etc.)
  * Extended use of session variables to limit calls to the MySQL database for redundant/constant pieces of information customized for each user.
  * Numerous behind-the-scenes coding clean up and enhancements aimed at improving performance and reducing page load times.

Addresses the following reported issues on Google Code: [Issue 198](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=198), [Issue 206](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=206), [Issue 207](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=207), [Issue 218](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=218), [Issue 221](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=221), [Issue 222](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=222), [Issue 223](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=223), [Issue 225](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=225), [Issue 226](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=226), [Issue 227](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=227), [Issue 228](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=228), [Issue 229](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=229), [Issue 230](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=230), [Issue 231](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=231), [Issue 232](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=232), [Issue 236](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=236), [Issue 237](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=237), [Issue 240](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=240), [Issue 241](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=241), [Issue 242](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=242), [Issue 243](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=243), [Issue 245](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=245), [Issue 246](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=246), [Issue 247](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=247), [Issue 249](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=249), [Issue 252](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=252), [Issue 253](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=253), [Issue 254](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=254), [Issue 255](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=255), [Issue 256](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=256), [Issue 257](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=257), [Issue 258](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=258), [Issue 260](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=260), [Issue 261](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=261), [Issue 262](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=262), [Issue 263](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=263), [Issue 266](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=266), [Issue 269](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=269), [Issue 271](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=271), [Issue 272](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=272), [Issue 273](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=273), [Issue 274](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=274), [Issue 275](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=275), and [Issue 276](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=276).

## Version 1.2.1.3 ##
This release features mostly bug fixes and a couple of enhancements:
  * Enhanced the data integrity functions to be very explicit with regard to messaging about special ingredients/classic style requirements.
  * Added the ability to utilize "clean" URLs for public pages (Entry Information, Rules, Volunteer Info, etc.)
  * Updated to Fancybox 2.1.3
  * Updated to some CSS3 scripting, especially concerning rounded corners (now supported by IE9)
  * Fixed some Archive display issues resulting from legacy code and database structure

Addresses the following reported issues on Google Code: [Issue 186](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=186), [Issue 188](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=188), [Issue 189](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=189), [Issue 190](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=190), [Issue 191](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=191), [Issue 195](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=195), [Issue 197](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=197), [Issue 199](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=199), [Issue 200](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=200), [Issue 202](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=202), [Issue 204](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=204), [Issue 205](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=205), [Issue 208](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=208), [Issue 209](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=209), [Issue 210](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=210), [Issue 211](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=211), [Issue 212](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=212), [Issue 213](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=213), [Issue 214](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=214)

Go to http://help.brewcompetition.com/files/whatsnew.html for more.

## Version 1.2.1.2 ##
This release again features mostly bug fixes and a few enhancements.

  * Enhanced the data integrity checking for sub-styles that require participants to enter special ingredients and/or a classic style (beer, mead, cider), as well as strength (mead), and carbonation/sweetness (mead, cider).
    * If participants do not add the requisite information, their entry is marked "unconfirmed," and subject to deletion after 24 hours.
  * Enhanced display of entry numbers to four digits (0000 - 9999). Standardizes display.
  * Minor tweak to processing of proper names to allow for dashes, initials, and apostrophes.
  * Tweaked the special ingredient bottle label download to only show the requisite categories.

Addressed all verified bugs reported to Google Code ([Issue 177](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=177), [Issue 178](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=178), [Issue 179](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=179), [Issue 180](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=180), [Issue 181](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=181), [Issue 182](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=182), [Issue 183](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=183), and [Issue 184](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=184)).

## Version 1.2.1.1 ##
This release features mostly bug fixes and a few enhancements.

  * Added more CSV exports (all paid entries, all non-paid entries).
  * Added more options for printing sorting sheets.
  * Enhanced display of judging numbers to make them more readable at a glance. Uses the convention: XX-XXX (e.g., the fourteenth entry in category 3 would be 03-014).

Addressed all verified bugs reported to Google Code ([Issue 160](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=160), [Issue 163](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=163), [Issue 164](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=164), [Issue 166](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=166), [Issue 167](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=167), [Issue 169](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=169), [Issue 171](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=171), [Issue 172](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=172), [Issue 173](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=173), [Issue 174](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=174), [Issue 175](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=175), [Issue 176](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=176), and [Issue 177](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=177)).

## Version 1.2.1.0 ##
This release features a few fairly major upgrades and numerous minor ones. It also addresses bugs reported between December 1, 2011 and August 25, 2012.

  * Added browser-based database setup and updating.
  * Added the ability to for the BCOE&M installation to run on a shared database (or multiple installations on a single database).
  * Added the ability to cap the number of entries.
  * Added custom winning category functionality.
  * Added ability for competitions to accept payment via Google Wallet ([Issue 48](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=48)).
  * Added localization capabilities. Allows for granular, time-zone specific dates and times to be utilized by the program.
  * Added registration windows for judges and stewards (now separate from regular entrants). Comps can now register judges and stewards before and after the entry window ([Issue 133](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=133)).
  * Added the ability for admins to designate the method to designate winners (by table, by category or by subcategory - [Issue 142](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=142)).
  * Added a new public page: Volunteer Information (thanks to Bruce Buerger for his contribution).
  * Added data integrity scripting that checks for inconsistencies between the user and brewer tables as well as deleting any entry that is either blank or is not attributed to any verified user.
  * Added another bottle label option that includes special ingredients (if any) on the label itself. Useful for Category 23, for example, and custom categories.
  * Added the ability to export promo materials in Bulletin Board Code (BBC) format. Useful for posting a competition announcement to various homebrewing forums.
  * Added the ability to export all entry data in CSV format ([Issue 149](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=149)).
  * Added time stamping for users and entry updates ([Issue 52](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=52)).
  * Added ability to filter admin display of paid entries ([Issue 129](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=129)).
  * Added granular display of the number of entries that had reduced fees from a promo code ([Issue 146](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=146)).
  * Updated the BJCP Ranks to utilize those that went into effect April 1, 2012 (as reported to SourceForge). Added explanation/help text to the participant information screen.
  * Cleaned up archived data display.
  * Addressed all verified bugs reported to Google Code ([Issue 117](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=117), [Issue 119](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=119), [Issue 120](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=120), [Issue 123](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=123), [Issue 124](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=124), [Issue 127](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=127), [Issue 137](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=137), [Issue 138](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=138), [Issue 150](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=150), [Issue 151](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=151), [Issue 152](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=152), [Issue 153](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=153), [Issue 155](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=155), [Issue 156](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=156), and [Issue 157](https://code.google.com/p/brewcompetitiononlineentry/issues/detail?id=157)).
  * Deprecated the option to choose whether to utilize BCOE&M for competition organization. Going forward, it will be assumed that Administrators will utilize the organization functions (those beyond simply gathering participant and entry data) as little or as much as they wish without needing to specify as such.