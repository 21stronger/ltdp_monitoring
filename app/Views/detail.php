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

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#project-pica">PICA</button>
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

                <div class="tab-pane fade project-pica" id="project-pica">
                  <h5 class="card-title">Project PICA
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#projectPicaAddModal">
                      <i class="bi bi-plus-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Add PICA"></i>
                    </button>
                  </h5>

                  <!-- PICA Table -->
                  <div class="row">
                    <?php if(count($dataPica)<1) {?>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 label ">No PICA Record for this Project</div>
                    </div>
                    <?php } else { ?>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Activity</th>
                          <th scope="col">Month</th>
                          <th scope="col">Due Date</th>
                          <th scope="col">Root Cause</th>
                          <th scope="col">CAPA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $numbering=1;
                          foreach ($dataPica as $key => $value) {
                        ?>
                        <tr>
                          <th scope="row"><?= $numbering; ?></th>
                          <td>
                            <?= $value['activity_name']; ?>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#projectPicaEditModal" onclick="editPica('<?= $value['id_pica']; ?>')">
                              <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit PICA"></i>
                            </button>
                          </td>
                          <td><?= $value['date_monthly_activity']; ?></td>
                          <td><?= $value['pica_due_date']; ?></td>
                          <td><?= $value['root_cause']; ?></td>
                          <td><?= $value['capa']; ?></td>
                        </tr>
                        <?php
                          $numbering++;
                          }
                        ?>
                      </tbody>
                    </table>
                    <?php } ?>
                  </div><!-- End PICA Table -->

                  <!-- Add Pica Modal -->
                  <div class="modal fade" id="projectPicaAddModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <form action="<?= base_url('pica/addpica/'.$idProject) ?>" method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Add PICA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-2 col-form-label">Activity Name</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="activityName"  id="activityName" aria-label="Default select example" required>
                                  <option disabled value selected>-</option>
                                  <?php 
                                    foreach ($dataActivities as $key => $value) {
                                    echo "<option value=".$value['id_activity'].">".$value['activity_name']."</option>";
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-2 col-form-label">Month</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="activityMonth"  id="activityMonth" aria-label="Default select example" required>
                                  <option disabled value>-</option>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputCategory" class="col-sm-2 col-form-label">Due Date</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" id="picaDueDate" name="picaDueDate" value="" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputDepartment" class="col-sm-2 col-form-label">Root Cause</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="rootCause" name="rootCause" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPIC" class="col-sm-2 col-form-label">CAPA</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="capa" name="capa" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div><!-- End Add Pica Modal-->

                  <!-- Edit Pica Modal -->
                  <div class="modal fade" id="projectPicaEditModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <form action="" id="formEditPica" method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit PICA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-2 col-form-label">Activity Name</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="activityName"  id="activityNameEdit" aria-label="Default select example" required>
                                  <option disabled value>-</option>
                                  <?php 
                                    foreach ($dataActivities as $key => $value) {
                                    echo "<option value=".$value['id_activity'].">".$value['activity_name']."</option>";
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-2 col-form-label">Month</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="activityMonth"  id="activityMonthEdit" aria-label="Default select example" required>
                                  <option disabled value>-</option>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputCategory" class="col-sm-2 col-form-label">Due Date</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" id="picaDueDateEdit" name="picaDueDate" value="" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputDepartment" class="col-sm-2 col-form-label">Root Cause</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="rootCauseEdit" name="rootCause" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPIC" class="col-sm-2 col-form-label">CAPA</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="capaEdit" name="capa" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div><!-- End Edit Pica Modal-->
                </div>

              </div>

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

        $('#activityName').change(function(){
          $('#activityMonth').children().slice(1).remove();
          $.ajax({
            url: '<?= base_url('update/getMonthly'); ?>/'+this.value,
            success: function(result){
              var resultObj = JSON.parse(result);
              resultObj.forEach(function(items){
                var field = "<option value="+items.id_monthly_activity+">"+items.date_monthly_activity+"</option>";
                $('#activityMonth').append(field);
              });
            }
          });
        });

        $('#activityNameEdit').change(function(){
          $('#activityMonthEdit').children().slice(1).remove();
          $.ajax({
            url: '<?= base_url('update/getMonthly'); ?>/'+this.value,
            success: function(result){
              var resultObj = JSON.parse(result);
              resultObj.forEach(function(items){
                var field = "<option value="+items.id_monthly_activity+">"+items.date_monthly_activity+"</option>";
                $('#activityMonthEdit').append(field);
              });
            }
          });
        });
      });

      function editPica(id){
        document.getElementById('formEditPica').action = '<?= base_url('pica/editpica'); ?>/'+id;
        $.ajax({
          url: '<?= base_url('pica/getpica'); ?>/'+id,
          success: function(items){
            var item = JSON.parse(items);
            document.getElementById('activityNameEdit').value = item.id_activity;
            editMonthOptions(item.id_activity, item.id_monthly_activity);
            document.getElementById('picaDueDateEdit').value = item.pica_due_date;
            document.getElementById('rootCauseEdit').value = item.root_cause;
            document.getElementById('capaEdit').value = item.capa;
          }
        })
      }

      function editMonthOptions(idActivity, idMonthly){
          $('#activityMonthEdit').children().slice(1).remove();
          $.ajax({
            url: '<?= base_url('update/getMonthly'); ?>/'+idActivity,
            success: function(result){
              var resultObj = JSON.parse(result);
              resultObj.forEach(function(items){
                var field = "<option value="+items.id_monthly_activity+">"+items.date_monthly_activity+"</option>";
                $('#activityMonthEdit').append(field);
              });
              document.getElementById('activityMonthEdit').value = idMonthly;
            }
          });
        }
    </script>
  </main><!-- End #main -->