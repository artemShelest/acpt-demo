<?php
/**
Plugin Name: ACPT Demo
Description: WordPress ACPT Demo gives an example of usage of attachment custom post types.
Author:      Artem Shelest
Version:     0.1
Plugin URI:  https://github.com/artemShelest/acpt-demo
License:     GPLv2 or Later
Domain Path: /languages
Text Domain: acpt-demo
 */

/* ACPT Demo
 *
 * Copyright (C) 2016 Artem Shelest (artem.e.shelest@gmail.com | https://github.com/artemShelest)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @copyright 2016
 * @license GPL v3
 * @version 0.1
 * @package acpt-demo
 * @author Artem Shelest <artem.e.shelest@gmail.com>
 */

// Include function (add_acpt_type) from attachment-cpt plugin
require_once dirname( dirname( __FILE__ )) . '/attachment-cpt/attachment-cpt.php';

if(!class_exists('ACPT_Demo')) {
	abstract class ACPT_Demo {

		const post_type = 'acpt-demo';
		const text_domain = 'acpt-demo';

		static function init() {
			add_action( 'init', array( __CLASS__, 'init_translations' ), 5 );
			add_action( 'init', array( __CLASS__, 'register_cpt' ) );
			add_action( 'plugins_loaded', array( __CLASS__, 'plugins_loaded' ) );
		}


		static function plugins_loaded() {

			Attachment_CPT::add_acpt_type( static::post_type );
		}


		static function init_translations() {
			load_plugin_textdomain( static::text_domain,
				false,
				plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		static function register_cpt() {
			$labels = array(
				'name'               => __( 'Gallery Images', static::text_domain ),
				'singular_name'      => __( 'Gallery Image', static::text_domain ),
				'add_new'            => __( 'Add New', static::text_domain ),
				'add_new_item'       => __( 'Add Gallery Image', static::text_domain ),
				'edit_item'          => __( 'Edit Gallery Image', static::text_domain ),
				'new_item'           => __( 'New Gallery Image', static::text_domain ),
				'view_item'          => __( 'View Gallery Image', static::text_domain ),
				'search_items'       => __( 'Search Gallery Images', static::text_domain ),
				'not_found'          => __( 'No gallery images found', static::text_domain ),
				'not_found_in_trash' => __( 'No gallery images found in Trash', static::text_domain ),
				'menu_name'          => __( 'Gallery Images', static::text_domain ),
			);

			$args = array(
				'labels'              => $labels,
				'hierarchical'        => false,
				'supports'            => array( 'title', 'author', 'revisions' ),
				'public'              => true,
				'show_ui'             => true,
				'show_in_nav_menus'   => false,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'has_archive'         => false,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => true,
				'map_meta_cap'        => true,
				'menu_icon'           => 'dashicons-album',
			);

			register_post_type( static::post_type, $args );
		}

	}

	ACPT_Demo::init();
}