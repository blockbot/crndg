
<!-- 		<footer class="container-fluid ic-section ic-section-gray">
            <p>Copyright &copy; <?php echo date(Y); ?> <a href="http://joeydehnert.com" target="_blank">Joey Dehnert</a></p>
		</footer>
 -->

        <div class="modal fade" id="crndg-modal" tabindex="-1" role="dialog" aria-labelledby="crndg-modal-label">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="crndg-modal-label">Modal title</h4>
                    </div>
                  <div class="modal-body">
                  </div>
                </div>
            </div>
        </div>

        <noscript id="deferred-styles">
            <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"/>
            <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/library/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
            <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/library/css/main.css"/>
        </noscript>

        <script>

            var loadDeferredStyles = function() {
                var addStylesNode = document.getElementById("deferred-styles");
                var replacement = document.createElement("div");
                replacement.innerHTML = addStylesNode.textContent;
                document.body.appendChild(replacement)
                addStylesNode.parentElement.removeChild(addStylesNode);
            };

            var raf = requestAnimationFrame || mozRequestAnimationFrame ||
                webkitRequestAnimationFrame || msRequestAnimationFrame;
            if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
            else window.addEventListener('load', loadDeferredStyles);

        </script>

		<?php wp_footer(); ?>

		<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-1881290-34', 'auto');
            ga('send', 'pageview');
        </script>

	</body>

<!--
      ___           ___           ___           ___           ___
     /\  \         /\  \         /\__\         /\  \         /\  \
    /::\  \       /::\  \       /::|  |       /::\  \       /::\  \
   /:/\:\  \     /:/\:\  \     /:|:|  |      /:/\:\  \     /:/\:\  \
  /:/  \:\  \   /::\~\:\  \   /:/|:|  |__   /:/  \:\__\   /:/  \:\  \
 /:/__/ \:\__\ /:/\:\ \:\__\ /:/ |:| /\__\ /:/__/ \:|__| /:/__/_\:\__\
 \:\  \  \/__/ \/_|::\/:/  / \/__|:|/:/  / \:\  \ /:/  / \:\  /\ \/__/
  \:\  \          |:|::/  /      |:/:/  /   \:\  /:/  /   \:\ \:\__\
   \:\  \         |:|\/__/       |::/  /     \:\/:/  /     \:\/:/  /
    \:\__\        |:|  |         /:/  /       \::/__/       \::/  /
     \/__/         \|__|         \/__/         ~~            \/__/
-->

<!--

<('-'<) ^(' - ')^ (>'-')> ^(' - ')^ <('-'<) ^(' - ')^ (>'-')>

-->

</html>
