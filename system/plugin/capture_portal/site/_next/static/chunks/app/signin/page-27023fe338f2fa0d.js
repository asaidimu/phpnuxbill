(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[281],{4561:function(e,s,n){Promise.resolve().then(n.bind(n,1982))},1982:function(e,s,n){"use strict";n.r(s),n.d(s,{default:function(){return p}});var l=n(7437),t=n(2198),a=n(4088),c=n(9733),r=n(8185),i=n(7209),u=n(402),o=n(357),d=n(6463),m=n(2265),h=n(2553),f=n(4663);function x(){let e=(0,d.useRouter)(),{user:s}=(0,f.a)(),[n,t]=(0,m.useState)(s.phonenumber?s.phonenumber:""),[x,p]=(0,m.useState)(!1),[j,N]=(0,m.useState)(!1),{config:w}=(0,o.Z)(),b=(0,h.y)();async function v(){p(!0),N(!1);let s=await b({action:"connectCustomer",params:{username:n,password:w.mac,macAddress:w.mac,ipAddress:w.ip}});p(!1),s.success?e.push("/dashboard"):N(!0)}return(0,l.jsxs)(r.Zb,{className:"min-w-[320px] w-full",children:[(0,l.jsxs)(r.Ol,{children:[(0,l.jsx)(r.ll,{children:(null==w?void 0:w.title)?null==w?void 0:w.title:"Zeiteck Wifi Login"}),(0,l.jsx)(r.SZ,{className:j?"text-red-500 font-medium":"",children:j?"Could not fetch your account!! Please try again!":"Already have a plan? Activate it!"})]}),(0,l.jsx)(r.aY,{children:(0,l.jsxs)("div",{className:"grid w-full items-center gap-4",children:[(0,l.jsx)("input",{type:"hidden",name:"router",value:(null==w?void 0:w.router)?w.router:""}),(0,l.jsxs)("div",{className:"flex flex-col space-y-4",children:[(0,l.jsx)(u._,{htmlFor:"phone",children:"Phone Number"}),(0,l.jsx)(i.I,{value:n,type:"text",name:"phone",onChange:e=>{t(e.target.value)},id:"name",placeholder:"Enter your phone number."})]})]})}),(0,l.jsx)(r.eW,{className:"flex flex-col gap-2",children:(0,l.jsxs)(c.z,{className:"w-full text-center uppercase",type:"button",onClick:()=>{v()},disabled:x,children:[x&&(0,l.jsx)(a.P.spinner,{className:"mr-2 h-4 w-4 animate-spin"}),"Activate Purchased Plan"]})})]})}function p(){return(0,l.jsxs)("main",{className:"flex min-h-screen flex-col md:p-16 p-4 gap-8",children:[(0,l.jsx)("section",{className:"flex flex-col items-center justify-between w-full",children:(0,l.jsx)(x,{})}),(0,l.jsx)("section",{className:"flex flex-col items-center justify-between w-full",children:(0,l.jsx)(t.M,{className:"flex-grow h-full"})})]})}}},function(e){e.O(0,[970,198,971,23,744],function(){return e(e.s=4561)}),_N_E=e.O()}]);