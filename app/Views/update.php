  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <!-- Default Accordion -->
              <?php //print_r($dataSummary); ?>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      Data Filter
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <label class="col-sm-2 col-form-label">Month</label>
                        <div class="col-sm-4">
                          <select class="form-select" id="monthUpd" aria-label="Default select example">
                            <option value="">All</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select>
                        </div>

                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                          <select class="form-select" id="statusUpd" aria-label="Default select example">
                            <option value="">All</option>
                            <option value="Faster">Faster</option>
                            <option value="Ontime">Ontime</option>
                            <option value="Overdue">Overdue</option>
                          </select>
                        </div>

                        <label class="col-sm-2 col-form-label">Achievement</label>
                        <div class="col-sm-4">
                          <select class="form-select" id="achUpd" aria-label="Default select example">
                            <option value="">All</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                            <option value="Cancel">Cancel</option>
                          </select>
                        </div>

                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-4">
                          <select class="form-select" id="deptUpd" aria-label="Default select example">
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

                        <div class="col-sm-3">
                          <button type="button" id="resetUpd" class="btn btn-primary">Reset</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->

              <!-- Table with stripped rows -->
              <table class="table" id="dataUpdate">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Month</th>
                    <th scope="col">Dept</th>
                    <th scope="col">PIC</th>
                    <th scope="col">Monthly</th>
                    <th scope="col">Status</th>
                    <th scope="col">YTD</th>
                    <th scope="col">Achievement</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach ($dataSummary as $key => $value) {
                    switch (true) {
                      case ($value['ach']>1.0):
                        $status = "Faster";
                        break;
                      
                      case ($value['ach']==1.0):
                        $status = "Ontime";
                        break;
                      
                      case ($value['ach']<1.0):
                        $status = "Overdue";
                        break;
                      
                      default:
                        $status = "Overdue!";
                        break;
                    }
                ?>
                  <tr onclick="window.location='<?= base_url('update/detail/'.$value['id_project']); ?>';">
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $value['category_name']; ?></td>
                    <td><?= $value['project_name']; ?></td>
                    <td><?= $value['date_monthly_activity']; ?></td>
                    <td><?= $value['department_name']; ?></td>
                    <th><?= $value['name_pic']; ?></th>
                    <td><?= $value['ach']*100; ?>%</td>
                    <td><?= $status; ?></td>
                    <td><?= $value['ach']*100; ?>%</td>
                    <td><?= $value['achievement']; ?></td>
                  </tr>
                <?php
                  $no++;
                  }
                ?>
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
      var month, status, department, achievement;
      var table = $('#dataUpdate').DataTable();
       
      $('#monthUpd').change( function() {
        if(this.value==''){
          month = this.value;
        } else {
          month = '2022-'+this.value;
        }
        table
          .columns(3)
          .search(month)
          .draw();
      });

      $('#achUpd').change( function() {
        achievement = this.value
        table
          .columns(9)
          .search(achievement)
          .draw();
      });

      $('#statusUpd').change( function() {
        status = this.value
        table
          .columns(7)
          .search(status)
          .draw();
      });

      $('#deptUpd').change( function() {
        department = this.value
        table
          .columns(4)
          .search(department)
          .draw();
      });

      $('#resetUpd').click( function() {
        document.getElementById("monthUpd").selectedIndex = 0;
        document.getElementById("achUpd").selectedIndex = 0;
        document.getElementById("statusUpd").selectedIndex = 0;
        document.getElementById("deptUpd").selectedIndex = 0;
        department='';
        month='';
        status='';
        achievement='';
        table
          .columns()
          .search('')
          .draw();
      });
    });
  </script>