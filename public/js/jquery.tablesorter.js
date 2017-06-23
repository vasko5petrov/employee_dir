! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof module && "object" == typeof module.exports ? module.exports = e(require("jquery")) : e(jQuery)
}(function(e) {
    return function(t) {
        "use strict";
        var r = t.tablesorter = {
            version: "2.28.14",
            parsers: [],
            widgets: [],
            defaults: {
                theme: "default",
                widthFixed: !1,
                showProcessing: !1,
                headerTemplate: "{content}",
                onRenderTemplate: null,
                onRenderHeader: null,
                cancelSelection: !0,
                tabIndex: !0,
                dateFormat: "mmddyyyy",
                sortMultiSortKey: "shiftKey",
                sortResetKey: "ctrlKey",
                usNumberFormat: !0,
                delayInit: !1,
                serverSideSorting: !1,
                resort: !0,
                headers: {},
                ignoreCase: !0,
                sortForce: null,
                sortList: [],
                sortAppend: null,
                sortStable: !1,
                sortInitialOrder: "asc",
                sortLocaleCompare: !1,
                sortReset: !1,
                sortRestart: !1,
                emptyTo: "bottom",
                stringTo: "max",
                duplicateSpan: !0,
                textExtraction: "basic",
                textAttribute: "data-text",
                textSorter: null,
                numberSorter: null,
                initWidgets: !0,
                widgetClass: "widget-{name}",
                widgets: [],
                widgetOptions: {
                    zebra: ["even", "odd"]
                },
                initialized: null,
                tableClass: "",
                cssAsc: "",
                cssDesc: "",
                cssNone: "",
                cssHeader: "",
                cssHeaderRow: "",
                cssProcessing: "",
                cssChildRow: "tablesorter-childRow",
                cssInfoBlock: "tablesorter-infoOnly",
                cssNoSort: "tablesorter-noSort",
                cssIgnoreRow: "tablesorter-ignoreRow",
                cssIcon: "tablesorter-icon",
                cssIconNone: "",
                cssIconAsc: "",
                cssIconDesc: "",
                cssIconDisabled: "",
                pointerClick: "click",
                pointerDown: "mousedown",
                pointerUp: "mouseup",
                selectorHeaders: "> thead th, > thead td",
                selectorSort: "th, td",
                selectorRemove: ".remove-me",
                debug: !1,
                headerList: [],
                empties: {},
                strings: {},
                parsers: [],
                globalize: 0,
                imgAttr: 0
            },
            css: {
                table: "tablesorter",
                cssHasChild: "tablesorter-hasChildRow",
                childRow: "tablesorter-childRow",
                colgroup: "tablesorter-colgroup",
                header: "tablesorter-header",
                headerRow: "tablesorter-headerRow",
                headerIn: "tablesorter-header-inner",
                icon: "tablesorter-icon",
                processing: "tablesorter-processing",
                sortAsc: "tablesorter-headerAsc",
                sortDesc: "tablesorter-headerDesc",
                sortNone: "tablesorter-headerUnSorted"
            },
            language: {
                sortAsc: "Ascending sort applied, ",
                sortDesc: "Descending sort applied, ",
                sortNone: "No sort applied, ",
                sortDisabled: "sorting is disabled",
                nextAsc: "activate to apply an ascending sort",
                nextDesc: "activate to apply a descending sort",
                nextNone: "activate to remove the sort"
            },
            regex: {
                templateContent: /\{content\}/g,
                templateIcon: /\{icon\}/g,
                templateName: /\{name\}/i,
                spaces: /\s+/g,
                nonWord: /\W/g,
                formElements: /(input|select|button|textarea)/i,
                chunk: /(^([+\-]?(?:\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[0-9a-f]+$|\d+)/gi,
                chunks: /(^\\0|\\0$)/,
                hex: /^0x[0-9a-f]+$/i,
                comma: /,/g,
                digitNonUS: /[\s|\.]/g,
                digitNegativeTest: /^\s*\([.\d]+\)/,
                digitNegativeReplace: /^\s*\(([.\d]+)\)/,
                digitTest: /^[\-+(]?\d+[)]?$/,
                digitReplace: /[,.'"\s]/g
            },
            string: {
                max: 1,
                min: -1,
                emptymin: 1,
                emptymax: -1,
                zero: 0,
                none: 0,
                null: 0,
                top: !0,
                bottom: !1
            },
            keyCodes: {
                enter: 13
            },
            dates: {},
            instanceMethods: {},
            setup: function(e, s) {
                if (e && e.tHead && 0 !== e.tBodies.length && !0 !== e.hasInitialized) {
                    var o = "",
                        a = t(e),
                        n = t.metadata;
                    e.hasInitialized = !1, e.isProcessing = !0, e.config = s, t.data(e, "tablesorter", s), s.debug && (console[console.group ? "group" : "log"]("Initializing tablesorter v" + r.version), t.data(e, "startoveralltimer", new Date)), s.supportsDataObject = function(e) {
                        return e[0] = parseInt(e[0], 10), e[0] > 1 || 1 === e[0] && parseInt(e[1], 10) >= 4
                    }(t.fn.jquery.split(".")), s.emptyTo = s.emptyTo.toLowerCase(), s.stringTo = s.stringTo.toLowerCase(), s.last = {
                        sortList: [],
                        clickedIndex: -1
                    }, /tablesorter\-/.test(a.attr("class")) || (o = "" !== s.theme ? " tablesorter-" + s.theme : ""), s.namespace ? s.namespace = "." + s.namespace.replace(r.regex.nonWord, "") : s.namespace = ".tablesorter" + Math.random().toString(16).slice(2), s.table = e, s.$table = a.addClass(r.css.table + " " + s.tableClass + o + " " + s.namespace.slice(1)).attr("role", "grid"), s.$headers = a.find(s.selectorHeaders), s.$table.children().children("tr").attr("role", "row"), s.$tbodies = a.children("tbody:not(." + s.cssInfoBlock + ")").attr({
                        "aria-live": "polite",
                        "aria-relevant": "all"
                    }), s.$table.children("caption").length && ((o = s.$table.children("caption")[0]).id || (o.id = s.namespace.slice(1) + "caption"), s.$table.attr("aria-labelledby", o.id)), s.widgetInit = {}, s.textExtraction = s.$table.attr("data-text-extraction") || s.textExtraction || "basic", r.buildHeaders(s), r.fixColumnWidth(e), r.addWidgetFromClass(e), r.applyWidgetOptions(e), r.setupParsers(s), s.totalRows = 0, r.validateOptions(s), s.delayInit || r.buildCache(s), r.bindEvents(e, s.$headers, !0), r.bindMethods(s), s.supportsDataObject && void 0 !== a.data().sortlist ? s.sortList = a.data().sortlist : n && a.metadata() && a.metadata().sortlist && (s.sortList = a.metadata().sortlist), r.applyWidget(e, !0), s.sortList.length > 0 ? r.sortOn(s, s.sortList, {}, !s.initWidgets) : (r.setHeadersCss(s), s.initWidgets && r.applyWidget(e, !1)), s.showProcessing && a.unbind("sortBegin" + s.namespace + " sortEnd" + s.namespace).bind("sortBegin" + s.namespace + " sortEnd" + s.namespace, function(t) {
                        clearTimeout(s.timerProcessing), r.isProcessing(e), "sortBegin" === t.type && (s.timerProcessing = setTimeout(function() {
                            r.isProcessing(e, !0)
                        }, 500))
                    }), e.hasInitialized = !0, e.isProcessing = !1, s.debug && (console.log("Overall initialization time:" + r.benchmark(t.data(e, "startoveralltimer"))), s.debug && console.groupEnd && console.groupEnd()), a.triggerHandler("tablesorter-initialized", e), "function" == typeof s.initialized && s.initialized(e)
                } else s.debug && (e.hasInitialized ? console.warn("Stopping initialization. Tablesorter has already been initialized") : console.error("Stopping initialization! No table, thead or tbody", e))
            },
            bindMethods: function(e) {
                var s = e.$table,
                    o = e.namespace,
                    a = "sortReset update updateRows updateAll updateHeaders addRows updateCell updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave ".split(" ").join(o + " ");
                s.unbind(a.replace(r.regex.spaces, " ")).bind("sortReset" + o, function(e, t) {
                    e.stopPropagation(), r.sortReset(this.config, function(e) {
                        e.isApplyingWidgets ? setTimeout(function() {
                            r.applyWidget(e, "", t)
                        }, 100) : r.applyWidget(e, "", t)
                    })
                }).bind("updateAll" + o, function(e, t, s) {
                    e.stopPropagation(), r.updateAll(this.config, t, s)
                }).bind("update" + o + " updateRows" + o, function(e, t, s) {
                    e.stopPropagation(), r.update(this.config, t, s)
                }).bind("updateHeaders" + o, function(e, t) {
                    e.stopPropagation(), r.updateHeaders(this.config, t)
                }).bind("updateCell" + o, function(e, t, s, o) {
                    e.stopPropagation(), r.updateCell(this.config, t, s, o)
                }).bind("addRows" + o, function(e, t, s, o) {
                    e.stopPropagation(), r.addRows(this.config, t, s, o)
                }).bind("updateComplete" + o, function() {
                    this.isUpdating = !1
                }).bind("sorton" + o, function(e, t, s, o) {
                    e.stopPropagation(), r.sortOn(this.config, t, s, o)
                }).bind("appendCache" + o, function(e, s, o) {
                    e.stopPropagation(), r.appendCache(this.config, o), t.isFunction(s) && s(this)
                }).bind("updateCache" + o, function(e, t, s) {
                    e.stopPropagation(), r.updateCache(this.config, t, s)
                }).bind("applyWidgetId" + o, function(e, t) {
                    e.stopPropagation(), r.applyWidgetId(this, t)
                }).bind("applyWidgets" + o, function(e, t) {
                    e.stopPropagation(), r.applyWidget(this, t)
                }).bind("refreshWidgets" + o, function(e, t, s) {
                    e.stopPropagation(), r.refreshWidgets(this, t, s)
                }).bind("removeWidget" + o, function(e, t, s) {
                    e.stopPropagation(), r.removeWidget(this, t, s)
                }).bind("destroy" + o, function(e, t, s) {
                    e.stopPropagation(), r.destroy(this, t, s)
                }).bind("resetToLoadState" + o, function(s) {
                    s.stopPropagation(), r.removeWidget(this, !0, !1);
                    var o = t.extend(!0, {}, e.originalSettings);
                    (e = t.extend(!0, {}, r.defaults, o)).originalSettings = o, this.hasInitialized = !1, r.setup(this, e)
                })
            },
            bindEvents: function(e, s, o) {
                var a, n = (e = t(e)[0]).config,
                    i = n.namespace,
                    l = null;
                !0 !== o && (s.addClass(i.slice(1) + "_extra_headers"), (a = t.fn.closest ? s.closest("table")[0] : s.parents("table")[0]) && "TABLE" === a.nodeName && a !== e && t(a).addClass(i.slice(1) + "_extra_table")), a = (n.pointerDown + " " + n.pointerUp + " " + n.pointerClick + " sort keyup ").replace(r.regex.spaces, " ").split(" ").join(i + " "), s.find(n.selectorSort).add(s.filter(n.selectorSort)).unbind(a).bind(a, function(e, o) {
                    var a, i, d, c = t(e.target),
                        g = " " + e.type + " ";
                    if (!(1 !== (e.which || e.button) && !g.match(" " + n.pointerClick + " | sort | keyup ") || " keyup " === g && e.which !== r.keyCodes.enter || g.match(" " + n.pointerClick + " ") && void 0 !== e.which || g.match(" " + n.pointerUp + " ") && l !== e.target && !0 !== o)) {
                        if (g.match(" " + n.pointerDown + " ")) return l = e.target, void("1" === (d = c.jquery.split("."))[0] && d[1] < 4 && e.preventDefault());
                        if (l = null, r.regex.formElements.test(e.target.nodeName) || c.hasClass(n.cssNoSort) || c.parents("." + n.cssNoSort).length > 0 || c.parents("button").length > 0) return !n.cancelSelection;
                        n.delayInit && r.isEmptyObject(n.cache) && r.buildCache(n), a = t.fn.closest ? t(this).closest("th, td") : /TH|TD/.test(this.nodeName) ? t(this) : t(this).parents("th, td"), d = s.index(a), n.last.clickedIndex = d < 0 ? a.attr("data-column") : d, (i = n.$headers[n.last.clickedIndex]) && !i.sortDisabled && r.initSort(n, i, e)
                    }
                }), n.cancelSelection && s.attr("unselectable", "on").bind("selectstart", !1).css({
                    "user-select": "none",
                    MozUserSelect: "none"
                })
            },
            buildHeaders: function(e) {
                var s, o, a, n;
                for (e.headerList = [], e.headerContent = [], e.sortVars = [], e.debug && (a = new Date), e.columns = r.computeColumnIndex(e.$table.children("thead, tfoot").children("tr")), o = e.cssIcon ? '<i class="' + (e.cssIcon === r.css.icon ? r.css.icon : e.cssIcon + " " + r.css.icon) + '"></i>' : "", e.$headers = t(t.map(e.$table.find(e.selectorHeaders), function(s, a) {
                        var n, i, l, d, c, g = t(s);
                        if (!g.parent().hasClass(e.cssIgnoreRow)) return n = r.getColumnData(e.table, e.headers, a, !0), e.headerContent[a] = g.html(), "" === e.headerTemplate || g.find("." + r.css.headerIn).length || (d = e.headerTemplate.replace(r.regex.templateContent, g.html()).replace(r.regex.templateIcon, g.find("." + r.css.icon).length ? "" : o), e.onRenderTemplate && (i = e.onRenderTemplate.apply(g, [a, d])) && "string" == typeof i && (d = i), g.html('<div class="' + r.css.headerIn + '">' + d + "</div>")), e.onRenderHeader && e.onRenderHeader.apply(g, [a, e, e.$table]), l = parseInt(g.attr("data-column"), 10), s.column = l, c = r.getOrder(r.getData(g, n, "sortInitialOrder") || e.sortInitialOrder), e.sortVars[l] = {
                            count: -1,
                            order: c ? e.sortReset ? [1, 0, 2] : [1, 0] : e.sortReset ? [0, 1, 2] : [0, 1],
                            lockedOrder: !1
                        }, void 0 !== (c = r.getData(g, n, "lockedOrder") || !1) && !1 !== c && (e.sortVars[l].lockedOrder = !0, e.sortVars[l].order = r.getOrder(c) ? [1, 1] : [0, 0]), e.headerList[a] = s, g.addClass(r.css.header + " " + e.cssHeader).parent().addClass(r.css.headerRow + " " + e.cssHeaderRow).attr("role", "row"), e.tabIndex && g.attr("tabindex", 0), s
                    })), e.$headerIndexed = [], n = 0; n < e.columns; n++) r.isEmptyObject(e.sortVars[n]) && (e.sortVars[n] = {}), s = e.$headers.filter('[data-column="' + n + '"]'), e.$headerIndexed[n] = s.length ? s.not(".sorter-false").length ? s.not(".sorter-false").filter(":last") : s.filter(":last") : t();
                e.$table.find(e.selectorHeaders).attr({
                    scope: "col",
                    role: "columnheader"
                }), r.updateHeader(e), e.debug && (console.log("Built headers:" + r.benchmark(a)), console.log(e.$headers))
            },
            addInstanceMethods: function(e) {
                t.extend(r.instanceMethods, e)
            },
            setupParsers: function(e, t) {
                var s, o, a, n, i, l, d, c, g, p, u, f, h, m, b = e.table,
                    y = 0,
                    w = {};
                if (e.$tbodies = e.$table.children("tbody:not(." + e.cssInfoBlock + ")"), h = void 0 === t ? e.$tbodies : t, 0 === (m = h.length)) return e.debug ? console.warn("Warning: *Empty table!* Not building a parser cache") : "";
                for (e.debug && (f = new Date, console[console.group ? "group" : "log"]("Detecting parsers for each column")), o = {
                        extractors: [],
                        parsers: []
                    }; y < m;) {
                    if ((s = h[y].rows).length)
                        for (i = 0, n = e.columns, l = 0; l < n; l++) {
                            if ((d = e.$headerIndexed[i]) && d.length && (c = r.getColumnData(b, e.headers, i), u = r.getParserById(r.getData(d, c, "extractor")), p = r.getParserById(r.getData(d, c, "sorter")), g = "false" === r.getData(d, c, "parser"), e.empties[i] = (r.getData(d, c, "empty") || e.emptyTo || (e.emptyToBottom ? "bottom" : "top")).toLowerCase(), e.strings[i] = (r.getData(d, c, "string") || e.stringTo || "max").toLowerCase(), g && (p = r.getParserById("no-parser")), u || (u = !1), p || (p = r.detectParserForColumn(e, s, -1, i)), e.debug && (w["(" + i + ") " + d.text()] = {
                                    parser: p.id,
                                    extractor: u ? u.id : "none",
                                    string: e.strings[i],
                                    empty: e.empties[i]
                                }), o.parsers[i] = p, o.extractors[i] = u, (a = d[0].colSpan - 1) > 0))
                                for (i += a, n += a; a + 1 > 0;) o.parsers[i - a] = p, o.extractors[i - a] = u, a--;
                            i++
                        }
                    y += o.parsers.length ? m : 1
                }
                e.debug && (r.isEmptyObject(w) ? console.warn("  No parsers detected!") : console[console.table ? "table" : "log"](w), console.log("Completed detecting parsers" + r.benchmark(f)), console.groupEnd && console.groupEnd()), e.parsers = o.parsers, e.extractors = o.extractors
            },
            addParser: function(e) {
                var t, s = r.parsers.length,
                    o = !0;
                for (t = 0; t < s; t++) r.parsers[t].id.toLowerCase() === e.id.toLowerCase() && (o = !1);
                o && (r.parsers[r.parsers.length] = e)
            },
            getParserById: function(e) {
                if ("false" == e) return !1;
                var t, s = r.parsers.length;
                for (t = 0; t < s; t++)
                    if (r.parsers[t].id.toLowerCase() === e.toString().toLowerCase()) return r.parsers[t];
                return !1
            },
            detectParserForColumn: function(e, s, o, a) {
                for (var n, i, l, d = r.parsers.length, c = !1, g = "", p = !0;
                    "" === g && p;)(l = s[++o]) && o < 50 ? l.className.indexOf(r.cssIgnoreRow) < 0 && (c = s[o].cells[a], g = r.getElementText(e, c, a), i = t(c), e.debug && console.log("Checking if value was empty on row " + o + ", column: " + a + ': "' + g + '"')) : p = !1;
                for (; --d >= 0;)
                    if ((n = r.parsers[d]) && "text" !== n.id && n.is && n.is(g, e.table, c, i)) return n;
                return r.getParserById("text")
            },
            getElementText: function(e, s, o) {
                if (!s) return "";
                var a, n = e.textExtraction || "",
                    i = s.jquery ? s : t(s);
                return "string" == typeof n ? "basic" === n && void 0 !== (a = i.attr(e.textAttribute)) ? t.trim(a) : t.trim(s.textContent || i.text()) : "function" == typeof n ? t.trim(n(i[0], e.table, o)) : "function" == typeof(a = r.getColumnData(e.table, n, o)) ? t.trim(a(i[0], e.table, o)) : t.trim(i[0].textContent || i.text())
            },
            getParsedText: function(e, t, s, o) {
                void 0 === o && (o = r.getElementText(e, t, s));
                var a = "" + o,
                    n = e.parsers[s],
                    i = e.extractors[s];
                return n && (i && "function" == typeof i.format && (o = i.format(o, e.table, t, s)), a = "no-parser" === n.id ? "" : n.format("" + o, e.table, t, s), e.ignoreCase && "string" == typeof a && (a = a.toLowerCase())), a
            },
            buildCache: function(e, s, o) {
                var a, n, i, l, d, c, g, p, u, f, h, m, b, y, w, x, v, C, $, I, D, R, T = e.table,
                    L = e.parsers;
                if (e.$tbodies = e.$table.children("tbody:not(." + e.cssInfoBlock + ")"), g = void 0 === o ? e.$tbodies : o, e.cache = {}, e.totalRows = 0, !L) return e.debug ? console.warn("Warning: *Empty table!* Not building a cache") : "";
                for (e.debug && (m = new Date), e.showProcessing && r.isProcessing(T, !0), c = 0; c < g.length; c++) {
                    for (x = [], a = e.cache[c] = {
                            normalized: []
                        }, b = g[c] && g[c].rows.length || 0, l = 0; l < b; ++l)
                        if (y = {
                                child: [],
                                raw: []
                            }, p = t(g[c].rows[l]), u = [], !p.hasClass(e.selectorRemove.slice(1)))
                            if (p.hasClass(e.cssChildRow) && 0 !== l)
                                for (D = a.normalized.length - 1, (w = a.normalized[D][e.columns]).$row = w.$row.add(p), p.prev().hasClass(e.cssChildRow) || p.prev().addClass(r.css.cssHasChild), f = p.children("th, td"), D = w.child.length, w.child[D] = [], C = 0, I = e.columns, d = 0; d < I; d++)(h = f[d]) && (w.child[D][d] = r.getParsedText(e, h, d), (v = f[d].colSpan - 1) > 0 && (C += v, I += v)), C++;
                            else {
                                for (y.$row = p, y.order = l, C = 0, I = e.columns, d = 0; d < I; ++d) {
                                    if ((h = p[0].cells[d]) && C < e.columns && (!($ = void 0 !== L[C]) && e.debug && console.warn("No parser found for row: " + l + ", column: " + d + '; cell containing: "' + t(h).text() + '"; does it have a header?'), n = r.getElementText(e, h, C), y.raw[C] = n, i = r.getParsedText(e, h, C, n), u[C] = i, $ && "numeric" === (L[C].type || "").toLowerCase() && (x[C] = Math.max(Math.abs(i) || 0, x[C] || 0)), (v = h.colSpan - 1) > 0)) {
                                        for (R = 0; R <= v;) i = e.duplicateSpan || 0 === R ? n : "string" != typeof e.textExtraction ? r.getElementText(e, h, C + R) || "" : "", y.raw[C + R] = i, u[C + R] = i, R++;
                                        C += v, I += v
                                    }
                                    C++
                                }
                                u[e.columns] = y, a.normalized[a.normalized.length] = u
                            }
                    a.colMax = x, e.totalRows += a.normalized.length
                }
                if (e.showProcessing && r.isProcessing(T), e.debug) {
                    for (D = Math.min(5, e.cache[0].normalized.length), console[console.group ? "group" : "log"]("Building cache for " + e.totalRows + " rows (showing " + D + " rows in log) and " + e.columns + " columns" + r.benchmark(m)), n = {}, d = 0; d < e.columns; d++)
                        for (C = 0; C < D; C++) n["row: " + C] || (n["row: " + C] = {}), n["row: " + C][e.$headerIndexed[d].text()] = e.cache[0].normalized[C][d];
                    console[console.table ? "table" : "log"](n), console.groupEnd && console.groupEnd()
                }
                t.isFunction(s) && s(T)
            },
            getColumnText: function(e, s, o, a) {
                var n, i, l, d, c, g, p, u, f, h, m = "function" == typeof o,
                    b = "all" === s,
                    y = {
                        raw: [],
                        parsed: [],
                        $cell: []
                    },
                    w = (e = t(e)[0]).config;
                if (!r.isEmptyObject(w)) {
                    for (c = w.$tbodies.length, n = 0; n < c; n++)
                        for (g = (l = w.cache[n].normalized).length, i = 0; i < g; i++) d = l[i], a && !d[w.columns].$row.is(a) || (h = !0, u = b ? d.slice(0, w.columns) : d[s], d = d[w.columns], p = b ? d.raw : d.raw[s], f = b ? d.$row.children() : d.$row.children().eq(s), m && (h = o({
                            tbodyIndex: n,
                            rowIndex: i,
                            parsed: u,
                            raw: p,
                            $row: d.$row,
                            $cell: f
                        })), !1 !== h && (y.parsed[y.parsed.length] = u, y.raw[y.raw.length] = p, y.$cell[y.$cell.length] = f));
                    return y
                }
                w.debug && console.warn("No cache found - aborting getColumnText function!")
            },
            setHeadersCss: function(e) {
                var s, o, a = e.sortList,
                    n = a.length,
                    i = r.css.sortNone + " " + e.cssNone,
                    l = [r.css.sortAsc + " " + e.cssAsc, r.css.sortDesc + " " + e.cssDesc],
                    d = [e.cssIconAsc, e.cssIconDesc, e.cssIconNone],
                    c = ["ascending", "descending"],
                    g = e.$table.find("tfoot tr").children("td, th").add(t(e.namespace + "_extra_headers")).removeClass(l.join(" ")),
                    p = e.$headers.add(t("thead " + e.namespace + "_extra_headers")).removeClass(l.join(" ")).addClass(i).attr("aria-sort", "none").find("." + r.css.icon).removeClass(d.join(" ")).end();
                for (p.not(".sorter-false").find("." + r.css.icon).addClass(d[2]), e.cssIconDisabled && p.filter(".sorter-false").find("." + r.css.icon).addClass(e.cssIconDisabled), s = 0; s < n; s++)
                    if (2 !== a[s][1] && (p = e.$headers.filter(function(t) {
                            for (var s = !0, o = e.$headers.eq(t), a = parseInt(o.attr("data-column"), 10), n = a + e.$headers[t].colSpan; a < n; a++) s = !!s && (s || r.isValueInArray(a, e.sortList) > -1);
                            return s
                        }), (p = p.not(".sorter-false").filter('[data-column="' + a[s][0] + '"]' + (1 === n ? ":last" : ""))).length)) {
                        for (o = 0; o < p.length; o++) p[o].sortDisabled || p.eq(o).removeClass(i).addClass(l[a[s][1]]).attr("aria-sort", c[a[s][1]]).find("." + r.css.icon).removeClass(d[2]).addClass(d[a[s][1]]);
                        g.length && g.filter('[data-column="' + a[s][0] + '"]').removeClass(i).addClass(l[a[s][1]])
                    }
                for (n = e.$headers.length, s = 0; s < n; s++) r.setColumnAriaLabel(e, e.$headers.eq(s))
            },
            setColumnAriaLabel: function(e, s, o) {
                if (s.length) {
                    var a = parseInt(s.attr("data-column"), 10),
                        n = e.sortVars[a],
                        i = s.hasClass(r.css.sortAsc) ? "sortAsc" : s.hasClass(r.css.sortDesc) ? "sortDesc" : "sortNone",
                        l = t.trim(s.text()) + ": " + r.language[i];
                    s.hasClass("sorter-false") || !1 === o ? l += r.language.sortDisabled : (i = (n.count + 1) % n.order.length, o = n.order[i], l += r.language[0 === o ? "nextAsc" : 1 === o ? "nextDesc" : "nextNone"]), s.attr("aria-label", l)
                }
            },
            updateHeader: function(e) {
                var t, s, o, a, n = e.table,
                    i = e.$headers.length;
                for (t = 0; t < i; t++) o = e.$headers.eq(t), a = r.getColumnData(n, e.headers, t, !0), s = "false" === r.getData(o, a, "sorter") || "false" === r.getData(o, a, "parser"), r.setColumnSort(e, o, s)
            },
            setColumnSort: function(e, t, r) {
                var s = e.table.id;
                t[0].sortDisabled = r, t[r ? "addClass" : "removeClass"]("sorter-false").attr("aria-disabled", "" + r), e.tabIndex && (r ? t.removeAttr("tabindex") : t.attr("tabindex", "0")), s && (r ? t.removeAttr("aria-controls") : t.attr("aria-controls", s))
            },
            updateHeaderSortCount: function(e, s) {
                var o, a, n, i, l, d, c, g, p = s || e.sortList,
                    u = p.length;
                for (e.sortList = [], i = 0; i < u; i++)
                    if (c = p[i], (o = parseInt(c[0], 10)) < e.columns) {
                        switch (e.sortVars[o].order || (g = r.getOrder(e.sortInitialOrder) ? e.sortReset ? [1, 0, 2] : [1, 0] : e.sortReset ? [0, 1, 2] : [0, 1], e.sortVars[o].order = g, e.sortVars[o].count = 0), g = e.sortVars[o].order, a = ("" + c[1]).match(/^(1|d|s|o|n)/), a = a ? a[0] : "") {
                            case "1":
                            case "d":
                                a = 1;
                                break;
                            case "s":
                                a = l || 0;
                                break;
                            case "o":
                                a = 0 === (d = g[(l || 0) % g.length]) ? 1 : 1 === d ? 0 : 2;
                                break;
                            case "n":
                                a = g[++e.sortVars[o].count % g.length];
                                break;
                            default:
                                a = 0
                        }
                        l = 0 === i ? a : l, n = [o, parseInt(a, 10) || 0], e.sortList[e.sortList.length] = n, a = t.inArray(n[1], g), e.sortVars[o].count = a >= 0 ? a : n[1] % g.length
                    }
            },
            updateAll: function(e, t, s) {
                var o = e.table;
                o.isUpdating = !0, r.refreshWidgets(o, !0, !0), r.buildHeaders(e), r.bindEvents(o, e.$headers, !0), r.bindMethods(e), r.commonUpdate(e, t, s)
            },
            update: function(e, t, s) {
                e.table.isUpdating = !0, r.updateHeader(e), r.commonUpdate(e, t, s)
            },
            updateHeaders: function(e, t) {
                e.table.isUpdating = !0, r.buildHeaders(e), r.bindEvents(e.table, e.$headers, !0), r.resortComplete(e, t)
            },
            updateCell: function(e, s, o, a) {
                if (t(s).closest("tr").hasClass(e.cssChildRow)) console.warn('Tablesorter Warning! "updateCell" for child row content has been disabled, use "update" instead');
                else {
                    if (r.isEmptyObject(e.cache)) return r.updateHeader(e), void r.commonUpdate(e, o, a);
                    e.table.isUpdating = !0, e.$table.find(e.selectorRemove).remove();
                    var n, i, l, d, c, g, p = e.$tbodies,
                        u = t(s),
                        f = p.index(t.fn.closest ? u.closest("tbody") : u.parents("tbody").filter(":first")),
                        h = e.cache[f],
                        m = t.fn.closest ? u.closest("tr") : u.parents("tr").filter(":first");
                    if (s = u[0], p.length && f >= 0) {
                        if (l = p.eq(f).find("tr").not("." + e.cssChildRow).index(m), c = h.normalized[l], (g = m[0].cells.length) !== e.columns)
                            for (d = 0, n = !1, i = 0; i < g; i++) n || m[0].cells[i] === s ? n = !0 : d += m[0].cells[i].colSpan;
                        else d = u.index();
                        n = r.getElementText(e, s, d), c[e.columns].raw[d] = n, n = r.getParsedText(e, s, d, n), c[d] = n, "numeric" === (e.parsers[d].type || "").toLowerCase() && (h.colMax[d] = Math.max(Math.abs(n) || 0, h.colMax[d] || 0)), !1 !== (n = "undefined" !== o ? o : e.resort) ? r.checkResort(e, n, a) : r.resortComplete(e, a)
                    } else e.debug && console.error("updateCell aborted, tbody missing or not within the indicated table"), e.table.isUpdating = !1
                }
            },
            addRows: function(s, o, a, n) {
                var i, l, d, c, g, p, u, f, h, m, b, y, w, x = "string" == typeof o && 1 === s.$tbodies.length && /<tr/.test(o || ""),
                    v = s.table;
                if (x) o = t(o), s.$tbodies.append(o);
                else if (!(o && o instanceof e && (t.fn.closest ? o.closest("table")[0] : o.parents("table")[0]) === s.table)) return s.debug && console.error("addRows method requires (1) a jQuery selector reference to rows that have already been added to the table, or (2) row HTML string to be added to a table with only one tbody"), !1;
                if (v.isUpdating = !0, r.isEmptyObject(s.cache)) r.updateHeader(s), r.commonUpdate(s, a, n);
                else {
                    for (g = o.filter("tr").attr("role", "row").length, d = s.$tbodies.index(o.parents("tbody").filter(":first")), s.parsers && s.parsers.length || r.setupParsers(s), c = 0; c < g; c++) {
                        for (h = 0, u = o[c].cells.length, f = s.cache[d].normalized.length, b = [], m = {
                                child: [],
                                raw: [],
                                $row: o.eq(c),
                                order: f
                            }, p = 0; p < u; p++) y = o[c].cells[p], i = r.getElementText(s, y, h), m.raw[h] = i, l = r.getParsedText(s, y, h, i), b[h] = l, "numeric" === (s.parsers[h].type || "").toLowerCase() && (s.cache[d].colMax[h] = Math.max(Math.abs(l) || 0, s.cache[d].colMax[h] || 0)), (w = y.colSpan - 1) > 0 && (h += w), h++;
                        b[s.columns] = m, s.cache[d].normalized[f] = b
                    }
                    r.checkResort(s, a, n)
                }
            },
            updateCache: function(e, t, s) {
                e.parsers && e.parsers.length || r.setupParsers(e, s), r.buildCache(e, t, s)
            },
            appendCache: function(e, t) {
                var s, o, a, n, i, l, d, c = e.table,
                    g = e.widgetOptions,
                    p = e.$tbodies,
                    u = [],
                    f = e.cache;
                if (r.isEmptyObject(f)) return e.appender ? e.appender(c, u) : c.isUpdating ? e.$table.triggerHandler("updateComplete", c) : "";
                for (e.debug && (d = new Date), l = 0; l < p.length; l++)
                    if ((a = p.eq(l)).length) {
                        for (n = r.processTbody(c, a, !0), o = (s = f[l].normalized).length, i = 0; i < o; i++) u[u.length] = s[i][e.columns].$row, e.appender && (!e.pager || e.pager.removeRows && g.pager_removeRows || e.pager.ajax) || n.append(s[i][e.columns].$row);
                        r.processTbody(c, n, !1)
                    }
                e.appender && e.appender(c, u), e.debug && console.log("Rebuilt table" + r.benchmark(d)), t || e.appender || r.applyWidget(c), c.isUpdating && e.$table.triggerHandler("updateComplete", c)
            },
            commonUpdate: function(e, t, s) {
                e.$table.find(e.selectorRemove).remove(), r.setupParsers(e), r.buildCache(e), r.checkResort(e, t, s)
            },
            initSort: function(e, s, o) {
                if (e.table.isUpdating) return setTimeout(function() {
                    r.initSort(e, s, o)
                }, 50);
                var a, n, i, l, d, c, g, p = !o[e.sortMultiSortKey],
                    u = e.table,
                    f = e.$headers.length,
                    h = parseInt(t(s).attr("data-column"), 10),
                    m = e.sortVars[h].order;
                if (e.$table.triggerHandler("sortStart", u), c = (e.sortVars[h].count + 1) % m.length, e.sortVars[h].count = o[e.sortResetKey] ? 2 : c, e.sortRestart)
                    for (i = 0; i < f; i++) g = e.$headers.eq(i), h !== (c = parseInt(g.attr("data-column"), 10)) && (p || g.hasClass(r.css.sortNone)) && (e.sortVars[c].count = -1);
                if (p) {
                    if (e.sortList = [], e.last.sortList = [], null !== e.sortForce)
                        for (a = e.sortForce, n = 0; n < a.length; n++) a[n][0] !== h && (e.sortList[e.sortList.length] = a[n]);
                    if ((l = m[e.sortVars[h].count]) < 2 && (e.sortList[e.sortList.length] = [h, l], s.colSpan > 1))
                        for (n = 1; n < s.colSpan; n++) e.sortList[e.sortList.length] = [h + n, l], e.sortVars[h + n].count = t.inArray(l, m)
                } else if (e.sortList = t.extend([], e.last.sortList), r.isValueInArray(h, e.sortList) >= 0)
                    for (n = 0; n < e.sortList.length; n++)(c = e.sortList[n])[0] === h && (c[1] = m[e.sortVars[h].count], 2 === c[1] && (e.sortList.splice(n, 1), e.sortVars[h].count = -1));
                else if ((l = m[e.sortVars[h].count]) < 2 && (e.sortList[e.sortList.length] = [h, l], s.colSpan > 1))
                    for (n = 1; n < s.colSpan; n++) e.sortList[e.sortList.length] = [h + n, l], e.sortVars[h + n].count = t.inArray(l, m);
                if (e.last.sortList = t.extend([], e.sortList), e.sortList.length && e.sortAppend && (a = t.isArray(e.sortAppend) ? e.sortAppend : e.sortAppend[e.sortList[0][0]], !r.isEmptyObject(a)))
                    for (n = 0; n < a.length; n++)
                        if (a[n][0] !== h && r.isValueInArray(a[n][0], e.sortList) < 0) {
                            if (l = a[n][1], d = ("" + l).match(/^(a|d|s|o|n)/)) switch (c = e.sortList[0][1], d[0]) {
                                case "d":
                                    l = 1;
                                    break;
                                case "s":
                                    l = c;
                                    break;
                                case "o":
                                    l = 0 === c ? 1 : 0;
                                    break;
                                case "n":
                                    l = (c + 1) % m.length;
                                    break;
                                default:
                                    l = 0
                            }
                            e.sortList[e.sortList.length] = [a[n][0], l]
                        }
                e.$table.triggerHandler("sortBegin", u), setTimeout(function() {
                    r.setHeadersCss(e), r.multisort(e), r.appendCache(e), e.$table.triggerHandler("sortBeforeEnd", u), e.$table.triggerHandler("sortEnd", u)
                }, 1)
            },
            multisort: function(e) {
                var t, s, o, a, n = e.table,
                    i = [],
                    l = 0,
                    d = e.textSorter || "",
                    c = e.sortList,
                    g = c.length,
                    p = e.$tbodies.length;
                if (!e.serverSideSorting && !r.isEmptyObject(e.cache)) {
                    if (e.debug && (s = new Date), "object" == typeof d)
                        for (o = e.columns; o--;) "function" == typeof(a = r.getColumnData(n, d, o)) && (i[o] = a);
                    for (t = 0; t < p; t++) o = e.cache[t].colMax, e.cache[t].normalized.sort(function(t, s) {
                        var a, p, u, f, h, m, b;
                        for (a = 0; a < g; a++) {
                            if (u = c[a][0], f = c[a][1], l = 0 === f, e.sortStable && t[u] === s[u] && 1 === g) return t[e.columns].order - s[e.columns].order;
                            if (p = /n/i.test(r.getSortType(e.parsers, u)), p && e.strings[u] ? (p = "boolean" == typeof r.string[e.strings[u]] ? (l ? 1 : -1) * (r.string[e.strings[u]] ? -1 : 1) : e.strings[u] ? r.string[e.strings[u]] || 0 : 0, h = e.numberSorter ? e.numberSorter(t[u], s[u], l, o[u], n) : r["sortNumeric" + (l ? "Asc" : "Desc")](t[u], s[u], p, o[u], u, e)) : (m = l ? t : s, b = l ? s : t, h = "function" == typeof d ? d(m[u], b[u], l, u, n) : "function" == typeof i[u] ? i[u](m[u], b[u], l, u, n) : r["sortNatural" + (l ? "Asc" : "Desc")](t[u], s[u], u, e)), h) return h
                        }
                        return t[e.columns].order - s[e.columns].order
                    });
                    e.debug && console.log("Applying sort " + c.toString() + r.benchmark(s))
                }
            },
            resortComplete: function(e, r) {
                e.table.isUpdating && e.$table.triggerHandler("updateComplete", e.table), t.isFunction(r) && r(e.table)
            },
            checkResort: function(e, s, o) {
                var a = t.isArray(s) ? s : e.sortList;
                !1 === (void 0 === s ? e.resort : s) || e.serverSideSorting || e.table.isProcessing ? (r.resortComplete(e, o), r.applyWidget(e.table, !1)) : a.length ? r.sortOn(e, a, function() {
                    r.resortComplete(e, o)
                }, !0) : r.sortReset(e, function() {
                    r.resortComplete(e, o), r.applyWidget(e.table, !1)
                })
            },
            sortOn: function(e, s, o, a) {
                var n = e.table;
                e.$table.triggerHandler("sortStart", n), r.updateHeaderSortCount(e, s), r.setHeadersCss(e), e.delayInit && r.isEmptyObject(e.cache) && r.buildCache(e), e.$table.triggerHandler("sortBegin", n), r.multisort(e), r.appendCache(e, a), e.$table.triggerHandler("sortBeforeEnd", n), e.$table.triggerHandler("sortEnd", n), r.applyWidget(n), t.isFunction(o) && o(n)
            },
            sortReset: function(e, s) {
                e.sortList = [], r.setHeadersCss(e), r.multisort(e), r.appendCache(e);
                var o;
                for (o = 0; o < e.columns; o++) e.sortVars[o].count = -1;
                t.isFunction(s) && s(e.table)
            },
            getSortType: function(e, t) {
                return e && e[t] ? e[t].type || "" : ""
            },
            getOrder: function(e) {
                return /^d/i.test(e) || 1 === e
            },
            sortNatural: function(e, t) {
                if (e === t) return 0;
                e = e.toString(), t = t.toString();
                var s, o, a, n, i, l, d = r.regex;
                if (d.hex.test(t)) {
                    if (s = parseInt((e || "").match(d.hex), 16), o = parseInt((t || "").match(d.hex), 16), s < o) return -1;
                    if (s > o) return 1
                }
                for (s = (e || "").replace(d.chunk, "\\0$1\\0").replace(d.chunks, "").split("\\0"), o = (t || "").replace(d.chunk, "\\0$1\\0").replace(d.chunks, "").split("\\0"), l = Math.max(s.length, o.length), i = 0; i < l; i++) {
                    if (a = isNaN(s[i]) ? s[i] || 0 : parseFloat(s[i]) || 0, n = isNaN(o[i]) ? o[i] || 0 : parseFloat(o[i]) || 0, isNaN(a) !== isNaN(n)) return isNaN(a) ? 1 : -1;
                    if (typeof a != typeof n && (a += "", n += ""), a < n) return -1;
                    if (a > n) return 1
                }
                return 0
            },
            sortNaturalAsc: function(e, t, s, o) {
                if (e === t) return 0;
                var a = r.string[o.empties[s] || o.emptyTo];
                return "" === e && 0 !== a ? "boolean" == typeof a ? a ? -1 : 1 : -a || -1 : "" === t && 0 !== a ? "boolean" == typeof a ? a ? 1 : -1 : a || 1 : r.sortNatural(e, t)
            },
            sortNaturalDesc: function(e, t, s, o) {
                if (e === t) return 0;
                var a = r.string[o.empties[s] || o.emptyTo];
                return "" === e && 0 !== a ? "boolean" == typeof a ? a ? -1 : 1 : a || 1 : "" === t && 0 !== a ? "boolean" == typeof a ? a ? 1 : -1 : -a || -1 : r.sortNatural(t, e)
            },
            sortText: function(e, t) {
                return e > t ? 1 : e < t ? -1 : 0
            },
            getTextValue: function(e, t, r) {
                if (r) {
                    var s, o = e ? e.length : 0,
                        a = r + t;
                    for (s = 0; s < o; s++) a += e.charCodeAt(s);
                    return t * a
                }
                return 0
            },
            sortNumericAsc: function(e, t, s, o, a, n) {
                if (e === t) return 0;
                var i = r.string[n.empties[a] || n.emptyTo];
                return "" === e && 0 !== i ? "boolean" == typeof i ? i ? -1 : 1 : -i || -1 : "" === t && 0 !== i ? "boolean" == typeof i ? i ? 1 : -1 : i || 1 : (isNaN(e) && (e = r.getTextValue(e, s, o)), isNaN(t) && (t = r.getTextValue(t, s, o)), e - t)
            },
            sortNumericDesc: function(e, t, s, o, a, n) {
                if (e === t) return 0;
                var i = r.string[n.empties[a] || n.emptyTo];
                return "" === e && 0 !== i ? "boolean" == typeof i ? i ? -1 : 1 : i || 1 : "" === t && 0 !== i ? "boolean" == typeof i ? i ? 1 : -1 : -i || -1 : (isNaN(e) && (e = r.getTextValue(e, s, o)), isNaN(t) && (t = r.getTextValue(t, s, o)), t - e)
            },
            sortNumeric: function(e, t) {
                return e - t
            },
            addWidget: function(e) {
                e.id && !r.isEmptyObject(r.getWidgetById(e.id)) && console.warn('"' + e.id + '" widget was loaded more than once!'), r.widgets[r.widgets.length] = e
            },
            hasWidget: function(e, r) {
                return (e = t(e)).length && e[0].config && e[0].config.widgetInit[r] || !1
            },
            getWidgetById: function(e) {
                var t, s, o = r.widgets.length;
                for (t = 0; t < o; t++)
                    if ((s = r.widgets[t]) && s.id && s.id.toLowerCase() === e.toLowerCase()) return s
            },
            applyWidgetOptions: function(e) {
                var s, o, a, n = e.config,
                    i = n.widgets.length;
                if (i)
                    for (s = 0; s < i; s++)(o = r.getWidgetById(n.widgets[s])) && o.options && (a = t.extend(!0, {}, o.options), n.widgetOptions = t.extend(!0, a, n.widgetOptions), t.extend(!0, r.defaults.widgetOptions, o.options))
            },
            addWidgetFromClass: function(e) {
                var t, s, o = e.config,
                    a = "^" + o.widgetClass.replace(r.regex.templateName, "(\\S+)+") + "$",
                    n = new RegExp(a, "g"),
                    i = (e.className || "").split(r.regex.spaces);
                if (i.length)
                    for (t = i.length, s = 0; s < t; s++) i[s].match(n) && (o.widgets[o.widgets.length] = i[s].replace(n, "$1"))
            },
            applyWidgetId: function(e, s, o) {
                var a, n, i, l = (e = t(e)[0]).config,
                    d = l.widgetOptions,
                    c = r.getWidgetById(s);
                c && (i = c.id, a = !1, t.inArray(i, l.widgets) < 0 && (l.widgets[l.widgets.length] = i), l.debug && (n = new Date), !o && l.widgetInit[i] || (l.widgetInit[i] = !0, e.hasInitialized && r.applyWidgetOptions(e), "function" == typeof c.init && (a = !0, l.debug && console[console.group ? "group" : "log"]("Initializing " + i + " widget"), c.init(e, c, l, d))), o || "function" != typeof c.format || (a = !0, l.debug && console[console.group ? "group" : "log"]("Updating " + i + " widget"), c.format(e, l, d, !1)), l.debug && a && (console.log("Completed " + (o ? "initializing " : "applying ") + i + " widget" + r.benchmark(n)), console.groupEnd && console.groupEnd()))
            },
            applyWidget: function(e, s, o) {
                var a, n, i, l, d, c = (e = t(e)[0]).config,
                    g = [];
                if (!1 === s || !e.hasInitialized || !e.isApplyingWidgets && !e.isUpdating) {
                    if (c.debug && (d = new Date), r.addWidgetFromClass(e), clearTimeout(c.timerReady), c.widgets.length) {
                        for (e.isApplyingWidgets = !0, c.widgets = t.grep(c.widgets, function(e, r) {
                                return t.inArray(e, c.widgets) === r
                            }), n = (i = c.widgets || []).length, a = 0; a < n; a++)(l = r.getWidgetById(i[a])) && l.id ? (l.priority || (l.priority = 10), g[a] = l) : c.debug && console.warn('"' + i[a] + '" widget code does not exist!');
                        for (g.sort(function(e, t) {
                                return e.priority < t.priority ? -1 : e.priority === t.priority ? 0 : 1
                            }), n = g.length, c.debug && console[console.group ? "group" : "log"]("Start " + (s ? "initializing" : "applying") + " widgets"), a = 0; a < n; a++)(l = g[a]) && l.id && r.applyWidgetId(e, l.id, s);
                        c.debug && console.groupEnd && console.groupEnd()
                    }
                    c.timerReady = setTimeout(function() {
                        e.isApplyingWidgets = !1, t.data(e, "lastWidgetApplication", new Date), c.$table.triggerHandler("tablesorter-ready"), s || "function" != typeof o || o(e), c.debug && (l = c.widgets.length, console.log("Completed " + (!0 === s ? "initializing " : "applying ") + l + " widget" + (1 !== l ? "s" : "") + r.benchmark(d)))
                    }, 10)
                }
            },
            removeWidget: function(e, s, o) {
                var a, n, i, l, d = (e = t(e)[0]).config;
                if (!0 === s)
                    for (s = [], l = r.widgets.length, i = 0; i < l; i++)(n = r.widgets[i]) && n.id && (s[s.length] = n.id);
                else s = (t.isArray(s) ? s.join(",") : s || "").toLowerCase().split(/[\s,]+/);
                for (l = s.length, a = 0; a < l; a++) n = r.getWidgetById(s[a]), (i = t.inArray(s[a], d.widgets)) >= 0 && !0 !== o && d.widgets.splice(i, 1), n && n.remove && (d.debug && console.log((o ? "Refreshing" : "Removing") + ' "' + s[a] + '" widget'), n.remove(e, d, d.widgetOptions, o), d.widgetInit[s[a]] = !1)
            },
            refreshWidgets: function(e, s, o) {
                var a, n, i = (e = t(e)[0]).config.widgets,
                    l = r.widgets,
                    d = l.length,
                    c = [],
                    g = function(e) {
                        t(e).triggerHandler("refreshComplete")
                    };
                for (a = 0; a < d; a++)(n = l[a]) && n.id && (s || t.inArray(n.id, i) < 0) && (c[c.length] = n.id);
                r.removeWidget(e, c.join(","), !0), !0 !== o ? (r.applyWidget(e, s || !1, g), s && r.applyWidget(e, !1, g)) : g(e)
            },
            benchmark: function(e) {
                return " (" + ((new Date).getTime() - e.getTime()) + " ms)"
            },
            log: function() {
                console.log(arguments)
            },
            isEmptyObject: function(e) {
                for (var t in e) return !1;
                return !0
            },
            isValueInArray: function(e, t) {
                var r, s = t && t.length || 0;
                for (r = 0; r < s; r++)
                    if (t[r][0] === e) return r;
                return -1
            },
            formatFloat: function(e, s) {
                if ("string" != typeof e || "" === e) return e;
                var o;
                return e = (s && s.config ? !1 !== s.config.usNumberFormat : void 0 === s || s) ? e.replace(r.regex.comma, "") : e.replace(r.regex.digitNonUS, "").replace(r.regex.comma, "."), r.regex.digitNegativeTest.test(e) && (e = e.replace(r.regex.digitNegativeReplace, "-$1")), o = parseFloat(e), isNaN(o) ? t.trim(e) : o
            },
            isDigit: function(e) {
                return isNaN(e) ? r.regex.digitTest.test(e.toString().replace(r.regex.digitReplace, "")) : "" !== e
            },
            computeColumnIndex: function(e, s) {
                var o, a, n, i, l, d, c, g, p, u, f = s && s.columns || 0,
                    h = [],
                    m = new Array(f);
                for (o = 0; o < e.length; o++)
                    for (d = e[o].cells, a = 0; a < d.length; a++) {
                        for (c = (l = d[a]).parentNode.rowIndex, g = l.rowSpan || 1, p = l.colSpan || 1, void 0 === h[c] && (h[c] = []), n = 0; n < h[c].length + 1; n++)
                            if (void 0 === h[c][n]) {
                                u = n;
                                break
                            }
                        for (f && l.cellIndex === u || (l.setAttribute ? l.setAttribute("data-column", u) : t(l).attr("data-column", u)), n = c; n < c + g; n++)
                            for (void 0 === h[n] && (h[n] = []), m = h[n], i = u; i < u + p; i++) m[i] = "x"
                    }
                return r.checkColumnCount(e, h, m.length), m.length
            },
            checkColumnCount: function(e, t, r) {
                var s, o, a = !0,
                    n = [];
                for (s = 0; s < t.length; s++)
                    if (t[s] && (o = t[s].length, t[s].length !== r)) {
                        a = !1;
                        break
                    }
                a || (e.each(function(e, t) {
                    var r = t.parentElement.nodeName;
                    n.indexOf(r) && n.push(r)
                }), console.error("Invalid or incorrect number of columns in the " + n.join(" or ") + "; expected " + r + ", but found " + o + " columns"))
            },
            fixColumnWidth: function(e) {
                var s, o, a, n, i, l = (e = t(e)[0]).config,
                    d = l.$table.children("colgroup");
                if (d.length && d.hasClass(r.css.colgroup) && d.remove(), l.widthFixed && 0 === l.$table.children("colgroup").length) {
                    for (d = t('<colgroup class="' + r.css.colgroup + '">'), s = l.$table.width(), n = (a = l.$tbodies.find("tr:first").children(":visible")).length, i = 0; i < n; i++) o = parseInt(a.eq(i).width() / s * 1e3, 10) / 10 + "%", d.append(t("<col>").css("width", o));
                    l.$table.prepend(d)
                }
            },
            getData: function(e, r, s) {
                var o, a, n = "",
                    i = t(e);
                return i.length ? (o = !!t.metadata && i.metadata(), a = " " + (i.attr("class") || ""), void 0 !== i.data(s) || void 0 !== i.data(s.toLowerCase()) ? n += i.data(s) || i.data(s.toLowerCase()) : o && void 0 !== o[s] ? n += o[s] : r && void 0 !== r[s] ? n += r[s] : " " !== a && a.match(" " + s + "-") && (n = a.match(new RegExp("\\s" + s + "-([\\w-]+)"))[1] || ""), t.trim(n)) : ""
            },
            getColumnData: function(e, r, s, o, a) {
                if ("object" != typeof r || null === r) return r;
                var n, i = (e = t(e)[0]).config,
                    l = a || i.$headers,
                    d = i.$headerIndexed && i.$headerIndexed[s] || l.filter('[data-column="' + s + '"]:last');
                if (void 0 !== r[s]) return o ? r[s] : r[l.index(d)];
                for (n in r)
                    if ("string" == typeof n && d.filter(n).add(d.find(n)).length) return r[n]
            },
            isProcessing: function(e, s, o) {
                var a = (e = t(e))[0].config,
                    n = o || e.find("." + r.css.header);
                s ? (void 0 !== o && a.sortList.length > 0 && (n = n.filter(function() {
                    return !this.sortDisabled && r.isValueInArray(parseFloat(t(this).attr("data-column")), a.sortList) >= 0
                })), e.add(n).addClass(r.css.processing + " " + a.cssProcessing)) : e.add(n).removeClass(r.css.processing + " " + a.cssProcessing)
            },
            processTbody: function(e, r, s) {
                if (e = t(e)[0], s) return e.isProcessing = !0, r.before('<colgroup class="tablesorter-savemyplace"/>'), t.fn.detach ? r.detach() : r.remove();
                var o = t(e).find("colgroup.tablesorter-savemyplace");
                r.insertAfter(o), o.remove(), e.isProcessing = !1
            },
            clearTableBody: function(e) {
                t(e)[0].config.$tbodies.children().detach()
            },
            characterEquivalents: {
                a: "áàâãäąå",
                A: "ÁÀÂÃÄĄÅ",
                c: "çćč",
                C: "ÇĆČ",
                e: "éèêëěę",
                E: "ÉÈÊËĚĘ",
                i: "íìİîïı",
                I: "ÍÌİÎÏ",
                o: "óòôõöō",
                O: "ÓÒÔÕÖŌ",
                ss: "ß",
                SS: "ẞ",
                u: "úùûüů",
                U: "ÚÙÛÜŮ"
            },
            replaceAccents: function(e) {
                var t, s = "[",
                    o = r.characterEquivalents;
                if (!r.characterRegex) {
                    r.characterRegexArray = {};
                    for (t in o) "string" == typeof t && (s += o[t], r.characterRegexArray[t] = new RegExp("[" + o[t] + "]", "g"));
                    r.characterRegex = new RegExp(s + "]")
                }
                if (r.characterRegex.test(e))
                    for (t in o) "string" == typeof t && (e = e.replace(r.characterRegexArray[t], t));
                return e
            },
            validateOptions: function(e) {
                var s, o, a, n, i = "headers sortForce sortList sortAppend widgets".split(" "),
                    l = e.originalSettings;
                if (l) {
                    e.debug && (n = new Date);
                    for (s in l)
                        if ("undefined" === (a = typeof r.defaults[s])) console.warn('Tablesorter Warning! "table.config.' + s + '" option not recognized');
                        else if ("object" === a)
                        for (o in l[s]) a = r.defaults[s] && typeof r.defaults[s][o], t.inArray(s, i) < 0 && "undefined" === a && console.warn('Tablesorter Warning! "table.config.' + s + "." + o + '" option not recognized');
                    e.debug && console.log("validate options time:" + r.benchmark(n))
                }
            },
            restoreHeaders: function(e) {
                var s, o, a = t(e)[0].config,
                    n = a.$table.find(a.selectorHeaders),
                    i = n.length;
                for (s = 0; s < i; s++)(o = n.eq(s)).find("." + r.css.headerIn).length && o.html(a.headerContent[s])
            },
            destroy: function(e, s, o) {
                if ((e = t(e)[0]).hasInitialized) {
                    r.removeWidget(e, !0, !1);
                    var a, n = t(e),
                        i = e.config,
                        l = i.debug,
                        d = n.find("thead:first"),
                        c = d.find("tr." + r.css.headerRow).removeClass(r.css.headerRow + " " + i.cssHeaderRow),
                        g = n.find("tfoot:first > tr").children("th, td");
                    !1 === s && t.inArray("uitheme", i.widgets) >= 0 && (n.triggerHandler("applyWidgetId", ["uitheme"]), n.triggerHandler("applyWidgetId", ["zebra"])), d.find("tr").not(c).remove(), a = "sortReset update updateRows updateAll updateHeaders updateCell addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets removeWidget destroy mouseup mouseleave " + "keypress sortBegin sortEnd resetToLoadState ".split(" ").join(i.namespace + " "), n.removeData("tablesorter").unbind(a.replace(r.regex.spaces, " ")), i.$headers.add(g).removeClass([r.css.header, i.cssHeader, i.cssAsc, i.cssDesc, r.css.sortAsc, r.css.sortDesc, r.css.sortNone].join(" ")).removeAttr("data-column").removeAttr("aria-label").attr("aria-disabled", "true"), c.find(i.selectorSort).unbind("mousedown mouseup keypress ".split(" ").join(i.namespace + " ").replace(r.regex.spaces, " ")), r.restoreHeaders(e), n.toggleClass(r.css.table + " " + i.tableClass + " tablesorter-" + i.theme, !1 === s), n.removeClass(i.namespace.slice(1)), e.hasInitialized = !1, delete e.config.cache, "function" == typeof o && o(e), l && console.log("tablesorter has been removed")
                }
            }
        };
        t.fn.tablesorter = function(e) {
            return this.each(function() {
                var s = this,
                    o = t.extend(!0, {}, r.defaults, e, r.instanceMethods);
                o.originalSettings = e, !s.hasInitialized && r.buildTable && "TABLE" !== this.nodeName ? r.buildTable(s, o) : r.setup(s, o)
            })
        }, window.console && window.console.log || (r.logs = [], console = {}, console.log = console.warn = console.error = console.table = function() {
            var e = arguments.length > 1 ? arguments : arguments[0];
            r.logs[r.logs.length] = {
                date: Date.now(),
                log: e
            }
        }), r.addParser({
            id: "no-parser",
            is: function() {
                return !1
            },
            format: function() {
                return ""
            },
            type: "text"
        }), r.addParser({
            id: "text",
            is: function() {
                return !0
            },
            format: function(e, s) {
                var o = s.config;
                return e && (e = t.trim(o.ignoreCase ? e.toLocaleLowerCase() : e), e = o.sortLocaleCompare ? r.replaceAccents(e) : e), e
            },
            type: "text"
        }), r.regex.nondigit = /[^\w,. \-()]/g, r.addParser({
            id: "digit",
            is: function(e) {
                return r.isDigit(e)
            },
            format: function(e, s) {
                var o = r.formatFloat((e || "").replace(r.regex.nondigit, ""), s);
                return e && "number" == typeof o ? o : e ? t.trim(e && s.config.ignoreCase ? e.toLocaleLowerCase() : e) : e
            },
            type: "numeric"
        }), r.regex.currencyReplace = /[+\-,. ]/g, r.regex.currencyTest = /^\(?\d+[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]|[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]\d+\)?$/, r.addParser({
            id: "currency",
            is: function(e) {
                return e = (e || "").replace(r.regex.currencyReplace, ""), r.regex.currencyTest.test(e)
            },
            format: function(e, s) {
                var o = r.formatFloat((e || "").replace(r.regex.nondigit, ""), s);
                return e && "number" == typeof o ? o : e ? t.trim(e && s.config.ignoreCase ? e.toLocaleLowerCase() : e) : e
            },
            type: "numeric"
        }), r.regex.urlProtocolTest = /^(https?|ftp|file):\/\//, r.regex.urlProtocolReplace = /(https?|ftp|file):\/\/(www\.)?/, r.addParser({
            id: "url",
            is: function(e) {
                return r.regex.urlProtocolTest.test(e)
            },
            format: function(e) {
                return e ? t.trim(e.replace(r.regex.urlProtocolReplace, "")) : e
            },
            type: "text"
        }), r.regex.dash = /-/g, r.regex.isoDate = /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/, r.addParser({
            id: "isoDate",
            is: function(e) {
                return r.regex.isoDate.test(e)
            },
            format: function(e, t) {
                var s = e ? new Date(e.replace(r.regex.dash, "/")) : e;
                return s instanceof Date && isFinite(s) ? s.getTime() : e
            },
            type: "numeric"
        }), r.regex.percent = /%/g, r.regex.percentTest = /(\d\s*?%|%\s*?\d)/, r.addParser({
            id: "percent",
            is: function(e) {
                return r.regex.percentTest.test(e) && e.length < 15
            },
            format: function(e, t) {
                return e ? r.formatFloat(e.replace(r.regex.percent, ""), t) : e
            },
            type: "numeric"
        }), r.addParser({
            id: "image",
            is: function(e, t, r, s) {
                return s.find("img").length > 0
            },
            format: function(e, r, s) {
                return t(s).find("img").attr(r.config.imgAttr || "alt") || e
            },
            parsed: !0,
            type: "text"
        }), r.regex.dateReplace = /(\S)([AP]M)$/i, r.regex.usLongDateTest1 = /^[A-Z]{3,10}\.?\s+\d{1,2},?\s+(\d{4})(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?$/i, r.regex.usLongDateTest2 = /^\d{1,2}\s+[A-Z]{3,10}\s+\d{4}/i, r.addParser({
            id: "usLongDate",
            is: function(e) {
                return r.regex.usLongDateTest1.test(e) || r.regex.usLongDateTest2.test(e)
            },
            format: function(e, t) {
                var s = e ? new Date(e.replace(r.regex.dateReplace, "$1 $2")) : e;
                return s instanceof Date && isFinite(s) ? s.getTime() : e
            },
            type: "numeric"
        }), r.regex.shortDateTest = /(^\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4})|(^\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2})/, r.regex.shortDateReplace = /[\-.,]/g, r.regex.shortDateXXY = /(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, r.regex.shortDateYMD = /(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/, r.convertFormat = function(e, t) {
            e = (e || "").replace(r.regex.spaces, " ").replace(r.regex.shortDateReplace, "/"), "mmddyyyy" === t ? e = e.replace(r.regex.shortDateXXY, "$3/$1/$2") : "ddmmyyyy" === t ? e = e.replace(r.regex.shortDateXXY, "$3/$2/$1") : "yyyymmdd" === t && (e = e.replace(r.regex.shortDateYMD, "$1/$2/$3"));
            var s = new Date(e);
            return s instanceof Date && isFinite(s) ? s.getTime() : ""
        }, r.addParser({
            id: "shortDate",
            is: function(e) {
                return e = (e || "").replace(r.regex.spaces, " ").replace(r.regex.shortDateReplace, "/"), r.regex.shortDateTest.test(e)
            },
            format: function(e, t, s, o) {
                if (e) {
                    var a = t.config,
                        n = a.$headerIndexed[o],
                        i = n.length && n.data("dateFormat") || r.getData(n, r.getColumnData(t, a.headers, o), "dateFormat") || a.dateFormat;
                    return n.length && n.data("dateFormat", i), r.convertFormat(e, i) || e
                }
                return e
            },
            type: "numeric"
        }), r.regex.timeTest = /^(0?[1-9]|1[0-2]):([0-5]\d)(\s[AP]M)$|^((?:[01]\d|[2][0-4]):[0-5]\d)$/i, r.regex.timeMatch = /(0?[1-9]|1[0-2]):([0-5]\d)(\s[AP]M)|((?:[01]\d|[2][0-4]):[0-5]\d)/i, r.addParser({
            id: "time",
            is: function(e) {
                return r.regex.timeTest.test(e)
            },
            format: function(e, t) {
                var s, o = (e || "").match(r.regex.timeMatch),
                    a = new Date(e),
                    n = e && (null !== o ? o[0] : "00:00 AM"),
                    i = n ? new Date("2000/01/01 " + n.replace(r.regex.dateReplace, "$1 $2")) : n;
                return i instanceof Date && isFinite(i) ? (s = a instanceof Date && isFinite(a) ? a.getTime() : 0, s ? parseFloat(i.getTime() + "." + a.getTime()) : i.getTime()) : e
            },
            type: "numeric"
        }), r.addParser({
            id: "metadata",
            is: function() {
                return !1
            },
            format: function(e, r, s) {
                var o = r.config,
                    a = o.parserMetadataName ? o.parserMetadataName : "sortValue";
                return t(s).metadata()[a]
            },
            type: "numeric"
        }), r.addWidget({
            id: "zebra",
            priority: 90,
            format: function(e, r, s) {
                var o, a, n, i, l, d, c, g = new RegExp(r.cssChildRow, "i"),
                    p = r.$tbodies.add(t(r.namespace + "_extra_table").children("tbody:not(." + r.cssInfoBlock + ")"));
                for (l = 0; l < p.length; l++)
                    for (n = 0, c = (o = p.eq(l).children("tr:visible").not(r.selectorRemove)).length, d = 0; d < c; d++) a = o.eq(d), g.test(a[0].className) || n++, i = n % 2 == 0, a.removeClass(s.zebra[i ? 1 : 0]).addClass(s.zebra[i ? 0 : 1])
            },
            remove: function(e, t, s, o) {
                if (!o) {
                    var a, n, i = t.$tbodies,
                        l = (s.zebra || ["even", "odd"]).join(" ");
                    for (a = 0; a < i.length; a++)(n = r.processTbody(e, i.eq(a), !0)).children().removeClass(l), r.processTbody(e, n, !1)
                }
            }
        })
    }(e), e.tablesorter
});