(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[185],{9947:function(e,t,n){Promise.resolve().then(n.t.bind(n,3054,23)),Promise.resolve().then(n.bind(n,357)),Promise.resolve().then(n.bind(n,2553)),Promise.resolve().then(n.bind(n,4663))},6463:function(e,t,n){"use strict";var r=n(1169);n.o(r,"useRouter")&&n.d(t,{useRouter:function(){return r.useRouter}})},9997:function(e,t,n){"use strict";n.d(t,{Z:function(){return o},b:function(){return r}});let r={LIMITED:"Limited",UNLIMITED:"Unlimited"};function o(e){return async function(t){try{let n=await fetch(e,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(t)});return await n.json()}catch(e){return!1}}}},357:function(e,t,n){"use strict";n.d(t,{Z:function(){return s},default:function(){return u}});var r=n(7437),o=n(2265);let i=(0,o.createContext)({config:{},setConfig:()=>{}});function u(e){let{children:t}=e,[n,u]=(0,o.useState)({});return(0,o.useEffect)(()=>{(()=>{let e=localStorage.getItem("config");e&&u(JSON.parse(e))})()},[]),(0,r.jsx)(i.Provider,{value:{config:n,setConfig:e=>{let t=Object.assign(n,{...e});localStorage.setItem("config",JSON.stringify(t)),u(t)}},children:t})}let s=()=>(0,o.useContext)(i)},2553:function(e,t,n){"use strict";n.d(t,{default:function(){return c},y:function(){return a}});var r=n(7437),o=n(9997),i=n(2265),u=n(357);let s=(0,i.createContext)({});function c(e){let{config:t}=(0,u.Z)(),n=(0,o.Z)("".concat(null==t?void 0:t.baseURL,"/system/api.php?r=hotspot"));return(0,r.jsx)(s.Provider,{value:n,children:e.children})}let a=()=>(0,i.useContext)(s)},4663:function(e,t,n){"use strict";n.d(t,{a:function(){return a},default:function(){return c}});var r=n(7437),o=n(2265),i=n(6463);let u=(0,o.createContext)({}),s={id:0,username:"",password:null,pppoe_password:null,fullname:"",address:"",city:"Nairobi",district:"Nairobi",state:"Kenya",zip:"+254",phonenumber:"",email:"johndoe@anon.com",coordinates:"6.465422, 3.406448",account_type:"Personal",balance:0,service_type:"Hotspot",auto_renewal:1,status:"Active",created_by:0,created_at:"2024-07-12 14:03:05",last_login:null,plans:[]};function c(e){let t=(0,i.useRouter)(),[n,c]=(0,o.useState)(s);function a(){let e=JSON.parse(String(localStorage.getItem("user")));e||t.replace("/signin"),c(e)}return(0,o.useEffect)(a,[t]),(0,r.jsx)(u.Provider,{value:{user:n,setUser:function(e){e&&localStorage.setItem("user",JSON.stringify(e)),c(e)},loadUser:a},children:e.children})}let a=()=>(0,o.useContext)(u)},3054:function(){}},function(e){e.O(0,[141,971,23,744],function(){return e(e.s=9947)}),_N_E=e.O()}]);