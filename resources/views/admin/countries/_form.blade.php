<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Country name *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $country->name ?? '') }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">ISO2 code</label>
    <input type="text" name="iso2" maxlength="5" class="form-control" value="{{ old('iso2', $country->iso2 ?? '') }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">ISO3 code</label>
    <input type="text" name="iso3" maxlength="5" class="form-control" value="{{ old('iso3', $country->iso3 ?? '') }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">Phone code</label>
    <input type="text" name="phone_code" class="form-control" value="{{ old('phone_code', $country->phone_code ?? '') }}" placeholder="+880">
  </div>
  <div class="col-md-4">
    <label class="form-label">Currency</label>
    <input type="text" name="currency" class="form-control" value="{{ old('currency', $country->currency ?? '') }}" placeholder="USD">
  </div>
  <div class="col-md-4">
    <label class="form-label">Sort order</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $country->sort_order ?? 0) }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Flag image</label>
    <input type="file" name="flag" class="form-control" accept="image/*">
    @if (!empty($country->flag))
      <img src="{{ asset('storage/'.$country->flag) }}" class="mt-2 rounded border" width="60">
    @endif
  </div>
  <div class="col-md-6">
    <label class="form-label">Hero image</label>
    <input type="file" name="hero_image" class="form-control" accept="image/*">
    @if (!empty($country->hero_image))
      <img src="{{ asset('storage/'.$country->hero_image) }}" class="mt-2 rounded border" width="120">
    @endif
  </div>

  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $country->description ?? '') }}</textarea>
  </div>

  <div class="col-md-6">
    <label class="form-label">SEO title</label>
    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $country->seo_title ?? '') }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">SEO description</label>
    <input type="text" name="seo_description" class="form-control" value="{{ old('seo_description', $country->seo_description ?? '') }}">
  </div>

  <div class="col-12 form-check ps-4">
    <input type="checkbox" name="status" id="status" class="form-check-input"
      {{ old('status', $country->status ?? true) ? 'checked' : '' }}>
    <label for="status" class="form-check-label">Active (visible on site)</label>
  </div>
</div>
