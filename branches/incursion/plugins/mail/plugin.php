<?php

    class mail extends Plugin {
        var $name = 'Mail';
        var $level = 1;

        function mail($db, $site) {
            $this->Plugin($db, $site);

            $this->site->plugins['mainmenu']->addLink('main', 'Mail', '?module=mail', 'icon94_08');
        }

        function getContent() {
            $this->site->character->loadMail();

            $mail = objectToArray($this->site->character->mail, array('DBManager', 'eveDB'));

            $message = false;
            if (isset($_GET['view'])) {
                foreach ($this->site->character->mail as $m) {
                    if ($m->messageID == $_GET['view']) {
                        $message = objectToArray($this->site->character->getMailMessage($m), array('DBManager', 'eveDB'));
                    }
                }
            }

            return $this->render('mail', array('mail' => $mail, 'message' => $message));
        }

        function getContentJson() {
            $this->site->character->loadMail();
            $message = false;
            if (isset($_GET['view'])) {
                foreach ($this->site->character->mail as $m) {
                    if ($m->messageID == $_GET['view']) {
                        $message = objectToArray($this->site->character->getMailMessage($m), array('DBManager', 'eveDB'));
                        $message['headers']['sentDate'] = date('d M Y H:i', $message['headers']['sentDate']);
                    }
                }
            }
            return json_encode($message);
        }
    }

?>