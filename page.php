<?php get_header(); ?>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo site_url(); ?>" style="text-decoration:none">Home</a><span class="divider">/</span>
				<a href="<?php the_permalink(); ?>" style="text-decoration:none"><?php the_title(); ?></a>
			</li>
		</ul>
	</div>
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header well">
				<h2><a href="<?php the_permalink(); ?>" style="text-decoration:none"><?php the_title(); ?></a></h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div class="box-content">
				<?php the_content(); ?>
				<div class="clearfix"></div>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>