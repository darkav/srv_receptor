(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Categoria_tabla_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js ***!
  \****************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _controles_pantalla__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../controles/pantalla */ "./resources/js/controles/pantalla.vue");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ["registro", "accion", "menus"],
  components: {
    'pantalla': _controles_pantalla__WEBPACK_IMPORTED_MODULE_0__.default
  },
  mounted: function mounted() {
    var my = this;

    window.cleanInput = function () {
      my.cleanInput();
    };

    window.w_refresh = function () {
      my.refresh();
    };
  },
  data: function data() {
    return {
      titulo: "Tablas x Categoría",
      v_tabla: "",
      v_key: "",
      v_except: "",
      tbcount: 0,
      linkBack: "categoria.index",
      customBotones: [{
        html: "<span class='mif-refresh'></span>",
        cls: "warning",
        onclick: "w_refresh()"
      }, {
        html: "<span class='mif-add'></span>",
        cls: "primary",
        onclick: "cleanInput"
      }]
    };
  },
  computed: {
    getBotones: function getBotones() {
      return JSON.stringify(this.customBotones);
    },
    getRegistro: function getRegistro() {
      console.log("en el registro ok", this.registro);
      return this.registro;
    }
  },
  methods: {
    cleanInput: function cleanInput() {
      this.v_tabla = "";
      this.v_key = "";
    },
    refresh: function refresh() {
      this.$inertia.reload({
        only: ['registro']
      });
      this.$refs.pantalla.setForm(this.registro);
      this.tbcount++;
    },
    addTabla: function addTabla() {
      var _this = this;

      var dtabla = {};
      dtabla.categoria_id = this.$refs.pantalla.form.categoria_id;
      dtabla.tabla = this.v_tabla;
      dtabla.idkey = this.v_key;
      dtabla.excepto = this.v_except;
      console.log("antes de enviar la dtabla", dtabla);
      this.$inertia.post(route("categoriatabla.store"), dtabla, {
        onSuccess: function onSuccess() {
          _this.cleanInput();

          _this.refresh();
        }
      }); // debe de guardar la informacion o refrescar
    },
    delTabla: function delTabla(fila) {
      var _this2 = this;

      if (!confirm("Estas seguro que desea eliminar este registro")) return;
      console.log("eliminando registro", fila);
      this.$inertia["delete"](route("categoriatabla.destroy", fila.id), {
        onSuccess: function onSuccess() {
          _this2.refresh();
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Layouts_AvsisLayout__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Layouts/AvsisLayout */ "./resources/js/Layouts/AvsisLayout.vue");
/* harmony import */ var _Mixes_busqueda__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Mixes/busqueda */ "./resources/js/Mixes/busqueda.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {//AvsisLayout
  },
  mixins: [_Mixes_busqueda__WEBPACK_IMPORTED_MODULE_1__.default],
  props: {
    data: {
      type: Array
    },
    menus: {
      type: Array
    },
    header: {
      type: Array
    },
    linkCreate: {
      type: String
    },
    linkEdit: {
      type: String
    },
    linkDelete: {
      type: String
    },
    linkStore: {
      type: String
    },
    linkUpdate: {
      type: String
    },
    linkBack: {
      type: String
    },
    accion: {
      type: String
    },
    titulo: {
      type: String
    },
    icono: {
      type: String
    },
    registro: {
      type: Object
    },
    linkStoreShow: {
      type: Boolean,
      "default": true
    },
    showBotones: {
      type: Boolean,
      "default": true
    },
    sizeclase: {
      type: String,
      "default": "card w-50"
    }
  },
  mounted: function mounted() {
    console.log("montado otra vez", this.accion);

    if ("N|E".includes(this.accion)) {
      this.form = this.registro;
      console.log("accion pantalla", this.form, this.accion);
    }
  },
  data: function data() {
    return {
      form: {}
    };
  },
  computed: {
    getData: function getData() {
      console.log("data refrescando", this.data);
      return this.data;
    }
  },
  methods: {
    showForm: function showForm() {
      this.$inertia.get(route(this.linkCreate));
    },
    editForm: function editForm(fila) {
      console.log("Edit Form", fila, this.linkEdit);
      this.$inertia.get(route(this.linkEdit, fila.id));
    },
    deleteForm: function deleteForm(fila) {
      if (!confirm("Estas seguro que desea eliminar este registro")) return;
      this.$inertia["delete"](route(this.linkDelete, fila.id));
    },
    submit: function submit() {
      var _this = this;

      console.log("entrando al submit", this.accion);

      switch (this.accion) {
        case 'N':
          var vform = Object.assign({}, this.form);
          this.$inertia.post(route(this.linkStore), vform, {
            onSuccess: function onSuccess() {
              _this.$refs.frmMantenimiento.reset();
            }
          });
          break;

        case 'E':
          var vform = Object.assign({}, this.form);
          console.log("Grabando la informacion de edicion", this.form);
          this.$inertia.put(route(this.linkUpdate, vform.id), vform);
          break;
      }
    },
    close: function close() {
      console.log("back of the future", this.linkBack);
      this.$inertia.get(route(this.linkBack));
    },
    setForm: function setForm(objeto) {
      this.form = objeto;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56":
/*!********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56 ***!
  \********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row mb-2 d-flex flex-align-center"
};

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("label", {
  "class": "cell-2"
}, "Categoria", -1
/* HOISTED */
);

var _hoisted_3 = {
  "class": "cell-10"
};
var _hoisted_4 = {
  "class": "card"
};
var _hoisted_5 = {
  "class": "card-content p-2"
};
var _hoisted_6 = {
  "class": "row"
};
var _hoisted_7 = {
  "class": "cell-12"
};
var _hoisted_8 = {
  "class": "cell-12"
};
var _hoisted_9 = {
  "class": "cell-12"
};
var _hoisted_10 = {
  "class": "cell-12 d-flex flex-justify-center"
};

var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", null, "Guardar", -1
/* HOISTED */
);

var _hoisted_12 = {
  "class": "row"
};
var _hoisted_13 = {
  "class": "cell-12"
};

var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "#"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "Tabla"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "Key"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "Excluidos"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "Eliminar")])], -1
/* HOISTED */
);

