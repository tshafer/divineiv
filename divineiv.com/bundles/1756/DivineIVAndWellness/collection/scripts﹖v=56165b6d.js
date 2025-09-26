/******************************************************************************
W:\websites\_dl_components\components\header\_shared\header.js
******************************************************************************/
;(function () {
    console.debug('initializing dynamic-css-var --header-height');

    // track the max header height we've seen (used in the scroll listener)
    let maxHeaderHeight = 0;

    /**
     * Sets the --header-height property based on the (header) offsetHeight.
     */
    function setHeaderHeight(height) {
        maxHeaderHeight = Math.max(maxHeaderHeight, height);
        const root = document.querySelector(':root');
        root.style.setProperty('--header-height', height + 'px');
    }

    /**
     * Initializes the ResizeObserver to change the --header-height property.
     * @param {HTMLElement} header 
     */
    function initHeaderHeightObserver(header) {
        try {
            // set the initial height because the observer doesn't always fire immediately
            setHeaderHeight(header?.offsetHeight || 0);

            const headerObserver = new ResizeObserver(entries => {
                // we only use the first entry
                const headerEntry = entries && entries[0];

                if (headerEntry) {
                    setHeaderHeight(headerEntry.target.offsetHeight);
                }
            });

            headerObserver.observe(header, { box: 'border-box' });
        } catch (ex) {
            console.debug('Could not set --header-height observer.', ex);
        }
    }

    function init() {
        const header = document.querySelector('header');

        // only run the rest if we have a header
        if (header) {
            initHeaderHeightObserver(header);

            // add or remove the header--scroll class based on scroll position
            window.addEventListener('scroll', () => {
                const scrollPosition = window.scrollY;

                // use 75% of the max header height, 30 minimum
                const threshold = Math.max(maxHeaderHeight * 0.75, 30);

                if (scrollPosition >= threshold) {
                    header.classList.add('header--scroll');
                } else {
                    const currentHeaderHeight = header.offsetHeight;

                    // make sure that going back to the larger header isn't going to cause oscillation
                    if (maxHeaderHeight - currentHeaderHeight + scrollPosition < threshold) {
                        header.classList.remove('header--scroll');
                    }
                }
            }, { passive: true });
        }
    }

    // no dependencies, call immediately
    init();
})();
/******************************************************************************
W:\websites\_dl_components\assets\js\util\namespace.js
******************************************************************************/
;// namespace.js
(() => {
    const namespace = (name, root) => {
        const parts = name.split(".");
        let ns = root || globalThis;

        for (const p of parts) {
            ns = ns[p] = ns[p] || {};
        }

        return ns;
    };

    const namespaces = (/** @type {string[]} */ ...names) =>
        names.map(name => namespace(name));

    // add the namespace function in the dl.util namespace
    const ns = namespace("dl.util");
    ns.namespace = namespace;
    ns.namespaces = namespaces;
})();

/******************************************************************************
W:\websites\_dl_components\assets\js\util\events.js
******************************************************************************/
;/// <reference path="./types.d.ts" />
((/** @type {DL_Util_Events_Namespace} */ events) => {
    events.domContentLoaded = (cb) => {
        if (document.readyState === 'loading') {
            window.addEventListener('DOMContentLoaded', cb);
        } else {
            cb();
        }
    };
    events.hashChange = (cb) => {
      if (document.readyState === "loading") {
        window.addEventListener("hashchange", cb);
      } else {
        cb();
      }
    };
})(window.dl.util.namespace('dl.util.events'));
/******************************************************************************
W:\websites\_dl_components\components\header-notification\header-notification\header-notification.js
******************************************************************************/
;/// <reference path="../../../assets/js/util/types.d.ts" />
((/** @type {DL_Util_Events_Namespace} */ events) => {
  let dlHeaderNotificationStorageName =
    "__DL-dl-headerNotification-lastAccessedData";

  let closeButtonElement = document.querySelector(
    `.header__notification-close`
  );

  let headerNotifacationElem = document.querySelector(`.header__notification`);

  function init() {
    if (closeButtonElement) {
      closeButtonElement.addEventListener("click", function (event) {
        event.preventDefault();
        headerNotifacationElem.classList.toggle("header__notification--hidden");
        localStorage.setItem(dlHeaderNotificationStorageName, new Date());
      });
    }
  }
  function hideHeaderNotification() {
    let __debugging = !!location.hash.match(/__testHeaderNotification/);

    let lastDateAccessed = new Date(
      localStorage.getItem(dlHeaderNotificationStorageName)
    );

    let yesterday = new Date().getTime() - 1 * 24 * 60 * 60 * 1000;
    let wasViewInLast24Hours = lastDateAccessed > yesterday;

    if (wasViewInLast24Hours) {
      headerNotifacationElem.classList.add("header__notification--hidden");
    }
    if (__debugging) {
      headerNotifacationElem.classList.remove("header__notification--hidden");
    }
  }

  events.domContentLoaded(function () {
    init();
    hideHeaderNotification();
  });

  events.hashChange(function () {
    hideHeaderNotification();
  });
})(dl.util.namespace("dl.util.events"));

