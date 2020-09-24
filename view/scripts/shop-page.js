;$(document).ready(function(){
  var showSearch  = 0;
  var showFilters = 0;
  //Search processing
  $('.search').click(function(){
    if(!showSearch){
      $('.searchform').css({"display": "flex"});
      setTimeout(function(){$('.searchform').css({"transition": 'opacity 0.2s', "opacity": '1'});}, 10);
      showSearch  = 1;
    }else{
      $('.searchform').css({"transition": 'opacity 0.2s', "opacity": '0'});
      setTimeout(function(){$('.searchform').css({"display": "none"});}, 200);
      showSearch    = 0;
    }
});
  //Categories processing
  $('.filters').click(function(){
    if(!showFilters){
      $('.filterform').css({"display": "flex"});
      setTimeout(function(){$('.filterform').css({"transition": 'opacity 0.2s', "opacity": '1'});}, 10);
      showFilters  = 1;
    }else{
      $('.filterform').css({"transition": 'opacity 0.2s', "opacity": '0'});
      setTimeout(function(){$('.filterform').css({"display": "none"});}, 200);
      showFilters    = 0;
    }
    
  });
  
});