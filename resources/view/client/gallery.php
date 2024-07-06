<?php
$body = [
    'title' => 'Thư viện ảnh'
];
if (isset($_GET['id'])) {
    $idmon = $_GET['id'];
}
require_once(__DIR__ . '/header.php');
$sql = "SELECT * FROM gallery WHERE mon_id = $idmon";
$listImg = $BB->getList($sql);

?>
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
                <button class="btn btn-primary">
                    <a style="color: white" href="/home/upload/<?= $idmon ?>">UPLOAD</a>
                </button>
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
                <h3 class="card-title">
                    Thư viện ảnh đã thêm
                </h3>

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
                <!-- <div class="row">
                    <div class="col-lg-12 text-center my-2">
                        <h4>Isotope filter magical layouts with Bootstrap 4</h4>
                    </div>
                </div>
                <div class="portfolio-menu mt-2 mb-4">
                    <ul>
                        <li class="btn btn-outline-dark active" data-filter="*">All</li>
                        <li class="btn btn-outline-dark" data-filter=".gts">Girls T-shirt</li>
                        <li class="btn btn-outline-dark" data-filter=".lap">Laptops</li>
                        <li class="btn btn-outline-dark text" data-filter=".selfie">selfie</li>
                    </ul>
                </div> -->
                <div class="portfolio-item row">
                    <?php
                    foreach ($listImg as $item) {
                        echo '
                            <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                                <a href="https://image.freepik.com/free-photo/stylish-young-woman-with-bags-taking-selfie_23-2147962203.jpg" class="fancylight popup-btn" data-fancybox-group="light">
                                    <img class="img-fluid" src="' . $item['tenanh'] . '" alt="">
                                </a>
                            </div>
                            ';
                    }
                    ?>

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
    $('.portfolio-menu ul li').click(function() {
        $('.portfolio-menu ul li').removeClass('active');
        $(this).addClass('active');

        var selector = $(this).attr('data-filter');
        $('.portfolio-item').isotope({
            filter: selector
        });
        return false;
    });
    $(document).ready(function() {
        var popup_btn = $('.popup-btn');
        popup_btn.magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
</script>