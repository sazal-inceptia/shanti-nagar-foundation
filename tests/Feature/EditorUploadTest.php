<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

uses(RefreshDatabase::class);

test('guests cannot upload files via editor upload endpoint', function () {
    $file = UploadedFile::fake()->image('test_diagram.jpg');

    $response = $this->postJson(route('admin.editor.upload'), [
        'upload' => $file,
    ]);

    $response->assertStatus(401);
});

test('authenticated admin can upload images and media through rich editor endpoint', function () {
    $admin = User::factory()->create();
    $file = UploadedFile::fake()->image('field_distribution_photo.jpg', 800, 600);

    $response = $this->actingAs($admin)->postJson(route('admin.editor.upload'), [
        'upload' => $file,
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'url',
        'fileName',
        'uploaded',
    ]);
    expect($response->json('uploaded'))->toBe(1);

    // Clean up created fake file
    $uploadedFile = public_path('uploads/editor/'.$response->json('fileName'));
    if (File::exists($uploadedFile)) {
        @unlink($uploadedFile);
    }
});

test('editor upload validates file mime types', function () {
    $admin = User::factory()->create();
    $file = UploadedFile::fake()->create('malicious.exe', 100);

    $response = $this->actingAs($admin)->postJson(route('admin.editor.upload'), [
        'upload' => $file,
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['upload']);
});
