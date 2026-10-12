<?php

use App\Models\User;

test('authenticated admin can view financial reports dashboard', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.index'));

    $response->assertStatus(200);
    $response->assertSee('Financial Reports &amp; Audit Statement', false);
    $response->assertSee('Total Inflow (Donations)');
    $response->assertSee('Direct Expenditures');
    $response->assertSee('Project-Wise Financial Balance Sheet');
});

test('authenticated admin can view printable financial audit statement', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.statement'));

    $response->assertStatus(200);
    $response->assertSee('FINANCIAL AUDIT STATEMENT', false);
    $response->assertSee('ROTARY CLUB OF SHANTINAGAR DHAKA');
    $response->assertSee('Project &amp; Relief Causes Financial Balance Sheet', false);
});

test('authenticated admin can export financial ledger to csv', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.export'));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
});

test('admin can filter reports by rotary year', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.index', ['year' => '2026', 'rotary_year' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('Rotary Year');
    $response->assertSee('RY 2026–2027 (Current)');
});

test('admin dashboard supports filtering by rotary year', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['year' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('RY 2026–2027 (Current)');
});
