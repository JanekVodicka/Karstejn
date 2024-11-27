@component('mail::message')
<br>
<h1>Dobrý den,</h2>
<br>
<br>
<p>Děkujeme za přihlášení Vašeho dítěte na 1. běh letního táboéra Karštejn v termínu {{ $rocnik->termin }}.</p>
<p>Prosíme o kontrolu Vámi odeslaných informací a následné vyplnění formulářů, které nalzenete v příloze tohoto emailu.</p>
<p>Vyplněné formuláře odevzdáte při předání dítěte.</p>
<p>Platbu prosím proveďte s variabilním symbolem {{ $form->variable_symbol }}.</p>
<br>
<h3>Kontaktní osoba:</h3>
<ul>
    <li>Jméno: {{ $form->paren_names }}</li>
    <li>Email: {{ $form->parent_email }}</li>
    <li>Telefon: {{ $form->parent_number }}</li>
    <li>Adresa: {{ $form->parent_street }}, {{ $form->parent_city }}, {{ $form->parent_zip }}</li>
    <li>Poznámka: {{ $form->parent_note }}</li>
</ul>
<h3>Přihlášené dítě:</h3>
<ul>
    <li>Jméno: {{ $form->child_first_name }} {{ $form->child_last_name }}</li>
    <li>Datum narození: {{ $form->child_birthday }} </li>
    <li>Adresa: {{ $form->child_street }}, {{ $form->child_city }}, {{ $form->child_zip }} </li>
    <li>Poznámka: {{ $form->child_note }}</li>
</ul>
<h3>Další informace:</h3>
<ul>
    <li>Místo nástupu: {{ $form->misto_nastupu }}</li>
    <li>Plavec: {{ $form->plavec }}</li>
    <li>Velikost trika: {{ $form->velikost_trika }}</li>
    <li>Souhlas s pořízením a použitím fotografií a video/audio záznamu: {{ $form->photos_agreement }}</li>
    <li>Faktura pro zaměstnance: {{ $form->facture }}</li>
</ul>
<p>V přípdě jakýchkoliv nejasností nebo špatně vyplněných informací nás neváhejte kontaktovat na email info@karstejn.cz</p>
<p>Děkujeme za Vaši důvěru.</p>
<br>
<p>S pozdravem,</p>
<p>Tým Karštejn</p>
@endcomponent

