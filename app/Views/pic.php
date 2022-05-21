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
                          <label for="inputProjectName" class="col-sm-3 col-form-label">Surename</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="surename" name="surename" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="InputDueDate" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputCategory" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputDepartment" class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
                            <select class="form-select" name="role" id="role" aria-label="Role">
                              <option value="User">User</option>
                              <option value="Admin">Admin</option>
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
                          <label for="edtUsername" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edtUsername" disabled>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="edtSurename" class="col-sm-3 col-form-label">Surename</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="edtSurename" name="edtSurename" required>
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
                              <option value="Admin">Admin</option>
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
                    <th scope="col">Surename</th>
                    <th scope="col">Role</th>
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
    document.getElementById("edtSurename").value = sure;
    document.getElementById("edtUsername").value = user;
    document.getElementById("edtRole").value = role;
  }
</script>

</main><!-- End #main -->

