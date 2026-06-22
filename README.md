=== Tekbyt Location Leads ===
Contributors: talhaahmadkhan08
Donate link: https://talhaahmadkhan.blog/
Tags: location, services, leads
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

This plugin was created from the wordpress standard boilerplate from wppb.me 
This plugin has 3 post types. locations , services, leads.
Location is main post type as primary which has custom single template page which renders Hero section the services attached to that location. leads form, testimonials, faq, and cta.
second is services which is secondary to location and act as a services for the locations. it is attached to many locations and has price range to it.
third is leads which is admin only and has data according to the leads which are captured from the locatioon single page form.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `tekbyt-location-leads` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== How to add Locations ==

1. Go to locations admin menu in admin dashboard. create new post. fill all the fields and publish.
2. You can now click on view post to visit the locatin page.

== How to add services ==

1. Go to services admin menu in admin dashboard. create new post.
2. fill all the fields select the related locations from all the locations available which is dynamically filled from locations cpt
3. publish the services you can view the services from the location page it shows the related services.

== How to test the form ==
 
 1. Goto any location page and go to the Request a qoute section form.
 2. fill the form from dummy data and submit
 3. A new lead will be created with the name of the form in the admin dashboard and the data would be sent to the  https://httpbin.org/post
 4. if the lead is subimtted sucessully you will see an alert. telling it is succefull if not it will show errorr
 5. if the data is sent successfully the CRM Sync status will show Synced if not it will show failed. 

== How CRM sync works ==

When the form is submitted the data is sent to the https://httpbin.org/post automatically and the sync status is saved if there is any error in the post request or it fails the error is logged to the debug log file through error_log funtion of wordpress.
it will almost everytime successfull if the internet is connected if you want to see the unsuccessfull then turn off the internet. then submit the form. or you can go the  tekbyt-location-leads\public\class-tekbyt-location-leads-public.php 205
and eidt the url and break it.
You can check the total failed request from admin dashboard widget

== Known Limitations ==

1. the services ajax filter couldnot be completed on time.
2. The fallbacks for images and no data logic needs more time.
3. There should be an options page where user can add the CRM api link 
4. Location should have more dynamic content due to time limitaions cannot be done.

== Unfinished Parts ==

1. services ajax filter remains.
2. Sytling should me improved more.

== Dependencies ==

There is no dependency it is complete plugin with all the functionality in it. It uses two libraries. 
1. bootstrap
2. select2

== What the candidate would improve with more time ==

i would improve above limitations and add google maps API in the location so that it can be done completely dynaimically