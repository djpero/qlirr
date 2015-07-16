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
    .trs{
        
        
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
    .ocrFont {
    font-family:ocrb;
    font-size:12px;
    }
    .classicFont {
     font-size:11px;   
    }
    {/literal}
</style>


<div></div>
    <table>
        <tr>
            <td width="10"></td>
            <td><img style="margin-left:20px;margin-top:20px" src="themes/frontend/gfx/logoNewBlack.png" width="70" /></td>
            
            <td align="right"></td>
        </tr> 
        
    </table>
<div></div>
    <table >
        <tr>
            <td width="170"></td>
            <td width="170"></td>
            <td width="300" style="font-size:14px;"><b>FAKTURELIST</b></td> 
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><table cellspacing="5">
                    
        <tr>
            <td>Created date:</td>
            <td><b>{$shop->date_signed}</b></td>
        </tr>            
                    
        <tr>
            <td>Owner:</td>
            <td><b>{$shop->owner1}</b></td>
        </tr>
        <tr>
     
            <td>Shop name:</td>
            <td><b>{$shop->name}</b></td>
        </tr>
        <tr>
         
            <td>Shop Client ID:</td>
            <td><b>{$shop->shop_id}</b></td>
        </tr>
        <tr>
         
            <td>Bank name:</td>
            <td><b>{$bank->full_name}</b></td>
        </tr>
        <tr>
      
            <td>Clearing/account: </td>
            <td><b>{$shop->bank_clearing}/{$shop->bank_account}</b></td>
        </tr>
        <tr>
         
            <td>Swift/IBAN: </td>
            <td><b>{$shop->bank_swift}/{$shop->bank_iban}</b></td>
        </tr>
    </table></td>
        </tr>
    </table>
    
        <div></div>
        <div></div>

        <table>
            <tr>
                <td height="590px">
                    <table cellspacing="9" >
                        <tr>
                            <td width="30"></td>
                            <td colspan="3" width="610" style="font-size:15px" align="center"><b>Specification</b></td>
                            <td width="30"></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="90" style="font-size:12px"><b>No</b></td>
                            <td width="390" align="center"  style="font-size:12px"><b>CODE</b></td>
                            <td width="130" align="right"  style="font-size:12px"><b>Amount</b></td>
                            <td width="30"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3"  style="border-top:1px solid black;font-size:13px"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td>{$idnr}</td>
                            <td align="center">{$ordersID}</td>
                            <td align="right">{$prices}</td>
                            <td width="30"></td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td colspan="3" align="right" style="border-top:1px solid black;font-size:13px"><b>TOTAL: {$pricesT} kr</b></td>
                            <td width="30"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> 

            
<p style="text-align:center;margin-bottom: 100px;font-size:9px;color: #666; text-justify: auto">Vid förfallodagen så kan dröjsmålsränta (8.5%) debiteras om fullständig inbetalning på fakturan saknas. 
Vid utebliven eller försenad betalning kandessutom påminnelseavgift tillkomma. Den här fakturan 
är utställd av Qlirr AB via fakturatjänsten Billogram. Betalning ska ske till Billogram AB(worry) 
klientmedelskonto (bankgiro 639-8770). Frågor gällande denna faktura ska ställas direkt till utställaren (support@Qlirr.com).</p>
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
            <td width="40px"></td>
            <td width="177px">Address<br/>
              QLIRR AB, <br/>
                Björkrisvägen 4 D, 702 34 <br>Örebro</td>
            <td width="177px">Org nr.<br/>
              556983-6140<br/>
                Godkänd for F-skatt<br/>
                </td>
            <td colspan="2" width="177px">Momsref .nr.<br/>
                SE556983614001<br/>
                </td>
            <td width="177px" style="text-align:left;">E-post<br/>
                support@qlirr.com</td>
        </tr>      
    </table>

</div>


