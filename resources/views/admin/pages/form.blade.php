@csrf

<!-- Status Toggle -->
<div class="form-section">
  <div class="row mb-3 ms-2">
    <div class="col-md-4 toggle-switch">
      <div class="d-flex">
        <label>Disable</label>
        <div class="form-check form-switch mx-2">
          <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" name="status" value="1"
            {{ old('status', $page->status ?? 1) ? 'checked' : '' }}>
        </div>
        <label>Enable</label>
      </div>
    </div>
  </div>
</div>

<!-- Page Title + SEO URL -->
<div class="form-section">
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="form-floating form-floating-outline">
        <input type="text" name="page_title" class="form-control" placeholder="Page Title"
          value="{{ old('page_title', $page->page_title ?? '') }}" required>
        <label>Page Title *</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating form-floating-outline">
        <input type="text" name="seo_url" class="form-control" placeholder="SEO URL"
          value="{{ old('seo_url', $page->seo_url ?? '') }}" required>
        <label>SEO URL *</label>
      </div>
    </div>
  </div>
</div>

<!-- Meta Title + Meta Keywords -->
<div class="form-section">
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="form-floating form-floating-outline">
        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title"
          value="{{ old('meta_title', $page->meta_title ?? '') }}">
        <label>Meta Title</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating form-floating-outline">
        <input type="text" name="meta_keywords" class="form-control" placeholder="Meta Keywords"
          value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}">
        <label>Meta Keywords</label>
      </div>
    </div>
  </div>
</div>

<!-- Meta Description -->
<div class="form-section">
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="form-floating form-floating-outline mb-6">
        <textarea class="form-control h-px-100" placeholder="Meta Description" name="meta_description">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        <label>Meta Description</label>
      </div>
    </div>
  </div>
</div>

<!-- Page Content -->
<div class="form-section">
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="form-floating form-floating-outline mb-6">
        <textarea class="form-control h-px-100" placeholder="Page Content" name="page_content">{{ old('page_content', $page->page_content ?? '') }}</textarea>
        <label>Page Content</label>
      </div>
    </div>
  </div>
</div>

<!-- Media Upload -->
<div class="form-section">
  <div class="row">
    <div class="col-md-3">
      <label>Page Image</label>
      <div class="image-upload-box" onclick="document.getElementById('media').click()">
        <img id="media_preview"
          src="{{ isset($page) && $page->media ? asset('storage/'.$page->media) : '' }}"
          style="{{ isset($page) && $page->media ? '' : 'display:none;' }}">
        <svg id="media_placeholder" style="{{ isset($page) && $page->media ? 'display:none;' : '' }}"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M20,5A2,2 0 0,1 22,7V17A2,2 0 0,1 20,19H4C2.89,19 2,18.1 2,17V7C2,5.89 2.89,5 4,5H20M5,16H19L14.5,10 L11,14.5L8.5,11.5L5,16Z" />
        </svg>
      </div>
      <input type="file" id="media" name="media" style="display:none;" accept="image/*"
        onchange="previewImage(event, 'media_preview', 'media_placeholder')">
    </div>
    <div class="col-md-3">
      <label>Banner Image</label>
      <div class="image-upload-box" onclick="document.getElementById('banner_image').click()">
        <img id="banner_preview"
          src="{{ isset($page) && $page->banner_image ? asset('storage/'.$page->banner_image) : '' }}"
          style="{{ isset($page) && $page->banner_image ? '' : 'display:none;' }}">
        <svg id="banner_placeholder" style="{{ isset($page) && $page->banner_image ? 'display:none;' : '' }}"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M20,5A2,2 0 0,1 22,7V17A2,2 0 0,1 20,19H4C2.89,19 2,18.1 2,17V7C2,5.89 2.89,5 4,5H20M5,16H19L14.5,10 L11,14.5L8.5,11.5L5,16Z" />
        </svg>
      </div>
      <input type="file" id="banner_image" name="banner_image" style="display:none;" accept="image/*"
        onchange="previewImage(event, 'banner_preview', 'banner_placeholder')">
    </div>
  </div>
</div>

<!-- Hidden Sort Order -->
<input type="hidden" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}">

<!-- Save Button -->
<div class="text-end mb-4">
  <button class="btn btn-primary">💾 Save</button>
</div>

<script>
function previewImage(event, previewId, placeholderId) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById(previewId).src = reader.result;
        document.getElementById(previewId).style.display = 'block';
        document.getElementById(placeholderId).style.display = 'none';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
