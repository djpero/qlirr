<!DOCTYPE html>

<?php
   // $shops = ShopsDao::getShopList();
 ?>
<html>
<head>
<title>Qlirr Admin Area</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8"> 
<!-- Bootstrap -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/thin-admin.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/font-awesome.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/style.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/style/dashboard.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/uploadify.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_page.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/demo_table.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<style>
    .twitter-typeahead{
width:100%;
}

.twitter-typeahead .tt-query,
.twitter-typeahead .tt-hint {
  margin-bottom: 0;
}
.tt-dropdown-menu {
  min-width: 160px;
  margin-top: 2px;
  padding: 5px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0,0,0,.2);
  *border-right-width: 2px;
  *border-bottom-width: 2px;
  -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
  -webkit-background-clip: padding-box;
     -moz-background-clip: padding;
          background-clip: padding-box;
  width:100%;        
}

.tt-suggestion {
  display: block;
  padding: 3px 20px;
}

.tt-suggestion.tt-is-under-cursor {
  color: #fff;
  background-color: #0081c2;
  background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
  background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
  background-image: -o-linear-gradient(top, #0088cc, #0077b3);
  background-image: linear-gradient(to bottom, #0088cc, #0077b3);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0)
}

.tt-suggestion.tt-is-under-cursor a {
  color: #fff;
}

.tt-suggestion p {
  margin: 0;
}
</style>
<body>

 <div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="/admin/default"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/gfx/logoNewMobile.png"></a></div>
    <ul class="nav navbar-nav navbar-right  hidden-xs">

      <li class="dropdown user  hidden-xs"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-male"></i> <span class="username"><?php echo $this->user->name.' '.$this->user->surname; ?></span> <i class="icon-caret-down small"></i> </a>
        <ul class="dropdown-menu">
          
          <li><a href="/admin/default/logout"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>

  </div>
</div>
<div class="wrapper">
  <div class="left-nav">
    <div id="side-nav">
      <ul id="nav">
            <?php  DefaultController::printMenu(2); ?>
       </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      <div class="row">
       <div class="col-lg-12">
            <div class="col-lg-6"><h2 class="page-title">Shops</h2></div>
            <div class="col-lg-6"><h2 class="page-title" style="text-align:right"><span id="tmrWatch"></span></h2></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-table"></i>
              <h3>Shop list</h3>
            </div>
            <div class="widget-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#active">Active</a></li>
                    <li class=""><a data-toggle="tab" href="#noactive">No-active</a></li>
                </ul>   
                
                <div class="tab-content" id="myTabContent">

                <div id="active" class="tab-pane fade active in">
                <div class="example_alt_pagination">
                    <div id="container">
                      <div class="full_width big"></div>
                <div id="demo">
                    <div class="row" style="padding:20px; margin:0;margin-bottom: 20px;background: rgba(0,0,0,0.2); border-radius: 6px;">


                          <div class="col-lg-12">
                              <div class="col-lg-6">
                                  <a onclick="getTableData('1');" class="btn btn-s-md btn-success btn-sm" href="#" >Update</a>
                              </div>

                              <div class="col-lg-6" align="right">
                                  <button data-backdrop="false" data-target="#modalShop" data-toggle="modal" class="btn btn-s-md  btn-default btn-sm newBTN" type="button">New Shop</button>
                              </div>
                          </div>
                    </div>
                  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
                    <thead>
                          <tr>
                              <th class="hidden-xs">Client ID</th>
                              <th class="hidden-xs">Shop name</th>
                              <th class="hidden-xs">VAT number</th>
                              <th class="hidden-xs">Mobile no.</th>
                              <th class="hidden-xs">Shop type</th>
                              <th class="hidden-xs">Created</th>
                              <th class="hidden-xs" style="width:110px">Action</th>
                          </tr>
                      </thead>

                     <!--ovdje ide container sa tabelom-->

                    <tbody id="tableContainer" style="font-size:13px"></tbody>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                      </tfoot>
                  </table>
                  </div>



                      </div>
                  </div>
                </div>
                    <div id="noactive" class="tab-pane fade">
                        
                        
                <div class="example_alt_pagination">
                    <div id="container">
                      <div class="full_width big"></div>
                <div id="demo">
                    <div class="row" style="padding:20px; margin:0;margin-bottom: 20px;background: rgba(0,0,0,0.2); border-radius: 6px;">


                          <div class="col-lg-12">
                              <div class="col-lg-6">
                                  <a onclick="getTableData('0');" class="btn btn-s-md btn-success btn-sm" href="#" >Update</a>
                              </div>

                          </div>
                    </div>
                  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example0">
                    <thead>
                          <tr>
                              <th class="hidden-xs">Client ID</th>
                              <th class="hidden-xs">Shop name</th>
                              <th class="hidden-xs">VAT number</th>
                              <th class="hidden-xs">Mobile no.</th>
                              <th class="hidden-xs">Shop type</th>
                              <th class="hidden-xs">Created</th>
                              <th class="hidden-xs" style="width:110px">Action</th>
                          </tr>
                      </thead>

                     <!--ovdje ide container sa tabelom-->

                    <tbody id="tableContainer" style="font-size:13px"></tbody>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                      </tfoot>
                  </table>
                  </div>



                      </div>
                  </div>
                        
                        
                        
                        
                        
                    </div>    
                </div>
            </div>
          </div>
        </div>
      </div>
      
      
      
      
      
    </div>
  </div>
</div>
    
    <!---------------------------------------------------  MODAL NEW SHOP ---------------------------------------------------->
    <div class="modal" id="modalShop" tabindex="-1" role="dialog" aria-labelledby="enter-pin-label" aria-hidden="true">
      <div class="modal-dialog" style="width:760px">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="" >New shop</h4>

          </div>
          <div  class="modal-body" style="margin-top:10px;overflow:auto;">
              <div class="row" style="margin-left:6px">
                <p style="margin-left:3px; font-size:16px; font-weight:900"> Account details</p>
                <table cellpadding="3" style="width:680px">
                   
                    <tr>
                        <td width="160px">Account name: </td>
                        <td width="200px"><input id="modalShopName" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  onblur="checkThis(this.id)" data-val="0"/></td>
                    </tr>
                    <tr>
                        <td>Class of trade: </td>
                        <td>
                            <select id="modalShopCategory" class="selectpicker" style="height:34px;padding:6px 12px;background-color: white;color:black;width:100%;border: 1px solid #ddd;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);border-radius: 4px">
                                <?php   
                                    $shopType = ShopTypeDao::getAll();
                                    $x=0;
                                    while ($x < count($shopType))  {
                                        echo '<option  id="'.$shopType[$x]->type.'" value="'.$shopType[$x]->type.'">'.$shopType[$x]->name.'</option>';
                                        $x++;
                                    }
                                ?>
                            </select>
                        </td>
                    
                    </tr>
                    <tr>
                        <td>Address <i>(county)</i>: </td>
                        <td width="220px" colspan="3">
                         <select id="modalCounty" class="selectpicker" style="height:34px;padding:6px 12px;background-color: white;color:black;width:100%;border: 1px solid #ddd;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);border-radius: 4px">
                                <?php   
                                    $county = CountiesDao::getAll();
                                    $w=0;
                                    while ($w < count($county))  {
                                        echo '<option  id="'.$county[$w]->id.'" value="'.$county[$w]->id.'">'.$county[$w]->name.'</option>';
                                        $w++;
                                    }
                                ?>
                            </select>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td width="340px"><input id="modalAddress1" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td width="100px"><input id="modalPost1" type="tel" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td width="220px"><input id="modalCity1" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    <tr>
                        <td width="110px">CID: </td>
                        <td width="190px"><input id="modalCID" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  onblur="checkThis(this.id)" data-val="0"/></td>
                    </tr>
                    <tr>
                        <td width="110px">Contract signed/ends: </td>
                        <td width="100px"><input id="modalContractSign" type="date" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td colspan="2"><input id="modalContractEnd" type="date"  class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    
                    
                </table>
                <p style="margin-top:15px;margin-left:2px; font-size:16px; font-weight:900"> Login info</p>
                <table cellpadding="3" style="width:680px">
                    
                    <tr>
                        <td width="140px">User name: </td>
                        <td ><input id="modalUsername" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  onblur="checkThis(this.id)" data-val="0"/></td>
                        <td style="padding-left:10px"><span onclick="generateRandomPass('modalPass')" style="cursor: pointer">Password: </span></td>
                        <td ><input id="modalPass" class="form-control" style="background-color: white;color:black;border:1px solid #ddd" onblur="changeElement(this.id,'0')" onfocus="changeElement(this.id,'1')" value="password" /></td>
                    </tr>
                </table>
                <p style="margin-top:15px;margin-left:2px; font-size:16px; font-weight:900"> Bank info</p>
                <table cellpadding="3" style="width:680px">
                    <tr>
                        <td width="135px">Bank name/account: </td>
                        <td>
                            <select id="modalBankName" class="selectpicker" style="margin:5px;height:34px;padding:6px 12px;background-color: white;color:black;width:96%;border: 1px solid #ddd;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);border-radius: 4px">
                                <?php   
                                    $shopBank = BanksDao::getAll();
                                    $x=0;
                                    while ($x < count($shopBank))  {
                                        echo '<option id="'.$shopBank[$x]->id.'" value="'.$shopBank[$x]->id.'">'.$shopBank[$x]->full_name.'</option>';
                                        $x++;
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td >Clearing nr/account: </td>
                        <td ><input id="modalBankClearing" class="form-control" style="background-color: white;color:black;border:1px solid #ddd;"  /></td>
                        <td ><input id="modalBankAcc" class="form-control" style="background-color: white;color:black;border:1px solid #ddd;"  /></td>
                    </tr>
                    <tr>
                        <td >SWIFT/IBAN: </td>
                        <td ><input id="modalBankSwift" class="form-control" style="background-color: white;color:black;border:1px solid #ddd;"  /></td>
                        <td ><input id="modalBankIban" class="form-control" style="background-color: white;color:black;border:1px solid #ddd;"  /></td>
                    </tr>
                </table>
                <p style="margin-top:15px;margin-left:2px; font-size:16px; font-weight:900"> Company info</p>
                <table cellpadding="3" style="width:680px">
                    <tr>
                        <td width="160px">Legal name: </td>
                        <td ><input id="modalCompanyname" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    <tr>
                        <td>Legal address: </td>
                        <td width="330px"><input id="modalAddress2" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td  width="115px"><input id="modalPost2" type="tel" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td width="220px"><input id="modalCity2" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>

                    </tr>
                    <tr>
                        <td >VAT nr:</td>
                        <td ><input id="modalVATnumber" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    <tr>
                        <td>Owner/SSN: <i style="padding-left:5px;font-size:18px;color:green;cursor:pointer" class="icon-plus-sign" onclick="addCompanyInfo('','')"/></td>
                        <td><input id="modalOwner1" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td colspan="2"><input id="modalOwner2" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    
                </table>
                <table cellpadding="3" style="width:680px" id="tableCompanyInfo">
                    
                </table>
                <p style="margin-top:15px;margin-left:2px; font-size:16px; font-weight:900"> Contact info</p>
                <table cellpadding="3" style="width:680px">
                    <tr>
                        <td width="136px">Contact person: <i style="padding-left:5px;font-size:18px;color:green;cursor:pointer" class="icon-plus-sign" onclick="addContactInfo('','')"/></td>
                        <td colspan="3" width="360px"><input id="modalContactInfo" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td ><input id="modalContactEmail"  class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                        <td style="padding-left:10px">Phone: </td>
                        <td ><input id="modalContactTel" class="form-control" style="background-color: white;color:black;border:1px solid #ddd"  /></td>
                    </tr>
                </table>
                <table cellpadding="3" style="width:680px" id="tableContactInfo">
                    
                </table>
                <p style="margin-top:15px;margin-left:2px; font-size:16px; font-weight:900"> Services</p>
                <table style="width:680px">
                    <tr>
                        <td width="205px" >Qlirr Invoice: </td>
                        <td ><input id="modalCheckInvoice"  type="checkbox"  style="background-color: white;color:black;border:1px solid #ddd;zoom:1.7"  /></td>
<!--                    </tr>
                     <tr>-->
                        <td width="205px"  >Qlirr Installments: </td>
                        <td ><input id="modalCheckInstallments" type="checkbox"  style="background-color: white;color:black;border:1px solid #ddd;zoom:1.7"  /></td>
                    </tr>
                </table>
                
                <form enctype="multipart/form-data" id="upload1">
                    <input id="file_upload" name="file_upload" type="file" multiple="true">

                </form>
                <iframe id="upload2" src="/admin/default/uploadS">
                    
                </iframe>
                
              </div> 
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-success" type="button" onclick="saveNewShop();">Save</button>
                </div>
            </div>
            
        </div>
      </div>
    </div>  
           <!---------------------------------- MODAL SHOP DELETE CONFIRMATION ----------------------------------->
    <div class="modal" id="deleteShopModal" tabindex="-1" role="dialog" aria-labelledby="enter-pin-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="closeDeleteShopModal()">&times;</button>
                <h4 class="modal-title" id="" >Deactivate shop</h4>

            </div>
            <div class="modal-body" >
                <p style="font-size:16px;text-align:center;color:red;font-weight: 300;margin-top:24px"> Are you sure to deactivate this shop?</p>
                
            </div>
            <div class="modal-footer">
                <div id="modalAskSure" >
                    <button class="btn btn-danger" type="button" aria-hidden="true" data-dismiss="modal" onclick="closeDeleteShopModal()">No</button>
                    <button class="btn btn-success" type="button" id="delAction">Yes</button>
                </div>
            </div>
           </div>
          <!-- /.modal-content --> 
         </div>
        <!-- /.modal-dialog --> 
     </div>
<div class="bottom-nav footer"><?php    echo date('Y'); ?> &copy; Qlirr </div>
<input id="inpSaveType" hidden />
<input id="currentShop" hidden />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script> 

<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/smooth-sliding-menu.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/hogan.js"></script> 

<script type="text/javascript" language="javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.js"></script>
<script type="text/javascript" language="javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/jquery.uploadify.min.js"></script> 

<script type="text/javascript">
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    if (isSafari) {
        $("#upload1").hide();
        $("#upload2").show();
    } else {
        $("#upload1").hide();
        $("#upload2").show();
    }
    

</script>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example1').dataTable( {
            "sPaginationType": "full_numbers"
        });
        $('#example0').dataTable( {
            "sPaginationType": "full_numbers"
        });
    });
    
    startTime();
    
    
    function startTime() {
        var today=new Date();
        var h=today.getHours();
        var m=today.getMinutes();
        var s=today.getSeconds();
        var datum = today.getDate();
        var mjesec = today.getMonth()+1;
        var godina = today.getYear();
        // add a zero in front of numbers<10
        m=checkTime(m);
        s=checkTime(s);
        document.getElementById('tmrWatch').innerHTML=h+":"+m+":"+s+" <small>"+datum+"."+mjesec+"</small>";
        t=setTimeout(function(){startTime()},500);
    }

    function checkTime(i)
    {
    if (i<10)
      {
      i="0" + i;
      }
    return i;
    }
                        
    function addCompanyInfo(owner, ssn) {
        $("<tr><td width='142px'></td><td width='265px'><input value='"+owner+"' class='form-control companyAddOwner' style='background-color: white;color:black;border:1px solid #ddd'  /></td><td colspan='2'><input value='"+ssn+"' class='form-control companyAddSsn' style='background-color: white;color:black;border:1px solid #ddd'  /></td></tr>").appendTo('#tableCompanyInfo');
    }
    
    function addContactInfo(email, phone) {
        $("<tr><td width='136px'>Email: </td><td ><input class='form-control contactAddEmail' style='background-color: white;color:black;border:1px solid #ddd' value='"+email+"' /></td><td style='padding-left:10px'>Phone: </td><td ><input value='"+phone+"'  class='form-control contactAddPhone' style='background-color: white;color:black;border:1px solid #ddd'  /></td></tr>").appendTo('#tableContactInfo');
    }
    
