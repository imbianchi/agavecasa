<style>
.col {
	padding: 0px;
	}
</style>

<section>

<?php

$query_args = array(
	'post_type' => 'post',
	'category_name' => 'projetos',
	'posts_per_page' => '3',
);

// The Query
$the_query = new WP_Query( $query_args );

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
?>
<a href="<?php the_permalink(); ?>">
	<div>
		<div>
			<?php the_post_thumbnail( 'full' ); ?>
		</div>

		
		
		<div class="section">
			<div class="row align-center">
				<div class="col medium-12 small-12 large-12">
					
			
			
			<h2 style="
    text-align: left;
    margin-top: 15px;
    margin-bottom: 70px;
"><?php the_title(); ?></h2>
		</div>	
			</div>
				</div>

	</div>
</a>
	
	<style>
	
	.row.align-center {
    margin: 0 auto !important;
		max-width: 1000px;
}
		.col.medium-12.small-12.large-12 {
    width: 900px;
}
		.section {
    padding-top: 5px;
    padding-bottom: 0px;
}
	</style>
	
<?php
	}
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	echo "Nenhum resultado encontrado";
}
?>
</section>