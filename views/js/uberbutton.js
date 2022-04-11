$(document).ready(function(){

  $(document).on('click', '#uberButton', function(){
    var getUrl = window.location;
    var baseurl = getUrl.origin; //or
    var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
    $.ajax({
      type: 'GET',
      url: baseurl + '/modules/mymodule/auth/AuthUber.php',
      headers: { "cache-control": "no-cache" },
      async: true,
      cache: false,
      data:{'baseUrl':baseurl},
      success: function(data)
      {
        console.log("connected");
      }
    });
  });
});
