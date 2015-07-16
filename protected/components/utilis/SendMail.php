<?php
    class SendMail {
        public function mailsend($to, $from, $subject, $message, $attachments = null, $user, $code = null){

            $emailLog = new EmailLogs;
            $emailLog->user_id = $user->id;
            $emailLog->email = $to;
            $emailLog->subject = $subject;
            $emailLog->sender_email = $from;
            $emailLog->content = $message;
            $emailLog->code = $code;
            $emailLog->save();

            $mail=Yii::app()->Smtpmail;
            $mail->SetFrom($from, 'Qlirr');
            $mail->Subject = $subject;
            $mail->CharSet = "UTF-8";
            $mail->MsgHTML($message);
            //$mail->ClearAddresses();
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
            if($attachments != null) {
                foreach($attachments as $attachment){
                    $mail->AddAttachment($attachment["path"], $attachment['name']);
                }
            }

            $mail->AddAddress($to, "");
            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
        }
    }
?>
