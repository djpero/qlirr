<?php /* Smarty version Smarty-3.1.13, created on 2014-10-03 12:12:55
         compiled from "/ws/prod/qlirr/code/protected/data/templates/r1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1048685490542e76a74457f6-70435825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c82b02a8d2e18df7ba0ad04e730380a5c420425' => 
    array (
      0 => '/ws/prod/qlirr/code/protected/data/templates/r1.tpl',
      1 => 1411042861,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1048685490542e76a74457f6-70435825',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'paymentReference' => 0,
    'totalAmount' => 0,
    'dateDue' => 0,
    'customer' => 0,
    'customerAddressBuyer' => 0,
    'customerCountry' => 0,
    'article_name' => 0,
    'reminders' => 0,
    'remindersPCS' => 0,
    'remindersValue' => 0,
    'remindersVAT' => 0,
    'remindersTotal' => 0,
    'footerMemo' => 0,
    'wholeAmount' => 0,
    'decimalAmount' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_542e76a74e6818_97256623',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542e76a74e6818_97256623')) {function content_542e76a74e6818_97256623($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/ws/prod/qlirr/code/protected/vendors/smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include '/ws/prod/qlirr/code/protected/vendors/smarty/plugins/modifier.replace.php';
?><style>
    

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
    
</style>
<table class="topElements" style="padding-top:10px;padding-left:10px;padding-right:10px">
    <tr>
        <td id="fstCell" height="520px;" >



            <table class="tr" width="660px">
                <tr>
                    
                    <td width="300px" class="tdr header"><div ></div><div ></div>    <img  src="themes/frontend/gfx/logoExSmall.png" width="70" height="37" />
                        <p>Returadress: Peydo AB<br>Björkrisvägen 4 D, 702 34 Örebro</p>
                      
                    </td>
                    <td width="55">
                        
                    </td>
                    <td width="345px">
                        <table style="padding:2px">
                            <tr>
                                <td style="font-size:14px"><b>Faktura</b></td>
                                <td valign="center">Fakturadatum <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date_accepted,"%Y-%m-%d");?>
</td>
                            </tr>
                        </table>
                        <table cellpadding="2px" style="background-color:#e9f7f6">
                            
                            <tr>
                                <td><b>OCR/Fakturanummer</b></td>
                                <td><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['paymentReference']->value,'-','');?>
</td>
                            </tr>
                            <tr>
                                <td><b>Att betala</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 SEK</td>
                            </tr>
                            <tr>
                                <td><b>Bankgiro</b></td>
                                <td>817-6372</td>
                            </tr>
                            <tr>
                                <td><b>Förfalldatum</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['dateDue']->value;?>
</td>
                            </tr>
                        </table>        
                    </td>
					
                </tr>
				
            </table>

            <table class="tr" >
               
                <tr>
                    <td width="20px" class="tdr"></td>
                    <td width="260px" class="tdr">            
                       
                    </td>
                    <td width="260px" >
                        <table cellpadding="2px">
                            <tr><td colspan="2" height="0px"></td></tr>
                            <tr>
                                <td width="75px"></td>
                                <td height="100px" width="260px">
                                    <h5 class="user"><b><?php echo $_smarty_tpl->tpl_vars['customer']->value->name;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->surname;?>
</b><br /> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->street;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->post_code;?>
 <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->city;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerCountry']->value;?>
</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>    
            </table>
                                <div></div>              
            <table >
                <tr>
                    <td height="150px">

                        <table class="tr" width="650px" cellpadding="3" >
                            <tr style="background-color:#e9f7f6;font-size:11px;">
                                <td width="80px" class="bdBtm bld">Art.nr.</td>
                                <td width="240px" class="bdBtm bld">Vara/tjänst</td>
                                <td width="60px" class="bdBtm bld">Antal</td>
                                <td width="125px" class="bdBtm bld">Pris</td>
                                <td class=" bdBtm bld" width="40px">Moms</td>
				<td class="txtRight bdBtm bld" width="145px">Summa</td>
                            </tr>
                            <tr style="font-size:11px">
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</td>
                                <td><b><?php echo $_smarty_tpl->tpl_vars['article_name']->value;?>
<?php echo $_smarty_tpl->tpl_vars['reminders']->value;?>
</b></td>
                                <td>1 st<?php echo $_smarty_tpl->tpl_vars['remindersPCS']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
<?php echo $_smarty_tpl->tpl_vars['remindersValue']->value;?>
</td>
                                <td>0 %<?php echo $_smarty_tpl->tpl_vars['remindersVAT']->value;?>
</td>
                                <td class="txtRight"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
<?php echo $_smarty_tpl->tpl_vars['remindersTotal']->value;?>
</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="divTop" style="background-color:#e9f7f6;" >
                        
                        <table width="680px">
                            <tr><td colspan="5"></td></tr>
                            <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Netto</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 SEK</td>
                            </tr>
                             <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Moms</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right">0,00 SEK</td>
                            </tr>
                             <tr style="background-color:#e9f7f6;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size:11px;text-align:right"><b>Brutto</b></td>        
                                <td class="txtRight" style="font-size:11px;text-align:right"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 SEK</td>
                            </tr>
                            <tr><td colspan="5"></td></tr>
                            <tr class="blueBorder">
                                <td colspan="5"></td>
                            </tr>
                            
                            <tr class="bordering" style="background-color:white;" border="0" cellpadding="0">
                                <td colspan="3"></td>
             
                                <td style="font-size:13px;text-align:right"><b>Att betala</b></td>        
                                <td class="txtRight" style="font-size:13px;padding-right: 2px;text-align:right"><b><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 SEK</b></td>
                            </tr>
                        </table>
                    </div>

                    </td>
                </tr>
            </table>
          
        </td>
    </tr>


</table>
                            
<p style="text-align:center;margin-bottom: 100px;font-size:9px;color: #666; text-justify: auto">Den här fakturan är utställd av Peydo AB som även är fordringsägare 
enligt gällande villkor. Vid förfallodagen kan dröjsmålsränta (8,5%) debiteras 
om fullständig <br>inbetalning på fakturan saknas. Vid utebliven eller försenad 
betalning kan dessutom påminnelseavgift tillkomma samt avgifter för 
inkassokrav och ansökan om <br>betalningsföreläggande. Betalning ska ske till 
Peydo AB:s konto (Bankgiro 817-6372). Frågor gällande denna faktura 
ska ställas direkt till utställaren <br>(support@peydo.com).</p>
<div class="footerDown" style="border-bottom: 1px solid grey">
    <table class="tr" width="660px" style="color:grey;">
        <tr>
            <td width="20px" class="noBdBtm"></td>
            <td colspan="5" width="640px" class="bdBtm txtCenter">
                <?php echo $_smarty_tpl->tpl_vars['footerMemo']->value;?>

            </td>        
        </tr>
  
        <tr>
            <td width="40px"></td>
            <td width="177px">Address<br/>
              Peydo AB, <br/>
                Björkrisvägen 4 D, 702 34 <br>Örebro</td>
            <td width="177px">Org nr.<br/>
              556865-4486<br/>
                Godkänd for F-skatt<br/>
                </td>
            <td colspan="2" width="177px">Momsref .nr.<br/>
                SE556865448601<br/>
                </td>
            <td width="177px" style="text-align:left;">E-post<br/>
                support@peydo.com</td>
        </tr>    
    </table>

</div>


<table class="trs" style="padding-top:150px">
    
    <tr>
        <td width="63px"></td>
        <td width="320" class="ocrFont"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['customer']->value->name, 'UTF-8');?>
 <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['customer']->value->surname, 'UTF-8');?>
<br><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['customerAddressBuyer']->value->street, 'UTF-8');?>
<br><?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->post_code;?>
 <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['customerAddressBuyer']->value->city, 'UTF-8');?>
</td>
        <td>
            <table style="padding:3px">
                <tr>
                    <td width="170px"><b>OCR/FAKTURANUMMER</b> </td>
                    <td><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['paymentReference']->value,'-','');?>
</td>
                </tr>
                <tr>
                    <td width="170px"><b>FÖRFALLODATUM</b></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['dateDue']->value;?>
</td>
                </tr>
            </table>
        </td>
        
    </tr>

</table>
<table style="padding-top:45px">
    <tr class="classicFont">
        <td width="387px"></td>
        <td width="98px">817-6372</td>
        <td width="190px">Peydo AB</td>
    </tr>
</table>
<table style="padding-top:44px">
    <tr class="ocrFont">
       <td width="64px"></td>
       <td width="20px">#</td>
       <td class="txtRight" width="200px"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['paymentReference']->value,'-','');?>
</td>
       <td width="20px">#</td>
       <td class="txtRight" width="62px"><?php echo $_smarty_tpl->tpl_vars['wholeAmount']->value;?>
</td>
       <td width="33px"><?php echo $_smarty_tpl->tpl_vars['decimalAmount']->value;?>
</td>
       <td width="130px"> 0 ></td>
       <td class="txtRight" width="202px">8176372#41#</td>
    </tr>
</table>
<?php }} ?>