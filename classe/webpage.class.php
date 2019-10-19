<?PHP

class WebPage 
{
    private $head; #string
    private $title;#string
    private $body; #string

    
    public function __construct(string $title=null)
    {
        $this->body="";
        $this->title=$title;
        $this->head="";
    }
    
    public function body():string
    {
        return $this->body;
    }
    
    public function head():string
    {
        return $this->head;
    }

    public function setTitle(string $title):void
    {
        $this->title=$title;
    }

    public function appendToHead(string $content):void
    {
        $this->head.=$content;
    }

    public function appendCss(string $css):void
    {
        $this->head.="<style>$css</style>";
    }

    public function appendCssUrl(string $url):void
    {
        $this->head.='<link href="'.$url.'" rel="stylesheet" type="text/css"/>';
    }

    public function appendJs(string $js):void
    {
        $this->head.='<script type="text/javascript">'.$js.'</script>';
    }

    public function appendJsUrl(string $url):void
    {
        $this->head.='<script type="text/javascript" src="'.$url.'"></script>';
    }

    public function appendContent(string $content):void
    {
        $this->body.=$content;
    }

  public function getLastModification():string
    {
        $lastModification=strftime('%D',getlastmod());
        return "<span>$lastModification</span>";
    }    

    public static function escapeString(string $string):string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, "utf-8");
    }

    public function toHTML():string
    {
        $date=$this->getLastModification();
        if(is_null($this->title))
        {
           throw new exception ('Pas de titre') ;
        }
        else
        {
            
            $html=<<<HTML
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>$this->title</title>
                $this->head
            </head>
            <body>
                $this->body
                <footer>Dernière modification de cette page le $date</footer>
            </body>
            </html>
HTML;
            return $html;
        }      
        
    }    

  

}
