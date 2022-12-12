<?php
function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
 
$name     = $_POST['name'];
$email    = $_POST['email'];
$subject  = $_POST['subject'];
$messages = $_POST['messages'];
 
if(trim($name) == '') {
    echo '<div class="error_message">Oops! Kamu lupa menuliskan Nama.</div>';
    exit();
} else if(trim($email) == '') {
    echo '<div class="error_message">Maaf! Email anda tidak valid</div>';
    exit();
} else if(!isEmail($email)) {
    echo '<div class="error_message">Maaf! Email anda tidak valid</div>';
    exit();
}
 
if(trim($subject) == '') {
    echo '<div class="error_message">Oops! Kamu lupa menuliskan Subjek.</div>';
    exit();
} else if(trim($messages) == '') {
    echo '<div class="error_message">Maaf, Isi Pesan Tidak Boleh Kosong</div>';
    exit();
} 

$address = "setyawanrullynli@gmail.com";
$e_subject = '[New Feedback] Anda dapat pesan baru dari ' . $name . '.';
$e_body = "kamu mendapat pesan dari $name mengenai $subject. isi pesan :" . PHP_EOL . PHP_EOL;
$e_content = "\"$messages\"" . PHP_EOL . PHP_EOL;
$e_reply = "kamu dapat membalas $name melalui email ke $email";


$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );
 
$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
 
if(mail($address, $e_subject, $msg, $headers)) {
 
    // Email has sent successfully, so let the user know.
 
    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h1>Terima kasih telah menghubungi saya</h1>";
    echo "<p>Terima kasih<strong>$name</strong>! Pesan anda sudah terkirim, dan akan saya respon secepatnya<</p>";
    echo "</div>";
    echo "</fieldset>";
 
} else {
 
    echo 'Ada yang Salah!';
    var_dump(mail($address, $e_subject, $msg, $headers));
    echo $address.'<br>'.$e_subject.'<br>'.$msg.'<br>'.$headers;
 
}