/******************************************************************************
W:\websites\_dl_components\assets\js\slide-menu.js
******************************************************************************/
;!function (t) { var e = {}; function n(r) { if (e[r]) return e[r].exports; var i = e[r] = { i: r, l: !1, exports: {} }; return t[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports } n.m = t, n.c = e, n.d = function (t, e, r) { n.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: r }) }, n.r = function (t) { "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 }) }, n.t = function (t, e) { if (1 & e && (t = n(t)), 8 & e) return t; if (4 & e && "object" == typeof t && t && t.__esModule) return t; var r = Object.create(null); if (n.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t) for (var i in t) n.d(r, i, function (e) { return t[e] }.bind(null, i)); return r }, n.n = function (t) { var e = t && t.__esModule ? function () { return t.default } : function () { return t }; return n.d(e, "a", e), e }, n.o = function (t, e) { return Object.prototype.hasOwnProperty.call(t, e) }, n.p = "", n(n.s = 59) }([function (t, e, n) { (function (e) { var n = function (t) { return t && t.Math == Math && t }; t.exports = n("object" == typeof globalThis && globalThis) || n("object" == typeof window && window) || n("object" == typeof self && self) || n("object" == typeof e && e) || Function("return this")() }).call(this, n(32)) }, function (t, e) { t.exports = function (t) { try { return !!t() } catch (t) { return !0 } } }, function (t, e) { var n = {}.hasOwnProperty; t.exports = function (t, e) { return n.call(t, e) } }, function (t, e, n) { var r = n(1); t.exports = !r((function () { return 7 != Object.defineProperty({}, "a", { get: function () { return 7 } }).a })) }, function (t, e) { t.exports = function (t) { return "object" == typeof t ? null !== t : "function" == typeof t } }, function (t, e, n) { var r = n(3), i = n(18), o = n(13); t.exports = r ? function (t, e, n) { return i.f(t, e, o(1, n)) } : function (t, e, n) { return t[e] = n, t } }, function (t, e, n) { var r = n(4); t.exports = function (t) { if (!r(t)) throw TypeError(String(t) + " is not an object"); return t } }, function (t, e, n) { var r = n(14), i = n(8); t.exports = function (t) { return r(i(t)) } }, function (t, e) { t.exports = function (t) { if (null == t) throw TypeError("Can't call method on " + t); return t } }, function (t, e, n) { var r = n(0), i = n(5); t.exports = function (t, e) { try { i(r, t, e) } catch (n) { r[t] = e } return e } }, function (t, e, n) { var r = n(0), i = n(11).f, o = n(5), c = n(19), s = n(9), a = n(38), u = n(46); t.exports = function (t, e) { var n, l, f, p, h, m = t.target, d = t.global, v = t.stat; if (n = d ? r : v ? r[m] || s(m, {}) : (r[m] || {}).prototype) for (l in e) { if (p = e[l], f = t.noTargetGet ? (h = i(n, l)) && h.value : n[l], !u(d ? l : m + (v ? "." : "#") + l, t.forced) && void 0 !== f) { if (typeof p == typeof f) continue; a(p, f) } (t.sham || f && f.sham) && o(p, "sham", !0), c(n, l, p, t) } } }, function (t, e, n) { var r = n(3), i = n(12), o = n(13), c = n(7), s = n(16), a = n(2), u = n(17), l = Object.getOwnPropertyDescriptor; e.f = r ? l : function (t, e) { if (t = c(t), e = s(e, !0), u) try { return l(t, e) } catch (t) { } if (a(t, e)) return o(!i.f.call(t, e), t[e]) } }, function (t, e, n) { "use strict"; var r = {}.propertyIsEnumerable, i = Object.getOwnPropertyDescriptor, o = i && !r.call({ 1: 2 }, 1); e.f = o ? function (t) { var e = i(this, t); return !!e && e.enumerable } : r }, function (t, e) { t.exports = function (t, e) { return { enumerable: !(1 & t), configurable: !(2 & t), writable: !(4 & t), value: e } } }, function (t, e, n) { var r = n(1), i = n(15), o = "".split; t.exports = r((function () { return !Object("z").propertyIsEnumerable(0) })) ? function (t) { return "String" == i(t) ? o.call(t, "") : Object(t) } : Object }, function (t, e) { var n = {}.toString; t.exports = function (t) { return n.call(t).slice(8, -1) } }, function (t, e, n) { var r = n(4); t.exports = function (t, e) { if (!r(t)) return t; var n, i; if (e && "function" == typeof (n = t.toString) && !r(i = n.call(t))) return i; if ("function" == typeof (n = t.valueOf) && !r(i = n.call(t))) return i; if (!e && "function" == typeof (n = t.toString) && !r(i = n.call(t))) return i; throw TypeError("Can't convert object to primitive value") } }, function (t, e, n) { var r = n(3), i = n(1), o = n(33); t.exports = !r && !i((function () { return 7 != Object.defineProperty(o("div"), "a", { get: function () { return 7 } }).a })) }, function (t, e, n) { var r = n(3), i = n(17), o = n(6), c = n(16), s = Object.defineProperty; e.f = r ? s : function (t, e, n) { if (o(t), e = c(e, !0), o(n), i) try { return s(t, e, n) } catch (t) { } if ("get" in n || "set" in n) throw TypeError("Accessors not supported"); return "value" in n && (t[e] = n.value), t } }, function (t, e, n) { var r = n(0), i = n(5), o = n(2), c = n(9), s = n(20), a = n(34), u = a.get, l = a.enforce, f = String(String).split("String"); (t.exports = function (t, e, n, s) { var a = !!s && !!s.unsafe, u = !!s && !!s.enumerable, p = !!s && !!s.noTargetGet; "function" == typeof n && ("string" != typeof e || o(n, "name") || i(n, "name", e), l(n).source = f.join("string" == typeof e ? e : "")), t !== r ? (a ? !p && t[e] && (u = !0) : delete t[e], u ? t[e] = n : i(t, e, n)) : u ? t[e] = n : c(e, n) })(Function.prototype, "toString", (function () { return "function" == typeof this && u(this).source || s(this) })) }, function (t, e, n) { var r = n(21), i = Function.toString; "function" != typeof r.inspectSource && (r.inspectSource = function (t) { return i.call(t) }), t.exports = r.inspectSource }, function (t, e, n) { var r = n(0), i = n(9), o = r["__core-js_shared__"] || i("__core-js_shared__", {}); t.exports = o }, function (t, e, n) { var r = n(37), i = n(21); (t.exports = function (t, e) { return i[t] || (i[t] = void 0 !== e ? e : {}) })("versions", []).push({ version: "3.6.1", mode: r ? "pure" : "global", copyright: "© 2019 Denis Pushkarev (zloirock.ru)" }) }, function (t, e) { var n = 0, r = Math.random(); t.exports = function (t) { return "Symbol(" + String(void 0 === t ? "" : t) + ")_" + (++n + r).toString(36) } }, function (t, e) { t.exports = {} }, function (t, e, n) { var r = n(2), i = n(7), o = n(43).indexOf, c = n(24); t.exports = function (t, e) { var n, s = i(t), a = 0, u = []; for (n in s) !r(c, n) && r(s, n) && u.push(n); for (; e.length > a;)r(s, n = e[a++]) && (~o(u, n) || u.push(n)); return u } }, function (t, e) { var n = Math.ceil, r = Math.floor; t.exports = function (t) { return isNaN(t = +t) ? 0 : (t > 0 ? r : n)(t) } }, function (t, e) { t.exports = ["constructor", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "valueOf"] }, function (t, e) { e.f = Object.getOwnPropertySymbols }, function (t, e, n) { var r = n(0), i = n(22), o = n(2), c = n(23), s = n(30), a = n(55), u = i("wks"), l = r.Symbol, f = a ? l : l && l.withoutSetter || c; t.exports = function (t) { return o(u, t) || (s && o(l, t) ? u[t] = l[t] : u[t] = f("Symbol." + t)), u[t] } }, function (t, e, n) { var r = n(1); t.exports = !!Object.getOwnPropertySymbols && !r((function () { return !String(Symbol()) })) }, function (t, e, n) { var r = n(10), i = n(47); r({ target: "Object", stat: !0, forced: Object.assign !== i }, { assign: i }) }, function (t, e) { var n; n = function () { return this }(); try { n = n || new Function("return this")() } catch (t) { "object" == typeof window && (n = window) } t.exports = n }, function (t, e, n) { var r = n(0), i = n(4), o = r.document, c = i(o) && i(o.createElement); t.exports = function (t) { return c ? o.createElement(t) : {} } }, function (t, e, n) { var r, i, o, c = n(35), s = n(0), a = n(4), u = n(5), l = n(2), f = n(36), p = n(24), h = s.WeakMap; if (c) { var m = new h, d = m.get, v = m.has, g = m.set; r = function (t, e) { return g.call(m, t, e), e }, i = function (t) { return d.call(m, t) || {} }, o = function (t) { return v.call(m, t) } } else { var E = f("state"); p[E] = !0, r = function (t, e) { return u(t, E, e), e }, i = function (t) { return l(t, E) ? t[E] : {} }, o = function (t) { return l(t, E) } } t.exports = { set: r, get: i, has: o, enforce: function (t) { return o(t) ? i(t) : r(t, {}) }, getterFor: function (t) { return function (e) { var n; if (!a(e) || (n = i(e)).type !== t) throw TypeError("Incompatible receiver, " + t + " required"); return n } } } }, function (t, e, n) { var r = n(0), i = n(20), o = r.WeakMap; t.exports = "function" == typeof o && /native code/.test(i(o)) }, function (t, e, n) { var r = n(22), i = n(23), o = r("keys"); t.exports = function (t) { return o[t] || (o[t] = i(t)) } }, function (t, e) { t.exports = !1 }, function (t, e, n) { var r = n(2), i = n(39), o = n(11), c = n(18); t.exports = function (t, e) { for (var n = i(e), s = c.f, a = o.f, u = 0; u < n.length; u++) { var l = n[u]; r(t, l) || s(t, l, a(e, l)) } } }, function (t, e, n) { var r = n(40), i = n(42), o = n(28), c = n(6); t.exports = r("Reflect", "ownKeys") || function (t) { var e = i.f(c(t)), n = o.f; return n ? e.concat(n(t)) : e } }, function (t, e, n) { var r = n(41), i = n(0), o = function (t) { return "function" == typeof t ? t : void 0 }; t.exports = function (t, e) { return arguments.length < 2 ? o(r[t]) || o(i[t]) : r[t] && r[t][e] || i[t] && i[t][e] } }, function (t, e, n) { var r = n(0); t.exports = r }, function (t, e, n) { var r = n(25), i = n(27).concat("length", "prototype"); e.f = Object.getOwnPropertyNames || function (t) { return r(t, i) } }, function (t, e, n) { var r = n(7), i = n(44), o = n(45), c = function (t) { return function (e, n, c) { var s, a = r(e), u = i(a.length), l = o(c, u); if (t && n != n) { for (; u > l;)if ((s = a[l++]) != s) return !0 } else for (; u > l; l++)if ((t || l in a) && a[l] === n) return t || l || 0; return !t && -1 } }; t.exports = { includes: c(!0), indexOf: c(!1) } }, function (t, e, n) { var r = n(26), i = Math.min; t.exports = function (t) { return t > 0 ? i(r(t), 9007199254740991) : 0 } }, function (t, e, n) { var r = n(26), i = Math.max, o = Math.min; t.exports = function (t, e) { var n = r(t); return n < 0 ? i(n + e, 0) : o(n, e) } }, function (t, e, n) { var r = n(1), i = /#|\.prototype\./, o = function (t, e) { var n = s[c(t)]; return n == u || n != a && ("function" == typeof e ? r(e) : !!e) }, c = o.normalize = function (t) { return String(t).replace(i, ".").toLowerCase() }, s = o.data = {}, a = o.NATIVE = "N", u = o.POLYFILL = "P"; t.exports = o }, function (t, e, n) { "use strict"; var r = n(3), i = n(1), o = n(48), c = n(28), s = n(12), a = n(49), u = n(14), l = Object.assign, f = Object.defineProperty; t.exports = !l || i((function () { if (r && 1 !== l({ b: 1 }, l(f({}, "a", { enumerable: !0, get: function () { f(this, "b", { value: 3, enumerable: !1 }) } }), { b: 2 })).b) return !0; var t = {}, e = {}, n = Symbol(); return t[n] = 7, "abcdefghijklmnopqrst".split("").forEach((function (t) { e[t] = t })), 7 != l({}, t)[n] || "abcdefghijklmnopqrst" != o(l({}, e)).join("") })) ? function (t, e) { for (var n = a(t), i = arguments.length, l = 1, f = c.f, p = s.f; i > l;)for (var h, m = u(arguments[l++]), d = f ? o(m).concat(f(m)) : o(m), v = d.length, g = 0; v > g;)h = d[g++], r && !p.call(m, h) || (n[h] = m[h]); return n } : l }, function (t, e, n) { var r = n(25), i = n(27); t.exports = Object.keys || function (t) { return r(t, i) } }, function (t, e, n) { var r = n(8); t.exports = function (t) { return Object(r(t)) } }, function (t, e, n) { "use strict"; var r = n(19), i = n(6), o = n(1), c = n(51), s = RegExp.prototype, a = s.toString, u = o((function () { return "/a/b" != a.call({ source: "a", flags: "b" }) })), l = "toString" != a.name; (u || l) && r(RegExp.prototype, "toString", (function () { var t = i(this), e = String(t.source), n = t.flags; return "/" + e + "/" + String(void 0 === n && t instanceof RegExp && !("flags" in s) ? c.call(t) : n) }), { unsafe: !0 }) }, function (t, e, n) { "use strict"; var r = n(6); t.exports = function () { var t = r(this), e = ""; return t.global && (e += "g"), t.ignoreCase && (e += "i"), t.multiline && (e += "m"), t.dotAll && (e += "s"), t.unicode && (e += "u"), t.sticky && (e += "y"), e } }, function (t, e, n) { "use strict"; var r = n(10), i = n(53), o = n(8); r({ target: "String", proto: !0, forced: !n(56)("includes") }, { includes: function (t) { return !!~String(o(this)).indexOf(i(t), arguments.length > 1 ? arguments[1] : void 0) } }) }, function (t, e, n) { var r = n(54); t.exports = function (t) { if (r(t)) throw TypeError("The method doesn't accept regular expressions"); return t } }, function (t, e, n) { var r = n(4), i = n(15), o = n(29)("match"); t.exports = function (t) { var e; return r(t) && (void 0 !== (e = t[o]) ? !!e : "RegExp" == i(t)) } }, function (t, e, n) { var r = n(30); t.exports = r && !Symbol.sham && "symbol" == typeof Symbol.iterator }, function (t, e, n) { var r = n(29)("match"); t.exports = function (t) { var e = /./; try { "/./"[t](e) } catch (n) { try { return e[r] = !1, "/./"[t](e) } catch (t) { } } return !1 } }, function (t, e, n) { }, , function (t, e, n) { "use strict"; n.r(e); var r, i, o; n(31), n(50), n(52), n(57); function c(t, e, n) { const r = []; for (; t && null !== t.parentElement && (void 0 === n || r.length < n);)t instanceof HTMLElement && t.matches(e) && r.push(t), t = t.parentElement; return r } function s(t, e) { const n = c(t, e, 1); return n.length ? n[0] : null } !function (t) { t[t.Backward = -1] = "Backward", t[t.Forward = 1] = "Forward" }(r || (r = {})), function (t) { t.Left = "left", t.Right = "right" }(i || (i = {})), function (t) { t.Back = "back", t.Close = "close", t.Forward = "forward", t.Navigate = "navigate", t.Open = "open" }(o || (o = {})); const a = { backLinkAfter: "", backLinkBefore: "", keyClose: "", keyOpen: "", position: "right", showBackLink: !0, submenuLinkAfter: "", submenuLinkBefore: "" }; class u { constructor(t, e) { if (this.level = 0, this.isOpen = !1, this.isAnimating = !1, this.lastAction = null, null === t) throw new Error("Argument `elem` must be a valid HTML node"); this.options = Object.assign({}, a, e), this.menuElem = t, this.wrapperElem = document.createElement("div"), this.wrapperElem.classList.add(u.CLASS_NAMES.wrapper); const n = this.menuElem.querySelector("ul"); n && function (t, e) { if (null === t.parentElement) throw Error("`elem` has no parentElement"); t.parentElement.insertBefore(e, t), e.appendChild(t) }(n, this.wrapperElem), this.initMenu(), this.initSubmenus(), this.initEventHandlers(), this.menuElem._slideMenu = this } toggle(t, e = !0) { let n; if (void 0 === t) return this.isOpen ? this.close(e) : this.open(e); if (n = t ? 0 : this.options.position === i.Left ? "-100%" : "100%", this.isOpen = t, e) this.moveSlider(this.menuElem, n); else { const t = this.moveSlider.bind(this, this.menuElem, n); this.runWithoutAnimation(t) } } open(t = !0) { this.triggerEvent(o.Open), this.toggle(!0, t) } close(t = !0) { this.triggerEvent(o.Close), this.toggle(!1, t) } back() { this.navigate(r.Backward) } destroy() { const { submenuLinkAfter: t, submenuLinkBefore: e, showBackLink: n } = this.options; if (t || e) { Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.decorator))).forEach(t => { t.parentElement && t.parentElement.removeChild(t) }) } if (n) { Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.control))).forEach(t => { const e = s(t, "li"); e && e.parentElement && e.parentElement.removeChild(e) }) } !function (t) { const e = t.parentElement; if (null === e) throw Error("`elem` has no parentElement"); for (; t.firstChild;)e.insertBefore(t.firstChild, t); e.removeChild(t) }(this.wrapperElem), this.menuElem.style.cssText = "", this.menuElem.querySelectorAll("ul").forEach(t => t.style.cssText = ""), delete this.menuElem._slideMenu } navigateTo(t) { if (this.triggerEvent(o.Navigate), "string" == typeof t) { const e = document.querySelector(t); if (!(e instanceof HTMLElement)) throw new Error("Invalid parameter `target`. A valid query selector is required."); t = e } Array.from(this.wrapperElem.querySelectorAll(".".concat(u.CLASS_NAMES.active))).forEach(t => { t.style.display = "none", t.classList.remove(u.CLASS_NAMES.active) }); const e = c(t, "ul"), n = e.length - 1; n >= 0 && n !== this.level && (this.level = n, this.moveSlider(this.wrapperElem, 100 * -this.level)), e.forEach(t => { t.style.display = "block", t.classList.add(u.CLASS_NAMES.active) }) } initEventHandlers() { Array.from(this.menuElem.querySelectorAll("a")).forEach(t => t.addEventListener("click", t => { const e = t.target, n = e.matches("a") ? e : s(e, "a"); n && this.navigate(r.Forward, n) })), this.menuElem.addEventListener("transitionend", this.onTransitionEnd.bind(this)), this.wrapperElem.addEventListener("transitionend", this.onTransitionEnd.bind(this)), this.initKeybindings(), this.initSubmenuVisibility() } onTransitionEnd(t) { t.target !== this.menuElem && t.target !== this.wrapperElem || (this.isAnimating = !1, this.lastAction && (this.triggerEvent(this.lastAction, !0), this.lastAction = null)) } initKeybindings() { document.addEventListener("keydown", t => { switch (t.key) { case this.options.keyClose: this.close(); break; case this.options.keyOpen: this.open(); break; default: return }t.preventDefault() }) } initSubmenuVisibility() { this.menuElem.addEventListener("sm.back-after", () => { const t = ".".concat(u.CLASS_NAMES.active, " ").repeat(this.level + 1), e = this.menuElem.querySelector("ul ".concat(t)); e && (e.style.display = "none", e.classList.remove(u.CLASS_NAMES.active)) }) } triggerEvent(t, e = !1) { this.lastAction = t; const n = "sm.".concat(t).concat(e ? "-after" : ""), r = new CustomEvent(n); this.menuElem.dispatchEvent(r) } navigate(t = r.Forward, e) { if (this.isAnimating || t === r.Backward && 0 === this.level) return; const n = -100 * (this.level + t); if (e && null !== e.parentElement && t === r.Forward) { const t = e.parentElement.querySelector("ul"); if (!t) return; t.classList.add(u.CLASS_NAMES.active), t.style.display = "block" } const i = t === r.Forward ? o.Forward : o.Back; this.triggerEvent(i), this.level = this.level + t, this.moveSlider(this.wrapperElem, n) } moveSlider(t, e) { e.toString().includes("%") || (e += "%"), t.style.transform = "translateX(".concat(e, ")"), this.isAnimating = !0 } initMenu() { this.runWithoutAnimation(() => { switch (this.options.position) { case i.Left: Object.assign(this.menuElem.style, { left: 0, right: "auto", transform: "translateX(-100%)" }); break; default: Object.assign(this.menuElem.style, { left: "auto", right: 0 }) }this.menuElem.style.display = "block" }) } runWithoutAnimation(t) { const e = [this.menuElem, this.wrapperElem]; e.forEach(t => t.style.transition = "none"), t(), this.menuElem.offsetHeight, e.forEach(t => t.style.removeProperty("transition")), this.isAnimating = !1 } initSubmenus() { this.menuElem.querySelectorAll("a").forEach(t => { if (null === t.parentElement) return; const e = t.parentElement.querySelector("ul"); if (!e) return; t.addEventListener("click", t => { t.preventDefault() }); const n = t.textContent; if (this.addLinkDecorators(t), this.options.showBackLink) { const { backLinkBefore: t, backLinkAfter: r } = this.options, i = document.createElement("a"); i.href = "#", i.addEventListener("click", t => { t.preventDefault() }), i.innerHTML = t + n + r, i.classList.add(u.CLASS_NAMES.backlink, u.CLASS_NAMES.control), i.setAttribute("data-action", o.Back); const c = document.createElement("li"); c.appendChild(i), e.insertBefore(c, e.firstChild) } }) } addLinkDecorators(t) { const { submenuLinkBefore: e, submenuLinkAfter: n } = this.options; if (e) { const n = document.createElement("span"); n.classList.add(u.CLASS_NAMES.decorator), n.innerHTML = e, t.insertBefore(n, t.firstChild) } if (n) { const e = document.createElement("span"); e.classList.add(u.CLASS_NAMES.decorator), e.innerHTML = n, t.appendChild(e) } return t } } u.NAMESPACE = "slide-menu", u.CLASS_NAMES = { active: "".concat(u.NAMESPACE, "__submenu--active"), backlink: "".concat(u.NAMESPACE, "__backlink"), control: "".concat(u.NAMESPACE, "__control"), decorator: "".concat(u.NAMESPACE, "__decorator"), wrapper: "".concat(u.NAMESPACE, "__slider") }, document.addEventListener("click", t => { if (!(t.target instanceof HTMLElement)) return; const e = t.target.className.includes(u.CLASS_NAMES.control) ? t.target : s(t.target, ".".concat(u.CLASS_NAMES.control)); if (!e || !e.className.includes(u.CLASS_NAMES.control)) return; const n = e.getAttribute("data-target"), r = n && "this" !== n ? document.getElementById(n) : s(e, ".".concat(u.NAMESPACE)); if (!r) throw new Error("Unable to find menu ".concat(n)); const i = r._slideMenu, o = e.getAttribute("data-action"), c = e.getAttribute("data-arg"); i && o && "function" == typeof i[o] && (c ? i[o](c) : i[o]()) }), window.SlideMenu = u }]);
/******************************************************************************
W:\websites\_dl_components\components\navigation\slide-nav\slide-nav.js
******************************************************************************/
;/// <reference path="../../../assets/js/util/types.d.ts" />
((/** @type {DL_Util_Events_Namespace} */ events) => {
    events.domContentLoaded(function () {
        const toggle = document.querySelector('.header__nav-toggle label');

        // a toggle is required, bail if we don't find it
        if (!toggle) {
            return;
        }

        const openDirection = toggle.closest('[data-open-direction]')?.dataset.openDirection || 'right';
        const body = document.body;
        const navBreakPoint = getComputedStyle(document.documentElement).getPropertyValue('--nav-breakpoint');
        let menu = null;

        // set the direction modifier
        body.classList.add(`nav-opens--${openDirection}`);

        // Defining a function
        function toggleNav() {
            toggle.classList.toggle('header__nav-toggle--open');
            body.classList.toggle('openNav');

            if (openDirection) {
                body.classList.toggle(`openNav--${openDirection}`);
            }

            if (menu) {
                menu.toggle();
            }
        }

        function setupMenu() {
            if (window.matchMedia(`(min-width: ${navBreakPoint})`).matches) {
                if (menu) {
                    menu.destroy();
                    menu = null;
                }
            }
            else {
                if (!menu) {
                    menu = new SlideMenu(document.querySelector('.slide-menu'), {
                        keyClose: 'Escape',
                        submenuLinkAfter: '<span style="margin-left: 1em;"><\/span>',
                        backLinkBefore: '<span style="margin-right: 1em;"><\/span>',
                        position: openDirection,
                    });
                }
            }
        }

        // Calling the function after click event occurs
        toggle.addEventListener('click', function () {
            toggleNav();
        });

        window.addEventListener('resize', setupMenu);
        setupMenu(); // initial load
    });
})(dl.util.namespace('dl.util.events'));
/******************************************************************************
W:\websites\_dl_components\components\footer\footer-1\footer-1.js
******************************************************************************/
;(function () {
    console.debug('initializing dynamic-css-var --footer-height');

    /**
     * Sets the --footer-height property based on the (footer) offsetHeight.
     */
    function setFooterHeight(height) {
        const root = document.querySelector(':root');
        root.style.setProperty('--footer-height', height + 'px');
    }

    /**
     * Initializes the ResizeObserver to change the --footer-height property.
     * @param {HTMLElement} footer
     */
    function initFooterHeightObserver(footer) {
        try {
            // set the initial height because the observer doesn't always fire immediately
            setFooterHeight(footer?.offsetHeight || 0);

            const footerObserver = new ResizeObserver(entries => {
                // we only use the first entry
                const footerEntry = entries && entries[0];

                if (footerEntry) {
                    setFooterHeight(footerEntry.target.offsetHeight);
                }
            });

            footerObserver.observe(footer, { box: 'border-box' });
        } catch (ex) {
            console.debug('Could not set --footer-height observer.', ex);
        }
    }

    function init() {
        const footer = document.querySelector('footer');

        // only run the rest if we have a footer
        if (footer) {
            initFooterHeightObserver(footer);
        }
    }

    // no dependencies, call immediately
    init();
})();
/******************************************************************************
W:\websites\_dl_components\assets\js\liquid.browser.min.js
******************************************************************************/
;!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports):"function"==typeof define&&define.amd?define(["exports"],e):e((t=t||self).liquidjs={})}(this,function(p){"use strict";var n=function(t,e){return(n=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var r in e)e.hasOwnProperty(r)&&(t[r]=e[r])})(t,e)};function t(t,e){function r(){this.constructor=t}n(t,e),t.prototype=null===e?Object.create(e):(r.prototype=e.prototype,new r)}var x=function(){return(x=Object.assign||function(t){for(var e,r=1,n=arguments.length;r<n;r++)for(var i in e=arguments[r])Object.prototype.hasOwnProperty.call(e,i)&&(t[i]=e[i]);return t}).apply(this,arguments)};function i(s,o,a,u){return new(a=a||Promise)(function(t,e){function r(t){try{i(u.next(t))}catch(t){e(t)}}function n(t){try{i(u.throw(t))}catch(t){e(t)}}function i(e){e.done?t(e.value):new a(function(t){t(e.value)}).then(r,n)}i((u=u.apply(s,o||[])).next())})}function q(r,n){var i,s,o,t,a={label:0,sent:function(){if(1&o[0])throw o[1];return o[1]},trys:[],ops:[]};return t={next:e(0),throw:e(1),return:e(2)},"function"==typeof Symbol&&(t[Symbol.iterator]=function(){return this}),t;function e(e){return function(t){return function(e){if(i)throw new TypeError("Generator is already executing.");for(;a;)try{if(i=1,s&&(o=2&e[0]?s.return:e[0]?s.throw||((o=s.return)&&o.call(s),0):s.next)&&!(o=o.call(s,e[1])).done)return o;switch(s=0,o&&(e=[2&e[0],o.value]),e[0]){case 0:case 1:o=e;break;case 4:return a.label++,{value:e[1],done:!1};case 5:a.label++,s=e[1],e=[0];continue;case 7:e=a.ops.pop(),a.trys.pop();continue;default:if(!(o=0<(o=a.trys).length&&o[o.length-1])&&(6===e[0]||2===e[0])){a=0;continue}if(3===e[0]&&(!o||e[1]>o[0]&&e[1]<o[3])){a.label=e[1];break}if(6===e[0]&&a.label<o[1]){a.label=o[1],o=e;break}if(o&&a.label<o[2]){a.label=o[2],a.ops.push(e);break}o[2]&&a.ops.pop(),a.trys.pop();continue}e=n.call(r,a)}catch(t){e=[6,t],s=0}finally{i=o=0}if(5&e[0])throw e[1];return{value:e[0]?e[1]:void 0,done:!0}}([e,t])}}}function O(t){var e="function"==typeof Symbol&&t[Symbol.iterator],r=0;return e?e.call(t):{next:function(){return t&&r>=t.length&&(t=void 0),{value:t&&t[r++],done:!t}}}}function m(t,e){var r="function"==typeof Symbol&&t[Symbol.iterator];if(!r)return t;var n,i,s=r.call(t),o=[];try{for(;(void 0===e||0<e--)&&!(n=s.next()).done;)o.push(n.value)}catch(t){i={error:t}}finally{try{n&&!n.done&&(r=s.return)&&r.call(s)}finally{if(i)throw i.error}}return o}function w(){for(var t=[],e=0;e<arguments.length;e++)t=t.concat(m(arguments[e]));return t}var s=(e.prototype.valueOf=function(){},e.prototype.liquidMethodMissing=function(t){},e);function e(){}var r=Object.prototype.toString,o=String.prototype.toLowerCase;function a(t){return"string"==typeof t}function u(t){return"function"==typeof t}function c(t){return a(t=f(t))?t:h(t)?"":String(t)}function f(t){return t instanceof s?t.valueOf():t}function l(t){return"number"==typeof t}function h(t){return null==t}function d(t){return"[object Array]"===r.call(t)}function v(t,e){for(var r in t=t||{})if(t.hasOwnProperty(r)&&!1===e(t[r],r,t))break;return t}function g(t){return t[t.length-1]}function y(t){var e=typeof t;return null!==t&&("object"==e||"function"==e)}function b(t,e,r){void 0===r&&(r=1);for(var n=[],i=t;i<e;i+=r)n.push(i);return n}function T(t,e,r){return void 0===r&&(r=" "),k(t,e,r,function(t,e){return e+t})}function k(t,e,r,n){for(var i=e-(t=String(t)).length;0<i--;)t=n(t,r);return t}function F(t){return t}function R(t){return t.replace(/(\w?)([A-Z])/g,function(t,e,r){return(e?e+"_":"")+r.toLowerCase()})}function S(t,e){return null==t&&null==e?0:null==t?1:null==e?-1:(t=o.call(t))<(e=o.call(e))?-1:e<t?1:0}var E=function(t,e,r,n){this.key=t,this.value=e,this.next=r,this.prev=n},L=(P.prototype.write=function(t,e){if(this.cache[t])this.cache[t].value=e;else{var r=new E(t,e,this.head.next,this.head);this.head.next.prev=r,this.head.next=r,this.cache[t]=r,this.size++,this.ensureLimit()}},P.prototype.read=function(t){if(this.cache[t]){var e=this.cache[t].value;return this.remove(t),this.write(t,e),e}},P.prototype.remove=function(t){var e=this.cache[t];e.prev.next=e.next,e.next.prev=e.prev,delete this.cache[t],this.size--},P.prototype.clear=function(){this.head.next=this.tail,this.tail.prev=this.head,this.size=0,this.cache={}},P.prototype.ensureLimit=function(){this.size>this.limit&&this.remove(this.tail.prev.key)},P);function P(t,e){void 0===e&&(e=0),this.limit=t,this.size=e,this.cache={},this.head=new E("HEAD",null,null,null),this.tail=new E("TAIL",null,null,null),this.head.next=this.tail,this.tail.prev=this.head}function D(t,e){var r=document.createElement("base");r.href=t;var n=document.getElementsByTagName("head")[0];n.insertBefore(r,n.firstChild);var i=document.createElement("a");i.href=e;var s=i.href;return n.removeChild(r),s}var N=Object.freeze({resolve:function(t,e,i){return t.length&&"/"!==g(t)&&(t+="/"),D(t,e).replace(/^(\w+:\/\/[^/]+)(\/[^?]+)/,function(t,e,r){var n=r.split("/").pop();return/\.\w+$/.test(n)?t:e+r+i})},readFile:function(n){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,new Promise(function(t,e){var r=new XMLHttpRequest;r.onload=function(){200<=r.status&&r.status<300?t(r.responseText):e(new Error(r.statusText))},r.onerror=function(){e(new Error("An error occurred whilst receiving the response."))},r.open("GET",n),r.send()})]})})},readFileSync:function(t){var e=new XMLHttpRequest;if(e.open("GET",t,!1),e.send(),e.status<200||300<=e.status)throw new Error(e.statusText);return e.responseText},exists:function(t){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,!0]})})},existsSync:function(t){return!0},dirname:function(t){return D(t,".")},sep:"/"});function M(t){return t&&u(t.equals)}function A(t,e){return!I(t,e)}function I(t,e){return e.opts.jsTruthy?!t:!1===t||null==t}var z={"==":function(t,e){return M(t)?t.equals(e):M(e)?e.equals(t):t===e},"!=":function(t,e){return M(t)?!t.equals(e):M(e)?!e.equals(t):t!==e},">":function(t,e){return M(t)?t.gt(e):M(e)?e.lt(t):e<t},"<":function(t,e){return M(t)?t.lt(e):M(e)?e.gt(t):t<e},">=":function(t,e){return M(t)?t.geq(e):M(e)?e.leq(t):e<=t},"<=":function(t,e){return M(t)?t.leq(e):M(e)?e.geq(t):t<=e},contains:function(t,e){return!(!t||!u(t.indexOf))&&-1<t.indexOf(e)},and:function(t,e,r){return A(t,r)&&A(e,r)},or:function(t,e,r){return A(t,r)||A(e,r)}},_=[0,0,0,0,0,0,0,0,0,20,4,4,4,20,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,20,2,8,0,0,0,0,8,0,0,0,64,0,65,0,0,33,33,33,33,33,33,33,33,33,33,0,0,2,2,2,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0],j=1,V=4,B=16;function C(t){var e,r,n={};try{for(var i=O(Object.entries(t)),s=i.next();!s.done;s=i.next()){for(var o=m(s.value,2),a=o[0],u=o[1],c=n,l=0;l<a.length;l++){var h=a[l];c[h]=c[h]||{},l===a.length-1&&_[a.charCodeAt(l)]&j&&(c[h].needBoundary=!0),c=c[h]}c.handler=u,c.end=!0}}catch(t){e={error:t}}finally{try{s&&!s.done&&(r=i.return)&&r.call(i)}finally{if(e)throw e.error}}return n}_[160]=_[5760]=_[6158]=_[8192]=_[8193]=_[8194]=_[8195]=_[8196]=_[8197]=_[8198]=_[8199]=_[8200]=_[8201]=_[8202]=_[8232]=_[8233]=_[8239]=_[8287]=_[12288]=V;var H={root:["."],layouts:["."],partials:["."],relativeReference:!0,cache:void 0,extname:"",fs:N,dynamicPartials:!0,jsTruthy:!1,trimTagRight:!1,trimTagLeft:!1,trimOutputRight:!1,trimOutputLeft:!1,greedy:!0,tagDelimiterLeft:"{%",tagDelimiterRight:"%}",outputDelimiterLeft:"{{",outputDelimiterRight:"}}",preserveTimezones:!1,strictFilters:!1,strictVariables:!1,lenientIf:!1,globals:{},keepOutputType:!1,operators:z,operatorsTrie:C(z)};function K(t){var e=[];return d(t)&&(e=t),a(t)&&(e=[t]),e}var U,Q=(t(W,U=Error),W.prototype.update=function(){var t=this.originalError;this.context=function(t){var e=m(t.getPosition(),1)[0],r=t.input.split("\n"),n=Math.max(e-2,1),i=Math.min(e+3,r.length);return b(n,i+1).map(function(t){return(t===e?">> ":"   ")+T(String(t),String(i).length)+"| "+r[t-1]}).join("\n")}(this.token),this.message=function(t,e){e.file&&(t+=", file:"+e.file);var r=m(e.getPosition(),2),n=r[0],i=r[1];return t+=", line:"+n+", col:"+i}(t.message,this.token),this.stack=this.message+"\n"+this.context+"\n"+this.stack+"\nFrom "+t.stack},W);function W(t,e){var r=U.call(this,t.message)||this;return r.originalError=t,r.token=e,r.context="",r}var J,$=(t(Y,J=Q),Y);function Y(t,e){var r=J.call(this,new Error(t),e)||this;return r.name="TokenizationError",J.prototype.update.call(r),r}var G,X=(t(Z,G=Q),Z);function Z(t,e){var r=G.call(this,t,e)||this;return r.name="ParseError",r.message=t.message,G.prototype.update.call(r),r}var tt,et=(t(rt,tt=Q),rt.is=function(t){return"RenderError"===t.name},rt);function rt(t,e){var r=tt.call(this,t,e.token)||this;return r.name="RenderError",r.message=t.message,tt.prototype.update.call(r),r}var nt,it=(t(st,nt=Q),st);function st(t,e){var r=nt.call(this,t,e)||this;return r.name="UndefinedVariableError",r.message=t.message,nt.prototype.update.call(r),r}var ot,at=(t(ut,ot=Error),ut);function ut(t){var e=ot.call(this,"undefined variable: "+t)||this;return e.name="InternalUndefinedVariableError",e.variableName=t,e}var ct,lt=(t(ht,ct=Error),ht);function ht(t){var e=ct.call(this,t)||this;return e.name="AssertionError",e.message=t+"",e}var pt,ft,dt=(vt.prototype.getRegister=function(t){return this.registers[t]=this.registers[t]||{}},vt.prototype.setRegister=function(t,e){return this.registers[t]=e},vt.prototype.saveRegister=function(){for(var e=this,t=[],r=0;r<arguments.length;r++)t[r]=arguments[r];return t.map(function(t){return[t,e.getRegister(t)]})},vt.prototype.restoreRegister=function(t){var i=this;return t.forEach(function(t){var e=m(t,2),r=e[0],n=e[1];return i.setRegister(r,n)})},vt.prototype.getAll=function(){return w([this.globals,this.environments],this.scopes).reduce(function(t,e){return x(t,e)},{})},vt.prototype.get=function(t){var e=this.findScope(t[0]);return this.getFromScope(e,t)},vt.prototype.getFromScope=function(t,e){var r=this;return"string"==typeof e&&(e=e.split(".")),e.reduce(function(t,e){if(h(t=function(t,e){return h(t)?t:u((t=function t(e){return e&&u(e.toLiquid)?t(e.toLiquid()):e}(t))[e])?t[e]():t instanceof s?t.hasOwnProperty(e)?t[e]:t.liquidMethodMissing(e):"size"===e?function(t){return d(t)||a(t)?t.length:t.size}(t):"first"===e?function(t){return d(t)?t[0]:t.first}(t):"last"===e?function(t){return d(t)?t[t.length-1]:t.last}(t):t[e]}(t,e))&&r.opts.strictVariables)throw new at(e);return t},t)},vt.prototype.push=function(t){return this.scopes.push(t)},vt.prototype.pop=function(){return this.scopes.pop()},vt.prototype.bottom=function(){return this.scopes[0]},vt.prototype.findScope=function(t){for(var e=this.scopes.length-1;0<=e;e--){var r=this.scopes[e];if(t in r)return r}return t in this.environments?this.environments:this.globals},vt);function vt(t,e,r){void 0===t&&(t={}),void 0===e&&(e=H),void 0===r&&(r=!1),this.scopes=[{}],this.registers={},this.sync=r,this.opts=e,this.globals=e.globals,this.environments=t}function gt(t,e){if(!t){var r="function"==typeof e?e():e||"expect "+t+" to be true";throw new lt(r)}}(ft=pt=pt||{}).Partials="partials",ft.Layouts="layouts",ft.Root="root";var yt=(mt.prototype.lookup=function(e,r,n,i){var s,o,a,u,c,l,h,p,f;return q(this,function(t){switch(t.label){case 0:s=this.options.fs,o=this.options[r],t.label=1;case 1:t.trys.push([1,8,9,10]),a=O(this.candidates(e,o,i,r!==pt.Root)),u=a.next(),t.label=2;case 2:return u.done?[3,7]:(c=u.value,n?(l=s.existsSync(c),[3,5]):[3,3]);case 3:return[4,s.exists(c)];case 4:l=t.sent(),t.label=5;case 5:if(l)return[2,c];t.label=6;case 6:return u=a.next(),[3,2];case 7:return[3,10];case 8:return h=t.sent(),p={error:h},[3,10];case 9:try{u&&!u.done&&(f=a.return)&&f.call(a)}finally{if(p)throw p.error}return[7];case 10:throw this.lookupError(e,o)}})},mt.prototype.candidates=function(e,r,n,i){var s,o,a,u,c,l,h,p,f,d,v,g,y,m,w,b;return q(this,function(t){switch(t.label){case 0:if(s=this.options,o=s.fs,a=s.extname,!this.shouldLoadRelative(e)||!n)return[3,8];d=o.resolve(this.dirname(n),e,a),t.label=1;case 1:t.trys.push([1,6,7,8]),u=O(r),c=u.next(),t.label=2;case 2:return c.done?[3,5]:(f=c.value,i&&!this.contains(f,d)?[3,4]:[4,d]);case 3:return t.sent(),[3,5];case 4:return c=u.next(),[3,2];case 5:return[3,8];case 6:return l=t.sent(),y={error:l},[3,8];case 7:try{c&&!c.done&&(m=u.return)&&m.call(u)}finally{if(y)throw y.error}return[7];case 8:t.trys.push([8,13,14,15]),h=O(r),p=h.next(),t.label=9;case 9:return p.done?[3,12]:(f=p.value,d=o.resolve(f,e,a),i&&!this.contains(f,d)?[3,11]:[4,d]);case 10:t.sent(),t.label=11;case 11:return p=h.next(),[3,9];case 12:return[3,15];case 13:return v=t.sent(),w={error:v},[3,15];case 14:try{p&&!p.done&&(b=h.return)&&b.call(h)}finally{if(w)throw w.error}return[7];case 15:return void 0===o.fallback?[3,17]:void 0===(g=o.fallback(e))?[3,17]:[4,g];case 16:t.sent(),t.label=17;case 17:return[2]}})},mt.prototype.dirname=function(t){var e=this.options.fs;return gt(e.dirname,"`fs.dirname` is required for relative reference"),e.dirname(t)},mt.prototype.lookupError=function(t,e){var r=new Error("ENOENT");return r.message='ENOENT: Failed to lookup "'+t+'" in "'+e+'"',r.code="ENOENT",r},mt);function mt(t){if((this.options=t).relativeReference){var e=t.fs.sep;gt(e,"`fs.sep` is required for relative reference");var r=new RegExp(["."+e,".."+e].map(function(t){return function(t){return t.replace(/[-/\\^$*+?.()|[\]{}]/g,"\\$&")}(t)}).join("|"));this.shouldLoadRelative=function(t){return r.test(t)}}else this.shouldLoadRelative=function(t){return!1};this.contains=this.options.fs.contains||function(){return!0}}var wt=(bt.prototype.write=function(t){this.buffer+=c(t)},bt);function bt(){this.buffer=""}var Tt=function(){throw this.buffer="",this.stream=null,new Error("streaming not supported in browser")};function kt(e){var t={then:function(t){return t(e)},catch:function(){return t}};return t}function xt(r){var n={then:function(t,e){return e?e(r):n},catch:function(t){return t(r)}};return n}function qt(n){return function(t){return t&&u(t.then)}(n)?n:function(t){return t&&u(t.next)&&u(t.throw)&&u(t.return)}(n)?function r(t){var e;try{e=n.next(t)}catch(t){return xt(t)}if(e.done)return kt(e.value);return qt(e.value).then(r,function(t){var e;try{e=n.throw(t)}catch(t){return xt(t)}return e.done?kt(e.value):r(e.value)})}():kt(n)}function Ot(t){return Promise.resolve(qt(t))}function Ft(t){var e;return qt(t).then(function(t){return kt(e=t)}).catch(function(t){throw t}),e}var Rt=(St.prototype.write=function(t){"string"!=typeof(t=f(t))&&""===this.buffer?this.buffer=t:this.buffer=c(this.buffer)+c(t)},St);function St(){this.buffer=""}var Et,Lt=(Pt.prototype.renderTemplatesToNodeStream=function(t,e){var r=this,n=new Tt;return Promise.resolve().then(function(){return qt(r.renderTemplates(t,e,n))}).then(function(){return n.end()},function(t){return n.error(t)}),n.stream},Pt.prototype.renderTemplates=function(e,r,n){var i,s,o,a,u,c,l,h;return q(this,function(t){switch(t.label){case 0:n=n||(r.opts.keepOutputType?new Rt:new wt),t.label=1;case 1:t.trys.push([1,8,9,10]),i=O(e),s=i.next(),t.label=2;case 2:if(s.done)return[3,7];o=s.value,t.label=3;case 3:return t.trys.push([3,5,,6]),[4,o.render(r,n)];case 4:return(a=t.sent())&&n.write(a),n.break||n.continue?[3,7]:[3,6];case 5:throw u=t.sent(),et.is(u)?u:new et(u,o);case 6:return s=i.next(),[3,2];case 7:return[3,10];case 8:return c=t.sent(),l={error:c},[3,10];case 9:try{s&&!s.done&&(h=i.return)&&h.call(i)}finally{if(l)throw l.error}return[7];case 10:return[2,n.buffer]}})},Pt);function Pt(){}function Dt(t){return!!(Ht(t)&p.TokenKind.Delimited)}function Nt(t){return Ht(t)===p.TokenKind.Operator}function Mt(t){return Ht(t)===p.TokenKind.HTML}function At(t){return Ht(t)===p.TokenKind.Output}function It(t){return Ht(t)===p.TokenKind.Tag}function zt(t){return Ht(t)===p.TokenKind.Quoted}function _t(t){return Ht(t)===p.TokenKind.Literal}function jt(t){return Ht(t)===p.TokenKind.Number}function Vt(t){return Ht(t)===p.TokenKind.PropertyAccess}function Bt(t){return Ht(t)===p.TokenKind.Word}function Ct(t){return Ht(t)===p.TokenKind.Range}function Ht(t){return t?t.kind:-1}(Et=p.TokenKind||(p.TokenKind={}))[Et.Number=1]="Number",Et[Et.Literal=2]="Literal",Et[Et.Tag=4]="Tag",Et[Et.Output=8]="Output",Et[Et.HTML=16]="HTML",Et[Et.Filter=32]="Filter",Et[Et.Hash=64]="Hash",Et[Et.PropertyAccess=128]="PropertyAccess",Et[Et.Word=256]="Word",Et[Et.Range=512]="Range",Et[Et.Quoted=1024]="Quoted",Et[Et.Operator=2048]="Operator",Et[Et.Delimited=12]="Delimited";var Kt=Object.freeze({isDelimitedToken:Dt,isOperatorToken:Nt,isHTMLToken:Mt,isOutputToken:At,isTagToken:It,isQuotedToken:zt,isLiteralToken:_t,isNumberToken:jt,isPropertyAccessToken:Vt,isWordToken:Bt,isRangeToken:Ct}),Ut=(Qt.prototype.on=function(t,e){return this.handlers[t]=e,this},Qt.prototype.trigger=function(t,e){var r=this.handlers[t];return!!r&&(r.call(this,e),!0)},Qt.prototype.start=function(){var t;for(this.trigger("start");!this.stopRequested&&(t=this.tokens.shift());)if(!(this.trigger("token",t)||It(t)&&this.trigger("tag:"+t.name,t))){var e=this.parseToken(t,this.tokens);this.trigger("template",e)}return this.stopRequested||this.trigger("end"),this},Qt.prototype.stop=function(){return this.stopRequested=!0,this},Qt);function Qt(t,e){this.handlers={},this.stopRequested=!1,this.tokens=t,this.parseToken=e}function Wt(t){this.token=t}var Jt,$t=(t(Yt,Jt=s),Yt.prototype.equals=function(t){return h(f(t))},Yt.prototype.gt=function(){return!1},Yt.prototype.geq=function(){return!1},Yt.prototype.lt=function(){return!1},Yt.prototype.leq=function(){return!1},Yt.prototype.valueOf=function(){return null},Yt);function Yt(){return null!==Jt&&Jt.apply(this,arguments)||this}var Gt,Xt=(t(Zt,Gt=s),Zt.prototype.equals=function(t){return!(t instanceof Zt||(a(t=f(t))||d(t)?0!==t.length:!y(t)||0!==Object.keys(t).length))},Zt.prototype.gt=function(){return!1},Zt.prototype.geq=function(){return!1},Zt.prototype.lt=function(){return!1},Zt.prototype.leq=function(){return!1},Zt.prototype.valueOf=function(){return""},Zt);function Zt(){return null!==Gt&&Gt.apply(this,arguments)||this}var te,ee=(t(re,te=Xt),re.prototype.equals=function(t){return!1===t||!!h(f(t))||(a(t)?/^\s*$/.test(t):te.prototype.equals.call(this,t))},re);function re(){return null!==te&&te.apply(this,arguments)||this}var ne=new $t,ie={true:!0,false:!1,nil:ne,null:ne,empty:new Xt,blank:new ee},se=/[\da-fA-F]/,oe=/[0-7]/,ae={b:"\b",f:"\f",n:"\n",r:"\r",t:"\t",v:"\v"};function ue(t){var e=t.charCodeAt(0);return 97<=e?e-87:65<=e?e-55:e-48}function ce(t){for(var e="",r=1;r<t.length-1;r++)if("\\"===t[r])if(void 0!==ae[t[r+1]])e+=ae[t[++r]];else if("u"===t[r+1]){for(var n=0,i=r+2;i<=r+5&&se.test(t[i]);)n=16*n+ue(t[i++]);r=i-1,e+=String.fromCharCode(n)}else if(oe.test(t[r+1])){for(i=r+1,n=0;i<=r+3&&oe.test(t[i]);)n=8*n+ue(t[i++]);r=i-1,e+=String.fromCharCode(n)}else e+=t[++r];else e+=t[r];return e}var le=(he.prototype.evaluate=function(e,r){var n,i,s,o,a,u,c,l,h,p,f,d;return q(this,function(t){switch(t.label){case 0:gt(e,"unable to evaluate: context not defined"),n=[],t.label=1;case 1:t.trys.push([1,9,10,11]),i=O(this.postfix),s=i.next(),t.label=2;case 2:return s.done?[3,8]:Nt(o=s.value)?[4,n.pop()]:[3,5];case 3:return a=t.sent(),[4,n.pop()];case 4:return u=t.sent(),c=function(t,e,r,n,i){return(0,t[e.operator])(r,n,i)}(e.opts.operators,o,u,a,e),n.push(c),[3,7];case 5:return h=(l=n).push,[4,pe(o,e,r&&1===this.postfix.length)];case 6:h.apply(l,[t.sent()]),t.label=7;case 7:return s=i.next(),[3,2];case 8:return[3,11];case 9:return p=t.sent(),f={error:p},[3,11];case 10:try{s&&!s.done&&(d=i.return)&&d.call(i)}finally{if(f)throw f.error}return[7];case 11:return[2,n[0]]}})},he);function he(t){this.postfix=w(function(e){var r,n,i,s,o,a,u;return q(this,function(t){switch(t.label){case 0:r=[],t.label=1;case 1:t.trys.push([1,10,11,12]),n=O(e),i=n.next(),t.label=2;case 2:if(i.done)return[3,9];if(!Nt(s=i.value))return[3,6];t.label=3;case 3:return r.length&&r[r.length-1].getPrecedence()>s.getPrecedence()?[4,r.pop()]:[3,5];case 4:return t.sent(),[3,3];case 5:return r.push(s),[3,8];case 6:return[4,s];case 7:t.sent(),t.label=8;case 8:return i=n.next(),[3,2];case 9:return[3,12];case 10:return o=t.sent(),a={error:o},[3,12];case 11:try{i&&!i.done&&(u=n.return)&&u.call(n)}finally{if(a)throw a.error}return[7];case 12:return r.length?[4,r.pop()]:[3,14];case 13:return t.sent(),[3,12];case 14:return[2]}})}(t))}function pe(t,e,r){return void 0===r&&(r=!1),Vt(t)?function(e,r,n){var t=e.props.map(function(t){return pe(t,r,!1)});try{return r.get(w([e.propertyName],t))}catch(t){if(n&&"InternalUndefinedVariableError"===t.name)return null;throw new it(t,e)}}(t,e,r):Ct(t)?function(t,e){var r=pe(t.lhs,e),n=pe(t.rhs,e);return b(+r,+n+1)}(t,e):_t(t)?function(t){return ie[t.literal]}(t):jt(t)?function(t){var e=t.whole.content+"."+(t.decimal?t.decimal.content:"");return Number(e)}(t):Bt(t)?t.getText():zt(t)?fe(t):void 0}function fe(t){return ce(t.getText())}var de=(ve.prototype.getText=function(){return this.input.slice(this.begin,this.end)},ve.prototype.getPosition=function(){for(var t=m([1,1],2),e=t[0],r=t[1],n=0;n<this.begin;n++)"\n"===this.input[n]?(e++,r=1):r++;return[e,r]},ve.prototype.size=function(){return this.end-this.begin},ve);function ve(t,e,r,n,i){this.kind=t,this.input=e,this.begin=r,this.end=n,this.file=i}var ge,ye=(t(me,ge=de),me);function me(t,e,r,n,i,s,o,a){var u=ge.call(this,t,r,n,i,a)||this;u.trimLeft=!1,u.trimRight=!1,u.content=u.getText();var c="-"===e[0],l="-"===g(e);return u.content=e.slice(c?1:0,l?-1:e.length).trim(),u.trimLeft=c||s,u.trimRight=l||o,u}function we(t,e){if(t&&Mt(t))for(var r=e?V:B;_[t.input.charCodeAt(t.end-1-t.trimRight)]&r;)t.trimRight++}function be(t,e){if(t&&Mt(t)){for(var r=e?V:B;_[t.input.charCodeAt(t.begin+t.trimLeft)]&r;)t.trimLeft++;"\n"===t.input.charAt(t.begin+t.trimLeft)&&t.trimLeft++}}var Te,ke=(t(xe,Te=de),xe);function xe(t,e){var r=Te.call(this,p.TokenKind.Number,t.input,t.begin,e?e.end:t.end,t.file)||this;return r.whole=t,r.decimal=e,r}var qe,Oe=(t(Fe,qe=de),Fe.prototype.isNumber=function(t){void 0===t&&(t=!1);for(var e=t&&64&_[this.input.charCodeAt(this.begin)]?this.begin+1:this.begin;e<this.end;e++)if(!(32&_[this.input.charCodeAt(e)]))return!1;return!0},Fe);function Fe(t,e,r,n){var i=qe.call(this,p.TokenKind.Word,t,e,r,n)||this;return i.input=t,i.begin=e,i.end=r,i.file=n,i.content=i.getText(),i}var Re,Se=(t(Ee,Re=de),Ee);function Ee(t,e,r,n){var i=Re.call(this,p.TokenKind.Literal,t,e,r,n)||this;return i.input=t,i.begin=e,i.end=r,i.file=n,i.literal=i.getText(),i}var Le,Pe={"==":1,"!=":1,">":1,"<":1,">=":1,"<=":1,contains:1,and:0,or:0},De=(t(Ne,Le=de),Ne.prototype.getPrecedence=function(){var t=this.getText();return t in Pe?Pe[t]:1},Ne);function Ne(t,e,r,n){var i=Le.call(this,p.TokenKind.Operator,t,e,r,n)||this;return i.input=t,i.begin=e,i.end=r,i.file=n,i.operator=i.getText(),i}var Me,Ae=(t(Ie,Me=de),Ie);function Ie(t,e,r){var n=Me.call(this,p.TokenKind.PropertyAccess,t.input,t.begin,r,t.file)||this;return n.variable=t,n.props=e,n.propertyName=n.variable instanceof Oe?n.variable.getText():ce(n.variable.getText()),n}var ze,_e=(t(je,ze=de),je);function je(t,e,r,n,i,s){var o=ze.call(this,p.TokenKind.Filter,r,n,i,s)||this;return o.name=t,o.args=e,o}var Ve,Be=(t(Ce,Ve=de),Ce);function Ce(t,e,r,n,i,s){var o=Ve.call(this,p.TokenKind.Hash,t,e,r,s)||this;return o.input=t,o.begin=e,o.end=r,o.name=n,o.value=i,o.file=s,o}var He,Ke=(t(Ue,He=de),Ue);function Ue(t,e,r,n){var i=He.call(this,p.TokenKind.Quoted,t,e,r,n)||this;return i.input=t,i.begin=e,i.end=r,i.file=n,i}var Qe,We=(t(Je,Qe=de),Je.prototype.getContent=function(){return this.input.slice(this.begin+this.trimLeft,this.end-this.trimRight)},Je);function Je(t,e,r,n){var i=Qe.call(this,p.TokenKind.HTML,t,e,r,n)||this;return i.input=t,i.begin=e,i.end=r,i.file=n,i.trimLeft=0,i.trimRight=0,i}var $e,Ye=(t(Ge,$e=de),Ge);function Ge(t,e,r,n,i,s){var o=$e.call(this,p.TokenKind.Range,t,e,r,s)||this;return o.input=t,o.begin=e,o.end=r,o.lhs=n,o.rhs=i,o.file=s,o}var Xe,Ze=(t(tr,Xe=ye),tr);function tr(t,e,r,n,i){var s=n.trimOutputLeft,o=n.trimOutputRight,a=n.outputDelimiterLeft,u=n.outputDelimiterRight,c=t.slice(e+a.length,r-u.length);return Xe.call(this,p.TokenKind.Output,c,t,e,r,s,o,i)||this}var er=(rr.prototype.readExpression=function(){return new le(this.readExpressionTokens())},rr.prototype.readExpressionTokens=function(){var e,r,n;return q(this,function(t){switch(t.label){case 0:return(e=this.readValue())?[4,e]:[2];case 1:t.sent(),t.label=2;case 2:return this.p<this.N?(r=this.readOperator())&&(n=this.readValue())?[4,r]:[2]:[3,5];case 3:return t.sent(),[4,n];case 4:return t.sent(),[3,2];case 5:return[2]}})},rr.prototype.readOperator=function(){this.skipBlank();var t=function(t,e,r,n){void 0===n&&(n=t.length);for(var i,s=r,o=e;s[t[o]]&&o<n;)(s=s[t[o++]]).end&&(i=s);return i?i.needBoundary&&_[t.charCodeAt(o)]&j?-1:o:-1}(this.input,this.p,this.trie,this.p+8);if(-1!==t)return new De(this.input,this.p,this.p=t,this.file)},rr.prototype.readFilters=function(){for(var t=[];;){var e=this.readFilter();if(!e)return t;t.push(e)}},rr.prototype.readFilter=function(){var t=this;if(this.skipBlank(),this.end())return null;gt("|"===this.peek(),function(){return"unexpected token at "+t.snapshot()}),this.p++;var e=this.p,r=this.readIdentifier();if(!r.size())return null;var n=[];if(this.skipBlank(),":"===this.peek())do{++this.p;var i=this.readFilterArg();for(i&&n.push(i);this.p<this.N&&","!==this.peek()&&"|"!==this.peek();)++this.p}while(","===this.peek());return new _e(r.getText(),n,this.input,e,this.p,this.file)},rr.prototype.readFilterArg=function(){var t=this.readValue();if(t){if(this.skipBlank(),":"!==this.peek())return t;++this.p;var e=this.readValue();return[t.getText(),e]}},rr.prototype.readTopLevelTokens=function(t){void 0===t&&(t=H);for(var e=[];this.p<this.N;){var r=this.readTopLevelToken(t);e.push(r)}return function(t,e){for(var r=!1,n=0;n<t.length;n++){var i=t[n];Dt(i)&&(!r&&i.trimLeft&&we(t[n-1],e.greedy),It(i)&&("raw"===i.name?r=!0:"endraw"===i.name&&(r=!1)),!r&&i.trimRight&&be(t[n+1],e.greedy))}}(e,t),e},rr.prototype.readTopLevelToken=function(t){var e=t.tagDelimiterLeft,r=t.outputDelimiterLeft;return-1<this.rawBeginAt?this.readEndrawOrRawContent(t):this.match(e)?this.readTagToken(t):this.match(r)?this.readOutputToken(t):this.readHTMLToken(t)},rr.prototype.readHTMLToken=function(t){for(var e=this.p;this.p<this.N;){var r=t.tagDelimiterLeft,n=t.outputDelimiterLeft;if(this.match(r))break;if(this.match(n))break;++this.p}return new We(this.input,e,this.p,this.file)},rr.prototype.readTagToken=function(t){void 0===t&&(t=H);var e=this.file,r=this.input,n=this.p;if(-1===this.readToDelimiter(t.tagDelimiterRight))throw this.mkError("tag "+this.snapshot(n)+" not closed",n);var i=new ir(r,n,this.p,t,e);return"raw"===i.name&&(this.rawBeginAt=n),i},rr.prototype.readToDelimiter=function(t){for(;this.p<this.N;)if(8&this.peekType())this.readQuoted();else if(++this.p,this.rmatch(t))return this.p;return-1},rr.prototype.readOutputToken=function(t){void 0===t&&(t=H);var e=this.file,r=this.input,n=t.outputDelimiterRight,i=this.p;if(-1===this.readToDelimiter(n))throw this.mkError("output "+this.snapshot(i)+" not closed",i);return new Ze(r,i,this.p,t,e)},rr.prototype.readEndrawOrRawContent=function(t){for(var e=t.tagDelimiterLeft,r=t.tagDelimiterRight,n=this.p,i=this.readTo(e)-e.length;this.p<this.N;)if("endraw"===this.readIdentifier().getText())for(;this.p<=this.N;){if(this.rmatch(r)){var s=this.p;return n===i?(this.rawBeginAt=-1,new ir(this.input,n,s,t,this.file)):(this.p=i,new We(this.input,n,i,this.file))}if(this.rmatch(e))break;this.p++}else i=this.readTo(e)-e.length;throw this.mkError("raw "+this.snapshot(this.rawBeginAt)+" not closed",n)},rr.prototype.mkError=function(t,e){return new $(t,new Oe(this.input,e,this.N,this.file))},rr.prototype.snapshot=function(t){return void 0===t&&(t=this.p),JSON.stringify(function(t,e){return t.length>e?t.substr(0,e-3)+"...":t}(this.input.slice(t),16))},rr.prototype.readWord=function(){return console.warn("Tokenizer#readWord() will be removed, use #readIdentifier instead"),this.readIdentifier()},rr.prototype.readIdentifier=function(){this.skipBlank();for(var t=this.p;this.peekType()&j;)++this.p;return new Oe(this.input,t,this.p,this.file)},rr.prototype.readHashes=function(){for(var t=[];;){var e=this.readHash();if(!e)return t;t.push(e)}},rr.prototype.readHash=function(){this.skipBlank(),","===this.peek()&&++this.p;var t,e=this.p,r=this.readIdentifier();if(r.size())return this.skipBlank(),":"===this.peek()&&(++this.p,t=this.readValue()),new Be(this.input,e,this.p,r,t,this.file)},rr.prototype.remaining=function(){return this.input.slice(this.p)},rr.prototype.advance=function(t){void 0===t&&(t=1),this.p+=t},rr.prototype.end=function(){return this.p>=this.N},rr.prototype.readTo=function(t){for(;this.p<this.N;)if(++this.p,this.rmatch(t))return this.p;return-1},rr.prototype.readValue=function(){var t=this.readQuoted()||this.readRange();if(t)return t;if("["===this.peek()){if(this.p++,!(i=this.readQuoted()))return;if("]"!==this.peek())return;return this.p++,new Ae(i,[],this.p)}var e=this.readIdentifier();if(e.size()){for(var r=e.isNumber(!0),n=[];;)if("["===this.peek()){r=!1,this.p++;var i=this.readValue()||new Oe(this.input,this.p,this.p,this.file);this.readTo("]"),n.push(i)}else{if("."!==this.peek()||"."===this.peek(1))break;if(this.p++,!(i=this.readIdentifier()).size())break;i.isNumber()||(r=!1),n.push(i)}return!n.length&&ie.hasOwnProperty(e.content)?new Se(this.input,e.begin,e.end,this.file):r?new ke(e,n[0]):new Ae(e,n,this.p)}},rr.prototype.readRange=function(){this.skipBlank();var t=this.p;if("("===this.peek()){++this.p;var e=this.readValueOrThrow();this.p+=2;var r=this.readValueOrThrow();return++this.p,new Ye(this.input,t,this.p,e,r,this.file)}},rr.prototype.readValueOrThrow=function(){var t=this,e=this.readValue();return gt(e,function(){return"unexpected token "+t.snapshot()+", value expected"}),e},rr.prototype.readQuoted=function(){this.skipBlank();var t=this.p;if(8&this.peekType()){++this.p;for(var e=!1;this.p<this.N&&(++this.p,this.input[this.p-1]!==this.input[t]||e);)e?e=!1:"\\"===this.input[this.p-1]&&(e=!0);return new Ke(this.input,t,this.p,this.file)}},rr.prototype.readFileName=function(){for(var t=this.p;!(this.peekType()&V)&&","!==this.peek()&&this.p<this.N;)this.p++;return new Oe(this.input,t,this.p,this.file)},rr.prototype.match=function(t){for(var e=0;e<t.length;e++)if(t[e]!==this.input[this.p+e])return!1;return!0},rr.prototype.rmatch=function(t){for(var e=0;e<t.length;e++)if(t[t.length-1-e]!==this.input[this.p-1-e])return!1;return!0},rr.prototype.peekType=function(t){return void 0===t&&(t=0),_[this.input.charCodeAt(this.p+t)]},rr.prototype.peek=function(t){return void 0===t&&(t=0),this.input[this.p+t]},rr.prototype.skipBlank=function(){for(;this.peekType()&V;)++this.p},rr);function rr(t,e,r){void 0===r&&(r=""),this.input=t,this.trie=e,this.file=r,this.p=0,this.rawBeginAt=-1,this.N=t.length}var nr,ir=(t(sr,nr=ye),sr);function sr(t,e,r,n,i){var s=this,o=n.trimTagLeft,a=n.trimTagRight,u=n.tagDelimiterLeft,c=n.tagDelimiterRight,l=t.slice(e+u.length,r-c.length);s=nr.call(this,p.TokenKind.Tag,l,t,e,r,o,a,i)||this;var h=new er(s.content,n.operatorsTrie);if(s.name=h.readIdentifier().getText(),!s.name)throw new $("illegal tag syntax",s);return h.skipBlank(),s.args=h.remaining(),s}var or=(ar.prototype.render=function(e){var r,n,i,s,o,a,u,c,l,h;return q(this,function(t){switch(t.label){case 0:r={},t.label=1;case 1:t.trys.push([1,8,9,10]),n=O(Object.keys(this.hash)),i=n.next(),t.label=2;case 2:return i.done?[3,7]:(s=i.value,o=r,a=s,void 0!==this.hash[s]?[3,3]:(u=!0,[3,5]));case 3:return[4,pe(this.hash[s],e)];case 4:u=t.sent(),t.label=5;case 5:o[a]=u,t.label=6;case 6:return i=n.next(),[3,2];case 7:return[3,10];case 8:return c=t.sent(),l={error:c},[3,10];case 9:try{i&&!i.done&&(h=n.return)&&h.call(n)}finally{if(l)throw l.error}return[7];case 10:return[2,r]}})},ar);function ar(t){var e,r;this.hash={};var n=new er(t,{});try{for(var i=O(n.readHashes()),s=i.next();!s.done;s=i.next()){var o=s.value;this.hash[o.name.content]=o.value}}catch(t){e={error:t}}finally{try{s&&!s.done&&(r=i.return)&&r.call(i)}finally{if(e)throw e.error}}}var ur=(cr.prototype.render=function(t,e){var r,n,i=[];try{for(var s=O(this.args),o=s.next();!o.done;o=s.next()){var a=o.value;d(a)?i.push([a[0],pe(a[1],e)]):i.push(pe(a,e))}}catch(t){r={error:t}}finally{try{o&&!o.done&&(n=s.return)&&n.call(s)}finally{if(r)throw r.error}}return this.impl.apply({context:e,liquid:this.liquid},w([t],i))},cr);function cr(t,e,r,n){this.name=t,this.impl=e||F,this.args=r,this.liquid=n}var lr=(hr.prototype.value=function(e,r){var n,i,s,o,a,u;return q(this,function(t){switch(t.label){case 0:return r=r||e.opts.lenientIf&&0<this.filters.length&&"default"===this.filters[0].name,[4,this.initial.evaluate(e,r)];case 1:n=t.sent(),t.label=2;case 2:t.trys.push([2,7,8,9]),i=O(this.filters),s=i.next(),t.label=3;case 3:return s.done?[3,6]:[4,s.value.render(n,e)];case 4:n=t.sent(),t.label=5;case 5:return s=i.next(),[3,3];case 6:return[3,9];case 7:return o=t.sent(),a={error:o},[3,9];case 8:try{s&&!s.done&&(u=i.return)&&u.call(i)}finally{if(a)throw a.error}return[7];case 9:return[2,n]}})},hr);function hr(t,n){this.filters=[];var e=new er(t,n.options.operatorsTrie);this.initial=e.readExpression(),this.filters=e.readFilters().map(function(t){var e=t.name,r=t.args;return new ur(e,n.filters.get(e),r,n)})}var pr,fr=(t(dr,pr=Wt),dr.prototype.render=function(e,r){var n,i;return q(this,function(t){switch(t.label){case 0:return[4,new or(this.token.args).render(e)];case 1:return n=t.sent(),u((i=this.impl).render)?[4,i.render(e,r,n)]:[3,3];case 2:return[2,t.sent()];case 3:return[2]}})},dr);function dr(t,e,r){var n=pr.call(this,t)||this;n.name=t.name;var i=r.tags.get(t.name);return n.impl=Object.create(i),n.impl.liquid=r,n.impl.parse&&n.impl.parse(t,e),n}var vr,gr=(t(yr,vr=Wt),yr.prototype.render=function(e,r){var n;return q(this,function(t){switch(t.label){case 0:return[4,this.value.value(e,!1)];case 1:return n=t.sent(),r.write(n),[2]}})},yr);function yr(t,e){var r=vr.call(this,t)||this;return r.value=new lr(t.content,e),r}var mr,wr=(t(br,mr=Wt),br.prototype.render=function(t,e){return q(this,function(t){return e.write(this.str),[2]})},br);function br(t){var e=mr.call(this,t)||this;return e.str=t.getContent(),e}var Tr=(kr.prototype.parse=function(t,e){var r=new er(t,this.liquid.options.operatorsTrie,e).readTopLevelTokens(this.liquid.options);return this.parseTokens(r)},kr.prototype.parseTokens=function(t){for(var e,r=[];e=t.shift();)r.push(this.parseToken(e,t));return r},kr.prototype.parseToken=function(e,t){try{return It(e)?new fr(e,t,this.liquid):At(e)?new gr(e,this.liquid):new wr(e)}catch(t){throw new X(t,e)}},kr.prototype.parseStream=function(t){var r=this;return new Ut(t,function(t,e){return r.parseToken(t,e)})},kr.prototype._parseFileCached=function(e,r,n,i){var s,o,a;return void 0===n&&(n=pt.Root),q(this,function(t){switch(t.label){case 0:return s=this.loader.shouldLoadRelative(e)?i+","+e:n+":"+e,[4,this.cache.read(s)];case 1:if(o=t.sent())return[2,o];a=qt(this._parseFile(e,r,n,i)),this.cache.write(s,a),t.label=2;case 2:return t.trys.push([2,4,,5]),[4,a];case 3:return[2,t.sent()];case 4:return t.sent(),this.cache.remove(s),[3,5];case 5:return[2]}})},kr.prototype._parseFile=function(e,r,n,i){var s,o,a,u;return void 0===n&&(n=pt.Root),q(this,function(t){switch(t.label){case 0:return[4,this.loader.lookup(e,n,r,i)];case 1:return s=t.sent(),a=(o=this.liquid).parse,r?(u=this.fs.readFileSync(s),[3,4]):[3,2];case 2:return[4,this.fs.readFile(s)];case 3:u=t.sent(),t.label=4;case 4:return[2,a.apply(o,[u,s])]}})},kr);function kr(t){this.liquid=t,this.cache=this.liquid.options.cache,this.fs=this.liquid.options.fs,this.parseFile=this.cache?this._parseFileCached:this._parseFile,this.loader=new yt(this.liquid.options)}var xr={parse:function(t){var e=new er(t.args,this.liquid.options.operatorsTrie);this.key=e.readIdentifier().content,e.skipBlank(),gt("="===e.peek(),function(){return"illegal token "+t.getText()}),e.advance(),this.value=e.remaining()},render:function(e){var r,n;return q(this,function(t){switch(t.label){case 0:return r=e.bottom(),n=this.key,[4,this.liquid._evalValue(this.value,e)];case 1:return r[n]=t.sent(),[2]}})}};function qr(e){return d(e)?e:a(e)&&0<e.length?[e]:y(e)?Object.keys(e).map(function(t){return[t,e[t]]}):[]}function Or(t){return d(t)?t:[t]}var Fr,Rr=(t(Sr,Fr=s),Sr.prototype.next=function(){this.i++},Sr.prototype.index0=function(){return this.i},Sr.prototype.index=function(){return this.i+1},Sr.prototype.first=function(){return 0===this.i},Sr.prototype.last=function(){return this.i===this.length-1},Sr.prototype.rindex=function(){return this.length-this.i},Sr.prototype.rindex0=function(){return this.length-this.i-1},Sr.prototype.valueOf=function(){return JSON.stringify(this)},Sr);function Sr(t,e,r){var n=Fr.call(this)||this;return n.i=0,n.length=t,n.name=r+"-"+e,n}var Er=["offset","limit","reversed"],Lr={type:"block",parse:function(t,e){var r,n=this,i=new er(t.args,this.liquid.options.operatorsTrie),s=i.readIdentifier(),o=i.readIdentifier(),a=i.readValue();gt(s.size()&&"in"===o.content&&a,function(){return"illegal tag: "+t.getText()}),this.variable=s.content,this.collection=a,this.hash=new or(i.remaining()),this.templates=[],this.elseTemplates=[];var u=this.liquid.parser.parseStream(e).on("start",function(){return r=n.templates}).on("tag:else",function(){return r=n.elseTemplates}).on("tag:endfor",function(){return u.stop()}).on("template",function(t){return r.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")});u.start()},render:function(e,r){var n,i,s,o,a,u,c,l,h,p,f,d;return q(this,function(t){switch(t.label){case 0:return n=this.liquid.renderer,s=qr,[4,pe(this.collection,e)];case 1:return(i=s.apply(void 0,[t.sent()])).length?[3,3]:[4,n.renderTemplates(this.elseTemplates,e,r)];case 2:return t.sent(),[2];case 3:return[4,this.hash.render(e)];case 4:o=t.sent(),a=this.liquid.options.orderedFilterParameters?Object.keys(o).filter(function(t){return Er.includes(t)}):Er.filter(function(t){return void 0!==o[t]}),i=a.reduce(function(t,e){return"offset"===e?function(t,e){return t.slice(e)}(t,o.offset):"limit"===e?function(t,e){return t.slice(0,e)}(t,o.limit):function(t){return w(t).reverse()}(t)},i),u={forloop:new Rr(i.length,this.collection.getText(),this.variable)},e.push(u),t.label=5;case 5:t.trys.push([5,10,11,12]),c=O(i),l=c.next(),t.label=6;case 6:return l.done?[3,9]:(h=l.value,u[this.variable]=h,[4,n.renderTemplates(this.templates,e,r)]);case 7:if(t.sent(),r.break)return r.break=!1,[3,9];r.continue=!1,u.forloop.next(),t.label=8;case 8:return l=c.next(),[3,6];case 9:return[3,12];case 10:return p=t.sent(),f={error:p},[3,12];case 11:try{l&&!l.done&&(d=c.return)&&d.call(c)}finally{if(f)throw f.error}return[7];case 12:return e.pop(),[2]}})}};var Pr={parse:function(t,e){var r=this,n=new er(t.args,this.liquid.options.operatorsTrie);this.variable=function(t){var e=t.readIdentifier().content;if(e)return e;var r=t.readQuoted();if(r)return fe(r)}(n),gt(this.variable,function(){return t.args+" not valid identifier"}),this.templates=[];var i=this.liquid.parser.parseStream(e);i.on("tag:endcapture",function(){return i.stop()}).on("template",function(t){return r.templates.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}),i.start()},render:function(e){var r;return q(this,function(t){switch(t.label){case 0:return[4,this.liquid.renderer.renderTemplates(this.templates,e)];case 1:return r=t.sent(),e.bottom()[this.variable]=r,[2]}})}};var Dr,Nr,Mr={parse:function(t,e){var n=this;this.cond=new lr(t.args,this.liquid),this.cases=[],this.elseTemplates=[];var i=[],r=this.liquid.parser.parseStream(e).on("tag:when",function(t){i=[];for(var e=new er(t.args,n.liquid.options.operatorsTrie);!e.end();){var r=e.readValue();n.cases.push({val:r,templates:i}),e.readTo(",")}}).on("tag:else",function(){return i=n.elseTemplates}).on("tag:endcase",function(){return r.stop()}).on("template",function(t){return i.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")});r.start()},render:function(e,r){var n,i,s,o,a,u,c,l,h;return q(this,function(t){switch(t.label){case 0:return n=this.liquid.renderer,s=f,[4,this.cond.value(e,e.opts.lenientIf)];case 1:i=s.apply(void 0,[t.sent()]),t.label=2;case 2:t.trys.push([2,7,8,9]),o=O(this.cases),a=o.next(),t.label=3;case 3:return a.done?[3,6]:(u=a.value,pe(u.val,e,e.opts.lenientIf)!==i?[3,5]:[4,n.renderTemplates(u.templates,e,r)]);case 4:return t.sent(),[2];case 5:return a=o.next(),[3,3];case 6:return[3,9];case 7:return c=t.sent(),l={error:c},[3,9];case 8:try{a&&!a.done&&(h=o.return)&&h.call(o)}finally{if(l)throw l.error}return[7];case 9:return[4,n.renderTemplates(this.elseTemplates,e,r)];case 10:return t.sent(),[2]}})}},Ar={parse:function(t,e){var r=this.liquid.parser.parseStream(e);r.on("token",function(t){"endcomment"===t.name&&r.stop()}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}),r.start()}};(Nr=Dr=Dr||{})[Nr.OUTPUT=0]="OUTPUT",Nr[Nr.STORE=1]="STORE";var Ir=Dr,zr={parseFilePath:_r,renderFilePath:jr,parse:function(t){var e=t.args,r=new er(e,this.liquid.options.operatorsTrie);for(this.file=this.parseFilePath(r,this.liquid),this.currentFile=t.file;!r.end();){r.skipBlank();var n=r.p,i=r.readIdentifier();if(("with"===i.content||"for"===i.content)&&(r.skipBlank(),":"!==r.peek())){var s=r.readValue();if(s){var o=r.p,a=void 0;"as"===r.readIdentifier().content?a=r.readIdentifier():r.p=o,this[i.content]={value:s,alias:a&&a.content},r.skipBlank(),","===r.peek()&&r.advance();continue}}r.p=n;break}this.hash=new or(r.remaining())},render:function(e,r){var n,i,s,o,a,u,c,l,h,p,f,d,v,g,y,m,w,b,T,k;return q(this,function(t){switch(t.label){case 0:return i=(n=this).liquid,s=n.hash,[4,this.renderFilePath(this.file,e,i)];case 1:return gt(o=t.sent(),function(){return'illegal filename "'+o+'"'}),a=new dt({},e.opts,e.sync),u=a.bottom(),c=x,l=[u],[4,s.render(e)];case 2:if(c.apply(void 0,l.concat([t.sent()])),this.with&&(h=this.with,f=h.value,d=h.alias,u[d||o]=pe(f,e)),!this.for)return[3,12];p=this.for,f=p.value,d=p.alias,v=qr(v=pe(f,e)),u.forloop=new Rr(v.length,f.getText(),d),t.label=3;case 3:t.trys.push([3,9,10,11]),g=O(v),y=g.next(),t.label=4;case 4:return y.done?[3,8]:(m=y.value,u[d]=m,[4,i._parsePartialFile(o,a.sync,this.currentFile)]);case 5:return b=t.sent(),[4,i.renderer.renderTemplates(b,a,r)];case 6:t.sent(),u.forloop.next(),t.label=7;case 7:return y=g.next(),[3,4];case 8:return[3,11];case 9:return w=t.sent(),T={error:w},[3,11];case 10:try{y&&!y.done&&(k=g.return)&&k.call(g)}finally{if(T)throw T.error}return[7];case 11:return[3,15];case 12:return[4,i._parsePartialFile(o,a.sync,this.currentFile)];case 13:return b=t.sent(),[4,i.renderer.renderTemplates(b,a,r)];case 14:t.sent(),t.label=15;case 15:return[2]}})}};function _r(t,e){if(e.options.dynamicPartials){var r=t.readValue();if(void 0===r)throw new TypeError('illegal argument "'+t.input+'"');if("none"===r.getText())return null;if(zt(r)){var n=e.parse(fe(r));return 1===n.length&&Mt(n[0].token)?n[0].token.getContent():n}return r}var i=t.readFileName().getText();return"none"===i?null:i}function jr(t,e,r){return"string"==typeof t?t:Array.isArray(t)?r.renderer.renderTemplates(t,e):pe(t,e)}var Vr,Br={parseFilePath:_r,renderFilePath:jr,parse:function(t){var e=t.args,r=new er(e,this.liquid.options.operatorsTrie);this.file=this.parseFilePath(r,this.liquid),this.currentFile=t.file;var n=r.p;"with"===r.readIdentifier().content?(r.skipBlank(),":"!==r.peek()?this.withVar=r.readValue():r.p=n):r.p=n,this.hash=new or(r.remaining())},render:function(e,r){var n,i,s,o,a,u,c,l,h;return q(this,function(t){switch(t.label){case 0:return i=(n=this).liquid,s=n.hash,o=n.withVar,a=i.renderer,[4,this.renderFilePath(this.file,e,i)];case 1:return gt(u=t.sent(),function(){return'illegal filename "'+u+'"'}),c=e.saveRegister("blocks","blockMode"),e.setRegister("blocks",{}),e.setRegister("blockMode",Ir.OUTPUT),[4,s.render(e)];case 2:return l=t.sent(),o&&(l[u]=pe(o,e)),[4,i._parsePartialFile(u,e.sync,this.currentFile)];case 3:return h=t.sent(),e.push(l),[4,a.renderTemplates(h,e,r)];case 4:return t.sent(),e.pop(),e.restoreRegister(c),[2]}})}},Cr={parse:function(t){var e=new er(t.args,this.liquid.options.operatorsTrie);this.variable=e.readIdentifier().content},render:function(t,e){var r=t.environments;l(r[this.variable])||(r[this.variable]=0),e.write(c(--r[this.variable]))}},Hr={parse:function(t){var e=new er(t.args,this.liquid.options.operatorsTrie),r=e.readValue();for(e.skipBlank(),this.candidates=[],r&&(":"===e.peek()?(this.group=r,e.advance()):this.candidates.push(r));!e.end();){var n=e.readValue();n&&this.candidates.push(n),e.readTo(",")}gt(this.candidates.length,function(){return"empty candidates: "+t.getText()})},render:function(t,e){var r="cycle:"+pe(this.group,t)+":"+this.candidates.join(","),n=t.getRegister("cycle"),i=n[r];void 0===i&&(i=n[r]=0);var s=this.candidates[i];i=(i+1)%this.candidates.length,n[r]=i;var o=pe(s,t);e.write(o)}},Kr={parse:function(t,e){var r,n=this;this.branches=[],this.elseTemplates=[],this.liquid.parser.parseStream(e).on("start",function(){return n.branches.push({predicate:new lr(t.args,n.liquid),templates:r=[]})}).on("tag:elsif",function(t){return n.branches.push({predicate:new lr(t.args,n.liquid),templates:r=[]})}).on("tag:else",function(){return r=n.elseTemplates}).on("tag:endif",function(){this.stop()}).on("template",function(t){return r.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}).start()},render:function(e,r){var n,i,s,o,a,u,c,l,h;return q(this,function(t){switch(t.label){case 0:n=this.liquid.renderer,t.label=1;case 1:t.trys.push([1,7,8,9]),i=O(this.branches),s=i.next(),t.label=2;case 2:return s.done?[3,6]:(o=s.value,a=o.predicate,u=o.templates,[4,a.value(e,e.opts.lenientIf)]);case 3:return A(t.sent(),e)?[4,n.renderTemplates(u,e,r)]:[3,5];case 4:return t.sent(),[2];case 5:return s=i.next(),[3,2];case 6:return[3,9];case 7:return c=t.sent(),l={error:c},[3,9];case 8:try{s&&!s.done&&(h=i.return)&&h.call(i)}finally{if(l)throw l.error}return[7];case 9:return[4,n.renderTemplates(this.elseTemplates,e,r)];case 10:return t.sent(),[2]}})}},Ur={parse:function(t){var e=new er(t.args,this.liquid.options.operatorsTrie);this.variable=e.readIdentifier().content},render:function(t,e){var r=t.environments;l(r[this.variable])||(r[this.variable]=0);var n=r[this.variable];r[this.variable]++,e.write(c(n))}},Qr={parseFilePath:_r,renderFilePath:jr,parse:function(t,e){var r=new er(t.args,this.liquid.options.operatorsTrie);this.file=this.parseFilePath(r,this.liquid),this.currentFile=t.file,this.hash=new or(r.remaining()),this.tpls=this.liquid.parser.parseTokens(e)},render:function(e,r){var n,i,s,o,a,u,c,l,h,p,f;return q(this,function(t){switch(t.label){case 0:return i=(n=this).liquid,s=n.hash,o=n.file,a=i.renderer,null!==o?[3,2]:(e.setRegister("blockMode",Ir.OUTPUT),[4,a.renderTemplates(this.tpls,e,r)]);case 1:return t.sent(),[2];case 2:return[4,this.renderFilePath(this.file,e,i)];case 3:return gt(u=t.sent(),function(){return'illegal filename "'+u+'"'}),[4,i._parseLayoutFile(u,e.sync,this.currentFile)];case 4:return c=t.sent(),e.setRegister("blockMode",Ir.STORE),[4,a.renderTemplates(this.tpls,e)];case 5:return l=t.sent(),void 0===(h=e.getRegister("blocks"))[""]&&(h[""]=function(t,e){return e.write(l)}),e.setRegister("blockMode",Ir.OUTPUT),f=(p=e).push,[4,s.render(e)];case 6:return f.apply(p,[t.sent()]),[4,a.renderTemplates(c,e,r)];case 7:return t.sent(),e.pop(),[2]}})}},Wr=(t(Jr,Vr=s),Jr.prototype.super=function(){return this.superBlockRender()},Jr);function Jr(t){void 0===t&&(t=function(){return""});var e=Vr.call(this)||this;return e.superBlockRender=t,e}var $r,Yr={parse:function(t,e){var r=this,n=/\w+/.exec(t.args);this.block=n?n[0]:"",this.tpls=[],this.liquid.parser.parseStream(e).on("tag:endblock",function(){this.stop()}).on("template",function(t){return r.tpls.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}).start()},render:function(e,r){var n;return q(this,function(t){switch(t.label){case 0:return n=this.getBlockRender(e),e.getRegister("blockMode")!==Ir.STORE?[3,1]:(e.getRegister("blocks")[this.block]=n,[3,3]);case 1:return[4,n(new Wr,r)];case 2:t.sent(),t.label=3;case 3:return[2]}})},getBlockRender:function(n){function r(e,r){return q(this,function(t){switch(t.label){case 0:return n.push({block:e}),[4,i.renderer.renderTemplates(s,n,r)];case 1:return t.sent(),n.pop(),[2]}})}var i=this.liquid,s=this.tpls,o=n.getRegister("blocks")[this.block];return o?function(t,e){return o(new Wr(function(){return r(t,e)}),e)}:r}},Gr={parse:function(t,e){var r=this;this.tokens=[];var n=this.liquid.parser.parseStream(e);n.on("token",function(t){"endraw"===t.name?n.stop():r.tokens.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}),n.start()},render:function(){return this.tokens.map(function(t){return t.getText()}).join("")}},Xr=(t(Zr,$r=Rr),Zr.prototype.row=function(){return Math.floor(this.i/this.cols)+1},Zr.prototype.col0=function(){return this.i%this.cols},Zr.prototype.col=function(){return this.col0()+1},Zr.prototype.col_first=function(){return 0===this.col0()},Zr.prototype.col_last=function(){return this.col()===this.cols},Zr);function Zr(t,e,r,n){var i=$r.call(this,t,r,n)||this;return i.length=t,i.cols=e,i}var tn={assign:xr,for:Lr,capture:Pr,case:Mr,comment:Ar,include:Br,render:zr,decrement:Cr,increment:Ur,cycle:Hr,if:Kr,layout:Qr,block:Yr,raw:Gr,tablerow:{parse:function(t,e){var r=this,n=new er(t.args,this.liquid.options.operatorsTrie),i=n.readIdentifier();n.skipBlank();var s,o=n.readIdentifier();gt(o&&"in"===o.content,function(){return"illegal tag: "+t.getText()}),this.variable=i.content,this.collection=n.readValue(),this.hash=new or(n.remaining()),this.templates=[];var a=this.liquid.parser.parseStream(e).on("start",function(){return s=r.templates}).on("tag:endtablerow",function(){return a.stop()}).on("template",function(t){return s.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")});a.start()},render:function(e,r){var n,i,s,o,a,u,c,l,h,p;return q(this,function(t){switch(t.label){case 0:return i=qr,[4,pe(this.collection,e)];case 1:return n=i.apply(void 0,[t.sent()]),[4,this.hash.render(e)];case 2:s=t.sent(),o=s.offset||0,a=void 0===s.limit?n.length:s.limit,n=n.slice(o,o+a),u=s.cols||n.length,c=this.liquid.renderer,l=new Xr(n.length,u,this.collection.getText(),this.variable),h={tablerowloop:l},e.push(h),p=0,t.label=3;case 3:return p<n.length?(h[this.variable]=n[p],0===l.col0()&&(1!==l.row()&&r.write("</tr>"),r.write('<tr class="row'+l.row()+'">')),r.write('<td class="col'+l.col()+'">'),[4,c.renderTemplates(this.templates,e,r)]):[3,6];case 4:t.sent(),r.write("</td>"),t.label=5;case 5:return p++,l.next(),[3,3];case 6:return n.length&&r.write("</tr>"),e.pop(),[2]}})}},unless:{parse:function(t,e){var r,n=this;this.branches=[],this.elseTemplates=[],this.liquid.parser.parseStream(e).on("start",function(){return n.branches.push({predicate:new lr(t.args,n.liquid),test:I,templates:r=[]})}).on("tag:elsif",function(t){return n.branches.push({predicate:new lr(t.args,n.liquid),test:A,templates:r=[]})}).on("tag:else",function(){return r=n.elseTemplates}).on("tag:endunless",function(){this.stop()}).on("template",function(t){return r.push(t)}).on("end",function(){throw new Error("tag "+t.getText()+" not closed")}).start()},render:function(e,r){var n,i,s,o,a,u,c,l,h,p,f;return q(this,function(t){switch(t.label){case 0:n=this.liquid.renderer,t.label=1;case 1:t.trys.push([1,7,8,9]),i=O(this.branches),s=i.next(),t.label=2;case 2:return s.done?[3,6]:(o=s.value,a=o.predicate,u=o.test,c=o.templates,[4,a.value(e,e.opts.lenientIf)]);case 3:return l=t.sent(),u(l,e)?[4,n.renderTemplates(c,e,r)]:[3,5];case 4:return t.sent(),[2];case 5:return s=i.next(),[3,2];case 6:return[3,9];case 7:return h=t.sent(),p={error:h},[3,9];case 8:try{s&&!s.done&&(f=i.return)&&f.call(i)}finally{if(p)throw p.error}return[7];case 9:return[4,n.renderTemplates(this.elseTemplates,e,r)];case 10:return t.sent(),[2]}})}},break:{render:function(t,e){e.break=!0}},continue:{render:function(t,e){e.continue=!0}}},en={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&#34;","'":"&#39;"},rn={"&amp;":"&","&lt;":"<","&gt;":">","&#34;":'"',"&#39;":"'"};function nn(t){return c(t).replace(/&|<|>|"|'/g,function(t){return en[t]})}var sn=Math.abs,on=Math.max,an=Math.min,un=Math.ceil,cn=Math.floor;var ln=/%([-_0^#:]+)?(\d+)?([EO])?(.)/,hn=["January","February","March","April","May","June","July","August","September","October","November","December"],pn=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],fn=hn.map(gn),dn=pn.map(gn),vn={1:"st",2:"nd",3:"rd",default:"th"};function gn(t){return t.slice(0,3)}function yn(t){for(var e=0,r=0;r<t.getMonth();++r)e+=[31,function(t){var e=t.getFullYear();return!(0!=(3&e)||!(e%100||e%400==0&&e))}(t)?29:28,31,30,31,30,31,31,30,31,30,31][r];return e+t.getDate()}function mn(t,e){var r=yn(t)+(e-t.getDay()),n=7-new Date(t.getFullYear(),0,1).getDay()+e;return String(Math.floor((r-n)/7)+1)}var wn={d:2,e:2,H:2,I:2,j:3,k:2,l:2,L:3,m:2,M:2,S:2,U:2,W:2},bn={a:" ",A:" ",b:" ",B:" ",c:" ",e:" ",k:" ",l:" ",p:" ",P:" "},Tn={a:function(t){return dn[t.getDay()]},A:function(t){return pn[t.getDay()]},b:function(t){return fn[t.getMonth()]},B:function(t){return hn[t.getMonth()]},c:function(t){return t.toLocaleString()},C:function(t){return function(t){return parseInt(t.getFullYear().toString().substring(0,2),10)}(t)},d:function(t){return t.getDate()},e:function(t){return t.getDate()},H:function(t){return t.getHours()},I:function(t){return String(t.getHours()%12||12)},j:function(t){return yn(t)},k:function(t){return t.getHours()},l:function(t){return String(t.getHours()%12||12)},L:function(t){return t.getMilliseconds()},m:function(t){return t.getMonth()+1},M:function(t){return t.getMinutes()},N:function(t,e){var r=Number(e.width)||9;return function(t,e,r){return void 0===r&&(r=" "),k(t,e,r,function(t,e){return t+e})}(String(t.getMilliseconds()).substr(0,r),r,"0")},p:function(t){return t.getHours()<12?"AM":"PM"},P:function(t){return t.getHours()<12?"am":"pm"},q:function(t){return function(t){var e=t.getDate().toString(),r=parseInt(e.slice(-1));return vn[r]||vn.default}(t)},s:function(t){return Math.round(t.valueOf()/1e3)},S:function(t){return t.getSeconds()},u:function(t){return t.getDay()||7},U:function(t){return mn(t,0)},w:function(t){return t.getDay()},W:function(t){return mn(t,1)},x:function(t){return t.toLocaleDateString()},X:function(t){return t.toLocaleTimeString()},y:function(t){return t.getFullYear().toString().substring(2,4)},Y:function(t){return t.getFullYear()},z:function(t,e){var r=Math.abs(t.getTimezoneOffset()),n=Math.floor(r/60),i=r%60;return(0<t.getTimezoneOffset()?"-":"+")+T(n,2,"0")+(e.flags[":"]?":":"")+T(i,2,"0")},t:function(){return"\t"},n:function(){return"\n"},"%":function(){return"%"}};function kn(t,e){var r,n,i=m(e,5),s=i[0],o=i[1],a=void 0===o?"":o,u=i[2],c=i[3],l=i[4],h=Tn[l];if(!h)return s;var p={};try{for(var f=O(a),d=f.next();!d.done;d=f.next()){p[d.value]=!0}}catch(t){r={error:t}}finally{try{d&&!d.done&&(n=f.return)&&n.call(f)}finally{if(r)throw r.error}}var v=String(h(t,{flags:p,width:u,modifier:c})),g=bn[l]||"0",y=u||wn[l]||0;return p["^"]?v=v.toUpperCase():p["#"]&&(v=function(t){return w(t).some(function(t){return"a"<=t&&t<="z"})?t.toUpperCase():t.toLowerCase()}(v)),p._?g=" ":p[0]&&(g="0"),p["-"]&&(y=0),T(v,y,g)}Tn.h=Tn.b;var xn,qn=(new Date).getTimezoneOffset(),On=/([zZ]|([+-])(\d{2}):(\d{2}))$/,Fn=(t(Rn,xn=Date),Rn.prototype.getTimezoneOffset=function(){return this.timezoneOffset},Rn.createDateFixedToTimezone=function(t){var e=t.match(On);if(e&&"Z"===e[1])return new Rn(+new Date(t),0);if(e&&e[2]&&e[3]&&e[4]){var r=m(e,5),n=r[2],i=r[3],s=r[4],o=("+"===n?-1:1)*(60*parseInt(i,10)+parseInt(s,10));return new Rn(+new Date(t),o)}return new Date(t)},Rn);function Rn(t,e){var r=this;if(t instanceof Rn)return t;var n=6e4*(qn-e),i=new Date(t).getTime()+n;return(r=xn.call(this,i)||this).timezoneOffset=e,r}var Sn=Object.freeze({escape:nn,escapeOnce:function(t){return nn(function(t){return String(t).replace(/&(amp|lt|gt|#34|#39);/g,function(t){return rn[t]})}(t))},newlineToBr:function(t){return t.replace(/\n/g,"<br />\n")},stripHtml:function(t){return t.replace(/<script.*?<\/script>|<!--.*?-->|<style.*?<\/style>|<.*?>/g,"")},abs:sn,atLeast:on,atMost:an,ceil:un,dividedBy:function(t,e){return t/e},floor:cn,minus:function(t,e){return t-e},modulo:function(t,e){return t%e},times:function(t,e){return t*e},round:function(t,e){void 0===e&&(e=0);var r=Math.pow(10,e);return Math.round(t*r)/r},plus:function(t,e){return Number(t)+Number(e)},sortNatural:function(t,r){return t&&t.sort?void 0!==r?w(t).sort(function(t,e){return S(t[r],e[r])}):w(t).sort(S):[]},urlDecode:function(t){return t.split("+").map(decodeURIComponent).join(" ")},urlEncode:function(t){return t.split(" ").map(encodeURIComponent).join("+")},join:function(t,e){return t.join(void 0===e?" ":e)},last:function(t){return d(t)?g(t):""},first:function(t){return d(t)?t[0]:""},reverse:function(t){return w(t).reverse()},sort:function(t,e){function r(t){return e?n.context.getFromScope(t,e.split(".")):t}var n=this;return Or(t).sort(function(t,e){return(t=r(t))<(e=r(e))?-1:e<t?1:0})},size:function(t){return t&&t.length||0},map:function(t,e){var r=this;return Or(t).map(function(t){return r.context.getFromScope(t,e.split("."))})},compact:function(t){return Or(t).filter(function(t){return!h(t)})},concat:function(t,e){return Or(t).concat(e)},slice:function(t,e,r){return void 0===r&&(r=1),e=e<0?t.length+e:e,t.slice(e,e+r)},where:function(t,r,n){var i=this;return Or(t).filter(function(t){var e=i.context.getFromScope(t,String(r).split("."));return void 0===n?A(e,i.context):e===n})},uniq:function(t){var e={};return(t||[]).filter(function(t){return!e.hasOwnProperty(String(t))&&(e[String(t)]=!0)})},date:function(t,e){var r,n=this.context.opts;return function(t){return t instanceof Date&&!isNaN(t.getTime())}(r="now"===t||"today"===t?new Date:l(t)?new Date(1e3*t):a(t)?/^\d+$/.test(t)?new Date(1e3*+t):n.preserveTimezones?Fn.createDateFixedToTimezone(t):new Date(t):t)?(n.hasOwnProperty("timezoneOffset")&&(r=new Fn(r,n.timezoneOffset)),function(t,e){for(var r,n="",i=e;r=ln.exec(i);)n+=i.slice(0,r.index),i=i.slice(r.index+r[0].length),n+=kn(t,r);return n+i}(r,e)):t},Default:function(t,e){return d(t)||a(t)?t.length?t:e:I(f(t),this.context)?e:t},json:function(t){return JSON.stringify(t)},append:function(t,e){return gt(2===arguments.length,"append expect 2 arguments"),c(t)+c(e)},prepend:function(t,e){return gt(2===arguments.length,"prepend expect 2 arguments"),c(e)+c(t)},lstrip:function(t){return c(t).replace(/^\s+/,"")},downcase:function(t){return c(t).toLowerCase()},upcase:function(t){return c(t).toUpperCase()},remove:function(t,e){return c(t).split(String(e)).join("")},removeFirst:function(t,e){return c(t).replace(String(e),"")},rstrip:function(t){return c(t).replace(/\s+$/,"")},split:function(t,e){return c(t).split(String(e))},strip:function(t){return c(t).trim()},stripNewlines:function(t){return c(t).replace(/\n/g,"")},capitalize:function(t){return(t=c(t)).charAt(0).toUpperCase()+t.slice(1).toLowerCase()},replace:function(t,e,r){return c(t).split(String(e)).join(r)},replaceFirst:function(t,e,r){return c(t).replace(String(e),r)},truncate:function(t,e,r){return void 0===e&&(e=50),void 0===r&&(r="..."),(t=c(t)).length<=e?t:t.substr(0,e-r.length)+r},truncatewords:function(t,e,r){void 0===e&&(e=15),void 0===r&&(r="...");var n=t.split(/\s+/),i=n.slice(0,e).join(" ");return n.length>=e&&(i+=r),i}}),En=(Ln.prototype.get=function(t){var e=this.impls[t];return gt(e,function(){return'tag "'+t+'" not found'}),e},Ln.prototype.set=function(t,e){this.impls[t]=e},Ln);function Ln(){this.impls={}}var Pn=(Dn.prototype.get=function(t){var e=this.impls[t];return gt(e||!this.strictFilters,function(){return"undefined filter: "+t}),e},Dn.prototype.set=function(t,e){this.impls[t]=e},Dn.prototype.create=function(t,e){return new ur(t,this.get(t),e,this.liquid)},Dn);function Dn(t,e){this.strictFilters=t,this.liquid=e,this.impls={}}var Nn=(Mn.prototype.parse=function(t,e){return this.parser.parse(t,e)},Mn.prototype._render=function(t,e,r){var n=new dt(e,this.options,r);return this.renderer.renderTemplates(t,n)},Mn.prototype.render=function(e,r){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,Ot(this._render(e,r,!1))]})})},Mn.prototype.renderSync=function(t,e){return Ft(this._render(t,e,!0))},Mn.prototype.renderToNodeStream=function(t,e){var r=new dt(e,this.options);return this.renderer.renderTemplatesToNodeStream(t,r)},Mn.prototype._parseAndRender=function(t,e,r){var n=this.parse(t);return this._render(n,e,r)},Mn.prototype.parseAndRender=function(e,r){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,Ot(this._parseAndRender(e,r,!1))]})})},Mn.prototype.parseAndRenderSync=function(t,e){return Ft(this._parseAndRender(t,e,!0))},Mn.prototype._parsePartialFile=function(t,e,r){return this.parser.parseFile(t,e,pt.Partials,r)},Mn.prototype._parseLayoutFile=function(t,e,r){return this.parser.parseFile(t,e,pt.Layouts,r)},Mn.prototype.parseFile=function(e){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,Ot(this.parser.parseFile(e,!1))]})})},Mn.prototype.parseFileSync=function(t){return Ft(this.parser.parseFile(t,!0))},Mn.prototype.renderFile=function(r,n){return i(this,void 0,void 0,function(){var e;return q(this,function(t){switch(t.label){case 0:return[4,this.parseFile(r)];case 1:return e=t.sent(),[2,this.render(e,n)]}})})},Mn.prototype.renderFileSync=function(t,e){var r=this.parseFileSync(t);return this.renderSync(r,e)},Mn.prototype.renderFileToNodeStream=function(r,n){return i(this,void 0,void 0,function(){var e;return q(this,function(t){switch(t.label){case 0:return[4,this.parseFile(r)];case 1:return e=t.sent(),[2,this.renderToNodeStream(e,n)]}})})},Mn.prototype._evalValue=function(t,e){return new lr(t,this).value(e,!1)},Mn.prototype.evalValue=function(e,r){return i(this,void 0,void 0,function(){return q(this,function(t){return[2,Ot(this._evalValue(e,r))]})})},Mn.prototype.evalValueSync=function(t,e){return Ft(this._evalValue(t,e))},Mn.prototype.registerFilter=function(t,e){this.filters.set(t,e)},Mn.prototype.registerTag=function(t,e){this.tags.set(t,e)},Mn.prototype.plugin=function(t){return t.call(this,Mn)},Mn.prototype.express=function(){var a=this,u=!0;return function(t,e,r){var n,i,s;if(u){u=!1;var o=K(this.root);(n=a.options.root).unshift.apply(n,w(o)),(i=a.options.layouts).unshift.apply(i,w(o)),(s=a.options.partials).unshift.apply(s,w(o))}a.renderFile(t,e).then(function(t){return r(null,t)},r)}},Mn);function Mn(t){var r=this;void 0===t&&(t={}),this.options=function(t){if(t.hasOwnProperty("operators")&&(t.operatorsTrie=C(t.operators)),t.hasOwnProperty("root")&&(t.hasOwnProperty("partials")||(t.partials=t.root),t.hasOwnProperty("layouts")||(t.layouts=t.root)),t.hasOwnProperty("cache")){var e=void 0;e="number"==typeof t.cache?0<t.cache?new L(t.cache):void 0:"object"==typeof t.cache?t.cache:t.cache?new L(1024):void 0,t.cache=e}return!(t=x({},H,t)).fs.dirname&&t.relativeReference&&(console.warn("[LiquidJS] `fs.dirname` is required for relativeReference, set relativeReference to `false` to suppress this warning, or provide implementation for `fs.dirname`"),t.relativeReference=!1),t.root=K(t.root),t.partials=K(t.partials),t.layouts=K(t.layouts),t}(t),this.parser=new Tr(this),this.renderer=new Lt,this.filters=new Pn(this.options.strictFilters,this),this.tags=new En,v(tn,function(t,e){return r.registerTag(R(e),t)}),v(Sn,function(t,e){return r.registerFilter(R(e),t)})}p.AssertionError=lt,p.Context=dt,p.Drop=s,p.Expression=le,p.Hash=or,p.InternalUndefinedVariableError=at,p.Liquid=Nn,p.LiquidError=Q,p.ParseError=X,p.ParseStream=Ut,p.RenderError=et,p.TagToken=ir,p.Token=de,p.TokenizationError=$,p.Tokenizer=er,p.TypeGuards=Kt,p.UndefinedVariableError=it,p.Value=lr,p.assert=gt,p.createTrie=C,p.defaultOperators=z,p.evalQuotedToken=fe,p.evalToken=pe,p.isFalsy=I,p.isTruthy=A,p.toPromise=Ot,p.toThenable=qt,p.toValue=f,p.version="9.28.3",Object.defineProperty(p,"__esModule",{value:!0})});

/******************************************************************************
W:\websites\_dl_components\components\_func\liquid\liquid.js
******************************************************************************/
;/// <reference path="../../../assets/js/_types/liquidjs/liquid.d.ts" />
/// <reference path="../../../assets/js/util/namespace.js" />
/// <reference path="./types.d.ts" />
((/** @type {Liquid_Namespace} */ ns) => {
    const _mapToObj = map => {
        const result = {};

        for (const [name, value] of map) {
            result[name] = value instanceof Map ? _mapToObj(value) : value;
        }

        return result;
    };

    const _safeMap = input => {
        try {
            if (input instanceof Map) {
                return new Map(input);
            }

            // convert object to kvps
            if (!Array.isArray(input)) {
                const arr = [];

                for (const k in input) {
                    arr.push([k, input[k]]);
                }

                input = arr;
            }

            // remove null/undefined
            input = input.filter(item => item !== null && item !== undefined);

            return new Map(input);
        } catch (error) {
            console.error(`Failed to create Map: '${error}'`, input);
            // todo: should we rethrow? maybe as a config?
            return new Map();
        }
    };

    const _mergeMaps = (first, second) => {
        const map = new Map(first);

        for (const [name, value] of second) {
            if (map.has(name)) {
                map.set(name, _merge(map.get(name), value));
            } else {
                map.set(name, value);
            }
        }

        return map;
    };

    const _merge = (first, second) => {
        if (Array.isArray(first) || first instanceof Map) {
            return _mergeMaps(_safeMap(first), _safeMap(second));
        }

        if (typeof first === 'string') {
            return `${first} ${second}`;
        }

        if (first instanceof Date) {
            return second;
        }

        if (typeof first === 'object' && typeof second === 'object') {
            return _mergeMaps(_safeMap(first), _safeMap(second));
        }

        return second;
    };

    /****************************************
     * TAGS
     ***************************************/
    const _makeElseOnlyTag = name => ({
        name,
        impl: {
            parse: function (tagToken, remainingTokens) {
                const tagName = tagToken.name;
                this.elseTemplates = [];

                let inElse = false;

                this.liquid.parser.parseStream(remainingTokens)
                    .on('tag:else', () => { inElse = true; })
                    .on('template', template => { if (inElse) { this.elseTemplates.push(template); } })
                    .on(`tag:end${tagName}`, function () { this.stop(); /* stop parsing */ })
                    .on('end', () => { throw new Error(`tag ${tagName} not closed`); })
                    .start();
            },
            render: function* (context, emitter) {
                yield this.liquid.renderer.renderTemplates(this.elseTemplates, context, emitter);
            }
        }
    });

    const counterTag = (() => {
        /** @type {Map<string, number>} */
        const COUNTERS = new Map();

        return {
            name: 'counter',
            impl: {
                parse: function (token) {
                    const tokenizer = new liquidjs.Tokenizer(token.args, this.liquid.options.operatorsTrie);
                    this.identifier = tokenizer.readIdentifier().content;
                },
                render: function (_, emitter) {
                    let value = 0;

                    if (COUNTERS.has(this.identifier)) {
                        value = COUNTERS.get(this.identifier);
                        value++;
                    }

                    COUNTERS.set(this.identifier, value);

                    // write an integer
                    emitter.write(value.toFixed(0));
                }
            }
        };
    })();

    // todo: real slot support
    const slotTag = {
        name: 'slot',
        impl: {
            render: () => { }
        }
    };

    const forSlotTag = _makeElseOnlyTag('forslot');

    const ifSlotTag = _makeElseOnlyTag('ifslot');

    const unlessSlotTag = {
        name: 'unlessslot',
        impl: {
            parse: function (tagToken, remainingTokens) { },
            render: function* (context, emitter) { }
        }
    };

    const usingTag = (() => {
        const specialNames = [
            'forloop'
        ];

        return {
            name: 'using',
            impl: {
                parse: function (token, remainingTokens) {
                    const tagName = token.name;
                    const tokenizer = new liquidjs.Tokenizer(token.args, this.liquid.options.operatorsTrie);
                    this.value = tokenizer.readValue();
                    this.templates = [];

                    this.liquid.parser.parseStream(remainingTokens)
                        .on('template', template => this.templates.push(template))
                        .on(`tag:end${tagName}`, function () { this.stop(); /* stop parsing */ })
                        .on('end', () => { throw new Error(`tag ${tagName} not closed`); })
                        .start();
                },
                render: function* (context, emitter) {
                    const data = liquidjs.evalToken(this.value, context);
                    const childContext = new liquidjs.Context(data, context.opts, { sync: context.sync, globals: context.globals, strictVariables: context.strictVariables });
                    const scope = childContext.bottom();

                    // add special values if they exist
                    for (const specialName of specialNames) {
                        const specialValue = context.get(specialName.split('.'));

                        if (specialValue != null) {
                            scope[specialName] = specialValue;
                        }
                    }

                    yield this.liquid.renderer.renderTemplates(this.templates, childContext, emitter);
                }
            }
        };
    })();

    /****************************************
     * FILTERS
     ***************************************/
    const _addPropsInternal = (input, args, merge) => {
        const params = _safeMap(args);
        const map = _safeMap(input);

        // add arguments passed in
        for (const [name, value] of params) {
            if (merge && map.has(name)) {
                // merge values
                map.set(name, _merge(map.get(name), value));
            } else {
                // add or override value
                map.set(name, value);
            }
        }

        // convert map to object for better interop
        return _mapToObj(map);
    };

    const addPropsFilter = {
        name: 'add_props',
        impl: (input, ...args) =>
            _addPropsInternal(input, args, false)
    };

    const assetUrlFilter = {
        name: 'asset_url',
        impl: (() => {
            const filingNamePattern = /\/(?<firstLetter>[_a-z0-9])\/\k<firstLetter>[\w.\-]+\//i;

            return (input, ...args) => {
                const params = _safeMap(args);
                let base = params.get('global') ? ns.assetUrls.global : ns.assetUrls.asset;

                // remove any whitespace (and make sure we have a string)
                input = (input || '').trim();

                try {
                    // special case for absolute urls
                    if (/^(?:https?:)?\/\//.test(input)) {
                        return input;
                    }

                    // special case for filing name urls
                    if (filingNamePattern.test(input)) {
                        // remove any filing name from the base
                        base = base.replace(filingNamePattern, '/');
                    }

                    // combine base and input (with possible leading `/` removed)
                    const url = base + input.replace(/^\//, '');

                    return url;
                } catch (error) {
                    console.error(`${assetUrlFilter.name} failed for '${input}': ${error}`);
                }
            }
        })()
    };

    const toAttrsFilter = {
        name: 'to_attrs',
        impl: (input, ...args) => {
            const params = _safeMap(args);
            const map = _safeMap(input);
            const arr = [];

            // convert values
            for (const [name, value] of map) {
                // make sure value is a string
                const strValue =
                    value instanceof Date ?
                        value.toISOString() :
                        (value === undefined || value === null) ?
                            '' :
                            typeof value === 'object' ?
                                JSON.stringify(value) :
                                `${value}`;

                arr.push([name, strValue]);
            }

            if (params.get('list')) {
                return arr;
            }

            let str = '';

            for (const [name, value] of arr) {
                str += ` ${name}`;

                if (value) {
                    // use ' if the value contains "
                    const quote = value.includes('"') ? "'" : '"';
                    str += `=${quote}${value}${quote}`;
                }
            }

            return str;
        }
    };

    const makeListFilter = {
        name: 'make_list',
        impl: (input, ...args) => {
            const arr = Array.from(input);
            return arr.concat(args);
        }
    };

    const mergeFilter = {
        name: 'merge',
        impl: (input, ...args) => {
            let result = input;

            for (const other of args) {
                result = _merge(result, other);
            }

            if (result instanceof Map) {
                result = _mapToObj(result);
            }

            return result;
        }
    };

    const mergePropsFilter = {
        name: 'merge_props',
        impl: (input, ...args) =>
            _addPropsInternal(input, args, true)
    };

    const consoleFilter = {
        name: 'console',
        impl: (input) =>
            console.log(input)
    };

    const jsonFilter = {
        name: 'json',
        impl: (value, format) =>
            JSON.stringify(value, null, format ? 4 : 0)
    };

    const decodeOnceFilter = (() => {
        const textarea = document.createElement('textarea');

        return {
            name: 'decode_once',
            impl: (input) => {
                textarea.innerHTML = input;
                return textarea.value;
            }
        };
    })();

    // set default asset urls if they haven't already been
    ns.assetUrls = ns.assetUrls || {
        global: 'https://assets.doctorlogic.com/Images/Sites/GlobalAssets/',
        asset: 'https://assets.doctorlogic.com/Images/Sites/Y/YakerNatan/',
    };

    ns.registerTags = (liquid) => {
        // register tags
        const registerTag = tag => liquid.registerTag(tag.name, tag.impl);
        registerTag(counterTag);
        registerTag(slotTag);
        registerTag(forSlotTag);
        registerTag(ifSlotTag);
        registerTag(unlessSlotTag);
        registerTag(usingTag);

        return liquid;
    };

    ns.registerFilters = (liquid) => {
        // register filters
        const registerFilter = filter => liquid.registerFilter(filter.name, filter.impl);
        registerFilter(addPropsFilter);
        registerFilter(assetUrlFilter);
        registerFilter(toAttrsFilter);
        registerFilter(makeListFilter);
        registerFilter(mergeFilter);
        registerFilter(mergePropsFilter);
        registerFilter(consoleFilter);
        registerFilter(jsonFilter);
        registerFilter(decodeOnceFilter);

        return liquid;
    };

    ns.register = (liquid) => ns.registerFilters(ns.registerTags(liquid));

    class Liquid extends liquidjs.Liquid {
        constructor(options) {
            // allow consumer to pass in options extending the ns.options
            super({
                ...(ns.options || {}),
                ...(options || {})
            });
            ns.register(this);
        }
    };

    ns.Liquid = Liquid;
})(dl.util.namespace('dl.liquid'));
/******************************************************************************
W:\websites\_dl_components\pages\collection\collection.js
******************************************************************************/
;/// <reference path="../../assets/js/util/types.d.ts" />
/// <reference path="./types.d.ts" />
((
    /** @type {DL_Collection_Namespace} */ ns,
    /** @type {import('../../components/_func/liquid/types').Liquid_Namespace} */ liquidNs,
    /** @type {import('../../components/_data/labels/types').Data_Namespace} */ dataNs) => {
    let page = 1;

    const liquid = new liquidNs.Liquid();
    const itemTemplate = liquid.parse(ns.config.itemTemplate);

    const btn = document.getElementById('view-more');

    const setLoading = isLoading => {
        if (isLoading) {
            btn.disabled = true;
            document.getElementById('view-more-pre').style.display = '';
            document.getElementById('view-more-post').style.display = 'none';
        } else {
            btn.disabled = false;
            document.getElementById('view-more-pre').style.display = 'none';
            document.getElementById('view-more-post').style.display = '';
        }
    };

    const setDone = isDone => {
        if (isDone) {
            btn.disabled = true;
            btn.style.display = 'none';
        } else {
            btn.disabled = false;
            btn.style.display = '';
        }
    };

    const getDataUrl = (/** @type {number} */ page) => {
        try {
            return ns.config.getDataUrl(page);
        } catch (error) {
            console.error(`Error in getDataUrl: ${error}`);
            throw error;
        }
    };

    const handleErrorResponse = (/** @type {Response} */ resp) => {
        console.error(`Received non-success response from '${resp.url}' - ${resp.status} '${resp.statusText}'.`)
    };

    const parseResponse = async (/** @type {Response} */ resp) => {
        try {
            const data = await resp.json();
            let hasMore = data?.Posts?.length > 0;

            // check if we have the HasMoreItems header
            if (resp.headers.has('HasMoreItems')) {
                const hasMoreHeader = resp.headers.get('HasMoreItems');
                hasMore = hasMoreHeader === 'true';
            }

            return {
                data,
                hasMore,
            };
        } catch (error) {
            console.error(`Error while parsing response json: ${error}`);
        }
    };

    const fetchData = async (page) => {
        try {
            const url = getDataUrl(page);
            const resp = await fetch(url, {
                // need this until the controller change makes it to prod
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
            });

            if (!resp.ok) {
                handleErrorResponse(resp);
                return;
            }

            return await parseResponse(resp);
        } catch (error) {
            console.error(`Error while loading page data: ${error}`);
        }
    };

    const renderNextPage = async () => {
        setLoading(true);

        try {
            page += 1;

            const { data, hasMore } = await fetchData(page);

            if (data?.Posts?.length > 0) {
                const posts = ns.config.dataMapper(data.Posts, dataNs.labels, ns.config.collections, ns.config.imageWidth);

                posts.forEach(p => {
                    const context = {
                        ...data,
                        ...ns.config.itemTemplateContext,
                        item: p,
                    };

                    const markup = liquid.renderSync(itemTemplate, context);

                    ns.config.listEl.innerHTML += markup;
                });
            }

            if (!hasMore) {
                setDone(true);
            }
        } finally {
            setLoading(false);
        }
    };

    if (btn) {
        btn.addEventListener('click', renderNextPage);
    }
})(...window.dl.util.namespaces(
    'dl.page.collection',
    'dl.liquid',
    'dl.data'));
/******************************************************************************
W:\websites\_dl_components\assets\js\flickity.pkgd.min.js
******************************************************************************/
;/*!
 * Flickity PACKAGED v2.2.3
 * Touch, responsive, flickable carousels
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * https://flickity.metafizzy.co
 * Copyright 2015-2021 Metafizzy
 */
(function(e,i){if(typeof define=="function"&&define.amd){define("jquery-bridget/jquery-bridget",["jquery"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("jquery"))}else{e.jQueryBridget=i(e,e.jQuery)}})(window,function t(e,r){"use strict";var o=Array.prototype.slice;var i=e.console;var u=typeof i=="undefined"?function(){}:function(t){i.error(t)};function n(h,s,c){c=c||r||e.jQuery;if(!c){return}if(!s.prototype.option){s.prototype.option=function(t){if(!c.isPlainObject(t)){return}this.options=c.extend(true,this.options,t)}}c.fn[h]=function(t){if(typeof t=="string"){var e=o.call(arguments,1);return i(this,t,e)}n(this,t);return this};function i(t,r,o){var a;var l="$()."+h+'("'+r+'")';t.each(function(t,e){var i=c.data(e,h);if(!i){u(h+" not initialized. Cannot call methods, i.e. "+l);return}var n=i[r];if(!n||r.charAt(0)=="_"){u(l+" is not a valid method");return}var s=n.apply(i,o);a=a===undefined?s:a});return a!==undefined?a:t}function n(t,n){t.each(function(t,e){var i=c.data(e,h);if(i){i.option(n);i._init()}else{i=new s(e,n);c.data(e,h,i)}})}a(c)}function a(t){if(!t||t&&t.bridget){return}t.bridget=n}a(r||e.jQuery);return n});(function(t,e){if(typeof define=="function"&&define.amd){define("ev-emitter/ev-emitter",e)}else if(typeof module=="object"&&module.exports){module.exports=e()}else{t.EvEmitter=e()}})(typeof window!="undefined"?window:this,function(){function t(){}var e=t.prototype;e.on=function(t,e){if(!t||!e){return}var i=this._events=this._events||{};var n=i[t]=i[t]||[];if(n.indexOf(e)==-1){n.push(e)}return this};e.once=function(t,e){if(!t||!e){return}this.on(t,e);var i=this._onceEvents=this._onceEvents||{};var n=i[t]=i[t]||{};n[e]=true;return this};e.off=function(t,e){var i=this._events&&this._events[t];if(!i||!i.length){return}var n=i.indexOf(e);if(n!=-1){i.splice(n,1)}return this};e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(!i||!i.length){return}i=i.slice(0);e=e||[];var n=this._onceEvents&&this._onceEvents[t];for(var s=0;s<i.length;s++){var r=i[s];var o=n&&n[r];if(o){this.off(t,r);delete n[r]}r.apply(this,e)}return this};e.allOff=function(){delete this._events;delete this._onceEvents};return t});
/*!
 * getSize v2.0.3
 * measure size of elements
 * MIT license
 */
(function(t,e){if(typeof define=="function"&&define.amd){define("get-size/get-size",e)}else if(typeof module=="object"&&module.exports){module.exports=e()}else{t.getSize=e()}})(window,function t(){"use strict";function m(t){var e=parseFloat(t);var i=t.indexOf("%")==-1&&!isNaN(e);return i&&e}function e(){}var i=typeof console=="undefined"?e:function(t){console.error(t)};var y=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];var b=y.length;function E(){var t={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0};for(var e=0;e<b;e++){var i=y[e];t[i]=0}return t}function S(t){var e=getComputedStyle(t);if(!e){i("Style returned "+e+". Are you running this code in a hidden iframe on Firefox? "+"See https://bit.ly/getsizebug1")}return e}var n=false;var C;function x(){if(n){return}n=true;var t=document.createElement("div");t.style.width="200px";t.style.padding="1px 2px 3px 4px";t.style.borderStyle="solid";t.style.borderWidth="1px 2px 3px 4px";t.style.boxSizing="border-box";var e=document.body||document.documentElement;e.appendChild(t);var i=S(t);C=Math.round(m(i.width))==200;s.isBoxSizeOuter=C;e.removeChild(t)}function s(t){x();if(typeof t=="string"){t=document.querySelector(t)}if(!t||typeof t!="object"||!t.nodeType){return}var e=S(t);if(e.display=="none"){return E()}var i={};i.width=t.offsetWidth;i.height=t.offsetHeight;var n=i.isBorderBox=e.boxSizing=="border-box";for(var s=0;s<b;s++){var r=y[s];var o=e[r];var a=parseFloat(o);i[r]=!isNaN(a)?a:0}var l=i.paddingLeft+i.paddingRight;var h=i.paddingTop+i.paddingBottom;var c=i.marginLeft+i.marginRight;var u=i.marginTop+i.marginBottom;var d=i.borderLeftWidth+i.borderRightWidth;var f=i.borderTopWidth+i.borderBottomWidth;var p=n&&C;var v=m(e.width);if(v!==false){i.width=v+(p?0:l+d)}var g=m(e.height);if(g!==false){i.height=g+(p?0:h+f)}i.innerWidth=i.width-(l+d);i.innerHeight=i.height-(h+f);i.outerWidth=i.width+c;i.outerHeight=i.height+u;return i}return s});(function(t,e){"use strict";if(typeof define=="function"&&define.amd){define("desandro-matches-selector/matches-selector",e)}else if(typeof module=="object"&&module.exports){module.exports=e()}else{t.matchesSelector=e()}})(window,function t(){"use strict";var n=function(){var t=window.Element.prototype;if(t.matches){return"matches"}if(t.matchesSelector){return"matchesSelector"}var e=["webkit","moz","ms","o"];for(var i=0;i<e.length;i++){var n=e[i];var s=n+"MatchesSelector";if(t[s]){return s}}}();return function t(e,i){return e[n](i)}});(function(e,i){if(typeof define=="function"&&define.amd){define("fizzy-ui-utils/utils",["desandro-matches-selector/matches-selector"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("desandro-matches-selector"))}else{e.fizzyUIUtils=i(e,e.matchesSelector)}})(window,function t(h,r){var c={};c.extend=function(t,e){for(var i in e){t[i]=e[i]}return t};c.modulo=function(t,e){return(t%e+e)%e};var i=Array.prototype.slice;c.makeArray=function(t){if(Array.isArray(t)){return t}if(t===null||t===undefined){return[]}var e=typeof t=="object"&&typeof t.length=="number";if(e){return i.call(t)}return[t]};c.removeFrom=function(t,e){var i=t.indexOf(e);if(i!=-1){t.splice(i,1)}};c.getParent=function(t,e){while(t.parentNode&&t!=document.body){t=t.parentNode;if(r(t,e)){return t}}};c.getQueryElement=function(t){if(typeof t=="string"){return document.querySelector(t)}return t};c.handleEvent=function(t){var e="on"+t.type;if(this[e]){this[e](t)}};c.filterFindElements=function(t,n){t=c.makeArray(t);var s=[];t.forEach(function(t){if(!(t instanceof HTMLElement)){return}if(!n){s.push(t);return}if(r(t,n)){s.push(t)}var e=t.querySelectorAll(n);for(var i=0;i<e.length;i++){s.push(e[i])}});return s};c.debounceMethod=function(t,e,n){n=n||100;var s=t.prototype[e];var r=e+"Timeout";t.prototype[e]=function(){var t=this[r];clearTimeout(t);var e=arguments;var i=this;this[r]=setTimeout(function(){s.apply(i,e);delete i[r]},n)}};c.docReady=function(t){var e=document.readyState;if(e=="complete"||e=="interactive"){setTimeout(t)}else{document.addEventListener("DOMContentLoaded",t)}};c.toDashed=function(t){return t.replace(/(.)([A-Z])/g,function(t,e,i){return e+"-"+i}).toLowerCase()};var u=h.console;c.htmlInit=function(a,l){c.docReady(function(){var t=c.toDashed(l);var s="data-"+t;var e=document.querySelectorAll("["+s+"]");var i=document.querySelectorAll(".js-"+t);var n=c.makeArray(e).concat(c.makeArray(i));var r=s+"-options";var o=h.jQuery;n.forEach(function(e){var t=e.getAttribute(s)||e.getAttribute(r);var i;try{i=t&&JSON.parse(t)}catch(t){if(u){u.error("Error parsing "+s+" on "+e.className+": "+t)}return}var n=new a(e,i);if(o){o.data(e,l,n)}})})};return c});(function(e,i){if(typeof define=="function"&&define.amd){define("flickity/js/cell",["get-size/get-size"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("get-size"))}else{e.Flickity=e.Flickity||{};if(typeof e.Flickity.Cell==="function"){return}e.Flickity.Cell=i(e,e.getSize)}})(window,function t(e,i){function n(t,e){this.element=t;this.parent=e;this.create()}var s=n.prototype;s.create=function(){this.element.style.position="absolute";this.element.setAttribute("aria-hidden","true");this.x=0;this.shift=0};s.destroy=function(){this.unselect();this.element.style.position="";var t=this.parent.originSide;this.element.style[t]="";this.element.removeAttribute("aria-hidden")};s.getSize=function(){this.size=i(this.element)};s.setPosition=function(t){this.x=t;this.updateTarget();this.renderPosition(t)};s.updateTarget=s.setDefaultTarget=function(){var t=this.parent.originSide=="left"?"marginLeft":"marginRight";this.target=this.x+this.size[t]+this.size.width*this.parent.cellAlign};s.renderPosition=function(t){var e=this.parent.originSide;this.element.style[e]=this.parent.getPositionValue(t)};s.select=function(){this.element.classList.add("is-selected");this.element.removeAttribute("aria-hidden")};s.unselect=function(){this.element.classList.remove("is-selected");this.element.setAttribute("aria-hidden","true")};s.wrapShift=function(t){this.shift=t;this.renderPosition(this.x+this.parent.slideableWidth*t)};s.remove=function(){this.element.parentNode.removeChild(this.element)};return n});(function(t,e){if(typeof define=="function"&&define.amd){define("flickity/js/slide",e)}else if(typeof module=="object"&&module.exports){module.exports=e()}else{t.Flickity=t.Flickity||{};if(typeof t.Flickity.Slide==="function"){return}t.Flickity.Slide=e()}})(window,function t(){function e(t){this.parent=t;this.isOriginLeft=t.originSide=="left";this.cells=[];this.outerWidth=0;this.height=0}var i=e.prototype;i.addCell=function(t){this.cells.push(t);this.outerWidth+=t.size.outerWidth;this.height=Math.max(t.size.outerHeight,this.height);if(this.cells.length==1){this.x=t.x;var e=this.isOriginLeft?"marginLeft":"marginRight";this.firstMargin=t.size[e]}};i.updateTarget=function(){var t=this.isOriginLeft?"marginRight":"marginLeft";var e=this.getLastCell();var i=e?e.size[t]:0;var n=this.outerWidth-(this.firstMargin+i);this.target=this.x+this.firstMargin+n*this.parent.cellAlign};i.getLastCell=function(){return this.cells[this.cells.length-1]};i.select=function(){this.cells.forEach(function(t){t.select()})};i.unselect=function(){this.cells.forEach(function(t){t.unselect()})};i.getCellElements=function(){return this.cells.map(function(t){return t.element})};return e});(function(e,i){if(typeof define=="function"&&define.amd){define("flickity/js/animate",["fizzy-ui-utils/utils"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("fizzy-ui-utils"))}else{e.Flickity=e.Flickity||{};e.Flickity.animatePrototype=i(e,e.fizzyUIUtils)}})(window,function t(e,i){var n={};n.startAnimation=function(){if(this.isAnimating){return}this.isAnimating=true;this.restingFrames=0;this.animate()};n.animate=function(){this.applyDragForce();this.applySelectedAttraction();var t=this.x;this.integratePhysics();this.positionSlider();this.settle(t);if(this.isAnimating){var e=this;requestAnimationFrame(function t(){e.animate()})}};n.positionSlider=function(){var t=this.x;if(this.options.wrapAround&&this.cells.length>1){t=i.modulo(t,this.slideableWidth);t-=this.slideableWidth;this.shiftWrapCells(t)}this.setTranslateX(t,this.isAnimating);this.dispatchScrollEvent()};n.setTranslateX=function(t,e){t+=this.cursorPosition;t=this.options.rightToLeft?-t:t;var i=this.getPositionValue(t);this.slider.style.transform=e?"translate3d("+i+",0,0)":"translateX("+i+")"};n.dispatchScrollEvent=function(){var t=this.slides[0];if(!t){return}var e=-this.x-t.target;var i=e/this.slidesWidth;this.dispatchEvent("scroll",null,[i,e])};n.positionSliderAtSelected=function(){if(!this.cells.length){return}this.x=-this.selectedSlide.target;this.velocity=0;this.positionSlider()};n.getPositionValue=function(t){if(this.options.percentPosition){return Math.round(t/this.size.innerWidth*1e4)*.01+"%"}else{return Math.round(t)+"px"}};n.settle=function(t){var e=!this.isPointerDown&&Math.round(this.x*100)==Math.round(t*100);if(e){this.restingFrames++}if(this.restingFrames>2){this.isAnimating=false;delete this.isFreeScrolling;this.positionSlider();this.dispatchEvent("settle",null,[this.selectedIndex])}};n.shiftWrapCells=function(t){var e=this.cursorPosition+t;this._shiftCells(this.beforeShiftCells,e,-1);var i=this.size.innerWidth-(t+this.slideableWidth+this.cursorPosition);this._shiftCells(this.afterShiftCells,i,1)};n._shiftCells=function(t,e,i){for(var n=0;n<t.length;n++){var s=t[n];var r=e>0?i:0;s.wrapShift(r);e-=s.size.outerWidth}};n._unshiftCells=function(t){if(!t||!t.length){return}for(var e=0;e<t.length;e++){t[e].wrapShift(0)}};n.integratePhysics=function(){this.x+=this.velocity;this.velocity*=this.getFrictionFactor()};n.applyForce=function(t){this.velocity+=t};n.getFrictionFactor=function(){return 1-this.options[this.isFreeScrolling?"freeScrollFriction":"friction"]};n.getRestingPosition=function(){return this.x+this.velocity/(1-this.getFrictionFactor())};n.applyDragForce=function(){if(!this.isDraggable||!this.isPointerDown){return}var t=this.dragX-this.x;var e=t-this.velocity;this.applyForce(e)};n.applySelectedAttraction=function(){var t=this.isDraggable&&this.isPointerDown;if(t||this.isFreeScrolling||!this.slides.length){return}var e=this.selectedSlide.target*-1-this.x;var i=e*this.options.selectedAttraction;this.applyForce(i)};return n});(function(o,a){if(typeof define=="function"&&define.amd){define("flickity/js/flickity",["ev-emitter/ev-emitter","get-size/get-size","fizzy-ui-utils/utils","./cell","./slide","./animate"],function(t,e,i,n,s,r){return a(o,t,e,i,n,s,r)})}else if(typeof module=="object"&&module.exports){module.exports=a(o,require("ev-emitter"),require("get-size"),require("fizzy-ui-utils"),require("./cell"),require("./slide"),require("./animate"))}else{var t=o.Flickity;if(typeof t==="function"){return}o.Flickity=a(o,o.EvEmitter,o.getSize,o.fizzyUIUtils,t.Cell,t.Slide,t.animatePrototype)}})(window,function t(n,e,i,a,s,o,r){var l=n.jQuery;var h=n.getComputedStyle;var c=n.console;function u(t,e){t=a.makeArray(t);while(t.length){e.appendChild(t.shift())}}var d=0;var f={};function p(t,e){var i=a.getQueryElement(t);if(!i){if(c){c.error("Bad element for Flickity: "+(i||t))}return}this.element=i;if(this.element.flickityGUID){var n=f[this.element.flickityGUID];if(n)n.option(e);return n}if(l){this.$element=l(this.element)}this.options=a.extend({},this.constructor.defaults);this.option(e);this._create()}p.defaults={accessibility:true,cellAlign:"center",freeScrollFriction:.075,friction:.28,namespaceJQueryEvents:true,percentPosition:true,resize:true,selectedAttraction:.025,setGallerySize:true};p.createMethods=[];var v=p.prototype;a.extend(v,e.prototype);v._create=function(){var t=this.guid=++d;this.element.flickityGUID=t;f[t]=this;this.selectedIndex=0;this.restingFrames=0;this.x=0;this.velocity=0;this.originSide=this.options.rightToLeft?"right":"left";this.viewport=document.createElement("div");this.viewport.className="flickity-viewport";this._createSlider();if(this.options.resize||this.options.watchCSS){n.addEventListener("resize",this)}for(var e in this.options.on){var i=this.options.on[e];this.on(e,i)}p.createMethods.forEach(function(t){this[t]()},this);if(this.options.watchCSS){this.watchCSS()}else{this.activate()}};v.option=function(t){a.extend(this.options,t)};v.activate=function(){if(this.isActive){return}this.isActive=true;this.element.classList.add("flickity-enabled");if(this.options.rightToLeft){this.element.classList.add("flickity-rtl")}this.getSize();var t=this._filterFindCellElements(this.element.children);u(t,this.slider);this.viewport.appendChild(this.slider);this.element.appendChild(this.viewport);this.reloadCells();if(this.options.accessibility){this.element.tabIndex=0;this.element.addEventListener("keydown",this)}this.emitEvent("activate");this.selectInitialIndex();this.isInitActivated=true;this.dispatchEvent("ready")};v._createSlider=function(){var t=document.createElement("div");t.className="flickity-slider";t.style[this.originSide]=0;this.slider=t};v._filterFindCellElements=function(t){return a.filterFindElements(t,this.options.cellSelector)};v.reloadCells=function(){this.cells=this._makeCells(this.slider.children);this.positionCells();this._getWrapShiftCells();this.setGallerySize()};v._makeCells=function(t){var e=this._filterFindCellElements(t);var i=e.map(function(t){return new s(t,this)},this);return i};v.getLastCell=function(){return this.cells[this.cells.length-1]};v.getLastSlide=function(){return this.slides[this.slides.length-1]};v.positionCells=function(){this._sizeCells(this.cells);this._positionCells(0)};v._positionCells=function(t){t=t||0;this.maxCellHeight=t?this.maxCellHeight||0:0;var e=0;if(t>0){var i=this.cells[t-1];e=i.x+i.size.outerWidth}var n=this.cells.length;for(var s=t;s<n;s++){var r=this.cells[s];r.setPosition(e);e+=r.size.outerWidth;this.maxCellHeight=Math.max(r.size.outerHeight,this.maxCellHeight)}this.slideableWidth=e;this.updateSlides();this._containSlides();this.slidesWidth=n?this.getLastSlide().target-this.slides[0].target:0};v._sizeCells=function(t){t.forEach(function(t){t.getSize()})};v.updateSlides=function(){this.slides=[];if(!this.cells.length){return}var n=new o(this);this.slides.push(n);var t=this.originSide=="left";var s=t?"marginRight":"marginLeft";var r=this._getCanCellFit();this.cells.forEach(function(t,e){if(!n.cells.length){n.addCell(t);return}var i=n.outerWidth-n.firstMargin+(t.size.outerWidth-t.size[s]);if(r.call(this,e,i)){n.addCell(t)}else{n.updateTarget();n=new o(this);this.slides.push(n);n.addCell(t)}},this);n.updateTarget();this.updateSelectedSlide()};v._getCanCellFit=function(){var t=this.options.groupCells;if(!t){return function(){return false}}else if(typeof t=="number"){var e=parseInt(t,10);return function(t){return t%e!==0}}var i=typeof t=="string"&&t.match(/^(\d+)%$/);var n=i?parseInt(i[1],10)/100:1;return function(t,e){return e<=(this.size.innerWidth+1)*n}};v._init=v.reposition=function(){this.positionCells();this.positionSliderAtSelected()};v.getSize=function(){this.size=i(this.element);this.setCellAlign();this.cursorPosition=this.size.innerWidth*this.cellAlign};var g={center:{left:.5,right:.5},left:{left:0,right:1},right:{right:0,left:1}};v.setCellAlign=function(){var t=g[this.options.cellAlign];this.cellAlign=t?t[this.originSide]:this.options.cellAlign};v.setGallerySize=function(){if(this.options.setGallerySize){var t=this.options.adaptiveHeight&&this.selectedSlide?this.selectedSlide.height:this.maxCellHeight;this.viewport.style.height=t+"px"}};v._getWrapShiftCells=function(){if(!this.options.wrapAround){return}this._unshiftCells(this.beforeShiftCells);this._unshiftCells(this.afterShiftCells);var t=this.cursorPosition;var e=this.cells.length-1;this.beforeShiftCells=this._getGapCells(t,e,-1);t=this.size.innerWidth-this.cursorPosition;this.afterShiftCells=this._getGapCells(t,0,1)};v._getGapCells=function(t,e,i){var n=[];while(t>0){var s=this.cells[e];if(!s){break}n.push(s);e+=i;t-=s.size.outerWidth}return n};v._containSlides=function(){if(!this.options.contain||this.options.wrapAround||!this.cells.length){return}var t=this.options.rightToLeft;var e=t?"marginRight":"marginLeft";var i=t?"marginLeft":"marginRight";var n=this.slideableWidth-this.getLastCell().size[i];var s=n<this.size.innerWidth;var r=this.cursorPosition+this.cells[0].size[e];var o=n-this.size.innerWidth*(1-this.cellAlign);this.slides.forEach(function(t){if(s){t.target=n*this.cellAlign}else{t.target=Math.max(t.target,r);t.target=Math.min(t.target,o)}},this)};v.dispatchEvent=function(t,e,i){var n=e?[e].concat(i):i;this.emitEvent(t,n);if(l&&this.$element){t+=this.options.namespaceJQueryEvents?".flickity":"";var s=t;if(e){var r=new l.Event(e);r.type=t;s=r}this.$element.trigger(s,i)}};v.select=function(t,e,i){if(!this.isActive){return}t=parseInt(t,10);this._wrapSelect(t);if(this.options.wrapAround||e){t=a.modulo(t,this.slides.length)}if(!this.slides[t]){return}var n=this.selectedIndex;this.selectedIndex=t;this.updateSelectedSlide();if(i){this.positionSliderAtSelected()}else{this.startAnimation()}if(this.options.adaptiveHeight){this.setGallerySize()}this.dispatchEvent("select",null,[t]);if(t!=n){this.dispatchEvent("change",null,[t])}this.dispatchEvent("cellSelect")};v._wrapSelect=function(t){var e=this.slides.length;var i=this.options.wrapAround&&e>1;if(!i){return t}var n=a.modulo(t,e);var s=Math.abs(n-this.selectedIndex);var r=Math.abs(n+e-this.selectedIndex);var o=Math.abs(n-e-this.selectedIndex);if(!this.isDragSelect&&r<s){t+=e}else if(!this.isDragSelect&&o<s){t-=e}if(t<0){this.x-=this.slideableWidth}else if(t>=e){this.x+=this.slideableWidth}};v.previous=function(t,e){this.select(this.selectedIndex-1,t,e)};v.next=function(t,e){this.select(this.selectedIndex+1,t,e)};v.updateSelectedSlide=function(){var t=this.slides[this.selectedIndex];if(!t){return}this.unselectSelectedSlide();this.selectedSlide=t;t.select();this.selectedCells=t.cells;this.selectedElements=t.getCellElements();this.selectedCell=t.cells[0];this.selectedElement=this.selectedElements[0]};v.unselectSelectedSlide=function(){if(this.selectedSlide){this.selectedSlide.unselect()}};v.selectInitialIndex=function(){var t=this.options.initialIndex;if(this.isInitActivated){this.select(this.selectedIndex,false,true);return}if(t&&typeof t=="string"){var e=this.queryCell(t);if(e){this.selectCell(t,false,true);return}}var i=0;if(t&&this.slides[t]){i=t}this.select(i,false,true)};v.selectCell=function(t,e,i){var n=this.queryCell(t);if(!n){return}var s=this.getCellSlideIndex(n);this.select(s,e,i)};v.getCellSlideIndex=function(t){for(var e=0;e<this.slides.length;e++){var i=this.slides[e];var n=i.cells.indexOf(t);if(n!=-1){return e}}};v.getCell=function(t){for(var e=0;e<this.cells.length;e++){var i=this.cells[e];if(i.element==t){return i}}};v.getCells=function(t){t=a.makeArray(t);var i=[];t.forEach(function(t){var e=this.getCell(t);if(e){i.push(e)}},this);return i};v.getCellElements=function(){return this.cells.map(function(t){return t.element})};v.getParentCell=function(t){var e=this.getCell(t);if(e){return e}t=a.getParent(t,".flickity-slider > *");return this.getCell(t)};v.getAdjacentCellElements=function(t,e){if(!t){return this.selectedSlide.getCellElements()}e=e===undefined?this.selectedIndex:e;var i=this.slides.length;if(1+t*2>=i){return this.getCellElements()}var n=[];for(var s=e-t;s<=e+t;s++){var r=this.options.wrapAround?a.modulo(s,i):s;var o=this.slides[r];if(o){n=n.concat(o.getCellElements())}}return n};v.queryCell=function(t){if(typeof t=="number"){return this.cells[t]}if(typeof t=="string"){if(t.match(/^[#.]?[\d/]/)){return}t=this.element.querySelector(t)}return this.getCell(t)};v.uiChange=function(){this.emitEvent("uiChange")};v.childUIPointerDown=function(t){
// HACK iOS does not allow touch events to bubble up?!
if(t.type!="touchstart"){t.preventDefault()}this.focus()};v.onresize=function(){this.watchCSS();this.resize()};a.debounceMethod(p,"onresize",150);v.resize=function(){if(!this.isActive){return}this.getSize();if(this.options.wrapAround){this.x=a.modulo(this.x,this.slideableWidth)}this.positionCells();this._getWrapShiftCells();this.setGallerySize();this.emitEvent("resize");var t=this.selectedElements&&this.selectedElements[0];this.selectCell(t,false,true)};v.watchCSS=function(){var t=this.options.watchCSS;if(!t){return}var e=h(this.element,":after").content;if(e.indexOf("flickity")!=-1){this.activate()}else{this.deactivate()}};v.onkeydown=function(t){var e=document.activeElement&&document.activeElement!=this.element;if(!this.options.accessibility||e){return}var i=p.keyboardHandlers[t.keyCode];if(i){i.call(this)}};p.keyboardHandlers={37:function(){var t=this.options.rightToLeft?"next":"previous";this.uiChange();this[t]()},39:function(){var t=this.options.rightToLeft?"previous":"next";this.uiChange();this[t]()}};v.focus=function(){var t=n.pageYOffset;this.element.focus({preventScroll:true});if(n.pageYOffset!=t){n.scrollTo(n.pageXOffset,t)}};v.deactivate=function(){if(!this.isActive){return}this.element.classList.remove("flickity-enabled");this.element.classList.remove("flickity-rtl");this.unselectSelectedSlide();this.cells.forEach(function(t){t.destroy()});this.element.removeChild(this.viewport);u(this.slider.children,this.element);if(this.options.accessibility){this.element.removeAttribute("tabIndex");this.element.removeEventListener("keydown",this)}this.isActive=false;this.emitEvent("deactivate")};v.destroy=function(){this.deactivate();n.removeEventListener("resize",this);this.allOff();this.emitEvent("destroy");if(l&&this.$element){l.removeData(this.element,"flickity")}delete this.element.flickityGUID;delete f[this.guid]};a.extend(v,r);p.data=function(t){t=a.getQueryElement(t);var e=t&&t.flickityGUID;return e&&f[e]};a.htmlInit(p,"flickity");if(l&&l.bridget){l.bridget("flickity",p)}p.setJQuery=function(t){l=t};p.Cell=s;p.Slide=o;return p});
/*!
 * Unipointer v2.4.0
 * base class for doing one thing with pointer event
 * MIT license
 */
(function(e,i){if(typeof define=="function"&&define.amd){define("unipointer/unipointer",["ev-emitter/ev-emitter"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("ev-emitter"))}else{e.Unipointer=i(e,e.EvEmitter)}})(window,function t(s,e){function i(){}function n(){}var r=n.prototype=Object.create(e.prototype);r.bindStartEvent=function(t){this._bindStartEvent(t,true)};r.unbindStartEvent=function(t){this._bindStartEvent(t,false)};r._bindStartEvent=function(t,e){e=e===undefined?true:e;var i=e?"addEventListener":"removeEventListener";var n="mousedown";if("ontouchstart"in s){n="touchstart"}else if(s.PointerEvent){n="pointerdown"}t[i](n,this)};r.handleEvent=function(t){var e="on"+t.type;if(this[e]){this[e](t)}};r.getTouch=function(t){for(var e=0;e<t.length;e++){var i=t[e];if(i.identifier==this.pointerIdentifier){return i}}};r.onmousedown=function(t){var e=t.button;if(e&&(e!==0&&e!==1)){return}this._pointerDown(t,t)};r.ontouchstart=function(t){this._pointerDown(t,t.changedTouches[0])};r.onpointerdown=function(t){this._pointerDown(t,t)};r._pointerDown=function(t,e){if(t.button||this.isPointerDown){return}this.isPointerDown=true;this.pointerIdentifier=e.pointerId!==undefined?e.pointerId:e.identifier;this.pointerDown(t,e)};r.pointerDown=function(t,e){this._bindPostStartEvents(t);this.emitEvent("pointerDown",[t,e])};var o={mousedown:["mousemove","mouseup"],touchstart:["touchmove","touchend","touchcancel"],pointerdown:["pointermove","pointerup","pointercancel"]};r._bindPostStartEvents=function(t){if(!t){return}var e=o[t.type];e.forEach(function(t){s.addEventListener(t,this)},this);this._boundPointerEvents=e};r._unbindPostStartEvents=function(){if(!this._boundPointerEvents){return}this._boundPointerEvents.forEach(function(t){s.removeEventListener(t,this)},this);delete this._boundPointerEvents};r.onmousemove=function(t){this._pointerMove(t,t)};r.onpointermove=function(t){if(t.pointerId==this.pointerIdentifier){this._pointerMove(t,t)}};r.ontouchmove=function(t){var e=this.getTouch(t.changedTouches);if(e){this._pointerMove(t,e)}};r._pointerMove=function(t,e){this.pointerMove(t,e)};r.pointerMove=function(t,e){this.emitEvent("pointerMove",[t,e])};r.onmouseup=function(t){this._pointerUp(t,t)};r.onpointerup=function(t){if(t.pointerId==this.pointerIdentifier){this._pointerUp(t,t)}};r.ontouchend=function(t){var e=this.getTouch(t.changedTouches);if(e){this._pointerUp(t,e)}};r._pointerUp=function(t,e){this._pointerDone();this.pointerUp(t,e)};r.pointerUp=function(t,e){this.emitEvent("pointerUp",[t,e])};r._pointerDone=function(){this._pointerReset();this._unbindPostStartEvents();this.pointerDone()};r._pointerReset=function(){this.isPointerDown=false;delete this.pointerIdentifier};r.pointerDone=i;r.onpointercancel=function(t){if(t.pointerId==this.pointerIdentifier){this._pointerCancel(t,t)}};r.ontouchcancel=function(t){var e=this.getTouch(t.changedTouches);if(e){this._pointerCancel(t,e)}};r._pointerCancel=function(t,e){this._pointerDone();this.pointerCancel(t,e)};r.pointerCancel=function(t,e){this.emitEvent("pointerCancel",[t,e])};n.getPointerPoint=function(t){return{x:t.pageX,y:t.pageY}};return n});
/*!
 * Unidragger v2.4.0
 * Draggable base class
 * MIT license
 */
(function(e,i){if(typeof define=="function"&&define.amd){define("unidragger/unidragger",["unipointer/unipointer"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("unipointer"))}else{e.Unidragger=i(e,e.Unipointer)}})(window,function t(r,e){function i(){}var n=i.prototype=Object.create(e.prototype);n.bindHandles=function(){this._bindHandles(true)};n.unbindHandles=function(){this._bindHandles(false)};n._bindHandles=function(t){t=t===undefined?true:t;var e=t?"addEventListener":"removeEventListener";var i=t?this._touchActionValue:"";for(var n=0;n<this.handles.length;n++){var s=this.handles[n];this._bindStartEvent(s,t);s[e]("click",this);if(r.PointerEvent){s.style.touchAction=i}}};n._touchActionValue="none";n.pointerDown=function(t,e){var i=this.okayPointerDown(t);if(!i){return}this.pointerDownPointer={pageX:e.pageX,pageY:e.pageY};t.preventDefault();this.pointerDownBlur();this._bindPostStartEvents(t);this.emitEvent("pointerDown",[t,e])};var s={TEXTAREA:true,INPUT:true,SELECT:true,OPTION:true};var o={radio:true,checkbox:true,button:true,submit:true,image:true,file:true};n.okayPointerDown=function(t){var e=s[t.target.nodeName];var i=o[t.target.type];var n=!e||i;if(!n){this._pointerReset()}return n};n.pointerDownBlur=function(){var t=document.activeElement;var e=t&&t.blur&&t!=document.body;if(e){t.blur()}};n.pointerMove=function(t,e){var i=this._dragPointerMove(t,e);this.emitEvent("pointerMove",[t,e,i]);this._dragMove(t,e,i)};n._dragPointerMove=function(t,e){var i={x:e.pageX-this.pointerDownPointer.pageX,y:e.pageY-this.pointerDownPointer.pageY};if(!this.isDragging&&this.hasDragStarted(i)){this._dragStart(t,e)}return i};n.hasDragStarted=function(t){return Math.abs(t.x)>3||Math.abs(t.y)>3};n.pointerUp=function(t,e){this.emitEvent("pointerUp",[t,e]);this._dragPointerUp(t,e)};n._dragPointerUp=function(t,e){if(this.isDragging){this._dragEnd(t,e)}else{this._staticClick(t,e)}};n._dragStart=function(t,e){this.isDragging=true;this.isPreventingClicks=true;this.dragStart(t,e)};n.dragStart=function(t,e){this.emitEvent("dragStart",[t,e])};n._dragMove=function(t,e,i){if(!this.isDragging){return}this.dragMove(t,e,i)};n.dragMove=function(t,e,i){t.preventDefault();this.emitEvent("dragMove",[t,e,i])};n._dragEnd=function(t,e){this.isDragging=false;setTimeout(function(){delete this.isPreventingClicks}.bind(this));this.dragEnd(t,e)};n.dragEnd=function(t,e){this.emitEvent("dragEnd",[t,e])};n.onclick=function(t){if(this.isPreventingClicks){t.preventDefault()}};n._staticClick=function(t,e){if(this.isIgnoringMouseUp&&t.type=="mouseup"){return}this.staticClick(t,e);if(t.type!="mouseup"){this.isIgnoringMouseUp=true;setTimeout(function(){delete this.isIgnoringMouseUp}.bind(this),400)}};n.staticClick=function(t,e){this.emitEvent("staticClick",[t,e])};i.getPointerPoint=e.getPointerPoint;return i});(function(n,s){if(typeof define=="function"&&define.amd){define("flickity/js/drag",["./flickity","unidragger/unidragger","fizzy-ui-utils/utils"],function(t,e,i){return s(n,t,e,i)})}else if(typeof module=="object"&&module.exports){module.exports=s(n,require("./flickity"),require("unidragger"),require("fizzy-ui-utils"))}else{n.Flickity=s(n,n.Flickity,n.Unidragger,n.fizzyUIUtils)}})(window,function t(n,e,i,a){a.extend(e.defaults,{draggable:">1",dragThreshold:3});e.createMethods.push("_createDrag");var s=e.prototype;a.extend(s,i.prototype);s._touchActionValue="pan-y";var r="createTouch"in document;var o=false;s._createDrag=function(){this.on("activate",this.onActivateDrag);this.on("uiChange",this._uiChangeDrag);this.on("deactivate",this.onDeactivateDrag);this.on("cellChange",this.updateDraggable);if(r&&!o){n.addEventListener("touchmove",function(){});o=true}};s.onActivateDrag=function(){this.handles=[this.viewport];this.bindHandles();this.updateDraggable()};s.onDeactivateDrag=function(){this.unbindHandles();this.element.classList.remove("is-draggable")};s.updateDraggable=function(){if(this.options.draggable==">1"){this.isDraggable=this.slides.length>1}else{this.isDraggable=this.options.draggable}if(this.isDraggable){this.element.classList.add("is-draggable")}else{this.element.classList.remove("is-draggable")}};s.bindDrag=function(){this.options.draggable=true;this.updateDraggable()};s.unbindDrag=function(){this.options.draggable=false;this.updateDraggable()};s._uiChangeDrag=function(){delete this.isFreeScrolling};s.pointerDown=function(t,e){if(!this.isDraggable){this._pointerDownDefault(t,e);return}var i=this.okayPointerDown(t);if(!i){return}this._pointerDownPreventDefault(t);this.pointerDownFocus(t);if(document.activeElement!=this.element){this.pointerDownBlur()}this.dragX=this.x;this.viewport.classList.add("is-pointer-down");this.pointerDownScroll=h();n.addEventListener("scroll",this);this._pointerDownDefault(t,e)};s._pointerDownDefault=function(t,e){this.pointerDownPointer={pageX:e.pageX,pageY:e.pageY};this._bindPostStartEvents(t);this.dispatchEvent("pointerDown",t,[e])};var l={INPUT:true,TEXTAREA:true,SELECT:true};s.pointerDownFocus=function(t){var e=l[t.target.nodeName];if(!e){this.focus()}};s._pointerDownPreventDefault=function(t){var e=t.type=="touchstart";var i=t.pointerType=="touch";var n=l[t.target.nodeName];if(!e&&!i&&!n){t.preventDefault()}};s.hasDragStarted=function(t){return Math.abs(t.x)>this.options.dragThreshold};s.pointerUp=function(t,e){delete this.isTouchScrolling;this.viewport.classList.remove("is-pointer-down");this.dispatchEvent("pointerUp",t,[e]);this._dragPointerUp(t,e)};s.pointerDone=function(){n.removeEventListener("scroll",this);delete this.pointerDownScroll};s.dragStart=function(t,e){if(!this.isDraggable){return}this.dragStartPosition=this.x;this.startAnimation();n.removeEventListener("scroll",this);this.dispatchEvent("dragStart",t,[e])};s.pointerMove=function(t,e){var i=this._dragPointerMove(t,e);this.dispatchEvent("pointerMove",t,[e,i]);this._dragMove(t,e,i)};s.dragMove=function(t,e,i){if(!this.isDraggable){return}t.preventDefault();this.previousDragX=this.dragX;var n=this.options.rightToLeft?-1:1;if(this.options.wrapAround){i.x%=this.slideableWidth}var s=this.dragStartPosition+i.x*n;if(!this.options.wrapAround&&this.slides.length){var r=Math.max(-this.slides[0].target,this.dragStartPosition);s=s>r?(s+r)*.5:s;var o=Math.min(-this.getLastSlide().target,this.dragStartPosition);s=s<o?(s+o)*.5:s}this.dragX=s;this.dragMoveTime=new Date;this.dispatchEvent("dragMove",t,[e,i])};s.dragEnd=function(t,e){if(!this.isDraggable){return}if(this.options.freeScroll){this.isFreeScrolling=true}var i=this.dragEndRestingSelect();if(this.options.freeScroll&&!this.options.wrapAround){var n=this.getRestingPosition();this.isFreeScrolling=-n>this.slides[0].target&&-n<this.getLastSlide().target}else if(!this.options.freeScroll&&i==this.selectedIndex){i+=this.dragEndBoostSelect()}delete this.previousDragX;this.isDragSelect=this.options.wrapAround;this.select(i);delete this.isDragSelect;this.dispatchEvent("dragEnd",t,[e])};s.dragEndRestingSelect=function(){var t=this.getRestingPosition();var e=Math.abs(this.getSlideDistance(-t,this.selectedIndex));var i=this._getClosestResting(t,e,1);var n=this._getClosestResting(t,e,-1);var s=i.distance<n.distance?i.index:n.index;return s};s._getClosestResting=function(t,e,i){var n=this.selectedIndex;var s=Infinity;var r=this.options.contain&&!this.options.wrapAround?function(t,e){return t<=e}:function(t,e){return t<e};while(r(e,s)){n+=i;s=e;e=this.getSlideDistance(-t,n);if(e===null){break}e=Math.abs(e)}return{distance:s,index:n-i}};s.getSlideDistance=function(t,e){var i=this.slides.length;var n=this.options.wrapAround&&i>1;var s=n?a.modulo(e,i):e;var r=this.slides[s];if(!r){return null}var o=n?this.slideableWidth*Math.floor(e/i):0;return t-(r.target+o)};s.dragEndBoostSelect=function(){if(this.previousDragX===undefined||!this.dragMoveTime||new Date-this.dragMoveTime>100){return 0}var t=this.getSlideDistance(-this.dragX,this.selectedIndex);var e=this.previousDragX-this.dragX;if(t>0&&e>0){return 1}else if(t<0&&e<0){return-1}return 0};s.staticClick=function(t,e){var i=this.getParentCell(t.target);var n=i&&i.element;var s=i&&this.cells.indexOf(i);this.dispatchEvent("staticClick",t,[e,n,s])};s.onscroll=function(){var t=h();var e=this.pointerDownScroll.x-t.x;var i=this.pointerDownScroll.y-t.y;if(Math.abs(e)>3||Math.abs(i)>3){this._pointerDone()}};function h(){return{x:n.pageXOffset,y:n.pageYOffset}}return e});(function(n,s){if(typeof define=="function"&&define.amd){define("flickity/js/prev-next-button",["./flickity","unipointer/unipointer","fizzy-ui-utils/utils"],function(t,e,i){return s(n,t,e,i)})}else if(typeof module=="object"&&module.exports){module.exports=s(n,require("./flickity"),require("unipointer"),require("fizzy-ui-utils"))}else{s(n,n.Flickity,n.Unipointer,n.fizzyUIUtils)}})(window,function t(e,i,n,s){var r="http://www.w3.org/2000/svg";function o(t,e){this.direction=t;this.parent=e;this._create()}o.prototype=Object.create(n.prototype);o.prototype._create=function(){this.isEnabled=true;this.isPrevious=this.direction==-1;var t=this.parent.options.rightToLeft?1:-1;this.isLeft=this.direction==t;var e=this.element=document.createElement("button");e.className="flickity-button flickity-prev-next-button";e.className+=this.isPrevious?" previous":" next";e.setAttribute("type","button");this.disable();e.setAttribute("aria-label",this.isPrevious?"Previous":"Next");var i=this.createSVG();e.appendChild(i);this.parent.on("select",this.update.bind(this));this.on("pointerDown",this.parent.childUIPointerDown.bind(this.parent))};o.prototype.activate=function(){this.bindStartEvent(this.element);this.element.addEventListener("click",this);this.parent.element.appendChild(this.element)};o.prototype.deactivate=function(){this.parent.element.removeChild(this.element);this.unbindStartEvent(this.element);this.element.removeEventListener("click",this)};o.prototype.createSVG=function(){var t=document.createElementNS(r,"svg");t.setAttribute("class","flickity-button-icon");t.setAttribute("viewBox","0 0 100 100");var e=document.createElementNS(r,"path");var i=a(this.parent.options.arrowShape);e.setAttribute("d",i);e.setAttribute("class","arrow");if(!this.isLeft){e.setAttribute("transform","translate(100, 100) rotate(180) ")}t.appendChild(e);return t};function a(t){if(typeof t=="string"){return t}return"M "+t.x0+",50"+" L "+t.x1+","+(t.y1+50)+" L "+t.x2+","+(t.y2+50)+" L "+t.x3+",50 "+" L "+t.x2+","+(50-t.y2)+" L "+t.x1+","+(50-t.y1)+" Z"}o.prototype.handleEvent=s.handleEvent;o.prototype.onclick=function(){if(!this.isEnabled){return}this.parent.uiChange();var t=this.isPrevious?"previous":"next";this.parent[t]()};o.prototype.enable=function(){if(this.isEnabled){return}this.element.disabled=false;this.isEnabled=true};o.prototype.disable=function(){if(!this.isEnabled){return}this.element.disabled=true;this.isEnabled=false};o.prototype.update=function(){var t=this.parent.slides;if(this.parent.options.wrapAround&&t.length>1){this.enable();return}var e=t.length?t.length-1:0;var i=this.isPrevious?0:e;var n=this.parent.selectedIndex==i?"disable":"enable";this[n]()};o.prototype.destroy=function(){this.deactivate();this.allOff()};s.extend(i.defaults,{prevNextButtons:true,arrowShape:{x0:10,x1:60,y1:50,x2:70,y2:40,x3:30}});i.createMethods.push("_createPrevNextButtons");var l=i.prototype;l._createPrevNextButtons=function(){if(!this.options.prevNextButtons){return}this.prevButton=new o(-1,this);this.nextButton=new o(1,this);this.on("activate",this.activatePrevNextButtons)};l.activatePrevNextButtons=function(){this.prevButton.activate();this.nextButton.activate();this.on("deactivate",this.deactivatePrevNextButtons)};l.deactivatePrevNextButtons=function(){this.prevButton.deactivate();this.nextButton.deactivate();this.off("deactivate",this.deactivatePrevNextButtons)};i.PrevNextButton=o;return i});(function(n,s){if(typeof define=="function"&&define.amd){define("flickity/js/page-dots",["./flickity","unipointer/unipointer","fizzy-ui-utils/utils"],function(t,e,i){return s(n,t,e,i)})}else if(typeof module=="object"&&module.exports){module.exports=s(n,require("./flickity"),require("unipointer"),require("fizzy-ui-utils"))}else{s(n,n.Flickity,n.Unipointer,n.fizzyUIUtils)}})(window,function t(e,i,n,s){function r(t){this.parent=t;this._create()}r.prototype=Object.create(n.prototype);r.prototype._create=function(){this.holder=document.createElement("ol");this.holder.className="flickity-page-dots";this.dots=[];this.handleClick=this.onClick.bind(this);this.on("pointerDown",this.parent.childUIPointerDown.bind(this.parent))};r.prototype.activate=function(){this.setDots();this.holder.addEventListener("click",this.handleClick);this.bindStartEvent(this.holder);this.parent.element.appendChild(this.holder)};r.prototype.deactivate=function(){this.holder.removeEventListener("click",this.handleClick);this.unbindStartEvent(this.holder);this.parent.element.removeChild(this.holder)};r.prototype.setDots=function(){var t=this.parent.slides.length-this.dots.length;if(t>0){this.addDots(t)}else if(t<0){this.removeDots(-t)}};r.prototype.addDots=function(t){var e=document.createDocumentFragment();var i=[];var n=this.dots.length;var s=n+t;for(var r=n;r<s;r++){var o=document.createElement("li");o.className="dot";o.setAttribute("aria-label","Page dot "+(r+1));e.appendChild(o);i.push(o)}this.holder.appendChild(e);this.dots=this.dots.concat(i)};r.prototype.removeDots=function(t){var e=this.dots.splice(this.dots.length-t,t);e.forEach(function(t){this.holder.removeChild(t)},this)};r.prototype.updateSelected=function(){if(this.selectedDot){this.selectedDot.className="dot";this.selectedDot.removeAttribute("aria-current")}if(!this.dots.length){return}this.selectedDot=this.dots[this.parent.selectedIndex];this.selectedDot.className="dot is-selected";this.selectedDot.setAttribute("aria-current","step")};r.prototype.onTap=r.prototype.onClick=function(t){var e=t.target;if(e.nodeName!="LI"){return}this.parent.uiChange();var i=this.dots.indexOf(e);this.parent.select(i)};r.prototype.destroy=function(){this.deactivate();this.allOff()};i.PageDots=r;s.extend(i.defaults,{pageDots:true});i.createMethods.push("_createPageDots");var o=i.prototype;o._createPageDots=function(){if(!this.options.pageDots){return}this.pageDots=new r(this);this.on("activate",this.activatePageDots);this.on("select",this.updateSelectedPageDots);this.on("cellChange",this.updatePageDots);this.on("resize",this.updatePageDots);this.on("deactivate",this.deactivatePageDots)};o.activatePageDots=function(){this.pageDots.activate()};o.updateSelectedPageDots=function(){this.pageDots.updateSelected()};o.updatePageDots=function(){this.pageDots.setDots()};o.deactivatePageDots=function(){this.pageDots.deactivate()};i.PageDots=r;return i});(function(t,n){if(typeof define=="function"&&define.amd){define("flickity/js/player",["ev-emitter/ev-emitter","fizzy-ui-utils/utils","./flickity"],function(t,e,i){return n(t,e,i)})}else if(typeof module=="object"&&module.exports){module.exports=n(require("ev-emitter"),require("fizzy-ui-utils"),require("./flickity"))}else{n(t.EvEmitter,t.fizzyUIUtils,t.Flickity)}})(window,function t(e,i,n){function s(t){this.parent=t;this.state="stopped";this.onVisibilityChange=this.visibilityChange.bind(this);this.onVisibilityPlay=this.visibilityPlay.bind(this)}s.prototype=Object.create(e.prototype);s.prototype.play=function(){if(this.state=="playing"){return}var t=document.hidden;if(t){document.addEventListener("visibilitychange",this.onVisibilityPlay);return}this.state="playing";document.addEventListener("visibilitychange",this.onVisibilityChange);this.tick()};s.prototype.tick=function(){if(this.state!="playing"){return}var t=this.parent.options.autoPlay;t=typeof t=="number"?t:3e3;var e=this;this.clear();this.timeout=setTimeout(function(){e.parent.next(true);e.tick()},t)};s.prototype.stop=function(){this.state="stopped";this.clear();document.removeEventListener("visibilitychange",this.onVisibilityChange)};s.prototype.clear=function(){clearTimeout(this.timeout)};s.prototype.pause=function(){if(this.state=="playing"){this.state="paused";this.clear()}};s.prototype.unpause=function(){if(this.state=="paused"){this.play()}};s.prototype.visibilityChange=function(){var t=document.hidden;this[t?"pause":"unpause"]()};s.prototype.visibilityPlay=function(){this.play();document.removeEventListener("visibilitychange",this.onVisibilityPlay)};i.extend(n.defaults,{pauseAutoPlayOnHover:true});n.createMethods.push("_createPlayer");var r=n.prototype;r._createPlayer=function(){this.player=new s(this);this.on("activate",this.activatePlayer);this.on("uiChange",this.stopPlayer);this.on("pointerDown",this.stopPlayer);this.on("deactivate",this.deactivatePlayer)};r.activatePlayer=function(){if(!this.options.autoPlay){return}this.player.play();this.element.addEventListener("mouseenter",this)};r.playPlayer=function(){this.player.play()};r.stopPlayer=function(){this.player.stop()};r.pausePlayer=function(){this.player.pause()};r.unpausePlayer=function(){this.player.unpause()};r.deactivatePlayer=function(){this.player.stop();this.element.removeEventListener("mouseenter",this)};r.onmouseenter=function(){if(!this.options.pauseAutoPlayOnHover){return}this.player.pause();this.element.addEventListener("mouseleave",this)};r.onmouseleave=function(){this.player.unpause();this.element.removeEventListener("mouseleave",this)};n.Player=s;return n});(function(i,n){if(typeof define=="function"&&define.amd){define("flickity/js/add-remove-cell",["./flickity","fizzy-ui-utils/utils"],function(t,e){return n(i,t,e)})}else if(typeof module=="object"&&module.exports){module.exports=n(i,require("./flickity"),require("fizzy-ui-utils"))}else{n(i,i.Flickity,i.fizzyUIUtils)}})(window,function t(e,i,n){function l(t){var e=document.createDocumentFragment();t.forEach(function(t){e.appendChild(t.element)});return e}var s=i.prototype;s.insert=function(t,e){var i=this._makeCells(t);if(!i||!i.length){return}var n=this.cells.length;e=e===undefined?n:e;var s=l(i);var r=e==n;if(r){this.slider.appendChild(s)}else{var o=this.cells[e].element;this.slider.insertBefore(s,o)}if(e===0){this.cells=i.concat(this.cells)}else if(r){this.cells=this.cells.concat(i)}else{var a=this.cells.splice(e,n-e);this.cells=this.cells.concat(i).concat(a)}this._sizeCells(i);this.cellChange(e,true)};s.append=function(t){this.insert(t,this.cells.length)};s.prepend=function(t){this.insert(t,0)};s.remove=function(t){var e=this.getCells(t);if(!e||!e.length){return}var i=this.cells.length-1;e.forEach(function(t){t.remove();var e=this.cells.indexOf(t);i=Math.min(e,i);n.removeFrom(this.cells,t)},this);this.cellChange(i,true)};s.cellSizeChange=function(t){var e=this.getCell(t);if(!e){return}e.getSize();var i=this.cells.indexOf(e);this.cellChange(i)};s.cellChange=function(t,e){var i=this.selectedElement;this._positionCells(t);this._getWrapShiftCells();this.setGallerySize();var n=this.getCell(i);if(n){this.selectedIndex=this.getCellSlideIndex(n)}this.selectedIndex=Math.min(this.slides.length-1,this.selectedIndex);this.emitEvent("cellChange",[t]);this.select(this.selectedIndex);if(e){this.positionSliderAtSelected()}};return i});(function(i,n){if(typeof define=="function"&&define.amd){define("flickity/js/lazyload",["./flickity","fizzy-ui-utils/utils"],function(t,e){return n(i,t,e)})}else if(typeof module=="object"&&module.exports){module.exports=n(i,require("./flickity"),require("fizzy-ui-utils"))}else{n(i,i.Flickity,i.fizzyUIUtils)}})(window,function t(e,i,o){i.createMethods.push("_createLazyload");var n=i.prototype;n._createLazyload=function(){this.on("select",this.lazyLoad)};n.lazyLoad=function(){var t=this.options.lazyLoad;if(!t){return}var e=typeof t=="number"?t:0;var i=this.getAdjacentCellElements(e);var n=[];i.forEach(function(t){var e=s(t);n=n.concat(e)});n.forEach(function(t){new r(t,this)},this)};function s(t){if(t.nodeName=="IMG"){var e=t.getAttribute("data-flickity-lazyload");var i=t.getAttribute("data-flickity-lazyload-src");var n=t.getAttribute("data-flickity-lazyload-srcset");if(e||i||n){return[t]}}var s="img[data-flickity-lazyload], "+"img[data-flickity-lazyload-src], img[data-flickity-lazyload-srcset]";var r=t.querySelectorAll(s);return o.makeArray(r)}function r(t,e){this.img=t;this.flickity=e;this.load()}r.prototype.handleEvent=o.handleEvent;r.prototype.load=function(){this.img.addEventListener("load",this);this.img.addEventListener("error",this);var t=this.img.getAttribute("data-flickity-lazyload")||this.img.getAttribute("data-flickity-lazyload-src");var e=this.img.getAttribute("data-flickity-lazyload-srcset");this.img.src=t;if(e){this.img.setAttribute("srcset",e)}this.img.removeAttribute("data-flickity-lazyload");this.img.removeAttribute("data-flickity-lazyload-src");this.img.removeAttribute("data-flickity-lazyload-srcset")};r.prototype.onload=function(t){this.complete(t,"flickity-lazyloaded")};r.prototype.onerror=function(t){this.complete(t,"flickity-lazyerror")};r.prototype.complete=function(t,e){this.img.removeEventListener("load",this);this.img.removeEventListener("error",this);var i=this.flickity.getParentCell(this.img);var n=i&&i.element;this.flickity.cellSizeChange(n);this.img.classList.add(e);this.flickity.dispatchEvent("lazyLoad",t,n)};i.LazyLoader=r;return i});
/*!
 * Flickity v2.2.3
 * Touch, responsive, flickable carousels
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * https://flickity.metafizzy.co
 * Copyright 2015-2021 Metafizzy
 */
(function(t,e){if(typeof define=="function"&&define.amd){define("flickity/js/index",["./flickity","./drag","./prev-next-button","./page-dots","./player","./add-remove-cell","./lazyload"],e)}else if(typeof module=="object"&&module.exports){module.exports=e(require("./flickity"),require("./drag"),require("./prev-next-button"),require("./page-dots"),require("./player"),require("./add-remove-cell"),require("./lazyload"))}})(window,function t(e){return e});
/*!
 * Flickity asNavFor v2.0.2
 * enable asNavFor for Flickity
 */
(function(t,e){if(typeof define=="function"&&define.amd){define("flickity-as-nav-for/as-nav-for",["flickity/js/index","fizzy-ui-utils/utils"],e)}else if(typeof module=="object"&&module.exports){module.exports=e(require("flickity"),require("fizzy-ui-utils"))}else{t.Flickity=e(t.Flickity,t.fizzyUIUtils)}})(window,function t(n,s){n.createMethods.push("_createAsNavFor");var e=n.prototype;e._createAsNavFor=function(){this.on("activate",this.activateAsNavFor);this.on("deactivate",this.deactivateAsNavFor);this.on("destroy",this.destroyAsNavFor);var e=this.options.asNavFor;if(!e){return}var i=this;setTimeout(function t(){i.setNavCompanion(e)})};e.setNavCompanion=function(t){t=s.getQueryElement(t);var e=n.data(t);if(!e||e==this){return}this.navCompanion=e;var i=this;this.onNavCompanionSelect=function(){i.navCompanionSelect()};e.on("select",this.onNavCompanionSelect);this.on("staticClick",this.onNavStaticClick);this.navCompanionSelect(true)};e.navCompanionSelect=function(t){var e=this.navCompanion&&this.navCompanion.selectedCells;if(!e){return}var i=e[0];var n=this.navCompanion.cells.indexOf(i);var s=n+e.length-1;var r=Math.floor(a(n,s,this.navCompanion.cellAlign));this.selectCell(r,false,t);this.removeNavSelectedElements();if(r>=this.cells.length){return}var o=this.cells.slice(n,s+1);this.navSelectedElements=o.map(function(t){return t.element});this.changeNavSelectedClass("add")};function a(t,e,i){return(e-t)*i+t}e.changeNavSelectedClass=function(e){this.navSelectedElements.forEach(function(t){t.classList[e]("is-nav-selected")})};e.activateAsNavFor=function(){this.navCompanionSelect(true)};e.removeNavSelectedElements=function(){if(!this.navSelectedElements){return}this.changeNavSelectedClass("remove");delete this.navSelectedElements};e.onNavStaticClick=function(t,e,i,n){if(typeof n=="number"){this.navCompanion.selectCell(n)}};e.deactivateAsNavFor=function(){this.removeNavSelectedElements()};e.destroyAsNavFor=function(){if(!this.navCompanion){return}this.navCompanion.off("select",this.onNavCompanionSelect);this.off("staticClick",this.onNavStaticClick);delete this.navCompanion};return n});
/*!
 * imagesLoaded v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
(function(e,i){"use strict";if(typeof define=="function"&&define.amd){define("imagesloaded/imagesloaded",["ev-emitter/ev-emitter"],function(t){return i(e,t)})}else if(typeof module=="object"&&module.exports){module.exports=i(e,require("ev-emitter"))}else{e.imagesLoaded=i(e,e.EvEmitter)}})(typeof window!=="undefined"?window:this,function t(e,i){var s=e.jQuery;var r=e.console;function o(t,e){for(var i in e){t[i]=e[i]}return t}var n=Array.prototype.slice;function a(t){if(Array.isArray(t)){return t}var e=typeof t=="object"&&typeof t.length=="number";if(e){return n.call(t)}return[t]}function l(t,e,i){if(!(this instanceof l)){return new l(t,e,i)}var n=t;if(typeof t=="string"){n=document.querySelectorAll(t)}if(!n){r.error("Bad element for imagesLoaded "+(n||t));return}this.elements=a(n);this.options=o({},this.options);if(typeof e=="function"){i=e}else{o(this.options,e)}if(i){this.on("always",i)}this.getImages();if(s){this.jqDeferred=new s.Deferred}setTimeout(this.check.bind(this))}l.prototype=Object.create(i.prototype);l.prototype.options={};l.prototype.getImages=function(){this.images=[];this.elements.forEach(this.addElementImages,this)};l.prototype.addElementImages=function(t){if(t.nodeName=="IMG"){this.addImage(t)}if(this.options.background===true){this.addElementBackgroundImages(t)}var e=t.nodeType;if(!e||!h[e]){return}var i=t.querySelectorAll("img");for(var n=0;n<i.length;n++){var s=i[n];this.addImage(s)}if(typeof this.options.background=="string"){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var o=r[n];this.addElementBackgroundImages(o)}}};var h={1:true,9:true,11:true};l.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(!e){return}var i=/url\((['"])?(.*?)\1\)/gi;var n=i.exec(e.backgroundImage);while(n!==null){var s=n&&n[2];if(s){this.addBackground(s,t)}n=i.exec(e.backgroundImage)}};l.prototype.addImage=function(t){var e=new c(t);this.images.push(e)};l.prototype.addBackground=function(t,e){var i=new u(t,e);this.images.push(i)};l.prototype.check=function(){var n=this;this.progressedCount=0;this.hasAnyBroken=false;if(!this.images.length){this.complete();return}function e(t,e,i){setTimeout(function(){n.progress(t,e,i)})}this.images.forEach(function(t){t.once("progress",e);t.check()})};l.prototype.progress=function(t,e,i){this.progressedCount++;this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded;this.emitEvent("progress",[this,t,e]);if(this.jqDeferred&&this.jqDeferred.notify){this.jqDeferred.notify(this,t)}if(this.progressedCount==this.images.length){this.complete()}if(this.options.debug&&r){r.log("progress: "+i,t,e)}};l.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";this.isComplete=true;this.emitEvent(t,[this]);this.emitEvent("always",[this]);if(this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}};function c(t){this.img=t}c.prototype=Object.create(i.prototype);c.prototype.check=function(){var t=this.getIsImageComplete();if(t){this.confirm(this.img.naturalWidth!==0,"naturalWidth");return}this.proxyImage=new Image;this.proxyImage.addEventListener("load",this);this.proxyImage.addEventListener("error",this);this.img.addEventListener("load",this);this.img.addEventListener("error",this);this.proxyImage.src=this.img.src};c.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth};c.prototype.confirm=function(t,e){this.isLoaded=t;this.emitEvent("progress",[this,this.img,e])};c.prototype.handleEvent=function(t){var e="on"+t.type;if(this[e]){this[e](t)}};c.prototype.onload=function(){this.confirm(true,"onload");this.unbindEvents()};c.prototype.onerror=function(){this.confirm(false,"onerror");this.unbindEvents()};c.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this);this.proxyImage.removeEventListener("error",this);this.img.removeEventListener("load",this);this.img.removeEventListener("error",this)};function u(t,e){this.url=t;this.element=e;this.img=new Image}u.prototype=Object.create(c.prototype);u.prototype.check=function(){this.img.addEventListener("load",this);this.img.addEventListener("error",this);this.img.src=this.url;var t=this.getIsImageComplete();if(t){this.confirm(this.img.naturalWidth!==0,"naturalWidth");this.unbindEvents()}};u.prototype.unbindEvents=function(){this.img.removeEventListener("load",this);this.img.removeEventListener("error",this)};u.prototype.confirm=function(t,e){this.isLoaded=t;this.emitEvent("progress",[this,this.element,e])};l.makeJQueryPlugin=function(t){t=t||e.jQuery;if(!t){return}s=t;s.fn.imagesLoaded=function(t,e){var i=new l(this,t,e);return i.jqDeferred.promise(s(this))}};l.makeJQueryPlugin();return l});
/*!
 * Flickity imagesLoaded v2.0.0
 * enables imagesLoaded option for Flickity
 */
(function(i,n){if(typeof define=="function"&&define.amd){define(["flickity/js/index","imagesloaded/imagesloaded"],function(t,e){return n(i,t,e)})}else if(typeof module=="object"&&module.exports){module.exports=n(i,require("flickity"),require("imagesloaded"))}else{i.Flickity=n(i,i.Flickity,i.imagesLoaded)}})(window,function t(e,i,s){"use strict";i.createMethods.push("_createImagesLoaded");var n=i.prototype;n._createImagesLoaded=function(){this.on("activate",this.imagesLoaded)};n.imagesLoaded=function(){if(!this.options.imagesLoaded){return}var n=this;function t(t,e){var i=n.getParentCell(e.img);n.cellSizeChange(i&&i.element);if(!n.options.freeScroll){n.positionSliderAtSelected()}}s(this.slider).on("progress",t)};return i});
