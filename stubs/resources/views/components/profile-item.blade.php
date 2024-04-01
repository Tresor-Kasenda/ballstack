@props([
    'title' => '',
    'name' => ''
])
<div {{ $attributes->class(['profile-ud-item']) }}>
    <div class="profile-ud wider">
        <span class="profile-ud-label">{{ $title }}</span>
        <span class="profile-ud-value">{{ $name }}</span>
    </div>
</div>
