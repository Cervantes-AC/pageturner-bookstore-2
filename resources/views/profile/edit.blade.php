@extends('layouts.app')
@section('title', 'Profile - PageTurner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold mb-6 text-white">Profile Settings</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Profile Information --}}
            <div class="p-6 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-white">Profile Information</h2>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Security Settings --}}
            <div class="p-6 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-white">Security Settings</h2>
                @include('profile.partials.security-settings')
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Password Update --}}
            <div class="p-6 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-white">Update Password</h2>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Account Deletion --}}
            <div class="p-6 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-red-400">Danger Zone</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
