<?php

test('view all projects', function () {
    $this->get('/project')
        ->assertStatus(200);
});
