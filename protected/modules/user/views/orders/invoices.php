<?php 
    $orderID = $_GET['id'];

    $shopId   = Yii::app()->session['userIDm'];
    $myPass   = Yii::app()->session['userIDp'];
    $shop     = ShopsDao::getShopById($shopId);
    if (isset(Yii::app()->session['userIDm'])) {
        if (isset(Yii::app()->session['userIDp'])) {
            if ($shop->password !== $myPass) {
                $this->redirect('/user/login');
            } 
        } else {
            $this->redirect('/user/login');
        }
    } else {
        $this->redirect('/user/login');
    }

?>
<!DOCTYPE html>
<html lang="se" class="full">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Klirrr</title>

    <!-- Bootstrap core CSS -->
    <link href="/themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/frontend/css/bootstrap-theme.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
  </head>
<!-- NAVBAR
================================================== -->
<body class="full">
    <input id="myPass" hidden value="<?php echo $myPass;?>" />
    <input id="inputUser" hidden value="<?php echo $shop->shop_id;?>" />
    <input id="inputOrder" hidden value="<?php echo $order->id;?>" />
    <div class="container" style='width:100%'>
        <div id="stickyribbon" class="col-md-12 sticky" >
            <div class="row">
                <div class="col-xs-10" align="left" style="padding-left:3px;padding-right:0px;padding-top: 5px">
                    <img src="/themes/frontend/gfx/logo90.png" style='float:left;margin-right:14px'/>
                     <p style="font-size:14px;color:#777;margin-bottom: 0px;font-weight: 900;margin-top:6px"><span style="font-weight: 400;color:#999">Butik: </span><?php echo $shop->name ?></p>
                     <p style="font-size:14px;color:#777;font-weight: 900"><span style="font-weight: 400;color:#999">Butiks-ID: </span><?php echo $shop->shop_id ?></p>
                </div>
                <div class="col-xs-2 mobileMenuIcon" align="right">
                    <i class="fa fa-bars" onclick="showMenu();" style="margin-top:11px"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="full " style="padding-top:78px;">
     <div class="container" style="height:100%;width:100%">
       <div id="test1"  class="row">
           
           <div class="col-md-12 headerinfo" style="vertical-align: middle">

                   <div class='col-md-8 col-md-offset-2'>
                       <p id="pcountOrdersR" style='margin-top:0px;padding-top:16px'>Fakturor</p>
                        <p id="infotext" style="margin-top:0px!important">Sök med hjälp av referensnummer, datum eller belopp</p>
                        <div class="col-md-6 col-md-offset-3 transSearch"> 
                            <i class="fa fa-search" onclick="startSearch()"></i><input id="searchValue" type="search"  class="form-control" placeholder="Sök" />
                        </div>
                   </div>

           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-left:0px;">
               <i class="fa fa-caret-down" style="position: relative;top:-33px;color:#5cc6fe;font-size:80px"></i>
               <p style="font-size:18px;font-weight: 900; color:#444;padding-left:22px;position:relative;top:-24px;">Fakturor<span id="psearchCondition" style="font-weight: 300"> - Alla</span></p>
           </div>
           <div class="col-md-8 col-md-offset-2" style="padding-top:0px;">
               <div id="offerList" style="margin-top:0px;z-index:-1;margin-left:22px;margin-right:22px" >
                   <!--------------------------------OVDJE IDE LISTA SVIH PONUDA------------------------------->
                   
                  <table id="tableFaktura" class="tableFaktura" style="width:100%">

                    <tr style="padding-bottom: 3px;">
                      <th>FAKTURANUMMER</th>
                      <th>DATUM</th>
                      <th>AKTION</th>
                    </tr>
                    
                    <!--~~~~~~~~~~~~~~~~~ OVDJE IDE PHP ~~~~~~~~~~~~~~~~~-->
                    <?php
                        $invoices = InvoiceDao::getInvoicesByShop($shop->id);
                        $x=0;
                        
                        
                        
                        if (count($invoices)>0) {
                            do {
                                $path = Yii::app()->basePath.'/documents/pdf/agreements/invoice_s_'.substr(date('Y'),-2).$invoices[$x]->id.'.pdf';
                                $pdf = Yii::app()->assetManager->publish($path);
                                
                                $dateNew = new DateTime($invoices[$x]->date_issued);
                                $output = '<tr>';
                                $output = $output.'<td>'.$invoices[$x]->id.'</td><td style="text-align:center;">'.date_format($dateNew, 'Y-m-d').'</td><td><a style="cursor:pointer" onclick="viewInvoice('.$invoices[$x]->id.');"><i class="fa fa-cloud-download" style="font-size:18px"></i></a> <a href="'.$pdf.'"><i class="fa fa-eye" style="font-size:18px"></i></a> </td></tr>';
                                echo $output;
                                $x++;
                            } while ($x<count($invoices));
                        }
                    ?>
                    <!--~~~~~~~~~~~~~~~~~ OVDJE IDE PHP ~~~~~~~~~~~~~~~~~-->

                  </table>
                   <!--------------------------------OVDJE IDE LISTA SVIH PONUDA------------------------------->
               </div>
           </div>
       </div>
      </div>
    </div>
    <div onclick='closeMenu()' class="blackMenu"></div>
    <div id="mobileMenu" class="mobileMenu" data-tag="0">
        <div align='right' style='margin-bottom: 30px'><p style='margin-right:14px;font-weight:300;font-size:28px;line-height:48px;cursor:pointer' onclick='closeMenu()'><i class="fa fa-times"></i> </p></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders">Ta emot betalning</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/transactions">Transaktionshistorik</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/orders/invoices" class="active">Fakturor</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile">Profil</a></div>
        <div style="margin-bottom:4px;margin-left:14px"> <a href="/user/profile/logout">Logga ut</a></div>

    </div>
    

    <div class="modal fade" id="offerYesNo" tabindex="-1" role="dialog" aria-labelledby="enter-pin-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Avbryta affär</h4>
          </div>
          <div class="modal-body">
            <div id="completePin"> 
                <p>Vill du avbryta affär</p>
                <div class="row">
                    <div class="col-md-2 offset2"></div>
                  <div class="col-md-4">
                    <a onclick="cancelOffer();" class="btn btn-primary btn-lg btn-block" id="submit-pin-btn">Ja</a>
                  </div>
                  <div class="col-md-4">
                    <a onclick="$('#offerYesNo').modal('toggle');" class="btn btn-danger btn-lg btn-block" id="submit-pin-btn">Nej</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/themes/frontend/js/bootstrap.min.js"></script>
    <script src="/themes/frontend/js/application.js"></script>
