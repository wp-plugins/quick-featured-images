=== Quick Featured Images ===
Contributors: Hinjiriyo
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SBF76TCGTRNX2
Tags: add, assign, associate, attach, author, batch, bulk, category, categories, change, control, custom post types, custom taxonomy, custom taxonomies, define, delete, detach, exchange, featured, featured image, featured images, image, image size, images, mass, media, pages, parent page, post type, post types, posts, quick, rapid, remove, replace, search, set, tag, taxonomy, taxonomies , thumb, thumbnail, thumbnails, thumbs, unset, update
Requires at least: 3.7
Tested up to: 3.9
Stable tag: 4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Bulk set, replace and remove featured images for posts, pages and custom post types in one go and save your time

== Description ==

Quick Featured Images sets, replaces and removes featured images for posts, pages and custom post types in one go and saves your time. You can run it over all posts or narrow down to posts by using flexible filters.

= Main actions =

Quick Featured Images enables you three main tasks with featured images: add, exchange and delete them.

1. **Adding featured images:** You can set and replace an image as the new featured image to hundreds of posts in one go.
2. **Exchanging featured images:** You can replace or update several existing featured images with one new image in one go.
3. **Deleting featured images:** You can remove a particular or any existing featured image in one go.

= Filters =

If there would be no filters Quick Featured Images would affect all posts and pages without exception! In most cases this is not desired. 

The implemented filters allows you to narrow down the action to only the posts and pages you want to modify. The built-in filters are:

* Filter by **post type**: Search by post types. By default all posts, pages and custom post types will be affected
* Filter by **status**: Search by several statuses (published, draft, private etc.). By default all statuses will be affected
* Filter by **search**: Search by search term
* Filter by **author**: Search by author
* Filter by **time**: Search by time specifications
* Filter by **custom taxonomy**: Search by terms of registered taxonomies of a plugin or a theme
* Filter by **featured image size**: Search for too small featured images
* Filter by **category**: Search posts by category
* Filter by **tag**: Search posts by tag
* Filter by **parent page**: Search child pages by parent page

New filters will come.

