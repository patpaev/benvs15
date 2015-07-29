<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html>
<html>
<head>

	<?php print $head; ?>

  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="IE=edge" http-equiv="X-UA-Compatible" />

	<?php 
		if(drupal_get_title() != '') { 
			$page_title = drupal_get_title(); } else { $page_title = ''; 
		}
		$site_name = variable_get('site_name', '');
	?>

	<title><?php print $page_title . ' | ' . $site_name; ?></title>  

	<!-- SEO relevant meta data to describe content of page -->
	<meta name="DC.Title" content="<?php print $site_name . ' | ' . $page_title; ?>">
	<meta name="keywords" content="<?php if(variable_get('unimelb_settings_meta-keywords')) { print variable_get('unimelb_settings_meta-keywords') . ', ' . $page_title . ', ' . $site_name; } ?>">
	<meta name="description" content="<?php print $site_name . ': ' . $page_title; if($is_front && variable_get('unimelb_settings_ht-right')) { print ' - ' . variable_get('unimelb_settings_ht-right'); } ?>">
	<meta name="DC.Description" content="<?php print $site_name . ': ' . $page_title; if($is_front && variable_get('unimelb_settings_ht-right')) { print ' - ' . variable_get('unimelb_settings_ht-right'); } ?>">
	<!-- End SEO relevant meta data -->

	<!-- Static meta data   -->
	<meta name="DC.Rights" content="http://www.unimelb.edu.au/disclaimer">
	<meta name="DC.Publisher" content="The University of Melbourne">
	<meta name="DC.Format" content="text/html">
	<meta name="DC.Language" content="en">
	<meta name="DC.Identifier" content="http://www.unimelb.edu.au/">
	<!-- End static meta data -->

	<!-- favicons -->
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/favicons/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#00457c">
	<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">

	<!--[if lt IE 9]><script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><![endif]-->
	<?php print $styles; ?>
	<?php print $scripts; ?>
	
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  
  
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-547495-2', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
