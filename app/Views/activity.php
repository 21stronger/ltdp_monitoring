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
                  <h5 class="card-title">Project Details
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#projectEditModal">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                  </h5>

                  <!-- Project Edit Modal -->
                  <div class="modal fade" id="projectEditModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <form action="<?= base_url('project/editProject/'.$idProject); ?>" method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Project Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-2 col-form-label">Project Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputText" name="projectName" value="<?= $dataProject['project_name']; ?>">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-2 col-form-label">Due Date</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputText" name="projectDueDate" value="<?= $dataProject['project_due_date']; ?>">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="projectCategory"  id="category" aria-label="Default select example">
                                  <?php foreach ($dataCategories as $key => $value) {
                                    $selected = 
                                    ($value['category_name']==$dataProject['category_name'])? 
                                    " selected": "";
                                    echo "<option value=".$value['id_category']."".$selected.">".$value['category_name']."</option>";
                                  }?>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="projectDepartment"  id="department" aria-label="Default select example">
                                <?php 
                                  foreach ($dateDepartment as $key => $value) {
                                    $selected = 
                                    ($value['department_name']==$dataProject['department_name'])? 
                                    " selected": "";

                                    echo "<option value=".$value['id_department']."".$selected.">".$value['department_name']."</option>";
                                  }
                                ?>
                            </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputPIC" class="col-sm-2 col-form-label">PIC</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="projectPic"  id="pic" aria-label="Default select example">
                                  <?php foreach ($dataPics as $key => $value) {
                                    $selected = 
                                    ($value['name_pic']==$dataProject['name_pic'])? 
                                    " selected": "";
                                    echo "<option value=".$value['id_pic']."".$selected.">".$value['name_pic']."</option>";
                                  }?>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="inputAchievement" class="col-sm-2 col-form-label">Achievement</label>
                              <div class="col-sm-10">
                                <select class="form-select" name="projectAchievement" id="achievement" aria-label="Default select example">
                                  <option value="Open"
                                  <?php echo ($dataProject['achievement']=="Open")?" selected":""; ?>>Open</option>
                                  <option value="Close"
                                  <?php echo ($dataProject['achievement']=="Close")?" selected":""; ?>>Close</option>
                                  <option value="Cancel"
                                  <?php echo ($dataProject['achievement']=="Cancel")?" selected":""; ?>>Cancel</option>
                                </select>
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
                  </div><!-- End Project Edit Modal-->

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
                  <h5 class="card-title">Project Activities
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#activityAddModal">
                      <i class="bi bi-plus-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Activity"></i>
                    </button>
                  </h5>

                  <!-- Activity Add Modal -->
                  <div class="modal fade" id="activityAddModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form id="activityAddForm" method="post"> 
                          <div class="modal-header">
                            <h5 class="modal-title">Add Activity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="addRowModal">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-3 col-form-label">Activity Name</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="activityAddName" name="activityName" value="" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-3 col-form-label">Activity Weight</label>
                              <div class="col-sm-9">
                                <input type="number" class="form-control" id="activityAddWeight" name="activityWeight" value="" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-3 col-form-label">Activity</label>
                              <div class="col-sm-4">
                                <input type="date" class="form-control" id="activityAddDate" name="activitiesDate[]" value="" required>
                              </div>
                              <div class="col-sm-4">
                                <input type="number" class="form-control" id="activityAddWeight" name="activitiesWeight[]" value="" placeholder="%" required>
                              </div>
                              <div class="col-sm-1">
                                <button id="delete" type="button" class="btn btn-danger" disabled>x</button>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" id="addAddButton" class="btn btn-secondary">Add Row</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End Activity Add Modal-->

                  <!-- Activity Edit Modal -->
                  <div class="modal fade" id="activityEditModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form id="editForm" method="post"> 
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Activity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="editRowModal">
                            <div class="row mb-3">
                              <label for="inputProjectName" class="col-sm-3 col-form-label">Activity Name</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="editActivityName" name="activityName" value="" required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="InputDueDate" class="col-sm-3 col-form-label">Activity Weight</label>
                              <div class="col-sm-9">
                                <input type="number" class="form-control" id="editActivityWeight" name="activityWeight" value="" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteActivity()">Delete Activity</button>
                            <button type="button" id="editAddButton" class="btn btn-secondary">Add Row</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End Activity Edit Modal-->

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
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

