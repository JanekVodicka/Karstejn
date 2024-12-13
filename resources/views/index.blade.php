@extends('layouts.app')
@section('title', 'Karštejn - 1. běh')
@section('content')
    <div class="image-main">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset('videos/video_uvodni.mp4') }}" type="video/mp4">
        </video>
        <div class="image-main-content">
            <div class="image-main-header">
                <h1>LT Karštejn</h1>
            </div>
            <div class="image-main-anchors">
                <a href="{{ route('info') }}#Karstejn-aktualni">Karštejn {{ $data_rocniky['rok'] }}</a>
                <a href="{{ route('prihlaska') }}">Přihláška</a>
            </div>
        </div>
    </div>

    <div class="container">
        <section>
            <div id="o-nas">
                <h1>O nás</h1>
                <div class="section-grid">
                    <div class="section-grid-item">
                        <h3>Naše kořeny</h2>
                        <div class="section-grid-text">
                            <img id="parez" src="{{ asset('images/drawing_parez.jpg') }}" alt="Pařez malůvka">
                            <p>Letní tábor Karštejn má více než padesátiletou tradici, která se promítá do každého léta,
                                které společně trávíme.</p><br>
                            <p>Stanový tábor se nachází v chráněné krajinné oblasti Třeboňsko, poblíž Kardašovy Řečice, mezi
                                Malým a Velkým Závistivým rybníkem.</p><br>
                            <p>Obklopeny lesem a přírodou děti zažívají jedinečné spojení dobrodružství a klidu, které tento
                                kout Jižních Čech nabízí.</p><br>
                            <p>Tato lokalita poskytuje ideální prostředí pro zkoumání přírody, táborové hry a výpravy, které
                                jsou nedílnou součástí našeho programu.</p>
                        </div>  
                    </div>
                    <div class="section-grid-item">
                        <div class="section-grid-img">
                            <img src="{{ asset('images/ohen_deti.jpg') }}" alt="Oheň děti">
                        </div>
                    </div>
                    <div class="section-grid-item">
                        <div class="section-grid-img">
                            <img src="{{ asset('images/vize/P1020184.jpg') }}" alt="Vize">
                        </div>
                    </div>
                    <div class="section-grid-item">
                        <h3>Průvodci divočinou</h2>
                        <div class="section-grid-text">
                            <img id="totem" src="{{ asset('images/drawing_totem.jpg') }}" alt="Totem">
                            <p>Náš karštejnský tým se skládá z nadšených vedoucích a instruktorů, kteří pečlivě plánují a
                                připravují každou část tábora, a to nejen během léta, ale po celý rok.</p><br>
                            <p>še dva běhy spolupracují, aby udržovaly tábor v kondici, pořádají brigády a setkání, která
                                nejen posilují týmového ducha, ale také rozvíjejí naše schopnosti a nápady.</p><br>
                            <p>Naši zkušení a proškolení vedoucí spolu s kvalifikovanou zdravotnicí zajišťují pro děti
                                bezpečný prostor, kde se mohou plně ponořit do táborového života.</p>
                        </div>   
                    </div>
                    <div class="section-grid-item">
                        <h3>Kam směřujeme</h2>
                        <div class="section-grid-text">
                            <img id="esus" src="{{ asset('images/drawing_esus.jpg') }}" alt="Ešus">
                            <p>Naším cílem je rozvíjet u dětí hlubší vztah k přírodě, vést je k odpovědnému chování, jako je
                                předcházení vzniku odpadu a jeho třídění, a učit je, jak s respektem přistupovat k prostředí
                                kolem nás.</p><br>
                            <p>Na Karštejně klademe velký důraz na budování silného kolektivu a dlouhodobou spolupráci mezi
                                vedoucími, instruktory a dětmi. Díky pravidelným setkáním a společným projektům v průběhu
                                roku budujeme pevné vazby, které se odrážejí v táborovém životě a přerůstají v
                                dlouhotrvající přátelství..</p>
                        </div> 
                    </div>
                    <div class="section-grid-item">
                        <div class="section-grid-img">
                            <img src="{{ asset('images/kzw_karstejn_trika_post/triko_forma.JPG') }}" alt="Triko forma">
                        </div>
                    </div>
                    <div class="section-grid-item">
                        <div class="section-grid-img">
                            <img src="{{ asset('images/hry/P1010332.jpg') }}" alt="Hra">
                        </div>
                    </div>
                    <div class="section-grid-item">
                        <h3>Aktivity</h2>
                        <div class="section-grid-text">
                            <img id="gong" src="{{ asset('images/drawing_gong.jpg') }}" alt="Gong">
                            <p>Karštejnské léto je nabité pestrým programem, který zajišťuje, že si každý najde něco, co ho
                                baví. Děti se mohou těšit na celotáborovou hru, která podporuje týmovou spolupráci a
                                kreativitu.</p><br>
                            <p>Každý večer se scházíme u ohně, kde si zpíváme s kytarou (někdy i s ukulele, bubnem, tahací
                                nebo foukací harmonikou) a sdílíme zážitky z uplynulého dne. Volný čas pak děti mohou využít
                                na různé sportovní aktivity, jako je pingpong, fotbal nebo basketbal.</p><br>
                            <p>Nezapomínáme ani na relaxaci a odpočinek v krásné přírodě, kde během poledního klidu čteme,
                                hrajeme karetní hry nebo si dopřáváme zasloužený spánek.</p>
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </div>

    <Section>
        <div class="image-div" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('{{ asset('images/svetlo_stromy.jpg') }}'); opacity: 1;">
            <h1>49°8'30.012"N<br>14°48'9.475"E</h1>
        </div>
    </Section>
    

    <div class="container">
        <section>
            <div id="nas-tym">
                <h2>Náš tým</h2>
                <img id="nas-tym-skupinovka" src="{{ asset('images/skupinovka_historická/_DSC0522.JPG') }}" alt="">
                <div class="drawing_teepee_totem">
                    <img id="teepee" src="{{ asset('images/drawing_teepee.jpg') }}" alt="">
                    <img id="totem_2" src="{{ asset('images/drawing_totem.jpg') }}" alt="">
                </div>
            </div>
        </section>
    </div>

    @include('partials.contact')
@endsection