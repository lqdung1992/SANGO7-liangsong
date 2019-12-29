<?php
/**
 * Author: lqdung1992@gmail.com
 * Date: 3/14/2019
 * Time: 1:47 PM
 */
?>

<html>
<head>
</head>
<body>
<?php
function vn_str_filter ($str) {
    $unicode = array(
        'TCMQ' => 'thăng cấp mật quyển',
        'MQ' => 'mật quyển',
        'DTT' => 'đoán tạo thư|đích thư quyển|tất bị',
        'YQuyet' => 'yếu quyết',
        'CThuat' => 'chiến thuật',
        'Uan Xa' => '轒 uân xe|轒 uân xa|轒 uan xa|轒 uan xe',
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        '，'=> ',',
    );

    foreach ($unicode as $nonUnicode=>$uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }

    return $str;
}

$ret = '';
$input = isset($_POST['string']) ? $_POST['string'] : '';
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$type = isset($_POST['camel']) ? $_POST['camel'] : 'per';
if ($mode == 'dich') {
    if ($input) {
        switch ($type) {
            case 'one':
                $ret = ucfirst(vn_str_filter($input));
                break;
            case 'per':
                $ret = ucwords(vn_str_filter($input));
                break;
            case 'all':
                $ret = strtoupper(vn_str_filter($input));
                break;
        }
    }
}
?>
<style>
    textarea {
        width:40%;
        box-sizing:border-box;
        /*direction:rtl;*/
        display:inline-block;
        /*max-width:100%;*/
        line-height:1.5;
        padding:15px 15px 30px;
        border-radius:3px;
        border:1px solid #F7E98D;
        font:13px Tahoma, cursive;
        transition:box-shadow 0.5s ease;
        font-smoothing: subpixel-antialiased;
    }
</style>

<form method="post" style="width: 1280px; margin: auto; position: relative;">
    <div style="width: 100%; display: inline-block;">
        <textarea name="string" rows="20"><?php echo $input; ?></textarea><br>
        <div style="width: 18%">
            <label><input type="radio" name="camel" value="one" <?php echo ($type == 'one') ? 'checked="checked"' : ""; ?>/> In hoa chữ cái đầu</label> <br>
            <label><input type="radio" name="camel" value="per" <?php echo ($type == 'per') ? 'checked="checked"' : ""; ?>/> In hoa tất cả chữ cái đầu</label><br>
            <label><input type="radio" name="camel" value="all" <?php echo ($type == 'all') ? 'checked="checked"' : ""; ?>/> In hoa hết</label><br><br>
            <button type="submit" name="mode" value="dich">Bỏ dấu</button>
            <button type="button" onclick="copyText();">copy all text</button>
        </div>
        <textarea rows="20" id="copy"><?php echo $ret; ?></textarea>
    </div>
</form>
<script type="text/javascript">
    var copyText = function () {
        var text = document.getElementById("copy");
        if (text && text.value) {
            /* Select the text field */
            text.select();
            /* Copy the text inside the text field */
            document.execCommand("copy");
        }
    };
    setTimeout(function () {
        copyText();
    }, 300);
</script>
</body>
<footer></footer>
</html>
