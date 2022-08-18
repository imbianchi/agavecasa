<style>
.col {
	padding: 0px;
	}
</style>



<section>
	<div class="row row-small">
		
	
	       <div class="col medium-12 small-12 large-6 inline-col">
		  
			
			   
			   
			   <span>
			   CLASSIFICAR POR:
			   
			   </span>
			   <form class='post-filters'>
	<select name="orderby">
		<?php
			$orderby_options = array(
				'DESC' => 'Descendente',
				'ASC' => 'Ascendente',
				'post_date' => 'Data',
				'post_title' => 'Nome',
				
			);

			foreach( $orderby_options as $value => $label ) {
				echo "<option ".selected( $_GET['orderby'], $value )." value='$value'>$label</option>";
			}
		?>
	</select>
	
	<div class="btn-filtrar">
		
				 
	<input type='submit' value='Filtrar'>
		  </div>
</form>
			   
			   
			   
			   
			   
			   
			   
			   
			   
		   
	 	
	       </div>
	       
		   <div class="col medium-12 small-12 large-3 inline-col mobile-none">
	       	
	       </div>
		
		   <div class="col medium-12 small-12 large-3 inline-col">
	       	<?php echo do_shortcode('[search]');?>
	       </div>
		
	</div>

<?php

$query_args = array(
	'post_type' => 'post',
	'category_name' => 'corporativo',
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
		.row.row-small {
    max-width: 1262.5px;
}
		.row.row-small {
    margin: 0 auto !important;
}
		
		@media only screen and (max-width: 600px) {
  .mobile-none {
    display: none;
}
}
	form.post-filters {
    display: inline-flex;
}	
		
		form.post-filters select {
    box-shadow: none !important;
    border: none;
    padding: 0px;
    text-transform: uppercase;
    border-bottom: 2px solid #000000d9;
			font-weight: 600;
}
		
		.btn-filtrar {
    margin-left: 20px;
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