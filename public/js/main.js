// var Main = function () {
//     return {
//         init: function () {
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
//                 }
//             });
//         }
//     };
// }();

$(document).ready(function () {
    // Main.init();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
        }
    });
});