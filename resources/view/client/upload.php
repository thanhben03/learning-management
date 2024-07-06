<?php
$body = [
    'title' => 'Upload Hình Ảnh'
];
require_once(__DIR__ . '/header.php');
?>
<div class="content-wrapper" style="min-height: 2838.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thư Viện Ảnh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tạo ảnh mới <a href="javascript:history.go(-1)" class="btn btn-danger">Back</a> </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="note-img">Ghi chú</label>
                            <input type="text" class="form-control" id="note-img" placeholder="Nhập nội dung">
                            <input type="text" hidden value="<?= $_GET['id'] ?>" class="form-control" id="idmon">
                        </div>
                        <div class="form-group">
                            <label for="fileImgInput">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-button" id="fileName">Choose File</div>
                                            <div class="file-select-name" id="noFile">No file chosen...</div>
                                            <input type="file" id="files" name="files[]" multiple>
                                            <!-- <input type="file" id="file" name="file"> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Preview</label>
                            <div class="input-group wrap-preview-img">
                                <img src="https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg" class="img-upload-preview img-fluid no-data-img" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button onclick="submitImage()" class="submit-img-gallery btn btn-primary">
                            <div class="wrap-submit">
                                <span>Submit</span>
                            </div>
                            <div class="wrap-loading">
                                <i class="fa fa-spinner fa-spin icon-loading"></i><span>Loading</span>
                            </div>
                        </button>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
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
    $('#file').bind('change', function() {
        var filename = $("#file").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen...");
        } else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
            var curElement = $('.img-upload-preview');
            var reader = new FileReader();

            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                curElement.attr('src', e.target.result);
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        }
    });

    function submitImage() {
        var file_data = document.getElementById("files").files;

        var form_data = new FormData();
        var file_arr = Object.entries(file_data);
        file_arr.forEach(file => {
            // console.log(file[1]);
            form_data.append("files[]", file[1]);
        });
        // console.log(form_data); 
        form_data.append('idmon', $("#idmon").val());
        form_data.append('ghichu', $("#note-img").val());
        $.ajax({
            url: '<?= base_url('ajax/upload.php') ?>',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                console.log('12312312');
                document.querySelector(".wrap-loading").style.display = 'block';
                document.querySelector(".wrap-loading").style.cursor = 'not-allowed';
                document.querySelector(".wrap-submit").style.display = 'none';
            },
            success: function(res) {
                console.log(res);
                if (res.status == 'success') {
                    toastr.success('Thêm ảnh thành công !', 'success!')
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
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
    // function submitImage() {
    //     var file_data = $("#file").prop('files')[0];
    //     var form_data = new FormData();
    //     console.log(file_data);
    //     form_data.append('file', file_data);

    //     console.log(form_data['files']);
    //     form_data.append('idmon',$("#idmon").val());
    //     form_data.append('ghichu',$("#note-img").val());
    //     console.log(form_data);
    //     $.ajax({
    //         url: '<?= base_url('ajax/upload.php') ?>',
    //         dataType: 'json',
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: form_data,
    //         type: 'post',
    //         success: function(res) {
    //             console.log(res);
    //             if (res.status == 'success') {
    //                 toastr.success('Thêm ảnh thành công !', 'success!')
    //             } else {
    //                 toastr.error('Đã xảy ra lỗi !', 'error')
    //             }
    //         }
    //     });
    // }
</script>