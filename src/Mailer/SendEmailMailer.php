<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * SendEmail mailer.
 */
class SendEmailMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'SendEmail';
    public function sendEmail(array $data)
{
	
     $this->from('ladanipiyush00@gmail.com','DE-CIX Colocation Portal')
                ->to($data[0])
                ->subject('Password Change Request for '.$data[2].'')
                ->emailFormat('text')
                ->template('default','default')
                ->set(['data'=>$data[1]]);
}
}
