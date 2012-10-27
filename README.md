#Project-shortcodes-for-Wordpress

Shortcode for projects for use with Wordpress. This can for instance be used to create a portfolio page. Although it's targetted towards software projects (as that's the reason why I made it), it can be used for other kinds of projects, and it is fairly simple to modify.

Note that I created this plugin mainly for my own use, so the plugin is not very flexible. 

##Usage
In your Wordpress posts or pages, insert a project using the syntax:
[project lang="<your-programming-language>" url="<link-to-project-files>" screenshots="<url-screenshot1>|<url-screenshot2>|..."]Your project description[/project]

An example of how it looks can be found at http://www.hallgeir.org/programming.

##Installation
1. Create a directory "project-shortcode" under $WPROOT/wp-content/plugins/
2. Put the project-shortcode.php file under $WPROOT/wp-content/plugins/project-shortcode
3. Activate it in Wordpress by clicking "Activate" next to the project-shortcodes entry under admin -> plugins

##License
This project is distributed under the GNU LGPL licence. Please find the licence text in "LICENSE.txt".