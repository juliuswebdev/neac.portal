
        <div class="text-center py-4 text-muted" style="background: #222;">
            <p class="text-white m-0">Copyright  2007-<?= date('Y') ?> NEAC Medical Exams Application Center Inc.</p>
        </div>
    </main>

    <script src="/node_modules/js/jquery-3.4.1.min.js"></script>
    <script src="/node_modules/js/popper.min.js"></script>

    <script src="/node_modules/js/bootstrap.min.js"></script>

    <script src="/node_modules/plugins/smooth-scroll/smoothscroll.js"></script>
    <script src="/node_modules/plugins/slick/slick.min.js"></script>
    <script src="/node_modules/plugins/moment/moment.min.js"></script>
    <script src="/node_modules/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/node_modules/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/node_modules/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/node_modules/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/node_modules/plugins/select2/js/select2.full.min.js"></script>
    <script src="/node_modules/js/script.js"></script>

    <script>
        function myFunction() {
            var copyText = document.getElementById("qrInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert('Copied to Clipboard!');
        }
    </script>
     <script>
         const tooltipContents = [];
         function mediaListener(media) {
             $("#sidebar-wrapper .list-group-item").each((i, el) => {
                 const content = $(el).attr("title");

                 if (!tooltipContents.includes(content)) {
                     tooltipContents.push(content);
                 }

                 if (media.matches) {
                     $(el).attr("data-toggle", "tooltip");
                     $(el).attr("title", tooltipContents[i]);
                 } else {
                     $(el).attr("data-toggle", "");
                     $(el).attr("title", "");
                 }
             });
         }

          $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
              $("#menu-toggle").toggleClass("active");

              const isToggledSidebar = $("#wrapper").hasClass("toggled");

              $("#sidebar-wrapper .list-group-item").each((i, el) => {
                  const content = $(el).attr("title");

                  if (!tooltipContents.includes(content)) {
                      tooltipContents.push(content);
                  }

                  if (isToggledSidebar) {
                      $(el).attr("data-toggle", "");
                      $(el).attr("title", "");
                  } else {
                      $(el).attr("data-toggle", "tooltip");
                      $(el).attr("title", tooltipContents[i]);
                  }
              });
          });
          window.matchMedia("(min-width: 768px) and (max-width: 991px)").addEventListener("change", mediaListener)
     </script>
  </body>
</html>