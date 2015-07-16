<style>
    {literal}
    <style>
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
    .bdBtm{border-bottom:1px solid black;}
    .bld{font-weight:bold;}
    .noBdBtm{border-bottom:none;}
    .txtCenter{text-align:center;}
    .bgY td{font-size:9px;}
    .topElements{}

    {/literal}
</style>
<table class="topElements">
    <tr>
        <td id="fstCell" height="688px;">



            <table class="tr" width="660px">
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="375px" class="tdr"><img src="themes/classic/cms/css/images/logo.png" /></td>
                    <td width="265px">
                        <table cellpadding="3px">
                            <tr>
                                <td colspan="2"><h1>Payment notice</h1></td>                    
                            </tr>
                            <tr>
                                <td><b>Date</b></td>
                                <td><b>Notice reference</b></td>
                            </tr>
                            <tr>
                                <td>{$smarty.now|date_format:"%d.%m.%Y"}</td>
                                <td>{$paymentReference}</td>
                            </tr>
                        </table>        
                    </td>
                </tr>    
            </table>

            <table class="tr" >
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="300px" class="tdr"><h1>Thank you for using Peydo!</h1></td>
                    <td width="340px"></td>
                </tr>
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="300px" class="tdr">            
                        <p>{$headerMemo}</p>
                    </td>
                    <td width="340px" >
                        <table cellpadding="3px">
                            <tr><td colspan="2" height="50px"></td></tr>
                            <tr>
                                <td width="75px"></td>
                                <td height="120px" width="260px">
                                    <h5 class="user">{$customer->name} {$customer->surname}<br /> {$customerAddress->street}<br /> {$customerAddress->post_code} {$customerAddress->city}<br /> {$customerCountry}</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>    
            </table>

            <table class="tr">
                <tr>
                    <td width="19" class="tdr"></td>
                    <td width="360" class="tdr"></td>
                    <td width="273">
                        <table cellpadding="5px">
                            <tr>
                                <td style="padding" height="70px">
                                    <table cellpadding="4px" class="blackBD">
                                        <tr>
                                            <td class="bw">Due date:</td>
                                            <td class="wb">{$dateDue|date_format:"%d.%m.%Y"}</td>
                                        </tr>
                                        <tr>
                                            <td class="bw">Total for payment:</td>
                                            <td class="wb">{$totalAmount} &euro;</td>
                                        </tr>


                                    </table>
                                </td>                    
                            </tr>                
                        </table>        
                    </td>
                </tr>    
            </table>

            <table>
                <tr>
                    <td height="190px">

                        <table class="tr" width="660px">
                            <tr>
                                <td width="20px" class="noBdBtm"></td>
                                <td width="80px" class="bdBtm bld">Date</td>
                                <td width="280px" class="bdBtm bld">Service</td>

                                <td width="210px" class="bdBtm bld"></td>
                                <td class="txtRight bdBtm bld" width="70px">Amount (&euro;)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{$order.time_created|date_format:"%d.%m.%Y."}</td>
                                <td>Chargeback fee for not delivering item</td>

                                <td></td>
                                <td class="txtRight">{$totalAmount}</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Total</b></td>
                                <td></td>
                                <td></td>        
                                <td class="txtRight"><b>{$totalAmount}</b></td>
                            </tr>
                        </table>


                    </td>
                </tr>
            </table>

            <table class="tr" width="660px">
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
                        Björkrisvägen 4 D, 702 34 Örebro</td>
                    <td width="160px">Contact<br/>
                      Web: www.peydo.com<br/>
                        Phone: 01/4851 399<br/>
                        Fax: 01/4851 293</td>
                    <td colspan="2" width="160px">OIB<br/>
                        98118442026<br/>
                        MBS<br/>
                        080724466</td>
                    <td width="160px">Payment receiver<br/>
                        Peydo AB<br/>
                        Privredna Banka Zagreb d.d. HR5423400091110424605</td>
                </tr>    
            </table>


        </td>
    </tr>


                        </table>
