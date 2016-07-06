<?php

Class Listing {
    
    private $output;
    private $names;
    private $paths;
    private $messages;

    public function __construct($names, $paths, $fileName, $fileExt) {
        $this->names = $names;
        $this->paths = $paths;
        $this->output = $fileName . '.' . $fileExt;
        $this->messages = array();
        $this->rewriteExistedFile($this->output);
    }
    
    private function rewriteExistedFile($file) {
        if (file_exists($file) && !unlink($file))
            throw new Exception('SERVER ERROR: file with this name already exist, and cannot be rewrite');
    }
            
    public function processing() {
        $fh = fopen($this->output, 'a');
        for ($i = 0; $i < count($this->names); $i++) {
            $title = 'File: ' . $this->names[$i] . ': ';
            $file = array();
            fwrite($fh, PHP_EOL . $title. PHP_EOL . PHP_EOL);
            $file = $this->getArrayOfLines($this->paths[$i]);
            $this->writeArrayInFile($file, $fh);
        }
        fclose($fh);
    }
    
    private function getArrayOfLines($path) {
        $fileAsArray = file($path);
        foreach($fileAsArray as $num => $line) {
            if (preg_match("((^[\s]+$)|(^//))", $line))
                unset($fileAsArray[$num]);
        }
        return $fileAsArray;
    }

    private function writeArrayInFile($array, $fh) {
        $array = array_values($array);
        foreach ($array as $num => $line) {
    //        $line = htmlspecialchars($line);
            $line = sprintf("%-4s $line", $num);
            fwrite($fh, $line . PHP_EOL);
        }
    }
    
    public function downloadFile() {
        header('X-Sendfile: ' . realpath($this->output));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($this->output));
        exit;
    } 
}
?>
