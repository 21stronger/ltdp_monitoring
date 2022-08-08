  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= (isset($headerTitle))? $headerTitle: "Testing"; ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="filter" style="right: 20px;">
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
            </div>
            <div class="card-body">
              <h5 class="card-title">Achievement</h5>
              
              <!-- Tab Achievement and Status -->
              <div class="col-lg-12">
                <!-- Nav Tab Achievement and Status -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="achievement-tab" data-bs-toggle="tab" data-bs-target="#achievement" type="button" role="tab" aria-controls="achievement" aria-selected="true">Achievement</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="false">Status</button>
                  </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                  <div class="tab-pane fade show active" id="achievement" role="tabpanel" aria-labelledby="achievement-tab">
                    <div class="col-lg-12">
                      <!-- Row Achievement Faster Ontime Overdue Open Close Cancel -->
                      <div class="row">
                        <!-- Faster Card -->
                        <div class="col-lg-4">
                          <div class="card text-center info-card sales-card">

                            <div class="card-body">
                              <h5 class="card-title">Faster</h5>

                              <h6 id="achFaster">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Faster Card -->

                        <!-- Ontime Card -->
                        <div class="col-lg-4">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Ontime</h5>

                              <h6 id="achOntime">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Ontime Card -->

                        <!-- Overdue Card -->
                        <div class="col-lg-4">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Overdue</h5>

                              <h6 id="achOverdue">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Overdue Card -->
                      </div>
                      <!-- End Row Achievement -->
                    </div>
                  </div>
                  <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                    <div class="col-lg-12">
                      <!-- Row Achievement Open Close Cancel -->
                      <div class="row">
                        <!-- Close Card -->
                        <div class="col-lg-3">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Close</h5>

                              <h6 id="proClose">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Close Card -->

                        <!-- Open Card -->
                        <div class="col-lg-3">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Open</h5>

                              <h6 id="proOpen">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Open Card -->

                        <!-- Cancel Card -->
                        <div class="col-lg-3">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Cancel</h5>

                              <h6 id="proCancel">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Cancel Card -->

                        <!-- Postpone Card -->
                        <div class="col-lg-3">
                          <div class="card text-center info-card revenue-card">

                            <div class="card-body">
                              <h5 class="card-title">Postpone</h5>

                              <h6 id="proPostpone">-</h6>
                              <span class="text-muted small pt-2 ps-1">projects</span>
                            </div>

                          </div>
                        </div><!-- End Postpone Card -->
                      </div>
                      <!-- End Row Achievement -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Tab Achievement and Status -->

              <!-- Tab YTD and Department -->
              <div class="col-lg-12">
                <!-- Nav Tab YTD and Department -->
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
                            <div class="col-md-12">
                              <div class="card recent-sales">
                                <div class="card-body">
                                  <h5 class="card-title">Category</h5>

                                  <div class="table-responsive-sm">
                                    <table class="table table-borderless" id="dataCategories">
                                      <thead>
                                        <tr>
                                          <th scope="col" class="col-sm-1">#</th>
                                          <th scope="col" class="col-sm-8">Category</th>
                                          <th scope="col" class="col-sm-1">Faster</th>
                                          <th scope="col" class="col-sm-1">Ontime</th>
                                          <th scope="col" class="col-sm-1">Overdue</th>
                                        </tr>
                                      </thead>
                                    </table>
                                  </div>

                                </div>
                              </div>
                            </div>
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
                                  <h5 class="card-title">YTD Percentage Status</h5>

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

                                  <div class="table-responsive-sm">
                                    <table class="table table-borderless" id="dataDepartment">
                                      <thead>
                                        <tr>
                                          <th scope="col" class="col-sm-1">#</th>
                                          <th scope="col" class="col-sm-8">Department</th>
                                          <th scope="col" class="col-sm-1">Faster</th>
                                          <th scope="col" class="col-sm-1">Ontime</th>
                                          <th scope="col" class="col-sm-1">Overdue</th>
                                        </tr>
                                      </thead>
                                    </table>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="row">
                            <!-- YTD Percentage per PIC -->
                            <div class="card">

                              <div class="filter" style="right: 20px;">
                                <select class="form-select" name="YtdPicPerDept" id="YtdPicPerDept">
                                  <?php 
                                    foreach ($dataDepartments as $key => $value) {
                                      echo "<option value=\"{$value['department_name']}\">{$value['department_name']}</option>";
                                    }
                                  ?>
                                </select>
                              </div>

                              <div class="card-body pb-0">
                                <h5 class="card-title">YTD Percentage per PIC</h5>

                                <div id="ytdDepartmentPIC" style="min-height: 250px;" class="echart"></div>

                              </div>
                            </div><!-- End YTD Percentage per PIC -->

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Tab YTD and Department -->

              <!-- Yearly Report Chart -->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Yearly Report</h5>

                    <div id="reportsChart" style="min-height: 450px;" class="echart"></div>
                  </div>
                </div>
              </div>
              <!-- End Yearly Report Chart -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<script type="text/javascript">
  // Color Pallete for Faster, Ontime and Overdue
  var colorPaletteAch = ['#2958BE', '#FFCC66', '#FF0000'];

  // Color Pallete for Open, Close, Cancel and Postpone
  var colorPaletteSta = ['#00B050', '#FFFF00', '#BFBFBF', '#2596BE'];

  // Table
  var tableCategories, tableDepartment;
  
  // EChart initfor Graph Data
  var ytdStatus1, ytdAch1, ytdDeptPIC, yearlyReportChart;
  document.addEventListener("DOMContentLoaded", () => {
    tableCategories = $('#dataCategories').DataTable({
      autoWidth: false,
      columns: [
        {data: "id_category"},
        {data: "category_name"},
        {data: "faster"},
        {data: "ontime"},
        {data: "overdue"},
      ]
    });

    tableDepartment = $('#dataDepartment').DataTable({
      autoWidth: false,
      columns: [
        {data: "id_department"},
        {data: "department_name"},
        {data: "faster"},
        {data: "ontime"},
        {data: "overdue"},
      ]
    });

    ytdAch1 = echarts.init(document.querySelector("#ytdAchievement"));
    ytdStatus1 = echarts.init(document.querySelector("#ytdStatus"));
    ytdDeptPIC = echarts.init(document.querySelector("#ytdDepartmentPIC"));
    yearlyReportChart = echarts.init(document.querySelector('#reportsChart'));
  });
  
  $(document).ready(function() {
    const d = new Date();
    const month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    getAchievement(month[d.getMonth()]);
    document.getElementById('month').value = month[d.getMonth()];

    getYtdPerPic($('#YtdPicPerDept').val());

    //choosed month
    $("#month").change(function(){
      getAchievement(this.value);
      getYtdPerPic($('#YtdPicPerDept').val());
    });

    $("#YtdPicPerDept").change(function(){
      getYtdPerPic(this.value);
    });

    var yearlySource = [
      ['ach', 'month'],
      [0, 'Dec'],
      [0, 'Nov'],
      [0, 'Oct'],
      [0, 'Sep'],
      [0, 'Aug'],
      [0, 'Jul'],
      [0, 'Jun'],
      [0, 'May'],
      [0, 'Apr'],
      [0, 'Mar'],
      [0, 'Feb'],
      [0, 'Jan'],
      [0, 'YTD']
    ];

    $.ajax({
      url: "<?= base_url('home/getYearlyChartData'); ?>",
      success: function(response){
        var index = 1;
        var result = JSON.parse(response);

        yearlySource = result;
        yearlyReportChart.setOption({
          dataset: {
            source: yearlySource
          }
        });
      }
    });

    yearlyReportChart.setOption({
      dataset: {
        source: yearlySource
      },
      grid: { containLabel: true },
      xAxis: { name: 'ach' },
      yAxis: { type: 'category' },
      visualMap: {
        show: false,
        orient: 'horizontal',
        left: 'center',
        min: 0,
        max: 120,
        text: ['High Score', 'Low Score'],
        // Map the score column to color
        dimension: 0,
        inRange: {
          color: [
            '#ff0000', //0
            '#ff0000', //10
            '#ff0000', //20
            '#ff0000', //30
            '#ff0000', //40
            '#ff0000', //50
            '#ff0000', //60
            '#ff0000', //70
            '#ff0000', //80
            '#bb0000', //90
            '#00bb00', //100
            '#0044ff', //110
            '#0000ff'  //120
          ] 
        }
      },
      series: [
        {
          type: 'bar',
          label: {
            show: true,
            position: 'right',
            formatter: '{@ach}%'
          },
          encode: {
            // Map the "amount" column to X axis.
            x: 'ach',
            // Map the "product" column to Y axis
            y: 'month'
          }
        }
      ]
    });
  });

  function getAchievement(month){
    $.ajax({url: "<?= base_url('home/ytd'); ?>/"+month, success: function(response){
      var result = JSON.parse(response);

      tableCategories.clear();
      result.dataCategories.forEach(addCategoriesRow);
      tableCategories.draw();

      tableDepartment.clear();
      result.dataDepartments.forEach(addDepartmentRow);
      tableDepartment.draw();

      document.getElementById('achFaster').innerHTML = result.faster;
      document.getElementById('achOntime').innerHTML = result.ontime;
      document.getElementById('achOverdue').innerHTML = result.overdue;
      document.getElementById('proClose').innerHTML = result.close;
      document.getElementById('proOpen').innerHTML = result.open;
      document.getElementById('proCancel').innerHTML = result.cancel;
      document.getElementById('proPostpone').innerHTML = result.postpone;

      ytdStatus1.setOption({
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b}: {c} ({d}%)'
        },
        legend: {
          top: '0%',
          left: 'center'
        },
        series: [{
          name: 'Project',
          type: 'pie',
          radius: ['40%', '70%'],
          avoidLabelOverlap: false,
          label: {
            show: false,
            position: 'center',
            rich: {
              a: {
                color: '#6E7079',
                lineHeight: 22,
                align: 'center'
              },
              b: {
                color: '#4C5058',
                fontSize: 14,
                fontWeight: 'bold',
                lineHeight: 33
              }
            }
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
              value: result.close,
              name: 'Close'
            },
            {
              value: result.open,
              name: 'Open'
            },
            {
              value: result.cancel,
              name: 'Cancel'
            },
            {
              value: result.postpone,
              name: 'Postpone'
            }
          ],
          color: colorPaletteSta
        }],
        graph: {
          color: colorPaletteSta
        }
      });

      ytdAch1.setOption({
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b}: {c} ({d}%)'
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
            position: 'center',
            rich: {
              a: {
                color: '#6E7079',
                lineHeight: 22,
                align: 'center'
              },
              b: {
                color: '#4C5058',
                fontSize: 14,
                fontWeight: 'bold',
                lineHeight: 33
              }
            }
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
              value: result.faster,
              name: 'Faster'
            },
            {
              value: result.ontime,
              name: 'Ontime'
            },
            {
              value: result.overdue,
              name: 'Overdue'
            }
          ],
          color: colorPaletteAch
        }],
        graph: {
          color: colorPaletteAch
        }
      });

    }});
  };

  function getYtdPerPic(dept){
    var month = $("#month").val();

    $.ajax({url: "<?= base_url('home/achPicPerDept'); ?>/"+month+"/"+dept, success: function(response){
      var result = JSON.parse(response);
      const arrPic = [];
      const arrVal = [];

      result.forEach(function(item){
        arrPic[arrPic.length] = item.name_pic;
        arrVal[arrVal.length] = Number(item.percentage).toFixed(2);
      });

      ytdDeptPIC.setOption({
        xAxis: {
          type: 'category',
          data: arrPic
        },
        yAxis: {
          type: 'value'
        },
        series: [
          {
            data: arrVal,
            type: 'bar',
            label: {
              show: true,
              position: 'top',
              formatter: '{@ach}%'
            },
            barWidth: '30%'
          }
        ]
      });
    }});
  }

  function addCategoriesRow(item){
    tableCategories.row.add({
      'id_category'   : item.idCategory,
      'category_name' : item.nameCategory,
      'faster'        : item.fasterCategory,
      'ontime'        : item.ontimeCategory,
      'overdue'       : item.overdueCategory
    });
  }

  function addDepartmentRow(item){
    tableDepartment.row.add({
      'id_department'  : item.id_department,
      'department_name': item.department_name,
      'faster'         : item.fasterDepartment,
      'ontime'         : item.ontimeDepartment,
      'overdue'        : item.overdueDepartment
    });
  }
</script>