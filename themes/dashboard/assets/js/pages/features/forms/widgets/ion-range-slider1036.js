var KTIONRangeSlider={init:function(){$("#kt_slider_1").ionRangeSlider(),$("#kt_slider_2").ionRangeSlider({min:100,max:1e3,from:550}),$("#kt_slider_3").ionRangeSlider({type:"double",grid:!0,min:0,max:1e3,from:200,to:800,prefix:"$"}),$("#kt_slider_4").ionRangeSlider({type:"double",grid:!0,min:-1e3,max:1e3,from:-500,to:500}),$("#kt_slider_5").ionRangeSlider({type:"double",grid:!0,min:-12.8,max:12.8,from:-3.2,to:3.2,step:.1}),$("#kt_slider_6").ionRangeSlider({type:"single",grid:!0,min:-90,max:90,from:0,postfix:"°"}),$("#kt_slider_7").ionRangeSlider({type:"double",min:100,max:200,from:145,to:155,prefix:"Weight: ",postfix:" million pounds",decorate_both:!0})}};jQuery(document).ready((function(){KTIONRangeSlider.init()}));