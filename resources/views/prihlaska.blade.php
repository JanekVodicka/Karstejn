@extends('layouts.app')
@section('title', 'Přihláška')
@section('content')
    <div class="container">
        <div id="prihlaska">
            <h2>Přihláška</h2>
            <div class="prihlaska-status">
                <h4 class="{{ $spusteni_prihlasek == 'ano' ? 'prihlaska-status-aktivni' : ''}}">{{ $spusteni_prihlasek == 'ano' ? 'Přihlášky spuštěny' : 'Přihlášky nedostupné'}}</h4>
            </div>
            @if (session('success-prihlaska'))
                <div class="alert alert-success">
                    {{ session('success-prihlaska') }}
                </div>
                <div class="prihlaska-instrukce">
                    <p>Děkujeme za vyplnění přihlášky. Nyní Vámi vyplněné informace zpracováváme a do <strong>10 minut</strong> byste měli obdržet email s instrukcemi a vyplněnými formuláři. Pokud Vám žádný email nepříjde, zkontrolujte prosím nejprve složku Spam. Pokud zde email nenaleznete, neváhejte nás kontaktovat na adrese <strong>info@karstejn.cz</strong></p>
                </div>
            @else
            <div class="prihlaska-instrukce">
                @if ($spusteni_prihlasek == 'ano')
                    <p>Vyplňte <strong>1x</strong> formulář a my vám pošleme všechny potřebné dokumenty na <strong>email</strong> vyplněné i s instrukcemi co je potřeba!</p><br>
                    <p>Pokud máte nějaké dotazy, neváhejte nás kontaktovat. <br>E-mailovou schránku kontrolujeme nepravidelně, zpravidla <strong>2x týdně</strong>. Prosím, přednostně volejte nebo napište sms.</p>
                @endif
            </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    Něco se pokazilo. <br>
                    Pokud jste zvolili "místo nástupu": jiné, ujistěte se, že jste vyplnili i kde přesně Vaše dítě nastoupí.
                </div>
            @endif

            <form action="{{ route('prihlaska.store') }}" method="POST">
                @csrf
                <div class="formular">
                    <div class="input-box">
                        <label class="main-label required" for="parent-email">Email:</label>
                        <input class="input-text" type="email" id="parent-email" name="parent_email" placeholder=“Email“
                            required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <h4>Zákonný zástupce dítěte:</h4>
                    <div class="input-box">
                        <label class="main-label required" for="parent-names">Jméno a Příjmení:</label>
                        <input class="input-text" type="text" id="parent-names" name="parent_names"
                            placeholder=“JménoPříjmení“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="phone-number">Telefon:</label>
                        <input class="input-text" type="tel" id="phone-number" name="parent_number" placeholder=“Telefon“
                            required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="parent-street">Ulice a číslo popisné:</label>
                        <input class="input-text" type="text" id="parent-street" name="parent_street" placeholder=“Ulice“
                            required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="parent-city">Obec:</label>
                        <input class="input-text" type="text" id="parent-city" name="parent_city" placeholder=“Obec“
                            required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="parent-zip">PSČ:</label>
                        <input class="input-text" type="text" id="parent-zip" name="parent_zip" placeholder=“PSČ“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label" for="parent-note">Poznámka:</label>
                        <p>Druhý telefon, potřeby ohledně platby, jiné</p>
                        <input class="input-text" type="text" id="parent-note" name="parent_note" placeholder=“Poznámka“ @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <h4>Dítě:</h4>
                    <div class="input-box">
                        <label class="main-label required" for="child-first-name">Křestní jméno:</label>
                        <input class="input-text" type="text" id="child-first-name" name="child_first_name"
                            placeholder=“Jméno“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-last-name">Příjmení:</label>
                        <input class="input-text" type="text" id="child-last-name" name="child_last_name"
                            placeholder=“Příjmení“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-birth-day">Datum narození:</label>
                        <input class="input-text" type="date" id="child-birth-day" name="child_birthday" required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-street">Ulice a číslo popisné:</label>
                        <input class="input-text" type="text" id="child-street" name="child_street" placeholder=“Ulice“
                            required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-city">Obec:</label>
                        <input class="input-text" type="text" id="child-city" name="child_city" placeholder=“Obec“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-zip">PSČ:</label>
                        <input class="input-text" type="text" id="child-zip" name="child_zip" placeholder=“PSČ“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>
                    <div class="input-box">
                        <label class="main-label required">Místo nástupu:</label>
                        <div class="input-box-radio">
                            <div>
                                <input type="radio" id="Tabor" name="misto_nastupu" value="Tábor" onclick="toggleTextInput()">
                                <label for="Tabor">Tábor</label>
                            </div>
                            <div>
                                <input type="radio" id="PlanaNadLuznici" name="misto_nastupu" value="Planá nad Lužnicí" onclick="toggleTextInput()">
                                <label for="PlanaNadLuznici">Planá nad Lužnicí</label>
                            </div>
                            <div>
                                <input type="radio" id="Sobeslav" name="misto_nastupu" value="Soběslav" onclick="toggleTextInput()">
                                <label for="Sobeslav">Soběslav</label>
                            </div>
                            <div>
                                <input type="radio" id="Jine" name="misto_nastupu" value="Jiné" onclick="toggleTextInput()">
                                <label for="Jine">Jiné</label>
                                <input id="input-text-jine" type="text" name="misto_nastupu_custom" placeholder="Jiné" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="main-label required">Plavec:</label>
                        <div class="input-box-radio">
                            <div>
                                <input type="radio" id="plavec-ano" name="plavec" value="Ano" required>
                                <label for="plavec-ano">Ano</label>
                            </div>
                            <div>
                                <input type="radio" id="plavec-ne" name="plavec" value="Ne">
                                <label for="plavec-ne">Ne</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="main-label required">Velikost trika:</label>
                        <div class="input-box-radio">
                            <div>
                                <input type="radio" id="XS" name="velikost_trika" value="XS" required>
                                <label for="XS">XS</label>
                            </div>
                            <div>
                                <input type="radio" id="S" name="velikost_trika" value="S">
                                <label for="S">S</label>
                            </div>
                            <div>
                                <input type="radio" id="M" name="velikost_trika" value="M">
                                <label for="M">M</label>
                            </div>
                            <div>
                                <input type="radio" id="L" name="velikost_trika" value="L">
                                <label for="L">L</label>
                            </div>
                            <div>
                                <input type="radio" id="XL" name="velikost_trika" value="XL">
                                <label for="XL">XL</label>
                            </div>
                            <div>
                                <input type="radio" id="XXL" name="velikost_trika" value="XXL">
                                <label for="XXL">XXL</label>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="main-label required" for="child-note">Poznámka:</label>
                        <p>Alergie, léky, zdravotní omezení, s kým chce být ve stanu, cokoliv dalšího bychom měli vědět</p>
                        <input class="input-text" type="text" id="child-note" name="child_note" placeholder=“Poznámka“ required @if ($spusteni_prihlasek == 'ne') disabled @endif>
                    </div>

                </div>
                <div class="formular">
                    <h4>Právní náležitosti a souhlas</h4>
                    <h5>Odesláním tohoto formuláře stvrzuji, že:</h5>
                    <ul>
                        <li>S ohledem na skladbu programu a ostatní účastníky nejsou návštěvy tábora povoleny.</li>
                        <li>Jsem si vědom(a), že v případě závažného porušení táborového řádu může být účastník tábora na
                            základě
                            rozhodnutí vedení tábora vyloučen. V takovém případě zajistím vlastním nákladem odvoz dítěte do 24
                            hodin.</li>
                        <ul>
                            <li>Provozovatel tábora v takovém případě není povinnen vrátit úměrnou část účastnického poplatku.
                            </li>
                        </ul>
                        <li>Neručíme za ztráty či zničení cenností (drahé kovy, elektronika apod.)</li>
                    </ul>
                    <h5 class="required">Seznámil(a) jsem se s následujícími dokumenty, beru vše na vědomí a souhlasím s:</h5>
                    <div class="form-ke-stazeni">
                        <a href="{{ asset('documents/Všeobecné podmínky LT Karštejn.pdf') }}" target="_blank">Všeobecné podmínky LT Karštejn</a>
                        <a href="{{ asset('documents/Taborovy_rad_zs_Karstejn.pdf') }}" target="_blank">Táborový řád</a>
                        <a href="{{ asset('documents/Storno podmínky.pdf') }}" target="_blank">Podmínky stornování přihlášky</a>
                        <a href="{{ asset('documents/Ochrana osobních údajů 2024.pdf') }}" target="_blank">Podmínky o zpracování údajů</a>
                    </div>
                    <div>
                        <input type="checkbox" id="gen-terms-and-cond" name="general_terms_and_conditions">
                        <label for="gen-terms-and-cond">Všeobecné podmínky LT Karštejn</label>
                    </div>
                    <div>
                        <input type="checkbox" id="camp-rules" name="camp_rules">
                        <label for="camp-rules">Táborový řád</label>
                    </div>
                    <div>
                        <input type="checkbox" id="ap-storno" name="application_storno">
                        <label for="ap-storno">Podmínky stornování přihlášky</label>
                    </div>
                    <div>
                        <input type="checkbox" id="data-privacy" name="data_privacy">
                        <label for="data-privacy">Podmínky o zpracování údajů</label>
                    </div>
                </div>
                <div class="formular">
                    <h4 class="required">Souhlas s pořízením a použitím fotografií a audio/video záznamu</h4>
                    <p>Souhlasím s pořizováním a použitím fotografií a obrazových záznamů mě a mého dítěte za účelem propagační
                        činnosti a prezentace na veřejnosti, v tisku a na webových stránkách po celou dobu existence skupiny
                        Karštejn z.s. Jsem informován o možnosti přístupu ke svým osobním údajům, právu na jejich opravu,
                        doplnění,
                        omezení, blokování či likvidaci v souladu s novým nařízením Evropského parlamentu a Rady (EU) 20
                        16/679.Veškeré osobní údaje jsou zpracovávány výhradně pověřenými pracovníky skupiny Karštejn z.s.,
                        kteří
                        dodržují postupy pro zamezení zneužití Vašich osobních údajů.</p>
                    <div class="input-box-radio">
                        <div>
                            <input type="radio" id="photo-ano" name="photos_agreement" value="Ano" required>
                            <label for="photo-ano">Ano</label>
                        </div>
                        <div>
                            <input type="radio" id="photo-ne" name="photos_agreement" value="Ne">
                            <label for="photo-ne">Ne</label>
                        </div>
                    </div>
                </div>
                <div class="formular">
                    <h4 class="required">Chci vystavit fakturu pro zaměstnavatele</h4>
                    <div class="input-box-radio">
                        <div>
                            <input type="radio" id="facture-ano" name="facture" value="Ano" required>
                            <label for="facture-ano">Ano</label>
                        </div>
                        <div>
                            <input type="radio" id="facture-ne" name="facture" value="Ne">
                            <label for="facture-ne">Ne</label>
                        </div>
                    </div>
                </div>
                <div class="submit-form">
                    <input type="submit" value="Odeslat" @if ($spusteni_prihlasek == 'ne') disabled @endif>
                </div>
            </form>
        </div>
    </div>
@endsection
