@props(['icon', 'link', 'name'])

<li class="sidebar-item">
    <a href="{{ $link }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
</li>
