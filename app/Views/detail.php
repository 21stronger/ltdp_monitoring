  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#project-detail">Project</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#project-activity">Activity</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#project-description">Description</button>
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
                    <div class="col-lg-9 col-md-8"><?= datetostr($dataProject['project_due_date']); ?></div>
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

                  <div class="filter" style="right: 20px;">
                    <select class="form-select" name="year" id="year" onchange="getActivities()">
                      <?php
                        foreach ($yearOptions as $key => $value) {
                          echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                      ?>
                    </select>
                  </div>

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
                      <tbody id="activityTable" onload="getActivities()">
                      </tbody>
                    </table>
                  </div>

                  <!-- Edit Monthly Activity Modal -->
                  <div class="modal fade" id="monthlyActivityModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <form action="<?= base_url('update'); ?>" method="post" id="monthlyEditForm" novalidate>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Activity Achievement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" class="form-control" id="activityIdAch" name="activityIdAch">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-2 col-form-label">Activity Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="activityNameAch" disabled>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-2 col-form-label">Month</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" id="activityMonthAch" disabled>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputCategory" class="col-sm-2 col-form-label">Plan</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="activityPlanAch" disabled>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputDepartment" class="col-sm-2 col-form-label">Achievement</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" id="activityActualAch" name="activityActualAch" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPIC" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="activityDescriptionAch" name="activityDescriptionAch">
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
                  </div><!-- End Edit Monthly Activity Modal-->
                </div>

                <div class="tab-pane fade project-description" id="project-description">
                  <h5 class="card-title">Activity Description</h5>

                  <!-- Activity Description Table -->
                  <div class="row">
                    <?php if(count($dataDescription)<1) {?>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 label ">No Description Record for this Project</div>
                    </div>
                    <?php } else { ?>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Activity</th>
                          <th scope="col">Month</th>
                          <th scope="col">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $numbering=1;
                          foreach ($dataDescription as $key => $value) {
                        ?>
                        <tr>
                          <th scope="row"><?= $numbering; ?></th>
                          <td><?= $value['activity_name']; ?></td>
                          <td><?= datetostr($value['date_monthly_activity']); ?></td>
                          <td><?= $value['description']; ?></td>
                        </tr>
                        <?php
                          $numbering++;
                          }
                        ?>
                      </tbody>
                    </table>
                    <?php } ?>
                  </div><!-- End Activity Description Table -->
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
                          <td><?= datetostr($value['date_monthly_activity']); ?></td>
                          <td><?= datetostr($value['pica_due_date']); ?></td>
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
        getActivities();
        
        // Show Monthly Ach and Description Modal
        $(document).on('click', '.editable', function() {
          var id = this.id;

          $.ajax({
            url: '<?= base_url('update/getDetailMonthly'); ?>/'+id, 
            success: function(response){
              var result = JSON.parse(response);
              document.getElementById('activityIdAch').value          = result.id_monthly_activity;
              document.getElementById('activityNameAch').value        = result.activity_name;
              document.getElementById('activityMonthAch').value       = result.date_monthly_activity;
              document.getElementById('activityPlanAch').value        = result.plan_monthly_activity;
              document.getElementById('activityActualAch').value      = result.actual_monthly_activity;
              document.getElementById('activityDescriptionAch').value = result.description;
            }
          });

          $('#monthlyActivityModal').modal('show');
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

        $('#monthlyActivityModal').on('shown.bs.modal', function(){
          $('#activityActualAch').focus();
        });

        $('#monthlyEditForm').submit(function(event){
          event.preventDefault();

          $.ajax({
            url: '<?= base_url('update/updateDetail'); ?>',
            type: "POST",
            data: $('#monthlyEditForm').serialize(),
            success: function(response){
              var result = JSON.parse(response);

              document.getElementById(result.id).innerHTML = result.value+'%';
              $('#monthlyActivityModal').modal('hide');
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

      function getActivities(){
        var year = document.getElementById('year').value;
        $.ajax({
          url: "<?= base_url('update/getDetailActivity/'.$idProject); ?>/"+year,
          success: function(response){
            $('#activityTable').empty();
            var numbering = 0;
            var result = JSON.parse(response);
            result.forEach(function(items){
              numbering++;
              var rowField = '<tr class="table-warning" style="vertical-align: middle;" onclick="window">'+
                  '<th scope="row" rowspan="2">'+numbering+'</th>'+
                  '<td rowspan="2">'+items.activity_name+'</td>'+
                  '<td rowspan="2">'+items.activity_weight+'%</td>'+
                  '<td>'+isset(items.JanPlan)+'</td>'+
                  '<td>'+isset(items.FebPlan)+'</td>'+
                  '<td>'+isset(items.MarPlan)+'</td>'+
                  '<td>'+isset(items.AprPlan)+'</td>'+
                  '<td>'+isset(items.MayPlan)+'</td>'+
                  '<td>'+isset(items.JunPlan)+'</td>'+
                  '<td>'+isset(items.JulPlan)+'</td>'+
                  '<td>'+isset(items.AugPlan)+'</td>'+
                  '<td>'+isset(items.SepPlan)+'</td>'+
                  '<td>'+isset(items.OctPlan)+'</td>'+
                  '<td>'+isset(items.NovPlan)+'</td>'+
                  '<td>'+isset(items.DesPlan)+'</td>'+
                '</tr>'+
                '<tr class="table-primary">'+
                  '<td><div class="editable" id="'+items.JanId+'">'+isset(items.JanAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.FebId+'">'+isset(items.FebAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.MarId+'">'+isset(items.MarAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.AprId+'">'+isset(items.AprAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.MayId+'">'+isset(items.MayAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.JunId+'">'+isset(items.JunAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.JulId+'">'+isset(items.JulAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.AugId+'">'+isset(items.AugAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.SepId+'">'+isset(items.SepAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.OctId+'">'+isset(items.OctAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.NovId+'">'+isset(items.NovAct)+'</div></td>'+
                  '<td><div class="editable" id="'+items.DesId+'">'+isset(items.DesAct)+'</div></td>'+
                '</tr>';
            $('#activityTable').append(rowField);
            });
          }
        });
      }

      function isset(item){
        return (item!=null)?
          item+'%':
          '&nbsp;'
      }
    </script>
  </main><!-- End #main -->