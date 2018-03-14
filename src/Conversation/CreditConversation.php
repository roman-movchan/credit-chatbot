<?php

namespace App\Conversation;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class CreditConversation extends Conversation
{
    protected $firstname;

    protected $lastname;

    protected $email;

    protected $phone;

    protected $amount;

    public function askFirstName()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            $this->firstname = $answer->getText();
            $this->askLastName();
        });

    }

    public function askLastName()
    {
        $this->ask('What is your lastname?', function(Answer $answer) {
            $this->lastname = $answer->getText();
            $this->askAmount();
        });
    }

    public function askAmount()
    {
        $this->ask('What amount of credit you want?', function(Answer $answer) {
            $this->amount = $answer->getText();
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            $this->email = $answer->getText();
            $this->askPhone();
        });
    }

    public function askPhone()
    {
        $this->ask('And the last, what is your phone number?', function(Answer $answer) {
            $this->phone = $answer->getText();
            $this->say('Great - that is all we need, '.$this->firstname);
        });
    }

    public function run()
    {
        $this->askFirstName();
    }
}
