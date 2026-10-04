<div class="card mb-4" style="border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
    <div class="card-body p-2" style="background-color: #ffffff; border-radius: 10px;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            {{-- Tabs --}}
            <ul class="nav nav-pills" style="gap: 6px;">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.albums.index', 'admin.albums.show', 'admin.albums.edit') ? 'active' : '' }}"
                        href="{{ route('admin.albums.index') }}"
                        style="font-weight: 600; font-size: 13px; padding: 7px 16px; border-radius: 6px; display: inline-flex; align-items: center;">
                        <i class="ri-folder-image-line me-2" style="font-size: 15px;"></i> Photo Albums
                        <span
                            class="badge ms-2 {{ request()->routeIs('admin.albums.index', 'admin.albums.show', 'admin.albums.edit') ? 'bg-white text-primary' : 'bg-light text-dark' }}"
                            style="font-size: 11px;">
                            {{ \App\Models\Album::count() }}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.gallery-images.index', 'admin.gallery-images.edit') ? 'active' : '' }}"
                        href="{{ route('admin.gallery-images.index') }}"
                        style="font-weight: 600; font-size: 13px; padding: 7px 16px; border-radius: 6px; display: inline-flex; align-items: center;">
                        <i class="ri-image-2-line me-2" style="font-size: 15px;"></i> All Gallery Photos
                        <span
                            class="badge ms-2 {{ request()->routeIs('admin.gallery-images.index', 'admin.gallery-images.edit') ? 'bg-white text-primary' : 'bg-light text-dark' }}"
                            style="font-size: 11px;">
                            {{ \App\Models\GalleryImage::count() }}
                        </span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>