/*!
 DataTables 1.10.24
 ©2008-2021 SpryMedia Ltd - datatables.net/license
*/
(function (h) {
	"function" === typeof define && define.amd
		? define(["jquery"], function (E) {
				return h(E, window, document);
		  })
		: "object" === typeof exports
		? (module.exports = function (E, H) {
				E || (E = window);
				H ||
					(H =
						"undefined" !== typeof window
							? require("jquery")
							: require("jquery")(E));
				return h(H, E, E.document);
		  })
		: h(jQuery, window, document);
})(function (h, E, H, k) {
	function $(a) {
		var b,
			c,
			d = {};
		h.each(a, function (e) {
			if (
				(b = e.match(/^([^A-Z]+?)([A-Z])/)) &&
				-1 !== "a aa ai ao as b fn i m o s ".indexOf(b[1] + " ")
			)
				(c = e.replace(b[0], b[2].toLowerCase())),
					(d[c] = e),
					"o" === b[1] && $(a[e]);
		});
		a._hungarianMap = d;
	}
	function J(a, b, c) {
		a._hungarianMap || $(a);
		var d;
		h.each(b, function (e) {
			d = a._hungarianMap[e];
			if (d !== k && (c || b[d] === k))
				"o" === d.charAt(0)
					? (b[d] || (b[d] = {}), h.extend(!0, b[d], b[e]), J(a[d], b[d], c))
					: (b[d] = b[e]);
		});
	}
	function Ea(a) {
		var b = l.defaults.oLanguage,
			c = b.sDecimal;
		c && Fa(c);
		if (a) {
			var d = a.sZeroRecords;
			!a.sEmptyTable &&
				d &&
				"لا توجد بيانات مطابقة" === b.sEmptyTable &&
				F(a, a, "sZeroRecords", "sEmptyTable");
			!a.sLoadingRecords &&
				d &&
				"Loading..." === b.sLoadingRecords &&
				F(a, a, "sZeroRecords", "sLoadingRecords");
			a.sInfoThousands && (a.sThousands = a.sInfoThousands);
			(a = a.sDecimal) && c !== a && Fa(a);
		}
	}
	function gb(a) {
		A(a, "ordering", "bSort");
		A(a, "orderMulti", "bSortMulti");
		A(a, "orderClasses", "bSortClasses");
		A(a, "orderCellsTop", "bSortCellsTop");
		A(a, "order", "aaSorting");
		A(a, "orderFixed", "aaSortingFixed");
		A(a, "paging", "bPaginate");
		A(a, "pagingType", "sPaginationType");
		A(a, "pageLength", "iDisplayLength");
		A(a, "searching", "bFilter");
		"boolean" === typeof a.sScrollX && (a.sScrollX = a.sScrollX ? "100%" : "");
		"boolean" === typeof a.scrollX && (a.scrollX = a.scrollX ? "100%" : "");
		if ((a = a.aoSearchCols))
			for (var b = 0, c = a.length; b < c; b++)
				a[b] && J(l.models.oSearch, a[b]);
	}
	function hb(a) {
		A(a, "orderable", "bSortable");
		A(a, "orderData", "aDataSort");
		A(a, "orderSequence", "asSorting");
		A(a, "orderDataType", "sortDataType");
		var b = a.aDataSort;
		"number" === typeof b && !Array.isArray(b) && (a.aDataSort = [b]);
	}
	function ib(a) {
		if (!l.__browser) {
			var b = {};
			l.__browser = b;
			var c = h("<div/>")
					.css({
						position: "fixed",
						top: 0,
						left: -1 * h(E).scrollLeft(),
						height: 1,
						width: 1,
						overflow: "hidden",
					})
					.append(
						h("<div/>")
							.css({
								position: "absolute",
								top: 1,
								left: 1,
								width: 100,
								overflow: "scroll",
							})
							.append(h("<div/>").css({ width: "100%", height: 10 }))
					)
					.appendTo("body"),
				d = c.children(),
				e = d.children();
			b.barWidth = d[0].offsetWidth - d[0].clientWidth;
			b.bScrollOversize = 100 === e[0].offsetWidth && 100 !== d[0].clientWidth;
			b.bScrollbarLeft = 1 !== Math.round(e.offset().left);
			b.bBounding = c[0].getBoundingClientRect().width ? !0 : !1;
			c.remove();
		}
		h.extend(a.oBrowser, l.__browser);
		a.oScroll.iBarWidth = l.__browser.barWidth;
	}
	function jb(a, b, c, d, e, f) {
		var g,
			j = !1;
		c !== k && ((g = c), (j = !0));
		for (; d !== e; )
			a.hasOwnProperty(d) &&
				((g = j ? b(g, a[d], d, a) : a[d]), (j = !0), (d += f));
		return g;
	}
	function Ga(a, b) {
		var c = l.defaults.column,
			d = a.aoColumns.length,
			c = h.extend({}, l.models.oColumn, c, {
				nTh: b ? b : H.createElement("th"),
				sTitle: c.sTitle ? c.sTitle : b ? b.innerHTML : "",
				aDataSort: c.aDataSort ? c.aDataSort : [d],
				mData: c.mData ? c.mData : d,
				idx: d,
			});
		a.aoColumns.push(c);
		c = a.aoPreSearchCols;
		c[d] = h.extend({}, l.models.oSearch, c[d]);
		la(a, d, h(b).data());
	}
	function la(a, b, c) {
		var b = a.aoColumns[b],
			d = a.oClasses,
			e = h(b.nTh);
		if (!b.sWidthOrig) {
			b.sWidthOrig = e.attr("width") || null;
			var f = (e.attr("style") || "").match(/width:\s*(\d+[pxem%]+)/);
			f && (b.sWidthOrig = f[1]);
		}
		c !== k &&
			null !== c &&
			(hb(c),
			J(l.defaults.column, c, !0),
			c.mDataProp !== k && !c.mData && (c.mData = c.mDataProp),
			c.sType && (b._sManualType = c.sType),
			c.className && !c.sClass && (c.sClass = c.className),
			c.sClass && e.addClass(c.sClass),
			h.extend(b, c),
			F(b, c, "sWidth", "sWidthOrig"),
			c.iDataSort !== k && (b.aDataSort = [c.iDataSort]),
			F(b, c, "aDataSort"));
		var g = b.mData,
			j = S(g),
			i = b.mRender ? S(b.mRender) : null,
			c = function (a) {
				return "string" === typeof a && -1 !== a.indexOf("@");
			};
		b._bAttrSrc = h.isPlainObject(g) && (c(g.sort) || c(g.type) || c(g.filter));
		b._setter = null;
		b.fnGetData = function (a, b, c) {
			var d = j(a, b, k, c);
			return i && b ? i(d, b, a, c) : d;
		};
		b.fnSetData = function (a, b, c) {
			return N(g)(a, b, c);
		};
		"number" !== typeof g && (a._rowReadObject = !0);
		a.oFeatures.bSort || ((b.bSortable = !1), e.addClass(d.sSortableNone));
		a = -1 !== h.inArray("asc", b.asSorting);
		c = -1 !== h.inArray("desc", b.asSorting);
		!b.bSortable || (!a && !c)
			? ((b.sSortingClass = d.sSortableNone), (b.sSortingClassJUI = ""))
			: a && !c
			? ((b.sSortingClass = d.sSortableAsc),
			  (b.sSortingClassJUI = d.sSortJUIAscAllowed))
			: !a && c
			? ((b.sSortingClass = d.sSortableDesc),
			  (b.sSortingClassJUI = d.sSortJUIDescAllowed))
			: ((b.sSortingClass = d.sSortable), (b.sSortingClassJUI = d.sSortJUI));
	}
	function aa(a) {
		if (!1 !== a.oFeatures.bAutoWidth) {
			var b = a.aoColumns;
			Ha(a);
			for (var c = 0, d = b.length; c < d; c++)
				b[c].nTh.style.width = b[c].sWidth;
		}
		b = a.oScroll;
		("" !== b.sY || "" !== b.sX) && ma(a);
		t(a, null, "column-sizing", [a]);
	}
	function ba(a, b) {
		var c = na(a, "bVisible");
		return "number" === typeof c[b] ? c[b] : null;
	}
	function ca(a, b) {
		var c = na(a, "bVisible"),
			c = h.inArray(b, c);
		return -1 !== c ? c : null;
	}
	function W(a) {
		var b = 0;
		h.each(a.aoColumns, function (a, d) {
			d.bVisible && "none" !== h(d.nTh).css("display") && b++;
		});
		return b;
	}
	function na(a, b) {
		var c = [];
		h.map(a.aoColumns, function (a, e) {
			a[b] && c.push(e);
		});
		return c;
	}
	function Ia(a) {
		var b = a.aoColumns,
			c = a.aoData,
			d = l.ext.type.detect,
			e,
			f,
			g,
			j,
			i,
			h,
			m,
			q,
			s;
		e = 0;
		for (f = b.length; e < f; e++)
			if (((m = b[e]), (s = []), !m.sType && m._sManualType))
				m.sType = m._sManualType;
			else if (!m.sType) {
				g = 0;
				for (j = d.length; g < j; g++) {
					i = 0;
					for (h = c.length; i < h; i++) {
						s[i] === k && (s[i] = B(a, i, e, "type"));
						q = d[g](s[i], a);
						if (!q && g !== d.length - 1) break;
						if ("html" === q) break;
					}
					if (q) {
						m.sType = q;
						break;
					}
				}
				m.sType || (m.sType = "string");
			}
	}
	function kb(a, b, c, d) {
		var e,
			f,
			g,
			j,
			i,
			n,
			m = a.aoColumns;
		if (b)
			for (e = b.length - 1; 0 <= e; e--) {
				n = b[e];
				var q = n.targets !== k ? n.targets : n.aTargets;
				Array.isArray(q) || (q = [q]);
				f = 0;
				for (g = q.length; f < g; f++)
					if ("number" === typeof q[f] && 0 <= q[f]) {
						for (; m.length <= q[f]; ) Ga(a);
						d(q[f], n);
					} else if ("number" === typeof q[f] && 0 > q[f])
						d(m.length + q[f], n);
					else if ("string" === typeof q[f]) {
						j = 0;
						for (i = m.length; j < i; j++)
							("_all" == q[f] || h(m[j].nTh).hasClass(q[f])) && d(j, n);
					}
			}
		if (c) {
			e = 0;
			for (a = c.length; e < a; e++) d(e, c[e]);
		}
	}
	function O(a, b, c, d) {
		var e = a.aoData.length,
			f = h.extend(!0, {}, l.models.oRow, { src: c ? "dom" : "data", idx: e });
		f._aData = b;
		a.aoData.push(f);
		for (var g = a.aoColumns, j = 0, i = g.length; j < i; j++)
			g[j].sType = null;
		a.aiDisplayMaster.push(e);
		b = a.rowIdFn(b);
		b !== k && (a.aIds[b] = f);
		(c || !a.oFeatures.bDeferRender) && Ja(a, e, c, d);
		return e;
	}
	function oa(a, b) {
		var c;
		b instanceof h || (b = h(b));
		return b.map(function (b, e) {
			c = Ka(a, e);
			return O(a, c.data, e, c.cells);
		});
	}
	function B(a, b, c, d) {
		var e = a.iDraw,
			f = a.aoColumns[c],
			g = a.aoData[b]._aData,
			j = f.sDefaultContent,
			i = f.fnGetData(g, d, { settings: a, row: b, col: c });
		if (i === k)
			return (
				a.iDrawError != e &&
					null === j &&
					(K(
						a,
						0,
						"Requested unknown parameter " +
							("function" == typeof f.mData
								? "{function}"
								: "'" + f.mData + "'") +
							" for row " +
							b +
							", column " +
							c,
						4
					),
					(a.iDrawError = e)),
				j
			);
		if ((i === g || null === i) && null !== j && d !== k) i = j;
		else if ("function" === typeof i) return i.call(g);
		return null === i && "display" == d ? "" : i;
	}
	function lb(a, b, c, d) {
		a.aoColumns[c].fnSetData(a.aoData[b]._aData, d, {
			settings: a,
			row: b,
			col: c,
		});
	}
	function La(a) {
		return h.map(a.match(/(\\.|[^\.])+/g) || [""], function (a) {
			return a.replace(/\\\./g, ".");
		});
	}
	function S(a) {
		if (h.isPlainObject(a)) {
			var b = {};
			h.each(a, function (a, c) {
				c && (b[a] = S(c));
			});
			return function (a, c, f, g) {
				var j = b[c] || b._;
				return j !== k ? j(a, c, f, g) : a;
			};
		}
		if (null === a)
			return function (a) {
				return a;
			};
		if ("function" === typeof a)
			return function (b, c, f, g) {
				return a(b, c, f, g);
			};
		if (
			"string" === typeof a &&
			(-1 !== a.indexOf(".") || -1 !== a.indexOf("[") || -1 !== a.indexOf("("))
		) {
			var c = function (a, b, f) {
				var g, j;
				if ("" !== f) {
					j = La(f);
					for (var i = 0, h = j.length; i < h; i++) {
						f = j[i].match(da);
						g = j[i].match(X);
						if (f) {
							j[i] = j[i].replace(da, "");
							"" !== j[i] && (a = a[j[i]]);
							g = [];
							j.splice(0, i + 1);
							j = j.join(".");
							if (Array.isArray(a)) {
								i = 0;
								for (h = a.length; i < h; i++) g.push(c(a[i], b, j));
							}
							a = f[0].substring(1, f[0].length - 1);
							a = "" === a ? g : g.join(a);
							break;
						} else if (g) {
							j[i] = j[i].replace(X, "");
							a = a[j[i]]();
							continue;
						}
						if (null === a || a[j[i]] === k) return k;
						a = a[j[i]];
					}
				}
				return a;
			};
			return function (b, e) {
				return c(b, e, a);
			};
		}
		return function (b) {
			return b[a];
		};
	}
	function N(a) {
		if (h.isPlainObject(a)) return N(a._);
		if (null === a) return function () {};
		if ("function" === typeof a)
			return function (b, d, e) {
				a(b, "set", d, e);
			};
		if (
			"string" === typeof a &&
			(-1 !== a.indexOf(".") || -1 !== a.indexOf("[") || -1 !== a.indexOf("("))
		) {
			var b = function (a, d, e) {
				var e = La(e),
					f;
				f = e[e.length - 1];
				for (var g, j, i = 0, h = e.length - 1; i < h; i++) {
					if ("__proto__" === e[i] || "constructor" === e[i])
						throw Error("Cannot set prototype values");
					g = e[i].match(da);
					j = e[i].match(X);
					if (g) {
						e[i] = e[i].replace(da, "");
						a[e[i]] = [];
						f = e.slice();
						f.splice(0, i + 1);
						g = f.join(".");
						if (Array.isArray(d)) {
							j = 0;
							for (h = d.length; j < h; j++)
								(f = {}), b(f, d[j], g), a[e[i]].push(f);
						} else a[e[i]] = d;
						return;
					}
					j && ((e[i] = e[i].replace(X, "")), (a = a[e[i]](d)));
					if (null === a[e[i]] || a[e[i]] === k) a[e[i]] = {};
					a = a[e[i]];
				}
				if (f.match(X)) a[f.replace(X, "")](d);
				else a[f.replace(da, "")] = d;
			};
			return function (c, d) {
				return b(c, d, a);
			};
		}
		return function (b, d) {
			b[a] = d;
		};
	}
	function Ma(a) {
		return C(a.aoData, "_aData");
	}
	function pa(a) {
		a.aoData.length = 0;
		a.aiDisplayMaster.length = 0;
		a.aiDisplay.length = 0;
		a.aIds = {};
	}
	function qa(a, b, c) {
		for (var d = -1, e = 0, f = a.length; e < f; e++)
			a[e] == b ? (d = e) : a[e] > b && a[e]--;
		-1 != d && c === k && a.splice(d, 1);
	}
	function ea(a, b, c, d) {
		var e = a.aoData[b],
			f,
			g = function (c, d) {
				for (; c.childNodes.length; ) c.removeChild(c.firstChild);
				c.innerHTML = B(a, b, d, "display");
			};
		if ("dom" === c || ((!c || "auto" === c) && "dom" === e.src))
			e._aData = Ka(a, e, d, d === k ? k : e._aData).data;
		else {
			var j = e.anCells;
			if (j)
				if (d !== k) g(j[d], d);
				else {
					c = 0;
					for (f = j.length; c < f; c++) g(j[c], c);
				}
		}
		e._aSortData = null;
		e._aFilterData = null;
		g = a.aoColumns;
		if (d !== k) g[d].sType = null;
		else {
			c = 0;
			for (f = g.length; c < f; c++) g[c].sType = null;
			Na(a, e);
		}
	}
	function Ka(a, b, c, d) {
		var e = [],
			f = b.firstChild,
			g,
			j,
			i = 0,
			h,
			m = a.aoColumns,
			q = a._rowReadObject,
			d = d !== k ? d : q ? {} : [],
			s = function (a, b) {
				if ("string" === typeof a) {
					var c = a.indexOf("@");
					-1 !== c && ((c = a.substring(c + 1)), N(a)(d, b.getAttribute(c)));
				}
			},
			G = function (a) {
				if (c === k || c === i)
					(j = m[i]),
						(h = a.innerHTML.trim()),
						j && j._bAttrSrc
							? (N(j.mData._)(d, h),
							  s(j.mData.sort, a),
							  s(j.mData.type, a),
							  s(j.mData.filter, a))
							: q
							? (j._setter || (j._setter = N(j.mData)), j._setter(d, h))
							: (d[i] = h);
				i++;
			};
		if (f)
			for (; f; ) {
				g = f.nodeName.toUpperCase();
				if ("TD" == g || "TH" == g) G(f), e.push(f);
				f = f.nextSibling;
			}
		else {
			e = b.anCells;
			f = 0;
			for (g = e.length; f < g; f++) G(e[f]);
		}
		if ((b = b.firstChild ? b : b.nTr))
			(b = b.getAttribute("id")) && N(a.rowId)(d, b);
		return { data: d, cells: e };
	}
	function Ja(a, b, c, d) {
		var e = a.aoData[b],
			f = e._aData,
			g = [],
			j,
			i,
			n,
			m,
			q;
		if (null === e.nTr) {
			j = c || H.createElement("tr");
			e.nTr = j;
			e.anCells = g;
			j._DT_RowIndex = b;
			Na(a, e);
			n = 0;
			for (m = a.aoColumns.length; n < m; n++) {
				i = a.aoColumns[n];
				e = (q = c ? !1 : !0) ? H.createElement(i.sCellType) : d[n];
				e._DT_CellIndex = { row: b, column: n };
				g.push(e);
				if (
					q ||
					((i.mRender || i.mData !== n) &&
						(!h.isPlainObject(i.mData) || i.mData._ !== n + ".display"))
				)
					e.innerHTML = B(a, b, n, "display");
				i.sClass && (e.className += " " + i.sClass);
				i.bVisible && !c
					? j.appendChild(e)
					: !i.bVisible && c && e.parentNode.removeChild(e);
				i.fnCreatedCell &&
					i.fnCreatedCell.call(a.oInstance, e, B(a, b, n), f, b, n);
			}
			t(a, "aoRowCreatedCallback", null, [j, f, b, g]);
		}
	}
	function Na(a, b) {
		var c = b.nTr,
			d = b._aData;
		if (c) {
			var e = a.rowIdFn(d);
			e && (c.id = e);
			d.DT_RowClass &&
				((e = d.DT_RowClass.split(" ")),
				(b.__rowc = b.__rowc ? ra(b.__rowc.concat(e)) : e),
				h(c).removeClass(b.__rowc.join(" ")).addClass(d.DT_RowClass));
			d.DT_RowAttr && h(c).attr(d.DT_RowAttr);
			d.DT_RowData && h(c).data(d.DT_RowData);
		}
	}
	function mb(a) {
		var b,
			c,
			d,
			e,
			f,
			g = a.nTHead,
			j = a.nTFoot,
			i = 0 === h("th, td", g).length,
			n = a.oClasses,
			m = a.aoColumns;
		i && (e = h("<tr/>").appendTo(g));
		b = 0;
		for (c = m.length; b < c; b++)
			(f = m[b]),
				(d = h(f.nTh).addClass(f.sClass)),
				i && d.appendTo(e),
				a.oFeatures.bSort &&
					(d.addClass(f.sSortingClass),
					!1 !== f.bSortable &&
						(d.attr("tabindex", a.iTabIndex).attr("aria-controls", a.sTableId),
						Oa(a, f.nTh, b))),
				f.sTitle != d[0].innerHTML && d.html(f.sTitle),
				Pa(a, "header")(a, d, f, n);
		i && fa(a.aoHeader, g);
		h(g).children("tr").attr("role", "row");
		h(g).children("tr").children("th, td").addClass(n.sHeaderTH);
		h(j).children("tr").children("th, td").addClass(n.sFooterTH);
		if (null !== j) {
			a = a.aoFooter[0];
			b = 0;
			for (c = a.length; b < c; b++)
				(f = m[b]),
					(f.nTf = a[b].cell),
					f.sClass && h(f.nTf).addClass(f.sClass);
		}
	}
	function ga(a, b, c) {
		var d,
			e,
			f,
			g = [],
			j = [],
			i = a.aoColumns.length,
			n;
		if (b) {
			c === k && (c = !1);
			d = 0;
			for (e = b.length; d < e; d++) {
				g[d] = b[d].slice();
				g[d].nTr = b[d].nTr;
				for (f = i - 1; 0 <= f; f--)
					!a.aoColumns[f].bVisible && !c && g[d].splice(f, 1);
				j.push([]);
			}
			d = 0;
			for (e = g.length; d < e; d++) {
				if ((a = g[d].nTr)) for (; (f = a.firstChild); ) a.removeChild(f);
				f = 0;
				for (b = g[d].length; f < b; f++)
					if (((n = i = 1), j[d][f] === k)) {
						a.appendChild(g[d][f].cell);
						for (
							j[d][f] = 1;
							g[d + i] !== k && g[d][f].cell == g[d + i][f].cell;

						)
							(j[d + i][f] = 1), i++;
						for (; g[d][f + n] !== k && g[d][f].cell == g[d][f + n].cell; ) {
							for (c = 0; c < i; c++) j[d + c][f + n] = 1;
							n++;
						}
						h(g[d][f].cell).attr("rowspan", i).attr("colspan", n);
					}
			}
		}
	}
	function P(a) {
		var b = t(a, "aoPreDrawCallback", "preDraw", [a]);
		if (-1 !== h.inArray(!1, b)) D(a, !1);
		else {
			var b = [],
				c = 0,
				d = a.asStripeClasses,
				e = d.length,
				f = a.oLanguage,
				g = a.iInitDisplayStart,
				j = "ssp" == y(a),
				i = a.aiDisplay;
			a.bDrawing = !0;
			g !== k &&
				-1 !== g &&
				((a._iDisplayStart = j ? g : g >= a.fnRecordsDisplay() ? 0 : g),
				(a.iInitDisplayStart = -1));
			var g = a._iDisplayStart,
				n = a.fnDisplayEnd();
			if (a.bDeferLoading) (a.bDeferLoading = !1), a.iDraw++, D(a, !1);
			else if (j) {
				if (!a.bDestroying && !nb(a)) return;
			} else a.iDraw++;
			if (0 !== i.length) {
				f = j ? a.aoData.length : n;
				for (j = j ? 0 : g; j < f; j++) {
					var m = i[j],
						q = a.aoData[m];
					null === q.nTr && Ja(a, m);
					var s = q.nTr;
					if (0 !== e) {
						var G = d[c % e];
						q._sRowStripe != G &&
							(h(s).removeClass(q._sRowStripe).addClass(G),
							(q._sRowStripe = G));
					}
					t(a, "aoRowCallback", null, [s, q._aData, c, j, m]);
					b.push(s);
					c++;
				}
			} else
				(c = f.sZeroRecords),
					1 == a.iDraw && "ajax" == y(a)
						? (c = f.sLoadingRecords)
						: f.sEmptyTable && 0 === a.fnRecordsTotal() && (c = f.sEmptyTable),
					(b[0] = h("<tr/>", { class: e ? d[0] : "" }).append(
						h("<td />", {
							valign: "top",
							colSpan: W(a),
							class: a.oClasses.sRowEmpty,
						}).html(c)
					)[0]);
			t(a, "aoHeaderCallback", "header", [
				h(a.nTHead).children("tr")[0],
				Ma(a),
				g,
				n,
				i,
			]);
			t(a, "aoFooterCallback", "footer", [
				h(a.nTFoot).children("tr")[0],
				Ma(a),
				g,
				n,
				i,
			]);
			d = h(a.nTBody);
			d.children().detach();
			d.append(h(b));
			t(a, "aoDrawCallback", "draw", [a]);
			a.bSorted = !1;
			a.bFiltered = !1;
			a.bDrawing = !1;
		}
	}
	function T(a, b) {
		var c = a.oFeatures,
			d = c.bFilter;
		c.bSort && ob(a);
		d ? ha(a, a.oPreviousSearch) : (a.aiDisplay = a.aiDisplayMaster.slice());
		!0 !== b && (a._iDisplayStart = 0);
		a._drawHold = b;
		P(a);
		a._drawHold = !1;
	}
	function pb(a) {
		var b = a.oClasses,
			c = h(a.nTable),
			c = h("<div/>").insertBefore(c),
			d = a.oFeatures,
			e = h("<div/>", {
				id: a.sTableId + "_wrapper",
				class: b.sWrapper + (a.nTFoot ? "" : " " + b.sNoFooter),
			});
		a.nHolding = c[0];
		a.nTableWrapper = e[0];
		a.nTableReinsertBefore = a.nTable.nextSibling;
		for (var f = a.sDom.split(""), g, j, i, n, m, q, k = 0; k < f.length; k++) {
			g = null;
			j = f[k];
			if ("<" == j) {
				i = h("<div/>")[0];
				n = f[k + 1];
				if ("'" == n || '"' == n) {
					m = "";
					for (q = 2; f[k + q] != n; ) (m += f[k + q]), q++;
					"H" == m ? (m = b.sJUIHeader) : "F" == m && (m = b.sJUIFooter);
					-1 != m.indexOf(".")
						? ((n = m.split(".")),
						  (i.id = n[0].substr(1, n[0].length - 1)),
						  (i.className = n[1]))
						: "#" == m.charAt(0)
						? (i.id = m.substr(1, m.length - 1))
						: (i.className = m);
					k += q;
				}
				e.append(i);
				e = h(i);
			} else if (">" == j) e = e.parent();
			else if ("l" == j && d.bPaginate && d.bLengthChange) g = qb(a);
			else if ("f" == j && d.bFilter) g = rb(a);
			else if ("r" == j && d.bProcessing) g = sb(a);
			else if ("t" == j) g = tb(a);
			else if ("i" == j && d.bInfo) g = ub(a);
			else if ("p" == j && d.bPaginate) g = vb(a);
			else if (0 !== l.ext.feature.length) {
				i = l.ext.feature;
				q = 0;
				for (n = i.length; q < n; q++)
					if (j == i[q].cFeature) {
						g = i[q].fnInit(a);
						break;
					}
			}
			g &&
				((i = a.aanFeatures), i[j] || (i[j] = []), i[j].push(g), e.append(g));
		}
		c.replaceWith(e);
		a.nHolding = null;
	}
	function fa(a, b) {
		var c = h(b).children("tr"),
			d,
			e,
			f,
			g,
			j,
			i,
			n,
			m,
			q,
			k;
		a.splice(0, a.length);
		f = 0;
		for (i = c.length; f < i; f++) a.push([]);
		f = 0;
		for (i = c.length; f < i; f++) {
			d = c[f];
			for (e = d.firstChild; e; ) {
				if (
					"TD" == e.nodeName.toUpperCase() ||
					"TH" == e.nodeName.toUpperCase()
				) {
					m = 1 * e.getAttribute("colspan");
					q = 1 * e.getAttribute("rowspan");
					m = !m || 0 === m || 1 === m ? 1 : m;
					q = !q || 0 === q || 1 === q ? 1 : q;
					g = 0;
					for (j = a[f]; j[g]; ) g++;
					n = g;
					k = 1 === m ? !0 : !1;
					for (j = 0; j < m; j++)
						for (g = 0; g < q; g++)
							(a[f + g][n + j] = { cell: e, unique: k }), (a[f + g].nTr = d);
				}
				e = e.nextSibling;
			}
		}
	}
	function sa(a, b, c) {
		var d = [];
		c || ((c = a.aoHeader), b && ((c = []), fa(c, b)));
		for (var b = 0, e = c.length; b < e; b++)
			for (var f = 0, g = c[b].length; f < g; f++)
				if (c[b][f].unique && (!d[f] || !a.bSortCellsTop)) d[f] = c[b][f].cell;
		return d;
	}
	function ta(a, b, c) {
		t(a, "aoServerParams", "serverParams", [b]);
		if (b && Array.isArray(b)) {
			var d = {},
				e = /(.*?)\[\]$/;
			h.each(b, function (a, b) {
				var c = b.name.match(e);
				c
					? ((c = c[0]), d[c] || (d[c] = []), d[c].push(b.value))
					: (d[b.name] = b.value);
			});
			b = d;
		}
		var f,
			g = a.ajax,
			j = a.oInstance,
			i = function (b) {
				t(a, null, "xhr", [a, b, a.jqXHR]);
				c(b);
			};
		if (h.isPlainObject(g) && g.data) {
			f = g.data;
			var n = "function" === typeof f ? f(b, a) : f,
				b = "function" === typeof f && n ? n : h.extend(!0, b, n);
			delete g.data;
		}
		n = {
			data: b,
			success: function (b) {
				var c = b.error || b.sError;
				c && K(a, 0, c);
				a.json = b;
				i(b);
			},
			dataType: "json",
			cache: !1,
			type: a.sServerMethod,
			error: function (b, c) {
				var d = t(a, null, "xhr", [a, null, a.jqXHR]);
				-1 === h.inArray(!0, d) &&
					("parsererror" == c
						? K(a, 0, "Invalid JSON response", 1)
						: 4 === b.readyState && K(a, 0, "Ajax error", 7));
				D(a, !1);
			},
		};
		a.oAjaxData = b;
		t(a, null, "preXhr", [a, b]);
		a.fnServerData
			? a.fnServerData.call(
					j,
					a.sAjaxSource,
					h.map(b, function (a, b) {
						return { name: b, value: a };
					}),
					i,
					a
			  )
			: a.sAjaxSource || "string" === typeof g
			? (a.jqXHR = h.ajax(h.extend(n, { url: g || a.sAjaxSource })))
			: "function" === typeof g
			? (a.jqXHR = g.call(j, b, i, a))
			: ((a.jqXHR = h.ajax(h.extend(n, g))), (g.data = f));
	}
	function nb(a) {
		return a.bAjaxDataGet
			? (a.iDraw++,
			  D(a, !0),
			  ta(a, wb(a), function (b) {
					xb(a, b);
			  }),
			  !1)
			: !0;
	}
	function wb(a) {
		var b = a.aoColumns,
			c = b.length,
			d = a.oFeatures,
			e = a.oPreviousSearch,
			f = a.aoPreSearchCols,
			g,
			j = [],
			i,
			n,
			m,
			k = Y(a);
		g = a._iDisplayStart;
		i = !1 !== d.bPaginate ? a._iDisplayLength : -1;
		var s = function (a, b) {
			j.push({ name: a, value: b });
		};
		s("sEcho", a.iDraw);
		s("iColumns", c);
		s("sColumns", C(b, "sName").join(","));
		s("iDisplayStart", g);
		s("iDisplayLength", i);
		var G = {
			draw: a.iDraw,
			columns: [],
			order: [],
			start: g,
			length: i,
			search: { value: e.sSearch, regex: e.bRegex },
		};
		for (g = 0; g < c; g++)
			(n = b[g]),
				(m = f[g]),
				(i = "function" == typeof n.mData ? "function" : n.mData),
				G.columns.push({
					data: i,
					name: n.sName,
					searchable: n.bSearchable,
					orderable: n.bSortable,
					search: { value: m.sSearch, regex: m.bRegex },
				}),
				s("mDataProp_" + g, i),
				d.bFilter &&
					(s("sSearch_" + g, m.sSearch),
					s("bRegex_" + g, m.bRegex),
					s("bSearchable_" + g, n.bSearchable)),
				d.bSort && s("bSortable_" + g, n.bSortable);
		d.bFilter && (s("sSearch", e.sSearch), s("bRegex", e.bRegex));
		d.bSort &&
			(h.each(k, function (a, b) {
				G.order.push({ column: b.col, dir: b.dir });
				s("iSortCol_" + a, b.col);
				s("sSortDir_" + a, b.dir);
			}),
			s("iSortingCols", k.length));
		b = l.ext.legacy.ajax;
		return null === b ? (a.sAjaxSource ? j : G) : b ? j : G;
	}
	function xb(a, b) {
		var c = ua(a, b),
			d = b.sEcho !== k ? b.sEcho : b.draw,
			e = b.iTotalRecords !== k ? b.iTotalRecords : b.recordsTotal,
			f =
				b.iTotalDisplayRecords !== k
					? b.iTotalDisplayRecords
					: b.recordsFiltered;
		if (d !== k) {
			if (1 * d < a.iDraw) return;
			a.iDraw = 1 * d;
		}
		pa(a);
		a._iRecordsTotal = parseInt(e, 10);
		a._iRecordsDisplay = parseInt(f, 10);
		d = 0;
		for (e = c.length; d < e; d++) O(a, c[d]);
		a.aiDisplay = a.aiDisplayMaster.slice();
		a.bAjaxDataGet = !1;
		P(a);
		a._bInitComplete || va(a, b);
		a.bAjaxDataGet = !0;
		D(a, !1);
	}
	function ua(a, b) {
		var c =
			h.isPlainObject(a.ajax) && a.ajax.dataSrc !== k
				? a.ajax.dataSrc
				: a.sAjaxDataProp;
		return "data" === c ? b.aaData || b[c] : "" !== c ? S(c)(b) : b;
	}
	function rb(a) {
		var b = a.oClasses,
			c = a.sTableId,
			d = a.oLanguage,
			e = a.oPreviousSearch,
			f = a.aanFeatures,
			g = '<input type="search" class="' + b.sFilterInput + '"/>',
			j = d.sSearch,
			j = j.match(/_INPUT_/) ? j.replace("_INPUT_", g) : j + g,
			b = h("<div/>", {
				id: !f.f ? c + "_filter" : null,
				class: b.sFilter,
			}).append(h("<label/>").append(j)),
			i = function () {
				var b = !this.value ? "" : this.value;
				b != e.sSearch &&
					(ha(a, {
						sSearch: b,
						bRegex: e.bRegex,
						bSmart: e.bSmart,
						bCaseInsensitive: e.bCaseInsensitive,
					}),
					(a._iDisplayStart = 0),
					P(a));
			},
			f = null !== a.searchDelay ? a.searchDelay : "ssp" === y(a) ? 400 : 0,
			n = h("input", b)
				.val(e.sSearch)
				.attr("placeholder", d.sSearchPlaceholder)
				.on("keyup.DT search.DT input.DT paste.DT cut.DT", f ? Qa(i, f) : i)
				.on("mouseup", function () {
					setTimeout(function () {
						i.call(n[0]);
					}, 10);
				})
				.on("keypress.DT", function (a) {
					if (13 == a.keyCode) return !1;
				})
				.attr("aria-controls", c);
		h(a.nTable).on("search.dt.DT", function (b, c) {
			if (a === c)
				try {
					n[0] !== H.activeElement && n.val(e.sSearch);
				} catch (d) {}
		});
		return b[0];
	}
	function ha(a, b, c) {
		var d = a.oPreviousSearch,
			e = a.aoPreSearchCols,
			f = function (a) {
				d.sSearch = a.sSearch;
				d.bRegex = a.bRegex;
				d.bSmart = a.bSmart;
				d.bCaseInsensitive = a.bCaseInsensitive;
			};
		Ia(a);
		if ("ssp" != y(a)) {
			yb(
				a,
				b.sSearch,
				c,
				b.bEscapeRegex !== k ? !b.bEscapeRegex : b.bRegex,
				b.bSmart,
				b.bCaseInsensitive
			);
			f(b);
			for (b = 0; b < e.length; b++)
				zb(
					a,
					e[b].sSearch,
					b,
					e[b].bEscapeRegex !== k ? !e[b].bEscapeRegex : e[b].bRegex,
					e[b].bSmart,
					e[b].bCaseInsensitive
				);
			Ab(a);
		} else f(b);
		a.bFiltered = !0;
		t(a, null, "بحث", [a]);
	}
	function Ab(a) {
		for (
			var b = l.ext.search, c = a.aiDisplay, d, e, f = 0, g = b.length;
			f < g;
			f++
		) {
			for (var j = [], i = 0, n = c.length; i < n; i++)
				(e = c[i]),
					(d = a.aoData[e]),
					b[f](a, d._aFilterData, e, d._aData, i) && j.push(e);
			c.length = 0;
			h.merge(c, j);
		}
	}
	function zb(a, b, c, d, e, f) {
		if ("" !== b) {
			for (
				var g = [], j = a.aiDisplay, d = Ra(b, d, e, f), e = 0;
				e < j.length;
				e++
			)
				(b = a.aoData[j[e]]._aFilterData[c]), d.test(b) && g.push(j[e]);
			a.aiDisplay = g;
		}
	}
	function yb(a, b, c, d, e, f) {
		var e = Ra(b, d, e, f),
			g = a.oPreviousSearch.sSearch,
			j = a.aiDisplayMaster,
			i,
			f = [];
		0 !== l.ext.search.length && (c = !0);
		i = Bb(a);
		if (0 >= b.length) a.aiDisplay = j.slice();
		else {
			if (i || c || d || g.length > b.length || 0 !== b.indexOf(g) || a.bSorted)
				a.aiDisplay = j.slice();
			b = a.aiDisplay;
			for (c = 0; c < b.length; c++)
				e.test(a.aoData[b[c]]._sFilterRow) && f.push(b[c]);
			a.aiDisplay = f;
		}
	}
	function Ra(a, b, c, d) {
		a = b ? a : Sa(a);
		c &&
			(a =
				"^(?=.*?" +
				h
					.map(a.match(/"[^"]+"|[^ ]+/g) || [""], function (a) {
						if ('"' === a.charAt(0))
							var b = a.match(/^"(.*)"$/),
								a = b ? b[1] : a;
						return a.replace('"', "");
					})
					.join(")(?=.*?") +
				").*$");
		return RegExp(a, d ? "i" : "");
	}
	function Bb(a) {
		var b = a.aoColumns,
			c,
			d,
			e,
			f,
			g,
			j,
			i,
			h,
			m = l.ext.type.search;
		c = !1;
		d = 0;
		for (f = a.aoData.length; d < f; d++)
			if (((h = a.aoData[d]), !h._aFilterData)) {
				j = [];
				e = 0;
				for (g = b.length; e < g; e++)
					(c = b[e]),
						c.bSearchable
							? ((i = B(a, d, e, "filter")),
							  m[c.sType] && (i = m[c.sType](i)),
							  null === i && (i = ""),
							  "string" !== typeof i && i.toString && (i = i.toString()))
							: (i = ""),
						i.indexOf &&
							-1 !== i.indexOf("&") &&
							((wa.innerHTML = i), (i = Zb ? wa.textContent : wa.innerText)),
						i.replace && (i = i.replace(/[\r\n\u2028]/g, "")),
						j.push(i);
				h._aFilterData = j;
				h._sFilterRow = j.join("  ");
				c = !0;
			}
		return c;
	}
	function Cb(a) {
		return {
			search: a.sSearch,
			smart: a.bSmart,
			regex: a.bRegex,
			caseInsensitive: a.bCaseInsensitive,
		};
	}
	function Db(a) {
		return {
			sSearch: a.search,
			bSmart: a.smart,
			bRegex: a.regex,
			bCaseInsensitive: a.caseInsensitive,
		};
	}
	function ub(a) {
		var b = a.sTableId,
			c = a.aanFeatures.i,
			d = h("<div/>", { class: a.oClasses.sInfo, id: !c ? b + "_info" : null });
		c ||
			(a.aoDrawCallback.push({ fn: Eb, sName: "information" }),
			d.attr("role", "status").attr("aria-live", "polite"),
			h(a.nTable).attr("aria-describedby", b + "_info"));
		return d[0];
	}
	function Eb(a) {
		var b = a.aanFeatures.i;
		if (0 !== b.length) {
			var c = a.oLanguage,
				d = a._iDisplayStart + 1,
				e = a.fnDisplayEnd(),
				f = a.fnRecordsTotal(),
				g = a.fnRecordsDisplay(),
				j = g ? c.sInfo : c.sInfoEmpty;
			g !== f && (j += " " + c.sInfoFiltered);
			j += c.sInfoPostFix;
			j = Fb(a, j);
			c = c.fnInfoCallback;
			null !== c && (j = c.call(a.oInstance, a, d, e, f, g, j));
			h(b).html(j);
		}
	}
	function Fb(a, b) {
		var c = a.fnFormatNumber,
			d = a._iDisplayStart + 1,
			e = a._iDisplayLength,
			f = a.fnRecordsDisplay(),
			g = -1 === e;
		return b
			.replace(/_START_/g, c.call(a, d))
			.replace(/_END_/g, c.call(a, a.fnDisplayEnd()))
			.replace(/_MAX_/g, c.call(a, a.fnRecordsTotal()))
			.replace(/_TOTAL_/g, c.call(a, f))
			.replace(/_PAGE_/g, c.call(a, g ? 1 : Math.ceil(d / e)))
			.replace(/_PAGES_/g, c.call(a, g ? 1 : Math.ceil(f / e)));
	}
	function ia(a) {
		var b,
			c,
			d = a.iInitDisplayStart,
			e = a.aoColumns,
			f;
		c = a.oFeatures;
		var g = a.bDeferLoading;
		if (a.bInitialised) {
			pb(a);
			mb(a);
			ga(a, a.aoHeader);
			ga(a, a.aoFooter);
			D(a, !0);
			c.bAutoWidth && Ha(a);
			b = 0;
			for (c = e.length; b < c; b++)
				(f = e[b]), f.sWidth && (f.nTh.style.width = w(f.sWidth));
			t(a, null, "preInit", [a]);
			T(a);
			e = y(a);
			if ("ssp" != e || g)
				"ajax" == e
					? ta(
							a,
							[],
							function (c) {
								var f = ua(a, c);
								for (b = 0; b < f.length; b++) O(a, f[b]);
								a.iInitDisplayStart = d;
								T(a);
								D(a, !1);
								va(a, c);
							},
							a
					  )
					: (D(a, !1), va(a));
		} else
			setTimeout(function () {
				ia(a);
			}, 200);
	}
	function va(a, b) {
		a._bInitComplete = !0;
		(b || a.oInit.aaData) && aa(a);
		t(a, null, "plugin-init", [a, b]);
		t(a, "aoInitComplete", "init", [a, b]);
	}
	function Ta(a, b) {
		var c = parseInt(b, 10);
		a._iDisplayLength = c;
		Ua(a);
		t(a, null, "length", [a, c]);
	}
	function qb(a) {
		for (
			var b = a.oClasses,
				c = a.sTableId,
				d = a.aLengthMenu,
				e = Array.isArray(d[0]),
				f = e ? d[0] : d,
				d = e ? d[1] : d,
				e = h("<select/>", {
					name: c + "_length",
					"aria-controls": c,
					class: b.sLengthSelect,
				}),
				g = 0,
				j = f.length;
			g < j;
			g++
		)
			e[0][g] = new Option(
				"number" === typeof d[g] ? a.fnFormatNumber(d[g]) : d[g],
				f[g]
			);
		var i = h("<div><label/></div>").addClass(b.sLength);
		a.aanFeatures.l || (i[0].id = c + "_length");
		i.children().append(
			a.oLanguage.sLengthMenu.replace("_MENU_", e[0].outerHTML)
		);
		h("select", i)
			.val(a._iDisplayLength)
			.on("change.DT", function () {
				Ta(a, h(this).val());
				P(a);
			});
		h(a.nTable).on("length.dt.DT", function (b, c, d) {
			a === c && h("select", i).val(d);
		});
		return i[0];
	}
	function vb(a) {
		var b = a.sPaginationType,
			c = l.ext.pager[b],
			d = "function" === typeof c,
			e = function (a) {
				P(a);
			},
			b = h("<div/>").addClass(a.oClasses.sPaging + b)[0],
			f = a.aanFeatures;
		d || c.fnInit(a, b, e);
		f.p ||
			((b.id = a.sTableId + "_paginate"),
			a.aoDrawCallback.push({
				fn: function (a) {
					if (d) {
						var b = a._iDisplayStart,
							i = a._iDisplayLength,
							h = a.fnRecordsDisplay(),
							m = -1 === i,
							b = m ? 0 : Math.ceil(b / i),
							i = m ? 1 : Math.ceil(h / i),
							h = c(b, i),
							k,
							m = 0;
						for (k = f.p.length; m < k; m++)
							Pa(a, "pageButton")(a, f.p[m], m, h, b, i);
					} else c.fnUpdate(a, e);
				},
				sName: "pagination",
			}));
		return b;
	}
	function Va(a, b, c) {
		var d = a._iDisplayStart,
			e = a._iDisplayLength,
			f = a.fnRecordsDisplay();
		0 === f || -1 === e
			? (d = 0)
			: "number" === typeof b
			? ((d = b * e), d > f && (d = 0))
			: "first" == b
			? (d = 0)
			: "previous" == b
			? ((d = 0 <= e ? d - e : 0), 0 > d && (d = 0))
			: "next" == b
			? d + e < f && (d += e)
			: "last" == b
			? (d = Math.floor((f - 1) / e) * e)
			: K(a, 0, "Unknown paging action: " + b, 5);
		b = a._iDisplayStart !== d;
		a._iDisplayStart = d;
		b && (t(a, null, "page", [a]), c && P(a));
		return b;
	}
	function sb(a) {
		return h("<div/>", {
			id: !a.aanFeatures.r ? a.sTableId + "_processing" : null,
			class: a.oClasses.sProcessing,
		})
			.html(a.oLanguage.sProcessing)
			.insertBefore(a.nTable)[0];
	}
	function D(a, b) {
		a.oFeatures.bProcessing &&
			h(a.aanFeatures.r).css("display", b ? "block" : "none");
		t(a, null, "processing", [a, b]);
	}
	function tb(a) {
		var b = h(a.nTable);
		b.attr("role", "grid");
		var c = a.oScroll;
		if ("" === c.sX && "" === c.sY) return a.nTable;
		var d = c.sX,
			e = c.sY,
			f = a.oClasses,
			g = b.children("caption"),
			j = g.length ? g[0]._captionSide : null,
			i = h(b[0].cloneNode(!1)),
			n = h(b[0].cloneNode(!1)),
			m = b.children("tfoot");
		m.length || (m = null);
		i = h("<div/>", { class: f.sScrollWrapper })
			.append(
				h("<div/>", { class: f.sScrollHead })
					.css({
						overflow: "hidden",
						position: "relative",
						border: 0,
						width: d ? (!d ? null : w(d)) : "100%",
					})
					.append(
						h("<div/>", { class: f.sScrollHeadInner })
							.css({ "box-sizing": "content-box", width: c.sXInner || "100%" })
							.append(
								i
									.removeAttr("id")
									.css("margin-left", 0)
									.append("top" === j ? g : null)
									.append(b.children("thead"))
							)
					)
			)
			.append(
				h("<div/>", { class: f.sScrollBody })
					.css({
						position: "relative",
						overflow: "auto",
						width: !d ? null : w(d),
					})
					.append(b)
			);
		m &&
			i.append(
				h("<div/>", { class: f.sScrollFoot })
					.css({
						overflow: "hidden",
						border: 0,
						width: d ? (!d ? null : w(d)) : "100%",
					})
					.append(
						h("<div/>", { class: f.sScrollFootInner }).append(
							n
								.removeAttr("id")
								.css("margin-left", 0)
								.append("bottom" === j ? g : null)
								.append(b.children("tfoot"))
						)
					)
			);
		var b = i.children(),
			k = b[0],
			f = b[1],
			s = m ? b[2] : null;
		if (d)
			h(f).on("scroll.DT", function () {
				var a = this.scrollLeft;
				k.scrollLeft = a;
				m && (s.scrollLeft = a);
			});
		h(f).css("max-height", e);
		c.bCollapse || h(f).css("height", e);
		a.nScrollHead = k;
		a.nScrollBody = f;
		a.nScrollFoot = s;
		a.aoDrawCallback.push({ fn: ma, sName: "scrolling" });
		return i[0];
	}
	function ma(a) {
		var b = a.oScroll,
			c = b.sX,
			d = b.sXInner,
			e = b.sY,
			b = b.iBarWidth,
			f = h(a.nScrollHead),
			g = f[0].style,
			j = f.children("div"),
			i = j[0].style,
			n = j.children("table"),
			j = a.nScrollBody,
			m = h(j),
			q = j.style,
			s = h(a.nScrollFoot).children("div"),
			l = s.children("table"),
			o = h(a.nTHead),
			p = h(a.nTable),
			r = p[0],
			t = r.style,
			u = a.nTFoot ? h(a.nTFoot) : null,
			U = a.oBrowser,
			V = U.bScrollOversize,
			$b = C(a.aoColumns, "nTh"),
			Q,
			L,
			R,
			xa,
			v = [],
			x = [],
			y = [],
			z = [],
			A,
			B = function (a) {
				a = a.style;
				a.paddingTop = "0";
				a.paddingBottom = "0";
				a.borderTopWidth = "0";
				a.borderBottomWidth = "0";
				a.height = 0;
			};
		L = j.scrollHeight > j.clientHeight;
		if (a.scrollBarVis !== L && a.scrollBarVis !== k)
			(a.scrollBarVis = L), aa(a);
		else {
			a.scrollBarVis = L;
			p.children("thead, tfoot").remove();
			u &&
				((R = u.clone().prependTo(p)), (Q = u.find("tr")), (R = R.find("tr")));
			xa = o.clone().prependTo(p);
			o = o.find("tr");
			L = xa.find("tr");
			xa.find("th, td").removeAttr("tabindex");
			c || ((q.width = "100%"), (f[0].style.width = "100%"));
			h.each(sa(a, xa), function (b, c) {
				A = ba(a, b);
				c.style.width = a.aoColumns[A].sWidth;
			});
			u &&
				I(function (a) {
					a.style.width = "";
				}, R);
			f = p.outerWidth();
			if ("" === c) {
				t.width = "100%";
				if (
					V &&
					(p.find("tbody").height() > j.offsetHeight ||
						"scroll" == m.css("overflow-y"))
				)
					t.width = w(p.outerWidth() - b);
				f = p.outerWidth();
			} else "" !== d && ((t.width = w(d)), (f = p.outerWidth()));
			I(B, L);
			I(function (a) {
				y.push(a.innerHTML);
				v.push(w(h(a).css("width")));
			}, L);
			I(function (a, b) {
				if (h.inArray(a, $b) !== -1) a.style.width = v[b];
			}, o);
			h(L).height(0);
			u &&
				(I(B, R),
				I(function (a) {
					z.push(a.innerHTML);
					x.push(w(h(a).css("width")));
				}, R),
				I(function (a, b) {
					a.style.width = x[b];
				}, Q),
				h(R).height(0));
			I(function (a, b) {
				a.innerHTML = '<div class="dataTables_sizing">' + y[b] + "</div>";
				a.childNodes[0].style.height = "0";
				a.childNodes[0].style.overflow = "hidden";
				a.style.width = v[b];
			}, L);
			u &&
				I(function (a, b) {
					a.innerHTML = '<div class="dataTables_sizing">' + z[b] + "</div>";
					a.childNodes[0].style.height = "0";
					a.childNodes[0].style.overflow = "hidden";
					a.style.width = x[b];
				}, R);
			if (p.outerWidth() < f) {
				Q =
					j.scrollHeight > j.offsetHeight || "scroll" == m.css("overflow-y")
						? f + b
						: f;
				if (
					V &&
					(j.scrollHeight > j.offsetHeight || "scroll" == m.css("overflow-y"))
				)
					t.width = w(Q - b);
				("" === c || "" !== d) && K(a, 1, "Possible column misalignment", 6);
			} else Q = "100%";
			q.width = w(Q);
			g.width = w(Q);
			u && (a.nScrollFoot.style.width = w(Q));
			!e && V && (q.height = w(r.offsetHeight + b));
			c = p.outerWidth();
			n[0].style.width = w(c);
			i.width = w(c);
			d = p.height() > j.clientHeight || "scroll" == m.css("overflow-y");
			e = "padding" + (U.bScrollbarLeft ? "Left" : "Right");
			i[e] = d ? b + "px" : "0px";
			u &&
				((l[0].style.width = w(c)),
				(s[0].style.width = w(c)),
				(s[0].style[e] = d ? b + "px" : "0px"));
			p.children("colgroup").insertBefore(p.children("thead"));
			m.trigger("scroll");
			if ((a.bSorted || a.bFiltered) && !a._drawHold) j.scrollTop = 0;
		}
	}
	function I(a, b, c) {
		for (var d = 0, e = 0, f = b.length, g, j; e < f; ) {
			g = b[e].firstChild;
			for (j = c ? c[e].firstChild : null; g; )
				1 === g.nodeType && (c ? a(g, j, d) : a(g, d), d++),
					(g = g.nextSibling),
					(j = c ? j.nextSibling : null);
			e++;
		}
	}
	function Ha(a) {
		var b = a.nTable,
			c = a.aoColumns,
			d = a.oScroll,
			e = d.sY,
			f = d.sX,
			g = d.sXInner,
			j = c.length,
			i = na(a, "bVisible"),
			n = h("th", a.nTHead),
			m = b.getAttribute("width"),
			k = b.parentNode,
			s = !1,
			l,
			o,
			p = a.oBrowser,
			d = p.bScrollOversize;
		(l = b.style.width) && -1 !== l.indexOf("%") && (m = l);
		for (l = 0; l < i.length; l++)
			(o = c[i[l]]),
				null !== o.sWidth && ((o.sWidth = Gb(o.sWidthOrig, k)), (s = !0));
		if (d || (!s && !f && !e && j == W(a) && j == n.length))
			for (l = 0; l < j; l++)
				(i = ba(a, l)), null !== i && (c[i].sWidth = w(n.eq(l).width()));
		else {
			j = h(b).clone().css("visibility", "hidden").removeAttr("id");
			j.find("tbody tr").remove();
			var r = h("<tr/>").appendTo(j.find("tbody"));
			j.find("thead, tfoot").remove();
			j.append(h(a.nTHead).clone()).append(h(a.nTFoot).clone());
			j.find("tfoot th, tfoot td").css("width", "");
			n = sa(a, j.find("thead")[0]);
			for (l = 0; l < i.length; l++)
				(o = c[i[l]]),
					(n[l].style.width =
						null !== o.sWidthOrig && "" !== o.sWidthOrig
							? w(o.sWidthOrig)
							: ""),
					o.sWidthOrig &&
						f &&
						h(n[l]).append(
							h("<div/>").css({
								width: o.sWidthOrig,
								margin: 0,
								padding: 0,
								border: 0,
								height: 1,
							})
						);
			if (a.aoData.length)
				for (l = 0; l < i.length; l++)
					(s = i[l]),
						(o = c[s]),
						h(Hb(a, s)).clone(!1).append(o.sContentPadding).appendTo(r);
			h("[name]", j).removeAttr("name");
			o = h("<div/>")
				.css(
					f || e
						? {
								position: "absolute",
								top: 0,
								left: 0,
								height: 1,
								right: 0,
								overflow: "hidden",
						  }
						: {}
				)
				.append(j)
				.appendTo(k);
			f && g
				? j.width(g)
				: f
				? (j.css("width", "auto"),
				  j.removeAttr("width"),
				  j.width() < k.clientWidth && m && j.width(k.clientWidth))
				: e
				? j.width(k.clientWidth)
				: m && j.width(m);
			for (l = e = 0; l < i.length; l++)
				(k = h(n[l])),
					(g = k.outerWidth() - k.width()),
					(k = p.bBounding
						? Math.ceil(n[l].getBoundingClientRect().width)
						: k.outerWidth()),
					(e += k),
					(c[i[l]].sWidth = w(k - g));
			b.style.width = w(e);
			o.remove();
		}
		m && (b.style.width = w(m));
		if ((m || f) && !a._reszEvt)
			(b = function () {
				h(E).on(
					"resize.DT-" + a.sInstance,
					Qa(function () {
						aa(a);
					})
				);
			}),
				d ? setTimeout(b, 1e3) : b(),
				(a._reszEvt = !0);
	}
	function Gb(a, b) {
		if (!a) return 0;
		var c = h("<div/>")
				.css("width", w(a))
				.appendTo(b || H.body),
			d = c[0].offsetWidth;
		c.remove();
		return d;
	}
	function Hb(a, b) {
		var c = Ib(a, b);
		if (0 > c) return null;
		var d = a.aoData[c];
		return !d.nTr ? h("<td/>").html(B(a, c, b, "display"))[0] : d.anCells[b];
	}
	function Ib(a, b) {
		for (var c, d = -1, e = -1, f = 0, g = a.aoData.length; f < g; f++)
			(c = B(a, f, b, "display") + ""),
				(c = c.replace(ac, "")),
				(c = c.replace(/&nbsp;/g, " ")),
				c.length > d && ((d = c.length), (e = f));
		return e;
	}
	function w(a) {
		return null === a
			? "0px"
			: "number" == typeof a
			? 0 > a
				? "0px"
				: a + "px"
			: a.match(/\d$/)
			? a + "px"
			: a;
	}
	function Y(a) {
		var b,
			c,
			d = [],
			e = a.aoColumns,
			f,
			g,
			j,
			i;
		b = a.aaSortingFixed;
		c = h.isPlainObject(b);
		var n = [];
		f = function (a) {
			a.length && !Array.isArray(a[0]) ? n.push(a) : h.merge(n, a);
		};
		Array.isArray(b) && f(b);
		c && b.pre && f(b.pre);
		f(a.aaSorting);
		c && b.post && f(b.post);
		for (a = 0; a < n.length; a++) {
			i = n[a][0];
			f = e[i].aDataSort;
			b = 0;
			for (c = f.length; b < c; b++)
				(g = f[b]),
					(j = e[g].sType || "string"),
					n[a]._idx === k && (n[a]._idx = h.inArray(n[a][1], e[g].asSorting)),
					d.push({
						src: i,
						col: g,
						dir: n[a][1],
						index: n[a]._idx,
						type: j,
						formatter: l.ext.type.order[j + "-pre"],
					});
		}
		return d;
	}
	function ob(a) {
		var b,
			c,
			d = [],
			e = l.ext.type.order,
			f = a.aoData,
			g = 0,
			j,
			i = a.aiDisplayMaster,
			h;
		Ia(a);
		h = Y(a);
		b = 0;
		for (c = h.length; b < c; b++) (j = h[b]), j.formatter && g++, Jb(a, j.col);
		if ("ssp" != y(a) && 0 !== h.length) {
			b = 0;
			for (c = i.length; b < c; b++) d[i[b]] = b;
			g === h.length
				? i.sort(function (a, b) {
						var c,
							e,
							g,
							j,
							i = h.length,
							k = f[a]._aSortData,
							l = f[b]._aSortData;
						for (g = 0; g < i; g++)
							if (
								((j = h[g]),
								(c = k[j.col]),
								(e = l[j.col]),
								(c = c < e ? -1 : c > e ? 1 : 0),
								0 !== c)
							)
								return "asc" === j.dir ? c : -c;
						c = d[a];
						e = d[b];
						return c < e ? -1 : c > e ? 1 : 0;
				  })
				: i.sort(function (a, b) {
						var c,
							g,
							j,
							i,
							k = h.length,
							l = f[a]._aSortData,
							o = f[b]._aSortData;
						for (j = 0; j < k; j++)
							if (
								((i = h[j]),
								(c = l[i.col]),
								(g = o[i.col]),
								(i = e[i.type + "-" + i.dir] || e["string-" + i.dir]),
								(c = i(c, g)),
								0 !== c)
							)
								return c;
						c = d[a];
						g = d[b];
						return c < g ? -1 : c > g ? 1 : 0;
				  });
		}
		a.bSorted = !0;
	}
	function Kb(a) {
		for (
			var b,
				c,
				d = a.aoColumns,
				e = Y(a),
				a = a.oLanguage.oAria,
				f = 0,
				g = d.length;
			f < g;
			f++
		) {
			c = d[f];
			var j = c.asSorting;
			b = c.sTitle.replace(/<.*?>/g, "");
			var i = c.nTh;
			i.removeAttribute("aria-sort");
			c.bSortable &&
				(0 < e.length && e[0].col == f
					? (i.setAttribute(
							"aria-sort",
							"asc" == e[0].dir ? "ascending" : "descending"
					  ),
					  (c = j[e[0].index + 1] || j[0]))
					: (c = j[0]),
				(b += "asc" === c ? a.sSortAscending : a.sSortDescending));
			i.setAttribute("aria-label", b);
		}
	}
	function Wa(a, b, c, d) {
		var e = a.aaSorting,
			f = a.aoColumns[b].asSorting,
			g = function (a, b) {
				var c = a._idx;
				c === k && (c = h.inArray(a[1], f));
				return c + 1 < f.length ? c + 1 : b ? null : 0;
			};
		"number" === typeof e[0] && (e = a.aaSorting = [e]);
		c && a.oFeatures.bSortMulti
			? ((c = h.inArray(b, C(e, "0"))),
			  -1 !== c
					? ((b = g(e[c], !0)),
					  null === b && 1 === e.length && (b = 0),
					  null === b ? e.splice(c, 1) : ((e[c][1] = f[b]), (e[c]._idx = b)))
					: (e.push([b, f[0], 0]), (e[e.length - 1]._idx = 0)))
			: e.length && e[0][0] == b
			? ((b = g(e[0])), (e.length = 1), (e[0][1] = f[b]), (e[0]._idx = b))
			: ((e.length = 0), e.push([b, f[0]]), (e[0]._idx = 0));
		T(a);
		"function" == typeof d && d(a);
	}
	function Oa(a, b, c, d) {
		var e = a.aoColumns[c];
		Xa(b, {}, function (b) {
			!1 !== e.bSortable &&
				(a.oFeatures.bProcessing
					? (D(a, !0),
					  setTimeout(function () {
							Wa(a, c, b.shiftKey, d);
							"ssp" !== y(a) && D(a, !1);
					  }, 0))
					: Wa(a, c, b.shiftKey, d));
		});
	}
	function ya(a) {
		var b = a.aLastSort,
			c = a.oClasses.sSortColumn,
			d = Y(a),
			e = a.oFeatures,
			f,
			g;
		if (e.bSort && e.bSortClasses) {
			e = 0;
			for (f = b.length; e < f; e++)
				(g = b[e].src),
					h(C(a.aoData, "anCells", g)).removeClass(c + (2 > e ? e + 1 : 3));
			e = 0;
			for (f = d.length; e < f; e++)
				(g = d[e].src),
					h(C(a.aoData, "anCells", g)).addClass(c + (2 > e ? e + 1 : 3));
		}
		a.aLastSort = d;
	}
	function Jb(a, b) {
		var c = a.aoColumns[b],
			d = l.ext.order[c.sSortDataType],
			e;
		d && (e = d.call(a.oInstance, a, b, ca(a, b)));
		for (
			var f, g = l.ext.type.order[c.sType + "-pre"], j = 0, i = a.aoData.length;
			j < i;
			j++
		)
			if (
				((c = a.aoData[j]),
				c._aSortData || (c._aSortData = []),
				!c._aSortData[b] || d)
			)
				(f = d ? e[j] : B(a, j, b, "sort")), (c._aSortData[b] = g ? g(f) : f);
	}
	function za(a) {
		if (a.oFeatures.bStateSave && !a.bDestroying) {
			var b = {
				time: +new Date(),
				start: a._iDisplayStart,
				length: a._iDisplayLength,
				order: h.extend(!0, [], a.aaSorting),
				search: Cb(a.oPreviousSearch),
				columns: h.map(a.aoColumns, function (b, d) {
					return { visible: b.bVisible, search: Cb(a.aoPreSearchCols[d]) };
				}),
			};
			t(a, "aoStateSaveParams", "stateSaveParams", [a, b]);
			a.oSavedState = b;
			a.fnStateSaveCallback.call(a.oInstance, a, b);
		}
	}
	function Lb(a, b, c) {
		var d,
			e,
			f = a.aoColumns,
			b = function (b) {
				if (b && b.time) {
					var g = t(a, "aoStateLoadParams", "stateLoadParams", [a, b]);
					if (
						-1 === h.inArray(!1, g) &&
						((g = a.iStateDuration),
						!(0 < g && b.time < +new Date() - 1e3 * g) &&
							!(b.columns && f.length !== b.columns.length))
					) {
						a.oLoadedState = h.extend(!0, {}, b);
						b.start !== k &&
							((a._iDisplayStart = b.start), (a.iInitDisplayStart = b.start));
						b.length !== k && (a._iDisplayLength = b.length);
						b.order !== k &&
							((a.aaSorting = []),
							h.each(b.order, function (b, c) {
								a.aaSorting.push(c[0] >= f.length ? [0, c[1]] : c);
							}));
						b.search !== k && h.extend(a.oPreviousSearch, Db(b.search));
						if (b.columns) {
							d = 0;
							for (e = b.columns.length; d < e; d++)
								(g = b.columns[d]),
									g.visible !== k && (f[d].bVisible = g.visible),
									g.search !== k &&
										h.extend(a.aoPreSearchCols[d], Db(g.search));
						}
						t(a, "aoStateLoaded", "stateLoaded", [a, b]);
					}
				}
				c();
			};
		if (a.oFeatures.bStateSave) {
			var g = a.fnStateLoadCallback.call(a.oInstance, a, b);
			g !== k && b(g);
		} else c();
	}
	function Aa(a) {
		var b = l.settings,
			a = h.inArray(a, C(b, "nTable"));
		return -1 !== a ? b[a] : null;
	}
	function K(a, b, c, d) {
		c =
			"DataTables warning: " + (a ? "table id=" + a.sTableId + " - " : "") + c;
		d &&
			(c +=
				". For more information about this error, please see http://datatables.net/tn/" +
				d);
		if (b) E.console && console.log && console.log(c);
		else if (
			((b = l.ext),
			(b = b.sErrMode || b.errMode),
			a && t(a, null, "error", [a, d, c]),
			"alert" == b)
		)
			alert(c);
		else {
			if ("throw" == b) throw Error(c);
			"function" == typeof b && b(a, d, c);
		}
	}
	function F(a, b, c, d) {
		Array.isArray(c)
			? h.each(c, function (c, d) {
					Array.isArray(d) ? F(a, b, d[0], d[1]) : F(a, b, d);
			  })
			: (d === k && (d = c), b[c] !== k && (a[d] = b[c]));
	}
	function Ya(a, b, c) {
		var d, e;
		for (e in b)
			b.hasOwnProperty(e) &&
				((d = b[e]),
				h.isPlainObject(d)
					? (h.isPlainObject(a[e]) || (a[e] = {}), h.extend(!0, a[e], d))
					: (a[e] =
							c && "data" !== e && "aaData" !== e && Array.isArray(d)
								? d.slice()
								: d));
		return a;
	}
	function Xa(a, b, c) {
		h(a)
			.on("click.DT", b, function (b) {
				h(a).trigger("blur");
				c(b);
			})
			.on("keypress.DT", b, function (a) {
				13 === a.which && (a.preventDefault(), c(a));
			})
			.on("selectstart.DT", function () {
				return !1;
			});
	}
	function z(a, b, c, d) {
		c && a[b].push({ fn: c, sName: d });
	}
	function t(a, b, c, d) {
		var e = [];
		b &&
			(e = h.map(a[b].slice().reverse(), function (b) {
				return b.fn.apply(a.oInstance, d);
			}));
		null !== c &&
			((b = h.Event(c + ".dt")), h(a.nTable).trigger(b, d), e.push(b.result));
		return e;
	}
	function Ua(a) {
		var b = a._iDisplayStart,
			c = a.fnDisplayEnd(),
			d = a._iDisplayLength;
		b >= c && (b = c - d);
		b -= b % d;
		if (-1 === d || 0 > b) b = 0;
		a._iDisplayStart = b;
	}
	function Pa(a, b) {
		var c = a.renderer,
			d = l.ext.renderer[b];
		return h.isPlainObject(c) && c[b]
			? d[c[b]] || d._
			: "string" === typeof c
			? d[c] || d._
			: d._;
	}
	function y(a) {
		return a.oFeatures.bServerSide
			? "ssp"
			: a.ajax || a.sAjaxSource
			? "ajax"
			: "dom";
	}
	function ja(a, b) {
		var c = [],
			c = Mb.numbers_length,
			d = Math.floor(c / 2);
		b <= c
			? (c = Z(0, b))
			: a <= d
			? ((c = Z(0, c - 2)), c.push("ellipsis"), c.push(b - 1))
			: (a >= b - 1 - d
					? (c = Z(b - (c - 2), b))
					: ((c = Z(a - d + 2, a + d - 1)), c.push("ellipsis"), c.push(b - 1)),
			  c.splice(0, 0, "ellipsis"),
			  c.splice(0, 0, 0));
		c.DT_el = "span";
		return c;
	}
	function Fa(a) {
		h.each(
			{
				num: function (b) {
					return Ba(b, a);
				},
				"num-fmt": function (b) {
					return Ba(b, a, Za);
				},
				"html-num": function (b) {
					return Ba(b, a, Ca);
				},
				"html-num-fmt": function (b) {
					return Ba(b, a, Ca, Za);
				},
			},
			function (b, c) {
				v.type.order[b + a + "-pre"] = c;
				b.match(/^html\-/) && (v.type.search[b + a] = v.type.search.html);
			}
		);
	}
	function Nb(a) {
		return function () {
			var b = [Aa(this[l.ext.iApiIndex])].concat(
				Array.prototype.slice.call(arguments)
			);
			return l.ext.internal[a].apply(this, b);
		};
	}
	var l = function (a) {
			this.$ = function (a, b) {
				return this.api(!0).$(a, b);
			};
			this._ = function (a, b) {
				return this.api(!0).rows(a, b).data();
			};
			this.api = function (a) {
				return a ? new r(Aa(this[v.iApiIndex])) : new r(this);
			};
			this.fnAddData = function (a, b) {
				var c = this.api(!0),
					d =
						Array.isArray(a) && (Array.isArray(a[0]) || h.isPlainObject(a[0]))
							? c.rows.add(a)
							: c.row.add(a);
				(b === k || b) && c.draw();
				return d.flatten().toArray();
			};
			this.fnAdjustColumnSizing = function (a) {
				var b = this.api(!0).columns.adjust(),
					c = b.settings()[0],
					d = c.oScroll;
				a === k || a ? b.draw(!1) : ("" !== d.sX || "" !== d.sY) && ma(c);
			};
			this.fnClearTable = function (a) {
				var b = this.api(!0).clear();
				(a === k || a) && b.draw();
			};
			this.fnClose = function (a) {
				this.api(!0).row(a).child.hide();
			};
			this.fnDeleteRow = function (a, b, c) {
				var d = this.api(!0),
					a = d.rows(a),
					e = a.settings()[0],
					h = e.aoData[a[0][0]];
				a.remove();
				b && b.call(this, e, h);
				(c === k || c) && d.draw();
				return h;
			};
			this.fnDestroy = function (a) {
				this.api(!0).destroy(a);
			};
			this.fnDraw = function (a) {
				this.api(!0).draw(a);
			};
			this.fnFilter = function (a, b, c, d, e, h) {
				e = this.api(!0);
				null === b || b === k
					? e.search(a, c, d, h)
					: e.column(b).search(a, c, d, h);
				e.draw();
			};
			this.fnGetData = function (a, b) {
				var c = this.api(!0);
				if (a !== k) {
					var d = a.nodeName ? a.nodeName.toLowerCase() : "";
					return b !== k || "td" == d || "th" == d
						? c.cell(a, b).data()
						: c.row(a).data() || null;
				}
				return c.data().toArray();
			};
			this.fnGetNodes = function (a) {
				var b = this.api(!0);
				return a !== k ? b.row(a).node() : b.rows().nodes().flatten().toArray();
			};
			this.fnGetPosition = function (a) {
				var b = this.api(!0),
					c = a.nodeName.toUpperCase();
				return "TR" == c
					? b.row(a).index()
					: "TD" == c || "TH" == c
					? ((a = b.cell(a).index()), [a.row, a.columnVisible, a.column])
					: null;
			};
			this.fnIsOpen = function (a) {
				return this.api(!0).row(a).child.isShown();
			};
			this.fnOpen = function (a, b, c) {
				return this.api(!0).row(a).child(b, c).show().child()[0];
			};
			this.fnPageChange = function (a, b) {
				var c = this.api(!0).page(a);
				(b === k || b) && c.draw(!1);
			};
			this.fnSetColumnVis = function (a, b, c) {
				a = this.api(!0).column(a).visible(b);
				(c === k || c) && a.columns.adjust().draw();
			};
			this.fnSettings = function () {
				return Aa(this[v.iApiIndex]);
			};
			this.fnSort = function (a) {
				this.api(!0).order(a).draw();
			};
			this.fnSortListener = function (a, b, c) {
				this.api(!0).order.listener(a, b, c);
			};
			this.fnUpdate = function (a, b, c, d, e) {
				var h = this.api(!0);
				c === k || null === c ? h.row(b).data(a) : h.cell(b, c).data(a);
				(e === k || e) && h.columns.adjust();
				(d === k || d) && h.draw();
				return 0;
			};
			this.fnVersionCheck = v.fnVersionCheck;
			var b = this,
				c = a === k,
				d = this.length;
			c && (a = {});
			this.oApi = this.internal = v.internal;
			for (var e in l.ext.internal) e && (this[e] = Nb(e));
			this.each(function () {
				var e = {},
					g = 1 < d ? Ya(e, a, !0) : a,
					j = 0,
					i,
					e = this.getAttribute("id"),
					n = !1,
					m = l.defaults,
					q = h(this);
				if ("table" != this.nodeName.toLowerCase())
					K(
						null,
						0,
						"Non-table node initialisation (" + this.nodeName + ")",
						2
					);
				else {
					gb(m);
					hb(m.column);
					J(m, m, !0);
					J(m.column, m.column, !0);
					J(m, h.extend(g, q.data()), !0);
					var s = l.settings,
						j = 0;
					for (i = s.length; j < i; j++) {
						var o = s[j];
						if (
							o.nTable == this ||
							(o.nTHead && o.nTHead.parentNode == this) ||
							(o.nTFoot && o.nTFoot.parentNode == this)
						) {
							var r = g.bRetrieve !== k ? g.bRetrieve : m.bRetrieve;
							if (c || r) return o.oInstance;
							if (g.bDestroy !== k ? g.bDestroy : m.bDestroy) {
								o.oInstance.fnDestroy();
								break;
							} else {
								K(o, 0, "Cannot reinitialise DataTable", 3);
								return;
							}
						}
						if (o.sTableId == this.id) {
							s.splice(j, 1);
							break;
						}
					}
					if (null === e || "" === e)
						this.id = e = "DataTables_Table_" + l.ext._unique++;
					var p = h.extend(!0, {}, l.models.oSettings, {
						sDestroyWidth: q[0].style.width,
						sInstance: e,
						sTableId: e,
					});
					p.nTable = this;
					p.oApi = b.internal;
					p.oInit = g;
					s.push(p);
					p.oInstance = 1 === b.length ? b : q.dataTable();
					gb(g);
					Ea(g.oLanguage);
					g.aLengthMenu &&
						!g.iDisplayLength &&
						(g.iDisplayLength = Array.isArray(g.aLengthMenu[0])
							? g.aLengthMenu[0][0]
							: g.aLengthMenu[0]);
					g = Ya(h.extend(!0, {}, m), g);
					F(
						p.oFeatures,
						g,
						"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(
							" "
						)
					);
					F(p, g, [
						"asStripeClasses",
						"ajax",
						"fnServerData",
						"fnFormatNumber",
						"sServerMethod",
						"aaSorting",
						"aaSortingFixed",
						"aLengthMenu",
						"sPaginationType",
						"sAjaxSource",
						"sAjaxDataProp",
						"iStateDuration",
						"sDom",
						"bSortCellsTop",
						"iTabIndex",
						"fnStateLoadCallback",
						"fnStateSaveCallback",
						"renderer",
						"searchDelay",
						"rowId",
						["iCookieDuration", "iStateDuration"],
						["oSearch", "oPreviousSearch"],
						["aoSearchCols", "aoPreSearchCols"],
						["iDisplayLength", "_iDisplayLength"],
					]);
					F(p.oScroll, g, [
						["sScrollX", "sX"],
						["sScrollXInner", "sXInner"],
						["sScrollY", "sY"],
						["bScrollCollapse", "bCollapse"],
					]);
					F(p.oLanguage, g, "fnInfoCallback");
					z(p, "aoDrawCallback", g.fnDrawCallback, "user");
					z(p, "aoServerParams", g.fnServerParams, "user");
					z(p, "aoStateSaveParams", g.fnStateSaveParams, "user");
					z(p, "aoStateLoadParams", g.fnStateLoadParams, "user");
					z(p, "aoStateLoaded", g.fnStateLoaded, "user");
					z(p, "aoRowCallback", g.fnRowCallback, "user");
					z(p, "aoRowCreatedCallback", g.fnCreatedRow, "user");
					z(p, "aoHeaderCallback", g.fnHeaderCallback, "user");
					z(p, "aoFooterCallback", g.fnFooterCallback, "user");
					z(p, "aoInitComplete", g.fnInitComplete, "user");
					z(p, "aoPreDrawCallback", g.fnPreDrawCallback, "user");
					p.rowIdFn = S(g.rowId);
					ib(p);
					var u = p.oClasses;
					h.extend(u, l.ext.classes, g.oClasses);
					q.addClass(u.sTable);
					p.iInitDisplayStart === k &&
						((p.iInitDisplayStart = g.iDisplayStart),
						(p._iDisplayStart = g.iDisplayStart));
					null !== g.iDeferLoading &&
						((p.bDeferLoading = !0),
						(e = Array.isArray(g.iDeferLoading)),
						(p._iRecordsDisplay = e ? g.iDeferLoading[0] : g.iDeferLoading),
						(p._iRecordsTotal = e ? g.iDeferLoading[1] : g.iDeferLoading));
					var w = p.oLanguage;
					h.extend(!0, w, g.oLanguage);
					w.sUrl
						? (h.ajax({
								dataType: "json",
								url: w.sUrl,
								success: function (a) {
									Ea(a);
									J(m.oLanguage, a);
									h.extend(true, w, a);
									t(p, null, "i18n", [p]);
									ia(p);
								},
								error: function () {
									ia(p);
								},
						  }),
						  (n = !0))
						: t(p, null, "i18n", [p]);
					null === g.asStripeClasses &&
						(p.asStripeClasses = [u.sStripeOdd, u.sStripeEven]);
					var e = p.asStripeClasses,
						v = q.children("tbody").find("tr").eq(0);
					-1 !==
						h.inArray(
							!0,
							h.map(e, function (a) {
								return v.hasClass(a);
							})
						) &&
						(h("tbody tr", this).removeClass(e.join(" ")),
						(p.asDestroyStripes = e.slice()));
					e = [];
					s = this.getElementsByTagName("thead");
					0 !== s.length && (fa(p.aoHeader, s[0]), (e = sa(p)));
					if (null === g.aoColumns) {
						s = [];
						j = 0;
						for (i = e.length; j < i; j++) s.push(null);
					} else s = g.aoColumns;
					j = 0;
					for (i = s.length; j < i; j++) Ga(p, e ? e[j] : null);
					kb(p, g.aoColumnDefs, s, function (a, b) {
						la(p, a, b);
					});
					if (v.length) {
						var U = function (a, b) {
							return a.getAttribute("data-" + b) !== null ? b : null;
						};
						h(v[0])
							.children("th, td")
							.each(function (a, b) {
								var c = p.aoColumns[a];
								if (c.mData === a) {
									var d = U(b, "sort") || U(b, "order"),
										e = U(b, "filter") || U(b, "search");
									if (d !== null || e !== null) {
										c.mData = {
											_: a + ".display",
											sort: d !== null ? a + ".@data-" + d : k,
											type: d !== null ? a + ".@data-" + d : k,
											filter: e !== null ? a + ".@data-" + e : k,
										};
										la(p, a);
									}
								}
							});
					}
					var V = p.oFeatures,
						e = function () {
							if (g.aaSorting === k) {
								var a = p.aaSorting;
								j = 0;
								for (i = a.length; j < i; j++)
									a[j][1] = p.aoColumns[j].asSorting[0];
							}
							ya(p);
							V.bSort &&
								z(p, "aoDrawCallback", function () {
									if (p.bSorted) {
										var a = Y(p),
											b = {};
										h.each(a, function (a, c) {
											b[c.src] = c.dir;
										});
										t(p, null, "order", [p, a, b]);
										Kb(p);
									}
								});
							z(
								p,
								"aoDrawCallback",
								function () {
									(p.bSorted || y(p) === "ssp" || V.bDeferRender) && ya(p);
								},
								"sc"
							);
							var a = q.children("caption").each(function () {
									this._captionSide = h(this).css("caption-side");
								}),
								b = q.children("thead");
							b.length === 0 && (b = h("<thead/>").appendTo(q));
							p.nTHead = b[0];
							b = q.children("tbody");
							b.length === 0 && (b = h("<tbody/>").appendTo(q));
							p.nTBody = b[0];
							b = q.children("tfoot");
							if (
								b.length === 0 &&
								a.length > 0 &&
								(p.oScroll.sX !== "" || p.oScroll.sY !== "")
							)
								b = h("<tfoot/>").appendTo(q);
							if (b.length === 0 || b.children().length === 0)
								q.addClass(u.sNoFooter);
							else if (b.length > 0) {
								p.nTFoot = b[0];
								fa(p.aoFooter, p.nTFoot);
							}
							if (g.aaData)
								for (j = 0; j < g.aaData.length; j++) O(p, g.aaData[j]);
							else
								(p.bDeferLoading || y(p) == "dom") &&
									oa(p, h(p.nTBody).children("tr"));
							p.aiDisplay = p.aiDisplayMaster.slice();
							p.bInitialised = true;
							n === false && ia(p);
						};
					g.bStateSave
						? ((V.bStateSave = !0),
						  z(p, "aoDrawCallback", za, "state_save"),
						  Lb(p, g, e))
						: e();
				}
			});
			b = null;
			return this;
		},
		v,
		r,
		o,
		u,
		$a = {},
		Ob = /[\r\n\u2028]/g,
		Ca = /<.*?>/g,
		bc =
			/^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/,
		cc = RegExp(
			"(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)",
			"g"
		),
		Za = /['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi,
		M = function (a) {
			return !a || !0 === a || "-" === a ? !0 : !1;
		},
		Pb = function (a) {
			var b = parseInt(a, 10);
			return !isNaN(b) && isFinite(a) ? b : null;
		},
		Qb = function (a, b) {
			$a[b] || ($a[b] = RegExp(Sa(b), "g"));
			return "string" === typeof a && "." !== b
				? a.replace(/\./g, "").replace($a[b], ".")
				: a;
		},
		ab = function (a, b, c) {
			var d = "string" === typeof a;
			if (M(a)) return !0;
			b && d && (a = Qb(a, b));
			c && d && (a = a.replace(Za, ""));
			return !isNaN(parseFloat(a)) && isFinite(a);
		},
		Rb = function (a, b, c) {
			return M(a)
				? !0
				: !(M(a) || "string" === typeof a)
				? null
				: ab(a.replace(Ca, ""), b, c)
				? !0
				: null;
		},
		C = function (a, b, c) {
			var d = [],
				e = 0,
				f = a.length;
			if (c !== k) for (; e < f; e++) a[e] && a[e][b] && d.push(a[e][b][c]);
			else for (; e < f; e++) a[e] && d.push(a[e][b]);
			return d;
		},
		ka = function (a, b, c, d) {
			var e = [],
				f = 0,
				g = b.length;
			if (d !== k) for (; f < g; f++) a[b[f]][c] && e.push(a[b[f]][c][d]);
			else for (; f < g; f++) e.push(a[b[f]][c]);
			return e;
		},
		Z = function (a, b) {
			var c = [],
				d;
			b === k ? ((b = 0), (d = a)) : ((d = b), (b = a));
			for (var e = b; e < d; e++) c.push(e);
			return c;
		},
		Sb = function (a) {
			for (var b = [], c = 0, d = a.length; c < d; c++) a[c] && b.push(a[c]);
			return b;
		},
		ra = function (a) {
			var b;
			a: {
				if (!(2 > a.length)) {
					b = a.slice().sort();
					for (var c = b[0], d = 1, e = b.length; d < e; d++) {
						if (b[d] === c) {
							b = !1;
							break a;
						}
						c = b[d];
					}
				}
				b = !0;
			}
			if (b) return a.slice();
			b = [];
			var e = a.length,
				f,
				g = 0,
				d = 0;
			a: for (; d < e; d++) {
				c = a[d];
				for (f = 0; f < g; f++) if (b[f] === c) continue a;
				b.push(c);
				g++;
			}
			return b;
		},
		Tb = function (a, b) {
			if (Array.isArray(b)) for (var c = 0; c < b.length; c++) Tb(a, b[c]);
			else a.push(b);
			return a;
		};
	Array.isArray ||
		(Array.isArray = function (a) {
			return "[object Array]" === Object.prototype.toString.call(a);
		});
	String.prototype.trim ||
		(String.prototype.trim = function () {
			return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
		});
	l.util = {
		throttle: function (a, b) {
			var c = b !== k ? b : 200,
				d,
				e;
			return function () {
				var b = this,
					g = +new Date(),
					j = arguments;
				if (d && g < d + c) {
					clearTimeout(e);
					e = setTimeout(function () {
						d = k;
						a.apply(b, j);
					}, c);
				} else {
					d = g;
					a.apply(b, j);
				}
			};
		},
		escapeRegex: function (a) {
			return a.replace(cc, "\\$1");
		},
	};
	var A = function (a, b, c) {
			a[b] !== k && (a[c] = a[b]);
		},
		da = /\[.*?\]$/,
		X = /\(\)$/,
		Sa = l.util.escapeRegex,
		wa = h("<div>")[0],
		Zb = wa.textContent !== k,
		ac = /<.*?>/g,
		Qa = l.util.throttle,
		Ub = [],
		x = Array.prototype,
		dc = function (a) {
			var b,
				c,
				d = l.settings,
				e = h.map(d, function (a) {
					return a.nTable;
				});
			if (a) {
				if (a.nTable && a.oApi) return [a];
				if (a.nodeName && a.nodeName.toLowerCase() === "table") {
					b = h.inArray(a, e);
					return b !== -1 ? [d[b]] : null;
				}
				if (a && typeof a.settings === "function")
					return a.settings().toArray();
				typeof a === "string" ? (c = h(a)) : a instanceof h && (c = a);
			} else return [];
			if (c)
				return c
					.map(function () {
						b = h.inArray(this, e);
						return b !== -1 ? d[b] : null;
					})
					.toArray();
		};
	r = function (a, b) {
		if (!(this instanceof r)) return new r(a, b);
		var c = [],
			d = function (a) {
				(a = dc(a)) && c.push.apply(c, a);
			};
		if (Array.isArray(a)) for (var e = 0, f = a.length; e < f; e++) d(a[e]);
		else d(a);
		this.context = ra(c);
		b && h.merge(this, b);
		this.selector = { rows: null, cols: null, opts: null };
		r.extend(this, this, Ub);
	};
	l.Api = r;
	h.extend(r.prototype, {
		any: function () {
			return this.count() !== 0;
		},
		concat: x.concat,
		context: [],
		count: function () {
			return this.flatten().length;
		},
		each: function (a) {
			for (var b = 0, c = this.length; b < c; b++)
				a.call(this, this[b], b, this);
			return this;
		},
		eq: function (a) {
			var b = this.context;
			return b.length > a ? new r(b[a], this[a]) : null;
		},
		filter: function (a) {
			var b = [];
			if (x.filter) b = x.filter.call(this, a, this);
			else
				for (var c = 0, d = this.length; c < d; c++)
					a.call(this, this[c], c, this) && b.push(this[c]);
			return new r(this.context, b);
		},
		flatten: function () {
			var a = [];
			return new r(this.context, a.concat.apply(a, this.toArray()));
		},
		join: x.join,
		indexOf:
			x.indexOf ||
			function (a, b) {
				for (var c = b || 0, d = this.length; c < d; c++)
					if (this[c] === a) return c;
				return -1;
			},
		iterator: function (a, b, c, d) {
			var e = [],
				f,
				g,
				j,
				i,
				h,
				m = this.context,
				l,
				o,
				u = this.selector;
			if (typeof a === "string") {
				d = c;
				c = b;
				b = a;
				a = false;
			}
			g = 0;
			for (j = m.length; g < j; g++) {
				var t = new r(m[g]);
				if (b === "table") {
					f = c.call(t, m[g], g);
					f !== k && e.push(f);
				} else if (b === "columns" || b === "rows") {
					f = c.call(t, m[g], this[g], g);
					f !== k && e.push(f);
				} else if (
					b === "column" ||
					b === "column-rows" ||
					b === "row" ||
					b === "cell"
				) {
					o = this[g];
					b === "column-rows" && (l = Da(m[g], u.opts));
					i = 0;
					for (h = o.length; i < h; i++) {
						f = o[i];
						f =
							b === "cell"
								? c.call(t, m[g], f.row, f.column, g, i)
								: c.call(t, m[g], f, g, i, l);
						f !== k && e.push(f);
					}
				}
			}
			if (e.length || d) {
				a = new r(m, a ? e.concat.apply([], e) : e);
				b = a.selector;
				b.rows = u.rows;
				b.cols = u.cols;
				b.opts = u.opts;
				return a;
			}
			return this;
		},
		lastIndexOf:
			x.lastIndexOf ||
			function (a, b) {
				return this.indexOf.apply(this.toArray.reverse(), arguments);
			},
		length: 0,
		map: function (a) {
			var b = [];
			if (x.map) b = x.map.call(this, a, this);
			else
				for (var c = 0, d = this.length; c < d; c++)
					b.push(a.call(this, this[c], c));
			return new r(this.context, b);
		},
		pluck: function (a) {
			return this.map(function (b) {
				return b[a];
			});
		},
		pop: x.pop,
		push: x.push,
		reduce:
			x.reduce ||
			function (a, b) {
				return jb(this, a, b, 0, this.length, 1);
			},
		reduceRight:
			x.reduceRight ||
			function (a, b) {
				return jb(this, a, b, this.length - 1, -1, -1);
			},
		reverse: x.reverse,
		selector: null,
		shift: x.shift,
		slice: function () {
			return new r(this.context, this);
		},
		sort: x.sort,
		splice: x.splice,
		toArray: function () {
			return x.slice.call(this);
		},
		to$: function () {
			return h(this);
		},
		toJQuery: function () {
			return h(this);
		},
		unique: function () {
			return new r(this.context, ra(this));
		},
		unshift: x.unshift,
	});
	r.extend = function (a, b, c) {
		if (c.length && b && (b instanceof r || b.__dt_wrapper)) {
			var d,
				e,
				f,
				g = function (a, b, c) {
					return function () {
						var d = b.apply(a, arguments);
						r.extend(d, d, c.methodExt);
						return d;
					};
				};
			d = 0;
			for (e = c.length; d < e; d++) {
				f = c[d];
				b[f.name] =
					f.type === "function"
						? g(a, f.val, f)
						: f.type === "object"
						? {}
						: f.val;
				b[f.name].__dt_wrapper = true;
				r.extend(a, b[f.name], f.propExt);
			}
		}
	};
	r.register = o = function (a, b) {
		if (Array.isArray(a))
			for (var c = 0, d = a.length; c < d; c++) r.register(a[c], b);
		else
			for (
				var e = a.split("."), f = Ub, g, j, c = 0, d = e.length;
				c < d;
				c++
			) {
				g = (j = e[c].indexOf("()") !== -1) ? e[c].replace("()", "") : e[c];
				var i;
				a: {
					i = 0;
					for (var k = f.length; i < k; i++)
						if (f[i].name === g) {
							i = f[i];
							break a;
						}
					i = null;
				}
				if (!i) {
					i = { name: g, val: {}, methodExt: [], propExt: [], type: "object" };
					f.push(i);
				}
				if (c === d - 1) {
					i.val = b;
					i.type =
						typeof b === "function"
							? "function"
							: h.isPlainObject(b)
							? "object"
							: "other";
				} else f = j ? i.methodExt : i.propExt;
			}
	};
	r.registerPlural = u = function (a, b, c) {
		r.register(a, c);
		r.register(b, function () {
			var a = c.apply(this, arguments);
			return a === this
				? this
				: a instanceof r
				? a.length
					? Array.isArray(a[0])
						? new r(a.context, a[0])
						: a[0]
					: k
				: a;
		});
	};
	var Vb = function (a, b) {
		if (Array.isArray(a))
			return h.map(a, function (a) {
				return Vb(a, b);
			});
		if (typeof a === "number") return [b[a]];
		var c = h.map(b, function (a) {
			return a.nTable;
		});
		return h(c)
			.filter(a)
			.map(function () {
				var a = h.inArray(this, c);
				return b[a];
			})
			.toArray();
	};
	o("tables()", function (a) {
		return a !== k && a !== null ? new r(Vb(a, this.context)) : this;
	});
	o("table()", function (a) {
		var a = this.tables(a),
			b = a.context;
		return b.length ? new r(b[0]) : a;
	});
	u("tables().nodes()", "table().node()", function () {
		return this.iterator(
			"table",
			function (a) {
				return a.nTable;
			},
			1
		);
	});
	u("tables().body()", "table().body()", function () {
		return this.iterator(
			"table",
			function (a) {
				return a.nTBody;
			},
			1
		);
	});
	u("tables().header()", "table().header()", function () {
		return this.iterator(
			"table",
			function (a) {
				return a.nTHead;
			},
			1
		);
	});
	u("tables().footer()", "table().footer()", function () {
		return this.iterator(
			"table",
			function (a) {
				return a.nTFoot;
			},
			1
		);
	});
	u("tables().containers()", "table().container()", function () {
		return this.iterator(
			"table",
			function (a) {
				return a.nTableWrapper;
			},
			1
		);
	});
	o("draw()", function (a) {
		return this.iterator("table", function (b) {
			if (a === "page") P(b);
			else {
				typeof a === "string" && (a = a === "full-hold" ? false : true);
				T(b, a === false);
			}
		});
	});
	o("page()", function (a) {
		return a === k
			? this.page.info().page
			: this.iterator("table", function (b) {
					Va(b, a);
			  });
	});
	o("page.info()", function () {
		if (this.context.length === 0) return k;
		var a = this.context[0],
			b = a._iDisplayStart,
			c = a.oFeatures.bPaginate ? a._iDisplayLength : -1,
			d = a.fnRecordsDisplay(),
			e = c === -1;
		return {
			page: e ? 0 : Math.floor(b / c),
			pages: e ? 1 : Math.ceil(d / c),
			start: b,
			end: a.fnDisplayEnd(),
			length: c,
			recordsTotal: a.fnRecordsTotal(),
			recordsDisplay: d,
			serverSide: y(a) === "ssp",
		};
	});
	o("page.len()", function (a) {
		return a === k
			? this.context.length !== 0
				? this.context[0]._iDisplayLength
				: k
			: this.iterator("table", function (b) {
					Ta(b, a);
			  });
	});
	var Wb = function (a, b, c) {
		if (c) {
			var d = new r(a);
			d.one("draw", function () {
				c(d.ajax.json());
			});
		}
		if (y(a) == "ssp") T(a, b);
		else {
			D(a, true);
			var e = a.jqXHR;
			e && e.readyState !== 4 && e.abort();
			ta(a, [], function (c) {
				pa(a);
				for (var c = ua(a, c), d = 0, e = c.length; d < e; d++) O(a, c[d]);
				T(a, b);
				D(a, false);
			});
		}
	};
	o("ajax.json()", function () {
		var a = this.context;
		if (a.length > 0) return a[0].json;
	});
	o("ajax.params()", function () {
		var a = this.context;
		if (a.length > 0) return a[0].oAjaxData;
	});
	o("ajax.reload()", function (a, b) {
		return this.iterator("table", function (c) {
			Wb(c, b === false, a);
		});
	});
	o("ajax.url()", function (a) {
		var b = this.context;
		if (a === k) {
			if (b.length === 0) return k;
			b = b[0];
			return b.ajax
				? h.isPlainObject(b.ajax)
					? b.ajax.url
					: b.ajax
				: b.sAjaxSource;
		}
		return this.iterator("table", function (b) {
			h.isPlainObject(b.ajax) ? (b.ajax.url = a) : (b.ajax = a);
		});
	});
	o("ajax.url().load()", function (a, b) {
		return this.iterator("table", function (c) {
			Wb(c, b === false, a);
		});
	});
	var bb = function (a, b, c, d, e) {
			var f = [],
				g,
				j,
				i,
				h,
				m,
				l;
			i = typeof b;
			if (!b || i === "string" || i === "function" || b.length === k) b = [b];
			i = 0;
			for (h = b.length; i < h; i++) {
				j =
					b[i] && b[i].split && !b[i].match(/[\[\(:]/)
						? b[i].split(",")
						: [b[i]];
				m = 0;
				for (l = j.length; m < l; m++)
					(g = c(typeof j[m] === "string" ? j[m].trim() : j[m])) &&
						g.length &&
						(f = f.concat(g));
			}
			a = v.selector[a];
			if (a.length) {
				i = 0;
				for (h = a.length; i < h; i++) f = a[i](d, e, f);
			}
			return ra(f);
		},
		cb = function (a) {
			a || (a = {});
			if (a.filter && a.search === k) a.search = a.filter;
			return h.extend({ search: "none", order: "current", page: "all" }, a);
		},
		db = function (a) {
			for (var b = 0, c = a.length; b < c; b++)
				if (a[b].length > 0) {
					a[0] = a[b];
					a[0].length = 1;
					a.length = 1;
					a.context = [a.context[b]];
					return a;
				}
			a.length = 0;
			return a;
		},
		Da = function (a, b) {
			var c,
				d,
				e,
				f = [],
				g = a.aiDisplay;
			e = a.aiDisplayMaster;
			var j = b.search;
			c = b.order;
			d = b.page;
			if (y(a) == "ssp") return j === "removed" ? [] : Z(0, e.length);
			if (d == "current") {
				c = a._iDisplayStart;
				for (d = a.fnDisplayEnd(); c < d; c++) f.push(g[c]);
			} else if (c == "current" || c == "applied")
				if (j == "none") f = e.slice();
				else if (j == "applied") f = g.slice();
				else {
					if (j == "removed") {
						var i = {};
						c = 0;
						for (d = g.length; c < d; c++) i[g[c]] = null;
						f = h.map(e, function (a) {
							return !i.hasOwnProperty(a) ? a : null;
						});
					}
				}
			else if (c == "index" || c == "original") {
				c = 0;
				for (d = a.aoData.length; c < d; c++)
					if (j == "none") f.push(c);
					else {
						e = h.inArray(c, g);
						((e === -1 && j == "removed") || (e >= 0 && j == "applied")) &&
							f.push(c);
					}
			}
			return f;
		};
	o("rows()", function (a, b) {
		if (a === k) a = "";
		else if (h.isPlainObject(a)) {
			b = a;
			a = "";
		}
		var b = cb(b),
			c = this.iterator(
				"table",
				function (c) {
					var e = b,
						f;
					return bb(
						"row",
						a,
						function (a) {
							var b = Pb(a),
								i = c.aoData;
							if (b !== null && !e) return [b];
							f || (f = Da(c, e));
							if (b !== null && h.inArray(b, f) !== -1) return [b];
							if (a === null || a === k || a === "") return f;
							if (typeof a === "function")
								return h.map(f, function (b) {
									var c = i[b];
									return a(b, c._aData, c.nTr) ? b : null;
								});
							if (a.nodeName) {
								var b = a._DT_RowIndex,
									n = a._DT_CellIndex;
								if (b !== k) return i[b] && i[b].nTr === a ? [b] : [];
								if (n)
									return i[n.row] && i[n.row].nTr === a.parentNode
										? [n.row]
										: [];
								b = h(a).closest("*[data-dt-row]");
								return b.length ? [b.data("dt-row")] : [];
							}
							if (typeof a === "string" && a.charAt(0) === "#") {
								b = c.aIds[a.replace(/^#/, "")];
								if (b !== k) return [b.idx];
							}
							b = Sb(ka(c.aoData, f, "nTr"));
							return h(b)
								.filter(a)
								.map(function () {
									return this._DT_RowIndex;
								})
								.toArray();
						},
						c,
						e
					);
				},
				1
			);
		c.selector.rows = a;
		c.selector.opts = b;
		return c;
	});
	o("rows().nodes()", function () {
		return this.iterator(
			"row",
			function (a, b) {
				return a.aoData[b].nTr || k;
			},
			1
		);
	});
	o("rows().data()", function () {
		return this.iterator(
			true,
			"rows",
			function (a, b) {
				return ka(a.aoData, b, "_aData");
			},
			1
		);
	});
	u("rows().cache()", "row().cache()", function (a) {
		return this.iterator(
			"row",
			function (b, c) {
				var d = b.aoData[c];
				return a === "search" ? d._aFilterData : d._aSortData;
			},
			1
		);
	});
	u("rows().invalidate()", "row().invalidate()", function (a) {
		return this.iterator("row", function (b, c) {
			ea(b, c, a);
		});
	});
	u("rows().indexes()", "row().index()", function () {
		return this.iterator(
			"row",
			function (a, b) {
				return b;
			},
			1
		);
	});
	u("rows().ids()", "row().id()", function (a) {
		for (var b = [], c = this.context, d = 0, e = c.length; d < e; d++)
			for (var f = 0, g = this[d].length; f < g; f++) {
				var h = c[d].rowIdFn(c[d].aoData[this[d][f]]._aData);
				b.push((a === true ? "#" : "") + h);
			}
		return new r(c, b);
	});
	u("rows().remove()", "row().remove()", function () {
		var a = this;
		this.iterator("row", function (b, c, d) {
			var e = b.aoData,
				f = e[c],
				g,
				h,
				i,
				n,
				m;
			e.splice(c, 1);
			g = 0;
			for (h = e.length; g < h; g++) {
				i = e[g];
				m = i.anCells;
				if (i.nTr !== null) i.nTr._DT_RowIndex = g;
				if (m !== null) {
					i = 0;
					for (n = m.length; i < n; i++) m[i]._DT_CellIndex.row = g;
				}
			}
			qa(b.aiDisplayMaster, c);
			qa(b.aiDisplay, c);
			qa(a[d], c, false);
			b._iRecordsDisplay > 0 && b._iRecordsDisplay--;
			Ua(b);
			c = b.rowIdFn(f._aData);
			c !== k && delete b.aIds[c];
		});
		this.iterator("table", function (a) {
			for (var c = 0, d = a.aoData.length; c < d; c++) a.aoData[c].idx = c;
		});
		return this;
	});
	o("rows.add()", function (a) {
		var b = this.iterator(
				"table",
				function (b) {
					var c,
						f,
						g,
						h = [];
					f = 0;
					for (g = a.length; f < g; f++) {
						c = a[f];
						c.nodeName && c.nodeName.toUpperCase() === "TR"
							? h.push(oa(b, c)[0])
							: h.push(O(b, c));
					}
					return h;
				},
				1
			),
			c = this.rows(-1);
		c.pop();
		h.merge(c, b);
		return c;
	});
	o("row()", function (a, b) {
		return db(this.rows(a, b));
	});
	o("row().data()", function (a) {
		var b = this.context;
		if (a === k)
			return b.length && this.length ? b[0].aoData[this[0]]._aData : k;
		var c = b[0].aoData[this[0]];
		c._aData = a;
		Array.isArray(a) && c.nTr && c.nTr.id && N(b[0].rowId)(a, c.nTr.id);
		ea(b[0], this[0], "data");
		return this;
	});
	o("row().node()", function () {
		var a = this.context;
		return a.length && this.length ? a[0].aoData[this[0]].nTr || null : null;
	});
	o("row.add()", function (a) {
		a instanceof h && a.length && (a = a[0]);
		var b = this.iterator("table", function (b) {
			return a.nodeName && a.nodeName.toUpperCase() === "TR"
				? oa(b, a)[0]
				: O(b, a);
		});
		return this.row(b[0]);
	});
	var eb = function (a, b) {
			var c = a.context;
			if (c.length)
				if ((c = c[0].aoData[b !== k ? b : a[0]]) && c._details) {
					c._details.remove();
					c._detailsShow = k;
					c._details = k;
				}
		},
		Xb = function (a, b) {
			var c = a.context;
			if (c.length && a.length) {
				var d = c[0].aoData[a[0]];
				if (d._details) {
					(d._detailsShow = b)
						? d._details.insertAfter(d.nTr)
						: d._details.detach();
					var e = c[0],
						f = new r(e),
						g = e.aoData;
					f.off(
						"draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details"
					);
					if (C(g, "_details").length > 0) {
						f.on("draw.dt.DT_details", function (a, b) {
							e === b &&
								f
									.rows({ page: "current" })
									.eq(0)
									.each(function (a) {
										a = g[a];
										a._detailsShow && a._details.insertAfter(a.nTr);
									});
						});
						f.on("column-visibility.dt.DT_details", function (a, b) {
							if (e === b)
								for (var c, d = W(b), f = 0, h = g.length; f < h; f++) {
									c = g[f];
									c._details &&
										c._details.children("td[colspan]").attr("colspan", d);
								}
						});
						f.on("destroy.dt.DT_details", function (a, b) {
							if (e === b)
								for (var c = 0, d = g.length; c < d; c++)
									g[c]._details && eb(f, c);
						});
					}
				}
			}
		};
	o("row().child()", function (a, b) {
		var c = this.context;
		if (a === k)
			return c.length && this.length ? c[0].aoData[this[0]]._details : k;
		if (a === true) this.child.show();
		else if (a === false) eb(this);
		else if (c.length && this.length) {
			var d = c[0],
				c = c[0].aoData[this[0]],
				e = [],
				f = function (a, b) {
					if (Array.isArray(a) || a instanceof h)
						for (var c = 0, k = a.length; c < k; c++) f(a[c], b);
					else if (a.nodeName && a.nodeName.toLowerCase() === "tr") e.push(a);
					else {
						c = h("<tr><td></td></tr>").addClass(b);
						h("td", c).addClass(b).html(a)[0].colSpan = W(d);
						e.push(c[0]);
					}
				};
			f(a, b);
			c._details && c._details.detach();
			c._details = h(e);
			c._detailsShow && c._details.insertAfter(c.nTr);
		}
		return this;
	});
	o(["row().child.show()", "row().child().show()"], function () {
		Xb(this, true);
		return this;
	});
	o(["row().child.hide()", "row().child().hide()"], function () {
		Xb(this, false);
		return this;
	});
	o(["row().child.remove()", "row().child().remove()"], function () {
		eb(this);
		return this;
	});
	o("row().child.isShown()", function () {
		var a = this.context;
		return a.length && this.length
			? a[0].aoData[this[0]]._detailsShow || false
			: false;
	});
	var ec = /^([^:]+):(name|visIdx|visible)$/,
		Yb = function (a, b, c, d, e) {
			for (var c = [], d = 0, f = e.length; d < f; d++) c.push(B(a, e[d], b));
			return c;
		};
	o("columns()", function (a, b) {
		if (a === k) a = "";
		else if (h.isPlainObject(a)) {
			b = a;
			a = "";
		}
		var b = cb(b),
			c = this.iterator(
				"table",
				function (c) {
					var e = a,
						f = b,
						g = c.aoColumns,
						j = C(g, "sName"),
						i = C(g, "nTh");
					return bb(
						"column",
						e,
						function (a) {
							var b = Pb(a);
							if (a === "") return Z(g.length);
							if (b !== null) return [b >= 0 ? b : g.length + b];
							if (typeof a === "function") {
								var e = Da(c, f);
								return h.map(g, function (b, f) {
									return a(f, Yb(c, f, 0, 0, e), i[f]) ? f : null;
								});
							}
							var k = typeof a === "string" ? a.match(ec) : "";
							if (k)
								switch (k[2]) {
									case "visIdx":
									case "visible":
										b = parseInt(k[1], 10);
										if (b < 0) {
											var l = h.map(g, function (a, b) {
												return a.bVisible ? b : null;
											});
											return [l[l.length + b]];
										}
										return [ba(c, b)];
									case "name":
										return h.map(j, function (a, b) {
											return a === k[1] ? b : null;
										});
									default:
										return [];
								}
							if (a.nodeName && a._DT_CellIndex)
								return [a._DT_CellIndex.column];
							b = h(i)
								.filter(a)
								.map(function () {
									return h.inArray(this, i);
								})
								.toArray();
							if (b.length || !a.nodeName) return b;
							b = h(a).closest("*[data-dt-column]");
							return b.length ? [b.data("dt-column")] : [];
						},
						c,
						f
					);
				},
				1
			);
		c.selector.cols = a;
		c.selector.opts = b;
		return c;
	});
	u("columns().header()", "column().header()", function () {
		return this.iterator(
			"column",
			function (a, b) {
				return a.aoColumns[b].nTh;
			},
			1
		);
	});
	u("columns().footer()", "column().footer()", function () {
		return this.iterator(
			"column",
			function (a, b) {
				return a.aoColumns[b].nTf;
			},
			1
		);
	});
	u("columns().data()", "column().data()", function () {
		return this.iterator("column-rows", Yb, 1);
	});
	u("columns().dataSrc()", "column().dataSrc()", function () {
		return this.iterator(
			"column",
			function (a, b) {
				return a.aoColumns[b].mData;
			},
			1
		);
	});
	u("columns().cache()", "column().cache()", function (a) {
		return this.iterator(
			"column-rows",
			function (b, c, d, e, f) {
				return ka(
					b.aoData,
					f,
					a === "search" ? "_aFilterData" : "_aSortData",
					c
				);
			},
			1
		);
	});
	u("columns().nodes()", "column().nodes()", function () {
		return this.iterator(
			"column-rows",
			function (a, b, c, d, e) {
				return ka(a.aoData, e, "anCells", b);
			},
			1
		);
	});
	u("columns().visible()", "column().visible()", function (a, b) {
		var c = this,
			d = this.iterator("column", function (b, c) {
				if (a === k) return b.aoColumns[c].bVisible;
				var d = b.aoColumns,
					j = d[c],
					i = b.aoData,
					n,
					m,
					l;
				if (a !== k && j.bVisible !== a) {
					if (a) {
						var o = h.inArray(true, C(d, "bVisible"), c + 1);
						n = 0;
						for (m = i.length; n < m; n++) {
							l = i[n].nTr;
							d = i[n].anCells;
							l && l.insertBefore(d[c], d[o] || null);
						}
					} else h(C(b.aoData, "anCells", c)).detach();
					j.bVisible = a;
				}
			});
		a !== k &&
			this.iterator("table", function (d) {
				ga(d, d.aoHeader);
				ga(d, d.aoFooter);
				d.aiDisplay.length ||
					h(d.nTBody).find("td[colspan]").attr("colspan", W(d));
				za(d);
				c.iterator("column", function (c, d) {
					t(c, null, "column-visibility", [c, d, a, b]);
				});
				(b === k || b) && c.columns.adjust();
			});
		return d;
	});
	u("columns().indexes()", "column().index()", function (a) {
		return this.iterator(
			"column",
			function (b, c) {
				return a === "visible" ? ca(b, c) : c;
			},
			1
		);
	});
	o("columns.adjust()", function () {
		return this.iterator(
			"table",
			function (a) {
				aa(a);
			},
			1
		);
	});
	o("column.index()", function (a, b) {
		if (this.context.length !== 0) {
			var c = this.context[0];
			if (a === "fromVisible" || a === "toData") return ba(c, b);
			if (a === "fromData" || a === "toVisible") return ca(c, b);
		}
	});
	o("column()", function (a, b) {
		return db(this.columns(a, b));
	});
	o("cells()", function (a, b, c) {
		if (h.isPlainObject(a))
			if (a.row === k) {
				c = a;
				a = null;
			} else {
				c = b;
				b = null;
			}
		if (h.isPlainObject(b)) {
			c = b;
			b = null;
		}
		if (b === null || b === k)
			return this.iterator("table", function (b) {
				var d = a,
					e = cb(c),
					f = b.aoData,
					g = Da(b, e),
					i = Sb(ka(f, g, "anCells")),
					j = h(Tb([], i)),
					l,
					n = b.aoColumns.length,
					o,
					u,
					r,
					t,
					w,
					v;
				return bb(
					"cell",
					d,
					function (a) {
						var c = typeof a === "function";
						if (a === null || a === k || c) {
							o = [];
							u = 0;
							for (r = g.length; u < r; u++) {
								l = g[u];
								for (t = 0; t < n; t++) {
									w = { row: l, column: t };
									if (c) {
										v = f[l];
										a(w, B(b, l, t), v.anCells ? v.anCells[t] : null) &&
											o.push(w);
									} else o.push(w);
								}
							}
							return o;
						}
						if (h.isPlainObject(a))
							return a.column !== k && a.row !== k && h.inArray(a.row, g) !== -1
								? [a]
								: [];
						c = j
							.filter(a)
							.map(function (a, b) {
								return {
									row: b._DT_CellIndex.row,
									column: b._DT_CellIndex.column,
								};
							})
							.toArray();
						if (c.length || !a.nodeName) return c;
						v = h(a).closest("*[data-dt-row]");
						return v.length
							? [{ row: v.data("dt-row"), column: v.data("dt-column") }]
							: [];
					},
					b,
					e
				);
			});
		var d = c ? { page: c.page, order: c.order, search: c.search } : {},
			e = this.columns(b, d),
			f = this.rows(a, d),
			g,
			j,
			i,
			l,
			d = this.iterator(
				"table",
				function (a, b) {
					var c = [];
					g = 0;
					for (j = f[b].length; g < j; g++) {
						i = 0;
						for (l = e[b].length; i < l; i++)
							c.push({ row: f[b][g], column: e[b][i] });
					}
					return c;
				},
				1
			),
			d = c && c.selected ? this.cells(d, c) : d;
		h.extend(d.selector, { cols: b, rows: a, opts: c });
		return d;
	});
	u("cells().nodes()", "cell().node()", function () {
		return this.iterator(
			"cell",
			function (a, b, c) {
				return (a = a.aoData[b]) && a.anCells ? a.anCells[c] : k;
			},
			1
		);
	});
	o("cells().data()", function () {
		return this.iterator(
			"cell",
			function (a, b, c) {
				return B(a, b, c);
			},
			1
		);
	});
	u("cells().cache()", "cell().cache()", function (a) {
		a = a === "search" ? "_aFilterData" : "_aSortData";
		return this.iterator(
			"cell",
			function (b, c, d) {
				return b.aoData[c][a][d];
			},
			1
		);
	});
	u("cells().render()", "cell().render()", function (a) {
		return this.iterator(
			"cell",
			function (b, c, d) {
				return B(b, c, d, a);
			},
			1
		);
	});
	u("cells().indexes()", "cell().index()", function () {
		return this.iterator(
			"cell",
			function (a, b, c) {
				return { row: b, column: c, columnVisible: ca(a, c) };
			},
			1
		);
	});
	u("cells().invalidate()", "cell().invalidate()", function (a) {
		return this.iterator("cell", function (b, c, d) {
			ea(b, c, a, d);
		});
	});
	o("cell()", function (a, b, c) {
		return db(this.cells(a, b, c));
	});
	o("cell().data()", function (a) {
		var b = this.context,
			c = this[0];
		if (a === k)
			return b.length && c.length ? B(b[0], c[0].row, c[0].column) : k;
		lb(b[0], c[0].row, c[0].column, a);
		ea(b[0], c[0].row, "data", c[0].column);
		return this;
	});
	o("order()", function (a, b) {
		var c = this.context;
		if (a === k) return c.length !== 0 ? c[0].aaSorting : k;
		typeof a === "number"
			? (a = [[a, b]])
			: a.length &&
			  !Array.isArray(a[0]) &&
			  (a = Array.prototype.slice.call(arguments));
		return this.iterator("table", function (b) {
			b.aaSorting = a.slice();
		});
	});
	o("order.listener()", function (a, b, c) {
		return this.iterator("table", function (d) {
			Oa(d, a, b, c);
		});
	});
	o("order.fixed()", function (a) {
		if (!a) {
			var b = this.context,
				b = b.length ? b[0].aaSortingFixed : k;
			return Array.isArray(b) ? { pre: b } : b;
		}
		return this.iterator("table", function (b) {
			b.aaSortingFixed = h.extend(true, {}, a);
		});
	});
	o(["columns().order()", "column().order()"], function (a) {
		var b = this;
		return this.iterator("table", function (c, d) {
			var e = [];
			h.each(b[d], function (b, c) {
				e.push([c, a]);
			});
			c.aaSorting = e;
		});
	});
	o("search()", function (a, b, c, d) {
		var e = this.context;
		return a === k
			? e.length !== 0
				? e[0].oPreviousSearch.sSearch
				: k
			: this.iterator("table", function (e) {
					e.oFeatures.bFilter &&
						ha(
							e,
							h.extend({}, e.oPreviousSearch, {
								sSearch: a + "",
								bRegex: b === null ? false : b,
								bSmart: c === null ? true : c,
								bCaseInsensitive: d === null ? true : d,
							}),
							1
						);
			  });
	});
	u("columns().search()", "column().search()", function (a, b, c, d) {
		return this.iterator("column", function (e, f) {
			var g = e.aoPreSearchCols;
			if (a === k) return g[f].sSearch;
			if (e.oFeatures.bFilter) {
				h.extend(g[f], {
					sSearch: a + "",
					bRegex: b === null ? false : b,
					bSmart: c === null ? true : c,
					bCaseInsensitive: d === null ? true : d,
				});
				ha(e, e.oPreviousSearch, 1);
			}
		});
	});
	o("state()", function () {
		return this.context.length ? this.context[0].oSavedState : null;
	});
	o("state.clear()", function () {
		return this.iterator("table", function (a) {
			a.fnStateSaveCallback.call(a.oInstance, a, {});
		});
	});
	o("state.loaded()", function () {
		return this.context.length ? this.context[0].oLoadedState : null;
	});
	o("state.save()", function () {
		return this.iterator("table", function (a) {
			za(a);
		});
	});
	l.versionCheck = l.fnVersionCheck = function (a) {
		for (
			var b = l.version.split("."), a = a.split("."), c, d, e = 0, f = a.length;
			e < f;
			e++
		) {
			c = parseInt(b[e], 10) || 0;
			d = parseInt(a[e], 10) || 0;
			if (c !== d) return c > d;
		}
		return true;
	};
	l.isDataTable = l.fnIsDataTable = function (a) {
		var b = h(a).get(0),
			c = false;
		if (a instanceof l.Api) return true;
		h.each(l.settings, function (a, e) {
			var f = e.nScrollHead ? h("table", e.nScrollHead)[0] : null,
				g = e.nScrollFoot ? h("table", e.nScrollFoot)[0] : null;
			if (e.nTable === b || f === b || g === b) c = true;
		});
		return c;
	};
	l.tables = l.fnTables = function (a) {
		var b = false;
		if (h.isPlainObject(a)) {
			b = a.api;
			a = a.visible;
		}
		var c = h.map(l.settings, function (b) {
			if (!a || (a && h(b.nTable).is(":visible"))) return b.nTable;
		});
		return b ? new r(c) : c;
	};
	l.camelToHungarian = J;
	o("$()", function (a, b) {
		var c = this.rows(b).nodes(),
			c = h(c);
		return h([].concat(c.filter(a).toArray(), c.find(a).toArray()));
	});
	h.each(["on", "one", "off"], function (a, b) {
		o(b + "()", function () {
			var a = Array.prototype.slice.call(arguments);
			a[0] = h
				.map(a[0].split(/\s/), function (a) {
					return !a.match(/\.dt\b/) ? a + ".dt" : a;
				})
				.join(" ");
			var d = h(this.tables().nodes());
			d[b].apply(d, a);
			return this;
		});
	});
	o("clear()", function () {
		return this.iterator("table", function (a) {
			pa(a);
		});
	});
	o("settings()", function () {
		return new r(this.context, this.context);
	});
	o("init()", function () {
		var a = this.context;
		return a.length ? a[0].oInit : null;
	});
	o("data()", function () {
		return this.iterator("table", function (a) {
			return C(a.aoData, "_aData");
		}).flatten();
	});
	o("destroy()", function (a) {
		a = a || false;
		return this.iterator("table", function (b) {
			var c = b.nTableWrapper.parentNode,
				d = b.oClasses,
				e = b.nTable,
				f = b.nTBody,
				g = b.nTHead,
				j = b.nTFoot,
				i = h(e),
				f = h(f),
				k = h(b.nTableWrapper),
				m = h.map(b.aoData, function (a) {
					return a.nTr;
				}),
				o;
			b.bDestroying = true;
			t(b, "aoDestroyCallback", "destroy", [b]);
			a || new r(b).columns().visible(true);
			k.off(".DT").find(":not(tbody *)").off(".DT");
			h(E).off(".DT-" + b.sInstance);
			if (e != g.parentNode) {
				i.children("thead").detach();
				i.append(g);
			}
			if (j && e != j.parentNode) {
				i.children("tfoot").detach();
				i.append(j);
			}
			b.aaSorting = [];
			b.aaSortingFixed = [];
			ya(b);
			h(m).removeClass(b.asStripeClasses.join(" "));
			h("th, td", g).removeClass(
				d.sSortable +
					" " +
					d.sSortableAsc +
					" " +
					d.sSortableDesc +
					" " +
					d.sSortableNone
			);
			f.children().detach();
			f.append(m);
			g = a ? "remove" : "detach";
			i[g]();
			k[g]();
			if (!a && c) {
				c.insertBefore(e, b.nTableReinsertBefore);
				i.css("width", b.sDestroyWidth).removeClass(d.sTable);
				(o = b.asDestroyStripes.length) &&
					f.children().each(function (a) {
						h(this).addClass(b.asDestroyStripes[a % o]);
					});
			}
			c = h.inArray(b, l.settings);
			c !== -1 && l.settings.splice(c, 1);
		});
	});
	h.each(["column", "row", "cell"], function (a, b) {
		o(b + "s().every()", function (a) {
			var d = this.selector.opts,
				e = this;
			return this.iterator(b, function (f, g, h, i, l) {
				a.call(e[b](g, b === "cell" ? h : d, b === "cell" ? d : k), g, h, i, l);
			});
		});
	});
	o("i18n()", function (a, b, c) {
		var d = this.context[0],
			a = S(a)(d.oLanguage);
		a === k && (a = b);
		c !== k && h.isPlainObject(a) && (a = a[c] !== k ? a[c] : a._);
		return a.replace("%d", c);
	});
	l.version = "1.10.24";
	l.settings = [];
	l.models = {};
	l.models.oSearch = {
		bCaseInsensitive: !0,
		sSearch: "",
		bRegex: !1,
		bSmart: !0,
	};
	l.models.oRow = {
		nTr: null,
		anCells: null,
		_aData: [],
		_aSortData: null,
		_aFilterData: null,
		_sFilterRow: null,
		_sRowStripe: "",
		src: null,
		idx: -1,
	};
	l.models.oColumn = {
		idx: null,
		aDataSort: null,
		asSorting: null,
		bSearchable: null,
		bSortable: null,
		bVisible: null,
		_sManualType: null,
		_bAttrSrc: !1,
		fnCreatedCell: null,
		fnGetData: null,
		fnSetData: null,
		mData: null,
		mRender: null,
		nTh: null,
		nTf: null,
		sClass: null,
		sContentPadding: null,
		sDefaultContent: null,
		sName: null,
		sSortDataType: "std",
		sSortingClass: null,
		sSortingClassJUI: null,
		sTitle: null,
		sType: null,
		sWidth: null,
		sWidthOrig: null,
	};
	l.defaults = {
		aaData: null,
		aaSorting: [[0, "asc"]],
		aaSortingFixed: [],
		ajax: null,
		aLengthMenu: [10, 25, 50, 100],
		aoColumns: null,
		aoColumnDefs: null,
		aoSearchCols: [],
		asStripeClasses: null,
		bAutoWidth: !0,
		bDeferRender: !1,
		bDestroy: !1,
		bFilter: !0,
		bInfo: !0,
		bLengthChange: !0,
		bPaginate: !0,
		bProcessing: !1,
		bRetrieve: !1,
		bScrollCollapse: !1,
		bServerSide: !1,
		bSort: !0,
		bSortMulti: !0,
		bSortCellsTop: !1,
		bSortClasses: !0,
		bStateSave: !1,
		fnCreatedRow: null,
		fnDrawCallback: null,
		fnFooterCallback: null,
		fnFormatNumber: function (a) {
			return a
				.toString()
				.replace(/\B(?=(\d{3})+(?!\d))/g, this.oLanguage.sThousands);
		},
		fnHeaderCallback: null,
		fnInfoCallback: null,
		fnInitComplete: null,
		fnPreDrawCallback: null,
		fnRowCallback: null,
		fnServerData: null,
		fnServerParams: null,
		fnStateLoadCallback: function (a) {
			try {
				return JSON.parse(
					(a.iStateDuration === -1 ? sessionStorage : localStorage).getItem(
						"DataTables_" + a.sInstance + "_" + location.pathname
					)
				);
			} catch (b) {
				return {};
			}
		},
		fnStateLoadParams: null,
		fnStateLoaded: null,
		fnStateSaveCallback: function (a, b) {
			try {
				(a.iStateDuration === -1 ? sessionStorage : localStorage).setItem(
					"DataTables_" + a.sInstance + "_" + location.pathname,
					JSON.stringify(b)
				);
			} catch (c) {}
		},
		fnStateSaveParams: null,
		iStateDuration: 7200,
		iDeferLoading: null,
		iDisplayLength: 10,
		iDisplayStart: 0,
		iTabIndex: 0,
		oClasses: {},
		oLanguage: {
			oAria: {
				sSortAscending: ": activate to sort column ascending",
				sSortDescending: ": activate to sort column descending",
			},
			oPaginate: {
				sFirst: "الاول",
				sLast: "الاخير",
				sNext: "التالي",
				sPrevious: "السابق",
			},
			sEmptyTable: "لا توجد بيانات مطابقة",
			sInfo: "عرض _START_ الي _END_ من _TOTAL_ سجل",
			sInfoEmpty: "عرض من   0 الي 0 من 0 السجلات",
			sInfoFiltered: "(بحث من _MAX_ من اجمالي السجلات)",
			sInfoPostFix: "",
			sDecimal: "",
			sThousands: ",",
			sLengthMenu: "Show _MENU_ entries",
			sLoadingRecords: "Loading...",
			sProcessing: "Processing...",
			sSearch: "بحث :",
			sSearchPlaceholder: "",
			sUrl: "",
			sZeroRecords: "لا توجد بيانات",
		},
		oSearch: h.extend({}, l.models.oSearch),
		sAjaxDataProp: "data",
		sAjaxSource: null,
		sDom: "lfrtip",
		searchDelay: null,
		sPaginationType: "simple_numbers",
		sScrollX: "",
		sScrollXInner: "",
		sScrollY: "",
		sServerMethod: "GET",
		renderer: null,
		rowId: "DT_RowId",
	};
	$(l.defaults);
	l.defaults.column = {
		aDataSort: null,
		iDataSort: -1,
		asSorting: ["asc", "desc"],
		bSearchable: !0,
		bSortable: !0,
		bVisible: !0,
		fnCreatedCell: null,
		mData: null,
		mRender: null,
		sCellType: "td",
		sClass: "",
		sContentPadding: "",
		sDefaultContent: null,
		sName: "",
		sSortDataType: "std",
		sTitle: null,
		sType: null,
		sWidth: null,
	};
	$(l.defaults.column);
	l.models.oSettings = {
		oFeatures: {
			bAutoWidth: null,
			bDeferRender: null,
			bFilter: null,
			bInfo: null,
			bLengthChange: null,
			bPaginate: null,
			bProcessing: null,
			bServerSide: null,
			bSort: null,
			bSortMulti: null,
			bSortClasses: null,
			bStateSave: null,
		},
		oScroll: {
			bCollapse: null,
			iBarWidth: 0,
			sX: null,
			sXInner: null,
			sY: null,
		},
		oLanguage: { fnInfoCallback: null },
		oBrowser: {
			bScrollOversize: !1,
			bScrollbarLeft: !1,
			bBounding: !1,
			barWidth: 0,
		},
		ajax: null,
		aanFeatures: [],
		aoData: [],
		aiDisplay: [],
		aiDisplayMaster: [],
		aIds: {},
		aoColumns: [],
		aoHeader: [],
		aoFooter: [],
		oPreviousSearch: {},
		aoPreSearchCols: [],
		aaSorting: null,
		aaSortingFixed: [],
		asStripeClasses: null,
		asDestroyStripes: [],
		sDestroyWidth: 0,
		aoRowCallback: [],
		aoHeaderCallback: [],
		aoFooterCallback: [],
		aoDrawCallback: [],
		aoRowCreatedCallback: [],
		aoPreDrawCallback: [],
		aoInitComplete: [],
		aoStateSaveParams: [],
		aoStateLoadParams: [],
		aoStateLoaded: [],
		sTableId: "",
		nTable: null,
		nTHead: null,
		nTFoot: null,
		nTBody: null,
		nTableWrapper: null,
		bDeferLoading: !1,
		bInitialised: !1,
		aoOpenRows: [],
		sDom: null,
		searchDelay: null,
		sPaginationType: "two_button",
		iStateDuration: 0,
		aoStateSave: [],
		aoStateLoad: [],
		oSavedState: null,
		oLoadedState: null,
		sAjaxSource: null,
		sAjaxDataProp: null,
		bAjaxDataGet: !0,
		jqXHR: null,
		json: k,
		oAjaxData: k,
		fnServerData: null,
		aoServerParams: [],
		sServerMethod: null,
		fnFormatNumber: null,
		aLengthMenu: null,
		iDraw: 0,
		bDrawing: !1,
		iDrawError: -1,
		_iDisplayLength: 10,
		_iDisplayStart: 0,
		_iRecordsTotal: 0,
		_iRecordsDisplay: 0,
		oClasses: {},
		bFiltered: !1,
		bSorted: !1,
		bSortCellsTop: null,
		oInit: null,
		aoDestroyCallback: [],
		fnRecordsTotal: function () {
			return y(this) == "ssp"
				? this._iRecordsTotal * 1
				: this.aiDisplayMaster.length;
		},
		fnRecordsDisplay: function () {
			return y(this) == "ssp"
				? this._iRecordsDisplay * 1
				: this.aiDisplay.length;
		},
		fnDisplayEnd: function () {
			var a = this._iDisplayLength,
				b = this._iDisplayStart,
				c = b + a,
				d = this.aiDisplay.length,
				e = this.oFeatures,
				f = e.bPaginate;
			return e.bServerSide
				? f === false || a === -1
					? b + d
					: Math.min(b + a, this._iRecordsDisplay)
				: !f || c > d || a === -1
				? d
				: c;
		},
		oInstance: null,
		sInstance: null,
		iTabIndex: 0,
		nScrollHead: null,
		nScrollFoot: null,
		aLastSort: [],
		oPlugins: {},
		rowIdFn: null,
		rowId: null,
	};
	l.ext = v = {
		buttons: {},
		classes: {},
		builder: "-source-",
		errMode: "alert",
		feature: [],
		search: [],
		selector: { cell: [], column: [], row: [] },
		internal: {},
		legacy: { ajax: null },
		pager: {},
		renderer: { pageButton: {}, header: {} },
		order: {},
		type: { detect: [], search: {}, order: {} },
		_unique: 0,
		fnVersionCheck: l.fnVersionCheck,
		iApiIndex: 0,
		oJUIClasses: {},
		sVersion: l.version,
	};
	h.extend(v, {
		afnFiltering: v.search,
		aTypes: v.type.detect,
		ofnSearch: v.type.search,
		oSort: v.type.order,
		afnSortData: v.order,
		aoFeatures: v.feature,
		oApi: v.internal,
		oStdClasses: v.classes,
		oPagination: v.pager,
	});
	h.extend(l.ext.classes, {
		sTable: "dataTable",
		sNoFooter: "no-footer",
		sPageButton: "paginate_button",
		sPageButtonActive: "current",
		sPageButtonDisabled: "disabled",
		sStripeOdd: "odd",
		sStripeEven: "even",
		sRowEmpty: "dataTables_empty",
		sWrapper: "dataTables_wrapper",
		sFilter: "dataTables_filter",
		sInfo: "dataTables_info",
		sPaging: "dataTables_paginate paging_",
		sLength: "dataTables_length",
		sProcessing: "dataTables_processing",
		sSortAsc: "sorting_asc",
		sSortDesc: "sorting_desc",
		sSortable: "sorting",
		sSortableAsc: "sorting_desc_disabled",
		sSortableDesc: "sorting_asc_disabled",
		sSortableNone: "sorting_disabled",
		sSortColumn: "sorting_",
		sFilterInput: "",
		sLengthSelect: "",
		sScrollWrapper: "dataTables_scroll",
		sScrollHead: "dataTables_scrollHead",
		sScrollHeadInner: "dataTables_scrollHeadInner",
		sScrollBody: "dataTables_scrollBody",
		sScrollFoot: "dataTables_scrollFoot",
		sScrollFootInner: "dataTables_scrollFootInner",
		sHeaderTH: "",
		sFooterTH: "",
		sSortJUIAsc: "",
		sSortJUIDesc: "",
		sSortJUI: "",
		sSortJUIAscAllowed: "",
		sSortJUIDescAllowed: "",
		sSortJUIWrapper: "",
		sSortIcon: "",
		sJUIHeader: "",
		sJUIFooter: "",
	});
	var Mb = l.ext.pager;
	h.extend(Mb, {
		simple: function () {
			return ["previous", "next"];
		},
		full: function () {
			return ["first", "previous", "next", "last"];
		},
		numbers: function (a, b) {
			return [ja(a, b)];
		},
		simple_numbers: function (a, b) {
			return ["previous", ja(a, b), "next"];
		},
		full_numbers: function (a, b) {
			return ["first", "previous", ja(a, b), "next", "last"];
		},
		first_last_numbers: function (a, b) {
			return ["first", ja(a, b), "last"];
		},
		_numbers: ja,
		numbers_length: 7,
	});
	h.extend(!0, l.ext.renderer, {
		pageButton: {
			_: function (a, b, c, d, e, f) {
				var g = a.oClasses,
					j = a.oLanguage.oPaginate,
					i = a.oLanguage.oAria.paginate || {},
					l,
					m,
					o = 0,
					s = function (b, d) {
						var k,
							u,
							t,
							r,
							v = g.sPageButtonDisabled,
							w = function (b) {
								Va(a, b.data.action, true);
							};
						k = 0;
						for (u = d.length; k < u; k++) {
							r = d[k];
							if (Array.isArray(r)) {
								t = h("<" + (r.DT_el || "div") + "/>").appendTo(b);
								s(t, r);
							} else {
								l = null;
								m = r;
								t = a.iTabIndex;
								switch (r) {
									case "ellipsis":
										b.append('<span class="ellipsis">&#x2026;</span>');
										break;
									case "first":
										l = j.sFirst;
										if (e === 0) {
											t = -1;
											m = m + (" " + v);
										}
										break;
									case "previous":
										l = j.sPrevious;
										if (e === 0) {
											t = -1;
											m = m + (" " + v);
										}
										break;
									case "next":
										l = j.sNext;
										if (f === 0 || e === f - 1) {
											t = -1;
											m = m + (" " + v);
										}
										break;
									case "last":
										l = j.sLast;
										if (f === 0 || e === f - 1) {
											t = -1;
											m = m + (" " + v);
										}
										break;
									default:
										l = a.fnFormatNumber(r + 1);
										m = e === r ? g.sPageButtonActive : "";
								}
								if (l !== null) {
									t = h("<a>", {
										class: g.sPageButton + " " + m,
										"aria-controls": a.sTableId,
										"aria-label": i[r],
										"data-dt-idx": o,
										tabindex: t,
										id:
											c === 0 && typeof r === "string"
												? a.sTableId + "_" + r
												: null,
									})
										.html(l)
										.appendTo(b);
									Xa(t, { action: r }, w);
									o++;
								}
							}
						}
					},
					u;
				try {
					u = h(b).find(H.activeElement).data("dt-idx");
				} catch (t) {}
				s(h(b).empty(), d);
				u !== k &&
					h(b)
						.find("[data-dt-idx=" + u + "]")
						.trigger("focus");
			},
		},
	});
	h.extend(l.ext.type.detect, [
		function (a, b) {
			var c = b.oLanguage.sDecimal;
			return ab(a, c) ? "num" + c : null;
		},
		function (a) {
			if (a && !(a instanceof Date) && !bc.test(a)) return null;
			var b = Date.parse(a);
			return (b !== null && !isNaN(b)) || M(a) ? "date" : null;
		},
		function (a, b) {
			var c = b.oLanguage.sDecimal;
			return ab(a, c, true) ? "num-fmt" + c : null;
		},
		function (a, b) {
			var c = b.oLanguage.sDecimal;
			return Rb(a, c) ? "html-num" + c : null;
		},
		function (a, b) {
			var c = b.oLanguage.sDecimal;
			return Rb(a, c, true) ? "html-num-fmt" + c : null;
		},
		function (a) {
			return M(a) || (typeof a === "string" && a.indexOf("<") !== -1)
				? "html"
				: null;
		},
	]);
	h.extend(l.ext.type.search, {
		html: function (a) {
			return M(a)
				? a
				: typeof a === "string"
				? a.replace(Ob, " ").replace(Ca, "")
				: "";
		},
		string: function (a) {
			return M(a) ? a : typeof a === "string" ? a.replace(Ob, " ") : a;
		},
	});
	var Ba = function (a, b, c, d) {
		if (a !== 0 && (!a || a === "-")) return -Infinity;
		b && (a = Qb(a, b));
		if (a.replace) {
			c && (a = a.replace(c, ""));
			d && (a = a.replace(d, ""));
		}
		return a * 1;
	};
	h.extend(v.type.order, {
		"date-pre": function (a) {
			a = Date.parse(a);
			return isNaN(a) ? -Infinity : a;
		},
		"html-pre": function (a) {
			return M(a)
				? ""
				: a.replace
				? a.replace(/<.*?>/g, "").toLowerCase()
				: a + "";
		},
		"string-pre": function (a) {
			return M(a)
				? ""
				: typeof a === "string"
				? a.toLowerCase()
				: !a.toString
				? ""
				: a.toString();
		},
		"string-asc": function (a, b) {
			return a < b ? -1 : a > b ? 1 : 0;
		},
		"string-desc": function (a, b) {
			return a < b ? 1 : a > b ? -1 : 0;
		},
	});
	Fa("");
	h.extend(!0, l.ext.renderer, {
		header: {
			_: function (a, b, c, d) {
				h(a.nTable).on("order.dt.DT", function (e, f, g, h) {
					if (a === f) {
						e = c.idx;
						b.removeClass(d.sSortAsc + " " + d.sSortDesc).addClass(
							h[e] == "asc"
								? d.sSortAsc
								: h[e] == "desc"
								? d.sSortDesc
								: c.sSortingClass
						);
					}
				});
			},
			jqueryui: function (a, b, c, d) {
				h("<div/>")
					.addClass(d.sSortJUIWrapper)
					.append(b.contents())
					.append(h("<span/>").addClass(d.sSortIcon + " " + c.sSortingClassJUI))
					.appendTo(b);
				h(a.nTable).on("order.dt.DT", function (e, f, g, h) {
					if (a === f) {
						e = c.idx;
						b.removeClass(d.sSortAsc + " " + d.sSortDesc).addClass(
							h[e] == "asc"
								? d.sSortAsc
								: h[e] == "desc"
								? d.sSortDesc
								: c.sSortingClass
						);
						b.find("span." + d.sSortIcon)
							.removeClass(
								d.sSortJUIAsc +
									" " +
									d.sSortJUIDesc +
									" " +
									d.sSortJUI +
									" " +
									d.sSortJUIAscAllowed +
									" " +
									d.sSortJUIDescAllowed
							)
							.addClass(
								h[e] == "asc"
									? d.sSortJUIAsc
									: h[e] == "desc"
									? d.sSortJUIDesc
									: c.sSortingClassJUI
							);
					}
				});
			},
		},
	});
	var fb = function (a) {
		return typeof a === "string"
			? a
					.replace(/&/g, "&amp;")
					.replace(/</g, "&lt;")
					.replace(/>/g, "&gt;")
					.replace(/"/g, "&quot;")
			: a;
	};
	l.render = {
		number: function (a, b, c, d, e) {
			return {
				display: function (f) {
					if (typeof f !== "number" && typeof f !== "string") return f;
					var g = f < 0 ? "-" : "",
						h = parseFloat(f);
					if (isNaN(h)) return fb(f);
					h = h.toFixed(c);
					f = Math.abs(h);
					h = parseInt(f, 10);
					f = c ? b + (f - h).toFixed(c).substring(2) : "";
					return (
						g +
						(d || "") +
						h.toString().replace(/\B(?=(\d{3})+(?!\d))/g, a) +
						f +
						(e || "")
					);
				},
			};
		},
		text: function () {
			return { display: fb, filter: fb };
		},
	};
	h.extend(l.ext.internal, {
		_fnExternApiFunc: Nb,
		_fnBuildAjax: ta,
		_fnAjaxUpdate: nb,
		_fnAjaxParameters: wb,
		_fnAjaxUpdateDraw: xb,
		_fnAjaxDataSrc: ua,
		_fnAddColumn: Ga,
		_fnColumnOptions: la,
		_fnAdjustColumnSizing: aa,
		_fnVisibleToColumnIndex: ba,
		_fnColumnIndexToVisible: ca,
		_fnVisbleColumns: W,
		_fnGetColumns: na,
		_fnColumnTypes: Ia,
		_fnApplyColumnDefs: kb,
		_fnHungarianMap: $,
		_fnCamelToHungarian: J,
		_fnLanguageCompat: Ea,
		_fnBrowserDetect: ib,
		_fnAddData: O,
		_fnAddTr: oa,
		_fnNodeToDataIndex: function (a, b) {
			return b._DT_RowIndex !== k ? b._DT_RowIndex : null;
		},
		_fnNodeToColumnIndex: function (a, b, c) {
			return h.inArray(c, a.aoData[b].anCells);
		},
		_fnGetCellData: B,
		_fnSetCellData: lb,
		_fnSplitObjNotation: La,
		_fnGetObjectDataFn: S,
		_fnSetObjectDataFn: N,
		_fnGetDataMaster: Ma,
		_fnClearTable: pa,
		_fnDeleteIndex: qa,
		_fnInvalidate: ea,
		_fnGetRowElements: Ka,
		_fnCreateTr: Ja,
		_fnBuildHead: mb,
		_fnDrawHead: ga,
		_fnDraw: P,
		_fnReDraw: T,
		_fnAddOptionsHtml: pb,
		_fnDetectHeader: fa,
		_fnGetUniqueThs: sa,
		_fnFeatureHtmlFilter: rb,
		_fnFilterComplete: ha,
		_fnFilterCustom: Ab,
		_fnFilterColumn: zb,
		_fnFilter: yb,
		_fnFilterCreateSearch: Ra,
		_fnEscapeRegex: Sa,
		_fnFilterData: Bb,
		_fnFeatureHtmlInfo: ub,
		_fnUpdateInfo: Eb,
		_fnInfoMacros: Fb,
		_fnInitialise: ia,
		_fnInitComplete: va,
		_fnLengthChange: Ta,
		_fnFeatureHtmlLength: qb,
		_fnFeatureHtmlPaginate: vb,
		_fnPageChange: Va,
		_fnFeatureHtmlProcessing: sb,
		_fnProcessingDisplay: D,
		_fnFeatureHtmlTable: tb,
		_fnScrollDraw: ma,
		_fnApplyToChildren: I,
		_fnCalculateColumnWidths: Ha,
		_fnThrottle: Qa,
		_fnConvertToWidth: Gb,
		_fnGetWidestNode: Hb,
		_fnGetMaxLenString: Ib,
		_fnStringToCss: w,
		_fnSortFlatten: Y,
		_fnSort: ob,
		_fnSortAria: Kb,
		_fnSortListener: Wa,
		_fnSortAttachListener: Oa,
		_fnSortingClasses: ya,
		_fnSortData: Jb,
		_fnSaveState: za,
		_fnLoadState: Lb,
		_fnSettingsFromNode: Aa,
		_fnLog: K,
		_fnMap: F,
		_fnBindAction: Xa,
		_fnCallbackReg: z,
		_fnCallbackFire: t,
		_fnLengthOverflow: Ua,
		_fnRenderer: Pa,
		_fnDataSource: y,
		_fnRowAttributes: Na,
		_fnExtend: Ya,
		_fnCalculateEnd: function () {},
	});
	h.fn.dataTable = l;
	l.$ = h;
	h.fn.dataTableSettings = l.settings;
	h.fn.dataTableExt = l.ext;
	h.fn.DataTable = function (a) {
		return h(this).dataTable(a).api();
	};
	h.each(l, function (a, b) {
		h.fn.DataTable[a] = b;
	});
	return h.fn.dataTable;
});
