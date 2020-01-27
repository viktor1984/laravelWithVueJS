import '@/bootstrap';
import router from '@/routes';
// import App from '@/App.vue';

new Vue({
    el: '#my-app',
    router//,
    // render: h => h(App)
});

// var vm = new Vue({
//     el: '#app',
//     data: {
//         value: ''
//     },
//     directives: {
//         inputmask: {
//             bind: function(el, binding, vnode) {
//                 $(el).inputmask('999 999-99-99', {
//                     isComplete: function (buffer, opts) {
//                         vnode.context.value = buffer.join('');
//                     }
//                 });
//             },
//         }
//     },
// });
