<!-- header -->
<nav class="navbar fixed-top py-2 navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="/20031223">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/20031223/add_portfolio">Add Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/20031223/add_skill">Add Skill</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/20031223/message">Message</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" style="cursor: pointer" :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>