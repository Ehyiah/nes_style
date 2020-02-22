const $ = require('jquery');

$(document).ready(function () {
    let $body = $('body');
    let $mainArea = $('#main-area');

    let $aboutSelect = $('#about-select');
    let $aboutArea = $('#about-area');
    let $closeButtonAbout = $('#close-about');

    let $skillSelect = $('#skill-select');
    let $skillArea = $('#skill-area');
    let $closeButtonSkill = $('#close-skill');

    let $contactSelect = $('#contact-select');
    let $contactArea = $('#contact-area');
    let $closeButtoncontact = $('#close-contact');

    $closeButtonAbout.on('click', function (e) {
        $aboutArea.fadeOut(500);
        $mainArea.delay(500).fadeIn(800);
    });

    $aboutSelect.on('click', function() {
        $mainArea.fadeOut(800);
        $aboutArea.delay(800).fadeIn(500);
    });

    $closeButtonSkill.on('click', function (e) {
        $skillArea.fadeOut(500);
        $mainArea.delay(500).fadeIn(800);
    });

    $skillSelect.on('click', function() {
        $mainArea.fadeOut(800);
        $skillArea.delay(800).fadeIn(500);
    });

    $closeButtoncontact.on('click', function (e) {
        $contactArea.fadeOut(500);
        $mainArea.delay(500).fadeIn(800);
    });

    $contactSelect.on('click', function() {
        $mainArea.fadeOut(800);
        $contactArea.delay(800).fadeIn(500);
    })
});
