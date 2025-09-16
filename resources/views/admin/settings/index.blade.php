@extends('layouts.main')

@section('content')
<div class="container py-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <ul class="nav nav-tabs mb-3" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding" type="button">Branding</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button">Email</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button">Footer</button>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Branding -->
            <div class="tab-pane fade show active" id="branding">
                <div class="mb-3">
                    <label class="form-label">Site Name</label>
                    <input name="site_name" class="form-control" value="{{ setting('site_name', config('app.name')) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Site Logo</label>
                        <input type="file" name="site_logo" class="form-control">
                        @if(setting('site_logo'))
                          <img src="{{ asset(setting('site_logo')) }}" alt="logo" style="height:60px;margin-top:8px;">
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Favicon</label>
                        <input type="file" name="favicon" class="form-control">
                        @if(setting('favicon'))
                          <img src="{{ asset(setting('favicon')) }}" alt="favicon" style="height:40px;margin-top:8px;">
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Theme Color (hex)</label>
                    <input name="theme_color" class="form-control" value="{{ setting('theme_color','#007bff') }}">
                </div>
            </div>

            <!-- Email -->
            <div class="tab-pane fade" id="email">
                <div class="mb-3">
                    <label class="form-label">From Email</label>
                    <input name="from_email" class="form-control" value="{{ setting('from_email', config('mail.from.address')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">From Name</label>
                    <input name="from_name" class="form-control" value="{{ setting('from_name', config('mail.from.name')) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Signature (HTML allowed)</label>
                    <textarea name="email_signature" rows="4" class="form-control">{{ setting('email_signature') }}</textarea>
                </div>
            </div>

            <!-- Footer -->
            <div class="tab-pane fade" id="footer">
                <div class="mb-3">
                    <label class="form-label">Footer Text (HTML allowed)</label>
                    <textarea name="footer_text" class="form-control" rows="3">{{ setting('footer_text') }}</textarea>
                </div>

                <h6>Social Links</h6>
                @php $social = setting('social_links', []); @endphp
                <div class="mb-3">
                    <label class="form-label">Facebook URL</label>
                    <input name="facebook" class="form-control" value="{{ $social['facebook'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">LinkedIn URL</label>
                    <input name="linkedin" class="form-control" value="{{ $social['linkedin'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Twitter / X URL</label>
                    <input name="twitter" class="form-control" value="{{ $social['twitter'] ?? '' }}">
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <button class="btn btn-secondary me-2" type="reset">Reset</button>
            <button class="btn btn-primary" type="submit">Save Settings</button>
        </div>
    </form>
</div>
@endsection
