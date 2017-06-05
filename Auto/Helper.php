<?php

require_once 'goutte.phar';

use Goutte\Client;

class HaiPham_Auto_Helper
{
    public static function html2BBCode($string)
    {
        $replace = strip_tags($string, '<br><i><b><font><img><u><p>');
        $replace = preg_replace('/\<br( \/)?\>/',"\n",$replace);
        $replace = preg_replace("/<img src=\"(http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\"( alt=\"\".+)?\/?>/", "[img]$1[/img]", $replace);
        $replace = preg_replace("/<img alt=\"\" src=\"(http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\"\/?>/", "[img]$1[/img]", $replace);
        $replace = preg_replace('/\<font size=\"([1-7])\"\>((\s|.)+?)\<\/font>/i', '[size=\\1]\\2[/size]', $replace);
        $replace = preg_replace('/\<font color=\"(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])\"\>((\s|.)+?)\<\/font>/i', '[color=\\1]\\2[/color]', $replace);
        $replace = preg_replace('/\<font color=\"([a-zA-Z]+)\]((\s|.)+?)\<\/font>/i', '[color=\\1]\\2[/color]', $replace);
//        $replace = preg_replace("/\<a href=\"((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\">((\s|.)+?)\<\/a\>/i","[url=\\1]\\3[/url]", $replace);
        $replace = str_replace('<p>', '', $replace);
        $replace = str_replace('</p>', "\n", $replace);
        $replace = str_replace('<i>','[i]',$replace);
        $replace = str_replace('</i>','[/i]',$replace);
        $replace = str_replace('<b>','[b]',$replace);
        $replace = str_replace('</b>','[/b]',$replace);
        $replace = str_replace('<u>','[u]',$replace);
        $replace = str_replace('</u>','[/u]',$replace);
        $replace = str_replace('<','',$replace);
        $replace = str_replace('/>','',$replace);
        $replace = str_replace('&nbsp;',' ',$replace);
        return $replace;
    }

    public static function dwPost(array $input)
    {
        $visitor = XenForo_Visitor::getInstance();
        $writer = XenForo_DataWriter::create('XenForo_DataWriter_DiscussionMessage_Post');
        $writer->set('user_id', $visitor['user_id']);
        $writer->set('username', $visitor['username']);
        $writer->set('message', $input['message']);
        $writer->set('thread_id', $input['thread']);

        $writer->save();
    }

    public static function connect(array $option = array())
    {
        $client = new Client();
        $guzzleClient = new GuzzleHttp\Client($option);
        $client->setClient($guzzleClient);
        $client->setHeader('User-Agent', @$_SERVER['HTTP_USER_AGENT']);
//        $client->setHeader('X-Forwarded-For:', ($_SERVER['REMOTE_ADDR'], {$_SERVER['SERVER_ADDR']}));
        return $client;
    }

    public static function delTrash($text)
    {
        $text = preg_replace('/xem thêm tại (.+)/', '', $text);

        $text = str_replace("*Chương này có nội dung ảnh, nếu bạn không thấy nội dung chương, vui lòng bật chế độ hiện hình ảnh của trình duyệt để đọc.", '', $text);

        $text = preg_replace('/Bạn đang xem (.+)/', '', $text);

        $text = preg_replace('/Bạn đang đọc (.+)/', '', $text);

        $text = preg_replace('/Nguồn tại (.+)/', '', $text);

        $text = preg_replace('/Truyện được (.+)/', '', $text);

        $text = preg_replace('/Text được (.+)/', '', $text);

        $text = str_replace('nguồn TruyệnFULL.vn', '', $text);

        $text = str_replace('xem tại TruyenFull.vn', '', $text);

        $text = preg_replace('/Đọc Truyện Online(.+)/', '', $text);

        return $text;
    }

    public static function extracNum($string)
    {
        //http://truyencuatoi.com/threads/yeu-than-ky-_-phat-tieu-dich-oa-nguu.2097/
        preg_match('/(^(http:\/\/)|https:\/\/)?.+\/(index.php\?)?threads\/(.+)\.([0-9]+)(\/(.+))?/',
            $string,
            $new
        );


        return $new[5];
    }

    public static function setMessages($title, $content)
    {
        return '[CENTER][B] ' . $title . '[/B][/CENTER]
                [SPOILER="Mời đọc"]
                    ' . $content . '
                [/SPOILER]';

    }

}