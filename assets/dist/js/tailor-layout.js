/*
 * IGL Tailor - layout behaviour (replaces AdminLTE's PushMenu + Treeview).
 * Plain JS on purpose: many pages load a second copy of jQuery after the layout.
 */
(function () {
    'use strict';

    var root = document.documentElement;
    var STORE_KEY = 'tl-sidebar-collapsed';
    var desktop = window.matchMedia('(min-width: 992px)');

    function remember(collapsed) {
        try { localStorage.setItem(STORE_KEY, collapsed ? '1' : '0'); } catch (e) { /* storage blocked */ }
    }

    // Toggle button: mini sidebar on desktop, drawer on phones/tablets
    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('[data-tl-sidebar-toggle]');
        if (toggle) {
            e.preventDefault();
            if (desktop.matches) {
                remember(root.classList.toggle('tl-collapsed'));
            } else {
                root.classList.toggle('tl-sidebar-open');
            }
            return;
        }

        if (e.target.closest('[data-tl-sidebar-close]')) {
            root.classList.remove('tl-sidebar-open');
            return;
        }

        // Sub menus: a parent link that only opens its children
        var link = e.target.closest('.tl-menu .nav-item > .nav-link');
        if (!link) {
            return;
        }
        var item = link.parentElement;
        var sub = item.querySelector(':scope > .nav-treeview');
        if (!sub) {
            return;
        }
        var href = link.getAttribute('href');
        if (!href || href === '#') {
            e.preventDefault();
        }
        item.classList.toggle('menu-open');
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            root.classList.remove('tl-sidebar-open');
        }
    });

    // Leaving the phone layout closes the drawer
    var onChange = function () { root.classList.remove('tl-sidebar-open'); };
    if (desktop.addEventListener) {
        desktop.addEventListener('change', onChange);
    } else if (desktop.addListener) {
        desktop.addListener(onChange);
    }

    // Keep the active menu item in view inside a long sidebar
    document.addEventListener('DOMContentLoaded', function () {
        var active = document.querySelector('.tl-menu .nav-treeview .nav-link.active, .tl-menu > .nav-item > .nav-link.active');
        var body = document.querySelector('.tl-sidebar-body');
        if (!active || !body) {
            return;
        }
        var top = active.getBoundingClientRect().top - body.getBoundingClientRect().top;
        if (top > body.clientHeight - 80) {
            body.scrollTop = top - body.clientHeight / 2;
        }
    });
})();
