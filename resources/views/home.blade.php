<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('head')
</head>

<body class="text-center">

	<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
    <header class="masthead mb-auto">
        
        @include('header')
        
    </header>
      
    
    
    <div class="tab-content" id="pills-tabContent">
    	
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="pills-home-tab">
      		<main role="main" class="inner cover">
    			<h1 class="cover-heading">International Human Papillomavirus Reference Center</h1>
    			<h3 class="cover-heading">
    			    <a href="#" id="gotofaqs">Forskningsprojekt om SMS-påminnelser 
    			    och Självprovtagning</a>
    			</h3>
    			<h3 class="cover-heading">
    			    <a href="#exampleModalLong" data-target="#exampleModalLong" id="gotofaqs" data-toggle="modal">
    			    Klicka här för att läsa mer</a>
    			</h3>
    			
    			
    			<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Läs mer
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
        Forskningsprojekt om SMS-påminnelser och Självprovtagning kan öka deltagandet i Gynekologisk Cellprovtagning - Förebyggande Undersökning mot Livmoderhalscancer
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

<p><span style="font-size: small;">Vi vill fråga dig om du vill delta i ett forskningsprojekt. Alla kvinnor i Sverige i åldern 23-64 år kallas till gynekologisk cellprovtagning. 
Regelbunden cellprovtagning ger dig ett starkt skydd mot cancer i livmoderhalsen. Risken minskar med mer än 90 procent. Cellförändringar känns inte. Du bör därför gå på regelbundna kontroller. Socialstyrelsen rekommenderar att du går varje gång du får en kallelse. </span></p>


<p><span style="font-size: small;">Cellförändringar som kan leda till cancer i livmoderhalsen orsakas oftast av ett virus, HPV (Humant papillomvirus). 
Cellförändringar känns inte och är inte farliga i sig. Men de kan utvecklas till livmoderhalscancer om de inte upptäcks i tid. Cellprov analyseras numera med ett HPV-test där cellprovet kan tas av kvinnan själv. Vi vill därför undersöka om ett SMS med erbjudande om att ta provet själv i hemmet kan resultera i ett ökat deltagande. 
Forskningshuvudman för projektet är Karolinska Institutet. Med forskningshuvudman menas den organisation som är ansvarig för studien.
</span></p>

<p><span style="font-size: small;">På denna hemsida kan Du beställa provtagningsmaterial med svarskuvert samt instruktioner om hur du själv tar provet. När du tagit provet lägger du provet i medföljande kuvert och postar det till ett laboratorium där det analyseras för HPV. 
Provsvaret skickas till dig med SMS. Om provet visar att du har HPV kommer du att få en tid för kompletterande undersökning på kvinnoklinik.
I så fall kommer undersökningen att ske helt enligt gällande vårdrutiner och med sedvanligt försäkringsskydd enligt Patientskadeförsäkringen
</span></p>

<p class="pa"><span>Den hantering av personuppgifter som är nödvändig för att kunna utvärdera projektet kommer att ske på ett så säkert sätt som möjligt och redovisning av projektet kommer endast att ske med statistiska resultat i figurer och tabeller där ingen person kommer att kunna identifieras. 
Dina resultat kommer att behandlas så att inte obehöriga kan ta del av dem. Ansvarig för dina personuppgifter är Karolinska Institutet. Enligt EU:s dataskyddsförordning har du rätt att kostnadsfritt få ta del av de uppgifter om dig som hanteras i studien, och vid behov få eventuella fel rättade. 
Du kan också begära att uppgifter om dig raderas samt att behandlingen av dina personuppgifter begränsas. Om du vill ta del av uppgifterna ska du kontakta professor Joakim Dillner på Karolinska Institutet (hpvcenter@ki.se). Dataskyddsombud nås på dataskyddsombudet@ki.se. Om du är missnöjd med hur dina personuppgifter behandlas har du rätt att ge in klagomål till Datainspektionen, som är tillsynsmyndighet.
</span></p>
 
