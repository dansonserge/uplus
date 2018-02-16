!function(e){function t(r){if(n[r])return n[r].exports;var o=n[r]={exports:{},id:r,loaded:!1};return e[r].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}var n={};return t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){e.exports=n(25)},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function r(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function o(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var i=function(e){function t(e){n(this,t);var o=r(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return o.name="IntegrationError",o}return o(t,e),t}(Error);t.default=i},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.zipObject=t.sum=t.stringsIntersection=t.merge=t.omit=t.pickBy=t.pick=t.mapValues=t.isEqual=t.findIndex=t.find=void 0;var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o=n(18),i=(t.find=function(e,t){for(var n=0;n<e.length;n++)if(t(e[n]))return e[n]},t.findIndex=function(e,t){for(var n=0;n<e.length;n++)if(t(e[n]))return n;return-1},"[object Object]"),a=(t.isEqual=function e(t,n){if("object"!==("undefined"==typeof t?"undefined":r(t))||"object"!==("undefined"==typeof n?"undefined":r(n)))return t===n;if(null===t||null===n)return t===n;var o=Array.isArray(t),a=Array.isArray(n);if(o!==a)return!1;var s=Object.prototype.toString.call(t)===i,u=Object.prototype.toString.call(n)===i;if(s!==u)return!1;if(!s&&!o)return!1;var c=Object.keys(t),l=Object.keys(n);if(c.length!==l.length)return!1;for(var f={},d=0;d<c.length;d++)f[c[d]]=!0;for(var p=0;p<l.length;p++)f[l[p]]=!0;var h=Object.keys(f);if(h.length!==c.length)return!1;var y=function(r){return e(t[r],n[r])};return h.every(y)},t.mapValues=function(e,t){for(var n={},r=Object.keys(e),o=0;o<r.length;o++)n[r[o]]=t(e[r[o]],r[o]);return n},t.pick=function(e,t){for(var n={},r=0;r<t.length;r++)"undefined"!=typeof e[t[r]]&&(n[t[r]]=e[t[r]]);return n},t.pickBy=function(e,t){for(var n={},r=Object.keys(e),o=0;o<r.length;o++)t(r[o],e[r[o]])&&(n[r[o]]=e[r[o]]);return n});t.omit=function(e,t){return a(e,function(e,n){return t.indexOf(e)===-1})},t.merge=function e(){for(var t=arguments.length,n=Array(t),i=0;i<t;i++)n[i]=arguments[i];var a=Array.isArray(n[0])?[]:{};return n.forEach(function(t){t&&Object.keys(t).forEach(function(n){var i=a[n],s=t[n];"object"!==("undefined"==typeof i?"undefined":r(i))||"object"!==("undefined"==typeof s?"undefined":r(s))||i instanceof o.SafeString?void 0!==s?a[n]=s:void 0!==i&&(a[n]=i):a[n]=e(i,s)})}),a},t.stringsIntersection=function(e,t){for(var n={},r=0;r<t.length;r++)n[t[r]]=!0;for(var o=[],i=0;i<e.length;i++)n[e[i]]&&o.push(e[i]);return o},t.sum=function(e){for(var t=0,n=0;n<e.length;n++)t+=e[n];return t},t.zipObject=function(e,t){for(var n={},r=0;r<e.length;r++)n[e[r]]=t[r];return n}},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),o=function(){function e(){n(this,e),this._shouldLog=!1}return r(e,[{key:"setApiKey",value:function(e){this._shouldLog=/^pk_test_/.test(e)}},{key:"_log",value:function(e,t){if(this._shouldLog&&window.console){var n=window.console[e];n.apply?n.apply(window.console,t):n(t.join(" "))}}},{key:"log",value:function(){for(var e=arguments.length,t=Array(e),n=0;n<e;n++)t[n]=arguments[n];this._log("log",t)}},{key:"warn",value:function(){for(var e=arguments.length,t=Array(e),n=0;n<e;n++)t[n]=arguments[n];this._log("warn",t)}}]),e}(),i=new o;t.default=i},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.RELEASE_VERSION=t.Q_URL=t.API_URL=t.ELEMENTS_INNER_URL=t.PARENT_ORIGIN=t.REFERRER=t.ORIGIN=void 0;var r=n(11),o=(t.ORIGIN=(0,r.parseUrl)("https://js.stripe.com/v3/").origin,t.REFERRER=document.referrer);t.PARENT_ORIGIN=(0,r.parseUrl)(o).origin,t.ELEMENTS_INNER_URL="https://js.stripe.com/v3/elements-inner-0e3633856ff4c1df888017896d937b88.html",t.API_URL="https://api.stripe.com/v1/",t.Q_URL="https://q.stripe.com",t.RELEASE_VERSION="24a48b3"},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.or=function(){for(var e=arguments.length,t=Array(e),n=0;n<e;n++)t[n]=arguments[n];return{check:function(e){return t.some(function(t){return t.check(e)})},description:"one of the following types: "+t.map(function(e){return e.description}).join(", ")}},t.oneOf=function(){for(var e=arguments.length,t=Array(e),n=0;n<e;n++)t[n]=arguments[n];return{check:function(e){return t.some(function(t){return t===e})},description:"one of the following strings: "+t.join(", ")}},t.string={check:function(e){return"string"==typeof e},description:"a string"},t.bool={check:function(e){return"boolean"==typeof e},description:"true or false"},t.number={check:function(e){return"number"==typeof e},description:"a number"},t.object={check:function(e){return null!==e&&"object"===("undefined"==typeof e?"undefined":n(e))},description:"an object"},t.arrayOf=function(e){return{check:function(e){function t(t){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(t){return!(!Array.isArray(t)||!t.every(function(t){return e.check(t)}))}),description:"an array of "+e.description}},t.misuse=function(e){return{check:function(e){return void 0===e},description:"used in "+e+" instead"}}},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}function o(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}Object.defineProperty(t,"__esModule",{value:!0});var i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a=n(2),s=n(3),u=r(s),c=n(1),l=r(c),f=function e(t,n){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},s=r.path||[],c=r.label||"option",f=r.origin,d=null===n?"null":"undefined"==typeof n?"undefined":i(n);if(!t)return void u.default.warn("Unsupported "+c+": "+s.join(".")+" is not a customizable parameter.");if("function"==typeof t)return t(n,f);if("function"==typeof t.check){if(t.check(n))return n;throw new l.default("Invalid "+c+": "+s.join(".")+" should be "+t.description+".\nYou passed a value of type: "+d+".")}if("object"===("undefined"==typeof t?"undefined":i(t))){if("object"!==d)throw new l.default("Invalid "+c+": "+s.join(".")+" should be an object. You passed a value of type: "+d+".");var p=function(){var r=t;return{v:(0,a.pickBy)((0,a.mapValues)(n,function(t,n){return e(r[n],t,{label:c,origin:f,path:[].concat(o(s),[n])})}),function(e,t){return void 0!==t})}}();if("object"===("undefined"==typeof p?"undefined":i(p)))return p.v}};t.default=f},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}function o(e,t){var n={};for(var r in e)t.indexOf(r)>=0||Object.prototype.hasOwnProperty.call(e,r)&&(n[r]=e[r]);return n}function i(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function a(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}function s(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function u(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function c(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var l=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},f=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),d=n(17),p=r(d),h=n(4),y=n(9),v=r(y),_=n(21),m=r(_),b=n(10),g=n(19),w=r(g),E=n(1),S=r(E),O=n(3),j=r(O),k=n(6),M=r(k),A=n(8),I={base:"StripeElement",focus:"StripeElement--focus",invalid:"StripeElement--invalid",complete:"StripeElement--complete",empty:"StripeElement--empty",webkitAutofill:"StripeElement--webkit-autofill"},P="#faffbd",C="rgb(250, 255, 189)",N=function(e){function t(e){var n;s(this,t);var r=u(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));r._formSubmit=function(){for(var e=r._component.parentElement;e&&"FORM"!==e.nodeName;)e=e.parentElement;if(e){var t=document.createEvent("Event");t.initEvent("submit",!0,!0),e.dispatchEvent(t)}},r.focus=function(){return r._iframe.contentWindow.focus(),r},r.blur=function(){return r._iframe.blur(),r._iframe.contentWindow.blur(),Array.prototype.forEach.call(r._component.querySelectorAll("input"),function(e){return e.blur()}),r},r._sendMessage=function(e){return r._iframe.contentWindow&&r._loaded?r._iframe.contentWindow.postMessage(JSON.stringify(e),h.ORIGIN):r._queuedMessages=[].concat(a(r._queuedMessages),[e]),r};var o=e.componentName,i=e.classes;return r._createComponent(e),r._componentName=o,r._classes=l({},I),r._queuedMessages=[],r._changeClasses(i),r._loaded=!1,r._lastBackgroundColor="",n=r,u(r,n)}return c(t,e),f(t,[{key:"mount",value:function(e){var t,n=void 0,r=Date.now();if(!e)throw new S.default("Missing argument. Make sure to call mount() with a valid DOM element or selector.");if("string"==typeof e){var o=document.querySelectorAll(e);if(o.length>1&&j.default.warn("The selector you specified ("+e+") applies to "+o.length+" DOM elements that are currently on the page.\nThe Stripe element will be mounted to the first one."),!o.length)throw new S.default("The selector you specified ("+e+") applies to no DOM elements that are currently on the page.\nMake sure the element exists on the page before calling mount().");n=o[0]}else{if(!e.appendChild)throw new S.default("Invalid DOM element. Make sure to call mount() with a valid dom element or selector.");n=e}if("INPUT"===n.nodeName)throw new S.default("Stripe elements must be mounted in a DOM element that\ncan contain child nodes. `input` elements are not permitted to have child\nnodes. Try using a `div` or `span` element instead.");n.children.length&&j.default.warn("Stripe element must be mounted in a DOM element does not contain child nodes.");var a=this._component.parentElement;if(n!==a){if(a)throw new S.default("This component has already been mounted");for(this._parent=n;n.firstChild;)n.removeChild(n.firstChild);n.appendChild(this._component),this._sendMessage({action:"stripe-mount",mountTime:r}),this._findPossibleLabel(),this.on("submit",this._formSubmit),(0,b.updateClasses)(n,(t={},i(t,this._classes.base,!0),i(t,this._classes.empty,!0),t))}}},{key:"_findPossibleLabel",value:function(){var e=this,t=this._parent;if(t){var n=t.getAttribute("id"),r=void 0;if(n&&(r=document.querySelector("label[for="+n+"]")),r)t.addEventListener("click",this.focus);else for(r=r||t.parentElement;r&&"LABEL"!==r.nodeName;)r=r.parentElement;r?(this._label=r,r.addEventListener("click",function(t){e.focus(),t.preventDefault()})):t.addEventListener("click",this.focus)}}},{key:"update",value:function(e){var t=(0,M.default)(A.createOptions,e,{label:"option for `update()`"})||{},n=t.classes,r=o(t,["classes"]);return this._changeClasses(n),this._updateIFrameHeight(e),Object.keys(r).length&&this._sendMessage(l({action:"stripe-update"},r)),this}},{key:"_isMounted",value:function(){return!!document.body&&document.body.contains(this._component)}},{key:"unmount",value:function(){var e=this._component.parentElement,t=this._label;if(e){var n;e.removeChild(this._component),e.removeEventListener("click",this.focus),(0,b.updateClasses)(e,(n={},i(n,this._classes.base,!1),i(n,this._classes.empty,!1),i(n,this._classes.focus,!1),i(n,this._classes.invalid,!1),i(n,this._classes.complete,!1),n))}return this._parent=null,t&&(t.removeEventListener("click",this.focus),this._label=null),this}},{key:"_changeClasses",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t={};return Object.keys(e).forEach(function(n){if(!I[n])throw new S.default(n+" is not a customizable class name.\nYou can customize: "+Object.keys(I).join(", "));t[n]=e[n].replace(/\./g," ")}),this._classes=l({},this._classes,t),this}},{key:"_receiveMessage",value:function(e){if(this._name!==e.element)return this;switch(e.event){case"redirectfocus":var t=(0,m.default)(this._iframe,e.focusDirection);t&&t.focus();break;case"focus":this._parent&&(0,b.updateClasses)(this._parent,i({},this._classes.focus,!0)),this.emit("focus");break;case"blur":this._parent&&(0,b.updateClasses)(this._parent,i({},this._classes.focus,!1)),this.emit("blur");break;case"escape":this.emit("escape");break;case"load":this._loaded=!0,this._queuedMessages.forEach(this._sendMessage),this._queuedMessages=[];break;case"change":var n=e.error,r=e.brand,o=e.value,a=e.empty,s=e.complete;if(this.emit("change",{error:n,brand:r,value:o,empty:a,complete:s}),this._parent){var u;(0,b.updateClasses)(this._parent,(u={},i(u,this._classes.invalid,n),i(u,this._classes.empty,a),i(u,this._classes.complete,s),u))}break;case"submit":this.emit("submit");break;case"autofill":if(this._parent){var c=this._parent.style.backgroundColor,l=c===P||c===C;this._lastBackgroundColor=l?this._lastBackgroundColor:c,this._parent.style.backgroundColor=P,(0,b.updateClasses)(this._parent,i({},this._classes.webkitAutofill,!0))}break;case"autofill-cleared":this._parent&&(this._parent.style.backgroundColor=this._lastBackgroundColor,(0,b.updateClasses)(this._parent,i({},this._classes.webkitAutofill,!1)))}return this}},{key:"_createToken",value:function(e){return this._sendMessage(l({action:"stripe-create-token"},e))}},{key:"_createComponent",value:function(e){var t=e.componentName,n=e.groupId,r=e.apiKey,i=(e.classes,o(e,["componentName","groupId","apiKey","classes"]));this._name="stripeField_"+t+"_"+n;var a=(0,v.default)(l({name:this._name,componentName:t,groupId:n,apiKey:r},i)),s=a.component,u=a.iframe;this._component=s,this._iframe=u,this._updateIFrameHeight(e)}},{key:"_updateIFrameHeight",value:function(e){var t=e.style&&e.style.base||{},n=t.lineHeight,r=t.fontSize,o=this._iframe.style.height;if(!o||n||r){var i=(0,w.default)(n||this._lastHeight,r||this._lastFontSize);o!==i&&(this._iframe.style.height=i),this._lastFontSize=r||this._lastFontSize,this._lastHeight=n||this._lastHeight}}}]),t}(p.default);t.default=N},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.createOptions=void 0;var r=n(5);t.createOptions={classes:{base:r.string,complete:r.string,empty:r.string,focus:r.string,invalid:r.string,webkitAutofill:r.string},hidePostalCode:r.bool,hideIcon:r.bool,style:{base:r.object,complete:r.object,empty:r.object,invalid:r.object,focus:r.object,hover:r.object},iconStyle:(0,r.oneOf)("solid","default"),value:(0,r.or)(r.string,r.object),__privateCvcOptional:r.bool,__privateValue:(0,r.or)(r.string,r.object),error:{type:r.string,code:r.string,decline_code:r.string},locale:(0,r.misuse)("elements()"),fonts:(0,r.misuse)("elements()"),__privateWithCredentials:(0,r.misuse)("elements()")}},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.PRIVATE_INPUT_CLASSNAME=void 0;var o=n(20),i=r(o),a="__PrivateStripeElement",s=t.PRIVATE_INPUT_CLASSNAME=a+"-input",u=function(e){var t=document.createElement("div");t.className=a,t.style.margin="0",t.style.padding="0",t.style.border="none",t.style.display="block",t.style.background="transparent",t.style.position="relative",t.style.opacity="1";var n=(0,i.default)(e),r=document.createElement("input");return r.className=s,r.style.height="1px",r.style.position="absolute",r.style.top="0",r.style.left="0",r.style.border="none",r.style.padding="0",r.style.margin="0",r.style.display="block",r.style.width="100%",r.style.opacity="0",r.style.background="transparent",r.style.pointerEvents="none",r.setAttribute("aria-hidden","true"),r.disabled=!0,n.addEventListener("load",function(){r.disabled=!1}),r.addEventListener("focus",function(){n.contentWindow&&n.contentWindow.focus()}),t.appendChild(r),t.appendChild(n),t.appendChild(r),{component:t,iframe:n}};t.default=u},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.invisibleDiv=t.updateClasses=void 0;var o=n(26),i=r(o);t.updateClasses=function(e,t){var n={};Object.keys(t).forEach(function(e){e.split(/\s+/).forEach(function(r){r&&(n[r]=t[e])})}),e.className=(0,i.default)(e.className,n)},t.invisibleDiv=function(){var e=document.createElement("div");return e.style.display="none",e}},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=t.parseUrl=function(e){if(""===e)return{host:"",protocol:"",origin:""};var t=document.createElement("a");return t.href=e,{host:t.host,protocol:t.protocol,origin:t.protocol+"//"+t.host}};t.isCrossDomain=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=n(e).host;return!!r&&r!==(t||window.location.host)}},function(e,t){(function(t){"use strict";function n(e){s.length||(a(),u=!0),s[s.length]=e}function r(){for(;c<s.length;){var e=c;if(c+=1,s[e].call(),c>l){for(var t=0,n=s.length-c;t<n;t++)s[t]=s[t+c];s.length-=c,c=0}}s.length=0,c=0,u=!1}function o(e){var t=1,n=new d(e),r=document.createTextNode("");return n.observe(r,{characterData:!0}),function(){t=-t,r.data=t}}function i(e){return function(){function t(){clearTimeout(n),clearInterval(r),e()}var n=setTimeout(t,0),r=setInterval(t,50)}}e.exports=n;var a,s=[],u=!1,c=0,l=1024,f="undefined"!=typeof t?t:self,d=f.MutationObserver||f.WebKitMutationObserver;a="function"==typeof d?o(r):i(r),n.requestFlush=a,n.makeRequestCallFromTimer=i}).call(t,function(){return this}())},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.validate=void 0;var o=n(2),i=n(1),a=r(i),s=n(16);t.validate=function(e,t){if(!(e&&e in s.ELEMENT_SPEC))throw new a.default("A valid component name must be provided. Valid component names are:\n"+Object.keys(s.ELEMENT_SPEC).join(", ")+"; you passed: "+e+".");if(s.ELEMENT_SPEC[e].unique&&t.indexOf(e)!==-1)throw new a.default("Can only create one element of type "+e+".");var n=(0,o.stringsIntersection)(t,s.ELEMENT_SPEC[e].conflict);if(n.length){var r=n[0];throw new a.default("Cannot create an element of type "+e+" after an element of type "+r+" has already been created.")}}},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},a=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),s=n(2),u=n(1),c=r(u),l=n(3),f=r(l),d=n(6),p=r(d),h=n(13),y=n(8),v=n(7),_=r(v),m=function(){function e(t,n,r,i){return o(this,e),b.call(this),this._fields={},this._id=t,this._apiKey=r,this._stripeJsId=n,f.default.setApiKey(r),this._commonOptions=i,this}return a(e,[{key:"_registerSiblings",value:function(){var e=this,t=(0,s.mapValues)(this._fields,function(e){return e._componentName});Object.keys(this._fields).forEach(function(n){e._fields[n]._sendMessage({action:"stripe-sibling-register",frames:t})})}}]),e}(),b=function(){var e=this;this.create=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=Object.keys(e._fields).map(function(t){return e._fields[t]._componentName});(0,h.validate)(t,r);var o=(0,p.default)(y.createOptions,n,{label:"option for `create()`"}),a=new _.default(i({},o,e._commonOptions,{componentName:t,groupId:e._id,stripeJsId:e._stripeJsId,apiKey:e._apiKey}));return e._fields[a._name]=a,e._registerSiblings(),a},this._proxyMessage=function(t){var n=e._fields[t.element];if("stripe-integration-error"===t.action&&n)throw new c.default(t.message);n&&n._receiveMessage(t)}};t.default=m},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.elementsOptions=void 0;var r=n(5);t.elementsOptions={locale:r.string,fonts:(0,r.arrayOf)(r.object),__privateWithCredentials:r.bool}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.FieldTypes=t.ELEMENT_SPEC=void 0;var r=n(2),o=t.ELEMENT_SPEC={
	card:{
		unique:!0,
		conflict:["cardNumber","cardExpiry","cardCvc","postalCode"]
		},
	cardNumber:{
		unique:!0,
		conflict:["card"]
		},
	cardExpiry:{
		unique:!0,
		conflict:["card"]
		},
	cardCvc:{
		unique:!0,
		conflict:["card"]
		},
	postalCode:{
		unique:!0,
		conflict:["card"]
		},
	empty:{
		unique:!0,
		conflict:[]
		}
	};t.FieldTypes=(0,r.zipObject)(Object.keys(o),Object.keys(o))},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),o=function(){function e(){n(this,e),this._callbacks={},this.on=this.addListener=this.addEventListener,this.off=this.removeListener=this.removeEventListener}return r(e,[{key:"addEventListener",value:function(e,t){return this._addEventListener(e,t)}},{key:"_addEventListener",value:function(e,t,n){return this._callbacks[e]=this._callbacks[e]||[],this._callbacks[e].push({original:n,fn:t}),this}},{key:"removeEventListener",value:function(e,t){if("undefined"==typeof t)delete this._callbacks[e];else for(var n=this._callbacks[e],r=void 0,o=0;o<n.length;o++)if(r=n[o],r.fn===t||r.original===t){n.splice(o,1);break}return this}},{key:"removeAllListeners",value:function(){return this._callbacks={},this}},{key:"once",value:function(e,t){var n=this,r=function r(){n.off(e,r),t.apply(void 0,arguments)};return r._original=t,this.on(e,r)}},{key:"emit",value:function(e){for(var t=arguments.length,n=Array(t>1?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];var o=this._callbacks[e]||[];return o.forEach(function(e){var t=e.fn;return t.apply(void 0,n)}),this}}]),e}();t.default=o},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}function o(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function i(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}function a(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0}),t.SafeFontSrcUrlString=t.SafeFontSrcFormatString=t.SafeFontStretchString=t.SafeFontStyleString=t.SafeFontWeightString=t.SafeFontVariantString=t.SafeFontUnicodeRangeString=t.SafeFontFamilyString=t.SafeStyleString=t.SafeString=void 0;var s=n(1),u=r(s),c=t.SafeString=function e(t){if(a(this,e),"string"!=typeof t)throw new u.default("Invalid string: "+t+".");this.value=t},l=(t.SafeStyleString=function(e){function t(e){if(a(this,t),"string"!=typeof e)throw new u.default("Invalid style configuration value: "+e+". This value must be a string.");var n=e.match(/^[#a-zA-Z0-9-_\s,"'().]*$/);if(!n)throw new u.default("Invalid style configuration value: "+e+". This value contains invalid characters.");return o(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e))}return i(t,e),t}(c),function(e,t){return function(n){function r(n){if(a(this,r),"string"!=typeof n)throw new u.default("Invalid "+e+" value in font configuration: "+n+". This value must be a string.");var i=n.match(t);if(!i)throw new u.default("Invalid "+e+" value in font configuration: "+n+". This value contains invalid characters.");return o(this,(r.__proto__||Object.getPrototypeOf(r)).call(this,n))}return i(r,n),r}(c)}),f=(t.SafeFontFamilyString=l("family",/^[-_a-zA-Z0-9\s'"]*$/),t.SafeFontUnicodeRangeString=l("unicodeRange",/^[-U+A-F0-9?, ]*$/),t.SafeFontVariantString=l("variant",/^[a-zA-Z0-9-()\s]*$/),/^[a-zA-Z0-9-]*$/);t.SafeFontWeightString=l("weight",f),t.SafeFontStyleString=l("style",f),t.SafeFontStretchString=l("stretch",f),t.SafeFontSrcFormatString=function(e){function t(e){a(this,t);var n=e.match(/^[-a-zA-Z0-9]*$/);if(!n)throw new u.default("Invalid src value in font configuration value: "+e+". This value contains invalid characters.");return o(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,window.encodeURI(e)))}return i(t,e),t}(c),t.SafeFontSrcUrlString=function(e){function t(e){a(this,t);var n=e.match(/^("?'?https:\/\/)|data:/);if(!n)throw new u.default("Invalid src value in font configuration: "+e+". URLs have to start with 'https://' or 'data:'.");var r=e.match(/^[#?&=;,a-zA-Z0-9-+_\/.:]*$/);if(!r)throw new u.default("Invalid src value in font configuration value: "+e+". This value contains invalid characters.");return o(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,window.encodeURI(e)))}return i(t,e),t}(c);t.default=c},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n="1.2em",r="14px",o=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:n,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:r;if(/^[0-9.]+px$/.test(e))return e;var o=parseFloat(t.toString().replace(/[^0-9.]/g,"")),i=parseFloat(e.toString().replace(/[^0-9.]/g,""));/^[0-9.]+px$/.test(t)||(o*=parseFloat(r.replace(/[^0-9.]/g,"")));var a=i*o+"px";return/^[0-9.]+px$/.test(a)?a:"100%"};t.default=o},function(e,t,n){"use strict";function r(e,t){var n={};for(var r in e)t.indexOf(r)>=0||Object.prototype.hasOwnProperty.call(e,r)&&(n[r]=e[r]);return n}Object.defineProperty(t,"__esModule",{value:!0});var o=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},i=n(4),a=n(24),s=n(11),u=function(e){var t=e.name,n=r(e,["name"]),u=window.location.toString(),c=(0,a.serialize)(o({frameId:t,origin:(0,s.parseUrl)(u).origin,referrer:u},n)),l=document.createElement("iframe");return l.setAttribute("frameborder","0"),l.setAttribute("allowTransparency","true"),l.setAttribute("scrolling","no"),l.setAttribute("name",e.name),l.style.border="none",l.style.margin="0",l.style.padding="0",l.style.width="1px",l.style.minWidth="100%",l.style.overflow="hidden",l.style.display="block",l.src=i.ELEMENTS_INNER_URL+"#"+c,l};t.default=u},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=n(9),i="a[href], area[href], input:not([disabled]),\n  select:not([disabled]), textarea:not([disabled]), button:not([disabled]),\n  iframe, object, embed, *[tabindex], *[contenteditable]",a=function(e,t){for(var n=document.querySelectorAll(i),a=(0,r.findIndex)(n,function(t){return t===e}),s="previous"===t?-1:1,u=s,c=n[a+u];c&&c.className.indexOf(o.PRIVATE_INPUT_CLASSNAME)!==-1;)u+=s,c=n[a+u];return c&&c.contentWindow?c.contentWindow:c};t.default=a},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=0;t.nextId=function(e){return""+e+n++},t.uuid=function e(t){return t?(t^16*Math.random()>>t/4).toString(16):"00000000-0000-4000-8000-000000000000".replace(/[08]/g,e)}},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=n(28),i=r(o),a=window.Promise||i.default;t.default=a},function(e,t){"use strict";function n(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}Object.defineProperty(t,"__esModule",{value:!0});var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.serialize=function e(t,o){var i=[];return Object.keys(t).forEach(function(a){var s=t[a],u=o?o+"["+a+"]":a;if("object"===("undefined"==typeof s?"undefined":r(s))){var c=e(s,u);""!==c&&(i=[].concat(n(i),[c]))}else void 0!==s&&(i=[].concat(n(i),[u+"="+encodeURIComponent(s)]))}),i.join("&").replace(/%20/g,"+")},t.deserialize=function(e){var t={};return e.replace(/\+/g," ").split("&").forEach(function(e,n){var r=e.split("="),o=decodeURIComponent(r[0]),i=void 0,a=t,s=0,u=o.split("]["),c=u.length-1;if(/\[/.test(u[0])&&/\]$/.test(u[c])?(u[c]=u[c].replace(/\]$/,""),u=u.shift().split("[").concat(u),c=u.length-1):c=0,2===r.length)if(i=decodeURIComponent(r[1]),c)for(;s<=c;s++)o=""===u[s]?a.length:u[s],a[o]=s<c?a[o]||(u[s+1]&&isNaN(u[s+1])?{}:[]):i,a=a[o];else Array.isArray(t[o])?t[o].push(i):void 0!==t[o]?t[o]=[t[o],i]:t[o]=i;else o&&(t[o]="")}),t}},function(e,t,n){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},s=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}(),u=n(14),c=r(u),l=n(7),f=r(l),d=n(15),p=n(22),h=n(3),y=r(h),v=n(23),_=r(v),m=n(1),b=r(m),g=n(6),w=r(g),E=n(5),S=n(10),O=n(4),j=function(){function e(t){var n=this,r=t.apiKey;if(o(this,e),this._ensureEmptyIframeMount=function(){n._emptyElement._isMounted()||n._mountEmptyElement()},this.elements=function(t){var r=null;t&&(r=(0,w.default)(d.elementsOptions,t,{label:"option for `elements()`"}));var o=(0,p.nextId)("element"),i=new c.default(o,e.stripeJsId,n._apiKey,r);return n._componentGroups[o]=i,i},this.createToken=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=void 0,o=void 0;if(e instanceof f.default?(r=e,o="card"):r=n._emptyElement,
n._requests[r._name])return n._requests[r._name].promise;var i=(0,p.nextId)("nonce"),s=r===n._emptyElement?"controller_"+i:r._name,u=new _.default(function(u,c){o||(o=(0,w.default)((0,E.oneOf)("bank_account","pii"),e,{label:"token type"}),n._ensureEmptyIframeMount()),n._requests[s]=a({},n._requests[s],{resolve:u,reject:c}),r._createToken({data:t,apiKey:n._apiKey,referrer:window.location.toString(),tokenName:o,nonce:i})});return n._requests[s]=a({},n._requests[s],{promise:u,nonce:i}),u},!r)throw new b.default("Please specify a publishable key.");if(0===r.indexOf("sk_"))throw new b.default("You should not use your secret key with Stripe.js.\n        Please pass a publishable key instead.");y.default.setApiKey(r),this._apiKey=r,this._requests={},this._componentGroups={},this._setupListeners(),this._emptyElement=this.elements().create("empty"),document.addEventListener("DOMContentLoaded",this._ensureEmptyIframeMount),window.addEventListener("load",this._ensureEmptyIframeMount)}return s(e,[{key:"_mountEmptyElement",value:function(){var e=(0,S.invisibleDiv)();if(document.body)document.body.appendChild(e),this._emptyElement.mount(e);else if("complete"===document.readyState||"interactive"===document.readyState)throw new b.default("Stripe.js requires that your page has a <body> element.")}},{key:"_setupListeners",value:function(){var e=this;window.addEventListener("message",function(t){var n=t.data,r=t.origin;if(0===O.ORIGIN.indexOf(r)){var o=n;if("object"!==("undefined"==typeof n?"undefined":i(n)))try{o=JSON.parse(n)}catch(e){return}if(o.__stripeJsV3){var a=e._requests["controller_"+o.nonce]||e._requests[o.element],s=e._componentGroups[o.groupId];switch(o.action){case"stripe-fieldevent":s&&s._proxyMessage(o);break;case"stripe-token":a&&a.nonce===o.nonce&&(a.resolve({token:o.token}),delete e._requests[o.element]);break;case"stripe-error":a&&a.nonce===o.nonce&&(a.resolve({error:o.error}),delete e._requests[o.element]);break;case"stripe-integration-error":a&&a.nonce===o.nonce?(a.reject(new b.default(o.message)),delete e._requests[o.element]):s&&s._proxyMessage(o)}}}})}}]),e}();j.version=3,j.stripeJsId=(0,p.uuid)();var k=function(e){return new j({apiKey:e})};k.version=j.version,window.Stripe&&2===window.Stripe.version?window.Stripe.StripeV3=k:window.Stripe=k,e.exports=k},function(e,t,n){var r,o;!function(){"use strict";var n=function(){function e(){}function t(e,t){for(var n=t.length,r=0;r<n;++r)i(e,t[r])}function n(e,t){e[t]=!0}function r(e,t){for(var n in t)s.call(t,n)&&(e[n]=!!t[n])}function o(e,t){for(var n=t.split(u),r=n.length,o=0;o<r;++o)e[n[o]]=!0}function i(e,i){if(i){var a=typeof i;"string"===a?o(e,i):Array.isArray(i)?t(e,i):"object"===a?r(e,i):"number"===a&&n(e,i)}}function a(){for(var n=arguments.length,r=Array(n),o=0;o<n;o++)r[o]=arguments[o];var i=new e;t(i,r);var a=[];for(var s in i)i[s]&&a.push(s);return a.join(" ")}e.prototype=Object.create(null);var s={}.hasOwnProperty,u=/\s+/;return a}();"undefined"!=typeof e&&e.exports?e.exports=n:(r=[],o=function(){return n}.apply(t,r),!(void 0!==o&&(e.exports=o)))}()},function(e,t,n){"use strict";function r(){}function o(e){try{return e.then}catch(e){return _=e,m}}function i(e,t){try{return e(t)}catch(e){return _=e,m}}function a(e,t,n){try{e(t,n)}catch(e){return _=e,m}}function s(e){if("object"!=typeof this)throw new TypeError("Promises must be constructed via new");if("function"!=typeof e)throw new TypeError("not a function");this._45=0,this._81=0,this._65=null,this._54=null,e!==r&&y(e,this)}function u(e,t,n){return new e.constructor(function(o,i){var a=new s(r);a.then(o,i),c(e,new h(t,n,a))})}function c(e,t){for(;3===e._81;)e=e._65;return s._10&&s._10(e),0===e._81?0===e._45?(e._45=1,void(e._54=t)):1===e._45?(e._45=2,void(e._54=[e._54,t])):void e._54.push(t):void l(e,t)}function l(e,t){v(function(){var n=1===e._81?t.onFulfilled:t.onRejected;if(null===n)return void(1===e._81?f(t.promise,e._65):d(t.promise,e._65));var r=i(n,e._65);r===m?d(t.promise,_):f(t.promise,r)})}function f(e,t){if(t===e)return d(e,new TypeError("A promise cannot be resolved with itself."));if(t&&("object"==typeof t||"function"==typeof t)){var n=o(t);if(n===m)return d(e,_);if(n===e.then&&t instanceof s)return e._81=3,e._65=t,void p(e);if("function"==typeof n)return void y(n.bind(t),e)}e._81=1,e._65=t,p(e)}function d(e,t){e._81=2,e._65=t,s._97&&s._97(e,t),p(e)}function p(e){if(1===e._45&&(c(e,e._54),e._54=null),2===e._45){for(var t=0;t<e._54.length;t++)c(e,e._54[t]);e._54=null}}function h(e,t,n){this.onFulfilled="function"==typeof e?e:null,this.onRejected="function"==typeof t?t:null,this.promise=n}function y(e,t){var n=!1,r=a(e,function(e){n||(n=!0,f(t,e))},function(e){n||(n=!0,d(t,e))});n||r!==m||(n=!0,d(t,_))}var v=n(12),_=null,m={};e.exports=s,s._10=null,s._97=null,s._61=r,s.prototype.then=function(e,t){if(this.constructor!==s)return u(this,e,t);var n=new s(r);return c(this,new h(e,t,n)),n}},function(e,t,n){"use strict";function r(e){var t=new o(o._61);return t._81=1,t._65=e,t}var o=n(27);e.exports=o;var i=r(!0),a=r(!1),s=r(null),u=r(void 0),c=r(0),l=r("");o.resolve=function(e){if(e instanceof o)return e;if(null===e)return s;if(void 0===e)return u;if(e===!0)return i;if(e===!1)return a;if(0===e)return c;if(""===e)return l;if("object"==typeof e||"function"==typeof e)try{var t=e.then;if("function"==typeof t)return new o(t.bind(e))}catch(e){return new o(function(t,n){n(e)})}return r(e)},o.all=function(e){var t=Array.prototype.slice.call(e);return new o(function(e,n){function r(a,s){if(s&&("object"==typeof s||"function"==typeof s)){if(s instanceof o&&s.then===o.prototype.then){for(;3===s._81;)s=s._65;return 1===s._81?r(a,s._65):(2===s._81&&n(s._65),void s.then(function(e){r(a,e)},n))}var u=s.then;if("function"==typeof u){var c=new o(u.bind(s));return void c.then(function(e){r(a,e)},n)}}t[a]=s,0===--i&&e(t)}if(0===t.length)return e([]);for(var i=t.length,a=0;a<t.length;a++)r(a,t[a])})},o.reject=function(e){return new o(function(t,n){n(e)})},o.race=function(e){return new o(function(t,n){e.forEach(function(e){o.resolve(e).then(t,n)})})},o.prototype.catch=function(e){return this.then(null,e)}}]);