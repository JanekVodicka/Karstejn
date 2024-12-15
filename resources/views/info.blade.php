@extends('layouts.app')
@section('title', 'Informace')
@section('content')
    <div class="container">
        <section>
            <div id="aktuality">
                <h2>Aktuality</h2>
                <div class="aktuality-carusel">
                    <div class="aktuality-slider">
                        <section>
                            <div class="aktualita">
                                <img id="plakat_2025" src="{{ asset('images/plakaty/plakat_aktualni.jpg') }}" alt="">
                                <p>Neleníme a pylně chystáme následující ročník. Více info naleznete <a href="{{ route('info') }}#Karstejn-aktualni">zde</a>.</p>
                            </div>
                        </section>
                        <section>
                            <div class="aktualita">
                                <p>Byly přidány fotky na facebook</p>
                                <a href="https://www.facebook.com/karstejn" target="_blank"><i class="fa fa-facebook-f icon-fb" style="font-size:36px; padding:10px"></i></a>
                            </div>
                        </section>
                        <section>
                            <div class="aktualita">
                                <h3>VÍKENDOVKA 25.-27.10.2025</h3>
                                <p>Více informací naleznete <a href="">zde</a>.</p>
                            </div>
                        </section>
                    </div>
                    <div class="controls">
                        <i class="fa fa-angle-left arrow left"></i>
                        <i class="fa fa-angle-right arrow right"></i>
                        <ul>
                            <li class="selected"></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

        <section>
            <div class="image-div" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.0)), url('{{ asset('images/ohen_freetime/DSC05635.JPG') }}'); opacity: 0.9;">
                <h1>Chcete k nám?</h1>
            </div>
        </section>

    <div class="container">
        <section>
            <div id="Karstejn-aktualni">
                <h1>Karštejn {{ $data_rocniky['rok'] }}</h1>
                <div class="karstejn-behy-info">
                    <p>Jako každý rok i letos se uskuteční 2 běhy našeho letního tábora.</p>
                    <p>Pro děti od <strong>7</strong> do <strong>15</strong> let</p>
                    <p>Na <strong>14 dní</strong> (termín viz běhy níže)</p><br>
                    <p><strong>Cena: </strong> {{ $data_rocniky['cena'] }} Kč <br>(cena zahrnuje ubytování, stravu, dopravu a pestrý program)</p>
                </div>

                <div class="behy-grid">
                    <div class="behy-grid-item">
                        <h2>I. běh</h2>
                        <div class="datum-behu">{{ $data_rocniky['termin_1beh'] }}</div>
                        <h3>{{ $data_rocniky['tema_1beh'] }}</h3>
                        <a href="{{ asset('images/plakaty/plakat_aktualni.jpg') }}"><img src="{{ asset('images/plakaty/plakat_aktualni.jpg') }}"></a>
                        <a class="btn-prihlaska {{ $spusteni_prihlasek == 'ano' ? 'prihlasky-zahajeny' : 'prihlasky-nezahajeny'}}" href="{{ route('prihlaska') }}">{{ $spusteni_prihlasek == 'ano' ? 'Přihlašování zahájeno' : 'Přihlašování ukončeno'}}</a>
                    </div>
                    <div class="behy-grid-item">
                        <h2>II. běh</h2>
                        <div class="datum-behu">{{ $data_rocniky['termin_2beh'] }}</div>
                        <h3>{{ $data_rocniky['tema_2beh'] }}</h3>
                        <a href="{{ asset('images/plakaty/plakat_aktualni_II_beh.jpg') }}"><img src="{{ asset('images/plakaty/plakat_aktualni_II_beh.jpg') }}"></a>
                        <a class="btn-prihlaska {{ $aktivace_prihlasek_2beh == 'ano' ? 'prihlasky-zahajeny' : 'prihlasky-nezahajeny'}}" href="https://www.karstejn.org/#prihlaska" target="_blank">{{ $aktivace_prihlasek_2beh == 'ano' ? 'Přihlašování zahájeno' : 'Přihlašování ukončeno'}}</a> 
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section>
        <div class="image-div" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.0)), url('{{ asset('images/pozadi/P0000178.JPG') }}'); opacity: 1;">
            <h1>Mohlo by Vás zajímat?</h1>
        </div>
    </section>

    <div class="container">
        <section>
            <div id="zazemi-tabora">
                <h2>Zázemí tábora</h2>
                <div class="info-photo-gallery">
                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zazemi/_DSC0219.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zazemi/DSC03788.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zazemi/DSC03797.JPG') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="aktivity">
                <h2>Aktivity</h2>
                <div class="info-photo-gallery">
                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/hry/DSC03976.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/deti_together/_DSC0381.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/deti_together/DSC02253.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/deti_together/DSC04027.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/deti_together/DSC04283.JPG') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="ke-stazeni">
                <h2>Ke stažení</h2>
                <div class="section-download-grid">
                    <div class="section-download-grid-item">
                        <p>Táborový řád:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="{{ asset('documents/Taborovy_rad_zs_Karstejn.pdf') }}" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Všeobecné podmínky LT Karštejn:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="{{ asset('documents/Všeobecné podmínky LT Karštejn.pdf') }}" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Storno podmínky:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="{{ asset('documents/Storno podmínky.pdf') }}" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Podmínky o zpracování údajů:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="{{ asset('documents/Ochrana osobních údajů 2024.pdf') }}" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Přihláškové formuláře:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Seznam věcí s sebou:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>    
                </div>
            </div>
        </div>

        @include('partials.contact')
@endsection