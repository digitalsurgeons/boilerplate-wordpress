<?php global $UI_DEBUG; if (!$UI_DEBUG): ?>

<?php endif; ?>

<?php
// render bugherd if dev environment
if (ENV !== 'prod'):
?>
<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=PROJECTAPIKEY';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>
<?php endif; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
<script defer src='/dist/svgxuse.js'></script>
<script src='/dist/vendor.js'></script>
<script src='/dist/bundle.js'></script>
</body>
</html>
