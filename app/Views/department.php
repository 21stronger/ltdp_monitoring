  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">
          <div class="row">

            <!-- Faster Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Faster</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countFaster ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Faster Card -->

            <!-- Ontime Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Ontime</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countOntime ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Ontime Card -->

            <!-- Overdue Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Overdue</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countOverdue ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Overdue Card -->

            <!-- Close Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Close</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countProjectClose ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Close Card -->

            <!-- Open Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Open</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countProjectOpen ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Open Card -->

            <!-- Cancel Card -->
            <div class="col-xxl-2 col-md-2">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Cancel</h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?= $countProjectCancel ?></h6>
                      <span class="text-muted small pt-2 ps-1">projects</span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Cancel Card -->
          </div>
        </div>

        <div class="col-lg-8">
          
          <div class="row">
            <!-- Category Sales -->
            <div class="col-12">
              <div class="card recent-sales">

                <div class="card-body">
                  <h5 class="card-title">Category</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Faster</th>
                        <th scope="col">Ontime</th>
                        <th scope="col">Overdue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($dataDepartments as $value) {
                      ?>
                      <tr>
                        <th scope="row"><?= $value['id_department']; ?></th>
                        <td><?= $value['department_name']; ?></td>
                        <td><?= $value['faster']; ?></td>
                        <td><?= $value['ontime']; ?></td>
                        <td><?= $value['overdue']; ?></td>
                      </tr>
                      <?php 
                        }
                      ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Category Sales -->
          </div>
        </div>

        <div class="col-lg-4">
          <div class="row">
            
            <!-- YTD Percent Traffic -->
            <div class="card">

              <div class="card-body pb-0">
                <h5 class="card-title">YTD Percentage Achievement</h5>

                <div id="ytdAchievement" style="min-height: 250px;" class="echart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#ytdAchievement")).setOption({
                      tooltip: {
                        trigger: 'item'
                      },
                      legend: {
                        top: '5%',
                        left: 'center'
                      },
                      series: [{
                        name: 'Project',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                          show: false,
                          position: 'center'
                        },
                        emphasis: {
                          label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                          }
                        },
                        labelLine: {
                          show: false
                        },
                        data: [{
                            value: <?= $countFaster ?>,
                            name: 'Faster'
                          },
                          {
                            value: <?= $countOntime ?>,
                            name: 'Ontime'
                          },
                          {
                            value: <?= $countOverdue ?>,
                            name: 'Overdue'
                          }
                        ]
                      }]
                    });
                  });
                </script>

              </div>
            </div><!-- End YTD Percent Traffic -->

            <!-- YTD Percent Traffic -->
            <div class="card">

              <div class="card-body pb-0">
                <h5 class="card-title">YTD Percentage Achievement</h5>

                <div id="ytdStatus" style="min-height: 250px;" class="echart"></div>

                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#ytdStatus")).setOption({
                      tooltip: {
                        trigger: 'item'
                      },
                      legend: {
                        top: '5%',
                        left: 'center'
                      },
                      series: [{
                        name: 'Project',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                          show: false,
                          position: 'center'
                        },
                        emphasis: {
                          label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                          }
                        },
                        labelLine: {
                          show: false
                        },
                        data: [{
                            value: <?= $countProjectClose ?>,
                            name: 'Close'
                          },
                          {
                            value: <?= $countProjectOpen ?>,
                            name: 'Open'
                          },
                          {
                            value: <?= $countProjectCancel ?>,
                            name: 'Cancel'
                          }
                        ]
                      }]
                    });
                  });
                </script>

              </div>
            </div><!-- End YTD Percent Traffic -->
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

