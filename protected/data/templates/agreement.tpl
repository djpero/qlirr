
<div style="text-align: center;">
    <h4 style="font-size:12px;">OBAVIJEST  O SKLOPLJENOM UGOVORU br.{$order->id}</h4>
</div>

<span style="font-size: 12px; font-weight: bold;">Prodavatelj</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ime</h6> {$order->seller->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Prezime</h6> {$order->seller->surname}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adresa</h6> {$customerAddressSeller->street}</td>
            <td width="100px" style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Poštanski broj</h6> {$customerAddressSeller->post_code}</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mjesto</h6> {$customerAddressSeller->city}</td>
        </tr>
        <tr>
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj mobitela</h6> {$order->seller->mobile_number}</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> {$order->seller->email}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> {$order->seller->id_number}</td>                                      
            <td  style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Uvjeti plaćanja</h6> 14 dana (temeljem prihvaćenih općih uvjeta ugovora)</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum prihvaćanja Općih uvjeta ugovora od 20.08.2013.</h6> {$dateSeller}</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum sklapanja ugovora o kupoprodaji</h6> {$dateSeller}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Stranka je prihvatila Opće uvjete ugovora objavljene na stranici</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj ugovora</h6> {$order->id}</td>
        </tr>
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">Kupac</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Ime</h6> {$order->buyer->name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"  width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Prezime</h6> {$order->buyer->surname}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="35%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Adresa</h6>  {$customerAddressBuyer->street}</td>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="15%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Poštanski broj</h6> {$customerAddressBuyer->post_code}</td>                                       
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Mjesto</h6> {$customerAddressBuyer->city}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj mobitela</h6> {$order->buyer->mobile_number}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">E-mail</h6> {$order->buyer->email}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Oib</h6> {$order->buyer->id_number}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Uvjeti plaćanja</h6> 14 dana (temeljem prihvaćenih općih uvjeta ugovora)</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum prihvaćanja Općih uvjeta ugovora od 20.08.2013.</h6> {$dateBuyer}</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Datum sklapanja ugovora o kupoprodaji</h6> {$dateSeller}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Stranka je prihvatila Opće uvjete ugovora objavljene na stranici</h6> www.peydo.com</td>           
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Broj ugovora</h6> {$order->id}</td>
        </tr>
    </tbody>
</table>

<br /><br /><span style="font-size: 12px; font-weight: bold;">Predmet kupoprodajnog ugovora</span><br />
<table class="iTable" cellpadding="5" style="font: 8px Arial, Helvetica, sans-serif;text-align: left;
    border-collapse: collapse;width:100%;margin-bottom:30px;border: 1px solid #ccc;" width="90%">            
    <tbody>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Naziv robe, proizvoda ili usluge</h6> {$orderItem->product_name}</td>                                      
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" width="50%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Kupoprodajna cijena (HRK)</h6> {$orderItem->price}</td>
        </tr>
        <tr>
            <td style="padding: 2px 3px;text-align: left;border-bottom:1px solid #ccc;border-right:1px solid #ccc;font-weight:bold;font-size:8px;word-break:break-all;" colspan="2" width="100%"><h6 style="font-size:7px;font-weight:normal;margin-bottom:10px;">Šifra oglasa</h6>
                {$order->order_reference}
            </td>
        </tr>                
    </tbody>
    </table>