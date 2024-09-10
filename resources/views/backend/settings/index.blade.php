@extends('backend.master')
@section('content')
    <h1>Site Settings</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

       
            <div>
                <label for="site_name">Site Name</label>
                <input type="text" name="site_name" id="site_name" value="{{ $settings->site_name ?? '' }}">
            </div>
            
            <div>
                <label for="site_title">Site Title</label>
                <input type="text" name="site_title" id="site_title" value="{{ $settings->site_title ?? '' }}">
            </div>
            
            <div>
                <label for="site_short_description">Site Short Description</label>
                <textarea name="site_short_description" id="site_short_description">{{ $settings->site_short_description ?? '' }}</textarea>
            </div>
            
            <div>
                <label for="site_description">Site Description</label>
                <textarea name="site_description" id="site_description">{{ $settings->site_description ?? '' }}</textarea>
            </div>

            <div>
                <label for="site_description">Site keyword</label>
                <textarea name="keyword" id="keyword">{{ $settings->keyword ?? '' }}</textarea>
            </div>
            
            <div>
                <label for="site_image">Site Image</label>
                <input type="file" name="site_image" id="site_image">
                @if ($settings->site_image)
                    <img src="{{ asset('images/siteimage/' . $settings->site_image) }}" alt="Site Image" width="100">
                @endif
            </div>
            
            <div>
                <label for="site_share_image">Site Share Image</label>
                <input type="file" name="site_share_image" id="site_share_image">
                @if ($settings->site_share_image)
                    <img src="{{ asset('images/siteimage/' . $settings->site_share_image) }}" alt="Share Image" width="100">
                @endif
            </div>
            
            <div>
                <label for="site_favicon">Site Favicon</label>
                <input type="file" name="site_favicon" id="site_favicon">
                @if ($settings->site_favicon)
                    <img src="{{ asset('images/siteimage/' . $settings->site_favicon) }}" alt="Favicon" width="32">
                @endif
            </div>
          
        <button type="submit">Save</button>
    </form>
    @endsection