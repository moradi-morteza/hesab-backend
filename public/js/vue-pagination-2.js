//https://github.com/lokyoung/vuejs-paginate/blob/master/src/components/Paginate.vue
//https://reposhub.com/vuejs/pagination/matfish2-vue-pagination-2.html
window["Pagination"] = (function (t) {
    var e = {};

    function i(s) {
        if (e[s]) {
            return e[s].exports;
        }
        var n = (e[s] = {i: s, l: false, exports: {}});
        t[s].call(n.exports, n, n.exports, i);
        n.l = true;
        return n.exports;
    }

    i.m = t;
    i.c = e;
    i.d = function (t, e, s) {
        if (!i.o(t, e)) {
            Object.defineProperty(t, e, {enumerable: true, get: s});
        }
    };
    i.r = function (t) {
        if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
            Object.defineProperty(t, Symbol.toStringTag, {value: "Module"});
        }
        Object.defineProperty(t, "__esModule", {value: true});
    };
    i.t = function (t, e) {
        if (e & 1) t = i(t);
        if (e & 8) return t;
        if (e & 4 && typeof t === "object" && t && t.__esModule) return t;
        var s = Object.create(null);
        i.r(s);
        Object.defineProperty(s, "default", {enumerable: true, value: t});
        if (e & 2 && typeof t != "string")
            for (var n in t)
                i.d(
                    s,
                    n,
                    function (e) {
                        return t[e];
                    }.bind(null, n)
                );
        return s;
    };
    i.n = function (t) {
        var e =
            t && t.__esModule
                ? function e() {
                    return t["default"];
                }
                : function e() {
                    return t;
                };
        i.d(e, "a", e);
        return e;
    };
    i.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e);
    };
    i.p = "/dist/";
    return i((i.s = 7));
})([
    function (t, e, i) {
        "use strict";
        t.exports = {
            nav: "",
            count: "",
            wrapper: "pagination",
            list: "pagination-list",
            item: "",
            link: "pagination-link",
            next: "",
            prev: "",
            active: "is-current",
            disabled: ""
        };
    },
    function (t, e, i) {
        "use strict";
        t.exports = {
            nav: "",
            count: "",
            wrapper: "",
            list: "pagination",
            item: "page-item",
            link: "page-link",
            next: "",
            prev: "",
            active: "active",
            disabled: "disabled"
        };
    },
    function (t, e, i) {
        "use strict";
        t.exports = {
            nav: "",
            count: "",
            wrapper: "",
            list: "pagination",
            item: "page-item",
            link: "page-link",
            next: "",
            prev: "",
            active: "active",
            disabled: "disabled"
        };
    },
    function (t, e, i) {
        "use strict";
        Object.defineProperty(e, "__esModule", {value: true});
        e.isPlainObject = e.clone = e.recursive = e.merge = e.main = void 0;
        t.exports = e = s;
        e.default = s;

        function s() {
            var t = [];
            for (var e = 0; e < arguments.length; e++) {
                t[e] = arguments[e];
            }
            return n.apply(void 0, t);
        }

        e.main = s;
        s.clone = r;
        s.isPlainObject = o;
        s.recursive = a;

        function n() {
            var t = [];
            for (var e = 0; e < arguments.length; e++) {
                t[e] = arguments[e];
            }
            return h(t[0] === true, false, t);
        }

        e.merge = n;

        function a() {
            var t = [];
            for (var e = 0; e < arguments.length; e++) {
                t[e] = arguments[e];
            }
            return h(t[0] === true, true, t);
        }

        e.recursive = a;

        function r(t) {
            if (Array.isArray(t)) {
                var e = [];
                for (var i = 0; i < t.length; ++i) e.push(r(t[i]));
                return e;
            } else if (o(t)) {
                var e = {};
                for (var i in t) e[i] = r(t[i]);
                return e;
            } else {
                return t;
            }
        }

        e.clone = r;

        function o(t) {
            return t && typeof t === "object" && !Array.isArray(t);
        }

        e.isPlainObject = o;

        function u(t, e) {
            if (!o(t)) return e;
            for (var i in e) {
                if (i === "__proto__" || i === "constructor" || i === "prototype") continue;
                t[i] = o(t[i]) && o(e[i]) ? u(t[i], e[i]) : e[i];
            }
            return t;
        }

        function h(t, e, i) {
            var s;
            if (t || !o((s = i.shift()))) s = {};
            for (var n = 0; n < i.length; ++n) {
                var a = i[n];
                if (!o(a)) continue;
                for (var h in a) {
                    if (h === "__proto__" || h === "constructor" || h === "prototype") continue;
                    var l = t ? r(a[h]) : a[h];
                    s[h] = e ? u(s[h], l) : l;
                }
            }
            return s;
        }
    },
    function (t, e, i) {
        "use strict";
        Object.defineProperty(e, "__esModule", {value: true});
        e.default = function () {
            return {
                format: true,
                chunk: 10,
                chunksNavigation: "fixed",
                edgeNavigation: false,
                theme: "bootstrap3",
                template: null,
                texts: {
                    count: (site_lang ==='en') ? "Showing {from} to {to} of {count} records | {count} records | One record" : ((site_lang ==='ar') ? '?????????? {from} - {to} ???? {count} ?????????????? |{count} ?????????????? | ?????? ????????' : ((site_lang.substr(0,2)==='fa') ? " ?????????? {from} - {to} ???? {count} ???????? |{count} ???????? | ???? ???????? " : "Showing {from} to {to} of {count} records | {count} records | One record")),
                    first: "First",
                    last: "Last",
                    nextPage: ">",
                    nextChunk: ">>",
                    prevPage: "<",
                    prevChunk: "<<"
                },
            };
        };
        t.exports = e["default"];
    },
    function (t, e, i) {
        "use strict";
        var s =
            typeof Symbol === "function" && typeof Symbol.iterator === "symbol"
                ? function (t) {
                    return typeof t;
                }
                : function (t) {
                    return t && typeof Symbol === "function" && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
                };
        Object.defineProperty(e, "__esModule", {value: true});
        var n =
            typeof Symbol === "function" && s(Symbol.iterator) === "symbol"
                ? function (t) {
                    return typeof t === "undefined" ? "undefined" : s(t);
                }
                : function (t) {
                    return t && typeof Symbol === "function" && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t === "undefined" ? "undefined" : s(t);
                };
        var a = i(4);
        var r = h(a);
        var o = i(3);
        var u = h(o);

        function h(t) {
            return t && t.__esModule ? t : {default: t};
        }

        e.default = {
            inject: ["Page", "records", "perPage"],
            props: {itemClass: {required: false, default: "VuePagination__pagination-item"}},
            render: function t() {
                var e = this;
                return this.$scopedSlots.default({
                    override: this.opts.template,
                    showPagination: this.totalPages > 1,
                    pages: this.pages,
                    pageEvents: function t(i) {
                        return {
                            click: function t() {
                                return e.setPage(i);
                            },
                            keydown: function t(i) {
                                if (i.key === "ArrowRight") {
                                    e.next();
                                }
                                if (i.key === "ArrowLeft") {
                                    e.prev();
                                }
                            },
                        };
                    },
                    activeClass: this.activeClass,
                    hasEdgeNav: this.opts.edgeNavigation && this.totalChunks > 1,
                    setPage: this.setPage,
                    setFirstPage: this.setPage.bind(this, 1),
                    setLastPage: this.setPage.bind(this, this.totalPages),
                    hasChunksNav: this.opts.chunksNavigation === "fixed",
                    setPrevChunk: this.prevChunk,
                    setNextChunk: this.nextChunk,
                    setPrevPage: this.prev,
                    firstPageProps: {class: this.Theme.link, disabled: this.page === 1},
                    lastPageProps: {class: this.Theme.link, disabled: this.page === this.totalPages},
                    prevProps: {class: this.Theme.link, disabled: !!this.allowedPageClass(this.page - 1)},
                    nextProps: {class: this.Theme.link, disabled: !!this.allowedPageClass(this.page + 1)},
                    pageClasses: function t(i) {
                        return e.itemClass + " " + e.Theme.item + " " + e.activeClass(i);
                    },
                    prevChunkProps: {class: this.Theme.link, disabled: !this.allowedChunk(-1)},
                    nextChunkProps: {class: this.Theme.link, disabled: !this.allowedChunk(1)},
                    setNextPage: this.next,
                    theme: {
                        nav: this.Theme.nav,
                        list: "VuePagination__pagination " + this.Theme.list,
                        item: this.Theme.item,
                        disabled: this.Theme.disabled,
                        prev: this.itemClass + " " + this.itemClass + "-prev-page " + this.Theme.item + " " + this.Theme.prev + " " + this.allowedPageClass(this.page - 1),
                        next: this.itemClass + "  " + this.itemClass + "-next-page " + this.Theme.item + " " + this.Theme.next + " " + this.allowedPageClass(this.page + 1),
                        prevChunk: this.itemClass + " " + this.Theme.item + " " + this.Theme.prev + " " + this.itemClass + "-prev-chunk " + this.allowedChunkClass(-1),
                        nextChunk: this.itemClass + " " + this.Theme.item + " " + this.Theme.next + " " + this.itemClass + "-next-chunk " + this.allowedChunkClass(1),
                        firstPage: this.itemClass + " " + this.Theme.item + " " + (this.page === 1 ? this.Theme.disabled : "") + " " + this.itemClass + "-first-page",
                        lastPage: this.itemClass + " " + this.Theme.item + " " + (this.page === this.totalPages ? this.Theme.disabled : "") + " " + this.itemClass + "-last-page",
                        link: this.Theme.link,
                        page: this.itemClass + " " + this.Theme.item,
                        wrapper: this.Theme.wrapper,
                        count: "VuePagination__count " + this.Theme.count,
                    },
                    hasRecords: this.hasRecords,
                    count: this.count,
                    texts: this.opts.texts,
                    opts: this.opts,
                    allowedChunkClass: this.allowedChunkClass,
                    allowedPageClass: this.allowedPageClass,
                    setChunk: this.setChunk,
                    prev: this.prev,
                    next: this.next,
                    totalPages: this.totalPages,
                    totalChunks: this.totalChunks,
                    page: this.Page(),
                    records: this.records(),
                    perPage: this.perPage(),
                    formatNumber: this.formatNumber,
                });
            },
            data: function t() {
                return {firstPage: this.$parent.value, For: this.$parent.for, Options: this.$parent.options};
            },
            watch: {
                page: function t(e) {
                    if (this.opts.chunksNavigation === "scroll" && this.allowedPage(e) && !this.inDisplay(e)) {
                        if (e === this.totalPages) {
                            var i = e - this.opts.chunk + 1;
                            this.firstPage = i >= 1 ? i : 1;
                        } else {
                            this.firstPage = e;
                        }
                    }
                    this.$parent.$emit("paginate", e);
                },
            },
            computed: {
                Records: function t() {
                    return this.records();
                },
                PerPage: function t() {
                    return this.perPage();
                },
                opts: function t() {
                    return u.default.recursive((0, r.default)(), this.Options);
                },
                Theme: function t() {
                    if (n(this.opts.theme) === "object") {
                        return this.opts.theme;
                    }
                    var e = {bootstrap3: i(2), bootstrap4: i(1), bulma: i(0)};
                    if (n(e[this.opts.theme]) === undefined) {
                        throw "vue-pagination-2: the theme " + this.opts.theme + " does not exist";
                    }
                    return e[this.opts.theme];
                },
                page: function t() {
                    return this.Page();
                },
                pages: function t() {
                    if (!this.Records) return [];
                    return l(this.paginationStart, this.pagesInCurrentChunk);
                },
                totalPages: function t() {
                    return this.Records ? Math.ceil(this.Records / this.PerPage) : 1;
                },
                totalChunks: function t() {
                    return Math.ceil(this.totalPages / this.opts.chunk);
                },
                currentChunk: function t() {
                    return Math.ceil(this.page / this.opts.chunk);
                },
                paginationStart: function t() {
                    if (this.opts.chunksNavigation === "scroll") {
                        return this.firstPage;
                    }
                    return (this.currentChunk - 1) * this.opts.chunk + 1;
                },
                pagesInCurrentChunk: function t() {
                    return this.paginationStart + this.opts.chunk <= this.totalPages ? this.opts.chunk : this.totalPages - this.paginationStart + 1;
                },
                hasRecords: function t() {
                    return parseInt(this.Records) > 0;
                },
                count: function t() {
                    if (/{page}/.test(this.opts.texts.count)) {
                        if (this.totalPages <= 1) return "";
                        return this.opts.texts.count.replace("{page}", this.page).replace("{pages}", this.totalPages);
                    }
                    var e = this.opts.texts.count.split("|");
                    var i = (this.page - 1) * this.PerPage + 1;
                    var s = this.page == this.totalPages ? this.Records : i + this.PerPage - 1;
                    var n = Math.min(this.Records == 1 ? 2 : this.totalPages == 1 ? 1 : 0, e.length - 1);
                    return e[n].replace("{count}", this.formatNumber(this.Records)).replace("{from}", this.formatNumber(i)).replace("{to}", this.formatNumber(s));
                },
            },
            methods: {
                setPage: function t(e) {
                    if (this.allowedPage(e)) {
                        this.paginate(e);
                    }
                },
                paginate: function t(e) {
                    var i = this;
                    this.$parent.$emit("input", e);
                    this.$nextTick(function () {
                        if (i.$el) {
                            i.$el.querySelector("li.active a").focus();
                        }
                    });
                },
                next: function t() {
                    return this.setPage(this.page + 1);
                },
                prev: function t() {
                    return this.setPage(this.page - 1);
                },
                inDisplay: function t(e) {
                    var i = this.firstPage;
                    var s = i + this.opts.chunk - 1;
                    return e >= i && e <= s;
                },
                nextChunk: function t() {
                    return this.setChunk(1);
                },
                prevChunk: function t() {
                    return this.setChunk(-1);
                },
                setChunk: function t(e) {
                    this.setPage((this.currentChunk - 1 + e) * this.opts.chunk + 1);
                },
                allowedPage: function t(e) {
                    return e >= 1 && e <= this.totalPages;
                },
                allowedChunk: function t(e) {
                    return (e == 1 && this.currentChunk < this.totalChunks) || (e == -1 && this.currentChunk > 1);
                },
                allowedPageClass: function t(e) {
                    return this.allowedPage(e) ? "" : this.Theme.disabled;
                },
                allowedChunkClass: function t(e) {
                    return this.allowedChunk(e) ? "" : this.Theme.disabled;
                },
                activeClass: function t(e) {
                    return this.page == e ? this.Theme.active : "";
                },
                formatNumber: function t(e) {
                    if (!this.opts.format) return e;
                    return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
            },
        };

        function l(t, e) {
            return Array.apply(0, Array(e)).map(function (e, i) {
                return i + t;
            });
        }

        t.exports = e["default"];
    },
    function (t, e, i) {
        "use strict";
        t.exports = function (t) {
            return function (t) {
                var e = this.theme;
                var i = "";
                var s = "";
                var n = "";
                var a = "";
                var r = this.pages.map(
                    function (i) {
                        return t("li", {
                            class: "VuePagination__pagination-item " + e.item + " " + this.activeClass(i),
                            on: {click: this.setPage.bind(this, i)}
                        }, [
                            t("a", {
                                class: e.link + " " + this.activeClass(i),
                                attrs: {role: "button"}
                            }, [this.formatNumber(i)]),
                        ]);
                    }.bind(this)
                );
                if (this.opts.edgeNavigation && this.totalChunks > 1) {
                    n = t("li", {
                        class: "VuePagination__pagination-item " + e.item + " " + (this.page === 1 ? e.disabled : "") + " VuePagination__pagination-item-first-page",
                        on: {click: this.setPage.bind(this, 1)}
                    }, [
                        t("a", {class: e.link, attrs: {disabled: this.page === 1}}, [this.opts.texts.first]),
                    ]);
                    a = t(
                        "li",
                        {
                            class: "VuePagination__pagination-item " + e.item + " " + (this.page === this.totalPages ? e.disabled : "") + " VuePagination__pagination-item-last-page",
                            on: {click: this.setPage.bind(this, this.totalPages)}
                        },
                        [t("a", {
                            class: e.link,
                            attrs: {disabled: this.page === this.totalPages}
                        }, [this.opts.texts.last])]
                    );
                }
                if (this.opts.chunksNavigation === "fixed") {
                    i = t("li", {
                        class: "VuePagination__pagination-item " + e.item + " " + e.prev + " VuePagination__pagination-item-prev-chunk " + this.allowedChunkClass(-1),
                        on: {click: this.setChunk.bind(this, -1)}
                    }, [
                        t("a", {
                            class: e.link,
                            attrs: {disabled: !!this.allowedChunkClass(-1)}
                        }, [this.opts.texts.prevChunk]),
                    ]);
                    s = t("li", {
                        class: "VuePagination__pagination-item " + e.item + " " + e.next + " VuePagination__pagination-item-next-chunk " + this.allowedChunkClass(1),
                        on: {click: this.setChunk.bind(this, 1)}
                    }, [
                        t("a", {
                            class: e.link,
                            attrs: {disabled: !!this.allowedChunkClass(1)}
                        }, [this.opts.texts.nextChunk]),
                    ]);
                }
                return t("div", {class: "VuePagination " + e.wrapper}, [
                    t("nav", {class: "" + e.nav}, [
                        t("ul", {
                            directives: [{name: "show", value: this.totalPages > 1}],
                            class: e.list + " VuePagination__pagination"
                        }, [
                            n,
                            i,
                            t("li", {
                                class: "VuePagination__pagination-item " + e.item + " " + e.prev + " VuePagination__pagination-item-prev-page " + this.allowedPageClass(this.page - 1),
                                on: {click: this.prev.bind(this)}
                            }, [
                                t("a", {
                                    class: e.link,
                                    attrs: {disabled: !!this.allowedPageClass(this.page - 1)}
                                }, [this.opts.texts.prevPage]),
                            ]),
                            r,
                            t("li", {
                                class: "VuePagination__pagination-item " + e.item + " " + e.next + " VuePagination__pagination-item-next-page " + this.allowedPageClass(this.page + 1),
                                on: {click: this.next.bind(this)}
                            }, [
                                t("a", {
                                    class: e.link,
                                    attrs: {disabled: !!this.allowedPageClass(this.page + 1)}
                                }, [this.opts.texts.nextPage]),
                            ]),
                            s,
                            a,
                        ]),
                        t("p", {
                            directives: [{name: "show", value: parseInt(this.records)}],
                            class: "VuePagination__count " + e.count
                        }, [this.count]),
                    ]),
                ]);
            }.bind(t);
        };
    },
    function (t, e, i) {
        "use strict";
        Object.defineProperty(e, "__esModule", {value: true});
        var s = i(6);
        var n = o(s);
        var a = i(5);
        var r = o(a);

        function o(t) {
            return t && t.__esModule ? t : {default: t};
        }

        e.default = {
            name: "Pagination",
            components: {RenderlessPagination: r.default},
            provide: function t() {
                var e = this;
                return {
                    Page: function t() {
                        return e.value;
                    },
                    perPage: function t() {
                        return e.perPage;
                    },
                    records: function t() {
                        return e.records;
                    },
                };
            },
            render: function t(e) {
                return e("renderless-pagination", {
                    scopedSlots: {
                        default: function t(i) {
                            return i.override ? e(i.override, {attrs: {props: i}}) : (0, n.default)(i)(e);
                        },
                    },
                });
            },
            props: {
                value: {
                    type: Number,
                    required: true,
                    validator: function t(e) {
                        return e > 0;
                    },
                },
                records: {type: Number, required: true},
                perPage: {type: Number, default: 25},
                options: {type: Object},
            },
            data: function t() {
                return {aProps: {role: "button"}};
            },
        };
        t.exports = e["default"];
    },
]);
