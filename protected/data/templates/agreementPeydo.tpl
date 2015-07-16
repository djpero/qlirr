<div>
    <img src=""  />
</div>
<div style="text-align: center;">
    <h4 style="font-size:12px;">KÖPEKONTRAKT Nr. <span style="font-weight:bolder;">{$order->id}</span> FÖR KÖP AV VARA MED PEYDO</h4>
</div>

<span style="font-size: 12px; font-weight: bold;">Säljare</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namn</h6> {$order->seller->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Efternamn</h6> {$order->seller->surname}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adress</h6>  {$customerAddressSeller->street}</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Postnummer</h6> {$customerAddressSeller->post_code}</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ort</h6> {$customerAddressSeller->city}</td>
        </tr>
        <tr>
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mobiltelefonnummer</h6> {$order->seller->mobile_number}</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Identifieringssätt</h6> {$order->seller->email}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Personnummer</h6> {$order->seller->id_number}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Gällande villkor</h6>{$bank_ac_name_seller}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Totalt summa att erhålla av Peydo AB (SEK) </h6> {$order->date_issued}</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Fordringsägare</h6> {$order->date_issued}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kontraktsdatum</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kontraktsnummer</h6> {$order->id}</td>
        </tr>
      
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">Köpare</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namn</h6> {$order->buyer->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Efternamn</h6> {$order->buyer->surname}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adress</h6>  {$customerAddressBuyer->street}</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Postnummer</h6> {$customerAddressBuyer->post_code}</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ort</h6> {$customerAddressBuyer->city}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mobiltelefonnummer</h6> {$order->buyer->mobile_number}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Identifieringssätt</h6> {$order->buyer->email}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Personnummer</h6> {$order->buyer->id_number}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Gällande villkor</h6>{$bank_ac_name_buyer}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Total summa att betala till Peydo AB (SEK)</h6> {$order->date_accepted}</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Fordringsägare</h6> {$order->date_issued}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kontraktsdatum</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kontraktsnummer</h6> {$order->id}</td>
        </tr><tr>
          <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:7px;word-break:break-all;" colspan="3"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Terms of payment</h6>14 days</td>
        </tr>
    </tbody>
</table>

<p><br />
  <br />
  <span style="font-size: 12px; font-weight: bold;">Köpekontraktet omfattar vara enligt följande beskrivning</span><br />
</p>
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
  <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Annonsens rubrik </h6> {$merchant->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Köpeskilling (SEK)</h6> {$order->total_amount}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="100%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Beskrivning av varan och varans skick</h6>
                {$order->order_reference}
            </td>
        </tr>                
    </tbody>
    </table>
	
<p><br />
  <br />
  <span style="font-size: 12px; font-weight: bold;">Kvitteras om annan leverans än post- eller paketförsändelse</span><br />
</p>
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
  <tbody>
         <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ort och datum, Säljare</h6> {$order->buyer->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ort och datum, Köpare</h6> {$order->buyer->surname}</td>
        </tr>   
		<tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namnteckning, Säljare</h6> {$order->buyer->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namnteckning, Köpare</h6> {$order->buyer->surname}</td>
        </tr>
		<tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namnförtydligande, Säljare</h6> {$order->buyer->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:9px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Namnförtydligande, Köpare</h6> {$order->buyer->surname}</td>
        </tr>		
    </tbody>
    </table>
	