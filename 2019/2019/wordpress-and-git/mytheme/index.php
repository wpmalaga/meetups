<?php /* Main Template File*/ ?>

    <?php get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

        <?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

            <?php /* HTML5 article */ ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                <?php the_title(); ?>
                            </a>
                        </h1>
                    </header><!-- .entry-header -->
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                    <footer class="entry-meta">
                        <?php the_time(get_option('date_format')); ?>
                    </footer><!-- .entry-meta -->
                <?php /* Close up the article */ ?>
                </article>

            <?php endwhile; ?>
        <?php endif; ?>

        </div>
    </div>

    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
<?php /* End Main Template File*/ ?>