<script type="text/javascript">
  var idActivity;

  $(document).ready(function(){
    getActivities();

    $('#activityAddForm').submit(function(event){
      event.preventDefault();
      addActivity();
    });
  });

  function getActivities(){
    $('#activityTable').empty();
    $.ajax({
      url: "<?= base_url('project/getDetailActivity/'.$idProject); ?>",
      success: function(result){
        var numbering = 0;
        var resultObj = JSON.parse(result);
        resultObj.forEach(function(items){
          numbering++;
          var rowField = '<tr class="table-warning" style="vertical-align: middle;">'+
              '<th scope="row">'+numbering+'</th>'+
              '<td>'+
              items.activity_name+
              '<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#activityEditModal" onclick="editActivity('+items.id_activity+')">'+
                '<i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit Activity"></i>'+
              '</button>'+
              '</td>'+
              '<td>'+items.activity_weight+'%</td>'+
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
            '</tr>';
            $('#activityTable').append(rowField);
        });
      }
    });
  }

  function isset(item){
    return (item!=null)?
      item+'%':
      ''
  }

  function addActivity() {
    $.ajax({
      type: "POST",
      url: "<?= base_url('project/addActivities/'.$idProject); ?>",
      cache:false,
      data: $('#activityAddForm').serialize(),
      success: function(response){
        getActivities();
        $('#activityAddName').val("");
        $('#activityAddWeight').val("");
        $('#activityAddDate').val("");
        $('#activityAddWeight').val("");
      },
      error: function(){
          alert("Error");
      }
    });
  }

  function editActivity(id){
    this.idActivity = id;
    var rows = document.querySelectorAll('#rowEdit');
    rows.forEach(function(item){
      item.remove();
    });

    $.ajax({
      url: "<?= base_url('project/getActivityMonthly'); ?>/"+id, 
      success: function(result){
        $('#editForm').attr('action', '<?= base_url('project/editActivities'); ?>/'+id);
        var resultObj = JSON.parse(result);
        document.getElementById('editActivityName').value   = resultObj[0].activity_name;
        document.getElementById('editActivityWeight').value = resultObj[0].activity_weight;
        resultObj.forEach(function(items){
          var field = '<div class="row mb-3" id="rowEdit"><label for="InputDueDate" class="col-sm-3 col-form-label">Activity</label><div class="col-sm-4"><input type="date" class="form-control" id="inputText" name="activitiesDate[]" value="'+items.date_monthly_activity+'" required></div><div class="col-sm-4"><input type="number" class="form-control" id="inputText" name="activitiesWeight[]" value="'+items.plan_monthly_activity+'" placeholder="%" required></div><div class="col-sm-1"><button id="delete" type="button" class="btn btn-danger">x</button></div></div>';
          $('#editRowModal').append(field);
        });
    }});
  }

  function deleteActivity(){
    $.ajax({
      url: "<?= base_url('project/deleteActivity'); ?>/"+this.idActivity,
      success: function(response){
        getActivities();
      }
    });
  }

  // Field Row Activity
  var field = '<div class="row mb-3" id="rowEdit"><label for="InputDueDate" class="col-sm-3 col-form-label">Activity</label><div class="col-sm-4"><input type="date" class="form-control" id="inputText" name="activitiesDate[]" value="" required></div><div class="col-sm-4"><input type="number" class="form-control" id="inputText" name="activitiesWeight[]" value="" placeholder="%" required></div><div class="col-sm-1"><button id="delete" type="button" class="btn btn-danger">x</button></div></div>';
  
  // Edit Modal
  $('#editAddButton').click(function(){
    $('#editRowModal').append(field);
  });

  $('#editRowModal').on('click', '#delete', function(e){
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
  });
  
  // Add Modal
  $('#addAddButton').click(function(){
    $('#addRowModal').append(field);
  });

  $('#addRowModal').on('click', '#delete', function(e){
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
  });
</script>