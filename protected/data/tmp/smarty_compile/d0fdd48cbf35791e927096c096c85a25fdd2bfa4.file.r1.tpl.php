<?php /* Smarty version Smarty-3.1.13, created on 2013-10-11 15:10:55
         compiled from "/ws/prod/peydo/code/protected/data/templates/r1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6600268715257f8dfd13e06-67951004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0fdd48cbf35791e927096c096c85a25fdd2bfa4' => 
    array (
      0 => '/ws/prod/peydo/code/protected/data/templates/r1.tpl',
      1 => 1377042301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6600268715257f8dfd13e06-67951004',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'headerMemo' => 0,
    'dateIssued' => 0,
    'paymentReference' => 0,
    'customerFullname' => 0,
    'customerAddress' => 0,
    'customerPostcode' => 0,
    'customerCity' => 0,
    'customerCountry' => 0,
    'order' => 0,
    'price' => 0,
    'vat' => 0,
    'priceNet' => 0,
    'priceVat' => 0,
    'totalAmount' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5257f8dfd5e185_64319652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5257f8dfd5e185_64319652')) {function content_5257f8dfd5e185_64319652($_smarty_tpl) {?><style type="text/css">
    
    .wrap{font-size:12px;line-height:1.5px;}
    .boldTD{font-weight:bold;}
    .bBgwTxt{background-color:#000;color:#fff;}
    h1{font-size:15px;}

    b{font-weight:bold;}

    .smallGap{font-size:2px;}

    .smallFonts td{font-size:10px;}
    
</style>
<table class="wrap"  cellpadding="0" cellspacing="0">
    <tr>
        <td height="800px" style="vertical-align:top;">
            <table width="660px">
                <tr>
                    <td>
                        <img src="/css/images/logo_original.png"  width="150" height="50" />
                        <p></p>
                        <table cellpadding="3" cellspacing="0">
                            <tr>
                                <td width="310px"><h1>Hvala sto ste koristili Peydo</h1></td>
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
                                <td colspan="2"><b>R-1 Račun</b></td>                
                            </tr>

                            <tr>
                                <td><b>Datum izdavanja</b></td>
                                <td><b>Mjesto izdavanja</b></td>
                            </tr>

                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['dateIssued']->value;?>
</td>
                                <td>Zagreb</td>
                            </tr>

                            <tr>
                                <td><b>Broj računa</b></td>
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
                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['customerFullname']->value;?>
<br/>
                                    <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
<br/>
                                    <?php echo $_smarty_tpl->tpl_vars['customerPostcode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['customerCity']->value;?>
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
            <table width="660px"  cellpadding="3" cellspacing="0">
                <tr>                    
                    <td width="33%" class="boldTD" style="border-bottom:1px solid #ddd;">Naziv usluge</td>
                    <td width="33%" class="boldTD" style="border-bottom:1px solid #ddd;">Obračun PDV-a</td>
                    <td width="33%" class="boldTD" style="border-bottom:1px solid #ddd;">Iznos (HRK)</td>                          
                </tr>
                <tr>
                    <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['service']['service_name'];?>
</td>
                    <td ></td>
                    <td ><?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</td>                    
                </tr>
                <tr>
                    <td ></td>
                    <td >Osnovica za PDV (<?php echo $_smarty_tpl->tpl_vars['vat']->value;?>
%)</td>
                    <td ><?php echo $_smarty_tpl->tpl_vars['priceNet']->value;?>
</td>                    
                </tr>
                <tr>
                    <td ></td>
                    <td >Iznos PDV-a (<?php echo $_smarty_tpl->tpl_vars['vat']->value;?>
%)</td>
                    <td ><?php echo $_smarty_tpl->tpl_vars['priceVat']->value;?>
</td>                    
                </tr>               
            </table>
            <p style="border-bottom:1px solid #ddd;font-size:1px;"></p>
            <table width="660px"  cellpadding="3" cellspacing="0">                
                <tr >                
                    <td width="66%" colspan="2" class="boldTD">Ukupno za uplatit</td>    
                    <td width="33%" class="boldTD"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
</td>        
                </tr>
            </table>
            <p style="margin-bottom:30px;"><b></b></p>            
        </td>
    </tr>
    <tr>
        <td>

            <p style="text-align:center;">Ovaj račun je izdan u dva istovjetna primjerka, od kojih jedan zadržava izdavatelj računa u svojoj pismohrani.</p>
            <p style="border-bottom:1px solid #333;"></p>
            <p></p>
            <table class="border" cellpadding="3" cellspacing="0">
                <tr>
                    <td width="28%" style="vertical-align:top;"><b>Adresa</b><br />Peydo, Mobitel Proizvodi d.o.o.<br />Ulica grada Vukovara 269/D<br />10000 Zagreb<br />Republika Hrvatska</td>
                    <td width="25%" style="vertical-align:top;"><b>Kontakt</b><br />Web stranica: www.peydo.com<br />Telefon: 01/4851 399<br />Fax: 01/4851 293</td>
                    <td width="22%" style="vertical-align:top;"><b>OIB</b><br/>98118442026<br/><b>MBS</b><br/>080724466</td>
                    <td width="25%" style="vertical-align:top;"><b>Primatelj plaćanja</b><br/>Mobitel Proizvodi d.o.o.<br/><b>Privredna Banka Zagreb d.d.</b><br/>HR5423400091110424605</td>
                </tr>
            </table>

        </td>
    </tr>
</table><?php }} ?>