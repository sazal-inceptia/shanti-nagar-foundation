<?php

use App\Models\Album;
use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('public gallery page renders album cards and standalone photos successfully', function () {
    $album = Album::create([
        'title' => 'Winter Relief Campaign',
        'title_bn' => 'শীতবস্ত্র বিতরণ কর্মসূচি',
        'slug' => 'winter-relief-campaign',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    GalleryImage::create([
        'album_id' => $album->id,
        'title' => 'Blanket Handover',
        'image_path' => 'assets/images/gallery/portfolio-7.jpg',
        'is_active' => true,
    ]);

    GalleryImage::create([
        'album_id' => null,
        'title' => 'Standalone Field Photo',
        'image_path' => 'assets/images/resource/news-1.jpg',
        'is_active' => true,
    ]);

    $response = $this->get(route('gallery'));

    $response->assertStatus(200);
    $response->assertSee('Winter Relief Campaign');
    $response->assertSee('Standalone Field Photo');
});

test('public album details page renders photos for specific album', function () {
    $album = Album::create([
        'title' => 'Medical Camp 2026',
        'slug' => 'medical-camp-2026',
        'description' => 'Free medical consultation in Dhaka.',
        'is_active' => true,
    ]);

    $photo = GalleryImage::create([
        'album_id' => $album->id,
        'title' => 'Doctor Checking Patient',
        'image_path' => 'assets/images/resource/cause-1.jpg',
        'is_active' => true,
    ]);

    $response = $this->get(route('gallery.album', 'medical-camp-2026'));

    $response->assertStatus(200);
    $response->assertSee('Medical Camp 2026');
    $response->assertSee('Doctor Checking Patient');
});

test('public album details returns 404 for nonexistent or inactive album', function () {
    $response = $this->get(route('gallery.album', 'non-existent-album-slug'));
    $response->assertStatus(404);

    $inactiveAlbum = Album::create([
        'title' => 'Draft Album',
        'slug' => 'draft-album',
        'is_active' => false,
    ]);

    $responseInactive = $this->get(route('gallery.album', 'draft-album'));
    $responseInactive->assertStatus(404);
});

test('gallery page respects Bengali localization', function () {
    session(['locale' => 'bn']);

    $album = Album::create([
        'title' => 'English Title',
        'title_bn' => 'বাংলা অ্যালবাম শিরোনাম',
        'slug' => 'bangla-album',
        'is_active' => true,
    ]);

    $response = $this->get(route('gallery'));

    $response->assertStatus(200);
    $response->assertSee('বাংলা অ্যালবাম শিরোনাম');
});

test('admin can manage albums through CRUD operations', function () {
    $admin = User::factory()->create();
    Storage::fake('public');

    // Create Album
    $response = $this->actingAs($admin)->post(route('admin.albums.store'), [
        'title' => 'New Tree Plantation Album',
        'title_bn' => 'নতুন বৃক্ষরোপণ অ্যালবাম',
        'description' => 'Planting trees across community.',
        'event_date' => '2026-10-01',
        'is_active' => '1',
    ]);

    $response->assertRedirect();
    $album = Album::where('slug', 'new-tree-plantation-album')->first();
    expect($album)->not->toBeNull();
    expect($album->title_bn)->toBe('নতুন বৃক্ষরোপণ অ্যালবাম');

    // Toggle status
    $toggleResponse = $this->actingAs($admin)->post(route('admin.albums.toggle-status', $album->id));
    $toggleResponse->assertStatus(200);
    expect($album->fresh()->is_active)->toBeFalse();

    // Update Album
    $updateResponse = $this->actingAs($admin)->put(route('admin.albums.update', $album->id), [
        'title' => 'Updated Tree Plantation Album',
        'is_active' => '1',
    ]);
    $updateResponse->assertRedirect(route('admin.albums.index'));
    expect($album->fresh()->title)->toBe('Updated Tree Plantation Album');

    // Delete Album
    $deleteResponse = $this->actingAs($admin)->delete(route('admin.albums.destroy', $album->id));
    $deleteResponse->assertRedirect(route('admin.albums.index'));
    expect(Album::find($album->id))->toBeNull();
});

test('admin can upload single and bulk gallery photos', function () {
    $admin = User::factory()->create();
    Storage::fake('public');

    $album = Album::create([
        'title' => 'Blood Donation Drive',
        'slug' => 'blood-donation-drive',
        'is_active' => true,
    ]);

    $file1 = UploadedFile::fake()->image('photo1.jpg');
    $file2 = UploadedFile::fake()->image('photo2.jpg');

    $response = $this->actingAs($admin)->post(route('admin.gallery-images.store'), [
        'album_id' => $album->id,
        'title' => 'Donor Photo',
        'images' => [$file1, $file2],
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.albums.show', $album->id));
    $uploadedPhoto = $album->images()->first();

    // Edit Photo View & Update
    $editPhotoResponse = $this->actingAs($admin)->get(route('admin.gallery-images.edit', $uploadedPhoto->id));
    $editPhotoResponse->assertStatus(200);
    $editPhotoResponse->assertSee('Donor Photo');

    $updatePhotoResponse = $this->actingAs($admin)->put(route('admin.gallery-images.update', $uploadedPhoto->id), [
        'title' => 'Updated Donor Photo Title',
        'title_bn' => 'হালনাগাদ রক্তদাতা ছবি',
        'is_active' => '1',
    ]);
    $updatePhotoResponse->assertRedirect(route('admin.gallery-images.index'));
    expect($uploadedPhoto->fresh()->title)->toBe('Updated Donor Photo Title');

    // Delete photo
    $deleteResponse = $this->actingAs($admin)->delete(route('admin.gallery-images.destroy', $uploadedPhoto->id));
    $deleteResponse->assertRedirect();
    expect(GalleryImage::find($uploadedPhoto->id))->toBeNull();
});

test('admin can open edit album view without 404', function () {
    $admin = User::factory()->create();

    $album = Album::create([
        'title' => 'Sample Album for Edit',
        'slug' => 'sample-album-for-edit',
        'is_active' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.albums.edit', $album->id));
    $response->assertStatus(200);
    $response->assertSee('Sample Album for Edit');
});
