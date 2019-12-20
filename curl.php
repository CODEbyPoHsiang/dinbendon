<?php

//初始化curl環境
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dinbendon.net/do/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: zh-TW,zh;q=0.9,en-US;q=0.8,en;q=0.7",
    "Cache-Control: max-age=0",
    "Connection: keep-alive",
    "Content-Length: 0",
    // "cookie: _ga=GA1.2.1046945946.1576548924; _gid=GA1.2.1708859978.1576548924; signIn.rememberMe=true; INDIVIDUAL_KEY=130469d0-5adb-4c00-9621-dd9493c4830a; JSESSIONID=E1036F90DBB139221F6A5AD04C5435FE; signInPanel__signInForm__username=BBinMobile; signInPanel__signInForm__password=nITbJKzP0p2p7sTSaxh79Q%3D%3D",
    "Host: dinbendon.net",
    // "Postman-Token: 21d2a79d-8540-49c3-9927-a5e3bafd34a7,fea55f9c-149b-430d-96da-543a10837ac7",
    "Referer: https://dinbendon.net/do/login",
    "Sec-Fetch-Mode: navigate",
    "Sec-Fetch-Site: same-origin",
    "Sec-Fetch-User: ?1",
    "Upgrade-Insecure-Requests: 1",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36",
    "cache-control: no-cache"
  ),
CURLOPT_COOKIE => "_ga=GA1.2.1046945946.1576548924; _gid=GA1.2.1708859978.1576548924; signIn.rememberMe=true; INDIVIDUAL_KEY=130469d0-5adb-4c00-9621-dd9493c4830a; JSESSIONID=05EE57DEAA2ED369AD95C16FA26B317E; signInPanel__signInForm__username=BBinMobile; signInPanel__signInForm__password=nITbJKzP0p2p7sTSaxh79Q%3D%3D",
  // CURLOPT_COOKIEJAR =>"Cookie",
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$html = curl_exec($curl);
curl_close($curl);


////顯示爬出的含html格式的網頁
//  echo $html;

// // preg_match以陣列方式把這標籤包含的字串，只會抓出指定標籤第一筆
//   $IsMatch= preg_match('/<span>(.*)<\/span>/', $html, $match);
// //印出陣列
//   if( $IsMatch ){
//   print_r ($match[0]) . "\n." ;
//   }


// //preg_match_all以陣列方式把這標籤包含的字串全部抓出來
//   $IsMatch= preg_match_all('/><a href="(.*)"><span>(.*)<\/span></U', $html, $match);
// //印出陣列
//   if( $IsMatch ){
//   print_r ($match[0]) . "\n." ;
//   }

  // 迴圈跑出全部標籤為<td ><a href="(.*)"><span>(.*)<\/span><\/a>的字串
  //做正規表示法，要特別注意函數內的標籤顏色，要注意斜線跟反斜線的運用，若提示顏色沒變化，則可能是正規表示法操作錯誤
  preg_match_all('/\<td ><a href="(.*)"><span>(.*)<\/span><\/a>/U', $html, $match);
  //在php preg_match中預設是採用貪婪比對，太貪婪反而不符合需要，因此得採用「非貪婪比對」，只要在modifier 中加上"U"即可
  foreach ($match[0] as $key => $stores) {
    echo  strip_tags ($stores)."\n"."</br>";
  }
   echo "<br>".'爬蟲結束時間:'.date("Y-m-d H:i:s",(time()+時差*3600)); 

 
// //逐一印出徒法煉鋼方式，把需要印出來即可(這個會把全部<span>標籤全部抓近來)
//這個步驟的缺點，因為是寫死的，若別的區域用到要抓的標籤，這樣值就不對了
//   preg_match_all('/<span>(.*)<\/span>/', $html, $match);
//   echo "最新公用店家";
//   echo "<hr>"; 
//     print_r ($match[0][0]). "\n.";
//     echo "</br>";
//     print_r ($match[0][1]). "\n.";
//     echo "</br>";
//     print_r ($match[0][2]). "\n.";
//     echo "</br>";
//     print_r ($match[0][3]). "\n.";
//     echo "</br>";
//     print_r ($match[0][4]). "\n.";
//     echo "</br>";
//     print_r ($match[0][5]). "\n.";
//     echo "</br>";
//     print_r ($match[0][6]). "\n.";
//     echo "<hr>"; 
//     echo "<br>".'爬蟲結束時間:'.date("d-m-Y H:i:s"); 

