<?php


class HaiPham_Auto_Chap
{

    /**
     * @var \Symfony\Component\DomCrawler\Crawler|void
     */
    private $html;


    /**
     * @var string
     */
    private $next_url;

    /**
     * @var string
     */
    private $messages;


    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    public function __construct($url)
    {
        $this->html = HaiPham_Auto_Helper::connect()->request('get', $url);
        switch (parse_url($url, PHP_URL_HOST)) :
            case 'truyenfull.vn';
                $this->TFV();
                break;
            case 'bachngocsach.com';
                $this->BNS();
                break;
            case 'webtruyen.com';
                $this->WET();
                break;
            case 'thichdoctruyen.com';
                $this->TDT();
                break;
            default;
                return;
                break;
        endswitch;
    }

    private function TDT()
    {

    }

    private function WET()
    {
        $this->title = $this->html->filter('.chapter-header h3')->text();
        $this->content = $this->html->filter('#content')->html();
        try {
            $this->next_url = $this->html->filter('#nextchap')->attr('href');

        } catch (Exception $exception) {
            $this->next_url = '';
        }
        return $this->setMessages();
    }

    private function BNS()
    {
        //$this->title = $this->html->filter('#chuong-title')->text();
        //$this->content = $this->html->filter('#noidung')->html();
        //$url = $this->html;
        var_dump($this->html);die;
    }


    private function TFV()
    {
        $this->title = $this->html->filter('.chapter-title')->text();
        $this->content = $this->html->filter('.chapter-c')->html();
        $url = $this->html->filter('a#next_chap')->attr('href');
        if ($url != 'javascript:void(0)')
        {
            $this->next_url = $url;
        } else $this->next_url = '';
        return $this->setMessages();
    }

    /**
     * @return mixed
     */
    public function getNextUrl()
    {
        return $this->next_url;
    }



    private function setMessages()
    {
        $this->messages = HaiPham_Auto_Helper::setMessages(
            $this->title,
            HaiPham_Auto_Helper::html2BBCode($this->content)
        );
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return HaiPham_Auto_Helper::delTrash($this->messages);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}