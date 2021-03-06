<?php

//(1.)抓出驗證碼的總和及post會變動的網址串===========================================================================================
$cookie =  dirname(__FILE__)."/cookie.txt";//把cookie存起來
$login_url = "https://dinbendon.net/do/login";
$curl= curl_init();
curl_setopt($curl, CURLOPT_URL, $login_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); 
$html = curl_exec($curl);
curl_close($curl);

//先抓認證碼加法的算式 xx+xx= 或 xx加xx 等於
preg_match('/\<td style="width: 6em;" class="alignRight">(.*)<\/td>/U', $html, $match);
$num=$match[1];
// print_r($num);//將加法印出來
preg_match_all('/[0-9]{0,}/',$num,$single);//利用array_sum函數把數值全部相加
$code = array_sum($single[0]);// echo $code;//印出總和

//抓出每次提交表單變更action後的網址串
preg_match('/<form action="(.*)" id="signInPanel_signInForm" method="post">/U', $html, $ma);
$a=$ma[1];
// var_dump($a);

//(2.)模擬提交表單//(把每次變更的網址串$a帶進來)===========================================================================================
$posturl = "https://dinbendon.net$a";
//要提交的資料//(把每次變更的認證碼總和$code帶進來)
$post = "signInPanel_signInForm%3Ahf%3A0=&username=guest&password=guest&result=$code&submit=%E7%99%BB%E5%85%A5";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $posturl);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);//提交方式為post
// curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
curl_exec($curl);
curl_close($curl);


//(3.)開始爬登入之後網頁的資料，並用正規表示法比對條件篩選出要的資料==========================================================================
$data_url = "https://dinbendon.net/do"; //爬出登入後資料的網址
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $data_url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '0');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
$data = curl_exec($ch);
curl_close($ch);
// echo ($data);//印出登入後的全部頁面

//利用正規表示比對把要的新增店家欄位取出來
preg_match_all('/\<td ><a href="(.*)"><span>(.*)<\/span><\/a>/U', $data, $match);
//在php preg_match中預設是採用貪婪比對，太貪婪反而不符合需要，因此得採用「非貪婪比對」，只要在modifier 中加上"U"即可
foreach ($match[0] as $key => $store) {
  echo  strip_tags ($store)."\n"."</br>";
}
  echo "<br>".'爬蟲結束時間:'.date("Y-m-d H:i:s",(time()+8*3600))."<br>"; //(time()+8*3600)是改成台灣時間
  echo "<hr>";

//(4.)爬出來的資料寫進資料庫中===========================================================================================================

//連接資料庫
  require_once './db.php';

?>


