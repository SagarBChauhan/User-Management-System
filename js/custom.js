$(document).ready
(
    function()
    {
      // alert("Hello world");
       $("div#login").hide();      //p = element : element selector  | after (.) action 
       //$("p#test").hide(); //p = element | # used to apply on specified id
       //$("p.test").hide();   //p = element | . used to apply on specified class
       
       //$("p").hide();
       $("a#l").click(
            function()
            {
                $("div#login").slideToggle();
            }
        );
/*       $("h2").click
       (
            function()
            {
                $(this).next().slideToggle();
            }
        );*/
 /*      $("h2").mouseenter
       (
            function()
            {
                $(this).next().slideToggle();
            }
        );*/
       $("p").on({
           mouseenter:function(){
               $(this).css("background-color","lightgray");
           },
           mouseleave:function(){
               $(this).css("background-color","lightblue");
           },
           click:function(){
               $(this).css("background-color","lightgreen");
           }
       });
       $("p").click(function(){
            $(this).animate({height: "300px"});
          });
    }
);