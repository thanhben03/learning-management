<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="sendmail">Send</button>
</body>
<script src="public/js/moment.js"></script>
<script src="public/js/countdown.js"></script>
<script src="public/js/moment-countdown.js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<script>
    $.ajax({
        type: "POST",
        url: "sendmail.php",
        data: {
            nguoinhan: 'benb2014642@student.ctu.edu.vn',
            tieude: 'Ngày mai kiểm tra',
            noidung: 'Ngày mai kiểm tra môn CSDL Phòng 201/DI'
        },
        dataType: "text",
        success: function (response) {
            console.log(respose,'success');
        }
    });
</script>
</html>