var _hoisted_15 = {
  "class": "d-flex flex-justify-center"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_pantalla = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("pantalla");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_pantalla, {
    ref: "pantalla",
    menus: $props.menus,
    registro: $options.getRegistro,
    accion: $props.accion,
    linkUpdate: _ctx.linkUpdate,
    linkStore: _ctx.linkStore,
    linkBack: $data.linkBack,
    titulo: $data.titulo,
    linkStoreShow: false
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function (parent) {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_1, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
        type: "text",
        "onUpdate:modelValue": function onUpdateModelValue($event) {
          return parent.form.categoria = $event;
        },
        "class": "metro-input",
        "data-role": "input",
        "data-prepend": parent.form.categoria_id
      }, null, 8
      /* PROPS */
      , ["onUpdate:modelValue", "data-prepend"]), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, parent.form.categoria]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
        "data-role": "panel",
        "class": "w-100",
        "data-title-caption": "Tablas",
        "data-custom-buttons": $options.getBotones
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
        type: "text",
        placeholder: "Tabla",
        "data-role": "input",
        "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
          return $data.v_tabla = $event;
        }),
        "class": "metro-input"
      }, null, 512
      /* NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.v_tabla]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
        type: "text",
        placeholder: "Key",
        "data-role": "input",
        "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
          return $data.v_key = $event;
        }),
        "class": "metro-input"
      }, null, 512
      /* NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.v_key]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
        type: "text",
        placeholder: "Campos Excluidos",
        "data-role": "input",
        "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
          return $data.v_except = $event;
        }),
        "class": "metro-input"
      }, null, 512
      /* NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.v_except]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
        "class": "button outline primary",
        onClick: _cache[4] || (_cache[4] = function () {
          return $options.addTabla && $options.addTabla.apply($options, arguments);
        })
      }, [_hoisted_11])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_13, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("table", {
        "class": "table table-border row-border",
        key: $data.tbcount
      }, [_hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(parent.form.tabla, function (fil, fix) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("tr", {
          key: fix
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fil.id), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fil.tabla), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fil.idkey), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fil.excepto), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
          "class": "mif-cross fg-red",
          onClick: function onClick($event) {
            return $options.delTabla(fil);
          }
        }, null, 8
        /* PROPS */
        , ["onClick"])])]);
      }), 128
      /* KEYED_FRAGMENT */
      ))])]))])])])])], 8
      /* PROPS */
      , ["data-custom-buttons"])];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["menus", "registro", "accion", "linkUpdate", "linkStore", "linkBack", "titulo"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce":
/*!*****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "scrollbox"
};
var _hoisted_2 = {
  "class": "grid"
};
var _hoisted_3 = {
  "class": "row w-100"
};
var _hoisted_4 = {
  "class": "cell-6"
};
var _hoisted_5 = {
  "class": "cell-6 d-flex flex-row-r"
};
var _hoisted_6 = {
  "class": "toolbar"
};

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-refresh icon"
}, null, -1
/* HOISTED */
);

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-file-empty icon"
}, null, -1
/* HOISTED */
);

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
  "class": "tool-button primary outline"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-exit icon"
})], -1
/* HOISTED */
);

