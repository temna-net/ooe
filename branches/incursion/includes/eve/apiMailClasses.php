<?php

    class eveMailMessage {
        var $messageID = 0;
        var $senderID = 0;
        var $sentDate = 0;
        var $title = '';
        var $toCorpID = 0;
        var $toCharacterIDs = array();
        var $toListIDs = array();
        var $read = false;

        var $senderName = '';
        var $toCorpName = '';
        var $toCharacterNames = array();

        function eveMailMessage($acc, $mail) {
            $this->messageID = (int)$mail['messageID'];
            $this->senderID = (int)$mail['senderID'];
            $this->sentDate = strtotime((string)$mail['sentDate']) + $acc->timeOffset;
            $this->title = (string)$mail['title'];
            $this->toCorpID = (int)$mail['toCorpOrAllianceID'];
            $this->toCharacterIDs = explode(',', (string)$mail['toCharacterIDs']);
            $this->toListIDs = explode(',', (string)$mail['toListID']);
            $this->read = (int)$mail['read'] > 0;
            if (!isset($this->read) || empty($this->read)) {
                $this->read = true;
            } else {
                $this->read = false;
            }
        }
    }

    class eveMailMessageBody {
        var $messageID = 0;
        var $message = '';

        function eveMailMessageBody($acc, $mail) {
            $this->messageID = (int)$mail['messageID'];
            $this->message = (string)$mail;
        }
    }
?>
