<?php
//此方法是直接把獲取的cookie寫在程式碼內
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
    "Host: dinbendon.net",
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
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//忽略ssl認證
$html = curl_exec($curl);
curl_close($curl);

//目前運行做法:
// foreach跑出全部標籤為<td ><a href="(.*)"><span>(.*)<\/span><\/a>的資料
//要特別注意preg_match_all()內過濾的標籤顏色，要注意斜線跟反斜線的運用，若提示顏色在vscode提示沒變化，則可能是正規表示法操作錯誤
//利用strip_tags將獲取的資料處理轉成字串
preg_match_all('/\<td ><a href="(.*)"><span>(.*)<\/span><\/a>/U', $html, $match);
foreach ($match[0] as $key => $stores) {
  echo  strip_tags ($stores)."\n"."</br>";
}
 echo "<br>".'爬蟲結束時間:'.date("Y-m-d H:i:s",(time()+時差*3600)); 


