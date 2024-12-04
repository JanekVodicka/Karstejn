<div class="nav-bar">
    <div class="nav-items">
        <ul>
            <li class="{{ $active === 'rocniky' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'rocniky' ? 'active-item' : '' }}" href="{{ route('galerie_rocniky') }}">ROČNÍKY</a>
            </li>
            
            <li class="{{ $active === 'rocniky' ? 'act' : 'nonact' }}">
                <a class="{{ $activealbum === 'rocniky' ? 'active-album' : 'non-active-album'}}">{{ $year }} - {{ $albumname }}</a>
            </li>

            <li class="{{ $active === 'akce' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'akce' ? 'active-item' : '' }}" href="{{ route('galerie_akce') }}">AKCE</a>
            </li>

            <li class="{{ $active === 'akce' ? 'act' : 'nonact' }}">
                <a class="{{ $activealbum === 'akce' ? 'active-album' : 'non-active-album'}}">{{ $year }} - {{ $albumname }}</a>
            </li>

            <li class="{{ $active === 'videa' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'videa' ? 'active-item' : '' }}" href="{{ route('galerie_videa') }}">VIDEA</a>
            </li>
            <li class="{{ $active === 'ostatni' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'ostatni' ? 'active-item' : '' }}" href="{{ route('galerie_ostatni') }}">OSTATNÍ</a>
            </li>
        </ul>
    </div>
    <div class="nav-items-control">
        <i class="fa fa-angle-down nav-arrow arrow-nav"></i>
        @if(request()->is('galerie/*'))
            <a href="{{ url()->previous() }}"><i class="fa fa-angle-left nav-arrow arrow-back"></i></a>
        @endif
    </div>
</div>
