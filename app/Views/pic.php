<main id="main" class="main">

<div class="pagetitle">
  <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <!-- PICs -->
        <div class="col-12">
          <div class="card recent-sales">
            <div class="card-body">
              <h5 class="card-title">PICs
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addPIC">
                  <i class="bi bi-plus-square" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="Add PIC"></i>
                </button>
              </h5>

              <div class="modal fade" id="addPIC" tabindex="-1">
                <div class="modal-dialog">
                  <form action="<?= base_url('pic/addpic'); ?>" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add PIC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row mb-3">
                          <label for="InputInitial" class="col-sm-3 col-form-label">Initial</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="initial" name="initial" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="InputEmail" class="col-sm-3 col-form-label">E-Mail</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="InputPassword" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="InputRole" class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
                            <select class="form-select" name="role" id="role" aria-label="Role">
                              <option value="User">User</option>
                              <option value="Supervisor">Supervisor</option>
                              <option value="Admin">Admin</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3" id="inputAddDepartment">
                          <label for="InputDept" class="col-sm-3 col-form-label">Department</label>
                          <div class="col-sm-9">
                            <select class="form-select" name="dept" id="dept" aria-label="Role">
                              <?php foreach ($dataDepartments as $key => $value) {
                                echo 
                                '<option value="'.$value['id_department'].'">'.$value['department_name'].'</option>';
                              }?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="modal fade" id="editPIC" tabindex="-1">
                <div class="modal-dialog">
                  <form action="<?= base_url('pic/editpic'); ?>" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit PIC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" class="form-control" id="idPic" name="idPic">
                      </div>
                      <div class="modal-body">
                        <div class="row mb-3">
                          <label for="edtEmail" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edtEmail" disabled>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="edtInitial" class="col-sm-3 col-form-label">Initial</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edtInitial" name="edtInitial" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="edtPassword" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edtPassword" name="edtPassword" placeholder="Leave blank if doesn't change password">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputDepartment" class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
                            <select class="form-select" name="edtRole" id="edtRole" aria-label="Role">
                              <option value="User">User</option>
                              <option value="Supervisor">Supervisor</option>
                              <option value="Admin">Admin</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3" id="inputEdtDepartment">
                          <label for="InputDept" class="col-sm-3 col-form-label">Department</label>
                          <div class="col-sm-9">
                            <select class="form-select" name="edtDept" id="edtDept" aria-label="Role">
                              <?php foreach ($dataDepartments as $key => $value) {
                                echo 
                                '<option value="'.$value['id_department'].'">'.$value['department_name'].'</option>';
                              }?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Initial</th>
                    <th scope="col">Role</th>
                    <th scope="col">Dept</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($dataPICs as $value) {
                  ?>
                  <tr>
                    <th scope="row"><?= $value['id_pic']; ?></th>
                    <td><?= $value['user_pic']; ?></td>
                    <td><?= $value['name_pic']; ?></td>
                    <td><?= $value['role_pic']; ?></td>
                    <td><?= $value['department_name']; ?></td>
                    <td>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPIC" onclick="editModal('<?= $value['id_pic']; ?>', '<?= $value['name_pic']; ?>', '<?= $value['user_pic']; ?>', '<?= $value['role_pic']; ?>')"><i class="bi bi-pencil-square"></i> Edit</button>
                    </td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- End PICs -->
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  function editModal(id, sure, user, role){
    document.getElementById("idPic").value = id;
    document.getElementById("edtInitial").value = sure;
    document.getElementById("edtEmail").value = user;
    document.getElementById("edtRole").value = role;

    if(role == 'User' || role == 'Supervisor'){
      $('#inputEdtDepartment').show();
    } else {
      $('#inputEdtDepartment').hide();
    }
  }

  $(document).ready(function(){
    $('#role').change(function(){
      if($(this).val()=="Supervisor" || $(this).val()=="User"){
        $('#inputAddDepartment').show();
      } else {
        $('#inputAddDepartment').hide();
      }
    });

    $('#edtRole').change(function(){
      if($(this).val()=="Supervisor" || $(this).val()=="User"){
        $('#inputEdtDepartment').show();
      } else {
        $('#inputEdtDepartment').hide();
      }
    });
  });
</script>

</main><!-- End #main -->

