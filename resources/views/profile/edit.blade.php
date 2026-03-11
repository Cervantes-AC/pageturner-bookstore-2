@extends('layouts.app')
@section('title', 'Profile Settings')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your account information and security settings.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Profile Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Profile Information</h2>
                    <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Security Settings -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Security Settings</h2>
                    <p class="mt-1 text-sm text-gray-600">Manage two-factor authentication and security options.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.security-settings')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Update Password</h2>
                    <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-lg shadow-sm border border-red-200">
                <div class="px-6 py-4 border-b border-red-200 bg-red-50">
                    <h2 class="text-lg font-semibold text-red-900">Delete Account</h2>
                    <p class="mt-1 text-sm text-red-700">Permanently delete your account and all associated data.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
