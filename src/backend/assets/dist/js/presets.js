/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/dist/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	var _vue = __webpack_require__(2);

	var _vue2 = _interopRequireDefault(_vue);

	var _PresetEditForm = __webpack_require__(3);

	var _PresetEditForm2 = _interopRequireDefault(_PresetEditForm);

	var _presets = __webpack_require__(9);

	var _presets2 = _interopRequireDefault(_presets);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	_vue2.default.component('PresetEditForm', _PresetEditForm2.default);

	window.App.$store.registerModule('presets', _presets2.default);

	new _vue2.default({
	    store: window.App.$store
	}).$mount('#presets');

/***/ }),
/* 2 */
/***/ (function(module, exports) {

	module.exports = Vue;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* script */
	__vue_exports__ = __webpack_require__(4)

	/* template */
	var __vue_template__ = __webpack_require__(8)
	__vue_options__ = __vue_exports__ = __vue_exports__ || {}
	if (
	  typeof __vue_exports__.default === "object" ||
	  typeof __vue_exports__.default === "function"
	) {
	if (Object.keys(__vue_exports__).some(function (key) { return key !== "default" && key !== "__esModule" })) {console.error("named exports are not supported in *.vue files.")}
	__vue_options__ = __vue_exports__ = __vue_exports__.default
	}
	if (typeof __vue_options__ === "function") {
	  __vue_options__ = __vue_options__.options
	}
	__vue_options__.__file = "/home/dn/www/reform-city.docker/app/modules/files/backend/assets/src/components/PresetEditForm.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-13df7a6c", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-13df7a6c", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] PresetEditForm.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _PresetForm = __webpack_require__(5);

	var _PresetForm2 = _interopRequireDefault(_PresetForm);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	exports.default = {

	    components: {
	        PresetForm: _PresetForm2.default
	    },

	    props: ['id'],

	    created: function created() {
	        this.$store.dispatch('presets/find', this.id);
	    },


	    computed: {
	        isDev: function isDev() {
	            return this.$store.getters['isDev'];
	        },
	        isLoading: function isLoading() {
	            return this.$store.getters['isLoading'];
	        },
	        hasError: function hasError() {
	            return this.$store.getters['hasError'];
	        },
	        model: function model() {
	            return this.$store.getters['presets/model'];
	        }
	    },

	    methods: {
	        save: function save(event) {
	            var _this = this;

	            event.preventDefault();

	            var isNewRecord = this.model.id === null;

	            this.$store.dispatch('presets/save', this.model).then(function () {
	                if (_this.hasError) {
	                    return false;
	                }

	                _this.$notify({ type: 'success', text: 'Пресет сохранен' });

	                if (isNewRecord) {
	                    window.location.href = '/files/preset/update?id=' + _this.model.id;
	                }
	            });
	        }
	    }

	}; //
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

	var __vue_exports__, __vue_options__
	var __vue_styles__ = {}

	/* script */
	__vue_exports__ = __webpack_require__(6)

	/* template */
	var __vue_template__ = __webpack_require__(7)
	__vue_options__ = __vue_exports__ = __vue_exports__ || {}
	if (
	  typeof __vue_exports__.default === "object" ||
	  typeof __vue_exports__.default === "function"
	) {
	if (Object.keys(__vue_exports__).some(function (key) { return key !== "default" && key !== "__esModule" })) {console.error("named exports are not supported in *.vue files.")}
	__vue_options__ = __vue_exports__ = __vue_exports__.default
	}
	if (typeof __vue_options__ === "function") {
	  __vue_options__ = __vue_options__.options
	}
	__vue_options__.__file = "/home/dn/www/reform-city.docker/app/modules/files/backend/assets/src/components/PresetForm.vue"
	__vue_options__.render = __vue_template__.render
	__vue_options__.staticRenderFns = __vue_template__.staticRenderFns

	/* hot reload */
	if (false) {(function () {
	  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
	  hotAPI.install(require("vue"), false)
	  if (!hotAPI.compatible) return
	  module.hot.accept()
	  if (!module.hot.data) {
	    hotAPI.createRecord("data-v-7bbc957c", __vue_options__)
	  } else {
	    hotAPI.reload("data-v-7bbc957c", __vue_options__)
	  }
	})()}
	if (__vue_options__.functional) {console.error("[vue-loader] PresetForm.vue: functional components are not supported and should be defined in plain js files using render functions.")}

	module.exports = __vue_exports__


/***/ }),
/* 6 */
/***/ (function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//


	exports.default = {

	    props: ['model'],

	    computed: {
	        settings: function settings() {
	            return this.$store.getters['settings'];
	        },
	        actions: function actions() {
	            return _.isEmpty(this.settings) ? {} : this.settings.presets.actions;
	        }
	    }

	};

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('b-card', {
	    staticClass: "mb-4",
	    attrs: {
	      "header": "Общая информация",
	      "header-class": "text-white bg-secondary",
	      "no-body": ""
	    }
	  }, [_c('b-card-body', [_c('b-form-group', {
	    attrs: {
	      "label": "Название",
	      "label-for": "title",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "title",
	      "type": "text",
	      "required": "",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.title),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "title", $$v)
	      },
	      expression: "model.title"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Системное название",
	      "label-for": "name",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "name",
	      "type": "text",
	      "required": "",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.name),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "name", $$v)
	      },
	      expression: "model.name"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Ширина",
	      "label-for": "width",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "width",
	      "type": "number",
	      "min": "1",
	      "max": "1900",
	      "required": "",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.width),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "width", $$v)
	      },
	      expression: "model.width"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Высота",
	      "label-for": "height",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "height",
	      "type": "number",
	      "min": "1",
	      "max": "1200",
	      "required": "",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.height),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "height", $$v)
	      },
	      expression: "model.height"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Качество",
	      "label-for": "quality",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "quantity",
	      "type": "number",
	      "min": "1",
	      "max": "100",
	      "required": "",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.quality),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "quality", $$v)
	      },
	      expression: "model.quality"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Экшен",
	      "label-for": "action",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-select', {
	    staticClass: "col-3",
	    attrs: {
	      "id": "action",
	      "options": _vm.actions
	    },
	    model: {
	      value: (_vm.model.action),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "action", $$v)
	      },
	      expression: "model.action"
	    }
	  })], 1), _vm._v(" "), _c('b-form-group', {
	    attrs: {
	      "label": "Копирайт",
	      "label-for": "watermark",
	      "label-cols-sm": "2"
	    }
	  }, [_c('b-form-input', {
	    attrs: {
	      "id": "watermark",
	      "type": "text",
	      "trim": ""
	    },
	    model: {
	      value: (_vm.model.watermark),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "watermark", $$v)
	      },
	      expression: "model.watermark"
	    }
	  })], 1), _vm._v(" "), _c('b-form-checkbox', {
	    attrs: {
	      "id": "isDefault",
	      "name": "isDefault",
	      "value": 1,
	      "unchecked-value": 0
	    },
	    model: {
	      value: (_vm.model.isDefault),
	      callback: function($$v) {
	        _vm.$set(_vm.model, "isDefault", $$v)
	      },
	      expression: "model.isDefault"
	    }
	  }, [_vm._v("\n            Использовать по умолчанию\n        ")])], 1)], 1)
	},staticRenderFns: []}
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-7bbc957c", module.exports)
	  }
	}

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
	  return _c('div', [(_vm.model) ? _c('b-form', {
	    on: {
	      "submit": _vm.save
	    }
	  }, [_c('preset-form', {
	    attrs: {
	      "model": _vm.model
	    }
	  }), _vm._v(" "), _c('b-button', {
	    attrs: {
	      "type": "submit",
	      "variant": "primary",
	      "disabled": _vm.isLoading
	    }
	  }, [_vm._v("Сохранить")]), _vm._v(" "), (_vm.isDev) ? _c('pre', [_vm._v("model: " + _vm._s(_vm.model))]) : _vm._e()], 1) : _vm._e()], 1)
	},staticRenderFns: []}
	if (false) {
	  module.hot.accept()
	  if (module.hot.data) {
	     require("vue-loader/node_modules/vue-hot-reload-api").rerender("data-v-13df7a6c", module.exports)
	  }
	}

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});

	var _defineProperty2 = __webpack_require__(10);

	var _defineProperty3 = _interopRequireDefault(_defineProperty2);

	var _mutations;

	var _vue = __webpack_require__(2);

	var _vue2 = _interopRequireDefault(_vue);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	exports.default = {
	    namespaced: true,

	    state: {
	        actions: [],
	        model: {}
	    },

	    getters: {
	        actions: function actions(state) {
	            return state.actions;
	        },
	        model: function model(state) {
	            return state.model;
	        }
	    },

	    mutations: (_mutations = {}, (0, _defineProperty3.default)(_mutations, 'FETCH_ACTIONS_SUCCESS', function FETCH_ACTIONS_SUCCESS(state, actions) {
	        state.actions = actions;
	    }), (0, _defineProperty3.default)(_mutations, 'FETCH_MODEL_SUCCESS', function FETCH_MODEL_SUCCESS(state, model) {
	        state.model = model;
	    }), _mutations),

	    actions: {
	        actions: function actions(_ref, id) {
	            var state = _ref.state,
	                commit = _ref.commit,
	                rootState = _ref.rootState;

	            return _vue2.default.axios.get('/files/api/v1/preset/actions').then(function (response) {
	                return commit('FETCH_ACTIONS_SUCCESS', response.data);
	            }, function (error) {});
	        },
	        find: function find(_ref2, id) {
	            var state = _ref2.state,
	                commit = _ref2.commit,
	                rootState = _ref2.rootState;

	            return _vue2.default.axios.get('/files/api/v1/preset/find', { params: { id: id } }).then(function (response) {
	                return commit('FETCH_MODEL_SUCCESS', response.data);
	            }, function (error) {});
	        },
	        save: function save(_ref3, model) {
	            var state = _ref3.state,
	                commit = _ref3.commit,
	                rootState = _ref3.rootState;

	            return _vue2.default.axios.post('/files/api/v1/preset/save', model).then(function (response) {
	                return commit('FETCH_MODEL_SUCCESS', response.data);
	            }, function (error) {});
	        }
	    }
	};

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

	"use strict";

	exports.__esModule = true;

	var _defineProperty = __webpack_require__(11);

	var _defineProperty2 = _interopRequireDefault(_defineProperty);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	exports.default = function (obj, key, value) {
	  if (key in obj) {
	    (0, _defineProperty2.default)(obj, key, {
	      value: value,
	      enumerable: true,
	      configurable: true,
	      writable: true
	    });
	  } else {
	    obj[key] = value;
	  }

	  return obj;
	};

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(12), __esModule: true };

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

	__webpack_require__(13);
	var $Object = __webpack_require__(16).Object;
	module.exports = function defineProperty(it, key, desc) {
	  return $Object.defineProperty(it, key, desc);
	};


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

	var $export = __webpack_require__(14);
	// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
	$export($export.S + $export.F * !__webpack_require__(24), 'Object', { defineProperty: __webpack_require__(20).f });


