<?php

function unimelb_form_system_theme_settings_alter(&$form, $form_state) {
    // Generate Menus array
    $menus = menu_get_names();
    $menuOptions = array(
        'none' => t("None")
    );

    foreach ($menus as $menu) {
        if ($menu != 'shortcut-set-1') {
            $menuOptions[$menu] = ucwords(str_replace('-', ' ', $menu));
        }
    }

    $banner_types = array(
        'newsbanner' => t("Newsbanner"),
        'homebanner' => t("Homebanner"),
        'none' => t("None"),
    );

    $navigation_options = array(
        0 => t('All pages except those listed'),
        1 => t('Only the listed pages'),
    );
    
    $max_depth_options = array(
        0 => t("Unlimited"),
        1 => t("1 Level"),
        2 => t("2 Levels"),
        3 => t("3 Levels"),
        4 => t("4 Levels"),
    );

    /* Generate Form */

    /* Visual Section */
    $form['visual'] = array(
        '#type' => 'fieldset',
        '#title' => t("Visual"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['visual']['background'] = array(
        '#type' => 'select',
        '#title' => t("Background"),
        '#default_value' => theme_get_setting('background'),
        '#options' => array(
            'blue' => t("Blue"),
            'science' => t("Science"),
            'green' => t("Green"),
            'clouds' => t("Clouds"),
            'custom' => t("Custom")
        )
    );

    $form['visual']['unimelb_banner_type'] = array(
        '#type' => 'select',
        '#title' => t("Banner type"),
        '#default_value' => theme_get_setting('unimelb_banner_type'),
        '#options' => $banner_types
    );

    /* Menu Section */
    $form['menus'] = array(
        '#type' => 'fieldset',
        '#title' => t("Menus"),
        '#collapsible' => true,
        '#collapsed' => false
    );
    
    $form['menus']['header'] = array(
        '#type' => 'fieldset',
        '#title' => t("Header Menu"),
        '#collapsible' => true,
        '#collapsed' => false
    );
    
    $form['menus']['header']['header_menu'] = array(
        '#type' => 'select',
        '#title' => t("Menu"),
        '#default_value' => theme_get_setting('header_menu'),
        '#options' => $menuOptions
    );
    
    $form['menus']['header']['header_menu_max_depth'] = array(
        '#type' => 'select',
        '#title' => t("Maximum Depth"),
        '#default_value' => theme_get_setting('header_menu_max_depth'),
        '#options' => $max_depth_options,
        '#description' => t("Set the maximum depth of the menu, starting at and including the top level")
    );

    $form['menus']['navigation'] = array(
        '#type' => 'fieldset',
        '#title' => t("Navigation Menu"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['menus']['navigation']['navigation_menu'] = array(
        '#type' => 'select',
        '#title' => t("Navigation Menu"),
        '#default_value' => theme_get_setting('navigation_menu'),
        '#options' => $menuOptions
    );
    
    $form['menus']['navigation']['navigation_menu_max_depth'] = array(
        '#type' => 'select',
        '#title' => t("Maximum Depth"),
        '#default_value' => theme_get_setting('navigation_menu_max_depth'),
        '#options' => $max_depth_options,
        '#description' => t("Set the maximum depth of the menu, starting at and including the top level")
    );

    $form['menus']['navigation']['navigation_menu_visibility'] = array(
        '#type' => 'radios',
        '#title' => t('Show Navigation Menu on specific pages'),
        '#options' => $navigation_options,
        '#default_value' => theme_get_setting('navigation_menu_visibility'),
    );

    $form['menus']['navigation']['navigation_menu_pages'] = array(
        '#type' => 'textarea',
        '#title' => '<span class="element-invisible">Pages</span>',
        '#default_value' => theme_get_setting('navigation_menu_pages'),
        '#description' => t("Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard. Example paths are blog for the blog page and blog/* for every personal blog. &lt;front&gt; is the front page."),
    );

    /* Parent Site Section */
    $form['parent_site'] = array(
        '#type' => 'fieldset',
        '#title' => t("Parent Site"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['parent_site']['site_parent_name'] = array(
        '#type' => 'textfield',
        '#title' => t("Parent Site Name"),
        '#default_value' => theme_get_setting('site_parent_name'),
        '#description' => t("The name of the parent site (i.e. Faculty of Science for the Graduate School of Science site)")
    );

    $form['parent_site']['site_parent_link'] = array(
        '#type' => 'textfield',
        '#title' => t("Parent Site Link"),
        '#default_value' => theme_get_setting('site_parent_link'),
        '#description' => t("The link to the parent site home page")
    );

    /* Contact Details Section */
    $form['contact_details'] = array(
        '#type' => 'fieldset',
        '#title' => t("Contact Details"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['contact_details']['address'] = array(
        '#type' => 'textarea',
        '#title' => t("Address"),
        '#default_value' => theme_get_setting('address'),
    );

    $form['contact_details']['phone'] = array(
        '#type' => 'textfield',
        '#title' => t("Phone"),
        '#default_value' => theme_get_setting('phone'),
    );

    $form['contact_details']['fax'] = array(
        '#type' => 'textfield',
        '#title' => t("Fax"),
        '#default_value' => theme_get_setting('fax'),
    );

    $form['contact_details']['email'] = array(
        '#type' => 'textfield',
        '#title' => t("Email"),
        '#default_value' => theme_get_setting('email'),
    );

    /* Social Media Section */
    $form['social_media'] = array(
        '#type' => 'fieldset',
        '#title' => t("Social Media"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['social_media']['facebook_url'] = array(
        '#type' => 'textfield',
        '#title' => t("Facebook Page URL"),
        '#default_value' => theme_get_setting('facebook_url'),
    );

    $form['social_media']['twitter_url'] = array(
        '#type' => 'textfield',
        '#title' => t("Twitter Page URL"),
        '#default_value' => theme_get_setting('twitter_url'),
    );

    /* Site Contacts Section */
    $form['site_contacts'] = array(
        '#type' => 'fieldset',
        '#title' => t("Site Contacts"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['site_contacts']['authoriser'] = array(
        '#type' => 'textfield',
        '#title' => t("Authoriser"),
        '#default_value' => theme_get_setting('authoriser'),
    );

    $form['site_contacts']['maintainer'] = array(
        '#type' => 'textfield',
        '#title' => t("Maintainer"),
        '#default_value' => theme_get_setting('maintainer'),
    );

    /* Development Section */
    $form['development'] = array(
        '#type' => 'fieldset',
        '#title' => t("Development"),
        '#collapsible' => true,
        '#collapsed' => false
    );

    $form['development']['show_grid'] = array(
        '#type' => 'checkbox',
        '#title' => t("Show Grid"),
        '#default_value' => theme_get_setting('show_grid'),
    );
}