var _hoisted_10 = {
  "class": "row w-100"
};
var _hoisted_11 = {
  "class": "cell-12"
};
var _hoisted_12 = {
  "class": "mitabla table subcompact row-hover striped table-border  mt-4"
};

var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", null, "Acciones", -1
/* HOISTED */
);

var _hoisted_14 = {
  "class": "toolbar",
  style: {
    "height": "36px"
  }
};

var _hoisted_15 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-pencil "
}, null, -1
/* HOISTED */
);

var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-cross"
}, null, -1
/* HOISTED */
);

var _hoisted_17 = {
  "class": "card-content p-2"
};
var _hoisted_18 = {
  ref: "frmMantenimiento"
};
var _hoisted_19 = {
  key: 0,
  "class": "card-footer d-flex flex-row flex-justify-center"
};

var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-floppy-disk"
}, null, -1
/* HOISTED */
);

var _hoisted_21 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("span", {
  "class": "mif-exit"
}, null, -1
/* HOISTED */
);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [$props.accion === 'B' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", {
    key: 0,
    "data-role": "panel",
    "data-title-caption": $props.titulo,
    "data-title-icon": $props.icono,
    "class": "w-100 h-100"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("input", {
    type: "text",
    "class": "metro-input",
    "data-role": "input",
    "data-search-button": "true",
    "data-on-search-button-click": "searchData",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return _ctx.searched = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.searched]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    "class": "tool-button primary outline",
    onClick: _cache[2] || (_cache[2] = function ($event) {
      return _ctx.$inertia.reload({
        only: ['data']
      });
    })
  }, [_hoisted_7]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    "class": "tool-button primary outline",
    onClick: _cache[3] || (_cache[3] = function ($event) {
      return $options.showForm();
    })
  }, [_hoisted_8]), _hoisted_9])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("table", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("thead", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" \"sortable-column sort-asc\" "), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.header, function (head, hix) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("th", {
      "class": head.clase,
      key: hix
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(head.label), 3
    /* TEXT, CLASS */
    );
  }), 128
  /* KEYED_FRAGMENT */
  )), _hoisted_13])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" style=\"height: 150px !important;\" "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.getFiltro || [], function (fila, fix) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("tr", {
      key: fix
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.header, function (col, cix) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("td", {
        key: cix
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fila[col.campo]), 1
      /* TEXT */
      );
    }), 128
    /* KEYED_FRAGMENT */
    )), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "extra-comando", {
      fila: fila
    }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
      "class": "tool-button secondary outline",
      onClick: function onClick($event) {
        return $options.editForm(fila);
      }
    }, [_hoisted_15], 8
    /* PROPS */
    , ["onClick"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
      "class": "tool-button alert outline",
      onClick: function onClick($event) {
        return $options.deleteForm(fila);
      }
    }, [_hoisted_16], 8
    /* PROPS */
    , ["onClick"])])])]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])])])])], 8
  /* PROPS */
  , ["data-title-caption", "data-title-icon"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), 'N|E'.includes(this.accion) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", {
    key: 1,
    "data-role": "panel",
    "data-title-caption": 'Mantenimiento de ' + $props.titulo,
    "data-title-icon": $props.icono,
    "data-main-panel": "true",
    "class": "w-100 h-100"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", {
    "class": $props.sizeclase
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("form", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "default", {
    form: $data.form
  })], 512
  /* NEED_PATCH */
  )]), $props.showBotones ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    "class": "button primary outline m-2",
    onClick: _cache[4] || (_cache[4] = function () {
      return $options.submit && $options.submit.apply($options, arguments);
    })
  }, [_hoisted_20], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $props.linkStoreShow]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    "class": "button alert outline",
    onClick: _cache[5] || (_cache[5] = function () {
      return $options.close && $options.close.apply($options, arguments);
    })
  }, [_hoisted_21])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
  /* CLASS */
  )], 8
  /* PROPS */
  , ["data-title-caption", "data-title-icon"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $props.accion == 'R' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", {
    key: 2,
    "data-role": "panel",
    "data-title-caption": $props.titulo,
    "data-title-icon": $props.icono,
    "data-main-panel": "true",
    "class": "w-100 h-100"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "reporte")], 8
  /* PROPS */
  , ["data-title-caption", "data-title-icon"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./resources/js/Mixes/busqueda.js":
/*!****************************************!*\
  !*** ./resources/js/Mixes/busqueda.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var busqueda = {
  data: function data() {
    return {
      searched: ""
    };
  },
  computed: {
    getFiltro: function getFiltro() {
      var my = this;
      return this.getData.filter(function (fila) {
        return JSON.stringify(fila).toLocaleUpperCase().includes(my.searched.toLocaleUpperCase());
      });
    }
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (busqueda);

/***/ }),

