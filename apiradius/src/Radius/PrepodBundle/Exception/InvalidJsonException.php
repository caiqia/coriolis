<?php
namespace Radius\PrepodBundle\Exception;

class InvalidJsonException extends \RuntimeException
{
    //protected $form;
    public function __construct($message, $code)
    {
        parent::__construct($message,$code);
        //$this->form = $form;
    }
    /**
     * @return array|null
     
    public function getForm()
    {
        return $this->form;
    }
	*/
}
