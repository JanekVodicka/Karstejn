<div class="nav-gallery-bar">
    <div class="nav-gallery">
        <ul>
            <li class="{{ $active === 'rocniky' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'rocniky' ? 'active-gallery' : '' }}" href="{{ route('galerie_rocniky') }}">ROČNÍKY</a>
            </li>
            
            <li class="{{ $active === 'rocniky' ? 'act' : 'nonact' }}">
                <a class="{{ $activealbum === 'rocniky' ? 'active-album' : 'non-active-album'}}">{{ $year }} - {{ $albumname }}</a>
            </li>

            <li class="{{ $active === 'akce' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'akce' ? 'active-gallery' : '' }}" href="{{ route('galerie_akce') }}">AKCE</a>
            </li>

            <li class="{{ $active === 'akce' ? 'act' : 'nonact' }}">
                <a class="{{ $activealbum === 'akce' ? 'active-album' : 'non-active-album'}}">{{ $year }} - {{ $albumname }}</a>
            </li>

            <li class="{{ $active === 'videa' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'videa' ? 'active-gallery' : '' }}" href="{{ route('galerie_videa') }}">VIDEA</a>
            </li>
            <li class="{{ $active === 'ostatni' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'ostatni' ? 'active-gallery' : '' }}" href="{{ route('galerie_ostatni') }}">OSTATNÍ</a>
            </li>
        </ul>
    </div>
    <div class="nav-gallery-control">
        <i class="fa fa-angle-down gallery-arrow arrow-nav"></i>
        @if(request()->is('galerie/*'))
            <a href="{{ url()->previous() }}"><i class="fa fa-angle-left gallery-arrow arrow-back"></i></a>
        @endif
    </div>
</div>
