<div class="nav-bar">
    <div class="nav-items">
        <ul>
            <li class="{{ $active === 'settings' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'settings' ? 'active-item' : '' }}" href="{{ route('settings') }}">NASTAVENÍ</a>
            </li>

            <li class="{{ $active === 'prihlasky-private' ? 'act' : 'nonact' }}">
                <a class="{{ $active === 'prihlasky-private' ? 'active-item' : '' }}" href="{{ route('prihlasky-private') }}">PŘIHLÁŠKY</a>
            </li>
        </ul>

        <div class="log-out">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Odhlásit se</button>
            </form>
        </div>
    </div>
    <div class="nav-items-control">
        <i class="fa fa-angle-down nav-arrow arrow-nav"></i>
    </div>
</div>
