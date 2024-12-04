@extends('layouts.app')
@section('title', 'Informace')
@section('content')
    <div class="container">
        <section>
            <h2>Aktuality</h2>
            <div class="aktuality">
                <div class="aktuality-carusel">
                    <div class="aktuality-slider">
                        <section>
                            <div class="aktualita">
                                <img id="plakat_2025" src="{{ asset('images/plakaty/plakat_2025.jpg') }}" alt="">
                                <p>Neleníme a pylně chystáme následující ročník. Více info naleznete <a href="info.html#Karstejn-aktualni">zde</a>.</p>
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

        <section>
            <div id="Karstejn-aktualni">
                <h1>Karštejn {{ $data_rocniky['rok'] }}</h2>
                <div class="karstejn-behy-info">
                    <p>Jako každý rok i letos se uskuteční 2 běhy našeho letního tábora.</p>
                    <p>Pro děti od <strong>7</strong> do <strong>15</strong> let</p>
                    <p>Na <strong>14 dní</strong> (termín viz běhy níže)</p>
                    <p><strong>Cena: </strong> {{ $data_rocniky['cena'] }} Kč (cena zahrnuje ubytování, stravu, dopravu a pestrý program)</p>
                </div>

                <div class="behy-grid">
                    <div class="behy-grid-item">
                        <h2>I. běh</h2>
                        <div class="datum-behu">{{ $data_rocniky['termin_1beh'] }}</div>
                        <h3>{{ $data_rocniky['tema_1beh'] }}</h3>
                        <img src="{{ asset('images/plakaty/plakat_2025.jpg') }}">
                        <a href="#">Přihlašování nezahájeno</a>
                    </div>
                    <div class="behy-grid-item">
                        <h2>II. běh</h2>
                        <div class="datum-behu">{{ $data_rocniky['termin_2beh'] }}</div>
                        <h3>{{ $data_rocniky['tema_2beh'] }}</h3>
                        <img src="{{ asset('images/plakaty/plakat_2025_II_beh.jpg.avif') }}">
                        <a href="#">Přihlašování nezahájeno</a> 
                    </div>
                </div>
            </div>
        </section>
    </div>


    <section>
        <div class="image-info-div">
            <h1>Mohlo by Vás zajímat?</h1>
        </div>
    </section>

    <div class="container">
        <section>
            <div class="zazemi-tabora">
                <h2>Zázemí tábora</h2>
                <div class="info-photo-gallery">
                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zázemí/_DSC0219.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zázemí/DSC03788.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/zázemí/DSC03797.JPG') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="aktivity">
                <h2>Aktivity</h2>
                <div class="info-photo-gallery">
                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/hry/DSC03976.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/děti_together/_DSC0381.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/děti_together/DSC02253.JPG') }}" alt="">
                        </div>
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/děti_together/DSC04027.JPG') }}" alt="">
                        </div>
                    </div>

                    <div class="column">
                        <div class="photo">
                            <img class="photo-info" src="{{ asset('images/děti_together/DSC04283.JPG') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="ke-stazeni">
                <h2>Ke stažení</h2>
                <div class="section-download-grid">
                    <div class="section-download-grid-item">
                        <p>Seznam věcí s sebou:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>
                    
                    <div class="section-download-grid-item">
                        <p>Zpěvník:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>
                    
                    <div class="section-download-grid-item">
                        <p>Formuláře:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>

                    <div class="section-download-grid-item">
                        <p>Táborový řád:</p>
                    </div>
                    <div class="section-download-grid-item">
                        <a href="documents/seznam.pdf" download class="btn-download">Stáhnout <i class="fa fa fa-download"></i></a>
                    </div>    
                </div>
            </div>
        </div>

        @include('partials.contact')
@endsection