  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li>
                  <select class="form-select" name="month" id="month">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Achievement</h5>
              
              <div class="col-lg-12">
                <!-- Row Achievement Faster Ontime Overdue Open Close Cancel -->
                <div class="row">
                  <!-- Faster Card -->
                  <div class="col-lg-2">
                    <div class="card info-card sales-card">

                      <div class="card-body">
                        <h5 class="card-title">Faster</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="achFaster">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Faster Card -->

                  <!-- Ontime Card -->
                  <div class="col-lg-2">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title">Ontime</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="achOntime">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Ontime Card -->

                  <!-- Overdue Card -->
                  <div class="col-lg-2">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title">Overdue</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="achOverdue">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Overdue Card -->

                  <!-- Close Card -->
                  <div class="col-lg-2">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title">Close</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="proClose">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Close Card -->

                  <!-- Open Card -->
                  <div class="col-lg-2">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title">Open</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="proOpen">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Open Card -->

                  <!-- Cancel Card -->
                  <div class="col-lg-2">
                    <div class="card info-card revenue-card">

                      <div class="card-body">
                        <h5 class="card-title">Cancel</h5>

                        <div class="d-flex align-items-center">
                          <div class="ps-3">
                            <h6 id="proCancel">-</h6>
                            <span class="text-muted small pt-2 ps-1">projects</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- End Cancel Card -->
                </div>
                <!-- End Row Achievement -->
              </div>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="ytd-tab" data-bs-toggle="tab" data-bs-target="#ytd" type="button" role="tab" aria-controls="ytd" aria-selected="true">YTD</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="department-tab" data-bs-toggle="tab" data-bs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="false">Department</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="ytd" role="tabpanel" aria-labelledby="ytd-tab">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-8"> 
                        <div class="row">
                          <!-- Category Sales -->
                          <div class="col-md-12">
                            <div class="card recent-sales">

                              <div class="card-body">
                                <h5 class="card-title">Category</span></h5>

                                <table class="table table-borderless" id="dataCategories">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Kategori</th>
                                      <th scope="col">Faster</th>
                                      <th scope="col">Ontime</th>
                                      <th scope="col">Overdue</th>
                                    </tr>
                                  </thead>
                                  <tbody id="categoriesDataTable">
                                  </tbody>
                                </table>

                              </div>
                            </div>
                          </div><!-- End Category Sales -->
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="row">
                          <div class="col-md-12">
                            <!-- YTD Percent Traffic -->
                            <div class="card">

                              <div class="card-body pb-0">
                                <h5 class="card-title">YTD Percentage Achievement</h5>

                                <div id="ytdAchievement" style="min-height: 250px;" class="echart"></div>

                              </div>
                            </div><!-- End YTD Percent Traffic -->
                          </div>
                          <div class="col-md-12"><!-- YTD Percent Traffic -->
                            <div class="card">

                              <div class="card-body pb-0">
                                <h5 class="card-title">YTD Percentage Achievement</h5>

                                <div id="ytdStatus" style="min-height: 250px;" class="echart"></div>
                              </div>
                            </div><!-- End YTD Percent Traffic -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="department" role="tabpanel" aria-labelledby="department-tab">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-12">
                            <div class="card recent-sales">
                              <div class="card-body">
                                <h5 class="card-title">Department</h5>

                                <table class="table table-borderless" id="dataDepartment">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Department</th>
                                      <th scope="col">Faster</th>
                                      <th scope="col">Ontime</th>
                                      <th scope="col">Overdue</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="row">
                          
                          <!-- YTD Percent Traffic -->
                          <div class="card">

                            <div class="card-body pb-0">
                              <h5 class="card-title">YTD Percentage Achievement</h5>

                              <div id="ytdAchievement1" style="min-height: 250px;" class="echart"></div>

                            </div>
                          </div><!-- End YTD Percent Traffic -->

                          <!-- YTD Percent Traffic -->
                          <div class="card">

                            <div class="card-body pb-0">
                              <h5 class="card-title">YTD Percentage Achievement</h5>

                              <div id="ytdStatus1" style="min-height: 250px;" class="echart"></div>

                            </div>
                          </div><!-- End YTD Percent Traffic -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<script type="text/javascript">
  var tableCategories = $('#dataCategories').DataTable({
    columns: [
      {data: "id_category"},
      {data: "category_name"},
      {data: "faster"},
      {data: "ontime"},
      {data: "overdue"},
    ]
  });

  var tableDepartment = $('#dataDepartment').DataTable({
    columns: [
      {data: "id_department"},
      {data: "department_name"},
      {data: "faster"},
      {data: "ontime"},
      {data: "overdue"},
    ]
  });
  
  document.addEventListener("DOMContentLoaded", () => {
    var ytdStatus1 = echarts.init(document.querySelector("#ytdStatus")).setOption({
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

    var ytdAch1 = echarts.init(document.querySelector("#ytdAchievement")).setOption({
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
    
    var ytdAch2 = echarts.init(document.querySelector("#ytdAchievement1")).setOption({
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
      
    var ytdStatus2 = echarts.init(document.querySelector("#ytdStatus1")).setOption({
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
  
  $(document).ready(function() {
    //this month
    const d = new Date();
    const month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    getAchievement(month[d.getMonth()]);
    document.getElementById('month').value = month[d.getMonth()];

    //choosed month
    $("#month").change(function(){
      getAchievement(this.value);
    });
  });

  function getAchievement(month){
    $.ajax({url: "<?= base_url('home/'); ?>/getAchievement/"+month, success: function(resultJson){
      var result = JSON.parse(resultJson);
      document.getElementById('achFaster').innerHTML = result.countFaster;
      document.getElementById('achOntime').innerHTML = result.countOntime;
      document.getElementById('achOverdue').innerHTML = result.countOverdue;
      document.getElementById('proClose').innerHTML = result.countClose;
      document.getElementById('proOpen').innerHTML = result.countOpen;
      document.getElementById('proCancel').innerHTML = result.countCancel;

      tableCategories.clear();
      tableDepartment.clear();
      result.dataCategories.forEach(addCategoriesRow);
      result.dataDepartments.forEach(addDepartmentRow);
      tableCategories.draw();
      tableDepartment.draw();
    }});
  };

  function addCategoriesRow(item){
    tableCategories.row.add({
      'id_category'   : item.id_category,
      'category_name' : item.category_name,
      'faster'        : item.faster,
      'ontime'        : item.ontime,
      'overdue'       : item.overdue
    });
  }

  function addDepartmentRow(item){
    tableDepartment.row.add({
      'id_department'  : item.id_department,
      'department_name': item.department_name,
      'faster'         : item.faster,
      'ontime'         : item.ontime,
      'overdue'        : item.overdue
    });
  }
</script>