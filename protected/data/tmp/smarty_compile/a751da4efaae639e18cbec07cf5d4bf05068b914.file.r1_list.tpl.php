<?php /* Smarty version Smarty-3.1.13, created on 2014-10-09 10:37:31
         compiled from "/ws/prod/qlirr/code/protected/data/templates/r1_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10724785585436494beee1e8-70960968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a751da4efaae639e18cbec07cf5d4bf05068b914' => 
    array (
      0 => '/ws/prod/qlirr/code/protected/data/templates/r1_list.tpl',
      1 => 1411042865,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10724785585436494beee1e8-70960968',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop' => 0,
    'bank' => 0,
    'idnr' => 0,
    'ordersID' => 0,
    'prices' => 0,
    'pricesT' => 0,
    'footerMemo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5436494c03b310_71159281',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436494c03b310_71159281')) {function content_5436494c03b310_71159281($_smarty_tpl) {?><style>
    

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


<div></div>
    <table>
        <tr>
            <td width="10"></td>
            <td><img style="margin-left:20px;margin-top:20px" src="themes/frontend/gfx/logoNewBlack.png"  /></td>
            
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
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->date_signed;?>
</b></td>
        </tr>            
                    
        <tr>
            <td>Owner:</td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->owner1;?>
</b></td>
        </tr>
        <tr>
     
            <td>Shop name:</td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->name;?>
</b></td>
        </tr>
        <tr>
         
            <td>Shop Client ID:</td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->shop_id;?>
</b></td>
        </tr>
        <tr>
         
            <td>Bank name:</td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['bank']->value->full_name;?>
</b></td>
        </tr>
        <tr>
      
            <td>Clearing/account: </td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->bank_clearing;?>
/<?php echo $_smarty_tpl->tpl_vars['shop']->value->bank_account;?>
</b></td>
        </tr>
        <tr>
         
            <td>Swift/IBAN: </td>
            <td><b><?php echo $_smarty_tpl->tpl_vars['shop']->value->bank_swift;?>
/<?php echo $_smarty_tpl->tpl_vars['shop']->value->bank_iban;?>
</b></td>
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
                            <td><?php echo $_smarty_tpl->tpl_vars['idnr']->value;?>
</td>
                            <td align="center"><?php echo $_smarty_tpl->tpl_vars['ordersID']->value;?>
</td>
                            <td align="right"><?php echo $_smarty_tpl->tpl_vars['prices']->value;?>
</td>
                            <td width="30"></td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td colspan="3" align="right" style="border-top:1px solid black;font-size:13px"><b>TOTAL: <?php echo $_smarty_tpl->tpl_vars['pricesT']->value;?>
 kr</b></td>
                            <td width="30"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> 

            
<p style="text-align:center;margin-bottom: 100px;font-size:9px;color: #666; text-justify: auto">Vid förfallodagen så kan dröjsmålsränta (8.5%) debiteras om fullständig inbetalning på fakturan saknas. 
Vid utebliven eller försenad betalning kandessutom påminnelseavgift tillkomma. Den här fakturan 
är utställd av Peydo AB via fakturatjänsten Billogram. Betalning ska ske till Billogram AB(worry) 
klientmedelskonto (bankgiro 639-8770). Frågor gällande denna faktura ska ställas direkt till utställaren (support@peydo.com).</p>
<div class="footerDown">
    <table class="tr" width="660px" style="color:grey;">
        <tr>
            <td width="20px" class="noBdBtm"></td>
            <td colspan="5" width="640px" class="bdBtm txtCenter">
                <?php echo $_smarty_tpl->tpl_vars['footerMemo']->value;?>

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


<?php }} ?>