<p class="pa"><span>De prover som tas i studien förvaras kodade i en så kallad biobank. Biobankens namn är Stockholms Medicinska Biobank och den finns vid Karolinska Universitetssjukhuset. Huvudman (ansvarig) för biobanken är Stockholms Läns Landsting. Du har rätt att säga nej till att proverna sparas. Om du samtycker till att proverna sparas har du rätt att senare ta tillbaka (ångra) det samtycket. Dina prover kommer i så fall att kastas eller avidentifieras. 
Om du vill ångra ett samtycke ska du kontakta professor Joakim Dillner (hpvcenter@ki.se). Proverna får bara användas på det sätt som du har gett samtycke till. Om det skulle tillkomma forskning som ännu inte är planerad, kommer etikprövningsnämnden att besluta om du ska tillfrågas på nytt. Ditt deltagande är frivilligt och du kan när som helst välja att avbryta deltagandet. Om du väljer att inte delta eller vill avbryta ditt deltagande behöver du inte uppge varför, och det kommer inte heller att påverka din framtida vård eller behandling. 
Om du vill avbryta ditt deltagande ska du kontakta den ansvarige för studien; professor Joakim Dillner, Karolinska Institutet (joakim.dillner@ki.se)
</span></p>

<p class="pa"><span>Ansvarig för studien är professor Joakim Dillner, Karolinska Institutet (0724682460; joakim.dillner@ki.se)</span></p>
<div class="checkboxes">
<p><span style="font-size: medium;"><strong>Samtycke till att delta i studien</strong></span></p>

<p><span style="font-size: small;">
Jag har fått skriftlig informationen om studien. Jag samtycker till att delta i studien ”Forskningsprojekt om SMS påminnelser och
Självprovtagning kan öka deltagandet i Gynekologisk Cellprovtagning - Förebyggande Undersökning mot
Livmoderhalscancer”, att uppgifter om mig behandlas samt att mina prover sparas i en biobank på det sätt som
beskrivs.
</span></p>



</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Stäng</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">JAG HAR LÄST, SAMTYCKT OCH VILL BESTÄLLA</button>
      </div>
    </div>
  </div>
