<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'registerCustomPostTypes' ) )
{
	class registerCustomPostTypes
	{

		public function __construct()
		{

			add_action( 'init', [$this, 'create_post_type'] );

			//taxonomies
			add_action( 'init', [$this,'create_workshop_type_tax'] );
			add_action( 'init', [$this,'create_workshop_status_tax'] );
			add_action( 'init', [$this,'create_workshop_field_tax'] );
			add_action( 'init', [$this,'create_workshop_partner_tax'] );

		}

		function create_post_type() {
			
			register_post_type( 'workshop',
			    array(
			      'labels' => array(
			        'name' => __( 'Seminář', TM ),
			        'add_new' => __( 'Přidat seminář', TM ),
			        'view_item'=> __( 'Zobrazit seminář', TM ),
			        'edit_item' => __( 'Upravit seminář', TM ),
			        'singular_name' => __( 'Seminář', TM ),
			        'menu_name' => __( 'Semináře', TM ),
			      ),
			      'public' => true,
			      'menu_icon' => 'dashicons-media-spreadsheet',
			      'menu_position' => 57,
			      'has_archive' => true,
			      'show_in_rest' => true,
			      'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' , 'author' )
			    )
			);


		}

		//taxonomy type
		function create_workshop_type_tax() {
			register_taxonomy(
				'workshop_type',
				'workshop',
				array(
					'label' => __( 'Typ semináře', TM ),
					'rewrite' => array( 'slug' => 'typ' ),
					'hierarchical' => true,
				)
			);
		}

		//taxonomy time
		function create_workshop_status_tax() {
			register_taxonomy(
				'workshop_status',
				'workshop',
				array(
					'label' => __( 'Status semináře', TM ),
					'rewrite' => array( 'slug' => 'status' ),
					'hierarchical' => true,
				)
			);
		}

		//taxonomy time
		function create_workshop_field_tax() {
			register_taxonomy(
				'field',
				'workshop',
				array(
					'label' => __( 'Obor', TM ),
					'rewrite' => array( 'slug' => 'obor' ),
					'hierarchical' => true,
				)
			);
		}

		//taxonomy time
		function create_workshop_partner_tax() {
			register_taxonomy(
				'partner',
				'workshop',
				array(
					'label' => __( 'Partner', TM ),
					'rewrite' => array( 'slug' => 'obor' ),
					'hierarchical' => true,
				)
			);
		}

	}

}

new registerCustomPostTypes;