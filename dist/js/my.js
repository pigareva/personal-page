$(function () {
    var lang = $('html').attr('lang');
    var url = window.location.href;
    $('#language, #language-sm').attr('href', ' ');
    $('#language, #language-sm').attr('href', function () {
        if (lang == 'de') {
            if (url.indexOf('index') > 0) {
                return '/en/index.html';
            } else if (url.indexOf('leben') > 0) {
                return '/en/experience.html';
            } else if (url.indexOf('publik') > 0) {
                return '/en/publication.html'
            } else if (url.indexOf('kontakt') > 0) {
                return '/en/contact.html'
            } else {
                return '/en/index.html'
            }
        } else {
            if (url.indexOf('index') > 0) {
                return '/index.html';
            } else if (url.indexOf('exper') > 0) {
                return '/lebenslauf.html';
            } else if (url.indexOf('public') > 0) {
                return '/publikation.html';
            } else if (url.indexOf('contact') > 0) {
                return '/kontakt.html';
            } else {
                return '/index.html';
            }
        }
    })
});

(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
    a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
ga('create', 'UA-70436265-1', 'auto');
ga('send', 'pageview');