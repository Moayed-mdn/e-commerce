<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Exception;

class BaseApiException extends Exception{

    use ResponseTrait;

}