// ~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~! AUTOCOMPLETE !~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~   

!function(a){var b="0.9.3",c={isMsie:function(){var a=/(msie) ([\w.]+)/i.exec(navigator.userAgent);return a?parseInt(a[2],10):!1},isBlankString:function(a){return!a||/^\s*$/.test(a)},escapeRegExChars:function(a){return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},isString:function(a){return"string"==typeof a},isNumber:function(a){return"number"==typeof a},isArray:a.isArray,isFunction:a.isFunction,isObject:a.isPlainObject,isUndefined:function(a){return"undefined"==typeof a},bind:a.proxy,bindAll:function(b){var c;for(var d in b)a.isFunction(c=b[d])&&(b[d]=a.proxy(c,b))},indexOf:function(a,b){for(var c=0;c<a.length;c++)if(a[c]===b)return c;return-1},each:a.each,map:a.map,filter:a.grep,every:function(b,c){var d=!0;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?void 0:!1}),!!d):d},some:function(b,c){var d=!1;return b?(a.each(b,function(a,e){return(d=c.call(null,e,a,b))?!1:void 0}),!!d):d},mixin:a.extend,getUniqueId:function(){var a=0;return function(){return a++}}(),defer:function(a){setTimeout(a,0)},debounce:function(a,b,c){var d,e;return function(){var f,g,h=this,i=arguments;return f=function(){d=null,c||(e=a.apply(h,i))},g=c&&!d,clearTimeout(d),d=setTimeout(f,b),g&&(e=a.apply(h,i)),e}},throttle:function(a,b){var c,d,e,f,g,h;return g=0,h=function(){g=new Date,e=null,f=a.apply(c,d)},function(){var i=new Date,j=b-(i-g);return c=this,d=arguments,0>=j?(clearTimeout(e),e=null,g=i,f=a.apply(c,d)):e||(e=setTimeout(h,j)),f}},tokenizeQuery:function(b){return a.trim(b).toLowerCase().split(/[\s]+/)},tokenizeText:function(b){return a.trim(b).toLowerCase().split(/[\s\-_]+/)},getProtocol:function(){return location.protocol},noop:function(){}},d=function(){var a=/\s+/;return{on:function(b,c){var d;if(!c)return this;for(this._callbacks=this._callbacks||{},b=b.split(a);d=b.shift();)this._callbacks[d]=this._callbacks[d]||[],this._callbacks[d].push(c);return this},trigger:function(b,c){var d,e;if(!this._callbacks)return this;for(b=b.split(a);d=b.shift();)if(e=this._callbacks[d])for(var f=0;f<e.length;f+=1)e[f].call(this,{type:d,data:c});return this}}}(),e=function(){function b(b){b&&b.el||a.error("EventBus initialized without el"),this.$el=a(b.el)}var d="typeahead:";return c.mixin(b.prototype,{trigger:function(a){var b=[].slice.call(arguments,1);this.$el.trigger(d+a,b)}}),b}(),f=function(){function a(a){this.prefix=["__",a,"__"].join(""),this.ttlKey="__ttl__",this.keyMatcher=new RegExp("^"+this.prefix)}function b(){return(new Date).getTime()}function d(a){return JSON.stringify(c.isUndefined(a)?null:a)}function e(a){return JSON.parse(a)}var f,g;try{f=window.localStorage,f.setItem("~~~","!"),f.removeItem("~~~")}catch(h){f=null}return g=f&&window.JSON?{_prefix:function(a){return this.prefix+a},_ttlKey:function(a){return this._prefix(a)+this.ttlKey},get:function(a){return this.isExpired(a)&&this.remove(a),e(f.getItem(this._prefix(a)))},set:function(a,e,g){return c.isNumber(g)?f.setItem(this._ttlKey(a),d(b()+g)):f.removeItem(this._ttlKey(a)),f.setItem(this._prefix(a),d(e))},remove:function(a){return f.removeItem(this._ttlKey(a)),f.removeItem(this._prefix(a)),this},clear:function(){var a,b,c=[],d=f.length;for(a=0;d>a;a++)(b=f.key(a)).match(this.keyMatcher)&&c.push(b.replace(this.keyMatcher,""));for(a=c.length;a--;)this.remove(c[a]);return this},isExpired:function(a){var d=e(f.getItem(this._ttlKey(a)));return c.isNumber(d)&&b()>d?!0:!1}}:{get:c.noop,set:c.noop,remove:c.noop,clear:c.noop,isExpired:c.noop},c.mixin(a.prototype,g),a}(),g=function(){function a(a){c.bindAll(this),a=a||{},this.sizeLimit=a.sizeLimit||10,this.cache={},this.cachedKeysByAge=[]}return c.mixin(a.prototype,{get:function(a){return this.cache[a]},set:function(a,b){var c;this.cachedKeysByAge.length===this.sizeLimit&&(c=this.cachedKeysByAge.shift(),delete this.cache[c]),this.cache[a]=b,this.cachedKeysByAge.push(a)}}),a}(),h=function(){function b(a){c.bindAll(this),a=c.isString(a)?{url:a}:a,i=i||new g,h=c.isNumber(a.maxParallelRequests)?a.maxParallelRequests:h||6,this.url=a.url,this.wildcard=a.wildcard||"%QUERY",this.filter=a.filter,this.replace=a.replace,this.ajaxSettings={type:"get",cache:a.cache,timeout:a.timeout,dataType:a.dataType||"json",beforeSend:a.beforeSend},this._get=(/^throttle$/i.test(a.rateLimitFn)?c.throttle:c.debounce)(this._get,a.rateLimitWait||300)}function d(){j++}function e(){j--}function f(){return h>j}var h,i,j=0,k={};return c.mixin(b.prototype,{_get:function(a,b){function c(c){var e=d.filter?d.filter(c):c;b&&b(e),i.set(a,c)}var d=this;f()?this._sendRequest(a).done(c):this.onDeckRequestArgs=[].slice.call(arguments,0)},_sendRequest:function(b){function c(){e(),k[b]=null,f.onDeckRequestArgs&&(f._get.apply(f,f.onDeckRequestArgs),f.onDeckRequestArgs=null)}var f=this,g=k[b];return g||(d(),g=k[b]=a.ajax(b,this.ajaxSettings).always(c)),g},get:function(a,b){var d,e,f=this,g=encodeURIComponent(a||"");return b=b||c.noop,d=this.replace?this.replace(this.url,g):this.url.replace(this.wildcard,g),(e=i.get(d))?c.defer(function(){b(f.filter?f.filter(e):e)}):this._get(d,b),!!e}}),b}(),i=function(){function d(b){c.bindAll(this),c.isString(b.template)&&!b.engine&&a.error("no template engine specified"),b.local||b.prefetch||b.remote||a.error("one of local, prefetch, or remote is required"),this.name=b.name||c.getUniqueId(),this.limit=b.limit||5,this.minLength=b.minLength||1,this.header=b.header,this.footer=b.footer,this.valueKey=b.valueKey||"value",this.template=e(b.template,b.engine,this.valueKey),this.local=b.local,this.prefetch=b.prefetch,this.remote=b.remote,this.itemHash={},this.adjacencyList={},this.storage=b.name?new f(b.name):null}function e(a,b,d){var e,f;return c.isFunction(a)?e=a:c.isString(a)?(f=b.compile(a),e=c.bind(f.render,f)):e=function(a){return"<p>"+a[d]+"</p>"},e}var g={thumbprint:"thumbprint",protocol:"protocol",itemHash:"itemHash",adjacencyList:"adjacencyList"};return c.mixin(d.prototype,{_processLocalData:function(a){this._mergeProcessedData(this._processData(a))},_loadPrefetchData:function(d){function e(a){var b=d.filter?d.filter(a):a,e=m._processData(b),f=e.itemHash,h=e.adjacencyList;m.storage&&(m.storage.set(g.itemHash,f,d.ttl),m.storage.set(g.adjacencyList,h,d.ttl),m.storage.set(g.thumbprint,n,d.ttl),m.storage.set(g.protocol,c.getProtocol(),d.ttl)),m._mergeProcessedData(e)}var f,h,i,j,k,l,m=this,n=b+(d.thumbprint||"");return this.storage&&(f=this.storage.get(g.thumbprint),h=this.storage.get(g.protocol),i=this.storage.get(g.itemHash),j=this.storage.get(g.adjacencyList)),k=f!==n||h!==c.getProtocol(),d=c.isString(d)?{url:d}:d,d.ttl=c.isNumber(d.ttl)?d.ttl:864e5,i&&j&&!k?(this._mergeProcessedData({itemHash:i,adjacencyList:j}),l=a.Deferred().resolve()):l=a.getJSON(d.url).done(e),l},_transformDatum:function(a){var b=c.isString(a)?a:a[this.valueKey],d=a.tokens||c.tokenizeText(b),e={value:b,tokens:d};return c.isString(a)?(e.datum={},e.datum[this.valueKey]=a):e.datum=a,e.tokens=c.filter(e.tokens,function(a){return!c.isBlankString(a)}),e.tokens=c.map(e.tokens,function(a){return a.toLowerCase()}),e},_processData:function(a){var b=this,d={},e={};return c.each(a,function(a,f){var g=b._transformDatum(f),h=c.getUniqueId(g.value);d[h]=g,c.each(g.tokens,function(a,b){var d=b.charAt(0),f=e[d]||(e[d]=[h]);!~c.indexOf(f,h)&&f.push(h)})}),{itemHash:d,adjacencyList:e}},_mergeProcessedData:function(a){var b=this;c.mixin(this.itemHash,a.itemHash),c.each(a.adjacencyList,function(a,c){var d=b.adjacencyList[a];b.adjacencyList[a]=d?d.concat(c):c})},_getLocalSuggestions:function(a){var b,d=this,e=[],f=[],g=[];return c.each(a,function(a,b){var d=b.charAt(0);!~c.indexOf(e,d)&&e.push(d)}),c.each(e,function(a,c){var e=d.adjacencyList[c];return e?(f.push(e),(!b||e.length<b.length)&&(b=e),void 0):!1}),f.length<e.length?[]:(c.each(b,function(b,e){var h,i,j=d.itemHash[e];h=c.every(f,function(a){return~c.indexOf(a,e)}),i=h&&c.every(a,function(a){return c.some(j.tokens,function(b){return 0===b.indexOf(a)})}),i&&g.push(j)}),g)},initialize:function(){var b;return this.local&&this._processLocalData(this.local),this.transport=this.remote?new h(this.remote):null,b=this.prefetch?this._loadPrefetchData(this.prefetch):a.Deferred().resolve(),this.local=this.prefetch=this.remote=null,this.initialize=function(){return b},b},getSuggestions:function(a,b){function d(a){f=f.slice(0),c.each(a,function(a,b){var d,e=g._transformDatum(b);return d=c.some(f,function(a){return e.value===a.value}),!d&&f.push(e),f.length<g.limit}),b&&b(f)}var e,f,g=this,h=!1;a.length<this.minLength||(e=c.tokenizeQuery(a),f=this._getLocalSuggestions(e).slice(0,this.limit),f.length<this.limit&&this.transport&&(h=this.transport.get(a,d)),!h&&b&&b(f))}}),d}(),j=function(){function b(b){var d=this;c.bindAll(this),this.specialKeyCodeMap={9:"tab",27:"esc",37:"left",39:"right",13:"enter",38:"up",40:"down"},this.$hint=a(b.hint),this.$input=a(b.input).on("blur.tt",this._handleBlur).on("focus.tt",this._handleFocus).on("keydown.tt",this._handleSpecialKeyEvent),c.isMsie()?this.$input.on("keydown.tt keypress.tt cut.tt paste.tt",function(a){d.specialKeyCodeMap[a.which||a.keyCode]||c.defer(d._compareQueryToInputValue)}):this.$input.on("input.tt",this._compareQueryToInputValue),this.query=this.$input.val(),this.$overflowHelper=e(this.$input)}function e(b){return a("<span></span>").css({position:"absolute",left:"-9999px",visibility:"hidden",whiteSpace:"nowrap",fontFamily:b.css("font-family"),fontSize:b.css("font-size"),fontStyle:b.css("font-style"),fontVariant:b.css("font-variant"),fontWeight:b.css("font-weight"),wordSpacing:b.css("word-spacing"),letterSpacing:b.css("letter-spacing"),textIndent:b.css("text-indent"),textRendering:b.css("text-rendering"),textTransform:b.css("text-transform")}).insertAfter(b)}function f(a,b){return a=(a||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),b=(b||"").replace(/^\s*/g,"").replace(/\s{2,}/g," "),a===b}return c.mixin(b.prototype,d,{_handleFocus:function(){this.trigger("focused")},_handleBlur:function(){this.trigger("blured")},_handleSpecialKeyEvent:function(a){var b=this.specialKeyCodeMap[a.which||a.keyCode];b&&this.trigger(b+"Keyed",a)},_compareQueryToInputValue:function(){var a=this.getInputValue(),b=f(this.query,a),c=b?this.query.length!==a.length:!1;c?this.trigger("whitespaceChanged",{value:this.query}):b||this.trigger("queryChanged",{value:this.query=a})},destroy:function(){this.$hint.off(".tt"),this.$input.off(".tt"),this.$hint=this.$input=this.$overflowHelper=null},focus:function(){this.$input.focus()},blur:function(){this.$input.blur()},getQuery:function(){return this.query},setQuery:function(a){this.query=a},getInputValue:function(){return this.$input.val()},setInputValue:function(a,b){this.$input.val(a),!b&&this._compareQueryToInputValue()},getHintValue:function(){return this.$hint.val()},setHintValue:function(a){this.$hint.val(a)},getLanguageDirection:function(){return(this.$input.css("direction")||"ltr").toLowerCase()},isOverflow:function(){return this.$overflowHelper.text(this.getInputValue()),this.$overflowHelper.width()>this.$input.width()},isCursorAtEnd:function(){var a,b=this.$input.val().length,d=this.$input[0].selectionStart;return c.isNumber(d)?d===b:document.selection?(a=document.selection.createRange(),a.moveStart("character",-b),b===a.text.length):!0}}),b}(),k=function(){function b(b){c.bindAll(this),this.isOpen=!1,this.isEmpty=!0,this.isMouseOverDropdown=!1,this.$menu=a(b.menu).on("mouseenter.tt",this._handleMouseenter).on("mouseleave.tt",this._handleMouseleave).on("click.tt",".tt-suggestion",this._handleSelection).on("mouseover.tt",".tt-suggestion",this._handleMouseover)}function e(a){return a.data("suggestion")}var f={suggestionsList:'<span class="tt-suggestions"></span>'},g={suggestionsList:{display:"block"},suggestion:{whiteSpace:"nowrap",cursor:"pointer"},suggestionChild:{whiteSpace:"normal"}};return c.mixin(b.prototype,d,{_handleMouseenter:function(){this.isMouseOverDropdown=!0},_handleMouseleave:function(){this.isMouseOverDropdown=!1},_handleMouseover:function(b){var c=a(b.currentTarget);this._getSuggestions().removeClass("tt-is-under-cursor"),c.addClass("tt-is-under-cursor")},_handleSelection:function(b){var c=a(b.currentTarget);this.trigger("suggestionSelected",e(c))},_show:function(){this.$menu.css("display","block")},_hide:function(){this.$menu.hide()},_moveCursor:function(a){var b,c,d,f;if(this.isVisible()){if(b=this._getSuggestions(),c=b.filter(".tt-is-under-cursor"),c.removeClass("tt-is-under-cursor"),d=b.index(c)+a,d=(d+1)%(b.length+1)-1,-1===d)return this.trigger("cursorRemoved"),void 0;-1>d&&(d=b.length-1),f=b.eq(d).addClass("tt-is-under-cursor"),this._ensureVisibility(f),this.trigger("cursorMoved",e(f))}},_getSuggestions:function(){return this.$menu.find(".tt-suggestions > .tt-suggestion")},_ensureVisibility:function(a){var b=this.$menu.height()+parseInt(this.$menu.css("paddingTop"),10)+parseInt(this.$menu.css("paddingBottom"),10),c=this.$menu.scrollTop(),d=a.position().top,e=d+a.outerHeight(!0);0>d?this.$menu.scrollTop(c+d):e>b&&this.$menu.scrollTop(c+(e-b))},destroy:function(){this.$menu.off(".tt"),this.$menu=null},isVisible:function(){return this.isOpen&&!this.isEmpty},closeUnlessMouseIsOverDropdown:function(){this.isMouseOverDropdown||this.close()},close:function(){this.isOpen&&(this.isOpen=!1,this.isMouseOverDropdown=!1,this._hide(),this.$menu.find(".tt-suggestions > .tt-suggestion").removeClass("tt-is-under-cursor"),this.trigger("closed"))},open:function(){this.isOpen||(this.isOpen=!0,!this.isEmpty&&this._show(),this.trigger("opened"))},setLanguageDirection:function(a){var b={left:"0",right:"auto"},c={left:"auto",right:" 0"};"ltr"===a?this.$menu.css(b):this.$menu.css(c)},moveCursorUp:function(){this._moveCursor(-1)},moveCursorDown:function(){this._moveCursor(1)},getSuggestionUnderCursor:function(){var a=this._getSuggestions().filter(".tt-is-under-cursor").first();return a.length>0?e(a):null},getFirstSuggestion:function(){var a=this._getSuggestions().first();return a.length>0?e(a):null},renderSuggestions:function(b,d){var e,h,i,j,k,l="tt-dataset-"+b.name,m='<div class="tt-suggestion">%body</div>',n=this.$menu.find("."+l);0===n.length&&(h=a(f.suggestionsList).css(g.suggestionsList),n=a("<div></div>").addClass(l).append(b.header).append(h).append(b.footer).appendTo(this.$menu)),d.length>0?(this.isEmpty=!1,this.isOpen&&this._show(),i=document.createElement("div"),j=document.createDocumentFragment(),c.each(d,function(c,d){d.dataset=b.name,e=b.template(d.datum),i.innerHTML=m.replace("%body",e),k=a(i.firstChild).css(g.suggestion).data("suggestion",d),k.children().each(function(){a(this).css(g.suggestionChild)}),j.appendChild(k[0])}),n.show().find(".tt-suggestions").html(j)):this.clearSuggestions(b.name),this.trigger("suggestionsRendered")},clearSuggestions:function(a){var b=a?this.$menu.find(".tt-dataset-"+a):this.$menu.find('[class^="tt-dataset-"]'),c=b.find(".tt-suggestions");b.hide(),c.empty(),0===this._getSuggestions().length&&(this.isEmpty=!0,this._hide())}}),b}(),l=function(){function b(a){var b,d,f;c.bindAll(this),this.$node=e(a.input),this.datasets=a.datasets,this.dir=null,this.eventBus=a.eventBus,b=this.$node.find(".tt-dropdown-menu"),d=this.$node.find(".tt-query"),f=this.$node.find(".tt-hint"),this.dropdownView=new k({menu:b}).on("suggestionSelected",this._handleSelection).on("cursorMoved",this._clearHint).on("cursorMoved",this._setInputValueToSuggestionUnderCursor).on("cursorRemoved",this._setInputValueToQuery).on("cursorRemoved",this._updateHint).on("suggestionsRendered",this._updateHint).on("opened",this._updateHint).on("closed",this._clearHint).on("opened closed",this._propagateEvent),this.inputView=new j({input:d,hint:f}).on("focused",this._openDropdown).on("blured",this._closeDropdown).on("blured",this._setInputValueToQuery).on("enterKeyed tabKeyed",this._handleSelection).on("queryChanged",this._clearHint).on("queryChanged",this._clearSuggestions).on("queryChanged",this._getSuggestions).on("whitespaceChanged",this._updateHint).on("queryChanged whitespaceChanged",this._openDropdown).on("queryChanged whitespaceChanged",this._setLanguageDirection).on("escKeyed",this._closeDropdown).on("escKeyed",this._setInputValueToQuery).on("tabKeyed upKeyed downKeyed",this._managePreventDefault).on("upKeyed downKeyed",this._moveDropdownCursor).on("upKeyed downKeyed",this._openDropdown).on("tabKeyed leftKeyed rightKeyed",this._autocomplete)}function e(b){var c=a(g.wrapper),d=a(g.dropdown),e=a(b),f=a(g.hint);c=c.css(h.wrapper),d=d.css(h.dropdown),f.css(h.hint).css({backgroundAttachment:e.css("background-attachment"),backgroundClip:e.css("background-clip"),backgroundColor:e.css("background-color"),backgroundImage:e.css("background-image"),backgroundOrigin:e.css("background-origin"),backgroundPosition:e.css("background-position"),backgroundRepeat:e.css("background-repeat"),backgroundSize:e.css("background-size")}),e.data("ttAttrs",{dir:e.attr("dir"),autocomplete:e.attr("autocomplete"),spellcheck:e.attr("spellcheck"),style:e.attr("style")}),e.addClass("tt-query").attr({autocomplete:"off",spellcheck:!1}).css(h.query);try{!e.attr("dir")&&e.attr("dir","auto")}catch(i){}return e.wrap(c).parent().prepend(f).append(d)}function f(a){var b=a.find(".tt-query");c.each(b.data("ttAttrs"),function(a,d){c.isUndefined(d)?b.removeAttr(a):b.attr(a,d)}),b.detach().removeData("ttAttrs").removeClass("tt-query").insertAfter(a),a.remove()}var g={wrapper:'<span class="twitter-typeahead"></span>',hint:'<input class="tt-hint" type="text" autocomplete="off" spellcheck="off" disabled>',dropdown:'<span class="tt-dropdown-menu"></span>'},h={wrapper:{position:"relative",display:"inline-block"},hint:{position:"absolute",top:"0",left:"0",borderColor:"transparent",boxShadow:"none"},query:{position:"relative",verticalAlign:"top",backgroundColor:"transparent"},dropdown:{position:"absolute",top:"100%",left:"0",zIndex:"100",display:"none"}};return c.isMsie()&&c.mixin(h.query,{backgroundImage:"url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"}),c.isMsie()&&c.isMsie()<=7&&(c.mixin(h.wrapper,{display:"inline",zoom:"1"}),c.mixin(h.query,{marginTop:"-1px"})),c.mixin(b.prototype,d,{_managePreventDefault:function(a){var b,c,d=a.data,e=!1;switch(a.type){case"tabKeyed":b=this.inputView.getHintValue(),c=this.inputView.getInputValue(),e=b&&b!==c;break;case"upKeyed":case"downKeyed":e=!d.shiftKey&&!d.ctrlKey&&!d.metaKey}e&&d.preventDefault()},_setLanguageDirection:function(){var a=this.inputView.getLanguageDirection();a!==this.dir&&(this.dir=a,this.$node.css("direction",a),this.dropdownView.setLanguageDirection(a))},_updateHint:function(){var a,b,d,e,f,g=this.dropdownView.getFirstSuggestion(),h=g?g.value:null,i=this.dropdownView.isVisible(),j=this.inputView.isOverflow();h&&i&&!j&&(a=this.inputView.getInputValue(),b=a.replace(/\s{2,}/g," ").replace(/^\s+/g,""),d=c.escapeRegExChars(b),e=new RegExp("^(?:"+d+")(.*$)","i"),f=e.exec(h),this.inputView.setHintValue(a+(f?f[1]:"")))},_clearHint:function(){this.inputView.setHintValue("")},_clearSuggestions:function(){this.dropdownView.clearSuggestions()},_setInputValueToQuery:function(){this.inputView.setInputValue(this.inputView.getQuery())},_setInputValueToSuggestionUnderCursor:function(a){var b=a.data;this.inputView.setInputValue(b.value,!0)},_openDropdown:function(){this.dropdownView.open()},_closeDropdown:function(a){this.dropdownView["blured"===a.type?"closeUnlessMouseIsOverDropdown":"close"]()},_moveDropdownCursor:function(a){var b=a.data;b.shiftKey||b.ctrlKey||b.metaKey||this.dropdownView["upKeyed"===a.type?"moveCursorUp":"moveCursorDown"]()},_handleSelection:function(a){var b="suggestionSelected"===a.type,d=b?a.data:this.dropdownView.getSuggestionUnderCursor();d&&(this.inputView.setInputValue(d.value),b?this.inputView.focus():a.data.preventDefault(),b&&c.isMsie()?c.defer(this.dropdownView.close):this.dropdownView.close(),this.eventBus.trigger("selected",d.datum,d.dataset))},_getSuggestions:function(){var a=this,b=this.inputView.getQuery();c.isBlankString(b)||c.each(this.datasets,function(c,d){d.getSuggestions(b,function(c){b===a.inputView.getQuery()&&a.dropdownView.renderSuggestions(d,c)})})},_autocomplete:function(a){var b,c,d,e,f;("rightKeyed"!==a.type&&"leftKeyed"!==a.type||(b=this.inputView.isCursorAtEnd(),c="ltr"===this.inputView.getLanguageDirection()?"leftKeyed"===a.type:"rightKeyed"===a.type,b&&!c))&&(d=this.inputView.getQuery(),e=this.inputView.getHintValue(),""!==e&&d!==e&&(f=this.dropdownView.getFirstSuggestion(),this.inputView.setInputValue(f.value),this.eventBus.trigger("autocompleted",f.datum,f.dataset)))},_propagateEvent:function(a){this.eventBus.trigger(a.type)},destroy:function(){this.inputView.destroy(),this.dropdownView.destroy(),f(this.$node),this.$node=null},setQuery:function(a){this.inputView.setQuery(a),this.inputView.setInputValue(a),this._clearHint(),this._clearSuggestions(),this._getSuggestions()}}),b}();!function(){var b,d={},f="ttView";b={initialize:function(b){function g(){var b,d=a(this),g=new e({el:d});b=c.map(h,function(a){return a.initialize()}),d.data(f,new l({input:d,eventBus:g=new e({el:d}),datasets:h})),a.when.apply(a,b).always(function(){c.defer(function(){g.trigger("initialized")})})}var h;return b=c.isArray(b)?b:[b],0===b.length&&a.error("no datasets provided"),h=c.map(b,function(a){var b=d[a.name]?d[a.name]:new i(a);return a.name&&(d[a.name]=b),b}),this.each(g)},destroy:function(){function b(){var b=a(this),c=b.data(f);c&&(c.destroy(),b.removeData(f))}return this.each(b)},setQuery:function(b){function c(){var c=a(this).data(f);c&&c.setQuery(b)}return this.each(c)}},jQuery.fn.typeahead=function(a){return b[a]?b[a].apply(this,[].slice.call(arguments,1)):b.initialize.apply(this,arguments)}}()}(window.jQuery);

    $('#modalCity1').typeahead({
        hint: true,
        highlight: true,
        minLength: 4, 
        valueKey: 'city',
        remote: {
            url:'/admin/default/getCities/id/%QUERY',
            dataType:'json'
        },
        template:  '<p style="font-weight:700"> <span style="font-weight:300;margin-right:3px">{{postcode}}</span>{{city}}</p><table style="width:200px"><tr><td style="font-size:12px;font-weight:400;width:"><span style="width:30px;background-color:#3366CC;color:white;font-weight:700;padding-left:2px;padding-right:2px;border-radius:4px;margin-right:4px">{{county}}</span>{{countyName}}</td></tr></table>',
        engine: Hogan
      });     
      
    $('#modalPost1').typeahead({
        hint: true,
        highlight: true,
        minLength: 3, 
        valueKey: 'postcode',
        remote: {
            url:'/admin/default/getPostcode/id/%QUERY',
            dataType:'json'
        },
        template:  '<p style="font-weight:700"> <span style="font-weight:300;margin-right:3px">{{postcode}}</span>{{city}}</p><table style="width:200px"><tr><td style="font-size:12px;font-weight:400;width:"><span style="width:30px;background-color:#3366CC;color:white;font-weight:700;padding-left:2px;padding-right:2px;border-radius:4px;margin-right:4px">{{county}}</span>{{countyName}}</td></tr></table>',
        engine: Hogan
      });         
      
