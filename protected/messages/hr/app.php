<?php
    return array(
        'mobile.number.email' => 'Broj mobitela ili e-mail',
        'mobile.number.password' => 'Nova lozinka',
        'mobile.number.confirm_password' => 'Potvrdite lozinku',

        //translations for models

        'model.description' => 'Opis',
        'model.users.name' => 'Ime', 
        'model.users.surname' => 'Prezime', 
        'model.users.password' => 'Lozinka', 
        'model.users.old_password' => 'Stara lozinka', 
        'model.users.repeat_password' => 'Ponovi lozinku', 
        'model.users.email' => 'E-mail adresa', 
        'model.users.gender' => 'Spol', 
        'model.users.age' => 'Starost', 
        'model.users.create_at' => 'Registrovan', 
        'model.users.userType_id' => 'Tip korisnika', 
        'model.users.mob_prefix' => 'Mobilni prefiks', 
        'model.users.mobile' => 'Broj mobitela', 
        'model.users.id_number' => 'OIB', 
        'model.users.personal_number' => 'JMBG ili Broj osobne iskaznice', 
        'model.users.country' => 'Država', 
        'model.users.credit_limit' => 'Kreditni limit', 
        'model.users.creditLimit_date' => 'Limit vrijedi do', 
        'model.users.newsletter' => 'Vijesti', 
        'model.users.percentage' => 'Verifikovan', 

        'model.login.username' => 'E-mail ili mobitel', 
        'model.login.remember_login' => 'Zapamti me sljedeći put', 

        'model.orders.code' => 'Kod', 
        'model.orders.date_issued' => 'Datum žalbe', 
        'model.orders.date_accepted' => 'Datum prihvaćanja', 
        'model.orders.date_sent' => 'Datum preuzimanja', 
        'model.orders.date_delivered' => 'Datum dostavljanja', 
        'model.orders.time_created' => 'Vrijeme kreiranja', 
        'model.orders.reference' => 'Šifra oglasa', 
        'model.orders.country_id' => 'Država', 
        'model.orders.buyer_id' => 'Kupac', 
        'model.orders.seller_id' => 'Prodavac', 
        'model.orders.orderStatus_id' => 'Status narudžbe', 
        'model.orders.service_id' => 'Tip servisa', 
        'model.orders.service' => 'Tip servisa', 
        'model.orders.paymentMethod_id' => 'Način plaćanja', 
        'model.orders.shippingAddress_id' => 'Adresa za dostavu', 
        'model.orders.total_amount' => 'Ukupno', 
        'model.orders.website' => 'Web stranica', 
        'model.orders.tracking_number' => 'Tracking Number', 
        'model.orders.reason' => 'Razlog', 
        'model.orders.comment' => 'Komentar', 

        'model.country.name' => 'Država', 
        'model.country.default_currency' => 'Zadana valuta', 
        'model.country.default_language' => 'Zadani jezik', 
        'model.country.time_created' => 'Vrijeme dodavanja', 
        'model.country.vat' => 'Porez', 

        'model.account.income' => 'Ukupno dugovanje', 
        'model.account.income_net' => 'Neto dugovanje', 
        'model.account.income_var' => 'PDV', 
        'model.account.outgoing_net' => 'Neto potražnja', 
        'model.account.outgoing_vat' => 'PDV', 
        'model.account.from_account' => 'Isplaćeno sa', 
        'model.account.to_account' => 'Račun primatelja', 
        'model.account.booking_time' => 'Vrijeme uplate', 
        'model.account.outgoing' => 'Ukupno potražnja', 
        'model.account.unique_ref' => 'Poziv na plaćanje', 
        'model.account.date_document' => 'Datum dokumentiranja', 
        'model.account.date_due' => 'Rok dospijeća', 
        'model.account.vat' => 'PDV', 
        'model.account.comment' => 'Komentar', 
        'model.account.description' => 'Opis', 
        'model.account.time_created' => 'Vrijeme izdavanja', 

        'model.bank.account' => 'Bankovni račun', 
        'model.bank.full_name' => 'Ime banke', 
        'model.bank.code' => 'Šifra banke', 
        'model.bank.primary' => 'Primarni', 

        'model.currency.code' => 'Šifra valute', 
        'model.currency.name' => 'Naziv valute', 
        'model.currency.symbol' => 'Simbol valute', 

        'model.email_temp.recipient_type' => 'Tip primaoca', 
        'model.email_temp.country_id' => 'Država', 
        'model.email_temp.subject' => 'Naslov', 
        'model.email_temp.econtent' => 'Sadržaj', 
        'model.email_temp.time_created' => 'Vrijeme izrade', 
        'model.email_temp.sender_name' => 'Ime pošiljatelja', 
        'model.email_temp.sender_email' => 'Email pošiljatelja', 

        'model.invoice.status' => 'Invoice status', 
        'model.invoice.number' => 'Invoice broj', 
        'model.invoice.date_issued' => 'Datum žalbe', 
        'model.invoice.date_due' => 'Rok dospijeća', 
        'model.invoice.time_created' => 'Vrijeme izdavanja', 

        'model.invoice.item_name' => 'Naziv', 
        'model.invoice.item_amount' => 'Količina', 
        'model.invoice.total_amount' => 'Ukupno', 
        'model.invoice.tax_rate' => 'Kamatna stopa', 
        'model.invoice.time_created' => 'Vrijeme izdavanja', 

        'model.mobile_prefix.name' => 'Prefiks', 
        'model.mobile_prefix.value' => 'Vrijednost', 

        'model.msg_types.name' => 'Opis poruke', 

        'model.order_item.product_name' => 'Naziv proizvoda', 
        'model.order_item.product_description' => 'Opis proizvoda', 
        'model.order_item.qty' => 'Količina', 
        'model.order_item.price' => 'Cijena', 
        'model.order_item.tax_rate' => 'Kamatna stopa', 
        'model.order_item.time_created' => 'Vrijeme kreiranja', 

        'model.order_status.name' => 'Status narudžbe', 

        'model.service.name' => 'Vrsta usluge', 

        'model.user_address.type' => 'Adrese korisnika', 
        'model.user_address.active' => 'Aktivna', 
        'model.user_address.street' => 'Adresa', 
        'model.user_address.country_id' => 'Država', 
        'model.user_address.post_code' => 'Poštanski broj', 
        'model.user_address.city' => 'Mjesto', 
        'model.user_address.region' => 'Županija', 
        'model.user_address.time_created' => 'Vrijeme dodavanja adrese', 
        'model.user_address.primary' => 'Primarna adresa', 
        'model.user_address.primary_change' => 'Označi ovu adresu kao primarnu', 
        'model.user_address.address_type' => 'Tip adrese', 

        'model.user_history.name' => 'Ime', 
        'model.user_history.surname' => 'Prezime', 
        'model.user_history.password' => 'Lozinka', 
        'model.user_history.email' => 'Email adresa', 
        'model.user_history.identnumber' => 'Identifikacijski broj', 
        'model.user_history.mobile' => 'Mobitel', 
        'model.user_history.gender' => 'Spol', 
        'model.user_history.credit_limit' => 'Kreditni limit', 

        'model.user_messages.new' => 'Nova poruka', 
        'model.user_messages.subject' => 'Naslov', 
        'model.user_messages.receiver_id' => 'Primalac', 
        'model.user_messages.sender_id' => 'Pošiljatelj', 
        'model.user_messages.msgType_id' => 'Tip poruke', 
        'model.user_messages.content' => 'Sadržaj', 
        'model.user_messages.time_created' => 'Vrijeme slanja', 

        'model.user_types.name' => 'Ime korisnika',

        'model.document_temp.document_type' => 'Tip dokumenta',
        'model.document_temp.lang' => 'Jezik',
        'model.document_temp.memo_header' => 'Zaglavlje',
        'model.document_temp.memo_footer' => 'Podnožje',
        'model.document_temp.time_created' => 'Vrijeme kreiranja',
        'model.document_temp.template_name' => 'Naziv predloška',

        'model.app_settings.setting_name' => 'Naziv podešavanja',
        'model.app_settings.setting_type' => 'Tip podešavanja',
        'model.app_settings.setting_value' => 'Vrijednost podešavanja',
        'model.app_settings.time_updated' => 'Vrijeme izmjene',

        'model.service_fees.service_id' => 'Tip servisa',
        'model.service_fees.from' => 'Od',
        'model.service_fees.to' => 'Do',
        'model.service_fees.fixed' => 'Fiksno',
        'model.service_fees.percentage' => 'Postotak',

        'model.payouts.user_id' => 'Korisnik',
        'model.payouts.order_id' => 'Narudžba/ponuda',
        'model.payouts.amount' => 'Količina',
        'model.payouts.payment_date' => 'Datum plaćanja',
        'model.payouts.payment_notice' => 'Poziv na plaćanje',
        'model.payouts.time_created' => 'Vrijeme kreiranja',

        'model.payment_notice.time_created' => 'Vrijeme kreiranja',
        'model.payment_notice.user_id' => 'Korisnik',
        'model.payment_notice.order_id' => 'Narudžba/ponuda',
        'model.payment_notice.service_id' => 'Tip servisa',
        'model.payment_notice.type' => 'Tip',
        'model.payment_notice.comment' => 'Komentar',
        'model.payment_notice.date_due' => 'Rok dospijeća',
        'model.payment_notice.date_issued' => 'Datum žalbe',
        'model.payment_notice.currency_code' => 'Valuta',
        'model.payment_notice.min_amount' => 'Minimalan iznos',
        'model.payment_notice.total_amount' => 'Ukupno',


        //translations for views
        'customer.profile.post_code_city' => 'Poštanski broj i mjesto',
        'customer.profile.deactivate' => 'Deaktiviraj račun',
        'customer.profile.deactivate_are_you_sure' => 'Da li ste sigurni da želite deaktivirati račun?',

        'customer.default.my_profile' => 'Moj profil',
        'customer.default.change_profile' => 'Izmjenite profil',
        'customer.default.name_surname' => 'Ime i prezime',
        'customer.default.address' => 'Adresa',
        'customer.default.email' => 'E-mail',
        'customer.default.mobile' => 'Broj mobitela',
        'customer.default.my_account' => 'Moj račun',
        'customer.default.fill_wallet' => 'Napunite novčanik',
        'customer.default.approved_limit' => 'Odobreni limit',
        'customer.default.currency_available' => 'Na raspolaganju',
        'customer.default.currency_reserved' => 'Rezervirani iznos',
        'customer.default.currency_spent' => 'Trenutno koristite',
        'customer.default.my_mail' => 'Moja pošta',
        'customer.default.new_messages' => 'novih poruka.',
        'customer.default.no_new_messages' => 'Nemate novih poruka',
        'customer.default.my_purchase_my_sales' => 'Moje kupnje & prodaje',
        'customer.default.my_orders' => 'Moje narudžbe',
        'customer.default.my_offers' => 'Moje ponude',
        'customer.default.my_offer' => 'Moja ponuda',
        'customer.default.my_sales' => 'Moje prodaje',
        'customer.default.my_payments' => 'Moje isplate',
        'customer.default.enter_and_see' => 'Uđite i pogledajte',
        'customer.default.read_more' => 'Pročitaj više',
        'customer.default.how_postpay_works' => 'Kako funkcionira PostPay?',
        'customer.default.was_born' => 'Rođen/a sam',
        'customer.default.before' => 'prije',
        'customer.default.days' => 'dana',
        'customer.default.send' => 'Pošalji',

        'customer.instantor.write_address' => 'Upis adrese',
        'customer.instantor.please_enter_address' => 'Molimo Vas unesite Vašu adresu stanovanja kako bi započeli identifikaciju.',
        'customer.instantor.street' => 'Ulica',
        'customer.instantor.postal_code' => 'Poštanski broj',
        'customer.instantor.city' => 'Grad',
        'customer.instantor.form_save' => 'Sačuvaj',
        'customer.instantor.failed_identification' => 'Nažalost nismo bili u mogućnosti obaviti uspješnu identifikaciju.',
        'customer.instantor.suceeded_identification' => 'Uspješno ste se indetificirali',
        'customer.instantor.suceeded_change_mobile' => 'Čestitamo! Uspješno ste promijenili broj mobitela',
        'customer.instantor.congratulations' => 'Čestitamo!',
        'customer.instantor.write_mobile' => 'Upišite novi broj mobitela',
        'customer.instantor.mobile' => 'Broj mobitela',
        'customer.instantor.region' => 'Županija',

        'customer.messages.delete' => 'Briši',
        'customer.messages.date' => 'Datum',
        'customer.messages.title' => 'Naslov',
        'customer.messages.content' => 'Sadržaj',
        'customer.messages.subject' => 'Predmet',
        'customer.messages.user' => 'Korisnik',
        'customer.messages.no_messages' => 'Nema poruka.',

        'customer.orders.purchases' => 'Kupnje',
        'customer.orders.download_payment' => 'Skini Račun',
        'customer.orders.download_contract' => 'Skini Ugovor',
        'customer.orders.download_paymentNotice' => 'Skini Ugovor',
        'customer.orders.show_contract' => 'Prikaži Ugovor',
        'customer.orders.show_payment' => 'Prikaži Račun',
        'customer.orders.details' => 'Detalji',
        'customer.orders.buyer_data' => 'Podatci o kupcu',
        'customer.orders.reciver_data' => 'Podatci o primatelju',
        'customer.orders.seller_data' => 'Podatci o prodavatelju',
        'customer.orders.sender_data' => 'Podatci o pošiljatelju',
        'customer.orders.want_to_send_from' => 'Želite poslati paket s druge adrese?',
        'customer.orders.shipment_data' => 'Podatci o pošiljci',
        'customer.orders.date_wanted' => 'Željeni datum',
        'customer.orders.time_start' => 'Početno vrijeme',
        'customer.orders.time_stop' => 'Završno vrijeme',
        'customer.orders.sending_manual' => 'Uputa dostavljaču',
        'customer.orders.shipment_description' => 'Opis robe',
        'customer.orders.dimensions' => 'Dimenzije paketa',
        'customer.orders.weight' => 'Težina paketa',
        'customer.orders.sent' => 'Poslana',
        'customer.orders.sent_offers' => 'Proslijeđene ponude',
        'customer.orders.received' => 'Primljena',
        'customer.orders.received_offers' => 'Primljene ponude',
        'customer.orders.view_offer' => 'Pogledaj ponudu',
        'customer.orders.stop_offer' => 'Otkaži ponudu',
        'customer.orders.my_offers_sent_received' => 'Moje ponude (poslane/primljene)',
        'customer.orders.product' => 'Proizvod',
        'customer.orders.date_offer' => 'Datum ponude',
        'customer.orders.offer_expires' => 'Ponuda ističe za',
        'customer.orders.sent_received_offer' => 'Poslana/primljena ponuda',
        'customer.orders.status' => 'Status',
        'customer.orders.sales' => 'Prodaje',
        'customer.orders.contracts' => 'Ugovori',
        'customer.orders.bills' => 'Računi',
        'customer.orders.report_fraud' => 'Prijava prijevare',
        'customer.orders.sales_and_purchases' => 'Pogledaj svoje kupnje & prodaje',
        'customer.orders.pays' => 'Plaćanja',
        'customer.orders.ads' => 'Oglasi',
        'customer.orders.price' => 'Kupoprodajna cijena',
        'customer.orders.actions' => 'Akcije',
        'customer.orders.tracking_number' => 'Tracking number',
        'customer.orders.sender' => 'Prodavatelj',
        'customer.orders.contract' => 'Ugovor',
        'customer.orders.date_contract' => 'Datum ugovora',
        'customer.orders.no_offers' => 'Nemate ponude',
        'customer.orders.no_contracts' => 'Nemate račun',
        'customer.orders.no_orders' => 'Nemate narudžbi',
        'customer.orders.my_orders' => 'Moje narudžbe',
        'customer.orders.my_sales' => 'Moje prodaje',
        'customer.orders.no_sales' => 'Nemate prodaje',
        'customer.orders.buyer' => 'Kupac',
        'customer.orders.seller' => 'Prodavatelj',
        'customer.orders.payment_notice_buy' => "Poziv na plaćanje kupnja",     
        'customer.orders.payment_notice_service' => "Poziv na plaćanje usluga",     
        'customer.orders.due_date' => "Datum dospijeća",     
        'customer.orders.my_payments' => 'Moje isplate',
        'customer.orders.payments' => 'Isplate',
        'customer.orders.new_offer' => 'Novih ponuda',
        'customer.orders.date_payment' => 'Datum isplate',
        'customer.orders.amount' => 'Iznos',
        'customer.orders.no_payments' => 'Nemate isplata',
        'customer.orders.description' => 'Opis',
        'customer.orders.finish_profile' => 'Dovršite profil',
        'customer.orders.finish_profile' => 'Dovršite profil',
        'customer.orders.allow' => 'Prihvati',
        'customer.orders.delete' => 'Obriši',
        'customer.orders.last_ad' => 'Zadnji oglas',
        'customer.orders.finished_to_see_please' => 'dovršen. Da bi vidjeli ponudu, molimo Vas',
        'customer.orders.are_you_sure' => 'Da li ste sigurni da želite odbiti ponudu? <br/> Ako želite, upišite razlog.',
        'customer.orders.your_profile_is' => 'Kako biste prihvatili ponudu potrebno je obaviti verifikaciju. Verificiraj se',
        'customer.orders.here' => 'ovdje',
        'customer.orders.reject_offer' => 'Odbij',
        'customer.orders.new_address' => 'Nova adresa',
        'customer.orders.contract_number' => 'Broj ugovora',
        'customer.orders.reclamation' => 'Prijave prijevara',
        'customer.orders.shipping' => 'Naruči dostavu',
        'customer.orders.send_reclamation' => 'Prijavi prijevaru',
        'customer.orders.cancel_contract' => 'Raskini ugovor',

        'customer.profile.save' => 'Sačuvaj',
        'customer.profile.name_msg' => 'Ukoliko ste iz nekog razloga promijenili ime ili prezime, možete ga ovdje ažurirati.',
        'customer.profile.address_msg' => 'Ukoliko ste iz nekog razloga promijenili mjesto prebivališta, možete ga ovdje ažurirati.',
        'customer.profile.mobile_msg' => 'Ukoliko želite promijeniti broj mobitela, potrebno je obaviti novu verifikaciju.',
        'customer.profile.email_msg' => 'Nakon što ste poslali podatke o promjeni e-maila, primit će te SMS kod na broj mobitela $mobile$. Upišite SMS kod u naznačeno polje kako bi potvrdili promjenu.',
        'customer.profile.password_msg' => 'Nakon što ste poslali podatke o promjeni lozinke, primit će te SMS kod na broj mobitela $mobile$. Upišite SMS kod u naznačeno polje kako bi potvrdili promjenu.',
        'customer.profile.bank_account_msg' => 'Ukoliko želite promjeniti broj bankovnog računa, potrebno je obaviti novu verifikaciju.',
        'customer.profile.this_account_money' => 'Na ovaj račun primate novac',
        'customer.profile.old_password' => 'Stara lozinka',
        'customer.profile.change_mobile' => 'Uredi broj mobitela',
        'customer.profile.updated_before' => 'Ažurirano prije ',
        'customer.profile.user_account_open' => 'Račun je aktiviran',
        'customer.profile.shipping_addresses' => 'Pakete primam na ovu adresu',
        'customer.profile.main_address' => 'Glavna adresa korisnika.',
        'customer.profile.sending_addresses' => 'Pakete šaljem s ove adrese',
        'customer.profile.not_changed' => 'Nije mijenjana',
        'customer.profile.new_email' => 'Nova e-mail adresa',
        'customer.profile.code' => 'Upišite SMS kod koji ste primili na broj Vašeg mobitela',
        'customer.profile.repeat_email' => 'Ponovi e-mail adresu',
        'customer.profile.my_profile' => 'Moj profil',
        'customer.profile.view_your_account' => 'Pregledaj svoj račun',
        'customer.profile.change_data' => 'Promijeni podatke',
        'customer.profile.primary' => 'Označi ovu adresu kao primarnu',
        'customer.profile.primary_bank' => 'Koristi ovaj račun',
        'customer.profile.last_change' => 'Zadnja promjena: ',
        'customer.profile.want_change_name' => 'Želite promijeniti ime?',
        'customer.profile.want_change_mobile' => 'Želite promijeniti broj mobitela?',
        'customer.profile.want_change_email' => 'Želite promijeniti e-mail adresu?',
        'customer.profile.want_change_bank_account' => 'Želite promijeniti broj bankovnog računa?',
        'customer.profile.want_change_password' => 'Želite promijeniti lozinku?',
        'customer.profile.want_change_residence' => 'Želite promijeniti prebivalište?',
        'customer.profile.verification_needed_name' => 'Kako bi odobrili promjenu imena potrebno je obaviti veriﬁkaciju.',
        'customer.profile.verification_needed_password' => 'Kako bi odobrili promjenu lozinke potrebno je obaviti veriﬁkaciju.',
        'customer.profile.verification_needed_bank_account' => 'Kako bi odobrili promjenu broja bankovnog računa potrebno je obaviti veriﬁkaciju.',
        'customer.profile.verification_needed_mobile' => 'Kako bi odobrili promjenu broja mobitela potrebno je obaviti veriﬁkaciju.',
        'customer.profile.verification_needed_email' => 'Kako bi odobrili promjenu e-mail adrese potrebno je obaviti veriﬁkaciju.',
        'customer.profile.verification_needed_residence' => 'Kako bi odobrili promjenu novog prebivališta potrebno je obaviti veriﬁkaciju.',

        'customer.wallet.last_verification' => 'Zadnja verifikacija: ',
        'customer.wallet.last_purchase' => 'Zadnja kupnja: ',
        'customer.wallet.last_sale' => 'Zadnja prodaja: ',
        'customer.wallet.last_payout' => 'Zadnja isplata: ',
        'customer.wallet.last_bill' => 'Zadnji račun: ',
        'customer.wallet.last_contract' => 'Zadnji ugovor: ',
        'customer.wallet.last_ad' => 'Zadnji oglas: ',
        'customer.wallet.last_report_fraud' => 'Zadnja prijava: ',
        'customer.wallet.no_report_frauds' => 'Nemate prijave',
        'customer.wallet.no_contracts' => 'Nemate ugovore',
        'customer.wallet.no_purchase' => 'Nemate kupnje',
        'customer.wallet.no_sales' => 'Nemate prodaje',
        'customer.wallet.no_bills' => 'Nemate račun',
        'customer.wallet.no_ads' => 'Nemate oglase',
        'customer.wallet.no_payouts' => 'Nemate isplate',
        'customer.wallet.want_fill' => 'Želite napuniti račun?',
        'customer.wallet.verification_needed_limit' => 'Kako bi odobrili limit do 10.000,00 kn potrebno je obaviti verifikaciju.',

        'customer.error.oib' => '<span>Ime mora odgovarati prezimenom i JMBG-om ili brojem osobne iskaznice</span>;
        <span>Prezime mora odgovarati imenom i JMBG-om ili brojem osobne iskaznice</span>;
        <span>JMBG ili broj osobne iskaznice koji mora odgovarati imenom i prezimenom</span>;',
        'customer.error.oib_not_match' => '<li>Pronađeni OIB ne odgovara s postojećim OIB-om. Molimo Vas da kontaktirate našu korisničku službu.</li>',
        'customer.error.email_not_match' => '<li>Navedene e-mail adrese se ne slažu. Molimo Vas provjerite polja.</li>',
        'customer.error.email_format_not_correct' => '<li>Molimo upišite ispravnu e-mail adresu npr. vaseime@domen.hr.</li>',
        'customer.error.email_exist' => '<li>E-mail adresa već postoji.</li>',
        'customer.error.mobile_exist' => '<li>Broj mobitela već postoji.</li>',
        'customer.error.password_not_match' => '<li>Navedene lozinke se ne slažu. Molimo Vas provjerite polja.</li>',
        'customer.error.code_not_match' => '<li>Navedeni kod se ne slaže. Molimo Vas unesite ponovo kod.</li>',
        'customer.error.offer_not_exist' => 'Ova ponuda ne postoji',
        'customer.error.password_not_found' => '<li>Stara lozinka se ne podudara s postojećom lozinkom.</li>',

        'customer.success.oib' => '<li>Čestitamo! Vaše ime je {$user->name} {$user->surname}.</li>',
        'customer.success.email_change' => '<li>Čestitamo! Vaša e-mail adresa je uspiješno promijenjena.</li>',
        'customer.success.password_changed' => '<li>Čestitamo! Vaša lozinka je uspiješno promijenjena.</li>',
        'customer.success.code_sent' => '<li>Sms kod je poslan. Unesite sms kod koji ste primili na broj {$mobile} i kliknite gumb pošalji.</li>',
        'customer.success.password_reset' => 'Link za promjenu lozinke je prosljeđen na e-mail adresu ',
        'customer.error.password_reset' => 'Žao nam je, kod za promjenu lozinke je istekao.',

        'customer.sms.reset_password' => 'Zatrazena je promjena podataka na stranici shop.peydo.com. Kako biste potvrdili promjenu, upisite SMS kod: {$code} u naznaceno polje. Srdacan pozdrav, Peydo',

        'customer.notification.verification_is_not_performed' => 'Verifikacija nije obavljena',
        'customer.notification.verification_is_not_performed_error' => '<li>Kako biste poslali ponudu potrebno je obaviti verifikaciju. Verificiraj se <a href="&url&">peydo.com</a></li>',

        'customer.address.primary_note' => 'Napomena: Samo jedna adresa može biti primarna',
        'customer.address.create' => 'Spremi adresu',
        'customer.address.update' => 'Uredi adresu',
        'customer.address.save' => 'Promijeni adresu',
        'customer.address.shipping' => 'Adresa za primanje robe',
        'customer.address.billing' => 'Adresa za naplatu računa',
        'customer.address.sending' => 'Adresa otkud šaljete robu',

        'customer.ad.price' => 'Cijena za koju želite prodati',
        'customer.ad.article_id' => 'Broj oglasa na Njuskalo hr',
        'customer.ad.title' => 'Naziv oglasa',
        'customer.ad.status' => 'Status',
        'customer.ad.allow' => 'Automatska prodaja',
        'customer.ad.no_ads' => 'Nemate oglasa',

        'customer.welcome' => 'Dobrodošli',
        'customer.profile_modify' => 'Uredi svoj profil',
        'customer.password_change' => 'Promjena lozinke',
        'customer.password_change_message' => 'Unesite e-mail adresu koju ste koristili pri registraciji. Poslat ćemo Vam link za promjenu Vaše lozinke.',
        'customer.password_change_contact_help' => 'Ukoliko ipak trebate pomoć, kontaktirajte Peydo korisničku službu.',

        'admin.layout.orders' => 'Narudžbe i ponude', 
        'admin.layout.messages' => 'Poruke', 
        'admin.layout.users' => 'Korisnici', 
        'admin.layout.email_templates' => 'E-mail predlošci', 
        'admin.layout.document_templates' => 'Predlošci dokumenata', 
        'admin.layout.application_settings' => 'Podešavanja aplikacije', 
        'admin.layout.service_fees' => 'Usluge', 

        'home' => 'Naslovna',
        'logout' => 'Odjavi se',
        'view' => 'Pogledaj',
        'hide' => 'Sakrij',
        'gender' => 'Spol',
        'change' => 'Promijeni',
        'male' => 'Muški',
        'female' => 'Ženski',
        'no_gender' => 'Nema spola',
        'birth_date' => 'Datum rođenja',
        'total' => 'Ukupno',
        'no_results' => 'Nema rezultata.',
        'submit' => 'Potvrdi',
        'check' => 'Provjeri',
        'secure_connection' => 'Sigurna veza',
        'reason_not_specified'=>'Razlog nije naveden', 
        'modify' => 'Uredi',
        'OIB' => 'OIB',
        'fill_account' => 'Napuni račun',
        'more_about_free_shipping' => 'Više o besplatnoj dostavi.',
        'not_verified_please_verify' => ' Napunite Vaš račun ovdje i krenite u shopping ',
        'must.enter.tracking_number' => 'Molimo upišite tracking number.',

        'Offer pending' => "Ponuda na čekanju",
        'Offer approved' => "Ponuda prihvaćena",     
        'Offer rejected' =>  "Ponuda odbijena",     
        'Package ordered' => "Dostava naručena",    
        'Package sent' => "Paket poslan",     
        'Package delivered' => "Paket isporučen",     
        'Reclamation pending' => "Žalba na čekanju",     
        'Reclamation approved' => "Žalba odobrena",     
        'Reclamation declined' => "Žalba odbijena",     
        'Package not delivered' => "Paket nije isporučen",     
        'Deleted' => "Izbrisano",     
        'Stand by' => "Odloženo",
        'Paid' => "Isplaćeno",
        'Late' => "Kasni",
        'Unpaid' => "Neplaćeno",

        'page.does.not.exist' => "Tražena stranica ne postoji.",

        'user_history.name_changed' => 'Promijenjeno ime iz {$oldName} u {$newName}',
        'user_history.address_changed' => 'Promijenjena adresa iz {$oldName} u {$newName}',
        'user_history.address_changed' => 'Promijenjena email adresa iz {$oldName} u {$newName}',
        'user_history.mobile_number_changed' => 'Promijenjen broj mobitela iz {$oldName} u {$newName}',
        'user_history.password_changed' => 'Promijenjena lozinka',


        'form.booking' => 'Knjiži',
        'form.create' => 'Dodaj',
        'form.save' => 'Sačuvaj',
        'delete_you_sure' => 'Jeste li sigurni da želite obrisati?',


        //za dodati u engleski fajl
        'options' => 'Opcije',
        'no_lates' => 'Nema kašnjenja',
        'forum' => 'Forum',
        'purchase_contract' => 'Kupoprodajni ugovor',
        'complaints' => 'Žalbe',
        'contract_cancel' => 'Raskid ugovora',
        'sell' => 'Prodaj',
        'buy' => 'Kupi',
        'add_peydo' => 'Dodaj Peydo',
        'my_ads_sales' => 'Moji oglasi i prodaje',
        'my_ads_purchases' => 'Moje kupnje',
        'my_ads' => 'Moji oglasi',
        'my_invoices' => 'Moje fakture',
        'send_offer' => 'Pošalji ponudu',
        'settings' => 'Podešavanja',
        'my_money' => 'Moj novac',
        'follow_package' => 'Prati paket',
        'all' => 'Svi',
        'waiting' => 'Na čekanju',
        'accepted' => 'Prihvaćena',
        'rejected' => 'Odbijena',
        'hello_what_you_want_to_do' => 'Pozdrav {$user_name}! Što želiš danas raditi? Odaberi jednu od navedenih opcija.',
        'peydo_way_of_paying' => 'Dodaj Peydo kao način plaćanja za oglase<br/> koje već imate na web oglasnicima.',
        'add_peydo_to_your_ad' => 'Postavi Peydo u svoj oglas',
        'approve_offers_and' => 'Odobri ponude i pogledaj statuse',
        'how_and_when_pay' => 'Koliko i kada trebam platiti?',
        'send_offer_check_invoices' => 'Pošalji ponudu, provjeri fakture kao i<br/> povijest kupnje i više. ',
        'create_checkout_send_offer' => 'Stvori checkout i pošalji ponudu',
        'manage_your_account' => 'Podesi svoj korisnički račun, sigurnosni<br/> nivo, svoj profil i više. ',
        'watch_your_payments' => 'Pripazi na svoj saldo, provjeri status isplate<br/> i napuni račun. ',
        'write_tracking_number' => 'Ovdje upiši broj paketa kako bi svi mogli<br/> pratiti paket. ',
        'paid_new' => 'Plaćeno',
        'late_new' => 'Kasne',
        'canceled' => 'Otkazano',
        'personal_info' => 'Osobni podatci',
        'contact_info' => 'Kontakt informacije',
        'addresses_where_receive' => 'Adresa gdje primam paket',
        'addresses_where_send' => 'Adresa s koje šaljem paket',
        'verification' => 'Verifikacija',
        'safe_level' => 'Sigurnosni nivo',
        'advertiser' => 'Oglasnik',
        'ad_link' => 'Link oglasa',

    );
?>