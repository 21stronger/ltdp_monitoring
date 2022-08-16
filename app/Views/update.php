  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" style="padding-top: 20px;">
              <!-- Default Accordion -->
              <?php //print_r($dataSummary); ?>
              <div class="accordion" id="accordionExample" style="padding-bottom: 10px;">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      Data Filter
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <form action="#" id="dataFilter">
                        <div class="row">
                          <label class="col-sm-2 col-form-label">Month</label>
                          <div class="col-sm-4">
                            <select class="form-select" id="monthUpd" name="monthUpd" aria-label="Default select example">
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>

                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-4">
                            <select class="form-select" id="statusUpd" name="statusUpd" aria-label="Default select example">
                              <option value="">All</option>
                              <option value="Faster">Faster</option>
                              <option value="Ontime">Ontime</option>
                              <option value="Overdue">Overdue</option>
                            </select>
                          </div>

                          <label class="col-sm-2 col-form-label">Achievement</label>
                          <div class="col-sm-4">
                            <select class="form-select" id="achUpd" name="achUpd" aria-label="Default select example">
                              <option value="">All</option>
                              <option value="Open">Open</option>
                              <option value="Close">Close</option>
                              <option value="Cancel">Cancel</option>
                              <option value="Postpone">Postpone</option>
                            </select>
                          </div>

                          <label class="col-sm-2 col-form-label">Department</label>
                          <div class="col-sm-4">
                            <select class="form-select" id="deptUpd" name="deptUpd" aria-label="Default select example">
                              <option value="">All</option>
                              <?php 
                                foreach ($dateDepartment as $key => $value) {
                              ?>
                              <option value="<?php echo $value['department_name']; ?>"><?php echo $value['department_name']; ?></option>
                              <?php 
                                }
                              ?>
                            </select>
                          </div>

                          <div class="col-sm-3" style="margin-top: 10px;">
                            <button type="button" id="resetUpd" class="btn btn-primary">Reset</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->

              <!-- Table with stripped rows -->
              <table class="table" id="dataUpdate">
                <thead>
                  <tr>
                    <th scope="col" style="width: 1%;">#</th>
                    <th scope="col">ID</th>
                    <th scope="col" style="width: 16%;">Category</th>
                    <th scope="col">Project Name</th>
                    <th scope="col" style="width: 12%;">Month</th>
                    <th scope="col" style="width: 9%;">Dept</th>
                    <th scope="col" style="width: 5%;">PIC</th>
                    <th scope="col" style="width: 5%;">Monthly</th>
                    <th scope="col" style="width: 5%;">Status</th>
                    <th scope="col" style="width: 5%;">YTD</th>
                    <th scope="col" style="width: 5%;">Ach</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script type="text/javascript">
    $(document).ready(function() {
      const date = new Date();
      //const month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      const month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
      document.getElementById('monthUpd').value = month[date.getMonth()];

      var table = $('#dataUpdate').DataTable({
        "autoWidth": false,
        "processing": false,
        "serverSide": true,
        "ordering": false,
        "ajax": {
          "url": "<?= base_url('update/getDataSummary'); ?>",
          "type": "POST",
          "data": function(d){
            d.form = $('#dataFilter').serializeArray();
          }
        },
        "createdRow": function(row, data, dataIndex, cells){
          $(row).attr('title', data[3]);
        }
      });
      
      table.column(1).visible(false);

      table.on('click', 'tr', function(){
        var data = table.row(this).data();
        window.location='<?= base_url('update/detail/'); ?>/'+data[1];
      });

      $('#monthUpd').change( function() {
        table.draw();
      });

      $('#achUpd').change( function() {
        table.draw();
      });

      $('#statusUpd').change( function() {
        table.draw();
      });

      $('#deptUpd').change( function() {
        table.draw();
      });

      $('#resetUpd').click( function() {
        document.getElementById("monthUpd").selectedIndex = date.getMonth();
        document.getElementById("achUpd").selectedIndex = 0;
        document.getElementById("statusUpd").selectedIndex = 0;
        document.getElementById("deptUpd").selectedIndex = 0;
        table.draw();
      });
    });
  </script>