You need to do same steps for import news (capability with WP now):

# Create Table 'export' in WordPress DataBase (1.1)
# Record data to 'export' table (you can to use script 1.2)
# Use migrate DB to change all http://site.com/SLUG to /SLUG, for capability link with custom hosts (exclude image column)
# Export to csv
# Use command 'php artisan npa:import --filepath=storage/app/posts.csv --stripslashes=1 --site_id=1' for import form scv file
# Profit!

<!-- Export Table 1.1


CREATE TABLE `export` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_id` int(11) unsigned NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `excerpt` text,
  `content` longtext,
  `slug` varchar(255) DEFAULT NULL,
  `categories` text,
  `tags` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `lang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


 -->

<!-- SCRIPT 1.2 .
PHP EXPORT EXAMPLE FOR WORDPRESS, copy it to /wp-content/themes/single.php


global $wpdb;
wp_cache_flush();

$count = wp_count_posts()->publish;
$perPage = 100;
$postCategoriesFilter = [59, 68];
//echo '<pre>';print_r(get_categories());echo '</pre>';die;

$importCount = 0;
for($i = 0; $i <= $count / $perPage; $i++) {
	$posts = get_posts([
		'post_type' => 'post',
	  	'post_status' => 'publish',
	  	'offset' => $i * $perPage,
		'numberposts' => $perPage,
		'category__in' => $postCategoriesFilter
	]);
	$importCount = $importCount + count($posts);
	foreach($posts as $post) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$image = isset($image[0]) ? $image[0] : null;

		$oldCategories = get_the_category($post->ID) ?: [];
		foreach($oldCategories as $row) {
			$categories = $categories ? $categories . ',' . $row->name : $row->name;
		}
		$oldTags = get_the_tags($post->ID) ?: [];
		foreach($oldTags as $row) {
			$tags = $tags ? $tags . ',' . $row->name : $row->name;
		}

		$wpdb->insert(
			'export',
			[
				'source_id' => $post->ID,
				'title' => $post->post_title,
				'content' => do_shortcode($post->post_content),
				'excerpt' => $post->post_excerpt,
				'categories' => $categories ?? null,
				'tags' => $tags ?? null,
				'slug' => $post->post_name,
				'image' => $image,
				'published_at' => $post->post_date,
				'updated_at' => $post->post_modified,
				'created_at' => $post->post_date,
				'url' => get_permalink($post)
			],
			[
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
			]
		);

		wp_cache_delete( $post->ID, 'posts' );
		wp_cache_delete( $post->ID, 'post_meta' );
	}
}
echo($importCount);
die;


-->