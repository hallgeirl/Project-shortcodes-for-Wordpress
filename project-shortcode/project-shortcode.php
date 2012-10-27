<?php
/*
Plugin Name: Project Shortcodes
Plugin URI: http://www.hallgeir.org/programming
Description: Shortcodes for listing projects in a page.
Author: Hallgeir Lien
Version: 1.1
*/

/*  Copyright 2012  Hallgeir Lien

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published 
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function create_header($title, $lang, $headerlevel)
{
    $header = "<h" . $headerlevel . ">";
    if (!empty($lang))
        $header .= "[" . $lang . "] ";

    $header .=  $title;
    $header .= "</h" . $headerlevel . ">\n";

    return $header;
}

function create_screenshot($url)
{
    $result = "";
    $result .= "<span style=\"display: inline-block;\">";
    $result .= "<a href=\"" . $url . "\">";
    $result .= "<img class=\"size-thumbnail wp-image-33\" title=\"" . $url . "\" src=\"" . substr($url, 0, strlen($url) - strlen(strrchr($url, "."))) . "-150x150" . substr($url, strlen($url) - strlen(strrchr($url, "."))) . "\" alt=\"screenshot: " . $url . "\" />";
    $result .= "</a></span>";

    return $result;
}

function create_screenshots($screenshots)
{
    $result = "";

    //Screenshots
    if (!empty($screenshots)) {
        $ss = explode("|", $screenshots);
        $result .= "<br />Screenshots:<br />";
        foreach($ss as $s) 
        {
	    $result .= create_screenshot($s);
        }
    }

    return $result;
}

function project_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array("url" => "", "title" => "Untitled project", "headerlevel" => 3, "lang" => "", "screenshots" => ""), $atts));
    
    if ($headerlevel <= 0) $headerlevel = 1;
    $result = create_header($title, $lang, $headerlevel);
    
    if (!empty($url))
        $result .= "<div><a href=\"" . $url . "\">Download</a></div>\n";
    
    $result .= "<p>";
    if (!empty($content))
        $result .= $content . "\n";
    
    $result .= create_screenshots($screenshots);
  
    $result .= "</p>\n";
    
    return $result;
}

add_shortcode("project", "project_shortcode"); 

?>
