/*! =======================================================
                      VERSION  4.4.2              
========================================================= */
/*! =========================================================
 * bootstrap-slider.js
 *
 * Maintainers:
 *		Kyle Kemp
 *			- Twitter: @seiyria
 *			- Github:  seiyria
 *		Rohit Kalkur
 *			- Twitter: @Rovolutionary
 *			- Github:  rovolution
 *
 * =========================================================
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */
!function (a, b) {
    if ("function" == typeof define && define.amd) define(["jquery"], b); else if ("object" == typeof module && module.exports) {
        var c;
        try {
            c = require("jquery")
        } catch (d) {
            c = null
        }
        module.exports = b(c)
    } else a.Slider = b(a.jQuery)
}(this, function (a) {
    var b;
    return function (a) {
        "use strict";

        function b() {
        }

        function c(a) {
            function c(b) {
                b.prototype.option || (b.prototype.option = function (b) {
                    a.isPlainObject(b) && (this.options = a.extend(!0, this.options, b))
                })
            }

            function e(b, c) {
                a.fn[b] = function (e) {
                    if ("string" == typeof e) {
                        for (var g = d.call(arguments, 1), h = 0, i = this.length; i > h; h++) {
                            var j = this[h], k = a.data(j, b);
                            if (k) if (a.isFunction(k[e]) && "_" !== e.charAt(0)) {
                                var l = k[e].apply(k, g);
                                if (void 0 !== l && l !== k) return l
                            } else f("no such method '" + e + "' for " + b + " instance"); else f("cannot call methods on " + b + " prior to initialization; attempted to call '" + e + "'")
                        }
                        return this
                    }
                    var m = this.map(function () {
                        var d = a.data(this, b);
                        return d ? (d.option(e), d._init()) : (d = new c(this, e), a.data(this, b, d)), a(this)
                    });
                    return !m || m.length > 1 ? m : m[0]
                }
            }

            if (a) {
                var f = "undefined" == typeof console ? b : function (a) {
                    console.error(a)
                };
                return a.bridget = function (a, b) {
                    c(b), e(a, b)
                }, a.bridget
            }
        }

        var d = Array.prototype.slice;
        c(a)
    }(a), function (a) {
        function c(b, c) {
            function d(a, b) {
                var c = "data-slider-" + b, d = a.getAttribute(c);
                try {
                    return JSON.parse(d)
                } catch (e) {
                    return d
                }
            }

            "string" == typeof b ? this.element = document.querySelector(b) : b instanceof HTMLElement && (this.element = b), c = c ? c : {};
            for (var e = Object.keys(this.defaultOptions), f = 0; f < e.length; f++) {
                var g = e[f], h = c[g];
                h = "undefined" != typeof h ? h : d(this.element, g), h = null !== h ? h : this.defaultOptions[g], this.options || (this.options = {}), this.options[g] = h
            }
            var i, j, k, l, m, n = this.element.style.width, o = !1, p = this.element.parentNode;
            if (this.sliderElem) o = !0; else {
                this.sliderElem = document.createElement("div"), this.sliderElem.className = "slider";
                var q = document.createElement("div");
                if (q.className = "slider-track", j = document.createElement("div"), j.className = "slider-track-left", i = document.createElement("div"), i.className = "slider-selection", k = document.createElement("div"), k.className = "slider-track-right", l = document.createElement("div"), l.className = "slider-handle min-slider-handle", m = document.createElement("div"), m.className = "slider-handle max-slider-handle", q.appendChild(j), q.appendChild(i), q.appendChild(k), this.ticks = [], this.options.ticks instanceof Array && this.options.ticks.length > 0) for (f = 0; f < this.options.ticks.length; f++) {
                    var r = document.createElement("div");
                    r.className = "slider-tick", this.ticks.push(r), q.appendChild(r)
                }
                if (q.appendChild(l), q.appendChild(m), this.tickLabels = [], this.options.ticks_labels instanceof Array && this.options.ticks_labels.length > 0) for (this.tickLabelContainer = document.createElement("div"), this.tickLabelContainer.className = "slider-tick-label-container", f = 0; f < this.options.ticks_labels.length; f++) {
                    var s = document.createElement("div");
                    s.className = "slider-tick-label", s.innerHTML = this.options.ticks_labels[f], this.tickLabels.push(s), this.tickLabelContainer.appendChild(s)
                }
                var t = function (a) {
                    var b = document.createElement("div");
                    b.className = "tooltip-arrow";
                    var c = document.createElement("div");
                    c.className = "tooltip-inner", a.appendChild(b), a.appendChild(c)
                }, u = document.createElement("div");
                u.className = "tooltip tooltip-main", t(u);
                var v = document.createElement("div");
                v.className = "tooltip tooltip-min", t(v);
                var w = document.createElement("div");
                w.className = "tooltip tooltip-max", t(w), this.sliderElem.appendChild(q), this.sliderElem.appendChild(u), this.sliderElem.appendChild(v), this.sliderElem.appendChild(w), this.tickLabelContainer && this.sliderElem.appendChild(this.tickLabelContainer), p.insertBefore(this.sliderElem, this.element), this.element.style.display = "none"
            }
            if (a && (this.$element = a(this.element), this.$sliderElem = a(this.sliderElem)), this.eventToCallbackMap = {}, this.sliderElem.id = this.options.id, this.touchCapable = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch, this.tooltip = this.sliderElem.querySelector(".tooltip-main"), this.tooltipInner = this.tooltip.querySelector(".tooltip-inner"), this.tooltip_min = this.sliderElem.querySelector(".tooltip-min"), this.tooltipInner_min = this.tooltip_min.querySelector(".tooltip-inner"), this.tooltip_max = this.sliderElem.querySelector(".tooltip-max"), this.tooltipInner_max = this.tooltip_max.querySelector(".tooltip-inner"), o === !0 && (this._removeClass(this.sliderElem, "slider-horizontal"), this._removeClass(this.sliderElem, "slider-vertical"), this._removeClass(this.tooltip, "hide"), this._removeClass(this.tooltip_min, "hide"), this._removeClass(this.tooltip_max, "hide"), ["left", "top", "width", "height"].forEach(function (a) {
                this._removeProperty(this.trackLeft, a), this._removeProperty(this.trackSelection, a), this._removeProperty(this.trackRight, a)
            }, this), [this.handle1, this.handle2].forEach(function (a) {
                this._removeProperty(a, "left"), this._removeProperty(a, "top")
            }, this), [this.tooltip, this.tooltip_min, this.tooltip_max].forEach(function (a) {
                this._removeProperty(a, "left"), this._removeProperty(a, "top"), this._removeProperty(a, "margin-left"), this._removeProperty(a, "margin-top"), this._removeClass(a, "right"), this._removeClass(a, "top")
            }, this)), "vertical" === this.options.orientation ? (this._addClass(this.sliderElem, "slider-vertical"), this.stylePos = "top", this.mousePos = "pageY", this.sizePos = "offsetHeight", this._addClass(this.tooltip, "right"), this.tooltip.style.left = "100%", this._addClass(this.tooltip_min, "right"), this.tooltip_min.style.left = "100%", this._addClass(this.tooltip_max, "right"), this.tooltip_max.style.left = "100%") : (this._addClass(this.sliderElem, "slider-horizontal"), this.sliderElem.style.width = n, this.options.orientation = "horizontal", this.stylePos = "left", this.mousePos = "pageX", this.sizePos = "offsetWidth", this._addClass(this.tooltip, "top"), this.tooltip.style.top = -this.tooltip.outerHeight - 14 + "px", this._addClass(this.tooltip_min, "top"), this.tooltip_min.style.top = -this.tooltip_min.outerHeight - 14 + "px", this._addClass(this.tooltip_max, "top"), this.tooltip_max.style.top = -this.tooltip_max.outerHeight - 14 + "px"), this.options.ticks instanceof Array && this.options.ticks.length > 0 && (this.options.max = Math.max.apply(Math, this.options.ticks), this.options.min = Math.min.apply(Math, this.options.ticks)), this.options.value instanceof Array ? this.options.range = !0 : this.options.range && (this.options.value = [this.options.value, this.options.max]), this.trackLeft = j || this.trackLeft, this.trackSelection = i || this.trackSelection, this.trackRight = k || this.trackRight, "none" === this.options.selection && (this._addClass(this.trackLeft, "hide"), this._addClass(this.trackSelection, "hide"), this._addClass(this.trackRight, "hide")), this.handle1 = l || this.handle1, this.handle2 = m || this.handle2, o === !0) for (this._removeClass(this.handle1, "round triangle"), this._removeClass(this.handle2, "round triangle hide"), f = 0; f < this.ticks.length; f++) this._removeClass(this.ticks[f], "round triangle hide");
            var x = ["round", "triangle", "custom"], y = -1 !== x.indexOf(this.options.handle);
            if (y) for (this._addClass(this.handle1, this.options.handle), this._addClass(this.handle2, this.options.handle), f = 0; f < this.ticks.length; f++) this._addClass(this.ticks[f], this.options.handle);
            this.offset = this._offset(this.sliderElem), this.size = this.sliderElem[this.sizePos], this.setValue(this.options.value), this.handle1Keydown = this._keydown.bind(this, 0), this.handle1.addEventListener("keydown", this.handle1Keydown, !1), this.handle2Keydown = this._keydown.bind(this, 1), this.handle2.addEventListener("keydown", this.handle2Keydown, !1), this.touchCapable ? (this.mousedown = this._mousedown.bind(this), this.sliderElem.addEventListener("touchstart", this.mousedown, !1)) : (this.mousedown = this._mousedown.bind(this), this.sliderElem.addEventListener("mousedown", this.mousedown, !1)), "hide" === this.options.tooltip ? (this._addClass(this.tooltip, "hide"), this._addClass(this.tooltip_min, "hide"), this._addClass(this.tooltip_max, "hide")) : "always" === this.options.tooltip ? (this._showTooltip(), this._alwaysShowTooltip = !0) : (this.showTooltip = this._showTooltip.bind(this), this.hideTooltip = this._hideTooltip.bind(this), this.sliderElem.addEventListener("mouseenter", this.showTooltip, !1), this.sliderElem.addEventListener("mouseleave", this.hideTooltip, !1), this.handle1.addEventListener("focus", this.showTooltip, !1), this.handle1.addEventListener("blur", this.hideTooltip, !1), this.handle2.addEventListener("focus", this.showTooltip, !1), this.handle2.addEventListener("blur", this.hideTooltip, !1)), this.options.enabled ? this.enable() : this.disable()
        }

        var d = {
            formatInvalidInputErrorMsg: function (a) {
                return "Invalid input value '" + a + "' passed in"
            },
            callingContextNotSliderInstance: "Calling context element does not have instance of Slider bound to it. Check your code to make sure the JQuery object returned from the call to the slider() initializer is calling the method"
        };
        if (b = function (a, b) {
            return c.call(this, a, b), this
        }, b.prototype = {
            _init: function () {
            },
            constructor: b,
            defaultOptions: {
                id: "",
                min: 0,
                max: 10,
                step: 1,
                precision: 0,
                orientation: "horizontal",
                value: 5,
                range: !1,
                selection: "before",
                tooltip: "show",
                tooltip_split: !1,
                handle: "round",
                reversed: !1,
                enabled: !0,
                formatter: function (a) {
                    return a instanceof Array ? a[0] + " : " + a[1] : a
                },
                natural_arrow_keys: !1,
                ticks: [],
                ticks_labels: [],
                ticks_snap_bounds: 0
            },
            over: !1,
            inDrag: !1,
            getValue: function () {
                return this.options.range ? this.options.value : this.options.value[0]
            },
            setValue: function (a, b) {
                a || (a = 0);
                var c = this.getValue();
                this.options.value = this._validateInputValue(a);
                var d = this._applyPrecision.bind(this);
                this.options.range ? (this.options.value[0] = d(this.options.value[0]), this.options.value[1] = d(this.options.value[1]), this.options.value[0] = Math.max(this.options.min, Math.min(this.options.max, this.options.value[0])), this.options.value[1] = Math.max(this.options.min, Math.min(this.options.max, this.options.value[1]))) : (this.options.value = d(this.options.value), this.options.value = [Math.max(this.options.min, Math.min(this.options.max, this.options.value))], this._addClass(this.handle2, "hide"), this.options.value[1] = "after" === this.options.selection ? this.options.max : this.options.min), this.diff = this.options.max - this.options.min, this.percentage = this.diff > 0 ? [100 * (this.options.value[0] - this.options.min) / this.diff, 100 * (this.options.value[1] - this.options.min) / this.diff, 100 * this.options.step / this.diff] : [0, 0, 100], this._layout();
                var e = this.options.range ? this.options.value : this.options.value[0];
                return b === !0 && this._trigger("slide", e), c !== e && this._trigger("change", {
                    oldValue: c,
                    newValue: e
                }), this._setDataVal(e), this
            },
            destroy: function () {
                this._removeSliderEventHandlers(), this.sliderElem.parentNode.removeChild(this.sliderElem), this.element.style.display = "", this._cleanUpEventCallbacksMap(), this.element.removeAttribute("data"), a && (this._unbindJQueryEventHandlers(), this.$element.removeData("slider"))
            },
            disable: function () {
                return this.options.enabled = !1, this.handle1.removeAttribute("tabindex"), this.handle2.removeAttribute("tabindex"), this._addClass(this.sliderElem, "slider-disabled"), this._trigger("slideDisabled"), this
            },
            enable: function () {
                return this.options.enabled = !0, this.handle1.setAttribute("tabindex", 0), this.handle2.setAttribute("tabindex", 0), this._removeClass(this.sliderElem, "slider-disabled"), this._trigger("slideEnabled"), this
            },
            toggle: function () {
                return this.options.enabled ? this.disable() : this.enable(), this
            },
            isEnabled: function () {
                return this.options.enabled
            },
            on: function (b, c) {
                return a ? (this.$element.on(b, c), this.$sliderElem.on(b, c)) : this._bindNonQueryEventHandler(b, c), this
            },
            getAttribute: function (a) {
                return a ? this.options[a] : this.options
            },
            setAttribute: function (a, b) {
                return this.options[a] = b, this
            },
            refresh: function () {
                return this._removeSliderEventHandlers(), c.call(this, this.element, this.options), a && a.data(this.element, "slider", this), this
            },
            relayout: function () {
                return this._layout(), this
            },
            _removeSliderEventHandlers: function () {
                this.handle1.removeEventListener("keydown", this.handle1Keydown, !1), this.handle1.removeEventListener("focus", this.showTooltip, !1), this.handle1.removeEventListener("blur", this.hideTooltip, !1), this.handle2.removeEventListener("keydown", this.handle2Keydown, !1), this.handle2.removeEventListener("focus", this.handle2Keydown, !1), this.handle2.removeEventListener("blur", this.handle2Keydown, !1), this.sliderElem.removeEventListener("mouseenter", this.showTooltip, !1), this.sliderElem.removeEventListener("mouseleave", this.hideTooltip, !1), this.sliderElem.removeEventListener("touchstart", this.mousedown, !1), this.sliderElem.removeEventListener("mousedown", this.mousedown, !1)
            },
            _bindNonQueryEventHandler: function (a, b) {
                void 0 === this.eventToCallbackMap[a] && (this.eventToCallbackMap[a] = []), this.eventToCallbackMap[a].push(b)
            },
            _cleanUpEventCallbacksMap: function () {
                for (var a = Object.keys(this.eventToCallbackMap), b = 0; b < a.length; b++) {
                    var c = a[b];
                    this.eventToCallbackMap[c] = null
                }
            },
            _showTooltip: function () {
                this.options.tooltip_split === !1 ? this._addClass(this.tooltip, "in") : (this._addClass(this.tooltip_min, "in"), this._addClass(this.tooltip_max, "in")), this.over = !0
            },
            _hideTooltip: function () {
                this.inDrag === !1 && this.alwaysShowTooltip !== !0 && (this._removeClass(this.tooltip, "in"), this._removeClass(this.tooltip_min, "in"), this._removeClass(this.tooltip_max, "in")), this.over = !1
            },
            _layout: function () {
                var a;
                if (a = this.options.reversed ? [100 - this.percentage[0], this.percentage[1]] : [this.percentage[0], this.percentage[1]], this.handle1.style[this.stylePos] = a[0] + "%", this.handle2.style[this.stylePos] = a[1] + "%", this.options.ticks instanceof Array && this.options.ticks.length > 0) {
                    var b = Math.max.apply(Math, this.options.ticks), c = Math.min.apply(Math, this.options.ticks),
                        d = "vertical" === this.options.orientation ? "height" : "width",
                        e = "vertical" === this.options.orientation ? "margin-top" : "margin-left",
                        f = this.size / (this.options.ticks.length - 1);
                    if (this.tickLabelContainer && (this.tickLabelContainer.style[e] = -f / 2 + "px", "horizontal" === this.options.orientation)) {
                        var g = this.tickLabelContainer.offsetHeight - this.sliderElem.offsetHeight;
                        this.sliderElem.style.marginBottom = g + "px"
                    }
                    for (var h = 0; h < this.options.ticks.length; h++) {
                        var i = 100 * (this.options.ticks[h] - c) / (b - c);
                        this.ticks[h].style[this.stylePos] = i + "%", this._removeClass(this.ticks[h], "in-selection"), i <= a[0] && !this.options.range ? this._addClass(this.ticks[h], "in-selection") : i >= a[0] && i <= a[1] && this._addClass(this.ticks[h], "in-selection"), this.tickLabels[h] && (this.tickLabels[h].style[d] = f + "px")
                    }
                }
                if ("vertical" === this.options.orientation) this.trackLeft.style.top = "0", this.trackLeft.style.height = Math.min(a[0], a[1]) + "%", this.trackSelection.style.top = Math.min(a[0], a[1]) + "%", this.trackSelection.style.height = Math.abs(a[0] - a[1]) + "%", this.trackRight.style.bottom = "0", this.trackRight.style.height = 100 - Math.min(a[0], a[1]) - Math.abs(a[0] - a[1]) + "%"; else {
                    this.trackLeft.style.left = "0", this.trackLeft.style.width = Math.min(a[0], a[1]) + "%", this.trackSelection.style.left = Math.min(a[0], a[1]) + "%", this.trackSelection.style.width = Math.abs(a[0] - a[1]) + "%", this.trackRight.style.right = "0", this.trackRight.style.width = 100 - Math.min(a[0], a[1]) - Math.abs(a[0] - a[1]) + "%";
                    var j = this.tooltip_min.getBoundingClientRect(), k = this.tooltip_max.getBoundingClientRect();
                    j.right > k.left ? (this._removeClass(this.tooltip_max, "top"), this._addClass(this.tooltip_max, "bottom"), this.tooltip_max.style.top = "18px") : (this._removeClass(this.tooltip_max, "bottom"), this._addClass(this.tooltip_max, "top"), this.tooltip_max.style.top = this.tooltip_min.style.top)
                }
                var l;
                if (this.options.range) {
                    l = this.options.formatter(this.options.value), this._setText(this.tooltipInner, l), this.tooltip.style[this.stylePos] = (a[1] + a[0]) / 2 + "%", "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px"), "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px");
                    var m = this.options.formatter(this.options.value[0]);
                    this._setText(this.tooltipInner_min, m);
                    var n = this.options.formatter(this.options.value[1]);
                    this._setText(this.tooltipInner_max, n), this.tooltip_min.style[this.stylePos] = a[0] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip_min, "margin-top", -this.tooltip_min.offsetHeight / 2 + "px") : this._css(this.tooltip_min, "margin-left", -this.tooltip_min.offsetWidth / 2 + "px"), this.tooltip_max.style[this.stylePos] = a[1] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip_max, "margin-top", -this.tooltip_max.offsetHeight / 2 + "px") : this._css(this.tooltip_max, "margin-left", -this.tooltip_max.offsetWidth / 2 + "px")
                } else l = this.options.formatter(this.options.value[0]), this._setText(this.tooltipInner, l), this.tooltip.style[this.stylePos] = a[0] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px")
            },
            _removeProperty: function (a, b) {
                a.style.removeProperty ? a.style.removeProperty(b) : a.style.removeAttribute(b)
            },
            _mousedown: function (a) {
                if (!this.options.enabled) return !1;
                this._triggerFocusOnHandle(), this.offset = this._offset(this.sliderElem), this.size = this.sliderElem[this.sizePos];
                var b = this._getPercentage(a);
                if (this.options.range) {
                    var c = Math.abs(this.percentage[0] - b), d = Math.abs(this.percentage[1] - b);
                    this.dragged = d > c ? 0 : 1
                } else this.dragged = 0;
                this.percentage[this.dragged] = this.options.reversed ? 100 - b : b, this._layout(), this.touchCapable && (document.removeEventListener("touchmove", this.mousemove, !1), document.removeEventListener("touchend", this.mouseup, !1)), this.mousemove && document.removeEventListener("mousemove", this.mousemove, !1), this.mouseup && document.removeEventListener("mouseup", this.mouseup, !1), this.mousemove = this._mousemove.bind(this), this.mouseup = this._mouseup.bind(this), this.touchCapable && (document.addEventListener("touchmove", this.mousemove, !1), document.addEventListener("touchend", this.mouseup, !1)), document.addEventListener("mousemove", this.mousemove, !1), document.addEventListener("mouseup", this.mouseup, !1), this.inDrag = !0;
                var e = this._calculateValue();
                return this._trigger("slideStart", e), this._setDataVal(e), this.setValue(e), this._pauseEvent(a), !0
            },
            _triggerFocusOnHandle: function (a) {
                0 === a && this.handle1.focus(), 1 === a && this.handle2.focus()
            },
            _keydown: function (a, b) {
                if (!this.options.enabled) return !1;
                var c;
                switch (b.keyCode) {
                    case 37:
                    case 40:
                        c = -1;
                        break;
                    case 39:
                    case 38:
                        c = 1
                }
                if (c) {
                    if (this.options.natural_arrow_keys) {
                        var d = "vertical" === this.options.orientation && !this.options.reversed,
                            e = "horizontal" === this.options.orientation && this.options.reversed;
                        (d || e) && (c = -1 * c)
                    }
                    var f = c * this.percentage[2], g = this.percentage[a] + f;
                    g > 100 ? g = 100 : 0 > g && (g = 0), this.dragged = a, this._adjustPercentageForRangeSliders(g), this.percentage[this.dragged] = g, this._layout();
                    var h = this._calculateValue(!1);
                    return this._trigger("slideStart", h), this._setDataVal(h), this.setValue(h, !0), this._trigger("slideStop", h), this._setDataVal(h), this._pauseEvent(b), !1
                }
            },
            _pauseEvent: function (a) {
                a.stopPropagation && a.stopPropagation(), a.preventDefault && a.preventDefault(), a.cancelBubble = !0, a.returnValue = !1
            },
            _mousemove: function (a) {
                if (!this.options.enabled) return !1;
                var b = this._getPercentage(a);
                this._adjustPercentageForRangeSliders(b), this.percentage[this.dragged] = this.options.reversed ? 100 - b : b, this._layout();
                var c = this._calculateValue(!0);
                return this.setValue(c, !0), !1
            },
            _adjustPercentageForRangeSliders: function (a) {
                this.options.range && (0 === this.dragged && this.percentage[1] < a ? (this.percentage[0] = this.percentage[1], this.dragged = 1) : 1 === this.dragged && this.percentage[0] > a && (this.percentage[1] = this.percentage[0], this.dragged = 0))
            },
            _mouseup: function () {
                if (!this.options.enabled) return !1;
                this.touchCapable && (document.removeEventListener("touchmove", this.mousemove, !1), document.removeEventListener("touchend", this.mouseup, !1)), document.removeEventListener("mousemove", this.mousemove, !1), document.removeEventListener("mouseup", this.mouseup, !1), this.inDrag = !1, this.over === !1 && this._hideTooltip();
                var a = this._calculateValue(!0);
                return this._layout(), this._trigger("slideStop", a), this._setDataVal(a), !1
            },
            _calculateValue: function (a) {
                var b;
                if (this.options.range ? (b = [this.options.min, this.options.max], 0 !== this.percentage[0] && (b[0] = Math.max(this.options.min, this.options.min + Math.round(this.diff * this.percentage[0] / 100 / this.options.step) * this.options.step), b[0] = this._applyPrecision(b[0])), 100 !== this.percentage[1] && (b[1] = Math.min(this.options.max, this.options.min + Math.round(this.diff * this.percentage[1] / 100 / this.options.step) * this.options.step), b[1] = this._applyPrecision(b[1]))) : (b = this.options.min + Math.round(this.diff * this.percentage[0] / 100 / this.options.step) * this.options.step, b < this.options.min ? b = this.options.min : b > this.options.max && (b = this.options.max), b = parseFloat(b), b = this._applyPrecision(b)), a) {
                    for (var c = [b, 1 / 0], d = 0; d < this.options.ticks.length; d++) {
                        var e = Math.abs(this.options.ticks[d] - b);
                        e <= c[1] && (c = [this.options.ticks[d], e])
                    }
                    if (c[1] <= this.options.ticks_snap_bounds) return c[0]
                }
                return b
            },
            _applyPrecision: function (a) {
                var b = this.options.precision || this._getNumDigitsAfterDecimalPlace(this.options.step);
                return this._applyToFixedAndParseFloat(a, b)
            },
            _getNumDigitsAfterDecimalPlace: function (a) {
                var b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
            },
            _applyToFixedAndParseFloat: function (a, b) {
                var c = a.toFixed(b);
                return parseFloat(c)
            },
            _getPercentage: function (a) {
                !this.touchCapable || "touchstart" !== a.type && "touchmove" !== a.type || (a = a.touches[0]);
                var b = 100 * (a[this.mousePos] - this.offset[this.stylePos]) / this.size;
                return b = Math.round(b / this.percentage[2]) * this.percentage[2], Math.max(0, Math.min(100, b))
            },
            _validateInputValue: function (a) {
                if ("number" == typeof a) return a;
                if (a instanceof Array) return this._validateArray(a), a;
                throw new Error(d.formatInvalidInputErrorMsg(a))
            },
            _validateArray: function (a) {
                for (var b = 0; b < a.length; b++) {
                    var c = a[b];
                    if ("number" != typeof c) throw new Error(d.formatInvalidInputErrorMsg(c))
                }
            },
            _setDataVal: function (a) {
                var b = "value: '" + a + "'";
                this.element.setAttribute("data", b), this.element.setAttribute("value", a)
            },
            _trigger: function (b, c) {
                c = c || 0 === c ? c : void 0;
                var d = this.eventToCallbackMap[b];
                if (d && d.length) for (var e = 0; e < d.length; e++) {
                    var f = d[e];
                    f(c)
                }
                a && this._triggerJQueryEvent(b, c)
            },
            _triggerJQueryEvent: function (a, b) {
                var c = {type: a, value: b};
                this.$element.trigger(c), this.$sliderElem.trigger(c)
            },
            _unbindJQueryEventHandlers: function () {
                this.$element.off(), this.$sliderElem.off()
            },
            _setText: function (a, b) {
                "undefined" != typeof a.innerText ? a.innerText = b : "undefined" != typeof a.textContent && (a.textContent = b)
            },
            _removeClass: function (a, b) {
                for (var c = b.split(" "), d = a.className, e = 0; e < c.length; e++) {
                    var f = c[e], g = new RegExp("(?:\\s|^)" + f + "(?:\\s|$)");
                    d = d.replace(g, " ")
                }
                a.className = d.trim()
            },
            _addClass: function (a, b) {
                for (var c = b.split(" "), d = a.className, e = 0; e < c.length; e++) {
                    var f = c[e], g = new RegExp("(?:\\s|^)" + f + "(?:\\s|$)"), h = g.test(d);
                    h || (d += " " + f)
                }
                a.className = d.trim()
            },
            _offset: function (a) {
                var b = 0, c = 0;
                if (a.offsetParent) do b += a.offsetLeft, c += a.offsetTop; while (a = a.offsetParent);
                return {left: b, top: c}
            },
            _css: function (b, c, d) {
                if (a) a.style(b, c, d); else {
                    var e = c.replace(/^-ms-/, "ms-").replace(/-([\da-z])/gi, function (a, b) {
                        return b.toUpperCase()
                    });
                    b.style[e] = d
                }
            }
        }, a) {
            var e = a.fn.slider ? "bootstrapSlider" : "slider";
            a.bridget(e, b)
        }
    }(a), b
});