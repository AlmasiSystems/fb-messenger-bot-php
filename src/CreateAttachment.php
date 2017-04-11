<?php

namespace FbMessengerBot;

class CreateAttachment {
    public static function create($type, $messageText, $answerText)
    {
        return CreateAttachment::populate($type, $messageText, $answerText);
    }

    public static function populate($type, $messageText, $answerText)
    {
        $message = new Message();
        $message->setText($messageText);

        $answer = CreateAttachment::answer($type, $answerText);

        $item = new Item();
        $item->setMessage($message);
        $item->setAnswer($answer);

        return $item;
    }

    public static function answer($type, $answerText)
    {
        if ($type != 'text') {
            $attachment = new Attachment();
            $attachment->setType($type);
            $attachment->setPayload([
                'url' => $answerText
            ]);

            $answer = new Answer();
            $answer->setAttachment($attachment);
        } else {
            $answer = new Answer();
            $answer->setText($answerText);
        }

        return $answer;
    }
}
