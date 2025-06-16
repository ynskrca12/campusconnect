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

<a href="javascript:void(0);" class="avatar user-avatar-component" data-userid="{{ $user->id }}">
    <img class="avatar"
        style="background-color: {{ $bgColor }};"
        src="{{ $imagePath }}"
        data-default="{{ asset('img/default-profile-picture-light.svg') }}" 
        alt="{{ $user->username ?? 'Anonim' }}" 
        title="{{ $user->username ?? 'Anonim' }}">
</a>


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