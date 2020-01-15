(function webpackUniversalModuleDefinition(a, b) {
    if (typeof exports === "object" && typeof module === "object") {
        module.exports = b()
    } else {
        if (typeof define === "function" && define.amd) {
            define([], b)
        } else {
            if (typeof exports === "object") {
                exports.jwplayer = b()
            } else {
                a.jwplayer = b()
            }
        }
    }
})(this, function() {
    return (function(b) {
        var a = window.webpackJsonpjwplayer;
        window.webpackJsonpjwplayer = function f(n, m) {
            var l, h, j = 0,
                k = [];
            for (; j < n.length; j++) {
                h = n[j];
                if (d[h]) {
                    k.push.apply(k, d[h])
                }
                d[h] = 0
            }
            for (l in m) {
                b[l] = m[l]
            }
            if (a) {
                a(n, m)
            }
            while (k.length) {
                k.shift().call(null, g)
            }
        };
        var e = {};
        var d = {
            0: 0
        };

        function g(i) {
            if (e[i]) {
                return e[i].exports
            }
            var h = e[i] = {
                exports: {},
                id: i,
                loaded: false
            };
            b[i].call(h.exports, h, h.exports, g);
            h.loaded = true;
            return h.exports
        }
        g.e = function c(i, k) {
            if (d[i] === 0) {
                return k.call(null, g)
            }
            if (d[i] !== undefined) {
                d[i].push(k)
            } else {
                d[i] = [k];
                var j = document.getElementsByTagName("head")[0];
                var h = document.createElement("script");
                h.type = "text/javascript";
                h.charset = "utf-8";
                h.async = true;
                h.src = g.p + "" + ({
                    "1": "provider.youtube",
                    "2": "provider.hlsjs",
                    "3": "polyfills.promise",
                    "4": "polyfills.base64"
                }[i] || i) + ".js";
                j.appendChild(h)
            }
        };
        g.m = b;
        g.c = e;
        g.p = "";
        return g(0)
    })([function(b, a, c) {
            b.exports = c(40)
        }, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , function(c, b, d) {
            var a, e;
            !(a = [d(41), d(46)], e = function(g, f) {
                d.p = f.loadFrom();
                return g.selectPlayer
            }.apply(b, a), e !== undefined && (c.exports = e))
        }, function(c, b, d) {
            var a, e;
            !(a = [d(42), d(43), d(76), d(80), d(78), d(93)], e = function(o, p, n, f, i, g) {
                var r = [],
                    l = 0;
                var k = function(t) {
                    var s;
                    var u;
                    if (!t) {
                        s = r[0]
                    } else {
                        if (typeof t === "string") {
                            s = j(t);
                            if (!s) {
                                u = document.getElementById(t)
                            }
                        } else {
                            if (typeof t === "number") {
                                s = r[t]
                            } else {
                                if (t.nodeType) {
                                    u = t;
                                    s = j(u.id)
                                }
                            }
                        }
                    }
                    if (s) {
                        return s
                    }
                    if (u) {
                        return h(new o(u, q))
                    }
                    return {
                        registerPlugin: g.registerPlugin
                    }
                };
                var j = function(t) {
                    for (var s = 0; s < r.length; s++) {
                        if (r[s].id === t) {
                            return r[s]
                        }
                    }
                    return null
                };
                var h = function(s) {
                    l++;
                    s.uniqueId = l;
                    r.push(s);
                    return s
                };
                var q = function(t) {
                    for (var s = r.length; s--;) {
                        if (r[s].uniqueId === t.uniqueId) {
                            r.splice(s, 1);
                            break
                        }
                    }
                };
                var m = {
                    selectPlayer: k,
                    registerProvider: n.registerProvider,
                    availableProviders: i,
                    registerPlugin: g.registerPlugin
                };
                k.api = m;
                return m
            }.apply(b, a), e !== undefined && (c.exports = e))
        }, function(c, b, d) {
            var a, e;
            !(a = [d(44), d(61), d(45), d(46), d(60), d(59), d(43), d(62), d(163), d(164), d(165), d(58)], e = function(p, q, r, m, o, h, n, g, l, f, i, k) {
                var j = function(t, s) {
                    var w = this,
                        v, x = false,
                        A = {};
                    n.extend(this, r);
                    this.utils = m;
                    this._ = n;
                    this.Events = r;
                    this.version = k;
                    this.trigger = function(C, B) {
                        if (n.isObject(B)) {
                            B = n.extend({}, B)
                        } else {
                            B = {}
                        }
                        B.type = C;
                        if (window.jwplayer && window.jwplayer.debug) {
                            return r.trigger.call(w, C, B)
                        }
                        return r.triggerSafe.call(w, C, B)
                    };
                    this.dispatchEvent = this.trigger;
                    this.removeEventListener = this.off.bind(this);
                    var u = function() {
                        v = new g(t);
                        l(w, v);
                        f(w, v);
                        v.on(p.JWPLAYER_PLAYLIST_ITEM, function() {
                            A = {}
                        });
                        v.on(p.JWPLAYER_MEDIA_META, function(B) {
                            n.extend(A, B.metadata)
                        });
                        v.on(p.JWPLAYER_READY, function(B) {
                            x = true;
                            z.tick("ready");
                            B.setupTime = z.between("setup", "ready")
                        });
                        v.on("all", w.trigger)
                    };
                    u();
                    i(this);
                    this.id = t.id;
                    var z = this._qoe = new o();
                    z.tick("init");
                    var y = function() {
                        x = false;
                        A = {};
                        w.off();
                        if (v) {
                            v.off()
                        }
                        if (v && v.playerDestroy) {
                            v.playerDestroy()
                        }
                    };
                    this.getPlugin = function(B) {
                        return w.plugins && w.plugins[B]
                    };
                    this.addPlugin = function(C, B) {
                        this.plugins = this.plugins || {};
                        this.plugins[C] = B;
                        this.onReady(B.addToPlayer);
                        if (B.resize) {
                            this.onResize(B.resizeHandler)
                        }
                    };
                    this.setup = function(B) {
                        z.tick("setup");
                        y();
                        u();
                        m.foreach(B.events, function(C, E) {
                            var D = w[C];
                            if (typeof D === "function") {
                                D.call(w, E)
                            }
                        });
                        B.id = w.id;
                        v.setup(B, this);
                        return w
                    };
                    this.qoe = function() {
                        var C = v.getItemQoe();
                        var B = z.between("setup", "ready");
                        var D = C.between(p.JWPLAYER_MEDIA_PLAY_ATTEMPT, p.JWPLAYER_MEDIA_FIRST_FRAME);
                        return {
                            setupTime: B,
                            firstFrame: D,
                            player: z.dump(),
                            item: C.dump()
                        }
                    };
                    this.getContainer = function() {
                        if (v.getContainer) {
                            return v.getContainer()
                        }
                        return t
                    };
                    this.getMeta = this.getItemMeta = function() {
                        return A
                    };
                    this.getPlaylistItem = function(B) {
                        if (!m.exists(B)) {
                            return v._model.get("playlistItem")
                        }
                        var C = w.getPlaylist();
                        if (C) {
                            return C[B]
                        }
                        return null
                    };
                    this.getRenderingMode = function() {
                        return "html5"
                    };
                    this.load = function(C) {
                        var B = this.getPlugin("vast") || this.getPlugin("googima");
                        if (B) {
                            B.destroy()
                        }
                        v.load(C);
                        return w
                    };
                    this.play = function(B, C) {
                        if (!n.isBoolean(B)) {
                            C = B
                        }
                        if (!C) {
                            C = {
                                reason: "external"
                            }
                        }
                        if (B === true) {
                            v.play(C);
                            return w
                        } else {
                            if (B === false) {
                                v.pause();
                                return w
                            }
                        }
                        B = w.getState();
                        switch (B) {
                            case q.PLAYING:
                            case q.BUFFERING:
                                v.pause();
                                break;
                            default:
                                v.play(C)
                        }
                        return w
                    };
                    this.pause = function(B) {
                        if (n.isBoolean(B)) {
                            return this.play(!B)
                        }
                        return this.play()
                    };
                    this.createInstream = function() {
                        return v.createInstream()
                    };
                    this.castToggle = function() {
                        if (v && v.castToggle) {
                            v.castToggle()
                        }
                    };
                    this.playAd = this.pauseAd = m.noop;
                    this.remove = function() {
                        s(w);
                        w.trigger("remove");
                        y();
                        return w
                    };
                    this.sendEvent = function(B, C) {
                        v.sendEvent(B, C)
                    };
                    this.setMouse = function(B) {
                        v.setMouse(B)
                    };
                    this.setCaptionBack = function(B) {
                        v.setCaptionBack(B)
                    };
                    this.setCaptionDelay = function(B) {
                        v.setCaptionDelay(B)
                    };
                    this.setCaptionColor = function(B) {
                        v.setCaptionColor(B)
                    };
                    this.setCaptionLine = function(B) {
                        v.setCaptionLine(B)
                    };
                    this.setCaptionSize = function(B) {
                        v.setCaptionSize(B)
                    };
                    this.setCaptionFont = function(B) {
                        v.setCaptionFont(B)
                    };
                    this.getCaptionStyle = function() {
                        return v.getCaptionStyle()
                    };
                    this.setSpeed = function(B) {
                        return v.setSpeed(B)
                    };
                    this.setSecondCaptions = function(B) {
                        v.setSecondCaptions(B)
                    };
                    this.saveScreenShot = function() {
                        var H = document.getElementById(this.id);
                        var B = (H) ? H.querySelector("video") : undefined;
                        if (B) {
                            var F = 1;
                            var D = document.createElement("canvas");
                            D.width = B.videoWidth * F;
                            D.height = B.videoHeight * F;
                            if (D.width > window.innerWidth) {
                                D.width = window.innerWidth * 0.9
                            }
                            if (D.height > window.innerHeight) {
                                D.height = window.innerHeight * 0.9
                            }
                            D.getContext("2d").drawImage(B, 0, 0, D.width, D.height);
                            var G = document.createElement("div");
                            var K = (window.innerHeight - D.height - 100) / 2 + "px";
                            var L = (window.innerWidth - D.width) / 2 + "px";
                            var C = document.createElement("div");
                            var E = "position: fixed;z-index: 9999999999999; left: " + L + ";top: " + K;
                            E += ";padding: 10px; background: #fff;border-radius: 5px;";
                            E += "text-align: center;border: 1px solid rgba(0, 0, 0, 0.23);";
                            C.setAttribute("style", "display: block;");
                            C.appendChild(D);
                            G.setAttribute("id", "popupSave");
                            G.setAttribute("style", E);
                            var J = document.createElement("span");
                            J.innerHTML = 'Nhấp phải vào ảnh vào chọn "Lưu ảnh (Save image as)" ';
                            var I = document.createElement("a");
                            I.innerHTML = "Đóng";
                            E = "display: inline-block; margin: 0px auto;background: #eee;";
                            E += "margin-top: 10px; padding: 5px 10px;";
                            E += "color: #000; border-radius: 5px; border: 1px solid #ccc; cursor: pointer;";
                            I.setAttribute("style", E);
                            I.onclick = function() {
                                document.getElementById("popupSave").remove()
                            };
                            G.appendChild(J);
                            G.appendChild(C);
                            G.appendChild(I);
                            document.body.appendChild(G)
                        }
                    };
                    this.showCopyUrl = function() {
                        var D = document.createElement("div");
                        var H = (this.getHeight() - 100) / 2 + "px";
                        var J = (this.getWidth() - 250) / 2 + "px";
                        var B = document.createElement("div");
                        var C = "position: absolute;z-index: 9999999999999; left: " + J + ";top: " + H;
                        C += ";padding: 10px; background: rgba(32, 32, 32, 0.38);border-radius: 5px;";
                        C += "text-align: center;border: 1px solid rgba(238, 238, 238, 0.17);";
                        B.setAttribute("style", "display: block;width:250px");
                        D.setAttribute("id", "popupCopyUrl");
                        D.setAttribute("style", C);
                        var I = document.createElement("input");
                        I.setAttribute("type", "text");
                        I.setAttribute("value", window.location.href.replace("/embed/","/phim/"));
                        C = "line-height: 20px;  border: 1px solid #ccc; ";
                        C += "border-radius: 2px; color: #656363;";
                        I.setAttribute("style", C);
                        B.appendChild(I);
                        var G = document.createElement("span");
                        G.setAttribute("style", "color: #fff; line-height: 30px;font-size: 14px;");
                        G.innerHTML = "Nhấp Ctrl + C để sao chép URl";
                        var F = document.createElement("a");
                        F.innerHTML = "Đóng";
                        C = "display: inline-block; margin: 0px auto;background: rgba(32, 32, 32, 0.79);";
                        C += "margin-top: 10px; padding: 5px 10px;font-size: 14px;";
                        C += "color: #fff; border-radius: 5px; border: 1px solid rgba(204, 204, 204, 0.28); cursor: pointer;";
                        F.setAttribute("style", C);
                        F.onclick = function() {
                            document.getElementById("popupCopyUrl").remove()
                        };
                        D.appendChild(G);
                        D.appendChild(B);
                        D.appendChild(F);
                        var E = document.getElementById(this.id);
                        E.appendChild(D);
                        I.focus();
                        I.select()
                    };
                    this.showCopyIframeCode = function() {
                        var D = document.createElement("div");
                        var H = (this.getHeight() - 100) / 2 + "px";
                        var J = (this.getWidth() - 250) / 2 + "px";
                        var B = document.createElement("div");
                        var C = "position: absolute;z-index: 9999999999999; left: " + J + ";top: " + H;
                        C += ";padding: 10px; background: rgba(32, 32, 32, 0.38);border-radius: 5px;";
                        C += "text-align: center;border: 1px solid rgba(238, 238, 238, 0.17);";
                        B.setAttribute("style", "display: block;width:250px");
                        D.setAttribute("id", "popupCopyUrl");
                        D.setAttribute("style", C);
                        var I = document.createElement("input");
                        I.setAttribute("type", "text");
                        var code = '<iframe width="560" height="310" src="'+window.location.href.replace("/phim/","/embed/")+'" frameborder="0" allowfullscreen></iframe>';
                        I.setAttribute("value", code);
                        C = "line-height: 20px;  border: 1px solid #ccc; ";
                        C += "border-radius: 2px; color: #656363;";
                        I.setAttribute("style", C);
                        B.appendChild(I);
                        var G = document.createElement("span");
                        G.setAttribute("style", "color: #fff; line-height: 30px;font-size: 14px;");
                        G.innerHTML = "Nhấp Ctrl + C để sao chép Code";
                        var F = document.createElement("a");
                        F.innerHTML = "Đóng";
                        C = "display: inline-block; margin: 0px auto;background: rgba(32, 32, 32, 0.79);";
                        C += "margin-top: 10px; padding: 5px 10px;font-size: 14px;";
                        C += "color: #fff; border-radius: 5px; border: 1px solid rgba(204, 204, 204, 0.28); cursor: pointer;";
                        F.setAttribute("style", C);
                        F.onclick = function() {
                            document.getElementById("popupCopyUrl").remove()
                        };
                        D.appendChild(G);
                        D.appendChild(B);
                        D.appendChild(F);
                        var E = document.getElementById(this.id);
                        E.appendChild(D);
                        I.focus();
                        I.select()
                    };
                    this.showCopyUrlCurrent = function() {
                        var D = document.createElement("div");
                        var H = (this.getHeight() - 100) / 2 + "px";
                        var J = (this.getWidth() - 250) / 2 + "px";
                        var B = document.createElement("div");
                        var C = "position: absolute;z-index: 9999999999999; left: " + J + ";top: " + H;
                        C += ";padding: 10px; background: rgba(32, 32, 32, 0.38);border-radius: 5px;";
                        C += "text-align: center;border: 1px solid rgba(238, 238, 238, 0.17);";
                        B.setAttribute("style", "display: block;width:250px");
                        D.setAttribute("id", "popupCopyUrl");
                        D.setAttribute("style", C);
                        var I = document.createElement("input");
                        I.setAttribute("type", "text");
                        I.setAttribute("value", window.location.href + "#t=" + Math.round(this.getPosition()));
                        C = "line-height: 20px;  border: 1px solid #ccc; ";
                        C += "border-radius: 2px; color: #656363;";
                        I.setAttribute("style", C);
                        B.appendChild(I);
                        var G = document.createElement("span");
                        G.setAttribute("style", "color: #fff; line-height: 30px;font-size: 14px;");
                        G.innerHTML = "Nhấp Ctrl + C để sao chép URl";
                        var F = document.createElement("a");
                        F.innerHTML = "Đóng";
                        C = "display: inline-block; margin: 0px auto;background: rgba(32, 32, 32, 0.79);";
                        C += "margin-top: 10px; padding: 5px 10px;font-size: 14px;";
                        C += "color: #fff; border-radius: 5px; border: 1px solid rgba(204, 204, 204, 0.28); cursor: pointer;";
                        F.setAttribute("style", C);
                        F.onclick = function() {
                            document.getElementById("popupCopyUrl").remove()
                        };
                        D.appendChild(G);
                        D.appendChild(B);
                        D.appendChild(F);
                        var E = document.getElementById(this.id);
                        E.appendChild(D);
                        I.focus();
                        I.select()
                    };
                    return this
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                var g = {};
                var m = Array.prototype,
                    C = Object.prototype,
                    E = Function.prototype;
                var v = m.slice,
                    k = m.concat,
                    x = C.toString,
                    s = C.hasOwnProperty;
                var l = m.map,
                    A = m.reduce,
                    r = m.forEach,
                    q = m.filter,
                    f = m.every,
                    z = m.some,
                    w = m.indexOf,
                    h = Array.isArray,
                    B = Object.keys,
                    n = E.bind;
                var D = function(F) {
                    if (F instanceof D) {
                        return F
                    }
                    if (!(this instanceof D)) {
                        return new D(F)
                    }
                };
                var i = D.each = D.forEach = function(K, H, G) {
                    if (K == null) {
                        return K
                    }
                    if (r && K.forEach === r) {
                        K.forEach(H, G)
                    } else {
                        if (K.length === +K.length) {
                            for (var F = 0, J = K.length; F < J; F++) {
                                if (H.call(G, K[F], F, K) === g) {
                                    return
                                }
                            }
                        } else {
                            var I = D.keys(K);
                            for (var F = 0, J = I.length; F < J; F++) {
                                if (H.call(G, K[I[F]], I[F], K) === g) {
                                    return
                                }
                            }
                        }
                    }
                    return K
                };
                D.map = D.collect = function(I, H, G) {
                    var F = [];
                    if (I == null) {
                        return F
                    }
                    if (l && I.map === l) {
                        return I.map(H, G)
                    }
                    i(I, function(L, J, K) {
                        F.push(H.call(G, L, J, K))
                    });
                    return F
                };
                var u = "Reduce of empty array with no initial value";
                D.reduce = D.foldl = D.inject = function(J, I, F, H) {
                    var G = arguments.length > 2;
                    if (J == null) {
                        J = []
                    }
                    if (A && J.reduce === A) {
                        if (H) {
                            I = D.bind(I, H)
                        }
                        return G ? J.reduce(I, F) : J.reduce(I)
                    }
                    i(J, function(M, K, L) {
                        if (!G) {
                            F = M;
                            G = true
                        } else {
                            F = I.call(H, F, M, K, L)
                        }
                    });
                    if (!G) {
                        throw new TypeError(u)
                    }
                    return F
                };
                D.find = D.detect = function(I, G, H) {
                    var F;
                    t(I, function(L, J, K) {
                        if (G.call(H, L, J, K)) {
                            F = L;
                            return true
                        }
                    });
                    return F
                };
                D.filter = D.select = function(I, F, H) {
                    var G = [];
                    if (I == null) {
                        return G
                    }
                    if (q && I.filter === q) {
                        return I.filter(F, H)
                    }
                    i(I, function(L, J, K) {
                        if (F.call(H, L, J, K)) {
                            G.push(L)
                        }
                    });
                    return G
                };
                D.reject = function(H, F, G) {
                    return D.filter(H, function(K, I, J) {
                        return !F.call(G, K, I, J)
                    }, G)
                };
                D.compact = function(F) {
                    return D.filter(F, D.identity)
                };
                D.every = D.all = function(I, G, H) {
                    G || (G = D.identity);
                    var F = true;
                    if (I == null) {
                        return F
                    }
                    if (f && I.every === f) {
                        return I.every(G, H)
                    }
                    i(I, function(L, J, K) {
                        if (!(F = F && G.call(H, L, J, K))) {
                            return g
                        }
                    });
                    return !!F
                };
                var t = D.some = D.any = function(I, G, H) {
                    G || (G = D.identity);
                    var F = false;
                    if (I == null) {
                        return F
                    }
                    if (z && I.some === z) {
                        return I.some(G, H)
                    }
                    i(I, function(L, J, K) {
                        if (F || (F = G.call(H, L, J, K))) {
                            return g
                        }
                    });
                    return !!F
                };
                D.size = function(F) {
                    if (F == null) {
                        return 0
                    }
                    return F.length === +F.length ? F.length : D.keys(F).length
                };
                D.last = function(H, G, F) {
                    if (H == null) {
                        return void 0
                    }
                    if ((G == null) || F) {
                        return H[H.length - 1]
                    }
                    return v.call(H, Math.max(H.length - G, 0))
                };
                D.after = function(G, F) {
                    return function() {
                        if (--G < 1) {
                            return F.apply(this, arguments)
                        }
                    }
                };
                D.before = function(H, G) {
                    var F;
                    return function() {
                        if (--H > 0) {
                            F = G.apply(this, arguments)
                        }
                        if (H <= 1) {
                            G = null
                        }
                        return F
                    }
                };
                var y = function(F) {
                    if (F == null) {
                        return D.identity
                    }
                    if (D.isFunction(F)) {
                        return F
                    }
                    return D.property(F)
                };
                var o = function(F) {
                    return function(J, I, H) {
                        var G = {};
                        I = y(I);
                        i(J, function(M, K) {
                            var L = I.call(H, M, K, J);
                            F(G, L, M)
                        });
                        return G
                    }
                };
                D.groupBy = o(function(F, G, H) {
                    D.has(F, G) ? F[G].push(H) : F[G] = [H]
                });
                D.indexBy = o(function(F, G, H) {
                    F[G] = H
                });
                D.sortedIndex = function(M, L, I, H) {
                    I = y(I);
                    var K = I.call(H, L);
                    var F = 0,
                        J = M.length;
                    while (F < J) {
                        var G = (F + J) >>> 1;
                        I.call(H, M[G]) < K ? F = G + 1 : J = G
                    }
                    return F
                };
                var t = D.some = D.any = function(I, G, H) {
                    G || (G = D.identity);
                    var F = false;
                    if (I == null) {
                        return F
                    }
                    if (z && I.some === z) {
                        return I.some(G, H)
                    }
                    i(I, function(L, J, K) {
                        if (F || (F = G.call(H, L, J, K))) {
                            return g
                        }
                    });
                    return !!F
                };
                D.contains = D.include = function(G, F) {
                    if (G == null) {
                        return false
                    }
                    if (G.length !== +G.length) {
                        G = D.values(G)
                    }
                    return D.indexOf(G, F) >= 0
                };
                D.pluck = function(G, F) {
                    return D.map(G, D.property(F))
                };
                D.where = function(G, F) {
                    return D.filter(G, D.matches(F))
                };
                D.findWhere = function(G, F) {
                    return D.find(G, D.matches(F))
                };
                D.max = function(J, H, G) {
                    if (!H && D.isArray(J) && J[0] === +J[0] && J.length < 65535) {
                        return Math.max.apply(Math, J)
                    }
                    var F = -Infinity,
                        I = -Infinity;
                    i(J, function(N, K, M) {
                        var L = H ? H.call(G, N, K, M) : N;
                        if (L > I) {
                            F = N;
                            I = L
                        }
                    });
                    return F
                };
                D.difference = function(G) {
                    var F = k.apply(m, v.call(arguments, 1));
                    return D.filter(G, function(H) {
                        return !D.contains(F, H)
                    })
                };
                D.without = function(F) {
                    return D.difference(F, v.call(arguments, 1))
                };
                D.indexOf = function(J, H, I) {
                    if (J == null) {
                        return -1
                    }
                    var F = 0,
                        G = J.length;
                    if (I) {
                        if (typeof I == "number") {
                            F = (I < 0 ? Math.max(0, G + I) : I)
                        } else {
                            F = D.sortedIndex(J, H);
                            return J[F] === H ? F : -1
                        }
                    }
                    if (w && J.indexOf === w) {
                        return J.indexOf(H, I)
                    }
                    for (; F < G; F++) {
                        if (J[F] === H) {
                            return F
                        }
                    }
                    return -1
                };
                var j = function() {};
                D.bind = function(I, G) {
                    var F, H;
                    if (n && I.bind === n) {
                        return n.apply(I, v.call(arguments, 1))
                    }
                    if (!D.isFunction(I)) {
                        throw new TypeError
                    }
                    F = v.call(arguments, 2);
                    return H = function() {
                        if (!(this instanceof H)) {
                            return I.apply(G, F.concat(v.call(arguments)))
                        }
                        j.prototype = I.prototype;
                        var K = new j;
                        j.prototype = null;
                        var J = I.apply(K, F.concat(v.call(arguments)));
                        if (Object(J) === J) {
                            return J
                        }
                        return K
                    }
                };
                D.partial = function(F) {
                    var G = v.call(arguments, 1);
                    return function() {
                        var H = 0;
                        var I = G.slice();
                        for (var J = 0, K = I.length; J < K; J++) {
                            if (I[J] === D) {
                                I[J] = arguments[H++]
                            }
                        }
                        while (H < arguments.length) {
                            I.push(arguments[H++])
                        }
                        return F.apply(this, I)
                    }
                };
                D.once = D.partial(D.before, 2);
                D.memoize = function(H, G) {
                    var F = {};
                    G || (G = D.identity);
                    return function() {
                        var I = G.apply(this, arguments);
                        return D.has(F, I) ? F[I] : (F[I] = H.apply(this, arguments))
                    }
                };
                D.delay = function(G, H) {
                    var F = v.call(arguments, 2);
                    return setTimeout(function() {
                        return G.apply(null, F)
                    }, H)
                };
                D.defer = function(F) {
                    return D.delay.apply(D, [F, 1].concat(v.call(arguments, 1)))
                };
                D.throttle = function(G, I, M) {
                    var F, K, N;
                    var L = null;
                    var J = 0;
                    M || (M = {});
                    var H = function() {
                        J = M.leading === false ? 0 : D.now();
                        L = null;
                        N = G.apply(F, K);
                        F = K = null
                    };
                    return function() {
                        var O = D.now();
                        if (!J && M.leading === false) {
                            J = O
                        }
                        var P = I - (O - J);
                        F = this;
                        K = arguments;
                        if (P <= 0) {
                            clearTimeout(L);
                            L = null;
                            J = O;
                            N = G.apply(F, K);
                            F = K = null
                        } else {
                            if (!L && M.trailing !== false) {
                                L = setTimeout(H, P)
                            }
                        }
                        return N
                    }
                };
                D.keys = function(H) {
                    if (!D.isObject(H)) {
                        return []
                    }
                    if (B) {
                        return B(H)
                    }
                    var G = [];
                    for (var F in H) {
                        if (D.has(H, F)) {
                            G.push(F)
                        }
                    }
                    return G
                };
                D.invert = function(J) {
                    var F = {};
                    var I = D.keys(J);
                    for (var G = 0, H = I.length; G < H; G++) {
                        F[J[I[G]]] = I[G]
                    }
                    return F
                };
                D.defaults = function(F) {
                    i(v.call(arguments, 1), function(G) {
                        if (G) {
                            for (var H in G) {
                                if (F[H] === void 0) {
                                    F[H] = G[H]
                                }
                            }
                        }
                    });
                    return F
                };
                D.extend = function(F) {
                    i(v.call(arguments, 1), function(G) {
                        if (G) {
                            for (var H in G) {
                                F[H] = G[H]
                            }
                        }
                    });
                    return F
                };
                D.pick = function(G) {
                    var H = {};
                    var F = k.apply(m, v.call(arguments, 1));
                    i(F, function(I) {
                        if (I in G) {
                            H[I] = G[I]
                        }
                    });
                    return H
                };
                D.omit = function(H) {
                    var I = {};
                    var G = k.apply(m, v.call(arguments, 1));
                    for (var F in H) {
                        if (!D.contains(G, F)) {
                            I[F] = H[F]
                        }
                    }
                    return I
                };
                D.clone = function(F) {
                    if (!D.isObject(F)) {
                        return F
                    }
                    return D.isArray(F) ? F.slice() : D.extend({}, F)
                };
                D.isArray = h || function(F) {
                    return x.call(F) == "[object Array]"
                };
                D.isObject = function(F) {
                    return F === Object(F)
                };
                i(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function(F) {
                    D["is" + F] = function(G) {
                        return x.call(G) == "[object " + F + "]"
                    }
                });
                if (!D.isArguments(arguments)) {
                    D.isArguments = function(F) {
                        return !!(F && D.has(F, "callee"))
                    }
                }
                if (true) {
                    D.isFunction = function(F) {
                        return typeof F === "function"
                    }
                }
                D.isFinite = function(F) {
                    return isFinite(F) && !isNaN(parseFloat(F))
                };
                D.isNaN = function(F) {
                    return D.isNumber(F) && F != +F
                };
                D.isBoolean = function(F) {
                    return F === true || F === false || x.call(F) == "[object Boolean]"
                };
                D.isNull = function(F) {
                    return F === null
                };
                D.isUndefined = function(F) {
                    return F === void 0
                };
                D.has = function(G, F) {
                    return s.call(G, F)
                };
                D.identity = function(F) {
                    return F
                };
                D.constant = function(F) {
                    return function() {
                        return F
                    }
                };
                D.property = function(F) {
                    return function(G) {
                        return G[F]
                    }
                };
                D.propertyOf = function(F) {
                    return F == null ? function() {} : function(G) {
                        return F[G]
                    }
                };
                D.matches = function(F) {
                    return function(H) {
                        if (H === F) {
                            return true
                        }
                        for (var G in F) {
                            if (F[G] !== H[G]) {
                                return false
                            }
                        }
                        return true
                    }
                };
                D.now = Date.now || function() {
                    return new Date().getTime()
                };
                D.result = function(F, H) {
                    if (F == null) {
                        return void 0
                    }
                    var G = F[H];
                    return D.isFunction(G) ? G.call(F) : G
                };
                var p = 0;
                D.uniqueId = function(F) {
                    var G = ++p + "";
                    return F ? F + G : G
                };
                return D
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                var g = {
                    DRAG: "drag",
                    DRAG_START: "dragStart",
                    DRAG_END: "dragEnd",
                    CLICK: "click",
                    DOUBLE_CLICK: "doubleClick",
                    TAP: "tap",
                    DOUBLE_TAP: "doubleTap",
                    OVER: "over",
                    MOVE: "move",
                    OUT: "out"
                };
                var f = {
                    COMPLETE: "complete",
                    ERROR: "error",
                    JWPLAYER_AD_CLICK: "adClick",
                    JWPLAYER_AD_COMPANIONS: "adCompanions",
                    JWPLAYER_AD_COMPLETE: "adComplete",
                    JWPLAYER_AD_ERROR: "adError",
                    JWPLAYER_AD_IMPRESSION: "adImpression",
                    JWPLAYER_AD_META: "adMeta",
                    JWPLAYER_AD_PAUSE: "adPause",
                    JWPLAYER_AD_PLAY: "adPlay",
                    JWPLAYER_AD_SKIPPED: "adSkipped",
                    JWPLAYER_AD_TIME: "adTime",
                    JWPLAYER_CAST_AD_CHANGED: "castAdChanged",
                    JWPLAYER_MEDIA_COMPLETE: "complete",
                    JWPLAYER_READY: "ready",
                    JWPLAYER_MEDIA_SEEK: "seek",
                    JWPLAYER_MEDIA_BEFOREPLAY: "beforePlay",
                    JWPLAYER_MEDIA_BEFORECOMPLETE: "beforeComplete",
                    JWPLAYER_MEDIA_BUFFER_FULL: "bufferFull",
                    JWPLAYER_DISPLAY_CLICK: "displayClick",
                    JWPLAYER_PLAYLIST_COMPLETE: "playlistComplete",
                    JWPLAYER_CAST_SESSION: "cast",
                    JWPLAYER_MEDIA_ERROR: "mediaError",
                    JWPLAYER_MEDIA_FIRST_FRAME: "firstFrame",
                    JWPLAYER_MEDIA_PLAY_ATTEMPT: "playAttempt",
                    JWPLAYER_MEDIA_LOADED: "loaded",
                    JWPLAYER_MEDIA_SEEKED: "seeked",
                    JWPLAYER_SETUP_ERROR: "setupError",
                    JWPLAYER_ERROR: "error",
                    JWPLAYER_PLAYER_STATE: "state",
                    JWPLAYER_CAST_AVAILABLE: "castAvailable",
                    JWPLAYER_MEDIA_BUFFER: "bufferChange",
                    JWPLAYER_MEDIA_TIME: "time",
                    JWPLAYER_MEDIA_TYPE: "mediaType",
                    JWPLAYER_MEDIA_VOLUME: "volume",
                    JWPLAYER_MEDIA_MUTE: "mute",
                    JWPLAYER_MEDIA_META: "meta",
                    JWPLAYER_MEDIA_LEVELS: "levels",
                    JWPLAYER_MEDIA_LEVEL_CHANGED: "levelsChanged",
                    JWPLAYER_CONTROLS: "controls",
                    JWPLAYER_FULLSCREEN: "fullscreen",
                    JWPLAYER_RESIZE: "resize",
                    JWPLAYER_PLAYLIST_ITEM: "playlistItem",
                    JWPLAYER_PLAYLIST_LOADED: "playlist",
                    JWPLAYER_AUDIO_TRACKS: "audioTracks",
                    JWPLAYER_AUDIO_TRACK_CHANGED: "audioTrackChanged",
                    JWPLAYER_LOGO_CLICK: "logoClick",
                    JWPLAYER_CAPTIONS_LIST: "captionsList",
                    JWPLAYER_CAPTIONS_CHANGED: "captionsChanged",
                    JWPLAYER_PROVIDER_CHANGED: "providerChanged",
                    JWPLAYER_PROVIDER_FIRST_FRAME: "providerFirstFrame",
                    JWPLAYER_USER_ACTION: "userAction",
                    JWPLAYER_PROVIDER_CLICK: "providerClick",
                    JWPLAYER_VIEW_TAB_FOCUS: "tabFocus",
                    JWPLAYER_CONTROLBAR_DRAGGING: "scrubbing",
                    JWPLAYER_INSTREAM_CLICK: "instreamClick",
                    JWPLAYER_VIP_ALERT: "requireVip",
                    JWPLAYER_SEND_DUNE: "sendVideoDune"
                };
                f.touchEvents = g;
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(i) {
                var m = [];
                var k = m.slice;
                var f = {
                    on: function(n, q, p) {
                        if (!l(this, "on", n, [q, p]) || !q) {
                            return this
                        }
                        this._events || (this._events = {});
                        var o = this._events[n] || (this._events[n] = []);
                        o.push({
                            callback: q,
                            context: p
                        });
                        return this
                    },
                    once: function(o, r, p) {
                        if (!l(this, "once", o, [r, p]) || !r) {
                            return this
                        }
                        var n = this;
                        var q = i.once(function() {
                            n.off(o, q);
                            r.apply(this, arguments)
                        });
                        q._callback = r;
                        return this.on(o, q, p)
                    },
                    off: function(n, w, o) {
                        var u, v, x, t, s, p, r, q;
                        if (!this._events || !l(this, "off", n, [w, o])) {
                            return this
                        }
                        if (!n && !w && !o) {
                            this._events = void 0;
                            return this
                        }
                        t = n ? [n] : i.keys(this._events);
                        for (s = 0, p = t.length; s < p; s++) {
                            n = t[s];
                            if (x = this._events[n]) {
                                this._events[n] = u = [];
                                if (w || o) {
                                    for (r = 0, q = x.length; r < q; r++) {
                                        v = x[r];
                                        if ((w && w !== v.callback && w !== v.callback._callback) || (o && o !== v.context)) {
                                            u.push(v)
                                        }
                                    }
                                }
                                if (!u.length) {
                                    delete this._events[n]
                                }
                            }
                        }
                        return this
                    },
                    trigger: function(p) {
                        if (!this._events) {
                            return this
                        }
                        var o = k.call(arguments, 1);
                        if (!l(this, "trigger", p, o)) {
                            return this
                        }
                        var q = this._events[p];
                        var n = this._events.all;
                        if (q) {
                            j(q, o, this)
                        }
                        if (n) {
                            j(n, arguments, this)
                        }
                        return this
                    },
                    triggerSafe: function(p) {
                        if (!this._events) {
                            return this
                        }
                        var o = k.call(arguments, 1);
                        if (!l(this, "trigger", p, o)) {
                            return this
                        }
                        var q = this._events[p];
                        var n = this._events.all;
                        if (q) {
                            g(q, o, this)
                        }
                        if (n) {
                            g(n, arguments, this)
                        }
                        return this
                    }
                };
                var h = /\s+/;
                var l = function(u, s, o, r) {
                    if (!o) {
                        return true
                    }
                    if (typeof o === "object") {
                        for (var q in o) {
                            u[s].apply(u, [q, o[q]].concat(r))
                        }
                        return false
                    }
                    if (h.test(o)) {
                        var t = o.split(h);
                        for (var p = 0, n = t.length; p < n; p++) {
                            u[s].apply(u, [t[p]].concat(r))
                        }
                        return false
                    }
                    return true
                };
                var j = function(v, t, p) {
                    var u, s = -1,
                        r = v.length,
                        q = t[0],
                        o = t[1],
                        n = t[2];
                    switch (t.length) {
                        case 0:
                            while (++s < r) {
                                (u = v[s]).callback.call(u.context || p)
                            }
                            return;
                        case 1:
                            while (++s < r) {
                                (u = v[s]).callback.call(u.context || p, q)
                            }
                            return;
                        case 2:
                            while (++s < r) {
                                (u = v[s]).callback.call(u.context || p, q, o)
                            }
                            return;
                        case 3:
                            while (++s < r) {
                                (u = v[s]).callback.call(u.context || p, q, o, n)
                            }
                            return;
                        default:
                            while (++s < r) {
                                (u = v[s]).callback.apply(u.context || p, t)
                            }
                            return
                    }
                };
                var g = function(r, o, q) {
                    var s, p = -1,
                        n = r.length;
                    while (++p < n) {
                        try {
                            (s = r[p]).callback.apply(s.context || q, o)
                        } catch (t) {}
                    }
                };
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48), d(43), d(49), d(50), d(52), d(53), d(47), d(55), d(54), d(56), d(59)], e = function(p, o, k, j, l, g, h, m, f, q, i) {
                var n = {};
                n.log = function() {
                    if (!window.console) {
                        return
                    }
                    if (typeof console.log === "object") {
                        console.log(Array.prototype.slice.call(arguments, 0))
                    } else {
                        console.log.apply(console, arguments)
                    }
                };
                n.between = function(s, t, r) {
                    return Math.max(Math.min(s, r), t)
                };
                n.foreach = function(s, r) {
                    var t, u;
                    for (t in s) {
                        if (n.typeOf(s.hasOwnProperty) === "function") {
                            if (s.hasOwnProperty(t)) {
                                u = s[t];
                                r(t, u)
                            }
                        } else {
                            u = s[t];
                            r(t, u)
                        }
                    }
                };
                n.indexOf = o.indexOf;
                n.noop = function() {};
                n.seconds = p.seconds;
                n.prefix = p.prefix;
                n.suffix = p.suffix;
                o.extend(n, g, h, f, k, m, j, l, q, i);
                return n
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(g) {
                var h = {};
                var f = {
                    TIT2: "title",
                    TT2: "title",
                    WXXX: "url",
                    TPE1: "artist",
                    TP1: "artist",
                    TALB: "album",
                    TAL: "album"
                };
                h.utf8ArrayToStr = function(q, o) {
                    var k, m, j, p;
                    var n, l;
                    k = "";
                    j = q.length;
                    m = o || 0;
                    while (m < j) {
                        p = q[m++];
                        if (p === 0 || p === 3) {
                            continue
                        }
                        switch (p >> 4) {
                            case 0:
                            case 1:
                            case 2:
                            case 3:
                            case 4:
                            case 5:
                            case 6:
                            case 7:
                                k += String.fromCharCode(p);
                                break;
                            case 12:
                            case 13:
                                n = q[m++];
                                k += String.fromCharCode(((p & 31) << 6) | (n & 63));
                                break;
                            case 14:
                                n = q[m++];
                                l = q[m++];
                                k += String.fromCharCode(((p & 15) << 12) | ((n & 63) << 6) | ((l & 63) << 0));
                                break
                        }
                    }
                    return k
                };
                h.utf16BigEndianArrayToStr = function(n, m) {
                    var j, k, l;
                    j = "";
                    l = n.length - 1;
                    k = m || 0;
                    while (k < l) {
                        if (n[k] === 254 && n[k + 1] === 255) {} else {
                            j += String.fromCharCode((n[k] << 8) + n[k + 1])
                        }
                        k += 2
                    }
                    return j
                };
                h.syncSafeInt = function(i) {
                    var j = h.arrayToInt(i);
                    return (j & 127) | ((j & 32512) >> 1) | ((j & 8323072) >> 2) | ((j & 2130706432) >> 3)
                };
                h.arrayToInt = function(l) {
                    var j = "0x";
                    for (var k = 0; k < l.length; k++) {
                        j += l[k].toString(16)
                    }
                    return parseInt(j)
                };
                h.parseID3 = function(i) {
                    return g.reduce(i, function(q, s) {
                        if (!("value" in s)) {
                            if ("data" in s && s.data instanceof ArrayBuffer) {
                                var k = s;
                                var v = new Uint8Array(k.data);
                                var p = v.length;
                                s = {
                                    value: {
                                        key: "",
                                        data: ""
                                    }
                                };
                                var r = 10;
                                while (r < 14 && r < v.length) {
                                    if (v[r] === 0) {
                                        break
                                    }
                                    s.value.key += String.fromCharCode(v[r]);
                                    r++
                                }
                                var w = 19;
                                var x = v[w];
                                if (x === 3 || x === 0) {
                                    x = v[++w];
                                    p--
                                }
                                var y = 0;
                                if (x !== 1 && x !== 2) {
                                    for (var o = w + 1; o < p; o++) {
                                        if (v[o] === 0) {
                                            y = o - w;
                                            break
                                        }
                                    }
                                }
                                if (y > 0) {
                                    var n = h.utf8ArrayToStr(v.subarray(w, w += y), 0);
                                    if (s.value.key === "PRIV") {
                                        if (n === "com.apple.streaming.transportStreamTimestamp") {
                                            var m = h.syncSafeInt(v.subarray(w, w += 4)) & 1;
                                            var u = h.syncSafeInt(v.subarray(w, w += 4));
                                            if (m) {
                                                u += 4294967296
                                            }
                                            s.value.data = u
                                        } else {
                                            s.value.data = h.utf8ArrayToStr(v, w + 1)
                                        }
                                        s.value.info = n
                                    } else {
                                        s.value.info = n;
                                        s.value.data = h.utf8ArrayToStr(v, w + 1)
                                    }
                                } else {
                                    var l = v[w];
                                    if (l === 1 || l === 2) {
                                        s.value.data = h.utf16BigEndianArrayToStr(v, w + 1)
                                    } else {
                                        s.value.data = h.utf8ArrayToStr(v, w + 1)
                                    }
                                }
                            }
                        }
                        if (f.hasOwnProperty(s.value.key)) {
                            q[f[s.value.key]] = s.value.data
                        }
                        if (s.value.info) {
                            var t = q[s.value.key];
                            if (!g.isObject(t)) {
                                t = {};
                                q[s.value.key] = t
                            }
                            t[s.value.info] = s.value.data
                        } else {
                            q[s.value.key] = s.value.data
                        }
                        return q
                    }, {})
                };
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(n) {
                var g = function(p) {
                    return p.replace(/^\s+|\s+$/g, "")
                };
                var f = function(r, q, p) {
                    r = "" + r;
                    p = p || "0";
                    while (r.length < q) {
                        r = p + r
                    }
                    return r
                };
                var i = function(p, q) {
                    for (var r = 0; r < p.attributes.length; r++) {
                        if (p.attributes[r].name && p.attributes[r].name.toLowerCase() === q.toLowerCase()) {
                            return p.attributes[r].value.toString()
                        }
                    }
                    return ""
                };

                function h(p) {
                    if ((/[\(,]format=m3u8-/i).test(p)) {
                        return "m3u8"
                    } else {
                        return false
                    }
                }
                var m = function(q) {
                    if (!q || q.substr(0, 4) === "rtmp") {
                        return ""
                    }
                    var p = h(q);
                    if (p) {
                        return p
                    }
                    q = q.split("?")[0].split("#")[0];
                    if (q.lastIndexOf(".") > -1) {
                        return q.substr(q.lastIndexOf(".") + 1, q.length).toLowerCase()
                    }
                };
                var k = function(t) {
                    var r = parseInt(t / 3600);
                    var p = parseInt(t / 60) % 60;
                    var q = t % 60;
                    return f(r, 2) + ":" + f(p, 2) + ":" + f(q.toFixed(3), 6)
                };
                var l = function(r) {
                    if (n.isNumber(r)) {
                        return r
                    }
                    r = r.replace(",", ".");
                    var p = r.split(":");
                    var q = 0;
                    if (r.slice(-1) === "s") {
                        q = parseFloat(r)
                    } else {
                        if (r.slice(-1) === "m") {
                            q = parseFloat(r) * 60
                        } else {
                            if (r.slice(-1) === "h") {
                                q = parseFloat(r) * 3600
                            } else {
                                if (p.length > 1) {
                                    q = parseFloat(p[p.length - 1]);
                                    q += parseFloat(p[p.length - 2]) * 60;
                                    if (p.length === 3) {
                                        q += parseFloat(p[p.length - 3]) * 3600
                                    }
                                } else {
                                    q = parseFloat(r)
                                }
                            }
                        }
                    }
                    return q
                };
                var j = function(p, q) {
                    return n.map(p, function(r) {
                        return q + r
                    })
                };
                var o = function(p, q) {
                    return n.map(p, function(r) {
                        return r + q
                    })
                };
                return {
                    trim: g,
                    pad: f,
                    xmlAttribute: i,
                    extension: m,
                    hms: k,
                    seconds: l,
                    suffix: o,
                    prefix: j
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(n) {
                var j = {};
                var i = n.memoize(function(q) {
                    var p = navigator.userAgent.toLowerCase();
                    return (p.match(q) !== null)
                });

                function o(p) {
                    return function() {
                        return i(p)
                    }
                }
                var l = j.isInt = function(p) {
                    return parseFloat(p) % 1 === 0
                };
                j.isFlashSupported = function() {
                    var p = j.flashVersion();
                    return p && p >= (11.2)
                };
                j.isFF = o(/firefox/i);
                j.isIPod = o(/iP(hone|od)/i);
                j.isIPad = o(/iPad/i);
                j.isSafari602 = o(/Macintosh.*Mac OS X 10_8.*6\.0\.\d* Safari/i);
                j.isOSX = o(/Mac OS X/i);
                j.isEdge = o(/\sedge\/\d+/i);
                var g = j.isIETrident = function(p) {
                    if (j.isEdge()) {
                        return true
                    }
                    if (p) {
                        p = parseFloat(p).toFixed(1);
                        return i(new RegExp("trident/.+rv:\\s*" + p, "i"))
                    }
                    return i(/trident/i)
                };
                var h = j.isMSIE = function(p) {
                    if (p) {
                        p = parseFloat(p).toFixed(1);
                        return i(new RegExp("msie\\s*" + p, "i"))
                    }
                    return i(/msie/i)
                };
                var f = o(/chrome/i);
                j.isChrome = function() {
                    return f() && !j.isEdge()
                };
                j.isIE = function(p) {
                    if (p) {
                        p = parseFloat(p).toFixed(1);
                        if (p >= 11) {
                            return g(p)
                        } else {
                            return h(p)
                        }
                    }
                    return h() || g()
                };
                j.isSafari = function() {
                    return (i(/safari/i) && !i(/chrome/i) && !i(/chromium/i) && !i(/android/i))
                };
                var m = j.isIOS = function(p) {
                    if (p) {
                        return i(new RegExp("iP(hone|ad|od).+\\s(OS\\s" + p + "|.*\\sVersion/" + p + ")", "i"))
                    }
                    return i(/iP(hone|ad|od)/i)
                };
                j.isAndroidNative = function(p) {
                    return k(p, true)
                };
                var k = j.isAndroid = function(q, p) {
                    if (p && i(/chrome\/[123456789]/i) && !i(/chrome\/18/)) {
                        return false
                    }
                    if (q) {
                        if (l(q) && !/\./.test(q)) {
                            q = "" + q + "."
                        }
                        return i(new RegExp("Android\\s*" + q, "i"))
                    }
                    return i(/Android/i)
                };
                j.isMobile = function() {
                    return m() || k()
                };
                j.isIframe = function() {
                    return (window.frameElement && (window.frameElement.nodeName === "IFRAME"))
                };
                j.flashVersion = function() {
                    if (j.isAndroid()) {
                        return 0
                    }
                    var p = navigator.plugins,
                        q;
                    if (p) {
                        q = p["Shockwave Flash"];
                        if (q && q.description) {
                            return parseFloat(q.description.replace(/\D+(\d+\.?\d*).*/, "$1"))
                        }
                    }
                    if (typeof window.ActiveXObject !== "undefined") {
                        try {
                            q = new window.ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                            if (q) {
                                return parseFloat(q.GetVariable("$version").split(" ")[1].replace(/\s*,\s*/, "."))
                            }
                        } catch (r) {
                            return 0
                        }
                        return q
                    }
                    return 0
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48), d(43), d(51)], e = function(f, g, h) {
                var k = {};
                k.createElement = function(l) {
                    var m = document.createElement("div");
                    m.innerHTML = l;
                    return m.firstChild
                };
                k.styleDimension = function(l) {
                    return l + (l.toString().indexOf("%") > 0 ? "" : "px")
                };
                var j = function(l) {
                    return g.isString(l.className) ? l.className.split(" ") : []
                };
                var i = function(l, m) {
                    m = f.trim(m);
                    if (l.className !== m) {
                        l.className = m
                    }
                };
                k.classList = function(l) {
                    if (l.classList) {
                        return l.classList
                    }
                    return j(l)
                };
                k.hasClass = h.hasClass;
                k.addClass = function(n, m) {
                    var l = j(n);
                    var o = g.isArray(m) ? m : m.split(" ");
                    g.each(o, function(p) {
                        if (!g.contains(l, p)) {
                            l.push(p)
                        }
                    });
                    i(n, l.join(" "))
                };
                k.removeClass = function(n, o) {
                    var m = j(n);
                    var l = g.isArray(o) ? o : o.split(" ");
                    i(n, g.difference(m, l).join(" "))
                };
                k.replaceClass = function(n, o, l) {
                    var m = (n.className || "");
                    if (o.test(m)) {
                        m = m.replace(o, l)
                    } else {
                        if (l) {
                            m += " " + l
                        }
                    }
                    i(n, m)
                };
                k.toggleClass = function(m, o, n) {
                    var l = k.hasClass(m, o);
                    n = g.isBoolean(n) ? n : !l;
                    if (n === l) {
                        return
                    }
                    if (n) {
                        k.addClass(m, o)
                    } else {
                        k.removeClass(m, o)
                    }
                };
                k.emptyElement = function(l) {
                    while (l.firstChild) {
                        l.removeChild(l.firstChild)
                    }
                };
                k.addStyleSheet = function(l) {
                    var m = document.createElement("link");
                    m.rel = "stylesheet";
                    m.href = l;
                    document.getElementsByTagName("head")[0].appendChild(m)
                };
                k.empty = function(l) {
                    if (!l) {
                        return
                    }
                    while (l.childElementCount > 0) {
                        l.removeChild(l.children[0])
                    }
                };
                k.bounds = function(m) {
                    var p = {
                        left: 0,
                        right: 0,
                        width: 0,
                        height: 0,
                        top: 0,
                        bottom: 0
                    };
                    if (!m || !document.body.contains(m)) {
                        return p
                    }
                    var o = m.getBoundingClientRect(m),
                        l = window.pageYOffset,
                        n = window.pageXOffset;
                    if (!o.width && !o.height && !o.left && !o.top) {
                        return p
                    }
                    p.left = o.left + n;
                    p.right = o.right + n;
                    p.top = o.top + l;
                    p.bottom = o.bottom + l;
                    p.width = o.right - o.left;
                    p.height = o.bottom - o.top;
                    return p
                };
                return k
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return {
                    hasClass: function(f, h) {
                        var g = " " + h + " ";
                        return (f.nodeType === 1 && (" " + f.className + " ").replace(/[\t\r\n\f]/g, " ").indexOf(g) >= 0)
                    }
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48)], e = function(i) {
                var f = {},
                    n;
                var l = function(p, t) {
                    if (!n) {
                        n = document.createElement("style");
                        n.type = "text/css";
                        document.getElementsByTagName("head")[0].appendChild(n)
                    }
                    var r = "";
                    if (typeof t === "object") {
                        var q = document.createElement("div");
                        h(q, t);
                        r = "{" + q.style.cssText + "}"
                    } else {
                        if (typeof t === "string") {
                            r = t
                        }
                    }
                    var s = document.createTextNode(p + r);
                    if (f[p]) {
                        n.removeChild(f[p])
                    }
                    f[p] = s;
                    n.appendChild(s)
                };
                var h = function(v, u) {
                    if (v === undefined || v === null) {
                        return
                    }
                    if (v.length === undefined) {
                        v = [v]
                    }
                    var t;
                    var p = {};
                    for (t in u) {
                        p[t] = o(t, u[t])
                    }
                    for (var s = 0; s < v.length; s++) {
                        var r = v[s],
                            q;
                        if (r !== undefined && r !== null) {
                            for (t in p) {
                                q = k(t);
                                if (r.style[q] !== p[t]) {
                                    r.style[q] = p[t]
                                }
                            }
                        }
                    }
                };

                function k(p) {
                    p = p.split("-");
                    for (var q = 1; q < p.length; q++) {
                        p[q] = p[q].charAt(0).toUpperCase() + p[q].slice(1)
                    }
                    return p.join("")
                }

                function o(r, s, p) {
                    if (s === "" || s === undefined || s === null) {
                        return ""
                    }
                    var q = p ? " !important" : "";
                    if (typeof s === "string" && isNaN(s)) {
                        if ((/png|gif|jpe?g/i).test(s) && s.indexOf("url") < 0) {
                            return "url(" + s + ")"
                        }
                        return s + q
                    }
                    if (s === 0 || r === "z-index" || r === "opacity") {
                        return "" + s + q
                    }
                    if ((/color/i).test(r)) {
                        return "#" + i.pad(s.toString(16).replace(/^0x/i, ""), 6) + q
                    }
                    return Math.ceil(s) + "px" + q
                }
                var j = function(q) {
                    for (var p in f) {
                        if (p.indexOf(q) >= 0) {
                            n.removeChild(f[p]);
                            delete f[p]
                        }
                    }
                };
                var g = function(p, q) {
                    h(p, {
                        transform: q,
                        webkitTransform: q,
                        msTransform: q,
                        mozTransform: q,
                        oTransform: q
                    })
                };
                var m = function(r, q) {
                    var s = "rgb";
                    if (r) {
                        r = String(r).replace("#", "");
                        if (r.length === 3) {
                            r = r[0] + r[0] + r[1] + r[1] + r[2] + r[2]
                        }
                    } else {
                        r = "000000"
                    }
                    var p = [parseInt(r.substr(0, 2), 16), parseInt(r.substr(2, 2), 16), parseInt(r.substr(4, 2), 16)];
                    if (q !== undefined && q !== 100) {
                        s += "a";
                        p.push(q / 100)
                    }
                    return s + "(" + p.join(",") + ")"
                };
                return {
                    css: l,
                    style: h,
                    clearCss: j,
                    transform: g,
                    hexToRgba: m
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(54)], e = function(g, h) {
                var j = {};
                j.getAbsolutePath = function(q, p) {
                    if (!h.exists(p)) {
                        p = document.location.href
                    }
                    if (!h.exists(q)) {
                        return
                    }
                    if (f(q)) {
                        return q
                    }
                    var r = p.substring(0, p.indexOf("://") + 3);
                    var o = p.substring(r.length, p.indexOf("/", r.length + 1));
                    var l;
                    if (q.indexOf("/") === 0) {
                        l = q.split("/")
                    } else {
                        var m = p.split("?")[0];
                        m = m.substring(r.length + o.length + 1, m.lastIndexOf("/"));
                        l = m.split("/").concat(q.split("/"))
                    }
                    var k = [];
                    for (var n = 0; n < l.length; n++) {
                        if (!l[n] || !h.exists(l[n]) || l[n] === ".") {
                            continue
                        } else {
                            if (l[n] === "..") {
                                k.pop()
                            } else {
                                k.push(l[n])
                            }
                        }
                    }
                    return r + o + "/" + k.join("/")
                };

                function f(k) {
                    return /^(?:(?:https?|file)\:)?\/\//.test(k)
                }
                j.getScriptPath = g.memoize(function(m) {
                    var k = document.getElementsByTagName("script");
                    for (var l = 0; l < k.length; l++) {
                        var n = k[l].src;
                        if (n && n.indexOf(m) >= 0) {
                            return n.substr(0, n.indexOf(m))
                        }
                    }
                    return ""
                });

                function i(k) {
                    return g.some(k, function(l) {
                        return l.nodeName === "parsererror"
                    })
                }
                j.parseXML = function(k) {
                    var l = null;
                    try {
                        if ("DOMParser" in window) {
                            l = (new window.DOMParser()).parseFromString(k, "text/xml");
                            if (i(l.childNodes) || (l.childNodes && i(l.childNodes[0].childNodes))) {
                                l = null
                            }
                        } else {
                            l = new window.ActiveXObject("Microsoft.XMLDOM");
                            l.async = "false";
                            l.loadXML(k)
                        }
                    } catch (m) {}
                    return l
                };
                j.serialize = function(l) {
                    if (l === undefined) {
                        return null
                    }
                    if (typeof l === "string" && l.length < 6) {
                        var k = l.toLowerCase();
                        if (k === "true") {
                            return true
                        }
                        if (k === "false") {
                            return false
                        }
                        if (!isNaN(Number(l)) && !isNaN(parseFloat(l))) {
                            return Number(l)
                        }
                    }
                    return l
                };
                j.parseDimension = function(k) {
                    if (typeof k === "string") {
                        if (k === "") {
                            return 0
                        } else {
                            if (k.lastIndexOf("%") > -1) {
                                return k
                            }
                        }
                        return parseInt(k.replace("px", ""), 10)
                    }
                    return k
                };
                j.timeFormat = function(m, p) {
                    if (m <= 0 && !p) {
                        return "00:00"
                    }
                    var o = (m < 0) ? "-" : "";
                    m = Math.abs(m);
                    var l = Math.floor(m / 3600),
                        n = Math.floor((m - l * 3600) / 60),
                        k = Math.floor(m % 60);
                    return o + (l ? l + ":" : "") + (n < 10 ? "0" : "") + n + ":" + (k < 10 ? "0" : "") + k
                };
                j.adaptiveType = function(l) {
                    if (l !== 0) {
                        var k = -120;
                        if (l <= k) {
                            return "DVR"
                        }
                        if (l < 0 || l === Infinity) {
                            return "LIVE"
                        }
                    }
                    return "VOD"
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(f) {
                var g = {};
                g.exists = function(h) {
                    switch (typeof(h)) {
                        case "string":
                            return (h.length > 0);
                        case "object":
                            return (h !== null);
                        case "undefined":
                            return false
                    }
                    return true
                };
                g.isHTTPS = function() {
                    return (window.location.href.indexOf("https") === 0)
                };
                g.isRtmp = function(h, i) {
                    return (h.indexOf("rtmp") === 0 || i === "rtmp")
                };
                g.isYouTube = function(i, h) {
                    return (h === "youtube") || (/^(http|\/\/).*(youtube\.com|youtu\.be)\/.+/).test(i)
                };
                g.youTubeID = function(i) {
                    var h = (/v[=\/]([^?&]*)|youtu\.be\/([^?]*)|^([\w-]*)$/i).exec(i);
                    if (!h) {
                        return ""
                    }
                    return h.slice(1).join("").replace("?", "")
                };
                g.typeOf = function(i) {
                    if (i === null) {
                        return "null"
                    }
                    var h = typeof i;
                    if (h === "object") {
                        if (f.isArray(i)) {
                            return "array"
                        }
                    }
                    return h
                };
                g.isHLSJSSupport = function(h, i) {
                    if (typeof Hls !== "undefined" && Hls.isSupported() === true && i === "hlsjs") {
                        return true
                    }
                    return false
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(53)], e = function(n, g) {
                var p = function() {};
                var m = false;
                var f = function(t) {
                    var s = document.createElement("a");
                    var r = document.createElement("a");
                    s.href = location.href;
                    try {
                        r.href = t;
                        r.href = r.href;
                        return s.protocol + "//" + s.host !== r.protocol + "//" + r.host
                    } catch (u) {}
                    return true
                };
                var l = function(u, v, r, t) {
                    if (n.isObject(u)) {
                        t = u;
                        u = t.url
                    }
                    var x;
                    var s = n.extend({
                        xhr: null,
                        url: u,
                        withCredentials: false,
                        retryWithoutCredentials: false,
                        timeout: 60000,
                        timeoutId: -1,
                        oncomplete: v || p,
                        onerror: r || p,
                        mimeType: (t && !t.responseType) ? "text/xml" : "",
                        requireValidXML: false,
                        responseType: (t && t.plainText) ? "text" : ""
                    }, t);
                    if ("XDomainRequest" in window && f(u)) {
                        x = s.xhr = new window.XDomainRequest();
                        x.onload = q(s);
                        x.ontimeout = x.onprogress = p;
                        m = true
                    } else {
                        if ("XMLHttpRequest" in window) {
                            x = s.xhr = new window.XMLHttpRequest();
                            x.onreadystatechange = k(s)
                        } else {
                            s.onerror("", u);
                            return
                        }
                    }
                    var y = o("Error loading file", s);
                    x.onerror = y;
                    if ("overrideMimeType" in x) {
                        if (s.mimeType) {
                            x.overrideMimeType(s.mimeType)
                        }
                    } else {
                        m = true
                    }
                    try {
                        u = u.replace(/#.*$/, "");
                        x.open("GET", u, true)
                    } catch (w) {
                        y(w);
                        return x
                    }
                    if (s.responseType) {
                        try {
                            x.responseType = s.responseType
                        } catch (w) {}
                    }
                    if (s.timeout) {
                        s.timeoutId = setTimeout(function() {
                            j(x);
                            s.onerror("Timeout", u, x)
                        }, s.timeout)
                    }
                    try {
                        if (s.withCredentials && "withCredentials" in x) {
                            x.withCredentials = true
                        }
                        x.send()
                    } catch (w) {
                        y(w)
                    }
                    return x
                };

                function j(r) {
                    r.onload = null;
                    r.onprogress = null;
                    r.onreadystatechange = null;
                    r.onerror = null;
                    if ("abort" in r) {
                        r.abort()
                    }
                }

                function o(s, r) {
                    return function(u) {
                        var v = u.currentTarget || r.xhr;
                        clearTimeout(r.timeoutId);
                        if (r.retryWithoutCredentials && r.xhr.withCredentials) {
                            j(v);
                            var t = n.extend({}, r, {
                                xhr: null,
                                withCredentials: false,
                                retryWithoutCredentials: false
                            });
                            l(t);
                            return
                        }
                        r.onerror(s, r.url, v)
                    }
                }

                function k(r) {
                    return function(t) {
                        var u = t.currentTarget || r.xhr;
                        if (u.readyState === 4) {
                            clearTimeout(r.timeoutId);
                            if (u.status >= 400) {
                                var s;
                                if (u.status === 404) {
                                    s = "File not found"
                                } else {
                                    s = "" + u.status + "(" + u.statusText + ")"
                                }
                                return r.onerror(s, r.url, u)
                            }
                            if (u.status === 200) {
                                return q(r)(t)
                            }
                        }
                    }
                }

                function q(r) {
                    return function(v) {
                        var w = v.currentTarget || r.xhr;
                        clearTimeout(r.timeoutId);
                        if (r.responseType) {
                            if (r.responseType === "json") {
                                return h(w, r)
                            }
                        } else {
                            var t = w.responseXML,
                                u;
                            if (t) {
                                try {
                                    u = t.firstChild
                                } catch (s) {}
                            }
                            if (t && u) {
                                return i(w, t, r)
                            }
                            if (m && w.responseText && !t) {
                                t = g.parseXML(w.responseText);
                                if (t && t.firstChild) {
                                    return i(w, t, r)
                                }
                            }
                            if (r.requireValidXML) {
                                r.onerror("Invalid XML", r.url, w);
                                return
                            }
                        }
                        r.oncomplete(w)
                    }
                }

                function h(t, r) {
                    if (!t.response || (n.isString(t.response) && t.responseText.substr(1) !== '"')) {
                        try {
                            t = n.extend({}, t, {
                                response: JSON.parse(t.responseText)
                            })
                        } catch (s) {
                            r.onerror("Invalid JSON", r.url, t);
                            return
                        }
                    }
                    return r.oncomplete(t)
                }

                function i(u, s, r) {
                    var t = s.documentElement;
                    if (r.requireValidXML && (t.nodeName === "parsererror" || t.getElementsByTagName("parsererror").length)) {
                        r.onerror("Invalid XML", r.url, u);
                        return
                    }
                    if (!u.responseXML) {
                        u = n.extend({}, u, {
                            responseXML: s
                        })
                    }
                    return r.oncomplete(u)
                }
                return {
                    ajax: l,
                    crossdomain: f
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(57), d(43), d(54), d(53), d(58)], e = function(j, h, i, k, f) {
                var g = {};
                g.repo = h.memoize(function() {
                    if (true) {
                        return k.getScriptPath("jwplayer.js")
                    }
                    var l = f.split("+")[0];
                    var m = j.repo + l + "/";
                    if (i.isHTTPS()) {
                        return m.replace(/^http:/, "https:")
                    }
                    return m
                });
                g.versionCheck = function(n) {
                    var p = ("0" + n).split(/\W/);
                    var o = f.split(/\W/);
                    var m = parseFloat(p[0]);
                    var l = parseFloat(o[0]);
                    if (m > l) {
                        return false
                    } else {
                        if (m === l) {
                            if (parseFloat("0" + p[1]) > parseFloat(o[1])) {
                                return false
                            }
                        }
                    }
                    return true
                };
                g.loadFrom = function() {
                    if (true) {
                        return k.getScriptPath("jwplayer.js")
                    }
                    return g.repo()
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return {
                    repo: (""),
                    SkinsIncluded: ["seven"],
                    SkinsLoadable: ["beelden", "bekle", "five", "glow", "roundster", "six", "stormtrooper", "vapor"],
                    dvrSeekLimit: -25
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return ("7.4.0+")
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                var g = function(j, h, i) {
                    h = h || this;
                    i = i || [];
                    if (window.jwplayer && window.jwplayer.debug) {
                        return j.apply(h, i)
                    }
                    try {
                        return j.apply(h, i)
                    } catch (k) {
                        return new f(j.name, k)
                    }
                };
                var f = function(i, h) {
                    this.name = i;
                    this.message = h.message || h.toString();
                    this.error = h
                };
                return {
                    tryCatch: g,
                    Error: f
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(f) {
                var g = function() {
                    var h = {};
                    var j = {};
                    var k = {};
                    var i = {};
                    return {
                        start: function(l) {
                            h[l] = f.now();
                            k[l] = k[l] + 1 || 1
                        },
                        end: function(l) {
                            if (!h[l]) {
                                return
                            }
                            var m = f.now() - h[l];
                            j[l] = j[l] + m || m
                        },
                        dump: function() {
                            return {
                                counts: k,
                                sums: j,
                                events: i
                            }
                        },
                        tick: function(l, m) {
                            i[l] = m || f.now()
                        },
                        between: function(m, l) {
                            if (i[l] && i[m]) {
                                return i[l] - i[m]
                            }
                            return -1
                        }
                    }
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return {
                    BUFFERING: "buffering",
                    IDLE: "idle",
                    COMPLETE: "complete",
                    PAUSED: "paused",
                    PLAYING: "playing",
                    ERROR: "error",
                    LOADING: "loading",
                    STALLED: "stalled"
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(71), d(104), d(72), d(43), d(91), d(100), d(75), d(103), d(63), d(46), d(105), d(45), d(74), d(61), d(44), d(161)], e = function(l, f, p, w, u, n, m, s, h, t, r, o, i, j, g, q) {
                function k(y) {
                    return function() {
                        var z = Array.prototype.slice.call(arguments, 0);
                        this.eventsQueue.push([y, z])
                    }
                }

                function v(y) {
                    if (y === j.LOADING || y === j.STALLED) {
                        return j.BUFFERING
                    }
                    return y
                }
                var x = function(y) {
                    this.originalContainer = this.currentContainer = y;
                    this.eventsQueue = [];
                    w.extend(this, o);
                    this._model = new m()
                };
                x.prototype = {
                    play: k("play"),
                    pause: k("pause"),
                    setVolume: k("setVolume"),
                    setMute: k("setMute"),
                    seek: k("seek"),
                    stop: k("stop"),
                    load: k("load"),
                    playlistNext: k("playlistNext"),
                    playlistPrev: k("playlistPrev"),
                    playlistItem: k("playlistItem"),
                    playlistItemChange: k("playlistItemChange"),
                    setFullscreen: k("setFullscreen"),
                    setCurrentCaptions: k("setCurrentCaptions"),
                    setCurrentQuality: k("setCurrentQuality"),
                    setSecondCaptions: k("setSecondCaptions"),
                    setSpeed: k("setSpeed"),
                    setup: function(aa, G) {
                        var E, B, al, J, X = false,
                            aq, au = false,
                            z, F = this;
                        var H = function() {
                            return E.getVideo()
                        };
                        var an = new l(aa);
                        E = this._model.setup(an);
                        B = this._view = new r(G, E);
                        al = new n(G, E);
                        J = new u(G, E, B, am);
                        J.on(g.JWPLAYER_READY, M, this);
                        J.on(g.JWPLAYER_SETUP_ERROR, this.setupError, this);
                        E.mediaController.on(g.JWPLAYER_MEDIA_COMPLETE, function() {
                            w.defer(ac)
                        });
                        E.mediaController.on(g.JWPLAYER_MEDIA_ERROR, this.triggerError, this);
                        E.on("change:flashBlocked", function(aE, aF) {
                            if (!aF) {
                                this._model.set("errorEvent", undefined);
                                return
                            }
                            var aD = !!aE.get("flashThrottle");
                            var aG = {
                                message: aD ? "Click to run Flash" : "Flash plugin failed to load"
                            };
                            if (!aD) {
                                this.trigger(g.JWPLAYER_ERROR, aG)
                            }
                            this._model.set("errorEvent", aG)
                        }, this);

                        function ax() {
                            E.mediaModel.on("change:state", function(aE, aF) {
                                var aD = v(aF);
                                E.set("state", aD)
                            })
                        }
                        ax();
                        E.on("change:mediaModel", ax);

                        function M() {
                            J = null;
                            ae(E.get("item"));
                            E.on("change:state", i, this);
                            E.on("change:castState", function(aE, aD) {
                                F.trigger(g.JWPLAYER_CAST_SESSION, aD)
                            });
                            E.on("change:fullscreen", function(aE, aD) {
                                F.trigger(g.JWPLAYER_FULLSCREEN, {
                                    fullscreen: aD
                                })
                            });
                            E.on("itemReady", function() {
                                F.trigger(g.JWPLAYER_PLAYLIST_ITEM, {
                                    index: E.get("item"),
                                    item: E.get("playlistItem")
                                })
                            });
                            E.on("change:playlist", function(aD, aE) {
                                if (aE.length) {
                                    F.trigger(g.JWPLAYER_PLAYLIST_LOADED, {
                                        playlist: aE
                                    })
                                }
                            });
                            E.on("change:volume", function(aD, aE) {
                                F.trigger(g.JWPLAYER_MEDIA_VOLUME, {
                                    volume: aE
                                })
                            });
                            E.on("change:mute", function(aD, aE) {
                                F.trigger(g.JWPLAYER_MEDIA_MUTE, {
                                    mute: aE
                                })
                            });
                            E.on("change:controls", function(aD, aE) {
                                F.trigger(g.JWPLAYER_CONTROLS, {
                                    controls: aE
                                })
                            });
                            E.on("change:scrubbing", function(aD, aE) {
                                if (aE) {
                                    A()
                                } else {
                                    ad()
                                }
                            });
                            E.on("change:captionsList", function(aD, aE) {
                                F.trigger(g.JWPLAYER_CAPTIONS_LIST, {
                                    tracks: aE,
                                    track: ap()
                                })
                            });
                            E.mediaController.on("all", F.trigger.bind(F));
                            B.on("all", F.trigger.bind(F));
                            this.showView(B.element());
                            window.addEventListener("beforeunload", function() {
                                if (J) {
                                    J.destroy()
                                }
                                if (E) {
                                    E.destroy()
                                }
                            });
                            w.defer(ab)
                        }

                        function ab() {
                            F.trigger(g.JWPLAYER_READY, {
                                setupTime: 0
                            });
                            F.trigger(g.JWPLAYER_PLAYLIST_LOADED, {
                                playlist: E.get("playlist")
                            });
                            F.trigger(g.JWPLAYER_PLAYLIST_ITEM, {
                                index: E.get("item"),
                                item: E.get("playlistItem")
                            });
                            F.trigger(g.JWPLAYER_CAPTIONS_LIST, {
                                tracks: E.get("captionsList"),
                                track: E.get("captionsIndex")
                            });
                            if (E.get("autostart")) {
                                ad({
                                    reason: "autostart"
                                })
                            }
                            while (F.eventsQueue.length > 0) {
                                var aE = F.eventsQueue.shift();
                                var aF = aE[0];
                                var aD = aE[1] || [];
                                F[aF].apply(F, aD)
                            }
                        }

                        function ar(aD) {
                            if (E.get("state") === j.ERROR) {
                                E.set("state", j.IDLE)
                            }
                            S(true);
                            if (E.get("autostart")) {
                                E.once("itemReady", ad)
                            }
                            switch (typeof aD) {
                                case "string":
                                    aw(aD);
                                    break;
                                case "object":
                                    var aE = am(aD);
                                    if (aE) {
                                        ae(0)
                                    }
                                    break;
                                case "number":
                                    ae(aD);
                                    break
                            }
                        }

                        function aw(aE) {
                            var aD = new h();
                            aD.on(g.JWPLAYER_PLAYLIST_LOADED, function(aF) {
                                ar(aF.playlist)
                            });
                            aD.on(g.JWPLAYER_ERROR, function(aF) {
                                aF.message = "Error loading playlist: " + aF.message;
                                this.triggerError(aF)
                            }, this);
                            aD.load(aE)
                        }

                        function T() {
                            var aD = F._instreamAdapter && F._instreamAdapter.getState();
                            if (w.isString(aD)) {
                                return aD
                            }
                            return E.get("state")
                        }

                        function ad(aF) {
                            var aD;
                            if (aF) {
                                E.set("playReason", aF.reason)
                            }
                            if (E.get("state") === j.ERROR) {
                                return
                            }
                            var aE = F._instreamAdapter && F._instreamAdapter.getState();
                            if (w.isString(aE)) {
                                return G.pauseAd(false)
                            }
                            if (E.get("state") === j.COMPLETE) {
                                S(true);
                                ae(0)
                            }
                            if (!X) {
                                X = true;
                                F.trigger(g.JWPLAYER_MEDIA_BEFOREPLAY, {
                                    playReason: E.get("playReason")
                                });
                                X = false;
                                if (z) {
                                    z = false;
                                    aq = null;
                                    return
                                }
                            }
                            if (y()) {
                                if (E.get("playlist").length === 0) {
                                    return false
                                }
                                aD = t.tryCatch(function() {
                                    E.loadVideo()
                                })
                            } else {
                                if (E.get("state") === j.PAUSED) {
                                    aD = t.tryCatch(function() {
                                        E.playVideo()
                                    })
                                }
                            }
                            if (aD instanceof t.Error) {
                                F.triggerError(aD);
                                aq = null;
                                return false
                            }
                            return true
                        }

                        function S(aE) {
                            E.off("itemReady", ad);
                            var aF = !aE;
                            aq = null;
                            var aD = t.tryCatch(function() {
                                E.stopVideo()
                            }, F);
                            if (aD instanceof t.Error) {
                                F.triggerError(aD);
                                return false
                            }
                            if (aF) {
                                au = true
                            }
                            if (X) {
                                z = true
                            }
                            return true
                        }

                        function A() {
                            aq = null;
                            var aE = F._instreamAdapter && F._instreamAdapter.getState();
                            if (w.isString(aE)) {
                                return G.pauseAd(true)
                            }
                            switch (E.get("state")) {
                                case j.ERROR:
                                    return false;
                                case j.PLAYING:
                                case j.BUFFERING:
                                    var aD = t.tryCatch(function() {
                                        H().pause()
                                    }, this);
                                    if (aD instanceof t.Error) {
                                        F.triggerError(aD);
                                        return false
                                    }
                                    break;
                                default:
                                    if (X) {
                                        z = true
                                    }
                            }
                            return true
                        }

                        function y() {
                            var aD = E.get("state");
                            return (aD === j.IDLE || aD === j.COMPLETE || aD === j.ERROR)
                        }

                        function V(aD) {
                            if (E.get("state") === j.ERROR) {
                                return
                            }
                            if (!E.get("scrubbing") && E.get("state") !== j.PLAYING) {
                                ad(true)
                            }
                            H().seek(aD)
                        }

                        function ag(aD, aE) {
                            S(true);
                            ae(aD);
                            ad(aE)
                        }

                        function U(aD) {
                            S(true);
                            ae(aD)
                        }

                        function am(aD) {
                            var aE = s(aD);
                            aE = s.filterPlaylist(aE, E.getProviders(), E.get("androidhls"), E.get("drm"), E.get("preload"), E.get("feedid"));
                            E.set("playlist", aE);
                            if (!w.isArray(aE) || aE.length === 0) {
                                F.triggerError({
                                    message: "Error loading playlist: No playable sources found"
                                });
                                return false
                            }
                            return true
                        }

                        function ae(aD) {
                            var aE = E.get("playlist");
                            aD = parseInt(aD, 10) || 0;
                            aD = (aD + aE.length) % aE.length;
                            E.set("item", aD);
                            E.set("playlistItem", aE[aD]);
                            E.setActiveItem(aE[aD]);
                            al.reloadPlaylistItem(aE[aD]);
                            B.reloadPlaylistItem(aE[aD])
                        }

                        function ah(aD) {
                            ag(E.get("item") - 1, aD || {
                                reason: "external"
                            })
                        }

                        function C(aD) {
                            ag(E.get("item") + 1, aD || {
                                reason: "external"
                            })
                        }

                        function ac() {
                            if (!y()) {
                                return
                            } else {
                                if (au) {
                                    au = false;
                                    return
                                }
                            }
                            aq = ac;
                            var aD = E.get("item");
                            if (aD === E.get("playlist").length - 1) {
                                if (E.get("repeat")) {
                                    C({
                                        reason: "repeat"
                                    })
                                } else {
                                    E.set("state", j.COMPLETE);
                                    F.trigger(g.JWPLAYER_PLAYLIST_COMPLETE, {})
                                }
                                return
                            }
                            C({
                                reason: "playlist"
                            })
                        }

                        function R(aD) {
                            if (H()) {
                                aD = parseInt(aD, 10) || 0;
                                H().setCurrentQuality(aD)
                            }
                        }

                        function I(aD) {
                            var aE = E.get("provider").name;
                            if (aE.indexOf("html5") >= 0) {
                                H().setSpeed(aD);
                                return true
                            }
                            return false
                        }

                        function av() {
                            if (H()) {
                                return H().getCurrentQuality()
                            }
                            return -1
                        }

                        function aC() {
                            if (this._model) {
                                return this._model.getConfiguration()
                            }
                        }

                        function Z() {
                            if (this._model.mediaModel) {
                                return this._model.mediaModel.get("visualQuality")
                            }
                            var aD = at();
                            if (aD) {
                                var aF = av();
                                var aE = aD[aF];
                                if (aE) {
                                    return {
                                        level: w.extend({
                                            index: aF
                                        }, aE),
                                        mode: "",
                                        reason: ""
                                    }
                                }
                            }
                            return null
                        }

                        function at() {
                            if (H()) {
                                return H().getQualityLevels()
                            }
                            return null
                        }

                        function N(aD) {
                            if (H()) {
                                aD = parseInt(aD, 10) || 0;
                                H().setCurrentAudioTrack(aD)
                            }
                        }

                        function ai() {
                            if (H()) {
                                return H().getCurrentAudioTrack()
                            }
                            return -1
                        }

                        function ak() {
                            if (H()) {
                                return H().getAudioTracks()
                            }
                            return null
                        }

                        function aA(aD) {
                            aD = parseInt(aD, 10) || 0;
                            E.persistVideoSubtitleTrack(aD);
                            F.trigger(g.JWPLAYER_CAPTIONS_CHANGED, {
                                tracks: Y(),
                                track: aD
                            })
                        }

                        function af(aD) {
                            if (aD === -1) {
                                B.setCaptionSecond({})
                            } else {
                                B.setCaptionSecond(al.getDataCaption(aD))
                            }
                        }

                        function ap() {
                            return al.getCurrentIndex()
                        }

                        function Y() {
                            return al.getCaptionsList()
                        }

                        function O() {
                            var aE = E.getVideo();
                            if (aE) {
                                var aD = aE.detachMedia();
                                if (aD instanceof HTMLVideoElement) {
                                    return aD
                                }
                            }
                            return null
                        }

                        function D() {
                            var aD = t.tryCatch(function() {
                                E.getVideo().attachMedia()
                            });
                            if (aD instanceof t.Error) {
                                t.log("Error calling _attachMedia", aD);
                                return
                            }
                            if (typeof aq === "function") {
                                aq()
                            }
                        }

                        function L(aD, aE) {
                            if (H()) {
                                H().sendEvent(aD, aE)
                            }
                        }

                        function ay(aD) {
                            if (H() && H().setMouse) {
                                H().setMouse(aD)
                            }
                        }

                        function Q(aD) {
                            B.setCaptionBack(aD)
                        }

                        function W(aD) {
                            B.setCaptionDelay(aD)
                        }

                        function P(aD) {
                            B.setCaptionColor(aD)
                        }

                        function aB(aD) {
                            B.setCaptionLine(aD)
                        }

                        function az(aD) {
                            B.setCaptionSize(aD)
                        }

                        function aj(aD) {
                            B.setCaptionFont(aD)
                        }

                        function ao(aD) {
                            B.setCaptionSecond(al.getDataCaption(aD))
                        }

                        function K() {
                            return B.getCaptionStyle()
                        }
                        this.play = ad;
                        this.pause = A;
                        this.seek = V;
                        this.stop = S;
                        this.load = ar;
                        this.playlistNext = C;
                        this.playlistPrev = ah;
                        this.playlistItem = ag;
                        this.playlistItemChange = U;
                        this.setCurrentCaptions = aA;
                        this.setSecondCaptions = af;
                        this.setCurrentQuality = R;
                        this.setSpeed = I;
                        this.sendEvent = L;
                        this.setMouse = ay;
                        this.setCaptionBack = Q;
                        this.setCaptionDelay = W;
                        this.setCaptionColor = P;
                        this.setCaptionLine = aB;
                        this.setCaptionSize = az;
                        this.setCaptionFont = aj;
                        this.setCaptionSecond = ao;
                        this.getCaptionStyle = K;
                        this.detachMedia = O;
                        this.attachMedia = D;
                        this.getCurrentQuality = av;
                        this.getQualityLevels = at;
                        this.setCurrentAudioTrack = N;
                        this.getCurrentAudioTrack = ai;
                        this.getAudioTracks = ak;
                        this.getCurrentCaptions = ap;
                        this.getCaptionsList = Y;
                        this.getVisualQuality = Z;
                        this.getConfig = aC;
                        this.getState = T;
                        this.setVolume = E.setVolume;
                        this.setMute = E.setMute;
                        this.getProvider = function() {
                            return E.get("provider")
                        };
                        this.getWidth = function() {
                            return E.get("containerWidth")
                        };
                        this.getHeight = function() {
                            return E.get("containerHeight")
                        };
                        this.getContainer = function() {
                            return this.currentContainer
                        };
                        this.resize = B.resize;
                        this.getSafeRegion = B.getSafeRegion;
                        this.setCues = B.addCues;
                        this.setFullscreen = function(aD) {
                            if (!w.isBoolean(aD)) {
                                aD = !E.get("fullscreen")
                            }
                            E.set("fullscreen", aD);
                            if (this._instreamAdapter && this._instreamAdapter._adModel) {
                                this._instreamAdapter._adModel.set("fullscreen", aD)
                            }
                        };
                        this.addButton = function(aD, aG, aJ, aI, aH) {
                            var aE = {
                                img: aD,
                                tooltip: aG,
                                callback: aJ,
                                id: aI,
                                btnClass: aH
                            };
                            var aF = E.get("dock");
                            aF = (aF) ? aF.slice(0) : [];
                            aF = w.reject(aF, w.matches({
                                id: aE.id
                            }));
                            aF.push(aE);
                            E.set("dock", aF)
                        };
                        this.removeButton = function(aE) {
                            var aD = E.get("dock") || [];
                            aD = w.reject(aD, w.matches({
                                id: aE
                            }));
                            E.set("dock", aD)
                        };
                        this.checkBeforePlay = function() {
                            return X
                        };
                        this.getItemQoe = function() {
                            return E._qoeItem
                        };
                        this.setControls = function(aE) {
                            if (!w.isBoolean(aE)) {
                                aE = !E.get("controls")
                            }
                            E.set("controls", aE);
                            var aD = E.getVideo();
                            if (aD) {
                                aD.setControls(aE)
                            }
                        };
                        this.playerDestroy = function() {
                            this.stop();
                            this.showView(this.originalContainer);
                            if (B) {
                                B.destroy()
                            }
                            if (E) {
                                E.destroy()
                            }
                            if (J) {
                                J.destroy();
                                J = null
                            }
                        };
                        this.isBeforePlay = this.checkBeforePlay;
                        this.isBeforeComplete = function() {
                            return E.getVideo().checkComplete()
                        };
                        this.createInstream = function() {
                            this.instreamDestroy();
                            this._instreamAdapter = new p(this, E, B);
                            return this._instreamAdapter
                        };
                        this.skipAd = function() {
                            if (this._instreamAdapter) {
                                this._instreamAdapter.skipAd()
                            }
                        };
                        this.instreamDestroy = function() {
                            if (F._instreamAdapter) {
                                F._instreamAdapter.destroy()
                            }
                        };
                        f(G, this);
                        J.start()
                    },
                    showView: function(y) {
                        if (!document.documentElement.contains(this.currentContainer)) {
                            this.currentContainer = document.getElementById(this._model.get("id"));
                            if (!this.currentContainer) {
                                return
                            }
                        }
                        if (this.currentContainer.parentElement) {
                            this.currentContainer.parentElement.replaceChild(y, this.currentContainer)
                        }
                        this.currentContainer = y
                    },
                    triggerError: function(y) {
                        this._model.set("errorEvent", y);
                        this._model.set("state", j.ERROR);
                        this._model.once("change:state", function() {
                            this._model.set("errorEvent", undefined)
                        }, this);
                        this.trigger(g.JWPLAYER_ERROR, y)
                    },
                    setupError: function(A) {
                        var C = A.message;
                        var z = t.createElement(q(this._model.get("id"), this._model.get("skin"), C));
                        var B = this._model.get("width"),
                            y = this._model.get("height");
                        t.style(z, {
                            width: B.toString().indexOf("%") > 0 ? B : (B + "px"),
                            height: y.toString().indexOf("%") > 0 ? y : (y + "px")
                        });
                        this.showView(z);
                        var D = this;
                        w.defer(function() {
                            D.trigger(g.JWPLAYER_SETUP_ERROR, {
                                message: C
                            })
                        })
                    }
                };
                return x
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(64), d(65), d(46), d(44), d(45), d(43)], e = function(k, j, g, i, f, h) {
                var l = function() {
                    var p = h.extend(this, f);
                    this.load = function(q) {
                        g.ajax(q, o, n)
                    };
                    this.destroy = function() {
                        this.off()
                    };

                    function o(r) {
                        var q = g.tryCatch(function() {
                            var v = r.responseXML ? r.responseXML.childNodes : null;
                            var x = "";
                            var w;
                            if (v) {
                                for (var s = 0; s < v.length; s++) {
                                    x = v[s];
                                    if (x.nodeType !== 8) {
                                        break
                                    }
                                }
                                if (k.localName(x) === "xml") {
                                    x = x.nextSibling
                                }
                                if (k.localName(x) === "rss") {
                                    w = {
                                        playlist: j.parse(x)
                                    }
                                }
                            }
                            if (!w) {
                                try {
                                    var t = JSON.parse(r.responseText);
                                    if (h.isArray(t)) {
                                        w = {
                                            playlist: t
                                        }
                                    } else {
                                        if (h.isArray(t.playlist)) {
                                            w = t
                                        } else {
                                            throw null
                                        }
                                    }
                                } catch (u) {
                                    m("Not a valid RSS/JSON feed");
                                    return
                                }
                            }
                            p.trigger(i.JWPLAYER_PLAYLIST_LOADED, w)
                        });
                        if (q instanceof g.Error) {
                            m()
                        }
                    }

                    function n(q) {
                        m("Playlist load error: " + q)
                    }

                    function m(q) {
                        p.trigger(i.JWPLAYER_ERROR, {
                            message: q ? q : "Error loading file"
                        })
                    }
                };
                return l
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48)], e = function(f) {
                return {
                    localName: function(g) {
                        if (!g) {
                            return ""
                        } else {
                            if (g.localName) {
                                return g.localName
                            } else {
                                if (g.baseName) {
                                    return g.baseName
                                } else {
                                    return ""
                                }
                            }
                        }
                    },
                    textContent: function(g) {
                        if (!g) {
                            return ""
                        } else {
                            if (g.textContent) {
                                return f.trim(g.textContent)
                            } else {
                                if (g.text) {
                                    return f.trim(g.text)
                                } else {
                                    return ""
                                }
                            }
                        }
                    },
                    getChildNode: function(h, g) {
                        return h.childNodes[g]
                    },
                    numChildren: function(g) {
                        if (g.childNodes) {
                            return g.childNodes.length
                        } else {
                            return 0
                        }
                    }
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48), d(64), d(66), d(67), d(68)], e = function(p, o, i, g, n) {
                var j = o.textContent,
                    l = o.getChildNode,
                    k = o.numChildren,
                    h = o.localName;
                var f = {};
                f.parse = function(v) {
                    var q = [];
                    for (var t = 0; t < k(v); t++) {
                        var u = l(v, t),
                            r = h(u).toLowerCase();
                        if (r === "channel") {
                            for (var s = 0; s < k(u); s++) {
                                var w = l(u, s);
                                if (h(w).toLowerCase() === "item") {
                                    q.push(m(w))
                                }
                            }
                        }
                    }
                    return q
                };

                function m(t) {
                    var u = {};
                    for (var r = 0; r < t.childNodes.length; r++) {
                        var s = t.childNodes[r];
                        var q = h(s);
                        if (!q) {
                            continue
                        }
                        switch (q.toLowerCase()) {
                            case "enclosure":
                                u.file = p.xmlAttribute(s, "url");
                                break;
                            case "title":
                                u.title = j(s);
                                break;
                            case "guid":
                                u.mediaid = j(s);
                                break;
                            case "pubdate":
                                u.date = j(s);
                                break;
                            case "description":
                                u.description = j(s);
                                break;
                            case "link":
                                u.link = j(s);
                                break;
                            case "category":
                                if (u.tags) {
                                    u.tags += j(s)
                                } else {
                                    u.tags = j(s)
                                }
                                break
                        }
                    }
                    u = g(t, u);
                    u = i(t, u);
                    return new n(u)
                }
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(64), d(48), d(46)], e = function(i, g, h) {
                var j = "jwplayer";
                var f = function(q, u) {
                    var k = [],
                        s = [],
                        r = g.xmlAttribute,
                        l = "default",
                        v = "label",
                        o = "file",
                        t = "type";
                    for (var p = 0; p < q.childNodes.length; p++) {
                        var n = q.childNodes[p];
                        if (n.prefix === j) {
                            var m = i.localName(n);
                            if (m === "source") {
                                delete u.sources;
                                k.push({
                                    file: r(n, o),
                                    "default": r(n, l),
                                    label: r(n, v),
                                    type: r(n, t)
                                })
                            } else {
                                if (m === "track") {
                                    delete u.tracks;
                                    s.push({
                                        file: r(n, o),
                                        "default": r(n, l),
                                        kind: r(n, "kind"),
                                        label: r(n, v)
                                    })
                                } else {
                                    u[m] = h.serialize(i.textContent(n));
                                    if (m === "file" && u.sources) {
                                        delete u.sources
                                    }
                                }
                            }
                        }
                        if (!u[o]) {
                            u[o] = u.link
                        }
                    }
                    if (k.length) {
                        u.sources = [];
                        for (p = 0; p < k.length; p++) {
                            if (k[p].file.length > 0) {
                                k[p][l] = (k[p][l] === "true") ? true : false;
                                if (!k[p].label.length) {
                                    delete k[p].label
                                }
                                u.sources.push(k[p])
                            }
                        }
                    }
                    if (s.length) {
                        u.tracks = [];
                        for (p = 0; p < s.length; p++) {
                            if (s[p].file.length > 0) {
                                s[p][l] = (s[p][l] === "true") ? true : false;
                                s[p].kind = (!s[p].kind.length) ? "captions" : s[p].kind;
                                if (!s[p].label.length) {
                                    delete s[p].label
                                }
                                u.tracks.push(s[p])
                            }
                        }
                    }
                    return u
                };
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(64), d(48), d(46)], e = function(m, n, l) {
                var h = n.xmlAttribute,
                    g = m.localName,
                    j = m.textContent,
                    k = m.numChildren;
                var i = "media";
                var f = function(t, v) {
                    var s, q, p = "tracks",
                        o = [];

                    function u(w) {
                        var x = {
                            zh: "Chinese",
                            nl: "Dutch",
                            en: "English",
                            fr: "French",
                            de: "German",
                            it: "Italian",
                            ja: "Japanese",
                            pt: "Portuguese",
                            ru: "Russian",
                            es: "Spanish"
                        };
                        if (x[w]) {
                            return x[w]
                        }
                        return w
                    }
                    for (q = 0; q < k(t); q++) {
                        s = t.childNodes[q];
                        if (s.prefix === i) {
                            if (!g(s)) {
                                continue
                            }
                            switch (g(s).toLowerCase()) {
                                case "content":
                                    if (h(s, "duration")) {
                                        v.duration = l.seconds(h(s, "duration"))
                                    }
                                    if (k(s) > 0) {
                                        v = f(s, v)
                                    }
                                    if (h(s, "url")) {
                                        if (!v.sources) {
                                            v.sources = []
                                        }
                                        v.sources.push({
                                            file: h(s, "url"),
                                            type: h(s, "type"),
                                            width: h(s, "width"),
                                            label: h(s, "label")
                                        })
                                    }
                                    break;
                                case "title":
                                    v.title = j(s);
                                    break;
                                case "description":
                                    v.description = j(s);
                                    break;
                                case "guid":
                                    v.mediaid = j(s);
                                    break;
                                case "thumbnail":
                                    if (!v.image) {
                                        v.image = h(s, "url")
                                    }
                                    break;
                                case "player":
                                    break;
                                case "group":
                                    f(s, v);
                                    break;
                                case "subtitle":
                                    var r = {};
                                    r.file = h(s, "url");
                                    r.kind = "captions";
                                    if (h(s, "lang").length > 0) {
                                        r.label = u(h(s, "lang"))
                                    }
                                    o.push(r)
                            }
                        }
                    }
                    if (!v.hasOwnProperty(p)) {
                        v[p] = []
                    }
                    for (q = 0; q < o.length; q++) {
                        v[p].push(o[q])
                    }
                    return v
                };
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(69), d(70)], e = function(f, g, h) {
                var i = {
                    sources: [],
                    tracks: []
                };
                var j = function(l) {
                    l = l || {};
                    if (!f.isArray(l.tracks)) {
                        delete l.tracks
                    }
                    var k = f.extend({}, i, l);
                    if (f.isObject(k.sources) && !f.isArray(k.sources)) {
                        k.sources = [g(k.sources)]
                    }
                    if (!f.isArray(k.sources) || k.sources.length === 0) {
                        if (l.levels) {
                            k.sources = l.levels
                        } else {
                            k.sources = [g(l)]
                        }
                    }
                    for (var m = 0; m < k.sources.length; m++) {
                        var n = k.sources[m];
                        if (!n) {
                            continue
                        }
                        var o = n["default"];
                        if (o) {
                            n["default"] = (o.toString() === "true")
                        } else {
                            n["default"] = false
                        }
                        if (!k.sources[m].label) {
                            k.sources[m].label = m.toString()
                        }
                        k.sources[m] = g(k.sources[m])
                    }
                    k.sources = f.compact(k.sources);
                    if (!f.isArray(k.tracks)) {
                        k.tracks = []
                    }
                    if (f.isArray(k.captions)) {
                        k.tracks = k.tracks.concat(k.captions);
                        delete k.captions
                    }
                    k.tracks = f.compact(f.map(k.tracks, h));
                    return k
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(48), d(43)], e = function(g, f, h) {
                var j = {
                    "default": false
                };
                var i = function(m) {
                    if (!m || !m.file) {
                        return
                    }
                    var k = h.extend({}, j, m);
                    k.file = f.trim("" + k.file);
                    var l = /^[^\/]+\/(?:x-)?([^\/]+)$/;
                    if (g.isYouTube(k.file)) {
                        k.type = "youtube"
                    } else {
                        if (g.isRtmp(k.file)) {
                            k.type = "rtmp"
                        } else {
                            if (l.test(k.type)) {
                                k.type = k.type.replace(l, "$1")
                            } else {
                                if (!k.type) {
                                    k.type = f.extension(k.file)
                                }
                            }
                        }
                    }
                    if (!k.type) {
                        return
                    }
                    switch (k.type) {
                        case "m3u8":
                        case "vnd.apple.mpegurl":
                            k.type = "hls";
                            break;
                        case "dash+xml":
                            k.type = "dash";
                            break;
                        case "smil":
                            k.type = "rtmp";
                            break;
                        case "m4a":
                            k.type = "aac";
                            break;
                        case "hlsjs":
                            k.type = "hlsjs";
                            break
                    }
                    h.each(k, function(o, n) {
                        if (o === "") {
                            delete k[n]
                        }
                    });
                    return k
                };
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43)], e = function(f) {
                var h = {
                    kind: "captions",
                    "default": false
                };
                var g = function(i) {
                    if (!i || !i.file) {
                        return
                    }
                    return f.extend({}, h, i)
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43)], e = function(g, i) {
                var l = {
                    autostart: false,
                    controls: true,
                    displaytitle: true,
                    displaydescription: true,
                    mobilecontrols: false,
                    repeat: false,
                    castAvailable: false,
                    skin: "hdo",
                    stretching: "uniform",
                    mute: false,
                    volume: 90,
                    width: 480,
                    height: 270
                };

                function k(m) {
                    i.each(m, function(o, n) {
                        m[n] = g.serialize(o)
                    })
                }

                function j(m) {
                    if (m.slice && m.slice(-2) === "px") {
                        m = m.slice(0, -2)
                    }
                    return m
                }
                var h = function(n) {
                    var p = i.extend({}, (window.jwplayer || {}).defaults, n);
                    k(p);
                    var m = i.extend({}, l, p);
                    if (m.base === ".") {
                        m.base = g.getScriptPath("jwplayer.js")
                    }
                    m.base = (m.base || g.loadFrom()).replace(/\/?$/, "/");
                    d.p = m.base;
                    m.width = j(m.width);
                    m.height = j(m.height);
                    m.flashplayer = m.flashplayer || g.getScriptPath("jwplayer.js") + "jwplayer.flash.swf";
                    if (window.location.protocol === "http:") {
                        m.flashplayer = m.flashplayer.replace("https", "http")
                    }
                    m.aspectratio = f(m.aspectratio, m.width);
                    if (i.isObject(m.skin)) {
                        m.skinUrl = m.skin.url;
                        m.skinColorInactive = m.skin.inactive;
                        m.skinColorActive = m.skin.active;
                        m.skinColorBackground = m.skin.background;
                        m.skin = i.isString(m.skin.name) ? m.skin.name : l.skin
                    }
                    if (i.isString(m.skin) && m.skin.indexOf(".xml") > 0) {
                        console.log("JW Player does not support XML skins, please update your config");
                        m.skin = m.skin.replace(".xml", "")
                    }
                    if (!m.aspectratio) {
                        delete m.aspectratio
                    }
                    if (!m.playlist) {
                        var o = i.pick(m, ["title", "description", "type", "mediaid", "image", "file", "sources", "tracks", "preload"]);
                        m.playlist = [o]
                    }
                    return m
                };

                function f(n, q) {
                    if (q.toString().indexOf("%") === -1) {
                        return 0
                    }
                    if (typeof n !== "string" || !g.exists(n)) {
                        return 0
                    }
                    if (/^\d*\.?\d+%$/.test(n)) {
                        return n
                    }
                    var o = n.indexOf(":");
                    if (o === -1) {
                        return 0
                    }
                    var m = parseFloat(n.substr(0, o)),
                        p = parseFloat(n.substr(o + 1));
                    if (m <= 0 || p <= 0) {
                        return 0
                    }
                    return (p / m * 100) + "%"
                }
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(73), d(90), d(44), d(61), d(46), d(45), d(43)], e = function(i, h, m, n, j, o, k) {
                function l(q) {
                    var p = q.get("provider").name || "";
                    if (p.indexOf("flash") >= 0) {
                        return h
                    }
                    return i
                }
                var f = {
                    skipoffset: null,
                    tag: null
                };
                var g = function(u, w, t) {
                    var s = l(w);
                    var F = new s(u, w);
                    var B, y, C = 0,
                        E = {},
                        q, A, v;
                    var x = k.bind(function(G) {
                        G = G || {};
                        G.hasControls = !!w.get("controls");
                        this.trigger(m.JWPLAYER_INSTREAM_CLICK, G);
                        if (!F || !F._adModel) {
                            return
                        }
                        if (F._adModel.get("state") === n.PAUSED) {
                            if (G.hasControls) {
                                F.instreamPlay()
                            }
                        } else {
                            F.instreamPause()
                        }
                    }, this);
                    var r = k.bind(function() {
                        if (!F || !F._adModel) {
                            return
                        }
                        if (F._adModel.get("state") === n.PAUSED) {
                            if (w.get("controls")) {
                                u.setFullscreen();
                                u.play()
                            }
                        }
                    }, this);
                    this.type = "instream";
                    this.init = function() {
                        q = w.getVideo();
                        A = w.get("position");
                        v = w.get("playlist")[w.get("item")];
                        F.on("all", p, this);
                        F.on(m.JWPLAYER_MEDIA_TIME, z, this);
                        F.on(m.JWPLAYER_MEDIA_COMPLETE, D, this);
                        F.init();
                        q.detachMedia();
                        w.mediaModel.set("state", n.BUFFERING);
                        if (u.checkBeforePlay() || (A === 0 && !q.checkComplete())) {
                            A = 0;
                            w.set("preInstreamState", "instream-preroll")
                        } else {
                            if (q && q.checkComplete() || w.get("state") === n.COMPLETE) {
                                w.set("preInstreamState", "instream-postroll")
                            } else {
                                w.set("preInstreamState", "instream-midroll")
                            }
                        }
                        var G = w.get("state");
                        if (G === n.PLAYING || G === n.BUFFERING) {
                            q.pause()
                        }
                        t.setupInstream(F._adModel);
                        F._adModel.set("state", n.BUFFERING);
                        t.clickHandler().setAlternateClickHandlers(j.noop, null);
                        this.setText("Loading ad");
                        return this
                    };

                    function p(G, H) {
                        H = H || {};
                        if (E.tag && !H.tag) {
                            H.tag = E.tag
                        }
                        this.trigger(G, H)
                    }

                    function z(G) {
                        F._adModel.set("duration", G.duration);
                        F._adModel.set("position", G.position)
                    }

                    function D(I) {
                        if (B && C + 1 < B.length) {
                            F._adModel.set("state", "buffering");
                            w.set("skipButton", false);
                            C++;
                            var H = B[C];
                            var G;
                            if (y) {
                                G = y[C]
                            }
                            this.loadItem(H, G)
                        } else {
                            if (I.type === m.JWPLAYER_MEDIA_COMPLETE) {
                                p.call(this, I.type, I);
                                this.trigger(m.JWPLAYER_PLAYLIST_COMPLETE, {})
                            }
                            this.destroy()
                        }
                    }
                    this.loadItem = function(H, G) {
                        if (j.isAndroid(2.3)) {
                            this.trigger({
                                type: m.JWPLAYER_ERROR,
                                message: "Error loading instream: Cannot play instream on Android 2.3"
                            });
                            return
                        }
                        if (k.isArray(H)) {
                            B = H;
                            y = G;
                            H = B[C];
                            if (y) {
                                G = y[C]
                            }
                        }
                        this.trigger(m.JWPLAYER_PLAYLIST_ITEM, {
                            index: C,
                            item: H
                        });
                        H.type = "mp4";
                        if (!H.sources) {
                            H.sources = [{
                                file: H.file,
                                type: H.type
                            }]
                        }
                        E = k.extend({}, f, G);
                        F.load(H);
                        this.addClickHandler();
                        var I = H.skipoffset || E.skipoffset;
                        if (I) {
                            F._adModel.set("skipMessage", E.skipMessage);
                            F._adModel.set("skipText", E.skipText);
                            F._adModel.set("skipOffset", I);
                            w.set("skipButton", true)
                        }
                    };
                    this.applyProviderListeners = function(G) {
                        F.applyProviderListeners(G);
                        this.addClickHandler()
                    };
                    this.play = function() {
                        F.instreamPlay()
                    };
                    this.pause = function() {
                        F.instreamPause()
                    };
                    this.hide = function() {
                        F.hide()
                    };
                    this.addClickHandler = function() {
                        t.clickHandler().setAlternateClickHandlers(x, r);
                        F.on(m.JWPLAYER_MEDIA_META, this.metaHandler, this)
                    };
                    this.skipAd = function(G) {
                        var H = m.JWPLAYER_AD_SKIPPED;
                        this.trigger(H, G);
                        D.call(this, {
                            type: H
                        })
                    };
                    this.metaHandler = function(G) {
                        if (G.width && G.height) {
                            t.resizeMedia()
                        }
                    };
                    this.destroy = function() {
                        this.off();
                        w.set("skipButton", false);
                        if (F) {
                            if (t.clickHandler()) {
                                t.clickHandler().revertAlternateClickHandlers()
                            }
                            F.instreamDestroy();
                            t.destroyInstream();
                            F = null;
                            u.attachMedia();
                            var G = w.get("preInstreamState");
                            switch (G) {
                                case "instream-preroll":
                                case "instream-midroll":
                                    var H = k.extend({}, v);
                                    H.starttime = A;
                                    w.loadVideo(H);
                                    if (j.isMobile() && (w.mediaModel.get("state") === n.BUFFERING)) {
                                        q.setState(n.BUFFERING)
                                    }
                                    q.play();
                                    break;
                                case "instream-postroll":
                                case "instream-idle":
                                    q.stop();
                                    break
                            }
                        }
                    };
                    this.getState = function() {
                        if (F && F._adModel) {
                            return F._adModel.get("state")
                        }
                        return false
                    };
                    this.setText = function(G) {
                        t.setAltText(G ? G : "")
                    };
                    this.hide = function() {
                        t.useExternalControls()
                    }
                };
                k.extend(g.prototype, o);
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(45), d(74), d(44), d(61), d(75)], e = function(h, f, j, i, g, l) {
                var k = function(o, s) {
                    var p, m, r = h.extend(this, f);
                    o.on(i.JWPLAYER_FULLSCREEN, function(v) {
                        this.trigger(i.JWPLAYER_FULLSCREEN, v)
                    }, r);
                    this.init = function() {
                        p = new l().setup({
                            id: s.get("id"),
                            volume: s.get("volume"),
                            fullscreen: s.get("fullscreen"),
                            mute: s.get("mute")
                        });
                        p.on("fullscreenchange", t);
                        this._adModel = p
                    };
                    r.load = function(v) {
                        p.set("item", 0);
                        p.set("playlistItem", v);
                        p.setActiveItem(v);
                        q();
                        p.off(i.JWPLAYER_ERROR);
                        p.on(i.JWPLAYER_ERROR, function(w) {
                            this.trigger(i.JWPLAYER_ERROR, w)
                        }, r);
                        p.loadVideo(v)
                    };
                    r.applyProviderListeners = function(v) {
                        q(v);
                        v.off(i.JWPLAYER_ERROR);
                        v.on(i.JWPLAYER_ERROR, function(w) {
                            this.trigger(i.JWPLAYER_ERROR, w)
                        }, r);
                        s.on("change:volume", function(x, w) {
                            m.volume(w)
                        }, r);
                        s.on("change:mute", function(x, w) {
                            m.mute(w)
                        }, r)
                    };
                    this.instreamDestroy = function() {
                        if (!p) {
                            return
                        }
                        p.off();
                        this.off();
                        if (m) {
                            m.detachMedia();
                            m.off();
                            if (p.getVideo()) {
                                m.destroy()
                            }
                        }
                        p = null;
                        o.off(null, null, this);
                        o = null
                    };
                    r.instreamPlay = function() {
                        if (!p.getVideo()) {
                            return
                        }
                        p.getVideo().play(true)
                    };
                    r.instreamPause = function() {
                        if (!p.getVideo()) {
                            return
                        }
                        p.getVideo().pause(true)
                    };

                    function q(v) {
                        var w = v || p.getVideo();
                        if (m !== w) {
                            m = w;
                            if (!w) {
                                return
                            }
                            w.off();
                            w.on("all", function(x, y) {
                                y = h.extend({}, y, {
                                    type: x
                                });
                                this.trigger(x, y)
                            }, r);
                            w.on(i.JWPLAYER_MEDIA_BUFFER_FULL, n);
                            w.on(i.JWPLAYER_PLAYER_STATE, u);
                            w.attachMedia();
                            w.volume(s.get("volume"));
                            w.mute(s.get("mute"));
                            p.on("change:state", j, r)
                        }
                    }

                    function u(v) {
                        switch (v.newstate) {
                            case g.PLAYING:
                                p.set("state", v.newstate);
                                break;
                            case g.PAUSED:
                                p.set("state", v.newstate);
                                break
                        }
                    }

                    function t(v) {
                        s.trigger(v.type, v);
                        r.trigger(i.JWPLAYER_FULLSCREEN, {
                            fullscreen: v.jwstate
                        })
                    }

                    function n() {
                        p.getVideo().play()
                    }
                    return r
                };
                return k
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(61)], e = function(f) {
                function g(h) {
                    if (h === f.COMPLETE || h === f.ERROR) {
                        return f.IDLE
                    }
                    return h
                }
                return function(j, i, l) {
                    i = g(i);
                    l = g(l);
                    if (i !== l) {
                        var k = i.replace(/(?:ing|d)$/, "");
                        var h = {
                            type: k,
                            newstate: i,
                            oldstate: l,
                            reason: j.mediaModel.get("state")
                        };
                        if (k === "play") {
                            h.playReason = j.get("playReason")
                        }
                        this.trigger(k, h)
                    }
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(76), d(87), d(88), d(43), d(45), d(89), d(44), d(61)], e = function(l, j, q, f, m, p, i, o, n) {
                var k = ["volume", "mute", "captionLabel", "qualityLabel"];
                var h = function() {
                    var v = this,
                        r, u, t = l.noop;
                    this.mediaController = m.extend({}, p);
                    this.mediaModel = new g();
                    f.model(this);
                    this.set("mediaModel", this.mediaModel);
                    this.setup = function(w) {
                        var x = new q();
                        x.track(k, this);
                        if (!w.item) {
                            w.item = 0
                        }
                        m.extend(this.attributes, x.getAllItems(), w, {
                            state: n.IDLE,
                            flashBlocked: false,
                            fullscreen: false,
                            compactUI: false,
                            scrubbing: false,
                            duration: 0,
                            position: 0,
                            buffer: 0
                        });
                        if (l.isMobile() && !w.mobileSdk) {
                            this.set("autostart", false)
                        }
                        this.updateProviders();
                        return this
                    };
                    this.getConfiguration = function() {
                        return m.omit(this.clone(), ["mediaModel"])
                    };
                    this.updateProviders = function() {
                        r = new j(this.getConfiguration())
                    };

                    function s(y, z) {
                        switch (y) {
                            case "flashThrottle":
                                var x = (z.state !== "resume");
                                this.set("flashThrottle", x);
                                this.set("flashBlocked", x);
                                break;
                            case "flashBlocked":
                                this.set("flashBlocked", true);
                                return;
                            case "flashUnblocked":
                                this.set("flashBlocked", false);
                                return;
                            case "volume":
                            case "mute":
                                this.set(y, z[y]);
                                return;
                            case o.JWPLAYER_MEDIA_TYPE:
                                this.mediaModel.set("mediaType", z.mediaType);
                                break;
                            case o.JWPLAYER_PLAYER_STATE:
                                this.mediaModel.set("state", z.newstate);
                                return;
                            case o.JWPLAYER_MEDIA_BUFFER:
                                this.set("buffer", z.bufferPercent);
                            case o.JWPLAYER_MEDIA_META:
                                var A = z.duration;
                                if (m.isNumber(A)) {
                                    this.mediaModel.set("duration", A);
                                    this.set("duration", A)
                                }
                                break;
                            case o.JWPLAYER_MEDIA_BUFFER_FULL:
                                if (this.mediaModel.get("playAttempt")) {
                                    this.playVideo()
                                } else {
                                    this.mediaModel.on("change:playAttempt", function() {
                                        this.playVideo()
                                    }, this)
                                }
                                break;
                            case o.JWPLAYER_MEDIA_TIME:
                                this.mediaModel.set("position", z.position);
                                this.set("position", z.position);
                                if (m.isNumber(z.duration)) {
                                    this.mediaModel.set("duration", z.duration);
                                    this.set("duration", z.duration)
                                }
                                break;
                            case o.JWPLAYER_PROVIDER_CHANGED:
                                this.set("provider", u.getName());
                                break;
                            case o.JWPLAYER_MEDIA_LEVELS:
                                this.setQualityLevel(z.currentQuality, z.levels);
                                this.mediaModel.set("levels", z.levels);
                                break;
                            case o.JWPLAYER_MEDIA_LEVEL_CHANGED:
                                this.setQualityLevel(z.currentQuality, z.levels);
                                this.persistQualityLevel(z.currentQuality, z.levels);
                                break;
                            case o.JWPLAYER_AUDIO_TRACKS:
                                this.setCurrentAudioTrack(z.currentTrack, z.tracks);
                                this.mediaModel.set("audioTracks", z.tracks);
                                break;
                            case o.JWPLAYER_AUDIO_TRACK_CHANGED:
                                this.setCurrentAudioTrack(z.currentTrack, z.tracks);
                                break;
                            case "subtitlesTrackChanged":
                                this.setVideoSubtitleTrack(z.currentTrack, z.tracks);
                                break;
                            case "visualQuality":
                                var B = m.extend({}, z);
                                this.mediaModel.set("visualQuality", B);
                                break
                        }
                        var w = m.extend({}, z, {
                            type: y
                        });
                        this.mediaController.trigger(y, w)
                    }
                    this.setQualityLevel = function(x, w) {
                        if (x > -1 && w.length > 1 && u.getName().name !== "youtube") {
                            this.mediaModel.set("currentLevel", parseInt(x))
                        }
                    };
                    this.persistQualityLevel = function(z, x) {
                        var y = x[z] || {};
                        var w = y.label;
                        this.set("qualityLabel", w)
                    };
                    this.setCurrentAudioTrack = function(x, w) {
                        if (x > -1 && w.length > 0 && x < w.length) {
                            this.mediaModel.set("currentAudioTrack", parseInt(x))
                        }
                    };
                    this.onMediaContainer = function() {
                        var w = this.get("mediaContainer");
                        t.setContainer(w)
                    };
                    this.changeVideoProvider = function(x) {
                        this.off("change:mediaContainer", this.onMediaContainer);
                        if (u) {
                            u.off(null, null, this);
                            if (u.getContainer()) {
                                u.remove()
                            }
                        }
                        t = new x(v.get("id"), v.getConfiguration());
                        var w = this.get("mediaContainer");
                        if (w) {
                            t.setContainer(w)
                        } else {
                            this.once("change:mediaContainer", this.onMediaContainer)
                        }
                        this.set("provider", t.getName());
                        if (t.getName().name.indexOf("flash") === -1) {
                            this.set("flashThrottle", undefined);
                            this.set("flashBlocked", false)
                        }
                        u = t;
                        u.volume(v.get("volume"));
                        u.mute(v.get("mute"));
                        u.on("all", s, this)
                    };
                    this.destroy = function() {
                        this.off();
                        if (u) {
                            u.off(null, null, this);
                            u.destroy()
                        }
                    };
                    this.getVideo = function() {
                        return u
                    };
                    this.setFullscreen = function(w) {
                        w = !!w;
                        if (w !== v.get("fullscreen")) {
                            v.set("fullscreen", w)
                        }
                    };
                    this.chooseProvider = function(w) {
                        return r.choose(w).provider
                    };
                    this.setActiveItem = function(w) {
                        this.mediaModel.off();
                        this.mediaModel = new g();
                        this.set("mediaModel", this.mediaModel);
                        var x = w && w.sources && w.sources[0];
                        if (x === undefined) {
                            return
                        }
                        var y = this.chooseProvider(x);
                        if (!y) {
                            throw new Error("No suitable provider found")
                        }
                        if (!(t instanceof y)) {
                            v.changeVideoProvider(y)
                        }
                        if (t.init) {
                            t.init(w)
                        }
                        this.trigger("itemReady", w)
                    };
                    this.getProviders = function() {
                        return r
                    };
                    this.resetProvider = function() {
                        t = null
                    };
                    this.setVolume = function(w) {
                        w = Math.round(w);
                        v.set("volume", w);
                        if (u) {
                            u.volume(w)
                        }
                        var x = (w === 0);
                        if (x !== v.get("mute")) {
                            v.setMute(x)
                        }
                    };
                    this.setMute = function(x) {
                        if (!l.exists(x)) {
                            x = !v.get("mute")
                        }
                        v.set("mute", x);
                        if (u) {
                            u.mute(x)
                        }
                        if (!x) {
                            var w = Math.max(10, v.get("volume"));
                            this.setVolume(w)
                        }
                    };
                    this.loadVideo = function(x) {
                        this.mediaModel.set("playAttempt", true);
                        this.mediaController.trigger(o.JWPLAYER_MEDIA_PLAY_ATTEMPT, {
                            playReason: this.get("playReason")
                        });
                        if (!x) {
                            var w = this.get("item");
                            x = this.get("playlist")[w]
                        }
                        this.set("position", x.starttime || 0);
                        this.set("duration", x.duration || 0);
                        u.load(x)
                    };
                    this.stopVideo = function() {
                        if (u) {
                            u.stop()
                        }
                    };
                    this.playVideo = function() {
                        u.play()
                    };
                    this.persistCaptionsTrack = function() {
                        var w = this.get("captionsTrack");
                        if (w) {
                            this.set("captionLabel", w.label)
                        } else {
                            this.set("captionLabel", "Off")
                        }
                    };
                    this.setVideoSubtitleTrack = function(x, w) {
                        this.set("captionsIndex", x);
                        if (x && w && x <= w.length && w[x - 1].data) {
                            this.set("captionsTrack", w[x - 1])
                        }
                        if (u && u.setSubtitlesTrack) {
                            u.setSubtitlesTrack(x)
                        }
                    };
                    this.persistVideoSubtitleTrack = function(w) {
                        this.setVideoSubtitleTrack(w);
                        this.persistCaptionsTrack()
                    }
                };
                var g = h.MediaModel = function() {
                    this.set("state", n.IDLE)
                };
                m.extend(h.prototype, i);
                m.extend(g.prototype, i);
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(77), d(78), d(80), d(43)], e = function(f, j, i, g) {
                function h(k) {
                    this.providers = j.slice();
                    this.config = k || {};
                    this.reorderProviders()
                }
                h.registerProvider = function(n) {
                    var k;
                    try {
                        k = n.getName().name
                    } catch (m) {
                        k = "flash"
                    }
                    if (i[k]) {
                        return
                    }
                    if (!g.find(j, g.matches({
                            name: k
                        }))) {
                        if (!g.isFunction(n.supports)) {
                            throw {
                                message: "Tried to register a provider with an invalid object"
                            }
                        }
                        j.unshift({
                            name: k,
                            supports: n.supports
                        })
                    }
                    var l = function() {};
                    l.prototype = f;
                    n.prototype = new l();
                    i[k] = n
                };
                h.load = function(k) {
                    return Promise.all(g.map(k, function(l) {
                        return new Promise(function(m) {
                            switch (l.name) {
                                case "html5":
                                    !(function(n) {
                                        m(d(81))
                                    }(d));
                                    break;
                                case "flash":
                                    !(function(n) {
                                        m(d(82))
                                    }(d));
                                    break;
                                case "youtube":
                                    d.e(1, function(n) {
                                        m(d(84))
                                    });
                                    break;
                                case "hlsjs":
                                    d.e(2, function(n) {
                                        m(d(86))
                                    });
                                    break;
                                default:
                                    m()
                            }
                        }).then(function(m) {
                            if (!m) {
                                return
                            }
                            h.registerProvider(m)
                        })
                    }))
                };
                g.extend(h.prototype, {
                    reorderProviders: function() {
                        if (this.config.primary === "flash") {
                            var m = g.indexOf(this.providers, g.findWhere(this.providers, {
                                name: "flash"
                            }));
                            var k = this.providers.splice(m, 1)[0];
                            var l = g.indexOf(this.providers, g.findWhere(this.providers, {
                                name: "html5"
                            }));
                            this.providers.splice(l, 0, k)
                        }
                    },
                    providerSupports: function(l, k) {
                        return l.supports(k)
                    },
                    required: function(l, k) {
                        l = l.slice();
                        return g.compact(g.map(this.providers, function(q) {
                            var n = false;
                            for (var o = l.length; o--;) {
                                var p = l[o];
                                var m = q.supports(p.sources[0], k);
                                if (m) {
                                    l.splice(o, 1)
                                }
                                n = n || m
                            }
                            if (n) {
                                return q
                            }
                        }))
                    },
                    choose: function(n) {
                        n = g.isObject(n) ? n : {};
                        var m = this.providers.length;
                        for (var l = 0; l < m; l++) {
                            var o = this.providers[l];
                            if (this.providerSupports(o, n)) {
                                var k = m - l - 1;
                                return {
                                    priority: k,
                                    name: o.name,
                                    type: n.type,
                                    provider: i[o.name]
                                }
                            }
                        }
                        return null
                    }
                });
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(44), d(61), d(43)], e = function(f, k, g, h) {
                var l = f.noop,
                    j = h.constant(false);
                var i = {
                    supports: j,
                    play: l,
                    load: l,
                    stop: l,
                    volume: l,
                    mute: l,
                    seek: l,
                    resize: l,
                    remove: l,
                    destroy: l,
                    setVisibility: l,
                    setFullscreen: j,
                    getFullscreen: l,
                    getContainer: l,
                    setContainer: j,
                    getName: l,
                    getQualityLevels: l,
                    getCurrentQuality: l,
                    setCurrentQuality: l,
                    getAudioTracks: l,
                    getCurrentAudioTrack: l,
                    setCurrentAudioTrack: l,
                    checkComplete: l,
                    setControls: l,
                    attachMedia: l,
                    detachMedia: l,
                    setState: function(n) {
                        var m = this.state || g.IDLE;
                        this.state = n;
                        if (n === m) {
                            return
                        }
                        this.trigger(k.JWPLAYER_PLAYER_STATE, {
                            newstate: n
                        })
                    },
                    sendMediaType: function(o) {
                        var n = o[0].type;
                        var m = (n === "oga" || n === "aac" || n === "mp3" || n === "mpeg" || n === "vorbis");
                        this.trigger(k.JWPLAYER_MEDIA_TYPE, {
                            mediaType: m ? "audio" : "video"
                        })
                    }
                };
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43), d(79)], e = function(g, h, i) {
                function f(k) {
                    if (k.type === "hls") {
                        if (k.androidhls !== false) {
                            var l = g.isAndroidNative;
                            if (l(2) || l(3) || l("4.0")) {
                                return false
                            } else {
                                if (g.isAndroid()) {
                                    return true
                                }
                            }
                        } else {
                            if (g.isAndroid()) {
                                return false
                            }
                        }
                    }
                    return null
                }
                var j = [{
                    name: "youtube",
                    supports: function(k) {
                        return (g.isYouTube(k.file, k.type))
                    }
                }, {
                    name: "hlsjs",
                    supports: function(k) {
                        return (g.isHLSJSSupport(k.file, k.type))
                    }
                }, {
                    name: "html5",
                    supports: function(p) {
                        var o = {
                            aac: "audio/mp4",
                            mp4: "video/mp4",
                            f4v: "video/mp4",
                            m4v: "video/mp4",
                            mov: "video/mp4",
                            mp3: "audio/mpeg",
                            mpeg: "audio/mpeg",
                            ogv: "video/ogg",
                            ogg: "video/ogg",
                            oga: "video/ogg",
                            vorbis: "video/ogg",
                            webm: "video/webm",
                            f4a: "video/aac",
                            m3u8: "application/vnd.apple.mpegurl",
                            m3u: "application/vnd.apple.mpegurl",
                            hls: "application/vnd.apple.mpegurl"
                        };
                        var m = p.file;
                        var n = p.type;
                        var l = f(p);
                        if (l !== null) {
                            return l
                        }
                        if (g.isRtmp(m, n)) {
                            return false
                        }
                        if (!o[n]) {
                            return false
                        }
                        if (i.canPlayType) {
                            var k = i.canPlayType(o[n]);
                            return !!k
                        }
                        return false
                    }
                }, {
                    name: "flash",
                    supports: function(n) {
                        var o = {
                            flv: "video",
                            f4v: "video",
                            mov: "video",
                            m4a: "video",
                            m4v: "video",
                            mp4: "video",
                            aac: "video",
                            f4a: "video",
                            mp3: "sound",
                            mpeg: "sound",
                            smil: "rtmp",
                            m3u8: "hls",
                            hls: "hls",
                            drive: "drive",
                            youtube: "youtube",
                            google: "google"
                        };
                        var k = h.keys(o);
                        if (!g.isFlashSupported()) {
                            return false
                        }
                        var l = n.file;
                        var m = n.type;
                        if (g.isRtmp(l, m)) {
                            return true
                        }
                        return h.contains(k, m)
                    }
                }];
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return document.createElement("video")
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(81), d(82)], e = function(f, g) {
                var h = {
                    html5: f,
                    flash: g
                };
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(52), d(46), d(50), d(43), d(44), d(61), d(77), d(45)], e = function(r, x, s, C, f, j, i, o) {
                var g = window.clearTimeout,
                    m = 256,
                    k = x.isIE(),
                    B = x.isMSIE(),
                    t = x.isMobile(),
                    q = x.isFF(),
                    l = x.isAndroidNative(),
                    w = x.isIOS(7),
                    v = x.isIOS(8),
                    p = "html5";

                function D(F, E) {
                    x.foreach(F, function(G, H) {
                        E.addEventListener(G, H, false)
                    })
                }

                function y(F, E) {
                    x.foreach(F, function(G, H) {
                        E.removeEventListener(G, H, false)
                    })
                }

                function u(E, F, G) {
                    if ("addEventListener" in E) {
                        E.addEventListener(F, G)
                    } else {
                        E["on" + F] = G
                    }
                }

                function A(E, F, G) {
                    if (!E) {
                        return
                    }
                    if ("removeEventListener" in E) {
                        E.removeEventListener(F, G)
                    } else {
                        E["on" + F] = null
                    }
                }

                function z(E) {
                    if (E.type === "hls") {
                        if (E.androidhls !== false) {
                            var F = x.isAndroidNative;
                            if (F(2) || F(3) || F("4.0")) {
                                return false
                            } else {
                                if (x.isAndroid()) {
                                    return true
                                }
                            }
                        } else {
                            if (x.isAndroid()) {
                                return false
                            }
                        }
                    }
                    return null
                }

                function h(aw, P) {
                    this.state = j.IDLE;
                    this.seeking = false;
                    C.extend(this, o);
                    this.trigger = function(a7, a6) {
                        if (!aa) {
                            return
                        }
                        return o.trigger.call(this, a7, a6)
                    };
                    this.setState = function(a6) {
                        if (!aa) {
                            return
                        }
                        return i.setState.call(this, a6)
                    };
                    var V = this,
                        E = {
                            click: Z,
                            durationchange: aN,
                            ended: ar,
                            error: aK,
                            loadstart: aD,
                            loadeddata: W,
                            loadedmetadata: aP,
                            canplay: aS,
                            playing: ac,
                            progress: ap,
                            pause: G,
                            seeked: T,
                            timeupdate: aL,
                            volumechange: X,
                            webkitbeginfullscreen: az,
                            webkitendfullscreen: aB
                        },
                        aX, a2, Y, J = false,
                        aZ, aO = 0,
                        H = -1,
                        R = -1,
                        aa = true,
                        aF, ad = -1,
                        N = null,
                        a5 = !!P.sdkplatform,
                        aq = false,
                        an = false,
                        au = null,
                        I = null,
                        aj = -1,
                        ae = -1,
                        F = -1,
                        O = null,
                        aW = {
                            level: {}
                        };
                    var a4 = document.getElementById(aw);
                    var ai = (a4) ? a4.querySelector("video") : undefined;
                    ai = ai || document.createElement("video");
                    ai.className = "jw-video jw-reset";
                    if (C.isObject(P.cast) && P.cast.appid) {
                        ai.setAttribute("disableRemotePlayback", "")
                    }
                    D(E, ai);
                    if (!w) {
                        ai.controls = true;
                        ai.controls = false
                    }
                    ai.setAttribute("x-webkit-airplay", "allow");
                    ai.setAttribute("webkit-playsinline", "");

                    function W() {
                        if (!aa) {
                            return
                        }
                        ah(ai.audioTracks);
                        aV(ai.textTracks);
                        ai.setAttribute("jw-loaded", "data")
                    }

                    function aD() {
                        if (!aa) {
                            return
                        }
                        ai.setAttribute("jw-loaded", "started")
                    }

                    function Z(a6) {
                        V.trigger("click", a6)
                    }

                    function aN() {
                        if (!aa || N) {
                            return
                        }
                        am(aH());
                        aJ(aG(), Y, a2)
                    }

                    function ap() {
                        if (!aa) {
                            return
                        }
                        aJ(aG(), Y, a2)
                    }

                    function aL() {
                        g(H);
                        J = true;
                        if (!aa) {
                            return
                        }
                        if (V.state === j.STALLED) {
                            V.setState(j.PLAYING)
                        } else {
                            if (V.state === j.PLAYING) {
                                H = setTimeout(K, m)
                            }
                        }
                        if (N && (ai.duration === Infinity) && (ai.currentTime === 0)) {
                            return
                        }
                        am(aH());
                        aM(ai.currentTime);
                        aJ(aG(), Y, a2);
                        if (V.state === j.PLAYING) {
                            V.trigger(f.JWPLAYER_MEDIA_TIME, {
                                position: Y,
                                duration: a2
                            });
                            at()
                        }
                    }

                    function at() {
                        var a6 = aW.level;
                        if (a6.width !== ai.videoWidth || a6.height !== ai.videoHeight) {
                            a6.width = ai.videoWidth;
                            a6.height = ai.videoHeight;
                            U();
                            if (!a6.width || !a6.height) {
                                return
                            }
                            aW.reason = aW.reason || "auto";
                            aW.mode = aF[ad].type === "hls" ? "auto" : "manual";
                            aW.bitrate = 0;
                            a6.index = ad;
                            a6.label = aF[ad].label;
                            V.trigger("visualQuality", aW);
                            aW.reason = ""
                        }
                    }

                    function aJ(a6, a7, a8) {
                        if (a6 !== R || a8 !== a2) {
                            R = a6;
                            V.trigger(f.JWPLAYER_MEDIA_BUFFER, {
                                bufferPercent: a6 * 100,
                                position: a7,
                                duration: a8
                            })
                        }
                    }

                    function aM(a6) {
                        if (a2 < 0) {
                            a6 = -(a3() - a6)
                        }
                        Y = a6
                    }

                    function aH() {
                        var a8 = ai.duration;
                        var a6 = a3();
                        if (a8 === Infinity && a6) {
                            var a7 = a6 - ai.seekable.start(0);
                            if (a7 !== Infinity && a7 > 120) {
                                a8 = -a7
                            }
                        }
                        return a8
                    }

                    function am(a6) {
                        a2 = a6;
                        if (aO && a6 && a6 !== Infinity) {
                            V.seek(aO)
                        }
                    }

                    function ab() {
                        var a6 = aH();
                        if (N && a6 === Infinity) {
                            a6 = 0
                        }
                        V.trigger(f.JWPLAYER_MEDIA_META, {
                            duration: a6,
                            height: ai.videoHeight,
                            width: ai.videoWidth
                        });
                        am(a6)
                    }

                    function aS() {
                        if (!aa) {
                            return
                        }
                        J = true;
                        if (!N) {
                            U()
                        }
                        S()
                    }

                    function aP() {
                        if (!aa) {
                            return
                        }
                        if (ai.muted) {
                            ai.muted = false;
                            ai.muted = true
                        }
                        ai.setAttribute("jw-loaded", "meta");
                        ab()
                    }

                    function S() {
                        if (!aZ) {
                            aZ = true;
                            V.trigger(f.JWPLAYER_MEDIA_BUFFER_FULL)
                        }
                    }

                    function ac() {
                        V.setState(j.PLAYING);
                        if (!ai.hasAttribute("jw-played")) {
                            ai.setAttribute("jw-played", "")
                        }
                        V.trigger(f.JWPLAYER_PROVIDER_FIRST_FRAME, {})
                    }

                    function G() {
                        if (V.state === j.COMPLETE) {
                            return
                        }
                        if (ai.currentTime === ai.duration) {
                            return
                        }
                        V.setState(j.PAUSED)
                    }

                    function a0() {
                        if (N) {
                            return
                        }
                        if (ai.paused || ai.ended) {
                            return
                        }
                        if (V.state === j.LOADING || V.state === j.ERROR) {
                            return
                        }
                        if (V.seeking) {
                            return
                        }
                        V.setState(j.STALLED)
                    }

                    function aK() {
                        if (!aa) {
                            return
                        }
                        x.log("Error playing media: %o %s", ai.error, ai.src);
                        V.trigger(f.JWPLAYER_MEDIA_ERROR, {
                            message: "Error loading media: File could not be played"
                        })
                    }

                    function ax(a7) {
                        var a6;
                        if (x.typeOf(a7) === "array" && a7.length > 0) {
                            a6 = C.map(a7, function(a9, a8) {
                                return {
                                    label: a9.label || a8
                                }
                            })
                        }
                        return a6
                    }

                    function Q(a7) {
                        aF = a7;
                        ad = aR(a7);
                        var a6 = ax(a7);
                        if (a6) {
                            V.trigger(f.JWPLAYER_MEDIA_LEVELS, {
                                levels: a6,
                                currentQuality: ad
                            })
                        }
                    }

                    function aR(a8) {
                        var a9 = Math.max(0, ad);
                        var a6 = P.qualityLabel;
                        if (a8) {
                            for (var a7 = 0; a7 < a8.length; a7++) {
                                if (a8[a7]["default"]) {
                                    a9 = a7
                                }
                                if (a6 && a8[a7].label === a6) {
                                    return a7
                                }
                            }
                        }
                        aW.reason = "initial choice";
                        aW.level = {};
                        return a9
                    }

                    function aA(a8, bb) {
                        aO = 0;
                        g(H);
                        var a7 = document.createElement("source");
                        a7.src = aF[ad].file;
                        var ba = (ai.src !== a7.src);
                        var a9 = ai.getAttribute("jw-loaded");
                        var a6 = ai.hasAttribute("jw-played");
                        if (ba || a9 === "none" || a9 === "started") {
                            a2 = bb;
                            aQ(aF[ad]);
                            aI(O);
                            ai.load()
                        } else {
                            if (a8 === 0 && ai.currentTime > 0) {
                                aO = -1;
                                V.seek(a8)
                            }
                            ai.play()
                        }
                        Y = ai.currentTime;
                        if (t && !a6) {
                            S();
                            if (!ai.paused && V.state !== j.PLAYING) {
                                V.setState(j.LOADING)
                            }
                        }
                        if (x.isIOS() && V.getFullScreen()) {
                            ai.controls = true
                        }
                        if (a8 > 0) {
                            V.seek(a8)
                        }
                    }

                    function aQ(a7) {
                        au = null;
                        I = null;
                        ae = -1;
                        aj = -1;
                        F = -1;
                        if (!aW.reason) {
                            aW.reason = "initial choice";
                            aW.level = {}
                        }
                        J = false;
                        aZ = false;
                        N = z(a7);
                        if (a7.preload && a7.preload !== ai.getAttribute("preload")) {
                            ai.setAttribute("preload", a7.preload)
                        }
                        var a6 = document.createElement("source");
                        a6.src = a7.file;
                        var a8 = (ai.src !== a6.src);
                        if (a8) {
                            ai.setAttribute("jw-loaded", "none");
                            ai.src = a7.file
                        }
                    }

                    function M() {
                        if (ai) {
                            aY();
                            ai.removeAttribute("crossorigin");
                            ai.removeAttribute("preload");
                            ai.removeAttribute("src");
                            ai.removeAttribute("jw-loaded");
                            ai.removeAttribute("jw-played");
                            s.emptyElement(ai);
                            ad = -1;
                            O = null;
                            if (!B && "load" in ai) {
                                ai.load()
                            }
                        }
                    }

                    function aI(a6) {
                        if (a6 === null) {
                            return
                        }
                        var a7 = x.isChrome() || x.isIOS() || x.isSafari();
                        if (a5 || !a7) {
                            return
                        }
                        if (a6 !== O || (a6.length && !ai.textTracks.length)) {
                            aY();
                            s.emptyElement(ai);
                            O = a6;
                            L(a6)
                        }
                    }

                    function L(a9) {
                        if (!a9) {
                            return
                        }
                        var a6 = false;
                        for (var ba = 0; ba < a9.length; ba++) {
                            var a8 = a9[ba];
                            if (!(/\.(?:web)?vtt(?:\?.*)?$/i).test(a8.file)) {
                                continue
                            }
                            if (!(/subtitles|captions|descriptions|chapters|metadata/i).test(a8.kind)) {
                                continue
                            }
                            if (!a6) {
                                if (!ai.hasAttribute("crossorigin") && x.crossdomain(a8.file)) {
                                    ai.setAttribute("crossorigin", "anonymous");
                                    a6 = true
                                }
                            }
                            var a7 = document.createElement("track");
                            a7.src = a8.file;
                            a7.kind = a8.kind;
                            a7.srclang = a8.language || "";
                            a7.label = a8.label;
                            a7.mode = "disabled";
                            a7.id = a8["default"] || (a8.defaulttrack ? "default" : "");
                            ai.appendChild(a7)
                        }
                    }

                    function a1() {
                        var a6 = ai.seekable ? ai.seekable.length : 0;
                        var a7 = Infinity;
                        while (a6--) {
                            a7 = Math.min(a7, ai.seekable.start(a6))
                        }
                        return a7
                    }

                    function a3() {
                        var a7 = ai.seekable ? ai.seekable.length : 0;
                        var a6 = 0;
                        while (a7--) {
                            a6 = Math.max(a6, ai.seekable.end(a7))
                        }
                        return a6
                    }
                    this.stop = function() {
                        g(H);
                        if (!aa) {
                            return
                        }
                        M();
                        if (x.isIETrident()) {
                            ai.pause()
                        }
                        this.setState(j.IDLE)
                    };
                    this.destroy = function() {
                        y(E, ai);
                        A(ai.audioTracks, "change", ag);
                        A(ai.textTracks, "change", al);
                        this.remove();
                        this.off()
                    };
                    this.init = function(a6) {
                        if (!aa) {
                            return
                        }
                        O = null;
                        aF = a6.sources;
                        ad = aR(a6.sources);
                        if (a6.sources.length && a6.sources[0].type !== "hls") {
                            this.sendMediaType(a6.sources)
                        }
                        Y = a6.starttime || 0;
                        a2 = a6.duration || 0;
                        aW.reason = "";
                        aQ(aF[ad]);
                        aI(a6.tracks)
                    };
                    this.load = function(a6) {
                        if (!aa) {
                            return
                        }
                        Q(a6.sources);
                        if (a6.sources.length && a6.sources[0].type !== "hls") {
                            this.sendMediaType(a6.sources)
                        }
                        if (!t || ai.hasAttribute("jw-played")) {
                            V.setState(j.LOADING)
                        }
                        aA(a6.starttime || 0, a6.duration || 0)
                    };
                    this.play = function() {
                        if (V.seeking) {
                            V.setState(j.LOADING);
                            V.once(f.JWPLAYER_MEDIA_SEEKED, V.play);
                            return
                        }
                        ai.play()
                    };
                    this.pause = function() {
                        g(H);
                        ai.pause();
                        this.setState(j.PAUSED)
                    };
                    this.seek = function(a7) {
                        if (!aa) {
                            return
                        }
                        if (a7 < 0) {
                            a7 += a1() + a3()
                        }
                        if (aO === 0) {
                            this.trigger(f.JWPLAYER_MEDIA_SEEK, {
                                position: ai.currentTime,
                                offset: a7
                            })
                        }
                        if (!J) {
                            J = !!a3()
                        }
                        if (J) {
                            aO = 0;
                            try {
                                V.seeking = true;
                                ai.currentTime = a7
                            } catch (a6) {
                                V.seeking = false;
                                aO = a7
                            }
                        } else {
                            aO = a7;
                            if (q && ai.paused) {
                                ai.play()
                            }
                        }
                    };

                    function T() {
                        V.seeking = false;
                        V.trigger(f.JWPLAYER_MEDIA_SEEKED)
                    }
                    this.volume = function(a6) {
                        a6 = x.between(a6 / 100, 0, 1);
                        ai.volume = a6
                    };

                    function X() {
                        V.trigger("volume", {
                            volume: Math.round(ai.volume * 100)
                        });
                        V.trigger("mute", {
                            mute: ai.muted
                        })
                    }
                    this.mute = function(a6) {
                        ai.muted = !!a6
                    };

                    function K() {
                        if (ai.currentTime === Y) {
                            a0()
                        }
                    }

                    function aG() {
                        var a6 = ai.buffered;
                        var a7 = ai.duration;
                        if (!a6 || a6.length === 0 || a7 <= 0 || a7 === Infinity) {
                            return 0
                        }
                        return x.between(a6.end(a6.length - 1) / a7, 0, 1)
                    }

                    function ar() {
                        if (!aa) {
                            return
                        }
                        if (V.state !== j.IDLE && V.state !== j.COMPLETE) {
                            g(H);
                            ad = -1;
                            aq = true;
                            V.trigger(f.JWPLAYER_MEDIA_BEFORECOMPLETE);
                            if (!aa) {
                                return
                            }
                            af()
                        }
                    }

                    function af() {
                        g(H);
                        V.setState(j.COMPLETE);
                        aq = false;
                        V.trigger(f.JWPLAYER_MEDIA_COMPLETE)
                    }

                    function az(a6) {
                        an = true;
                        aT(a6);
                        if (x.isIOS()) {
                            ai.controls = false
                        }
                    }

                    function al() {
                        var a7 = -1,
                            a6 = 0;
                        if (au) {
                            for (a6; a6 < au.length; a6++) {
                                if (au[a6].mode === "showing") {
                                    a7 = a6;
                                    break
                                }
                            }
                        }
                        aE(a7 + 1)
                    }

                    function ag() {
                        var a7 = -1;
                        for (var a6 = 0; a6 < ai.audioTracks.length; a6++) {
                            if (ai.audioTracks[a6].enabled) {
                                a7 = a6;
                                break
                            }
                        }
                        av(a7)
                    }

                    function aU(a6) {
                        aC(a6.currentTarget.activeCues)
                    }

                    function aC(a7) {
                        if (!a7 || !a7.length || F === a7[0].startTime) {
                            return
                        }
                        var a6 = x.parseID3(a7);
                        F = a7[0].startTime;
                        V.trigger("meta", {
                            metadataTime: F,
                            metadata: a6
                        })
                    }

                    function aB(a6) {
                        an = false;
                        aT(a6);
                        if (x.isIOS()) {
                            ai.controls = false
                        }
                    }

                    function aT(a6) {
                        V.trigger("fullscreenchange", {
                            target: a6.target,
                            jwstate: an
                        })
                    }
                    this.checkComplete = function() {
                        return aq
                    };
                    this.detachMedia = function() {
                        g(H);
                        aY();
                        aa = false;
                        return ai
                    };
                    this.attachMedia = function() {
                        aa = true;
                        J = false;
                        this.seeking = false;
                        ai.loop = false;
                        if (aq) {
                            af()
                        }
                    };
                    this.setContainer = function(a6) {
                        aX = a6;
                        a6.appendChild(ai)
                    };
                    this.getContainer = function() {
                        return aX
                    };
                    this.remove = function() {
                        M();
                        g(H);
                        if (aX === ai.parentNode) {
                            aX.removeChild(ai)
                        }
                    };
                    this.setVisibility = function(a6) {
                        a6 = !!a6;
                        if (a6 || l) {
                            r.style(aX, {
                                visibility: "visible",
                                opacity: 1
                            })
                        } else {
                            r.style(aX, {
                                visibility: "",
                                opacity: 0
                            })
                        }
                    };
                    this.resize = function(a7, bf, ba) {
                        if (!a7 || !bf || !ai.videoWidth || !ai.videoHeight) {
                            return false
                        }
                        var a6 = {
                            objectFit: ""
                        };
                        if (ba === "uniform") {
                            var a9 = a7 / bf;
                            var bg = ai.videoWidth / ai.videoHeight;
                            if (Math.abs(a9 - bg) < 0.09) {
                                a6.objectFit = "fill";
                                ba = "exactfit"
                            }
                        }
                        var a8 = k || l || w || v;
                        if (a8) {
                            var bc = -Math.floor(ai.videoWidth / 2 + 1);
                            var bb = -Math.floor(ai.videoHeight / 2 + 1);
                            var be = Math.ceil(a7 * 100 / ai.videoWidth) / 100;
                            var bd = Math.ceil(bf * 100 / ai.videoHeight) / 100;
                            if (ba === "none") {
                                be = bd = 1
                            } else {
                                if (ba === "fill") {
                                    be = bd = Math.max(be, bd)
                                } else {
                                    if (ba === "uniform") {
                                        be = bd = Math.min(be, bd)
                                    }
                                }
                            }
                            a6.width = ai.videoWidth;
                            a6.height = ai.videoHeight;
                            a6.top = a6.left = "50%";
                            a6.margin = 0;
                            r.transform(ai, "translate(" + bc + "px, " + bb + "px) scale(" + be.toFixed(2) + ", " + bd.toFixed(2) + ")")
                        }
                        r.style(ai, a6);
                        return false
                    };
                    this.setFullscreen = function(a7) {
                        a7 = !!a7;
                        if (a7) {
                            var a6 = x.tryCatch(function() {
                                var a9 = ai.webkitEnterFullscreen || ai.webkitEnterFullScreen;
                                if (a9) {
                                    a9.apply(ai)
                                }
                            });
                            if (a6 instanceof x.Error) {
                                return false
                            }
                            return V.getFullScreen()
                        } else {
                            var a8 = ai.webkitExitFullscreen || ai.webkitExitFullScreen;
                            if (a8) {
                                a8.apply(ai)
                            }
                        }
                        return a7
                    };
                    V.getFullScreen = function() {
                        return an || !!ai.webkitDisplayingFullscreen
                    };
                    this.setCurrentQuality = function(a8) {
                        if (ad === a8) {
                            return
                        }
                        if (a8 >= 0) {
                            if (aF && aF.length > a8) {
                                ad = a8;
                                aW.reason = "api";
                                aW.level = {};
                                this.trigger(f.JWPLAYER_MEDIA_LEVEL_CHANGED, {
                                    currentQuality: a8,
                                    levels: ax(aF)
                                });
                                P.qualityLabel = aF[a8].label;
                                var a7 = ai.currentTime || 0;
                                var a6 = ai.duration || 0;
                                if (a6 <= 0) {
                                    a6 = a2
                                }
                                V.setState(j.LOADING);
                                aA(a7, a6)
                            }
                        }
                    };
                    this.getCurrentQuality = function() {
                        return ad
                    };
                    this.getQualityLevels = function() {
                        return ax(aF)
                    };
                    this.getName = function() {
                        return {
                            name: p
                        }
                    };
                    this.sendEvent = function() {};
                    this.setMouse = function() {};
                    this.setSpeed = function(a6) {
                        ai.playbackRate = a6;
                        ai.defaultPlaybackRate = a6;
                        if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
                            V.seek(Y)
                        }
                    };
                    this.setCurrentAudioTrack = av;
                    this.getAudioTracks = ao;
                    this.getCurrentAudioTrack = ay;

                    function ah(a6) {
                        I = null;
                        if (!a6) {
                            return
                        }
                        if (a6.length) {
                            for (var a7 = 0; a7 < a6.length; a7++) {
                                if (a6[a7].enabled) {
                                    ae = a7;
                                    break
                                }
                            }
                            if (ae === -1) {
                                ae = 0;
                                a6[ae].enabled = true
                            }
                            I = C.map(a6, function(a8) {
                                var a9 = {
                                    name: a8.label || a8.language,
                                    language: a8.language
                                };
                                return a9
                            })
                        }
                        u(a6, "change", ag);
                        if (I) {
                            V.trigger("audioTracks", {
                                currentTrack: ae,
                                tracks: I
                            })
                        }
                    }

                    function av(a6) {
                        if (ai && ai.audioTracks && I && a6 > -1 && a6 < ai.audioTracks.length && a6 !== ae) {
                            ai.audioTracks[ae].enabled = false;
                            ae = a6;
                            ai.audioTracks[ae].enabled = true;
                            V.trigger("audioTrackChanged", {
                                currentTrack: ae,
                                tracks: I
                            })
                        }
                    }

                    function ao() {
                        return I || []
                    }

                    function ay() {
                        return ae
                    }
                    this.setSubtitlesTrack = aE;
                    this.getSubtitlesTrack = ak;

                    function aV(a7) {
                        au = null;
                        if (!a7) {
                            return
                        }
                        if (a7.length) {
                            var a8 = 0,
                                a6 = a7.length;
                            for (a8; a8 < a6; a8++) {
                                if (a7[a8].kind === "metadata") {
                                    a7[a8].oncuechange = aU;
                                    a7[a8].mode = "showing"
                                } else {
                                    if (a7[a8].kind === "subtitles" || a7[a8].kind === "captions") {
                                        a7[a8].mode = "disabled";
                                        if (!au) {
                                            au = []
                                        }
                                        au.push(a7[a8])
                                    }
                                }
                            }
                        }
                        u(a7, "change", al);
                        if (au && au.length) {
                            V.trigger("subtitlesTracks", {
                                tracks: au
                            })
                        }
                    }

                    function aE(a6) {
                        if (!au) {
                            return
                        }
                        if (aj === a6 - 1) {
                            return
                        }
                        if (aj > -1 && aj < au.length) {
                            au[aj].mode = "disabled"
                        } else {
                            C.each(au, function(a7) {
                                a7.mode = "disabled"
                            })
                        }
                        if (a6 > 0 && a6 <= au.length) {
                            aj = a6 - 1;
                            au[aj].mode = "showing"
                        } else {
                            aj = -1
                        }
                        V.trigger("subtitlesTrackChanged", {
                            currentTrack: aj + 1,
                            tracks: au
                        })
                    }

                    function ak() {
                        return aj
                    }

                    function U() {
                        if (aF[0].type === "hls") {
                            var a6 = "video";
                            if (ai.videoHeight === 0) {
                                a6 = "audio"
                            }
                            V.trigger("mediaType", {
                                mediaType: a6
                            })
                        }
                    }

                    function aY() {
                        if (au && au[aj]) {
                            au[aj].mode = "disabled"
                        }
                    }
                }
                var n = function() {};
                n.prototype = i;
                h.prototype = new n();
                h.getName = function() {
                    return {
                        name: "html5"
                    }
                };
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43), d(44), d(61), d(83), d(77), d(45)], e = function(l, m, o, p, g, k, q) {
                var j = 0;

                function h(r) {
                    return r + "_swf_" + (j++)
                }

                function i(s) {
                    var r = document.createElement("a");
                    r.href = s.flashplayer;
                    var t = (r.hostname === window.location.host);
                    return l.isChrome() && !t
                }

                function f(O, G) {
                    var x;
                    var u;
                    var B = null;
                    var C = -1;
                    var E = false;
                    var t = -1;
                    var r = null;
                    var A = -1;
                    var D = null;
                    var z;
                    var J = true;
                    var M = false;
                    var I = this;
                    var s = function() {
                        return u && u.__ready
                    };
                    var w = function() {
                        if (u) {
                            u.triggerFlash.apply(u, arguments)
                        }
                    };
                    var K = y();

                    function F(Q) {
                        if (K) {
                            for (var P = 0; P < Q.length; P++) {
                                var S = Q[P];
                                if (S.bitrate) {
                                    var R = Math.round(S.bitrate / 1000);
                                    S.label = N(R)
                                }
                            }
                        }
                    }

                    function N(R) {
                        var P = K[R];
                        if (!P) {
                            var T = Infinity;
                            var Q = K.bitrates.length;
                            while (Q--) {
                                var S = Math.abs(K.bitrates[Q] - R);
                                if (S > T) {
                                    break
                                }
                                T = S
                            }
                            P = K.labels[K.bitrates[Q + 1]];
                            K[R] = P
                        }
                        return P
                    }

                    function y() {
                        var P = G.hlslabels;
                        if (!P) {
                            return null
                        }
                        var U = {};
                        var T = [];
                        for (var S in P) {
                            var R = parseFloat(S);
                            if (!isNaN(R)) {
                                var Q = Math.round(R);
                                U[Q] = P[S];
                                T.push(Q)
                            }
                        }
                        if (T.length === 0) {
                            return null
                        }
                        T.sort(function(W, V) {
                            return W - V
                        });
                        return {
                            labels: U,
                            bitrates: T
                        }
                    }

                    function L() {
                        C = setTimeout(function() {
                            q.trigger.call(I, "flashBlocked")
                        }, 4000);
                        u.once("embedded", function() {
                            H();
                            q.trigger.call(I, "flashUnblocked")
                        }, I)
                    }

                    function v() {
                        H();
                        L()
                    }

                    function H() {
                        clearTimeout(C);
                        window.removeEventListener("focus", v)
                    }
                    m.extend(this, q, {
                        init: function(P) {
                            if (!P.preload || P.preload === "none" || G.autostart) {
                                return
                            } else {
                                B = P
                            }
                        },
                        load: function(P) {
                            B = P;
                            E = false;
                            this.setState(p.LOADING);
                            w("load", P);
                            this.sendMediaType(P.sources)
                        },
                        play: function() {
                            w("play")
                        },
                        pause: function() {
                            w("pause");
                            this.setState(p.PAUSED)
                        },
                        stop: function() {
                            w("stop");
                            t = -1;
                            B = null;
                            this.setState(p.IDLE)
                        },
                        seek: function(P) {
                            w("seek", P)
                        },
                        volume: function(P) {
                            if (!m.isNumber(P)) {
                                return
                            }
                            var Q = Math.min(Math.max(0, P), 100);
                            if (s()) {
                                w("volume", Q)
                            }
                        },
                        mute: function(P) {
                            if (s()) {
                                w("mute", P)
                            }
                        },
                        setState: function() {
                            return k.setState.apply(this, arguments)
                        },
                        checkComplete: function() {
                            return E
                        },
                        attachMedia: function() {
                            J = true;
                            if (E) {
                                this.setState(p.COMPLETE);
                                this.trigger(o.JWPLAYER_MEDIA_COMPLETE);
                                E = false
                            }
                        },
                        detachMedia: function() {
                            J = false;
                            return null
                        },
                        getSwfObject: function(P) {
                            var Q = P.getElementsByTagName("object")[0];
                            if (Q) {
                                Q.off(null, null, this);
                                return Q
                            }
                            return g.embed(G.flashplayer, P, h(O), G.wmode)
                        },
                        getContainer: function() {
                            return x
                        },
                        setContainer: function(R) {
                            if (x === R) {
                                return
                            }
                            x = R;
                            u = this.getSwfObject(R);
                            if (document.hasFocus()) {
                                L()
                            } else {
                                window.addEventListener("focus", v)
                            }
                            u.once("ready", function() {
                                H();
                                u.once("pluginsLoaded", function() {
                                    u.queueCommands = false;
                                    w("setupCommandQueue", u.__commandQueue);
                                    u.__commandQueue = []
                                });
                                var U = m.extend({}, G);
                                var T = u.triggerFlash("setup", U);
                                if (T === u) {
                                    u.__ready = true
                                } else {
                                    this.trigger(o.JWPLAYER_MEDIA_ERROR, T)
                                }
                                if (B) {
                                    w("init", B)
                                }
                            }, this);
                            var Q = [o.JWPLAYER_MEDIA_META, o.JWPLAYER_MEDIA_ERROR, o.JWPLAYER_MEDIA_SEEK, o.JWPLAYER_MEDIA_SEEKED, "subtitlesTracks", "subtitlesTrackChanged", "subtitlesTrackData", "mediaType"];
                            var S = [o.JWPLAYER_MEDIA_BUFFER, o.JWPLAYER_MEDIA_TIME];
                            var P = [o.JWPLAYER_MEDIA_BUFFER_FULL];
                            u.on(o.JWPLAYER_MEDIA_LEVELS, function(T) {
                                F(T.levels);
                                t = T.currentQuality;
                                r = T.levels;
                                this.trigger(T.type, T)
                            }, this);
                            u.on(o.JWPLAYER_MEDIA_LEVEL_CHANGED, function(T) {
                                F(T.levels);
                                t = T.currentQuality;
                                r = T.levels;
                                this.trigger(T.type, T)
                            }, this);
                            u.on(o.JWPLAYER_AUDIO_TRACKS, function(T) {
                                A = T.currentTrack;
                                D = T.tracks;
                                this.trigger(T.type, T)
                            }, this);
                            u.on(o.JWPLAYER_AUDIO_TRACK_CHANGED, function(T) {
                                A = T.currentTrack;
                                D = T.tracks;
                                this.trigger(T.type, T)
                            }, this);
                            u.on(o.JWPLAYER_PLAYER_STATE, function(U) {
                                var T = U.newstate;
                                if (T === p.IDLE) {
                                    return
                                }
                                this.setState(T)
                            }, this);
                            u.on(S.join(" "), function(T) {
                                if (T.duration === "Infinity") {
                                    T.duration = Infinity
                                }
                                this.trigger(T.type, T)
                            }, this);
                            u.on(Q.join(" "), function(T) {
                                this.trigger(T.type, T)
                            }, this);
                            u.on(P.join(" "), function(T) {
                                this.trigger(T.type)
                            }, this);
                            u.on(o.JWPLAYER_MEDIA_BEFORECOMPLETE, function(T) {
                                E = true;
                                this.trigger(T.type);
                                if (J === true) {
                                    E = false
                                }
                            }, this);
                            u.on(o.JWPLAYER_MEDIA_COMPLETE, function(T) {
                                if (!E) {
                                    this.setState(p.COMPLETE);
                                    this.trigger(T.type)
                                }
                            }, this);
                            u.on("visualQuality", function(T) {
                                T.reason = T.reason || "api";
                                this.trigger("visualQuality", T);
                                this.trigger(o.JWPLAYER_PROVIDER_FIRST_FRAME, {})
                            }, this);
                            u.on(o.JWPLAYER_PROVIDER_CHANGED, function(T) {
                                z = T.message;
                                this.trigger(o.JWPLAYER_PROVIDER_CHANGED, T)
                            }, this);
                            u.on(o.JWPLAYER_ERROR, function(T) {
                                l.log("Error playing media: %o %s", T.code, T.message, T);
                                this.trigger(o.JWPLAYER_MEDIA_ERROR, T)
                            }, this);
                            u.on("sendEvent", function(T) {
                                this.trigger("sendEvent", T)
                            }, this);
                            u.on("setMouse", function(T) {
                                this.trigger("setMouse", T)
                            }, this);
                            if (i(G)) {
                                u.on("throttle", function(T) {
                                    H();
                                    if (T.state === "resume") {
                                        q.trigger.call(I, "flashThrottle", T)
                                    } else {
                                        C = setTimeout(function() {
                                            q.trigger.call(I, "flashThrottle", T)
                                        }, 250)
                                    }
                                }, this)
                            }
                        },
                        remove: function() {
                            t = -1;
                            r = null;
                            g.remove(u)
                        },
                        setVisibility: function(P) {
                            P = !!P;
                            x.style.opacity = P ? 1 : 0
                        },
                        resize: function(R, Q, P) {
                            if (P) {
                                w("stretch", P)
                            }
                        },
                        setControls: function(P) {
                            w("setControls", P)
                        },
                        setFullscreen: function(P) {
                            M = P;
                            w("fullscreen", P)
                        },
                        getFullScreen: function() {
                            return M
                        },
                        setCurrentQuality: function(P) {
                            w("setCurrentQuality", P)
                        },
                        getCurrentQuality: function() {
                            return t
                        },
                        setSubtitlesTrack: function(P) {
                            w("setSubtitlesTrack", P)
                        },
                        getName: function() {
                            if (z) {
                                return {
                                    name: "flash_" + z
                                }
                            }
                            return {
                                name: "flash"
                            }
                        },
                        getQualityLevels: function() {
                            return r || B.sources
                        },
                        getAudioTracks: function() {
                            return D
                        },
                        getCurrentAudioTrack: function() {
                            return A
                        },
                        setCurrentAudioTrack: function(P) {
                            w("setCurrentAudioTrack", P)
                        },
                        sendEvent: function(P, Q) {
                            w("sendEvent", P, Q)
                        },
                        setMouse: function(P) {
                            w("setMouse", P)
                        },
                        destroy: function() {
                            H();
                            this.remove();
                            if (u) {
                                u.off();
                                u = null
                            }
                            x = null;
                            B = null;
                            this.off()
                        }
                    });
                    this.trigger = function(Q, P) {
                        if (!J) {
                            return
                        }
                        return q.trigger.call(this, Q, P)
                    }
                }
                var n = function() {};
                n.prototype = k;
                f.prototype = new n();
                f.getName = function() {
                    return {
                        name: "flash"
                    }
                };
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(45), d(43)], e = function(i, h, j) {
                var l = "#000000";

                function g(o, n, p) {
                    var q = document.createElement("param");
                    q.setAttribute("name", n);
                    q.setAttribute("value", p);
                    o.appendChild(q)
                }

                function m(t, n, u, s) {
                    var r;
                    s = s || "opaque";
                    if (i.isMSIE()) {
                        var o = document.createElement("div");
                        n.appendChild(o);
                        o.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="' + u + '" name="' + u + '" tabindex="0"><param name="movie" value="' + t + '"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="wmode" value="' + s + '"><param name="bgcolor" value="' + l + '"><param name="menu" value="false"></object>';
                        var q = n.getElementsByTagName("object");
                        for (var p = q.length; p--;) {
                            if (q[p].id === u) {
                                r = q[p]
                            }
                        }
                    } else {
                        r = document.createElement("object");
                        r.setAttribute("type", "application/x-shockwave-flash");
                        r.setAttribute("data", t);
                        r.setAttribute("width", "100%");
                        r.setAttribute("height", "100%");
                        r.setAttribute("bgcolor", l);
                        r.setAttribute("id", u);
                        r.setAttribute("name", u);
                        g(r, "allowfullscreen", "true");
                        g(r, "allowscriptaccess", "always");
                        g(r, "wmode", s);
                        g(r, "menu", "false");
                        n.appendChild(r, n)
                    }
                    r.className = "jw-swf jw-reset";
                    r.style.display = "block";
                    r.style.position = "absolute";
                    r.style.left = 0;
                    r.style.right = 0;
                    r.style.top = 0;
                    r.style.bottom = 0;
                    j.extend(r, h);
                    r.queueCommands = true;
                    r.triggerFlash = function(x) {
                        var z = this;
                        if (x !== "setup" && z.queueCommands || !z.__externalCall) {
                            var A = z.__commandQueue;
                            for (var y = A.length; y--;) {
                                if (A[y][0] === x) {
                                    A.splice(y, 1)
                                }
                            }
                            A.push(Array.prototype.slice.call(arguments));
                            return z
                        }
                        var w = Array.prototype.slice.call(arguments, 1);
                        var v = i.tryCatch(function() {
                            if (w.length) {
                                for (var C = w.length; C--;) {
                                    if (typeof w[C] === "object") {
                                        j.each(w[C], k)
                                    }
                                }
                                var B = JSON.stringify(w);
                                z.__externalCall(x, B)
                            } else {
                                z.__externalCall(x)
                            }
                        });
                        if (v instanceof i.Error) {
                            console.error(x, v);
                            if (x === "setup") {
                                v.name = "Failed to setup flash";
                                return v
                            }
                        }
                        return z
                    };
                    r.__commandQueue = [];
                    return r
                }

                function f(n) {
                    if (n && n.parentNode) {
                        n.style.display = "none";
                        n.parentNode.removeChild(n)
                    }
                }

                function k(o, p, n) {
                    if (o instanceof window.HTMLElement) {
                        delete n[p]
                    }
                }
                return {
                    embed: m,
                    remove: f
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        }, ,
        function(c, b, d) {
            var a, e;
            !(a = [d(44), d(45), d(43)], e = function(i, g, h) {
                var j = {};
                var f = {
                    NEW: 0,
                    LOADING: 1,
                    ERROR: 2,
                    COMPLETE: 3
                };
                var k = function(l, o) {
                    var q = h.extend(this, g),
                        m = f.NEW;
                    this.addEventListener = this.on;
                    this.removeEventListener = this.off;

                    function n(r) {
                        m = f.ERROR;
                        q.trigger(i.ERROR, r)
                    }

                    function p(r) {
                        m = f.COMPLETE;
                        q.trigger(i.COMPLETE, r)
                    }
                    this.makeStyleLink = function(r) {
                        var s = document.createElement("link");
                        s.type = "text/css";
                        s.rel = "stylesheet";
                        s.href = r;
                        return s
                    };
                    this.makeScriptTag = function(r) {
                        var s = document.createElement("script");
                        s.src = r;
                        return s
                    };
                    this.makeTag = (o ? this.makeStyleLink : this.makeScriptTag);
                    this.load = function() {
                        if (m !== f.NEW) {
                            return
                        }
                        var u = j[l];
                        if (u) {
                            m = u.getStatus();
                            if (m < 2) {
                                u.on(i.ERROR, n);
                                u.on(i.COMPLETE, p);
                                return
                            }
                        }
                        var s = document.getElementsByTagName("head")[0] || document.documentElement;
                        var t = this.makeTag(l);
                        var r = false;
                        t.onload = t.onreadystatechange = function(v) {
                            if (!r && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                                r = true;
                                p(v);
                                t.onload = t.onreadystatechange = null;
                                if (s && t.parentNode && !o) {
                                    s.removeChild(t)
                                }
                            }
                        };
                        t.onerror = n;
                        s.insertBefore(t, s.firstChild);
                        m = f.LOADING;
                        j[l] = this
                    };
                    this.getStatus = function() {
                        return m
                    }
                };
                k.loaderstatus = f;
                return k
            }.apply(b, a), e !== undefined && (c.exports = e))
        }, ,
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46)], e = function(o, n) {
                var i = window.jwplayer;
                var l = {
                    removeItem: n.noop
                };
                try {
                    l = window.localStorage
                } catch (m) {}

                function h(q) {
                    return "jwplayer." + q
                }

                function f() {
                    return o.reduce(this.persistItems, function(q, r) {
                        var s = l[h(r)];
                        if (s) {
                            q[r] = n.serialize(s)
                        }
                        return q
                    }, {})
                }

                function k(q, r) {
                    try {
                        l[h(q)] = r
                    } catch (s) {
                        if (i && i.debug) {
                            console.error(s)
                        }
                    }
                }

                function j() {
                    o.each(this.persistItems, function(q) {
                        l.removeItem(h(q))
                    })
                }

                function p() {}

                function g(q, r) {
                    this.persistItems = q;
                    o.each(this.persistItems, function(s) {
                        r.on("change:" + s, function(t, u) {
                            k(s, u)
                        })
                    })
                }
                o.extend(p.prototype, {
                    getAllItems: f,
                    track: g,
                    clear: j
                });
                return p
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(60), d(44), d(43)], e = function(k, j, i) {
                var l = (function(n) {
                    var m = Number.MIN_VALUE;
                    return function(o) {
                        if (o.position > m) {
                            n()
                        }
                        m = o.position
                    }
                });

                function f(m) {
                    m.mediaController.off(j.JWPLAYER_MEDIA_PLAY_ATTEMPT, m._onPlayAttempt);
                    m.mediaController.off(j.JWPLAYER_PROVIDER_FIRST_FRAME, m._triggerFirstFrame);
                    m.mediaController.off(j.JWPLAYER_MEDIA_TIME, m._onTime)
                }

                function h(m) {
                    f(m);
                    m._triggerFirstFrame = i.once(function() {
                        var n = m._qoeItem;
                        n.tick(j.JWPLAYER_MEDIA_FIRST_FRAME);
                        var o = n.between(j.JWPLAYER_MEDIA_PLAY_ATTEMPT, j.JWPLAYER_MEDIA_FIRST_FRAME);
                        m.mediaController.trigger(j.JWPLAYER_MEDIA_FIRST_FRAME, {
                            loadTime: o
                        });
                        f(m)
                    });
                    m._onTime = l(m._triggerFirstFrame);
                    m._onPlayAttempt = function() {
                        m._qoeItem.tick(j.JWPLAYER_MEDIA_PLAY_ATTEMPT)
                    };
                    m.mediaController.on(j.JWPLAYER_MEDIA_PLAY_ATTEMPT, m._onPlayAttempt);
                    m.mediaController.once(j.JWPLAYER_PROVIDER_FIRST_FRAME, m._triggerFirstFrame);
                    m.mediaController.on(j.JWPLAYER_MEDIA_TIME, m._onTime)
                }

                function g(n) {
                    function m(o, p, q) {
                        if (o._qoeItem && q) {
                            o._qoeItem.end(q.get("state"))
                        }
                        o._qoeItem = new k();
                        o._qoeItem.tick(j.JWPLAYER_PLAYLIST_ITEM);
                        o._qoeItem.start(p.get("state"));
                        h(o);
                        p.on("change:state", function(s, r, t) {
                            o._qoeItem.end(t);
                            o._qoeItem.start(r)
                        })
                    }
                    n.on("change:mediaModel", m)
                }
                return {
                    model: g
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(45)], e = function(g, f) {
                var h = g.extend({
                    get: function(i) {
                        this.attributes = this.attributes || {};
                        return this.attributes[i]
                    },
                    set: function(i, k) {
                        this.attributes = this.attributes || {};
                        if (this.attributes[i] === k) {
                            return
                        }
                        var j = this.attributes[i];
                        this.attributes[i] = k;
                        this.trigger("change:" + i, this, k, j)
                    },
                    clone: function() {
                        return g.clone(this.attributes)
                    }
                }, f);
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(45), d(75), d(74), d(44), d(61), d(46), d(43)], e = function(g, m, k, j, h, f, i) {
                var l = function(o, p) {
                    this.model = p;
                    this._adModel = new m().setup({
                        id: p.get("id"),
                        volume: p.get("volume"),
                        fullscreen: p.get("fullscreen"),
                        mute: p.get("mute")
                    });
                    this._adModel.on("change:state", k, this);
                    var n = o.getContainer();
                    this.swf = n.querySelector("object")
                };
                l.prototype = i.extend({
                    init: function() {
                        if (f.isChrome()) {
                            var n = -1;
                            var o = false;
                            this.swf.on("throttle", function(p) {
                                clearTimeout(n);
                                if (p.state === "resume") {
                                    if (o) {
                                        o = false;
                                        this.instreamPlay()
                                    }
                                } else {
                                    var q = this;
                                    n = setTimeout(function() {
                                        if (q._adModel.get("state") === h.PLAYING) {
                                            o = true;
                                            q.instreamPause()
                                        }
                                    }, 250)
                                }
                            }, this)
                        }
                        this.swf.on("instream:state", function(p) {
                            switch (p.newstate) {
                                case h.PLAYING:
                                    this._adModel.set("state", p.newstate);
                                    break;
                                case h.PAUSED:
                                    this._adModel.set("state", p.newstate);
                                    break
                            }
                        }, this).on("instream:time", function(p) {
                            this._adModel.set("position", p.position);
                            this._adModel.set("duration", p.duration);
                            this.trigger(j.JWPLAYER_MEDIA_TIME, p)
                        }, this).on("instream:complete", function(p) {
                            this.trigger(j.JWPLAYER_MEDIA_COMPLETE, p)
                        }, this).on("instream:error", function(p) {
                            this.trigger(j.JWPLAYER_MEDIA_ERROR, p)
                        }, this);
                        this.swf.triggerFlash("instream:init");
                        this.applyProviderListeners = function(p) {
                            this.model.on("change:volume", function(r, q) {
                                p.volume(q)
                            }, this);
                            this.model.on("change:mute", function(r, q) {
                                p.mute(q)
                            }, this)
                        }
                    },
                    instreamDestroy: function() {
                        if (!this._adModel) {
                            return
                        }
                        this.off();
                        this.swf.off(null, null, this);
                        this.swf.triggerFlash("instream:destroy");
                        this.swf = null;
                        this._adModel.off();
                        this._adModel = null;
                        this.model = null
                    },
                    load: function(n) {
                        this.swf.triggerFlash("instream:load", n)
                    },
                    instreamPlay: function() {
                        this.swf.triggerFlash("instream:play")
                    },
                    instreamPause: function() {
                        this.swf.triggerFlash("instream:pause")
                    }
                }, g);
                return l
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(92), d(45), d(43), d(44)], e = function(j, f, g, h) {
                var i = function(u, o, m, s) {
                    var n = this,
                        t;
                    var q = j.getQueue();
                    var w = 30;
                    this.start = function() {
                        t = setTimeout(k, w * 1000);
                        l()
                    };
                    this.destroy = function() {
                        clearTimeout(t);
                        this.off();
                        q.length = 0;
                        u = null;
                        o = null;
                        m = null
                    };

                    function k() {
                        v("Setup Timeout Error", "Setup took longer than " + w + " seconds to complete.")
                    }

                    function l() {
                        g.each(q, function(y) {
                            if (y.complete === true || y.running === true || u === null) {
                                return
                            }
                            if (r(y.depends)) {
                                y.running = true;
                                x(y)
                            }
                        })
                    }

                    function x(y) {
                        var z = function(A) {
                            A = A || {};
                            p(y, A)
                        };
                        y.method(z, o, u, m, s)
                    }

                    function r(y) {
                        return g.all(y, function(z) {
                            return q[z].complete
                        })
                    }

                    function p(y, z) {
                        if (z.type === "error") {
                            v(z.msg, z.reason)
                        } else {
                            if (z.type === "complete") {
                                clearTimeout(t);
                                n.trigger(h.JWPLAYER_READY)
                            } else {
                                y.complete = true;
                                l()
                            }
                        }
                    }

                    function v(y, z) {
                        clearTimeout(t);
                        n.trigger(h.JWPLAYER_SETUP_ERROR, {
                            message: y + ": " + z
                        });
                        n.destroy()
                    }
                };
                i.prototype = f;
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(76), d(93), d(63), d(85), d(57), d(43), d(46), d(44)], e = function(k, u, i, C, g, F, B, f) {
                var p, y;

                function j() {
                    var G = {
                        LOAD_PROMISE_POLYFILL: {
                            method: m,
                            depends: []
                        },
                        LOAD_BASE64_POLYFILL: {
                            method: t,
                            depends: []
                        },
                        LOADED_POLYFILLS: {
                            method: n,
                            depends: ["LOAD_PROMISE_POLYFILL", "LOAD_BASE64_POLYFILL"]
                        },
                        LOAD_PLUGINS: {
                            method: z,
                            depends: ["LOADED_POLYFILLS"]
                        },
                        INIT_PLUGINS: {
                            method: w,
                            depends: ["LOAD_PLUGINS", "SETUP_VIEW"]
                        },
                        LOAD_PROVIDERS: {
                            method: l,
                            depends: ["FILTER_PLAYLIST"]
                        },
                        LOAD_SKIN: {
                            method: D,
                            depends: ["LOADED_POLYFILLS"]
                        },
                        LOAD_PLAYLIST: {
                            method: o,
                            depends: ["LOADED_POLYFILLS"]
                        },
                        FILTER_PLAYLIST: {
                            method: s,
                            depends: ["LOAD_PLAYLIST"]
                        },
                        SETUP_VIEW: {
                            method: A,
                            depends: ["LOAD_SKIN"]
                        },
                        SEND_READY: {
                            method: q,
                            depends: ["INIT_PLUGINS", "LOAD_PROVIDERS", "SETUP_VIEW"]
                        }
                    };
                    return G
                }

                function m(G) {
                    if (!window.Promise) {
                        d.e(3, function(H) {
                            d(98);
                            G()
                        })
                    } else {
                        G()
                    }
                }

                function t(G) {
                    if (!window.btoa || !window.atob) {
                        d.e(4, function(H) {
                            d(99);
                            G()
                        })
                    } else {
                        G()
                    }
                }

                function n(G) {
                    G()
                }

                function z(G, H) {
                    p = u.loadPlugins(H.get("id"), H.get("plugins"));
                    p.on(f.COMPLETE, G);
                    p.on(f.ERROR, F.partial(v, G));
                    p.load()
                }

                function w(H, I, G) {
                    p.setupPlugins(G, I);
                    H()
                }

                function v(H, G) {
                    x(H, "Could not load plugin", G.message)
                }

                function o(G, I) {
                    var H = I.get("playlist");
                    if (F.isString(H)) {
                        y = new i();
                        y.on(f.JWPLAYER_PLAYLIST_LOADED, function(J) {
                            I.set("playlist", J.playlist);
                            I.set("feedid", J.feedid);
                            G()
                        });
                        y.on(f.JWPLAYER_ERROR, F.partial(r, G));
                        y.load(H)
                    } else {
                        G()
                    }
                }

                function s(I, L, G, M, H) {
                    var K = L.get("playlist");
                    var J = H(K);
                    if (J) {
                        I()
                    } else {
                        r(I)
                    }
                }

                function r(H, G) {
                    if (G && G.message) {
                        x(H, "Error loading playlist", G.message)
                    } else {
                        x(H, "Error loading player", "No playable sources found")
                    }
                }

                function h(H, G) {
                    if (F.contains(g.SkinsLoadable, H)) {
                        return G + "skins/" + H + ".css"
                    }
                }

                function E(J) {
                    var I = document.styleSheets;
                    for (var H = 0, G = I.length; H < G; H++) {
                        if (I[H].href === J) {
                            return true
                        }
                    }
                    return false
                }

                function D(K, L) {
                    var J = L.get("skin");
                    var I = L.get("skinUrl");
                    if (F.contains(g.SkinsIncluded, J)) {
                        K();
                        return
                    }
                    if (!I) {
                        I = h(J, L.get("base"))
                    }
                    if (F.isString(I) && !E(I)) {
                        L.set("skin-loading", true);
                        var H = true;
                        var G = new C(I, H);
                        G.addEventListener(f.COMPLETE, function() {
                            L.set("skin-loading", false)
                        });
                        G.addEventListener(f.ERROR, function() {
                            L.set("skin", "seven");
                            L.set("skin-loading", false)
                        });
                        G.load()
                    }
                    F.defer(function() {
                        K()
                    })
                }

                function l(J, G) {
                    var H = G.getProviders();
                    var K = G.get("playlist");
                    var I = H.required(K);
                    k.load(I).then(J)
                }

                function A(H, I, G, J) {
                    J.setup();
                    H()
                }

                function q(G) {
                    G({
                        type: "complete"
                    })
                }

                function x(G, I, H) {
                    G({
                        type: "error",
                        msg: I,
                        reason: H
                    })
                }
                return {
                    getQueue: j,
                    error: x
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(94), d(96), d(97), d(95)], e = function(k, g, j, f) {
                var m = {},
                    i = {};
                var h = function(o, n) {
                    i[o] = new k(new g(m), n);
                    return i[o]
                };
                var l = function(r, q, p, o) {
                    var n = f.getPluginName(r);
                    if (!m[n]) {
                        m[n] = new j(r)
                    }
                    m[n].registerPlugin(r, q, p, o)
                };
                return {
                    loadPlugins: h,
                    registerPlugin: l
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(95), d(46), d(44), d(45), d(43), d(85)], e = function(g, j, m, n, k, i) {
                function f(p, o, q) {
                    return function() {
                        var r = p.getContainer().getElementsByClassName("jw-overlays")[0];
                        if (!r) {
                            return
                        }
                        r.appendChild(q);
                        q.left = r.style.left;
                        q.top = r.style.top;
                        o.displayArea = r
                    }
                }

                function h(o) {
                    function p() {
                        var q = o.displayArea;
                        if (q) {
                            o.resize(q.clientWidth, q.clientHeight)
                        }
                    }
                    return function() {
                        p();
                        setTimeout(p, 400)
                    }
                }
                var l = function(s, v) {
                    var u = k.extend(this, n),
                        x = i.loaderstatus.NEW,
                        o = false,
                        r = k.size(v),
                        y, p = false;

                    function q() {
                        if (!o) {
                            o = true;
                            x = i.loaderstatus.COMPLETE;
                            u.trigger(m.COMPLETE)
                        }
                    }

                    function w() {
                        if (p) {
                            return
                        }
                        if (!v || k.keys(v).length === 0) {
                            q()
                        }
                        if (!o) {
                            var z = s.getPlugins();
                            y = k.after(r, q);
                            k.each(v, function(D, B) {
                                var C = g.getPluginName(B),
                                    G = z[C],
                                    F = G.getJS(),
                                    E = G.getTarget(),
                                    A = G.getStatus();
                                if (A === i.loaderstatus.LOADING || A === i.loaderstatus.NEW) {
                                    return
                                } else {
                                    if (F && !j.versionCheck(E)) {
                                        u.trigger(m.ERROR, {
                                            message: "Incompatible player version"
                                        })
                                    }
                                }
                                y()
                            })
                        }
                    }

                    function t(A) {
                        if (p) {
                            return
                        }
                        var z = "File not found";
                        if (A.url) {
                            j.log(z, A.url)
                        }
                        this.off();
                        this.trigger(m.ERROR, {
                            message: z
                        });
                        w()
                    }
                    this.setupPlugins = function(D, C) {
                        var B = [],
                            z = s.getPlugins();
                        var A = C.get("plugins");
                        k.each(A, function(I, G) {
                            var H = g.getPluginName(G),
                                K = z[H],
                                L = K.getFlashPath(),
                                M = K.getJS(),
                                E = K.getURL();
                            if (L) {
                                var J = k.extend({
                                    name: H,
                                    swf: L,
                                    pluginmode: K.getPluginmode()
                                }, I);
                                B.push(J)
                            }
                            var F = j.tryCatch(function() {
                                if (M && A[E]) {
                                    var P = document.createElement("div");
                                    P.id = D.id + "_" + H;
                                    P.className = "jw-plugin jw-reset";
                                    var O = k.extend({}, A[E]);
                                    var N = K.getNewInstance(D, O, P);
                                    N.addToPlayer = f(D, N, P);
                                    N.resizeHandler = h(N);
                                    D.addPlugin(H, N, P)
                                }
                            });
                            if (F instanceof j.Error) {
                                j.log("ERROR: Failed to load " + H + ".")
                            }
                        });
                        C.set("flashPlugins", B)
                    };
                    this.load = function() {
                        if (j.exists(v) && j.typeOf(v) !== "object") {
                            w();
                            return
                        }
                        x = i.loaderstatus.LOADING;
                        k.each(v, function(B, A) {
                            if (j.exists(A)) {
                                var C = s.addPlugin(A);
                                C.on(m.COMPLETE, w);
                                C.on(m.ERROR, t)
                            }
                        });
                        var z = s.getPlugins();
                        k.each(z, function(A) {
                            A.load()
                        });
                        w()
                    };
                    this.destroy = function() {
                        p = true;
                        this.off()
                    };
                    this.getStatus = function() {
                        return x
                    }
                };
                return l
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48)], e = function(f) {
                var g = {};
                var h = g.pluginPathType = {
                    ABSOLUTE: 0,
                    RELATIVE: 1,
                    CDN: 2
                };
                g.getPluginPathType = function(j) {
                    if (typeof j !== "string") {
                        return
                    }
                    j = j.split("?")[0];
                    var k = j.indexOf("://");
                    if (k > 0) {
                        return h.ABSOLUTE
                    }
                    var i = j.indexOf("/");
                    var l = f.extension(j);
                    if (k < 0 && i < 0 && (!l || !isNaN(l))) {
                        return h.CDN
                    }
                    return h.RELATIVE
                };
                g.getPluginName = function(i) {
                    return i.replace(/^(.*\/)?([^-]*)-?.*\.(swf|js)$/, "$2")
                };
                g.getPluginVersion = function(i) {
                    return i.replace(/[^-]*-?([^\.]*).*$/, "$1")
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(95), d(97)], e = function(f, h) {
                var g = function(i) {
                    this.addPlugin = function(j) {
                        var k = f.getPluginName(j);
                        if (!i[k]) {
                            i[k] = new h(j)
                        }
                        return i[k]
                    };
                    this.getPlugins = function() {
                        return i
                    }
                };
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(95), d(44), d(45), d(85), d(43)], e = function(h, f, j, g, m, i) {
                var l = {
                    FLASH: 0,
                    JAVASCRIPT: 1,
                    HYBRID: 2
                };
                var k = function(n) {
                    var r = i.extend(this, g),
                        u = m.loaderstatus.NEW,
                        v, t, o, w;

                    function p() {
                        switch (f.getPluginPathType(n)) {
                            case f.pluginPathType.ABSOLUTE:
                                return n;
                            case f.pluginPathType.RELATIVE:
                                return h.getAbsolutePath(n, window.location.href)
                        }
                    }

                    function s() {
                        i.defer(function() {
                            u = m.loaderstatus.COMPLETE;
                            r.trigger(j.COMPLETE)
                        })
                    }

                    function q() {
                        u = m.loaderstatus.ERROR;
                        r.trigger(j.ERROR, {
                            url: n
                        })
                    }
                    this.load = function() {
                        if (u !== m.loaderstatus.NEW) {
                            return
                        }
                        if (n.lastIndexOf(".swf") > 0) {
                            v = n;
                            u = m.loaderstatus.COMPLETE;
                            r.trigger(j.COMPLETE);
                            return
                        }
                        if (f.getPluginPathType(n) === f.pluginPathType.CDN) {
                            u = m.loaderstatus.COMPLETE;
                            r.trigger(j.COMPLETE);
                            return
                        }
                        u = m.loaderstatus.LOADING;
                        var x = new m(p());
                        x.on(j.COMPLETE, s);
                        x.on(j.ERROR, q);
                        x.load()
                    };
                    this.registerPlugin = function(A, z, y, x) {
                        if (w) {
                            clearTimeout(w);
                            w = undefined
                        }
                        o = z;
                        if (y && x) {
                            v = x;
                            t = y
                        } else {
                            if (typeof y === "string") {
                                v = y
                            } else {
                                if (typeof y === "function") {
                                    t = y
                                } else {
                                    if (!y && !x) {
                                        v = A
                                    }
                                }
                            }
                        }
                        u = m.loaderstatus.COMPLETE;
                        r.trigger(j.COMPLETE)
                    };
                    this.getStatus = function() {
                        return u
                    };
                    this.getPluginName = function() {
                        return f.getPluginName(n)
                    };
                    this.getFlashPath = function() {
                        if (v) {
                            switch (f.getPluginPathType(v)) {
                                case f.pluginPathType.ABSOLUTE:
                                    return v;
                                case f.pluginPathType.RELATIVE:
                                    if (n.lastIndexOf(".swf") > 0) {
                                        return h.getAbsolutePath(v, window.location.href)
                                    }
                                    return h.getAbsolutePath(v, p())
                            }
                        }
                        return null
                    };
                    this.getJS = function() {
                        return t
                    };
                    this.getTarget = function() {
                        return o
                    };
                    this.getPluginmode = function() {
                        if (typeof v !== undefined && typeof t !== undefined) {
                            return l.HYBRID
                        } else {
                            if (typeof v !== undefined) {
                                return l.FLASH
                            } else {
                                if (typeof t !== undefined) {
                                    return l.JAVASCRIPT
                                }
                            }
                        }
                    };
                    this.getNewInstance = function(y, x, z) {
                        return new t(y, x, z)
                    };
                    this.getURL = function() {
                        return n
                    }
                };
                return k
            }.apply(b, a), e !== undefined && (c.exports = e))
        }, , ,
        function(c, b, d) {
            var a, e;
            !(a = [d(64), d(101), d(102), d(46)], e = function(i, h, g, f) {
                var j = function(x, y) {
                    var B = this;
                    B._api = x;
                    y.on("change:playlistItem", w, this);
                    y.on("change:captionsIndex", u, this);
                    y.on("itemReady", p, this);
                    y.mediaController.on("subtitlesTracks", t, this);

                    function t(J) {
                        if (!J.tracks.length) {
                            return
                        }
                        y.mediaController.off("meta", E);
                        k = [];
                        m = {};
                        o = {};
                        F = 0;
                        var H = J.tracks || [];
                        for (var I = 0; I < H.length; I++) {
                            var G = H[I];
                            G.id = G.name;
                            G.label = G.name || G.language;
                            z(G)
                        }
                        var K = n();
                        this.setCaptionsList(K);
                        q()
                    }
                    y.mediaController.on("subtitlesTrackData", function(M) {
                        var H = m[M.name];
                        if (!H) {
                            return
                        }
                        H.source = M.source;
                        var I = M.captions || [];
                        var K = false;
                        for (var J = 0; J < I.length; J++) {
                            var G = I[J];
                            var L = M.name + "_" + G.begin + "_" + G.end;
                            if (!o[L]) {
                                o[L] = G;
                                H.data.push(G);
                                K = true
                            }
                        }
                        if (K) {
                            H.data.sort(function(O, N) {
                                return O.begin - N.begin
                            })
                        }
                    }, this);
                    y.mediaController.on("meta", E, this);
                    var s = {},
                        k = [],
                        m = {},
                        o = {},
                        F = 0;

                    function E(L) {
                        var I = L.metadata;
                        if (!I) {
                            return
                        }
                        if (I.type === "textdata") {
                            if (!I.text) {
                                return
                            }
                            var H = m[I.trackid];
                            if (!H) {
                                H = {
                                    kind: "captions",
                                    id: I.trackid,
                                    data: []
                                };
                                z(H);
                                var M = n();
                                this.setCaptionsList(M)
                            }
                            var K, J;
                            if (I.useDTS) {
                                if (!H.source) {
                                    H.source = I.source || "mpegts"
                                }
                                K = I.begin;
                                J = I.begin + "_" + I.text
                            } else {
                                K = L.position || y.get("position");
                                J = "" + Math.round(K * 10) + "_" + I.text
                            }
                            var G = o[J];
                            if (!G) {
                                G = {
                                    begin: K,
                                    text: I.text
                                };
                                if (I.end) {
                                    G.end = I.end
                                }
                                o[J] = G;
                                H.data.push(G)
                            }
                        }
                    }

                    function v(G) {
                        f.log("CAPTIONS(" + G + ")")
                    }

                    function w(G, H) {
                        s = H;
                        k = [];
                        m = {};
                        o = {};
                        F = 0
                    }

                    function p(K) {
                        w(y, K);
                        y.mediaController.off("meta", E);
                        y.mediaController.off("subtitlesTracks", t);
                        var H = K.tracks,
                            G, J, I;
                        for (I = 0; I < H.length; I++) {
                            G = H[I];
                            J = G.kind.toLowerCase();
                            if (J === "captions" || J === "subtitles") {
                                if (G.file) {
                                    z(G);
                                    D(G)
                                } else {
                                    if (G.data) {
                                        z(G)
                                    }
                                }
                            }
                        }
                        var L = n();
                        B.setCaptionsList(L);
                        q()
                    }

                    function C() {
                        var H = k,
                            G, J, I;
                        k = [];
                        for (I = 0; I < H.length; I++) {
                            G = H[I];
                            J = G.kind.toLowerCase();
                            if (J === "captions" || J === "subtitles") {
                                if (G.file) {
                                    z(G)
                                } else {
                                    if (G.data) {
                                        z(G)
                                    }
                                }
                            }
                        }
                        var K = n();
                        B.setCaptionsList(K);
                        q()
                    }

                    function u(I, J) {
                        if (k && k.length > 1) {
                            if (J === 1) {
                                var H = this.getCaptionsList();
                                if (H !== undefined && H !== null && H.length > 1) {
                                    var K = this.getCurrentIndex();
                                    if (K === 3) {
                                        B._api.setSecondCaptions(0)
                                    } else {
                                        if (K === 2) {
                                            B._api.setSecondCaptions(1)
                                        } else {
                                            B._api.setSecondCaptions(0);
                                            G = k[k.length - 1];
                                            I.set("captionsTrack", G)
                                        }
                                    }
                                }
                                return
                            } else {
                                B._api.setSecondCaptions(-1)
                            }
                        }
                        var G = null;
                        if (J !== 0) {
                            if (k.length > 1) {
                                G = k[J - 2]
                            } else {
                                G = k[J - 1]
                            }
                        }
                        I.set("captionsTrack", G)
                    }

                    function z(G) {
                        if (typeof G.id !== "number") {
                            G.id = G.name || G.file || ("cc" + k.length)
                        }
                        G.data = G.data || [];
                        if (!G.label) {
                            G.label = "Unknown CC";
                            F++;
                            if (F > 1) {
                                G.label += " (" + F + ")"
                            }
                        }
                        k.push(G);
                        m[G.id] = G
                    }

                    function D(G) {
                        f.ajax(G.file, function(H) {
                            A(H, G)
                        }, function(H) {
                            delete G.file;
                            delete G.data;
                            r(H);
                            C()
                        }, true)
                    }

                    function A(I, H) {
                        var J = I.responseXML ? I.responseXML.firstChild : null,
                            G;
                        if (J) {
                            if (i.localName(J) === "xml") {
                                J = J.nextSibling
                            }
                            while (J.nodeType === J.COMMENT_NODE) {
                                J = J.nextSibling
                            }
                        }
                        if (J && i.localName(J) === "tt") {
                            G = f.tryCatch(function() {
                                H.data = g(I.responseXML)
                            })
                        } else {
                            G = f.tryCatch(function() {
                                H.data = h(I.responseText)
                            })
                        }
                        if (G instanceof f.Error) {
                            v(G.message + ": " + H.file)
                        }
                    }

                    function r(G) {
                        v(G)
                    }

                    function n() {
                        var H = [{
                            id: "off",
                            label: "Tắt phụ đề"
                        }];
                        if (k.length > 1) {
                            H.push({
                                id: "double",
                                label: "Song Ngữ"
                            })
                        }
                        for (var G = 0; G < k.length; G++) {
                            H.push({
                                id: k[G].id,
                                label: k[G].label || "Unknown CC"
                            })
                        }
                        return H
                    }

                    function q() {
                        var J = 0;
                        var H = y.get("captionLabel");
                        if (H === "Off" || H === "Tắt phụ đề") {
                            y.set("captionsIndex", 0);
                            return
                        }
                        if (H === "double" || H === "Song ngữ") {
                            y.set("captionsIndex", k.length - 1);
                            return
                        }
                        for (var I = 0; I < k.length; I++) {
                            var G = k[I];
                            if (H && H === G.label) {
                                J = I + 1;
                                break
                            } else {
                                if (G["default"] || G.defaulttrack) {
                                    J = I + 1
                                } else {
                                    if (G.autoselect) {}
                                }
                            }
                        }
                        if (k.length > 1) {
                            J = J + 1
                        }
                        l(J)
                    }

                    function l(G) {
                        if (k.length) {
                            y.setVideoSubtitleTrack(G, k)
                        } else {
                            y.set("captionsIndex", G)
                        }
                    }
                    this.getCurrentIndex = function() {
                        return y.get("captionsIndex")
                    };
                    this.getCaptionsList = function() {
                        return y.get("captionsList")
                    };
                    this.setCaptionsList = function(G) {
                        y.set("captionsList", G)
                    };
                    this.reloadPlaylistItem = function(G) {
                        p(G)
                    };
                    this.getDataCaption = function(G) {
                        return k[G]
                    }
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(48)], e = function(h, f) {
                var i = h.seconds;
                return function(n) {
                    var k = [];
                    n = f.trim(n);
                    var m = n.split("\r\n\r\n");
                    if (m.length === 1) {
                        m = n.split("\n\n")
                    }
                    for (var j = 0; j < m.length; j++) {
                        if (m[j] === "WEBVTT") {
                            continue
                        }
                        var l = g(m[j]);
                        if (l.text) {
                            k.push(l)
                        }
                    }
                    if (!k.length) {
                        throw new Error("Invalid SRT file")
                    }
                    return k
                };

                function g(n) {
                    var m = {};
                    var o = n.split("\r\n");
                    if (o.length === 1) {
                        o = n.split("\n")
                    }
                    var j = 1;
                    if (o[0].indexOf(" --> ") > 0) {
                        j = 0
                    }
                    if (o.length > j + 1 && o[j + 1]) {
                        var k = o[j];
                        var l = k.indexOf(" --> ");
                        if (l > 0) {
                            m.begin = i(k.substr(0, l));
                            m.end = i(k.substr(l + 5));
                            m.text = o.slice(j + 1).join("<br/>")
                        }
                    }
                    return m
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(48)], e = function(f) {
                var h = f.seconds;
                return function(u) {
                    i(u);
                    var s = [];
                    var q = u.getElementsByTagName("p");
                    i(q);
                    if (!q.length) {
                        q = u.getElementsByTagName("tt:p");
                        if (!q.length) {
                            q = u.getElementsByTagName("tts:p")
                        }
                    }
                    for (var n = 0; n < q.length; n++) {
                        var k = q[n];
                        var o = (k.innerHTML || k.textContent || k.text || "");
                        var t = f.trim(o).replace(/>\s+</g, "><").replace(/tts?:/g, "");
                        if (t) {
                            var l = k.getAttribute("begin");
                            var j = k.getAttribute("dur");
                            var m = k.getAttribute("end");
                            var r = {
                                begin: h(l),
                                text: t
                            };
                            if (m) {
                                r.end = h(m)
                            } else {
                                if (j) {
                                    r.end = r.begin + h(j)
                                }
                            }
                            s.push(r)
                        }
                    }
                    if (!s.length) {
                        g()
                    }
                    return s
                };

                function i(j) {
                    if (!j) {
                        g()
                    }
                }

                function g() {
                    throw new Error("Invalid DFXP file")
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(68), d(69), d(43), d(76)], e = function(m, j, f, i) {
                var l = function(n) {
                    n = (f.isArray(n) ? n : [n]);
                    return f.compact(f.map(n, m))
                };
                l.filterPlaylist = function(t, q, s, p, o, n) {
                    var r = [];
                    f.each(t, function(u) {
                        u = f.extend({}, u);
                        u.allSources = h(u.sources, s, u.drm || p, u.preload || o);
                        u.sources = k(u.allSources, q);
                        if (!u.sources.length) {
                            return
                        }
                        u.file = u.sources[0].file;
                        if (u.preload || o) {
                            u.preload = u.preload || o
                        }
                        if (u.feedid || n) {
                            u.feedid = u.feedid || n
                        }
                        r.push(u)
                    });
                    return r
                };
                var h = function(o, p, q, n) {
                    return f.compact(f.map(o, function(r) {
                        if (!f.isObject(r)) {
                            return
                        }
                        if (p !== undefined && p !== null) {
                            r.androidhls = p
                        }
                        if (r.drm || q) {
                            r.drm = r.drm || q
                        }
                        if (r.preload || n) {
                            r.preload = r.preload || n
                        }
                        return j(r)
                    }))
                };
                var k = function(n, o) {
                    if (!o || !o.choose) {
                        o = new i({
                            primary: o ? "flash" : null
                        })
                    }
                    var p = g(n, o);
                    return f.where(n, {
                        type: p
                    })
                };

                function g(o, q) {
                    for (var p = 0; p < o.length; p++) {
                        var r = o[p];
                        var n = q.choose(r);
                        if (n) {
                            return r.type
                        }
                    }
                    return null
                }
                return l
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [], e = function() {
                return function(g, h) {
                    g.getPlaylistIndex = g.getItem;
                    var f = {
                        jwPlay: h.play,
                        jwPause: h.pause,
                        jwSetMute: h.setMute,
                        jwLoad: h.load,
                        jwPlaylistItem: h.item,
                        jwGetAudioTracks: h.getAudioTracks,
                        jwDetachMedia: h.detachMedia,
                        jwAttachMedia: h.attachMedia,
                        jwAddEventListener: h.on,
                        jwRemoveEventListener: h.off,
                        jwStop: h.stop,
                        jwSeek: h.seek,
                        jwSetVolume: h.setVolume,
                        jwPlaylistNext: h.next,
                        jwPlaylistPrev: h.prev,
                        jwSetFullscreen: h.setFullscreen,
                        jwGetQualityLevels: h.getQualityLevels,
                        jwGetCurrentQuality: h.getCurrentQuality,
                        jwSetCurrentQuality: h.setCurrentQuality,
                        jwSetCurrentAudioTrack: h.setCurrentAudioTrack,
                        jwGetCurrentAudioTrack: h.getCurrentAudioTrack,
                        jwGetCaptionsList: h.getCaptionsList,
                        jwGetCurrentCaptions: h.getCurrentCaptions,
                        jwSetCurrentCaptions: h.setCurrentCaptions,
                        jwSetCues: h.setCues
                    };
                    g.callInternal = function(j) {
                        console.log("You are using the deprecated callInternal method for " + j);
                        var i = Array.prototype.slice.call(arguments, 1);
                        f[j].apply(h, i)
                    }
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(44), d(45), d(57), d(61), d(128), d(129), d(130), d(132), d(106), d(134), d(150), d(151), d(153), d(43), d(154)], e = function(x, f, q, j, l, g, i, t, y, o, h, k, p, m, z, n) {
                var u = x.style,
                    r = x.bounds,
                    v = x.isMobile(),
                    w = ["fullscreenchange", "webkitfullscreenchange", "mozfullscreenchange", "MSFullscreenChange"];
                var s = function(aB, C) {
                    var aN, aG, aJ = -1,
                        ar = v ? 4000 : 2000,
                        au = 40,
                        ah, af, S, R, am = false,
                        aL, aT, G, aV, an, H, aZ, A, ax, ad = false,
                        ac, aP = -1,
                        aR = -1,
                        ae, X, E, V, aU = false,
                        ap = false,
                        P = z.extend(this, q);
                    if (window.webpackJsonpjwplayer) {
                        d(155)
                    }
                    this.model = C;
                    this.api = aB;
                    aN = x.createElement(n({
                        id: C.get("id")
                    }));
                    if (x.isIE()) {
                        x.addClass(aN, "jw-ie")
                    }
                    var aK = C.get("width"),
                        N = C.get("height");
                    u(aN, {
                        width: aK.toString().indexOf("%") > 0 ? aK : (aK + "px"),
                        height: N.toString().indexOf("%") > 0 ? N : (N + "px")
                    });
                    E = aN.requestFullscreen || aN.webkitRequestFullscreen || aN.webkitRequestFullScreen || aN.mozRequestFullScreen || aN.msRequestFullscreen;
                    V = document.exitFullscreen || document.webkitExitFullscreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || document.msExitFullscreen;
                    aU = E && V;

                    function aW(a4) {
                        var a3 = 0;
                        var a1 = C.get("duration");
                        var a0 = C.get("position");
                        if (x.adaptiveType(a1) === "DVR") {
                            a3 = a1;
                            a1 = Math.max(a0, j.dvrSeekLimit)
                        }
                        var a2 = x.between(a0 + a4, a3, a1);
                        aB.seek(a2)
                    }

                    function aY(a0) {
                        var a1 = x.between(C.get("volume") + a0, 0, 100);
                        aB.setVolume(a1)
                    }

                    function aD(a0) {
                        if (a0.ctrlKey || a0.metaKey) {
                            return false
                        }
                        if (!C.get("controls")) {
                            return false
                        }
                        return true
                    }

                    function I(a0) {
                        if (!aD(a0)) {
                            return true
                        }
                        if (!am) {
                            aQ()
                        }
                        switch (a0.keyCode) {
                            case 27:
                                aB.setFullscreen(false);
                                break;
                            case 13:
                                aB.setFullscreen();
                                break;
                            case 32:
                                aB.play({
                                    reason: "interaction"
                                });
                                break;
                            case 37:
                                if (!am) {
                                    aW(-5)
                                }
                                break;
                            case 39:
                                if (!am) {
                                    aW(5)
                                }
                                break;
                            case 38:
                                aY(10);
                                break;
                            case 40:
                                aY(-10);
                                break;
                            case 77:
                                aB.setMute();
                                break;
                            case 70:
                                aB.setFullscreen();
                                break;
                            default:
                                if (a0.keyCode >= 48 && a0.keyCode <= 59) {
                                    var a2 = a0.keyCode - 48;
                                    var a1 = (a2 / 10) * C.get("duration");
                                    aB.seek(a1)
                                }
                                break
                        }
                        if (/13|32|37|38|39|40/.test(a0.keyCode)) {
                            a0.preventDefault();
                            return false
                        }
                    }

                    function aj() {
                        ap = false;
                        x.removeClass(aN, "jw-no-focus")
                    }

                    function aE() {
                        ap = true;
                        x.addClass(aN, "jw-no-focus")
                    }

                    function F() {
                        if (!ap) {
                            aj()
                        }
                        if (!am) {
                            aQ()
                        }
                    }

                    function aA() {
                        var a0 = r(aN),
                            a2 = Math.round(a0.width),
                            a1 = Math.round(a0.height);
                        if (!document.body.contains(aN)) {
                            window.removeEventListener("resize", aA);
                            if (v) {
                                window.removeEventListener("orientationchange", aA)
                            }
                        } else {
                            if (a2 && a1) {
                                if (a2 !== af || a1 !== S) {
                                    af = a2;
                                    S = a1;
                                    clearTimeout(aP);
                                    aP = setTimeout(aa, 50);
                                    C.set("containerWidth", a2);
                                    C.set("containerHeight", a1);
                                    P.trigger(f.JWPLAYER_RESIZE, {
                                        width: a2,
                                        height: a1
                                    })
                                }
                            }
                        }
                        return a0
                    }
                    this.onChangeSkin = function(a0, a1) {
                        x.replaceClass(aN, /jw-skin-\S+/, a1 ? ("jw-skin-" + a1) : "")
                    };
                    this.handleColorOverrides = function() {
                        var a4 = C.get("id");

                        function a2(a7, a5, a6) {
                            if (!a6) {
                                return
                            }
                            a7 = x.prefix(a7, "#" + a4 + " ");
                            var a8 = {};
                            a8[a5] = a6;
                            x.css(a7.join(", "), a8)
                        }
                        var a3 = C.get("skinColorActive"),
                            a1 = C.get("skinColorInactive"),
                            a0 = C.get("skinColorBackground");
                        a2([".jw-toggle", ".jw-button-color:hover"], "color", a3);
                        a2([".jw-active-option", ".jw-progress", ".jw-playlist-container .jw-option.jw-active-option", ".jw-playlist-container .jw-option:hover"], "background", a3);
                        a2([".jw-text", ".jw-option", ".jw-button-color", ".jw-toggle.jw-off", ".jw-tooltip-title", ".jw-skip .jw-skip-icon", ".jw-playlist-container .jw-icon"], "color", a1);
                        a2([".jw-cue", ".jw-knob"], "background", a1);
                        a2([".jw-playlist-container .jw-option"], "border-bottom-color", a1);
                        a2([".jw-background-color", ".jw-tooltip-title", ".jw-playlist", ".jw-playlist-container .jw-option"], "background", a0);
                        a2([".jw-playlist-container ::-webkit-scrollbar"], "border-color", a0)
                    };
                    this.setup = function() {
                        this.handleColorOverrides();
                        if (C.get("skin-loading") === true) {
                            x.addClass(aN, "jw-flag-skin-loading");
                            C.once("change:skin-loading", function() {
                                x.removeClass(aN, "jw-flag-skin-loading")
                            })
                        }
                        this.onChangeSkin(C, C.get("skin"), "");
                        C.on("change:skin", this.onChangeSkin, this);
                        ah = aN.getElementsByClassName("jw-media")[0];
                        aG = aN.getElementsByClassName("jw-controls")[0];
                        var a1 = aN.getElementsByClassName("jw-preview")[0];
                        aT = new k(C);
                        aT.setup(a1);
                        var a4 = aN.getElementsByClassName("jw-title")[0];
                        aZ = new m(C);
                        aZ.setup(a4);
                        O();
                        aQ();
                        C.set("mediaContainer", ah);
                        C.mediaController.on("fullscreenchange", D);
                        for (var a2 = w.length; a2--;) {
                            document.addEventListener(w[a2], D, false)
                        }
                        window.removeEventListener("resize", aA);
                        window.addEventListener("resize", aA, false);
                        if (v) {
                            window.removeEventListener("orientationchange", aA);
                            window.addEventListener("orientationchange", aA, false)
                        }
                        C.on("change:errorEvent", aF);
                        C.on("change:controls", aq);
                        aq(C, C.get("controls"));
                        C.on("change:state", J);
                        C.on("change:duration", aC, this);
                        C.on("change:flashBlocked", aI);
                        aI(C, C.get("flashBlocked"));
                        aB.onPlaylistComplete(aM);
                        aB.onPlaylistItem(Y);
                        C.on("change:castAvailable", aH);
                        aH(C, C.get("castAvailable"));
                        C.on("change:castActive", av);
                        av(C, C.get("castActive"));
                        if (C.get("stretching")) {
                            al(C, C.get("stretching"))
                        }
                        C.on("change:stretching", al);
                        J(C, l.IDLE);
                        C.on("change:fullscreen", ai);
                        T(aL);
                        T(H);
                        var a0 = C.get("aspectratio");
                        if (a0) {
                            x.addClass(aN, "jw-flag-aspect-mode");
                            var a3 = aN.getElementsByClassName("jw-aspect")[0];
                            u(a3, {
                                paddingTop: a0
                            })
                        }
                        aB.on(f.JWPLAYER_READY, function() {
                            aA();
                            M(C.get("width"), C.get("height"))
                        })
                    };

                    function av(a0, a1) {
                        a1 = a1 || false;
                        x.toggleClass(aN, "jw-flag-casting", a1)
                    }

                    function aH(a0, a1) {
                        x.toggleClass(aN, "jw-flag-cast-available", a1);
                        x.toggleClass(aG, "jw-flag-cast-available", a1)
                    }

                    function al(a1, a0) {
                        x.replaceClass(aN, /jw-stretch-\S+/, "jw-stretch-" + a0)
                    }

                    function az(a1, a0) {
                        x.toggleClass(aN, "jw-flag-compact-player", a0)
                    }

                    function T(a0) {
                        if (a0 && !v) {
                            a0.element().addEventListener("mousemove", B, false);
                            a0.element().addEventListener("mouseout", aS, false)
                        }
                    }

                    function ab() {
                        if ((C.get("state") === l.IDLE || C.get("state") === l.COMPLETE || C.get("state") === l.PAUSED) && C.get("controls")) {
                            aB.play({
                                reason: "interaction"
                            })
                        }
                        if (!ad) {
                            aQ()
                        } else {
                            ag()
                        }
                    }

                    function aO(a0) {
                        if (!a0.link) {
                            if (C.get("controls")) {
                                aB.play({
                                    reason: "interaction"
                                })
                            }
                        } else {
                            aB.pause(true);
                            aB.setFullscreen(false);
                            window.open(a0.link, a0.linktarget)
                        }
                    }

                    function B() {
                        clearTimeout(aJ)
                    }

                    function aS() {
                        aQ()
                    }

                    function ay(a0) {
                        P.trigger(a0.type, a0)
                    }

                    function aI(a0, a1) {
                        if (a1) {
                            if (ac) {
                                ac.destroy()
                            }
                            x.addClass(aN, "jw-flag-flash-blocked")
                        } else {
                            if (ac) {
                                ac.setup(C, aN, aN, aB)
                            }
                            x.removeClass(aN, "jw-flag-flash-blocked")
                        }
                    }
                    var aq = function(a1, a0) {
                        if (a0) {
                            var a2 = (am) ? R.get("state") : C.get("state");
                            J(a1, a2)
                        }
                        x.toggleClass(aN, "jw-flag-controls-disabled", !a0)
                    };

                    function L() {
                        if (C.get("controls")) {
                            aB.setFullscreen()
                        }
                    }

                    function O() {
                        var a3 = aN.getElementsByClassName("jw-overlays")[0];
                        a3.addEventListener("mousemove", aQ);
                        G = new i(C, ah, {
                            useHover: true
                        });
                        G.on("click", function() {
                            ay({
                                type: f.JWPLAYER_DISPLAY_CLICK
                            });
                            if (C.get("controls")) {
                                aB.play({
                                    reason: "interaction"
                                })
                            }
                        });
                        G.on("tap", function() {
                            ay({
                                type: f.JWPLAYER_DISPLAY_CLICK
                            });
                            ab()
                        });
                        G.on("doubleClick", L);
                        G.on("move", aQ);
                        G.on("over", aQ);
                        var a2 = new t(C);
                        a2.on("click", function() {
                            ay({
                                type: f.JWPLAYER_DISPLAY_CLICK
                            });
                            aB.play({
                                reason: "interaction"
                            })
                        });
                        a2.on("tap", function() {
                            ay({
                                type: f.JWPLAYER_DISPLAY_CLICK
                            });
                            ab()
                        });
                        if (x.isChrome()) {
                            a2.el.addEventListener("mousedown", function() {
                                var a6 = C.getVideo();
                                var a5 = (a6 && a6.getName().name.indexOf("flash") === 0);
                                if (!a5) {
                                    return
                                }
                                var a4 = function() {
                                    document.removeEventListener("mouseup", a4);
                                    a2.el.style.pointerEvents = "auto"
                                };
                                this.style.pointerEvents = "none";
                                document.addEventListener("mouseup", a4)
                            })
                        }
                        aG.appendChild(a2.element());
                        an = new y(C);
                        H = new o(C);
                        H.on(f.JWPLAYER_LOGO_CLICK, aO);
                        var a1 = document.createElement("div");
                        a1.className = "jw-controls-right jw-reset";
                        H.setup(a1);
                        a1.appendChild(an.element());
                        aG.appendChild(a1);
                        A = new g(C);
                        A.setup(C.get("captions"));
                        aG.parentNode.insertBefore(A.element(), aZ.element());
                        var a0 = C.get("height");
                        if (v && (typeof a0 === "string" || a0 >= au * 1.5)) {
                            x.addClass(aN, "jw-flag-touch")
                        } else {
                            ac = new p();
                            ac.setup(C, aN, aN, aB)
                        }
                        aL = new h(aB, C);
                        aL.on(f.JWPLAYER_USER_ACTION, aQ);
                        C.on("change:scrubbing", ao);
                        C.on("change:compactUI", az);
                        aG.appendChild(aL.element());
                        aN.addEventListener("focus", F);
                        aN.addEventListener("blur", aj);
                        aN.addEventListener("keydown", I);
                        aN.onmousedown = aE
                    }

                    function ak(a0) {
                        if (a0.get("state") === l.PAUSED) {
                            a0.once("change:state", ak);
                            return
                        }
                        if (a0.get("scrubbing") === false) {
                            x.removeClass(aN, "jw-flag-dragging")
                        }
                    }

                    function ao(a0, a1) {
                        a0.off("change:state", ak);
                        if (a1) {
                            x.addClass(aN, "jw-flag-dragging")
                        } else {
                            ak(a0)
                        }
                    }
                    var ai = function(a0, a1) {
                        var a2 = C.getVideo();
                        if (aU) {
                            if (a1) {
                                E.apply(aN)
                            } else {
                                V.apply(document)
                            }
                            aw(aN, a1)
                        } else {
                            if (x.isIE()) {
                                aw(aN, a1)
                            } else {
                                if (R && R.getVideo()) {
                                    R.getVideo().setFullscreen(a1)
                                }
                                a2.setFullscreen(a1)
                            }
                        }
                        if (a2 && a2.getName().name.indexOf("flash") === 0) {
                            a2.setFullscreen(a1)
                        }
                    };

                    function M(a3, a0, a1) {
                        var a2 = aN.className,
                            a4;
                        a1 = !!a1;
                        if (a1) {
                            a2 = a2.replace(/\s*aspectMode/, "");
                            if (aN.className !== a2) {
                                aN.className = a2
                            }
                            u(aN, {
                                display: "block"
                            }, a1)
                        }
                        if (x.exists(a3) && x.exists(a0)) {
                            C.set("width", a3);
                            C.set("height", a0)
                        }
                        a4 = {
                            width: a3
                        };
                        if (!x.hasClass(aN, "jw-flag-aspect-mode")) {
                            a4.height = a0
                        }
                        u(aN, a4, true);
                        U(a0);
                        aa(a3, a0)
                    }

                    function U(a0) {
                        ax = Z(a0);
                        if (aL) {
                            if (!ax) {
                                var a1 = am ? R : C;
                                J(a1, a1.get("state"))
                            }
                        }
                        x.toggleClass(aN, "jw-flag-audio-player", ax)
                    }

                    function Z(a0) {
                        if (C.get("aspectratio")) {
                            return false
                        }
                        if (z.isString(a0) && a0.indexOf("%") > -1) {
                            return false
                        }
                        var a1 = (z.isNumber(a0) ? a0 : C.get("containerHeight"));
                        return at(a1)
                    }

                    function at(a0) {
                        return a0 && a0 <= (au * ((v) ? 1.75 : 1))
                    }

                    function aa(a1, a0) {
                        if (!a1 || isNaN(Number(a1))) {
                            if (!ah) {
                                return
                            }
                            a1 = ah.clientWidth
                        }
                        if (!a0 || isNaN(Number(a0))) {
                            if (!ah) {
                                return
                            }
                            a0 = ah.clientHeight
                        }
                        if (x.isMSIE(9) && document.all && !window.atob) {
                            a1 = a0 = "100%"
                        }
                        var a3 = C.getVideo();
                        if (!a3) {
                            return
                        }
                        var a2 = a3.resize(a1, a0, C.get("stretching"));
                        if (a2) {
                            clearTimeout(aP);
                            aP = setTimeout(aa, 250)
                        }
                        aL.checkCompactMode(a1);
                        if (A) {
                            A.resize()
                        }
                    }
                    this.resize = function(a2, a0) {
                        var a1 = true;
                        M(a2, a0, a1);
                        aA();
                        if (A) {
                            A.resize()
                        }
                    };
                    this.resizeMedia = aa;
                    this.reset = function() {
                        if (document.contains(aN)) {
                            aN.parentNode.replaceChild(X, aN)
                        }
                        x.emptyElement(aN)
                    };

                    function Q() {
                        if (aU) {
                            var a0 = document.fullscreenElement || document.webkitCurrentFullScreenElement || document.mozFullScreenElement || document.msFullscreenElement;
                            return !!(a0 && a0.id === C.get("id"))
                        }
                        return am ? R.getVideo().getFullScreen() : C.getVideo().getFullScreen()
                    }

                    function D(a1) {
                        var a0 = C.get("fullscreen");
                        var a2 = (a1.jwstate !== undefined) ? a1.jwstate : Q();
                        if (a0 !== a2) {
                            C.set("fullscreen", a2)
                        }
                        clearTimeout(aP);
                        aP = setTimeout(aa, 200)
                    }

                    function aw(a1, a0) {
                        x.removeClass(a1, "jw-flag-fullscreen");
                        if (a0) {
                            x.addClass(a1, "jw-flag-fullscreen");
                            u(document.body, {
                                "overflow-y": "hidden"
                            });
                            aQ()
                        } else {
                            u(document.body, {
                                "overflow-y": ""
                            })
                        }
                        aa()
                    }

                    function ag() {
                        ad = false;
                        clearTimeout(aJ);
                        aL.hideComponents();
                        x.addClass(aN, "jw-flag-user-inactive");
                        aB.setMouse(false)
                    }

                    function aQ() {
                        if (!ad) {
                            x.removeClass(aN, "jw-flag-user-inactive");
                            aL.checkCompactMode(ah.clientWidth)
                        }
                        ad = true;
                        clearTimeout(aJ);
                        aJ = setTimeout(ag, ar);
                        aB.setMouse(true)
                    }

                    function aM() {
                        aB.setFullscreen(false)
                    }

                    function Y() {
                        if (aV) {
                            aV.setState(C.get("state"))
                        }
                        K(C, C.mediaModel.get("mediaType"));
                        C.mediaModel.on("change:mediaType", K, this)
                    }

                    function K(a1, a4) {
                        var a0 = (a4 === "audio");
                        var a3 = C.getVideo();
                        var a2 = (a3 && a3.getName().name.indexOf("flash") === 0);
                        x.toggleClass(aN, "jw-flag-media-audio", a0);
                        if (a0 && !a2) {
                            aN.insertBefore(aT.el, ah)
                        } else {
                            aN.insertBefore(aT.el, A.element())
                        }
                    }

                    function aC(a0, a2) {
                        var a1 = x.adaptiveType(a2) === "LIVE";
                        x.toggleClass(aN, "jw-flag-live", a1);
                        P.setAltText((a1) ? "Live Broadcast" : "")
                    }

                    function aF(a1, a0) {
                        if (!a0) {
                            aZ.playlistItem(a1, a1.get("playlistItem"));
                            return
                        }
                        if (a0.name) {
                            aZ.updateText(a0.name, a0.message)
                        } else {
                            aZ.updateText(a0.message, "")
                        }
                    }

                    function aX() {
                        var a0 = C.getVideo();
                        if (a0) {
                            return a0.isCaster
                        }
                        return false
                    }

                    function W() {
                        x.replaceClass(aN, /jw-state-\S+/, "jw-state-" + ae)
                    }

                    function J(a0, a1) {
                        ae = a1;
                        clearTimeout(aR);
                        if (a1 === l.COMPLETE || a1 === l.IDLE) {
                            aR = setTimeout(W, 100)
                        } else {
                            W()
                        }
                        if (aX()) {
                            x.addClass(ah, "jw-media-show");
                            return
                        }
                        switch (a1) {
                            case l.PLAYING:
                                aa();
                                break;
                            case l.PAUSED:
                                aQ();
                                break
                        }
                    }
                    this.setupInstream = function(a0) {
                        this.instreamModel = R = a0;
                        R.on("change:controls", aq, this);
                        R.on("change:state", J, this);
                        am = true;
                        x.addClass(aN, "jw-flag-ads");
                        aQ()
                    };
                    this.setAltText = function(a0) {
                        aL.setAltText(a0)
                    };
                    this.useExternalControls = function() {
                        x.addClass(aN, "jw-flag-ads-hide-controls")
                    };
                    this.destroyInstream = function() {
                        am = false;
                        if (R) {
                            R.off(null, null, this);
                            R = null
                        }
                        this.setAltText("");
                        x.removeClass(aN, "jw-flag-ads");
                        x.removeClass(aN, "jw-flag-ads-hide-controls");
                        if (C.getVideo) {
                            var a0 = C.getVideo();
                            a0.setContainer(ah)
                        }
                        aC(C, C.get("duration"));
                        G.revertAlternateClickHandlers()
                    };
                    this.addCues = function(a0) {
                        if (aL) {
                            aL.addCues(a0)
                        }
                    };
                    this.clickHandler = function() {
                        return G
                    };
                    this.controlsContainer = function() {
                        return aG
                    };
                    this.getContainer = this.element = function() {
                        return aN
                    };
                    this.getSafeRegion = function(a0) {
                        var a1 = {
                            x: 0,
                            y: 0,
                            width: C.get("containerWidth") || 0,
                            height: C.get("containerHeight") || 0
                        };
                        var a2 = C.get("dock");
                        if (a2 && a2.length && C.get("controls")) {
                            a1.y = an.element().clientHeight;
                            a1.height -= a1.y
                        }
                        a0 = a0 || !x.exists(a0);
                        if (a0 && C.get("controls")) {
                            a1.height -= aL.element().clientHeight
                        }
                        return a1
                    };
                    this.destroy = function() {
                        window.removeEventListener("resize", aA);
                        window.removeEventListener("orientationchange", aA);
                        for (var a0 = w.length; a0--;) {
                            document.removeEventListener(w[a0], D, false)
                        }
                        if (C.mediaController) {
                            C.mediaController.off("fullscreenchange", D)
                        }
                        aN.removeEventListener("keydown", I, false);
                        if (ac) {
                            ac.destroy()
                        }
                        if (aV) {
                            C.off("change:state", aV.statusDelegate);
                            aV.destroy();
                            aV = null
                        }
                        if (am) {
                            this.destroyInstream()
                        }
                        if (H) {
                            H.destroy()
                        }
                        x.clearCss("#" + C.get("id"))
                    };
                    this.reloadPlaylistItem = function(a0) {
                        aL.reloadPlaylistItem(a0)
                    };
                    this.setCaptionBack = function(a0) {
                        A.setCaptionBack(a0)
                    };
                    this.setCaptionDelay = function(a0) {
                        A.setCaptionDelay(a0)
                    };
                    this.setCaptionColor = function(a0) {
                        A.setCaptionColor(a0)
                    };
                    this.setCaptionLine = function(a0) {
                        A.setCaptionLine(a0)
                    };
                    this.setCaptionSize = function(a0) {
                        A.setCaptionSize(a0)
                    };
                    this.setCaptionFont = function(a0) {
                        A.setCaptionFont(a0)
                    };
                    this.setCaptionSecond = function(a0) {
                        A.setSecondCaptionsTrack(a0)
                    };
                    this.getCaptionStyle = function() {
                        return A.getCaptionStyle()
                    }
                };
                return s
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(107), d(46), d(44), d(43), d(45), d(108)], e = function(f, k, m, l, n, h) {
                var g = k.style;
                var j = {
                    linktarget: "_blank",
                    margin: 8,
                    hide: false,
                    position: "top-right"
                };
                var i = function(r) {
                    var q, o = new Image(),
                        p, s = l.extend({}, r.get("logo"));
                    l.extend(this, n);
                    this.setup = function(t) {
                        p = l.extend({}, j, s);
                        p.hide = (p.hide.toString() === "true");
                        q = k.createElement(h());
                        if (!p.file) {
                            return
                        }
                        if (p.hide) {
                            k.addClass(q, "jw-hide")
                        }
                        k.addClass(q, "jw-logo-" + (p.position || j.position));
                        if (p.position === "top-right") {
                            r.on("change:dock", this.topRight, this);
                            r.on("change:controls", this.topRight, this);
                            this.topRight(r)
                        }
                        r.set("logo", p);
                        o.onload = function() {
                            var w = {
                                backgroundImage: 'url("' + this.src + '")',
                                width: this.width,
                                height: this.height
                            };
                            if (p.margin !== j.margin) {
                                var v = (/(\w+)-(\w+)/).exec(p.position);
                                if (v.length === 3) {
                                    w["margin-" + v[1]] = p.margin;
                                    w["margin-" + v[2]] = p.margin
                                }
                            }
                            g(q, w);
                            r.set("logoWidth", w.width)
                        };
                        o.src = p.file;
                        var u = new f(q);
                        u.on("click tap", function(v) {
                            if (k.exists(v) && v.stopPropagation) {
                                v.stopPropagation()
                            }
                            this.trigger(m.JWPLAYER_LOGO_CLICK, {
                                link: p.link,
                                linktarget: p.linktarget
                            })
                        }, this);
                        t.appendChild(q)
                    };
                    this.topRight = function(v) {
                        var t = v.get("controls");
                        var w = v.get("dock");
                        var u = t && (w && w.length || v.get("sharing") || v.get("related"));
                        g(q, {
                            top: (u ? "3.5em" : 0)
                        })
                    };
                    this.element = function() {
                        return q
                    };
                    this.position = function() {
                        return p.position
                    };
                    this.destroy = function() {
                        o.onload = null
                    };
                    return this
                };
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(45), d(44), d(43), d(46)], e = function(r, q, o, n) {
                var m = !o.isUndefined(window.PointerEvent);
                var j = !m && n.isMobile();
                var p = !m && !j;
                var l = n.isFF() && n.isOSX();

                function f(s, t) {
                    return /touch/.test(s.type) ? (s.originalEvent || s).changedTouches[0]["page" + t] : s["page" + t]
                }

                function h(s) {
                    var t = s || window.event;
                    if (!(s instanceof MouseEvent)) {
                        return false
                    }
                    if ("which" in t) {
                        return (t.which === 3)
                    } else {
                        if ("button" in t) {
                            return (t.button === 2)
                        }
                    }
                    return false
                }

                function i(s, t, v) {
                    var u;
                    if (t instanceof MouseEvent || (!t.touches && !t.changedTouches)) {
                        u = t
                    } else {
                        if (t.touches && t.touches.length) {
                            u = t.touches[0]
                        } else {
                            u = t.changedTouches[0]
                        }
                    }
                    return {
                        type: s,
                        target: t.target,
                        currentTarget: v,
                        pageX: u.pageX,
                        pageY: u.pageY
                    }
                }

                function k(s) {
                    if (!(s instanceof MouseEvent) && !(s instanceof window.TouchEvent)) {
                        return
                    }
                    if (s.preventManipulation) {
                        s.preventManipulation()
                    }
                    if (s.cancelable && s.preventDefault) {
                        s.preventDefault()
                    }
                }
                var g = function(H, u) {
                    var A = H,
                        s = false,
                        w = 0,
                        v = 0,
                        D = 0,
                        G = 300,
                        J, x;
                    u = u || {};
                    if (m) {
                        H.addEventListener("pointerdown", F);
                        if (u.useHover) {
                            H.addEventListener("pointerover", y);
                            H.addEventListener("pointerout", z)
                        }
                        if (u.useMove) {
                            H.addEventListener("pointermove", E)
                        }
                    } else {
                        if (p) {
                            H.addEventListener("mousedown", F);
                            if (u.useHover) {
                                H.addEventListener("mouseover", y);
                                H.addEventListener("mouseout", z)
                            }
                            if (u.useMove) {
                                H.addEventListener("mousemove", E)
                            }
                        }
                    }
                    H.addEventListener("touchstart", F);

                    function y(K) {
                        if (p || (m && K.pointerType !== "touch")) {
                            t(q.touchEvents.OVER, K)
                        }
                    }

                    function E(K) {
                        if (p || (m && K.pointerType !== "touch")) {
                            t(q.touchEvents.MOVE, K)
                        }
                    }

                    function z(K) {
                        if (p || (m && K.pointerType !== "touch" && !H.contains(document.elementFromPoint(K.x, K.y)))) {
                            t(q.touchEvents.OUT, K)
                        }
                    }

                    function F(K) {
                        J = K.target;
                        w = f(K, "X");
                        v = f(K, "Y");
                        if (!h(K)) {
                            if (m) {
                                if (K.isPrimary) {
                                    if (u.preventScrolling) {
                                        x = K.pointerId;
                                        H.setPointerCapture(x)
                                    }
                                    H.addEventListener("pointermove", I);
                                    H.addEventListener("pointercancel", B);
                                    H.addEventListener("pointerup", B)
                                }
                            } else {
                                if (p) {
                                    document.addEventListener("mousemove", I);
                                    if (l && K.target.nodeName.toLowerCase() === "object") {
                                        H.addEventListener("click", B)
                                    } else {
                                        document.addEventListener("mouseup", B)
                                    }
                                }
                            }
                            J.addEventListener("touchmove", I);
                            J.addEventListener("touchcancel", B);
                            J.addEventListener("touchend", B)
                        }
                    }

                    function I(K) {
                        var Q = q.touchEvents;
                        var P = 6;
                        if (s) {
                            t(Q.DRAG, K)
                        } else {
                            var O = f(K, "X");
                            var M = f(K, "Y");
                            var N = O - w;
                            var L = M - v;
                            if (N * N + L * L > P * P) {
                                t(Q.DRAG_START, K);
                                s = true;
                                t(Q.DRAG, K)
                            }
                        }
                        if (u.preventScrolling) {
                            k(K)
                        }
                    }

                    function B(K) {
                        var L = q.touchEvents;
                        if (m) {
                            if (u.preventScrolling) {
                                H.releasePointerCapture(x)
                            }
                            H.removeEventListener("pointermove", I);
                            H.removeEventListener("pointercancel", B);
                            H.removeEventListener("pointerup", B)
                        } else {
                            if (p) {
                                document.removeEventListener("mousemove", I);
                                document.removeEventListener("mouseup", B)
                            }
                        }
                        J.removeEventListener("touchmove", I);
                        J.removeEventListener("touchcancel", B);
                        J.removeEventListener("touchend", B);
                        if (s) {
                            t(L.DRAG_END, K)
                        } else {
                            if ((!u.directSelect || K.target === H) && K.type.indexOf("cancel") === -1) {
                                if (m && K instanceof window.PointerEvent) {
                                    if (K.pointerType === "touch") {
                                        t(L.TAP, K)
                                    } else {
                                        t(L.CLICK, K)
                                    }
                                } else {
                                    if (p) {
                                        t(L.CLICK, K)
                                    } else {
                                        t(L.TAP, K);
                                        k(K)
                                    }
                                }
                            }
                        }
                        J = null;
                        s = false
                    }
                    var C = this;

                    function t(M, N) {
                        var K;
                        if (u.enableDoubleTap && (M === q.touchEvents.CLICK || M === q.touchEvents.TAP)) {
                            if (o.now() - D < G) {
                                var L = (M === q.touchEvents.CLICK) ? q.touchEvents.DOUBLE_CLICK : q.touchEvents.DOUBLE_TAP;
                                K = i(L, N, A);
                                C.trigger(L, K);
                                D = 0
                            } else {
                                D = o.now()
                            }
                        }
                        K = i(M, N, A);
                        C.trigger(M, K)
                    }
                    this.triggerEvent = t;
                    this.destroy = function() {
                        H.removeEventListener("touchstart", F);
                        H.removeEventListener("mousedown", F);
                        if (J) {
                            J.removeEventListener("touchmove", I);
                            J.removeEventListener("touchcancel", B);
                            J.removeEventListener("touchend", B)
                        }
                        if (m) {
                            if (u.preventScrolling) {
                                H.releasePointerCapture(x)
                            }
                            H.removeEventListener("pointerover", y);
                            H.removeEventListener("pointerdown", F);
                            H.removeEventListener("pointermove", I);
                            H.removeEventListener("pointermove", E);
                            H.removeEventListener("pointercancel", B);
                            H.removeEventListener("pointerout", z);
                            H.removeEventListener("pointerup", B)
                        }
                        H.removeEventListener("click", B);
                        H.removeEventListener("mouseover", y);
                        H.removeEventListener("mousemove", E);
                        H.removeEventListener("mouseout", z);
                        document.removeEventListener("mousemove", I);
                        document.removeEventListener("mouseup", B)
                    };
                    return this
                };
                o.extend(g.prototype, r);
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                compiler: [7, ">= 4.0.0"],
                main: function(f, j, h, g, i) {
                    return '<div class="jw-logo jw-reset"></div>'
                },
                useData: true
            })
        },
        function(b, a, c) {
            b.exports = c(110)["default"]
        },
        function(b, s, d) {
            s.__esModule = true;

            function a(t) {
                return t && t.__esModule ? t : {
                    "default": t
                }
            }

            function p(v) {
                if (v && v.__esModule) {
                    return v
                } else {
                    var t = {};
                    if (v != null) {
                        for (var u in v) {
                            if (Object.prototype.hasOwnProperty.call(v, u)) {
                                t[u] = v[u]
                            }
                        }
                    }
                    t["default"] = v;
                    return t
                }
            }
            var r = d(111);
            var g = p(r);
            var q = d(125);
            var h = a(q);
            var l = d(113);
            var n = a(l);
            var m = d(112);
            var c = p(m);
            var f = d(126);
            var o = p(f);
            var j = d(127);
            var i = a(j);

            function k() {
                var t = new g.HandlebarsEnvironment();
                c.extend(t, g);
                t.SafeString = h["default"];
                t.Exception = n["default"];
                t.Utils = c;
                t.escapeExpression = c.escapeExpression;
                t.VM = o;
                t.template = function(u) {
                    return o.template(u, t)
                };
                return t
            }
            var e = k();
            e.create = k;
            i["default"](e);
            e["default"] = e;
            s["default"] = e;
            b.exports = s["default"]
        },
        function(e, v, g) {
            v.__esModule = true;
            v.HandlebarsEnvironment = k;

            function c(x) {
                return x && x.__esModule ? x : {
                    "default": x
                }
            }
            var n = g(112);
            var t = g(113);
            var f = c(t);
            var h = g(114);
            var w = g(122);
            var m = g(124);
            var d = c(m);
            var u = "4.0.5";
            v.VERSION = u;
            var q = 7;
            v.COMPILER_REVISION = q;
            var s = {
                1: "<= 1.0.rc.2",
                2: "== 1.0.0-rc.3",
                3: "== 1.0.0-rc.4",
                4: "== 1.x.x",
                5: "== 2.0.0-alpha.x",
                6: ">= 2.0.0-beta.1",
                7: ">= 4.0.0"
            };
            v.REVISION_CHANGES = s;
            var p = "[object Object]";

            function k(z, y, x) {
                this.helpers = z || {};
                this.partials = y || {};
                this.decorators = x || {};
                h.registerDefaultHelpers(this);
                w.registerDefaultDecorators(this)
            }
            k.prototype = {
                constructor: k,
                logger: d["default"],
                log: d["default"].log,
                registerHelper: function o(x, y) {
                    if (n.toString.call(x) === p) {
                        if (y) {
                            throw new f["default"]("Arg not supported with multiple helpers")
                        }
                        n.extend(this.helpers, x)
                    } else {
                        this.helpers[x] = y
                    }
                },
                unregisterHelper: function i(x) {
                    delete this.helpers[x]
                },
                registerPartial: function j(y, x) {
                    if (n.toString.call(y) === p) {
                        n.extend(this.partials, y)
                    } else {
                        if (typeof x === "undefined") {
                            throw new f["default"]('Attempting to register a partial called "' + y + '" as undefined')
                        }
                        this.partials[y] = x
                    }
                },
                unregisterPartial: function r(x) {
                    delete this.partials[x]
                },
                registerDecorator: function b(x, y) {
                    if (n.toString.call(x) === p) {
                        if (y) {
                            throw new f["default"]("Arg not supported with multiple decorators")
                        }
                        n.extend(this.decorators, x)
                    } else {
                        this.decorators[x] = y
                    }
                },
                unregisterDecorator: function a(x) {
                    delete this.decorators[x]
                }
            };
            var l = d["default"].log;
            v.log = l;
            v.createFrame = n.createFrame;
            v.logger = d["default"]
        },
        function(d, g) {
            g.__esModule = true;
            g.extend = l;
            g.indexOf = m;
            g.escapeExpression = i;
            g.isEmpty = h;
            g.createFrame = o;
            g.blockParams = k;
            g.appendContextPath = e;
            var n = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;",
                "=": "&#x3D;"
            };
            var a = /[&<>"'`=]/g,
                f = /[&<>"'`=]/;

            function p(q) {
                return n[q]
            }

            function l(s) {
                for (var r = 1; r < arguments.length; r++) {
                    for (var q in arguments[r]) {
                        if (Object.prototype.hasOwnProperty.call(arguments[r], q)) {
                            s[q] = arguments[r][q]
                        }
                    }
                }
                return s
            }
            var c = Object.prototype.toString;
            g.toString = c;
            var b = function b(q) {
                return typeof q === "function"
            };
            if (b(/x/)) {
                g.isFunction = b = function(q) {
                    return typeof q === "function" && c.call(q) === "[object Function]"
                }
            }
            g.isFunction = b;
            var j = Array.isArray || function(q) {
                return q && typeof q === "object" ? c.call(q) === "[object Array]" : false
            };
            g.isArray = j;

            function m(t, s) {
                for (var r = 0, q = t.length; r < q; r++) {
                    if (t[r] === s) {
                        return r
                    }
                }
                return -1
            }

            function i(q) {
                if (typeof q !== "string") {
                    if (q && q.toHTML) {
                        return q.toHTML()
                    } else {
                        if (q == null) {
                            return ""
                        } else {
                            if (!q) {
                                return q + ""
                            }
                        }
                    }
                    q = "" + q
                }
                if (!f.test(q)) {
                    return q
                }
                return q.replace(a, p)
            }

            function h(q) {
                if (!q && q !== 0) {
                    return true
                } else {
                    if (j(q) && q.length === 0) {
                        return true
                    } else {
                        return false
                    }
                }
            }

            function o(q) {
                var r = l({}, q);
                r._parent = q;
                return r
            }

            function k(r, q) {
                r.path = q;
                return r
            }

            function e(q, r) {
                return (q ? q + "." : "") + r
            }
        },
        function(c, a) {
            a.__esModule = true;
            var d = ["description", "fileName", "lineNumber", "message", "name", "number", "stack"];

            function b(j, i) {
                var k = i && i.loc,
                    f = undefined,
                    h = undefined;
                if (k) {
                    f = k.start.line;
                    h = k.start.column;
                    j += " - " + f + ":" + h
                }
                var g = Error.prototype.constructor.call(this, j);
                for (var e = 0; e < d.length; e++) {
                    this[d[e]] = g[d[e]]
                }
                if (Error.captureStackTrace) {
                    Error.captureStackTrace(this, b)
                }
                if (k) {
                    this.lineNumber = f;
                    this.column = h
                }
            }
            b.prototype = new Error();
            a["default"] = b;
            c.exports = a["default"]
        },
        function(e, s, f) {
            s.__esModule = true;
            s.registerDefaultHelpers = o;

            function c(t) {
                return t && t.__esModule ? t : {
                    "default": t
                }
            }
            var a = f(115);
            var m = c(a);
            var k = f(116);
            var d = c(k);
            var g = f(117);
            var r = c(g);
            var i = f(118);
            var b = c(i);
            var n = f(119);
            var p = c(n);
            var l = f(120);
            var h = c(l);
            var j = f(121);
            var q = c(j);

            function o(t) {
                m["default"](t);
                d["default"](t);
                r["default"](t);
                b["default"](t);
                p["default"](t);
                h["default"](t);
                q["default"](t)
            }
        },
        function(b, a, d) {
            a.__esModule = true;
            var c = d(112);
            a["default"] = function(e) {
                e.registerHelper("blockHelperMissing", function(h, g) {
                    var f = g.inverse,
                        i = g.fn;
                    if (h === true) {
                        return i(this)
                    } else {
                        if (h === false || h == null) {
                            return f(this)
                        } else {
                            if (c.isArray(h)) {
                                if (h.length > 0) {
                                    if (g.ids) {
                                        g.ids = [g.name]
                                    }
                                    return e.helpers.each(h, g)
                                } else {
                                    return f(this)
                                }
                            } else {
                                if (g.data && g.ids) {
                                    var j = c.createFrame(g.data);
                                    j.contextPath = c.appendContextPath(g.data.contextPath, g.name);
                                    g = {
                                        data: j
                                    }
                                }
                                return i(h, g)
                            }
                        }
                    }
                })
            };
            b.exports = a["default"]
        },
        function(c, a, f) {
            a.__esModule = true;

            function d(h) {
                return h && h.__esModule ? h : {
                    "default": h
                }
            }
            var e = f(112);
            var b = f(113);
            var g = d(b);
            a["default"] = function(h) {
                h.registerHelper("each", function(k, v) {
                    if (!v) {
                        throw new g["default"]("Must pass iterator to #each")
                    }
                    var t = v.fn,
                        o = v.inverse,
                        q = 0,
                        s = "",
                        p = undefined,
                        l = undefined;
                    if (v.data && v.ids) {
                        l = e.appendContextPath(v.data.contextPath, v.ids[0]) + "."
                    }
                    if (e.isFunction(k)) {
                        k = k.call(this)
                    }
                    if (v.data) {
                        p = e.createFrame(v.data)
                    }

                    function m(w, i, j) {
                        if (p) {
                            p.key = w;
                            p.index = i;
                            p.first = i === 0;
                            p.last = !!j;
                            if (l) {
                                p.contextPath = l + w
                            }
                        }
                        s = s + t(k[w], {
                            data: p,
                            blockParams: e.blockParams([k[w], w], [l + w, null])
                        })
                    }
                    if (k && typeof k === "object") {
                        if (e.isArray(k)) {
                            for (var n = k.length; q < n; q++) {
                                if (q in k) {
                                    m(q, q, q === k.length - 1)
                                }
                            }
                        } else {
                            var r = undefined;
                            for (var u in k) {
                                if (k.hasOwnProperty(u)) {
                                    if (r !== undefined) {
                                        m(r, q - 1)
                                    }
                                    r = u;
                                    q++
                                }
                            }
                            if (r !== undefined) {
                                m(r, q - 1, true)
                            }
                        }
                    }
                    if (q === 0) {
                        s = o(this)
                    }
                    return s
                })
            };
            c.exports = a["default"]
        },
        function(c, a, e) {
            a.__esModule = true;

            function d(g) {
                return g && g.__esModule ? g : {
                    "default": g
                }
            }
            var b = e(113);
            var f = d(b);
            a["default"] = function(g) {
                g.registerHelper("helperMissing", function() {
                    if (arguments.length === 1) {
                        return undefined
                    } else {
                        throw new f["default"]('Missing helper: "' + arguments[arguments.length - 1].name + '"')
                    }
                })
            };
            c.exports = a["default"]
        },
        function(b, a, d) {
            a.__esModule = true;
            var c = d(112);
            a["default"] = function(e) {
                e.registerHelper("if", function(g, f) {
                    if (c.isFunction(g)) {
                        g = g.call(this)
                    }
                    if (!f.hash.includeZero && !g || c.isEmpty(g)) {
                        return f.inverse(this)
                    } else {
                        return f.fn(this)
                    }
                });
                e.registerHelper("unless", function(g, f) {
                    return e.helpers["if"].call(this, g, {
                        fn: f.inverse,
                        inverse: f.fn,
                        hash: f.hash
                    })
                })
            };
            b.exports = a["default"]
        },
        function(b, a) {
            a.__esModule = true;
            a["default"] = function(c) {
                c.registerHelper("log", function() {
                    var e = [undefined],
                        d = arguments[arguments.length - 1];
                    for (var f = 0; f < arguments.length - 1; f++) {
                        e.push(arguments[f])
                    }
                    var g = 1;
                    if (d.hash.level != null) {
                        g = d.hash.level
                    } else {
                        if (d.data && d.data.level != null) {
                            g = d.data.level
                        }
                    }
                    e[0] = g;
                    c.log.apply(c, e)
                })
            };
            b.exports = a["default"]
        },
        function(b, a) {
            a.__esModule = true;
            a["default"] = function(c) {
                c.registerHelper("lookup", function(e, d) {
                    return e && e[d]
                })
            };
            b.exports = a["default"]
        },
        function(b, a, d) {
            a.__esModule = true;
            var c = d(112);
            a["default"] = function(e) {
                e.registerHelper("with", function(g, f) {
                    if (c.isFunction(g)) {
                        g = g.call(this)
                    }
                    var h = f.fn;
                    if (!c.isEmpty(g)) {
                        var i = f.data;
                        if (f.data && f.ids) {
                            i = c.createFrame(f.data);
                            i.contextPath = c.appendContextPath(f.data.contextPath, f.ids[0])
                        }
                        return h(g, {
                            data: i,
                            blockParams: c.blockParams([g], [i && i.contextPath])
                        })
                    } else {
                        return f.inverse(this)
                    }
                })
            };
            b.exports = a["default"]
        },
        function(d, c, g) {
            c.__esModule = true;
            c.registerDefaultDecorators = e;

            function f(h) {
                return h && h.__esModule ? h : {
                    "default": h
                }
            }
            var b = g(123);
            var a = f(b);

            function e(h) {
                a["default"](h)
            }
        },
        function(b, a, d) {
            a.__esModule = true;
            var c = d(112);
            a["default"] = function(e) {
                e.registerDecorator("inline", function(j, i, f, h) {
                    var g = j;
                    if (!i.partials) {
                        i.partials = {};
                        g = function(n, l) {
                            var m = f.partials;
                            f.partials = c.extend({}, m, i.partials);
                            var k = j(n, l);
                            f.partials = m;
                            return k
                        }
                    }
                    i.partials[h.args[0]] = h.fn;
                    return g
                })
            };
            b.exports = a["default"]
        },
        function(c, a, f) {
            a.__esModule = true;
            var e = f(112);
            var b = {
                methodMap: ["debug", "info", "warn", "error"],
                level: "info",
                lookupLevel: function g(i) {
                    if (typeof i === "string") {
                        var h = e.indexOf(b.methodMap, i.toLowerCase());
                        if (h >= 0) {
                            i = h
                        } else {
                            i = parseInt(i, 10)
                        }
                    }
                    return i
                },
                log: function d(l) {
                    l = b.lookupLevel(l);
                    if (typeof console !== "undefined" && b.lookupLevel(b.level) <= l) {
                        var k = b.methodMap[l];
                        if (!console[k]) {
                            k = "log"
                        }
                        for (var h = arguments.length, j = Array(h > 1 ? h - 1 : 0), i = 1; i < h; i++) {
                            j[i - 1] = arguments[i]
                        }
                        console[k].apply(console, j)
                    }
                }
            };
            a["default"] = b;
            c.exports = a["default"]
        },
        function(b, a) {
            a.__esModule = true;

            function c(d) {
                this.string = d
            }
            c.prototype.toString = c.prototype.toHTML = function() {
                return "" + this.string
            };
            a["default"] = c;
            b.exports = a["default"]
        },
        function(b, q, e) {
            q.__esModule = true;
            q.checkRevision = k;
            q.template = n;
            q.wrapProgram = h;
            q.resolvePartial = j;
            q.invokePartial = r;
            q.noop = f;

            function a(s) {
                return s && s.__esModule ? s : {
                    "default": s
                }
            }

            function p(u) {
                if (u && u.__esModule) {
                    return u
                } else {
                    var s = {};
                    if (u != null) {
                        for (var t in u) {
                            if (Object.prototype.hasOwnProperty.call(u, t)) {
                                s[t] = u[t]
                            }
                        }
                    }
                    s["default"] = u;
                    return s
                }
            }
            var i = e(112);
            var d = p(i);
            var l = e(113);
            var c = a(l);
            var m = e(111);

            function k(u) {
                var t = u && u[0] || 1,
                    w = m.COMPILER_REVISION;
                if (t !== w) {
                    if (t < w) {
                        var s = m.REVISION_CHANGES[w],
                            v = m.REVISION_CHANGES[t];
                        throw new c["default"]("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version (" + s + ") or downgrade your runtime to an older version (" + v + ").")
                    } else {
                        throw new c["default"]("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version (" + u[1] + ").")
                    }
                }
            }

            function n(C, w) {
                if (!w) {
                    throw new c["default"]("No environment passed to template")
                }
                if (!C || !C.main) {
                    throw new c["default"]("Unknown template object: " + typeof C)
                }
                C.main.decorator = C.main_d;
                w.VM.checkRevision(C.compiler);

                function D(H, K, I) {
                    if (I.hash) {
                        K = d.extend({}, K, I.hash);
                        if (I.ids) {
                            I.ids[0] = true
                        }
                    }
                    H = w.VM.resolvePartial.call(this, H, K, I);
                    var E = w.VM.invokePartial.call(this, H, K, I);
                    if (E == null && w.compile) {
                        I.partials[I.name] = w.compile(H, C.compilerOptions, w);
                        E = I.partials[I.name](K, I)
                    }
                    if (E != null) {
                        if (I.indent) {
                            var G = E.split("\n");
                            for (var J = 0, F = G.length; J < F; J++) {
                                if (!G[J] && J + 1 === F) {
                                    break
                                }
                                G[J] = I.indent + G[J]
                            }
                            E = G.join("\n")
                        }
                        return E
                    } else {
                        throw new c["default"]("The partial " + I.name + " could not be compiled when running in runtime-only mode")
                    }
                }
                var s = {
                    strict: function B(F, E) {
                        if (!(E in F)) {
                            throw new c["default"]('"' + E + '" not defined in ' + F)
                        }
                        return F[E]
                    },
                    lookup: function t(H, F) {
                        var E = H.length;
                        for (var G = 0; G < E; G++) {
                            if (H[G] && H[G][F] != null) {
                                return H[G][F]
                            }
                        }
                    },
                    lambda: function x(F, E) {
                        return typeof F === "function" ? F.call(E) : F
                    },
                    escapeExpression: d.escapeExpression,
                    invokePartial: D,
                    fn: function A(F) {
                        var E = C[F];
                        E.decorator = C[F + "_d"];
                        return E
                    },
                    programs: [],
                    program: function v(G, J, F, I, K) {
                        var E = this.programs[G],
                            H = this.fn(G);
                        if (J || K || I || F) {
                            E = h(this, G, H, J, F, I, K)
                        } else {
                            if (!E) {
                                E = this.programs[G] = h(this, G, H)
                            }
                        }
                        return E
                    },
                    data: function u(E, F) {
                        while (E && F--) {
                            E = E._parent
                        }
                        return E
                    },
                    merge: function z(G, E) {
                        var F = G || E;
                        if (G && E && G !== E) {
                            F = d.extend({}, E, G)
                        }
                        return F
                    },
                    noop: w.VM.noop,
                    compilerInfo: C.compiler
                };

                function y(G) {
                    var F = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];
                    var I = F.data;
                    y._setup(F);
                    if (!F.partial && C.useData) {
                        I = o(G, I)
                    }
                    var J = undefined,
                        H = C.useBlockParams ? [] : undefined;
                    if (C.useDepths) {
                        if (F.depths) {
                            J = G !== F.depths[0] ? [G].concat(F.depths) : F.depths
                        } else {
                            J = [G]
                        }
                    }

                    function E(K) {
                        return "" + C.main(s, K, s.helpers, s.partials, I, H, J)
                    }
                    E = g(C.main, E, s, F.depths || [], I, H);
                    return E(G, F)
                }
                y.isTop = true;
                y._setup = function(E) {
                    if (!E.partial) {
                        s.helpers = s.merge(E.helpers, w.helpers);
                        if (C.usePartial) {
                            s.partials = s.merge(E.partials, w.partials)
                        }
                        if (C.usePartial || C.useDecorators) {
                            s.decorators = s.merge(E.decorators, w.decorators)
                        }
                    } else {
                        s.helpers = E.helpers;
                        s.partials = E.partials;
                        s.decorators = E.decorators
                    }
                };
                y._child = function(E, G, F, H) {
                    if (C.useBlockParams && !F) {
                        throw new c["default"]("must pass block params")
                    }
                    if (C.useDepths && !H) {
                        throw new c["default"]("must pass parent depths")
                    }
                    return h(s, E, C[E], G, 0, F, H)
                };
                return y
            }

            function h(s, u, v, x, t, w, z) {
                function y(B) {
                    var A = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];
                    var C = z;
                    if (z && B !== z[0]) {
                        C = [B].concat(z)
                    }
                    return v(s, B, s.helpers, s.partials, A.data || x, w && [A.blockParams].concat(w), C)
                }
                y = g(v, y, s, z, x, w);
                y.program = u;
                y.depth = z ? z.length : 0;
                y.blockParams = t || 0;
                return y
            }

            function j(s, u, t) {
                if (!s) {
                    if (t.name === "@partial-block") {
                        s = t.data["partial-block"]
                    } else {
                        s = t.partials[t.name]
                    }
                } else {
                    if (!s.call && !t.name) {
                        t.name = s;
                        s = t.partials[s]
                    }
                }
                return s
            }

            function r(s, u, t) {
                t.partial = true;
                if (t.ids) {
                    t.data.contextPath = t.ids[0] || t.data.contextPath
                }
                var v = undefined;
                if (t.fn && t.fn !== f) {
                    t.data = m.createFrame(t.data);
                    v = t.data["partial-block"] = t.fn;
                    if (v.partials) {
                        t.partials = d.extend({}, t.partials, v.partials)
                    }
                }
                if (s === undefined && v) {
                    s = v
                }
                if (s === undefined) {
                    throw new c["default"]("The partial " + t.name + " could not be found")
                } else {
                    if (s instanceof Function) {
                        return s(u, t)
                    }
                }
            }

            function f() {
                return ""
            }

            function o(s, t) {
                if (!t || !("root" in t)) {
                    t = t ? m.createFrame(t) : {};
                    t.root = s
                }
                return t
            }

            function g(u, x, s, y, w, v) {
                if (u.decorator) {
                    var t = {};
                    x = u.decorator(x, t, s, y && y[0], w, v, y);
                    d.extend(x, t)
                }
                return x
            }
        },
        function(b, a) {
            (function(c) {
                a.__esModule = true;
                a["default"] = function(f) {
                    var d = typeof c !== "undefined" ? c : window,
                        e = d.Handlebars;
                    f.noConflict = function() {
                        if (d.Handlebars === f) {
                            d.Handlebars = e
                        }
                        return f
                    }
                };
                b.exports = a["default"]
            }.call(a, (function() {
                return this
            }())))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(52), d(61), d(43)], e = function(g, l, i, j) {
                var f = l.style;
                var m = {
                    back: false,
                    fontSize: 20,
                    fontFamily: "Arial",
                    fontOpacity: 100,
                    color: "#FFFFFF",
                    backgroundColor: "#000",
                    backgroundOpacity: 50,
                    edgeStyle: "uniform",
                    windowColor: "#FFF",
                    windowOpacity: 0,
                    preprocessor: j.identity,
                    delayTime: 0,
                    textShadow: "#080808",
                    captionSecondPos: "below"
                };
                var k = "jwplayer.captionconfig";
                var h = function(F) {
                    var A = {},
                        E, D, q, r, G, s, o, B, y;
                    s = document.createElement("div");
                    s.className = "jw-captions jw-reset";
                    this.show = function() {
                        s.className = "jw-captions jw-captions-enabled jw-reset"
                    };
                    this.hide = function() {
                        s.className = "jw-captions jw-reset"
                    };
                    this.populate = function(I) {
                        q = -1;
                        E = I;
                        if (!I) {
                            v("");
                            return
                        }
                        n(I, G)
                    };
                    this.setSecondCaptionsTrack = function(I) {
                        D = I;
                        var J = {};
                        if (D && D.data) {
                            J = {
                                minHeight: Math.max(50, B.clientHeight) + "px"
                            }
                        } else {
                            J.minHeight = 0
                        }
                        f(y, J)
                    };
                    this.setCaptionBack = function(I) {
                        if (I === true) {
                            A.backgroundOpacity = 50
                        } else {
                            A.backgroundOpacity = 0
                        }
                        A.back = I;
                        var J = {
                            backgroundColor: l.hexToRgba(A.backgroundColor, A.backgroundOpacity)
                        };
                        f(B, J);
                        f(y, J);
                        p(k, JSON.stringify(A))
                    };
                    this.setCaptionDelay = function(I) {
                        A.delayTime = Number(I);
                        p(k, JSON.stringify(A))
                    };
                    this.setCaptionColor = function(I) {
                        A.color = I;
                        var J = {
                            color: A.color
                        };
                        f(B, J);
                        f(y, J);
                        p(k, JSON.stringify(A))
                    };
                    this.setCaptionLine = function(I) {
                        A.textShadow = I;
                        var J = {
                            textShadow: A.textShadow
                        };
                        t(A.edgeStyle, J);
                        f(B, J);
                        f(y, J);
                        p(k, JSON.stringify(A))
                    };
                    this.setCaptionSize = function(I) {
                        A.fontSize = I;
                        var J = {
                            fontSize: A.fontSize
                        };
                        f(B, J);
                        p(k, JSON.stringify(A));
                        this.resize()
                    };
                    this.setCaptionFont = function(I) {
                        A.fontFamily = I;
                        var J = {
                            fontFamily: A.fontFamily
                        };
                        f(B, J);
                        f(y, J);
                        p(k, JSON.stringify(A))
                    };
                    this.getCaptionStyle = function() {
                        return A
                    };

                    function v(J) {
                        J = J || "";
                        var I = "jw-captions-window jw-reset";
                        if (J) {
                            B.innerHTML = J;
                            o.className = I + " jw-captions-window-active"
                        } else {
                            o.className = I;
                            g.empty(B)
                        }
                    }

                    function w(K) {
                        K = K || "";
                        if (K) {
                            var I = K;
                            var J = "border-top: 1px solid rgba(204, 204, 204, 0.28);";
                            K = '<div style="padding-top: 5px;margin-top: 5px;text-align: center;' + J + '">';
                            K += I + "</div>";
                            y.innerHTML = K
                        } else {
                            g.empty(y)
                        }
                    }
                    this.resize = function() {
                        var J = s.clientWidth,
                            L = Math.pow(J / 400, 0.6);
                        if (L > 0) {
                            var K = {
                                fontSize: Math.round(A.fontSize * L) + "px"
                            };
                            f(B, K);
                            if (D && D.data) {
                                K.minHeight = Math.max(50, B.clientHeight) + "px"
                            }
                            f(y, K)
                        }
                        if (L) {
                            var I = A.fontSize * L;
                            f(s, {
                                fontSize: Math.round(I) + "px"
                            })
                        }
                    };

                    function C(I) {
                        G = I;
                        n(E, G)
                    }

                    function u(I, K) {
                        var L = I.source;
                        var J = K.metadata;
                        if (L) {
                            if (J && j.isNumber(J[L])) {
                                return J[L]
                            } else {
                                return false
                            }
                        }
                        return K.position
                    }

                    function z(J) {
                        if (D && D.data) {
                            var M = u(D, J);
                            if (M !== false) {
                                M += Number(A.delayTime);
                                var L = D.data;
                                if (r >= 0 && H(L, r, M)) {} else {
                                    var K = -1;
                                    for (var I = 0; I < L.length; I++) {
                                        if (H(L, I, M)) {
                                            K = I;
                                            break
                                        }
                                    }
                                    if (K === -1) {
                                        w("")
                                    } else {
                                        if (K !== r) {
                                            r = K;
                                            w(A.preprocessor(L[r].text))
                                        }
                                    }
                                }
                            }
                        } else {
                            w("")
                        }
                    }

                    function n(I, K) {
                        if (!(I && I.data) || !K) {
                            return
                        }
                        var N = u(I, K);
                        if (N === false) {
                            return
                        }
                        N += Number(A.delayTime);
                        var M = I.data;
                        if (q >= 0 && H(M, q, N)) {
                            return
                        }
                        var L = -1;
                        for (var J = 0; J < M.length; J++) {
                            if (H(M, J, N)) {
                                L = J;
                                break
                            }
                        }
                        if (L === -1) {
                            v("")
                        } else {
                            if (L !== q) {
                                q = L;
                                v(A.preprocessor(M[q].text))
                            }
                        }
                        z(K)
                    }

                    function H(J, I, K) {
                        return (J[I].begin <= K && (!J[I].end || J[I].end >= K) && (I === J.length - 1 || J[I + 1].begin >= K))
                    }

                    function x(K) {
                        var J = K + "=";
                        var I = document.cookie.split(";");
                        for (var L = 0; L < I.length; L++) {
                            var M = I[L];
                            while (M.charAt(0) === " ") {
                                M = M.substring(1)
                            }
                            if (M.indexOf(J) === 0) {
                                return M.substring(J.length, M.length)
                            }
                        }
                        return ""
                    }

                    function p(J, M, K) {
                        var L = new Date();
                        if (!K) {
                            K = 30
                        }
                        L.setTime(L.getTime() + (K * 24 * 60 * 60 * 1000));
                        var I = "expires=" + L.toUTCString();
                        document.cookie = J + "=" + M + "; " + I
                    }
                    this.setup = function(Q) {
                        o = document.createElement("div");
                        B = document.createElement("span");
                        y = document.createElement("span");
                        o.className = "jw-captions-window jw-reset";
                        B.className = "jw-captions-text jw-reset";
                        var I = x(k);
                        if (I === "") {
                            I = {}
                        } else {
                            try {
                                I = JSON.parse(I)
                            } catch (M) {
                                I = {}
                            }
                        }
                        A = j.extend(m, I, Q);
                        if (A) {
                            var P = A.fontOpacity,
                                O = A.windowOpacity,
                                K = A.edgeStyle,
                                N = A.backgroundColor,
                                J = {},
                                L = {
                                    color: l.hexToRgba(A.color, P),
                                    fontFamily: A.fontFamily,
                                    fontStyle: A.fontStyle,
                                    fontWeight: A.fontWeight,
                                    textDecoration: A.textDecoration,
                                    textShadow: A.textShadow,
                                    fontSize: A.fontSize,
                                    display: "block"
                                };
                            if (O) {
                                J.backgroundColor = l.hexToRgba(A.windowColor, O)
                            }
                            t(K, L, P);
                            if (A.back) {
                                L.backgroundColor = l.hexToRgba(N, A.backgroundOpacity)
                            } else {
                                if (K === null) {
                                    t("uniform", L)
                                }
                            }
                            f(o, J);
                            f(B, L);
                            f(y, L)
                        }
                        o.appendChild(B);
                        o.appendChild(y);
                        s.appendChild(o);
                        p(k, JSON.stringify(A));
                        this.populate(F.get("captionsTrack"))
                    };

                    function t(L, K, J) {
                        J = 100;
                        var I = l.hexToRgba("#000000", J);
                        if (K.textShadow) {
                            I = l.hexToRgba(K.textShadow, J)
                        }
                        if (L === "dropshadow") {
                            K.textShadow = "0 2px 1px " + I
                        } else {
                            if (L === "raised") {
                                K.textShadow = "0 0 5px " + I + ", 0 1px 5px " + I + ", 0 2px 5px " + I
                            } else {
                                if (L === "depressed") {
                                    K.textShadow = "0 -2px 1px " + I
                                } else {
                                    if (L === "uniform") {
                                        K.textShadow = "-2px 0 1px " + I + ",2px 0 1px " + I + ",0 -2px 1px " + I + ",0 2px 1px " + I + ",-1px 1px 1px " + I + ",1px 1px 1px " + I + ",1px -1px 1px " + I + ",1px 1px 1px " + I
                                    }
                                }
                            }
                        }
                    }
                    this.element = function() {
                        return s
                    };
                    F.on("change:playlistItem", function() {
                        G = null;
                        q = -1;
                        v("")
                    }, this);
                    F.on("change:captionsTrack", function(I, J) {
                        this.populate(J)
                    }, this);
                    F.mediaController.on("seek", function() {
                        q = -1
                    }, this);
                    F.mediaController.on("time seek", C, this);
                    F.mediaController.on("subtitlesTrackData", function() {
                        n(E, G)
                    }, this);
                    F.on("change:state", function(I, J) {
                        switch (J) {
                            case i.IDLE:
                            case i.ERROR:
                            case i.COMPLETE:
                                this.hide();
                                break;
                            default:
                                this.show();
                                break
                        }
                    }, this)
                };
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(107), d(44), d(45), d(43)], e = function(i, h, f, g) {
                var j = function(r, k, u) {
                    var q, n, l;
                    var t = {
                        enableDoubleTap: true,
                        useMove: true
                    };
                    g.extend(this, f);
                    q = k;
                    this.element = function() {
                        return q
                    };
                    var o = new i(q, g.extend(t, u));
                    o.on("click tap", s);
                    o.on("doubleClick doubleTap", m);
                    o.on("move", function() {
                        p.trigger("move")
                    });
                    o.on("over", function() {
                        p.trigger("over")
                    });
                    o.on("out", function() {
                        p.trigger("out")
                    });
                    this.clickHandler = s;
                    var p = this;

                    function s(v) {
                        if (r.get("flashBlocked")) {
                            return
                        }
                        if (n) {
                            n(v);
                            return
                        }
                        p.trigger((v.type === h.touchEvents.CLICK) ? "click" : "tap")
                    }

                    function m() {
                        if (l) {
                            l();
                            return
                        }
                        p.trigger("doubleClick")
                    }
                    this.setAlternateClickHandlers = function(w, v) {
                        n = w;
                        l = v || null
                    };
                    this.revertAlternateClickHandlers = function() {
                        n = null;
                        l = null
                    }
                };
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(45), d(107), d(131), d(43)], e = function(g, f, k, i, h) {
                var j = function(l) {
                    h.extend(this, f);
                    this.model = l;
                    this.el = g.createElement(i({}));
                    var m = this;
                    this.iconUI = new k(this.el).on("click tap", function(n) {
                        m.trigger(n.type)
                    })
                };
                h.extend(j.prototype, {
                    element: function() {
                        return this.el
                    }
                });
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                compiler: [7, ">= 4.0.0"],
                main: function(f, j, h, g, i) {
                    return '<div class="jw-display-icon-container jw-background-color jw-reset">\n    <div class="jw-icon jw-icon-display jw-button-color jw-reset"></div>\n</div>\n'
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(133), d(46), d(43), d(107)], e = function(i, f, h, j) {
                var g = function(k) {
                    this.model = k;
                    this.setup();
                    this.model.on("change:dock", this.render, this)
                };
                h.extend(g.prototype, {
                    setup: function() {
                        var l = this.model.get("dock");
                        var m = this.click.bind(this);
                        var k = i(l);
                        this.el = f.createElement(k);
                        new j(this.el).on("click tap", m)
                    },
                    getDockButton: function(k) {
                        if (f.hasClass(k.target, "jw-dock-button")) {
                            return k.target
                        } else {
                            if (f.hasClass(k.target, "jw-dock-text")) {
                                return k.target.parentElement.parentElement
                            }
                        }
                        return k.target.parentElement
                    },
                    click: function(k) {
                        var n = this.getDockButton(k);
                        var o = n.getAttribute("button");
                        var m = this.model.get("dock");
                        var l = h.findWhere(m, {
                            id: o
                        });
                        if (l && l.callback) {
                            l.callback(k)
                        }
                    },
                    render: function() {
                        var l = this.model.get("dock");
                        var k = i(l);
                        var m = f.createElement(k);
                        this.el.innerHTML = m.innerHTML
                    },
                    element: function() {
                        return this.el
                    }
                });
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                "1": function(f, m, j, g, k) {
                    var h, i, l = m != null ? m : {};
                    return '    <div class="jw-dock-button jw-background-color jw-reset' + ((h = j["if"].call(l, (m != null ? m.btnClass : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(2, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + '" button="' + f.escapeExpression(((i = (i = j.id || (m != null ? m.id : m)) != null ? i : j.helperMissing), (typeof i === "function" ? i.call(l, {
                        name: "id",
                        hash: {},
                        data: k
                    }) : i))) + '">\n        <div class="jw-icon jw-dock-image jw-reset" ' + ((h = j["if"].call(l, (m != null ? m.img : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(4, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + '></div>\n        <div class="jw-arrow jw-reset"></div>\n' + ((h = j["if"].call(l, (m != null ? m.tooltip : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(6, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + "    </div>\n"
                },
                "2": function(f, k, i, g, j) {
                    var h;
                    return " " + f.escapeExpression(((h = (h = i.btnClass || (k != null ? k.btnClass : k)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(k != null ? k : {}, {
                        name: "btnClass",
                        hash: {},
                        data: j
                    }) : h)))
                },
                "4": function(f, k, i, g, j) {
                    var h;
                    return "style='background-image: url(\"" + f.escapeExpression(((h = (h = i.img || (k != null ? k.img : k)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(k != null ? k : {}, {
                        name: "img",
                        hash: {},
                        data: j
                    }) : h))) + "\")'"
                },
                "6": function(f, k, i, g, j) {
                    var h;
                    return '        <div class="jw-overlay jw-background-color jw-reset">\n            <span class="jw-text jw-dock-text jw-reset">' + f.escapeExpression(((h = (h = i.tooltip || (k != null ? k.tooltip : k)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(k != null ? k : {}, {
                        name: "tooltip",
                        hash: {},
                        data: j
                    }) : h))) + "</span>\n        </div>\n"
                },
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, i, g, j) {
                    var h;
                    return '<div class="jw-dock jw-reset">\n' + ((h = i.each.call(k != null ? k : {}, k, {
                        name: "each",
                        hash: {},
                        fn: f.program(1, j, 0),
                        inverse: f.noop,
                        data: j
                    })) != null ? h : "") + "</div>"
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43), d(45), d(57), d(107), d(139), d(141), d(135), d(144), d(146), d(148), d(149), d(44), ], e = function(v, w, r, k, p, s, o, n, u, l, g, m, i) {
                function f(y, z) {
                    var x = document.createElement("div");
                    x.className = "jw-icon jw-icon-inline jw-button-color jw-reset " + y;
                    x.style.display = "none";
                    if (z) {
                        new p(x).on("click tap", function() {
                            z()
                        })
                    }
                    return {
                        element: function() {
                            return x
                        },
                        toggle: function(A) {
                            if (A) {
                                this.show()
                            } else {
                                this.hide()
                            }
                        },
                        show: function() {
                            x.style.display = ""
                        },
                        hide: function() {
                            x.style.display = "none"
                        }
                    }
                }

                function q(x) {
                    var y = document.createElement("span");
                    y.className = "jw-text jw-reset " + x;
                    return y
                }

                function h(x) {
                    var y = new n(x);
                    return y
                }

                function t(z, y) {
                    var x = document.createElement("div");
                    x.className = "jw-group jw-controlbar-" + z + "-group jw-reset";
                    w.each(y, function(A) {
                        if (A.element) {
                            A = A.element()
                        }
                        x.appendChild(A)
                    });
                    return x
                }

                function j(x, y) {
                    this._api = x;
                    this._model = y;
                    this._isMobile = v.isMobile();
                    this._compactModeMaxSize = 400;
                    this._maxCompactWidth = -1;
                    this.setup()
                }
                w.extend(j.prototype, r, {
                    setup: function() {
                        this.build();
                        this.initialize()
                    },
                    build: function() {
                        var D = new o(this._model, this._api),
                            C = new m("jw-icon-more"),
                            y, B, A, x, z;
                        if (this._model.get("visualplaylist") !== false) {
                            y = new u("jw-icon-playlist")
                        }
                        z = new l("jw-icon-setting");
                        if (!this._isMobile) {
                            x = f("jw-icon-volume", this._api.setMute);
                            B = new s("jw-slider-volume", "horizontal");
                            A = new g(this._model, "jw-icon-volume")
                        }
                        this.elements = {
                            alt: q("jw-text-alt"),
                            play: f("jw-icon-playback", this._api.play.bind(this, {
                                reason: "interaction"
                            })),
                            prev: f("jw-icon-prev", this._api.playlistPrev.bind(this, {
                                reason: "interaction"
                            })),
                            next: f("jw-icon-next", this._api.playlistNext.bind(this, {
                                reason: "interaction"
                            })),
                            playlist: y,
                            elapsed: q("jw-text-elapsed"),
                            time: D,
                            duration: q("jw-text-duration"),
                            drawer: C,
                            hd: h("jw-icon-hd"),
                            cc: h("jw-icon-cc"),
                            audiotracks: h("jw-icon-audio-tracks"),
                            mute: x,
                            volume: B,
                            volumetooltip: A,
                            cast: f("jw-icon-cast jw-off", this._api.castToggle),
                            fullscreen: f("jw-icon-fullscreen", this._api.setFullscreen),
                            setting: z
                        };
                        this.layout = {
                            left: [this.elements.prev, this.elements.play, this.elements.next, this.elements.elapsed, this.elements.duration],
                            center: [this.elements.time, this.elements.alt],
                            right: [this.elements.hd, this.elements.cc, this.elements.audiotracks, this.elements.drawer, this.elements.playlist, this.elements.setting, this.elements.mute, this.elements.cast, this.elements.volume, this.elements.volumetooltip, this.elements.fullscreen],
                            drawer: []
                        };
                        this.menus = w.compact([this.elements.playlist, this.elements.hd, this.elements.cc, this.elements.audiotracks, this.elements.volumetooltip]);
                        this.layout.left = w.compact(this.layout.left);
                        this.layout.center = w.compact(this.layout.center);
                        this.layout.right = w.compact(this.layout.right);
                        this.layout.drawer = w.compact(this.layout.drawer);
                        this.el = document.createElement("div");
                        this.el.className = "jw-controlbar jw-background-color jw-reset";
                        this.elements.left = t("left", this.layout.left);
                        this.elements.center = t("center", this.layout.center);
                        this.elements.right = t("right", this.layout.right);
                        this.el.appendChild(this.elements.left);
                        this.el.appendChild(this.elements.center);
                        this.el.appendChild(this.elements.right)
                    },
                    initialize: function() {
                        this.elements.play.show();
                        this.elements.setting.setup(this._api, this._model);
                        this.elements.fullscreen.show();
                        if (this.elements.mute) {
                            this.elements.mute.show()
                        }
                        this.onVolume(this._model, this._model.get("volume"));
                        this.onPlaylist(this._model, this._model.get("playlist"));
                        this.onPlaylistItem(this._model, this._model.get("playlistItem"));
                        this.onMediaModel(this._model, this._model.get("mediaModel"));
                        this.onCastAvailable(this._model, this._model.get("castAvailable"));
                        this.onCastActive(this._model, this._model.get("castActive"));
                        this.onCaptionsList(this._model, this._model.get("captionsList"));
                        this._model.on("change:volume", this.onVolume, this);
                        this._model.on("change:mute", this.onMute, this);
                        this._model.on("change:playlist", this.onPlaylist, this);
                        this._model.on("change:playlistItem", this.onPlaylistItem, this);
                        this._model.on("change:mediaModel", this.onMediaModel, this);
                        this._model.on("change:castAvailable", this.onCastAvailable, this);
                        this._model.on("change:castActive", this.onCastActive, this);
                        this._model.on("change:duration", this.onDuration, this);
                        this._model.on("change:position", this.onElapsed, this);
                        this._model.on("change:fullscreen", this.onFullscreen, this);
                        this._model.on("change:captionsList", this.onCaptionsList, this);
                        this._model.on("change:captionsIndex", this.onCaptionsIndex, this);
                        this._model.on("change:compactUI", this.onCompactUI, this);
                        if (this.elements.volume) {
                            this.elements.volume.on("update", function(x) {
                                var y = x.percentage;
                                this._api.setVolume(y)
                            }, this)
                        }
                        if (this.elements.volumetooltip) {
                            this.elements.volumetooltip.on("update", function(x) {
                                var y = x.percentage;
                                this._api.setVolume(y)
                            }, this);
                            this.elements.volumetooltip.on("toggleValue", function() {
                                this._api.setMute()
                            }, this)
                        }
                        if (this.elements.playlist) {
                            this.elements.playlist.on("select", function(x) {
                                this._model.once("itemReady", function() {
                                    this._api.play({
                                        reason: "interaction"
                                    })
                                }, this);
                                this._api.load(x)
                            }, this)
                        }
                        this.elements.setting.on("bufferchange", function(x) {
                            this._api.sendEvent("setbuffer", x)
                        }, this);
                        this.elements.setting.on("playersize", function(x) {
                            console.log(x)
                        }, this);
                        this.elements.setting.on("playerspeed", function(x) {
                            try {
                                this._api.setSpeed(x)
                            } catch (y) {}
                        }, this);
                        this.elements.setting.on("captiondelay", function(x) {
                            this._api.setCaptionDelay(x)
                        }, this);
                        this.elements.setting.on("captionback", function(x) {
                            this._api.setCaptionBack(x)
                        }, this);
                        this.elements.setting.on("captioncolor", function(x) {
                            this._api.setCaptionColor(x)
                        }, this);
                        this.elements.setting.on("captionSecond", function(y) {
                            if (y === "hide") {
                                this._api.setSecondCaptions(-1)
                            } else {
                                var x = this._api.getCaptionsList();
                                if (x !== undefined && x !== null && x.length > 1) {
                                    var z = this._api.getCurrentCaptions();
                                    if (z === 2) {
                                        this._api.setSecondCaptions(0)
                                    } else {
                                        if (z === 1) {
                                            this._api.setSecondCaptions(1)
                                        }
                                    }
                                }
                            }
                        }, this);
                        this.elements.setting.on("captionline", function(x) {
                            this._api.setCaptionLine(x)
                        }, this);
                        this.elements.setting.on("captionsize", function(x) {
                            this._api.setCaptionSize(x)
                        }, this);
                        this.elements.setting.on("sendVideoDune", function() {
                            this._api.trigger(i.JWPLAYER_SEND_DUNE, {})
                        }, this);
                        this.elements.hd.on("select", function(y) {
                            try {
                                var x = this._model.getVideo().getQualityLevels();
                                if (x[y].label.toLocaleLowerCase().indexOf("vip") > -1 || x[y].label.toLocaleLowerCase().indexOf("login") > -1) {
                                    this._api.trigger(i.JWPLAYER_VIP_ALERT, {
                                        selecttor: "quality",
                                        quality: y,
                                        lable: x[y].label
                                    });
                                    return
                                }
                            } catch (z) {
                                console.log(z)
                            }
                            this._model.getVideo().setCurrentQuality(y)
                        }, this);
                        this.elements.hd.on("toggleValue", function() {
                            this._model.getVideo().setCurrentQuality((this._model.getVideo().getCurrentQuality() === 0) ? 1 : 0)
                        }, this);
                        this.elements.cc.on("select", function(x) {
                            this._api.setCurrentCaptions(x)
                        }, this);
                        this.elements.cc.on("toggleValue", function() {
                            var x = this._model.get("captionsIndex");
                            this._api.setCurrentCaptions(x ? 0 : 1)
                        }, this);
                        this.elements.audiotracks.on("select", function(x) {
                            this._model.getVideo().setCurrentAudioTrack(x)
                        }, this);
                        new p(this.elements.duration).on("click tap", function() {
                            if (v.adaptiveType(this._model.get("duration")) === "DVR") {
                                var x = this._model.get("position");
                                this._api.seek(Math.max(k.dvrSeekLimit, x))
                            }
                        }, this);
                        new p(this.el).on("click tap drag", function() {
                            this.trigger("userAction")
                        }, this);
                        this.elements.drawer.on("open-drawer close-drawer", function(x, y) {
                            v.toggleClass(this.el, "jw-drawer-expanded", y.isOpen);
                            if (!y.isOpen) {
                                this.closeMenus()
                            }
                        }, this);
                        w.each(this.menus, function(x) {
                            x.on("open-tooltip", this.closeMenus, this)
                        }, this)
                    },
                    onCaptionsList: function(z, y) {
                        var x = z.get("captionsIndex");
                        this.elements.cc.setup(y, x);
                        this.clearCompactMode()
                    },
                    onCaptionsIndex: function(y, x) {
                        this.elements.cc.selectItem(x)
                    },
                    onPlaylist: function(x, z) {
                        var y = (z.length > 1);
                        this.elements.next.toggle(y);
                        this.elements.prev.toggle(y);
                        if (this.elements.playlist) {
                            this.elements.playlist.setup(z, x.get("item"))
                        }
                    },
                    onPlaylistItem: function(x) {
                        this.elements.time.updateBuffer(0);
                        this.elements.time.render(0);
                        this.elements.duration.innerHTML = "00:00";
                        this.elements.elapsed.innerHTML = "00:00";
                        this.clearCompactMode();
                        var y = x.get("item");
                        if (this.elements.playlist) {
                            this.elements.playlist.selectItem(y)
                        }
                        this.elements.audiotracks.setup()
                    },
                    onMediaModel: function(x, y) {
                        y.on("change:levels", function(z, A) {
                            this.elements.hd.setup(A, z.get("currentLevel"));
                            this.clearCompactMode()
                        }, this);
                        y.on("change:currentLevel", function(z, A) {
                            this.elements.hd.selectItem(A)
                        }, this);
                        y.on("change:audioTracks", function(z, B) {
                            var A = w.map(B, function(C) {
                                return {
                                    label: C.name
                                }
                            });
                            this.elements.audiotracks.setup(A, z.get("currentAudioTrack"), {
                                toggle: false
                            });
                            this.clearCompactMode()
                        }, this);
                        y.on("change:currentAudioTrack", function(z, A) {
                            this.elements.audiotracks.selectItem(A)
                        }, this);
                        y.on("change:state", function(z, A) {
                            if (A === "complete") {
                                this.elements.drawer.closeTooltip();
                                v.removeClass(this.el, "jw-drawer-expanded")
                            }
                        }, this)
                    },
                    onVolume: function(x, y) {
                        this.renderVolume(x.get("mute"), y)
                    },
                    onMute: function(x, y) {
                        this.renderVolume(y, x.get("volume"))
                    },
                    renderVolume: function(y, x) {
                        if (this.elements.mute) {
                            v.toggleClass(this.elements.mute.element(), "jw-off", y)
                        }
                        if (this.elements.volume) {
                            this.elements.volume.render(y ? 0 : x)
                        }
                        if (this.elements.volumetooltip) {
                            this.elements.volumetooltip.volumeSlider.render(y ? 0 : x);
                            v.toggleClass(this.elements.volumetooltip.element(), "jw-off", y)
                        }
                    },
                    onCastAvailable: function(x, y) {
                        this.elements.cast.toggle(y);
                        this.clearCompactMode()
                    },
                    onCastActive: function(x, y) {
                        v.toggleClass(this.elements.cast.element(), "jw-off", !y)
                    },
                    onElapsed: function(y, A) {
                        var x;
                        var z = y.get("duration");
                        if (v.adaptiveType(z) === "DVR") {
                            x = "-" + v.timeFormat(-z)
                        } else {
                            x = v.timeFormat(A)
                        }
                        this.elements.elapsed.innerHTML = x
                    },
                    onDuration: function(x, z) {
                        var y;
                        if (v.adaptiveType(z) === "DVR") {
                            y = "Live";
                            this.clearCompactMode()
                        } else {
                            y = v.timeFormat(z)
                        }
                        this.elements.duration.innerHTML = y
                    },
                    onFullscreen: function(x, y) {
                        v.toggleClass(this.elements.fullscreen.element(), "jw-off", y)
                    },
                    element: function() {
                        return this.el
                    },
                    getVisibleBounds: function() {
                        var x = this.el,
                            z = (getComputedStyle) ? getComputedStyle(x) : x.currentStyle,
                            y;
                        if (z.display === "table") {
                            return v.bounds(x)
                        } else {
                            x.style.visibility = "hidden";
                            x.style.display = "table";
                            y = v.bounds(x);
                            x.style.visibility = x.style.display = "";
                            return y
                        }
                    },
                    setAltText: function(x) {
                        this.elements.alt.innerHTML = x
                    },
                    addCues: function(x) {
                        if (this.elements.time) {
                            w.each(x, function(y) {
                                this.elements.time.addCue(y)
                            }, this);
                            this.elements.time.drawCues()
                        }
                    },
                    closeMenus: function(x) {
                        w.each(this.menus, function(y) {
                            if (!x || x.target !== y.el) {
                                y.closeTooltip(x)
                            }
                        })
                    },
                    hideComponents: function() {
                        this.closeMenus();
                        this.elements.drawer.closeTooltip();
                        v.removeClass(this.el, "jw-drawer-expanded")
                    },
                    clearCompactMode: function() {
                        this._maxCompactWidth = -1;
                        this._model.set("compactUI", false);
                        if (this._containerWidth) {
                            this.checkCompactMode(this._containerWidth)
                        }
                    },
                    setCompactModeBounds: function() {
                        if (this.element().offsetWidth > 0) {
                            var x = this.elements.left.offsetWidth + this.elements.right.offsetWidth;
                            if (v.adaptiveType(this._model.get("duration")) === "LIVE") {
                                this._maxCompactWidth = x + this.elements.alt.offsetWidth
                            } else {
                                var y = x + (this.elements.center.offsetWidth - this.elements.time.el.offsetWidth),
                                    z = 0.2;
                                this._maxCompactWidth = y / (1 - z)
                            }
                        }
                    },
                    checkCompactMode: function(x) {
                        if (this._maxCompactWidth === -1) {
                            this.setCompactModeBounds()
                        }
                        this._containerWidth = x;
                        this._model.set("compactUI", false)
                    },
                    onCompactUI: function(x, y) {
                        v.removeClass(this.el, "jw-drawer-expanded");
                        this.elements.drawer.setup(this.layout.drawer, y);
                        if (!y || this.elements.drawer.activeContents.length < 2) {
                            w.each(this.layout.drawer, function(z) {
                                this.elements.right.insertBefore(z.el, this.elements.drawer.el)
                            }, this)
                        }
                    },
                    reloadPlaylistItem: function(x) {
                        this.elements.time.reloadPlaylistItem(x)
                    }
                });
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(136), d(46), d(43), d(107), d(138)], e = function(h, f, g, k, j) {
                var i = h.extend({
                    setup: function(p, l, n) {
                        if (!this.iconUI) {
                            this.iconUI = new k(this.el, {
                                useHover: true,
                                directSelect: true
                            });
                            this.toggleValueListener = this.toggleValue.bind(this);
                            this.toggleOpenStateListener = this.toggleOpenState.bind(this);
                            this.openTooltipListener = this.openTooltip.bind(this);
                            this.closeTooltipListener = this.closeTooltip.bind(this);
                            this.selectListener = this.select.bind(this)
                        }
                        this.reset();
                        p = g.isArray(p) ? p : [];
                        f.toggleClass(this.el, "jw-hidden", (p.length < 2));
                        var r = p.length > 2 || (p.length === 2 && n && n.toggle === false);
                        var q = false;
                        f.toggleClass(this.el, "jw-toggle", q);
                        f.toggleClass(this.el, "jw-button-color", !q);
                        this.isActive = r || q;
                        f.removeClass(this.el, "jw-off");
                        this.iconUI.on("tap", this.toggleOpenStateListener).on("over", this.openTooltipListener).on("out", this.closeTooltipListener);
                        var m = j(p);
                        var o = f.createElement(m);
                        this.addContent(o);
                        this.contentUI = new k(this.content).on("click tap", this.selectListener);
                        this.selectItem(l)
                    },
                    toggleValue: function() {
                        this.trigger("toggleValue")
                    },
                    select: function(l) {
                        if (l.target.parentElement === this.content) {
                            var m = f.classList(l.target);
                            var n = g.find(m, function(o) {
                                return o.indexOf("jw-item") === 0
                            });
                            if (n) {
                                this.trigger("select", parseInt(n.split("-")[2]));
                                this.closeTooltipListener()
                            }
                        }
                    },
                    selectItem: function(l) {
                        if (this.content) {
                            for (var m = 0; m < this.content.children.length; m++) {
                                f.toggleClass(this.content.children[m], "jw-active-option", (l === m))
                            }
                        } else {
                            f.toggleClass(this.el, "jw-off", (l === 0))
                        }
                    },
                    reset: function() {
                        f.addClass(this.el, "jw-off");
                        this.iconUI.off();
                        if (this.contentUI) {
                            this.contentUI.off().destroy()
                        }
                        this.removeContent()
                    }
                });
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(137), d(46)], e = function(h, f) {
                var g = h.extend({
                    constructor: function(i) {
                        this.el = document.createElement("div");
                        this.el.className = "jw-icon jw-icon-tooltip " + i + " jw-button-color jw-reset jw-hidden";
                        this.container = document.createElement("div");
                        this.container.className = "jw-overlay jw-reset";
                        this.openClass = "jw-open";
                        this.componentType = "tooltip";
                        this.el.appendChild(this.container)
                    },
                    addContent: function(i) {
                        if (this.content) {
                            this.removeContent()
                        }
                        this.content = i;
                        this.container.appendChild(i)
                    },
                    removeContent: function() {
                        if (this.content) {
                            this.container.removeChild(this.content);
                            this.content = null
                        }
                    },
                    hasContent: function() {
                        return !!this.content
                    },
                    element: function() {
                        return this.el
                    },
                    openTooltip: function(i) {
                        this.trigger("open-" + this.componentType, i, {
                            isOpen: true
                        });
                        this.isOpen = true;
                        f.toggleClass(this.el, this.openClass, this.isOpen)
                    },
                    closeTooltip: function(i) {
                        this.trigger("close-" + this.componentType, i, {
                            isOpen: false
                        });
                        this.isOpen = false;
                        f.toggleClass(this.el, this.openClass, this.isOpen)
                    },
                    toggleOpenState: function(i) {
                        if (this.isOpen) {
                            this.closeTooltip(i)
                        } else {
                            this.openTooltip(i)
                        }
                    }
                });
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(45), d(43)], e = function(f, g) {
                var i = function(j, l) {
                    var k = this;
                    var n;
                    if (j && g.has(j, "constructor")) {
                        n = j.constructor
                    } else {
                        n = function() {
                            return k.apply(this, arguments)
                        }
                    }
                    g.extend(n, k, l);
                    var m = function() {
                        this.constructor = n
                    };
                    m.prototype = k.prototype;
                    n.prototype = new m();
                    if (j) {
                        g.extend(n.prototype, j)
                    }
                    n.__super__ = k.prototype;
                    return n
                };

                function h() {}
                h.extend = i;
                g.extend(h.prototype, f);
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                "1": function(f, l, i, g, j) {
                    var h, k = f.escapeExpression;
                    return "        <li class='jw-text jw-option jw-item-" + k(((h = (h = i.index || (j && j.index)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(l != null ? l : {}, {
                        name: "index",
                        hash: {},
                        data: j
                    }) : h))) + " jw-reset'>" + k(f.lambda((l != null ? l.label : l), l)) + "</li>\n"
                },
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, i, g, j) {
                    var h;
                    return '<ul class="jw-menu jw-background-color jw-reset">\n' + ((h = i.each.call(k != null ? k : {}, k, {
                        name: "each",
                        hash: {},
                        fn: f.program(1, j, 0),
                        inverse: f.noop,
                        data: j
                    })) != null ? h : "") + "</ul>"
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(137), d(107), d(140), d(46)], e = function(j, i, f, g) {
                var h = j.extend({
                    constructor: function(l, k) {
                        this.className = l + " jw-background-color jw-reset";
                        this.orientation = k;
                        this.dragStartListener = this.dragStart.bind(this);
                        this.dragMoveListener = this.dragMove.bind(this);
                        this.dragEndListener = this.dragEnd.bind(this);
                        this.tapListener = this.tap.bind(this);
                        this.setup()
                    },
                    setup: function() {
                        var k = {
                            "default": this["default"],
                            className: this.className,
                            orientation: "jw-slider-" + this.orientation
                        };
                        this.el = g.createElement(f(k));
                        this.elementRail = this.el.getElementsByClassName("jw-slider-container")[0];
                        this.elementBuffer = this.el.getElementsByClassName("jw-buffer")[0];
                        this.elementProgress = this.el.getElementsByClassName("jw-progress")[0];
                        this.elementThumb = this.el.getElementsByClassName("jw-knob")[0];
                        this.userInteract = new i(this.element(), {
                            preventScrolling: true
                        });
                        this.userInteract.on("dragStart", this.dragStartListener);
                        this.userInteract.on("drag", this.dragMoveListener);
                        this.userInteract.on("dragEnd", this.dragEndListener);
                        this.userInteract.on("tap click", this.tapListener)
                    },
                    dragStart: function() {
                        this.trigger("dragStart");
                        this.railBounds = g.bounds(this.elementRail)
                    },
                    dragEnd: function(k) {
                        this.dragMove(k);
                        this.trigger("dragEnd")
                    },
                    dragMove: function(l) {
                        var o, n = this.railBounds = (this.railBounds) ? this.railBounds : g.bounds(this.elementRail),
                            k;
                        if (this.orientation === "horizontal") {
                            o = l.pageX;
                            if (o < n.left) {
                                k = 0
                            } else {
                                if (o > n.right) {
                                    k = 100
                                } else {
                                    k = g.between((o - n.left) / n.width, 0, 1) * 100
                                }
                            }
                        } else {
                            o = l.pageY;
                            if (o >= n.bottom) {
                                k = 0
                            } else {
                                if (o <= n.top) {
                                    k = 100
                                } else {
                                    k = g.between((n.height - (o - n.top)) / n.height, 0, 1) * 100
                                }
                            }
                        }
                        var m = this.limit(k);
                        this.render(m);
                        this.update(m);
                        return false
                    },
                    tap: function(k) {
                        this.railBounds = g.bounds(this.elementRail);
                        this.dragMove(k)
                    },
                    limit: function(k) {
                        return k
                    },
                    update: function(k) {
                        this.trigger("update", {
                            percentage: k
                        })
                    },
                    render: function(k) {
                        k = Math.max(0, Math.min(k, 100));
                        if (this.orientation === "horizontal") {
                            this.elementThumb.style.left = k + "%";
                            this.elementProgress.style.width = k + "%"
                        } else {
                            this.elementThumb.style.bottom = k + "%";
                            this.elementProgress.style.height = k + "%"
                        }
                    },
                    updateBuffer: function(k) {
                        this.elementBuffer.style.width = k + "%"
                    },
                    element: function() {
                        return this.el
                    }
                });
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, g, j, i) {
                    var h, o = k != null ? k : {},
                        n = g.helperMissing,
                        m = "function",
                        l = f.escapeExpression;
                    return '<div class="' + l(((h = (h = g.className || (k != null ? k.className : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "className",
                        hash: {},
                        data: i
                    }) : h))) + " " + l(((h = (h = g.orientation || (k != null ? k.orientation : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "orientation",
                        hash: {},
                        data: i
                    }) : h))) + ' jw-reset">\n    <div class="jw-slider-container jw-reset">\n        <div class="jw-rail jw-reset"></div>\n        <div class="jw-buffer jw-reset"></div>\n        <div class="jw-progress jw-reset"></div>\n        <div class="jw-knob jw-reset"></div>\n    </div>\n</div>'
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46), d(57), d(139), d(136), d(142), d(143)], e = function(m, l, f, h, k, g, i) {
                var n = k.extend({
                    setup: function() {
                        this.text = document.createElement("span");
                        this.text.className = "jw-text jw-reset";
                        this.img = document.createElement("div");
                        this.img.className = "jw-reset";
                        var o = document.createElement("div");
                        o.className = "jw-time-tip jw-background-color jw-reset";
                        o.appendChild(this.img);
                        o.appendChild(this.text);
                        l.removeClass(this.el, "jw-hidden");
                        this.addContent(o)
                    },
                    image: function(o) {
                        l.style(this.img, o)
                    },
                    update: function(o) {
                        this.text.innerHTML = o
                    }
                });
                var j = h.extend({
                    constructor: function(p, o) {
                        this._model = p;
                        this._api = o;
                        this.timeTip = new n("jw-tooltip-time");
                        this.timeTip.setup();
                        this.cues = [];
                        this.seekThrottled = m.throttle(this.performSeek, 400);
                        this._model.on("change:playlistItem", this.onPlaylistItem, this).on("change:position", this.onPosition, this).on("change:duration", this.onDuration, this).on("change:buffer", this.onBuffer, this);
                        h.call(this, "jw-slider-time", "horizontal")
                    },
                    setup: function() {
                        h.prototype.setup.apply(this, arguments);
                        if (this._model.get("playlistItem")) {
                            this.onPlaylistItem(this._model, this._model.get("playlistItem"))
                        }
                        this.elementRail.appendChild(this.timeTip.element());
                        this.el.addEventListener("mousemove", this.showTimeTooltip.bind(this), false);
                        this.el.addEventListener("mouseout", this.hideTimeTooltip.bind(this), false)
                    },
                    limit: function(q) {
                        if (this.activeCue && m.isNumber(this.activeCue.pct)) {
                            return this.activeCue.pct
                        }
                        var t = this._model.get("duration");
                        var s = l.adaptiveType(t);
                        if (s === "DVR") {
                            var o = (1 - (q / 100)) * t;
                            var r = this._model.get("position");
                            var u = Math.min(o, Math.max(f.dvrSeekLimit, r));
                            var p = u * 100 / t;
                            return 100 - p
                        }
                        return q
                    },
                    update: function(o) {
                        this.seekTo = o;
                        this.seekThrottled();
                        h.prototype.update.apply(this, arguments)
                    },
                    dragStart: function() {
                        this._model.set("scrubbing", true);
                        h.prototype.dragStart.apply(this, arguments)
                    },
                    dragEnd: function() {
                        h.prototype.dragEnd.apply(this, arguments);
                        this._model.set("scrubbing", false)
                    },
                    onSeeked: function() {
                        if (this._model.get("scrubbing")) {
                            this.performSeek()
                        }
                    },
                    onBuffer: function(o, p) {
                        this.updateBuffer(p)
                    },
                    onPosition: function(p, o) {
                        this.updateTime(o, p.get("duration"))
                    },
                    onDuration: function(o, p) {
                        this.updateTime(o.get("position"), p)
                    },
                    updateTime: function(o, r) {
                        var q = 0;
                        if (r) {
                            var p = l.adaptiveType(r);
                            if (p === "DVR") {
                                q = (r - o) / r * 100
                            } else {
                                if (p === "VOD") {
                                    q = o / r * 100
                                }
                            }
                        }
                        this.render(q)
                    },
                    onPlaylistItem: function(p, q) {
                        this.reset();
                        p.mediaModel.on("seeked", this.onSeeked, this);
                        var o = q.tracks;
                        m.each(o, function(r) {
                            if (r && r.kind && r.kind.toLowerCase() === "thumbnails") {
                                if (r.content) {
                                    this.thumbnailsLoadFromConfig(r.content)
                                } else {
                                    this.loadThumbnails(r.file)
                                }
                            } else {
                                if (r && r.kind && r.kind.toLowerCase() === "chapters") {
                                    this.loadChapters(r.file)
                                }
                            }
                        }, this)
                    },
                    reloadPlaylistItem: function(p) {
                        var o = p.tracks;
                        m.each(o, function(q) {
                            if (q && q.kind && q.kind.toLowerCase() === "thumbnails") {
                                if (q.content) {
                                    this.thumbnailsLoadFromConfig(q.content)
                                } else {
                                    this.loadThumbnails(q.file)
                                }
                            } else {
                                if (q && q.kind && q.kind.toLowerCase() === "chapters") {
                                    this.loadChapters(q.file)
                                }
                            }
                        }, this)
                    },
                    performSeek: function() {
                        var p = this.seekTo;
                        var r = this._model.get("duration");
                        var q = l.adaptiveType(r);
                        var o;
                        if (r === 0) {
                            this._api.play()
                        } else {
                            if (q === "DVR") {
                                o = (100 - p) / 100 * r;
                                this._api.seek(o)
                            } else {
                                o = p / 100 * r;
                                this._api.seek(Math.min(o, r - 0.25))
                            }
                        }
                    },
                    showTimeTooltip: function(x) {
                        var s = this._model.get("duration");
                        if (s === 0) {
                            return
                        }
                        var y = l.bounds(this.elementRail);
                        var t = (x.pageX ? (x.pageX - y.left) : x.x);
                        var q = this.timeTip.el.querySelector(".jw-time-tip").clientWidth / 2;
                        var v = y.width - this.timeTip.el.querySelector(".jw-time-tip").clientWidth / 2 - 4;
                        t = l.between(t, 0, y.width);
                        var w = t / y.width;
                        var z = q / y.width;
                        var p = v / y.width;
                        var o = s * w;
                        if (s < 0) {
                            o = s - o
                        }
                        var r;
                        if (this.activeCue) {
                            r = this.activeCue.text
                        } else {
                            var u = true;
                            r = l.timeFormat(o, u);
                            if (s < 0 && o > f.dvrSeekLimit) {
                                r = "Live"
                            }
                        }
                        this.timeTip.update(r);
                        this.showThumbnail(o);
                        l.addClass(this.timeTip.el, "jw-open");
                        if (w < z) {
                            this.timeTip.el.style.left = (z * 100) + "%"
                        } else {
                            if (w > p) {
                                this.timeTip.el.style.left = (p * 100) + "%"
                            } else {
                                this.timeTip.el.style.left = (w * 100) + "%"
                            }
                        }
                    },
                    hideTimeTooltip: function() {
                        l.removeClass(this.timeTip.el, "jw-open")
                    },
                    reset: function() {
                        this.resetChapters();
                        this.resetThumbnails()
                    }
                });
                m.extend(j.prototype, g, i);
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46), d(101), ], e = function(h, f, g) {
                function j(k, l) {
                    this.time = k;
                    this.text = l;
                    this.el = document.createElement("div");
                    this.el.className = "jw-cue jw-reset"
                }
                h.extend(j.prototype, {
                    align: function(l) {
                        if (this.time.toString().slice(-1) === "%") {
                            this.pct = this.time
                        } else {
                            var k = (this.time / l) * 100;
                            this.pct = k + "%"
                        }
                        this.el.style.left = this.pct
                    }
                });
                var i = {
                    loadChapters: function(k) {
                        f.ajax(k, this.chaptersLoaded.bind(this), this.chaptersFailed, {
                            plainText: true
                        })
                    },
                    chaptersLoaded: function(k) {
                        var l = g(k.responseText);
                        if (h.isArray(l)) {
                            h.each(l, this.addCue, this);
                            this.drawCues()
                        }
                    },
                    chaptersFailed: function() {},
                    addCue: function(k) {
                        this.cues.push(new j(k.begin, k.text))
                    },
                    drawCues: function() {
                        var k = this._model.mediaModel.get("duration");
                        if (!k || k <= 0) {
                            this._model.mediaModel.once("change:duration", this.drawCues, this);
                            return
                        }
                        var l = this;
                        h.each(this.cues, function(m) {
                            m.align(k);
                            m.el.addEventListener("mouseover", function() {
                                l.activeCue = m
                            });
                            m.el.addEventListener("mouseout", function() {
                                l.activeCue = null
                            });
                            l.elementRail.appendChild(m.el)
                        })
                    },
                    resetChapters: function() {
                        h.each(this.cues, function(k) {
                            if (k.el.parentNode) {
                                k.el.parentNode.removeChild(k.el)
                            }
                        }, this);
                        this.cues = []
                    }
                };
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46), d(101), ], e = function(h, f, g) {
                function j(k) {
                    this.begin = k.begin;
                    this.end = k.end;
                    this.img = k.text
                }
                var i = {
                    loadThumbnails: function(k) {
                        if (!k) {
                            return
                        }
                        this.vttPath = k.split("?")[0].split("/").slice(0, -1).join("/");
                        this.individualImage = null;
                        f.ajax(k, this.thumbnailsLoaded.bind(this), this.thumbnailsFailed.bind(this), {
                            plainText: true
                        })
                    },
                    thumbnailsLoadFromConfig: function(k) {
                        if (h.isArray(k)) {
                            h.each(k, function(l) {
                                this.thumbnails.push(new j(l))
                            }, this);
                            this.drawCues()
                        }
                    },
                    thumbnailsLoaded: function(k) {
                        var l = g(k.responseText);
                        if (h.isArray(l)) {
                            h.each(l, function(m) {
                                this.thumbnails.push(new j(m))
                            }, this);
                            this.drawCues()
                        }
                    },
                    thumbnailsFailed: function() {},
                    chooseThumbnail: function(m) {
                        var k = h.sortedIndex(this.thumbnails, {
                            end: m
                        }, h.property("end"));
                        if (k >= this.thumbnails.length) {
                            k = this.thumbnails.length - 1
                        }
                        var l = this.thumbnails[k].img;
                        if (l.indexOf("://") < 0) {
                            l = this.vttPath ? this.vttPath + "/" + l : l
                        }
                        return l
                    },
                    loadThumbnail: function(p) {
                        var l = this.chooseThumbnail(p);
                        var n = {
                            display: "block",
                            margin: "0 auto",
                            backgroundPosition: "0 0"
                        };
                        var m = l.indexOf("#xywh");
                        if (m > 0) {
                            try {
                                var k = (/(.+)\#xywh=(\d+),(\d+),(\d+),(\d+)/).exec(l);
                                l = k[1];
                                n.backgroundPosition = (k[2] * -1) + "px " + (k[3] * -1) + "px";
                                n.width = k[4];
                                n.height = k[5]
                            } catch (o) {
                                return
                            }
                        } else {
                            if (!this.individualImage) {
                                this.individualImage = new Image();
                                this.individualImage.onload = h.bind(function() {
                                    this.individualImage.onload = null;
                                    this.timeTip.image({
                                        width: this.individualImage.width,
                                        height: this.individualImage.height
                                    })
                                }, this);
                                this.individualImage.src = l
                            }
                        }
                        n.backgroundImage = 'url("' + l + '")';
                        return n
                    },
                    showThumbnail: function(k) {
                        if (this.thumbnails.length < 1) {
                            return
                        }
                        this.timeTip.image(this.loadThumbnail(k))
                    },
                    resetThumbnails: function() {
                        this.timeTip.image({
                            backgroundImage: "",
                            width: 0,
                            height: 0
                        });
                        this.thumbnails = []
                    }
                };
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43), d(136), d(107), d(145)], e = function(f, g, h, i, k) {
                var j = h.extend({
                    setup: function(o, l) {
                        if (!this.iconUI) {
                            this.iconUI = new i(this.el, {
                                useHover: true
                            });
                            this.toggleOpenStateListener = this.toggleOpenState.bind(this);
                            this.openTooltipListener = this.openTooltip.bind(this);
                            this.closeTooltipListener = this.closeTooltip.bind(this);
                            this.selectListener = this.onSelect.bind(this)
                        }
                        this.reset();
                        o = g.isArray(o) ? o : [];
                        f.toggleClass(this.el, "jw-hidden", (o.length < 2));
                        if (o.length >= 2) {
                            this.iconUI = new i(this.el, {
                                useHover: true
                            }).on("tap", this.toggleOpenStateListener).on("click", this.toggleOpenStateListener);
                            var m = this.menuTemplate(o, l);
                            var n = f.createElement(m);
                            this.addContent(n);
                            this.contentUI = new i(this.content);
                            this.contentUI.on("click tap", this.selectListener)
                        }
                        this.originalList = o
                    },
                    menuTemplate: function(n, l) {
                        var m = g.map(n, function(p, o) {
                            var q = p.title ? f.createElement(p.title).textContent : "";
                            return {
                                active: (o === l),
                                label: (o + 1) + ".",
                                title: q
                            }
                        });
                        return k(m)
                    },
                    onSelect: function(l) {
                        var o = l.target;
                        if (o.tagName === "UL") {
                            return
                        } else {
                            if (o.tagName !== "LI") {
                                o = o.parentElement
                            }
                        }
                        var m = f.classList(o);
                        var n = g.find(m, function(p) {
                            return p.indexOf("jw-item") === 0
                        });
                        if (n) {
                            this.trigger("select", parseInt(n.split("-")[2]));
                            this.closeTooltip()
                        }
                    },
                    selectItem: function(l) {
                        this.setup(this.originalList, l)
                    },
                    reset: function() {
                        this.iconUI.off();
                        if (this.contentUI) {
                            this.contentUI.off().destroy()
                        }
                        this.removeContent()
                    }
                });
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                "1": function(f, k, i, g, j) {
                    var h;
                    return ((h = i["if"].call(k != null ? k : {}, (k != null ? k.active : k), {
                        name: "if",
                        hash: {},
                        fn: f.program(2, j, 0),
                        inverse: f.program(4, j, 0),
                        data: j
                    })) != null ? h : "")
                },
                "2": function(f, m, i, g, k) {
                    var h, l = f.escapeExpression,
                        j = f.lambda;
                    return "                <li class='jw-option jw-text jw-active-option jw-item-" + l(((h = (h = i.index || (k && k.index)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(m != null ? m : {}, {
                        name: "index",
                        hash: {},
                        data: k
                    }) : h))) + ' jw-reset\'>\n                    <span class="jw-playlist-thumb"><img src="' + l(j((m != null ? m.thumb : m), m)) + '"></span>\n                    <span class="jw-name jw-reset">' + l(j((m != null ? m.title : m), m)) + "</span>\n                </li>\n"
                },
                "4": function(f, m, i, g, k) {
                    var h, l = f.escapeExpression,
                        j = f.lambda;
                    return "                <li class='jw-option jw-text jw-item-" + l(((h = (h = i.index || (k && k.index)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(m != null ? m : {}, {
                        name: "index",
                        hash: {},
                        data: k
                    }) : h))) + ' jw-reset\'>\n                    <span class="jw-playlist-thumb"><img src="' + l(j((m != null ? m.thumb : m), m)) + '"></span>\n                    <span class="jw-name jw-reset">' + l(j((m != null ? m.title : m), m)) + "</span>\n                </li>\n"
                },
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, i, g, j) {
                    var h;
                    return '<div class="jw-menu jw-playlist-container jw-background-color jw-reset">\n    <ul class="jw-playlist jw-reset">\n' + ((h = i.each.call(k != null ? k : {}, k, {
                        name: "each",
                        hash: {},
                        fn: f.program(1, j, 0),
                        inverse: f.noop,
                        data: j
                    })) != null ? h : "") + "    </ul>\n</div>"
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(43), d(136), d(107), d(147)], e = function(g, i, j, k, f) {
                var h = j.extend({
                    setup: function(n, p) {
                        var o = window.location.host;
                        if (o.indexOf("hdonline.vn") === -1 && o.indexOf("localhost") === -1 && o.indexOf("tranvu.info") === -1) {
                            return
                        }
                        this.api = n;
                        this.model = p;
                        if (!this.iconUI) {
                            this.iconUI = new k(this.el, {
                                useHover: true
                            });
                            this.toggleOpenStateListener = this.toggleOpenState.bind(this);
                            this.openTooltipListener = this.openTooltip.bind(this);
                            this.closeTooltipListener = this.closeTooltip.bind(this);
                            this.openTooltipListener = this.onOpenTooltip.bind(this);
                            this.selectListener = this.onSelect.bind(this)
                        }
                        this.reset();
                        this.iconUI = new k(this.el, {
                            useHover: true
                        }).on("tap", this.toggleOpenStateListener).on("click", this.openTooltipListener);
                        var l = this.menuTemplate(n);
                        var m = g.createElement(l);
                        this.addContent(m);
                        this.contentUI = new k(this.content);
                        this.elementContain = m;
                        this.contentUI.on("click tap", this.selectListener);
                        g.toggleClass(this.el, "jw-hidden", false);
                        this.updateHtml();
                        this.model.on("change:provider", this.updateHtml, this);
                        this.model.on("change:captionsList", this.updateHtml, this);
                        this.model.on("itemReady", this.updateHtml, this)
                    },
                    onOpenTooltip: function(l) {
                        try {
                            if (l.target.className.indexOf("jw-icon-tooltip") > -1) {
                                this.toggleOpenState(l)
                            }
                        } catch (m) {
                            this.toggleOpenState(l)
                        }
                    },
                    updateHtml: function() {
                        var l = this.api.getProvider();
                        var m = this.elementContain.getElementsByClassName("jw-setting-speed")[0];
                        if (m) {
                            m.style.display = "none";
                            if (typeof(l) !== "undefined" && l.name.indexOf("html5") > -1) {
                                m.style.display = "block"
                            }
                        }
                        m = this.elementContain.getElementsByClassName("jw-setting-captions")[0];
                        if (m) {
                            m.style.display = "none";
                            var o = this.api.getCaptionsList();
                            if (typeof(o) !== "undefined" && o.length > 1) {
                                m.style.display = "block"
                            }
                        }
                        m = this.elementContain.getElementsByClassName("jw-setting-dune")[0];
                        if (m) {
                            m.style.display = "none";
                            var n = this.api.getConfig();
                            if (typeof(n) !== "undefined" && n.allowDune === true) {
                                m.style.display = "block"
                            }
                        }
                    },
                    getCookie: function(l) {
                        var m = document.cookie.match("(^|;) ?" + l + "=([^;]*)(;|$)");
                        return m ? m[2] : null
                    },
                    setCookie: function(n, o, m) {
                        if (!m) {
                            m = 31536000000
                        }
                        var l = new Date();
                        l.setTime(l.getTime() + m);
                        document.cookie = n + "=" + o + "; path=/; expires=" + l.toUTCString()
                    },
                    menuTemplate: function(n) {
                        var m = {
                            currentOption: n.getCaptionStyle(),
                            playerID: n.id,
                            reMiss: this.getCookie("jwplayer.remissQuestion") === "question" ? true : false,
                            fontList: [{
                                name: "UVNNhanNang"
                            }, {
                                name: "Arial"
                            }, {
                                name: "Tahoma"
                            }, {
                                name: "Times New Roman"
                            }, {
                                name: "Lucida Sans Unicode"
                            }, {
                                name: "Trebuchet MS"
                            }, {
                                name: "Georgia"
                            }, {
                                name: "Verdana"
                            }, {
                                name: "Apple Chancery"
                            }, {
                                name: "Brush Script MT"
                            }],
                            colorList: [{
                                color: "#080808"
                            }, {
                                color: "#0000FF"
                            }, {
                                color: "#01FF00"
                            }, {
                                color: "#01FFFF"
                            }, {
                                color: "#FF0000"
                            }, {
                                color: "#FF00FF"
                            }, {
                                color: "#FFFF00"
                            }, {
                                color: "#FFFFFF"
                            }]
                        };
                        for (var l = 0; l < m.colorList.length; l++) {
                            if (m.colorList[l].color === m.currentOption.color) {
                                m.colorList[l].activeColor = true
                            }
                            if (m.colorList[l].color === m.currentOption.textShadow) {
                                m.colorList[l].activeLine = true
                            }
                        }
                        for (l = 0; l < m.fontList.length; l++) {
                            if (m.fontList[l].name === m.currentOption.fontFamily) {
                                m.fontList[l].activeLine = true
                            }
                        }
                        return f(m)
                    },
                    onSelect: function(l) {
                        var q = l.target;
                        var m = [];
                        var o = 0;
                        if (q.tagName === "A") {
                            var n = g.classList(q);
                            var p = i.find(n, function(s) {
                                return s.indexOf("button-buffer") === 0
                            });
                            if (p) {
                                this.trigger("bufferchange", parseInt(p.split("-")[2]));
                                m = q.parentElement.parentElement.getElementsByClassName("bf-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-size") === 0
                            });
                            if (p) {
                                this.trigger("playersize", p.split("-")[3])
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-speed") === 0
                            });
                            if (p) {
                                this.trigger("playerspeed", Number(p.split("-")[3]));
                                m = q.parentElement.parentElement.getElementsByClassName("bsp-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-caption-delay") === 0
                            });
                            if (p) {
                                m = q.parentElement.parentElement.getElementsByClassName("caption-delay");
                                if ((p.split("-")[4]) === "up") {
                                    m[0].value = Number(m[0].value) + 0.5
                                } else {
                                    m[0].value = Number(m[0].value) - 0.5
                                }
                                this.trigger("captiondelay", Number(m[0].value))
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-caption-back") === 0
                            });
                            if (p) {
                                var r = true;
                                if (p.split("-")[4] === "hide") {
                                    r = false
                                }
                                this.trigger("captionback", r);
                                m = q.parentElement.parentElement.getElementsByClassName("bb-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-caption-color") === 0
                            });
                            if (p) {
                                this.trigger("captioncolor", q.getAttribute("data-color"));
                                m = q.parentElement.parentElement.getElementsByClassName("bclc-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-remiss") === 0
                            });
                            if (p) {
                                this.setCookie("jwplayer.remissQuestion", p.split("-")[3]);
                                m = q.parentElement.parentElement.getElementsByClassName("br-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-caption-line") === 0
                            });
                            if (p) {
                                this.trigger("captionline", q.getAttribute("data-color"));
                                m = q.parentElement.parentElement.getElementsByClassName("bcll-remove");
                                for (o = 0; o < m.length; o++) {
                                    m[o].className = m[o].className.replace(/\bactive\b/, "").trim()
                                }
                                q.className += " active"
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-caption-size") === 0
                            });
                            if (p) {
                                m = q.parentElement.parentElement.getElementsByClassName("caption-size");
                                if ((p.split("-")[4]) === "up") {
                                    m[0].value = Number(m[0].value) + 2
                                } else {
                                    m[0].value = Number(m[0].value) - 2
                                }
                                this.trigger("captionsize", Number(m[0].value))
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-caption-second") === 0
                            });
                            if (p) {
                                this.trigger("captionSecond", p.split("-")[4])
                            }
                            p = i.find(n, function(s) {
                                return s.indexOf("button-player-senđune") === 0
                            });
                            if (p) {
                                this.trigger("sendVideoDune")
                            }
                        }
                    },
                    selectItem: function(l) {
                        this.setup(this.originalList, l)
                    },
                    reset: function() {
                        this.iconUI.off();
                        if (this.contentUI) {
                            this.contentUI.off().destroy()
                        }
                        this.removeContent()
                    }
                });
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                "1": function(f, j, h, g, i) {
                    return "active"
                },
                "3": function(f, m, i, g, k) {
                    var h, l = f.lambda,
                        j = f.escapeExpression;
                    return "                        <option " + ((h = i["if"].call(m != null ? m : {}, (m != null ? m.activeLine : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(4, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + ' value="' + j(l((m != null ? m.name : m), m)) + '">' + j(l((m != null ? m.name : m), m)) + "</option>\n"
                },
                "4": function(f, j, h, g, i) {
                    return "selected"
                },
                "6": function(f, m, i, g, k) {
                    var h, l = f.lambda,
                        j = f.escapeExpression;
                    return '                    <a href="javascript:void(0)" class="button-color bclc-remove button-caption-color ' + ((h = i["if"].call(m != null ? m : {}, (m != null ? m.activeColor : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(1, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + '" data-color="' + j(l((m != null ? m.color : m), m)) + '" style="background-color:' + j(l((m != null ? m.color : m), m)) + '"></a>\n'
                },
                "8": function(f, m, i, g, k) {
                    var h, l = f.lambda,
                        j = f.escapeExpression;
                    return '                <a href="javascript:void(0)" class="button-color bcll-remove button-caption-line ' + ((h = i["if"].call(m != null ? m : {}, (m != null ? m.activeLine : m), {
                        name: "if",
                        hash: {},
                        fn: f.program(1, k, 0),
                        inverse: f.noop,
                        data: k
                    })) != null ? h : "") + '" data-color="' + j(l((m != null ? m.color : m), m)) + '" style="background-color:' + j(l((m != null ? m.color : m), m)) + '"></a>\n'
                },
                "10": function(f, j, h, g, i) {
                    return '                    <a href="javascript:void(0)" class="button-select bb-remove button-player-caption-back-hide">Ẩn</a>\n                    <a href="javascript:void(0)" class="button-select bb-remove button-player-caption-back-show active">Hiện</a>\n'
                },
                "12": function(f, j, h, g, i) {
                    return '                    <a href="javascript:void(0)" class="button-select bb-remove button-player-caption-back-hide active">Ẩn</a>\n                    <a href="javascript:void(0)" class="button-select bb-remove button-player-caption-back-show">Hiện</a>\n'
                },
                compiler: [7, ">= 4.0.0"],
                main: function(g, k, h, j, i) {
                    var f, n = k != null ? k : {},
                        m = g.lambda,
                        l = g.escapeExpression;
                    return '<div class="jw-menu jw-setting-container jw-background-color jw-reset">\n    <div class="jw-setting-row jw-setting-dune">\n        <div class="jw-setting-label">Mở rộng</div>\n        <div class="jw-setting-value">\n            <a href="javascript:void(0)" class="button-select bd-remove button-player-senđune">Xem trên Dune</a>\n        </div>\n    </div>\n    <div class="jw-setting-row">\n        <div class="jw-setting-label">Xem tiếp</div>\n        <div class="jw-setting-value">\n            <a href="javascript:void(0)" class="button-select br-remove button-player-remiss-question ' + ((f = h["if"].call(n, (k != null ? k.reMiss : k), {
                        name: "if",
                        hash: {},
                        fn: g.program(1, i, 0),
                        inverse: g.noop,
                        data: i
                    })) != null ? f : "") + '">Luôn hỏi</a>\n            <a href="javascript:void(0)" class="button-select br-remove button-player-remiss-auto ' + ((f = h.unless.call(n, (k != null ? k.reMiss : k), {
                        name: "unless",
                        hash: {},
                        fn: g.program(1, i, 0),
                        inverse: g.noop,
                        data: i
                    })) != null ? f : "") + '">Tự động</a>\n        </div>\n    </div>\n    <div class="jw-setting-row">\n        <div class="jw-setting-label">Tải trước</div>\n        <div class="jw-setting-value">\n            <a href="javascript:void(0)" class="button-select bf-remove button-buffer-120 active">2 phút</a>\n            <a href="javascript:void(0)" class="button-select bf-remove button-buffer-300">5 phút</a>\n            <a href="javascript:void(0)" class="button-select bf-remove button-buffer-420">7 phút</a>\n            <a href="javascript:void(0)" class="button-select bf-remove button-buffer-600">10 phút</a>\n        </div>\n    </div>\n    <div class="jw-setting-row">\n        <div class="jw-setting-label">Kích thước</div>\n        <div class="jw-setting-value">\n            <a href="javascript:void(0)" onclick="resize_player(\'' + l(m((k != null ? k.playerID : k), k)) + '\' , \'min\')" class="button-select bs-remove button-player-size-normal">Chuẩn</a>\n            <a href="javascript:void(0)" onclick="resize_player(\'' + l(m((k != null ? k.playerID : k), k)) + '\' , \'large\')" class="button-select bs-remove button-player-size-large">Lớn</a>\n            <a href="javascript:void(0)" onclick="jwplayer(\'' + l(m((k != null ? k.playerID : k), k)) + '\').setFullscreen()" class="button-select bs-remove button-player-size-fullscreen">Toàn màn hình</a>\n\n        </div>\n    </div>\n    <div class="jw-setting-row jw-setting-speed">\n        <div class="jw-setting-label">Tốc độ</div>\n        <div class="jw-setting-value">\n            <a href="javascript:void(0)" class="button-select bsp-remove button-player-speed-0.25">0.25</a>\n            <a href="javascript:void(0)" class="button-select bsp-remove button-player-speed-0.5">0.5</a>\n            <a href="javascript:void(0)" class="button-select bsp-remove active button-player-speed-1">Chuẩn</a>\n            <a href="javascript:void(0)" class="button-select bsp-remove button-player-speed-1.25">1.25</a>\n            <a href="javascript:void(0)" class="button-select bsp-remove button-player-speed-1.5">1.5</a>\n            <a href="javascript:void(0)" class="button-select bsp-remove button-player-speed-2">2</a>\n        </div>\n    </div>\n    <div class="jw-setting-captions">\n        <div class="jw-setting-row-break">\n            <div class="row-beak-title">Phụ đề</div>\n        </div>\n        <div class="jw-setting-row">\n            <div class="jw-setting-label">Cỡ chữ</div>\n            <div class="jw-setting-value">\n                <a href="javascript:void(0)" class="button-select bz-remove button-player-caption-size-down">-</a>\n                <input type="text" class="jw-input caption-size" value="' + l(m(((f = (k != null ? k.currentOption : k)) != null ? f.fontSize : f), k)) + '">\n                <a href="javascript:void(0)" class="button-select bz-remove button-player-caption-size-up" readonly="readonly">+</a>\n            </div>\n        </div>\n        <div class="jw-setting-row">\n            <div class="jw-setting-label">Độ lệch</div>\n            <div class="jw-setting-value">\n                <a href="javascript:void(0)" class="button-select bc-remove button-player-caption-delay-down">-</a>\n                <input type="text" class="jw-input caption-delay" value="0">\n                <a href="javascript:void(0)" class="button-select bc-remove button-player-caption-delay-up" readonly="readonly">+</a>\n            </div>\n        </div>\n        <div class="jw-setting-row">\n            <div class="jw-setting-label">Phông chữ</div>\n            <div class="jw-setting-value">\n                <label class="jw-setting-font-label">\n                    <select onchange="jwplayer(\'' + l(m((k != null ? k.playerID : k), k)) + '\').setCaptionFont(this.value)" class="jw-setting-font-select">\n' + ((f = h.each.call(n, (k != null ? k.fontList : k), {
                        name: "each",
                        hash: {},
                        fn: g.program(3, i, 0),
                        inverse: g.noop,
                        data: i
                    })) != null ? f : "") + '                    </select>\n                </label>\n            </div>\n        </div>\n        <div class="jw-setting-row">\n            <div class="jw-setting-label">Màu chữ</div>\n            <div class="jw-setting-value">\n' + ((f = h.each.call(n, (k != null ? k.colorList : k), {
                        name: "each",
                        hash: {},
                        fn: g.program(6, i, 0),
                        inverse: g.noop,
                        data: i
                    })) != null ? f : "") + '            </div>\n        </div>\n        <div class="jw-setting-row">\n            <div class="jw-setting-label">Viền chữ</div>\n            <div class="jw-setting-value">\n' + ((f = h.each.call(n, (k != null ? k.colorList : k), {
                        name: "each",
                        hash: {},
                        fn: g.program(8, i, 0),
                        inverse: g.noop,
                        data: i
                    })) != null ? f : "") + '            </div>\n        </div>\n        <div class="jw-setting-row">\n            <span class="jw-setting-label">Nền chữ</span>\n            <span class="jw-setting-value">\n' + ((f = h["if"].call(n, ((f = (k != null ? k.currentOption : k)) != null ? f.back : f), {
                        name: "if",
                        hash: {},
                        fn: g.program(10, i, 0),
                        inverse: g.program(12, i, 0),
                        data: i
                    })) != null ? f : "") + "            </span>\n        </div>\n    </div>\n</div>"
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(136), d(139), d(107), d(46)], e = function(h, g, j, f) {
                var i = h.extend({
                    constructor: function(l, k) {
                        this._model = l;
                        h.call(this, k);
                        this.volumeSlider = new g("jw-slider-volume jw-volume-tip", "vertical");
                        this.addContent(this.volumeSlider.element());
                        this.volumeSlider.on("update", function(m) {
                            this.trigger("update", m)
                        }, this);
                        f.removeClass(this.el, "jw-hidden");
                        new j(this.el, {
                            useHover: true,
                            directSelect: true
                        }).on("click", this.toggleValue, this).on("tap", this.toggleOpenState, this).on("over", this.openTooltip, this).on("out", this.closeTooltip, this);
                        this._model.on("change:volume", this.onVolume, this)
                    },
                    toggleValue: function() {
                        this.trigger("toggleValue")
                    }
                });
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(136), d(46), d(43), d(107)], e = function(i, f, h, j) {
                var g = i.extend({
                    constructor: function(k) {
                        i.call(this, k);
                        this.container.className = "jw-overlay-horizontal jw-reset";
                        this.openClass = "jw-open-drawer";
                        this.componentType = "drawer"
                    },
                    setup: function(l, k) {
                        if (!this.iconUI) {
                            this.iconUI = new j(this.el, {
                                useHover: true,
                                directSelect: true
                            });
                            this.toggleOpenStateListener = this.toggleOpenState.bind(this);
                            this.openTooltipListener = this.openTooltip.bind(this);
                            this.closeTooltipListener = this.closeTooltip.bind(this)
                        }
                        this.reset();
                        l = h.isArray(l) ? l : [];
                        this.activeContents = h.filter(l, function(m) {
                            return m.isActive
                        });
                        f.toggleClass(this.el, "jw-hidden", !k || this.activeContents.length < 2);
                        if (k && this.activeContents.length > 1) {
                            f.removeClass(this.el, "jw-off");
                            this.iconUI.on("tap", this.toggleOpenStateListener).on("over", this.openTooltipListener).on("out", this.closeTooltipListener);
                            h.each(l, function(m) {
                                this.container.appendChild(m.el)
                            }, this)
                        }
                    },
                    reset: function() {
                        f.addClass(this.el, "jw-off");
                        this.iconUI.off();
                        if (this.contentUI) {
                            this.contentUI.off().destroy()
                        }
                        this.removeContent()
                    }
                });
                return g
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46)], e = function(h, g) {
                var j = function(k) {
                    this.model = k;
                    k.on("change:playlistItem", i, this);
                    k.on("change:mediaModel", f, this)
                };

                function f(k, l) {
                    l.off("change:mediaType", null, this);
                    l.on("change:mediaType", function(n, m) {
                        if (m === "audio") {
                            this.setImage(k.get("playlistItem").image)
                        }
                    }, this)
                }

                function i(k, m) {
                    var l = (k.get("autostart") && !g.isMobile()) || (k.get("item") > 0);
                    if (l) {
                        this.setImage(null);
                        k.off("change:state", null, this);
                        k.on("change:state", function(n, o) {
                            if (o === "complete" || o === "idle" || o === "error") {
                                this.setImage(m.image)
                            }
                        }, this);
                        return
                    }
                    this.setImage(m.image)
                }
                h.extend(j.prototype, {
                    setup: function(k) {
                        this.el = k;
                        var l = this.model.get("playlistItem");
                        if (l) {
                            this.setImage(l.image)
                        }
                    },
                    setImage: function(k) {
                        this.model.off("change:state", null, this);
                        var l = "";
                        if (h.isString(k)) {
                            l = 'url("' + k + '")'
                        }
                        g.style(this.el, {
                            backgroundImage: l
                        })
                    },
                    element: function() {
                        return this.el
                    }
                });
                return j
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(46), d(152), d(43), d(107), d(58)], e = function(g, j, h, k, f) {
                var i = function() {};
                h.extend(i.prototype, {
                    buildArray: function() {
                        var l = f.split("+");
                        var m = l[0];
                        var n = {
                            items: [{
                                title: "Sao chép URL",
                                featured: true,
                                showLogo: false,
                                click: 'jwplayer("' + this.api.id + '").showCopyUrl()',
                                link: ""
                            },{
                                title: "Lấy mã",
                                featured: true,
                                showLogo: false,
                                click: 'jwplayer("' + this.api.id + '").showCopyIframeCode()',
                                link: ""
                            }, {
                                title: "Fan Page Hội Yêu Phim",
                                featured: true, 
                                showLogo: false,
                                link: "//facebook.com/biphim.net/"
                            }, {
                                title: "Biphim Player",
                                featured: true,
                                showLogo: false,
                                link: "//biphim.net"
                            }]
                        };
                        var o = this.model.get("provider").name;
                        if (o.indexOf("html5") >= 0) {
                            n.items.unshift({
                                title: "Chụp màn hình",
                                featured: true,
                                showLogo: false,
                                link: "",
                                click: 'jwplayer("' + this.api.id + '").saveScreenShot()'
                            })
                        }
                        return n
                    },
                    buildMenu: function() {
                        var l = this.buildArray();
                        return g.createElement(j(l))
                    },
                    updateHtml: function() {
                        this.el.innerHTML = this.buildMenu().innerHTML
                    },
                    rightClick: function(l) {
                        this.lazySetup();
                        if (this.mouseOverContext) {
                            return false
                        }
                        this.hideMenu();
                        this.showMenu(l);
                        return false
                    },
                    getOffset: function(m) {
                        var n = m.target;
                        var l = m.offsetX || m.layerX;
                        var o = m.offsetY || m.layerY;
                        while (n !== this.playerElement) {
                            l += n.offsetLeft;
                            o += n.offsetTop;
                            n = n.parentNode
                        }
                        return {
                            x: l,
                            y: o
                        }
                    },
                    showMenu: function(l) {
                        var m = this.getOffset(l);
                        this.el.style.left = m.x + "px";
                        this.el.style.top = m.y + "px";
                        g.addClass(this.playerElement, "jw-flag-rightclick-open");
                        g.addClass(this.el, "jw-open");
                        return false
                    },
                    hideMenu: function() {
                        if (this.mouseOverContext) {
                            return
                        }
                        g.removeClass(this.playerElement, "jw-flag-rightclick-open");
                        g.removeClass(this.el, "jw-open")
                    },
                    lazySetup: function() {
                        if (this.el) {
                            return
                        }
                        this.el = this.buildMenu();
                        this.layer.appendChild(this.el);
                        this.hideMenuHandler = this.hideMenu.bind(this);
                        this.addOffListener(this.playerElement);
                        this.addOffListener(document);
                        this.model.on("change:provider", this.updateHtml, this);
                        this.elementUI = new k(this.el, {
                            useHover: true
                        }).on("over", function() {
                            this.mouseOverContext = true
                        }, this).on("out", function() {
                            this.mouseOverContext = false
                        }, this)
                    },
                    setup: function(o, l, m, n) {
                        this.playerElement = l;
                        this.model = o;
                        this.mouseOverContext = false;
                        this.layer = m;
                        this.api = n;
                        l.oncontextmenu = this.rightClick.bind(this)
                    },
                    addOffListener: function(l) {
                        l.addEventListener("mousedown", this.hideMenuHandler);
                        l.addEventListener("touchstart", this.hideMenuHandler);
                        l.addEventListener("pointerdown", this.hideMenuHandler)
                    },
                    removeOffListener: function(l) {
                        l.removeEventListener("mousedown", this.hideMenuHandler);
                        l.removeEventListener("touchstart", this.hideMenuHandler);
                        l.removeEventListener("pointerdown", this.hideMenuHandler)
                    },
                    destroy: function() {
                        if (this.el) {
                            this.hideMenu();
                            this.elementUI.off();
                            this.removeOffListener(this.playerElement);
                            this.removeOffListener(document);
                            this.hideMenuHandler = null;
                            this.el = null
                        }
                        if (this.playerElement) {
                            this.playerElement.oncontextmenu = null;
                            this.playerElement = null
                        }
                        if (this.model) {
                            this.model.off("change:provider", this.updateHtml);
                            this.model = null
                        }
                    }
                });
                return i
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
		// fanpage
		
		//fanpage end
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                "1": function(f, k, i, g, j) {
                    var h;
                    return ((h = i["if"].call(k != null ? k : {}, (k != null ? k.click : k), {
                        name: "if",
                        hash: {},
                        fn: f.program(2, j, 0),
                        inverse: f.program(7, j, 0),
                        data: j
                    })) != null ? h : "")
                },
                "2": function(g, l, h, k, j) {
                    var f, i, p = l != null ? l : {},
                        o = h.helperMissing,
                        n = "function",
                        m = g.escapeExpression;
                    return '        <li class="jw-reset' + ((f = h["if"].call(p, (l != null ? l.featured : l), {
                        name: "if",
                        hash: {},
                        fn: g.program(3, j, 0),
                        inverse: g.noop,
                        data: j
                    })) != null ? f : "") + '">\n            <a href="javascript:void(0)" class="jw-reset" onclick="' + m(((i = (i = h.click || (l != null ? l.click : l)) != null ? i : o), (typeof i === n ? i.call(p, {
                        name: "click",
                        hash: {},
                        data: j
                    }) : i))) + '">\n' + ((f = h["if"].call(p, (l != null ? l.showLogo : l), {
                        name: "if",
                        hash: {},
                        fn: g.program(5, j, 0),
                        inverse: g.noop,
                        data: j
                    })) != null ? f : "") + "                " + m(((i = (i = h.title || (l != null ? l.title : l)) != null ? i : o), (typeof i === n ? i.call(p, {
                        name: "title",
                        hash: {},
                        data: j
                    }) : i))) + "\n            </a>\n        </li>\n"
                },
                "3": function(f, j, h, g, i) {
                    return " jw-featured"
                },
                "5": function(f, j, h, g, i) {
                    return '                <span class="jw-icon jw-rightclick-logo jw-reset"></span>\n'
                },
                "7": function(g, l, h, k, j) {
                    var f, i, p = l != null ? l : {},
                        o = h.helperMissing,
                        n = "function",
                        m = g.escapeExpression;
                    return '        <li class="jw-reset' + ((f = h["if"].call(p, (l != null ? l.featured : l), {
                        name: "if",
                        hash: {},
                        fn: g.program(3, j, 0),
                        inverse: g.noop,
                        data: j
                    })) != null ? f : "") + '">\n            <a href="' + m(((i = (i = h.link || (l != null ? l.link : l)) != null ? i : o), (typeof i === n ? i.call(p, {
                        name: "link",
                        hash: {},
                        data: j
                    }) : i))) + '" class="jw-reset" target="_blank">\n' + ((f = h["if"].call(p, (l != null ? l.showLogo : l), {
                        name: "if",
                        hash: {},
                        fn: g.program(5, j, 0),
                        inverse: g.noop,
                        data: j
                    })) != null ? f : "") + "                " + m(((i = (i = h.title || (l != null ? l.title : l)) != null ? i : o), (typeof i === n ? i.call(p, {
                        name: "title",
                        hash: {},
                        data: j
                    }) : i))) + "\n            </a>\n        </li>\n"
                },
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, i, g, j) {
                    var h;
                    return '<div class="jw-rightclick jw-reset">\n    <ul class="jw-reset">\n' + ((h = i.each.call(k != null ? k : {}, (k != null ? k.items : k), {
                        name: "each",
                        hash: {},
                        fn: f.program(1, j, 0),
                        inverse: f.noop,
                        data: j
                    })) != null ? h : "") + "    </ul>\n</div>"
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(46), ], e = function(g, f) {
                var h = function(i) {
                    this.model = i;
                    this.model.on("change:playlistItem", this.playlistItem, this)
                };
                g.extend(h.prototype, {
                    hide: function() {
                        this.el.style.display = "none"
                    },
                    show: function() {
                        this.el.style.display = ""
                    },
                    setup: function(j) {
                        this.el = j;
                        var i = this.el.getElementsByTagName("div");
                        this.title = i[0];
                        this.description = i[1];
                        if (this.model.get("playlistItem")) {
                            this.playlistItem(this.model, this.model.get("playlistItem"))
                        }
                        this.model.on("change:logoWidth", this.update, this);
                        this.model.on("change:dock", this.update, this)
                    },
                    update: function(j) {
                        var p = {
                            paddingLeft: 0,
                            paddingRight: 0
                        };
                        var i = j.get("controls");
                        var o = j.get("dock");
                        var n = j.get("logo");
                        if (n) {
                            var l = 1 * ("" + n.margin).replace("px", "");
                            var m = j.get("logoWidth") + (isNaN(l) ? 0 : l);
                            if (n.position === "top-left") {
                                p.paddingLeft = m
                            } else {
                                if (n.position === "top-right") {
                                    p.paddingRight = m
                                }
                            }
                        }
                        if (i && o && o.length) {
                            var k = 56 * o.length;
                            p.paddingRight = Math.max(p.paddingRight, k)
                        }
                        f.style(this.el, p)
                    },
                    playlistItem: function(i, k) {
                        if (i.get("displaytitle") || i.get("displaydescription")) {
                            var l = "";
                            var j = "";
                            if (k.title && i.get("displaytitle")) {
                                l = k.title
                            }
                            if (k.description && i.get("displaydescription")) {
                                j = k.description
                            }
                            this.updateText(l, j)
                        } else {
                            this.hide()
                        }
                    },
                    updateText: function(j, i) {
                        this.title.innerHTML = j;
                        this.description.innerHTML = i;
                        if (this.title.firstChild || this.description.firstChild) {
                            this.show()
                        } else {
                            this.hide()
                        }
                    },
                    element: function() {
                        return this.el
                    }
                });
                return h
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, i, g, j) {
                    var h;
                    return '<div id="' + f.escapeExpression(((h = (h = i.id || (k != null ? k.id : k)) != null ? h : i.helperMissing), (typeof h === "function" ? h.call(k != null ? k : {}, {
                        name: "id",
                        hash: {},
                        data: j
                    }) : h))) + '" class="jwplayer jw-reset" tabindex="0">\n    <div class="jw-aspect jw-reset"></div>\n    <div class="jw-media jw-reset"></div>\n    <div class="jw-preview jw-reset"></div>\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset"></div>\n        <div class="jw-title-secondary jw-reset"></div>\n    </div>\n    <div class="jw-overlays jw-reset"></div>\n    <div class="jw-controls jw-reset"></div>\n</div>'
                },
                useData: true
            })
        },
        function(b, a, d) {
            var c = d(156);
            if (typeof c === "string") {
                c = [
                    [b.id, c, ""]
                ]
            }
            var e = d(160)(c, {});
            if (c.locals) {
                b.exports = c.locals
            }
        },
        function(b, a, c) {
            a = b.exports = c(157)();
            a.push([b.id, ".jw-reset{color:inherit;background-color:transparent;padding:0;margin:0;float:none;font-family:Arial,Helvetica,sans-serif;font-size:1em;line-height:1em;list-style:none;text-align:left;text-transform:none;vertical-align:baseline;border:0;direction:ltr;font-variant:inherit;font-stretch:inherit;-webkit-tap-highlight-color:rgba(255,255,255,0)}@font-face{font-family:'jw-icons';src:url(" + c(158) + ") format('woff'),url(" + c(159) + ') format(\'truetype\');font-weight:normal;font-style:normal}.jw-icon{-webkit-transition:color .2s linear;transition:color .2s linear}.jw-icon-inline,.jw-icon-tooltip,.jw-icon-display,.jw-controlbar .jw-menu .jw-option:before{-webkit-transition:color .2s linear;transition:color .2s linear;font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-icon-audio-tracks:before{content:"\\E90E"}.jw-icon-buffer:before{content:"\\E601"}.jw-icon-cast:before{content:"\\E603"}.jw-icon-cast.jw-off:before{content:"\\E602"}.jw-icon-cc:before{content:"\\E605"}.jw-icon-cue:before{content:"\\E606"}.jw-icon-menu-bullet:before{content:"\\E606"}.jw-icon-error:before{content:"\\E607"}.jw-icon-fullscreen:before{content:"\\E905"}.jw-icon-fullscreen.jw-off:before{content:"\\E906"}.jw-icon-hd:before{content:"\\E60A"}.jw-watermark:before,.jw-rightclick-logo:before{content:"\\E60B"}.jw-icon-next:before{content:"\\E60C"}.jw-icon-pause:before{content:"\\E60D"}.jw-icon-play:before{content:"\\E60E"}.jw-icon-prev:before{content:"\\E60F"}.jw-icon-replay:before{content:"\\E610"}.jw-icon-volume:before{content:"\\E912"}.jw-icon-volume.jw-off:before{content:"\\E911"}.jw-icon-more:before{content:"\\E614"}.jw-icon-close:before{content:"\\E615"}.jw-icon-playlist:before{content:"\\E616"}.jw-icon-setting:before{content:"\\E90D"}.jwplayer{width:100%;font-size:16px;position:relative;display:block;min-height:0;overflow:hidden;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif;background-color:#000;-webkit-touch-callout:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.jwplayer *{box-sizing:inherit}.jwplayer.jw-flag-aspect-mode{height:auto !important}.jwplayer.jw-flag-aspect-mode .jw-aspect{display:block}.jwplayer .jw-aspect{display:none}.jwplayer.jw-no-focus:focus,.jwplayer .jw-swf{outline:none}.jwplayer.jw-ie:focus{outline:#585858 dotted 1px}.jwplayer:hover .jw-display-icon-container{background-color:#333;background:#333;background-size:#333}.jw-media,.jw-preview,.jw-overlays,.jw-controls{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jw-media{overflow:hidden;cursor:pointer}.jw-overlays{cursor:auto}.jw-media.jw-media-show{visibility:visible;opacity:1}.jw-controls.jw-controls-disabled{display:none}.jw-controls .jw-controls-right{position:absolute;top:0;right:0;left:0;bottom:2em}.jw-text{height:1em;font-family:Arial,Helvetica,sans-serif;font-size:.75em;font-style:normal;font-weight:normal;color:white;text-align:center;font-variant:normal;font-stretch:normal}.jw-plugin{position:absolute;bottom:2.5em}.jw-plugin .jw-banner{max-width:100%;opacity:0;cursor:pointer;position:absolute;margin:auto auto 0 auto;left:0;right:0;bottom:0;display:block}.jw-cast-screen{width:100%;height:100%}.jw-instream{position:absolute;top:0;right:0;bottom:0;left:0;display:none}.jw-icon-playback:before{content:"\\E60E"}.jw-preview,.jw-captions,.jw-title,.jw-overlays,.jw-controls{pointer-events:none}.jw-overlays>div,.jw-media,.jw-controlbar,.jw-dock,.jw-logo,.jw-skip,.jw-display-icon-container{pointer-events:all}.jwplayer video{position:absolute;top:0;right:0;bottom:0;left:0;width:100%;height:100%;margin:auto;background:transparent}.jwplayer video::-webkit-media-controls-start-playback-button{display:none}.jwplayer video::-webkit-media-text-track-display{-webkit-transform:translateY(-1.5em);transform:translateY(-1.5em)}.jwplayer.jw-flag-user-inactive.jw-state-playing video::-webkit-media-text-track-display{-webkit-transform:translateY(0);transform:translateY(0)}.jwplayer.jw-stretch-uniform video{-o-object-fit:contain;object-fit:contain}.jwplayer.jw-stretch-none video{-o-object-fit:none;object-fit:none}.jwplayer.jw-stretch-fill video{-o-object-fit:cover;object-fit:cover}.jwplayer.jw-stretch-exactfit video{-o-object-fit:fill;object-fit:fill}.jw-click{position:absolute;width:100%;height:100%}.jw-preview{position:absolute;display:none;opacity:1;visibility:visible;width:100%;height:100%;background:#000 no-repeat 50% 50%}.jwplayer .jw-preview,.jw-error .jw-preview,.jw-stretch-uniform .jw-preview{background-size:contain}.jw-stretch-none .jw-preview{background-size:auto auto}.jw-stretch-fill .jw-preview{background-size:cover}.jw-stretch-exactfit .jw-preview{background-size:100% 100%}.jw-display-icon-container{position:relative;top:50%;display:table;height:3.5em;width:3.5em;margin:-1.75em auto 0;cursor:pointer}.jw-display-icon-container .jw-icon-display{position:relative;display:table-cell;text-align:center;vertical-align:middle !important;background-position:50% 50%;background-repeat:no-repeat;font-size:2em}.jw-flag-audio-player .jw-display-icon-container,.jw-flag-dragging .jw-display-icon-container{display:none}.jw-icon{font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-controlbar{display:table;position:absolute;right:0;left:0;bottom:0;height:2em;padding:0 .25em;width:100%}.jw-controlbar .jw-hidden{display:none}.jw-controlbar.jw-drawer-expanded .jw-controlbar-left-group,.jw-controlbar.jw-drawer-expanded .jw-controlbar-center-group{opacity:0}.jw-background-color{background-color:#414040}.jw-group{display:table-cell}.jw-controlbar-center-group{position:absolute;left:0;top:-10px;width:100%;padding:0 .25em}.jw-controlbar-center-group .jw-slider-time,.jw-controlbar-center-group .jw-text-alt{padding:0}.jw-controlbar-center-group .jw-text-alt{display:none}.jw-controlbar-right-group{text-align:right}.jw-controlbar-left-group,.jw-controlbar-right-group{white-space:nowrap}.jw-knob:hover,.jw-icon-inline:hover,.jw-icon-tooltip:hover,.jw-icon-display:hover,.jw-option:before:hover{color:#eee}.jw-icon-inline,.jw-icon-tooltip,.jw-slider-horizontal,.jw-text-elapsed,.jw-text-duration{display:inline-block;height:2em;position:relative;line-height:2em;vertical-align:middle;cursor:pointer}.jw-icon-inline,.jw-icon-tooltip{min-width:1.25em;text-align:center}.jw-icon-playback{min-width:2.25em}.jw-icon-volume{min-width:1.75em;text-align:left}.jw-time-tip{line-height:1em;pointer-events:none}.jw-icon-inline:after,.jw-icon-tooltip:after{width:100%;height:100%;font-size:1em}.jw-icon-cast{display:none}.jw-slider-volume.jw-slider-horizontal,.jw-icon-inline.jw-icon-volume{display:none}.jw-dock{margin:.75em;display:block;opacity:1;clear:right}.jw-dock:after{content:\'\';clear:both;display:block}.jw-dock-button{cursor:pointer;float:right;position:relative;width:2.5em;height:2.5em;margin:.5em}.jw-dock-button .jw-arrow{display:none;position:absolute;bottom:-0.2em;width:.5em;height:.2em;left:50%;margin-left:-0.25em}.jw-dock-button .jw-overlay{display:none;position:absolute;top:2.5em;right:0;margin-top:.25em;padding:.5em;white-space:nowrap}.jw-dock-button:hover .jw-overlay,.jw-dock-button:hover .jw-arrow{display:block}.jw-dock-image{width:100%;height:100%;background-position:50% 50%;background-repeat:no-repeat;opacity:.75}.jw-title{display:none;position:absolute;top:0;width:100%;font-size:.875em;height:8em;background:-webkit-linear-gradient(top, rgba(0,0,0,0.38) 0, rgba(0,0,0,0.63) 8%, rgba(0,0,0,0) 100%);background:linear-gradient(to bottom, rgba(0,0,0,0.38) 0, rgba(0,0,0,0.63) 8%, rgba(0,0,0,0) 100%)}.jw-title-primary,.jw-title-secondary{padding:.75em 1.5em;min-height:2.5em;width:100%;color:white;white-space:nowrap;text-overflow:ellipsis;overflow-x:hidden}.jw-title-primary{font-weight:bold}.jw-title-secondary{margin-top:-0.5em}.jw-slider-container{display:inline-block;height:1em;position:relative;touch-action:none}.jw-rail,.jw-buffer,.jw-progress{position:absolute;cursor:pointer}.jw-progress{background-color:#fff}.jw-rail{background-color:#aaa}.jw-buffer{background-color:#202020}.jw-cue,.jw-knob{position:absolute;cursor:pointer}.jw-cue{background-color:#fff;width:.1em;height:.4em}.jw-knob{background-color:#aaa;width:.4em;height:.4em}.jw-slider-horizontal{width:4em;height:1em;background:none !important}.jw-slider-horizontal.jw-slider-volume{margin-right:5px}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress{width:100%;height:.4em}.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-buffer{width:0}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-slider-container{width:100%}.jw-slider-horizontal .jw-knob{left:0;margin-left:-0.325em}.jw-slider-vertical{width:.75em;height:4em;bottom:0;position:absolute;padding:1em}.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-buffer,.jw-slider-vertical .jw-progress{bottom:0;height:100%}.jw-slider-vertical .jw-progress,.jw-slider-vertical .jw-buffer{height:0}.jw-slider-vertical .jw-slider-container,.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-progress{bottom:0;width:.75em;height:100%;left:0;right:0;margin:0 auto}.jw-slider-vertical .jw-slider-container{height:4em;position:relative}.jw-slider-vertical .jw-knob{bottom:0;left:0;right:0;margin:0 auto}.jw-slider-time{right:0;left:0;width:100%}.jw-tooltip-time{position:absolute;bottom:.1em}.jw-slider-volume .jw-buffer{display:none}.jw-captions{position:absolute;display:none;margin:0 auto;width:100%;left:0;bottom:3em;right:0;max-width:90%;text-align:center;-webkit-transition:bottom .2s linear;transition:bottom .2s linear}.jw-captions.jw-captions-enabled{display:block}.jw-captions-window{display:none;padding:.25em;border-radius:.25em}.jw-captions-window.jw-captions-window-active{display:inline-block}.jw-captions-text{display:inline-block;color:white;background-color:black;word-wrap:break-word;white-space:pre-line;font-style:normal;font-weight:normal;text-align:center;text-decoration:none;line-height:1.3em;padding:.1em .8em}.jwplayer video::-webkit-media-text-track-container{bottom:1.5em}.jwplayer.jw-flag-compact-player video::-webkit-media-text-track-container{bottom:2.5em}.jw-rightclick{display:none;position:absolute;white-space:nowrap}.jw-rightclick.jw-open{display:block}.jw-rightclick ul{list-style:none;font-weight:bold;border-radius:.15em;margin:0;border:1px solid #444;padding-left:0}.jw-rightclick .jw-rightclick-logo{font-size:2em;color:#ff0147;vertical-align:middle;padding-right:.3em;margin-right:.3em;border-right:1px solid #444}.jw-rightclick li{background-color:#000;border-bottom:1px solid #444}.jw-rightclick a{color:#fff;text-decoration:none;padding:1em;display:block;font-size:.6875em}.jw-rightclick li:last-child{border-bottom:none}.jw-rightclick li:hover{background-color:#1a1a1a;cursor:pointer}.jw-rightclick .jw-featured{background-color:#252525;vertical-align:middle}.jw-rightclick .jw-featured a{color:#777}.jw-logo{position:absolute;margin:.75em;cursor:pointer;pointer-events:all;background-repeat:no-repeat;background-size:contain;top:auto;right:auto;left:auto;bottom:auto}.jw-logo .jw-flag-audio-player{display:none}.jw-logo-top-right{top:0;right:0}.jw-logo-top-left{top:0;left:0}.jw-logo-bottom-left{bottom:0;left:0}.jw-logo-bottom-right{bottom:0;right:0}.jw-watermark{position:absolute;top:50%;left:0;right:0;bottom:0;text-align:center;font-size:14em;color:#eee;opacity:.33;pointer-events:none}.jw-icon-tooltip.jw-open .jw-overlay{opacity:1;visibility:visible;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-icon-tooltip.jw-hidden{display:none}.jw-overlay-horizontal{display:none}.jw-icon-tooltip.jw-open-drawer:before{display:none}.jw-icon-tooltip.jw-open-drawer .jw-overlay-horizontal{opacity:1;display:inline-block;vertical-align:top;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-overlay:before{position:absolute;top:0;bottom:0;left:-50%;width:100%;background-color:rgba(0,0,0,0);content:" "}.jw-slider-time .jw-overlay:before{height:1em;top:auto}.jw-time-tip,.jw-volume-tip,.jw-menu{position:relative;left:-50%;border:solid 1px #000;margin:0}.jw-volume-tip{width:100%;height:100%;display:block}.jw-time-tip{text-align:center;font-family:inherit;color:#aaa;bottom:1em;border:solid 4px #000}.jw-time-tip .jw-text{line-height:1em}.jw-controlbar .jw-overlay{margin:0;position:absolute;bottom:2em;left:50%;opacity:0;visibility:hidden}.jw-controlbar .jw-overlay .jw-contents{position:relative}.jw-controlbar .jw-option{position:relative;white-space:nowrap;cursor:pointer;list-style:none;height:1.5em;font-family:inherit;line-height:1.5em;color:#aaa;padding:0 .5em;font-size:.8em}.jw-controlbar .jw-option:hover,.jw-controlbar .jw-option:before:hover{color:#eee}.jw-controlbar .jw-option:before{padding-right:.125em}.jw-playlist-container ::-webkit-scrollbar-track{background-color:#333;border-radius:10px}.jw-playlist-container ::-webkit-scrollbar{width:5px;border:10px solid black;border-bottom:0;border-top:0}.jw-playlist-container ::-webkit-scrollbar-thumb{background-color:white;border-radius:5px}.jw-tooltip-title{border-bottom:1px solid #444;text-align:left;padding-left:.7em}.jw-playlist{max-height:20em;min-height:4.5em;overflow-x:hidden;overflow-y:auto;width:calc(100% - 4px)}.jw-playlist .jw-option{height:3em;margin-right:5px;color:white;padding-left:1em;font-size:.8em}.jw-playlist .jw-label,.jw-playlist .jw-name,.jw-playlist .jw-playlist-thumb{display:inline-block;line-height:3em;text-align:left;overflow:hidden;white-space:nowrap}.jw-playlist .jw-label{width:1em}.jw-playlist .jw-name{width:11em}.jw-skip{cursor:default;position:absolute;float:right;display:inline-block;right:.75em;bottom:3em}.jw-skip.jw-skippable{cursor:pointer}.jw-skip.jw-hidden{visibility:hidden}.jw-skip .jw-skip-icon{display:none;margin-left:-0.75em}.jw-skip .jw-skip-icon:before{content:"\\E60C"}.jw-skip .jw-text,.jw-skip .jw-skip-icon{color:#aaa;vertical-align:middle;line-height:1.5em;font-size:.7em}.jw-skip.jw-skippable:hover{cursor:pointer}.jw-skip.jw-skippable:hover .jw-text,.jw-skip.jw-skippable:hover .jw-skip-icon{color:#eee}.jw-skip.jw-skippable .jw-skip-icon{display:inline;margin:0}.jwplayer.jw-state-playing.jw-flag-casting .jw-display-icon-container,.jwplayer.jw-state-paused.jw-flag-casting .jw-display-icon-container{display:table}.jwplayer.jw-flag-casting .jw-display-icon-container{border-radius:0;border:1px solid white;position:absolute;top:auto;left:.5em;right:.5em;bottom:50%;margin-bottom:-12.5%;height:50%;width:50%;padding:0;background-repeat:no-repeat;background-position:center}.jwplayer.jw-flag-casting .jw-display-icon-container .jw-icon{font-size:3em}.jwplayer.jw-flag-casting.jw-state-complete .jw-preview{display:none}.jw-cast{position:absolute;width:100%;height:100%;background-repeat:no-repeat;background-size:auto;background-position:50% 50%}.jw-cast-label{position:absolute;left:.5em;right:.5em;bottom:75%;margin-bottom:1.5em;text-align:center}.jw-cast-name{color:#ccc}.jw-state-idle .jw-preview{display:block}.jw-state-idle .jw-icon-display:before{content:"\\E60E"}.jw-state-idle .jw-controlbar{visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-state-idle .jw-captions{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-state-idle .jw-title{display:block;visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-playing .jw-display-icon-container{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-playing .jw-display-icon-container .jw-icon-display:before{content:"\\E60D"}.jwplayer.jw-state-playing .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-paused .jw-display-icon-container{visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-paused .jw-display-icon-container .jw-icon-display:before{content:"\\E60E"}.jwplayer.jw-state-paused .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display{-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display:before{content:"\\E601"}@-webkit-keyframes spin{100%{-webkit-transform:rotate(360deg)}}@keyframes spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-text{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-buffering .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-complete .jw-preview{visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-complete .jw-display-icon-container .jw-icon-display:before{content:"\\E610"}.jwplayer.jw-state-complete .jw-display-icon-container .jw-text{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-state-complete .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-complete .jw-captions{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}body .jw-error .jw-title,.jwplayer.jw-state-error .jw-title{visibility:visible;opacity:1;display:block;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}body .jw-error .jw-title .jw-title-primary,.jwplayer.jw-state-error .jw-title .jw-title-primary{white-space:normal}body .jw-error .jw-preview,.jwplayer.jw-state-error .jw-preview{visibility:visible;opacity:1;display:block;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}body .jw-error .jw-controlbar,.jwplayer.jw-state-error .jw-controlbar{visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}body .jw-error .jw-captions,.jwplayer.jw-state-error .jw-captions{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}body .jw-error:hover .jw-display-icon-container,.jwplayer.jw-state-error:hover .jw-display-icon-container{cursor:default;color:#fff;background:#000}body .jw-error .jw-icon-display,.jwplayer.jw-state-error .jw-icon-display{cursor:default;-webkit-transition:color .2s linear;transition:color .2s linear;font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}body .jw-error .jw-icon-display:before,.jwplayer.jw-state-error .jw-icon-display:before{content:"\\E607"}body .jw-error .jw-icon-display:hover,.jwplayer.jw-state-error .jw-icon-display:hover{color:#fff}body .jw-error{font-size:16px;background-color:#000;color:#eee;width:100%;height:100%;display:table;opacity:1;position:relative}body .jw-error .jw-icon-container{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jwplayer.jw-flag-cast-available .jw-controlbar{display:table}.jwplayer.jw-flag-cast-available .jw-icon-cast{display:inline-block}.jwplayer.jw-flag-skin-loading .jw-captions,.jwplayer.jw-flag-skin-loading .jw-controls,.jwplayer.jw-flag-skin-loading .jw-title{display:none}.jwplayer.jw-flag-fullscreen{width:100% !important;height:100% !important;top:0;right:0;bottom:0;left:0;z-index:1000;margin:0;position:fixed}.jwplayer.jw-flag-fullscreen.jw-flag-user-inactive{cursor:none;-webkit-cursor-visibility:auto-hide}.jwplayer.jw-flag-fullscreen.jw-flag-user-inactive .jw-media{cursor:none}.jwplayer.jw-flag-fullscreen:hover .jw-title{display:block}.jwplayer.jw-flag-user-inactive .jw-title{display:none !important}.jwplayer.jw-flag-live .jw-controlbar-center-group{position:relative;left:auto;top:auto}.jwplayer.jw-flag-live .jw-controlbar .jw-text-elapsed,.jwplayer.jw-flag-live .jw-controlbar .jw-text-duration,.jwplayer.jw-flag-live .jw-controlbar .jw-slider-time{display:none}.jwplayer.jw-flag-live .jw-controlbar .jw-text-alt{display:inline}.jwplayer.jw-flag-user-inactive.jw-state-playing .jw-controlbar,.jwplayer.jw-flag-user-inactive.jw-state-playing .jw-dock{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-flag-user-inactive.jw-state-playing .jw-logo.jw-hide{visibility:hidden;opacity:0;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-flag-user-inactive.jw-state-playing .jw-plugin,.jwplayer.jw-flag-user-inactive.jw-state-playing .jw-captions{bottom:.5em}.jwplayer.jw-flag-user-inactive.jw-state-playing video::-webkit-media-text-track-container{bottom:.5em}.jwplayer.jw-flag-user-inactive.jw-state-buffering .jw-controlbar{display:none}.jwplayer.jw-flag-media-audio .jw-controlbar{display:table}.jw-flag-media-audio .jw-preview{display:block}.jwplayer.jw-flag-ads .jw-controlbar-center-group{position:relative;left:auto;top:auto}.jwplayer.jw-flag-ads .jw-preview,.jwplayer.jw-flag-ads .jw-dock,.jwplayer.jw-flag-ads .jw-logo,.jwplayer.jw-flag-ads .jw-captions.jw-captions-enabled{display:none}.jwplayer.jw-flag-ads video::-webkit-media-text-track-container{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip,.jwplayer.jw-flag-ads .jw-controlbar .jw-text,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-horizontal{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-playback,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-fullscreen{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-text-alt{display:inline}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-ads .jw-logo,.jwplayer.jw-flag-ads .jw-captions{display:none}.jwplayer.jw-flag-ads-googleima .jw-controlbar{display:table;bottom:0}.jwplayer.jw-flag-ads-googleima.jw-flag-touch .jw-controlbar{font-size:1em}.jwplayer.jw-flag-ads-googleima.jw-flag-touch.jw-state-paused .jw-display-icon-container{display:none}.jwplayer.jw-flag-ads-googleima.jw-skin-seven .jw-controlbar{font-size:.9em}.jwplayer.jw-flag-ads-vpaid .jw-controlbar{display:none}.jwplayer.jw-flag-ads-hide-controls .jw-controls{display:none !important}.jwplayer.jw-flag-ads.jw-flag-touch .jw-controlbar{display:table}.jwplayer.jw-flag-ads .jw-controlbar{display:table}.jwplayer.jw-flag-overlay-open .jw-title{display:none}.jwplayer.jw-flag-overlay-open .jw-controls-right .jw-logo{display:none}.jwplayer.jw-flag-overlay-open-sharing .jw-controls,.jwplayer.jw-flag-overlay-open-related .jw-controls,.jwplayer.jw-flag-overlay-open-sharing .jw-title,.jwplayer.jw-flag-overlay-open-related .jw-title{display:none}.jwplayer.jw-flag-rightclick-open{overflow:visible}.jwplayer.jw-flag-rightclick-open .jw-rightclick{z-index:16777215}.jw-flag-controls-disabled .jw-controls{visibility:hidden;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-flag-controls-disabled .jw-logo{visibility:visible;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jw-flag-controls-disabled .jw-media{cursor:auto}body .jwplayer.jw-flag-flash-blocked .jw-title{display:block}body .jwplayer.jw-flag-flash-blocked .jw-controls,body .jwplayer.jw-flag-flash-blocked .jw-overlays,body .jwplayer.jw-flag-flash-blocked .jw-preview{display:none}.jw-flag-touch .jw-controlbar,.jw-flag-touch .jw-skip,.jw-flag-touch .jw-plugin{font-size:1.5em}.jw-flag-touch .jw-captions{bottom:4.25em}.jw-flag-touch video::-webkit-media-text-track-container{bottom:4.25em}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{display:inline}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{content:"\\E615"}.jw-flag-touch .jw-display-icon-container{pointer-events:none}.jw-flag-touch.jw-state-paused .jw-display-icon-container{display:table}.jw-flag-touch.jw-state-paused.jw-flag-dragging .jw-display-icon-container{display:none}.jw-flag-compact-player .jw-icon-playlist,.jw-flag-compact-player .jw-text-elapsed,.jw-flag-compact-player .jw-text-duration{display:none}.jwplayer.jw-flag-audio-player{background-color:transparent}.jwplayer.jw-flag-audio-player .jw-controlbar-center-group{position:relative;left:auto;top:auto}.jwplayer.jw-flag-audio-player .jw-media{visibility:hidden}.jwplayer.jw-flag-audio-player .jw-media object{width:1px;height:1px}.jwplayer.jw-flag-audio-player .jw-preview,.jwplayer.jw-flag-audio-player .jw-display-icon-container{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar{display:table;height:auto;left:0;bottom:0;margin:0;width:100%;min-width:100%;opacity:1;visibility:visible;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-flag-audio-player .jw-controlbar .jw-icon-fullscreen{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jwplayer.jw-flag-audio-player .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jwplayer.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar{display:table;left:0;visibility:visible;opacity:1;-webkit-transition:visibility .5s,opacity .5s linear;transition:visibility .5s,opacity .5s linear}.jwplayer.jw-flag-audio-player .jw-controlbar{height:auto}.jwplayer.jw-flag-audio-player .jw-preview{display:none}.jwplayer.jw-flag-audio-player .jw-display-icon-container{display:none}.jw-skin-hdo .jw-background-color{background:rgba(0,0,0,0.7)}.jw-skin-hdo .jw-controlbar{height:3em}.jw-skin-hdo .jw-group{vertical-align:middle}.jw-skin-hdo .jw-title{font-size:1.1em}.jw-skin-hdo .jw-playlist{background-color:rgba(0,0,0,0.5)}.jw-skin-hdo .jw-playlist-container{left:-43%;background-color:rgba(0,0,0,0.5)}.jw-skin-hdo .jw-playlist-container .jw-active-option .jw-name{color:#d83f16}.jw-skin-hdo .jw-playlist-container .jw-option{border-bottom:1px solid #444}.jw-skin-hdo .jw-playlist-container .jw-option:hover,.jw-skin-hdo .jw-playlist-container .jw-option.jw-active-option{background-color:rgba(0,0,0,0.33)}.jw-skin-hdo .jw-playlist-container .jw-option:hover .jw-label{color:#d83f16}.jw-skin-hdo .jw-playlist-container .jw-icon-playlist{margin-left:0}.jw-skin-hdo .jw-playlist-container .jw-label .jw-icon-play{color:#d83f16}.jw-skin-hdo .jw-playlist-container .jw-label .jw-icon-play:before{padding-left:0}.jw-skin-hdo .jw-tooltip-title{background-color:#000;color:#fff}.jw-skin-hdo .jw-text{color:#fff}.jw-skin-hdo .jw-icon-tooltip .jw-text:hover{color:#d83f16}.jw-skin-hdo .jw-button-color{color:#fff}.jw-skin-hdo .jw-button-color:hover{color:#d83f16}.jw-skin-hdo .jw-toggle{color:#d83f16}.jw-skin-hdo .jw-toggle.jw-off{color:#fff}.jw-skin-hdo .jw-captions-text{background-color:transparent}.jw-skin-hdo .jw-controlbar .jw-icon:before,.jw-skin-hdo .jw-text-elapsed,.jw-skin-hdo .jw-text-duration{padding:0 .7em}.jw-skin-hdo .jw-controlbar .jw-icon-setting:before,.jw-skin-hdo .jw-controlbar .jw-icon-volume:before,.jw-skin-hdo .jw-controlbar .jw-icon-fullscreen:before,.jw-skin-hdo .jw-controlbar .jw-icon-audio-tracks:before{padding:0 .4em}.jw-skin-hdo .jw-controlbar.jw-background-color{background:rgba(0,0,0,0.15)}.jw-skin-hdo .jw-text-duration{padding-left:0}.jw-skin-hdo .jw-text-duration:before{content:"";border-left:1px solid #fff;padding-left:.5em}.jw-skin-hdo .jw-icon-setting:before,.jw-skin-hdo .jw-icon-volume:before,.jw-skin-hdo .jw-icon-volume.jw-off:before{font-size:1.2em}.jw-skin-hdo .jw-icon-fullscreen:before,.jw-skin-hdo .jw-icon-fullscreen.jw-off:before{font-size:1.4em}.jw-skin-hdo .jw-controlbar .jw-icon-hd .jw-option,.jw-skin-hdo .jw-controlbar .jw-icon-cc .jw-option,.jw-skin-hdo .jw-controlbar .jw-icon-audio-tracks .jw-option{line-height:1.7em;height:1.7em}.jw-skin-hdo .jw-controlbar .jw-icon-prev:before{padding-right:.25em}.jw-skin-hdo .jw-controlbar .jw-icon-playlist:before{padding:0 .45em}.jw-skin-hdo .jw-controlbar .jw-icon-next:before{padding-left:.25em}.jw-skin-hdo .jw-controlbar .jw-icon{font-size:1.3em}.jw-skin-hdo .jw-icon-prev,.jw-skin-hdo .jw-icon-next{font-size:1.1em}.jw-skin-hdo .jw-icon-display{color:#fff}.jw-skin-hdo .jw-icon-display:before{padding-left:0}.jw-skin-hdo .jw-display-icon-container{border-radius:50%;border:1px solid #333;height:5em;width:5em;margin:-2.75em auto 0}.jw-skin-hdo .jw-rail{background-color:#384154;box-shadow:none}.jw-skin-hdo .jw-buffer{background-color:#666F82}.jw-skin-hdo .jw-progress{background:#d83f16}.jw-skin-hdo .jw-knob{width:.6em;height:.6em;background-color:#fff;box-shadow:0 0 0 1px #000;border-radius:1em}.jw-skin-hdo .jw-slider-horizontal .jw-slider-container{height:.95em}.jw-skin-hdo .jw-slider-horizontal .jw-rail,.jw-skin-hdo .jw-slider-horizontal .jw-buffer,.jw-skin-hdo .jw-slider-horizontal .jw-progress{height:.2em;border-radius:0}.jw-skin-hdo .jw-slider-horizontal .jw-knob{top:-0.2em}.jw-skin-hdo .jw-slider-horizontal .jw-cue{top:-0.05em;top:-0.02em;width:.2em;height:.25em;background-color:#F7F056;border-radius:50%;-webkit-transition:width .2s,height .2s linear;transition:width .2s,height .2s linear}.jw-skin-hdo .jw-slider-time .jw-rail,.jw-skin-hdo .jw-slider-time .jw-progress,.jw-skin-hdo .jw-slider-time .jw-buffer{height:.2em;-webkit-transition:height .2s,top .2s linear;transition:height .2s,top .2s linear}.jw-skin-hdo .jw-slider-time .jw-knob{width:.9em;height:.9em;top:-0.3em;visibility:hidden;opacity:0;-webkit-transition:visibility .2s,opacity .2s linear;transition:visibility .2s,opacity .2s linear}.jw-skin-hdo .jw-slider-time .jw-slider-container{top:-0.2em;-webkit-transition:height .2s,top .2s linear;transition:height .2s,top .2s linear;height:.75em}.jw-skin-hdo .jw-slider-time:hover .jw-rail,.jw-skin-hdo .jw-slider-time:hover .jw-progress,.jw-skin-hdo .jw-slider-time:hover .jw-buffer{height:.4em}.jw-skin-hdo .jw-slider-time:hover .jw-cue{width:.3em;height:.4em}.jw-skin-hdo .jw-slider-time:hover .jw-knob{top:-0.25em;visibility:visible;opacity:1}.jw-skin-hdo .jw-slider-time:hover .jw-slider-container{top:-0.3em}.jw-skin-hdo .jw-slider-vertical .jw-rail,.jw-skin-hdo .jw-slider-vertical .jw-buffer,.jw-skin-hdo .jw-slider-vertical .jw-progress{width:.2em}.jw-skin-hdo .jw-volume-tip{width:100%;left:-45%;padding-bottom:.7em}.jw-skin-hdo .jw-text-duration{color:#fff}.jw-skin-hdo .jw-controlbar-right-group .jw-icon-inline:first-child:before{border:none}.jw-skin-hdo .jw-dock .jw-dock-button{border-radius:50%;border:1px solid #333}.jw-skin-hdo .jw-dock .jw-overlay{border-radius:2.5em}.jw-skin-hdo .jw-icon-tooltip .jw-active-option{background-color:#d83f16;color:#fff}.jw-skin-hdo .jw-icon-volume{min-width:1.8em}.jw-skin-hdo .jw-time-tip,.jw-skin-hdo .jw-menu,.jw-skin-hdo .jw-volume-tip,.jw-skin-hdo .jw-skip{border:1px solid #333}.jw-skin-hdo .jw-time-tip{padding:.2em;bottom:-10px}.jw-skin-hdo .jw-time-tip .jw-reset{background-size:cover}.jw-skin-hdo .jw-menu,.jw-skin-hdo .jw-volume-tip{bottom:.4em}.jw-skin-hdo .jw-text-elapsed,.jw-skin-hdo .jw-text-duration{font-size:1em}.jw-skin-hdo .jw-skip{padding:.4em;border-radius:1.75em}.jw-skin-hdo .jw-skip .jw-text,.jw-skin-hdo .jw-skip .jw-icon-inline{color:#fff;line-height:1.75em}.jw-skin-hdo .jw-skip.jw-skippable:hover .jw-text,.jw-skin-hdo .jw-skip.jw-skippable:hover .jw-icon-inline{color:#d83f16}.jw-skin-hdo.jw-flag-touch .jw-controlbar .jw-icon:before,.jw-skin-hdo.jw-flag-touch .jw-text-elapsed,.jw-skin-hdo.jw-flag-touch .jw-text-duration{padding:0 .35em}.jw-skin-hdo.jw-flag-touch .jw-controlbar .jw-icon-prev:before{padding:0 .125em 0 .7em}.jw-skin-hdo.jw-flag-touch .jw-controlbar .jw-icon-next:before{padding:0 .7em 0 .125em}.jw-skin-hdo.jw-flag-touch .jw-controlbar .jw-icon-playlist:before{padding:0 .225em}.jw-skin-hdo.jw-flag-fullscreen .jw-icon-prev,.jw-skin-hdo.jw-flag-fullscreen .jw-icon-next{font-size:1em}.jw-skin-hdo.jw-flag-fullscreen .jw-controlbar .jw-icon{font-size:1.5em}.jw-skin-hdo.jw-flag-fullscreen .jw-text-elapsed,.jw-skin-hdo.jw-flag-fullscreen .jw-text-duration{font-size:1.3em}.jw-skin-hdo.jw-flag-fullscreen .jw-controlbar{height:3.3em}.jw-skin-hdo .jw-setting-container{width:400px}.jw-skin-hdo .jw-setting-container .jw-setting-row-break{display:block}.jw-skin-hdo .jw-setting-container .jw-setting-row-break .row-beak-title{border-bottom:1px solid rgba(255,255,255,0.27);padding-bottom:10px;font-size:.7em;color:#fff;padding-left:10px;text-transform:uppercase;padding-top:5px}.jw-skin-hdo .jw-setting-container .jw-setting-row{padding:5px 10px}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-label{font-size:.6em;color:#fff;display:inline-block;width:21%}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value{display:inline-block}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-select{padding:2px 7px;font-size:.6em;display:inline-block;background:rgba(0,0,0,0.54);text-decoration:none;color:#fff;border:1px solid rgba(255,255,255,0.27);-webkit-transition:background-color .3s linear;transition:background-color .3s linear}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-select:hover,.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-select.active{background-color:#d83f16}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-color{border:1px solid #fff;padding:0 10px;margin-right:7px;position:relative}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-color.active:before{content:"\\2714";color:#333;position:absolute;left:2px}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-value .button-color:hover{border:1px solid #d83f16}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-font-select{padding:3px;margin:0;border-radius:4px;background:rgba(51,51,51,0.8);color:#fff;border:none;outline:none;display:inline-block;-webkit-appearance:none;-moz-appearance:none;appearance:none;cursor:pointer;font-size:13px}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-font-label{position:relative}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-font-label:after{content:\'\';right:0;top:5px;width:20px;height:20px;background:rgba(51,51,51,0.34);position:absolute;pointer-events:none;display:block}.jw-skin-hdo .jw-setting-container .jw-setting-row .jw-setting-font-label:before{content:\'<>\';font:11px "Consolas",monospace;color:#aaa;-webkit-transform:rotate(90deg);transform:rotate(90deg);right:1px;top:6px;padding:0 0 2px;border-bottom:1px solid #333;position:absolute;pointer-events:none}.jw-skin-hdo .caption-delay,.jw-skin-hdo .caption-size{width:50px;background-color:#fff;background-image:none;border:1px solid #ccc;height:25px;color:#000;font-size:15px}.jw-skin-hdo .jw-rightclick .jw-featured{background-color:rgba(37,37,37,0.72);vertical-align:middle}.jw-skin-hdo .jw-rightclick .jw-featured:hover{background-color:#252525;vertical-align:middle}.jw-skin-hdo .jw-rightclick .jw-featured a{color:#fff;font-weight:normal}.jw-logo.jw-reset.jw-logo-top-right {width: 100px !important}.jw-skin-hdo .jw-preview{background-size:cover}.jw-skin-hdo .jw-slider-volume.jw-slider-horizontal,.jw-skin-hdo .jw-icon-inline.jw-icon-volume{display:inline-block}.jw-skin-hdo .jw-icon-tooltip.jw-icon-volume{display:none}', ""])
        },
        function(b, a) {
            b.exports = function() {
                var c = [];
                c.toString = function d() {
                    var e = [];
                    for (var f = 0; f < this.length; f++) {
                        var g = this[f];
                        if (g[2]) {
                            e.push("@media " + g[2] + "{" + g[1] + "}")
                        } else {
                            e.push(g[1])
                        }
                    }
                    return e.join("")
                };
                c.i = function(e, h) {
                    if (typeof e === "string") {
                        e = [
                            [null, e, ""]
                        ]
                    }
                    var k = {};
                    for (var f = 0; f < this.length; f++) {
                        var j = this[f][0];
                        if (typeof j === "number") {
                            k[j] = true
                        }
                    }
                    for (f = 0; f < e.length; f++) {
                        var g = e[f];
                        if (typeof g[0] !== "number" || !k[g[0]]) {
                            if (h && !g[2]) {
                                g[2] = h
                            } else {
                                if (h) {
                                    g[2] = "(" + g[2] + ") and (" + h + ")"
                                }
                            }
                            c.push(g)
                        }
                    }
                };
                return c
            }
        },
        function(b, a, c) {
            b.exports = c.p + "jw-icons.woff"
        },
        function(b, a, c) {
            b.exports = c.p + "jw-icons.ttf"
        },
        function(b, r) {
            var d = {},
                a = function(t) {
                    var s;
                    return function() {
                        if (typeof s === "undefined") {
                            s = t.apply(this, arguments)
                        }
                        return s
                    }
                },
                i = a(function() {
                    return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())
                }),
                e = a(function() {
                    return document.head || document.getElementsByTagName("head")[0]
                }),
                g = null,
                o = 0,
                n = [];
            b.exports = function(u, s) {
                s = s || {};
                if (typeof s.singleton === "undefined") {
                    s.singleton = i()
                }
                if (typeof s.insertAt === "undefined") {
                    s.insertAt = "bottom"
                }
                var t = p(u);
                j(t, s);
                return function v(z) {
                    var C = [];
                    var y;
                    for (var x = 0; x < t.length; x++) {
                        var A = t[x];
                        y = d[A.id];
                        y.refs--;
                        C.push(y)
                    }
                    if (z) {
                        var B = p(z);
                        j(B, s)
                    }
                    for (x = 0; x < C.length; x++) {
                        y = C[x];
                        if (y.refs === 0) {
                            for (var w = 0; w < y.parts.length; w++) {
                                y.parts[w]()
                            }
                            delete d[y.id]
                        }
                    }
                }
            };

            function j(x, t) {
                for (var v = 0; v < x.length; v++) {
                    var w = x[v];
                    var u = d[w.id];
                    var s;
                    if (u) {
                        u.refs++;
                        for (s = 0; s < u.parts.length; s++) {
                            u.parts[s](w.parts[s])
                        }
                        for (; s < w.parts.length; s++) {
                            u.parts.push(q(w.parts[s], t))
                        }
                    } else {
                        var y = [];
                        for (s = 0; s < w.parts.length; s++) {
                            y.push(q(w.parts[s], t))
                        }
                        d[w.id] = {
                            id: w.id,
                            refs: 1,
                            parts: y
                        }
                    }
                }
            }

            function p(y) {
                var z = [];
                var s = {};
                for (var w = 0; w < y.length; w++) {
                    var A = y[w];
                    var t = A[0];
                    var x = A[1];
                    var v = A[2];
                    var u = {
                        css: x,
                        media: v
                    };
                    if (!s[t]) {
                        z.push(s[t] = {
                            id: t,
                            parts: [u]
                        })
                    } else {
                        s[t].parts.push(u)
                    }
                }
                return z
            }

            function c(t, s) {
                var u = e();
                var v = n[n.length - 1];
                if (t.insertAt === "top") {
                    if (!v) {
                        u.insertBefore(s, u.firstChild)
                    } else {
                        if (v.nextSibling) {
                            u.insertBefore(s, v.nextSibling)
                        } else {
                            u.appendChild(s)
                        }
                    }
                    n.push(s)
                } else {
                    if (t.insertAt === "bottom") {
                        u.appendChild(s)
                    } else {
                        throw new Error("Invalid value for parameter insertAt. Must be top or bottom.")
                    }
                }
            }

            function f(t) {
                t.parentNode.removeChild(t);
                var s = n.indexOf(t);
                if (s >= 0) {
                    n.splice(s, 1)
                }
            }

            function m(t) {
                var s = document.createElement("style");
                s.type = "text/css";
                c(t, s);
                return s
            }

            function q(v, u) {
                var t, y, s;
                if (u.singleton) {
                    var w = o++;
                    t = g || (g = m(u));
                    y = l.bind(null, t, w, false);
                    s = l.bind(null, t, w, true)
                } else {
                    t = m(u);
                    y = k.bind(null, t);
                    s = function() {
                        f(t)
                    }
                }
                y(v);
                return function x(z) {
                    if (z) {
                        if (z.css === v.css && z.media === v.media) {
                            return
                        }
                        y(v = z)
                    } else {
                        s()
                    }
                }
            }
            var h = (function() {
                var s = [];
                return function(t, u) {
                    s[t] = u;
                    return s.filter(Boolean).join("\n")
                }
            })();

            function l(t, v, s, x) {
                var w = s ? "" : x.css;
                if (t.styleSheet) {
                    t.styleSheet.cssText = h(v, w)
                } else {
                    var u = document.createTextNode(w);
                    var y = t.childNodes;
                    if (y[v]) {
                        t.removeChild(y[v])
                    }
                    if (y.length) {
                        t.insertBefore(u, y[v])
                    } else {
                        t.appendChild(u)
                    }
                }
            }

            function k(s, v) {
                var t = v.css;
                var u = v.media;
                if (u) {
                    s.setAttribute("media", u)
                }
                if (s.styleSheet) {
                    s.styleSheet.cssText = t
                } else {
                    while (s.firstChild) {
                        s.removeChild(s.firstChild)
                    }
                    s.appendChild(document.createTextNode(t))
                }
            }
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(162)], e = function(g) {
                function f(k, i, j, h) {
                    return g({
                        id: k,
                        skin: i,
                        title: j,
                        body: h
                    })
                }
                return f
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var e = d(109);

            function a(f) {
                return f && (f.__esModule ? f["default"] : f)
            }
            c.exports = (e["default"] || e).template({
                compiler: [7, ">= 4.0.0"],
                main: function(f, k, g, j, i) {
                    var h, o = k != null ? k : {},
                        n = g.helperMissing,
                        m = "function",
                        l = f.escapeExpression;
                    return '<div id="' + l(((h = (h = g.id || (k != null ? k.id : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "id",
                        hash: {},
                        data: i
                    }) : h))) + '"class="jw-skin-' + l(((h = (h = g.skin || (k != null ? k.skin : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "skin",
                        hash: {},
                        data: i
                    }) : h))) + ' jw-error jw-reset">\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset">' + l(((h = (h = g.title || (k != null ? k.title : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "title",
                        hash: {},
                        data: i
                    }) : h))) + '</div>\n        <div class="jw-title-secondary jw-reset">' + l(((h = (h = g.body || (k != null ? k.body : k)) != null ? h : n), (typeof h === m ? h.call(o, {
                        name: "body",
                        hash: {},
                        data: i
                    }) : h))) + '</div>\n    </div>\n\n    <div class="jw-icon-container jw-reset">\n        <div class="jw-display-icon-container jw-background-color jw-reset">\n            <div class="jw-icon jw-icon-display jw-reset"></div>\n        </div>\n    </div>\n</div>\n'
                },
                useData: true
            })
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(93), d(43), ], e = function(f, g) {
                return function(h, j) {
                    var i = ["seek", "skipAd", "stop", "playlistNext", "playlistPrev", "playlistItem", "playlistItemChange", "resize", "addButton", "removeButton", "registerPlugin", "attachMedia"];
                    g.each(i, function(k) {
                        h[k] = function() {
                            j[k].apply(j, arguments);
                            return h
                        }
                    });
                    h.registerPlugin = f.registerPlugin
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), ], e = function(f) {
                return function(h, j) {
                    var g = ["buffer", "controls", "position", "duration", "fullscreen", "volume", "mute", "item", "stretching", "playlist"];
                    f.each(g, function(l) {
                        var m = l.slice(0, 1).toUpperCase() + l.slice(1);
                        h["get" + m] = function() {
                            return j._model.get(l)
                        }
                    });
                    var i = ["getAudioTracks", "getCaptionsList", "getWidth", "getHeight", "getCurrentAudioTrack", "setCurrentAudioTrack", "getCurrentCaptions", "setCurrentCaptions", "getCurrentQuality", "setCurrentQuality", "getQualityLevels", "getVisualQuality", "getConfig", "getState", "getSafeRegion", "isBeforeComplete", "isBeforePlay", "getProvider", "detachMedia"];
                    var k = ["setControls", "setFullscreen", "setVolume", "setMute", "setCues"];
                    f.each(i, function(l) {
                        h[l] = function() {
                            if (j[l]) {
                                return j[l].apply(j, arguments)
                            }
                            return null
                        }
                    });
                    f.each(k, function(l) {
                        h[l] = function() {
                            j[l].apply(j, arguments);
                            return h
                        }
                    });
                    h.getPlaylistIndex = h.getItem
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        },
        function(c, b, d) {
            var a, e;
            !(a = [d(43), d(44)], e = function(f, g) {
                return function h(j) {
                    var i = {
                        onBufferChange: g.JWPLAYER_MEDIA_BUFFER,
                        onBufferFull: g.JWPLAYER_MEDIA_BUFFER_FULL,
                        onError: g.JWPLAYER_ERROR,
                        onSetupError: g.JWPLAYER_SETUP_ERROR,
                        onFullscreen: g.JWPLAYER_FULLSCREEN,
                        onMeta: g.JWPLAYER_MEDIA_META,
                        onMute: g.JWPLAYER_MEDIA_MUTE,
                        onPlaylist: g.JWPLAYER_PLAYLIST_LOADED,
                        onPlaylistItem: g.JWPLAYER_PLAYLIST_ITEM,
                        onPlaylistComplete: g.JWPLAYER_PLAYLIST_COMPLETE,
                        onReady: g.JWPLAYER_READY,
                        onResize: g.JWPLAYER_RESIZE,
                        onComplete: g.JWPLAYER_MEDIA_COMPLETE,
                        onSeek: g.JWPLAYER_MEDIA_SEEK,
                        onTime: g.JWPLAYER_MEDIA_TIME,
                        onVolume: g.JWPLAYER_MEDIA_VOLUME,
                        onBeforePlay: g.JWPLAYER_MEDIA_BEFOREPLAY,
                        onBeforeComplete: g.JWPLAYER_MEDIA_BEFORECOMPLETE,
                        onDisplayClick: g.JWPLAYER_DISPLAY_CLICK,
                        onControls: g.JWPLAYER_CONTROLS,
                        onQualityLevels: g.JWPLAYER_MEDIA_LEVELS,
                        onQualityChange: g.JWPLAYER_MEDIA_LEVEL_CHANGED,
                        onCaptionsList: g.JWPLAYER_CAPTIONS_LIST,
                        onCaptionsChange: g.JWPLAYER_CAPTIONS_CHANGED,
                        onAdError: g.JWPLAYER_AD_ERROR,
                        onAdClick: g.JWPLAYER_AD_CLICK,
                        onAdImpression: g.JWPLAYER_AD_IMPRESSION,
                        onAdTime: g.JWPLAYER_AD_TIME,
                        onAdComplete: g.JWPLAYER_AD_COMPLETE,
                        onAdCompanions: g.JWPLAYER_AD_COMPANIONS,
                        onAdSkipped: g.JWPLAYER_AD_SKIPPED,
                        onAdPlay: g.JWPLAYER_AD_PLAY,
                        onAdPause: g.JWPLAYER_AD_PAUSE,
                        onAdMeta: g.JWPLAYER_AD_META,
                        onCast: g.JWPLAYER_CAST_SESSION,
                        onAudioTrackChange: g.JWPLAYER_AUDIO_TRACK_CHANGED,
                        onAudioTracks: g.JWPLAYER_AUDIO_TRACKS
                    };
                    var k = {
                        onBuffer: "buffer",
                        onPause: "pause",
                        onPlay: "play",
                        onIdle: "idle"
                    };
                    f.each(k, function(m, l) {
                        j[l] = f.partial(j.on, m, f)
                    });
                    f.each(i, function(m, l) {
                        j[l] = f.partial(j.on, m, f)
                    })
                }
            }.apply(b, a), e !== undefined && (c.exports = e))
        }
    ])
});