// ~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~! AUTOCOMPLETE !~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~!~  


//    ------------------------------------------------------------------------------------------
   var giCount = 1; 
    function getTableData(optionId) {
        //var optionId=0;
        $('#example0').dataTable().fnClearTable();
        $('#example1').dataTable().fnClearTable();
        $.ajax({
            url: "/admin/default/getShopList",
            type: "post",
            dataType: 'html',
            data: "data="+optionId,
            success: function(data){
                var outputData=data.split("|");
                var x=0;  
                do {
                   var y=(x*7);
                   var a = $('#example'+optionId).dataTable().fnAddData([
                       outputData[y+1],
                       outputData[y+2],
                       outputData[y+3],
                       outputData[y+4],
                       outputData[y+5],
                       outputData[y+6],
                       outputData[y+7]
                    ]);
                       var nTr = $('#example'+optionId).dataTable().fnSettings().aoData[a[0]].nTr;
                       nTr.className = nTr.className+ " gradeA";
                       giCount++;
                       x++;
                } while( x < outputData[0] );
            },
            error:function(data){
                alert('error');
            }
        });  
    }
//    ------------------------------------------------------------------------------------------    
    function checkThis(id) {
       
        var idValue = $("#"+id);
        var checkVal = idValue.val();
        if (checkVal.length>0) {
            $.ajax({
                url: "/admin/default/validateInput",
                type: "post",
                dataType: 'html',
                data: "data="+id+"|"+idValue.val(),
                success: function(data){
                    if (data==='false') {
                       idValue.attr('style','border-color:red;color:red;background-color:white');
                       idValue.attr('data-val', '0');
                    } else {
                       idValue.attr('style','border:1px solid rgba(10,255,10,0.7);color:yellowgreen;background-color:white'); 
                       idValue.attr('data-val', '1');
                    }
                },
                error:function(data){
                    alert('error');
                }
            });
        } else {
            idValue.attr('style','border-color:red;color:red;background-color:white');
        }
    }
    
    function changeElement(id, type) {
        if (type==='0') {
            $("#"+id).attr('type', 'password');
        } else {
            $("#"+id).attr('type', 'text');
        }    
    }
    function generateRandomPass(iElement) {
        $("#"+iElement).val(randomString(8));
        $("#"+iElement).attr('type', 'text');
    }
    
    function randomString(len, charSet) {
        charSet = charSet || 'abcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz,randomPoz+1);
        }
        return randomString;
    }
    
    function saveNewShop() {
        
        var owners = '';
        $(".companyAddOwner").each(function(key, value) {
            if (key==0) {
                owners = $(value).val();
            } else {
                owners = owners + ";" + $(value).val();
            }
        });

        var ssns = '';
        $(".companyAddSsn").each(function(key, value) {
            if (key==0) {
                ssns = $(value).val();
            } else {
                ssns = ssns + ";" + $(value).val();
            }
        });
        
        var contactsE = '';
        $(".contactAddEmail").each(function(key, value) {
            if (key==0) {
                contactsE = $(value).val();
            } else {
                contactsE = contactsE + ";" + $(value).val();
            }
        });
        
        var contactsP = '';
        $(".contactAddPhone").each(function(key, value) {
           if (key==0) {  
                contactsP = $(value).val();
           } else {
               contactsP = contactsP + ";" + $(value).val();
           }
        });
        
        var a       = GEV("modalShopName");
        var b       = GEV("modalCID");
        var c       = $("#modalShopCategory option:selected").attr("id");
        var d       = GEV("modalVATnumber");
        var e       = GEV("modalCompanyname");
        var f       = GEV("modalOwner1");
        var g       = GEV("modalUsername");
        var h       = GEV("modalPass");
        var i       = GEV("modalAddress1");
        var j       = GEV("modalAddress2");
        var k       = GEV("modalContactInfo");
        var l       = GEV("modalContactEmail");
        var m       = GEV("modalContactTel");
        var n       = GEV("modalOwner2");
        var o       = $("#modalBankName option:selected").attr("id");
        var p       = GEV("modalPost1");
        var r       = GEV("modalCity1");
        var s       = GEV("modalPost2");
        var t       = GEV("modalCity2");
        var u       = GEV("modalBankClearing");
        var v       = GEV("modalBankAcc");
        var w       = GEV("modalBankSwift");
        var z       = GEV("modalBankIban");
        var check1  = $("#modalCheckInstallments").is( ':checked' );
        var check2  = $("#modalCheckInvoice").is( ':checked' );
        var county  = $("#modalCounty option:selected").attr("id");
        if (check1==true) {
            var checkvalue1 = 1;
        } else {
            var checkvalue1 = 0;
        }
        if (check2==true) {
            var checkvalue2 = 1;
        } else {
            var checkvalue2 = 0;
        }
        
        var conSign     = GEV("modalContractSign");
        var conSignEnd  = GEV("modalContractEnd");
        
        var sumAll  = a+"|"+b+"|"+c+"|"+d+"|"+e+"|"+f+"|"+g+"|"+h+"|"+i+"|"+j+"|"+k+"|"+l+"|"+m+"|"+n+"|"+o+"|"+p+"|"+r+"|"+s+"|"+t+"|"+u+"|"+v+"|"+w+"|"+z;
        sumAll = sumAll + "|" + checkvalue1 + "|" + checkvalue2 + "|" + owners + "|" + ssns + "|" + contactsE + "|" + contactsP;
        sumAll = sumAll + "|" + conSign + "|" + conSignEnd + "|" + county;
        
        var sumValidate = 0;
        var saveType = $('#inpSaveType').val();
        if (saveType==='new') {
            var a1 = GDV("modalShopName");
            var a2 = GDV("modalCID");
            var a3 = GDV("modalUsername");
            sumValidate = parseInt(a1)+parseInt(a2)+parseInt(a3);
        } else if (saveType==='edit'){
            sumValidate = 3;
        }
        sumAll = sumAll + "|" + saveType + "|" + $('#currentShop').val();
        console.log(sumAll);
        if (sumValidate===3) {
            $.ajax({
                url: "/admin/default/saveNewShop",
                type: "post",
                dataType: 'html',
                data: "data="+sumAll,
                success: function(data){
                    resetFields();
                    $("#modalShop").fadeOut(100);
                },
                error:function(data){
                    console.log(data);
                }
            });
        } else {
            if (GDV("modalShopName")=="1") {
                $("#modalShopName").attr('style','border-color:red;color:red;background-color:white');
                $("#modalShopName").focus();
            }  
            if (GDV("modalCID")=="1") {
                $("#modalCID").attr('style','border-color:red;color:red;background-color:white');
                $("#modalCID").focus();
            } 
            if (GDV("modalUsername")=="1") {
                $("#modalUsername").attr('style','border-color:red;color:red;background-color:white');
                $("#modalUsername").focus();
            } 
        }
    }
    function resetFields() {
        document.getElementById("modalShopName").value="";
        document.getElementById("modalCID").value="";
        document.getElementById("modalShopCategory").value="";
        document.getElementById("modalVATnumber").value="";
        document.getElementById("modalCompanyname").value="";
        document.getElementById("modalUsername").value="";
        document.getElementById("modalPass").value="";
        document.getElementById("modalAddress1").value="";
        document.getElementById("modalAddress2").value="";
        document.getElementById("modalContactInfo").value="";
        document.getElementById("modalContactEmail").value="";
        document.getElementById("modalContactTel").value="";
        document.getElementById("modalBankName").value="";
        document.getElementById("modalBankAcc").value="";
        document.getElementById("modalPost1").value="";
        document.getElementById("modalCity1").value="";
        document.getElementById("modalPost2").value="";
        document.getElementById("modalCity2").value="";
        document.getElementById("modalBankClearing").value="";
        document.getElementById("modalBankSwift").value="";
        document.getElementById("modalBankIban").value="";
        document.getElementById("modalOwner1").value="";
        document.getElementById("modalOwner2").value="";
        document.getElementById("modalContractSign").value = 0;
        document.getElementById("modalContractEnd").value = 0;
        $("#modalCheckInstallments").removeAttr('checked');
        $("#modalCheckInvoice").removeAttr('checked');
        
        $(".companyAddOwner").each(function(key, value) {
          $(value).val('');
        });

        $(".companyAddSsn").each(function(key, value) {
           $(value).val('');
        });
        
        $(".contactAddEmail").each(function(key, value) {
           $(value).val('');
        });
        
        $(".contactAddPhone").each(function(key, value) {
           $(value).val('');
        });
                
    }
    function GEV(iElement){
        return document.getElementById(iElement).value;
    }
    function GDV(iElement){
        return $('#'+iElement).attr('data-val');
    }
    
    function delShop(id) {
        $("#deleteShopModal #delAction").attr('onclick', 'delAction(\''+id+'\')');
        $("#deleteShopModal").show();
    }
    
    $('body').on('click', '.editBTN', function (){
        $('#tableCompanyInfo').empty();
        $('#tableContactInfo').empty();
        
        editShop($(this).attr('data-id'));
        $('#inpSaveType').val('edit');

    });
    $('body').on('click', '.activeBTN', function (){
        
        var shopid = $(this).attr('data-id');
        $.ajax({
            url: "/admin/default/activateShop",
            type: "post",
            dataType: 'html',
            data: "data="+shopid,
            success: function(data){
                location.reload();
            },
            error:function(data){
                alert('error '+data.toString());
            }
        });

    });
    
    $('.newBTN').on('click', function() {
        resetFields();
        $('#inpSaveType').val('new');
    });
    
    function editShop(id) {
        $.ajax({
            url: "/admin/default/editShop",
            type: "post",
            dataType: 'html',
            data: "data="+id,
            success: function(data){
                 var datas      = JSON.parse(data);
                 var dAddress   = JSON.parse(datas[0].address0);
                 var dAddress1  = JSON.parse(datas[0].address1);
                 var dContacts  = JSON.parse(datas[0].contacts);
                 var dOwners    = JSON.parse(datas[0].owners);
                 $.each(dContacts, function(idx, obj) {
                     addContactInfo(obj.email, obj.phone);
                 });
                 $.each(dOwners, function(idx, obj) {
                     addCompanyInfo(obj.owner, obj.ssn);
                 });  

                 if (datas[0].invoice == '1') {
                     $('#modalCheckInvoice').attr('checked', 'checked');
                 }
                 if (datas[0].installments == '1') {
                     $('#modalCheckInstallments').attr('checked', 'checked');
                 }
                 console.log(datas[0].installments);
                    
                 $('#modalShopName').val(datas[0].account);
                 $('#modalCID').val(datas[0].cid);
                 $('#modalContractSign').val(datas[0].date_signed);
                 $('#modalContractEnd').val(datas[0].date_ended);
                 $('#modalUsername').val(datas[0].username);
                 $('#modalCompanyname').val(datas[0].company_name);
                 $('#modalBankClearing').val(datas[0].bank_clearing);
                 $('#modalBankAcc').val(datas[0].bank_account);
                 $('#modalBankSwift').val(datas[0].bank_swift);
                 $('#modalBankIban').val(datas[0].bank_iban);
                 $('#modalVATnumber').val(datas[0].vat_number);
                 $('#modalContactEmail').val(datas[0].email);
                 $('#modalContactTel').val(datas[0].mobile_number);
                 $('#modalShopCategory').val(datas[0].shop_type_id);
                 $('#modalContactInfo').val(datas[0].contact);
                 $('#modalAddress1').val(dAddress[0].street);
                 $('#modalPost1').val(dAddress[0].post_code);
                 $('#modalCity1').val(dAddress[0].city);
                 $('#modalAddress2').val(dAddress1[0].street);
                 $('#modalPost2').val(dAddress1[0].post_code);
                 $('#modalCity2').val(dAddress1[0].city);
                 $('#modalOwner1').val(datas[0].owner);
                 $('#modalOwner2').val(datas[0].ssn);
                 $('#currentShop').val(datas[0].id);
                 $('#modalShop').show();
            },
            error:function(data){
                alert('error '+data.toString());
            }
        });
    }
    function closeDeleteShopModal() {
        $("#deleteShopModal").hide(); 
    } 
    function delAction(id) {
        $.ajax({
            url: "/admin/default/delShop",
            type: "post",
            dataType: 'html',
            data: "data="+id,
            success: function(data){
                if(data=='ok') {
                    getTableData();
                    closeDeleteShopModal();
                }
            },
            error:function(data){
                alert('error '+data.toString());
            }
        });
    }
</script>

</body>
</html>
