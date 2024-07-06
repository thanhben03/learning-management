<?php
$body = [
  'title' => 'Trang chủ'
];
$today = date("Y-m-d");
$sql = "SELECT *
        FROM nhacnho nn JOIN ghichu gc ON nn.ghichu_id = gc.id WHERE '$today' <= nn.end ORDER BY id_nn DESC";
$getnn = $BB->getList($sql);

$date_time_current = new DateTime();
$w = (int)$date_time_current->format('w');
// $user_id = 1;
$sql = "SELECT *
        FROM lichhoc WHERE user_id = $user_id";
$lichhoc = $BB->getList($sql);

$sql = "SELECT count(*) as total FROM nhacnho";
$soluong_nn = $BB->getCountRow($sql);
$sql = "SELECT count(*) as total FROM lichhoc";
$soluong_lh = $BB->getCountRow($sql);
$sql = "SELECT count(*) as total FROM account";
$soluong_user = $BB->getCountRow($sql);
$sql = "SELECT count(*) as total FROM monhoc";
$soluong_mh = $BB->getCountRow($sql);

require_once(__DIR__ . '/header.php');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $soluong_lh ?></h3>

              <p>Lịch học</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $soluong_mh ?></h3>

              <p>Môn học</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $soluong_user ?></h3>

              <p>Thành viên</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $soluong_nn ?></h3>

              <p>Nhắc nhở</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Deadline Tớiiiiiii
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my
                  entire
                  soul, like these sweet mornings of spring which I enjoy with my whole heart.
                </div> -->
              <?php
              foreach ($getnn as $nn) {
                echo '
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h5><i class="icon fas fa-info"></i> Thông báo mới</h5>
                      <p>' . $nn['noidung'] . '</p>
                      <div class="row" style="justify-content: space-between;align-items: baseline;">
                        <p style="color: red;">Đến hạn: <span id="denhan" style="color: blue;">' . $nn['end'] . '</span></p>
                        <button style="height: 30px;" onclick="deleteNN(' . $nn['id_nn'] . ')" type="button" class="btn btn-danger btn-sm">Xóa</button>
                      </div>
                      
                    </div>
                    ';
              }
              ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Lịch học
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Hôm Nay</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Ngày Mai</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                  </li> -->
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <?php
                    $arrColor = ['callout callout-danger', 'callout callout-info', 'callout callout-warning', 'callout callout-success'];
                    $i = 0;
                    if (is_array($lichhoc) && count($lichhoc) >= 1) {
                      foreach ($lichhoc as $item) {
                        if ($item['thu'] == $w) {
                          echo '
                      <div class="' . $arrColor[$i] . '">
                        <div class="lichhoc" style="display:flex;">
                          <h5>' . $item['tenmon'] . '</h5>
                          <span style="margin-left: 10px; color: blue">Hôm nay</span>
                        </div>
        
                        <p>Phòng học: <span style="color: orange" class="phonghoc">' . $item['phonghoc'] . '</span> Tiết bắt đầu: <span class="tiet_bd">' . $item['tiet_bd'] . '</span></p>
                      </div>';
                          $i++;
                          if ($i == 4) {
                            $i = 0;
                          }
                        }
                      }
                    } else {
                      echo '<h4>Hiện tại không có dữ liệu</h4>';
                    }

                    ?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <?php
                    $arrColor = ['callout callout-danger', 'callout callout-info', 'callout callout-warning', 'callout callout-success'];
                    $i = 0;
                    if (is_array($lichhoc) && count($lichhoc) >= 1) {
                      foreach ($lichhoc as $item) {
                        // echo $w." ".$item['thu']."\n";
                        if ($w == ($item['thu'] - 1)) {
                          echo '
                      <div class="' . $arrColor[$i] . '">
                        <div class="lichhoc" style="display:flex;">
                          <h5>' . $item['tenmon'] . '</h5>
                          <span style="margin-left: 10px; color: blue">Ngày mai</span>
                        </div>
        
                        <p>Phòng học: <span style="color: orange" class="phonghoc">' . $item['phonghoc'] . '</span> Tiết bắt đầu: <span class="tiet_bd">' . $item['tiet_bd'] . '</span></p>
                      </div>';
                          $i++;
                          if ($i == 4) {
                            $i = 0;
                          }
                        }
                      }
                    } else {
                      echo '<h4>Hiện tại không có dữ liệu</h4>';
                    }

                    ?>
                  </div>

                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php
require_once(__DIR__ . '/footer.php');

?>
<script>
  var endElement = document.querySelectorAll("#denhan");
  endElement.forEach(ele => {
    var endDate = moment(ele.innerText).countdown().toString();
    ele.innerText = endDate;
  });

  function deleteNN(id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url('ajax/handleNN.php') ?>",
      data: {
        action: 'delete',
        id: id
      },
      dataType: "json",
      success: function(res) {
        if (res.status == 'success') {
          toastr.success('Xóa thành công !', 'success')

        }
        if (res.status == 'error') {
          toastr.error(res.msg, 'error');

        }
        setTimeout(() => {
            location.reload();
          }, 1500);
      }
    });
  }
</script>