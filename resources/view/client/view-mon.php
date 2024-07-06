<?php
$body = [
    'title' => 'Xem Ghi Chú'
];
if (isset($_GET['id'])) {
    $idmon = $_GET['id'];
}
$getMon = $BB->getOneRow('monhoc', $idmon);
$sql = "SELECT gc.*,ac.username,ac.id as userID  FROM ghichu gc JOIN account ac ON gc.userId = ac.id WHERE  mon_id = $idmon order by created_at DESC";
$getGhiChu = $BB->getList($sql);
// echo $idmon;die();
require_once(__DIR__ . '/header.php');
?>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm ghi chú</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="createNote">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="noidung">Nội dung</label>
                            <textarea class="form-control" name="noidung" id="noidung" rows="3"></textarea>
                            <input type="text" value="<?= $idmon ?>" hidden name="idMon">
                        </div>
                        <div class="form-group">
                            <label for="fileImgInput">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-button" id="fileName">Choose File</div>
                                            <div class="file-select-name" id="noFile">No file chosen...</div>
                                            <!-- <input type="file" id="files" name="files[]" multiple> -->
                                            <input type="file" id="file" name="file">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="">
                        <div class="input-group wrap-preview-img">
                            <img src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg" class="img-upload-preview img-fluid no-data-img" alt="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-showNote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Xem chi tiết</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="note-detail-content">One fine body…</p>
                <div class="wrap-img-detail">

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-nhacnho">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo nhắc nhở</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="create-nhacnho">
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <label for="noidung">Nội dung</label>
                            <textarea class="form-control" name="noidung" id="noidung" rows="3"></textarea>
                            <input type="text" value="<?= $idmon ?>" hidden name="idMon">
                        </div> -->
                        <!-- <label for="fileImgInput">File input</label> -->

                        <div class="form-group">
                            <label for="end-date">Ngày kết thúc</label>
                            <input type="date" required class="form-control" id="end-date">
                        </div>


                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" onclick="addAlert()" class="btn btn-primary btn-add-nhacnho">Thêm</button>
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
                    <h1><?=$body['title']?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active"><?=$body['title']?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content connectedSortable ui-sortable">
        <div class="row mr-2 mb-2 fl-direction-end ">
            <!-- <button type="button" class="ml-2 btn btn-primary btn-center" data-toggle="modal" data-target="#modal-default">
                <ion-icon name="add-circle-outline"></ion-icon>Thêm
            </button> -->
            <a href="/home/gallery/<?= $idmon ?>">
                <button type="button" class="ml-2 btn btn-warning btn-center">
                    <ion-icon name="images-outline"></ion-icon>Gallery
                </button>
            </a>
            <a href="javascript:history.go(-1)" class="ml-2 btn btn-success btn-center">
                <ion-icon name="arrow-back-circle-outline"></ion-icon>Back
            </a>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="" style="display: flex;">

            </div>

            <div class="card-header card-primary card-outline">

                <h3 data-idMon="<?= $idmon ?>" class="card-title">Môn: <?= $getMon['tenmon'] ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input onkeyup="searchNote(this)" type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <?php
                        if (count($getGhiChu) < 1) {
                            echo '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Alert!</h5>
                            No data availble !
                          </div>';
                        } else {
                            echo '<div class="timeline">';
                            $strImg = '';

                            foreach ($getGhiChu as $item) {
                                $ghichu_id = $item['id'];
                                $sql = "SELECT * FROM gallery gl JOIN ghichu gc ON gl.ghichu_id = gc.id WHERE gc.id= $ghichu_id LIMIT 2";
                                $getImg = $BB->getList($sql);
                                foreach ($getImg as $img) {
                                    $strImg .= '<img style="width: 108px" src="'.$img['tenanh'] . '">';
                                }
                                echo '
                                        <input id="ghichu_id" type="text" data-id="' . $item['id'] . '" hidden>
                                        <div class="time-label">
                                            <span class="bg-red">' . $item['created_at'] . '</span>
                                        </div>
        
                                        <div>
                                            <i class="fas fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                                <span class="time">' . $item['created_at'] . '</span>
                                                <h3 class="timeline-header"><a href="#">' . $item['username'] . '</a> đã tạo ghi chú mới</h3>
                                                <div class="timeline-body">
                                                    <p class="note-content">' . $item['noidung'] . '</p>
                                                    <div class="">
                                                    ' . $strImg . '
                                                    </div>
                                                </div>
                                                <div class="timeline-footer">
                                                
                                                    <a onclick="showNote(' . $item['id'] . ')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-showNote">Chi tiết</a>
                                                    <a class="btn btn-danger btn-sm" onclick="deleteNote(' . $item['id'] . ')">Xóa</a>
                                                    <a data-toggle="modal" data-target="#modal-nhacnho" class="btn btn-primary btn-sm">Tạo nhắc nhở</a>

                                                </div>
                                            </div>
                                        </div>
                                        ';
                                $strImg = '';
                            }
                            echo
                            '<div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>';
                        }



                        ?>

                    </div>
                </div>
                <!-- /.col -->
            </div>
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
    $("#createNote").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/insertnote.php') ?>",
            data: $(this).serialize(),
            dataType: "text",
            success: function(response) {
                if (response == 'success') {
                    toastr.success('Thêm ghi chú thành công !', 'Success!')
                    setTimeout(() => {
                        location.reload();

                    }, 1000);
                }
            }
        });
    })

    function deleteNote(idNote) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/deleteNote.php') ?>",
            data: {
                idNote: idNote
            },
            dataType: "text",
            success: function(response) {
                if (response == 'success') {
                    toastr.error('Xóa thành công!', 'Success')
                    setTimeout(() => {
                        location.reload();

                    }, 1000)
                }
            }
        })
    }

    function submitImage() {
        var file_data = document.getElementById("files").files;

        var form_data = new FormData();
        var file_arr = Object.entries(file_data);
        file_arr.forEach(file => {
            console.log(file[1]);
            form_data.append("files[]", file[1]);
        });
        console.log(form_data);
        form_data.append('idmon', $("#idmon").val());
        form_data.append('ghichu', $("#note-img").val());
        $.ajax({
            url: '<?= base_url('ajax/upload.php') ?>',
            dataType: 'json',
            // cache: false,
            // contentType: false,
            // processData: false,
            // async: false,
            data: form_data,
            type: 'post',
            beforeSend: function () {
                console.log('123123');
                $(".wrap-loading").show();            
            },
            success: function(res) {
                console.log(res);
                if (res.status == 'success') {
                    toastr.success('Thêm ảnh thành công !', 'success!')
                } else {
                    toastr.error('Đã xảy ra lỗi !', 'error')
                }
            }
        });
    }

    $("#files").on("change", function(e) {
        var files = e.target.files;
        var fileLength = files.length;
        if (document.querySelector(".no-data-img")) {
            document.querySelector(".no-data-img").remove();
        }
        for (let index = 0; index < fileLength; index++) {
            var f = files[index];
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var file = e.target;
                $("<img></img>", {
                    class: "img-upload-preview img-fluid",
                    src: e.target.result,
                    title: file.name + " | Click to remove"
                }).insertAfter(".wrap-preview-img").click(function() {
                    $(this).remove();
                });
            }
            fileReader.readAsDataURL(f);

        }
    })

    function showNote(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleSubject.php') ?>",
            data: {
                action: "getDetailNote",
                id: id
            },
            dataType: "json",
            success: function(res) {
                let noteContent = document.querySelector(".note-content");
                let strImg = '';
                res.forEach(item => {
                    strImg += `<img src="public/upload/img/${item.tenanh}">`;
                })
                document.querySelector(".note-detail-content").innerText = noteContent.innerText;
                document.querySelector(".wrap-img-detail").innerHTML = strImg;
            }
        });
    }

    function searchNote(el) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleNote.php') ?>",
            data: {
                action: 'searchNote',
                keyword: el.value,
                idmon: <?= $idmon ?>
            },
            dataType: "json",
            success: function(res) {
                console.log(res);
                let strImg = '';
                console.log(res);
                let result = '';
                if (res.length > 0) {
                    res.forEach(item => {
                        strImg = getStringImg(item.img);
                        result +=
                            `<div class="time-label">
                        <span class="bg-red">${item.created_at}</span>
                    </div>

                    <div>
                        <i class="fas fa-comments bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header"><a href="#">${item.username}</a> đã tạo ghi chú mới</h3>
                            <div class="timeline-body">
                                <p class="note-content">${item.noidung}</p>
                                <div class="">
                                ${strImg}
                                </div>
                            </div>
                            <div class="timeline-footer">
                            
                                <a onclick="showNote(${item.id})" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-showNote">Chi tiết</a>
                                <a class="btn btn-danger btn-sm" onclick="deleteNote(${item.id})">Xóa</a>
                                <a class="btn btn-primary btn-sm" onclick="addAlert(${item.id})">Tạo nhắc nhở</a>
                            </div>
                        </div>
                    </div>`;
                    });
                }
                document.querySelector(".timeline").innerHTML = result;
            }
        });
    }

    function getStringImg(arrImg) {
        let result = '';
        arrImg.forEach(img => {
            result += `
            <img style="width: 108px" src="${img.tenanh}">
            `
        });

        return result;
    }

    function addAlert() {
        let ghichu_id = $("#ghichu_id").data('id');
        let endDate = $("#end-date").val();
        if (endDate == '') {
            alert("Vui lòng chọn ngày kết thúc !");
            return;
        }
        $.ajax({
            type: "POST",
            url: "<?= base_url('ajax/handleNote.php') ?>",
            data: {
                action: "addAlert",
                ghichu_id: ghichu_id,
                endDate: endDate
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success('Tạo nhắc nhở thành công !', 'success')
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });

    }
    window.onload = function() {
        document.querySelectorAll(".time").forEach(item => {
            var time = item.innerText;
            item.innerText = moment(time).fromNow();
        })
    }
</script>