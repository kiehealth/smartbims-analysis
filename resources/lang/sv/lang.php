<?php 

return [
    'admin' => 'Admin',
    'menu' => 'Meny',
    'dashboard' => 'Dashboard',
    'orders' => 'Beställningar',
    'kits' => 'Kits',
    'sample-results' => 'Prov Svar',
    'Sample Results' => 'Prov Svar',
    'users' => 'Users',
    'reports' => 'Rapporter',
    'Language' => 'Språk',
    'Login' => 'Logga in',
    'Log out' => 'Logga ut',
    'Register' => 'Registrera',
    'Order' => 'Beställa',
    'Email' => 'E-post',
    'Password' => 'Lösenord',
    'Confirm Password' =>'Bekräfta Lösenord',
    'Current Password' => 'Nuvarande Lösenord',
    'New Password' => 'Nytt Lösenord',
    'Confirm New Password' => 'Bekräfta Nytt Lösenord',
    'Remember me' => 'Håll mig inloggad',
    'Already registered?' => 'Redan registrerad?',
    'Forgot your password?' => 'Glömt ditt lösenord?',
    'Email Password Reset Link' => 'E-post Lösenord Återställ Länk',
    'Reset Password' => 'Återställ Lösenord',
    'back' => 'Tillbaka',
    'Back' => 'Tillbaka',
    'Cancel' => 'Avbryt',
    'Import' => 'Importera',
    'to-front' => 'Till Hemsidan',
    'yyyy-mm-dd' => 'åååå-mm-dd',
    
    'Whoops! Something went wrong.' => 'Oj då! Något gick fel.',
    'wrong-current-password' => 'Ditt nuvarande lösenord matchar inte lösenordet du angav. Ange rätt nuvarande lösenord.',
    'password_update_success_msg' => 'Lösenordet har uppdaterats!',
    'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.' => 'Glömt ditt lösenord? Inga problem. Låt oss bara veta din e-postadress så skickar vi dig en länk för återställning av lösenord som gör att du kan välja en ny.',
    'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.' => 'Tack för att du registrerade dig! Innan du kom igång, kunde du verifiera din e-postadress genom att klicka på länken som vi just skickade till dig? Om du inte fick e-postmeddelandet skickar vi gärna ett annat till dig.',
    'A new verification link has been sent to the email address you provided during registration.' => 'En ny verifieringslänk har skickats till den e-postadress du angav under registreringen.',
    'Resend Verification Email' => 'Skicka Verifieringsemail Igen',
    'I have read, agreed and want to order.' => 'Jag har läst, samtyckt och vill beställa.',
    'I do not consent and do not wish to be contacted.' => 'Jag samtycker inte och vill inte bli kontaktad.',
    'click-button-to-order' => 'Beställa provtagningsmaterial med svarskuvert samt instruktioner genom knappen nedan.',
    'order-success-msg' => "Din beställning har tagits emot och den kommer att skickas
                            till din folkbokföringsadress om några dagar.
                            Om du vill att den ska skickas till en annan adress eller se
                            status kan du göra det på <a style=\"
                            color: cornflowerblue;\" href=".url('/myprofile').">mina sidor</a>
                            eller kontakta oss på hpvcenter@ki.se.",
    'click-button-to-withdraw-consent' => 'Om du är säker att du vill inte delta, avsluta deltagandet genom knappen nedan.',
    'regret-withdraw-consent' => 'Om du avslutar kommer vi inte kontakta dig längre. Däremot om du ångrar dig, behöver du bara
		                          samtycker igen på hemsidan och beställa självprovtagningskit.',
    'end-participation' => 'Avsluta',
    'unsubscribed-msg' => "Din deltagande i studien har avslutats och kommer vi inte kontakta dig längre. Däremot om du ångrar dig, behöver du bara
		                   samtycker igen på <a style=\"color: cornflowerblue;\" href=".url('/').">hemsidan</a> och beställa självprovtagningskit.",
    'profile' => 'Mina Sidor',
    'change-password' => 'Ändra lösenord',
    'my-details' => 'Mina Uppgifter',
    'name' => 'Namn',
    'ssn' => 'Personnummer',
    'address' => 'Adress',
    'check-edit' => 'Kontrollera/Redigera',
    'edit-address' => 'Redigera Adress',
    'phonenumber' => 'Phonenummer',
    'street-number-apartment' => 'Gata/Gatunummer/Lgh',
    'post-code' => 'Postnummer',
    'town-city' => 'Ort',
    'country' => 'Land',
    'select' => 'Välja',
    'update' => 'Uppdatera',
    'cancel' => 'Avbryt',
    'Upload' => 'Ladda upp',
    'Choose file' => 'Välj fil',
    'address-updated' => 'Adress Uppdaterad',
    'my-orders' => 'Mina Beställningar',
    'no-orders' => 'Inga Beställningar',
    'latest' => 'Senaste',
    'order-date' => 'Beställning Datum',
    'status' => 'Status',
    'view-all' => 'See alla',
    'test-results' => 'Provsvar',
    'not-ready-yet' => 'Inte färdigt än',
    'result' => 'Result',
    'reporting-date' => 'Rapporterad Datum',
    'sample-registered-date' => 'Prov Registrerad Datum',
    'result-message' => 'Meddelande',
    
    /*Kit Import*/
    'Import Kits/Samples' => 'Importera Kits/Prover',
    'Use the excel/csv file template to import the kits.' => "Använd excel/csv <a href=".asset('storage/import_templates/kits_import_template.xlsx').">filmallen</a> för att importera kits.",
    'order_id.required' => "Fel på rad: <strong> :row </strong>. Order_id saknas. "
                                 . "Order_id krävs.",
    'order_id.exists' => "Fel på rad: <strong>:row</strong>. Ingen order med order_id <strong>:order_id</strong> hittades. Beställningen ska göras "
                                         . "innan du registrerar ett kit.",
    'order_id.distinct' => "Fel på rad: <strong>:row</strong>. Order_id <strong>:order_id</strong> har ett duplikatvärde. ".
                                             "Order_id måste vara unik.",
    'sample_id.required_with' => "Fel på rad: <strong>:row</strong>. Sample_id saknas. "
                                             . "Sample_id krävs när sample_received_date är närvarande.",
    'sample_id.distinct' => "Fel på rad: <strong>:row</strong>. Sample_id <strong>:sample_id</strong> har ett duplikatvärde. ".
                                             "Sample_id måste vara unik.",
    'barcode.unique' => "Fel på rad: <strong>:row</strong>. Barcode <strong>:barcode</strong> har redan registrerats. Barcode måste vara unik.",
    'barcode.distinct' => "Fel på rad: <strong>:row</strong>. Barcode <strong>:barcode</strong> har ett duplikatvärde. ".
                                              " Barcode måste vara unik.",
    'kit_dispatched_date.required' => "Fel på rad: <strong>:row</strong>. Kit_dispatched_date saknas. ".
                                                 "Ange datumet när kit kommer att skickas.",
    'kit_dispatched_date.date' => "Fel på rad: <strong>:row</strong>. Kit_dispatched_date <strong>:kit_dispatched_date</strong> är inte ett giltigt datum.
                                                 Ange ett giltigt datum (åååå-mm-dd).",
    'sample_received_date.date' => "Fel på rad: <strong>:row</strong>. Sample_received_date <strong>:sample_received_date</strong> är inte ett giltigt datum.
                                                 Ange ett giltigt datum (åååå-mm-dd).",
    'sample_received_date.required_with' => "Fel på rad: <strong>:row</strong>. Sample_received_date saknas."
                                                 ." Sample_received_date krävs när sample_id är närvarande.",
    'sample_received_date.after_or_equal' => "Fel på rad: <strong>:row</strong>. Sample_received_date <strong>:sample_received_date</strong> måste vara ett datum efter eller samma som kit_dispatched_date <strong>:kit_dispatched_date</strong>.",
    'kits_import_success_msg' => "<strong>:total</strong> Kits/Samples har bearbetats framgångsrikt! <br>
                            varav <strong>:insert</strong> Kits/Samples har skapats och <strong>
                            :update</strong> Kits/Samples har uppdaterats.",
    
    /*Sample Import*/
    'Import Samples/Results' => 'Importera Prover/Resultat',
    'Use the excel/csv file template to import the samples.' => "Använd excel/csv <a href=".asset('storage/import_templates/samples_import_template.xlsx').">filmallen</a> för att importera prover.",
    'cobas_analysis_date.required_with' => "Fel på rad: <strong>:row</strong>. Cobas_analysis_date saknas."
                                        ." Cobas_analysis_date krävs när cobas_result är närvarande.",
    'cobas_result.in' => "Fel på rad: <strong>:row</strong>. Cobas_result <strong>:cobas_result</strong> är ogiltigt. Endast tillåtet ett av värdena <strong>:allowed</strong>.",
    'cobas_analysis_date.date' => "Fel på rad: <strong>:row</strong>. Cobas_analysis_date <strong>:cobas_analysis_date</strong> är inte ett giltigt datum.
                                                Ange ett giltigt datum (åååå-mm-dd).",
    'cobas_result.required_with' => "Fel på rad: <strong>:row</strong>. Cobas_result saknas."
                                                ." Cobas_result krävs när cobas_analysis_date är närvarande.",
    'cobas_analysis_date.after_or_equal' => "Fel på rad: <strong>:row</strong>. Cobas_analysis_date <strong>:cobas_analysis_date</strong> måste vara ett datum efter eller samma som sample_registered_date <strong>:sample_registered_date</strong>.",
    'luminex_analysis_date.required_with' => "Fel på rad: <strong>:row</strong>. Luminex_analysis_date saknas."
                                            ." Luminex_analysis_date krävs när luminex_result är närvarande.",
    'luminex_result.in' => "Fel på rad: <strong>:row</strong>. Luminex_result <strong>:luminex_result</strong> är ogiltigt. Endast tillåtet ett av värdena <strong>:allowed</strong>.",
    'luminex_analysis_date.date' => "Fel på rad: <strong>:row</strong>. Luminex_analysis_date <strong>:luminex_analysis_date</strong> är inte ett giltigt datum.
                                                Ange ett giltigt datum (åååå-mm-dd).",
    'luminex_result.required_with' => "Fel på rad: <strong>:row</strong>. Luminex_result saknas."
                                                ." Luminex_result krävs när luminex_analysis_date är närvarande.",
    'luminex_analysis_date.after_or_equal' => "Fel på rad: <strong>:row</strong>. Luminex_analysis_date <strong>:luminex_analysis_date</strong> måste vara ett datum efter eller samma som sample_registered_date <strong>:sample_registered_date</strong>.",
    'rtpcr_analysis_date.required_with' => "Fel på rad: <strong>:row</strong>. Rtpcr_analysis_date saknas."
                                                        ." Rtpcr_analysis_date krävs när rtpcr_result är närvarande.",
    'rtpcr_result.in' => "Fel på rad: <strong>:row</strong>. Rtpcr_result <strong>:rtpcr_result</strong> är ogiltigt. Endast tillåtet ett av värdena <strong>:allowed</strong>.",
    'rtpcr_analysis_date.date' => "Fel på rad: <strong>:row</strong>. Rtpcr_analysis_date <strong>:rtpcr_analysis_date</strong> är inte ett giltigt datum.
                                                Ange ett giltigt datum (åååå-mm-dd).",
    'rtpcr_result.required_with' => "Fel på rad: <strong>:row</strong>. Rtpcr_result saknas."
                                                ." Rtpcr_result krävs när rtpcr_analysis_date är närvarande.",
    'rtpcr_analysis_date.after_or_equal' => "Fel på rad: <strong>:row</strong>. Rtpcr_analysis_date <strong>:rtpcr_analysis_date</strong> måste vara ett datum efter eller samma som sample_registered_date <strong>:sample_registered_date</strong>.",
    'reporting_date.required_with' => "Fel på rad: <strong>:row</strong>. Reporting_date saknas."
                                                      ." Reporting_date krävs när final_reporting_result är närvarande.",
    'final_reporting_result.in' => "Fel på rad: <strong>:row</strong>. Final_reporting_result <strong>:final_reporting_result</strong> är ogiltigt. Endast tillåtet ett av värdena <strong>:allowed</strong>.",
    'reporting_date.date' => "Fel på rad: <strong>:row</strong>. Reporting_date <strong>:reporting_date</strong> är inte ett giltigt datum.
                                                Ange ett giltigt datum (åååå-mm-dd).",
    'final_reporting_result.required_with' => "Fel på rad: <strong>:row</strong>. Final_reporting_result saknas."
                                            ." Final_reporting_result krävs när reporting_date är närvarande.",
    'reporting_date.after_or_equal' => "Fel på rad: <strong>:row</strong>. Reporting_date <strong>:reporting_date</strong> måste vara ett datum efter eller samma som sample_registered_date <strong>:sample_registered_date</strong>.",
    'kit_id.required' => "Fel på rad: <strong>:row</strong>. Kit_id saknas. "
                                 . "Kit_id krävs.",
    'kit_id.exists' => "Fel på rad: <strong>:row</strong>. Ingen kit med kit_id <strong>:kit_id</strong> hittades. Kit bör redan registreras innan sample importeras.",
    'kit_id.distinct' => "Fel på rad: <strong>:row</strong>. Kit_id <strong>:kit_id</strong> har ett duplikatvärde. ".
                                      " Kit_id måste vara unik.",
    'sample_id.required' => "Fel på rad: <strong>:row</strong>. Sample_id saknas."
                                    ." Sample_id krävs.",
    'sample_id.distinct' => "Fel på rad: <strong>:row</strong>. Sample_id <strong>:sample_id</strong> har ett duplikatvärde. ".
                                    " Sample_id måste vara unik.",
    'lab_id.distinct' => "Fel på rad: <strong>:row</strong>. Lab_id <strong>:lab_id</strong> har ett duplikatvärde. ".
                                    " Lab_id måste vara unik.",
    'lab_id.unique' => "Fel på rad: <strong>:row</strong>. The lab_id <strong>:lab_id</strong> har redan registrerats. Lab_id måste vara unik.",
    'sample_registered_date.required' => "Fel på rad: <strong>:row</strong>. Sample_registered_date saknas."
                                                    ." Sample_registered_date krävs.",
    'sample_registered_date.date' => "Fel på rad: <strong>:row</strong>. Sample_registered_date <strong>:sample_registered_date</strong> är inte ett giltigt datum.
                                                Ange ett giltigt datum (åååå-mm-dd).",
    'samples_import_success_msg' => "<strong>:total</strong> Samples har bearbetats framgångsrikt! <br>
                            varav <strong>:insert</strong> Samples har skapats och <strong>
                            :update</strong> Samples har uppdaterats.",
    
    /*Report*/
    'Generate Report' => 'Generera Rapport',
    'search' => 'Sök',
    'Orders' => 'Beställningar',
    'Unprocessed Orders' => 'Obearbetad Beställningar',
    'Without Orders' => 'Utan Beställningar',
    'Kits' => 'Kits',
    'Kits Dispatched' => 'Kits Skickad',
    'Kits/Samples Received' => 'Kits/Prover Mottagen',
    'Samples' => 'Prover',
    'Results Reported' => 'Resultat Rapporterade',
    'From Date' => 'Datum fr.o.m',
    'To Date' => 'Datum t.o.m',
    
    /*User*/
    'edit-user' => 'Redigera User',
    'update-user' => 'Uppdatera User',
    'Update User' => 'Uppdatera User',
    'delete-user' => 'Ta bort User',
    'user_updated_msg' => 'User är uppdaterad!',
    'user_deleted_msg' => 'User borttagen!',
    'user_not_deleted_msg' => 'User kan inte raderas! Beställning redan registrerad för user. För att radera user, först ta bort tillhörande beställning.',
    'Are you sure you want to delete the user? All data related with the user will be deleted!' => 'Är du säker på att du vill ta bort user? All data relaterad till user kommer att raderas!',
    
    
    /*Order*/
    'delete-order' => 'Ta bort Beställning',
    'Create Order' => 'Skapa Beställning',
    'Are you sure you want to delete the kit for this order?' => 'Är du säker på att du vill ta bort kit för den här beställningen?',
    'Are you sure you want to delete the order?' => 'Är du säker på att du vill ta bort beställningen?',
    'order_deleted_msg' => 'Beställning borttagen!',
    'order_not_deleted_msg' => 'Beställning kan inte raderas! Kit redan registrerad för beställningen. För att radera
                                    beställningen, först ta bort tillhörande kit.',
    'order-success-msg-admin' => "Beställning skapades framgångsrikt för :ssn <strong>:ssnumber</strong>!",
    'order-unsuccess-msg-admin' => "User med :ssn <strong>:ssnumber</strong> existerar inte. Registrera user innan du kan göra en beställning.",
    
    /*Kit*/
    'register-kit' => "Registrera Kit",
    'Register Kit' => "Registrera Kit",
    'register-kit-for-order-x' => 'Registrera Kit för order id :order_id',
    'Edit Kit' => "Redigera Kit",
    'edit-kit-information' => 'Redigera Kit Information',
    'edit-kit-for-order-x' => 'Redigera Kit för order id :order_id',
    'delete-kit-for-order' => 'Ta bort Kit för den här beställningen',
    'delete-kit' => 'Ta bort Kit',
    'Are you sure you want to delete the kit?' => 'Är du säker på att du vill ta bort kit?',
    'kit_for_order_updated_msg' => 'Kit är uppdaterad för beställningen!',
    'kit_updated_msg' => 'Kit är uppdaterad!',
    'kit_deleted_msg' => 'Kit borttagen!',
    'kit_not_deleted_msg' => 'Kit kan inte raderas! Prov redan registrerad för kit. För att radera kit, först ta bort tillhörande prov.',
    'kit_registered_msg' => 'Kit är registrerad för beställningen!',
    
    /*Sample*/
    'Register Sample' => "Registrera Prov",
    'register-sample-for-order-x-kit-x' => 'Registrera Prov för order id :order_id/kit id :kit_id',
    'Are you sure you want to delete the sample?' => 'Är du säker på att du vill ta bort provet?',
    'sample_registered_msg' => "Provet med sample_id <strong>:sample_id</strong> har registrerats framgångsrikt!",
    'Edit Sample Information' => 'Redigera Prov Information',
    'Delete Sample' => 'Ta bort Prov',
    'edit-sample-for-order-x' => 'Redigera Prov för order id :order_id',
    'Edit Sample' => "Redigera Prov",
    'sample_updated_msg' => 'Provet är uppdaterad!',
    'sample_deleted_msg' => 'Prov borttagen!',
    
    /*Dashboard*/
    'Dashboard' => 'Dashboard',
    'Participants and Orders' => 'Deltagarna och Beställningar',
    'Total Participants' => 'Totalt antal deltagare',
    'Participants with Orders' => 'Deltagarna med Beställningar',
    'Participants without Orders' => 'Deltagarna utan Beställningar',
    'Total Orders' => 'Totalt antal Beställningar',
    'Orders Processed (Kits Registered)' => 'Beställningar behandlats (Kits Registrerats)',
    'Orders Unprocessed (Kits Not Registered)' => 'Obehandlats Beställningar (Kits ej Registrerats)',
    'Total Kits Registered' => 'Totalt antal Kits Registrerats',
    'Kits Dispatched' => 'Kits Skickats',
    'Samples Received' => 'Mottagna Prover',
    'Samples and Results' => 'Prover och Resultat',
    'Total Samples Registered' => 'Totalt antal Prover Registrerats',
    'Results Reported' => 'Resultat Rapporterats',
    'Results Not Reported' => 'Resultat ej Rapporterats',
];
