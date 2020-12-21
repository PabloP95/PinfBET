/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$('#myTabs a').click(function (e) {
//  e.preventDefault();
//  $(this).tab('show');
//});

function updateScroll(){
    var element = document.getElementById("charla");
    element.scrollTop = element.scrollHeight;
}

//once a second
setInterval(updateScroll,1000);
