<?php

test('home page returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('about page returns a successful response and renders leadership', function () {
    $response = $this->get(route('about'));
    $response->assertStatus(200);
    $response->assertSee('Board of Directors');
});

test('projects page returns a successful response with year filter', function () {
    $response = $this->get(route('projects', ['year' => '2026']));
    $response->assertStatus(200);
    $response->assertSee('Rotary Year');
});

test('activities page returns a successful response', function () {
    $response = $this->get(route('activities'));
    $response->assertStatus(200);
});

test('gallery page returns a successful response', function () {
    $response = $this->get(route('gallery'));
    $response->assertStatus(200);
});

test('contact, donate, volunteer and faq pages return successful responses', function () {
    $this->get(route('contact'))->assertStatus(200);
    $this->get(route('donate'))->assertStatus(200);
    $this->get(route('volunteer'))->assertStatus(200);
    $this->get(route('faq'))->assertStatus(200);
});
