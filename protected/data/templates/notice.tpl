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
                    <td width="375px" class="tdr"><img width="150" height="50" src="/css/images/logo_original.png" /></td>
                    <td width="265px">
                        <table cellpadding="3px">
                            <tr>
                                <td colspan="2"><h1>Poziv na plaćanje</h1></td>                    
                            </tr>
                            <tr>
                                <td><b>Datum</b></td>
                                <td><b>Poziv na broj</b></td>
                            </tr>
                            <tr>
                                <td>{$dateIssued}</td>
                                <td>{$paymentPrefix} {$paymentReference}</td>
                            </tr>
                        </table>        
                    </td>
                </tr>    
            </table>

            <table class="tr" >
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="300px" class="tdr"><h1>Hvala što ste koristili Peydo!</h1></td>
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
                                    <h5 class="user">{$customerFullname}<br /> {$customerAddress}<br /> {$customerPostcode} {$customerCity}<br /> {$customerCountry}</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>    
            </table>

            <table class="tr">
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="375px" class="tdr"></td>
                    <td width="265px">
                        <table cellpadding="5px">
                            <tr>
                                <td style="padding" height="70px">
                                    <table cellpadding="4px" class="blackBD">
                                        <tr>
                                            <td class="bw">Datum dospijeća:</td>
                                            <td class="wb">{$dateDue}</td>
                                        </tr>
                                        <tr>
                                            <td class="bw">Ukupno za platiti:</td>
                                            <td class="wb">{$totalAmount} HRK</td>
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
                                <td width="80px" class="bdBtm bld">Datum</td>
                                <td width="280px" class="bdBtm bld">Usluga</td>

                                <td width="210px" class="bdBtm bld"></td>
                                <td class="txtRight bdBtm bld" width="70px">Iznos (HRK)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{$order.time_created|date_format:"%d.%m.%Y."}</td>
                                <td>{$order.service.service_name}</td>

                                <td></td>
                                <td class="txtRight">{$price}</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Ukupno</b></td>
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
                    <td width="160px">Adresa<br/>
                        Peydo, Mobitel Proizvodi d.o.o.<br/>
                        Ulica grada Vukovara 269/D<br/>
                        10000 Zagreb<br/>
                        Republika Hrvatska</td>
                    <td width="160px">Kontakt<br/>
                        Web stranica: www.peydo.com<br/>
                        Telefon: 01/4851 399<br/>
                        Fax: 01/4851 293</td>
                    <td colspan="2" width="160px">OIB<br/>
                        98118442026<br/>
                        MBS<br/>
                        080724466</td>
                    <td width="160px">Primatelj plaćanja<br/>
                        Mobitel Proizvodi d.o.o.<br/>
                        Privredna Banka Zagreb d.d. HR5423400091110424605</td>
                </tr>    
            </table>


        </td>
    </tr>


    <tr>
        <td id="sndCell" height="330px" >

            <table class="bgY" cellpadding="2px" cellspacing="0">
                <tr>
                    <td colspan="9" height="10px"  style="border-bottom:1px dashed grey;"></td>
                </tr>
                <tr>
                    <td colspan="8" height="28px" width="483px"  style="border-right:1px dashed grey;"></td>
                    <td></td>
                </tr>    
                <tr height="20px">        
                    <td width="148px">
                        <table width="145px" >
                            <tr><td colspan="2"></td></tr>
                            <tr>
                                <td width="5px" ></td>
                                <td width="130px" height="50px">{$customerFullname}<br/>
                                    {$customerAddress}, {$customerCity}</td>
                            </tr>
                            <tr><td colspan="2" height="45px"></td></tr>
                            <tr>
                                <td width="5px" ></td>
                                <td width="130px" height="50px" >{$recipientFull}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="20px"></td>
                    <td width="70px">
                        <table>
                            <tr>                    
                                <td height="92px"></td>
                            </tr>
                            <tr>                    
                                <td width="40px">{$paymentPrefix}</td>
                            </tr>
                            <tr>                    
                                <td height="20px"></td>
                            </tr>
                            <tr>                    
                                <td width="40px">OTLC</td>
                            </tr>
                        </table>
                    </td>

                    <td width="234px">
                        <table>
                            <tr>
                                <td width="5px"></td>
                                <td>HRK</td>
                            </tr>
                            <tr>
                                <td width="5px"></td>
                                <td height="55px"></td>
                            </tr>
                            <tr>
                                <td width="5px"></td>
                                <td>{$bankAccountNo}</td>
                            </tr>
                            <tr>
                                <td width="5px"></td>
                                <td height="16px"></td>
                            </tr>
                            <tr>
                                <td height="15px" colspan="2">{$paymentReference}</td>
                            </tr>                
                            <tr>
                                <td width="5px"></td>
                                <td>
                                    <table cellpadding="3px">
                                        <tr>
                                            <td width="20px"></td>
                                            <td width="210px" height="50px">{$paymentDescription}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="11px" style="border-right:1px dashed grey;"></td>
                    <td width="12px"></td>
                    <td width="177px">
                        <table width="170px">
                            <tr><td height="22px">{$totalAmount} HRK</td></tr>
                            <tr>                    
                                <td height="10px">{$customerFullname}</td>
                            </tr>
                            <tr><td height="36px"></td></tr>                
                            <tr>                    
                                <td height="10px">{$bankAccountNo}</td>
                            </tr>
                            <tr><td height="16px"></td></tr>                
                            <tr>                    
                                <td height="10px">{$paymentPrefix} {$paymentReference}</td>
                            </tr>
                            <tr><td height="12px"></td></tr>                
                            <tr>                    
                                <td height="150px">{$paymentDescription}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
</table>