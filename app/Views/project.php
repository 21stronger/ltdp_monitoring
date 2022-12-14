  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Projects
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                  <i class="bi bi-plus-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Add New Project"></i>
                </button>
              </h5>

              <div class="modal fade" id="addProjectModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <!-- Horizontal Form -->
                  <form action="<?= base_url('project/addProject'); ?>" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Project Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row mb-3">
                          <label for="inputProjectName" class="col-sm-2 col-form-label">Project Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputText" name="projectName" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="InputDueDate" class="col-sm-2 col-form-label">Due Date</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputText" name="projectDueDate" value="<?= date('Y-m-d'); ?>" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                          <div class="col-sm-10">
                            <select class="form-select" name="projectCategory" id="Category" aria-label="Default select example">
                              <?php foreach ($dataCategories as $key => $value) {
                                echo "<option value=".$value['id_category'].">".$value['category_name']."</option>";
                              }?>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                          <div class="col-sm-10">
                            <select class="form-select" name="projectDepartment" id="department" aria-label="Default select example">
                            <?php 
                              foreach ($dateDepartment as $key => $value) {
                                echo "<option value=".$value['id_department'].">".$value['department_name']."</option>";
                              }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputPIC" class="col-sm-2 col-form-label">PIC</label>
                          <div class="col-sm-10">
                            <select class="form-select" name="projectPic" id="pic" aria-label="Default select example">
                              <?php foreach ($dataPics as $key => $value) {
                                echo "<option value=".$value['id_pic'].">".$value['name_pic']."</option>";
                              }?>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputAchievement" class="col-sm-2 col-form-label">Achievement</label>
                          <div class="col-sm-10">
                            <select class="form-select" name="projectAchievement" id="achievement" aria-label="Default select example">
                              <option value="Open">Open</option>
                              <option value="Close">Close</option>
                              <option value="Cancel">Cancel</option>
                              <option value="Postpone">Postpone</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </form><!-- End Horizontal Form -->
                </div>
              </div><!-- End Large Modal-->

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
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <label class="col-sm-2 col-form-label">PIC</label>
                            <div class="col-md-2">
                              <select class="form-select" name="PicSel" id="PicSel" aria-label="Default select example">
                                <option value=''>All</option>
                                <?php foreach ($dataPics as $key => $value) {
                                  echo "<option value=".$value['name_pic'].">".$value['name_pic']."</option>";
                                }?>
                              </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Department</label>
                            <div class="col-md-2">
                              <select class="form-select" name="DeptSel" id="DeptSel" aria-label="Default select example">
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
                            <label class="col-sm-2 col-form-label">Achievement</label>
                            <div class="col-md-2">
                              <select class="form-select" name="AchSel" id="AchSel" aria-label="Default select example">
                                <option value="">All</option>
                                <option value="Open">Open</option>
                                <option value="Close">Close</option>
                                <option value="Cancel">Cancel</option>
                                <option value="Postpone">Postpone</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-check" style="margin-top: 10px; margin-bottom: 10px;">
                                <input class="form-check-input" type="checkbox" id="selectZeroActivity">
                                <label class="form-check-label" for="selectZeroActivity">
                                  Show Zero Activity Project Only
                                </label>
                              </div>
                            </div>
                            <div class="col-md-4">&nbsp;</div>
                            <div class="col-md-4">&nbsp;</div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" id="reset" class="btn btn-primary">Reset</button>
                            </div>
                            <div class="col-md-6"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->

              <!-- Table with stripped rows -->
              <table class="table table-stripped" id="dataProject">
                <thead>
                  <tr>
                    <th scope="col" style="width: 1%;">#</th>
                    <th scope="col" style="width: 16%;">Category</th>
                    <th scope="col">Project Name</th>
                    <th scope="col" style="width: 12%;">Due Date</th>
                    <th scope="col" style="width: 9%;">Dept</th>
                    <th scope="col" style="width: 5%;">PIC</th>
                    <th scope="col" style="width: 5%;">Ach</th>
                    <th scope="col">-</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach ($dataProjects as $key => $value) {
                ?>
                  <tr <?= ($value['ytd']==null)? "class='table-warning'": ""; ?> onclick="window.location='<?= base_url('project/detail/'.$value['id_project']); ?>';" style="border-color: unset;">
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $value['category_name']; ?></td>
                    <td><?= $value['project_name']; ?></td>
                    <td><?= datetostr($value['project_due_date']); ?></td>
                    <td><?= $value['department_name']; ?></td>
                    <th><?= $value['name_pic']; ?></th>
                    <td><?= $value['ach']; ?></td>
                    <td><?= ($value['ytd']==null)? "0": "1"; ?></td>
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
    var pic, department, achievement;
    var table = $('#dataProject').DataTable({
      autoWidth: false
    });
     
    table.column(7).visible(false);

    $('#selectZeroActivity').change( function(){
      if($(this).is(':checked')){
        table
          .columns(7)
          .search('0')
          .draw();
      } else {
        zeroAct = 0;
        table
          .columns(7)
          .search('')
          .draw();
      }
    });

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
      document.getElementById("selectZeroActivity").checked = false;
      department='';
      pic='';
      table
        .columns()
        .search('')
        .draw();
    })
  });
</script>