</div>
    			
    			
    			<!-- <h1 class="cover-heading">Provsvar Antikroppar</h1> -->
   
   
   	{{-- @php ($grandidsession = app('request')->input('grandidsession'))
	@if(!isset($grandidsession) || empty($grandidsession)) --}}
        <p class="lead">
        	Vänligen ange ditt personnummer
        </p>
        @if(session()->has('order_created'))
        <div class="alert alert-success">
          {{ session('order_created') }}  
        </div>
  		@endif
        <form class="form-inline" action="{{url('orders')}}" method="post">
        @csrf
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
            <input type="text" name="pnr" class="form-control mb-2 mr-sm-2" id="pnr" 
            value = "{{ old('pnr') }}" placeholder="ÅÅÅÅMMDDNNNN">
            <button type="submit" class="btn btn-primary mb-2">Beställa</button>
        </form>
    {{-- @endif --}}
    	{{-- <p class="lead">
          <a href="#" class="btn btn-lg btn-primary" role="button" id="Logout">Logga ut</a>
        </p> --}}
   
    
			</main>
      
      
      	</div>
    	
    	
    	
    	
    	
    	<div class="tab-pane fade" id="resurser" role="tabpanel" aria-labelledby="pills-resurser-tab">
    		<div class="downloads">
                <h4>Downloads</h4>
                    <ul>
                  		<li><a href="http://www.kiehealth.se/wp-content/uploads/2020/05/Informationspaket-covid-19-provtagningstudie-V1.5-18May2020.pdf"
                  				target="_blank">Informationspaket COVID-19 provtagningstudie V1.5</a></li>
                    </ul>
              </div>
    	</div>
    	
    	
    	
    	<div class="tab-pane fade" id="faqs" role="tabpanel" aria-labelledby="pills-faqs-tab">
    		
    		<div class="accordion" id="accordionExample">
                <h5>FAQs Vanliga frågor från studiedeltagare</h5>
            	<h6>Svalgprov</h6>
            	
            	<!--
            	<div class="card">
                    <div class="card-header" id="headingbeforeOne">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsebeforeOne" aria-expanded="true" aria-controls="collapsebeforeOne">
                              Jag har inte fått svar på länge, kan mitt prov ha blivit förstört?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapsebeforeOne" class="collapse" aria-labelledby="headingbeforeOne" data-parent="#accordionExample">
                        <div class="card-body">
                        	Svalgproven svaras idag ut inom ca 1 vecka. Har Du tagit prov för >2 veckor sedan men inte fått svar är det tyvärr sannolikt att provet blivit förstört. Orsaker är exempelvis att rör har läckt och att påsar med rör ej kunnat öppnas pga smittrisk.
                            Vi rekommenderar därför omprov. Eftersom det inte rör sig om så många personer har vi inte längre några separata omprovtagningsstationer, men det är möjligt att under veckan 8-16/6 besöka oss på Forskningsgatan F52 i Huddinge och ta svalgprovet på plats.
						</div>
						<div class="card-body">
							Omprov är inte aktuellt beträffande serumprovet. 
                        </div>
                    </div>
            	</div>
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingbeforeOneAfter">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsebeforeOneAfter" aria-expanded="true" aria-controls="collapsebeforeOneAfter">
                              Hur kan jag ta om mitt svalgprov?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapsebeforeOneAfter" class="collapse" aria-labelledby="headingbeforeOneAfter" data-parent="#accordionExample">
                    	<div class="card-body">
                    		Vi har tyvärr inte längre några separata omprovtagningsstationer, men det är möjligt att under veckan 8-16/6 besöka oss på<b> Forskningsgatan F52 i Huddinge</b> och ta svalgprovet på plats.
						</div>
						<div class="card-body">
					 		Har Du själv kunnat ta svalgprovet så kan det lämnas in på någon av KULs provmottagningar för transport till COVID-19 studien,<b> Forskningsgatan F52, Huddinge Sjukhus.</b>
						</div>
						
 						
 							 
                    </div>
            	</div>
            	
            	
            	
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Hur tar jag svalgprovet?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        	Du använder den bifogade bomullspinnen och tar provet långt bak i halsen (vid tonsillerna). 
                        	Pinnen rörs sedan runt i 20 sekunder i buffertlösningen i provröret, och kasseras sedan. 
                        	Se den detaljerade instruktionen ”Ta prov på dig själv” som finns som resurs på denna hemsida. 
                        </div>
                    </div>
            	</div>
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              Hur lång tid tar det att få svar på svalgprovet?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                        	Det är en forskningsstudie för frisk personal och våra svarstider varierar beroende på mängden av prov som hanteras. Det har varit ett högt tryck, som har orsakat långa svarstider, men idag ligger svarstiden för svalgprover på under 1 vecka.  
                        </div>
                    </div>
            	</div>
            	
            	-->
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                              Hur får jag svar på svalgprovet?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                        	SMS skickades från www.direkttest.se med en länk till ditt provsvar. När du följer länken måste du identifiera dig med ditt mobila bank-id för att se svaret.  
                        </div>
                        <div class="card-body">
                        	Om du har fått ett sms, men inte har mobilt bank-id, kan du ringa forskargruppen för att få ditt svar (se kontaktinformation nedan).  
                        </div>
                    </div>
            	</div>
            	
            	<div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                              När jag loggar in på www.direkttest.se står det ”svar finns ej tillgängligt”, vad betyder det?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                        	Då forskningsstudien avslutades den 12 juni, och alla prover har analyserats betyder det tyvärr att du inte kommer att få svar på det provet. Det är möjligt att ditt provrör har läckt eller att det varit något annat problem. Kontakta gärna forskargruppen så gör vi en utredning av vad som kan ha hänt.   
                        </div>
                    </div>
            	</div>
            	
            	<!--
            	<div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                              Jag lämnade mitt prov samtidigt som mina kollegor, de har fått sitt svar men inte jag. 
                              Vad har hänt?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                        	Har du inte fått svar på omprovet på >3 veckor är det sannolikt att något blivit fel. Vi har skickat SMS till studiedeltagare där vi vet om att proven förstörts, men det finns också ett antal prover där vi ej vet identiteten på den person som provet kom ifrån (t ex om påsen ej kunnat öppnas pga smittrisk) och vi därför ej kunnat skicka SMS.
                            Får vi in ett omprov så analyserar vi det, men provtagningsstationer är inte längre öppna då studien snart skall avslutas. Det går bra att komma till oss på Forskningsgatan F52 i Huddinge och ta provet på plats. Öppet 8-17 vardagar.   
                        </div>
                    </div>
            	</div>
            	
            	<div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                              Kan mitt prov vara förstört?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                        	Tyvärr har vi flera incidenter där prov ej kunnat analyseras, till exempel på grund 
                        	av läckande rör som gjort att hela påsar med prov måst kasseras pga av smittrisk eller 
                        	problem med dåliga etiketter. Vi kommer att skicka SMS till dem det berör och erbjuda omprov.    
                        </div>
                    </div>
            	</div>
            	
            	<div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                              Jag har inte fått svar ännu, kan jag ta om mitt prov?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                        	 Har du inte fått svar på omprovet på >3 veckor är det sannolikt att något blivit fel. Vi har skickat SMS till studiedeltagare där vi vet om att proven förstörts, men det finns också ett antal prover där vi ej vet identiteten på den person som provet kom ifrån (t ex om påsen ej kunnat öppnas pga smittrisk) och vi därför ej kunnat skicka SMS.
                            Får vi in ett omprov så analyserar vi det, men provtagningsstationer är inte längre öppna då studien snart skall avslutas. Det går bra att komma till oss på Forskningsgatan F52 i Huddinge och ta provet på plats. Öppet 8-17 vardagar.    
                        </div>
                    </div>
            	</div>
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingEight">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                              Jag kan inte skanna QR-koden på mitt svalgprov, vad gör jag då?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                        <div class="card-body">
                        	Gå in på www.direkttest.se och följ anvisningarna under ”registrera prov”.     
                        </div>
                    </div>
            	</div>
            	
            	<div class="card">
                    <div class="card-header" id="headingNine">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                              Jag har symptom och vet inte mitt svar, kan jag få svaret av er?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                        <div class="card-body">
                        	Följ gällande riktlinjer från Folkhälsomyndigheten, om att bli symptomfri och vänta 
                        	ytterligare 48 timmar innan du går tillbaka till jobbet. Om du behöver ha ett snabbt 
                        	svar p.g.a. besvär råder vi dig att ta kontakt med sjukvården som patient för att ta 
                        	ett nytt prov där.     
                        </div>
                    </div>
            	</div>
            	-->
            	
            	<h6>Serumprov</h6>
            	<div class="card">
                    <div class="card-header" id="headingTen">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                              Hur lång tid tar det att få svar på serumprovet?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                        <div class="card-body">
                        	Forskningsstudien är avslutad sedan den 12 juni. Har Du inte fått svar har det varit någon form av problem.  Kontakta gärna forskargruppen så gör vi en utredning av vad som kan ha hänt.      
                        </div>
                    </div>
            	</div>
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingEleven">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                              Kan jag ta om mitt prov?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                        <div class="card-body">
                        	Forskningsstudien är avslutad sedan den 12 juni. Vi hänvisar till Region Stockholms provtagning, där du kan boka tid via appen ”Alltid Öppet” för antingen svalgprov (pågående infektion) eller 1177 för antikroppar (genomgången infektion). 
                        </div>
                        <div class="card-body">
                        	Mer information finns här: <a href="https://www.1177.se/Stockholm/sa-fungerar-varden/varden-i-stockholms-lan/om-corona/allt-om-provtagning-for-covid-19/" target="_blank" style="text-decoration:underline">
