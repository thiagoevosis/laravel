<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BookCreateException extends Exception
{
    /**
    * Report the exception.
    *
    * @return void
    */
   public function report(\Throwable $exception)
   {
     
       Log::error($exception->getMessage());
   }
}
