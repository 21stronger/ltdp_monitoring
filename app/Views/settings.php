  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dashboard-data">Dashboard</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#exportimport-data">Export/Import Database</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active dashboard-data" id="dashboard-data">
                  <h5 class="card-title">Data Dashboard</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Reset Data Dashboard</div>
                    <div class="col-lg-9 col-md-8">
                      <button type="submit" class="btn btn-primary" id="btnResetData">Reset</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade exportimport-data" id="exportimport-data">
                  <h5 class="card-title">Export/Import Database</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Under Construction</div>
                  </div>
                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
  
<script type="text/javascript">
  $(document).ready(function(){

    //Button Reset Data Dashboard
    $('#btnResetData').click( function(){
      var $this = $(this);
      $this.prop("disabled", true);
      $this.html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...`
      );
      $.ajax({
        url: "<?= base_url('settings/resetData'); ?>",
        success: function(response){
          var result = JSON.parse(response);
          if(result.status=="success"){
            $this.toggleClass("btn-primary btn-success");
            $this.html('Success');
            setTimeout(
              function(){
                $this.prop("disabled", false);
                $this.toggleClass("btn-success btn-primary");
                $this.html('Reset');
              }, 
              2000
            );
          } else {
            $this.toggleClass("btn-primary btn-danger");
            $this.html('Failed');
          }
        },
        error: function(){
          $this.toggleClass("btn-primary btn-danger");
          $this.html('Failed');
        }
      });
    });
  });
</script>