https://www.1177.se/Stockholm/sa-fungerar-varden/varden-i-stockholms-lan/om-corona/allt-om-provtagning-for-covid-19/</a>

                        </div>
                    </div>
            	</div>
            	
            	
            	<div class="card">
                    <div class="card-header" id="headingTwelve">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                              Vilken typ av antikroppstest gör ni?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                        <div class="card-body">
                        	Vi testar endast för immunoglobin G (IgG). Testet är baserat på 4 olika antigener 
                        	och är validerat. IgG finns inte när man är ny-insjuknad utan kommer ungefär vid 
                        	tillfrisknandet och stiger veckorna därefter.      
                        </div>
                    </div>
            	</div>
            	
            	
            	<h6>Kontakta forskargruppen?</h6>
            	<div class="card">
                    <div class="card-header" id="headingThirteen">
                        <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
                              Hur gör jag för att komma i kontakt med forskargruppen?
                        </button>
                        </h2>
                    </div>
                    
                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                        <div class="card-body">
                        	Om du saknar BankID, ring vardagar 0725-836709 mellan kl. 08.00-10.00.
                            Övrig tid maila: joakim.dillner@sll.se
                        </div>
                    </div>
            	</div>
            	
			</div>
    	
    	</div>
    	
	</div>
      
   

  

    <footer class="mastfoot mt-auto">
        
        @include('footer')
        
    </footer>
  
	</div>
</body>

<script src="{{ asset('js/main.js') }}"></script>

<script type="text/javascript">
console.log( Personnummer.valid('1982'));
// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-masthead a[href="#' + url.split('#')[1] + '"]').tab('show');
    window.scrollTo(0, 0);
} 

// Change hash for page-reload
$('.nav-masthead a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})

/*$('#gotofaqs').click(function() {
  $('.nav-masthead a[href="#faqs"]').tab('show');
});*/
</script>
</html>