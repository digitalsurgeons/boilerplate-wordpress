<section class="masthead">
  <div class="masthead__lampshade"></div>

  <?php if( have_rows('image') ): ?>
    <?php while ( have_rows('image') ) : the_row(); ?>
      <?php $desktop_image = get_sub_field('desktop'); ?>
      <?php $mobile_image = get_sub_field('desktop'); ?>
      <picture>
        <source srcset="<?=$desktop_image['url']?>" media="(min-width: 1024px)">
        <source srcset="<?=$mobile_image['url']?>" media="(min-width: 960px)">
        <img class="masthead__image" srcset="<?=$mobile_image['url']?>">
      </picture>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if( have_rows('video') ): ?>
    <?php while ( have_rows('video') ) : the_row(); ?>
      <?php $webm = get_sub_field('webm'); ?>
      <?php $mp4 = get_sub_field('mp4'); ?>
      <?php $ogg = get_sub_field('ogg'); ?>
      <video class="masthead__video" muted autoplay loop poster="<?=$desktop_image['url']?>">
        <source src="<?=$webm['url']?>" type="video/webm">
        <source src="<?=$webm['url']?>" type="video/webm">
        <source src="<?=$mp4['url']?>" type="video/mp4">
        <source src="<?=$ogg['url']?>" type="video/ogg">
      </video>
    <?php endwhile; ?>
  <?php endif; ?>

  <div class="masthead__container">
    <div class="masthead__content">
      <h1 class="masthead__heading"><?= get_sub_field('heading') ?></h1>
      <h2 class="masthead__subheading"><?= get_sub_field('subheading') ?></h2>
    </div>
  </div>
</section>
