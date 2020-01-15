var vtLaiBookmark = {
    "checkAvail": function() {
        return (typeof Object['keys'] != 'undefined' && typeof fx != 'undefined' && typeof fx['localStorage'] != 'undefined' && fx['localStorage']['check']())
    },
    "_getCurrentList": function() {
        var _0x8d49x2 = fx['localStorage']['get']('bookmark-list');
        if (!_0x8d49x2) {
            return {}
        };
        try {
            currentList = jQuery['parseJSON'](_0x8d49x2);
            if (typeof currentList != 'object' || Object['keys'](currentList)['length'] == 0) {
                return {}
            };
            return currentList;
        } catch (err) {
            return {}
        };
    },
    "_setCurrentList": function(_0x8d49x3) {
        var _0x8d49x2 = JSON['stringify'](_0x8d49x3);
        try {
            fx['localStorage']['set']('bookmark-list', _0x8d49x2);
            fx['localStorage']['set']('bookmark-count', Object['keys'](_0x8d49x3)['length'].toString());
            return true;
        } catch (err) {
            return false
        };
    },
    "_getIdList": function(_0x8d49x3) {
        var _0x8d49x3 = this._getCurrentList();
        var _0x8d49x4 = [];
        for (id in _0x8d49x3) {
            _0x8d49x4['push'](id)
        };
        return _0x8d49x4;
    },
    "_validId": function(_0x8d49x5) {
        if (typeof _0x8d49x5 == 'undefined') {
            return false
        };
        _0x8d49x5 = parseInt(_0x8d49x5);
        if (!_0x8d49x5) {
            return false
        };
        return _0x8d49x5;
    },
    "isInBookmark": function(_0x8d49x5) {
        var _0x8d49x5 = this._validId(_0x8d49x5);
        if (!_0x8d49x5) {
            return false
        };
        var _0x8d49x6 = _0x8d49x5.toString();
        var _0x8d49x3 = this._getCurrentList();
        return (typeof _0x8d49x3[_0x8d49x6] != 'undefined');
    },
    "add": function(_0x8d49x5) {
        var _0x8d49x5 = this._validId(_0x8d49x5);
        if (!_0x8d49x5) {
            return false
        };
        var _0x8d49x6 = _0x8d49x5.toString();
        var _0x8d49x7 = Math['floor']((new Date())['getTime']() / 1000);
        var _0x8d49x3 = this._getCurrentList();
        _0x8d49x3[_0x8d49x6] = {
            "addTime": _0x8d49x7
        };
        this._setCurrentList(_0x8d49x3);
        return true;
    },
    "remove": function(_0x8d49x5) {
        var _0x8d49x5 = this._validId(_0x8d49x5);
        if (!_0x8d49x5) {
            return false
        };
        var _0x8d49x6 = _0x8d49x5.toString();
        var _0x8d49x3 = this._getCurrentList();
        if (Object['keys'](_0x8d49x3)['length'] == 0) {
            return true
        };
        if (typeof _0x8d49x3[_0x8d49x6] != 'undefined') {
            delete _0x8d49x3[_0x8d49x6]
        };
        this._setCurrentList(_0x8d49x3);
        return true;
    },
    "count": function() {
        var _0x8d49x8 = fx['localStorage']['get']('bookmark-count');
        if (!_0x8d49x8) {
            return 0
        };
        return parseInt(_0x8d49x8);
    },
    "load": function(_0x8d49x9, _0x8d49xa) {
        var _0x8d49x4 = this._getIdList();
        var _0x8d49xb = _0x8d49x4['join'](',');
        jQuery['ajax']({
            "url": base_url+'ajax/danhdau/',
            "type": 'POST',
            "dataType": 'JSON',
            "silentLoad": true,
            "data": {
                "ids": _0x8d49xb,
                "do": 'load_bookmark',
            }
        })['done'](function(_0x8d49xc) {
            _0x8d49x9(_0x8d49xc.html);
        })['always'](function() {
            if (typeof _0x8d49xa == 'function') {
                _0x8d49xa()
            }
        });
    }
};
var updateBookmarkCount = function() {};
var bookmarkExpanded = false;
jQuery(document)['ready'](function() {
    if (vtLaiBookmark['checkAvail']()) {
        jQuery('#bookmark-btn-load')['click'](function() {
            jQuery('#bookmark-btn-load .status-icon')['removeClass']('normal');
            jQuery('#bookmark-btn-load .status-icon')['addClass']('loading');
            vtLaiBookmark['load'](function(_0x8d49xf) {
                jQuery('#bookmark-list-box')['html'](_0x8d49xf);
                jQuery('#bookmark-btn-load')['slideUp']('fast');
                jQuery('#bookmark-list-box')['slideDown']('fast');
                bookmarkExpanded = true;
                jQuery('.bookmark-btn-remove')['click'](function() {
                    var _0x8d49x5 = jQuery(this)['attr']('data-filmid');
                    if (typeof _0x8d49x5 == 'string' && _0x8d49x5 != '') {
                        if (confirm('Bạn có chắc chắn muốn bỏ đánh dấu phim này không ?') && vtLaiBookmark['remove'](_0x8d49x5)) {
                            jQuery('#bookmark-item-' + _0x8d49x5)['fadeOut']('fast', function() {
                                jQuery(this)['remove']()
                            })
                        }
                    } else {
                        alert('Kh�ng x�c ..nh ...c Id phim ...c .�nh d.u')
                    };
                });
            }, function() {
                jQuery('#bookmark-btn-load .status-icon')['addClass']('normal');
                jQuery('#bookmark-btn-load .status-icon')['removeClass']('loading');
            });
        });
        updateBookmarkCount = function() {
            var _0x8d49x10 = vtLaiBookmark['count']();
            jQuery('#bookmark-count')['text'](_0x8d49x10);
        };
        updateBookmarkCount();
        jQuery('#bookmark-box')['css']('display', 'block');
        if (jQuery('.tools-box-bookmark')['length'] > 0) {
            jQuery('.tools-box-bookmark')['each'](function() {
                var _0x8d49x5 = jQuery(this)['attr']('data-filmid');
                if (typeof _0x8d49x5 == 'string') {
                    _0x8d49x5 = jQuery['trim'](_0x8d49x5);
                    _0x8d49x5 = parseInt(_0x8d49x5);
                    if (!isNaN(_0x8d49x5) && _0x8d49x5 > 0) {
                        if (vtLaiBookmark['isInBookmark'](_0x8d49x5)) {
                            jQuery(this)['addClass']('added');
                            jQuery(this)['removeClass']('normal');
                            jQuery(this)['attr']('data-added', 'true');
                        } else {
                            jQuery(this)['addClass']('normal');
                            jQuery(this)['removeClass']('added');
                            jQuery(this)['attr']('data-added', 'false');
                        }
                    };
                    jQuery(this)['css']('display', 'block');
                };
            })
        };
        jQuery('.tools-box-bookmark')['click'](function() {
            var _0x8d49x11 = jQuery(this)['attr']('data-added');
            var _0x8d49x5 = jQuery(this)['attr']('data-filmid');
            if (typeof _0x8d49x11 == 'string' && _0x8d49x11 == 'true') {
                _0x8d49x11 = true
            } else {
                _0x8d49x11 = false
            };
            if (_0x8d49x11) {
                if (vtLaiBookmark['remove'](_0x8d49x5)) {
                    jQuery(this)['addClass']('normal');
                    jQuery(this)['removeClass']('added');
                    jQuery(this)['attr']('data-added', 'false');
                }
            } else {
                if (vtLaiBookmark['add'](_0x8d49x5)) {
                    jQuery(this)['addClass']('added');
                    jQuery(this)['removeClass']('normal');
                    jQuery(this)['attr']('data-added', 'true');
                }
            };
            updateBookmarkCount();
        });
    }
});