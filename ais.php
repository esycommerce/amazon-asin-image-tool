<?php
include_once 'utils.php';

define('AMAZON_P_BASE_URL', 'https://www.amazon.in/dp/');
define('AMAZON_OBJ_PREFIX', '<scripttype="text/javascript">P.when(\'A\').register("ImageBlockATF",function(A){vardata=');
define('AMAZON_OBJ_SUFFIX', ';A.trigger(\'P.AboveTheFold\');//triggerATFevent.returndata;});</script>');

class AIS{

    function __construct($downloads_folder = ''){
        $this->df = $downloads_folder;
    }

    public function downloadImages($asin){
        $url = AMAZON_P_BASE_URL . $asin;
        if(get_http_response_code($url) != "200"){
            return false;
        }
        $html = file_get_contents($url);
        return $this->parseContent($asin, $html);
    }

    private function parseContent($asin, $content){
        $stripped = preg_replace('/\s/', '', $content);
        $raw_data = getOccurrence(AMAZON_OBJ_PREFIX, AMAZON_OBJ_SUFFIX, $stripped);
        $raw_data = str_replace('\'', '"', $raw_data);
        $data = json_decode($raw_data);

        $images = $data->{'colorImages'}->{'initial'};
        $extractor = function ($img){
            return $this->getHighestResolutionImageUrl($img);
        };

        $images_urls = array_map($extractor, $images);
        if(count($images_urls) < 1) return false;
        
        return $this->downloadFiles($asin, $images_urls);
    }

    private function downloadFiles($asin, $urls){
        $folder = strlen($this->df) ? $this->df . '/' . $asin : $asin;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        foreach($urls as $url){
            copy($url, $folder . '/' . basename($url));
        }

        zipFolder($folder, 'zips/' . $asin . '.zip');
        deleteDir($folder);

        return true;
    }

    private function getHighestResolutionImageUrl($data){
        if($data->{'hiRes'}){
            return $data->{'hiRes'};
        }else if($data->{'large'}){
            return $data->{'large'};
        }else{
            $best = '';
            $record = 0;
            foreach($data->{'main'} as $url => $sizes){
                $w = $sizes[0];
                if($w > $record){
                    $record = $w;
                    $best = $url;
                }
            }
            return $best;
        }
    }

}