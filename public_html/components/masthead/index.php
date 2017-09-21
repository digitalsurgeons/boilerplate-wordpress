<section class="masthead">
  <div class="masthead__lampshade"></div>
  <picture>
    <source srcset="{{desktopImage.getUrl('mastheadDesktop')}}" media="(min-width: 1024px)">
    <source srcset="{{mobileImage.url}}" media="(min-width: 960px)">
    <img class="masthead__image" srcset="{{mobileImage.url}}">
  </picture>
  <video class="masthead__video" muted autoplay loop poster="{{desktopImage.url}}">
    <source src="/-/media/sites/camelbak/stories/videos/dane_petersen_webm.ashx" type="video/webm">
    <source
      src="{{videoWebm.getUrl()}}"
      type="video/webm">
    <source
      src="{{videoMp4.getUrl()}}"
      type="video/mp4">
    <source
      src="{{videoOgg.getUrl()}}"
      type="video/ogg">
  </video>
  <div class="masthead__container">
    <div class="masthead__content">
      <h1 class="masthead__heading" style="{% if serviceColor %}color: {{serviceColor}}{% endif %}">{{block.heading}}</h1>
      <h2 class="masthead__subheading">{{block.subheading|nl2br}}</h2>
      <a class="masthead__button button button--tertiary" href="{{block.callToAction.url}}" target="{{block.callToAction.target}}">{{block.callToAction.text}}</a>
    </div>
  </div>
</section>
