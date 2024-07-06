<?php
$body = [
    'title' => 'Danh Sách Môn Học'
];
require_once(__DIR__ . '/header.php');
$sql = "SELECT * FROM monhoc";
$dachsach_mon = $BB->getList($sql);

?>
<div class="modal fade" id="modal-listmon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="">EDIT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div action="" method="POST" id="createNote">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="noidung">Tên:</label>
                            <input type="text" class="idMon" hidden>
                            <input type="text" class="form-control modal-tenmon" value="">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <!-- <div class="card-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button class="btn btn-primary" onclick="updateMon()">Submit</button>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="updateMon()">Submit</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-themmon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="">ADD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div action="" method="POST" id="createNote">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="noidung">Tên:</label>
                            <input type="text" class="idMon" hidden>
                            <input type="text" class="form-control modal-add-tenmon" value="">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button class="btn btn-primary" onclick="addMon()">ADD</button>
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
                        <li class="breadcrumb-item active"><?= $body['title'] ?></li>
                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row fl-direction-end mr-2">
            <div class="mb-3 ml-2">
                <button class="btn btn-primary btn-icon-left m-b-10" onclick="showAddMon()" type="button"><i class="fas fa-plus-circle mr-1"></i>Thêm</button>
            </div>
            <div class="mb-3 ml-2">
                <a class="btn btn-warning btn-icon-left m-b-10 btn-center " href="javascript:history.go(-1)" type="button">
                    <ion-icon name="arrow-back-circle-outline"></ion-icon>Back
                </a>
            </div>

        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title">Các Môn Học Đã Thêm <button onclick="showAddMon()" class="btn btn-primary btnAddMon">Thêm</button> </h3> -->

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
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dachsach_mon as $mon) {
                            echo '
                                    <tr>
                                        <td>' . $mon['id'] . '</td>
                                        <td><a href="/home/view-mon/' . $mon['id'] . '">' . $mon['tenmon'] . '</td>
                                        <td>
                                            <ion-icon name="create-outline" class="btnAction" onclick="showMon(' . $mon['id'] . ')"></ion-icon>
                                            <ion-icon name="trash-outline" class="btnAction" onclick="deleteMon(' . $mon['id'] . ')"></ion-icon>
                                            <a href="/home/view-mon/' . $mon['id'] . '">
                                                <ion-icon name="eye-outline" class="btnAction"></ion-icon>
                                            </a>
                                            
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

    </section>
    <!-- /.content -->
</div>

<?php

require_once(__DIR__ . '/footer.php');
?>
<script>
    function deleteMon(id) {
        var check = confirm("Bạn có chắc chắn muốn xóa ?");
        if (!check) {
            return
        }
        $.ajax({
            url: "<?= base_url("ajax/deleteSubject.php"); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Xóa thành công !'
                    })
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    alert("Error")
                }
            },
            // error: function() {
            //     alert(html(response));
            //     history.back();
            // }
        });
    }

    function showMon(id) {
        // console.log($(".modal-tenmon").val);
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleSubject.php') ?>",
            data: {
                action: 'getDataMon',
                idMon: id,
                // name: $(".modal-tenmon").val
            },
            dataType: "json",
            success: function(response) {
                console.log(id);

                $(".modal-tenmon").val(response.tenmon)
                $(".idMon").val(id)
                $("#modal-listmon").modal('show')
            }
        });
    }

    function updateMon() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleSubject.php') ?>",
            data: {
                action: 'updateMon',
                idMon: $(".idMon").val(),
                tenmon: $(".modal-tenmon").val()
            },
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success('Chỉnh sửa thành công !', 'Success!')
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                }
            }
        });
    }

    function showAddMon() {
        $("#modal-themmon").modal('show');
    }

    function addMon() {
        $.ajax({
            type: "post",
            url: "<?= base_url('ajax/handleSubject.php') ?>",
            data: {
                action: 'addmon',
                tenmon: $(".modal-add-tenmon").val()
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success('Thêm môn thành công !', 'success!')
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }
</script>