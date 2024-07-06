<?php
$body = [
    'title' => 'Lịch Học'
];
require_once(__DIR__ . '/header.php');
$sql = "SELECT * FROM lichhoc WHERE user_id = $user_id";
echo $sql;
$danhsach_lh = $BB->getList($sql);

?>
<div class="modal fade" id="modal-lichhoc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa lịch học </h4>
                <input id="id_lh" type="text" value="" hidden>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title mon-title">Môn: </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="monhoc">Môn học:</label>
                                        <input type="text" required class="form-control" id="monhoc">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phonghoc">Phòng học:</label>
                                        <input type="text" required class="form-control" id="phonghoc">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tiet_bd">Tiết bắt đầu:</label>
                                        <input type="number" min="1" max="9" class="form-control" id="tiet_bd">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="sotiet">Số tiết:</label>
                                        <input type="number" min="1" max="5" class="form-control" id="sotiet">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="thu">Thứ:</label>
                                        <input type="number" min="2" max="8" class="form-control" id="thu">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $body['title'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?=$body['title']?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row fl-direction-end mr-2">
            <div class="mb-3 ml-2">
                <a href="?action=lichhoc" class="btn btn-primary btn-icon-left m-b-10"><i class="fa-solid fa-list"></i>Danh Sách</a href="">
            </div>
            <div class="mb-3 ml-2">
                <a class="btn btn-warning btn-icon-left m-b-10 btn-center " href="javascript:history.go(-1)" type="button">
                    <ion-icon name="arrow-back-circle-outline"></ion-icon>Back
                </a>
            </div>

        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0 table-lichhoc">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Môn học</th>
                                            <th>Phòng</th>
                                            <th>Tiết bắt đầu</th>
                                            <th>Số tiết</th>
                                            <th>Thứ</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ($danhsach_lh as $lh) {
                                            echo '
                                                <tr>
                                                    <td>' . $lh['id'] . '</td>
                                                    <td>' . $lh['tenmon'] . '</td>
                                                    <td>' . $lh['phonghoc'] . '</td>
                                                    <td>' . $lh['tiet_bd'] . '</td>
                                                    <td>' . $lh['sotiet'] . '</td>
                                                    <td>' . $lh['thu'] . '</td>
                                                    <td>
                                                    <button data-toggle="modal" data-target="#modal-lichhoc"  onclick="viewLH(' . $lh['id'] . ')" aria-label="" style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10" type="button">
                                                        <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                                    </button>
                                                    <button onclick="deleteLH(' . $lh['id'] . ')" style="color:white;" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                                                        <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                                                    </button>

                                                </td>
                                                </tr>
                                                ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<?php

require_once(__DIR__ . '/footer.php');
?>
<script>
    async function viewLH(id_lh) {
        let data = {
            action: 'getLH',
            id_lh: id_lh
        }
        let res = await handleAjaxLH(data);
        res = res[0];

        $("#id_lh").val(res.id_lh)
        $(".mon-title").val(res.tenmon)
        $("#monhoc").val(res.tenmon)
        $("#phonghoc").val(res.phonghoc)
        $("#tiet_bd").val(res.tiet_bd)
        $("#sotiet").val(res.sotiet)
        $("#thu").val(res.thu)

    }

    async function deleteLH(id_lh) {
        var check = confirm("Bạn có chắc chắn muốn xóa ?");
        if (!check) {
            return;
        }
        let data = {
            action: 'deleteLH',
            id_lh: id_lh
        }
        let res = await handleAjaxLH(data);
        if (res.status == 'success') {
            toastr.success("Xóa thành công !", "success");
            // reloadPage(1500);
        }
    }

    function handleAjaxLH(data) {
        var response;
        return $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleNN.php') ?>",
            data: data,
            dataType: "json",
        });
        // console.log(response);
        // return response;
    }

    function reloadPage(timeout) {
        setTimeout(() => {
            location.reload();
        }, timeout);
    }
</script>