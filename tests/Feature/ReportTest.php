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
    $response->assertSee('SHANTI NAGAR FOUNDATION');
    $response->assertSee('Project &amp; Relief Causes Financial Balance Sheet', false);
});

test('authenticated admin can export financial ledger to csv', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.export'));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
});
