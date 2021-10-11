<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function my_blocks_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'my_blocks-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'my_blocks-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'my_blocks-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'my_blocks-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-2-cols', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'my_blocks-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'my_blocks-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'my_blocks-cgb-block-editor-css',
			'render_callback' => 'render_2_cols'
		)
	);
	register_block_type(
		'cgb/block-3-cols', array(
			'render_callback' => 'render_3_cols'
		)
	);
	register_block_type(
		'cgb/block-hosting-block', array(
			'render_callback' => 'render_hosting_block'
		)
	);
	register_block_type(
		'cgb/block-pros-cons', array(
			'render_callback' => 'render_pros_cons'
		)
	);
	register_block_type(
		'cgb/block-tags-cloud', array(
			'render_callback' => 'render_tags_cloud'
		)
	);
	register_block_type(
		'cgb/block-contents-table', array(
			'render_callback' => 'render_contents_table'
		)
	);
	register_block_type(
		'cgb/block-client-reviews', array(
			'render_callback' => 'render_client_reviews'
		)
	);
}

require_once plugin_dir_path( __FILE__ ) . '/templates/block-2-cols.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/block-3-cols.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/hosting-block.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/pros-cons-block.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/tags-cloud.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/table-of-contents.php';
require_once plugin_dir_path( __FILE__ ) . '/templates/reviews.php';


// Hook: Block assets.
add_action( 'init', 'my_blocks_cgb_block_assets' );