/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

	var global = __webpack_require__(15);
	var core = __webpack_require__(16);
	var ctx = __webpack_require__(17);
	var hide = __webpack_require__(19);
	var has = __webpack_require__(29);
	var PROTOTYPE = 'prototype';

	var $export = function (type, name, source) {
	  var IS_FORCED = type & $export.F;
	  var IS_GLOBAL = type & $export.G;
	  var IS_STATIC = type & $export.S;
	  var IS_PROTO = type & $export.P;
	  var IS_BIND = type & $export.B;
	  var IS_WRAP = type & $export.W;
	  var exports = IS_GLOBAL ? core : core[name] || (core[name] = {});
	  var expProto = exports[PROTOTYPE];
	  var target = IS_GLOBAL ? global : IS_STATIC ? global[name] : (global[name] || {})[PROTOTYPE];
	  var key, own, out;
	  if (IS_GLOBAL) source = name;
	  for (key in source) {
	    // contains in native
	    own = !IS_FORCED && target && target[key] !== undefined;
	    if (own && has(exports, key)) continue;
	    // export native or passed
	    out = own ? target[key] : source[key];
	    // prevent global pollution for namespaces
	    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
	    // bind timers to global for call from export context
	    : IS_BIND && own ? ctx(out, global)
	    // wrap global constructors for prevent change them in library
	    : IS_WRAP && target[key] == out ? (function (C) {
	      var F = function (a, b, c) {
	        if (this instanceof C) {
	          switch (arguments.length) {
	            case 0: return new C();
	            case 1: return new C(a);
	            case 2: return new C(a, b);
	          } return new C(a, b, c);
	        } return C.apply(this, arguments);
	      };
	      F[PROTOTYPE] = C[PROTOTYPE];
	      return F;
	    // make static versions for prototype methods
	    })(out) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
	    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
	    if (IS_PROTO) {
	      (exports.virtual || (exports.virtual = {}))[key] = out;
	      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
	      if (type & $export.R && expProto && !expProto[key]) hide(expProto, key, out);
	    }
	  }
	};
	// type bitmap
	$export.F = 1;   // forced
	$export.G = 2;   // global
	$export.S = 4;   // static
	$export.P = 8;   // proto
	$export.B = 16;  // bind
	$export.W = 32;  // wrap
	$export.U = 64;  // safe
	$export.R = 128; // real proto method for `library`
	module.exports = $export;


