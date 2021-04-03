@props(['icon', 'link', 'name'])

<li class="sidebar-item has-sub">
    <a href="{{ $link }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
    <ul class="submenu">
        {{ $submenu }}
    </ul>
</li>