<script>
   
    function startSearch() {
        var a = document.getElementById('searchValue').value;
        if (a==="" || a===" ") {
            $("#searchValue").attr('style', 'border-color:red');
            $("#tableFaktura").fadeOut(200, function(){
                  $(this).empty();
            });
            $("#psearchCondition").html(' - Search: ');
        } else {
            $("#tableFaktura").fadeOut(200, function(){
                  $(this).empty();
            });
            getList();
        }
    } 
  
    $("#searchValue").on("keydown", function(e) {
        if(e.which === 13) {
            startSearch();
        } else {
            $("#searchValue").attr('style', 'border-color:rgba(0,0,0,0.2)');
        }
    });

   
  function getList() {
        var a = document.getElementById('searchValue').value;    
        var b = document.getElementById('inputUser').value;   
        
        $.ajax({
            url: '/user/orders/getSearchListFaktura',
            type: 'post',
            dataType: 'html',
            data: 'data='+a+"|"+b,
            async: false,
            success: function(data) {
                
                 $("#psearchCondition").html(' - Search: <span style="font-style:italic;color:black">'+a+'</span>');  
                 $("#offerList").empty();
                 $("#offerList").append(data);
            },
            error:function(data){
             //  alert("Error: "+data);
           } 
        });
  }
  
    function viewInvoice(invoiceID) {
        var a = invoiceID;    
//        $.post('/user/orders/viewInvoice/id/'+a);
        window.location = '/user/orders/downloadInvoice/id/'+a;
  }
  
  function showMenu(){
        var a = $("#mobileMenu").attr('data-tag');

        if (a==="0") { 
            $("#mobileMenu").addClass('showMenu');
            $("#mobileMenu" ).attr('data-tag', '-130');
            $(".blackMenu").fadeIn('fast');
            $("#test1").removeClass('pullright');
            $("#test1").addClass('pullleft');
            $("#stickyribbon").removeClass('pullright');
            $("#stickyribbon").addClass('pullleft');
            

         } else {
              closeMenu();
         }

    }
    
    function closeMenu() {
            $("#mobileMenu").removeClass('showMenu');
            $("#mobileMenu" ).attr('data-tag', '0');
            $("#stickyribbon").removeClass('pullleft');
            $("#stickyribbon").addClass('pullright');
            $("#test1").removeClass('pullleft');
            $("#test1").addClass('pullright');
            $(".blackMenu").fadeOut('fast');
    }
    
    
</script>
</body>
</html>