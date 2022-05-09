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
              <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

              <!-- Table with stripped rows -->
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
                  <tr class="table-warning" style="vertical-align: middle;">
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
                    <td><?= (!is_null($value['JanAct']))? $value['JanAct']."%":""; ?></td>
                    <td><?= (!is_null($value['FebAct']))? $value['FebAct']."%":""; ?></td>
                    <td><?= (!is_null($value['MarAct']))? $value['MarAct']."%":""; ?></td>
                    <td><?= (!is_null($value['AprAct']))? $value['AprAct']."%":""; ?></td>
                    <td><?= (!is_null($value['MayAct']))? $value['MayAct']."%":""; ?></td>
                    <td><?= (!is_null($value['JunAct']))? $value['JunAct']."%":""; ?></td>
                    <td><?= (!is_null($value['JulAct']))? $value['JulAct']."%":""; ?></td>
                    <td><?= (!is_null($value['AugAct']))? $value['AugAct']."%":""; ?></td>
                    <td><?= (!is_null($value['SepAct']))? $value['SepAct']."%":""; ?></td>
                    <td><?= (!is_null($value['OctAct']))? $value['OctAct']."%":""; ?></td>
                    <td><?= (!is_null($value['NovAct']))? $value['NovAct']."%":""; ?></td>
                    <td><?= (!is_null($value['DesAct']))? $value['DesAct']."%":""; ?></td>
                  </tr>
                  <?php
                    $numbering++;
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

      </div>
    </section>

  </main><!-- End #main -->
