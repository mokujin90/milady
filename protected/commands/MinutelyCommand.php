<?php

class MinutelyCommand extends CConsoleCommand
{
    public function run($args)
    {
        $this->actionCheckFeedback();
    }

    private function actionCheckFeedback()
    {
        $current_mailbox = array(
            'mailbox' => '{imap.yandex.ru:993/imap/ssl}INBOX',
            'username' => 'iip-support@yandex.ru',
            'password' => 'support2015',
        );
        //echo "START\n";
        $stream = @imap_open($current_mailbox['mailbox'], $current_mailbox['username'], $current_mailbox['password']);
        //echo "START2\n";

        if (!$stream) {
            echo "Could not connect to. Error: " . imap_last_error();
        } else {
            //echo "OPEN\n";
            $since = (int)Setting::get(Setting::FEEDBACK_UPDATE_DATE, 0);
            // Get our messages from the last week
            $emails = imap_search($stream, 'SINCE '. date('d-M-Y',strtotime("-1 day")));
            //echo "date: " .date('d-M-Y',strtotime("-1 day")) . "\n";
            // Instead of searching for this week's messages, you could search
            // for all the messages in your inbox using: $emails = imap_search($stream, 'ALL');
            $maxDate = 0;
            if (!count($emails) || empty($emails)){
                echo "<p>No e-mails found.</p>";
            } else {
                //echo "HAS MAILS\n";
                // If we've got some email IDs, sort them from new to old and show them
                //sort($emails);

                foreach($emails as $email_id){

                    // Fetch the email's overview and show subject, from and date.
                    $overview = imap_fetch_overview($stream,$email_id,0);
                    if(isset($overview[0]->date)){
                        $date = new DateTime($overview[0]->date);
                        if((int)$date->format('U') <= $since){
                            continue;
                        }
                        $maxDate = (int)$date->format('U');
                    } else {
                        continue;
                    }
                    preg_match('/.*<(.*@.*\..*)>.*/', $overview[0]->from,$res);
                    if(isset($res[1])) {
                        if ($dialog = Dialog::model()->findByAttributes(array('email' => $res[1], 'type' => 'feedback'))) {
                            $structure = imap_fetchstructure($stream, $email_id, FT_UID);
                            $part = isset($structure->parts) ? $structure->parts[0] : $structure;
                            $body = imap_fetchbody($stream, imap_msgno($stream, $email_id), "1.1");
                            if(empty($body)){
                                $body = imap_fetchbody($stream, imap_msgno($stream, $email_id), "1");
                            }
                            if($part->encoding == 0) {
                                $body = imap_8bit($body);
                            } else {
                                $body = imap_base64($body);
                            }
                            if(isset($part->parameters) && is_array($part->parameters)){
                                foreach($part->parameters as $param){
                                    if($param->attribute == 'charset'){
                                        if($param->value != 'utf-8' || $param->value != 'UTF-8'){
                                            $body = iconv($param->value, 'utf-8', $body);
                                            break;
                                        }
                                    }
                                }
                            }
                            $message = new Message();
                            $message->dialog_id = $dialog->id;
                            $message->text = $body;
                            $message->save();
                        }
                    }

                }
            }
            if($maxDate){
                Setting::set(Setting::FEEDBACK_UPDATE_DATE, $maxDate);
            }
            // Close our imap stream.
            imap_close($stream);
        }
    }
}