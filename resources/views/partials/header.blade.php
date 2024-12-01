<header>
    <a href="{{ route('index') }}"><img id="logo" src="{{ asset("images/logo.png") }}" alt="logo"></a>

    <div class="nadpis">
        <a href="{{ route('index') }}">
            <div class="nadpis-LT">Letní tábor</div>
            <div class="nadpis-Karstejn">Karštejn</div>
        </a>
    </div>

    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <nav>
        <ul class="nav-btns">
            <li><a href="{{ route('index') }}" class={{ request()->is('/') ? "active" : '' }}>Domů</a></li>
            <li><a href="{{ route('info') }}" class={{ request()->is('info') ? "active" : '' }}>Důležité info</a></li>
            <li><a href="{{ route('galerie_rocniky') }}" class={{ request()->is('galerie*') ? "active" : '' }}>Galerie</a></li>
            <li><a href="{{ route('kronika') }}" class={{ request()->is('kronika') ? "active" : '' }} >Kronika</a></li>
            <li><a class="btn-prihlaska" href="{{ route('prihlaska') }}">Přihláška</a></li>
        </ul>
        
        <div class="social-top">
            <a href="https://www.facebook.com/karstejn" target="_blank"><i class="fa fa-facebook fa-lg icon-fb"></i></a>
            <a href="https://www.instagram.com/lt.karstejn/?hl=cs" target=“_blank“><i class="fa fa-instagram fa-lg icon-in"></i></a>
            <a href="https://www.youtube.com/@letnitaborkarstejn2920" target=“_blank“><i class="fa fa-youtube-play fa-lg icon-yt"></i></a>
        </div>

        <div>
            <a href="{{ route('prihlasky-private') }}"><i class="fa fa-user icon-user" aria-hidden="true"></i></a>
        </div>
    </nav>
</header>