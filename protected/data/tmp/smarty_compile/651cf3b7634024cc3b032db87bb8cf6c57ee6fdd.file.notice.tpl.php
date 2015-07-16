<?php /* Smarty version Smarty-3.1.13, created on 2013-10-11 15:10:54
         compiled from "/ws/prod/peydo/code/protected/data/templates/notice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17944585785257f8deeb7407-54590064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '651cf3b7634024cc3b032db87bb8cf6c57ee6fdd' => 
    array (
      0 => '/ws/prod/peydo/code/protected/data/templates/notice.tpl',
      1 => 1377042301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17944585785257f8deeb7407-54590064',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dateIssued' => 0,
    'paymentPrefix' => 0,
    'paymentReference' => 0,
    'headerMemo' => 0,
    'customerFullname' => 0,
    'customerAddress' => 0,
    'customerPostcode' => 0,
    'customerCity' => 0,
    'customerCountry' => 0,
    'dateDue' => 0,
    'totalAmount' => 0,
    'order' => 0,
    'price' => 0,
    'footerMemo' => 0,
    'recipientFull' => 0,
    'bankAccountNo' => 0,
    'paymentDescription' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5257f8def3a301_90983322',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5257f8def3a301_90983322')) {function content_5257f8def3a301_90983322($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/ws/prod/peydo/code/protected/vendors/smarty/plugins/modifier.date_format.php';
?><style>
    
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
                                <td><?php echo $_smarty_tpl->tpl_vars['dateIssued']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['paymentPrefix']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['paymentReference']->value;?>
</td>
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
                        <p><?php echo $_smarty_tpl->tpl_vars['headerMemo']->value;?>
</p>
                    </td>
                    <td width="340px" >
                        <table cellpadding="3px">
                            <tr><td colspan="2" height="50px"></td></tr>
                            <tr>
                                <td width="75px"></td>
                                <td height="120px" width="260px">
                                    <h5 class="user"><?php echo $_smarty_tpl->tpl_vars['customerFullname']->value;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerPostcode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['customerCity']->value;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerCountry']->value;?>
</h5>
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
                                            <td class="wb"><?php echo $_smarty_tpl->tpl_vars['dateDue']->value;?>
</td>
                                        </tr>
                                        <tr>
                                            <td class="bw">Ukupno za platiti:</td>
                                            <td class="wb"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 HRK</td>
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
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['time_created'],"%d.%m.%Y.");?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value['service']['service_name'];?>
</td>

                                <td></td>
                                <td class="txtRight"><?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Ukupno</b></td>
                                <td></td>
                                <td></td>        
                                <td class="txtRight"><b><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
</b></td>
                            </tr>
                        </table>


                    </td>
                </tr>
            </table>

            <table class="tr" width="660px">
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
                                <td width="130px" height="50px"><?php echo $_smarty_tpl->tpl_vars['customerFullname']->value;?>
<br/>
                                    <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['customerCity']->value;?>
</td>
                            </tr>
                            <tr><td colspan="2" height="45px"></td></tr>
                            <tr>
                                <td width="5px" ></td>
                                <td width="130px" height="50px" ><?php echo $_smarty_tpl->tpl_vars['recipientFull']->value;?>
</td>
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
                                <td width="40px"><?php echo $_smarty_tpl->tpl_vars['paymentPrefix']->value;?>
</td>
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
                                <td><?php echo $_smarty_tpl->tpl_vars['bankAccountNo']->value;?>
</td>
                            </tr>
                            <tr>
                                <td width="5px"></td>
                                <td height="16px"></td>
                            </tr>
                            <tr>
                                <td height="15px" colspan="2"><?php echo $_smarty_tpl->tpl_vars['paymentReference']->value;?>
</td>
                            </tr>                
                            <tr>
                                <td width="5px"></td>
                                <td>
                                    <table cellpadding="3px">
                                        <tr>
                                            <td width="20px"></td>
                                            <td width="210px" height="50px"><?php echo $_smarty_tpl->tpl_vars['paymentDescription']->value;?>
</td>
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
                            <tr><td height="22px"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 HRK</td></tr>
                            <tr>                    
                                <td height="10px"><?php echo $_smarty_tpl->tpl_vars['customerFullname']->value;?>
</td>
                            </tr>
                            <tr><td height="36px"></td></tr>                
                            <tr>                    
                                <td height="10px"><?php echo $_smarty_tpl->tpl_vars['bankAccountNo']->value;?>
</td>
                            </tr>
                            <tr><td height="16px"></td></tr>                
                            <tr>                    
                                <td height="10px"><?php echo $_smarty_tpl->tpl_vars['paymentPrefix']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['paymentReference']->value;?>
</td>
                            </tr>
                            <tr><td height="12px"></td></tr>                
                            <tr>                    
                                <td height="150px"><?php echo $_smarty_tpl->tpl_vars['paymentDescription']->value;?>
</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
</table><?php }} ?>