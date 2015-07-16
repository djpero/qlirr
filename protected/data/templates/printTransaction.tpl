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
<div></div>
    <table>
        <tr>
            <td width="46" ></td>
            <td><img src="themes/frontend/gfx/login_logo.png" width="90"/></td>
            
            <td>
                <table style="padding:2px">
                    <tr>
                        <td style="font-size:16px;padding-bottom: 6px;"><b>History print</b></td>
                    </tr>
                </table>
                <table cellpadding="3px" style="background-color:#e9f7f6">
                    <tr>
                        <td><b>Skapad datum</b></td>
                        <td>{$smarty.now|date_format:"%Y.%m.%d"}</td>
                    </tr>
                    <tr>
                        <td><b>Total Betalning</b></td>
                        <td>{$totalTotal} SEK</td>
                    </tr>
                </table> 
            </td>
        </tr>
        
    </table>
<div></div>
    <table >

        <tr>
            <td width="293"></td>
    
            <td><table cellspacing="5">
                    
        <tr>
            <td><b>{$shop->name}</b></td>
        </tr>            
                    
        <tr>
            <td><b>{$shopAddress->street}</b></td>
        </tr>
        <tr>
            <td><b>{$shopAddress->post_code} {$shopAddress->city}</b></td>
        </tr>

    </table></td>
        </tr>
    </table>
    
        <div></div>
        <div></div>

        <table>
            <tr>
                <td height="660px">
                    <table cellpadding="5" >
                        <tr>
                            <td></td>
                        </tr>
                        <tr style="background-color:#e9f7f6;">
                            <td width="40" style="background-color:white;"></td>
                            <td width="160" style="font-size:15px;font-weight:800"><b>No.</b></td>
                            <td width="160" align="left"  style="font-size:15px;font-weight:800"><b>Datum</b></td>
                            <td width="160" align="center"  style="font-size:15px;font-weight:800"><b>Ref. nummer</b></td>
                            <td width="160" align="right"  style="font-size:15px;font-weight:800"><b>Pris</b></td>
                  
                        </tr>

                        <tr>
                            <td width="40"></td>
                            <td>{$nummer}</td>
                            <td align="left">{$date}</td>
                            <td align="center">{$code}</td>
                            <td align="right">{$total}</td>
                        </tr>
                        <tr>
                            <td width="40"></td>
                            <td colspan="4" align="right" style="border-top:1px solid black;font-size:13px"></td>
                            <td width="30"></td>
                        </tr>
                        <tr>
                            <td width="40"></td>
                            <td colspan="4" align="right" style="font-size:15px;"><b>Total Betalting: {$totalTotal} kr</b></td>
                            <td width="30"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> 

            

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
              556865-4486<br/>
                Godkänd for F-skatt<br/>
                </td>
            <td colspan="2" width="177px">Momsref .nr.<br/>
                SE556865448601<br/>
                </td>
            <td width="177px" style="text-align:left;">E-post<br/>
                support@qlirr.com</td>
        </tr>   
    </table>

</div>


