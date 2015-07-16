<?php
    class GeneralFunctions {
        public static function convertLetters($content)
        {
            $nasaSlova = array(
                'č',
                'ć',
                'ž',
                'š',
                'đ',
                'Č',
                'Ć',
                'Ž',
                'Š',
                'Ð', 
                ' ',
                '?',
                '!',
                ',',
                '.',
                '$',
                '#',
                ':',
                ';',
                '"',
                '\'',
                '<',
                '>',
                '*',
                '&',
                '^',
                '%',
                '@',
                '(',
                ')',
                '=',
            );
            $slova = array(
                'c',
                'c',
                'z',
                's',
                'dj',
                'C',
                'C',
                'Z',
                'S',
                'Dj',
                '-',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            );

            return ucfirst(str_replace($nasaSlova, $slova, $content));
        }

        public static function strtolower_utf8($inputString) {
            $outputString = utf8_decode($inputString);
            $outputString = strtolower($outputString);
            $outputString = utf8_encode($outputString);

            return $outputString;
        }

        function getElapsedTime($eventTime)
        {
            $totaldelay = time() - strtotime($eventTime);

            if($totaldelay <= 0)
            {
                return '';
            }
            else
            {
                if($days=floor($totaldelay/86400))
                {
                    $totaldelay = $totaldelay % 86400;
                    return $days.' dana.';
                }
                if($hours=floor($totaldelay/3600))
                {
                    $totaldelay = $totaldelay % 3600;
                    return $hours.' sata.';
                }
                if($minutes=floor($totaldelay/60))
                {
                    $totaldelay = $totaldelay % 60;
                    return $minutes.' minuta';
                }
                if($seconds=floor($totaldelay/1))
                {
                    $totaldelay = $totaldelay % 1;
                    return $seconds.' sekundi';
                }
            }
        }

        public function randomCode($length, $type)
        {   
            if ($type=='n') {
                $chars = "0123456789";
                return substr(str_shuffle($chars),0, $length); 
            } else {
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                return substr(str_shuffle($chars),0, $length); 
            }
            
        }

        public function mb_ucwords($str)
        {
            $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
            return ($str);
        }

        public function OnlyNumbers($string) {
            return preg_replace("/[^0-9]/","",$string);
        }

        /**
        * Upload document by making object of uploaded file with
        * CUploadedFile::getInstance..
        * 
        * @param mixed $file object CUploadedFile::getInstance...
        * @param integer $user_id
        * @param integer $document_type defaults to verification
        * @param integer $order_id defaults to null
        * @param integer $tracking_number defaults to null
        */
        public function addDocument($file, $user_id, $document_type=1, $order_id=null, $tracking_number=null, $date_delivered=null)
        {
            // proceed if the files have been set
            if (isset($file))
            {
                $model = new Documents;
                $model->name = $file->name;
                $model->user_id = $user_id;
                $model->documentType_id = $document_type;
                $model->order_id = $order_id;
                $model->tracking_number = $tracking_number;
                $model->date_sent = date('Y-m-d H:i:s');
                $model->date_delivered = $date_delivered;

                if($file->saveAs(Yii::getPathOfAlias('application').'/documents/'.$document_type.'/'.$user_id.'/'.$file->name))
                    $model->save();
                return true;
            } else return false;
        }

        public function makeParamsForNoticePDF($memoHeader, $memoFooter, $notice, $settings, $customerAddress) {
            return array(

                'headerMemo' => $memoHeader,
                'footerMemo' => $memoFooter,
                'dateIssued' => date('d.m.Y.', strtotime($notice->date_issued)),
                'dateDue' => date('d.m.Y.', strtotime($notice->date_due)),

                'recipientShort' => $settings['platformCompanyName'],
                'recipientFull' => $settings['platformCompanyName'] . ', ' . $settings['platformCompanyAddress'],
                'bankAccountNo' => $settings['platformBankAccountIBAN'],
                'paymentPrefix' => $notice->payment_reference_model,
                'paymentReference' => $notice->payment_reference,

                'paymentDescription' => $notice->service->service_name,
                'totalAmount' => number_format($notice->total_amount,2),
                'currencyCode' =>  $notice->currency_code,
                'minAmount' => number_format($notice->min_amount, 2),
                'customerFullname' => $notice->user->name . ' ' . $notice->user->surname,
                'customerIdNumber' => $notice->user->id_number,
                'customerAddress' => $customerAddress->street,
                'customerPostcode' => $customerAddress->post_code,
                'customerCity' => $customerAddress->city,
                'customerCountry' => $customerAddress->country->country_name
            );
        }

        public function displayImage($id, $type, $file = false)
        {
            if ($file)
            {
                $path =  Yii::getPathOfAlias('application.documents'). '/'.$type.'/'.$id.'/';
                if (file_exists($path. $file))
                {
                    header('Content-type: image');
                    header('Content-Disposition: inline; filename="' . $file . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($path.$file));
                    header('Accept-Ranges: bytes');

                    @readfile($path.$file);
                } else {
                    echo "none";
                }
            }
        }

        public function displayImages($id, $type, $file = false)
        {
            if ($file)
            {
                $path =  Yii::getPathOfAlias('application.documents'). '/'.$type.'/';
                if (file_exists($path. $file))
                {
                    header('Content-type: image');
                    header('Content-Disposition: inline; filename="' . $file . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($path.$file));
                    header('Accept-Ranges: bytes');

                    @readfile($path.$file);
                } else {
                    echo "none";
                }
            }
        }

        public function rejectOffer($model, $reason = null) {
            $orderHistory = new OrdersHistory();
            $orderHistory->attributes = $model->attributes;
            $orderHistory->order_id = $model->id;
            $orderHistory->change_comment = "order_history.status_changed,{$model->orderStatus->name},Offer rejected";
            $orderHistory->change_type = 1;
            $orderHistory->update_time = date('Y-m-d H:i:s');
            $orderHistory->save();

            $model->orderStatus_id = 3;

            if(!empty($reason))
                $model->reason = $reason;
            else
                $model->reason = Yii::t("frontend", "reason_not_specified");

            if($model->save()) {                    
                $smarty = Yii::app()->viewRenderer->getSmarty();
                $emailTemplateSeller = EmailTemplateDao::model()->findByPk(9); 
                $emailTemplateBuyer = EmailTemplateDao::model()->findByPk(10);

                $userCredit = UsersDao::model()->findByPk($model->buyer_id);
                $userCredit->creditLimit_remaining = $userCredit->creditLimit_remaining+$model->total_amount;
                $userCredit->creditLimit_reserved = $userCredit->creditLimit_reserved-$model->total_amount;
                $userCredit->save(); 

                //$buyer = Users::model()->findByPk($model->buyer_id);
                $smarty->assign('seller', $model->seller);
                $smarty->assign('buyer', $model->buyer);
                $smarty->assign('order', $model);

                $codeBuyer = GeneralFunctions::randomCode(8);
                $smarty->assign('code', $codeBuyer);
                $contentBuyer = $smarty->fetch('eval:' . $emailTemplateBuyer->eContent);

                SendMail::mailsend($model->buyer->email, 
                    Yii::app()->params['adminEmail'], 
                    $emailTemplateBuyer->subject, 
                    $contentBuyer, null, $model->buyer, $codeBuyer);

                $codeSeller = GeneralFunctions::randomCode(8);
                $smarty->assign('code', $codeSeller);
                $contentSeller = $smarty->fetch('eval:' . $emailTemplateSeller->eContent);

                if(isset($model->seller->email))
                    SendMail::mailsend($model->seller->email, 
                        Yii::app()->params['adminEmail'], 
                        $emailTemplateSeller->subject, 
                        $contentSeller, null, $model->seller, $codeSeller);

                return true;
            }

            return false;
        }

        /**
        * Returns link for page with specific page_type and by country_id.
        * 
        * @param integer $pageType
        * @param integer $country_id
        */
        public function pageLink($pageType, $country_id)
        {
            $model = Pages::model()->findByAttributes(array('pageType_id'=>$pageType, 'country_id'=>$country_id)); 

            return CHtml::link($model->subject, array('/pages/view', 'slug'=>$model->slug));
        }
    }
?>
