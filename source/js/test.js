
function process()
{
  var above = 0, below = 0;
  for(var i=0; i<1000000; i++)
  {
    if(Math.random() * 2 > 1)
    {
      above ++;      
    }
    else
    {
      below ++;
    }
  }
}




function test1()
{
  var result1 = document.getElementById('result1');
  
  var start = new Date().getTime();
    
  for(var i=0; i<100; i++)
  {
    result1.value =  'time=' + 
      (new Date().getTime() - start) + ' [i=' + i + ']';
    
    process();
  }
  
  result1.value = 'time=' + 
    (new Date().getTime() - start) + ' [done]';
}




function test2()
{
  var result2 = document.getElementById('result2');
  
  var start = new Date().getTime();
  
  var i = 0, limit = 100, busy = false;
  var processor = setInterval(function()
  {
    if(!busy)
    {
      busy = true;
      
      result2.value =  'time=' + 
        (new Date().getTime() - start) + ' [i=' + i + ']';
      
      process();
      
      if(++i == limit)
      {
        clearInterval(processor);

        result2.value = 'time=' + 
          (new Date().getTime() - start) + ' [done]';
      }
      
      busy = false;
    }
    
  }, 100);
  
}

