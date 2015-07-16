<?php /* Smarty version Smarty-3.1.13, created on 2013-10-11 15:10:57
         compiled from "/ws/prod/peydo/code/protected/data/templates/agreement.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11611818475257f8e1104867-52468403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e980b1c3b517cddce23f4000454cd382e1a3696' => 
    array (
      0 => '/ws/prod/peydo/code/protected/data/templates/agreement.tpl',
      1 => 1377042301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11611818475257f8e1104867-52468403',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'customerAddressSeller' => 0,
    'dateSeller' => 0,
    'customerAddressBuyer' => 0,
    'dateBuyer' => 0,
    'orderItem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5257f8e11ab9f3_88657055',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5257f8e11ab9f3_88657055')) {function content_5257f8e11ab9f3_88657055($_smarty_tpl) {?>
<div style="text-align: center;">
    <h4 style="font-size:12px;">OBAVIJEST  O SKLOPLJENOM UGOVORU br.<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</h4>
</div>

<span style="font-size: 12px; font-weight: bold;">Prodavatelj</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ime</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Prezime</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->surname;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adresa</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->street;?>
</td>
            <td width="100px" style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Poštanski broj</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->post_code;?>
</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mjesto</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressSeller']->value->city;?>
</td>
        </tr>
        <tr>
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj mobitela</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->mobile_number;?>
</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->email;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->seller->id_number;?>
</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Uvjeti plaćanja</h6> 14 dana (temeljem prihvaćenih općih uvjeta ugovora)</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum prihvaćanja Općih uvjeta ugovora od 20.08.2013.</h6> <?php echo $_smarty_tpl->tpl_vars['dateSeller']->value;?>
</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum sklapanja ugovora o kupoprodaji</h6> <?php echo $_smarty_tpl->tpl_vars['dateSeller']->value;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Stranka je prihvatila Opće uvjete ugovora objavljene na stranici</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj ugovora</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</td>
        </tr>
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">Kupac</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ime</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Prezime</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->surname;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adresa</h6>  <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->street;?>
</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Poštanski broj</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->post_code;?>
</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mjesto</h6> <?php echo $_smarty_tpl->tpl_vars['customerAddressBuyer']->value->city;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj mobitela</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->mobile_number;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->email;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->buyer->id_number;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Uvjeti plaćanja</h6> 14 dana (temeljem prihvaćenih općih uvjeta ugovora)</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum prihvaćanja Općih uvjeta ugovora od 20.08.2013.</h6> <?php echo $_smarty_tpl->tpl_vars['dateBuyer']->value;?>
</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum sklapanja ugovora o kupoprodaji</h6> <?php echo $_smarty_tpl->tpl_vars['dateSeller']->value;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Stranka je prihvatila Opće uvjete ugovora objavljene na stranici</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj ugovora</h6> <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</td>
        </tr>
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">Predmet kupoprodajnog ugovora</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Naziv robe, proizvoda ili usluge</h6> <?php echo $_smarty_tpl->tpl_vars['orderItem']->value->product_name;?>
</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kupoprodajna cijena (HRK)</h6> <?php echo $_smarty_tpl->tpl_vars['orderItem']->value->price;?>
</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="100%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Šifra oglasa</h6>
                <?php echo $_smarty_tpl->tpl_vars['order']->value->order_reference;?>

            </td>
        </tr>                
    </tbody>
    </table><?php }} ?>