/***/ }),
/* 15 */
/***/ (function(module, exports) {

	// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
	var global = module.exports = typeof window != 'undefined' && window.Math == Math
	  ? window : typeof self != 'undefined' && self.Math == Math ? self
	  // eslint-disable-next-line no-new-func
	  : Function('return this')();
	if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef


/***/ }),
/* 16 */
/***/ (function(module, exports) {

	var core = module.exports = { version: '2.6.5' };
	if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef


/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

	// optional / simple context binding
	var aFunction = __webpack_require__(18);
	module.exports = function (fn, that, length) {
	  aFunction(fn);
	  if (that === undefined) return fn;
	  switch (length) {
	    case 1: return function (a) {
	      return fn.call(that, a);
	    };
	    case 2: return function (a, b) {
	      return fn.call(that, a, b);
	    };
	    case 3: return function (a, b, c) {
	      return fn.call(that, a, b, c);
	    };
	  }
	  return function (/* ...args */) {
	    return fn.apply(that, arguments);
	  };
	};


/***/ }),
/* 18 */
/***/ (function(module, exports) {

	module.exports = function (it) {
	  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
	  return it;
	};


/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

	var dP = __webpack_require__(20);
	var createDesc = __webpack_require__(28);
	module.exports = __webpack_require__(24) ? function (object, key, value) {
	  return dP.f(object, key, createDesc(1, value));
	} : function (object, key, value) {
	  object[key] = value;
	  return object;
	};


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

	var anObject = __webpack_require__(21);
	var IE8_DOM_DEFINE = __webpack_require__(23);
	var toPrimitive = __webpack_require__(27);
	var dP = Object.defineProperty;

	exports.f = __webpack_require__(24) ? Object.defineProperty : function defineProperty(O, P, Attributes) {
	  anObject(O);
	  P = toPrimitive(P, true);
	  anObject(Attributes);
	  if (IE8_DOM_DEFINE) try {
	    return dP(O, P, Attributes);
	  } catch (e) { /* empty */ }
	  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
	  if ('value' in Attributes) O[P] = Attributes.value;
	  return O;
	};


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

	var isObject = __webpack_require__(22);
	module.exports = function (it) {
	  if (!isObject(it)) throw TypeError(it + ' is not an object!');
	  return it;
	};


/***/ }),
/* 22 */
/***/ (function(module, exports) {

	module.exports = function (it) {
	  return typeof it === 'object' ? it !== null : typeof it === 'function';
	};


/***/ }),
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = !__webpack_require__(24) && !__webpack_require__(25)(function () {
	  return Object.defineProperty(__webpack_require__(26)('div'), 'a', { get: function () { return 7; } }).a != 7;
	});


