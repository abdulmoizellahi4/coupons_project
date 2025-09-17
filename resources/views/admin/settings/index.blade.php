@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Site Settings</h5>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.settings.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to reset all settings to default values?')">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning">
                                <i class="ri-refresh-line me-1"></i>Reset to Default
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Branding Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="ri-palette-line me-2"></i>Branding Settings
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($brandingSettings as $setting)
                                        <div class="col-md-6 mb-3">
                                            <label for="{{ $setting->key }}" class="form-label">{{ $setting->label }}</label>
                                            @if($setting->type === 'textarea')
                                                <textarea class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3">{{ $setting->value }}</textarea>
                                            @elseif($setting->type === 'image')
                                                <div class="image-upload-container">
                                                    @if($setting->value)
                                                        <div class="current-image-preview mb-3">
                                                            <label class="form-label text-success">
                                                                <i class="ri-check-circle-fill me-1"></i>Current {{ $setting->label }} (Active on Website)
                                                            </label>
                                                            <div class="current-image-box">
                                                                <img src="{{ asset('storage/' . $setting->value) }}" 
                                                                     alt="Current {{ $setting->label }}" 
                                                                     class="current-image"
                                                                     style="max-width: {{ $setting->key === 'site_logo' ? '200px' : '64px' }}; max-height: {{ $setting->key === 'site_logo' ? '100px' : '64px' }}; border: 2px solid #28a745; border-radius: 8px; padding: 10px; background: #f8f9fa;">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="image-upload-box" onclick="document.getElementById('{{ $setting->key }}').click()">
                                                        <img id="{{ $setting->key }}_preview"
                                                             src="{{ $setting->value ? asset('storage/' . $setting->value) : '' }}"
                                                             style="{{ $setting->value ? '' : 'display:none;' }}">
                                                        <svg id="{{ $setting->key }}_placeholder" style="{{ $setting->value ? 'display:none;' : '' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M20,5A2,2 0 0,1 22,7V17A2,2 0 0,1 20,19H4C2.89,19 2,18.1 2,17V7C2,5.89 2.89,5 4,5H20M5,16H19L14.5,10L11,14.5L8.5,11.5L5,16Z" />
                                                        </svg>
                                                    </div>
                                                    <input type="file" id="{{ $setting->key }}" name="{{ $setting->key }}" style="display:none;" accept="image/*"
                                                           onchange="previewImage(event, '{{ $setting->key }}_preview', '{{ $setting->key }}_placeholder')">
                                                    <div class="form-text">
                                                        @if($setting->value)
                                                            <span class="text-success">
                                                                <i class="ri-check-circle-fill me-1"></i>Current {{ $setting->label }} is active on website
                                                            </span><br>
                                                        @endif
                                                        Click to upload new {{ strtolower($setting->label) }} (Max: {{ $setting->key === 'site_logo' ? '2MB' : '1MB' }})
                                                    </div>
                                                </div>
                                             @elseif(in_array($setting->key, ['primary_color', 'secondary_color', 'background_primary_color', 'background_secondary_color', 'text_color']))
                                                 <div class="color-input-group">
                                                     <div class="input-group">
                                                         <input type="color" class="form-control form-control-color" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                                         <input type="text" class="form-control color-text-input" value="{{ $setting->value }}" readonly>
                                                     </div>
                                                     <div class="color-preview" style="background-color: {{ $setting->value }}; border: 1px solid #ddd; width: 100%; height: 40px; border-radius: 4px; margin-top: 8px;"></div>
                                                 </div>
                                            @else
                                                <input type="{{ $setting->type === 'email' ? 'email' : ($setting->type === 'url' ? 'url' : 'text') }}" 
                                                       class="form-control" 
                                                       id="{{ $setting->key }}" 
                                                       name="settings[{{ $setting->key }}]" 
                                                       value="{{ $setting->value }}">
                                            @endif
                                            @if($setting->description)
                                                <div class="form-text">{{ $setting->description }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Contact Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="ri-phone-line me-2"></i>Contact Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($contactSettings as $setting)
                                        <div class="col-md-6 mb-3">
                                            <label for="{{ $setting->key }}" class="form-label">{{ $setting->label }}</label>
                                            @if($setting->type === 'textarea')
                                                <textarea class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3">{{ $setting->value }}</textarea>
                                            @elseif($setting->type === 'email')
                                                <input type="email" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                            @elseif($setting->type === 'phone')
                                                <input type="tel" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                            @else
                                                <input type="text" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                            @endif
                                            @if($setting->description)
                                                <div class="form-text">{{ $setting->description }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="ri-share-line me-2"></i>Social Media Links
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($socialSettings as $setting)
                                        <div class="col-md-6 mb-3">
                                            <label for="{{ $setting->key }}" class="form-label">
                                                @php
                                                    $icons = [
                                                        'facebook_url' => 'ri-facebook-fill',
                                                        'twitter_url' => 'ri-twitter-fill',
                                                        'instagram_url' => 'ri-instagram-fill',
                                                        'linkedin_url' => 'ri-linkedin-fill',
                                                        'youtube_url' => 'ri-youtube-fill',
                                                        'tiktok_url' => 'ri-tiktok-fill'
                                                    ];
                                                @endphp
                                                <i class="{{ $icons[$setting->key] ?? 'ri-link' }} me-1"></i>{{ $setting->label }}
                                            </label>
                                            <input type="url" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" placeholder="https://...">
                                            @if($setting->description)
                                                <div class="form-text">{{ $setting->description }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- General Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">
                                    <i class="ri-settings-3-line me-2"></i>General Settings
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($generalSettings as $setting)
                                        <div class="col-md-6 mb-3">
                                            <label for="{{ $setting->key }}" class="form-label">{{ $setting->label }}</label>
                                            @if($setting->type === 'textarea')
                                                <textarea class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3">{{ $setting->value }}</textarea>
                                            @elseif($setting->key === 'timezone')
                                                <select class="form-select" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]">
                                                    <option value="Europe/London" {{ $setting->value === 'Europe/London' ? 'selected' : '' }}>Europe/London (GMT)</option>
                                                    <option value="America/New_York" {{ $setting->value === 'America/New_York' ? 'selected' : '' }}>America/New_York (EST)</option>
                                                    <option value="America/Los_Angeles" {{ $setting->value === 'America/Los_Angeles' ? 'selected' : '' }}>America/Los_Angeles (PST)</option>
                                                    <option value="Asia/Tokyo" {{ $setting->value === 'Asia/Tokyo' ? 'selected' : '' }}>Asia/Tokyo (JST)</option>
                                                    <option value="Asia/Dubai" {{ $setting->value === 'Asia/Dubai' ? 'selected' : '' }}>Asia/Dubai (GST)</option>
                                                </select>
                                            @elseif($setting->key === 'currency')
                                                <select class="form-select" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]">
                                                    <option value="GBP" {{ $setting->value === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                                                    <option value="USD" {{ $setting->value === 'USD' ? 'selected' : '' }}>USD ($)</option>
                                                    <option value="EUR" {{ $setting->value === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                                    <option value="CAD" {{ $setting->value === 'CAD' ? 'selected' : '' }}>CAD (C$)</option>
                                                    <option value="AUD" {{ $setting->value === 'AUD' ? 'selected' : '' }}>AUD (A$)</option>
                                                </select>
                                            @else
                                                <input type="text" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                            @endif
                                            @if($setting->description)
                                                <div class="form-text">{{ $setting->description }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i>Save Settings
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="ri-arrow-left-line me-1"></i>Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.image-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #007bff;
    background: #e3f2fd;
}

.current-image-preview {
    text-align: center;
}

.current-image-box {
    display: inline-block;
    margin-top: 10px;
}

.current-image {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.current-image:hover {
    transform: scale(1.05);
}

.image-upload-box {
    cursor: pointer;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px dashed #6c757d;
    border-radius: 8px;
    background: white;
    margin: 10px 0;
    transition: all 0.3s ease;
}

.image-upload-box:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.image-upload-box img {
    max-width: 100%;
    max-height: 100px;
    border-radius: 4px;
}

.image-upload-box svg {
    width: 48px;
    height: 48px;
    fill: #6c757d;
}

.color-input-group {
    margin-bottom: 15px;
}

.color-input-group .input-group {
    margin-bottom: 8px;
}

.color-preview {
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.color-preview:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.form-control-color {
    width: 60px !important;
    height: 38px;
    border: none;
    border-radius: 4px 0 0 4px;
}

.color-text-input {
    font-family: 'Courier New', monospace;
    font-weight: bold;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Color picker synchronization
    const colorInputs = document.querySelectorAll('input[type="color"]');
    colorInputs.forEach(function(colorInput) {
        const textInput = colorInput.nextElementSibling;
        const colorPreview = colorInput.closest('.color-input-group').querySelector('.color-preview');
        
        colorInput.addEventListener('change', function() {
            textInput.value = this.value;
            if (colorPreview) {
                colorPreview.style.backgroundColor = this.value;
            }
        });
        
        textInput.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                colorInput.value = this.value;
                if (colorPreview) {
                    colorPreview.style.backgroundColor = this.value;
                }
            }
        });
    });

    // URL validation
    const urlInputs = document.querySelectorAll('input[type="url"]');
    urlInputs.forEach(function(input) {
        input.addEventListener('blur', function() {
            if (this.value && !this.value.match(/^https?:\/\//)) {
                this.value = 'https://' + this.value;
            }
        });
    });

    // File validation for image uploads
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size
                const maxSize = this.name === 'site_logo' ? 2 * 1024 * 1024 : 1 * 1024 * 1024; // 2MB for logo, 1MB for favicon
                if (file.size > maxSize) {
                    alert('File size too large! Maximum size is ' + (maxSize / (1024 * 1024)) + 'MB');
                    this.value = '';
                    return;
                }

                // Check file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file!');
                    this.value = '';
                    return;
                }
            }
        });
    });
});

// Preview image function (same as store form)
function previewImage(event, previewId, placeholderId) {
    const file = event.target.files && event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(){
        const img = document.getElementById(previewId);
        const ph  = document.getElementById(placeholderId);
        if (img) { img.src = reader.result; img.style.display = 'block'; }
        if (ph)  { ph.style.display = 'none'; }
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
