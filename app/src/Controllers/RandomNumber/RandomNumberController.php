<?php 
declare(strict_types=1);

namespace Randomserver\Controllers\RandomNumber;

use Randomserver\Logger\LoggerInterface;
use Randomserver\Services\Interfaces\RandomNumberServiceInterface;
use Randomserver\Controllers\RandomNumber\RandomNumberControllerInterface;
use Randomserver\Response\Response;
use Randomserver\Support\URLHelper;
use Exception;


class RandomNumberController implements RandomNumberControllerInterface{
    
    public function __construct(
        private RandomNumberServiceInterface $randomNumberService,
        private LoggerInterface $logger,
    )
    {}
   

    public function generate(){
 
        try{
            
            $id = $this->randomNumberService->create();
            Response::json(["id"=>$id]);

        }catch(Exception $exc){
            $this->logger->write(exc:$exc);
            Response::text("Server error",500);
        }
    }
    public function getById(){
        
        try{
            
            $idParameter = (int)URLHelper::getLastParameter();
            
            if(!is_int($idParameter)&&$idParameter<=0){
                Response::text("Not found",404);
                return;
            }

            $randomNumber = $this->randomNumberService->getById($idParameter);

            if($randomNumber===null){
                Response::text("Not found",404);
                return;
            }


            Response::json([
                "id"=>$randomNumber->getId(),
                "number"=>$randomNumber->getNumber()
            ]);

        }catch(Exception $exc){
            $this->logger->write(exc:$exc);
            Response::text("Server error",500);
        }
    }
}