/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

	// Thank's IE8 for his funny defineProperty
	module.exports = !__webpack_require__(25)(function () {
	  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
	});


/***/ }),
/* 25 */
/***/ (function(module, exports) {

	module.exports = function (exec) {
	  try {
	    return !!exec();
	  } catch (e) {
	    return true;
	  }
	};


/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

	var isObject = __webpack_require__(22);
	var document = __webpack_require__(15).document;
	// typeof document.createElement is 'object' in old IE
	var is = isObject(document) && isObject(document.createElement);
	module.exports = function (it) {
	  return is ? document.createElement(it) : {};
	};


/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

	// 7.1.1 ToPrimitive(input [, PreferredType])
	var isObject = __webpack_require__(22);
	// instead of the ES6 spec version, we didn't implement @@toPrimitive case
	// and the second argument - flag - preferred type is a string
	module.exports = function (it, S) {
	  if (!isObject(it)) return it;
	  var fn, val;
	  if (S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
	  if (typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it))) return val;
	  if (!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
	  throw TypeError("Can't convert object to primitive value");
	};


/***/ }),
/* 28 */
/***/ (function(module, exports) {

	module.exports = function (bitmap, value) {
	  return {
	    enumerable: !(bitmap & 1),
	    configurable: !(bitmap & 2),
	    writable: !(bitmap & 4),
	    value: value
	  };
	};


/***/ }),
/* 29 */
/***/ (function(module, exports) {

	var hasOwnProperty = {}.hasOwnProperty;
	module.exports = function (it, key) {
	  return hasOwnProperty.call(it, key);
	};


/***/ })
/******/ ]);