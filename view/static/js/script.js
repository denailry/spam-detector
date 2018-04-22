$(document).ready(function(){
    console.log('Hello from script.js'); 
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    })
});