<?php /* Smarty version Smarty-3.1.13, created on 2013-12-19 12:32:29
         compiled from "/ws/test/peydo/code/protected/data/templates/agreementPeydo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122278458552b1a8b7ceb890-80254425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adb4d69b3058493641bd1fc312c59041c92fde70' => 
    array (
      0 => '/ws/test/peydo/code/protected/data/templates/agreementPeydo.tpl',
      1 => 1387451934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122278458552b1a8b7ceb890-80254425',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b1a8b7d76991_03653514',
  'variables' => 
  array (
    'order' => 0,
    'customerAddressSeller' => 0,
    'bank_ac_name_seller' => 0,
    'customerAddressBuyer' => 0,
    'bank_ac_name_buyer' => 0,
    'merchant' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b1a8b7d76991_03653514')) {function content_52b1a8b7d76991_03653514($_smarty_tpl) {?>
<div style="text-align: center;">
    <h4 style="font-size:12px;">NOTIFICATION ABOUT SEALED CONTRACT No. <span style="font-weight:bolder;"><?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</span></h4>
</div>

<span style="font-size: 12px; font-weight: bold;">SELLER</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Name</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Surname</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->surname;?>
</td>
        </tr>
        <tr>
                        <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Address</h6>  <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->street;?>
</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Post number</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->post_code;?>
</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">City/Town</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->city;?>
</td>
        </tr>
        <tr>
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Cell Phone Number</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->mobile_number;?>
</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->email;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->id_number;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Bank account</h6><?php echo $_smarty_tpl->tpl_vars['bank_ac_name_seller']->value;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Acceptance date of Common conditions of contract </h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->date_issued;?>
</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Making of Buying/Selling Contract date</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->date_issued;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Party has accepted Common conditions of contract posted on web page</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Contract number</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</td>
        </tr>
        <tr>
          <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:7px;word-break:break-all;" colspan="3"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Terms of payment</h6>14 days</td>
        </tr>
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">BUYER</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Name</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Surname</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->surname;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Address</h6>  <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->street;?>
</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Post number</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->post_code;?>
</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">City/Town</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->city;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Cell Phone Number</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->mobile_number;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->email;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->id_number;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Bank account</h6><?php echo $_smarty_tpl->tpl_vars['bank_ac_name_buyer']->value;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Common contract conditions date of acceptance 20.08.2013.</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->date_accepted;?>
</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Buying/Selling Contract date </h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->date_issued;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Party has accepted Common conditions of contract posted on web page</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Contract Number</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</td>
        </tr><tr>
          <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:7px;word-break:break-all;" colspan="3"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Terms of payment</h6>14 days</td>
        </tr>
    </tbody>
</table>

<p><br />
  <br />
  <span style="font-size: 12px; font-weight: bold;">Subject of Buying/Selling Contract</span><br />
</p>
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
  <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Name of merchandise, product or service </h6> <?php echo $_smarty_tpl->tpl_vars['merchant']->value->name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Buying/Selling Price  (&euro;)</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->total_amount;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="100%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Item Number</h6>
                <?php echo $_smarty_tpl->tpl_vars['order']->value->order_reference;?>

            </td>
        </tr>                
    </tbody>
    </table><?php }} ?>