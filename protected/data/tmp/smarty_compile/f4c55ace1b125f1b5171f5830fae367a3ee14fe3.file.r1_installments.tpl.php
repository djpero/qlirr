<?php /* Smarty version Smarty-3.1.13, created on 2013-12-20 17:15:18
         compiled from "/ws/test/peydo/code/protected/data/templates/r1_installments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153631209752b46a6ba8d230-79220553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4c55ace1b125f1b5171f5830fae367a3ee14fe3' => 
    array (
      0 => '/ws/test/peydo/code/protected/data/templates/r1_installments.tpl',
      1 => 1387556098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153631209752b46a6ba8d230-79220553',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b46a6bb0a2a9_48584474',
  'variables' => 
  array (
    'headerMemo' => 0,
    'invoiceNO' => 0,
    'order' => 0,
    'peydoCountry' => 0,
    'paymentReference' => 0,
    'customer' => 0,
    'customerAddress' => 0,
    'customerCountry' => 0,
    'itemPrice' => 0,
    'itemFee' => 0,
    'totalAmount' => 0,
    'installment_no' => 0,
    'installment_date' => 0,
    'installment_amount' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b46a6bb0a2a9_48584474')) {function content_52b46a6bb0a2a9_48584474($_smarty_tpl) {?><style type="text/css">

    
    .wrap{font-size:12px;line-height:1.5px;}
    .boldTD{font-weight:bold; background-color:#eee;}
    .bBgwTxt{background-color:#000;color:#fff;}
    h1{font-size:15px;}

    b{font-weight:bold;}

    .smallGap{font-size:2px;}

    .smallFonts td{font-size:10px;}
    
</style>
<table class="wrap"  cellpadding="0" cellspacing="0">
    <tr>
        <td height="885" style="vertical-align:top;">
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
                                <td width="310px"><?php echo $_smarty_tpl->tpl_vars['headerMemo']->value;?>
</td>
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
                              <td colspan="2"><p style="font-size:18px"><?php echo $_smarty_tpl->tpl_vars['invoiceNO']->value;?>
</p></td>
                            </tr>

                            <tr>
                                <td><b>Date of invoice</b></td>
                                <td><b>Place</b></td>
                            </tr>

                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->date_issued;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['peydoCountry']->value;?>
</td>
                            </tr>

                            <tr>
                                <td><b>Payment reference no</b></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['paymentReference']->value;?>
</td>
                                <td></td>
                            </tr>
                        </table>
                      <p></p>
                        <table cellpadding="3" cellspacing="0">
                            <tr>
                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['customer']->value->name;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->surname;?>
<br/>
                                    <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->street;?>
<br/>
                                <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->post_code;?>
 <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->city;?>
<br/>
                                    <?php echo $_smarty_tpl->tpl_vars['customerCountry']->value;?>
 </td>                
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
                    <td ><?php echo $_smarty_tpl->tpl_vars['order']->value->date_issued;?>
</td>
                    <td >Agrement no.: <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
<br>Fee</td>
                    <td style="text-align:right"><?php echo $_smarty_tpl->tpl_vars['itemPrice']->value;?>
<br><?php echo $_smarty_tpl->tpl_vars['itemFee']->value;?>
</td>                    
                </tr>
                <tr style="background-color:#eee">
                  <td colspan="2" ><b>Total amount for payment</b></td>
                  <td style="text-align:right"><b><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
</b></td>
                </tr>               
            </table>
            <div style="height:50px;"></div>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr  style="background-color:#eee; font-weight: bold;">
                <td width="52">In. no.</td>
                <td width="148">Installment date</td>
                <td width="100" style="text-align:right">Amount</td>
              </tr>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['installment_no']->value;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['installment_date']->value;?>
</td>
                <td style="text-align:right"><?php echo $_smarty_tpl->tpl_vars['installment_amount']->value;?>
</td>
              </tr>
          
            </table>
            <p>&nbsp;</p></td>
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
</table><?php }} ?>