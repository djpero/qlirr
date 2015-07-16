<style>
    {literal}

    h1 {
    font-size: 13pt;
    line-height:1.6pt;
    }
    h5.user {
    font-size: 10pt;
    font-weight:normal;        
    }
    a{color:#333;text-decoration:none;}
    p{font-size:8pt;}        
    table.tr{
    border:1px solid white;        
    font-size:8pt;
    }
    td.tdr{
    border-right:1px solid white;
    text-align:center;
    }
    td.bw{
    background-color:black;
    color:white;
    font-size:11px;
    font-weight:bold;
    }
    td.wb{        
    color:black;
    font-size:11px;
    font-weight:bold;
    border-bottom:1px solid black;
    text-align:right;
    }
    td.txtRight{text-align:right;}
    .blackBD{border:2px solid black;}
    .bdBtm{border-bottom:1px solid #f2f2f2;}
    .bld{font-weight:bold;}
    .noBdBtm{border-bottom:none;}
    .txtCenter{text-align:center;}
    .bgY td{font-size:9px;}
    .topElements{}
    .blueBorder td {border-top: 3px solid #c8eae9;background-color:#e9f7f6;}
    .divTop {padding-top:10px;}
    .footerDown{margin-top:200px;}
    {/literal}
</style>
<table class="topElements">
    <tr>
        <td id="fstCell" height="688px;">



            <table class="tr" width="660px">
                <tr>
                    
                    <td width="355px" class="tdr header"><img src="themes/frontend/gfx/logoNewBlack.png" width="40" height="40" />
                        <p>Returadress: Peydo AB<br> Sveavägen 28-30, 111 34 Stockholm, Sverige</p>
                      
                    </td>
                    
                    <td width="305px">
                        <table cellpadding="2px" style="background-color:#e9f7f6">
                            
                            <tr>
                                <td><b>OCR-nummmer</b></td>
                                <td>{$paymentReference}</td>
                            </tr>
                            <tr>
                                <td><b>Att betala</b></td>
                                <td>{$totalAmountAB} SEK</td>
                            </tr>
                            <tr>
                                <td><b>Bankgiro</b></td>
                                <td>56546 55646456120 9708080</td>
                            </tr>
                            <tr>
                                <td><b>Forfalldatum</b></td>
                                <td>{$dateDue|date_format:"%d.%m.%Y"}</td>
                            </tr>
                            <tr>
                                <td><b>Fakturadatum</b></td>
                                <td>{$smarty.now|date_format:"%d.%m.%Y"}</td>
                            </tr>
                            <tr>
                                <td><b>Fakturanummer</b></td>
                                <td>{$paymentReference}</td>
                            </tr>
                      
                        </table>        
                    </td>
					
                </tr>
				
            </table>

            <table class="tr" >
               
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="260px" class="tdr">            
                       <div style="font-size:14px;font-weight:900;margin-left:50px;">Chargeback fee</div>
                    </td>
                    <td width="260px" >
                        <table cellpadding="3px">
                            <tr>
                                <td colspan="2" height="0px">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td width="75px"></td>
                                <td height="120px" width="260px">
                                    <h5 class="user"><b>{$customer->name} {$customer->surname}</b><br /> {$customerAddress->street}<br /> {$customerAddress->post_code} {$customerAddress->city}<br /> {$customerCountry}</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>    
            </table>
            
            <table>
                <tr>
                    <td height="190px">

                        <table class="tr" width="660px" cellpadding="3" >
                            <tr style="background-color:#e9f7f6;font-size:11px;">
                                <td width="70px"  class="bdBtm bld">Art.nr.</td>
                                <td width="250px" class="bdBtm bld">Vara/tjänst</td>
                                <td width="40px"  class="bdBtm bld">Antal</td>
                                <td width="100px" class="bdBtm bld txtRight">Pris</td>
                                <td class=" bdBtm bld txtRight" width="100px">Moms</td>
				<td class="txtRight bdBtm bld" width="100px">Summa</td>
                               </tr>
                            <tr style="font-size:11px">
                                <td></td>
                                <td><b>{$article_name}{$reminders}</b></td>
                                <td>1 st{$remindersPCS}</td>
                                <td class="txtRight">{$totalAmount}{$remindersValue}</td>
                                <td class="txtRight">{$vat}%</td>
                                <td class="txtRight">{$totalAmountAB}{$remindersTotal}</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                        </table>
                    <div class="divTop" style="background-color:#e9f7f6;">
                        
                        <table width="658px">
                            <tr><td colspan="5"></td></tr>
                            <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Netto</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right">{$totalAmountAN} SEK</td>
                            </tr>
                             <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Moms</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right">{$vatValue} SEK</td>
                            </tr>
                             <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Brutto</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right">{$totalAmountAB} SEK</td>
                            </tr>
                            <tr><td colspan="5"></td></tr>
                            <tr class="blueBorder">
                                <td colspan="5"></td>
                            </tr>
                            
                            <tr class="bordering" style="background-color:white;" border="0" cellpadding="0">
                                <td colspan="3"></td>
             
                                <td style="font-size:13px;text-align:right"><b>Att betala</b></td>        
                                <td class="txtRight" style="font-size:13px;padding-right: 2px;text-align:right"><b>{$totalAmountAB} SEK</b></td>
                            </tr>
                        </table>
                    </div>

                    </td>
                </tr>
            </table>
          
        </td>
    </tr>


</table>
        
<div>   </div><div>   </div><div>   </div><div>   </div><div>   </div>
<p style="text-align:center;margin-bottom: 100px;font-size:9px;color: #666; text-justify: auto">Vid förfallodagen så kan dröjsmålsränta (8.5%) debiteras om fullständig inbetalning på fakturan saknas. 
Vid utebliven eller försenad betalning kandessutom påminnelseavgift tillkomma. Den här fakturan 
är utställd av Peydo AB via fakturatjänsten Billogram. Betalning ska ske till Billogram AB(worry) 
klientmedelskonto (bankgiro 639-8770). Frågor gällande denna faktura ska ställas direkt till utställaren (support@peydo.com).</p>
<div class="footerDown">
    <table class="tr" width="660px" style="color:grey;">
        <tr>
            <td width="20px" class="noBdBtm"></td>
            <td colspan="5" width="640px" class="bdBtm txtCenter">
                {$footerMemo}
            </td>        
        </tr>
        <tr>
            <td width="20px"></td>
            <td width="160px"></td>
            <td width="160px"></td>
            <td colspan="2" width="160px"></td>
            <td width="160px"></td>
        </tr>    
        <tr>
            <td width="20px"></td>
            <td width="160px">Address<br/>
              Peydo AB, <br/>
                Sveavägen 28-30, 111 34 Stockholm</td>
            <td width="160px">Org nr.<br/>
              750123-1612<br/>
                Godkänd for F-skatt<br/>
                </td>
            <td colspan="2" width="160px">Momsref .nr.<br/>
                SE556865448601<br/>
                </td>
            <td width="160px" style="text-align:right;">Telefon och e-post<br/>
                support@peydo.com</td>
        </tr>    
    </table>

</div>


