<style type="text/css">

    {literal}
    .wrap{font-size:12px;line-height:1.5px;}
    .boldTD{font-weight:bold; background-color:#eee;}
    .bBgwTxt{background-color:#000;color:#fff;}
    h1{font-size:15px;}

    b{font-weight:bold;}

    .smallGap{font-size:2px;}

    .smallFonts td{font-size:10px;}
    {/literal}
</style>
<table class="wrap"  cellpadding="0" cellspacing="0">
    <tr>
        <td height="400" style="vertical-align:top;">
            <table width="100%">
                <tr>
                    <td>
                        <img src="themes/classic/cms/css/images/logo.png"  />
                        <p></p>
                        <table cellpadding="3" cellspacing="0">
                            <tr>
                                <td width="310px"><h1>Thank you for using Peydo</h1></td>
                                <td width="5px"></td>                            
                            </tr>
                            <tr>
                                <td width="310px">{$headerMemo}</td>
                                <td width="5px"></td>                            
                            </tr>
                        </table>                
                    </td>
                    <td>            
                        <table cellpadding="3" cellspacing="0">
                            <tr>
                                <td colspan="2"><b>Invoice</b></td>                
                            </tr>
                            <tr>
                              <td colspan="2"><p style="font-size:18px">{$invoiceNO}</p></td>
                            </tr>

                            <tr>
                                <td><b>Date of invoice</b></td>
                                <td><b>Place</b></td>
                            </tr>

                            <tr>
                                <td>{$order->date_issued}</td>
                                <td>{$peydoCountry}</td>
                            </tr>

                            <tr>
                                <td><b>Payment reference no</b></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>{$paymentReference}</td>
                                <td></td>
                            </tr>
                        </table>
                      <p></p>
                        <table cellpadding="3" cellspacing="0">
                            <tr>
                                <td colspan="2">{$customer->name} {$customer->surname}<br/>
                                    {$customerAddress->street}<br/>
                                {$customerAddress->post_code} {$customerAddress->city}<br/>
                                    {$customerCountry} </td>                
                            </tr>                                            
                        </table>
                        <p></p>                                    
                    </td>
                </tr>
            </table>
            <p> </p>
            <table style="width:680px" cellpadding="3" cellspacing="0">
                <tr>                    
                    <td width="142" class="boldTD" style="border-bottom:1px solid #ddd;">Date</td>
                    <td width="383" class="boldTD" style="border-bottom:1px solid #ddd;">Name of service</td>
                    <td width="181" class="boldTD" style="border-bottom:1px solid #ddd;text-align:right">Amount (&euro;)</td>                          
                </tr>
                <tr>
                    <td >{$order->date_issued}</td>
                    <td >Agrement no.: {$order->id}<br>Fee</td>
                    <td style="text-align:right">{$itemPrice}<br>{$itemFee}</td>                    
                </tr>
                <tr style="background-color:#eee">
                  <td colspan="2" ><b>Total amount for payment</b></td>
                  <td style="text-align:right"><b>{$totalAmount}</b></td>
                </tr>               
            </table></td>
    </tr>
    <tr>
      <td height="401" style="vertical-align:top;">&nbsp;</td>
    </tr>
    <tr>
        <td>

            <p style="text-align:center;">This bill is issued in two copies, one of which holds the account issuer in its archives.</p>
          <p style="border-bottom:1px solid #333;"></p>
            <p></p>
            <table class="border" cellpadding="3" cellspacing="0">
                <tr>
                    <td width="28%" style="vertical-align:top;"><b>Address</b><br />Peydo, Mobitel Proizvodi d.o.o.<br />Ulica grada Vukovara 269/D<br />10000 Zagreb<br />Republika Hrvatska</td>
                    <td width="25%" style="vertical-align:top;"><b>Contact</b><br />                      
                    Web: www.peydo.com<br />Telefon: 01/4851 399<br />Fax: 01/4851 293</td>
                    <td width="22%" style="vertical-align:top;"><b>OIB</b><br/>98118442026<br/><b>MBS</b><br/>080724466</td>
                    <td width="25%" style="vertical-align:top;"><b>Recipient of the payment</b><br/>Mobitel Proizvodi d.o.o.<br/><b>Privredna Banka Zagreb d.d.</b><br/>HR5423400091110424605</td>
                </tr>
            </table>

        </td>
    </tr>
</table>