/***/ "./resources/js/Pages/Categoria/tabla.vue":
/*!************************************************!*\
  !*** ./resources/js/Pages/Categoria/tabla.vue ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _tabla_vue_vue_type_template_id_05d13b56__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tabla.vue?vue&type=template&id=05d13b56 */ "./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56");
/* harmony import */ var _tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./tabla.vue?vue&type=script&lang=js */ "./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js");



_tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _tabla_vue_vue_type_template_id_05d13b56__WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/Pages/Categoria/tabla.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/controles/pantalla.vue":
/*!*********************************************!*\
  !*** ./resources/js/controles/pantalla.vue ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _pantalla_vue_vue_type_template_id_322bc1ce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pantalla.vue?vue&type=template&id=322bc1ce */ "./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce");
/* harmony import */ var _pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pantalla.vue?vue&type=script&lang=js */ "./resources/js/controles/pantalla.vue?vue&type=script&lang=js");



_pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _pantalla_vue_vue_type_template_id_322bc1ce__WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/controles/pantalla.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js":
/*!************************************************************************!*\
  !*** ./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_tabla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./tabla.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/controles/pantalla.vue?vue&type=script&lang=js":
/*!*********************************************************************!*\
  !*** ./resources/js/controles/pantalla.vue?vue&type=script&lang=js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_pantalla_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./pantalla.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56":
/*!******************************************************************************!*\
  !*** ./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56 ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_tabla_vue_vue_type_template_id_05d13b56__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_tabla_vue_vue_type_template_id_05d13b56__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./tabla.vue?vue&type=template&id=05d13b56 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Categoria/tabla.vue?vue&type=template&id=05d13b56");


/***/ }),

/***/ "./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce":
/*!***************************************************************************!*\
  !*** ./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_pantalla_vue_vue_type_template_id_322bc1ce__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_pantalla_vue_vue_type_template_id_322bc1ce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./pantalla.vue?vue&type=template&id=322bc1ce */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/controles/pantalla.vue?vue&type=template&id=322bc1ce");


/***/ })

}]);