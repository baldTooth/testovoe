<?php 
declare(strict_types=1);

namespace Randomserver\Logger;

use DateTime;
use Randomserver\Logger\LoggerInterface;
use Exception;
class SimpleLogger implements LoggerInterface{
    
    public function __construct(private string $logsPath)
    {}
    
    public function write(string $message="",Exception $exc=null){
        
        $file = fopen($this->logsPath,"r+");
        
        if(flock($file,\LOCK_EX)){
            
            fseek($file,0,SEEK_END);

            $logMessage = $this->generateMessage($message,$exc);

            fwrite($file,$logMessage);

            flock($file,\LOCK_UN);
        }else{
            throw new Exception("Failed flock logger file {$this->logsPath}");
        }

        fclose($file);

    }

    private function generateMessage(string $message,Exception $exc):string{
        $currDate = new DateTime();
        $logMessage = "\n\n{$currDate->getTimestamp()}\nMessage: {$message}\nStackTrace: {$exc->getTraceAsString()}\n";

        return $logMessage;
    }
}