If you have any new idea for Quick Featured Images post your questions and ideas in the [support forum at wordpress.org](http://wordpress.org/support/plugin/quick-featured-images).

= Support =

Support for this plugin will be provided in the form of Product Support. This means that I intend to fix any confirmed bugs, listen to ideas for this plugin and improve the user experience when enhancements are identified and can reasonably be accomodated. There is no User Support provided for this plugin. If you are having trouble with this plugin in your particular installation of WordPress, I will not be able to help you troubleshoot the problem.

= No warranty and liability! = 

This plugin is provided under the terms of the GPL, including the following:

BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Quick Featured Images'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard
5. Go to 'Media' => 'Quick Featured Images'

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `quick-featured-images.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard
6. Go to 'Media' => 'Quick Featured Images'

= Using FTP =

1. Download `quick-featured-images.zip`
2. Extract the `quick-featured-images` directory to your computer
3. Upload the `quick-featured-images` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard
5. Go to 'Media' => 'Quick Featured Images'


== Frequently Asked Questions ==

= Who can see Quick Featured Images in the WordPress backend? =

All users who have the right to **edit others posts** have the access to Quick Featured Images. As long as the user roles are untouched after a fresh standard WordPress installation both Administrators and Editors can use this plugin.

For these users the link 'Quick Featured Images' under 'Media' in the WordPress backend appears. All other users will not see the 'Quick Featured Images' link or will get an error message while requesting a Quick Featured Images page via a direct link.

= Does the plugin work in a WordPress Multisite installation? =

Yes. It works either activated for all sites (network wide) or activated in each single site. It changes only the posts of the site where you use it.

= Why does the plugin say "No matches found" after confirmation? =

This could be the case if the images were not uploaded via WordPress' own media uploader. If you have uploaded images via FTP or other ways the plugin can not find images.

It does not matter where the images are stored on your server. They can be in any folder. But they have to be uploaded via WordPress' own media uploader to be found by this plugin. IF this is the case the plugin will work fine.

= Why are there sometimes strange search results with custom taxonomies? =

The search for custom taxonomy terms could lead to surprising results. The reason is custom taxonomies can be used in many different ways. It is not possible to catch them all in one single code expression. If you should be unsatisfied with the result try other filters to get the result you want.

= Which languages does the plugin support? =

Actually these languages are supported:
* English
* German

Further translations are welcome. If you want to give in your translation please leave a notice in the [plugin's support forum](http://wordpress.org/support/plugin/quick-featured-images).

= Where is the *.pot file for translating the plugin in any language? =

If you want to contribute a translation of the plugin in your language it would be great! You would find the *.pot file in the 'languages' directory of this plugin. If you would send the *.po file to me I would include it in the next release of the plugin.

== Screenshots ==

1. The first screen of Quick Featured Images: select an image and an action.
2. The second screen: select a filter to narrow down to posts and pages you want to modify with the image. Alternatively you can drop filtering and jump to Screen 4 directly.
3. The third screen: refine the filters.
4. The fourth screen: take a preview. If the filtering does not correspond to your expectations you can refine the filters again under the list on this page.
5. The fifth and last screen: take an overview of the success of the action.

== Changelog ==

= 4.0 =
* Added new filter "Filter by Time Specifications": Search in time periods on a year-month base
* Improved page speed at both the preview list and the result list
* Improved style for smartphones
* Updated *.pot file and german translation

= 3.2.1 =
* Added message after activation about the plugin's location in the backend
* Updated *.pot file and german translation

= 3.2 =
* Added thumbnails of current assigned featured images both in the preview and the result lists
* Design adjustment for links
* Updated *.pot file and german translation


= 3.1.1 =
* Fixed useless listing of custom post types which do not support thumbnails

= 3.1 =
* Fixed missing merge of post types and custom post types as default if post type filter was not selected
* Changed the style to be based more on WP standard style
* Changed selection modus for images to be replaced from single to multiple
* Changed names of custom post types into their more readable labels
* Changed names of custom taxonomies into their more readable labels
* Changed notice for untouched posts from "failed" to "unconsidered"
* Moved notice of selected action to the right of the selected image
* Updated *.pot file and german translation

= 3.0.2 =
* Fixed broken search filter

= 3.0.1 =
* Fixed: error message after plugin activation
* Fixed: no images in the image library
* Fixed: PHP error searching for posts in the backend
* Deleted uninstall.php to avoid a confusing uninstall message

= 3.0 =
* Added new filter "Filter by Custom Taxonomies"
* Changed default post types: ALL posts, pages and custom post types are included in the search by default 
* Changed default selection in drop down selection lists into "nothing selected"
* Updated *.pot file and german translation
* Improved performance
* Improved design of confirmation page
* Revised functions

= 2.0.2 =
* Revised SQL statement for featured image size filter

= 2.0.1 =
* Fixed missing headline on confirmation page if action "remove any image" was selected
* Updated *.pot file and german translation

= 2.0 =
* Added new action "Remove any image"
* Added new filter "Filter by Featured Image Size"
* Added error notice if no image of the image replacement list was selected
* Changed design of the plugin's start page. I hope you find it more useful
* Improved processing speed of found posts
* Improved performance
* Improved security for input data and URLs

= 1.0 =
* The plugin was released.

== Upgrade Notice ==

= 4.0 =
* Added new filter "Filter by Time Specifications": Search in time periods on a year-month base
* Improved page speed at both the preview list and the result list
* Improved style for smartphones

= 3.2.1 =
More orientation: After activation of this plugin a message tells you where you can find the plugin in the WordPress backend.

= 3.2 =
Better overview: Now you can see both in the preview and the result lists the current assigned featured image of each post.

= 3.1.1 =
Fixed useless listing of custom post types which do not support thumbnails

= 3.1 =
* Many improvements of the user interface in style and labeling
* Now you can select multiple images to be replaced instead of only a single one
* Fixed some minor errors

= 3.0.2 =
Now the filter by search term works properly again.

= 3.0.1 =
Fixed error message after plugin activation and missed images in the library

= 3.0 =
* Added new filter "Filter by Custom Taxonomies"
* Be aware of the changed default behaviour: ALL posts, pages and custom post types are included in the search by default 
* Improved performance
* Improved design of confirmation page


= 2.0 =
Many improvements and additions

= 1.0 =
No upgrades, just the first release.
