@props(['user'])

@php
    $imageName = $user->user_image ?? null;
    $imagePath = $imageName
        ? asset('storage/profile_images/' . $imageName)
        : asset('assets/images/icons/user.png');

    $bgColor = match ($imageName) {
        'man.png' => '#95bdff',
        'woman.png' => '#ffbdd3',
        default => 'transparent',
    };
@endphp

<style>
    .avatar{
        display: block;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-top: -2px;
        margin-bottom: 2px;
        object-fit: cover;
    }
</style>

@if($user)
    <div class="user-avatar-component"
         data-userid="{{ $user->id }}"
         data-username="{{ $user->username }}"
         style="cursor: pointer;">
        <img src="{{ $imagePath }}"
             alt="{{ $user->username }}"
             style="background-color: {{ $bgColor }};"
              class="avatar">
    </div>
@else
    {{-- Kullanıcı silinmiş veya yok --}}
    <div style="cursor: default;">
        <img  src="{{ $imagePath }}"
            style="background-color: {{ $bgColor }};"
             alt="Anonim"
             class="avatar">
    </div>
@endif
