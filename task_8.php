<?php

class twitterService
{
    private $_data = [];  // Оголошуємо властивість

    public function setMessage($text)
    {
        $this->_data['message'] = $text;
        echo $this->_data['message'] . PHP_EOL;
    }

    public function sendTweet()
    {
        echo "I sent a tweet";
    }
}

interface NotificationInterface
{
    public function setData($data);
    public function sendNotification();
}

class TwitterAdapter implements NotificationInterface
{
    protected $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function sendNotification()
    {
        $twitterClient = new TwitterService();
        $twitterClient->setMessage($this->_data['message']);
        $twitterClient->sendTweet();
    }
}

class SmsService
{
    private $_data = [];  // Оголошуємо властивість

    public function setRecipient($recipient)
    {
        $this->_data['recipient'] = $recipient;
    }

    public function setMessage($message)
    {
        $this->_data['message'] = $message;
    }

    public function setTime($time)
    {
        $this->_data['time'] = $time;
    }

    public function sendText()
    {
        echo "Sending SMS to: " . $this->_data['recipient'] . PHP_EOL;
        echo "Message: " . $this->_data['message'] . PHP_EOL;
        echo "Scheduled time: " . $this->_data['time'] . PHP_EOL;
        echo "SMS sent!";
    }
}

class SmsAdapter implements NotificationInterface
{
    protected $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function sendNotification()
    {
        $smsClient = new SmsService();
        $smsClient->setRecipient($this->_data['recipient']);
        $smsClient->setMessage($this->_data['message']);
        $smsClient->setTime($this->_data['time']);
        $smsClient->sendText();
    }
}

interface INotificationManager
{
    public function sendNotification($data, $type = '');
}

class NotificationManager implements INotificationManager
{
    public function sendNotification($data, $type = '')
    {
        switch ($type) {
            case "twitter":
                $notification = new TwitterAdapter();
                break;
            case "sms":
                $notification = new SmsAdapter();
                break;
            default:
                echo "error";
                return false;
                break;
        }

        $notification->setData($data);
        $notification->sendNotification();
    }
}

// Example usage

// Send tweet
$array = array(
    "message" => "This is tweet"
);
$a = new NotificationManager();
$a->sendNotification($array, "twitter");

// Send SMS with scheduled time
$array_sms = array(
    "recipient" => "John Doe",
    "message" => "This is an SMS message",
    "time" => "2024-12-02 10:00:00"
);
$a->sendNotification($array_sms, "sms");

?>
