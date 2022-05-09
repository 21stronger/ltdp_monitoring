  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#project-detail">Project</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#project-activity">Activity</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active project-detail" id="project-detail">
                  <h5 class="card-title">Project Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Project Name</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['project_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Due Date</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['project_due_date']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Category</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['category_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['department_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">PIC</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['name_pic']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Achiement</div>
                    <div class="col-lg-9 col-md-8"><?= $dataProject['achievement']; ?></div>
                  </div>
                </div>

                <div class="tab-pane fade project-activity" id="project-activity">
                  <h5 class="card-title">Project Activities</h5>

                  <div class="row">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Activity</th>
                          <th scope="col">Weight</th>
                          <th scope="col">Jan</th>
                          <th scope="col">Feb</th>
                          <th scope="col">Mar</th>
                          <th scope="col">Apr</th>
                          <th scope="col">Mei</th>
                          <th scope="col">Jun</th>
                          <th scope="col">Jul</th>
                          <th scope="col">Ags</th>
                          <th scope="col">Sep</th>
                          <th scope="col">Okt</th>
                          <th scope="col">Nov</th>
                          <th scope="col">Des</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $numbering=1;
                          foreach ($detailActivity as $key => $value) {
                        ?>
                        <tr class="table-warning" style="vertical-align: middle;" onclick="window">
                          <th scope="row" rowspan="2"><?= $numbering; ?></th>
                          <td rowspan="2"><?= $value['activity_name']; ?></td>
                          <td rowspan="2"><?= $value['activity_weight']; ?>%</td>
                          <td><?= (!is_null($value['JanPlan']))? $value['JanPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['FebPlan']))? $value['FebPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['MarPlan']))? $value['MarPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['AprPlan']))? $value['AprPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['MayPlan']))? $value['MayPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['JunPlan']))? $value['JunPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['JulPlan']))? $value['JulPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['AugPlan']))? $value['AugPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['SepPlan']))? $value['SepPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['OctPlan']))? $value['OctPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['NovPlan']))? $value['NovPlan']."%":""; ?></td>
                          <td><?= (!is_null($value['DesPlan']))? $value['DesPlan']."%":""; ?></td>
                        </tr>
                        <tr class="table-primary">
                          <?php 
                            $months = array('JanAct','FebAct','MarAct','AprAct','MayAct','JunAct','JulAct','AugAct','SepAct','OctAct','NovAct','DesAct');
                            $ids = array('JanId','FebId','MarId','AprId','MayId','JunId','JulId','AugId','SepId','OctId','NovId','DesId');

                            for ($i=0; $i < 12; $i++) {
                              echo "<td>";
                              if(!is_null($value[$months[$i]])){
                          ?>
                            <div class="editable">
                              <?= $value[$months[$i]]."%"; ?>
                            </div>
                            <input type="number" class="inputEdit" id="<?= $value[$ids[$i]]; ?>" style="display: none;" value="<?= $value[$months[$i]]; ?>">
                          <?php
                              }
                              echo "</td>";
                            }
                          ?>
                        </tr>
                        <?php
                          $numbering++;
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

      </div>
    </section>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.editable').click(function() {
          var width = $(this).width();
          $('.inputEdit').hide();
          $(this).next('.inputEdit').width(width);
          $(this).next('.inputEdit').show().focus().select();
          $(this).hide();
        });

        $('.inputEdit').focusout(function() {
          var id = this.id;
          var value = $(this).val();

          $(this).hide();
          $(this).prev('.editable').show();
          $(this).prev('.editable').text(value+"%");

          $.ajax({
            url:'<?= base_url('update/updateDetail'); ?>',
            type:'post',
            data: {idUpdate: id, value: value},
            success:function(response){
              if(response == 1){
                console.log('Saved');
              }else{
                console.log('Failed');
              }
            }
          });
        });
      });
    </script>
  </main><!-- End #main -->