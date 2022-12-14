(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0495ae18"],{"281e":function(t,c,e){"use strict";e.r(c);var n=function(){var t=this,c=t.$createElement,e=t._self._c||c;return e("div",{staticClass:"cky-section cky-section-policies cky-zero--padding cky-zero--margin"},[e("div",{staticClass:"cky-row"},[e("div",{staticClass:"cky-col-12"},[e("cky-connect-success")],1)]),t._m(0),e("div",{staticClass:"cky-section-content"},[e("div",{staticClass:"cky-row"},[e("div",{staticClass:"cky-col-6"},[e("div",{staticClass:"cky-card cky-card-policy"},[e("div",{staticClass:"cky-card-title"},[e("h3",[t._v(" "+t._s(t.$i18n.__("Privacy Policy Generator","cookie-law-info"))+" ")])]),e("div",{staticClass:"cky-policy-description"},[e("p",[t._v(" "+t._s(t.$i18n.__("Generate a privacy policy to inform users about your website’s data collection practices.","cookie-law-info"))+" ")])]),e("div",{staticClass:"cky-policy-icon cky-align-center"},[e("cky-icon",{attrs:{icon:"privacy-policy",width:"100px",height:"145px",color:"#8893a1"}})],1),e("div",{staticClass:"cky-policy-btn"},[e("a",{staticClass:"\n\t\t\t\t\t\t\t\tcky-button\n\t\t\t\t\t\t\t\tcky-button-primary\n\t\t\t\t\t\t\t\tcky-button-medium\n\t\t\t\t\t\t\t\tcky-external-link\n\t\t\t\t\t\t\t",staticStyle:{"text-decoration":"none"},attrs:{href:"https://privacypolicy.cookieyes.com/privacy-policy-generator",target:"_blank"}},[t._v(t._s(t.$i18n.__("Generate Privacy Policy","cookie-law-info"))+" ")])])])]),e("div",{staticClass:"cky-col-6"},[e("div",{staticClass:"cky-card cky-card-policy"},[e("div",{staticClass:"cky-card-title"},[e("h3",[t._v(" "+t._s(t.$i18n.__("Cookie Policy Generator","cookie-law-info"))+" ")])]),e("div",{staticClass:"cky-policy-description"},[e("p",[t._v(" "+t._s(t.$i18n.__("Generate a cookie policy by connecting to a free CookieYes account and inform users about your site's use of cookies.","cookie-law-info"))+" ")])]),e("div",{staticClass:"cky-policy-icon cky-align-center"},[e("cky-icon",{attrs:{icon:"cookie-policy",width:"100px",height:"145px",color:"#8893a1"}})],1),t.connected?e("div",{staticClass:"cky-policy-btn"},[e("a",{staticClass:"cky-button cky-button-primary cky-button-medium",staticStyle:{"text-decoration":"none"},attrs:{href:"https://cookiepolicy.cookieyes.com/cookie-policy-generator",target:"_blank"}},[t._v(t._s(t.$i18n.__("Generate Cookie Policy","cookie-law-info"))+" ")])]):e("div",{staticClass:"cky-policy-btn"},[e("cky-button",{ref:"ckyButtonConnect",staticClass:"cky-button-medium",nativeOn:{click:function(c){return t.connectToApp()}}},[t._v(" "+t._s(t.$i18n.__("New? Create a Free Account","cookie-law-info"))+" "),e("template",{slot:"loader"},[t._v(t._s(t.$i18n.__("Connecting to cookieyes.com...","cookie-law-info")))])],2),e("p",{staticStyle:{"margin-top":"10px",position:"absolute",left:"0",right:"0"}},[t._v(" "+t._s(t.$i18n.__("Already have an account?","cookie-law-info"))+" "),e("a",{attrs:{href:""},on:{click:function(c){return c.preventDefault(),t.connectToApp(!0)}}},[t._v(t._s(t.$i18n.__("Connect your existing account","cookie-law-info")))])])],1)])])])])])},o=[function(){var t=this,c=t.$createElement,e=t._self._c||c;return e("div",{staticClass:"cky-section-header cky-align-center cky-justify-between"},[e("div",{staticClass:"cky-section-header-actions cky-align-center"})])}],i=e("1f3d"),s=e("c068"),a=e("2f62"),r=e("919d"),l={name:"CkyPolicies",mixins:[s["a"]],components:{CkyIcon:i["a"],CkyConnectSuccess:r["a"]},data(){return{}},methods:{},computed:{...Object(a["d"])("settings",["options"]),connected(){return this.options.account.connected&&this.options.account.connected||!1},currentTabComponent:function(){return"tab-"+this.currentTab.toLowerCase()}}},y=l,u=(e("3121"),e("2877")),k=Object(u["a"])(y,n,o,!1,null,null,null);c["default"]=k.exports},3121:function(t,c,e){"use strict";e("d755")},"6c87":function(t,c,e){"use strict";e("b3ba")},"919d":function(t,c,e){"use strict";var n=function(){var t=this,c=t.$createElement,e=t._self._c||c;return t.showConnectSuccess?e("div",{staticClass:"cky-connect-success",attrs:{id:"cky-connect-success"}},[t.syncing?e("div",{staticClass:"cky-connect-loader"},[e("cky-spinner"),e("h4",[t._v(" "+t._s(t.$i18n.__("Please wait while we connect your site to app.cookieyes.com","cookie-law-info"))+" ")])],1):e("div",{staticClass:"cky-connect-success-container"},[e("div",{staticClass:"cky-connect-success-icon"}),e("div",{staticClass:"cky-connect-success-message"},[t._t("message",(function(){return[e("h2",[t._v(" "+t._s(t.$i18n.__("Your website is connected to app.cookieyes.com","cookie-law-info"))+" ")]),e("p",[t._v(" "+t._s(t.$i18n.__("You can now continue to manage all your existing settings and access all free CookieYes features from your web app account","cookie-law-info"))+" ")])]}))],2),e("div",{staticClass:"cky-connect-success-actions"},[t._t("action",(function(){return[e("button",{staticClass:"cky-button cky-button-medium cky-external-link",on:{click:function(c){return t.redirectToApp()}}},[t._v(" "+t._s(t.$i18n.__("Go to CookieYes Web App","cookie-law-info"))+" ")])]}))],2)])]):t._e()},o=[],i=function(){var t=this,c=t.$createElement,e=t._self._c||c;return e("span",{staticClass:"cky-spinner-loader"})},s=[],a={name:"CkySpinner",components:{}},r=a,l=(e("6c87"),e("2877")),y=Object(l["a"])(r,i,s,!1,null,null,null),u=y.exports,k={name:"CkyConnectSuccess",components:{CkySpinner:u},props:{timeout:{type:Number,default:6e3}},data(){return{showConnectSuccess:!1,syncing:!1}},methods:{showMessage(){this.showConnectSuccess=!0},redirectToApp(){this.$router.redirectToApp(),this.showConnectSuccess=!1,this.$router.redirectToDashboard(this.$route.name)}},created(){this.$root.$on("afterConnection",()=>{this.syncing=!0,this.showMessage()}),this.$root.$on("afterSyncing",async()=>{this.syncing=!1})}},p=k,d=(e("a209"),Object(l["a"])(p,n,o,!1,null,null,null));c["a"]=d.exports},a209:function(t,c,e){"use strict";e("d6c6")},b3ba:function(t,c,e){},d6c6:function(t,c,e){},d755:function(t,c,e){}}]);