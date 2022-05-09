  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/chart.js/chart.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>/assets/js/main.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var pic, department, achievement;
      var table = $('#datatable').DataTable();
       
      $('#DeptSel').change( function() {
        department = this.value;
        table
          .columns(4)
          .search(department)
          .draw();
      });

      $('#PicSel').change( function() {
        pic = this.value
        table
          .columns(5)
          .search(pic)
          .draw();
      });

      $('#AchSel').change( function() {
        achievement = this.value
        table
          .columns(6)
          .search(achievement)
          .draw();
      });

      $('#reset').click( function() {
        document.getElementById("PicSel").selectedIndex = 0;
        document.getElementById("DeptSel").selectedIndex = 0;
        document.getElementById("AchSel").selectedIndex = 0;
        department='';
        pic='';
        table
          .columns()
          .search('')
          .draw();
      })

      // Add field
      var x = 1;
      var field = '<div class="row mb-3"><label for="InputDueDate" class="col-sm-3 col-form-label">Activity</label><div class="col-sm-4"><input type="date" class="form-control" id="inputText" name="activitiesDate[]" value="" required></div><div class="col-sm-4"><input type="number" class="form-control" id="inputText" name="activitiesWeight[]" value="" placeholder="%" required></div><div class="col-sm-1"><button id="delete" type="button" class="btn btn-danger">x</button></div></div>';
      
      $('#addButton').click(function(){
        $('#row').append(field);
      });

      $('#row').on('click', '#delete', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
      });
    });
  </script>
</body>

</html>