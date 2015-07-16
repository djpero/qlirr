<?php /* Smarty version Smarty-3.1.13, created on 2014-03-12 13:17:03
         compiled from "/ws/test/peydo/code/protected/data/templates/chargeback_fee.tpl" */ ?>
<?php /*%%SmartyHeaderCode:445652875532048ed69e9b2-66520603%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '006d392ebdbd8fa665129f6a3f08034f63f70d76' => 
    array (
      0 => '/ws/test/peydo/code/protected/data/templates/chargeback_fee.tpl',
      1 => 1394626387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '445652875532048ed69e9b2-66520603',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_532048ed771aa1_66715014',
  'variables' => 
  array (
    'paymentReference' => 0,
    'headerMemo' => 0,
    'customer' => 0,
    'customerAddress' => 0,
    'customerCountry' => 0,
    'dateDue' => 0,
    'totalAmount' => 0,
    'order' => 0,
    'footerMemo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532048ed771aa1_66715014')) {function content_532048ed771aa1_66715014($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/ws/test/peydo/code/protected/vendors/smarty/plugins/modifier.date_format.php';
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
                                <td><?php echo smarty_modifier_date_format(time(),"%d.%m.%Y");?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['paymentReference']->value;?>
</td>
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
                        <p><?php echo $_smarty_tpl->tpl_vars['headerMemo']->value;?>
</p>
                    </td>
                    <td width="340px" >
                        <table cellpadding="3px">
                            <tr><td colspan="2" height="50px"></td></tr>
                            <tr>
                                <td width="75px"></td>
                                <td height="120px" width="260px">
                                    <h5 class="user"><?php echo $_smarty_tpl->tpl_vars['customer']->value->name;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->surname;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->street;?>
<br /> <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->post_code;?>
 <?php echo $_smarty_tpl->tpl_vars['customerAddress']->value->city;?>
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
                    <td width="19" class="tdr"></td>
                    <td width="360" class="tdr"></td>
                    <td width="273">
                        <table cellpadding="5px">
                            <tr>
                                <td style="padding" height="70px">
                                    <table cellpadding="4px" class="blackBD">
                                        <tr>
                                            <td class="bw">Due date:</td>
                                            <td class="wb"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dateDue']->value,"%d.%m.%Y");?>
</td>
                                        </tr>
                                        <tr>
                                            <td class="bw">Total for payment:</td>
                                            <td class="wb"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
 &euro;</td>
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
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['time_created'],"%d.%m.%Y.");?>
</td>
                                <td>Chargeback fee for not delivering item</td>

                                <td></td>
                                <td class="txtRight"><?php echo $_smarty_tpl->tpl_vars['totalAmount']->value;?>
</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Total</b></td>
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
<?php }} ?>