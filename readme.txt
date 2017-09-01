=== ManualMaker ===
Contributors: reubenlillie
Donate link: http://nazarene.org/give
Tags: Church, Nazarene, manual, custom post type, custom taxonomy, extensible, pluggable
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Make WordPress into your online manual. Make ManualMaker your own with extensions.

== Description ==

_Make WordPress into your online manual._

**ManualMaker** was built for the [Church of the Nazarene][cotn-link], but it's not just for churches, and it's not just for manuals.

[cotn-link]: http://nazarene.org/ "The International Church of the Nazarene website"

Whether you use **ManualMaker** to write a simple chapter book, a doctoral thesis, or to manage a complex reference document complete with section headings, numbered paragraphs and subparagraphs, indexes, or even more features, **ManualMaker** may be able to help make making it happen much . . . _much_ easier.

_Make ManualMaker your own with extensions._

If **ManualMaker** can't make it happen out of the box, then _let's think outside it_ because **ManualMaker** is made to be [extended][extend] so you can make sure that it can make whatever it is that you want to make with it.

[extend]: https://developer.wordpress.org/plugins/hooks/custom-hooks/ "Learn more about Custom Hooks in the WordPress Plugin Handbook"

= Why This Plugin Exists =

**ManualMaker** was originally developed to optimize the oversight, translation, publications, and distribution of the [_Manual_ of the Church of the Nazarene][manual-link] by the Office of the General Secretary and the _Manual_ Editing Committee under the direction of the Board of General Superintendents (cf. _Manual_ 318, 902.4).

The _Manual_ has been our official agreed-upon statement of faith, practice, and polity for over 100 years. It's revised and re-translated every four years by our General Assembly, and it's used every day by Nazarenes around the world—currently in 160 world areas.

A print-first approach has served us well. The fundamental flaw of such an approach, however, is that it primarily relies upon presentation techniques like typesetting and cross-referencing to enhance the user experience. 

Not only can a new web-based database system utilize these features, but WordPress and **ManualMaker** can also _get our eyes back on the text and out of the index_ by building in deeper functionality for searching, linking, translation, and distribution.

_The printed editions are not going anywhere. We'll still print them. They'll just be made from our online WordPress database instead of local installations of proprietary word-processing software._

[manual-link]: http://nazarene.org/organization/general-secretary/manual/ "Learn more about the Manual from the Office of the General Secretary"

If you're reading this, chances are you're involved with the _Manual_ or a project like it.

= How It Works =

**ManualMaker** makes the _Manual_ in much the same way WordPress makes blogging platforms.

_Custom Post Types and Taxonomies_

**ManualMaker** creates a _hierarchical custom post type_ (**Paragraphs**, like Pages) with two (2) _custom taxonomies_ (**Sections**, which are hierarchical like Categories, **Index Locators**, which are flat like Tags).

_Custom Templates_

**ManualMaker** comes with basic template files which include custom queries to display the paragraphs, sections, and indexes according to how the paragraphs are ordered, instead of, say, by publication date like WordPress posts.

Each template is chock-full of custom [extensible hooks][extend], so you can more deeply integrate **ManualMaker** with your plugins and themes.

= How You Can Help =

_Contribute as you're able._

* You can support the Church of the Nazarene Information Technology team and the Office of the General Secretary by [giving online](http://nazarene.org/give "Give back to ManualMaker through the Church of the Nazarene"). When the Church can fulfill its [mission](http://nazarene.org/mission "The mission of the Church of the Nazarene is to make Christlike disciples in the nations"), we fulfill ours.

* If you can write clearly, then we can always use your help with the [documentation and guides][wiki].

[wiki]: http://github.com/reubenlillie/manualmaker/wiki "ManualMaker wiki on GitHub"

* If you can code, then you're welcome to help us maintain, extend, and translate **ManualMaker** on [GitHub](http://github.com/reubenlillie/manualmaker.git "ManualMaker on GitHub").

### License

ManualMaker is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html/ "GNU General Public License 2.0 or later"), version 2 or later.

&copy; 2016 [Reuben L. Lillie](https://reubenlillie.com/about/ "About Reuben")

== Installation ==

1. Upload `manualmaker.zip` to your `/wp-content/plugins/` directory
1. Activate ManualMaker through WordPress 'Plugins' menu
1. Place `add_action('plugin_name_hook');` in your theme's `functions.php` or plugin files

== Frequently Asked Questions ==

= Is there documentation on **ManualMaker**? =

**Yes!** Read and contribute to our [wiki on GitHub][wiki].

== Changelog ==

= 0.1.0 = 
Initial commit to GitHub

= 0.1.1 =
Add REST API access to 'paragraph' post type and 'section' and 'index_locator' taxonomies
