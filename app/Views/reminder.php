  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">E-mail Address Checker</span></h5>
              <div class="table-responsive-sm">
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col" class="col-sm-1">#</th>
                      <th scope="col" class="col-sm-3">Initial</th>
                      <th scope="col" class="col-sm-5">E-mail Address</th>
                      <th scope="col" class="col-sm-3">Valid Addr</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($dataPICs as $key => $value) {
                      $num = $key+1;

                      echo "<tr>
                        <td>{$num}</td>
                        <td>{$value['name_pic']}</td>
                        <td>{$value['user_pic']}</td>
                        <td>{$value['isTrue']}</td>
                      </tr>";
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reminder Sender</h5>
              <p>Klik tombol dibawah ini untuk mengirim email ke PIC yang masih memiliki project dengan status Overdue pada bulan ini</p>
              <p>
                <button type="submit" class="btn btn-primary" id="btnSendEmail">Kirim</button>
              </p>
              <p>Atau salin script dibawah ini untuk digunakan di Task Scheduler</p>
              <p>
                <input type="text" class="form-control" value="<?= "curl -X GET ".base_url()."/reminder/send" ?>" disabled>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

<script type="text/javascript">
  $(document).ready(function(){

    //Button Reset Data Dashboard
    $('#btnSendEmail').click( function(){
      var $this = $(this);
      $this.prop("disabled", true);
      $this.html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Proses...`
      );
      $.ajax({
        url: "<?= base_url('reminder/send'); ?>",
        success: function(response){
          $this.toggleClass("btn-primary btn-success");
          $this.html('Berhasil');
          setTimeout(
            function(){
              $this.prop("disabled", false);
              $this.toggleClass("btn-success btn-primary");
              $this.html('Kirim');
            }, 
            2000
          );
        },
        error: function(){
          $this.toggleClass("btn-primary btn-danger");
          $this.html('Gagal');
        }
      });
    });
  });
</script>