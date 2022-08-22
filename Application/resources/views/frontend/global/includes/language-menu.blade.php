<div class="dropdown language">
    <button class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="language-icon">
            <i class="fas fa-globe"></i>
        </div>
        <span class="language-title">{{ getLangName() }}</span>
        <div class="language-arrow">
            <i class="fas fa-chevron-down fa-xs me-0"></i>
        </div>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        @foreach ($languages as $language)
            <li>
                <a class="dropdown-item {{ app()->getLocale() == $language->code ? 'active' : '' }}"
                    href="{{ langURL($language->code) }}">{{ $language->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
